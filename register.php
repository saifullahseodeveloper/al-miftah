<?php
session_start();
require_once 'admin-panel/db.php';
require_once 'admin-panel/otp_helper.php';

// If already logged in, go to profile
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

// Track referral from GET parameter or cookie
if (isset($_GET['ref']) && !empty($_GET['ref'])) {
    setcookie('neknav_referrer', trim($_GET['ref']), time() + (86400 * 30), "/");
}

$ref_from_param = $_GET['ref'] ?? ($_COOKIE['neknav_referrer'] ?? '');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['neknav_register_submit'])) {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $mobile = trim($_POST['mobile'] ?? '');
    $pass = $_POST['password'] ?? '';
    $ref_code = trim($_POST['referred_by'] ?? ($ref_from_param));

    if (empty($full_name) || empty($email) || empty($mobile) || empty($pass)) {
        $error = "Barah-e-karam saari zaroori fields bharein.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Ghalat email format darj kiya gaya hai.";
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM custom_users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Yeh email address pehle se registered hai.";
        } else {
            // Find referrer ID if code provided
            $referrer_id = null;
            if (!empty($ref_code)) {
                $rstmt = $pdo->prepare("SELECT user_id FROM custom_user_profiles WHERE UPPER(referral_code) = UPPER(?)");
                $rstmt->execute([$ref_code]);
                $referrer_id = $rstmt->fetchColumn() ?: null;
            }

            // Generate Username
            $email_prefix = preg_replace('/[^a-zA-Z0-9]/', '', explode('@', $email)[0]);
            $username = $email_prefix . rand(10, 99);

            // Password Hash
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            // Insert into custom_users
            $ins_user = $pdo->prepare("INSERT INTO custom_users (username, email, password, role) VALUES (?, ?, ?, 'user')");
            if ($ins_user->execute([$username, $email, $hash])) {
                $user_id = $pdo->lastInsertId();

                // Generate Unique Referral Code for new user: NK + 6 chars
                $my_referral_code = 'NK' . strtoupper(substr(md5($user_id . time() . rand()), 0, 6));

                // Insert into custom_user_profiles
                $ins_profile = $pdo->prepare("INSERT INTO custom_user_profiles (user_id, full_name, mobile, referral_code, referred_by, status) VALUES (?, ?, ?, ?, ?, 'registered')");
                $ins_profile->execute([$user_id, $full_name, $mobile, $my_referral_code, $referrer_id]);

                // Auto login user
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'user';

                // Send OTP
                send_neknav_otp($pdo, $user_id, $mobile);

                // Redirect to Mobile Verification
                header("Location: verify-mobile.php");
                exit();
            } else {
                $error = "Kuch technical kharabi hui. Dobara koshish karein.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Join Al-Miftah - Educational Trust</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f0faf4; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 25px 15px; }
        .nk-auth-box {
            max-width: 460px;
            width: 100%;
            padding: 35px 30px;
            border: 2px solid #d8f3dc;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        }
        .nk-logo-wrap { text-align: center; margin-bottom: 20px; }
        .nk-logo-wrap img { width: 85px; height: auto; }
        .nk-auth-box h2 { text-align: center; color: #1B6B3A; font-size: 24px; font-weight: 800; margin-bottom: 6px; }
        .nk-subhead { text-align: center; color: #667471; font-size: 13.5px; margin-bottom: 25px; }
        .nk-field { margin-bottom: 16px; }
        .nk-field label { font-weight: 700; font-size: 13px; color: #122f2a; display: block; margin-bottom: 6px; }
        .nk-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #d0e8da;
            border-radius: 10px;
            background: #fafffe;
            color: #122f2a;
            font-size: 14.5px;
            outline: none;
            transition: 0.2s;
        }
        .nk-input:focus { border-color: #1B6B3A; background: #fff; box-shadow: 0 0 0 3px rgba(27,107,58,0.1); }
        .nk-btn {
            width: 100%;
            padding: 14px;
            background: #1B6B3A;
            color: #fff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 800;
            font-size: 15px;
            margin-top: 15px;
            box-shadow: 0 6px 20px rgba(27,107,58,0.25);
            transition: all 0.3s;
        }
        .nk-btn:hover { background: #14532d; transform: translateY(-2px); }
        .nk-auth-link { text-align: center; margin-top: 22px; font-size: 13.5px; color: #4b5563; }
        .nk-auth-link a { color: #1B6B3A; font-weight: 700; text-decoration: none; }
        .msg { padding: 12px; border-radius: 8px; margin-bottom: 18px; font-size: 13.5px; text-align: center; }
        .msg-err { background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; }
        .pass-toggle { position: absolute; right: 14px; top: 13px; cursor: pointer; color: #888; font-size: 16px; }
    </style>
</head>
<body>
    <div class="nk-auth-box">
        <div class="nk-logo-wrap">
            <a href="index.php"><img src="wp-content/uploads/2026/04/new-logo-change-.png" onerror="this.src='assets/images/logo.png'" alt="Al-Miftah Logo"></a>
        </div>
        <h2>🌱 Join Al-Miftah</h2>
        <p class="nk-subhead">Al-Miftah Charity & Education Network</p>
        
        <?php if ($error): ?> <div class="msg msg-err"><i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?></div> <?php endif; ?>

        <form method="post" id="neknav-reg-form">
            <div class="nk-field">
                <label><i class="fa-solid fa-users" style="color:#C8963E;"></i> Referral Code (Optional)</label>
                <input type="text" name="referred_by" id="ref_field" value="<?= htmlspecialchars($ref_from_param) ?>" class="nk-input" style="background:#f4fbf6; border-color:#b7e4c7; font-weight:700; text-transform:uppercase;" placeholder="e.g. NK12345">
            </div>

            <div class="nk-field">
                <label>Poora Naam (Full Name) *</label>
                <input type="text" name="full_name" class="nk-input" placeholder="Aapka Naam" required>
            </div>

            <div class="nk-field">
                <label>Email Address *</label>
                <input type="email" name="email" class="nk-input" placeholder="email@example.com" required>
            </div>

            <div class="nk-field">
                <label>Mobile Number *</label>
                <input type="tel" name="mobile" class="nk-input" placeholder="10-digit Mobile Number" required>
            </div>

            <div class="nk-field">
                <label>Password *</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="reg-pass" class="nk-input" placeholder="Minimum 6 characters" required>
                    <span class="pass-toggle" onclick="togglePass()"><i class="fa-regular fa-eye" id="eyeIcon"></i></span>
                </div>
            </div>

            <button type="submit" name="neknav_register_submit" class="nk-btn">
                Register & Verify Mobile <i class="fa-solid fa-arrow-right" style="margin-left:6px;"></i>
            </button>
        </form>

        <div class="nk-auth-link">
            Pehle se account hai? <a href="login.php">Login Now &rarr;</a>
        </div>
        <div style="text-align:center; margin-top:15px;">
            <a href="index.php" style="color:#888; font-size:12.5px; text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> Home Page Wapas Jayein</a>
        </div>
    </div>

    <script>
    function togglePass() {
        var p = document.getElementById("reg-pass");
        var eye = document.getElementById("eyeIcon");
        if (p.type === "password") {
            p.type = "text";
            eye.classList.remove("fa-eye");
            eye.classList.add("fa-eye-slash");
        } else {
            p.type = "password";
            eye.classList.remove("fa-eye-slash");
            eye.classList.add("fa-eye");
        }
    }
    </script>
</body>
</html>
