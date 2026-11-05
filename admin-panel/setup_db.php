<?php
// Database Schema Setup Script
require_once 'db.php';

try {
    // 1. Users Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'user') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Users table created successfully.<br>";

    // Add default admin if not exists
    $stmt = $pdo->prepare("SELECT id FROM custom_users WHERE username = 'admin'");
    $stmt->execute();
    if($stmt->rowCount() == 0) {
        $hashed_password = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->exec("INSERT INTO custom_users (username, email, password, role) VALUES ('admin', 'admin@almiftah.org', '$hashed_password', 'admin')");
        echo "Default admin user created. (User: admin, Pass: admin123)<br>";
    }

    // 2. Events Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        location VARCHAR(255) NOT NULL,
        event_date DATETIME NOT NULL,
        image_path VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Events table created successfully.<br>";

    // 3. Causes Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_causes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        goal_amount DECIMAL(10,2) DEFAULT 0.00,
        raised_amount DECIMAL(10,2) DEFAULT 0.00,
        image_path VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Causes table created successfully.<br>";

    // 4. Blogs Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_blogs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content LONGTEXT NOT NULL,
        image_path VARCHAR(255),
        author_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (author_id) REFERENCES custom_users(id) ON DELETE SET NULL
    )");
    echo "Blogs table created successfully.<br>";

    // 5. Gallery Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_gallery (
        id INT AUTO_INCREMENT PRIMARY KEY,
        image_path VARCHAR(255) NOT NULL,
        caption VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Gallery table created successfully.<br>";

    // --- NEKNAV REPLACEMENT TABLES ---

    // 6. OTP Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_otp (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        mobile VARCHAR(15) NOT NULL,
        otp VARCHAR(6) NOT NULL,
        expires_at DATETIME NOT NULL,
        verified TINYINT(1) DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    echo "OTP table created successfully.<br>";

    // 7. Extended Profiles Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_user_profiles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL UNIQUE,
        full_name VARCHAR(100) DEFAULT '',
        mobile VARCHAR(15) DEFAULT '',
        dob DATE DEFAULT NULL,
        address TEXT DEFAULT '',
        city VARCHAR(60) DEFAULT '',
        state VARCHAR(60) DEFAULT '',
        pincode VARCHAR(10) DEFAULT '',
        bank_name VARCHAR(100) DEFAULT '',
        account_number VARCHAR(30) DEFAULT '',
        ifsc VARCHAR(15) DEFAULT '',
        account_holder VARCHAR(100) DEFAULT '',
        referral_code VARCHAR(20) DEFAULT '',
        referred_by INT DEFAULT NULL,
        mobile_verified TINYINT(1) DEFAULT 0,
        profile_complete TINYINT(1) DEFAULT 0,
        doc_verified TINYINT(1) DEFAULT 0,
        status ENUM('registered','mobile_verified','profile_complete','fully_verified') DEFAULT 'registered',
        joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES custom_users(id) ON DELETE CASCADE
    )");
    echo "User Profiles table created successfully.<br>";

    // 8. Documents Table (KYC)
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_user_documents (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        doc_type ENUM('pan','aadhaar') NOT NULL,
        file_path VARCHAR(255) NOT NULL,
        file_url VARCHAR(500) NOT NULL,
        doc_number VARCHAR(20) DEFAULT '',
        status ENUM('pending','approved','rejected') DEFAULT 'pending',
        uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES custom_users(id) ON DELETE CASCADE
    )");
    echo "User Documents (KYC) table created successfully.<br>";

    echo "<h3>Database Setup Completed Successfully!</h3>";
    echo "<p>Please delete this file for security purposes.</p>";

} catch (PDOException $e) {
    die("Error creating tables: " . $e->getMessage());
}
?>
