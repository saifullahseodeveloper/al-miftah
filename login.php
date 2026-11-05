<?php
session_start();
require_once 'admin-panel/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $login_user = trim($_POST['login_user']);
    $pass       = $_POST['password'];
    
    if (!empty($login_user) && !empty($pass)) {
        // Look up by email or mobile or username
        // Mobile is in custom_user_profiles, so let's join
        $stmt = $pdo->prepare("
            SELECT u.id, u.username, u.password, u.role 
            FROM custom_users u
            LEFT JOIN custom_user_profiles p ON u.id = p.user_id
            WHERE u.email = ? OR u.username = ? OR p.mobile = ?
        ");
        $stmt->execute([$login_user, $login_user, $login_user]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: profile.php");
            exit();
        } else {
            // Check for plain text (for migrated WordPress users)
            if ($user && $pass === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                // Securely upgrade password hash
                $new_hash = password_hash($pass, PASSWORD_DEFAULT);
                $upd = $pdo->prepare("UPDATE custom_users SET password = ? WHERE id = ?");
                $upd->execute([$new_hash, $user['id']]);
                
                header("Location: profile.php");
                exit();
            } else {
                $error = "Ghalat Email/Mobile ya Password.";
            }
        }
    } else {
        $error = "In-put sahi se bharein.";
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Login - Al-miftah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body { background-color: #f0faf4 !important; font-family: sans-serif; margin: 0; padding: 0; }
        .nk-auth-box {
            max-width: 450px;
            margin: 60px auto;
            padding: 25px;
            border: 2px solid #d8f3dc;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
        }
        .nk-auth-box h2 { text-align: center; color: #2d6a4f; margin-bottom: 5px; }
        .nk-sub { text-align: center; color: #52b788; font-size: 13px; margin-bottom: 25px; font-weight: bold; }
        .nk-field label { font-weight: bold; font-size: 14px; color: #1b4332; display: block; margin-bottom: 5px; }
        .nk-input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1.5px solid #d0e8da;
            border-radius: 5px;
            background: #fafffe;
            color: #1b4332;
            box-sizing: border-box;
        }
        .nk-btn {
            width: 100%;
            padding: 14px;
            background: #1b4332;
            color: #52b788;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
            text-transform: uppercase;
        }
        .nk-auth-link { text-align: center; margin-top: 20px; font-size: 14px; color: #4b5563; }
        .nk-auth-link a { color: #2d6a4f; font-weight: 700; text-decoration: none; }
        .msg { padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center; }
        .msg-err { background: #fde8e8; color: #c81e1e; border: 1px solid #f8b4b4; }
    </style>
</head>
<body>
    <div class="nk-auth-box">
        <div style="text-align:center; margin-bottom:15px;">
             <img src="wp-content/uploads/2026/04/new-logo-change-.png" alt="Logo" style="width: 70px;">
        </div>
        <h2>Login</h2>
        <p class="nk-sub">APNE ACCOUNT MEIN LOGIN KAREIN</p>

        <?php if($error): ?> <div class="msg msg-err"><?= $error ?></div> <?php endif; ?>

        <form method="post">
            <div class="nk-field">
                <label>Email Address ya Mobile Number</label>
                <input type="text" name="login_user" class="nk-input" placeholder="Email ya Mobile likhein" required>
            </div>

            <div class="nk-field">
                <label>Password</label>
                <input type="password" name="password" class="nk-input" placeholder="Password likhein" required>
            </div>

            <button type="submit" name="login_submit" class="nk-btn">LOGIN KAREIN</button>
        </form>

        <div class="nk-auth-link">
            Naya account banana hai? <a href="register.php">Register Now</a>
        </div>
    </div>
</body>
</html>
