const fs = require('fs');
const path = require('path');

const rootDir = path.join(__dirname, '..');

function getHeaderBanner(title, subtitle, icon) {
  return `<?php 
require_once 'header.php'; 
?>
<section class="common-banner" style="position:relative; background:linear-gradient(135deg, #0d2616 0%, #153e24 60%, #1b6b3a 100%); color:#fff; padding:70px 20px 80px; text-align:center;">
    <div class="container" style="max-width:900px; margin:0 auto; position:relative; z-index:2;">
        <span style="display:inline-flex; align-items:center; gap:8px; background:rgba(200,150,62,0.18); border:1px solid rgba(200,150,62,0.45); color:#e5bc6e; font-size:13px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:6px 20px; border-radius:50px; margin-bottom:18px;">
            <i class="${icon}"></i> ${subtitle}
        </span>              
        <h1 style="font-size:clamp(30px, 4.5vw, 46px); font-weight:800; color:#fff; margin:0 0 14px;">${title}</h1>
        <p style="color:#cce0d3; font-size:15px; margin:0 auto; max-width:650px;">Al-Miftah Educational and Social Charitable Trust &bull; Dedicated to Transparency &amp; Social Welfare</p>
    </div>
</section>
`;
}

function getPageWrap(contentHtml) {
  return `
<div style="background-color: #faf9f6; padding: 60px 15px; min-height: 60vh; font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;">
    <div class="container" style="max-width: 960px; margin: 0 auto; background: #ffffff; border-radius: 20px; padding: 45px 40px; box-shadow: 0 4px 25px rgba(0,0,0,0.04); border: 1px solid #e7eee9; color: #2d3731; line-height: 1.8;">
${contentHtml}
    </div>
</div>
<?php require_once 'footer.php'; ?>
`;
}

// 1. terms.php
const termsContent = `
        <div style="border-bottom: 2px solid #eef3ef; padding-bottom: 20px; margin-bottom: 30px;">
            <span style="font-size: 13px; font-weight: 700; color: #c8963e; text-transform: uppercase; letter-spacing: 1px;">Legal Agreement</span>
            <h2 style="font-size: 26px; font-weight: 800; color: #0d2616; margin: 6px 0 0;">Terms and Conditions</h2>
            <p style="font-size: 13px; color: #738478; margin: 4px 0 0;">Last Updated: April 2026</p>
        </div>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">1. Introduction & Acceptance</h3>
        <p>Welcome to the official website of <strong>Al-Miftah Educational and Social Charitable Trust</strong> (<a href="https://al-miftah.org" style="color:#1b6b3a; font-weight:600;">al-miftah.org</a>). By accessing our website, donating, or registering as a member or volunteer, you agree to be bound by these Terms and Conditions and our Privacy Policy.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">2. Nature of the Organization</h3>
        <p>Al-Miftah Educational and Social Charitable Trust is a non-governmental, non-profit charitable trust registered under applicable Indian trust laws, operating for child education, school building, hunger relief, and humanitarian community empowerment.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">3. Voluntary Donations</h3>
        <ul style="padding-left: 20px; margin-bottom: 18px;">
            <li>All donations made through our payment gateways (Razorpay, UPI QR, Direct Bank Transfer, NetBanking) are entirely voluntary.</li>
            <li>Donors must provide accurate and verifiable personal details (Name, Email, Mobile number) for verification and official receipt generation.</li>
            <li>Donations are directed toward charitable relief projects, child education sponsorships, school infrastructure, and community ration drives.</li>
        </ul>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">4. User Conduct & Accounts</h3>
        <p>Users participating in our community network (such as the NekNeev initiative) must provide authentic identity documents when requested for KYC compliance. Misuse of the platform, fraudulent transaction claims, or impersonation will lead to immediate suspension of user privileges and reporting to legal authorities.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">5. Intellectual Property</h3>
        <p>All logos, visual trademarks, content, images, and text displayed on this portal are the sole intellectual property of Al-Miftah Educational and Social Charitable Trust and may not be reproduced without prior written consent.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">6. Governing Law & Jurisdiction</h3>
        <p>These terms and conditions are governed by and construed in accordance with the laws of India. Any legal disputes arising out of the website or transactions shall be subject to the exclusive jurisdiction of the competent courts in Barabanki / Lucknow, Uttar Pradesh, India.</p>

        <div style="background:#f7faf8; border-left:4px solid #1b6b3a; padding:16px 20px; border-radius:0 12px 12px 0; margin-top:35px;">
            <strong style="color:#0d2616;">Contact for Legal Queries:</strong><br>
            Email: <a href="mailto:info@al-miftah.org" style="color:#1b6b3a;">info@al-miftah.org</a> | Helpline: +91 8840432382<br>
            Address: Ranipur, Haidergarh, Barabanki, Uttar Pradesh, India - 225124
        </div>
`;

