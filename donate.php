<?php
require_once 'header.php';
require_once 'admin-panel/db.php';

// Fetch payment settings from database if available
$stmt = $pdo->query("SELECT setting_key, setting_value FROM custom_settings");
$settings = [];
while ($row = $stmt->fetch()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$upi_id = $settings['upi_id'] ?? 'juber786@hdfc';
$bank_name = $settings['bank_name'] ?? 'HDFC Bank';
$bank_holder = $settings['bank_account_name'] ?? 'MOHD JUBER';
$bank_acc = $settings['bank_account_no'] ?? '50200064192660';
$bank_ifsc = $settings['bank_ifsc'] ?? 'HDFC0004661';
$bank_branch = $settings['bank_branch'] ?? 'HAIDERGARH';
?>

<!-- Google Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* -------------------------------------------------------------
 * PREMIUM DONATION PAGE DESIGN SYSTEM
 * ------------------------------------------------------------- */
.am-donate-page {
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  color: #2b332d;
  background-color: #faf9f6;
  overflow-x: hidden;
}

.am-donate-page * {
  box-sizing: border-box;
}

/* 1. HERO BANNER */
.am-dn-hero {
  position: relative;
  background: linear-gradient(135deg, #0d2616 0%, #153e24 60%, #1b6b3a 100%);
  color: #ffffff;
  padding: 85px 20px 95px;
  text-align: center;
  overflow: hidden;
}

.am-dn-hero::before {
  content: '';
  position: absolute;
  top: -120px;
  right: -120px;
  width: 450px;
  height: 450px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(200, 150, 62, 0.16) 0%, transparent 70%);
  pointer-events: none;
}

.am-dn-hero::after {
  content: '';
  position: absolute;
  bottom: -100px;
  left: -100px;
  width: 400px;
  height: 400px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(27, 107, 58, 0.35) 0%, transparent 70%);
  pointer-events: none;
}

.am-dn-hero-inner {
  max-width: 820px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

/* COMPULSORY COIN STYLES & ANIMATION */
.am-dn-coin-side {
  position: absolute;
  width: 22%;
  max-width: 240px;
  height: auto;
  opacity: 0.22;
  filter: drop-shadow(0 10px 25px rgba(200, 150, 62, 0.45));
  pointer-events: none;
  z-index: 1;
  transition: all 0.5s ease;
}

.am-dn-coin-left {
  left: 2%;
  top: 50%;
  transform: translateY(-50%) rotate(-12deg);
  animation: floatCoinLeft 5s ease-in-out infinite;
}

.am-dn-coin-right {
  right: 2%;
  top: 50%;
  transform: translateY(-50%) scaleX(-1) rotate(12deg);
  animation: floatCoinRight 5s ease-in-out infinite;
}

.am-dn-hero-coin-center {
  margin-bottom: 22px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.am-dn-featured-coin {
  width: 140px;
  height: 140px;
  object-fit: contain;
  filter: drop-shadow(0 12px 28px rgba(200, 150, 62, 0.55));
  animation: floatCoinCenter 4s ease-in-out infinite;
}

@keyframes floatCoinCenter {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(-10px) rotate(3deg); }
}

@keyframes floatCoinLeft {
  0%, 100% { transform: translateY(-50%) rotate(-12deg); }
  50% { transform: translateY(-56%) rotate(-8deg); }
}

@keyframes floatCoinRight {
  0%, 100% { transform: translateY(-50%) scaleX(-1) rotate(12deg); }
  50% { transform: translateY(-56%) scaleX(-1) rotate(8deg); }
}

.am-dn-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(200, 150, 62, 0.18);
  border: 1px solid rgba(200, 150, 62, 0.45);
  color: #e5bc6e;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 7px 22px;
  border-radius: 50px;
  margin-bottom: 22px;
}

.am-dn-hero h1 {
  font-size: clamp(34px, 5.5vw, 54px);
  font-weight: 800;
  color: #ffffff;
  line-height: 1.22;
  margin-bottom: 18px;
  letter-spacing: -0.02em;
}

.am-dn-hero h1 span {
  color: #c8963e;
  font-style: italic;
  font-family: 'Amiri', serif;
  font-weight: 700;
}

.am-dn-hero p {
  font-size: clamp(16px, 2.2vw, 18.5px);
  color: #cce0d3;
  line-height: 1.7;
  max-width: 680px;
  margin: 0 auto 35px;
  font-weight: 400;
}

.am-dn-hero-actions {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.am-dn-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #c8963e, #e2b35c);
  color: #0d2616;
  font-weight: 700;
  font-size: 16px;
  padding: 15px 36px;
  border-radius: 50px;
  text-decoration: none;
  box-shadow: 0 8px 24px rgba(200, 150, 62, 0.35);
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
}

.am-dn-btn-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 30px rgba(200, 150, 62, 0.5);
  color: #0d2616;
}

.am-dn-btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(255, 255, 255, 0.08);
  border: 1.5px solid rgba(255, 255, 255, 0.3);
  color: #ffffff;
  font-weight: 600;
  font-size: 15px;
  padding: 14px 30px;
  border-radius: 50px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.am-dn-btn-outline:hover {
  background: rgba(255, 255, 255, 0.16);
  border-color: #ffffff;
  color: #ffffff;
}

/* 2. STATS STRIP */
.am-dn-stats-strip {
  background: #091c10;
  border-top: 1px solid rgba(200, 150, 62, 0.25);
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
  padding: 24px 20px;
}

