<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    add_menu_page('NekNeev Admin', '🌱 NekNeev', 'manage_options', 'neknav-admin', 'neknav_admin_dashboard', 'dashicons-networking', 25);
    add_submenu_page('neknav-admin', 'Users & Tree', '👥 Users & Tree', 'manage_options', 'neknav-admin', 'neknav_admin_dashboard');
    add_submenu_page('neknav-admin', 'Documents', '📄 Documents', 'manage_options', 'neknav-docs', 'neknav_admin_docs');
    add_submenu_page('neknav-admin', 'Donation Requests', '💸 Donations', 'manage_options', 'neknav-donations', 'neknav_admin_donations');
});

function neknav_admin_dashboard() {
    global $wpdb;
    $pt = $wpdb->prefix . 'neknav_profiles';
    $dt = $wpdb->prefix . 'neknav_documents';

    // 1. Action: Approve Payment from Detail Page
    if (isset($_GET['action']) && $_GET['action'] === 'approve_pay' && isset($_GET['pay_id'])) {
        $pay_id = intval($_GET['pay_id']);
        $don = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}neknav_donations WHERE id = %d", $pay_id));
        if ($don && $don->status == 'pending') {
            $p_row = $wpdb->get_row($wpdb->prepare("SELECT total_donated FROM $pt WHERE user_id = %d", $don->user_id));
            $new_amt = ($p_row->total_donated ?? 0) + $don->amount;
            $wpdb->update($pt, ['status' => 'fully_verified', 'total_donated' => $new_amt], ['user_id' => $don->user_id]);
            $wpdb->update($wpdb->prefix . 'neknav_donations', ['status' => 'approved'], ['id' => $pay_id]);
            echo '<div class="notice notice-success is-dismissible"><p>✅ Payment Approved!</p></div>';
        }
    }

    // 2. Action: View Single User Detail Page
    if (isset($_GET['action']) && $_GET['action'] === 'view_user' && isset($_GET['user_id'])) {
        neknav_admin_single_user_view(intval($_GET['user_id']));
        return;
    }

    // 3. Fetch Data for Dashboard
    $profiles = $wpdb->get_results("SELECT p.*, u.user_email, u.display_name FROM $pt p LEFT JOIN {$wpdb->users} u ON u.ID = p.user_id ORDER BY p.joined_at ASC");
    $stats = [
        'total'    => count($profiles),
        'verified' => count(array_filter($profiles, fn($p) => $p->status === 'fully_verified')),
        'mobile'   => count(array_filter($profiles, fn($p) => isset($p->mobile_verified) && $p->mobile_verified)),
        'docs'     => (int)$wpdb->get_var("SELECT COUNT(DISTINCT user_id) FROM $dt"),
    ];

    $users_json = array_map(fn($p) => [
        'id'         => (string)$p->user_id,
        'name'       => $p->full_name ?: ($p->display_name ?: 'User #' . $p->user_id),
        'email'      => $p->user_email,
        'mobile'     => $p->mobile,
        'code'       => $p->referral_code,
        'referredBy' => $p->referred_by ? (string)$p->referred_by : null,
        'joinDate'   => $p->joined_at,
        'status'     => $p->status,
        'pct'        => neknav_completion($p->user_id),
    ], $profiles);

    $json = wp_json_encode(array_values($users_json));
    ?>
    <div style="font-family:Georgia,serif;background:#f0faf4;margin:-20px -20px 0;padding:24px 28px;min-height:100vh">
        <div style="background:linear-gradient(90deg,#1b4332,#2d6a4f);padding:16px 28px;display:flex;align-items:center;justify-content:space-between;margin:-24px -28px 24px;border-radius:0;">
            <div style="display:flex;align-items:center;gap:12px"><span style="font-size:26px">🌱</span><div style="color:#52b788;font-weight:800;font-size:20px">NekNeev Admin</div></div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px">
            <?php foreach ([['👥','Total',$stats['total']],['✅','Verified',$stats['verified']],['📱','Mobile',$stats['mobile']],['📄','Docs',$stats['docs']]] as $s): ?>
            <div style="background:#fff;border-radius:12px;padding:18px;text-align:center;box-shadow:0 1px 6px #0001">
                <div style="font-size:24px;font-weight:800;color:#1b4332"><?php echo $s[2]; ?></div>
                <div style="font-size:10px;color:#74c69d;text-transform:uppercase"><?php echo $s[1]; ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="display:flex;gap:6px;margin-bottom:16px">
            <button onclick="nnTab('tree')" id="tab-tree" class="nn-tab nn-active">🌿 Referral Tree</button>
            <button onclick="nnTab('table')" id="tab-table" class="nn-tab">📋 User Table</button>
        </div>

        <input id="nn-search" oninput="nnSearch(this.value)" placeholder="🔍 Naam, Email ya ID se dhundein..." style="width:100%;padding:12px;border:1.5px solid #b7e4c7;border-radius:8px;margin-bottom:16px;outline:none">

        <div id="nn-tree" style="background:#fff;border-radius:14px;padding:20px;border:1.5px solid #d8f3dc"></div>
        <div id="nn-table" style="display:none;background:#fff;border-radius:14px;overflow:hidden;border:1.5px solid #d8f3dc"></div>
    </div>

    <style>
        .nn-tab{background:#fff;color:#2d6a4f;border:1.5px solid #b7e4c7;border-radius:8px;padding:8px 20px;font-weight:700;cursor:pointer;}
        .nn-active{background:#1b4332!important;color:#52b788!important}
        .nn-node{display:flex;align-items:center;gap:10px;background:#fff;border:1.5px solid #e9f5ee;border-radius:10px;padding:10px 14px;margin-bottom:8px;cursor:pointer;transition:all .2s}
        .nn-node:hover{border-color:#52b788}
        .nn-av{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:11px;flex-shrink:0}
        .nn-u-link { color:#1b4332; text-decoration:none; font-weight:700; border-bottom:1px dashed #52b788; }
    </style>

    <script>
    const NN_USERS = <?php echo $json; ?>;
    const COLORS=['#2d6a4f','#40916c','#1b4332','#74c69d','#52b788','#b5838d','#6d6875','#355070','#d4a017','#e56b6f'];
    const STATUS_LABEL = {registered:'Unverified',mobile_verified:'Mobile ✓',profile_complete:'Profile ✓',fully_verified:'✅ Full'};

    function gc(s){let h=0;for(let c of s)h=c.charCodeAt(0)+((h<<5)-h);return COLORS[Math.abs(h)%COLORS.length];}
    function ini(n){return n.split(' ').map(w=>w[0]||'').slice(0,2).join('').toUpperCase();}
    
    function buildTree(us){
        const m={}; us.forEach(u=>{ m[u.id]={...u,children:[]}; });
        const r=[]; us.forEach(u=>{ if(u.referredBy && m[u.referredBy]) m[u.referredBy].children.push(m[u.id]); else if(!u.referredBy) r.push(m[u.id]); });
        return {roots:r, map:m};
    }

    let TREE = buildTree(NN_USERS), sq = '', openN = {};

    function renderNode(node, lvl){
        const hk = node.children.length > 0;
        const isO = openN[node.id] !== false;
        if(openN[node.id] === undefined) openN[node.id] = lvl < 1;
        
        let h = `<div style="margin-left:${lvl===0?0:28}px;position:relative;">`;
        h += `<div class="nn-node" onclick="window.location.href='admin.php?page=neknav-admin&action=view_user&user_id=${node.id}'">
                <div class="nn-av" style="background:${gc(node.name)}">${ini(node.name)}</div>
                <div style="flex:1">
                    <div style="font-weight:700;font-size:13px">${node.name}</div>
                    <div style="font-size:10px;color:#74c69d">ID: #${node.id} | Code: ${node.code}</div>
                </div>
                ${hk ? `<span onclick="event.stopPropagation();nnTog('${node.id}')" style="font-weight:bold">${isO?'▼':'►'}</span>` : ''}
              </div>`;
        if(isO && hk){
            h += `<div style="border-left:1.5px solid #b7e4c7;margin-left:14px">`;
            node.children.forEach(c => { h += renderNode(c, lvl + 1); });
            h += `</div>`;
        }
        h += `</div>`; return h;
    }

    function renderTree(){
        let h = `<div style="font-weight:700;color:#2d6a4f;margin-bottom:14px">🌿 Referral Tree</div>`;
        TREE.roots.forEach(r => { h += renderNode(r, 0); });
        document.getElementById('nn-tree').innerHTML = h;
    }

    function renderTable(){
        const q = sq.toLowerCase();
        const fl = NN_USERS.filter(u => u.name.toLowerCase().includes(q) || u.email.toLowerCase().includes(q) || u.id.includes(sq));
        let h = `<table style="width:100%;border-collapse:collapse"><thead><tr style="background:#1b4332">
            ${['ID','Naam','Email','Status','Join Date'].map(x=>`<th style="color:#74c69d;padding:12px;text-align:left">${x}</th>`).join('')}
        </tr></thead><tbody>`;
        fl.forEach(u => {
            h += `<tr style="border-bottom:1px solid #e9f5ee">
                <td style="padding:12px">#${u.id}</td>
                <td style="padding:12px"><a href="admin.php?page=neknav-admin&action=view_user&user_id=${u.id}" class="nn-u-link">${u.name}</a></td>
                <td style="padding:12px">${u.email}</td>
                <td style="padding:12px;font-size:11px;font-weight:bold">${STATUS_LABEL[u.status] || u.status}</td>
                <td style="padding:12px">${new Date(u.joinDate).toLocaleDateString()}</td>
            </tr>`;
        });
        h += `</tbody></table>`;
        document.getElementById('nn-table').innerHTML = h;
    }

    function nnTog(id){ openN[id] = !openN[id]; renderTree(); }
    function nnSearch(v){ sq = v; renderTable(); }
    function nnTab(t){
        document.getElementById('nn-tree').style.display = t==='tree'?'block':'none';
        document.getElementById('nn-table').style.display = t==='table'?'block':'none';
        document.getElementById('tab-tree').className = 'nn-tab' + (t==='tree'?' nn-active':'');
        document.getElementById('tab-table').className = 'nn-tab' + (t==='table'?' nn-active':'');
    }
    renderTree(); renderTable();
    </script>
    <?php
}

function neknav_admin_single_user_view($user_id) {
    global $wpdb;
    $p = $wpdb->get_row($wpdb->prepare("SELECT p.*, u.user_email FROM {$wpdb->prefix}neknav_profiles p LEFT JOIN {$wpdb->users} u ON u.ID = p.user_id WHERE p.user_id = %d", $user_id));
    if (!$p) { echo "User record nahi mila."; return; }
    $pct = neknav_completion($user_id);
    ?>
    <div style="font-family:'Lora', Georgia, serif; padding:20px; background:#f0faf4; min-height:100vh;">
        <a href="admin.php?page=neknav-admin" style="display:inline-block; margin-bottom:20px; color:#1b4332; text-decoration:none; font-weight:bold;">⬅ Dashboard Wapas Jayein</a>
        <div style="max-width:850px; margin:0 auto; background:#fff; border-radius:20px; padding:40px; box-shadow:0 4px 24px rgba(0,0,0,0.08); border:1.5px solid #d8f3dc;">
            <h2 style="color:#1b4332; border-bottom:2px solid #e9f5ee; padding-bottom:10px; text-align:center;">👤 User Details: <?php echo esc_html($p->full_name); ?></h2>

            <div style="margin:25px 0;">
                <div style="display:flex; justify-content:space-between; margin-bottom:8px;"><strong>Profile Completion</strong><strong style="color:#40916c;"><?php echo $pct; ?>%</strong></div>
                <div style="height:12px; background:#e9f5ee; border-radius:6px; overflow:hidden;"><div style="width:<?php echo $pct; ?>%; height:100%; background:linear-gradient(90deg, #1b4332, #52b788);"></div></div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:25px;">
                <div style="background:#f9fbf9; padding:20px; border-radius:12px; border:1px solid #d8f3dc;">
                    <h4 style="color:#1b4332; margin:0 0 10px; border-bottom:1px solid #d8f3dc;">📋 Basic Information</h4>
                    <p><strong>Mobile:</strong> <?php echo esc_html($p->mobile); ?></p>
                    <p><strong>Email:</strong> <?php echo esc_html($p->user_email); ?></p>
                    <p><strong>Address:</strong> <?php echo esc_html($p->address); ?></p>
                </div>
                <div style="background:#f9fbf9; padding:20px; border-radius:12px; border:1px solid #d8f3dc;">
                    <h4 style="color:#1b4332; margin:0 0 10px; border-bottom:1px solid #d8f3dc;">🏦 Bank & Account</h4>
                    <p><strong>Bank:</strong> <?php echo esc_html($p->bank_name ?: 'N/A'); ?></p>
                    <p><strong>Ref Code:</strong> <span style="background:#d8f3dc; padding:2px 6px; border-radius:4px;"><?php echo esc_html($p->referral_code); ?></span></p>
                    <p><strong>Status:</strong> <span style="font-weight:bold; color:#40916c;"><?php echo strtoupper($p->status); ?></span></p>
                </div>
            </div>

            <div style="margin-top:30px; padding:20px; border:1.5px solid #d8f3dc; border-radius:12px; background:#fafffe;">
                <h3 style="color:#1b4332; margin-top:0;">🌿 Referral Network (User's Tree)</h3>
                <div id="user-specific-tree"></div>
            </div>

            <div style="margin-top:30px; padding:20px; border:1.5px solid #d8f3dc; border-radius:12px; background:#fff;">
                <h3 style="color:#1b4332; margin-top:0;">💰 Payment History</h3>
                <?php
                $donations = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}neknav_donations WHERE user_id = %d ORDER BY created_at DESC", $user_id));
                if ($donations) : ?>
                    <table style="width:100%; border-collapse:collapse; font-size:13px;">
                        <thead><tr style="border-bottom:2px solid #b7e4c7; text-align:left;"><th style="padding:10px;">Date</th><th style="padding:10px;">Amount</th><th style="padding:10px;">Proof</th><th style="padding:10px;">Status</th><th style="padding:10px;">Action</th></tr></thead>
                        <tbody>
                            <?php foreach ($donations as $don) : $st_clr = ($don->status == 'approved') ? '#40916c' : '#d4a017'; ?>
                            <tr style="border-bottom:1px solid #e9f5ee;">
                                <td style="padding:10px;"><?php echo date('d M Y', strtotime($don->created_at)); ?></td>
                                <td style="padding:10px; font-weight:bold;">₹<?php echo $don->amount; ?></td>
                                <td style="padding:10px;"><a href="<?php echo esc_url($don->proof_image); ?>" target="_blank" style="color:#40916c;">View Photo</a></td>
                                <td style="padding:10px; color:<?php echo $st_clr; ?>; font-weight:bold;"><?php echo ucfirst($don->status); ?></td>
                                <td style="padding:10px;"><?php if($don->status === 'pending'): ?><a href="admin.php?page=neknav-admin&action=approve_pay&pay_id=<?php echo $don->id; ?>&user_id=<?php echo $user_id; ?>" class="button button-primary button-small">Approve Now</a><?php else: ?>Done<?php endif; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : echo "Koi payment nahi hai."; endif; ?>
            </div>
        </div>
    </div>
    <script>
    (function(){
        const allUsers = <?php 
            $all = $wpdb->get_results("SELECT user_id as id, full_name as name, referred_by as referredBy, referral_code as code FROM {$wpdb->prefix}neknav_profiles");
            echo json_encode($all); 
        ?>;
        function build(us, rootId){
            const m={}; us.forEach(u=>{ m[u.id]={...u,children:[]}; });
            us.forEach(u=>{ if(u.referredBy && m[u.referredBy]) m[u.referredBy].children.push(m[u.id]); });
            return m[rootId];
        }
        const userTree = build(allUsers, <?php echo $user_id; ?>);
        function draw(node, lvl){
            if(!node || (lvl > 0 && !node.id)) return '';
            let h = `<div style="margin-left:${lvl > 0 ? 25 : 0}px; border-left:${lvl > 0 ? '1.5px solid #b7e4c7' : 'none'}; padding: 5px 0 5px 15px; position:relative;">`;
            if(lvl > 0) h += `<div style="position:absolute; left:0; top:20px; width:12px; height:1.5px; background:#b7e4c7;"></div>`;
            h += `<div style="background:#fff; border:1px solid #e9f5ee; padding:10px; border-radius:8px; display:inline-block; min-width:200px;">
                    <strong style="color:#1b4332;">${node.name}</strong> <span style="font-size:10px; color:#74c69d;">(ID: #${node.id})</span>
                  </div>`;
            if(node.children && node.children.length > 0){
                node.children.forEach(c => { h += draw(c, lvl + 1); });
            } else if(lvl === 0 && (!node.children || node.children.length === 0)) {
                return '<p style="color:#74c69d; font-style:italic;">Abhi koi referral nahi hai.</p>';
            }
            h += `</div>`; return h;
        }
        document.getElementById('user-specific-tree').innerHTML = draw(userTree, 0);
    })();
    </script>
    <?php
}

function neknav_admin_docs() {
    global $wpdb;
    $dt = $wpdb->prefix . 'neknav_documents';
    $docs = $wpdb->get_results("SELECT d.*, u.display_name FROM $dt d LEFT JOIN {$wpdb->users} u ON u.ID = d.user_id ORDER BY uploaded_at DESC");
    echo '<div class="wrap"><h1>📄 Uploaded Documents</h1><table class="wp-list-table widefat fixed striped"><thead><tr><th>User</th><th>Type</th><th>Status</th><th>Action</th></tr></thead>';
    foreach($docs as $d){ echo "<tr><td>" . esc_html($d->display_name) . "</td><td>".strtoupper($d->doc_type)."</td><td>{$d->status}</td><td><a href='".esc_url($d->file_url)."' target='_blank' class='button'>View</a></td></tr>"; }
    echo '</table></div>';
}

function neknav_admin_donations() {
    global $wpdb;
    $t_donations = $wpdb->prefix . 'neknav_donations';
    $res = $wpdb->get_results("SELECT d.*, u.display_name FROM $t_donations d LEFT JOIN {$wpdb->users} u ON u.ID = d.user_id ORDER BY created_at DESC");
    echo '<div class="wrap"><h1>💸 Donation Requests</h1><table class="wp-list-table widefat fixed striped"><thead><tr><th>User</th><th>Amount</th><th>Status</th></tr></thead>';
    foreach($res as $r){ echo "<tr><td>" . esc_html($r->display_name) . "</td><td>₹{$r->amount}</td><td>" . ucfirst($r->status) . "</td></tr>"; }
    echo '</table></div>';
}