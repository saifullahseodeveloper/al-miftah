<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    add_menu_page('NekNeev', '🌱 NekNeev', 'manage_options', 'nk-admin', 'nk_admin_main', 'dashicons-networking', 25);
    add_submenu_page('nk-admin','Overview','📊 Overview','manage_options','nk-admin','nk_admin_main');
    add_submenu_page('nk-admin','Users & Tree','👥 Users','manage_options','nk-users','nk_admin_users');
    add_submenu_page('nk-admin','Transactions','💚 Donations','manage_options','nk-txns','nk_admin_txns');
    add_submenu_page('nk-admin','Documents','📄 Documents','manage_options','nk-docs','nk_admin_docs');
    add_submenu_page('nk-admin','Payment Settings','⚙ Payment Setup','manage_options','nk-payment-settings','nk_payment_settings');
});

function nk_admin_main() {
    global $wpdb;
    $total    = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}nk_profiles");
    $verified = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}nk_profiles WHERE doc_status='approved'");
    $total_d  = $wpdb->get_var("SELECT COALESCE(SUM(amount),0) FROM {$wpdb->prefix}nk_transactions WHERE status='confirmed'");
    $pending  = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}nk_transactions WHERE status='pending'");
    ?>
    <div class="wrap" style="font-family:Georgia,serif">
        <h1 style="color:#1b4332">🌱 NekNeev — Admin Overview</h1>
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin:20px 0">
            <?php foreach ([
                ['👥','Total Members',$total,'#d8f3dc','#1b4332'],
                ['✅','Verified Users',$verified,'#c8e6c9','#1b5e20'],
                ['💚','Total Donated','₹'.number_format($total_d,2),'#e8f5e9','#2e7d32'],
                ['⏳','Pending Txns',$pending,'#fff8e1','#f57f17'],
            ] as $s): ?>
            <div style="background:<?=$s[3]?>;color:<?=$s[4]?>;border-radius:12px;padding:20px;text-align:center;border:1px solid <?=$s[3]?>">
                <div style="font-size:30px"><?=$s[0]?></div>
                <div style="font-size:26px;font-weight:800"><?=$s[2]?></div>
                <div style="font-size:11px;font-family:monospace;letter-spacing:.5px"><?=strtoupper($s[1])?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <p><a href="?page=nk-users" class="button button-primary">👥 Users Dekho</a>&nbsp;
           <a href="?page=nk-txns" class="button button-primary">💚 Donations Dekho</a>&nbsp;
           <a href="?page=nk-payment-settings" class="button">⚙ Payment Setup</a></p>
    </div>
    <?php
}

