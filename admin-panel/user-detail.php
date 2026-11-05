<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

$uid = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

// Handle Payment Approval
if (isset($_GET['action']) && $_GET['action'] === 'approve_pay' && isset($_GET['pay_id'])) {
    $pay_id = (int)$_GET['pay_id'];
    $don = $pdo->query("SELECT * FROM custom_donations WHERE id = $pay_id")->fetch();
    if ($don && $don['status'] === 'pending') {
        $p_row = $pdo->query("SELECT total_donated FROM custom_user_profiles WHERE user_id = {$don['user_id']}")->fetch();
        $new_amt = ((float)($p_row['total_donated'] ?? 0)) + (float)$don['amount'];
        $upd_p = $pdo->prepare("UPDATE custom_user_profiles SET total_donated = ?, status = 'fully_verified' WHERE user_id = ?");
        $upd_p->execute([$new_amt, $don['user_id']]);

        $upd_d = $pdo->prepare("UPDATE custom_donations SET status = 'approved' WHERE id = ?");
        $upd_d->execute([$pay_id]);
        header("Location: user-detail.php?user_id=$uid&msg=pay_approved");
        exit();
    }
}

// Handle KYC Document Approval / Rejection
if (isset($_GET['action']) && in_array($_GET['action'], ['approve_doc', 'reject_doc']) && isset($_GET['doc_id'])) {
    $doc_id = (int)$_GET['doc_id'];
    $new_st = ($_GET['action'] === 'approve_doc') ? 'approved' : 'rejected';
    $upd_doc = $pdo->prepare("UPDATE custom_user_documents SET status = ? WHERE id = ?");
    $upd_doc->execute([$new_st, $doc_id]);

    if ($new_st === 'approved') {
        $pdo->prepare("UPDATE custom_user_profiles SET doc_verified = 1 WHERE user_id = ?")->execute([$uid]);
    }
    header("Location: user-detail.php?user_id=$uid&msg=doc_updated");
    exit();
}

// Handle 1-Click Toggle Profile Lock
if (isset($_GET['action']) && $_GET['action'] === 'toggle_lock') {
    $cur_lock = (int)($pdo->query("SELECT is_locked FROM custom_user_profiles WHERE user_id = $uid")->fetchColumn() ?: 0);
    $new_lock = $cur_lock ? 0 : 1;
    $pdo->prepare("UPDATE custom_user_profiles SET is_locked = ? WHERE user_id = ?")->execute([$new_lock, $uid]);
    header("Location: user-detail.php?user_id=$uid&msg=lock_toggled");
    exit();
}

// Handle Admin Profile & Bank Details Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_update_user_submit'])) {
    $u_name = trim($_POST['full_name'] ?? '');
    $u_dob = !empty($_POST['dob']) ? $_POST['dob'] : null;
    $u_address = trim($_POST['address'] ?? '');
    $u_city = trim($_POST['city'] ?? '');
    $u_state = trim($_POST['state'] ?? '');
    $u_pincode = trim($_POST['pincode'] ?? '');
    $u_mobile = trim($_POST['mobile'] ?? '');
    $u_bank_name = trim($_POST['bank_name'] ?? '');
    $u_acc_no = trim($_POST['account_number'] ?? '');
    $u_ifsc = strtoupper(trim($_POST['ifsc'] ?? ''));
    $u_acc_holder = trim($_POST['account_holder'] ?? '');
    $u_status = trim($_POST['status'] ?? 'registered');
    $u_lock = isset($_POST['is_locked']) ? 1 : 0;
    $u_email = trim($_POST['user_email'] ?? '');

    $upd = $pdo->prepare("UPDATE custom_user_profiles SET 
        full_name = ?, mobile = ?, dob = ?, address = ?, city = ?, state = ?, pincode = ?, 
        bank_name = ?, account_number = ?, ifsc = ?, account_holder = ?, status = ?, is_locked = ?
        WHERE user_id = ?");
    $upd->execute([
        $u_name, $u_mobile, $u_dob, $u_address, $u_city, $u_state, $u_pincode,
        $u_bank_name, $u_acc_no, $u_ifsc, $u_acc_holder, $u_status, $u_lock, $uid
    ]);

    if (!empty($u_email)) {
        $pdo->prepare("UPDATE custom_users SET email = ? WHERE id = ?")->execute([$u_email, $uid]);
    }

    header("Location: user-detail.php?user_id=$uid&msg=user_updated");
    exit();
}

