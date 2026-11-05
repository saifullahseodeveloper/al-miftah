<?php
require_once 'admin-panel/db.php';

echo "--- DRIVER IN USE ---\n";
echo $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "\n\n";

echo "--- CAUSES ---\n";
$stmt = $pdo->query("SELECT id, title, category, raised_amount, goal_amount, image_url FROM custom_causes");
$causes = $stmt->fetchAll();
print_r($causes);

echo "\n--- EVENTS ---\n";
$stmt = $pdo->query("SELECT id, title, location, event_date, image_url FROM custom_events");
$events = $stmt->fetchAll();
print_r($events);

echo "\n--- BLOGS ---\n";
$stmt = $pdo->query("SELECT id, title, slug, image_url, created_at FROM custom_blogs");
$blogs = $stmt->fetchAll();
print_r($blogs);

echo "\n--- GALLERY ---\n";
$stmt = $pdo->query("SELECT id, caption, image_url FROM custom_gallery");
$gallery = $stmt->fetchAll();
print_r($gallery);
