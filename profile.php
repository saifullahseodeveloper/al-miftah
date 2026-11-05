<?php
require_once 'header.php';
require_once 'admin-panel/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$msg_ok = '';
$msg_err = '';

// Pre-fetch profile to determine lock status
$stmt_init = $pdo->prepare("SELECT u.email, u.username, p.* FROM custom_users u LEFT JOIN custom_user_profiles p ON u.id = p.user_id WHERE u.id = ?");
$stmt_init->execute([$user_id]);
$profile = $stmt_init->fetch();

// Lock logic: Once profile is created/saved, only admin can change details
// Personal profile is locked if explicitly is_locked == 1 OR if personal address/details already saved
$personal_locked = (!empty($profile['is_locked']) && (int)$profile['is_locked'] === 1) || (!empty($profile['address']) && !empty($profile['city']));

// Bank details are locked if is_locked == 1 OR if bank account already saved
$bank_locked = (!empty($profile['is_locked']) && (int)$profile['is_locked'] === 1) || (!empty($profile['account_number']) && !empty($profile['ifsc']));

// Handle Profile Details Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile_submit'])) {
    if ($personal_locked) {
        $msg_err = "Aapki profile details lock hain. Yeh details sirf Admin hi update kar sakta hai.";
    } else {
        $full_name = trim($_POST['full_name'] ?? '');
        $dob = !empty($_POST['dob']) ? $_POST['dob'] : null;
        $address = trim($_POST['address'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $state = trim($_POST['state'] ?? '');
        $pincode = trim($_POST['pincode'] ?? '');

        $upd = $pdo->prepare("UPDATE custom_user_profiles SET full_name = ?, dob = ?, address = ?, city = ?, state = ?, pincode = ?, is_locked = 1 WHERE user_id = ?");
        $upd->execute([$full_name, $dob, $address, $city, $state, $pincode, $user_id]);
        $msg_ok = "Personal details kamyabi se save ho gayi hain aur lock kar di gayi hain!";
        $personal_locked = true;
    }
}

// Handle Bank Details Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_bank_submit'])) {
    if ($bank_locked) {
        $msg_err = "Bank details lock ho chuki hain. Kisi bhi badlao ke liye Admin se contact karein.";
    } else {
        $bank_name = trim($_POST['bank_name'] ?? '');
        $account_number = trim($_POST['account_number'] ?? '');
        $ifsc = strtoupper(trim($_POST['ifsc'] ?? ''));
        $account_holder = trim($_POST['account_holder'] ?? '');

        $upd = $pdo->prepare("UPDATE custom_user_profiles SET bank_name = ?, account_number = ?, ifsc = ?, account_holder = ? WHERE user_id = ?");
        $upd->execute([$bank_name, $account_number, $ifsc, $account_holder, $user_id]);
        $msg_ok = "Bank details mehfooz ho gayi hain aur lock ho gayi hain!";
        $bank_locked = true;
    }
}

// Handle KYC Document Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_doc_submit'])) {
    $doc_type = trim($_POST['doc_type'] ?? 'aadhaar');
    $doc_number = trim($_POST['doc_number'] ?? '');

    if (empty($_FILES['doc_file']['name'])) {
        $msg_err = "Barah-e-karam document file chunein.";
    } else {
        $upload_dir = __DIR__ . '/admin-panel/uploads/';
        if (!is_dir($upload_dir)) @mkdir($upload_dir, 0755, true);

        $file_ext = strtolower(pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];

        if (!in_array($file_ext, $allowed)) {
            $msg_err = "Sirf JPG, PNG, WEBP ya PDF files allow hain.";
        } else {
            $file_name = 'kyc_' . $user_id . '_' . $doc_type . '_' . time() . '.' . $file_ext;
            $dest = $upload_dir . $file_name;
            if (move_uploaded_file($_FILES['doc_file']['tmp_name'], $dest)) {
                $file_url = 'admin-panel/uploads/' . $file_name;

                // Check if doc already exists for this type
                $del = $pdo->prepare("DELETE FROM custom_user_documents WHERE user_id = ? AND doc_type = ?");
                $del->execute([$user_id, $doc_type]);

                $ins_doc = $pdo->prepare("INSERT INTO custom_user_documents (user_id, doc_type, file_path, file_url, doc_number, status) VALUES (?, ?, ?, ?, ?, 'pending')");
                $ins_doc->execute([$user_id, $doc_type, $dest, $file_url, $doc_number]);
                $msg_ok = ucfirst($doc_type) . " document upload ho gaya hai. Admin review ke baad approve ho jayega.";
            } else {
                $msg_err = "File upload fail ho gaya.";
            }
        }
    }
}

