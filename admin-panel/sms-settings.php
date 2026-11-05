<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

$saved = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_sms_settings'])) {
    $provider  = trim($_POST['sms_provider'] ?? 'fast2sms');
    $api_key   = trim($_POST['sms_api_key'] ?? '');
    $sender_id = trim($_POST['sms_sender_id'] ?? 'ALMIFT');
    $test_mode = isset($_POST['sms_test_mode']) ? '1' : '0';

    $settings = [
        'sms_provider'  => $provider,
        'sms_api_key'   => $api_key,
        'sms_sender_id' => $sender_id,
        'sms_test_mode' => $test_mode
    ];

    foreach ($settings as $k => $v) {
        $stmt = $pdo->prepare("INSERT OR REPLACE INTO custom_settings (setting_key, setting_value) VALUES (?, ?)");
        if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) !== 'sqlite') {
            $stmt = $pdo->prepare("INSERT INTO custom_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
        }
        $stmt->execute([$k, $v]);
    }
    $saved = true;
}

// Fetch current settings
$rows = $pdo->query("SELECT setting_key, setting_value FROM custom_settings WHERE setting_key LIKE 'sms_%'")->fetchAll();
$cfg = [];
foreach ($rows as $r) {
    $cfg[$r['setting_key']] = $r['setting_value'];
}

$provider  = $cfg['sms_provider'] ?? 'fast2sms';
$api_key   = $cfg['sms_api_key'] ?? '';
$sender_id = $cfg['sms_sender_id'] ?? 'ALMIFT';
$test_mode = $cfg['sms_test_mode'] ?? '1';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS & OTP Settings - Admin CMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #1B6B3A; --sidebar-bg: #111827; --sidebar-hover: #1f2937; --text-main: #f9fafb; --text-muted: #9ca3af; --bg-body: #f0faf4; --card-bg: #ffffff; --text-dark: #122f2a; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: var(--bg-body); }
        .sidebar { width: 260px; background-color: var(--sidebar-bg); color: var(--text-main); display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-header { padding: 20px; font-size: 20px; font-weight: 700; text-align: center; border-bottom: 1px solid var(--sidebar-hover); display: flex; align-items: center; justify-content: center; gap: 10px; }
        .sidebar-header i { color: #52b788; }
        .nav-links { flex-grow: 1; padding: 20px 0; list-style: none; }
        .nav-links li { padding: 4px 15px; }
        .nav-links a { display: flex; align-items: center; gap: 12px; color: var(--text-muted); text-decoration: none; padding: 10px 16px; border-radius: 8px; font-size: 14.5px; transition: all 0.2s; }
        .nav-links a:hover, .nav-links a.active { background-color: var(--sidebar-hover); color: var(--text-main); }
        .nav-links a.active i { color: #52b788; }
        .logout-btn { margin: 20px; padding: 12px; background-color: rgba(239, 68, 68, 0.1); color: #ef4444; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600; display: block; }
        .main-content { flex-grow: 1; display: flex; flex-direction: column; }
        .header { background: #fff; padding: 20px 40px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); display: flex; justify-content: space-between; align-items: center; }
        .container { padding: 30px 40px; max-width: 800px; }
        .card { background: #fff; border-radius: 14px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1.5px solid #d8f3dc; }
        .lbl { display: block; font-size: 13px; font-weight: 700; color: #122f2a; margin-bottom: 6px; }
        .ctrl { width: 100%; padding: 12px 14px; border: 1.5px solid #dcdcdc; border-radius: 8px; font-size: 14px; outline: none; margin-bottom: 18px; }
        .ctrl:focus { border-color: #1B6B3A; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header"><i class="fa-solid fa-leaf"></i> Al Miftah CMS</div>
        <ul class="nav-links">
            <li><a href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="users.php"><i class="fa-solid fa-users"></i> Users List</a></li>
            <li><a href="tree.php"><i class="fa-solid fa-sitemap"></i> Referral Tree</a></li>
            <li><a href="kyc.php"><i class="fa-solid fa-id-card"></i> KYC Approvals</a></li>
            <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
            <li><a href="sms-settings.php" class="active"><i class="fa-solid fa-mobile-screen"></i> SMS / OTP</a></li>
            <li><a href="causes.php"><i class="fa-solid fa-hand-holding-heart"></i> Causes</a></li>
            <li><a href="events.php"><i class="fa-solid fa-calendar-days"></i> Events</a></li>
            <li><a href="blogs.php"><i class="fa-solid fa-newspaper"></i> Blogs</a></li>
            <li><a href="gallery.php"><i class="fa-solid fa-images"></i> Gallery</a></li>
            <li><a href="contacts.php"><i class="fa-solid fa-envelope"></i> Inquiries</a></li>
        </ul>
        <a href="logout.php" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
    </aside>

    <div class="main-content">
        <div class="header">
            <h2 style="font-size:22px; color:#122f2a;">📱 Al Miftah SMS & OTP Configuration</h2>
            <div style="font-size:14px; font-weight:600; color:#1B6B3A;"><i class="fa-solid fa-user-shield"></i> Admin Panel</div>
        </div>

        <div class="container">
            <?php if ($saved): ?>
            <div style="background:#dcfce7; color:#166534; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700;">
                SMS Settings kamyabi se save ho gayi hain!
            </div>
            <?php endif; ?>

            <div class="card">
                <form method="POST">
                    <label class="lbl">SMS Gateway Provider</label>
                    <select name="sms_provider" class="ctrl">
                        <option value="fast2sms" <?= $provider === 'fast2sms' ? 'selected' : '' ?>>Fast2SMS (India — Fast & Affordable)</option>
                        <option value="msg91" <?= $provider === 'msg91' ? 'selected' : '' ?>>MSG91 Enterprise</option>
                        <option value="twilio" <?= $provider === 'twilio' ? 'selected' : '' ?>>Twilio Global</option>
                    </select>

                    <label class="lbl">API Authorization Key</label>
                    <input type="text" name="sms_api_key" value="<?= htmlspecialchars($api_key) ?>" placeholder="Fast2SMS Authorization Token" class="ctrl" />

                    <label class="lbl">Sender ID / Route</label>
                    <input type="text" name="sms_sender_id" value="<?= htmlspecialchars($sender_id) ?>" placeholder="e.g. ALMIFT" class="ctrl" />

                    <div style="background:#f4fbf6; border:1.5px dashed #b7e4c7; padding:16px 20px; border-radius:10px; margin-bottom:20px;">
                        <label style="display:flex; align-items:center; gap:10px; font-weight:700; color:#1b4332; cursor:pointer;">
                            <input type="checkbox" name="sms_test_mode" value="1" <?= $test_mode === '1' ? 'checked' : '' ?> style="width:18px; height:18px;" />
                            <span>🧪 Development Test Mode ON (Screen par OTP dikhao)</span>
                        </label>
                        <p style="font-size:12.5px; color:#666; margin:6px 0 0 28px;">Jab Test Mode ON ho, to SMS credits kharch nahi hote aur OTP screen par demo badge mein dikh jata hai. Live launching ke waqt ise uncheck kar dein.</p>
                    </div>

                    <button type="submit" name="save_sms_settings" style="background:#1B6B3A; color:#fff; padding:12px 28px; border-radius:8px; font-weight:700; border:none; cursor:pointer; font-size:14.5px;">Save SMS Settings</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