.am-dn-stats-grid {
  max-width: 1100px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.am-dn-stat-item {
  text-align: center;
  padding: 10px 16px;
  border-right: 1px solid rgba(255, 255, 255, 0.08);
}

.am-dn-stat-item:last-child {
  border-right: none;
}

.am-dn-stat-num {
  font-size: 32px;
  font-weight: 800;
  color: #c8963e;
  line-height: 1.2;
  margin-bottom: 4px;
}

.am-dn-stat-label {
  font-size: 12.5px;
  color: #9cb8a5;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: 600;
}

/* 3. SECTION COMMONS */
.am-dn-section {
  padding: 80px 20px;
  position: relative;
}

.am-dn-container {
  max-width: 1200px;
  margin: 0 auto;
}

.am-dn-sec-header {
  text-align: center;
  max-width: 700px;
  margin: 0 auto 50px;
}

.am-dn-sec-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #eef6f1;
  color: #1b6b3a;
  border: 1px solid rgba(27, 107, 58, 0.25);
  font-size: 12.5px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 6px 18px;
  border-radius: 50px;
  margin-bottom: 14px;
}

.am-dn-sec-title {
  font-size: clamp(28px, 4vw, 40px);
  font-weight: 800;
  color: #0d2616;
  line-height: 1.25;
  margin-bottom: 14px;
  letter-spacing: -0.02em;
}

.am-dn-sec-sub {
  font-size: 16px;
  color: #5c6860;
  line-height: 1.7;
  margin: 0;
}

/* 4. DONATION PLANS (MAIN CARD) */
.am-dn-main-card {
  background: #ffffff;
  border-radius: 28px;
  box-shadow: 0 16px 50px rgba(13, 38, 22, 0.08);
  border: 1px solid #e7efe9;
  padding: 55px 45px;
  max-width: 960px;
  margin: 0 auto 60px;
  position: relative;
}

.am-dn-plans-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-bottom: 40px;
}

.am-dn-plan-box {
  background: #fafaf8;
  border: 2px solid #e7eee9;
  border-radius: 20px;
  padding: 32px 24px 28px;
  text-align: center;
  transition: all 0.3s ease;
  position: relative;
  display: flex;
  flex-direction: column;
}

.am-dn-plan-box:hover {
  transform: translateY(-6px);
  border-color: #c8963e;
  box-shadow: 0 14px 34px rgba(200, 150, 62, 0.15);
  background: #ffffff;
}

.am-dn-plan-box.featured {
  background: #ffffff;
  border-color: #1b6b3a;
  box-shadow: 0 12px 36px rgba(27, 107, 58, 0.14);
}

.am-dn-plan-ribbon {
  position: absolute;
  top: -13px;
  left: 50%;
  transform: translateX(-50%);
  background: linear-gradient(135deg, #1b6b3a, #268b4f);
  color: #ffffff;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 4px 16px;
  border-radius: 20px;
  white-space: nowrap;
}

.am-dn-plan-type {
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: #1b6b3a;
  margin-bottom: 10px;
}

.am-dn-plan-price {
  font-size: 42px;
  font-weight: 800;
  color: #0d2616;
  line-height: 1;
  margin-bottom: 6px;
}

.am-dn-plan-freq {
  font-size: 14px;
  color: #728276;
  margin-bottom: 14px;
}

.am-dn-plan-desc {
  font-size: 13.5px;
  color: #556258;
  line-height: 1.6;
  margin: 0 0 16px;
}

.am-dn-plan-coin-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #fff9ed;
  border: 1px solid rgba(200, 150, 62, 0.35);
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 11.5px;
  font-weight: 700;
  color: #a67830;
  margin: 0 auto 12px;
}

.am-dn-plan-coin-tag img {
  width: 18px;
  height: 18px;
  object-fit: contain;
}

.am-dn-plan-features {
  list-style: none;
  padding: 0;
  margin: 0 0 20px;
  text-align: left;
  display: flex;
  flex-direction: column;
  gap: 8px;
  border-top: 1px solid #edf2ee;
  padding-top: 16px;
  flex-grow: 1;
}

.am-dn-plan-features li {
  font-size: 12.5px;
  color: #4f5d53;
  display: flex;
  align-items: center;
  gap: 8px;
  line-height: 1.4;
}

.am-dn-plan-features li i {
  color: #1b6b3a;
  font-size: 13px;
  flex-shrink: 0;
}

.am-dn-plan-btn {
  background: #f0f5f2;
  color: #1b6b3a;
  border: 1.5px solid rgba(27, 107, 58, 0.25);
  font-size: 13px;
  font-weight: 700;
  padding: 10px 18px;
  border-radius: 30px;
  cursor: pointer;
  transition: all 0.25s ease;
  width: 100%;
}

.am-dn-plan-btn:hover {
  background: #1b6b3a;
  color: #ffffff;
  border-color: #1b6b3a;
}

.am-dn-plan-box.active-selected {
  border-color: #1b6b3a;
  box-shadow: 0 14px 38px rgba(27, 107, 58, 0.18);
  transform: translateY(-5px);
}

/* RAZORPAY BUTTON CONTAINER */
.am-dn-checkout-box {
  background: #f4f8f5;
  border: 1px dashed #1b6b3a;
  border-radius: 20px;
  padding: 30px;
  text-align: center;
  max-width: 580px;
  margin: 0 auto;
}

.am-dn-checkout-box h4 {
  font-size: 18px;
  font-weight: 700;
  color: #0d2616;
  margin: 0 0 8px;
}

.am-dn-checkout-box p {
  font-size: 14px;
  color: #5f7064;
  margin: 0 0 20px;
}

.am-dn-rzp-btn-wrap {
  margin-bottom: 16px;
}

.am-dn-security-badges {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 18px;
  font-size: 12.5px;
  color: #637769;
  flex-wrap: wrap;
}

.am-dn-security-badges span {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.am-dn-security-badges i {
  color: #1b6b3a;
}

/* 5. UPI & BANK TRANSFER (SIDE BY SIDE) */
.am-dn-payment-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
  max-width: 1000px;
  margin: 0 auto;
}