// Handle Donation Proof Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_donation_submit'])) {
    $amount = (float)($_POST['don_amount'] ?? 0);
    $txn_id = trim($_POST['don_txn_id'] ?? '');
    $proof_url = '';

    if ($amount <= 0) {
        $msg_err = "Donation amount darj karein.";
    } else {
        if (!empty($_FILES['don_proof']['name'])) {
            $upload_dir = __DIR__ . '/admin-panel/uploads/';
            if (!is_dir($upload_dir)) @mkdir($upload_dir, 0755, true);
            $file_ext = strtolower(pathinfo($_FILES['don_proof']['name'], PATHINFO_EXTENSION));
            $file_name = 'don_' . $user_id . '_' . time() . '.' . $file_ext;
            if (move_uploaded_file($_FILES['don_proof']['tmp_name'], $upload_dir . $file_name)) {
                $proof_url = 'admin-panel/uploads/' . $file_name;
            }
        }

        $ins_don = $pdo->prepare("INSERT INTO custom_donations (user_id, donor_name, donor_email, donor_mobile, amount, transaction_id, proof_image, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
        $stmt_u = $pdo->prepare("SELECT u.email, p.full_name, p.mobile FROM custom_users u LEFT JOIN custom_user_profiles p ON u.id = p.user_id WHERE u.id = ?");
        $stmt_u->execute([$user_id]);
        $u_info = $stmt_u->fetch();

        $ins_don->execute([$user_id, $u_info['full_name'] ?? 'Member', $u_info['email'] ?? '', $u_info['mobile'] ?? '', $amount, $txn_id, $proof_url]);
        $msg_ok = "Donation screenshot jama ho gaya hai! Admin jald tasdeeq karega.";
    }
}

// Fetch Full User Profile & Re-calculate Completion
$stmt = $pdo->prepare("SELECT u.email, u.username, p.* FROM custom_users u LEFT JOIN custom_user_profiles p ON u.id = p.user_id WHERE u.id = ?");
$stmt->execute([$user_id]);
$profile = $stmt->fetch();

// Calculate Completion Percentage
$completion = 0;
if (!empty($profile['mobile_verified'])) $completion += 25;
if (!empty($profile['full_name']) && !empty($profile['address']) && !empty($profile['pincode'])) $completion += 25;
if (!empty($profile['bank_name']) && !empty($profile['account_number']) && !empty($profile['ifsc'])) $completion += 25;

// Check approved documents
$doc_stmt = $pdo->prepare("SELECT * FROM custom_user_documents WHERE user_id = ?");
$doc_stmt->execute([$user_id]);
$docs = $doc_stmt->fetchAll();
$has_approved_docs = false;
foreach ($docs as $d) {
    if ($d['status'] === 'approved') $has_approved_docs = true;
}
if ($has_approved_docs) $completion += 25;

// Auto-update status
$profile_status = 'registered';
if (!empty($profile['mobile_verified'])) $profile_status = 'mobile_verified';
if ($completion >= 75) $profile_status = 'profile_complete';
if ($completion === 100) $profile_status = 'fully_verified';

$upd_st = $pdo->prepare("UPDATE custom_user_profiles SET status = ?, profile_complete = ?, doc_verified = ? WHERE user_id = ?");
$upd_st->execute([$profile_status, ($completion >= 75 ? 1 : 0), ($has_approved_docs ? 1 : 0), $user_id]);
$profile['status'] = $profile_status;

// Re-check locks after state update
$personal_locked = (!empty($profile['is_locked']) && (int)$profile['is_locked'] === 1) || (!empty($profile['address']) && !empty($profile['city']));
$bank_locked = (!empty($profile['is_locked']) && (int)$profile['is_locked'] === 1) || (!empty($profile['account_number']) && !empty($profile['ifsc']));

// Referral Tree Data Gathering
$all_profiles = $pdo->query("SELECT p.user_id as id, p.full_name as name, p.referral_code as code, p.referred_by as referredBy, p.joined_at as joinDate, p.status, p.total_donated FROM custom_user_profiles p")->fetchAll();

function build_sub_tree($list, $root_id) {
    $map = [];
    foreach ($list as $item) {
        $map[$item['id']] = $item;
        $map[$item['id']]['children'] = [];
    }
    foreach ($list as $item) {
        if (!empty($item['referredBy']) && isset($map[$item['referredBy']])) {
            $map[$item['referredBy']]['children'][] = &$map[$item['id']];
        }
    }
    return $map[$root_id] ?? ['id' => $root_id, 'name' => 'Me', 'children' => []];
}

$user_tree = build_sub_tree($all_profiles, $user_id);
$direct_count = count($user_tree['children'] ?? []);

function count_total_network($node) {
    $c = count($node['children'] ?? []);
    foreach (($node['children'] ?? []) as $kid) {
        $c += count_total_network($kid);
    }
    return $c;
}
$team_count = count_total_network($user_tree);

// Fetch user donations
$don_stmt = $pdo->prepare("SELECT * FROM custom_donations WHERE user_id = ? ORDER BY id DESC");
$don_stmt->execute([$user_id]);
$my_donations = $don_stmt->fetchAll();

// Base referral link
$ref_link = "http://" . $_SERVER['HTTP_HOST'] . "/register.php?ref=" . ($profile['referral_code'] ?? '');
?>

