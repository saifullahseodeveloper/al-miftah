<?php
if (!defined('ABSPATH')) exit;

add_shortcode('nk_dashboard', function () {
    if (!is_user_logged_in()) {
        return '<script>window.location="' . home_url('/login') . '"</script>';
    }

    $uid  = get_current_user_id();
    $user = get_userdata($uid);
    $p    = nk_profile($uid);
    $comp = nk_completion($uid);
    $txns = nk_transactions($uid, 20);
    $total_donated = nk_total_donated($uid);

    global $wpdb;
    $direct_refs = (int)$wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM {$wpdb->prefix}nk_profiles WHERE referred_by=%d", $uid
    ));
    $docs = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}nk_docs WHERE user_id=%d", $uid
    ));

    $ref_link = home_url('/?ref=' . $p->referral_code);
    $photo_id = get_user_meta($uid, 'nk_photo', true);
    $photo    = $photo_id ? wp_get_attachment_image_url($photo_id, 'thumbnail') : '';

    // Status
    $is_complete = $comp['pct'] === 100;
    $doc_ok      = $p->doc_status === 'approved';

    // Tab
    $tab = sanitize_text_field($_GET['tab'] ?? 'overview');

    ob_start(); ?>
    <div class="nk-dash-wrap">

        <!-- Sidebar -->
        <aside class="nk-sidebar">
            <div class="nk-sidebar-brand">ð± NekNeev</div>

            <!-- User card -->
            <div class="nk-user-mini">
                <?php if ($photo): ?>
                    <img src="<?= esc_url($photo) ?>" class="nk-mini-avatar">
                <?php else: ?>
                    <div class="nk-mini-avatar nk-av-fallback"><?= mb_strtoupper(mb_substr($user->display_name ?: 'U', 0, 1)) ?></div>
                <?php endif; ?>
                <div>
                    <div class="nk-mini-name"><?= esc_html($user->display_name) ?></div>
                    <div class="nk-mini-status <?= $is_complete ? 'verified' : 'incomplete' ?>">
                        <?= $is_complete ? 'â Verified' : 'â  Incomplete' ?>
                    </div>
                </div>
            </div>

            <!-- Completion bar -->
            <div class="nk-sidebar-progress">
                <div class="nk-sp-label"><span>Profile</span><span><?= $comp['pct'] ?>%</span></div>
                <div class="nk-sp-bar"><div style="width:<?= $comp['pct'] ?>%"></div></div>
            </div>

            <!-- Nav -->
            <nav class="nk-nav">
                <?php $tabs = [
                    ['overview', 'ð ', 'Overview'],
                    ['profile',  'ð¤', 'Meri Profile'],
                    ['documents','ð', 'Documents'],
                    ['donations','ð', 'Donations'],
                    ['referrals','ÿÿÿÿ', 'Referrals'],
                    ['security', 'ð', 'Password'],
                ]; foreach ($tabs as $t): ?>
                    <a href="?tab=<?= $t[0] ?>" class="nk-nav-item <?= $tab === $t[0] ? 'active' : '' ?>">
                        <span><?= $t[1] ?></span> <?= $t[2] ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="nk-sidebar-footer">
                <a href="<?= home_url('/donate') ?>" class="nk-btn nk-btn-sm nk-btn-full">ð Donate Karein</a>
                <a href="<?= wp_logout_url(home_url()) ?>" class="nk-logout-link">ðª Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="nk-main">

            <!-- ââ OVERVIEW ââ -->
            <?php if ($tab === 'overview'): ?>
            <div class="nk-page-title">Dashboard Overview</div>

            <!-- Alert if incomplete -->
            <?php if (!$doc_ok): ?>
            <div class="nk-banner nk-banner-warn">
                <div>
                    <strong>â  Profile Incomplete!</strong>
                    <p>Document upload karo â Aadhaar ya PAN card zaroori hai</p>
                </div>
                <a href="?tab=documents" class="nk-btn nk-btn-sm">Upload Karein â</a>
            </div>
            <?php endif; ?>

            <!-- Stats Row -->
            <div class="nk-stat-row">
                <?php foreach ([
                    ['ð','Total Donated', 'â¹' . number_format($total_donated, 2), '#d8f3dc', '#1b4332'],
                    ['ð¿','Direct Referrals', $direct_refs, '#e8f4fd', '#1565c0'],
                    ['ð','Transactions', count($txns), '#fce4ec', '#c62828'],
                    ['ð','Profile', $comp['pct'].'%', '#f3e5f5', '#6a1b9a'],
                ] as $s): ?>
                <div class="nk-stat-card" style="background:<?= $s[3] ?>;color:<?= $s[4] ?>">
                    <div class="nk-stat-icon"><?= $s[0] ?></div>
                    <div class="nk-stat-val"><?= $s[2] ?></div>
                    <div class="nk-stat-label"><?= $s[1] ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Steps Progress -->
            <div class="nk-section">
                <h3>ð Profile Completion Steps</h3>
                <div class="nk-steps-list">
                    <?php
                    $steps = [
                        ['â', 'Account Register', true],
                        ['ð±', 'Basic Details (Naam, Mobile, Address)', $comp['steps'][0]],
                        ['ð', 'Document Verify (Aadhaar/PAN)', $comp['steps'][1]],
                    ];
                    foreach ($steps as $i => $s): ?>
                    <div class="nk-step-row <?= $s[2] ? 'done' : '' ?>">
                        <div class="nk-step-num"><?= $s[2] ? 'â' : ($i+1) ?></div>
                        <div class="nk-step-label"><?= $s[1] ?></div>
                        <?php if (!$s[2]): ?>
                            <a href="?tab=<?= $i===1?'profile':'documents' ?>" class="nk-btn nk-btn-sm">Complete Karein</a>
                        <?php else: ?>
                            <span class="nk-done-badge">Done</span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Recent Transactions -->
            <?php if ($txns): ?>
            <div class="nk-section">
                <h3>ð Recent Donations</h3>
                <?php foreach (array_slice($txns, 0, 5) as $t): ?>
                <div class="nk-txn-row">
                    <div class="nk-txn-icon"><?= ['gpay'=>'ð¢','phonepe'=>'ð£','upi'=>'ðµ','bank'=>'ð¦'][$t->method] ?? 'ð³' ?></div>
                    <div class="nk-txn-info">
                        <div class="nk-txn-method"><?= strtoupper($t->method) ?> â Txn: <?= esc_html($t->txn_id) ?></div>
                        <div class="nk-txn-date"><?= date('d M Y, H:i', strtotime($t->created_at)) ?></div>
                    </div>
                    <div class="nk-txn-right">
                        <div class="nk-txn-amt">â¹<?= number_format($t->amount, 2) ?></div>
                        <span class="nk-status-badge nk-status-<?= $t->status ?>"><?= ucfirst($t->status) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
                <a href="?tab=donations" class="nk-link-more">Sab dekho â</a>
            </div>
            <?php endif; ?>

            <!-- ââ PROFILE TAB ââ -->
            <?php elseif ($tab === 'profile'): ?>
            <div class="nk-page-title">Meri Profile</div>

            <?php if (isset($_POST['nk_profile_save']) && wp_verify_nonce($_POST['_nk_nonce']??'','nk_profile_save')): ?>
                <?php
                global $wpdb;
                $data = [
                    'full_name' => sanitize_text_field($_POST['full_name']??''),
                    'mobile'    => preg_replace('/\D/','', $_POST['mobile']??''),
                    'address'   => sanitize_textarea_field($_POST['address']??''),
                    'city'      => sanitize_text_field($_POST['city']??''),
                    'state'     => sanitize_text_field($_POST['state']??''),
                    'pincode'   => preg_replace('/\D/','', $_POST['pincode']??''),
                ];
                $wpdb->update("{$wpdb->prefix}nk_profiles", $data, ['user_id'=>$uid]);
                wp_update_user(['ID'=>$uid,'display_name'=>$data['full_name']]);
                // Handle photo
                if (!empty($_FILES['nk_photo']['name'])) {
                    require_once ABSPATH.'wp-admin/includes/file.php';
                    require_once ABSPATH.'wp-admin/includes/media.php';
                    require_once ABSPATH.'wp-admin/includes/image.php';
                    $att = media_handle_upload('nk_photo', 0);
                    if (!is_wp_error($att)) update_user_meta($uid, 'nk_photo', $att);
                }
                $p    = nk_profile($uid);
                $photo_id = get_user_meta($uid,'nk_photo',true);
                $photo = $photo_id ? wp_get_attachment_image_url($photo_id,'thumbnail') : '';
                echo '<div class="nk-alert nk-ok">â Profile save ho gaya!</div>';
                ?>
            <?php endif; ?>

            <div class="nk-section">
                <form method="post" enctype="multipart/form-data" class="nk-form">
                    <?php wp_nonce_field('nk_profile_save','_nk_nonce'); ?>

                    <!-- Photo -->
                    <div class="nk-photo-section">
                        <?php if ($photo): ?>
                            <img src="<?= esc_url($photo) ?>" class="nk-profile-photo">
                        <?php else: ?>
                            <div class="nk-profile-photo nk-photo-default"><?= mb_strtoupper(mb_substr($user->display_name??'U',0,1)) ?></div>
                        <?php endif; ?>
                        <div>
                            <label class="nk-btn nk-btn-sm" for="nk_photo_inp">ð· Photo Change Karein</label>
                            <input type="file" id="nk_photo_inp" name="nk_photo" accept="image/*" style="display:none">
                            <div style="font-size:12px;color:#888;margin-top:4px">JPG/PNG, max 2MB</div>
                        </div>
                    </div>

                    <div class="nk-info-grid">
                        <div class="nk-info-row"><span>User ID</span><strong>#<?= $uid ?></strong></div>
                        <div class="nk-info-row"><span>Email</span><strong><?= esc_html($user->user_email) ?></strong></div>
                        <div class="nk-info-row"><span>Referral Code</span><strong><?= esc_html($p->referral_code) ?></strong></div>
                        <div class="nk-info-row"><span>Member Since</span><strong><?= date('d M Y', strtotime($p->joined_at)) ?></strong></div>
                    </div>

                    <div class="nk-row-2">
                        <div class="nk-field"><label>ð¤ Poora Naam *</label><input type="text" name="full_name" class="nk-input" value="<?= esc_attr($p->full_name) ?>" required></div>
                        <div class="nk-field"><label>ð± Mobile *</label>
                            <div class="nk-mobile-wrap"><span class="nk-code">+91</span><input type="tel" name="mobile" class="nk-input" maxlength="10" value="<?= esc_attr($p->mobile) ?>"></div>
                        </div>
                    </div>
                    <div class="nk-field"><label>ð  Address *</label><textarea name="address" class="nk-input" rows="2"><?= esc_textarea($p->address) ?></textarea></div>
                    <div class="nk-row-3">
                        <div class="nk-field"><label>ð City</label><input type="text" name="city" class="nk-input" value="<?= esc_attr($p->city) ?>"></div>
                        <div class="nk-field"><label>ðº State</label><input type="text" name="state" class="nk-input" value="<?= esc_attr($p->state) ?>"></div>
                        <div class="nk-field"><label>ð® PIN</label><input type="text" name="pincode" class="nk-input" maxlength="6" value="<?= esc_attr($p->pincode) ?>"></div>
                    </div>
                    <button type="submit" name="nk_profile_save" class="nk-btn nk-btn-full">ð¾ Save Karein</button>
                </form>
            </div>

            <!-- ââ DOCUMENTS TAB ââ -->
            <?php elseif ($tab === 'documents'): ?>
            <div class="nk-page-title">ð Identity Documents</div>

            <?php if ($doc_ok): ?>
                <div class="nk-alert nk-ok">â Document verified hai! Account poora ho gaya.</div>
            <?php else: ?>
                <div class="nk-alert nk-warn">â  Aadhaar ya PAN card mein se ek upload karein â yeh zaroori hai</div>
            <?php endif; ?>

            <?php if (!$doc_ok): ?>
            <div class="nk-doc-tabs">
                <button class="nk-doc-tab active" onclick="nkDocTab('aadhaar',this)">ð© Aadhaar Card</button>
                <button class="nk-doc-tab" onclick="nkDocTab('pan',this)">ð¦ PAN Card</button>
            </div>

            <div id="nk-doc-aadhaar" class="nk-doc-form-box">
                <h4>ð© Aadhaar Card Upload</h4>
                <div class="nk-field"><label>Aadhaar Number (12 digit)</label><input type="text" class="nk-input" id="nk-num-aadhaar" maxlength="12" placeholder="XXXX XXXX XXXX"></div>
                <div class="nk-field"><label>Front Photo</label><input type="file" class="nk-input" id="nk-file-aadhaar" accept="image/*,.pdf"><small>JPG/PNG/PDF, max 5MB</small></div>
                <div class="nk-doc-msg" id="nk-msg-aadhaar"></div>
                <button onclick="nkUploadDoc('aadhaar')" class="nk-btn nk-btn-full">ð¤ Upload Aadhaar</button>
            </div>

            <div id="nk-doc-pan" class="nk-doc-form-box" style="display:none">
                <h4>ð¦ PAN Card Upload</h4>
                <div class="nk-field"><label>PAN Number (Jaise: ABCDE1234F)</label><input type="text" class="nk-input" id="nk-num-pan" maxlength="10" placeholder="ABCDE1234F" style="text-transform:uppercase"></div>
                <div class="nk-field"><label>PAN Card Photo</label><input type="file" class="nk-input" id="nk-file-pan" accept="image/*,.pdf"><small>JPG/PNG/PDF, max 5MB</small></div>
                <div class="nk-doc-msg" id="nk-msg-pan"></div>
                <button onclick="nkUploadDoc('pan')" class="nk-btn nk-btn-full">ð¤ Upload PAN</button>
            </div>
            <?php endif; ?>

            <!-- Uploaded docs list -->
            <?php if ($docs): ?>
            <div class="nk-section" style="margin-top:20px">
                <h4>Uploaded Documents</h4>
                <?php foreach ($docs as $d): ?>
                <div class="nk-doc-item">
                    <span><?= $d->doc_type==='pan'?'ð¦ PAN Card':'ð© Aadhaar Card' ?></span>
                    <span style="font-family:monospace;font-size:12px"><?= esc_html($d->doc_number) ?></span>
                    <span class="nk-status-badge nk-status-<?= $d->status ?>"><?= ucfirst($d->status) ?></span>
                    <a href="<?= esc_url($d->file_url) ?>" target="_blank" class="nk-link-more">Dekhein</a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- ââ DONATIONS TAB ââ -->
            <?php elseif ($tab === 'donations'): ?>
            <div class="nk-page-title">ð Meri Donations</div>

            <div class="nk-stat-row">
                <div class="nk-stat-card" style="background:#d8f3dc;color:#1b4332">
                    <div class="nk-stat-icon">ð</div>
                    <div class="nk-stat-val">â¹<?= number_format($total_donated, 2) ?></div>
                    <div class="nk-stat-label">Total Confirmed</div>
                </div>
                <div class="nk-stat-card" style="background:#fff8e1;color:#f57f17">
                    <?php $pending = array_sum(array_map(fn($t)=>$t->status==='pending'?$t->amount:0, $txns)); ?>
                    <div class="nk-stat-icon">â³</div>
                    <div class="nk-stat-val">â¹<?= number_format($pending, 2) ?></div>
                    <div class="nk-stat-label">Pending Review</div>
                </div>
                <div class="nk-stat-card" style="background:#e8f4fd;color:#1565c0">
                    <div class="nk-stat-icon">ð</div>
                    <div class="nk-stat-val"><?= count($txns) ?></div>
                    <div class="nk-stat-label">Total Transactions</div>
                </div>
            </div>

            <div class="nk-section">
                <div class="nk-section-head">
                    <h3>Transaction History</h3>
                    <a href="<?= home_url('/donate') ?>" class="nk-btn nk-btn-sm">+ Naya Donate</a>
                </div>
                <?php if ($txns): foreach ($txns as $t): ?>
                <div class="nk-txn-row">
                    <div class="nk-txn-icon"><?= ['gpay'=>'ð¢','phonepe'=>'ð£','upi'=>'ðµ','bank'=>'ð¦'][$t->method]??'ð³' ?></div>
                    <div class="nk-txn-info">
                        <div class="nk-txn-method"><?= strtoupper($t->method) ?></div>
                        <div class="nk-txn-ref">Ref: <?= esc_html($t->txn_id) ?></div>
                        <?php if ($t->note): ?><div class="nk-txn-note-txt"><?= esc_html($t->note) ?></div><?php endif; ?>
                        <div class="nk-txn-date"><?= date('d M Y, H:i', strtotime($t->created_at)) ?></div>
                    </div>
                    <div class="nk-txn-right">
                        <div class="nk-txn-amt">â¹<?= number_format($t->amount, 2) ?></div>
                        <span class="nk-status-badge nk-status-<?= $t->status ?>"><?= ucfirst($t->status) ?></span>
                        <?php if ($t->screenshot_url): ?>
                            <a href="<?= esc_url($t->screenshot_url) ?>" target="_blank" class="nk-link-more">Screenshot</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; else: ?>
                    <p class="nk-empty">Koi donation nahi mila. <a href="<?= home_url('/donate') ?>">Donate karein â</a></p>
                <?php endif; ?>
            </div>

            <!-- ââ REFERRALS TAB ââ -->
            <?php elseif ($tab === 'referrals'): ?>
            <div class="nk-page-title">ð¿ Mera Referral Network</div>

            <div class="nk-ref-link-box">
                <div>
                    <div class="nk-ref-label">Aapka Referral Link</div>
                    <div class="nk-ref-url" id="nk-ref-url"><?= esc_html($ref_link) ?></div>
                </div>
                <button onclick="nkCopy('<?= esc_js($ref_link) ?>',this)" class="nk-btn">ð Copy</button>
            </div>

            <div class="nk-stat-row">
                <div class="nk-stat-card" style="background:#d8f3dc;color:#1b4332">
                    <div class="nk-stat-icon">ð¥</div>
                    <div class="nk-stat-val"><?= $direct_refs ?></div>
                    <div class="nk-stat-label">Direct Referrals</div>
                </div>
            </div>

            <?php
            // Build user's personal referral tree
            $all_profiles = $wpdb->get_results("SELECT p.user_id, p.full_name, p.mobile, p.referred_by, p.referral_code, p.joined_at, p.total_donated, p.doc_status, u.user_email FROM {$wpdb->prefix}nk_profiles p LEFT JOIN {$wpdb->users} u ON u.ID=p.user_id");
            $map = [];
            foreach ($all_profiles as $ap) { $map[$ap->user_id] = ['node'=>$ap,'children'=>[]]; }
            foreach ($all_profiles as $ap) { if ($ap->referred_by && isset($map[$ap->referred_by])) { $map[$ap->referred_by]['children'][] = &$map[$ap->user_id]; } }
            $current_node = $map[$uid] ?? null;
            ?>

            <?php if ($current_node): ?>
            <div class="nk-section">
                <h3>Aapka Tree</h3>
                <?php nk_render_user_tree($current_node, 0); ?>
            </div>
            <?php endif; ?>


            <!-- ── SECURITY / PASSWORD TAB ── -->
            <?php elseif ($tab === 'security'): ?>
            <div class="nk-page-title">🔐 Password Change Karein</div>

            <?php
            $pw_msg = ''; $pw_ok = false;
            if (isset($_POST['nk_change_pass']) && wp_verify_nonce($_POST['_nk_nonce']??'','nk_change_pass')) {
                $cur  = $_POST['current_pass'] ?? '';
                $new  = $_POST['new_pass'] ?? '';
                $conf = $_POST['confirm_pass'] ?? '';
                $user_obj = get_userdata($uid);
                if (!wp_check_password($cur, $user_obj->user_pass, $uid)) {
                    $pw_msg = 'Current password galat hai!';
                } elseif (strlen($new) < 8) {
                    $pw_msg = 'Naya password kam se kam 8 characters ka hona chahiye!';
                } elseif ($new !== $conf) {
                    $pw_msg = 'Dono passwords match nahi kar rahe!';
                } else {
                    wp_set_password($new, $uid);
                    wp_set_auth_cookie($uid, true);
                    $pw_msg = 'success';
                    $pw_ok  = true;
                }
            }
            ?>
            <?php if ($pw_ok): ?>
                <div class="nk-alert nk-ok">✅ Password successfully change ho gaya!</div>
            <?php elseif ($pw_msg): ?>
                <div class="nk-alert nk-err">⚠ <?= esc_html($pw_msg) ?></div>
            <?php endif; ?>

            <div class="nk-section" style="max-width:480px">
                <div class="nk-pass-info-box">
                    <div style="font-size:36px;text-align:center;margin-bottom:8px">🔐</div>
                    <p style="text-align:center;color:#666;font-size:14px;margin:0 0 24px">Strong password rakho — numbers, capital letters aur special characters use karo</p>
                </div>
                <form method="post" class="nk-form">
                    <?php wp_nonce_field('nk_change_pass','_nk_nonce'); ?>
                    <div class="nk-field">
                        <label>🔒 Current Password *</label>
                        <div class="nk-pass-wrap">
                            <input type="password" name="current_pass" id="nk-cur-pass" class="nk-input" placeholder="Purana password" required>
                            <button type="button" class="nk-eye" onclick="nkEyeToggle('nk-cur-pass')">👁</button>
                        </div>
                    </div>
                    <div class="nk-field">
                        <label>🆕 Naya Password *</label>
                        <div class="nk-pass-wrap">
                            <input type="password" name="new_pass" id="nk-new-pass" class="nk-input" placeholder="Kam se kam 8 characters" required oninput="nkPassStrength2(this.value)">
                            <button type="button" class="nk-eye" onclick="nkEyeToggle('nk-new-pass')">👁</button>
                        </div>
                        <div class="nk-strength-bar" style="margin-top:6px"><div id="nk-str2-fill"></div></div>
                        <div id="nk-str2-label" style="font-size:11px;color:#888;margin-top:3px;font-family:monospace"></div>
                    </div>
                    <div class="nk-field">
                        <label>🔁 Password Confirm Karein *</label>
                        <div class="nk-pass-wrap">
                            <input type="password" name="confirm_pass" id="nk-conf-pass" class="nk-input" placeholder="Dobara same password daalo" required oninput="nkMatchCheck()">
                            <button type="button" class="nk-eye" onclick="nkEyeToggle('nk-conf-pass')">👁</button>
                        </div>
                        <div id="nk-match-msg" style="font-size:12px;margin-top:4px;font-family:monospace"></div>
                    </div>

                    <div class="nk-pass-rules">
                        <div class="nk-rule" id="r-len">○ 8+ characters</div>
                        <div class="nk-rule" id="r-cap">○ Capital letter (A-Z)</div>
                        <div class="nk-rule" id="r-num">○ Number (0-9)</div>
                        <div class="nk-rule" id="r-sym">○ Special character (!@#$)</div>
                    </div>

                    <button type="submit" name="nk_change_pass" class="nk-btn nk-btn-full nk-btn-lg" style="margin-top:20px">🔒 Password Update Karein</button>
                </form>
            </div>

            <?php endif; // end tabs ?>

        </main>
    </div>

    <script>
    function nkDocTab(type, btn) {
        document.querySelectorAll('.nk-doc-form-box').forEach(el => el.style.display='none');
        document.querySelectorAll('.nk-doc-tab').forEach(el => el.classList.remove('active'));
        document.getElementById('nk-doc-'+type).style.display='block';
        btn.classList.add('active');
    }
    function nkUploadDoc(type) {
        var file   = document.getElementById('nk-file-'+type).files[0];
        var num    = document.getElementById('nk-num-'+type).value;
        var msg    = document.getElementById('nk-msg-'+type);
        if (!file) { msg.innerHTML='<span style="color:red">â  File select karein</span>'; return; }
        msg.innerHTML='â³ Upload ho raha hai...';
        var fd = new FormData();
        fd.append('action','nk_upload_doc');
        fd.append('nonce', NK.nonce);
        fd.append('doc_type', type);
        fd.append('doc_number', num);
        fd.append('doc_file', file);
        fetch(NK.ajax, {method:'POST',body:fd}).then(r=>r.json()).then(d=>{
            if (d.success) { msg.innerHTML='<span style="color:green">â '+d.data.msg+'</span>'; setTimeout(()=>location.reload(),1500); }
            else { msg.innerHTML='<span style="color:red">â  '+d.data+'</span>'; }
        });
    }
    function nkShowPay(method) {
        document.querySelectorAll('.nk-pay-panel').forEach(el=>el.style.display='none');
        document.querySelectorAll('.nk-pay-card').forEach(el=>el.classList.remove('active'));
        var el=document.getElementById('nk-pay-'+method);
        if(el){el.style.display='block';el.scrollIntoView({behavior:'smooth',block:'start'});}
    }
    function nkSubmitTxn(btn, method) {
        var box    = btn.closest('.nk-txn-form');
        var amount = box.querySelector('.nk-txn-amount').value;
        var txnid  = box.querySelector('.nk-txn-id').value;
        var note   = box.querySelector('.nk-txn-note').value;
        var ssFile = box.querySelector('.nk-txn-ss').files[0];
        var msg    = box.querySelector('.nk-txn-msg');
        if (!amount||amount<=0){msg.innerHTML='<span style="color:red">â  Amount daalo</span>';return;}
        if (!txnid){msg.innerHTML='<span style="color:red">â  Transaction ID daalo</span>';return;}
        msg.innerHTML='â³ Submit ho raha hai...';
        var fd=new FormData();
        fd.append('action','nk_submit_txn');
        fd.append('nonce',NK.nonce);
        fd.append('amount',amount);
        fd.append('txn_id',txnid);
        fd.append('method',method);
        fd.append('note',note);
        if(ssFile) fd.append('screenshot',ssFile);
        fetch(NK.ajax,{method:'POST',body:fd}).then(r=>r.json()).then(d=>{
            if(d.success){msg.innerHTML='<span style="color:green">â '+d.data.msg+'</span>';btn.disabled=true;}
            else{msg.innerHTML='<span style="color:red">â  '+d.data+'</span>';}
        });
    }
    </script>
    <?php return ob_get_clean();
});

