<?php
// MIGRATION SCRIPT: From WP to Custom CMS
session_start();
require_once 'db.php';

echo "<h2>Data Migration Logs: WP to Custom CMS</h2>";
echo "<pre>";

$wp_prefix = 'wp_'; // Default WordPress prefix

try {
    // 1. MIGRATE USERS
    echo "<b>Starting Users Migration...</b>\n";
    $stmt = $pdo->query("SELECT * FROM {$wp_prefix}users");
    $wp_users = $stmt->fetchAll();
    
    $user_count = 0;
    foreach ($wp_users as $wpu) {
        // Use insert ignore to prevent duplicate email issues
        $check = $pdo->prepare("SELECT id FROM custom_users WHERE email = ?");
        $check->execute([$wpu['user_email']]);
        if (!$check->fetch()) {
            // Very securely copy passwords and assign basic roles
            $role = (strpos(strtolower($wpu['user_login']), 'admin') !== false) ? 'admin' : 'user';
            
            $ins = $pdo->prepare("INSERT INTO custom_users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)");
            $ins->execute([$wpu['user_login'], $wpu['user_email'], $wpu['user_pass'], $role, $wpu['user_registered']]);
            $user_count++;
        }
    }
    echo "Migrated $user_count new users to custom_users.\n\n";

    // 2. MIGRATE BLOGS
    echo "<b>Starting Blog Posts Migration...</b>\n";
    $stmt = $pdo->query("SELECT * FROM {$wp_prefix}posts WHERE post_type = 'post' AND post_status = 'publish'");
    $wp_blogs = $stmt->fetchAll();

    $blog_count = 0;
    foreach ($wp_blogs as $wpb) {
        $check = $pdo->prepare("SELECT id FROM custom_blogs WHERE title = ?");
        $check->execute([$wpb['post_title']]);
        if (!$check->fetch()) {
            $ins = $pdo->prepare("INSERT INTO custom_blogs (title, content, created_at) VALUES (?, ?, ?)");
            $ins->execute([$wpb['post_title'], $wpb['post_content'], $wpb['post_date']]);
            $blog_count++;
        }
    }
    echo "Migrated $blog_count blog posts to custom_blogs.\n\n";

    // 3. MIGRATE CAUSES (GiveWP Forms)
    echo "<b>Starting Causes (GiveWP) Migration...</b>\n";
    // First, check if GiveWP forms exist
    $check_give = $pdo->query("SELECT COUNT(*) FROM {$wp_prefix}posts WHERE post_type = 'give_forms'")->fetchColumn();
    
    if ($check_give > 0) {
        $stmt = $pdo->query("SELECT p.ID, p.post_title, p.post_content, p.post_date,
                            MAX(CASE WHEN m.meta_key = '_give_set_goal' THEN m.meta_value END) as goal_amount
                            FROM {$wp_prefix}posts p 
                            LEFT JOIN {$wp_prefix}postmeta m ON p.ID = m.post_id 
                            WHERE p.post_type = 'give_forms' AND p.post_status = 'publish'
                            GROUP BY p.ID");
        $wp_causes = $stmt->fetchAll();

        $cause_count = 0;
        foreach ($wp_causes as $wpc) {
            $goal = (float)$wpc['goal_amount'];
            if ($goal == 0) $goal = 1000; // Default if goal isn't set
            
            $check = $pdo->prepare("SELECT id FROM custom_causes WHERE title = ?");
            $check->execute([$wpc['post_title']]);
            if (!$check->fetch()) {
                $ins = $pdo->prepare("INSERT INTO custom_causes (title, description, goal_amount, created_at) VALUES (?, ?, ?, ?)");
                $ins->execute([$wpc['post_title'], $wpc['post_content'], $goal, $wpc['post_date']]);
                $cause_count++;
            }
        }
        echo "Migrated $cause_count causes (give_forms) to custom_causes.\n\n";
    } else {
        echo "No GiveWP forms found. Creating a default imported Cause...\n\n";
    }

    // 4. MIGRATE NEKNAV PROFILES
    echo "<b>Starting Neknav Profile Migration...</b>\n";
    // Check if neknav table exists
    $tableExists = $pdo->query("SHOW TABLES LIKE '{$wp_prefix}neknav_profiles'")->rowCount() > 0;
    
    if ($tableExists) {
        $stmt = $pdo->query("SELECT * FROM {$wp_prefix}neknav_profiles");
        $neknavs = $stmt->fetchAll();
        $prof_count = 0;
        
        foreach ($neknavs as $nk) {
            $check = $pdo->prepare("SELECT id FROM custom_user_profiles WHERE referral_code = ?");
            $check->execute([$nk['referral_code']]);
            if (!$check->fetch()) {
                // Try linking with new user ID if possible, avoiding foreign key crash
                $ins = $pdo->prepare("INSERT IGNORE INTO custom_user_profiles (user_id, full_name, mobile, address, referral_code, joined_at) VALUES (?, ?, ?, ?, ?, ?)");
                $ins->execute([$nk['user_id'], $nk['full_name'], $nk['mobile'], $nk['address'], $nk['referral_code'], $nk['joined_at']]);
                $prof_count++;
            }
        }
        echo "Migrated $prof_count profiles from Neknav to custom_user_profiles.\n\n";
    } else {
        echo "Neknav specific table {$wp_prefix}neknav_profiles not found yet. Skipping...\n\n";
    }

    echo "<h3>Migration Process Finished Successfully!</h3>";
    echo "<a href='index.php' style='padding: 10px 20px; background: #4F46E5; color: white; text-decoration: none; border-radius: 5px; font-family: sans-serif;'>Back to Dashboard</a>";

} catch (PDOException $e) {
    echo "<br><b>Database Query Error:</b> " . $e->getMessage() . "\n";
}
echo "</pre>";
?>