<div style="background-color: #f0faf4; padding: 40px 15px; min-height: 85vh; font-family: 'Poppins', sans-serif;">
    <div style="max-width: 1100px; margin: 0 auto;">

        <?php if ($msg_ok): ?>
        <div style="background:#dcfce7; border:1.5px solid #86efac; color:#166534; padding:15px; border-radius:12px; margin-bottom:25px; font-weight:600;">
            <i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($msg_ok) ?>
        </div>
        <?php endif; ?>

        <?php if ($msg_err): ?>
        <div style="background:#fee2e2; border:1.5px solid #fca5a5; color:#991b1b; padding:15px; border-radius:12px; margin-bottom:25px; font-weight:600;">
            <i class="fa-solid fa-triangle-exclamation"></i> <?= htmlspecialchars($msg_err) ?>
        </div>
        <?php endif; ?>

        <!-- Profile Top Banner -->
        <div style="background:#fff; border-radius:20px; padding:30px; box-shadow:0 8px 30px rgba(0,0,0,0.04); border:1.5px solid #d8f3dc; margin-bottom:30px; display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:20px;">
            <div style="display:flex; align-items:center; gap:20px;">
                <div style="width:75px; height:75px; background:linear-gradient(135deg, #1B6B3A, #2d6a4f); color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:28px; font-weight:800; box-shadow:0 4px 15px rgba(27,107,58,0.3);">
                    <?= strtoupper(substr($profile['full_name'] ?: ($profile['username'] ?? 'U'), 0, 1)) ?>
                </div>
                <div>
                    <h2 style="font-size:24px; font-weight:800; color:#122f2a; margin:0;"><?= htmlspecialchars($profile['full_name'] ?: $profile['username']) ?></h2>
                    <p style="color:#667471; font-size:13.5px; margin:4px 0 0;">
                        <i class="fa-solid fa-envelope" style="color:#C8963E;"></i> <?= htmlspecialchars($profile['email']) ?> | 
                        <i class="fa-solid fa-phone" style="color:#1B6B3A;"></i> <?= htmlspecialchars($profile['mobile'] ?: 'No mobile') ?>
                        <?php if (!empty($profile['mobile_verified'])): ?>
                            <span style="background:#dcfce7; color:#16a34a; font-size:11px; font-weight:700; padding:2px 8px; border-radius:12px; margin-left:6px;">Verified ✓</span>
                        <?php else: ?>
                            <a href="verify-mobile.php" style="background:#fef3c7; color:#b45309; font-size:11px; font-weight:700; padding:3px 10px; border-radius:12px; margin-left:6px; text-decoration:none;">Verify Mobile &rarr;</a>
                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <div style="text-align:right;">
                <span style="font-size:12px; font-weight:700; color:#777; text-transform:uppercase; letter-spacing:1px;">Account Status</span>
                <div style="margin-top:4px;">
                    <?php if ($profile['status'] === 'fully_verified'): ?>
                        <span style="background:#1B6B3A; color:#fff; font-size:13px; font-weight:800; padding:6px 16px; border-radius:20px;">✅ Fully Verified</span>
                    <?php elseif ($profile['status'] === 'profile_complete'): ?>
                        <span style="background:#3b82f6; color:#fff; font-size:13px; font-weight:800; padding:6px 16px; border-radius:20px;">📋 Profile Complete</span>
                    <?php elseif ($profile['status'] === 'mobile_verified'): ?>
                        <span style="background:#10b981; color:#fff; font-size:13px; font-weight:800; padding:6px 16px; border-radius:20px;">📱 Mobile Verified</span>
                    <?php else: ?>
                        <span style="background:#f59e0b; color:#fff; font-size:13px; font-weight:800; padding:6px 16px; border-radius:20px;">⏳ Unverified</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Profile Completion Progress Bar -->
        <div style="background:#fff; border-radius:16px; padding:22px 28px; box-shadow:0 8px 30px rgba(0,0,0,0.04); border:1.5px solid #d8f3dc; margin-bottom:30px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                <strong style="color:#122f2a; font-size:14.5px;">Al-Miftah Profile Completion</strong>
                <strong style="color:#1B6B3A; font-size:16px;"><?= $completion ?>%</strong>
            </div>
            <div style="background:#e9f5ee; height:12px; border-radius:6px; overflow:hidden;">
                <div style="width:<?= $completion ?>%; height:100%; background:linear-gradient(90deg, #1B6B3A, #52b788); border-radius:6px; transition:width 0.5s ease;"></div>
            </div>
            <div style="display:flex; gap:20px; font-size:12px; color:#667471; margin-top:10px; flex-wrap:wrap;">
                <span><?= !empty($profile['mobile_verified']) ? '✅' : '⚪' ?> Mobile Verify</span>
                <span><?= (!empty($profile['full_name']) && !empty($profile['address'])) ? '✅' : '⚪' ?> Personal Info</span>
                <span><?= (!empty($profile['bank_name']) && !empty($profile['account_number'])) ? '✅' : '⚪' ?> Bank Details</span>
                <span><?= $has_approved_docs ? '✅' : '⚪' ?> KYC Approval</span>
            </div>
        </div>

        <!-- Referral & Network Metrics Grid -->
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:20px; margin-bottom:30px;">
            <!-- Referral Code -->
            <div style="background:#fff; border-radius:16px; padding:22px; border:1.5px solid #d8f3dc; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="font-size:11.5px; font-weight:700; color:#c8963e; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Your Referral Code</div>
                <div style="display:flex; align-items:center; justify-content:space-between;">
                    <span style="font-size:24px; font-weight:800; color:#1B6B3A; letter-spacing:1px;"><?= htmlspecialchars($profile['referral_code'] ?: 'NKPENDING') ?></span>
                    <button onclick="copyRefCode('<?= htmlspecialchars($profile['referral_code']) ?>')" style="background:#e8f5ed; color:#1B6B3A; border:none; padding:6px 12px; border-radius:8px; font-weight:700; font-size:12px; cursor:pointer;">Copy</button>
                </div>
            </div>

            <!-- Direct Referrals -->
            <div style="background:#fff; border-radius:16px; padding:22px; border:1.5px solid #d8f3dc; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="font-size:11.5px; font-weight:700; color:#667471; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Direct Referrals</div>
                <div style="font-size:28px; font-weight:800; color:#122f2a;"><?= $direct_count ?> <span style="font-size:13px; color:#16a34a; font-weight:600;">Direct Members</span></div>
            </div>

            <!-- Team Network Total -->
            <div style="background:#fff; border-radius:16px; padding:22px; border:1.5px solid #d8f3dc; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="font-size:11.5px; font-weight:700; color:#667471; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Total Team Network</div>
                <div style="font-size:28px; font-weight:800; color:#2d6a4f;">🌿 <?= $team_count ?> <span style="font-size:13px; color:#52b788; font-weight:600;">In Tree</span></div>
            </div>

            <!-- Total Donated -->
            <div style="background:#fff; border-radius:16px; padding:22px; border:1.5px solid #d8f3dc; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                <div style="font-size:11.5px; font-weight:700; color:#667471; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Total Contributed</div>
                <div style="font-size:28px; font-weight:800; color:#c8963e;">₹<?= number_format((float)($profile['total_donated'] ?? 0)) ?></div>
            </div>
        </div>

        <!-- Shareable Link Banner -->
        <div style="background:linear-gradient(135deg, #122f2a, #1B6B3A); color:#fff; border-radius:16px; padding:22px 25px; margin-bottom:35px; display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:15px;">
            <div>
                <h4 style="color:#fff; margin:0 0 4px; font-size:17px; font-weight:700;"><i class="fa-solid fa-share-nodes" style="color:#C8963E;"></i> Apna Referral Link Share Karein</h4>
                <p style="color:#cbd5e1; font-size:13px; margin:0;">Is link se join karne wale members automatically aapki referral tree mein judenge.</p>
            </div>
            <div style="display:flex; gap:10px; flex:1; max-width:450px;">
                <input type="text" id="refLinkInput" value="<?= htmlspecialchars($ref_link) ?>" readonly style="flex:1; padding:10px 14px; border-radius:8px; border:none; font-size:13px; background:#fff; color:#122f2a;" />
                <button onclick="copyRefLink()" style="background:#C8963E; color:#fff; border:none; padding:10px 18px; border-radius:8px; font-weight:700; font-size:13px; cursor:pointer; white-space:nowrap;">Copy Link</button>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div style="display:flex; gap:10px; margin-bottom:25px; flex-wrap:wrap;">
            <button onclick="switchTab('tab-personal')" id="btn-personal" class="prof-tab prof-tab-active"><i class="fa-solid fa-user"></i> Personal Profile</button>
            <button onclick="switchTab('tab-bank')" id="btn-bank" class="prof-tab"><i class="fa-solid fa-building-columns"></i> Bank Account</button>
            <button onclick="switchTab('tab-kyc')" id="btn-kyc" class="prof-tab"><i class="fa-solid fa-id-card"></i> KYC Documents</button>
            <button onclick="switchTab('tab-tree')" id="btn-tree" class="prof-tab"><i class="fa-solid fa-sitemap"></i> Referral Tree</button>
            <button onclick="switchTab('tab-donation')" id="btn-donation" class="prof-tab"><i class="fa-solid fa-receipt"></i> Donations & Proofs</button>
        </div>

        <!-- TAB 1: Personal Details -->
        <div id="tab-personal" class="tab-pane" style="background:#fff; border-radius:18px; padding:35px; border:1.5px solid #d8f3dc; box-shadow:0 8px 30px rgba(0,0,0,0.04);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1.5px solid #e9f5ee; padding-bottom:12px; flex-wrap:wrap; gap:10px;">
                <h3 style="font-size:20px; font-weight:800; color:#122f2a; margin:0;">
                    Personal Information
                </h3>
                <?php if ($personal_locked): ?>
                    <span style="background:#fef3c7; color:#92400e; font-size:12px; font-weight:800; padding:5px 14px; border-radius:20px; border:1px solid #fde68a;">
                        <i class="fa-solid fa-lock"></i> Profile Locked (Admin Only)
                    </span>
                <?php endif; ?>
            </div>

            <?php if ($personal_locked): ?>
            <div style="background:#fef3c7; border:1.5px solid #fde68a; color:#92400e; padding:14px 18px; border-radius:12px; margin-bottom:22px; font-weight:600; font-size:13.5px; display:flex; align-items:center; gap:12px;">
                <i class="fa-solid fa-shield-halved" style="font-size:22px; color:#d97706; flex-shrink:0;"></i>
                <div>
                    <strong>Profile Details Locked:</strong> Aapki profile create ho chuki hai. Security va verification policies ke mutabiq details sirf <strong>Admin</strong> hi change kar sakta hai. Agar aapko koi update karwana hai to Admin se contact karein.
                </div>
            </div>
            <?php endif; ?>

            <form method="POST">
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px;">
                    <div>
                        <label class="form-lbl">Poora Naam (Full Name)</label>
                        <input type="text" name="full_name" value="<?= htmlspecialchars($profile['full_name'] ?? '') ?>" class="form-ctrl" <?= $personal_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : 'required' ?> />
                    </div>
                    <div>
                        <label class="form-lbl">Date of Birth</label>
                        <input type="date" name="dob" value="<?= htmlspecialchars($profile['dob'] ?? '') ?>" class="form-ctrl" <?= $personal_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : '' ?> />
                    </div>
                    <div>
                        <label class="form-lbl">Email Address (Read Only)</label>
                        <input type="email" value="<?= htmlspecialchars($profile['email'] ?? '') ?>" class="form-ctrl" disabled style="background:#f8fafc; color:#888;" />
                    </div>
                    <div>
                        <label class="form-lbl">Mobile Number</label>
                        <input type="text" value="<?= htmlspecialchars($profile['mobile'] ?? '') ?>" class="form-ctrl" disabled style="background:#f8fafc; color:#888;" />
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label class="form-lbl">Address</label>
                        <textarea name="address" rows="2" class="form-ctrl" <?= $personal_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : '' ?>><?= htmlspecialchars($profile['address'] ?? '') ?></textarea>
                    </div>
                    <div>
                        <label class="form-lbl">City</label>
                        <input type="text" name="city" value="<?= htmlspecialchars($profile['city'] ?? '') ?>" class="form-ctrl" <?= $personal_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : '' ?> />
                    </div>
                    <div>
                        <label class="form-lbl">State</label>
                        <input type="text" name="state" value="<?= htmlspecialchars($profile['state'] ?? '') ?>" class="form-ctrl" <?= $personal_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : '' ?> />
                    </div>
                    <div>
                        <label class="form-lbl">Pincode</label>
                        <input type="text" name="pincode" value="<?= htmlspecialchars($profile['pincode'] ?? '') ?>" class="form-ctrl" <?= $personal_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : '' ?> />
                    </div>
                </div>
                <div style="margin-top:25px;">
                    <?php if ($personal_locked): ?>
                        <div style="display:inline-flex; align-items:center; gap:8px; background:#f1f5f9; color:#64748b; padding:11px 22px; border-radius:10px; font-size:13.5px; font-weight:700; border:1px solid #cbd5e1;">
                            <i class="fa-solid fa-lock"></i> Details Locked (Contact Admin to change)
                        </div>
                    <?php else: ?>
                        <button type="submit" name="update_profile_submit" class="save-btn">Save Personal Details</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- TAB 2: Bank Account Details -->
        <div id="tab-bank" class="tab-pane" style="display:none; background:#fff; border-radius:18px; padding:35px; border:1.5px solid #d8f3dc; box-shadow:0 8px 30px rgba(0,0,0,0.04);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1.5px solid #e9f5ee; padding-bottom:12px; flex-wrap:wrap; gap:10px;">
                <h3 style="font-size:20px; font-weight:800; color:#122f2a; margin:0;">
                    Bank Account Details (Payouts & Verification)
                </h3>
                <?php if ($bank_locked): ?>
                    <span style="background:#fef3c7; color:#92400e; font-size:12px; font-weight:800; padding:5px 14px; border-radius:20px; border:1px solid #fde68a;">
                        <i class="fa-solid fa-lock"></i> Bank Locked (Admin Only)
                    </span>
                <?php endif; ?>
            </div>

            <?php if ($bank_locked): ?>
            <div style="background:#fef3c7; border:1.5px solid #fde68a; color:#92400e; padding:14px 18px; border-radius:12px; margin-bottom:22px; font-weight:600; font-size:13.5px; display:flex; align-items:center; gap:12px;">
                <i class="fa-solid fa-shield-halved" style="font-size:22px; color:#d97706; flex-shrink:0;"></i>
                <div>
                    <strong>Bank Details Locked:</strong> Bank khata verify/save ho chuka hai. Kisi bhi update ya tabdeeli ke liye kripya <strong>Admin</strong> se sampark karein.
                </div>
            </div>
            <?php endif; ?>

            <form method="POST">
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px;">
                    <div>
                        <label class="form-lbl">Bank Name</label>
                        <input type="text" name="bank_name" value="<?= htmlspecialchars($profile['bank_name'] ?? '') ?>" placeholder="e.g. State Bank of India, HDFC" class="form-ctrl" <?= $bank_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : 'required' ?> />
                    </div>
                    <div>
                        <label class="form-lbl">Account Number</label>
                        <input type="text" name="account_number" value="<?= htmlspecialchars($profile['account_number'] ?? '') ?>" placeholder="Account Number" class="form-ctrl" <?= $bank_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : 'required' ?> />
                    </div>
                    <div>
                        <label class="form-lbl">IFSC Code</label>
                        <input type="text" name="ifsc" value="<?= htmlspecialchars($profile['ifsc'] ?? '') ?>" placeholder="e.g. SBIN0001234" class="form-ctrl" style="text-transform:uppercase; <?= $bank_locked ? 'background:#f8fafc; color:#555; cursor:not-allowed;' : '' ?>" <?= $bank_locked ? 'readonly' : 'required' ?> />
                    </div>
                    <div>
                        <label class="form-lbl">Account Holder Name</label>
                        <input type="text" name="account_holder" value="<?= htmlspecialchars($profile['account_holder'] ?? '') ?>" placeholder="Naam jaisa passbook par ho" class="form-ctrl" <?= $bank_locked ? 'readonly style="background:#f8fafc; color:#555; cursor:not-allowed;"' : 'required' ?> />
                    </div>
                </div>
                <div style="margin-top:25px;">
                    <?php if ($bank_locked): ?>
                        <div style="display:inline-flex; align-items:center; gap:8px; background:#f1f5f9; color:#64748b; padding:11px 22px; border-radius:10px; font-size:13.5px; font-weight:700; border:1px solid #cbd5e1;">
                            <i class="fa-solid fa-lock"></i> Bank Details Locked (Contact Admin to change)
                        </div>
                    <?php else: ?>
                        <button type="submit" name="update_bank_submit" class="save-btn">Save Bank Details</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- TAB 3: KYC Documents Upload -->
        <div id="tab-kyc" class="tab-pane" style="display:none; background:#fff; border-radius:18px; padding:35px; border:1.5px solid #d8f3dc; box-shadow:0 8px 30px rgba(0,0,0,0.04);">
            <h3 style="font-size:20px; font-weight:800; color:#122f2a; margin-bottom:20px; border-bottom:1.5px solid #e9f5ee; padding-bottom:12px;">
                KYC Identity Verification (Aadhaar & PAN)
            </h3>

            <!-- Upload Form -->
            <form method="POST" enctype="multipart/form-data" style="background:#f9fbf9; padding:25px; border-radius:14px; border:1.5px dashed #b7e4c7; margin-bottom:30px;">
                <h4 style="font-size:16px; font-weight:700; color:#1B6B3A; margin-bottom:15px;">Naya Document Upload Karein</h4>
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:18px;">
                    <div>
                        <label class="form-lbl">Document Type</label>
                        <select name="doc_type" class="form-ctrl" style="background:#fff;">
                            <option value="aadhaar">Aadhaar Card</option>
                            <option value="pan">PAN Card</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-lbl">Document / ID Number</label>
                        <input type="text" name="doc_number" placeholder="e.g. 12-digit Aadhaar / 10-digit PAN" class="form-ctrl" required />
                    </div>
                    <div>
                        <label class="form-lbl">Upload Photo / PDF</label>
                        <input type="file" name="doc_file" accept="image/*,.pdf" class="form-ctrl" required />
                    </div>
                </div>
                <div style="margin-top:20px;">
                    <button type="submit" name="upload_doc_submit" class="save-btn" style="background:#1B6B3A;">Upload for Approval</button>
                </div>
            </form>

            <!-- Uploaded Documents Table -->
            <h4 style="font-size:16px; font-weight:700; color:#122f2a; margin-bottom:12px;">Aapke Jama Shuda Documents</h4>
            <?php if (empty($docs)): ?>
                <p style="color:#888; font-style:italic;">Abhi koi document upload nahi hua hai.</p>
            <?php else: ?>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:14px;">
                        <thead>
                            <tr style="background:#e9f5ee; color:#1B6B3A; text-align:left;">
                                <th style="padding:12px 15px;">Document Type</th>
                                <th style="padding:12px 15px;">Number</th>
                                <th style="padding:12px 15px;">Status</th>
                                <th style="padding:12px 15px;">Upload Date</th>
                                <th style="padding:12px 15px;">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($docs as $d): ?>
                            <tr style="border-bottom:1px solid #eee;">
                                <td style="padding:12px 15px; font-weight:700; text-transform:uppercase;"><?= htmlspecialchars($d['doc_type']) ?></td>
                                <td style="padding:12px 15px;"><?= htmlspecialchars($d['doc_number'] ?: '—') ?></td>
                                <td style="padding:12px 15px;">
                                    <?php if ($d['status'] === 'approved'): ?>
                                        <span style="background:#dcfce7; color:#16a34a; padding:4px 10px; border-radius:12px; font-weight:700; font-size:12px;">Approved ✓</span>
                                    <?php elseif ($d['status'] === 'rejected'): ?>
                                        <span style="background:#fee2e2; color:#dc2626; padding:4px 10px; border-radius:12px; font-weight:700; font-size:12px;">Rejected ✕</span>
                                    <?php else: ?>
                                        <span style="background:#fef3c7; color:#d97706; padding:4px 10px; border-radius:12px; font-weight:700; font-size:12px;">Pending Review</span>
                                    <?php endif; ?>
                                </td>
                                <td style="padding:12px 15px; color:#777;"><?= date('d M Y', strtotime($d['uploaded_at'])) ?></td>
                                <td style="padding:12px 15px;"><a href="<?= htmlspecialchars($d['file_url']) ?>" target="_blank" style="color:#1B6B3A; font-weight:700;">View Doc</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- TAB 4: Referral Network & Tree -->
        <div id="tab-tree" class="tab-pane" style="display:none; background:#fff; border-radius:18px; padding:35px; border:1.5px solid #d8f3dc; box-shadow:0 8px 30px rgba(0,0,0,0.04);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1.5px solid #e9f5ee; padding-bottom:12px; flex-wrap:wrap; gap:10px;">
                <h3 style="font-size:20px; font-weight:800; color:#122f2a; margin:0;">
                    🌿 Al-Miftah Referral Tree Network
                </h3>
                <span style="font-size:13px; color:#1B6B3A; font-weight:700; background:#e8f5ed; padding:5px 12px; border-radius:12px;">
                    Team Size: <?= $team_count ?> Members
                </span>
            </div>

            <p style="color:#667471; font-size:13.5px; margin-bottom:25px;">
                Neeche aapka complete referral network hai. Kisi bhi member ke aage <strong style="color:#1B6B3A;">▼</strong> click karke unke downline referrals dekh sakte hain.
            </p>

            <div id="userTreeContainer" style="background:#fdfdfd; padding:25px; border-radius:14px; border:1.5px solid #e9f5ee;"></div>
        </div>

        <!-- TAB 5: Donations & Proofs -->
        <div id="tab-donation" class="tab-pane" style="display:none; background:#fff; border-radius:18px; padding:35px; border:1.5px solid #d8f3dc; box-shadow:0 8px 30px rgba(0,0,0,0.04);">
            <h3 style="font-size:20px; font-weight:800; color:#122f2a; margin-bottom:20px; border-bottom:1.5px solid #e9f5ee; padding-bottom:12px;">
                Donation History & Payment Proof Submission
            </h3>

            <!-- Quick Upload Screenshot Box -->
            <form method="POST" enctype="multipart/form-data" style="background:#f9fbf9; padding:25px; border-radius:14px; border:1.5px dashed #b7e4c7; margin-bottom:30px;">
                <h4 style="font-size:16px; font-weight:700; color:#1B6B3A; margin-bottom:15px;">Direct Donation Receipt Upload Karein</h4>
                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:18px;">
                    <div>
                        <label class="form-lbl">Donation Amount (₹)</label>
                        <input type="number" name="don_amount" placeholder="Amount in ₹" class="form-ctrl" required min="10" />
                    </div>
                    <div>
                        <label class="form-lbl">UTR / Transaction ID</label>
                        <input type="text" name="don_txn_id" placeholder="Bank / UPI Reference No." class="form-ctrl" />
                    </div>
                    <div>
                        <label class="form-lbl">Payment Screenshot</label>
                        <input type="file" name="don_proof" accept="image/*,.pdf" class="form-ctrl" required />
                    </div>
                </div>
                <div style="margin-top:20px;">
                    <button type="submit" name="upload_donation_submit" class="save-btn" style="background:#C8963E;">Submit Donation Proof</button>
                </div>
            </form>

            <h4 style="font-size:16px; font-weight:700; color:#122f2a; margin-bottom:12px;">Aapka Donation Record</h4>
            <?php if (empty($my_donations)): ?>
                <p style="color:#888; font-style:italic;">Abhi tak koi donation record nahi hai. <a href="donate.php" style="color:#1B6B3A; font-weight:700;">Donate karein</a></p>
            <?php else: ?>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:14px;">
                        <thead>
                            <tr style="background:#e9f5ee; color:#1B6B3A; text-align:left;">
                                <th style="padding:12px 15px;">Date</th>
                                <th style="padding:12px 15px;">Amount</th>
                                <th style="padding:12px 15px;">UTR / Txn ID</th>
                                <th style="padding:12px 15px;">Proof</th>
                                <th style="padding:12px 15px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($my_donations as $don): ?>
                            <tr style="border-bottom:1px solid #eee;">
                                <td style="padding:12px 15px; color:#666;"><?= date('d M Y', strtotime($don['created_at'])) ?></td>
                                <td style="padding:12px 15px; font-weight:800; color:#1B6B3A;">₹<?= number_format((float)$don['amount']) ?></td>
                                <td style="padding:12px 15px;"><?= htmlspecialchars($don['transaction_id'] ?: '—') ?></td>
                                <td style="padding:12px 15px;">
                                    <?php if ($don['proof_image']): ?>
                                        <a href="<?= htmlspecialchars($don['proof_image']) ?>" target="_blank" style="color:#C8963E; font-weight:700;">View Photo</a>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td style="padding:12px 15px;">
                                    <?php if ($don['status'] === 'approved'): ?>
                                        <span style="background:#dcfce7; color:#16a34a; padding:4px 10px; border-radius:12px; font-weight:700; font-size:12px;">Approved ✓</span>
                                    <?php elseif ($don['status'] === 'rejected'): ?>
                                        <span style="background:#fee2e2; color:#dc2626; padding:4px 10px; border-radius:12px; font-weight:700; font-size:12px;">Rejected ✕</span>
                                    <?php else: ?>
                                        <span style="background:#fef3c7; color:#d97706; padding:4px 10px; border-radius:12px; font-weight:700; font-size:12px;">Pending</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<style>
