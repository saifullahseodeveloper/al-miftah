<?php
session_start();
require_once 'admin-panel/db.php';
require_once 'admin-panel/otp_helper.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user profile
$stmt = $pdo->prepare("SELECT u.email, p.* FROM custom_users u LEFT JOIN custom_user_profiles p ON u.id = p.user_id WHERE u.id = ?");
$stmt->execute([$user_id]);
$profile = $stmt->fetch();

if (!$profile) {
    header("Location: profile.php");
    exit();
}

if (!empty($profile['mobile_verified'])) {
    header("Location: profile.php?verified=1");
    exit();
}

$error = '';
$success = '';

// Check if user requested resend OTP
if (isset($_GET['resend'])) {
    $res = send_neknav_otp($pdo, $user_id, $profile['mobile']);
    $success = "Naya OTP bhej diya gaya hai.";
}

// Handle OTP verification submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_otp_submit'])) {
    $entered_otp = trim($_POST['otp'] ?? '');

    $chk = $pdo->prepare("SELECT * FROM custom_otp WHERE user_id = ? ORDER BY id DESC LIMIT 1");
    $chk->execute([$user_id]);
    $otp_record = $chk->fetch();

    if (!$otp_record) {
        $error = "Koi active OTP nahi mila. Resend par click karein.";
    } elseif (strtotime($otp_record['expires_at']) < time()) {
        $error = "OTP expire ho chuka hai. Naya OTP mangwayen.";
    } elseif ($otp_record['otp'] !== $entered_otp) {
        $error = "Ghalat OTP darj kiya gaya hai. Dobara check karein.";
    } else {
        // Mark OTP verified
        $upd_otp = $pdo->prepare("UPDATE custom_otp SET verified = 1 WHERE id = ?");
        $upd_otp->execute([$otp_record['id']]);

        // Update profile
        $new_status = ($profile['profile_complete'] && $profile['doc_verified']) ? 'fully_verified' : 'mobile_verified';
        $upd_p = $pdo->prepare("UPDATE custom_user_profiles SET mobile_verified = 1, status = ? WHERE user_id = ?");
        $upd_p->execute([$new_status, $user_id]);

        $_SESSION['mobile_verified'] = 1;
        header("Location: profile.php?mobile_verified=1");
        exit();
    }
}

// Check latest test OTP in session or DB
$test_otp = $_SESSION['neknav_test_otp'] ?? '';
if (empty($test_otp)) {
    $lstmt = $pdo->prepare("SELECT otp FROM custom_otp WHERE user_id = ? AND expires_at > datetime('now') ORDER BY id DESC LIMIT 1");
    $lstmt->execute([$user_id]);
    $test_otp = $lstmt->fetchColumn() ?: '';
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Verify Mobile Number - Al-Miftah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f0faf4; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .otp-box {
            background: #fff;
            max-width: 440px;
            width: 100%;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            border: 2px solid #d8f3dc;
            text-align: center;
        }
        .otp-icon {
            width: 70px;
            height: 70px;
            background: #e8f5ed;
            color: #1B6B3A;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 20px;
        }
        h2 { color: #122f2a; font-size: 24px; font-weight: 800; margin-bottom: 8px; }
        p { color: #667471; font-size: 14px; line-height: 1.5; margin-bottom: 25px; }
        .otp-input {
            width: 100%;
            padding: 15px;
            text-align: center;
            font-size: 26px;
            letter-spacing: 12px;
            font-weight: 800;
            color: #1B6B3A;
            border: 2px solid #b7e4c7;
            border-radius: 12px;
            background: #fafffe;
            margin-bottom: 20px;
            outline: none;
            transition: 0.2s;
        }
        .otp-input:focus { border-color: #1B6B3A; box-shadow: 0 0 0 4px rgba(27,107,58,0.1); }
        .verify-btn {
            width: 100%;
            padding: 14px;
            background: #1B6B3A;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 6px 20px rgba(27,107,58,0.25);
        }
        .verify-btn:hover { background: #14532d; transform: translateY(-2px); }
        .resend-link { margin-top: 20px; font-size: 13.5px; color: #666; }
        .resend-link a { color: #c8963e; font-weight: 700; text-decoration: none; }
        .test-badge {
            background: #e6f9ed;
            border: 1.5px dashed #52b788;
            color: #1b4332;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13.5px;
        }
        .msg { padding: 12px; border-radius: 8px; font-size: 13.5px; margin-bottom: 20px; }
        .msg-err { background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; }
        .msg-ok { background: #dcfce7; color: #16a34a; border: 1px solid #86efac; }
    </style>
</head>
<body>

<div class="otp-box">
    <div class="otp-icon"><i class="fa-solid fa-shield-halved"></i></div>
    <h2>Mobile Verification</h2>
    <p>Aapke mobile number <strong><?php echo htmlspecialchars($profile['mobile']); ?></strong> par 6-digit OTP bheja gaya hai.</p>

    <?php if ($test_otp): ?>
    <div class="test-badge">
        <i class="fa-solid fa-flask" style="color:#c8963e;"></i> <strong>Test Mode Active:</strong><br>
        Aapka Demo OTP hai: <strong style="font-size:18px; color:#1B6B3A; letter-spacing:2px;"><?php echo htmlspecialchars($test_otp); ?></strong>
    </div>
    <?php endif; ?>

    <?php if ($error): ?> <div class="msg msg-err"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?></div> <?php endif; ?>
    <?php if ($success): ?> <div class="msg msg-ok"><i class="fa-solid fa-circle-check"></i> <?php echo $success; ?></div> <?php endif; ?>

    <form method="POST">
        <input type="text" name="otp" class="otp-input" maxlength="6" placeholder="000000" autofocus required />
        <button type="submit" name="verify_otp_submit" class="verify-btn">Verify Mobile & Continue &rarr;</button>
    </form>

    <div class="resend-link">
        OTP nahi mila? <a href="verify-mobile.php?resend=1">Resend OTP</a> | <a href="profile.php">Skip For Now</a>
    </div>
</div>

</body>
</html>