function nk_admin_users() {
    global $wpdb;
    $profiles = $wpdb->get_results("SELECT p.*, u.user_email FROM {$wpdb->prefix}nk_profiles p LEFT JOIN {$wpdb->users} u ON u.ID=p.user_id ORDER BY p.joined_at DESC");
    // Build tree
    $map = [];
    foreach ($profiles as $p) $map[$p->user_id] = ['n'=>$p,'c'=>[]];
    $roots = [];
    foreach ($profiles as $p) {
        if ($p->referred_by && isset($map[$p->referred_by])) $map[$p->referred_by]['c'][] = &$map[$p->user_id];
        elseif (!$p->referred_by) $roots[] = &$map[$p->user_id];
    }
    function nk_count_tree($node){$c=1;foreach($node['c']as$ch)$c+=nk_count_tree($ch);return $c;}
    ?>
    <div class="wrap" style="font-family:Georgia,serif">
    <h1>👥 Users & Referral Tree</h1>

    <h2>🌿 Referral Tree</h2>
    <div style="background:#fff;border:1px solid #e9f5ee;border-radius:12px;padding:20px;margin-bottom:24px;overflow-x:auto">
        <?php
        function nk_admin_tree_node($node,$lvl=0){
            $p=$node['n'];$n=$p->full_name?:('User #'.$p->user_id);$dc=count($node['c']);$tc=nk_count_tree($node)-1;
            $color=['#2d6a4f','#40916c','#52b788','#74c69d','#95d5b2'][$lvl%5];
            echo "<div style='margin-left:".($lvl*28)."px;margin-bottom:8px;position:relative'>";
            if($lvl>0)echo "<div style='position:absolute;left:-18px;top:20px;width:14px;height:1px;background:#b7e4c7'></div>";
            echo "<div style='display:flex;align-items:center;gap:10px;padding:10px 14px;background:#fff;border:1.5px solid #e9f5ee;border-radius:10px;flex-wrap:wrap'>";
            echo "<div style='width:34px;height:34px;border-radius:50%;background:$color;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:12px;font-family:monospace;flex-shrink:0'>".strtoupper(substr($n,0,2))."</div>";
            echo "<div style='flex:1;min-width:0'><div style='font-weight:700;color:#1b4332'>".esc_html($n)."</div><div style='font-size:11px;color:#74c69d;font-family:monospace'>".esc_html($p->user_email)." | ".esc_html($p->mobile)." | Joined: ".date('d M Y',strtotime($p->joined_at))."</div></div>";
            echo "<div style='display:flex;gap:6px;flex-wrap:wrap'>";
            $dstatus=['none'=>'🔴 Unverified','pending'=>'🟡 Pending','approved'=>'✅ Verified'][$p->doc_status??'none'];
            echo "<span style='background:#d8f3dc;color:#1b4332;border-radius:20px;padding:2px 10px;font-size:11px;font-weight:800'>↳ $dc direct</span>";
            if($tc>0)echo "<span style='background:#081c15;color:#52b788;border-radius:20px;padding:2px 10px;font-size:11px;font-weight:800'>🌱 $tc total</span>";
            echo "<span style='font-size:11px'>$dstatus</span>";
            if($p->total_donated>0)echo "<span style='background:#e8f5e9;color:#1b5e20;border-radius:20px;padding:2px 10px;font-size:11px;font-weight:800'>₹".number_format($p->total_donated,0)."</span>";
            echo "</div></div>";
            if($node['c']){echo "<div style='border-left:2px solid #b7e4c7;margin-left:14px'>";foreach($node['c']as$ch)nk_admin_tree_node($ch,$lvl+1);echo "</div>";}
            echo "</div>";
        }
        foreach($roots as $r) nk_admin_tree_node($r);
        ?>
    </div>

    <h2>📋 User Table</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead><tr>
            <th>ID</th><th>Naam</th><th>Email</th><th>Mobile</th><th>Pincode</th><th>Referred By</th><th>Direct</th><th>Donated</th><th>Doc Status</th><th>Joined</th>
        </tr></thead>
        <tbody>
        <?php foreach ($profiles as $p):
            $dc=$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}nk_profiles WHERE referred_by=%d",$p->user_id));
            $ref=$p->referred_by?$wpdb->get_var($wpdb->prepare("SELECT full_name FROM {$wpdb->prefix}nk_profiles WHERE user_id=%d",$p->referred_by)):null;
        ?>
        <tr>
            <td>#<?=$p->user_id?></td>
            <td><strong><?=esc_html($p->full_name?:'—')?></strong></td>
            <td style="font-size:12px"><?=esc_html($p->user_email)?></td>
            <td style="font-family:monospace"><?=esc_html($p->mobile)?></td>
            <td><?=esc_html($p->pincode)?></td>
            <td style="font-size:12px"><?=$ref?esc_html($ref):'<span style="color:#ccc">Root</span>'?></td>
            <td style="text-align:center"><strong><?=$dc?></strong></td>
            <td><strong>₹<?=number_format($p->total_donated,2)?></strong></td>
            <td><?=['none'=>'🔴 None','pending'=>'🟡 Pending','approved'=>'✅ Verified'][$p->doc_status??'none']?></td>
            <td style="font-size:12px"><?=date('d M Y',strtotime($p->joined_at))?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php
}

