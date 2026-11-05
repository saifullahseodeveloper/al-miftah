<?php
if (!defined('ABSPATH')) exit;

/* ═══════════════════════════════════════════════════════════════════════════
   DONATE PAGE  [nk_donate]
═══════════════════════════════════════════════════════════════════════════ */
add_shortcode('nk_donate', function () {
    if (!is_user_logged_in()) return '<div class="nk-box"><p>Pehle <a href="' . home_url('/login') . '">login</a> karein.</p></div>';

    // Payment settings from admin
    $gpay_upi   = get_option('nk_gpay_upi', '');
    $phonepe_upi= get_option('nk_phonepe_upi', '');
    $upi_id     = get_option('nk_upi_id', '');
    $bank_name  = get_option('nk_bank_name', '');
    $bank_acc   = get_option('nk_bank_acc', '');
    $bank_ifsc  = get_option('nk_bank_ifsc', '');
    $bank_holder= get_option('nk_bank_holder', '');
    $bank_branch= get_option('nk_bank_branch', '');

    ob_start(); ?>
    <div class="nk-donate-page">
        <div class="nk-donate-header">
            <h2>💚 Donate Karein</h2>
            <p>Aapki har ek rupee change laayegi</p>
        </div>

        <div class="nk-pay-methods">
            <!-- Google Pay -->
            <?php if ($gpay_upi): ?>
            <div class="nk-pay-card" onclick="nkShowPay('gpay')">
                <div class="nk-pay-icon">
                    <svg width="40" height="40" viewBox="0 0 48 48"><rect width="48" height="48" rx="10" fill="#fff"/><text y="32" x="4" font-size="14" font-family="Arial" font-weight="bold"><tspan fill="#4285F4">G</tspan><tspan fill="#EA4335">o</tspan><tspan fill="#FBBC05">o</tspan><tspan fill="#4285F4">g</tspan><tspan fill="#34A853">l</tspan><tspan fill="#EA4335">e</tspan></text><text y="45" x="6" font-size="9" font-family="Arial" fill="#555">Pay</text></svg>
                </div>
                <strong>Google Pay</strong>
                <small>UPI se donate karein</small>
            </div>
            <?php endif; ?>

            <!-- PhonePe -->
            <?php if ($phonepe_upi): ?>
            <div class="nk-pay-card" onclick="nkShowPay('phonepe')">
                <div class="nk-pay-icon" style="background:#5f259f;border-radius:10px;padding:6px">
                    <svg width="40" height="40" viewBox="0 0 40 40"><text y="28" x="2" font-size="22" fill="#fff">📱</text></svg>
                </div>
                <strong>PhonePe</strong>
                <small>UPI se donate karein</small>
            </div>
            <?php endif; ?>

            <!-- UPI -->
            <?php if ($upi_id): ?>
            <div class="nk-pay-card" onclick="nkShowPay('upi')">
                <div class="nk-pay-icon">
                    <svg width="40" height="40" viewBox="0 0 60 30"><text y="22" x="0" font-size="18" font-weight="bold" fill="#5f259f">UPI</text></svg>
                </div>
                <strong>Any UPI App</strong>
                <small>BHIM, Paytm, etc.</small>
            </div>
            <?php endif; ?>

            <!-- Bank Transfer -->
            <div class="nk-pay-card" onclick="nkShowPay('bank')">
                <div class="nk-pay-icon" style="font-size:36px">🏦</div>
                <strong>Bank Transfer</strong>
                <small>Direct NEFT/IMPS</small>
            </div>
        </div>

        <!-- GPay Panel -->
        <div id="nk-pay-gpay" class="nk-pay-panel" style="display:none">
            <h3>📱 Google Pay se Donate Karein</h3>
            <div class="nk-upi-detail">
                <div class="nk-upi-id"><span>UPI ID:</span> <strong><?= esc_html($gpay_upi) ?></strong> <button onclick="nkCopy('<?= esc_js($gpay_upi) ?>', this)" class="nk-copy-btn">Copy</button></div>
                <div class="nk-upi-steps">
                    <div>1️⃣ Google Pay app kholein</div>
                    <div>2️⃣ "Send Money" → UPI ID daalo: <strong><?= esc_html($gpay_upi) ?></strong></div>
                    <div>3️⃣ Amount daalo aur send karein</div>
                    <div>4️⃣ Transaction ID note karein</div>
                    <div>5️⃣ Neeche form bharein</div>
                </div>
            </div>
            <?php nk_txn_form('gpay'); ?>
        </div>

        <!-- PhonePe Panel -->
        <div id="nk-pay-phonepe" class="nk-pay-panel" style="display:none">
            <h3>📱 PhonePe se Donate Karein</h3>
            <div class="nk-upi-detail">
                <div class="nk-upi-id"><span>UPI ID:</span> <strong><?= esc_html($phonepe_upi) ?></strong> <button onclick="nkCopy('<?= esc_js($phonepe_upi) ?>', this)" class="nk-copy-btn">Copy</button></div>
                <div class="nk-upi-steps">
                    <div>1️⃣ PhonePe app kholein</div>
                    <div>2️⃣ "Transfer" → UPI ID daalo: <strong><?= esc_html($phonepe_upi) ?></strong></div>
                    <div>3️⃣ Amount daalo aur Pay karein</div>
                    <div>4️⃣ Neeche form bharein</div>
                </div>
            </div>
            <?php nk_txn_form('phonepe'); ?>
        </div>

        <!-- UPI Panel -->
        <div id="nk-pay-upi" class="nk-pay-panel" style="display:none">
            <h3>💳 Kisi Bhi UPI App se Donate Karein</h3>
            <div class="nk-upi-detail">
                <div class="nk-upi-id"><span>UPI ID:</span> <strong><?= esc_html($upi_id) ?></strong> <button onclick="nkCopy('<?= esc_js($upi_id) ?>', this)" class="nk-copy-btn">Copy</button></div>
                <p style="font-size:13px;color:#666">BHIM, Paytm, Amazon Pay — kisi bhi app se use karein</p>
            </div>
            <?php nk_txn_form('upi'); ?>
        </div>

        <!-- Bank Panel -->
        <div id="nk-pay-bank" class="nk-pay-panel" style="display:none">
            <h3>🏦 Bank Transfer se Donate Karein</h3>
            <div class="nk-bank-detail">
                <?php foreach ([
                    ['Bank Ka Naam', $bank_name],
                    ['Account Holder', $bank_holder],
                    ['Account Number', $bank_acc],
                    ['IFSC Code', $bank_ifsc],
                    ['Branch', $bank_branch],
                ] as $row): if (!$row[1]) continue; ?>
                <div class="nk-bank-row">
                    <span><?= esc_html($row[0]) ?></span>
                    <strong><?= esc_html($row[1]) ?></strong>
                    <button onclick="nkCopy('<?= esc_js($row[1]) ?>', this)" class="nk-copy-btn">Copy</button>
                </div>
                <?php endforeach; ?>
                <p class="nk-bank-note">⚠ Transfer ke baad neeche form zaroor bharein taaki aapke account mein donation record ho</p>
            </div>
            <?php nk_txn_form('bank'); ?>
        </div>
    </div>
    <?php return ob_get_clean();
});

