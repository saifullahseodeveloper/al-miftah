<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

// Fetch quick stats
$stats = [];
try {
    $stats['users'] = $pdo->query("SELECT COUNT(*) FROM custom_users WHERE role = 'user'")->fetchColumn() ?: 0;
    $stats['pending_kyc'] = $pdo->query("SELECT COUNT(*) FROM custom_user_documents WHERE status = 'pending'")->fetchColumn() ?: 0;
    $stats['pending_donations'] = $pdo->query("SELECT COUNT(*) FROM custom_donations WHERE status = 'pending'")->fetchColumn() ?: 0;
    $stats['total_raised'] = $pdo->query("SELECT SUM(amount) FROM custom_donations WHERE status = 'approved'")->fetchColumn() ?: 0;
    $stats['causes'] = $pdo->query("SELECT COUNT(*) FROM custom_causes")->fetchColumn() ?: 0;
    $stats['events'] = $pdo->query("SELECT COUNT(*) FROM custom_events")->fetchColumn() ?: 0;
    $stats['blogs'] = $pdo->query("SELECT COUNT(*) FROM custom_blogs")->fetchColumn() ?: 0;
    $stats['contacts'] = $pdo->query("SELECT COUNT(*) FROM custom_contacts WHERE status = 'new'")->fetchColumn() ?: 0;
} catch (PDOException $e) {
    $stats = ['users' => 0, 'pending_kyc' => 0, 'pending_donations' => 0, 'total_raised' => 0, 'causes' => 0, 'events' => 0, 'blogs' => 0, 'contacts' => 0];
}

// Fetch recent donations
$recent_dons = $pdo->query("SELECT * FROM custom_donations ORDER BY created_at DESC LIMIT 5")->fetchAll();

