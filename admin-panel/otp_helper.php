<?php
// NekNeev OTP Helper Function

function send_neknav_otp($pdo, $user_id, $mobile) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    
    // Generate 6-digit OTP
    $otp = str_pad((string)rand(100000, 999999), 6, '0', STR_PAD_LEFT);
    $expires = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    // Clear old OTPs for this user
    $del = $pdo->prepare("DELETE FROM custom_otp WHERE user_id = ?");
    $del->execute([$user_id]);

    // Insert new OTP
    $ins = $pdo->prepare("INSERT INTO custom_otp (user_id, mobile, otp, expires_at, verified) VALUES (?, ?, ?, ?, 0)");
    $ins->execute([$user_id, $mobile, $otp, $expires]);

    // Fetch SMS settings
    $settings_rows = $pdo->query("SELECT setting_key, setting_value FROM custom_settings WHERE setting_key LIKE 'sms_%'")->fetchAll();
    $cfg = [];
    foreach ($settings_rows as $row) {
        $cfg[$row['setting_key']] = $row['setting_value'];
    }

    $test_mode = $cfg['sms_test_mode'] ?? '1';
    $provider = $cfg['sms_provider'] ?? 'fast2sms';
    $api_key = $cfg['sms_api_key'] ?? '';

    // If Test Mode is ON, store in session
    if ($test_mode === '1' || empty($api_key)) {
        $_SESSION['neknav_test_otp'] = $otp;
        return [
            'success' => true,
            'test_mode' => true,
            'otp' => $otp
        ];
    }

    // Live Fast2SMS Gateway Integration
    if ($provider === 'fast2sms' && !empty($api_key)) {
        $message = "Al-Miftah NekNeev: Aapka verification OTP hai $otp. Yeh 10 minute tak valid hai.";
        $url = "https://www.fast2sms.com/dev/bulkV2?authorization=" . urlencode($api_key) . "&route=q&message=" . urlencode($message) . "&flash=0&numbers=" . urlencode($mobile);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($res, true);
        return [
            'success' => !empty($data['return']),
            'test_mode' => false,
            'otp' => $otp
        ];
    }

    return ['success' => true, 'test_mode' => true, 'otp' => $otp];
}