function nk_admin_txns() {
    global $wpdb;
    // Handle confirm/reject
    if (isset($_POST['nk_txn_action']) && current_user_can('manage_options')) {
        check_admin_referer('nk_txn_manage');
        $id  = intval($_POST['txn_id']);
        $act = sanitize_text_field($_POST['nk_txn_action']);
        $t   = $wpdb->prefix . 'nk_transactions';
        if ($act === 'confirm') {
            $txn = $wpdb->get_row($wpdb->prepare("SELECT * FROM $t WHERE id=%d", $id));
            $wpdb->update($t, ['status'=>'confirmed','confirmed_at'=>current_time('mysql')], ['id'=>$id]);
            $total = nk_total_donated($txn->user_id);
            $wpdb->update("{$wpdb->prefix}nk_profiles", ['total_donated'=>$total], ['user_id'=>$txn->user_id]);
            echo '<div class="notice notice-success"><p>✅ Confirmed!</p></div>';
        } elseif ($act === 'reject') {
            $wpdb->update($t, ['status'=>'rejected'], ['id'=>$id]);
            echo '<div class="notice notice-warning"><p>Transaction rejected.</p></div>';
        }
    }

    $txns = $wpdb->get_results("SELECT t.*, p.full_name, u.user_email FROM {$wpdb->prefix}nk_transactions t LEFT JOIN {$wpdb->prefix}nk_profiles p ON p.user_id=t.user_id LEFT JOIN {$wpdb->users} u ON u.ID=t.user_id ORDER BY t.created_at DESC LIMIT 200");
    ?>
    <div class="wrap" style="font-family:Georgia,serif">
    <h1>💚 Donations / Transactions</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead><tr>
            <th>ID</th><th>User</th><th>Method</th><th>Amount</th><th>Txn ID / UTR</th><th>Note</th><th>Screenshot</th><th>Status</th><th>Date</th><th>Action</th>
        </tr></thead>
        <tbody>
        <?php foreach ($txns as $t):
            $mc=['gpay'=>'🟢 GPay','phonepe'=>'🟣 PhonePe','upi'=>'🔵 UPI','bank'=>'🏦 Bank','other'=>'💳 Other'][$t->method]??'💳';
        ?>
        <tr>
            <td>#<?=$t->id?></td>
            <td><strong><?=esc_html($t->full_name??'#'.$t->user_id)?></strong><br><small style="color:#888"><?=esc_html($t->user_email)?></small></td>
            <td><?=$mc?></td>
            <td><strong style="color:#1b5e20">₹<?=number_format($t->amount,2)?></strong></td>
            <td style="font-family:monospace;font-size:12px"><?=esc_html($t->txn_id)?></td>
            <td style="font-size:12px"><?=esc_html($t->note)?></td>
            <td><?=$t->screenshot_url?'<a href="'.esc_url($t->screenshot_url).'" target="_blank" class="button button-small">View</a>':'—'?></td>
            <td><?=[
                'pending'  =>'<span style="background:#fff8e1;color:#f57f17;padding:2px 8px;border-radius:20px;font-size:11px">⏳ Pending</span>',
                'confirmed'=>'<span style="background:#e8f5e9;color:#1b5e20;padding:2px 8px;border-radius:20px;font-size:11px">✅ Confirmed</span>',
                'rejected' =>'<span style="background:#fce4ec;color:#c62828;padding:2px 8px;border-radius:20px;font-size:11px">❌ Rejected</span>',
            ][$t->status]?></td>
            <td style="font-size:11px"><?=date('d M Y, H:i',strtotime($t->created_at))?></td>
            <td>
                <?php if ($t->status === 'pending'): ?>
                <form method="post" style="display:inline">
                    <?php wp_nonce_field('nk_txn_manage'); ?>
                    <input type="hidden" name="txn_id" value="<?=$t->id?>">
                    <input type="hidden" name="nk_txn_action" value="confirm">
                    <button class="button button-primary" onclick="return confirm('Confirm karein?')">✅ Confirm</button>
                </form>
                <form method="post" style="display:inline;margin-left:4px">
                    <?php wp_nonce_field('nk_txn_manage'); ?>
                    <input type="hidden" name="txn_id" value="<?=$t->id?>">
                    <input type="hidden" name="nk_txn_action" value="reject">
                    <button class="button" onclick="return confirm('Reject karein?')">❌ Reject</button>
                </form>
                <?php else: echo '—'; endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php
}