.prof-tab {
    background: #fff;
    color: #122f2a;
    border: 1.5px solid #d8f3dc;
    padding: 12px 22px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
}
.prof-tab:hover, .prof-tab-active {
    background: #1B6B3A !important;
    color: #fff !important;
    border-color: #1B6B3A !important;
    box-shadow: 0 4px 15px rgba(27,107,58,0.2);
}
.form-lbl {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: #122f2a;
    margin-bottom: 6px;
}
.form-ctrl {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #dcdcdc;
    border-radius: 10px;
    font-size: 14.5px;
    outline: none;
    transition: 0.2s;
    box-sizing: border-box;
}
.form-ctrl:focus {
    border-color: #1B6B3A;
    box-shadow: 0 0 0 3px rgba(27,107,58,0.1);
}
.save-btn {
    background: #1B6B3A;
    color: #fff;
    border: none;
    padding: 13px 30px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 14.5px;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 15px rgba(27,107,58,0.25);
}
.save-btn:hover { background: #14532d; }
.tree-node-box {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #fff;
    border: 1.5px solid #e9f5ee;
    border-radius: 12px;
    padding: 12px 18px;
    margin-bottom: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}
.tree-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 800;
    font-size: 13px;
    flex-shrink: 0;
}
</style>

<script>
function switchTab(tabId) {
    document.querySelectorAll('.tab-pane').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.prof-tab').forEach(el => el.classList.remove('prof-tab-active'));
    document.getElementById(tabId).style.display = 'block';
    const btnId = tabId.replace('tab-', 'btn-');
    if (document.getElementById(btnId)) {
        document.getElementById(btnId).classList.add('prof-tab-active');
    }
}

