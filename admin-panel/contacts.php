<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

// Handle Mark as Read or Delete
if (isset($_GET['action']) && $_GET['action'] === 'read' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo->prepare("UPDATE custom_contacts SET status = 'read' WHERE id = ?")->execute([$id]);
    header("Location: contacts.php");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo->prepare("DELETE FROM custom_contacts WHERE id = ?")->execute([$id]);
    header("Location: contacts.php?deleted=1");
    exit();
}

// Fetch all inquiries
$stmt = $pdo->query("SELECT * FROM custom_contacts ORDER BY created_at DESC");
$contacts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Inquiries & Leads - Admin CMS</title>
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
        .card { background: #fff; border-radius: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1.5px solid #d8f3dc; overflow: hidden; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { padding: 14px 18px; text-align: left; }
        th { background: #1b4332; color: #74c69d; font-weight: 700; text-transform: uppercase; font-size: 12px; }
        td { border-bottom: 1px solid #e9f5ee; color: #374151; }
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
            <li><a href="sms-settings.php"><i class="fa-solid fa-mobile-screen"></i> SMS / OTP</a></li>
            <li><a href="causes.php"><i class="fa-solid fa-hand-holding-heart"></i> Causes</a></li>
            <li><a href="events.php"><i class="fa-solid fa-calendar-days"></i> Events</a></li>
            <li><a href="blogs.php"><i class="fa-solid fa-newspaper"></i> Blogs</a></li>
            <li><a href="gallery.php"><i class="fa-solid fa-images"></i> Gallery</a></li>
            <li><a href="contacts.php" class="active"><i class="fa-solid fa-envelope"></i> Inquiries</a></li>
        </ul>
        <a href="logout.php" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
    </aside>

    <div class="main-content">
        <div class="header">
            <h2 style="font-size:22px; color:#122f2a;">✉️ Contact Messages & Inquiries</h2>
            <div style="font-size:14px; font-weight:600; color:#1B6B3A;"><i class="fa-solid fa-user-shield"></i> Admin Panel</div>
        </div>

        <div class="container">
            <div class="card">
                <?php if (empty($contacts)): ?>
                    <p style="padding:40px; text-align:center; color:#888;">Abhi koi naya message nahi aaya.</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Sender</th>
                                <th>Contact Info</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $c): ?>
                            <tr>
                                <td style="color:#666; font-size:13px; white-space:nowrap;"><?= date('d M Y, h:i A', strtotime($c['created_at'])) ?></td>
                                <td style="font-weight:700; color:#122f2a;"><?= htmlspecialchars($c['name']) ?></td>
                                <td>
                                    <a href="mailto:<?= htmlspecialchars($c['email']) ?>" style="color:#1B6B3A; font-weight:600; text-decoration:none;"><?= htmlspecialchars($c['email']) ?></a><br>
                                    <small style="color:#666;"><?= htmlspecialchars($c['mobile'] ?: 'No phone') ?></small>
                                </td>
                                <td style="font-weight:600;"><?= htmlspecialchars($c['subject'] ?: 'Website Inquiry') ?></td>
                                <td style="max-width:300px; color:#4b5563; font-size:13px; line-height:1.5;"><?= nl2br(htmlspecialchars($c['message'])) ?></td>
                                <td>
                                    <?php if ($c['status'] === 'read'): ?>
                                        <span style="background:#e5e7eb; color:#4b5563; padding:3px 8px; border-radius:10px; font-size:11px; font-weight:700;">Read</span>
                                    <?php else: ?>
                                        <span style="background:#dcfce7; color:#16a34a; padding:3px 8px; border-radius:10px; font-size:11px; font-weight:700;">New ★</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($c['status'] === 'new'): ?>
                                    <a href="contacts.php?action=read&id=<?= $c['id'] ?>" style="color:#1B6B3A; font-weight:700; font-size:12px; margin-right:8px;">Mark Read</a>
                                    <?php endif; ?>
                                    <a href="contacts.php?action=delete&id=<?= $c['id'] ?>" onclick="return confirm('Message delete karein?')" style="color:#dc2626; font-size:12px;"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