// 2. privacy-policy.php
const privacyContent = `
        <div style="border-bottom: 2px solid #eef3ef; padding-bottom: 20px; margin-bottom: 30px;">
            <span style="font-size: 13px; font-weight: 700; color: #c8963e; text-transform: uppercase; letter-spacing: 1px;">Data Protection</span>
            <h2 style="font-size: 26px; font-weight: 800; color: #0d2616; margin: 6px 0 0;">Privacy Policy</h2>
            <p style="font-size: 13px; color: #738478; margin: 4px 0 0;">Last Updated: April 2026</p>
        </div>

        <p>At <strong>Al-Miftah Educational and Social Charitable Trust</strong>, protecting your personal privacy is one of our utmost priorities. This Privacy Policy document outlines the types of personal information that is received and collected by our website and how it is protected.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">1. Information We Collect</h3>
        <p>We may collect personal information when you donate, register as a volunteer/member, or submit an inquiry:</p>
        <ul style="padding-left: 20px; margin-bottom: 18px;">
            <li><strong>Personal Contact Information:</strong> Full name, email address, mobile phone number, mailing address, date of birth.</li>
            <li><strong>Payment & Transaction Information:</strong> Amount donated, payment method, bank transaction reference (UTR ID), and payment screenshot proof. (Note: We do not store your confidential debit/credit card numbers or CVV on our servers; payments are processed securely by PCI-DSS certified payment processors such as Razorpay).</li>
            <li><strong>Identity Verification (KYC):</strong> If you participate in our verified community network programs, government-issued ID copies (Aadhaar/PAN) provided voluntarily for statutory verification.</li>
        </ul>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">2. How We Use Your Information</h3>
        <ul style="padding-left: 20px; margin-bottom: 18px;">
            <li>To process your charitable contributions and issue official tax/donation receipts.</li>
            <li>To communicate project impact reports, charity newsletters, and transparent audit updates.</li>
            <li>To verify donor identity and comply with applicable statutory laws and banking regulations in India.</li>
            <li>To improve the security and functionality of our web portal.</li>
        </ul>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">3. Confidentiality & Non-Disclosure</h3>
        <p>We respect your trust. <strong>We strictly do not sell, trade, rent, or lease donor personal information to third-party commercial marketers or marketing agencies.</strong> Your data is accessible solely by authorized trust personnel and our banking/payment service providers solely for payment completion and compliance.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">4. Data Security</h3>
        <p>We implement standard 256-bit SSL encryption, firewall protections, and rigorous server access controls to protect all data submitted on our platform against unauthorized alteration or disclosure.</p>

        <div style="background:#f7faf8; border-left:4px solid #1b6b3a; padding:16px 20px; border-radius:0 12px 12px 0; margin-top:35px;">
            <strong style="color:#0d2616;">Data Protection Officer / Inquiries:</strong><br>
            Email: <a href="mailto:info@al-miftah.org" style="color:#1b6b3a;">info@al-miftah.org</a> | Helpline: +91 8840432382<br>
            Al-Miftah Educational and Social Charitable Trust, Ranipur, Haidergarh, Barabanki, UP - 225124
        </div>
`;

