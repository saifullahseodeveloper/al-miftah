const fs = require('fs');
const path = require('path');

const donatePath = path.join(__dirname, '..', 'donate.php');
let content = fs.readFileSync(donatePath, 'utf8');

const calculatorHtml = `
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
`;

if (!content.includes('Custom Giving Calculator')) {
  content = content.replace(
    '<!-- Official Live Razorpay Subscription Button -->',
    calculatorHtml + '\n        <!-- Official Live Razorpay Subscription Button -->'
  );
  fs.writeFileSync(donatePath, content, 'utf8');
  console.log('Inserted calculator HTML!');
} else {
  console.log('Already contains Custom Giving Calculator');
}