// Fetch User Profile
$stmt = $pdo->prepare("
    SELECT p.*, u.email as user_email, u.username, u.role
    FROM custom_user_profiles p
    LEFT JOIN custom_users u ON u.id = p.user_id
    WHERE p.user_id = ?
");
$stmt->execute([$uid]);
$p = $stmt->fetch();

if (!$p) {
    die("User not found. <a href='users.php'>Back to Users</a>");
}

// Fetch User Documents
$docs = $pdo->prepare("SELECT * FROM custom_user_documents WHERE user_id = ? ORDER BY uploaded_at DESC");
$docs->execute([$uid]);
$user_docs = $docs->fetchAll();

// Fetch User Donations
$dons = $pdo->prepare("SELECT * FROM custom_donations WHERE user_id = ? ORDER BY created_at DESC");
$dons->execute([$uid]);
$user_donations = $dons->fetchAll();

// Fetch Sub-tree
$all_profiles = $pdo->query("SELECT user_id as id, full_name as name, referred_by as referredBy, referral_code as code FROM custom_user_profiles")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Inspector: <?= htmlspecialchars($p['full_name'] ?: $p['username']) ?> - CMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #1B6B3A; --sidebar-bg: #111827; --text-dark: #122f2a; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #f0faf4; padding: 30px 20px; min-height: 100vh; }
        .card { background: #fff; border-radius: 16px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1.5px solid #d8f3dc; margin-bottom: 25px; }
        .btn-act { padding: 6px 14px; border-radius: 6px; font-weight: 700; font-size: 12px; text-decoration: none; display: inline-block; }
        .btn-ok { background: #dcfce7; color: #16a34a; }
        .btn-nok { background: #fee2e2; color: #dc2626; }
    </style>
</head>
<body>
    <div style="max-width: 900px; margin: 0 auto;">
        <a href="tree.php" style="display:inline-block; margin-bottom:20px; color:#1B6B3A; font-weight:700; text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> Wapas Dashboard / Tree Jayein</a>

        <?php if (isset($_GET['msg'])): ?>
            <div style="background:#dcfce7; color:#166534; padding:14px; border-radius:8px; margin-bottom:20px; font-weight:700;">
                <?php
                if ($_GET['msg'] === 'user_updated') echo "Member details kamyabi se update ho gayi hain!";
                elseif ($_GET['msg'] === 'lock_toggled') echo "Profile lock status update ho gaya!";
                elseif ($_GET['msg'] === 'pay_approved') echo "Payment approve ho gaya!";
                elseif ($_GET['msg'] === 'doc_updated') echo "Document status update ho gaya!";
                else echo "Action kamyabi se execute ho gaya!";
                ?>
            </div>
        <?php endif; ?>

        <!-- User Header Card -->
        <div class="card" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
            <div style="display:flex; align-items:center; gap:20px;">
                <div style="width:70px; height:70px; background:#1B6B3A; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:26px; font-weight:800;">
                    <?= strtoupper(substr($p['full_name'] ?: ($p['username'] ?: 'U'), 0, 1)) ?>
                </div>
                <div>
                    <h2 style="font-size:24px; color:#122f2a; margin-bottom:4px;"><?= htmlspecialchars($p['full_name'] ?: $p['username']) ?> <span style="font-size:14px; color:#888;">(#<?= $p['user_id'] ?>)</span></h2>
                    <p style="color:#667471; font-size:13.5px; margin:0 0 6px 0;">
                        <i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($p['user_email']) ?> | 
                        <i class="fa-solid fa-phone"></i> <?= htmlspecialchars($p['mobile']) ?>
                    </p>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <?php if (!empty($p['is_locked'])): ?>
                            <span style="background:#fef3c7; color:#92400e; font-size:12px; font-weight:800; padding:3px 10px; border-radius:12px; border:1px solid #fde68a;"><i class="fa-solid fa-lock"></i> Locked for User</span>
                            <a href="user-detail.php?user_id=<?= $uid ?>&action=toggle_lock" class="btn-act" style="background:#e0f2fe; color:#0369a1;"><i class="fa-solid fa-lock-open"></i> Unlock for User</a>
                        <?php else: ?>
                            <span style="background:#dcfce7; color:#166534; font-size:12px; font-weight:800; padding:3px 10px; border-radius:12px; border:1px solid #86efac;"><i class="fa-solid fa-lock-open"></i> User Can Edit</span>
                            <a href="user-detail.php?user_id=<?= $uid ?>&action=toggle_lock" class="btn-act" style="background:#fee2e2; color:#b91c1c;"><i class="fa-solid fa-lock"></i> Lock Profile</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div style="text-align:right;">
                <span style="font-size:11px; text-transform:uppercase; font-weight:700; color:#888;">Al-Miftah Status</span>
                <div style="font-size:16px; font-weight:800; color:#1B6B3A; margin-top:3px;"><?= strtoupper($p['status']) ?></div>
                <a href="#adminEditCard" style="display:inline-block; margin-top:10px; background:#1B6B3A; color:#fff; font-size:12.5px; font-weight:700; padding:6px 14px; border-radius:8px; text-decoration:none;"><i class="fa-solid fa-pen-to-square"></i> Edit Details (Admin)</a>
            </div>
        </div>

        <!-- Details Grid -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:25px;">
            <div class="card">
                <h4 style="color:#1B6B3A; margin-bottom:15px; border-bottom:1.5px solid #e9f5ee; padding-bottom:8px;"><i class="fa-solid fa-address-card"></i> Personal Details</h4>
                <p style="font-size:14px; margin-bottom:8px;"><strong>Address:</strong> <?= htmlspecialchars($p['address'] ?: '—') ?></p>
                <p style="font-size:14px; margin-bottom:8px;"><strong>City / State:</strong> <?= htmlspecialchars($p['city'] ?: '—') ?>, <?= htmlspecialchars($p['state'] ?: '—') ?></p>
                <p style="font-size:14px; margin-bottom:8px;"><strong>Pincode:</strong> <?= htmlspecialchars($p['pincode'] ?: '—') ?></p>
                <p style="font-size:14px; margin-bottom:8px;"><strong>Date of Birth:</strong> <?= htmlspecialchars($p['dob'] ?: '—') ?></p>
                <p style="font-size:14px; margin:0;"><strong>Joined At:</strong> <?= date('d M Y, h:i A', strtotime($p['joined_at'])) ?></p>
            </div>

            <div class="card">
                <h4 style="color:#1B6B3A; margin-bottom:15px; border-bottom:1.5px solid #e9f5ee; padding-bottom:8px;"><i class="fa-solid fa-building-columns"></i> Bank & Referral</h4>
                <p style="font-size:14px; margin-bottom:8px;"><strong>Bank Name:</strong> <?= htmlspecialchars($p['bank_name'] ?: '—') ?></p>
                <p style="font-size:14px; margin-bottom:8px;"><strong>Account No:</strong> <?= htmlspecialchars($p['account_number'] ?: '—') ?></p>
                <p style="font-size:14px; margin-bottom:8px;"><strong>IFSC Code:</strong> <?= htmlspecialchars($p['ifsc'] ?: '—') ?></p>
                <p style="font-size:14px; margin-bottom:8px;"><strong>Account Holder:</strong> <?= htmlspecialchars($p['account_holder'] ?: '—') ?></p>
                <p style="font-size:14px; margin:0;"><strong>Referral Code:</strong> <span style="background:#e8f5ed; padding:3px 8px; border-radius:6px; font-weight:700; color:#1B6B3A;"><?= htmlspecialchars($p['referral_code']) ?></span></p>
            </div>
        </div>

        <!-- Admin Edit User Details Form Card -->
        <div class="card" id="adminEditCard" style="border: 2px solid #b7e4c7; background: #ffffff;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; border-bottom:1.5px solid #e9f5ee; padding-bottom:10px;">
                <h4 style="color:#1B6B3A; font-size:17px; margin:0;"><i class="fa-solid fa-pen-to-square"></i> Admin Control: Edit Member Profile & Bank Details</h4>
                <span style="font-size:12px; font-weight:700; color:#c8963e; background:#fef9c3; padding:4px 10px; border-radius:6px;">Only Admin Can Modify</span>
            </div>

            <form method="POST">
                <h5 style="color:#122f2a; font-size:14px; margin-bottom:12px; text-transform:uppercase; letter-spacing:0.5px;">1. Personal & Contact Information</h5>
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:15px; margin-bottom:20px;">
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Full Name</label>
                        <input type="text" name="full_name" value="<?= htmlspecialchars($p['full_name'] ?? '') ?>" required style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Email Address</label>
                        <input type="email" name="user_email" value="<?= htmlspecialchars($p['user_email'] ?? '') ?>" required style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Mobile Number</label>
                        <input type="text" name="mobile" value="<?= htmlspecialchars($p['mobile'] ?? '') ?>" required style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Date of Birth</label>
                        <input type="date" name="dob" value="<?= htmlspecialchars($p['dob'] ?? '') ?>" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Address</label>
                        <input type="text" name="address" value="<?= htmlspecialchars($p['address'] ?? '') ?>" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">City</label>
                        <input type="text" name="city" value="<?= htmlspecialchars($p['city'] ?? '') ?>" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">State</label>
                        <input type="text" name="state" value="<?= htmlspecialchars($p['state'] ?? '') ?>" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Pincode</label>
                        <input type="text" name="pincode" value="<?= htmlspecialchars($p['pincode'] ?? '') ?>" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                </div>

                <h5 style="color:#122f2a; font-size:14px; margin-bottom:12px; text-transform:uppercase; letter-spacing:0.5px;">2. Bank Account Details</h5>
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:15px; margin-bottom:20px;">
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Bank Name</label>
                        <input type="text" name="bank_name" value="<?= htmlspecialchars($p['bank_name'] ?? '') ?>" placeholder="e.g. State Bank of India" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Account Number</label>
                        <input type="text" name="account_number" value="<?= htmlspecialchars($p['account_number'] ?? '') ?>" placeholder="Account Number" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">IFSC Code</label>
                        <input type="text" name="ifsc" value="<?= htmlspecialchars($p['ifsc'] ?? '') ?>" placeholder="e.g. SBIN0001234" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px; text-transform:uppercase;" />
                    </div>
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Account Holder Name</label>
                        <input type="text" name="account_holder" value="<?= htmlspecialchars($p['account_holder'] ?? '') ?>" placeholder="Account Holder Name" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px;" />
                    </div>
                </div>

                <h5 style="color:#122f2a; font-size:14px; margin-bottom:12px; text-transform:uppercase; letter-spacing:0.5px;">3. Account Status & Lock Settings</h5>
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:15px; margin-bottom:25px; align-items:center;">
                    <div>
                        <label style="display:block; font-size:12.5px; font-weight:700; color:#444; margin-bottom:5px;">Verification Status</label>
                        <select name="status" style="width:100%; padding:10px 12px; border:1.5px solid #d8f3dc; border-radius:8px; font-size:13.5px; background:#fff;">
                            <option value="registered" <?= $p['status'] === 'registered' ? 'selected' : '' ?>>Registered</option>
                            <option value="mobile_verified" <?= $p['status'] === 'mobile_verified' ? 'selected' : '' ?>>Mobile Verified</option>
                            <option value="profile_complete" <?= $p['status'] === 'profile_complete' ? 'selected' : '' ?>>Profile Complete</option>
                            <option value="fully_verified" <?= $p['status'] === 'fully_verified' ? 'selected' : '' ?>>Fully Verified</option>
                        </select>
                    </div>
                    <div style="padding-top:15px;">
                        <label style="display:flex; align-items:center; gap:10px; font-size:13.5px; font-weight:700; color:#122f2a; cursor:pointer;">
                            <input type="checkbox" name="is_locked" value="1" <?= (!empty($p['is_locked'])) ? 'checked' : '' ?> style="width:18px; height:18px; accent-color:#1B6B3A;" />
                            <span>🔒 Lock Profile (User cannot change details)</span>
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" name="admin_update_user_submit" style="background:#1B6B3A; color:#fff; border:none; padding:12px 24px; border-radius:8px; font-weight:700; font-size:14px; cursor:pointer; display:inline-flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-floppy-disk"></i> Save Member Details (Admin Override)
                    </button>
                </div>
            </form>
        </div>

        <!-- KYC Documents Section -->
        <div class="card">
            <h4 style="color:#1B6B3A; margin-bottom:15px; border-bottom:1.5px solid #e9f5ee; padding-bottom:8px;"><i class="fa-solid fa-id-card"></i> KYC Verification Documents</h4>
            <?php if (empty($user_docs)): ?>
                <p style="color:#888; font-style:italic;">Is user ne abhi koi document upload nahi kiya.</p>
            <?php else: ?>
                <table style="width:100%; border-collapse:collapse; font-size:13.5px;">
                    <thead><tr style="background:#f4fbf6; color:#1B6B3A; text-align:left;"><th style="padding:10px;">Type</th><th style="padding:10px;">Doc Number</th><th style="padding:10px;">Status</th><th style="padding:10px;">View File</th><th style="padding:10px;">Actions</th></tr></thead>
                    <tbody>
                        <?php foreach ($user_docs as $d): ?>
                        <tr style="border-bottom:1px solid #eee;">
                            <td style="padding:10px; font-weight:700; text-transform:uppercase;"><?= htmlspecialchars($d['doc_type']) ?></td>
                            <td style="padding:10px;"><?= htmlspecialchars($d['doc_number'] ?: '—') ?></td>
                            <td style="padding:10px; font-weight:bold;"><?= ucfirst($d['status']) ?></td>
                            <td style="padding:10px;"><a href="../<?= htmlspecialchars($d['file_url']) ?>" target="_blank" style="color:#C8963E; font-weight:700;">Open File</a></td>
                            <td style="padding:10px; display:flex; gap:8px;">
                                <?php if ($d['status'] !== 'approved'): ?>
                                <a href="user-detail.php?user_id=<?= $uid ?>&action=approve_doc&doc_id=<?= $d['id'] ?>" class="btn-act btn-ok">Approve</a>
                                <?php endif; ?>
                                <?php if ($d['status'] !== 'rejected'): ?>
                                <a href="user-detail.php?user_id=<?= $uid ?>&action=reject_doc&doc_id=<?= $d['id'] ?>" class="btn-act btn-nok">Reject</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- Donations History & Approval -->
        <div class="card">
            <h4 style="color:#1B6B3A; margin-bottom:15px; border-bottom:1.5px solid #e9f5ee; padding-bottom:8px;"><i class="fa-solid fa-receipt"></i> Payment & Donation History</h4>
            <?php if (empty($user_donations)): ?>
                <p style="color:#888; font-style:italic;">Koi donation submission record nahi hai.</p>
            <?php else: ?>
                <table style="width:100%; border-collapse:collapse; font-size:13.5px;">
                    <thead><tr style="background:#f4fbf6; color:#1B6B3A; text-align:left;"><th style="padding:10px;">Date</th><th style="padding:10px;">Amount</th><th style="padding:10px;">UTR / Txn</th><th style="padding:10px;">Proof</th><th style="padding:10px;">Status</th><th style="padding:10px;">Action</th></tr></thead>
                    <tbody>
                        <?php foreach ($user_donations as $don): ?>
                        <tr style="border-bottom:1px solid #eee;">
                            <td style="padding:10px;"><?= date('d M Y', strtotime($don['created_at'])) ?></td>
                            <td style="padding:10px; font-weight:bold; color:#1B6B3A;">₹<?= number_format((float)$don['amount']) ?></td>
                            <td style="padding:10px;"><?= htmlspecialchars($don['transaction_id'] ?: '—') ?></td>
                            <td style="padding:10px;"><?php if($don['proof_image']): ?><a href="../<?= htmlspecialchars($don['proof_image']) ?>" target="_blank" style="color:#C8963E; font-weight:700;">View Screenshot</a><?php else: ?>—<?php endif; ?></td>
                            <td style="padding:10px; font-weight:bold;"><?= ucfirst($don['status']) ?></td>
                            <td style="padding:10px;">
                                <?php if ($don['status'] === 'pending'): ?>
                                <a href="user-detail.php?user_id=<?= $uid ?>&action=approve_pay&pay_id=<?= $don['id'] ?>" class="btn-act btn-ok" style="background:#1B6B3A; color:#fff;">Approve Payment</a>
                                <?php else: ?>
                                <span style="color:#16a34a; font-weight:bold;">Approved ✓</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- User Specific Referral Tree -->
        <div class="card">
            <h4 style="color:#1B6B3A; margin-bottom:15px; border-bottom:1.5px solid #e9f5ee; padding-bottom:8px;"><i class="fa-solid fa-sitemap"></i> User Downline Referral Tree</h4>
            <div id="userTree"></div>
        </div>
    </div>

    <script>
    (function(){
        const allUsers = <?= json_encode($all_profiles) ?>;
        function build(us, rootId){
            const m={}; us.forEach(u=>{ m[u.id]={...u,children:[]}; });
            us.forEach(u=>{ if(u.referredBy && m[u.referredBy]) m[u.referredBy].children.push(m[u.id]); });
            return m[rootId];
        }
        const userTree = build(allUsers, <?= $uid ?>);
        function draw(node, lvl){
            if(!node || (lvl > 0 && !node.id)) return '';
            let h = `<div style="margin-left:${lvl > 0 ? 25 : 0}px; border-left:${lvl > 0 ? '1.5px solid #b7e4c7' : 'none'}; padding: 5px 0 5px 15px; position:relative;">`;
            if(lvl > 0) h += `<div style="position:absolute; left:0; top:20px; width:12px; height:1.5px; background:#b7e4c7;"></div>`;
            h += `<div style="background:#fafffe; border:1px solid #d8f3dc; padding:10px 14px; border-radius:8px; display:inline-block; min-width:220px; margin-bottom:6px;">
                    <strong style="color:#1B6B3A;">${node.name}</strong> <span style="font-size:10px; color:#888;">(#${node.id})</span>
                    <div style="font-size:11px; color:#666;">Code: ${node.code}</div>
                  </div>`;
            if(node.children && node.children.length > 0){
                node.children.forEach(c => { h += draw(c, lvl + 1); });
            } else if(lvl === 0 && (!node.children || node.children.length === 0)) {
                return '<p style="color:#888; font-style:italic;">Abhi koi downline referral nahi hai.</p>';
            }
            h += `</div>`; return h;
        }
        document.getElementById('userTree').innerHTML = draw(userTree, 0);
    })();
    </script>
</body>
</html>