function nk_txn_form($method) { ?>
    <div class="nk-txn-form">
        <h4>📋 Transaction Confirm Karein</h4>
        <div class="nk-row-2">
            <div class="nk-field">
                <label>💰 Amount (₹) *</label>
                <input type="number" class="nk-input nk-txn-amount" placeholder="Jaise: 500" min="1">
            </div>
            <div class="nk-field">
                <label>🔢 Transaction / UTR ID *</label>
                <input type="text" class="nk-input nk-txn-id" placeholder="12 digit UTR ya Txn ID">
            </div>
        </div>
        <div class="nk-field">
            <label>📷 Screenshot Upload <small>(optional)</small></label>
            <input type="file" class="nk-input nk-txn-ss" accept="image/*">
        </div>
        <div class="nk-field">
            <label>📝 Note <small>(optional)</small></label>
            <input type="text" class="nk-input nk-txn-note" placeholder="Kuch batana chahte hain?">
        </div>
        <div class="nk-txn-msg"></div>
        <button onclick="nkSubmitTxn(this,'<?= $method ?>')" class="nk-btn nk-btn-full">✅ Submit Donation</button>
    </div>
<?php }

// AJAX: Submit transaction
add_action('wp_ajax_nk_submit_txn', function () {
    check_ajax_referer('nk_nonce','nonce');
    if (!is_user_logged_in()) wp_send_json_error('Login required');
    $uid    = get_current_user_id();
    $amount = floatval($_POST['amount'] ?? 0);
    $txn_id = sanitize_text_field($_POST['txn_id'] ?? '');
    $method = sanitize_text_field($_POST['method'] ?? 'other');
    $note   = sanitize_textarea_field($_POST['note'] ?? '');

    if ($amount <= 0)   wp_send_json_error('Amount daalo!');
    if (!$txn_id)       wp_send_json_error('Transaction ID zaroori hai!');

    // Screenshot upload
    $ss_url = '';
    if (!empty($_FILES['screenshot']['name'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        $_FILES['screenshot']['name'] = 'donation_' . $uid . '_' . time() . '.' . pathinfo($_FILES['screenshot']['name'], PATHINFO_EXTENSION);
        $att = media_handle_upload('screenshot', 0);
        if (!is_wp_error($att)) $ss_url = wp_get_attachment_url($att);
    }

    global $wpdb;
    $wpdb->insert("{$wpdb->prefix}nk_transactions", [
        'user_id'        => $uid,
        'txn_id'         => $txn_id,
        'amount'         => $amount,
        'method'         => in_array($method,['gpay','phonepe','upi','bank']) ? $method : 'other',
        'upi_ref'        => $txn_id,
        'screenshot_url' => $ss_url,
        'note'           => $note,
        'status'         => 'pending',
    ]);

    wp_send_json_success(['msg' => 'Donation submit ho gaya! Admin confirm karne ke baad aapke dashboard mein dikhega.']);
});

// AJAX: Admin confirm transaction
add_action('wp_ajax_nk_confirm_txn', function () {
    if (!current_user_can('manage_options')) wp_send_json_error('Unauthorized');
    check_ajax_referer('nk_nonce','nonce');
    $id     = intval($_POST['id']);
    $action = sanitize_text_field($_POST['txn_action'] ?? '');
    global $wpdb; $t = $wpdb->prefix . 'nk_transactions';
    if ($action === 'confirm') {
        $txn = $wpdb->get_row($wpdb->prepare("SELECT * FROM $t WHERE id=%d",$id));
        $wpdb->update($t, ['status'=>'confirmed','confirmed_at'=>current_time('mysql')], ['id'=>$id]);
        // Update total donated
        $total = nk_total_donated($txn->user_id);
        $wpdb->update("{$wpdb->prefix}nk_profiles", ['total_donated'=>$total], ['user_id'=>$txn->user_id]);
    } else {
        $wpdb->update($t, ['status'=>'rejected'], ['id'=>$id]);
    }
    wp_send_json_success();
});
