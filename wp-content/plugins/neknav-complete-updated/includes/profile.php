<?php
if (!defined('ABSPATH')) exit;


/* ── Tree Node Renderer (profile page) ────────────────────────────── */
if (!function_exists('nkt_draw_node')) {
function nkt_draw_node($node, $level, $is_me = false) {
    $p      = $node['node'];
    $name   = $p->full_name ?: ('User #' . $p->user_id);
    $init   = strtoupper(substr(preg_replace('/[^a-zA-Z ]/','',$name), 0, 2));
    if (!$init) $init = '#' . $p->user_id;
    $dc     = count($node['children']);
    $total  = nkt_count_kids($node);
    $colors = ['#2d6a4f','#40916c','#52b788','#74c69d','#95d5b2'];
    $col    = $colors[$level % 5];
    $uid    = $p->user_id;
    $has    = $dc > 0;
    ?>
    <div style="<?php echo $level>0?'margin-left:28px;':'' ?>position:relative">
        <?php if($level>0): ?>
        <div style="position:absolute;left:-18px;top:20px;width:14px;height:1px;background:#b7e4c7"></div>
        <?php endif; ?>
        <div class="nkt-node">
            <div class="nkt-av" style="background:<?php echo $col ?>"><?php echo esc_html($init) ?></div>
            <div class="nkt-node-info">
                <div class="nkt-node-name">
                    <?php echo esc_html($name) ?>
                    <?php if($is_me): ?><span class="nkt-you-tag">Aap</span><?php endif; ?>
                </div>
                <div class="nkt-node-meta">
                    Joined: <?php echo date('d M Y', strtotime($p->joined_at)) ?>
                    &bull; Code: <?php echo esc_html($p->referral_code ?? '-') ?>
                </div>
            </div>
            <div class="nkt-node-right">
                <?php if($dc>0): ?><span class="nkt-nbadge"><?php echo $dc ?> direct</span><?php endif; ?>
                <?php if($total>0): ?><span class="nkt-nbadge nkt-nbadge-dk">&#127807; <?php echo $total ?></span><?php endif; ?>
                <?php if($p->doc_verified): ?><span class="nkt-nbadge nkt-nbadge-ok">&#10003; Verified</span><?php endif; ?>
                <?php if($has): ?><button class="nkt-tog-btn" id="nkt-btn-<?php echo $uid ?>" onclick="nktTog(<?php echo $uid ?>)">&#9660;</button><?php endif; ?>
            </div>
        </div>
        <?php if($has): ?>
        <div style="border-left:2px solid #b7e4c7;margin-left:14px" id="nkt-kids-<?php echo $uid ?>">
            <?php foreach($node['children'] as $child): nkt_draw_node($child, $level+1); endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
}
}

