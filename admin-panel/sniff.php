<?php
require_once 'db.php';

echo "Database Sniffing Analysis:\n\n";

// 1. Check existing wp_ tables
$stmt = $pdo->query("SHOW TABLES LIKE 'wp_%'");
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
echo "WP Tables found: " . count($tables) . "\n";

// 2. Tally post types in wp_posts
try {
    $stmt = $pdo->query("SELECT post_type, post_status, COUNT(*) as count FROM wp_posts GROUP BY post_type, post_status ORDER BY count DESC");
    $types = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "\nWP Post Types Breakdown:\n";
    foreach($types as $row) {
        echo "- {$row['post_type']} ({$row['post_status']}): {$row['count']}\n";
    }
} catch (Exception $e) { echo "Error reading wp_posts\n"; }

// 3. Tally Users
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM wp_users");
    $count = $stmt->fetchColumn();
    echo "\nTotal wp_users: {$count}\n";
} catch (Exception $e) { echo "Error reading wp_users\n"; }

// 4. Check GiveWP meta if present
try {
    $stmt = $pdo->query("SELECT meta_key, COUNT(*) as c FROM wp_postmeta WHERE meta_key LIKE '_give_goal%' GROUP BY meta_key");
    $meta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "\nGiveWP Goal Meta keys:\n";
    foreach($meta as $row) {
        echo "- {$row['meta_key']}: {$row['c']}\n";
    }
} catch (Exception $e) {}

// 5. Tally Neknav Profiles
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM wp_neknav_profiles");
    $count = $stmt->fetchColumn();
    echo "\nTotal wp_neknav_profiles: {$count}\n";
} catch (Exception $e) { echo "Error reading wp_neknav_profiles\n"; }
