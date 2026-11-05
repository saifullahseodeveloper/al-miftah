<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

// Fetch all user profiles for tree building
$profiles = $pdo->query("
    SELECT p.*, u.email as user_email, u.username 
    FROM custom_user_profiles p 
    LEFT JOIN custom_users u ON u.id = p.user_id 
    ORDER BY p.joined_at ASC
")->fetchAll();

$stats = [
    'total'    => count($profiles),
    'verified' => count(array_filter($profiles, fn($p) => $p['status'] === 'fully_verified')),
    'mobile'   => count(array_filter($profiles, fn($p) => !empty($p['mobile_verified']))),
    'docs'     => (int)$pdo->query("SELECT COUNT(DISTINCT user_id) FROM custom_user_documents WHERE status = 'approved'")->fetchColumn(),
];

$users_json = array_map(fn($p) => [
    'id'         => (string)$p['user_id'],
    'name'       => $p['full_name'] ?: ($p['username'] ?: 'User #' . $p['user_id']),
    'email'      => $p['user_email'] ?? '',
    'mobile'     => $p['mobile'] ?? '',
    'code'       => $p['referral_code'] ?? '',
    'referredBy' => !empty($p['referred_by']) ? (string)$p['referred_by'] : null,
    'joinDate'   => $p['joined_at'] ?? '',
    'status'     => $p['status'] ?? 'registered',
], $profiles);

$json = json_encode(array_values($users_json));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al Miftah Referral Tree - Admin CMS</title>
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
        .nn-tab { background:#fff; color:#2d6a4f; border:1.5px solid #b7e4c7; border-radius:8px; padding:8px 20px; font-weight:700; cursor:pointer; }
        .nn-active { background:#1b4332 !important; color:#52b788 !important; }
        .nn-node { display:flex; align-items:center; gap:12px; background:#fff; border:1.5px solid #e9f5ee; border-radius:10px; padding:12px 16px; margin-bottom:8px; cursor:pointer; transition:all .2s; }
        .nn-node:hover { border-color:#52b788; box-shadow:0 2px 10px rgba(0,0,0,0.04); }
        .nn-av { width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:12px; flex-shrink:0; }
        .nn-u-link { color:#1b4332; text-decoration:none; font-weight:700; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header"><i class="fa-solid fa-leaf"></i> Al Miftah CMS</div>
        <ul class="nav-links">
            <li><a href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="users.php"><i class="fa-solid fa-users"></i> Users List</a></li>
            <li><a href="tree.php" class="active"><i class="fa-solid fa-sitemap"></i> Referral Tree</a></li>
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
            <h2 style="font-size:22px; color:#122f2a;">🌱 Al Miftah Referral Network Tree</h2>
            <div style="font-size:14px; font-weight:600; color:#1B6B3A;"><i class="fa-solid fa-user-shield"></i> Admin Panel</div>
        </div>

        <div class="container">
            <!-- Stats -->
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px; margin-bottom:25px;">
                <div style="background:#fff; border-radius:12px; padding:18px; text-align:center; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                    <div style="font-size:26px; font-weight:800; color:#1b4332;"><?= $stats['total'] ?></div>
                    <div style="font-size:11px; color:#74c69d; text-transform:uppercase; font-weight:700;">Total Members</div>
                </div>
                <div style="background:#fff; border-radius:12px; padding:18px; text-align:center; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                    <div style="font-size:26px; font-weight:800; color:#16a34a;"><?= $stats['verified'] ?></div>
                    <div style="font-size:11px; color:#16a34a; text-transform:uppercase; font-weight:700;">Fully Verified</div>
                </div>
                <div style="background:#fff; border-radius:12px; padding:18px; text-align:center; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                    <div style="font-size:26px; font-weight:800; color:#2563eb;"><?= $stats['mobile'] ?></div>
                    <div style="font-size:11px; color:#2563eb; text-transform:uppercase; font-weight:700;">Mobile Verified</div>
                </div>
                <div style="background:#fff; border-radius:12px; padding:18px; text-align:center; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                    <div style="font-size:26px; font-weight:800; color:#d97706;"><?= $stats['docs'] ?></div>
                    <div style="font-size:11px; color:#d97706; text-transform:uppercase; font-weight:700;">Docs Approved</div>
                </div>
            </div>

            <!-- View Toggle & Search -->
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; flex-wrap:wrap; gap:10px;">
                <div style="display:flex; gap:8px;">
                    <button onclick="nnTab('tree')" id="tab-tree" class="nn-tab nn-active">🌿 Visual Tree</button>
                    <button onclick="nnTab('table')" id="tab-table" class="nn-tab">📋 Tabular View</button>
                </div>
                <input id="nn-search" oninput="nnSearch(this.value)" placeholder="🔍 Search name, email, or code..." style="padding:10px 16px; border:1.5px solid #b7e4c7; border-radius:8px; width:300px; outline:none; background:#fff;">
            </div>

            <div id="nn-tree" style="background:#fff; border-radius:14px; padding:25px; border:1.5px solid #d8f3dc; box-shadow:0 4px 15px rgba(0,0,0,0.03);"></div>
            <div id="nn-table" style="display:none; background:#fff; border-radius:14px; overflow:hidden; border:1.5px solid #d8f3dc; box-shadow:0 4px 15px rgba(0,0,0,0.03);"></div>
        </div>
    </div>

    <script>
    const NN_USERS = <?= $json ?>;
    const COLORS=['#2d6a4f','#40916c','#1b4332','#74c69d','#52b788','#b5838d','#355070','#d4a017','#e56b6f'];
    const STATUS_LABEL = {registered:'Unverified', mobile_verified:'Mobile ✓', profile_complete:'Profile ✓', fully_verified:'✅ Full Verified'};

    function gc(s){let h=0;for(let c of (s||''))h=c.charCodeAt(0)+((h<<5)-h);return COLORS[Math.abs(h)%COLORS.length];}
    function ini(n){return (n||'U').split(' ').map(w=>w[0]||'').slice(0,2).join('').toUpperCase();}

    function buildTree(us){
        const m={}; us.forEach(u=>{ m[u.id]={...u,children:[]}; });
        const r=[]; us.forEach(u=>{ if(u.referredBy && m[u.referredBy]) m[u.referredBy].children.push(m[u.id]); else if(!u.referredBy) r.push(m[u.id]); });
        return {roots:r, map:m};
    }

    let TREE = buildTree(NN_USERS), sq = '', openN = {};

    function renderNode(node, lvl){
        const hk = node.children && node.children.length > 0;
        const isO = openN[node.id] !== false;
        if(openN[node.id] === undefined) openN[node.id] = lvl < 2;
        
        let h = `<div style="margin-left:${lvl===0?0:28}px;position:relative;">`;
        if(lvl > 0){
            h += `<div style="position:absolute;left:-18px;top:22px;width:14px;height:2px;background:#b7e4c7"></div>`;
        }
        h += `<div class="nn-node">
                <div class="nn-av" style="background:${gc(node.name)}">${ini(node.name)}</div>
                <div style="flex:1">
                    <div style="font-weight:700;font-size:14px;color:#122f2a;">
                        <a href="user-detail.php?user_id=${node.id}" class="nn-u-link">${node.name}</a>
                        <span style="font-size:11px;color:#888;margin-left:6px;">(#${node.id})</span>
                    </div>
                    <div style="font-size:11.5px;color:#667471;margin-top:2px;">
                        Code: <strong style="color:#1B6B3A;">${node.code || '—'}</strong> | 
                        Mobile: ${node.mobile || '—'} | 
                        Status: <strong style="color:#C8963E;">${STATUS_LABEL[node.status] || node.status}</strong>
                    </div>
                </div>
                ${hk ? `<button onclick="event.stopPropagation();nnTog('${node.id}')" style="background:#e8f5ed;border:none;padding:5px 12px;border-radius:6px;font-weight:bold;color:#1B6B3A;cursor:pointer;">${isO?'▲ Hide':'▼ Downline (' + node.children.length + ')'}</button>` : '<span style="font-size:11px;color:#bbb;font-style:italic;">Direct</span>'}
              </div>`;
        if(isO && hk){
            h += `<div style="border-left:2px solid #b7e4c7;margin-left:17px">`;
            node.children.forEach(c => { h += renderNode(c, lvl + 1); });
            h += `</div>`;
        }
        h += `</div>`; return h;
    }

    function renderTree(){
        if(TREE.roots.length === 0){
            document.getElementById('nn-tree').innerHTML = '<p style="color:#888;text-align:center;padding:30px 0;">Koi user registered nahi hai.</p>';
            return;
        }
        let h = `<div style="font-weight:800;color:#1B6B3A;margin-bottom:15px;font-size:16px;">Root Referral Network</div>`;
        TREE.roots.forEach(r => { h += renderNode(r, 0); });
        document.getElementById('nn-tree').innerHTML = h;
    }

    function renderTable(){
        const q = sq.toLowerCase();
        const fl = NN_USERS.filter(u => u.name.toLowerCase().includes(q) || u.email.toLowerCase().includes(q) || u.id.includes(sq) || (u.code && u.code.toLowerCase().includes(q)));
        let h = `<table style="width:100%;border-collapse:collapse;font-size:14px;"><thead><tr style="background:#1b4332;color:#fff;">
            ${['ID','Name','Email / Mobile','Referral Code','Status','Join Date','Action'].map(x=>`<th style="color:#74c69d;padding:14px;text-align:left">${x}</th>`).join('')}
        </tr></thead><tbody>`;
        fl.forEach(u => {
            h += `<tr style="border-bottom:1px solid #e9f5ee">
                <td style="padding:14px;font-weight:bold;">#${u.id}</td>
                <td style="padding:14px"><a href="user-detail.php?user_id=${u.id}" class="nn-u-link">${u.name}</a></td>
                <td style="padding:14px">${u.email}<br><small style="color:#888;">${u.mobile}</small></td>
                <td style="padding:14px;font-weight:700;color:#1B6B3A;">${u.code || '—'}</td>
                <td style="padding:14px;font-weight:bold;color:#C8963E;">${STATUS_LABEL[u.status] || u.status}</td>
                <td style="padding:14px;color:#888;">${new Date(u.joinDate).toLocaleDateString()}</td>
                <td style="padding:14px;"><a href="user-detail.php?user_id=${u.id}" style="background:#e8f5ed;color:#1B6B3A;padding:6px 12px;border-radius:6px;text-decoration:none;font-weight:700;font-size:12px;">View Details</a></td>
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
</body>
</html>