// 3. refund-policy.php
const refundContent = `
        <div style="border-bottom: 2px solid #eef3ef; padding-bottom: 20px; margin-bottom: 30px;">
            <span style="font-size: 13px; font-weight: 700; color: #c8963e; text-transform: uppercase; letter-spacing: 1px;">Contribution Guidelines</span>
            <h2 style="font-size: 26px; font-weight: 800; color: #0d2616; margin: 6px 0 0;">Cancellation and Refund Policy</h2>
            <p style="font-size: 13px; color: #738478; margin: 4px 0 0;">Last Updated: April 2026</p>
        </div>

        <p><strong>Al-Miftah Educational and Social Charitable Trust</strong> is deeply grateful for your generous contributions towards educational sponsorships, student welfare, school construction, and community humanitarian relief.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">1. General Policy on Donations</h3>
        <p>As a registered non-profit charitable trust, all donations made via our website, payment gateways (Razorpay), UPI, or direct bank transfer are voluntary contributions for humanitarian causes. Because donations are immediately deployed for procuring student books, school supplies, food grains, and construction materials, <strong>donations are generally considered non-refundable once an official digital receipt has been issued</strong>.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">2. Exceptions for Genuine Errors & Unauthorized Debits</h3>
        <p>We understand that inadvertent technical or banking errors can occasionally occur. A refund request may be reviewed and considered under the following specific circumstances:</p>
        <ul style="padding-left: 20px; margin-bottom: 18px;">
            <li><strong>Double or Duplicate Deduction:</strong> If your bank account or card was charged twice for the same transaction due to a network or gateway glitch.</li>
            <li><strong>Incorrect Amount Transfer:</strong> If an unintended amount was entered and transferred inadvertently (e.g., typing an extra zero).</li>
            <li><strong>Unauthorized Card Usage:</strong> If your card or payment instrument was used without your authorization and is verified as fraudulent by your issuing bank.</li>
        </ul>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">3. Refund Request Procedure</h3>
        <p>To request a refund for an inadvertent or duplicate donation, the donor must reach out to us within <strong>7 calendar days</strong> of the transaction date. Please submit your request with the following details:</p>
        <ul style="padding-left: 20px; margin-bottom: 18px;">
            <li>Full Name of the Donor</li>
            <li>Date of Transaction &amp; Exact Amount Deducted</li>
            <li>Transaction Reference / Payment ID / Bank UTR Number</li>
            <li>Bank statement excerpt or payment confirmation screenshot showing the duplicate charge</li>
            <li>Reason for the cancellation/refund request</li>
        </ul>
        <p>Please send this information via email to <a href="mailto:info@al-miftah.org" style="color:#1b6b3a; font-weight:700;">info@al-miftah.org</a> or contact our helpline at <strong>+91 8840432382</strong>.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">4. Processing & Timeline</h3>
        <p>Upon receipt of your refund request, our administration team will review the transaction with our payment gateway partner (Razorpay / Bank). If approved, refunds are credited back strictly to the <strong>original payment method / source bank account</strong> used during donation within <strong>5 to 10 working days</strong>. No cash refunds are issued.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">5. Cancellation of Recurring / Monthly Subscriptions</h3>
        <p>Donors who have set up automatic monthly contributions (₹30/month or custom amounts) can cancel their recurring subscription at any time without penalty by contacting our team or using the cancellation link provided in their Razorpay subscription email. Future debits will cease immediately upon cancellation.</p>

        <div style="background:#f7faf8; border-left:4px solid #1b6b3a; padding:16px 20px; border-radius:0 12px 12px 0; margin-top:35px;">
            <strong style="color:#0d2616;">Support & Refund Desk:</strong><br>
            Email: <a href="mailto:info@al-miftah.org" style="color:#1b6b3a;">info@al-miftah.org</a> | Helpline: +91 8840432382<br>
            Al-Miftah Educational and Social Charitable Trust, Ranipur, Haidergarh, Barabanki, Uttar Pradesh - 225124
        </div>
`;