.am-dn-pay-card {
  background: #ffffff;
  border-radius: 24px;
  padding: 42px 36px;
  border: 1px solid #e7eee9;
  box-shadow: 0 10px 32px rgba(0, 0, 0, 0.05);
  display: flex;
  flex-direction: column;
}

.am-dn-card-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #c8963e;
  margin-bottom: 8px;
}

.am-dn-pay-card h3 {
  font-size: 24px;
  font-weight: 800;
  color: #0d2616;
  margin: 0 0 6px;
}

.am-dn-pay-card p.card-sub {
  font-size: 14px;
  color: #66756b;
  margin: 0 0 24px;
  line-height: 1.5;
}

/* QR Frame */
.am-dn-qr-wrapper {
  background: #fbfbf9;
  border: 2px dashed #c8963e;
  border-radius: 20px;
  padding: 24px;
  text-align: center;
  margin-bottom: 24px;
}

.am-dn-qr-img {
  width: 180px;
  height: 180px;
  object-fit: contain;
  margin: 0 auto 14px;
  display: block;
  border-radius: 12px;
  background: #ffffff;
  padding: 8px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
}

.am-dn-qr-caption {
  font-size: 13px;
  font-weight: 600;
  color: #1b6b3a;
  margin: 0;
}

.am-dn-upi-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-top: auto;
}

.am-dn-upi-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #f7f9f7;
  border: 1px solid #e2ede5;
  border-radius: 12px;
  padding: 12px 16px;
  gap: 10px;
}

.am-dn-upi-name {
  font-size: 13px;
  font-weight: 600;
  color: #2b332d;
  display: flex;
  align-items: center;
  gap: 8px;
}

.am-dn-upi-code {
  font-family: monospace;
  font-size: 13px;
  color: #1b6b3a;
  font-weight: 700;
}

.am-dn-copy-btn {
  background: #eef6f1;
  color: #1b6b3a;
  border: 1px solid rgba(27, 107, 58, 0.3);
  font-size: 12px;
  font-weight: 700;
  padding: 5px 12px;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
  white-space: nowrap;
}

.am-dn-copy-btn:hover {
  background: #1b6b3a;
  color: #ffffff;
}

/* Bank Details Table */
.am-dn-bank-table {
  display: flex;
  flex-direction: column;
  margin-bottom: 24px;
}

.am-dn-bank-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 13px 0;
  border-bottom: 1px solid #edf2ee;
  font-size: 14px;
}

.am-dn-bank-row:last-child {
  border-bottom: none;
}

.am-dn-bank-label {
  color: #728276;
  font-weight: 500;
  width: 120px;
  flex-shrink: 0;
}

.am-dn-bank-val {
  font-weight: 700;
  color: #0d2616;
  text-align: right;
  flex-grow: 1;
  word-break: break-all;
}

.am-dn-bank-val.mono {
  font-family: monospace;
  color: #1b6b3a;
  font-size: 14px;
}

.am-dn-note-box {
  background: #fff9ed;
  border: 1px solid #f2dfba;
  border-radius: 14px;
  padding: 16px 18px;
  font-size: 13px;
  color: #755217;
  line-height: 1.6;
  margin-top: auto;
}

.am-dn-note-box a {
  color: #1b6b3a;
  font-weight: 700;
  text-decoration: underline;
}

/* 6. IMPACT CAUSES GRID */
.am-dn-causes-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 26px;
}

.am-dn-cause-card {
  background: #ffffff;
  border-radius: 20px;
  padding: 34px 28px;
  border: 1px solid #e7eee9;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
  transition: all 0.3s ease;
  position: relative;
}

.am-dn-cause-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(27, 107, 58, 0.1);
  border-color: #c8963e;
}

.am-dn-cause-icon-wrap {
  width: 58px;
  height: 58px;
  border-radius: 16px;
  background: #eef6f1;
  color: #1b6b3a;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  margin-bottom: 20px;
}

.am-dn-cause-card h3 {
  font-size: 21px;
  font-weight: 700;
  color: #0d2616;
  margin: 0 0 10px;
}

.am-dn-cause-card p {
  font-size: 14px;
  color: #5c6860;
  line-height: 1.65;
  margin: 0;
}

/* 7. THREE SIMPLE STEPS */
.am-dn-steps-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
  position: relative;
}

.am-dn-step-box {
  background: #ffffff;
  border-radius: 20px;
  padding: 38px 30px;
  border: 1px solid #edf2ee;
  text-align: center;
  box-shadow: 0 6px 20px rgba(0,0,0,0.04);
  position: relative;
  transition: transform 0.3s ease;
}

.am-dn-step-box:hover {
  transform: translateY(-5px);
}

