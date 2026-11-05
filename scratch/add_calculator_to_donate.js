const fs = require('fs');
const path = require('path');

const donatePath = path.join(__dirname, '..', 'donate.php');
let content = fs.readFileSync(donatePath, 'utf8');

// 1. Add CSS for presets and calculator
const calculatorCss = `
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
`;

// Insert calculator CSS before </style>
if (!content.includes('.am-dn-calc-wrapper')) {
  content = content.replace('</style>', `${calculatorCss}\n</style>`);
}

// 2. Add Calculator HTML right before <!-- Official Live Razorpay Subscription Button -->
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

if (!content.includes('am-dn-calc-wrapper')) {
  content = content.replace(
    '<!-- Official Live Razorpay Subscription Button -->',
    `${calculatorHtml}\n        <!-- Official Live Razorpay Subscription Button -->`
  );
}

// 3. Add JavaScript functions for calculator
const calculatorJs = `
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
`;

if (!content.includes('setDonationAmount(')) {
  content = content.replace('function selectPlan(', `${calculatorJs}\nfunction selectPlan(`);
}

fs.writeFileSync(donatePath, content, 'utf8');
console.log('Successfully enhanced donate.php with interactive impact calculator!');