// 4. shipping-policy.php
const shippingContent = `
        <div style="border-bottom: 2px solid #eef3ef; padding-bottom: 20px; margin-bottom: 30px;">
            <span style="font-size: 13px; font-weight: 700; color: #c8963e; text-transform: uppercase; letter-spacing: 1px;">Service Delivery & Fulfillment</span>
            <h2 style="font-size: 26px; font-weight: 800; color: #0d2616; margin: 6px 0 0;">Shipping and Delivery Policy</h2>
            <p style="font-size: 13px; color: #738478; margin: 4px 0 0;">Last Updated: April 2026</p>
        </div>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">1. Nature of Operations</h3>
        <p><strong>Al-Miftah Educational and Social Charitable Trust</strong> is a non-profit humanitarian and educational charitable institution. We do not engage in commercial retail e-commerce or the retail sale of commercial physical merchandise.</p>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">2. Digital Fulfillment (Instant Electronic Delivery)</h3>
        <p>All contributions, donations, and memberships processed through our website are fulfilled digitally:</p>
        <ul style="padding-left: 20px; margin-bottom: 18px;">
            <li><strong>Official Donation Receipts:</strong> Generated and sent digitally to the donor's registered email address and/or WhatsApp phone number immediately after transaction confirmation.</li>
            <li><strong>Membership &amp; Patron Certificates:</strong> Issued electronically within 24 to 48 hours to verified donors and patrons.</li>
            <li><strong>Periodic Impact Reports:</strong> Dispatched via digital newsletters and PDF reports summarizing how your contributions are being utilized in schools, madarsas, and community ration drives.</li>
        </ul>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">3. Physical Delivery of Trust Publications or Receipts (If Requested)</h3>
        <p>In cases where a physical official printed donation receipt, annual souvenir, or honors plaque is requested by a donor:</p>
        <ul style="padding-left: 20px; margin-bottom: 18px;">
            <li><strong>Dispatch Timeline:</strong> Dispatched via registered India Post / Speed Post or reputed courier partners within <strong>3 to 7 working days</strong> from our registered trust office in Barabanki, Uttar Pradesh.</li>
            <li><strong>Delivery Timeline:</strong> Estimated delivery timeline across India is usually between <strong>5 to 10 working days</strong> depending on the destination pin code.</li>
            <li><strong>Shipping Charges:</strong> Physical dispatch of statutory receipts is fulfilled free of charge by the trust.</li>
        </ul>

        <h3 style="font-size: 18px; font-weight: 700; color: #1b6b3a; margin: 24px 0 10px;">4. Exchange Policy</h3>
        <p>Since our operations consist of voluntary charitable contributions, humanitarian sponsorships, and non-profit services, product replacement or merchandise exchange policies are not applicable. If there is any discrepancy in your printed receipt name or PAN number, please contact us for immediate digital correction.</p>

        <div style="background:#f7faf8; border-left:4px solid #1b6b3a; padding:16px 20px; border-radius:0 12px 12px 0; margin-top:35px;">
            <strong style="color:#0d2616;">Fulfillment & Dispatch Inquiries:</strong><br>
            Email: <a href="mailto:info@al-miftah.org" style="color:#1b6b3a;">info@al-miftah.org</a> | Helpline: +91 8840432382<br>
            Al-Miftah Educational and Social Charitable Trust, Ranipur, Haidergarh, Barabanki, Uttar Pradesh - 225124
        </div>
`;

// Write files
fs.writeFileSync(path.join(rootDir, 'terms.php'), getHeaderBanner('Terms &amp; Conditions', 'Legal &bull; Al-Miftah', 'fa-solid fa-file-contract') + getPageWrap(termsContent), 'utf8');
console.log('Created terms.php');

fs.writeFileSync(path.join(rootDir, 'privacy-policy.php'), getHeaderBanner('Privacy Policy', 'Data Security &bull; Al-Miftah', 'fa-solid fa-shield-halved') + getPageWrap(privacyContent), 'utf8');
console.log('Created privacy-policy.php');

fs.writeFileSync(path.join(rootDir, 'refund-policy.php'), getHeaderBanner('Cancellation &amp; Refund Policy', 'Transparent Giving', 'fa-solid fa-hand-holding-dollar') + getPageWrap(refundContent), 'utf8');
console.log('Created refund-policy.php');

fs.writeFileSync(path.join(rootDir, 'shipping-policy.php'), getHeaderBanner('Shipping &amp; Delivery Policy', 'Service Fulfillment', 'fa-solid fa-truck-fast') + getPageWrap(shippingContent), 'utf8');
console.log('Created shipping-policy.php');