// Fetch recent users
$recent_users = $pdo->query("SELECT u.username, u.email, p.full_name, p.status, p.joined_at, p.user_id FROM custom_users u LEFT JOIN custom_user_profiles p ON u.id = p.user_id WHERE u.role = 'user' ORDER BY u.created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Dashboard - Al-Miftah CMS</title>
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
        .container { padding: 30px 40px; }
        .stat-card { background: #fff; border-radius: 16px; padding: 22px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1.5px solid #d8f3dc; display: flex; align-items: center; justify-content: space-between; text-decoration: none; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.06); }
        .stat-val { font-size: 28px; font-weight: 800; color: #122f2a; margin-top: 4px; }
        .stat-lbl { font-size: 11.5px; text-transform: uppercase; font-weight: 700; color: #667471; letter-spacing: 0.5px; }
        .stat-ico { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
        .card-table { background: #fff; border-radius: 14px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1.5px solid #d8f3dc; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header"><i class="fa-solid fa-leaf"></i> Al Miftah CMS</div>
        <ul class="nav-links">
            <li><a href="index.php" class="active"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="users.php"><i class="fa-solid fa-users"></i> Users List</a></li>
            <li><a href="tree.php"><i class="fa-solid fa-sitemap"></i> Referral Tree</a></li>
            <li><a href="kyc.php"><i class="fa-solid fa-id-card"></i> KYC Approvals (<?= $stats['pending_kyc'] ?>)</a></li>
            <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations (<?= $stats['pending_donations'] ?>)</a></li>
            <li><a href="sms-settings.php"><i class="fa-solid fa-mobile-screen"></i> SMS / OTP</a></li>
            <li><a href="causes.php"><i class="fa-solid fa-hand-holding-heart"></i> Causes</a></li>
            <li><a href="events.php"><i class="fa-solid fa-calendar-days"></i> Events</a></li>
            <li><a href="blogs.php"><i class="fa-solid fa-newspaper"></i> Blogs</a></li>
            <li><a href="gallery.php"><i class="fa-solid fa-images"></i> Gallery</a></li>
            <li><a href="contacts.php"><i class="fa-solid fa-envelope"></i> Inquiries (<?= $stats['contacts'] ?>)</a></li>
        </ul>
        <a href="logout.php" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
    </aside>

    <div class="main-content">
        <div class="header">
            <h2 style="font-size:22px; color:#122f2a;">Al-Miftah Educational Trust — Master Dashboard</h2>
            <div style="font-size:14px; font-weight:600; color:#1B6B3A;">
                <a href="../index.php" target="_blank" style="color:#1B6B3A; text-decoration:none; margin-right:15px;"><i class="fa-solid fa-globe"></i> View Website</a>
                <i class="fa-solid fa-user-shield"></i> <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?>
            </div>
        </div>

        <div class="container">
            <!-- Welcome Banner -->
            <div style="background:linear-gradient(135deg, #122f2a, #1B6B3A); color:#fff; border-radius:18px; padding:30px 35px; margin-bottom:30px; box-shadow:0 8px 25px rgba(27,107,58,0.25);">
                <span style="background:rgba(200,150,62,0.3); color:#f5d082; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:700; text-transform:uppercase;">Al Miftah Management System</span>
                <h1 style="font-size:28px; font-weight:800; margin:10px 0 6px;">Assalamu Alaikum, Administrator</h1>
                <p style="color:#cbd5e1; font-size:14px; margin:0;">Aapka custom PHP charity platform bina WordPress dependency ke 100% active aur run ho raha hai.</p>
            </div>

            <!-- Stats Grid -->
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:20px; margin-bottom:35px;">
                <a href="users.php" class="stat-card">
                    <div>
                        <div class="stat-lbl">Al Miftah Members</div>
                        <div class="stat-val"><?= $stats['users'] ?></div>
                    </div>
                    <div class="stat-ico" style="background:#e8f5ed; color:#1B6B3A;"><i class="fa-solid fa-users"></i></div>
                </a>

                <a href="kyc.php" class="stat-card">
                    <div>
                        <div class="stat-lbl">Pending KYC Docs</div>
                        <div class="stat-val" style="color:<?= $stats['pending_kyc'] > 0 ? '#dc2626' : '#16a34a' ?>;"><?= $stats['pending_kyc'] ?></div>
                    </div>
                    <div class="stat-ico" style="background:#fef3c7; color:#d97706;"><i class="fa-solid fa-id-card"></i></div>
                </a>

                <a href="donations.php" class="stat-card">
                    <div>
                        <div class="stat-lbl">Pending Donations</div>
                        <div class="stat-val" style="color:<?= $stats['pending_donations'] > 0 ? '#dc2626' : '#16a34a' ?>;"><?= $stats['pending_donations'] ?></div>
                    </div>
                    <div class="stat-ico" style="background:#fee2e2; color:#dc2626;"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                </a>

                <a href="donations.php" class="stat-card">
                    <div>
                        <div class="stat-lbl">Total Funds Raised</div>
                        <div class="stat-val" style="color:#1B6B3A;">₹<?= number_format((float)$stats['total_raised']) ?></div>
                    </div>
                    <div class="stat-ico" style="background:#e8f5ed; color:#1B6B3A;"><i class="fa-solid fa-coins"></i></div>
                </a>
            </div>

            <!-- Two-column Activity Tables -->
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(400px, 1fr)); gap:25px;">
                <!-- Recent Donations -->
                <div class="card-table">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
                        <h4 style="font-size:16px; font-weight:800; color:#122f2a; margin:0;"><i class="fa-solid fa-receipt" style="color:#C8963E;"></i> Recent Donations</h4>
                        <a href="donations.php" style="color:#1B6B3A; font-weight:700; font-size:12.5px; text-decoration:none;">View All &rarr;</a>
                    </div>
                    <?php if (empty($recent_dons)): ?>
                        <p style="color:#888; font-size:13px; font-style:italic;">Koi donation submission nahi hai.</p>
                    <?php else: ?>
                        <table style="width:100%; border-collapse:collapse; font-size:13px;">
                            <?php foreach ($recent_dons as $rd): ?>
                            <tr style="border-bottom:1px solid #f0f0f0;">
                                <td style="padding:10px 0; font-weight:700; color:#122f2a;"><?= htmlspecialchars($rd['donor_name'] ?: 'Anonymous') ?></td>
                                <td style="padding:10px 0; font-weight:800; color:#1B6B3A;">₹<?= number_format((float)$rd['amount']) ?></td>
                                <td style="padding:10px 0; text-align:right;">
                                    <?php if ($rd['status'] === 'approved'): ?>
                                        <span style="background:#dcfce7; color:#16a34a; font-weight:800; padding:2px 8px; border-radius:10px; font-size:11px;">Approved</span>
                                    <?php else: ?>
                                        <span style="background:#fef3c7; color:#d97706; font-weight:800; padding:2px 8px; border-radius:10px; font-size:11px;">Pending</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>

                <!-- Recent Members -->
                <div class="card-table">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
                        <h4 style="font-size:16px; font-weight:800; color:#122f2a; margin:0;"><i class="fa-solid fa-user-plus" style="color:#1B6B3A;"></i> New Al Miftah Members</h4>
                        <a href="users.php" style="color:#1B6B3A; font-weight:700; font-size:12.5px; text-decoration:none;">View All &rarr;</a>
                    </div>
                    <?php if (empty($recent_users)): ?>
                        <p style="color:#888; font-size:13px; font-style:italic;">Koi user register nahi hua.</p>
                    <?php else: ?>
                        <table style="width:100%; border-collapse:collapse; font-size:13px;">
                            <?php foreach ($recent_users as $ru): ?>
                            <tr style="border-bottom:1px solid #f0f0f0;">
                                <td style="padding:10px 0;">
                                    <strong><a href="user-detail.php?user_id=<?= $ru['user_id'] ?>" style="color:#122f2a; text-decoration:none;"><?= htmlspecialchars($ru['full_name'] ?: $ru['username']) ?></a></strong><br>
                                    <small style="color:#888;"><?= htmlspecialchars($ru['email']) ?></small>
                                </td>
                                <td style="padding:10px 0; text-align:right;">
                                    <span style="background:#e8f5ed; color:#1B6B3A; font-weight:700; padding:3px 8px; border-radius:10px; font-size:11px;"><?= ucfirst($ru['status'] ?: 'registered') ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