add_shortcode('neknav_profile', 'neknav_profile_shortcode');
function neknav_profile_shortcode() {
    if (!is_user_logged_in()) {
        return '<div class="nk-box"><p>Pehle <a href="' . home_url('/login') . '">login</a> karein.</p></div>';
    }

    $uid  = get_current_user_id();
    $user = get_userdata($uid);
    global $wpdb;

    // --- LOGIC: Donation Screenshot Handle Karne Ke Liye ---
    if (isset($_POST['neknav_donation_submit'])) {
        $amount = sanitize_text_field($_POST['don_amount']);
        $txn_id = sanitize_text_field($_POST['don_txn_id']);
        $proof_url = '';

        if (!empty($_FILES['don_proof']['name'])) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            $att_id = media_handle_upload('don_proof', 0);
            if (!is_wp_error($att_id)) {
                $proof_url = wp_get_attachment_url($att_id);
            }
        }

        $wpdb->insert($wpdb->prefix . 'neknav_donations', [
            'user_id' => $uid,
            'amount'  => $amount,
            'transaction_id' => $txn_id,
            'proof_image' => $proof_url,
            'status'  => 'pending',
            'created_at' => current_time('mysql')
        ]);
        
        // --- NAYA: Redirect taaki refresh par duplicate entry na bane ---
        wp_redirect(add_query_arg('donation', 'sent', get_permalink()));
        exit;
    }

    // --- LOGIC: Identity Document Handle Karne Ke Liye ---
    if (isset($_POST['neknav_doc_submit'])) {
        $doc_type = sanitize_text_field($_POST['doc_type']);
        $doc_num  = sanitize_text_field($_POST['doc_number']);
        $file_url = '';

        if (!empty($_FILES['doc_file']['name'])) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            $att_id = media_handle_upload('doc_file', 0);
            if (!is_wp_error($att_id)) {
                $file_url = wp_get_attachment_url($att_id);
            }
        }

        $wpdb->insert($wpdb->prefix . 'neknav_documents', [
            'user_id' => $uid,
            'doc_type' => $doc_type,
            'doc_number' => $doc_num,
            'file_url' => $file_url,
            'status' => 'pending',
            'uploaded_at' => current_time('mysql')
        ]);
        
        // --- NAYA: Redirect taaki refresh par duplicate entry na bane ---
        wp_redirect(add_query_arg('doc', 'uploaded', get_permalink()));
        exit;
    }

    // Save profile form (Basic Info)
    if (isset($_POST['neknav_profile_save'])) {
        check_admin_referer('neknav_profile_save', 'nk_profile_nonce');
        $t = $wpdb->prefix . 'neknav_profiles';
        $data = [
            'full_name' => sanitize_text_field($_POST['full_name'] ?? ''),
            'dob'       => sanitize_text_field($_POST['dob'] ?? ''),
            'address'   => sanitize_textarea_field($_POST['address'] ?? ''),
            'city'      => sanitize_text_field($_POST['city'] ?? ''),
            'state'     => sanitize_text_field($_POST['state'] ?? ''),
            'pincode'   => sanitize_text_field($_POST['pincode'] ?? ''),
        ];
        $wpdb->update($t, $data, ['user_id' => $uid]);
        wp_update_user(['ID' => $uid, 'display_name' => $data['full_name']]);
        neknav_update_status($uid);
        
        wp_redirect(get_permalink());
        exit;
    }

    // Profile data refresh
    $p   = neknav_get_profile($uid);
    $pct = neknav_completion($uid);
    $photo_id  = get_user_meta($uid, 'neknav_profile_photo', true);
    $photo_url = $photo_id ? wp_get_attachment_image_url($photo_id, 'thumbnail') : '';
    
    $status_label = [
        'registered'       => ['🔴 Unverified', '#e56b6f', 'Mobile verify karein'],
        'mobile_verified'  => ['🟡 Partially Verified', '#d4a017', 'Profile aur documents complete karein'],
        'profile_complete' => ['🟠 Profile Complete', '#e07b39', 'Documents upload karein'],
        'fully_verified'   => ['✅ Fully Verified', '#40916c', 'Badhaai! Account poora ho gaya'],
    ][$p->status ?? 'registered'] ?? ['🔴 Unverified', '#e56b6f', ''];

    ob_start(); ?>

    <?php if(isset($_GET['donation'])): ?><script>alert('Dhanyawad! Payment details verification ke liye bhej di gayi hai.');</script><?php endif; ?>
    <?php if(isset($_GET['doc'])): ?><script>alert('Document upload ho gaya! Admin verify karega.');</script><?php endif; ?>

    <style>
    /* NekNeev Tree Styles */
    .nk-tree-section { margin-top: 24px; }
    .nkt-stat-row { display: flex; gap: 12px; margin-bottom: 18px; flex-wrap: wrap; }
    .nkt-stat-card { flex:1; min-width:120px; background:#f0faf4; border:1.5px solid #b7e4c7; border-radius:12px; padding:16px; text-align:center; }
    .nkt-sval { font-size:26px; font-weight:800; color:#1b4332; }
    .nkt-slbl { font-size:11px; color:#52b788; font-family:monospace; margin-top:3px; }
    .nkt-tree-box { background:#fafffe; border:1.5px solid #e9f5ee; border-radius:12px; padding:16px; }
    .nkt-empty-tree { text-align:center; padding:30px; color:#74c69d; }
    .nkt-node { display:flex; align-items:center; gap:10px; background:#fff; border:1.5px solid #e9f5ee; border-radius:10px; padding:10px 12px; margin-bottom:8px; flex-wrap:wrap; transition:border-color .2s; }
    .nkt-node:hover { border-color:#52b788; }
    .nkt-av { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:12px; font-family:monospace; flex-shrink:0; }
    .nkt-node-info { flex:1; min-width:0; }
    .nkt-node-name { font-weight:700; color:#1b4332; font-size:14px; }
    .nkt-node-meta { font-size:11px; color:#74c69d; font-family:monospace; margin-top:2px; }
    .nkt-node-right { display:flex; gap:6px; align-items:center; flex-wrap:wrap; flex-shrink:0; }
    .nkt-nbadge { background:#d8f3dc; color:#1b4332; border-radius:20px; padding:2px 10px; font-size:10px; font-weight:800; font-family:monospace; }
    .nkt-nbadge-dk { background:#081c15; color:#52b788; }
    .nkt-nbadge-ok { background:#e8f5e9; color:#1b5e20; }
    .nkt-you-tag { background:#52b788; color:#fff; border-radius:20px; padding:1px 8px; font-size:10px; font-weight:700; font-family:monospace; margin-left:6px; }
    .nkt-tog-btn { background:none; border:none; color:#40916c; font-size:14px; font-weight:700; cursor:pointer; padding:2px 5px; }
    </style>

    <div class="nk-profile-wrap">

        <div class="nk-status-banner" style="border-left:5px solid <?php echo $status_label[1]; ?>">
            <span style="font-size:18px; font-weight:bold; display:block;"><?php echo $status_label[0]; ?></span>
            <small><?php echo $status_label[2]; ?></small>
            <?php if ($p->status === 'registered'): ?>
                <a href="<?php echo home_url('/verify-mobile'); ?>" class="nk-btn nk-btn-sm" style="margin-top:10px;">📱 Mobile Verify Karein</a>
            <?php endif; ?>
        </div>

        <div class="nk-progress-wrap">
            <div style="display:flex;justify-content:space-between;margin-bottom:6px">
                <strong>Profile Completion</strong>
                <strong style="color:#40916c"><?php echo $pct; ?>%</strong>
            </div>
            <div class="nk-progress-bg"><div class="nk-progress-fill" style="width:<?php echo $pct; ?>%"></div></div>
        </div>

        <div class="nk-section" style="background:#f9fbf9; border:1px dashed #40916c; padding: 20px; border-radius: 12px; margin-bottom:25px;">
            <h3 style="margin-top:0;">🏦 Donation & Verification</h3>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; font-size:13px; background:#fff; padding:15px; border-radius:8px; margin-bottom:15px;">
                <span><strong>A/C Holder:</strong> MOHD JUBER</span>
                <span><strong>Bank:</strong> HDFC BANK</span>
                <span><strong>A/C No:</strong> 50200064192660</span>
                <span><strong>IFSC:</strong> HDFC0004661</span>
                <span style="grid-column: span 2;"><strong>UPI ID:</strong> <span style="color:#40916c; font-weight:bold;">9984860273@hdfc</span></span>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom:10px;">
                    <input type="number" name="don_amount" class="nk-input" placeholder="Amount (₹)" required>
                    <input type="text" name="don_txn_id" class="nk-input" placeholder="TXN ID / UTR" required>
                </div>
                <div class="nk-field" style="margin-bottom:10px;">
                    <label style="font-size:12px; font-weight:bold; color:#666;">Payment Screenshot Upload Karein:</label>
                    <input type="file" name="don_proof" accept="image/*" class="nk-input" required>
                </div>
                <button type="submit" name="neknav_donation_submit" class="nk-btn" style="width:100%;">Submit Payment Details</button>
            </form>
        </div>

        <div class="nk-section" style="padding:20px; border:1.5px solid #e9f5ee; border-radius:12px; margin-bottom:25px; background:#fff;">
            <h3>📄 Identity Verification</h3>
            <?php 
            $has_doc = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}neknav_documents WHERE user_id=%d", $uid));
            if ($p->doc_verified): ?>
                <div style="background:#e8f5e9; color:#1b5e20; padding:10px; border-radius:8px;">✅ Identity Verified!</div>
            <?php elseif ($has_doc): ?>
                <div style="background:#fff3e0; color:#e65100; padding:10px; border-radius:8px;">⏳ Document Pending Verification...</div>
            <?php else: ?>
                <form method="post" enctype="multipart/form-data">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:10px;">
                        <select name="doc_type" class="nk-input" required>
                            <option value="aadhar">Aadhaar Card</option>
                            <option value="pan">PAN Card</option>
                        </select>
                        <input type="text" name="doc_number" class="nk-input" placeholder="Card Number" required>
                    </div>
                    <div class="nk-field" style="margin-bottom:10px;">
                        <label style="font-size:12px; font-weight:bold;">Document Image Upload Karein:</label>
                        <input type="file" name="doc_file" accept="image/*" class="nk-input" required>
                    </div>
                    <button type="submit" name="neknav_doc_submit" class="nk-btn">Upload & Verify</button>
                </form>
            <?php endif; ?>
        </div>

        <form method="post" enctype="multipart/form-data" class="nk-profile-form">
            <?php wp_nonce_field('neknav_profile_save', 'nk_profile_nonce'); ?>
            <div class="nk-profile-header">
                <div class="nk-avatar-wrap">
                    <?php if ($photo_url): ?><img src="<?php echo esc_url($photo_url); ?>" class="nk-avatar-img"><?php else: ?><div class="nk-avatar-placeholder"><?php echo mb_substr($user->display_name ?: 'U', 0, 1); ?></div><?php endif; ?>
                    <label class="nk-avatar-edit" for="profile_photo">📷</label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display:none">
                </div>
                <div>
                    <div class="nk-uid">User ID: #<?php echo $uid; ?></div>
                    <div class="nk-ref-code">Referral Code: <strong><?php echo esc_html($p->referral_code ?? ''); ?></strong></div>
                </div>
            </div>

            <div class="nk-section">
                <h3>👤 Basic Information</h3>
                <div class="nk-grid-2">
                    <div class="nk-field"><label>Full Name *</label><input type="text" name="full_name" class="nk-input" value="<?php echo esc_attr($p->full_name ?? $user->display_name); ?>" required></div>
                    <div class="nk-field"><label>Date of Birth *</label><input type="date" name="dob" class="nk-input" value="<?php echo esc_attr($p->dob ?? ''); ?>"></div>
                </div>
                <div class="nk-field"><label>📍 Poora Address *</label><textarea name="address" class="nk-input" rows="2"><?php echo esc_textarea($p->address ?? ''); ?></textarea></div>
                <div class="nk-grid-3">
                    <div class="nk-field"><label>City</label><input type="text" name="city" class="nk-input" value="<?php echo esc_attr($p->city ?? ''); ?>"></div>
                    <div class="nk-field"><label>State</label><input type="text" name="state" class="nk-input" value="<?php echo esc_attr($p->state ?? ''); ?>"></div>
                    <div class="nk-field"><label>PIN</label><input type="text" name="pincode" class="nk-input" value="<?php echo esc_attr($p->pincode ?? ''); ?>"></div>
                </div>
                <button type="submit" name="neknav_profile_save" class="nk-btn nk-btn-full" style="margin-top:15px">💾 Profile Save Karein</button>
            </div>
        </form>

        <div class="nk-section nk-ref-section">
            <h3>🌱 Referral Link</h3>
            <div class="nk-ref-box" style="display:flex; gap:10px; align-items:center;">
                <?php $new_ref_link = home_url('/register/?ref=' . ($p->referral_code ?? '')); ?>
                <span id="nk-ref-url" style="font-family:monospace;"><?php echo esc_html($new_ref_link); ?></span>
                <button onclick="nkCopyRef()" class="nk-btn nk-btn-sm">📋 Copy</button>
            </div>
        </div>

        <div class="nk-section nk-tree-section">
            <h3>🌿 Aapka Referral Tree</h3>
            <?php
                $nkt_direct = (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}neknav_profiles WHERE referred_by=%d", $uid));
                $nkt_all = $wpdb->get_results("SELECT user_id, full_name, referred_by, referral_code, joined_at, doc_verified FROM {$wpdb->prefix}neknav_profiles");
                $nkt_map = [];
                foreach ($nkt_all as $na) $nkt_map[$na->user_id] = ['node'=>$na,'children'=>[]];
                foreach ($nkt_all as $na) { if ($na->referred_by && isset($nkt_map[$na->referred_by])) $nkt_map[$na->referred_by]['children'][] = &$nkt_map[$na->user_id]; }
                function nkt_count_kids($n){$c=0;foreach($n['children']as$ch){$c+=1+nkt_count_kids($ch);}return $c;}
                $nkt_me = $nkt_map[$uid] ?? null;
                $nkt_total = $nkt_me ? nkt_count_kids($nkt_me) : 0;
                
                // --- USER KA TOTAL APPROVED DONATION ---
                $my_total_donated = $wpdb->get_var($wpdb->prepare(
                    "SELECT SUM(amount) FROM {$wpdb->prefix}neknav_donations WHERE user_id = %d AND status = 'approved'", $uid
                )) ?: 0;
            ?>
            <div class="nkt-stat-row">
                <div class="nkt-stat-card"><div class="nkt-sval"><?php echo $nkt_direct; ?></div><div class="nkt-slbl">Direct</div></div>
                <div class="nkt-stat-card"><div class="nkt-sval"><?php echo $nkt_total; ?></div><div class="nkt-slbl">Total Network</div></div>
                <div class="nkt-stat-card"><div class="nkt-sval">₹<?php echo $my_total_donated; ?></div><div class="nkt-slbl">Aapka Total Payment</div></div>
            </div>
            <div class="nkt-tree-box">
                <?php if ($nkt_me && ($nkt_direct > 0 || $nkt_total > 0)): nkt_draw_node($nkt_me, 0, true); else: ?>
                    <p style="text-align:center; padding:20px; color:#74c69d;">Abhi koi referral nahi hai.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="nk-section" style="margin-top:25px; padding:20px; border:1.5px solid #d8f3dc; border-radius:12px; background:#fff;">
            <h3 style="color:#1b4332; margin-top:0;">💰 Aapki Payment History</h3>
            <?php
            $my_donations = $wpdb->get_results($wpdb->prepare(
                "SELECT amount, transaction_id, proof_image, created_at, status FROM {$wpdb->prefix}neknav_donations WHERE user_id = %d ORDER BY created_at DESC", $uid
            ));

            if ($my_donations) : ?>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:13px; min-width:400px;">
                        <thead>
                            <tr style="border-bottom:2px solid #b7e4c7; text-align:left;">
                                <th style="padding:10px;">Date</th>
                                <th style="padding:10px;">Amount</th>
                                <th style="padding:10px;">TXN ID</th>
                                <th style="padding:10px;">Proof</th>
                                <th style="padding:10px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($my_donations as $don) : 
                                $st_clr = ($don->status == 'approved') ? '#40916c' : (($don->status == 'pending') ? '#d4a017' : '#e56b6f');
                            ?>
                            <tr style="border-bottom:1px solid #e9f5ee;">
                                <td style="padding:10px;"><?php echo date('d M Y', strtotime($don->created_at)); ?></td>
                                <td style="padding:10px; font-weight:bold;">₹<?php echo $don->amount; ?></td>
                                <td style="padding:10px; font-family:monospace;"><?php echo $don->transaction_id; ?></td>
                                <td style="padding:10px;">
                                    <?php if($don->proof_image): ?>
                                        <a href="<?php echo esc_url($don->proof_image); ?>" target="_blank" style="color:#40916c; text-decoration:underline;">View Photo</a>
                                    <?php else: ?> - <?php endif; ?>
                                </td>
                                <td style="padding:10px; color:<?php echo $st_clr; ?>; font-weight:bold;"><?php echo ucfirst($don->status); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p style="color:#74c69d; font-style:italic;">Abhi tak koi payment record nahi hai.</p>
            <?php endif; ?>
        </div>

        <div style="text-align:center;margin-top:24px"><a href="<?php echo wp_logout_url(home_url()); ?>" style="color:#e56b6f;">🚪 Logout</a></div>
    </div>

    <script>
    function nkCopyRef() {
        navigator.clipboard.writeText(document.getElementById('nk-ref-url').innerText);
        alert('Copy ho gaya!');
    }
    function nktTog(id) {
        var kids = document.getElementById('nkt-kids-' + id);
        var btn = document.getElementById('nkt-btn-' + id);
        if (kids.style.display === 'none') { kids.style.display = 'block'; btn.innerHTML = '▼'; }
        else { kids.style.display = 'none'; btn.innerHTML = '►'; }
    }
    </script>
    <?php return ob_get_clean();
}