function nk_admin_docs() {
    global $wpdb;
    $docs = $wpdb->get_results("SELECT d.*, p.full_name, u.user_email FROM {$wpdb->prefix}nk_docs d LEFT JOIN {$wpdb->prefix}nk_profiles p ON p.user_id=d.user_id LEFT JOIN {$wpdb->users} u ON u.ID=d.user_id ORDER BY d.uploaded_at DESC");
    ?>
    <div class="wrap" style="font-family:Georgia,serif">
    <h1>📄 User Documents</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead><tr><th>User</th><th>Email</th><th>Type</th><th>Number</th><th>Status</th><th>Uploaded</th><th>View</th></tr></thead>
        <tbody>
        <?php foreach ($docs as $d): ?>
        <tr>
            <td><strong><?=esc_html($d->full_name??'#'.$d->user_id)?></strong></td>
            <td><?=esc_html($d->user_email)?></td>
            <td><?=$d->doc_type==='pan'?'🟦 PAN':'🟩 Aadhaar'?></td>
            <td style="font-family:monospace"><?=esc_html($d->doc_number)?></td>
            <td><span style="background:#e8f5e9;color:#1b5e20;padding:2px 8px;border-radius:20px;font-size:11px">✅ <?=ucfirst($d->status)?></span></td>
            <td><?=date('d M Y',strtotime($d->uploaded_at))?></td>
            <td><a href="<?=esc_url($d->file_url)?>" target="_blank" class="button button-small">🔍 View</a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php
}

function nk_payment_settings() {
    if (isset($_POST['nk_pay_save'])) {
        check_admin_referer('nk_pay_save');
        foreach (['nk_gpay_upi','nk_phonepe_upi','nk_upi_id','nk_bank_name','nk_bank_acc','nk_bank_ifsc','nk_bank_holder','nk_bank_branch'] as $opt) {
            update_option($opt, sanitize_text_field($_POST[$opt] ?? ''));
        }
        echo '<div class="notice notice-success"><p>✅ Payment settings saved!</p></div>';
    }
    ?>
    <div class="wrap" style="font-family:Georgia,serif">
    <h1>⚙ Payment Settings</h1>
    <form method="post">
        <?php wp_nonce_field('nk_pay_save'); ?>
        <h2>UPI / Digital Payments</h2>
        <table class="form-table">
            <tr><th>Google Pay UPI ID</th><td><input type="text" name="nk_gpay_upi" class="regular-text" value="<?=esc_attr(get_option('nk_gpay_upi'))?>" placeholder="yourname@okaxis"></td></tr>
            <tr><th>PhonePe UPI ID</th><td><input type="text" name="nk_phonepe_upi" class="regular-text" value="<?=esc_attr(get_option('nk_phonepe_upi'))?>" placeholder="yourname@ybl"></td></tr>
            <tr><th>Generic UPI ID</th><td><input type="text" name="nk_upi_id" class="regular-text" value="<?=esc_attr(get_option('nk_upi_id'))?>" placeholder="charity@upi"></td></tr>
        </table>
        <h2>Bank Transfer Details</h2>
        <table class="form-table">
            <tr><th>Bank Ka Naam</th><td><input type="text" name="nk_bank_name" class="regular-text" value="<?=esc_attr(get_option('nk_bank_name'))?>"></td></tr>
            <tr><th>Account Holder</th><td><input type="text" name="nk_bank_holder" class="regular-text" value="<?=esc_attr(get_option('nk_bank_holder'))?>"></td></tr>
            <tr><th>Account Number</th><td><input type="text" name="nk_bank_acc" class="regular-text" value="<?=esc_attr(get_option('nk_bank_acc'))?>"></td></tr>
            <tr><th>IFSC Code</th><td><input type="text" name="nk_bank_ifsc" class="regular-text" value="<?=esc_attr(get_option('nk_bank_ifsc'))?>"></td></tr>
            <tr><th>Branch</th><td><input type="text" name="nk_bank_branch" class="regular-text" value="<?=esc_attr(get_option('nk_bank_branch'))?>"></td></tr>
        </table>
        <p><input type="submit" name="nk_pay_save" class="button-primary" value="💾 Save Settings"></p>
    </form>
    <div style="background:#f0faf4;border:1.5px solid #b7e4c7;border-radius:10px;padding:16px;max-width:500px;margin-top:20px">
        <strong>📌 Donation Flow:</strong><br>
        User → Donate Page → Method chunen → UPI/Bank details dikhenge → User transfer kare → UTR ID submit kare → Aap confirm karein → User ke dashboard mein "Confirmed" dikhega
    </div>
    </div>
    <?php
}

// Block regular users from WP admin
add_action('admin_init', function () {
    if (is_admin() && !current_user_can('manage_options') && !wp_doing_ajax()) {
        wp_redirect(home_url('/dashboard')); exit;
    }
});
