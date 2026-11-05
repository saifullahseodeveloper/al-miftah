<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

$search = trim($_GET['q'] ?? '');
$users = [];
try {
    if ($search) {
        $stmt = $pdo->prepare("
            SELECT u.id, u.username, u.email, p.full_name, p.mobile, p.status, p.referral_code, p.joined_at, p.user_id 
            FROM custom_users u 
            LEFT JOIN custom_user_profiles p ON u.id = p.user_id 
            WHERE u.role = 'user' AND (u.username LIKE ? OR u.email LIKE ? OR p.full_name LIKE ? OR p.referral_code LIKE ? OR p.mobile LIKE ?)
            ORDER BY u.created_at DESC
        ");
        $q = "%$search%";
        $stmt->execute([$q, $q, $q, $q, $q]);
    } else {
        $stmt = $pdo->query("
            SELECT u.id, u.username, u.email, p.full_name, p.mobile, p.status, p.referral_code, p.joined_at, p.user_id 
            FROM custom_users u 
            LEFT JOIN custom_user_profiles p ON u.id = p.user_id 
            WHERE u.role = 'user' 
            ORDER BY u.created_at DESC
        ");
    }
    $users = $stmt->fetchAll();
} catch (PDOException $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Manager - CMS Admin</title>
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
        .status-badge { padding: 4px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 700; }
        .btn-view { background: #e8f5ed; color: #1B6B3A; padding: 6px 14px; border-radius: 6px; text-decoration: none; font-size: 12.5px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; }
        .btn-view:hover { background: #1B6B3A; color: #fff; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header"><i class="fa-solid fa-leaf"></i> Al Miftah CMS</div>
        <ul class="nav-links">
            <li><a href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="users.php" class="active"><i class="fa-solid fa-users"></i> Users List</a></li>
            <li><a href="tree.php"><i class="fa-solid fa-sitemap"></i> Referral Tree</a></li>
            <li><a href="kyc.php"><i class="fa-solid fa-id-card"></i> KYC Approvals</a></li>
            <li><a href="donations.php"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
            <li><a href="sms-settings.php"><i class="fa-solid fa-mobile-screen"></i> SMS / OTP</a></li>
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
            <h2 style="font-size:22px; color:#122f2a;">👥 Al Miftah Registered Users Directory</h2>
            <div style="font-size:14px; font-weight:600; color:#1B6B3A;"><i class="fa-solid fa-user-shield"></i> Admin Panel</div>
        </div>

        <div class="container">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:12px;">
                <form method="GET" style="display:flex; gap:10px;">
                    <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search name, email, code..." style="padding:10px 16px; border:1.5px solid #b7e4c7; border-radius:8px; width:300px; outline:none; background:#fff;">
                    <button type="submit" style="background:#1B6B3A; color:#fff; border:none; padding:10px 18px; border-radius:8px; font-weight:700; cursor:pointer;">Search</button>
                    <?php if ($search): ?><a href="users.php" style="padding:10px; color:#888;">Clear</a><?php endif; ?>
                </form>
                <div>
                    <a href="tree.php" style="background:#2d6a4f; color:#fff; padding:10px 20px; border-radius:8px; text-decoration:none; font-weight:700; font-size:13.5px;"><i class="fa-solid fa-sitemap"></i> View Referral Network Tree</a>
                </div>
            </div>

            <div class="card">
                <?php if(empty($users)): ?>
                <div style="padding:50px; text-align:center; color:#888;">
                    <i class="fa-solid fa-users" style="font-size:42px; color:#c8963e; margin-bottom:12px;"></i>
                    <h3>Koi user nahi mila</h3>
                </div>
                <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name / Username</th>
                            <th>Email & Mobile</th>
                            <th>Referral Code</th>
                            <th>Status</th>
                            <th>Registered Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td style="font-weight:bold;">#<?= $user['id'] ?></td>
                            <td>
                                <strong><a href="user-detail.php?user_id=<?= $user['id'] ?>" style="color:#122f2a; text-decoration:none;"><?= htmlspecialchars($user['full_name'] ?: $user['username']) ?></a></strong>
                            </td>
                            <td>
                                <?= htmlspecialchars($user['email']) ?><br>
                                <small style="color:#888;"><?= htmlspecialchars($user['mobile'] ?: 'No mobile') ?></small>
                            </td>
                            <td style="font-weight:700; color:#1B6B3A;"><?= htmlspecialchars($user['referral_code'] ?: '—') ?></td>
                            <td>
                                <?php if ($user['status'] === 'fully_verified'): ?>
                                    <span class="status-badge" style="background:#dcfce7; color:#16a34a;">✅ Fully Verified</span>
                                <?php elseif ($user['status'] === 'profile_complete'): ?>
                                    <span class="status-badge" style="background:#dbeafe; color:#2563eb;">Profile Complete</span>
                                <?php elseif ($user['status'] === 'mobile_verified'): ?>
                                    <span class="status-badge" style="background:#fef3c7; color:#d97706;">Mobile Verified</span>
                                <?php else: ?>
                                    <span class="status-badge" style="background:#fee2e2; color:#dc2626;">Registered</span>
                                <?php endif; ?>
                            </td>
                            <td style="color:#777; font-size:13px;"><?= date('d M Y', strtotime($user['joined_at'] ?? 'now')) ?></td>
                            <td>
                                <a href="user-detail.php?user_id=<?= $user['id'] ?>" class="btn-view">
                                    <i class="fa-solid fa-eye"></i> View Profile & Tree
                                </a>
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
