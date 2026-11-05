<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

// Handle Actions: Approve or Reject
if (isset($_GET['action']) && in_array($_GET['action'], ['approve', 'reject']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $new_status = ($_GET['action'] === 'approve') ? 'approved' : 'rejected';

    $doc = $pdo->query("SELECT * FROM custom_user_documents WHERE id = $id")->fetch();
    if ($doc) {
        $pdo->prepare("UPDATE custom_user_documents SET status = ? WHERE id = ?")->execute([$new_status, $id]);

        if ($new_status === 'approved') {
            $pdo->prepare("UPDATE custom_user_profiles SET doc_verified = 1 WHERE user_id = ?")->execute([$doc['user_id']]);
        }
        header("Location: kyc.php?msg=updated");
        exit();
    }
}

// Fetch all KYC Documents
$documents = [];
try {
    $stmt = $pdo->query("
        SELECT d.*, u.username, u.email, p.full_name, p.mobile 
        FROM custom_user_documents d 
        JOIN custom_users u ON d.user_id = u.id 
        LEFT JOIN custom_user_profiles p ON u.id = p.user_id 
        ORDER BY d.uploaded_at DESC
    ");
    $documents = $stmt->fetchAll();
} catch (PDOException $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KYC Approvals - CMS Admin</title>
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
        .status-pending { background: #fef3c7; color: #d97706; }
        .status-approved { background: #dcfce7; color: #16a34a; }
        .status-rejected { background: #fee2e2; color: #dc2626; }
        .btn-act { padding: 5px 12px; border-radius: 6px; font-weight: 700; font-size: 12px; text-decoration: none; display: inline-block; }
        .btn-ok { background: #dcfce7; color: #16a34a; }
        .btn-nok { background: #fee2e2; color: #dc2626; }
        .btn-view { background: #e8f5ed; color: #1B6B3A; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header"><i class="fa-solid fa-leaf"></i> Al Miftah CMS</div>
        <ul class="nav-links">
            <li><a href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="users.php"><i class="fa-solid fa-users"></i> Users List</a></li>
            <li><a href="tree.php"><i class="fa-solid fa-sitemap"></i> Referral Tree</a></li>
            <li><a href="kyc.php" class="active"><i class="fa-solid fa-id-card"></i> KYC Approvals</a></li>
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
            <h2 style="font-size:22px; color:#122f2a;">📄 KYC Documents Verification Center</h2>
            <div style="font-size:14px; font-weight:600; color:#1B6B3A;"><i class="fa-solid fa-user-shield"></i> Admin Panel</div>
        </div>

        <div class="container">
            <?php if (isset($_GET['msg'])): ?>
            <div style="background:#dcfce7; color:#166534; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700;">
                Document status successfully updated!
            </div>
            <?php endif; ?>

            <div class="card">
                <?php if (empty($documents)): ?>
                <div style="padding:50px; text-align:center; color:#888;">
                    <i class="fa-solid fa-id-card" style="font-size:42px; color:#c8963e; margin-bottom:12px;"></i>
                    <h3>Abhi koi document upload nahi hua hai.</h3>
                </div>
                <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Document Type</th>
                            <th>ID / Document Number</th>
                            <th>Uploaded Date</th>
                            <th>Status</th>
                            <th>View Document</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($documents as $doc): ?>
                        <tr>
                            <td>
                                <strong><a href="user-detail.php?user_id=<?= $doc['user_id'] ?>" style="color:#122f2a; text-decoration:none;"><?= htmlspecialchars($doc['full_name'] ?: $doc['username']) ?></a></strong><br>
                                <small style="color:#888;"><?= htmlspecialchars($doc['mobile']) ?></small>
                            </td>
                            <td style="font-weight:700; color:#1B6B3A; text-transform:uppercase;"><?= htmlspecialchars($doc['doc_type']) ?></td>
                            <td style="font-weight:600; font-family:monospace;"><?= htmlspecialchars($doc['doc_number'] ?: '—') ?></td>
                            <td style="color:#777; font-size:13px;"><?= date('d M Y, h:i A', strtotime($doc['uploaded_at'])) ?></td>
                            <td>
                                <span class="status-badge status-<?= $doc['status'] ?>"><?= ucfirst($doc['status']) ?></span>
                            </td>
                            <td>
                                <a href="../<?= htmlspecialchars($doc['file_url']) ?>" target="_blank" class="btn-act btn-view">
                                    <i class="fa-solid fa-eye"></i> View File
                                </a>
                            </td>
                            <td style="display:flex; gap:6px;">
                                <?php if($doc['status'] !== 'approved'): ?>
                                <a href="kyc.php?action=approve&id=<?= $doc['id'] ?>" class="btn-act btn-ok">Approve</a>
                                <?php endif; ?>
                                <?php if($doc['status'] !== 'rejected'): ?>
                                <a href="kyc.php?action=reject&id=<?= $doc['id'] ?>" class="btn-act btn-nok">Reject</a>
                                <?php endif; ?>
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