function copyRefCode(code) {
    navigator.clipboard.writeText(code);
    alert("Referral Code Copy Ho Gaya: " + code);
}

function copyRefLink() {
    var copyText = document.getElementById("refLinkInput");
    copyText.select();
    navigator.clipboard.writeText(copyText.value);
    alert("Referral Link Copy Ho Gaya!");
}

// Tree Rendering Logic
const USER_TREE = <?= json_encode($user_tree) ?>;
const COLORS = ['#1B6B3A', '#2d6a4f', '#40916c', '#52b788', '#74c69d', '#b5838d', '#d4a017'];
const openNodes = {};

function getInitials(name) {
    if (!name) return 'U';
    return name.split(' ').map(w => w[0] || '').slice(0, 2).join('').toUpperCase();
}

function renderTreeBranch(node, lvl) {
    if (!node) return '';
    const hasKids = node.children && node.children.length > 0;
    const isRoot = lvl === 0;
    const isExpanded = openNodes[node.id] !== false;
    const col = COLORS[lvl % COLORS.length];

    let h = `<div style="margin-left:${isRoot ? 0 : 25}px; position:relative;">`;
    if (!isRoot) {
        h += `<div style="position:absolute; left:-18px; top:22px; width:15px; height:2px; background:#b7e4c7;"></div>`;
    }

    h += `<div class="tree-node-box">
            <div class="tree-avatar" style="background:${col};">${getInitials(node.name)}</div>
            <div style="flex:1;">
                <div style="font-weight:800; font-size:14px; color:#122f2a;">
                    ${node.name} ${isRoot ? '<span style="background:#C8963E; color:#fff; font-size:10px; padding:2px 6px; border-radius:4px; margin-left:6px;">Aap (You)</span>' : ''}
                </div>
                <div style="font-size:11.5px; color:#888;">
                    Code: <strong>${node.code || '—'}</strong> | Status: <strong>${node.status || 'Active'}</strong>
                </div>
            </div>
            ${hasKids ? `<button onclick="toggleNode(${node.id})" style="background:#e8f5ed; border:none; padding:4px 10px; border-radius:6px; cursor:pointer; font-weight:bold; color:#1B6B3A;">${isExpanded ? '▲' : '▼ (' + node.children.length + ')'}</button>` : '<span style="font-size:11px; color:#aaa; font-style:italic;">Direct Member</span>'}
          </div>`;

    if (hasKids && isExpanded) {
        h += `<div style="border-left:2px solid #b7e4c7; margin-left:18px;">`;
        node.children.forEach(kid => {
            h += renderTreeBranch(kid, lvl + 1);
        });
        h += `</div>`;
    }

    h += `</div>`;
    return h;
}

function toggleNode(id) {
    openNodes[id] = !openNodes[id];
    drawTree();
}

function drawTree() {
    const el = document.getElementById('userTreeContainer');
    if (!el) return;
    if (!USER_TREE.children || USER_TREE.children.length === 0) {
        el.innerHTML = `
            <div style="text-align:center; padding:30px 0;">
                <div class="tree-avatar" style="background:#1B6B3A; margin:0 auto 12px; width:50px; height:50px; font-size:18px;">${getInitials(USER_TREE.name)}</div>
                <h4 style="margin:0 0 5px; color:#122f2a;">${USER_TREE.name}</h4>
                <p style="color:#888; font-size:13px; margin:0 0 15px;">Aapki downline tree abhi khali hai. Apne referral link se doston ko invite karein!</p>
                <button onclick="copyRefLink()" style="background:#1B6B3A; color:#fff; border:none; padding:8px 20px; border-radius:20px; font-weight:700; font-size:12.5px; cursor:pointer;">Copy My Invite Link</button>
            </div>`;
    } else {
        el.innerHTML = renderTreeBranch(USER_TREE, 0);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    drawTree();
});
</script>

<?php require_once 'footer.php'; ?>
