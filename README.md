# Al Miftah (al-miftah)

Official platform and management system for **Al-Miftah Educational and Social Charitable Trust** ([al-miftah.org](https://al-miftah.org)).

---

## 📌 About The Project
Al Miftah ("The Key") is a non-profit educational and charitable initiative providing free quality Islamic and modern education, charitable school infrastructure, and community support for underprivileged children and families.

### 🌟 Key Features
- **Frontend Portal**: Modern responsive pages for Home, About Us, Verified Causes, Online Donation / Bank details, Photo Gallery, Events, Blogs, and Inquiries.
- **Member Dashboard**: User registration, Mobile/OTP verification, KYC document submission (Aadhaar & PAN), and contribution tracking.
- **Referral Network Tree**: Visual downline team tree tracking for community members and volunteers.
- **Admin Control Panel**: Full administrative suite to manage donations, approve KYC documents, manage causes, and monitor system metrics.
- **Strict Profile Integrity & Security**: Once a member profile is submitted and created, user-side modifications are locked to prevent unauthorized alterations; only administrators can update personal or bank details.

---

## 🛠️ Tech Stack
- **Backend**: PHP 8+ (PDO with dual-driver support: MySQL production + automatic SQLite fallback)
- **Frontend**: HTML5, CSS3, JavaScript, FontAwesome 6, Bootstrap
- **Database**: MySQL / SQLite (`admin-panel/data/almiftah_local.sqlite`)

---

## 🚀 Getting Started
1. Clone or place the project files in your web root (`public_html` or `htdocs`).
2. Configure database credentials in `admin-panel/db.php` if using MySQL, or let it automatically run with the embedded SQLite database.
3. Access the web app in your browser:
   - User portal: `index.php` / `profile.php`
   - Admin CMS: `admin-panel/`

