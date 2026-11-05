<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

// Handle Approve / Reject
if (isset($_GET['action']) && in_array($_GET['action'], ['approve', 'reject']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $new_status = ($_GET['action'] === 'approve') ? 'approved' : 'rejected';

    $don = $pdo->query("SELECT * FROM custom_donations WHERE id = $id")->fetch();
    if ($don) {
        $upd = $pdo->prepare("UPDATE custom_donations SET status = ? WHERE id = ?");
        $upd->execute([$new_status, $id]);

        // If approved and has user_id, update profile total_donated
        if ($new_status === 'approved' && !empty($don['user_id'])) {
            $p_row = $pdo->query("SELECT total_donated FROM custom_user_profiles WHERE user_id = {$don['user_id']}")->fetch();
            $new_amt = ((float)($p_row['total_donated'] ?? 0)) + (float)$don['amount'];
            $pdo->prepare("UPDATE custom_user_profiles SET total_donated = ?, status = 'fully_verified' WHERE user_id = ?")->execute([$new_amt, $don['user_id']]);
        }

        // Also if linked to a cause, update raised_amount
        if ($new_status === 'approved' && !empty($don['cause_id'])) {
            $c_row = $pdo->query("SELECT raised_amount FROM custom_causes WHERE id = {$don['cause_id']}")->fetch();
            $new_c_amt = ((float)($c_row['raised_amount'] ?? 0)) + (float)$don['amount'];
            $pdo->prepare("UPDATE custom_causes SET raised_amount = ? WHERE id = ?")->execute([$new_c_amt, $don['cause_id']]);
        }

        header("Location: donations.php?msg=updated");
        exit();
    }
}

// Fetch all donations
$stmt = $pdo->query("
    SELECT d.*, c.title as cause_title 
    FROM custom_donations d 
    LEFT JOIN custom_causes c ON c.id = d.cause_id 
    ORDER BY d.created_at DESC
");
$donations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Requests & Proofs - Admin CMS</title>
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
        .btn-act { padding: 5px 12px; border-radius: 6px; font-weight: 700; font-size: 12px; text-decoration: none; display: inline-block; }
        .btn-ok { background: #dcfce7; color: #16a34a; }
        .btn-nok { background: #fee2e2; color: #dc2626; }
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
            <li><a href="donations.php" class="active"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
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
            <h2 style="font-size:22px; color:#122f2a;">💸 Donation Submissions & Verification</h2>
            <div style="font-size:14px; font-weight:600; color:#1B6B3A;"><i class="fa-solid fa-user-shield"></i> Admin Panel</div>
        </div>

        <div class="container">
            <?php if (isset($_GET['msg'])): ?>
            <div style="background:#dcfce7; color:#166534; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700;">
                Donation record successfully updated!
            </div>
            <?php endif; ?>

            <div class="card">
                <?php if (empty($donations)): ?>
                    <p style="padding:40px; text-align:center; color:#888;">Abhi tak koi donation submission nahi aayi.</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Donor Details</th>
                                <th>Cause / Purpose</th>
                                <th>Amount</th>
                                <th>UTR / Txn ID</th>
                                <th>Receipt Screenshot</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($donations as $d): ?>
                            <tr>
                                <td style="color:#666; font-size:13px;"><?= date('d M Y, h:i A', strtotime($d['created_at'])) ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($d['donor_name'] ?: 'Anonymous') ?></strong><br>
                                    <small style="color:#666;"><?= htmlspecialchars($d['donor_mobile']) ?> | <?= htmlspecialchars($d['donor_email']) ?></small>
                                </td>
                                <td><?= htmlspecialchars($d['cause_title'] ?: 'General Fund / Sadaqah') ?></td>
                                <td style="font-weight:800; font-size:16px; color:#1B6B3A;">₹<?= number_format((float)$d['amount']) ?></td>
                                <td style="font-family:monospace; font-weight:bold;"><?= htmlspecialchars($d['transaction_id'] ?: '—') ?></td>
                                <td>
                                    <?php if ($d['proof_image']): ?>
                                        <a href="../<?= htmlspecialchars($d['proof_image']) ?>" target="_blank" style="color:#C8963E; font-weight:700;"><i class="fa-solid fa-image"></i> View Receipt</a>
                                    <?php else: ?>
                                        <span style="color:#aaa;">No file</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($d['status'] === 'approved'): ?>
                                        <span style="background:#dcfce7; color:#16a34a; font-weight:800; padding:4px 10px; border-radius:12px; font-size:12px;">Approved ✓</span>
                                    <?php elseif ($d['status'] === 'rejected'): ?>
                                        <span style="background:#fee2e2; color:#dc2626; font-weight:800; padding:4px 10px; border-radius:12px; font-size:12px;">Rejected ✕</span>
                                    <?php else: ?>
                                        <span style="background:#fef3c7; color:#d97706; font-weight:800; padding:4px 10px; border-radius:12px; font-size:12px;">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td style="display:flex; gap:8px;">
                                    <?php if ($d['status'] !== 'approved'): ?>
                                    <a href="donations.php?action=approve&id=<?= $d['id'] ?>" class="btn-act btn-ok">Approve</a>
                                    <?php endif; ?>
                                    <?php if ($d['status'] !== 'rejected'): ?>
                                    <a href="donations.php?action=reject&id=<?= $d['id'] ?>" class="btn-act btn-nok">Reject</a>
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