function nk_render_user_tree($node, $level) {
    $p = $node['node'];
    $name = $p->full_name ?: ('User #' . $p->user_id);
    $total = 0;
    $count_children = function($n) use (&$count_children, &$total) {
        $total += count($n['children']);
        foreach ($n['children'] as $c) $count_children($c);
    };
    $count_children($node);
    ?>
    <div style="margin-left:<?= $level*28 ?>px;margin-bottom:8px;position:relative">
        <?php if ($level>0): ?><div style="position:absolute;left:-18px;top:22px;width:14px;height:1px;background:#b7e4c7"></div><?php endif; ?>
        <div class="nk-tree-node">
            <div class="nk-tree-av" style="background:<?= ['#2d6a4f','#40916c','#52b788','#74c69d','#d4a017'][$level%5] ?>"><?= strtoupper(substr($name,0,2)) ?></div>
            <div class="nk-tree-info">
                <div class="nk-tree-name"><?= esc_html($name) ?> <?= $level===0?'<span class="nk-you-badge">(Aap)</span>':'' ?></div>
                <div class="nk-tree-meta"><?= esc_html($p->user_email??'') ?> â¢ <?= date('d M Y',strtotime($p->joined_at)) ?></div>
            </div>
            <div class="nk-tree-badges">
                <span class="nk-tbadge"><?= count($node['children']) ?> direct</span>
                <?php if ($total): ?><span class="nk-tbadge nk-tbadge-dark">ð± <?= $total ?> total</span><?php endif; ?>
                <?php if ($p->total_donated > 0): ?><span class="nk-tbadge nk-tbadge-green">â¹<?= number_format($p->total_donated,0) ?></span><?php endif; ?>
            </div>
        </div>
        <?php if ($node['children']): ?>
        <div style="border-left:2px solid #b7e4c7;margin-left:14px;padding-left:0;margin-top:0">
            <?php foreach ($node['children'] as $child): nk_render_user_tree($child, $level+1); endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
}