.am-dn-step-num {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background: linear-gradient(135deg, #1b6b3a, #2a8b50);
  color: #ffffff;
  font-size: 20px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  box-shadow: 0 6px 18px rgba(27, 107, 58, 0.3);
}

.am-dn-step-box h4 {
  font-size: 19px;
  font-weight: 700;
  color: #0d2616;
  margin: 0 0 10px;
}

.am-dn-step-box p {
  font-size: 14px;
  color: #637268;
  line-height: 1.6;
  margin: 0;
}

/* 8. TRUST BANNER */
.am-dn-trust-wrap {
  background: linear-gradient(135deg, #0d2616, #153c22);
  color: #ffffff;
  border-radius: 24px;
  padding: 45px 35px;
  text-align: center;
  margin-top: 50px;
}

.am-dn-trust-wrap h3 {
  font-size: 24px;
  font-weight: 800;
  color: #ffffff;
  margin-bottom: 24px;
}

.am-dn-trust-badges {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.am-dn-trust-item {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(200, 150, 62, 0.35);
  border-radius: 40px;
  padding: 10px 24px;
  font-size: 14px;
  color: #e5bc6e;
  font-weight: 600;
}

/* TOAST NOTIFICATION */
.am-dn-toast {
  position: fixed;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%) translateY(90px);
  background: #0d2616;
  color: #ffffff;
  border: 1.5px solid #c8963e;
  font-size: 13.5px;
  font-weight: 600;
  padding: 12px 28px;
  border-radius: 50px;
  z-index: 9999;
  transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
  pointer-events: none;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.am-dn-toast.show {
  transform: translateX(-50%) translateY(0);
}

/* RESPONSIVE */
@media (max-width: 991px) {
  .am-dn-plans-grid,
  .am-dn-payment-grid,
  .am-dn-steps-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
  .am-dn-stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .am-dn-stat-item:nth-child(2) {
    border-right: none;
  }
  .am-dn-main-card {
    padding: 35px 24px;
  }
}

@media (max-width: 600px) {
  .am-dn-stats-grid {
    grid-template-columns: 1fr;
  }
  .am-dn-stat-item {
    border-right: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }
  .am-dn-stat-item:last-child {
    border-bottom: none;
  }
  .am-dn-hero {
    padding: 60px 18px 70px;
  }
}

/* INTERACTIVE DONATION CALCULATOR & PRESETS */
.am-dn-calc-wrapper {
  margin-top: 36px;
  margin-bottom: 24px;
  background: #ffffff;
  border: 1.5px solid #dce8e0;
  border-radius: 24px;
  padding: 32px 28px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.am-dn-calc-presets {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 22px;
}

.am-preset-btn {
  background: #f7faf8;
  border: 1.5px solid #d3e2d7;
  color: #1b6b3a;
  font-size: 14.5px;
  font-weight: 700;
  padding: 10px 18px;
  border-radius: 50px;
  cursor: pointer;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.am-preset-btn:hover {
  background: #eef6f1;
  border-color: #1b6b3a;
  transform: translateY(-2px);
}

.am-preset-btn.active-preset {
  background: #1b6b3a;
  color: #ffffff;
  border-color: #1b6b3a;
  box-shadow: 0 6px 16px rgba(27, 107, 58, 0.28);
}

.am-preset-btn.active-preset span {
  color: #dceee2 !important;
}

.am-custom-input-box {
  max-width: 420px;
  margin: 0 auto 18px;
  position: relative;
}

.am-custom-input-box .curr-symbol {
  position: absolute;
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 24px;
  font-weight: 800;
  color: #1b6b3a;
  pointer-events: none;
}

.am-custom-input-box input {
  width: 100%;
  font-size: 24px;
  font-weight: 700;
  color: #0d2616;
  padding: 14px 20px 14px 50px;
  border: 2px solid #1b6b3a;
  border-radius: 50px;
  outline: none;
  background: #ffffff;
  box-shadow: 0 4px 16px rgba(27, 107, 58, 0.08);
  transition: all 0.2s;
  box-sizing: border-box;
}

.am-custom-input-box input:focus {
  border-color: #c8963e;
  box-shadow: 0 4px 20px rgba(200, 150, 62, 0.22);
}

#impactOutputBox {
  background: linear-gradient(135deg, #f7faf8 0%, #edf6f0 100%);
  border: 1px solid #d4e5d8;
  border-radius: 16px;
  padding: 16px 22px;
  max-width: 520px;
  margin: 0 auto;
  text-align: center;
  transition: all 0.3s ease;
}

</style>

<div class="am-donate-page">

  <!-- 1. HERO SECTION -->
  <section class="am-dn-hero">
    <!-- Desktop Side Floating 1 Rupee Coins -->
    <img src="wp-content/uploads/2026/04/WhatsApp_Image_2026-03-31_at_1.47.44_PM-removebg-preview-1.png" class="am-dn-coin-side am-dn-coin-left" alt="1 Rupee Coin">
    <img src="wp-content/uploads/2026/04/WhatsApp_Image_2026-03-31_at_1.47.44_PM-removebg-preview-1.png" class="am-dn-coin-side am-dn-coin-right" alt="1 Rupee Coin">

    <div class="am-dn-hero-inner">
      <!-- Centered Featured Coin Badge -->
      <div class="am-dn-hero-coin-center">
        <img src="wp-content/uploads/2026/04/WhatsApp_Image_2026-03-31_at_1.47.44_PM-removebg-preview-1.png" alt="Ek Rupee Rozana Coin" class="am-dn-featured-coin">
      </div>

      <div class="am-dn-badge">
        <i class="fa-solid fa-coins"></i> Ek Rupee Bhi Badal Sakta Hai Zindagi
      </div>
      <h1>Sirf <span>₹1 Rozana</span> Ki Madad Se Bachchon Ko Taleem Dein</h1>
      <p>
        Aapka rozana ka sirf ₹1 donation underprivileged bachchon ki standard school education, books aur zarooratmand parivaaron ke rashan mein lagta hai &mdash; 100% transparent aur direct.
      </p>
      <div class="am-dn-hero-actions">
        <a href="#am-donate-box" class="am-dn-btn-primary">
          <i class="fa-solid fa-heart"></i> ₹30 / Mahina Donate Karein
        </a>
        <a href="#am-upi-box" class="am-dn-btn-outline">
          <i class="fa-solid fa-qrcode"></i> UPI &amp; Bank Transfer
        </a>
      </div>
    </div>
  </section>

  <!-- 2. STATS STRIP -->
  <div class="am-dn-stats-strip">
    <div class="am-dn-stats-grid">
      <div class="am-dn-stat-item">
        <div class="am-dn-stat-num">1,240+</div>
        <div class="am-dn-stat-label">Families Supported</div>
      </div>
      <div class="am-dn-stat-item">
        <div class="am-dn-stat-num">350+</div>
        <div class="am-dn-stat-label">Active Community Donors</div>
      </div>
      <div class="am-dn-stat-item">
        <div class="am-dn-stat-num">₹8 Lakh+</div>
        <div class="am-dn-stat-label">Transparently Invested</div>
      </div>
      <div class="am-dn-stat-item">
        <div class="am-dn-stat-num">100%</div>
        <div class="am-dn-stat-label">Direct Impact &bull; 0% Fee</div>
      </div>
    </div>
  </div>

  <!-- 3. DONATION PLANS & RAZORPAY SECTION -->
  <section class="am-dn-section" id="am-donate-box">
    <div class="am-dn-container">
      <div class="am-dn-sec-header">
        <div class="am-dn-sec-tag"><i class="fa-solid fa-gem"></i> Easy Giving Options</div>
        <h2 class="am-dn-sec-title">Choose Your Contribution Plan</h2>
        <p class="am-dn-sec-sub">Chaahe monthly ho ya one-time, aapki madad kisi zarooratmand bachche ke aane wale kal ko roshan karti hai.</p>
      </div>

      <div class="am-dn-main-card">
        
        <!-- 3 Plan Cards (Interactive) -->
        <div class="am-dn-plans-grid">
          
          <!-- Card 1 -->
          <div class="am-dn-plan-box" onclick="selectPlan(this, 'Monthly')">
            <div class="am-dn-plan-coin-tag">
              <img src="wp-content/uploads/2026/04/WhatsApp_Image_2026-03-31_at_1.47.44_PM-removebg-preview-1.png" alt="1 Rupee">
              <span>₹1 / Day Habit</span>
            </div>
            <div class="am-dn-plan-type">Monthly Support</div>
            <div class="am-dn-plan-price">₹30</div>
            <div class="am-dn-plan-freq">per month (₹1 / day)</div>
            <p class="am-dn-plan-desc">Roz ka sirf ₹1 donation zarooratmand bachon ki kitabein aur stationary ensure karta hai.</p>
            <ul class="am-dn-plan-features">
              <li><i class="fa-solid fa-circle-check"></i> ₹1 daily small donation</li>
              <li><i class="fa-solid fa-circle-check"></i> Monthly impact updates</li>
              <li><i class="fa-solid fa-circle-check"></i> Easy cancel anytime</li>
            </ul>
            <button type="button" class="am-dn-plan-btn">Select Monthly &darr;</button>
          </div>

          <!-- Card 2 (Featured) -->
          <div class="am-dn-plan-box featured active-selected" onclick="selectPlan(this, 'Yearly')">
            <div class="am-dn-plan-ribbon">Most Recommended</div>
            <div class="am-dn-plan-coin-tag" style="background:#eef6f1; border-color:rgba(27,107,58,0.3);">
              <img src="wp-content/uploads/2026/04/WhatsApp_Image_2026-03-31_at_1.47.44_PM-removebg-preview-1.png" alt="1 Rupee">
              <span style="color:#1b6b3a;">365 Days Care</span>
            </div>
            <div class="am-dn-plan-type">Yearly Guardian</div>
            <div class="am-dn-plan-price">₹365</div>
            <div class="am-dn-plan-freq">per year (₹1 / day)</div>
            <p class="am-dn-plan-desc">Poore saal ke liye ek bachche ki school dress, books aur complete basic education sponsor karein.</p>
            <ul class="am-dn-plan-features">
              <li><i class="fa-solid fa-circle-check"></i> 1 Child sponsored for full year</li>
              <li><i class="fa-solid fa-circle-check"></i> School uniform &amp; supplies</li>
              <li><i class="fa-solid fa-circle-check"></i> Annual Sadaqah Jariyah report</li>
            </ul>
            <button type="button" class="am-dn-plan-btn" style="background:#1b6b3a; color:#fff; border-color:#1b6b3a;">Selected Plan &darr;</button>
          </div>

          <!-- Card 3 -->
          <div class="am-dn-plan-box" onclick="selectPlan(this, 'Lifetime')">
            <div class="am-dn-plan-coin-tag">
              <i class="fa-solid fa-star" style="color:#c8963e; font-size:13px;"></i>
              <span>Permanent Impact</span>
            </div>
            <div class="am-dn-plan-type">Lifetime Patron</div>
            <div class="am-dn-plan-price">₹7,786</div>
            <div class="am-dn-plan-freq">One-Time Contribution</div>
            <p class="am-dn-plan-desc">School building classroom, smart blackboard aur furniture ke liye permanent Sadaqah Jariyah fund.</p>
            <ul class="am-dn-plan-features">
              <li><i class="fa-solid fa-circle-check"></i> Permanent classroom infrastructure</li>
              <li><i class="fa-solid fa-circle-check"></i> Patron honors certificate</li>
              <li><i class="fa-solid fa-circle-check"></i> Lifetime Sadaqah Jariyah</li>
            </ul>
            <button type="button" class="am-dn-plan-btn">Select Lifetime &darr;</button>
          </div>

        </div>

        
        <!-- INTERACTIVE DONATION AMOUNT SELECTOR & IMPACT CALCULATOR -->
        <div class="am-dn-calc-wrapper">
          <div style="display:flex; align-items:center; justify-content:center; gap:8px; margin-bottom:8px;">
            <span style="background:#eef6f1; color:#1b6b3a; font-weight:700; font-size:12px; padding:5px 16px; border-radius:20px; text-transform:uppercase; letter-spacing:1px; display:inline-flex; align-items:center; gap:6px;">
              <i class="fa-solid fa-hand-holding-dollar" style="color:#c8963e;"></i> Custom Giving Calculator
            </span>
          </div>
          <h3 style="text-align:center; font-size:22px; font-weight:800; color:#0d2616; margin:0 0 6px;">Select or Enter Any Donation Amount</h3>
          <p style="text-align:center; font-size:13.5px; color:#5f7064; margin:0 auto 22px; max-width:560px;">
            Aap apni marzi se koi bhi raqam donate kar sakte hain. Amount select karein aur dekhein aapka contribution kahan badlaaw laata hai:
          </p>

          <div class="am-dn-calc-presets">
            <button type="button" class="am-preset-btn" onclick="setDonationAmount(30, '₹1 / Day for 1 Month Notebooks & Pen Kit', this)">₹30 <span style="font-size:11.5px; font-weight:500; opacity:0.85;">(₹1/day)</span></button>
            <button type="button" class="am-preset-btn" onclick="setDonationAmount(100, 'Basic Education & Complete Stationery Kit', this)">₹100 <span style="font-size:11.5px; font-weight:500; opacity:0.85;">(Kit)</span></button>
            <button type="button" class="am-preset-btn active-preset" onclick="setDonationAmount(365, 'Full 1-Year Education & Uniform for 1 Child (₹1/day)', this)">₹365 <span style="font-size:11.5px; font-weight:500; opacity:0.85;">(1 Year)</span></button>
            <button type="button" class="am-preset-btn" onclick="setDonationAmount(500, 'Monthly Dry Ration for a Needy Family', this)">₹500 <span style="font-size:11.5px; font-weight:500; opacity:0.85;">(Ration)</span></button>
            <button type="button" class="am-preset-btn" onclick="setDonationAmount(1000, 'Full Schooling Sponsorship for 2 Underprivileged Children', this)">₹1,000</button>
            <button type="button" class="am-preset-btn" onclick="setDonationAmount(7786, 'Classroom Smart Desk & Sadaqah Jariyah Fund', this)">₹7,786 <span style="font-size:11.5px; font-weight:500; opacity:0.85;">(Patron)</span></button>
          </div>

          <div class="am-custom-input-box">
            <span class="curr-symbol">₹</span>
            <input type="number" id="customDonationInput" value="365" min="1" placeholder="Enter amount" oninput="onCustomAmountChange(this.value)">
          </div>

          <!-- Dynamic Live Impact Display -->
          <div id="impactOutputBox">
            <span style="font-size:11.5px; font-weight:700; text-transform:uppercase; color:#c8963e; letter-spacing:1px; display:inline-flex; align-items:center; gap:6px; margin-bottom:4px;">
              <i class="fa-solid fa-sparkles"></i> Direct Impact
            </span>
            <div id="impactOutputText" style="font-size:15px; font-weight:700; color:#154a27; line-height:1.4;">
              Full 1-Year Education &amp; Uniform for 1 Child (₹1/day)
            </div>
            <div id="impactSubNote" style="font-size:12px; color:#607366; margin-top:4px;">
              100% direct relief &bull; No admin deductions &bull; Verified ground work
            </div>
          </div>
        </div>

        <!-- Official Live Razorpay Subscription Button -->
        <div class="am-dn-checkout-box">
          <h4>Secure Instant Online Checkout</h4>
          <p>Credit Card, Debit Card, NetBanking, UPI, aur Wallets supported</p>
          
          <div class="am-dn-rzp-btn-wrap">
            <form>
              <script src="https://cdn.razorpay.com/static/widget/subscription-button.js" data-subscription_button_id="pl_Tu9TZO67rbfjaA" data-button_theme="brand-color" async> </script>
            </form>
          </div>

          <div class="am-dn-security-badges">
            <span><i class="fa-solid fa-lock"></i> 256-Bit SSL Encrypted</span>
            <span><i class="fa-solid fa-shield-halved"></i> PCI-DSS Compliant</span>
            <span><i class="fa-solid fa-calendar-xmark"></i> Cancel Anytime</span>
          </div>
        </div>

      </div>

      <!-- 4. UPI & DIRECT BANK TRANSFER (Side-by-Side) -->
      <div id="am-upi-box" style="padding-top: 20px;">
        <div class="am-dn-sec-header" style="margin-bottom: 40px;">
          <div class="am-dn-sec-tag" style="background:#fff7ea; color:#c8963e; border-color:rgba(200,150,62,0.3);">
            <i class="fa-solid fa-building-columns"></i> Direct Account Transfer
          </div>
          <h2 class="am-dn-sec-title">Ya Seedha UPI / Bank Account Me Bhejein</h2>
          <p class="am-dn-sec-sub">Bina kisi third-party fee ke 100% amount direct Al-Miftah trust ke official bank account me jama hota hai.</p>
        </div>

        <div class="am-dn-payment-grid">
          
          <!-- Left: UPI QR Card -->
          <div class="am-dn-pay-card">
            <div class="am-dn-card-badge"><i class="fa-solid fa-qrcode"></i> Instant UPI Payment</div>
            <h3>Scan Any QR Code</h3>
            <p class="card-sub">Google Pay, PhonePe, Paytm, BHIM ya kisi bhi bank app se scan karke transfer karein.</p>
            
            <div class="am-dn-qr-wrapper">
              <img src="wp-content/uploads/2026/02/10a2deff-1582-40de-b3a8-1bafa05dc615.jpg" alt="Al-Miftah UPI QR Code" class="am-dn-qr-img" onerror="this.src='wp-content/uploads/2026/04/al-miftah-official-logo.png'">
              <p class="am-dn-qr-caption">Scan with any UPI App</p>
            </div>

            <div class="am-dn-upi-list">
              <div class="am-dn-upi-row">
                <span class="am-dn-upi-name"><i class="fa-brands fa-google-pay" style="color:#4285F4; font-size:18px;"></i> GPay / UPI ID</span>
                <span class="am-dn-upi-code"><?= htmlspecialchars($upi_id) ?></span>
                <button class="am-dn-copy-btn" onclick="amCopy('<?= htmlspecialchars($upi_id) ?>', this)">Copy</button>
              </div>
              <div class="am-dn-upi-row">
                <span class="am-dn-upi-name"><i class="fa-solid fa-mobile-screen" style="color:#5f259f; font-size:16px;"></i> PhonePe / Paytm</span>
                <span class="am-dn-upi-code"><?= htmlspecialchars($upi_id) ?></span>
                <button class="am-dn-copy-btn" onclick="amCopy('<?= htmlspecialchars($upi_id) ?>', this)">Copy</button>
              </div>
            </div>
          </div>

          <!-- Right: Official Bank Account Card -->
          <div class="am-dn-pay-card">
            <div class="am-dn-card-badge"><i class="fa-solid fa-landmark"></i> Official Trust Account</div>
            <h3>Bank Account Transfer</h3>
            <p class="card-sub">NEFT, RTGS, IMPS ya NetBanking ke zariye direct transfer karein.</p>
            
            <div class="am-dn-bank-table">
              <div class="am-dn-bank-row">
                <span class="am-dn-bank-label">Bank Name</span>
                <span class="am-dn-bank-val"><?= htmlspecialchars($bank_name) ?></span>
              </div>
              <div class="am-dn-bank-row">
                <span class="am-dn-bank-label">Account Holder</span>
                <span class="am-dn-bank-val"><?= htmlspecialchars($bank_holder) ?></span>
              </div>
              <div class="am-dn-bank-row">
                <span class="am-dn-bank-label">Account Number</span>
                <span class="am-dn-bank-val mono"><?= htmlspecialchars($bank_acc) ?></span>
                <button class="am-dn-copy-btn" style="margin-left: 10px;" onclick="amCopy('<?= htmlspecialchars($bank_acc) ?>', this)">Copy</button>
              </div>
              <div class="am-dn-bank-row">
                <span class="am-dn-bank-label">IFSC Code</span>
                <span class="am-dn-bank-val mono"><?= htmlspecialchars($bank_ifsc) ?></span>
                <button class="am-dn-copy-btn" style="margin-left: 10px;" onclick="amCopy('<?= htmlspecialchars($bank_ifsc) ?>', this)">Copy</button>
              </div>
              <div class="am-dn-bank-row">
                <span class="am-dn-bank-label">Account Type</span>
                <span class="am-dn-bank-val">Current Account</span>
              </div>
              <div class="am-dn-bank-row">
                <span class="am-dn-bank-label">Branch</span>
                <span class="am-dn-bank-val"><?= htmlspecialchars($bank_branch) ?></span>
              </div>
            </div>

            <div class="am-dn-note-box">
              <i class="fa-solid fa-circle-info" style="margin-right: 6px; color:#c8963e;"></i>
              <strong>Zaroori Note:</strong> Bank transfer ke baad receipt ya UTR number hume WhatsApp par ya dashboard me submit karein taaki hum aapko official receipt bhej sakein.<br>
              <div style="margin-top: 8px;">
                <a href="https://wa.me/918840432382?text=Assalam%20o%20Alaikum,%20maine%20Al-Miftah%20me%20donation%20kiya%20hai.%20UTR%20Receipt:" target="_blank"><i class="fa-brands fa-whatsapp"></i> WhatsApp par Receipt Bhejein &rarr;</a>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- 5. WHERE DOES YOUR DONATION GO? -->
  <section class="am-dn-section" style="background:#ffffff; border-top: 1px solid #edf2ee;">
    <div class="am-dn-container">
      <div class="am-dn-sec-header">
        <div class="am-dn-sec-tag"><i class="fa-solid fa-bullseye"></i> Targeted Relief</div>
        <h2 class="am-dn-sec-title">Aapka Donation Kahan Lagta Hai?</h2>
        <p class="am-dn-sec-sub">Al-Miftah ka har program transparently verify kiya jata hai taaki aapka ek ek rupaya sahi haqdaar tak pahuchein.</p>
      </div>

      <div class="am-dn-causes-grid">
        
        <div class="am-dn-cause-card">
          <div class="am-dn-cause-icon-wrap"><i class="fa-solid fa-graduation-cap"></i></div>
          <h3>Child Education</h3>
          <p>Yateem aur be-sahara bachon ke liye school admission fees, uniform, copies aur standard textbooks ka poora kharch.</p>
        </div>

        <div class="am-dn-cause-card">
          <div class="am-dn-cause-icon-wrap" style="background:#fff7ea; color:#c8963e;"><i class="fa-solid fa-school"></i></div>
          <h3>School Building</h3>
          <p>Gramin ilaqon me modern charitable school ki nayi building, clean toilets aur safe learning rooms ki tameer.</p>
        </div>

        <div class="am-dn-cause-card">
          <div class="am-dn-cause-icon-wrap"><i class="fa-solid fa-bowl-rice"></i></div>
          <h3>Monthly Ration</h3>
          <p>Majboor bewa khwateen aur gareeb gharanon ke liye mahina-waar zaroori dry ration aur nutritional support.</p>
        </div>

        <div class="am-dn-cause-card">
          <div class="am-dn-cause-icon-wrap" style="background:#fff7ea; color:#c8963e;"><i class="fa-solid fa-mosque"></i></div>
          <h3>Madarsa &amp; Values</h3>
          <p>Deeni taleem, hifz aur akhlaaqi tarbiyat ke markaz ka intezam taaki bachchon me imandar shakhsiyat bane.</p>
        </div>

      </div>

      <!-- Trust Badges -->
      <div class="am-dn-trust-wrap">
        <h3>Al-Miftah Trust Transparency &amp; Trust</h3>
        <div class="am-dn-trust-badges">
          <div class="am-dn-trust-item"><i class="fa-solid fa-lock"></i> 100% Direct Utilization</div>
          <div class="am-dn-trust-item"><i class="fa-solid fa-receipt"></i> Official Donation Receipt</div>
          <div class="am-dn-trust-item"><i class="fa-solid fa-file-invoice"></i> Regular Audit &amp; Impact Reports</div>
          <div class="am-dn-trust-item"><i class="fa-solid fa-hand-holding-heart"></i> Shariah &amp; Trust Compliant</div>
        </div>
      </div>

    </div>
  </section>

  <!-- 6. THREE SIMPLE STEPS -->
  <section class="am-dn-section" style="background:#faf9f6;">
    <div class="am-dn-container">
      <div class="am-dn-sec-header">
        <div class="am-dn-sec-tag"><i class="fa-solid fa-list-check"></i> Simple Process</div>
        <h2 class="am-dn-sec-title">3 Minute Me Donation Complete Karein</h2>
        <p class="am-dn-sec-sub">Bina kisi pareshani ke simple steps ke zariye apna nek amal anjaam dein.</p>
      </div>

      <div class="am-dn-steps-grid">
        
        <div class="am-dn-step-box">
          <div class="am-dn-step-num">1</div>
          <h4>Plan / Method Select Karein</h4>
          <p>Online Razorpay checkout, Instant UPI QR code ya Direct Bank Transfer me se apna pasandeeda tareeqa chunein.</p>
        </div>

        <div class="am-dn-step-box">
          <div class="am-dn-step-num">2</div>
          <h4>Amount Transfer Karein</h4>
          <p>Apni marzi se koi bhi raqam bina kisi hidden fee ke securely aur direct transfer karein.</p>
        </div>

        <div class="am-dn-step-box">
          <div class="am-dn-step-num">3</div>
          <h4>Instant Receipt Hasil Karein</h4>
          <p>Transaction ID / UTR confirm karein aur apne donation ki official verified digital receipt receive karein.</p>
        </div>

      </div>
    </div>
  </section>

</div>

<!-- Copy Toast Notification -->
<div class="am-dn-toast" id="am-dn-toast"><i class="fa-solid fa-circle-check" style="color:#c8963e; margin-right:6px;"></i> Copied to Clipboard!</div>

<script>
function amCopy(text, btn) {
  navigator.clipboard.writeText(text).then(function() {
    var orig = btn.innerText;
    btn.innerText = 'Copied!';
    btn.style.background = '#1b6b3a';
    btn.style.color = '#ffffff';
    setTimeout(function() {
      btn.innerText = orig;
      btn.style.background = '';
      btn.style.color = '';
    }, 2000);
    
    var t = document.getElementById('am-dn-toast');
    t.classList.add('show');
    setTimeout(function() {
      t.classList.remove('show');
    }, 2500);
  });
}


function setDonationAmount(amt, impactMsg, btn) {
  var input = document.getElementById('customDonationInput');
  if (input) {
    input.value = amt;
  }
  document.querySelectorAll('.am-preset-btn').forEach(function(b) {
    b.classList.remove('active-preset');
  });
  if (btn) {
    btn.classList.add('active-preset');
  }
  updateImpactDisplay(amt, impactMsg);
}

function onCustomAmountChange(val) {
  var amt = parseInt(val, 10) || 0;
  
  // Highlight matching preset button if any
  document.querySelectorAll('.am-preset-btn').forEach(function(b) {
    b.classList.remove('active-preset');
  });

  var msg = '';
  if (amt <= 0) {
    msg = 'Enter any amount to see your direct impact in community welfare.';
  } else if (amt < 30) {
    msg = 'Every single rupee helps buy notebooks, pencils and study aids.';
  } else if (amt < 100) {
    msg = Math.floor(amt) + ' Days of child education covered at ₹1/day!';
  } else if (amt < 365) {
    msg = 'Essential study supplies, school bags &amp; notebook kits for students.';
  } else if (amt < 500) {
    msg = 'Full 1-Year Schooling &amp; uniform sponsorship for 1 child!';
  } else if (amt < 1000) {
    msg = 'Monthly dry ration kit (flour, rice, dal, oil) for a widow-led household.';
  } else if (amt < 5000) {
    msg = Math.floor(amt / 365) + ' Children sponsored for their entire year of education!';
  } else {
    msg = 'Permanent Sadaqah Jariyah: Classroom furniture, clean water &amp; school infrastructure.';
  }

  updateImpactDisplay(amt, msg);
}

function updateImpactDisplay(amt, msg) {
  var txt = document.getElementById('impactOutputText');
  if (txt) {
    txt.innerHTML = msg;
  }
}

function selectPlan(card, planName) {
  document.querySelectorAll('.am-dn-plan-box').forEach(function(b) {
    b.classList.remove('active-selected');
    var btn = b.querySelector('.am-dn-plan-btn');
    if (btn) {
      btn.innerText = 'Select ' + (b.querySelector('.am-dn-plan-type').innerText.split(' ')[0]) + ' ↓';
      btn.style.background = '';
      btn.style.color = '';
      btn.style.borderColor = '';
    }
  });

  card.classList.add('active-selected');
  var activeBtn = card.querySelector('.am-dn-plan-btn');
  if (activeBtn) {
    activeBtn.innerText = 'Selected Plan ↓';
    activeBtn.style.background = '#1b6b3a';
    activeBtn.style.color = '#ffffff';
    activeBtn.style.borderColor = '#1b6b3a';
  }

  // Smooth scroll to checkout box
  var checkoutBox = document.querySelector('.am-dn-checkout-box');
  if (checkoutBox) {
    checkoutBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
}
</script>

<?php require_once 'footer.php'; ?>
