<?php
require_once 'admin-panel/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $subject = trim($_POST['subject'] ?? 'Website Inquiry');
    $message = trim($_POST['message'] ?? '');

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO custom_contacts (name, email, mobile, subject, message, status) VALUES (?, ?, ?, ?, ?, 'new')");
        $stmt->execute([$name, $email, $mobile, $subject, $message]);
        header("Location: contact-us.php?sent=1");
        exit();
    } else {
        header("Location: contact-us.php?err=1");
        exit();
    }
} else {
    header("Location: contact-us.php");
    exit();
}
