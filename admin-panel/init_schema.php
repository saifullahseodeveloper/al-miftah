<?php
// Database Schema Initialization & Auto-Migrate
function ensure_database_schema($pdo) {
    static $initialized = false;
    if ($initialized) return;
    $initialized = true;

    $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    $auto_inc = ($driver === 'sqlite') ? 'INTEGER PRIMARY KEY AUTOINCREMENT' : 'INT AUTO_INCREMENT PRIMARY KEY';

    // 1. Users Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_users (
        id $auto_inc,
        username VARCHAR(100) NOT NULL UNIQUE,
        email VARCHAR(150) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(20) DEFAULT 'user',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. NekNeev User Profiles Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_user_profiles (
        id $auto_inc,
        user_id INT NOT NULL UNIQUE,
        full_name VARCHAR(150) DEFAULT '',
        mobile VARCHAR(20) DEFAULT '',
        dob DATE DEFAULT NULL,
        address TEXT DEFAULT '',
        city VARCHAR(100) DEFAULT '',
        state VARCHAR(100) DEFAULT '',
        pincode VARCHAR(20) DEFAULT '',
        bank_name VARCHAR(150) DEFAULT '',
        account_number VARCHAR(50) DEFAULT '',
        ifsc VARCHAR(30) DEFAULT '',
        account_holder VARCHAR(150) DEFAULT '',
        referral_code VARCHAR(30) DEFAULT '',
        referred_by INT DEFAULT NULL,
        mobile_verified TINYINT(1) DEFAULT 0,
        profile_complete TINYINT(1) DEFAULT 0,
        doc_verified TINYINT(1) DEFAULT 0,
        total_donated DECIMAL(10,2) DEFAULT 0.00,
        is_locked TINYINT(1) DEFAULT 0,
        status VARCHAR(30) DEFAULT 'registered',
        joined_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Auto-migrate: Add is_locked to custom_user_profiles if missing
    try {
        $pdo->exec("ALTER TABLE custom_user_profiles ADD COLUMN is_locked TINYINT(1) DEFAULT 0");
    } catch (Exception $e) {}

    // 3. NekNeev User KYC Documents Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_user_documents (
        id $auto_inc,
        user_id INT NOT NULL,
        doc_type VARCHAR(20) NOT NULL,
        file_path VARCHAR(255) NOT NULL,
        file_url VARCHAR(500) NOT NULL,
        doc_number VARCHAR(50) DEFAULT '',
        status VARCHAR(20) DEFAULT 'pending',
        uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 4. NekNeev OTP Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_otp (
        id $auto_inc,
        user_id INT NOT NULL,
        mobile VARCHAR(20) NOT NULL,
        otp VARCHAR(10) NOT NULL,
        expires_at DATETIME NOT NULL,
        verified TINYINT(1) DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 5. Causes Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_causes (
        id $auto_inc,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        category VARCHAR(100) DEFAULT 'Education',
        goal_amount DECIMAL(12,2) DEFAULT 0.00,
        raised_amount DECIMAL(12,2) DEFAULT 0.00,
        image_url VARCHAR(500) DEFAULT '',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 6. Donations & Payment Proofs Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_donations (
        id $auto_inc,
        user_id INT DEFAULT NULL,
        donor_name VARCHAR(150) DEFAULT '',
        donor_email VARCHAR(150) DEFAULT '',
        donor_mobile VARCHAR(30) DEFAULT '',
        cause_id INT DEFAULT NULL,
        amount DECIMAL(12,2) NOT NULL,
        transaction_id VARCHAR(100) DEFAULT '',
        proof_image VARCHAR(500) DEFAULT '',
        status VARCHAR(20) DEFAULT 'pending',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 7. Events Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_events (
        id $auto_inc,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        location VARCHAR(255) NOT NULL,
        event_date DATETIME NOT NULL,
        image_url VARCHAR(500) DEFAULT '',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 8. Blogs Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_blogs (
        id $auto_inc,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) DEFAULT '',
        content TEXT NOT NULL,
        image_url VARCHAR(500) DEFAULT '',
        author_id INT DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 9. Gallery Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_gallery (
        id $auto_inc,
        image_url VARCHAR(500) NOT NULL,
        caption VARCHAR(255) DEFAULT '',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 10. Contact Inquiries Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_contacts (
        id $auto_inc,
        name VARCHAR(150) NOT NULL,
        email VARCHAR(150) NOT NULL,
        mobile VARCHAR(30) DEFAULT '',
        subject VARCHAR(255) DEFAULT '',
        message TEXT NOT NULL,
        status VARCHAR(20) DEFAULT 'new',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 11. System Settings Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_settings (
        setting_key VARCHAR(100) PRIMARY KEY,
        setting_value TEXT
    )");

    // Insert Default Admin if not exists
    $stmt = $pdo->prepare("SELECT id FROM custom_users WHERE username = 'admin' OR email = 'admin@almiftah.org'");
    $stmt->execute();
    $admin_existing = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$admin_existing) {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $ins = $pdo->prepare("INSERT INTO custom_users (username, email, password, role) VALUES ('admin', 'admin@almiftah.org', ?, 'admin')");
        $ins->execute([$hash]);
        $admin_id = $pdo->lastInsertId();

        $pins = $pdo->prepare("INSERT INTO custom_user_profiles (user_id, full_name, mobile, referral_code, mobile_verified, profile_complete, doc_verified, status) VALUES (?, 'Trust Administrator', '918840432382', 'NKADMIN', 1, 1, 1, 'fully_verified')");
        $pins->execute([$admin_id]);
    }

    // Insert Real Verified Causes if table is empty
    $count = (int)$pdo->query("SELECT COUNT(*) FROM custom_causes")->fetchColumn();
    if ($count === 0) {
        $causes_data = [
            [
                'title' => 'Ek Charitable School Kholo, Taleem Ka Noor Phelao',
                'description' => 'Ranipur, Haidergarh mein Al-Miftah Educational and Social Charitable Trust ke tehat ghareeb aur mustahiq bachchon ke liye muft charitable school building aur smart classrooms ki tameer ka project. Aapka har rupaya aane wali nasal ki taleem aur Sadaqah Jariyah banta hai.',
                'category' => 'School Construction',
                'goal_amount' => 500000.00,
                'raised_amount' => 185000.00,
                'image_url' => 'wp-content/uploads/2026/04/3D-View-01.jpg-1-scaled.jpeg'
            ],
            [
                'title' => 'Free Islamic & Modern Education for Underprivileged Children',
                'description' => 'Yateem aur be-sahara bachchon ko Hifz-e-Quran, Deeni taleem ke sath sath Computer, Science aur English modern syllabus bilkul muft faraham kiya jata hai. Isme school bag, books aur stationery shamil hain.',
                'category' => 'Child Education',
                'goal_amount' => 350000.00,
                'raised_amount' => 120000.00,
                'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.02-PM-scaled.jpeg'
            ],
            [
                'title' => 'Monthly Dry Ration & Family Food Support Drive',
                'description' => 'Ghareeb, bewa aur majboor parivaaron ke liye mahina-waar zaroori rashan (atta, daal, chawal, tel) ki direct distribution taaki koi bhi parivaar bhookha na soye.',
                'category' => 'Community Relief',
                'goal_amount' => 200000.00,
                'raised_amount' => 95000.00,
                'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.04-PM-scaled.jpeg'
            ]
        ];
        $cins = $pdo->prepare("INSERT INTO custom_causes (title, description, category, goal_amount, raised_amount, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($causes_data as $c) {
            $cins->execute([$c['title'], $c['description'], $c['category'], $c['goal_amount'], $c['raised_amount'], $c['image_url']]);
        }
    }

    // Insert Real Verified Events if table is empty
    $ecount = (int)$pdo->query("SELECT COUNT(*) FROM custom_events")->fetchColumn();
    if ($ecount === 0) {
        $events_data = [
            [
                'title' => 'Annual Admission & Educational Awareness Camp 2026',
                'description' => 'Ghareeb bachchon ke dakhila muhim aur muft taleemi kit distribution par khususi ijlas. Ulema aur education experts ki janib se rehnumai aur registration.',
                'location' => 'Ranipur, Haidergarh, Barabanki (UP)',
                'event_date' => '2026-11-20 10:00:00',
                'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.03-PM-scaled.jpeg'
            ],
            [
                'title' => 'Winter Uniform & Study Supplies Distribution Drive',
                'description' => 'Mustahiq bachchon mein sardiyon ke sweater, shoes, school bag aur syllabus kitabein baantne ki khusoosi drive.',
                'location' => 'Al-Miftah Trust Campus, Ranipur Haidergarh',
                'event_date' => '2026-12-10 11:30:00',
                'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.06-PM-scaled.jpeg'
            ]
        ];
        $eins = $pdo->prepare("INSERT INTO custom_events (title, description, location, event_date, image_url) VALUES (?, ?, ?, ?, ?)");
        foreach ($events_data as $e) {
            $eins->execute([$e['title'], $e['description'], $e['location'], $e['event_date'], $e['image_url']]);
        }
    }

    // Insert Real Verified Blogs if table is empty
    $bcount = (int)$pdo->query("SELECT COUNT(*) FROM custom_blogs")->fetchColumn();
    if ($bcount === 0) {
        $blogs_data = [
            [
                'title' => 'Islam Mein Sadaqah Jariyah Ki Fazilat Aur Taleemi Khidmat',
                'slug' => 'sadaqah-jariyah-taleemi-khidmat',
                'content' => 'Sadaqah Jariyah wo neki hai jiska sawab insan ke marne ke baad bhi hamesha jari rehta hai. Jab aap kisi ghareeb bachche ko taleem dilwate hain ya school / madarse ki building mein hissa lete hain, to wo jab tak padhega aur aage naslon ko sikhayega, uska ajar aapko milta rahega. Al-Miftah Educational Trust is amanat ko poori imandari ke sath zarooratmand bachon tak pahunchata hai.',
                'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.05-PM-scaled.jpeg'
            ],
            [
                'title' => 'Ghareeb Bachchon Ko Taleem Se Aaraasta Karna Hum Sab Ka Farz Hai',
                'slug' => 'taleem-se-aarasta-karna',
                'content' => 'Taleem har bachche ka bunyadi haq hai. Al-Miftah Educational Trust ka maqsad har us bachche tak noor-e-ilm pahunchana hai jo maali tangi ki wajah se school nahi ja pa rahe hain. Hamara mission rural ilaqon mein charitable schooling ke zariye har bachche ko aage badhne ka barabar mauqa dena hai.',
                'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.07-PM-scaled.jpeg'
            ]
        ];
        $bins = $pdo->prepare("INSERT INTO custom_blogs (title, slug, content, image_url) VALUES (?, ?, ?, ?)");
        foreach ($blogs_data as $b) {
            $bins->execute([$b['title'], $b['slug'], $b['content'], $b['image_url']]);
        }
    }

    // Insert Real Verified Gallery if table is empty
    $gcount = (int)$pdo->query("SELECT COUNT(*) FROM custom_gallery")->fetchColumn();
    if ($gcount === 0) {
        $gallery_data = [
            ['image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.02-PM-scaled.jpeg', 'caption' => 'Al-Miftah Educational Trust Community Drive'],
            ['image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.03-PM-scaled.jpeg', 'caption' => 'Students & Community Assembly Session'],
            ['image_url' => 'wp-content/uploads/2026/04/3D-View-01.jpg-1-scaled.jpeg', 'caption' => 'Proposed Charitable School Building Architecture'],
            ['image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.06-PM-scaled.jpeg', 'caption' => 'Ration & Relief Support Distribution']
        ];
        $gins = $pdo->prepare("INSERT INTO custom_gallery (image_url, caption) VALUES (?, ?)");
        foreach ($gallery_data as $g) {
            $gins->execute([$g['image_url'], $g['caption']]);
        }
    }

    // Insert Default SMS Settings
    $sstmt = $pdo->prepare("SELECT setting_value FROM custom_settings WHERE setting_key = 'sms_provider'");
    $sstmt->execute();
    $setting_existing = $sstmt->fetch(PDO::FETCH_ASSOC);
    if (!$setting_existing) {
        $settings = [
            'sms_provider' => 'fast2sms',
            'sms_api_key' => '',
            'sms_sender_id' => 'ALMIFT',
            'sms_test_mode' => '1',
            'upi_id' => 'almiftah@upi',
            'bank_account_name' => 'AL-MIFTAH EDUCATIONAL TRUST',
            'bank_account_no' => '50200088991122',
            'bank_ifsc' => 'HDFC0001234',
            'bank_branch' => 'Haidergarh, Barabanki'
        ];
        $sins = $pdo->prepare("INSERT OR REPLACE INTO custom_settings (setting_key, setting_value) VALUES (?, ?)");
        if ($driver !== 'sqlite') {
            $sins = $pdo->prepare("INSERT INTO custom_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
        }
        foreach ($settings as $k => $v) {
            $sins->execute([$k, $v]);
        }
    }
}
