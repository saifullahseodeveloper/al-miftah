

<!-- =========================================================================
     AL-MIFTAH EDUCATIONAL TRUST - MODERN AGENCY-GRADE SECTIONS (BELOW HERO)
     ========================================================================= -->

<style>
/* -------------------------------------------------------------
 * PREMIUM MODERN DESIGN SYSTEM (BELOW HERO ONLY)
 * ------------------------------------------------------------- */
.am-redesign-wrap {
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  color: #2b332d;
  background-color: #ffffff;
  overflow-x: hidden;
}

.am-redesign-wrap * {
  box-sizing: border-box;
}

.am-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
}

/* SECTION PADDING & RHYTHM */
.am-section {
  padding: 70px 0;
  position: relative;
}

.am-section-cream {
  background: #faf8f3;
}

.am-section-white {
  background: #ffffff;
}

/* SECTION HEADERS */
.am-section-header {
  text-align: center;
  max-width: 720px;
  margin: 0 auto 46px;
}

.am-badge {
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

.am-badge i {
  color: #c8963e;
}

.am-title {
  font-size: clamp(28px, 4vw, 40px);
  font-weight: 800;
  color: #0d2616;
  line-height: 1.25;
  margin-bottom: 14px;
  letter-spacing: -0.02em;
}

.am-subtitle {
  font-size: 16px;
  color: #5d6860;
  line-height: 1.7;
  margin: 0;
}

/* -------------------------------------------------------------
 * 1. ABOUT US SECTION
 * ------------------------------------------------------------- */
.am-about-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 50px;
  align-items: center;
}

.am-carousel-card {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 16px 40px rgba(13, 38, 22, 0.12);
  border: 4px solid #ffffff;
  background: #0d2616;
}

.am-carousel-card .swiper-slide img {
  width: 100%;
  height: 440px;
  object-fit: cover;
  display: block;
}

.am-about-content h3 {
  font-size: 32px;
  font-weight: 800;
  color: #0d2616;
  line-height: 1.3;
  margin-bottom: 18px;
}

.am-about-content p {
  font-size: 16px;
  color: #4b554e;
  line-height: 1.8;
  margin-bottom: 18px;
}

.am-pills-row {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
  margin: 22px 0 28px;
}

.am-pill-item {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #ffffff;
  border: 1px solid #e2ece5;
  padding: 10px 18px;
  border-radius: 12px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
}

.am-pill-item i {
  color: #c8963e;
  font-size: 16px;
}

.am-pill-item span {
  font-weight: 700;
  color: #0d2616;
  font-size: 14.5px;
}

.am-about-footer-row {
  display: flex;
  align-items: center;
  gap: 24px;
  flex-wrap: wrap;
}

.am-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #1b6b3a 0%, #134626 100%);
  color: #ffffff !important;
  font-weight: 600;
  font-size: 15px;
  padding: 14px 32px;
  border-radius: 50px;
  text-decoration: none;
  box-shadow: 0 6px 20px rgba(27, 107, 58, 0.28);
  transition: all 0.3s ease;
}

.am-btn-primary:hover {
  background: linear-gradient(135deg, #c8963e 0%, #a67830 100%);
  transform: translateY(-3px);
  box-shadow: 0 10px 26px rgba(200, 150, 62, 0.35);
}

.am-leader-box {
  background: #ffffff;
  border-left: 4px solid #c8963e;
  padding: 10px 18px;
  border-radius: 10px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

.am-leader-box h5 {
  font-size: 15px;
  font-weight: 700;
  color: #0d2616;
  margin: 0 0 2px 0;
}

.am-leader-box span {
  font-size: 12px;
  color: #c8963e;
  font-weight: 600;
  text-transform: uppercase;
}

/* -------------------------------------------------------------
 * 2. SERVICES SECTION (01, 02, 03)
 * ------------------------------------------------------------- */
.am-services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 28px;
}

.am-service-card {
  background: #ffffff;
  border-radius: 20px;
  padding: 40px 32px;
  border: 1px solid #eef2ec;
  box-shadow: 0 8px 26px rgba(0, 0, 0, 0.04);
  transition: all 0.35s ease;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.am-service-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #1b6b3a, #c8963e);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.am-service-card:hover {
  transform: translateY(-8px);
  border-color: rgba(200, 150, 62, 0.4);
  box-shadow: 0 22px 50px rgba(27, 107, 58, 0.12);
}

.am-service-card:hover::before {
  opacity: 1;
}

.am-service-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.am-service-icon {
  width: 64px;
  height: 64px;
  border-radius: 16px;
  background: #eef6f1;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 14px rgba(27, 107, 58, 0.08);
}

.am-service-icon img {
  width: 38px;
  height: 38px;
  object-fit: contain;
}

.am-service-num {
  font-size: 36px;
  font-weight: 800;
  color: rgba(27, 107, 58, 0.15);
  line-height: 1;
}

.am-service-card h4 {
  font-size: 22px;
  font-weight: 700;
  color: #0d2616;
  margin-bottom: 12px;
}

.am-service-card p {
  font-size: 15px;
  color: #5c6860;
  line-height: 1.7;
  margin-bottom: 24px;
  flex-grow: 1;
}

.am-service-btn {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: #eef6f1;
  color: #1b6b3a;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: all 0.25s ease;
}

.am-service-card:hover .am-service-btn {
  background: #c8963e;
  color: #ffffff;
  transform: translateX(6px);
}

/* -------------------------------------------------------------
 * 3. PILLARS OF ISLAM
 * ------------------------------------------------------------- */
.am-pillars-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: center;
}

.am-pillars-banner img {
  width: 100%;
  border-radius: 20px;
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.1);
  border: 4px solid #ffffff;
  display: block;
  object-fit: cover;
  max-height: 520px;
}

.am-pillars-list {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.am-pillar-box {
  display: flex;
  align-items: center;
  gap: 18px;
  background: #ffffff;
  padding: 16px 20px;
  border-radius: 16px;
  border: 1px solid #edf2eb;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
  transition: all 0.3s ease;
}

.am-pillar-box:hover {
  transform: translateX(8px);
  border-color: #c8963e;
  box-shadow: 0 8px 24px rgba(27, 107, 58, 0.08);
}

.am-pillar-icon {
  width: 46px;
  height: 46px;
  border-radius: 12px;
  background: #eef6f1;
  color: #1b6b3a;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
  flex-shrink: 0;
  transition: all 0.25s ease;
}

.am-pillar-box:hover .am-pillar-icon {
  background: #c8963e;
  color: #ffffff;
}

.am-pillar-info h5 {
  font-size: 17px;
  font-weight: 700;
  color: #0d2616;
  margin: 0 0 2px 0;
}

.am-pillar-info p {
  font-size: 13.5px;
  color: #5c6860;
  margin: 0;
  line-height: 1.5;
}

/* -------------------------------------------------------------
 * 4. POPULAR CAUSES & CAMPAIGNS
 * ------------------------------------------------------------- */
.am-causes-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 28px;
}

.am-cause-card {
  background: #ffffff;
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid #edf2eb;
  box-shadow: 0 8px 26px rgba(0, 0, 0, 0.05);
  transition: all 0.35s ease;
  display: flex;
  flex-direction: column;
}

.am-cause-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 22px 50px rgba(27, 107, 58, 0.14);
  border-color: #c8963e;
}

.am-cause-thumb {
  position: relative;
  height: 230px;
  overflow: hidden;
  background: #0d2616;
}

.am-cause-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.45s ease;
}

.am-cause-card:hover .am-cause-thumb img {
  transform: scale(1.06);
}

.am-cause-body {
  padding: 24px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.am-cause-body h4 a {
  font-size: 20px;
  font-weight: 700;
  color: #0d2616;
  text-decoration: none;
  line-height: 1.35;
  transition: color 0.2s;
}

.am-cause-body h4 a:hover {
  color: #1b6b3a;
}

.am-cause-body p {
  font-size: 14.5px;
  color: #5c6860;
  line-height: 1.65;
  margin: 10px 0 20px 0;
  flex-grow: 1;
}

.am-progress-wrapper {
  margin-bottom: 20px;
}

.am-progress-header {
  display: flex;
  justify-content: space-between;
  font-size: 13.5px;
  font-weight: 700;
  color: #1b6b3a;
  margin-bottom: 8px;
}

.am-progress-bar-bg {
  width: 100%;
  height: 8px;
  background: #edf3ec;
  border-radius: 50px;
  overflow: hidden;
}

.am-progress-bar-fill {
  height: 100%;
  background: linear-gradient(90deg, #1b6b3a 0%, #c8963e 100%);
  border-radius: 50px;
}

.am-progress-meta {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
  font-size: 13.5px;
}

.am-progress-meta strong {
  color: #0d2616;
}

.am-cause-btn {
  width: 100%;
  justify-content: center;
  background: #eef6f1;
  color: #1b6b3a;
  border-radius: 50px;
  font-weight: 700;
  font-size: 15px;
  padding: 12px 24px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  transition: all 0.25s ease;
}

.am-cause-card:hover .am-cause-btn,
.am-cause-btn:hover {
  background: #1b6b3a;
  color: #ffffff;
}

/* -------------------------------------------------------------
 * 5. 5-YEAR VISION & MISSION (HIGHLIGHT BANNER)
 * ------------------------------------------------------------- */
.am-vision-banner {
  background: linear-gradient(135deg, #092012 0%, #134626 100%);
  border-radius: 28px;
  padding: 60px 50px;
  color: #ffffff;
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: 40px;
  align-items: center;
  box-shadow: 0 20px 60px rgba(9, 32, 18, 0.25);
  position: relative;
  overflow: hidden;
}

.am-vision-banner::before {
  content: '';
  position: absolute;
  top: -50px;
  right: -50px;
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(200, 150, 62, 0.2) 0%, transparent 70%);
  pointer-events: none;
}

.am-vision-left h3 {
  font-size: clamp(26px, 3.5vw, 36px);
  font-weight: 800;
  color: #ffffff;
  line-height: 1.35;
  margin-bottom: 20px;
}

.am-vision-features {
  list-style: none;
  padding: 0;
  margin: 0 0 28px 0;
}

.am-vision-features li {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 15.5px;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 12px;
}

.am-vision-features li i {
  color: #c8963e;
  font-size: 16px;
}

.am-vision-right {
  text-align: center;
}

.am-vision-stat-box {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(200, 150, 62, 0.3);
  border-radius: 20px;
  padding: 36px 28px;
  backdrop-filter: blur(8px);
}

.am-vision-stat-num {
  font-size: 48px;
  font-weight: 900;
  color: #c8963e;
  display: block;
  line-height: 1;
  margin-bottom: 8px;
}

.am-vision-stat-lbl {
  font-size: 14px;
  color: rgba(255, 255, 255, 0.8);
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* -------------------------------------------------------------
 * 6. SCHOLARS & COMMITTEE
 * ------------------------------------------------------------- */
.am-team-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 30px;
  max-width: 800px;
  margin: 0 auto;
}

.am-team-card {
  background: #ffffff;
  border-radius: 20px;
  padding: 36px 24px;
  border: 1px solid #edf2eb;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
  text-align: center;
  transition: all 0.3s ease;
}

.am-team-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 45px rgba(27, 107, 58, 0.1);
  border-color: #c8963e;
}

.am-team-avatar {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  background: #eef6f1;
  color: #1b6b3a;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 38px;
  margin: 0 auto 18px;
  border: 3px solid #c8963e;
}

.am-team-card h5 {
  font-size: 20px;
  font-weight: 700;
  color: #0d2616;
  margin: 0 0 4px 0;
}

.am-team-card span {
  font-size: 13.5px;
  color: #c8963e;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* -------------------------------------------------------------
 * 7. TESTIMONIALS
 * ------------------------------------------------------------- */
.am-testimonial-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 28px;
}

.am-testimonial-card {
  background: #faf8f3;
  border-radius: 20px;
  padding: 36px 30px;
  border: 1px solid #edf2eb;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.03);
}

.am-testimonial-card .quotes-icon {
  font-size: 32px;
  color: #c8963e;
  margin-bottom: 14px;
}

.am-testimonial-card h4 {
  font-size: 19px;
  font-weight: 700;
  color: #0d2616;
  margin-bottom: 10px;
}

.am-testimonial-card p {
  font-size: 15px;
  color: #556057;
  line-height: 1.7;
  font-style: italic;
  margin-bottom: 20px;
}

.am-testimonial-author {
  display: flex;
  align-items: center;
  gap: 14px;
  padding-top: 16px;
  border-top: 1px solid #e5ded2;
}

.am-author-thumb {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #c8963e;
}

.am-author-meta h6 {
  font-size: 16px;
  font-weight: 700;
  color: #0d2616;
  margin: 0;
}

.am-author-meta span {
  font-size: 13px;
  color: #88948c;
}

/* -------------------------------------------------------------
 * 8. RESPONSIVE DESIGN BREAKPOINTS
 * ------------------------------------------------------------- */
@media (max-width: 991px) {
  .am-about-grid,
  .am-pillars-grid,
  .am-vision-banner {
    grid-template-columns: 1fr;
    gap: 36px;
  }
  .am-carousel-card .swiper-slide img {
    height: 320px;
  }
  .am-vision-banner {
    padding: 40px 28px;
  }
}

@media (max-width: 640px) {
  .am-section {
    padding: 50px 0;
  }
  .am-carousel-card .swiper-slide img {
    height: 250px;
  }
}
</style>

<div class="am-redesign-wrap">

  <!-- =========================================================
       1. ABOUT US SECTION WITH PHOTO CAROUSEL
       ========================================================= -->
  <section class="am-section am-section-cream">
    <div class="am-container">
      <div class="am-about-grid">
        
        <!-- Left: Carousel -->
        <div class="am-carousel-card">
          <div class="elementor-image-carousel-wrapper swiper">
            <div class="elementor-image-carousel swiper-wrapper">
              <div class="swiper-slide">
                <img src="https://al-miftah.org/wp-content/uploads/2026/04/project-based-learning-1024x468.png" alt="Education">
              </div>
              <div class="swiper-slide">
                <img src="https://al-miftah.org/wp-content/uploads/2026/04/maxresdefault-1024x576.jpg" alt="Al Miftah">
              </div>
              <div class="swiper-slide">
                <img src="https://al-miftah.org/wp-content/uploads/2026/04/istockphoto-1146925253-612x612-1.jpg" alt="Students">
              </div>
              <div class="swiper-slide">
                <img src="https://al-miftah.org/wp-content/uploads/2026/04/1728363714-3827-1024x538.jpg" alt="Relief">
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Text Content -->
        <div class="am-about-content">
          <div class="am-badge"><i class="fa-solid fa-moon"></i> About our Educational Trust</div>
          <h3>Al-Miftah – Preserving Values & Giving Real Education</h3>
          <p>Hamara mission hai underprivileged bachchon ko quality Islamic aur modern education dena. Aapka har rupaya school building, teachers aur books mein lagega.</p>
          <p>Al-Miftah ek non-profit initiative hai jo charitable school kholne par focus karega. Ham gareeb aur be-sahara bachhon ko deeni taleem aur basic skills sikhaenge.</p>

          <div class="am-pills-row">
            <div class="am-pill-item">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Educational Relief</span>
            </div>
            <div class="am-pill-item">
              <i class="fa-solid fa-hand-holding-heart"></i>
              <span>Humanitarian Aid</span>
            </div>
          </div>

          <div class="am-about-footer-row">
            <a href="about-us.php" class="am-btn-primary">
              Read More <i class="fa-solid fa-arrow-right"></i>
            </a>
            <div class="am-leader-box">
              <h5>Maulana Anees</h5>
              <span>Head of Al-Miftah</span>
            </div>
            <div class="am-leader-box">
              <h5>Mohammad Danish Alam</h5>
              <span>Founder & Chairman</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================
       2. SERVICES FOR HUMANITY (01, 02, 03)
       ========================================================= -->
  <section class="am-section am-section-white">
    <div class="am-container">
      <div class="am-section-header">
        <div class="am-badge"><i class="fa-solid fa-hand-holding-dollar"></i> Our Services</div>
        <h2 class="am-title">Services For Humanity & Education</h2>
        <p class="am-subtitle">Al-Miftah is dedicated to transparent charitable giving, school construction, and community upliftment.</p>
      </div>

      <div class="am-services-grid">
        
        <!-- Card 1 -->
        <div class="am-service-card">
          <div class="am-service-top">
            <div class="am-service-icon">
              <img src="https://al-miftah.org/wp-content/uploads/2025/07/Icon-01.png" alt="School Funding">
            </div>
            <span class="am-service-num">01</span>
          </div>
          <h4>School Funding</h4>
          <p>Al-Miftah provides primary education platforms, books, classroom amenities, and teacher sponsorships for underprivileged children.</p>
          <div>
            <a href="donate.php" class="am-service-btn" aria-label="Donate"><i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="am-service-card">
          <div class="am-service-top">
            <div class="am-service-icon">
              <img src="https://al-miftah.org/wp-content/uploads/2025/07/Icon-02.png" alt="Charity & Donation">
            </div>
            <span class="am-service-num">02</span>
          </div>
          <h4>Charity & Zakat</h4>
          <p>Dedicated to collecting and distributing Zakat, Sadaqah, and emergency relief with 100% financial transparency and verified accounts.</p>
          <div>
            <a href="donate.php" class="am-service-btn" aria-label="Donate"><i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="am-service-card">
          <div class="am-service-top">
            <div class="am-service-icon">
              <img src="https://al-miftah.org/wp-content/uploads/2025/07/Icon-03.png" alt="Masjid Renovation">
            </div>
            <span class="am-service-num">03</span>
          </div>
          <h4>Masjid Renovation</h4>
          <p>Assisting rural and neglected communities by repairing, maintaining, and supporting local prayer spaces and madarsa centers.</p>
          <div>
            <a href="donate.php" class="am-service-btn" aria-label="Donate"><i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================
       3. PILLARS OF ISLAM
       ========================================================= -->
  <section class="am-section am-section-cream">
    <div class="am-container">
      <div class="am-pillars-grid">
        
        <!-- Left: Image -->
        <div class="am-pillars-banner">
          <img src="https://al-miftah.org/wp-content/uploads/2026/02/WhatsApp-Image-2026-01-30-at-8.11.21-PM.jpeg" alt="Pillars of Islam">
        </div>

        <!-- Right: 5 Pillars List -->
        <div>
          <div class="am-badge"><i class="fa-solid fa-mosque"></i> Core Fundamentals</div>
          <h2 class="am-title">The Five Pillars of Islam</h2>
          <p class="am-subtitle" style="margin-bottom: 24px;">The spiritual foundation guiding all charitable endeavors at Al-Miftah Educational Trust.</p>

          <div class="am-pillars-list">
            
            <div class="am-pillar-box">
              <div class="am-pillar-icon"><i class="fa-solid fa-bell"></i></div>
              <div class="am-pillar-info">
                <h5>Shahada (Faith)</h5>
                <p>Belief in the oneness of Allah and the prophethood of Muhammad (PBUH).</p>
              </div>
            </div>

            <div class="am-pillar-box">
              <div class="am-pillar-icon"><i class="fa-solid fa-person-praying"></i></div>
              <div class="am-pillar-info">
                <h5>Salah (Daily Prayer)</h5>
                <p>The performance of 5 daily ritual prayers at prescribed times.</p>
              </div>
            </div>

            <div class="am-pillar-box">
              <div class="am-pillar-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
              <div class="am-pillar-info">
                <h5>Zakat (Giving)</h5>
                <p>Obligatory charity given to the poor to purify wealth and aid society.</p>
              </div>
            </div>

            <div class="am-pillar-box">
              <div class="am-pillar-icon"><i class="fa-solid fa-moon"></i></div>
              <div class="am-pillar-info">
                <h5>Sawm (Fasting)</h5>
                <p>Abstaining from dawn until sunset during the holy month of Ramadan.</p>
              </div>
            </div>

            <div class="am-pillar-box">
              <div class="am-pillar-icon"><i class="fa-solid fa-kaaba"></i></div>
              <div class="am-pillar-info">
                <h5>Hajj (Pilgrimage)</h5>
                <p>Sacred journey to Mecca that every able Muslim undertakes in their lifetime.</p>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================
       4. POPULAR CAUSES & DONATIONS (ACTIVE & BEAUTIFULLY TILED)
       ========================================================= -->
  <section class="am-section am-section-white">
    <div class="am-container">
      <div class="am-section-header">
        <div class="am-badge"><i class="fa-solid fa-heart-pulse"></i> Help & Donate</div>
        <h2 class="am-title">Find Our Active Causes</h2>
        <p class="am-subtitle">Your direct contribution creates Sadaqah Jariyah that changes lives forever.</p>
      </div>

      <div class="am-causes-grid">
        <!-- Card 1 -->
        <div class="am-cause-card">
          <div class="am-cause-thumb">
            <img src="wp-content/uploads/2026/04/istockphoto-1146925253-612x612-1.jpg" alt="Support Poor Children Education">
            <span style="position: absolute; top: 16px; left: 16px; background: #1B6B3A; color: #ffffff; padding: 4px 14px; border-radius: 30px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Education</span>
          </div>
          <div class="am-cause-body">
            <h4><a href="causes.php">Support Poor Children's Quality Education</a></h4>
            <p>Help provide books, school fees, uniforms, and learning supplies to deserving underprivileged students across local communities.</p>
            <div class="am-progress-wrapper">
              <div class="am-progress-header"><span>Funded</span><span style="color: #1b6b3a; font-weight:700;">68%</span></div>
              <div class="am-progress-bar-bg"><div class="am-progress-bar-fill" style="width: 68%;"></div></div>
              <div class="am-progress-meta"><span>Raised: <strong>₹1,70,000</strong></span><span>Goal: <strong>₹2,50,000</strong></span></div>
            </div>
            <a href="donate.php" class="am-cause-btn"><i class="fa-solid fa-heart"></i> Donate Now</a>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="am-cause-card">
          <div class="am-cause-thumb">
            <img src="wp-content/uploads/2026/04/project-based-learning-1024x468.png" alt="School Building and Classrooms">
            <span style="position: absolute; top: 16px; left: 16px; background: #C8963E; color: #ffffff; padding: 4px 14px; border-radius: 30px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Infrastructure</span>
          </div>
          <div class="am-cause-body">
            <h4><a href="causes.php">School Building &amp; Modern Classrooms</a></h4>
            <p>Constructing safe, conducive classrooms, sanitation facilities, and tech-equipped study centers for rural students.</p>
            <div class="am-progress-wrapper">
              <div class="am-progress-header"><span>Funded</span><span style="color: #1b6b3a; font-weight:700;">82%</span></div>
              <div class="am-progress-bar-bg"><div class="am-progress-bar-fill" style="width: 82%;"></div></div>
              <div class="am-progress-meta"><span>Raised: <strong>₹4,10,000</strong></span><span>Goal: <strong>₹5,00,000</strong></span></div>
            </div>
            <a href="donate.php" class="am-cause-btn"><i class="fa-solid fa-heart"></i> Donate Now</a>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="am-cause-card">
          <div class="am-cause-thumb">
            <img src="wp-content/uploads/2026/04/1728363714-3827-1024x538.jpg" alt="Monthly Ration and Relief">
            <span style="position: absolute; top: 16px; left: 16px; background: #1B6B3A; color: #ffffff; padding: 4px 14px; border-radius: 30px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Relief</span>
          </div>
          <div class="am-cause-body">
            <h4><a href="causes.php">Monthly Ration &amp; Emergency Aid Kits</a></h4>
            <p>Distributing essential dry grocery kits, nutritional support, and emergency medical kits to vulnerable families and widows.</p>
            <div class="am-progress-wrapper">
              <div class="am-progress-header"><span>Funded</span><span style="color: #1b6b3a; font-weight:700;">54%</span></div>
              <div class="am-progress-bar-bg"><div class="am-progress-bar-fill" style="width: 54%;"></div></div>
              <div class="am-progress-meta"><span>Raised: <strong>₹1,35,000</strong></span><span>Goal: <strong>₹2,50,000</strong></span></div>
            </div>
            <a href="donate.php" class="am-cause-btn"><i class="fa-solid fa-heart"></i> Donate Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================
       5. 5-YEAR VISION & IMPACT BANNER
       ========================================================= -->
  <section class="am-section am-section-cream">
    <div class="am-container">
      <div class="am-vision-banner">
        <div class="am-vision-left">
          <div class="am-badge" style="background: rgba(200,150,62,0.2); border-color: rgba(200,150,62,0.4); color: #e0b462;">
            <i class="fa-solid fa-star-and-crescent"></i> Our 5-Year Vision
          </div>
          <h3>India mein 5 saal mein 10 charitable schools kholna — focused on Islamic & modern education.</h3>
          <ul class="am-vision-features">
            <li><i class="fa-solid fa-circle-check"></i> Free quality education, textbooks, stationery, and uniforms.</li>
            <li><i class="fa-solid fa-circle-check"></i> Wholesome daily meals and free safe transport for kids.</li>
            <li><i class="fa-solid fa-circle-check"></i> Complete donor transparency with monthly reports & student updates.</li>
          </ul>
          <a href="donate.php" class="am-btn-primary" style="background: #c8963e;">
            Join Our Mission <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
        <div class="am-vision-right">
          <div class="am-vision-stat-box">
            <span class="am-vision-stat-num">10+</span>
            <span class="am-vision-stat-lbl">Charitable Schools Target</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================
       6. MANAGING COMMITTEE / SCHOLARS
       ========================================================= -->
  <section class="am-section am-section-white">
    <div class="am-container">
      <div class="am-section-header">
        <div class="am-badge"><i class="fa-solid fa-users"></i> Leadership</div>
        <h2 class="am-title">Managing Committee & Scholars</h2>
        <p class="am-subtitle">Guided by dedicated community leaders upholding values of honesty, service, and excellence.</p>
      </div>

      <div class="am-team-grid">
        
        <div class="am-team-card">
          <div class="am-team-avatar">
            <i class="fa-solid fa-user-tie"></i>
          </div>
          <h5>Mohammad Danish Alam</h5>
          <span>Founder & Chairman</span>
        </div>

        <div class="am-team-card">
          <div class="am-team-avatar">
            <i class="fa-solid fa-user-graduate"></i>
          </div>
          <h5>Laique Ahmad Shrafi</h5>
          <span>Co-Founder</span>
        </div>

      </div>
    </div>
  </section>

  <!-- =========================================================
       7. TESTIMONIALS / WORDS FROM SUPPORTERS
       ========================================================= -->
  <section class="am-section am-section-cream">
    <div class="am-container">
      <div class="am-section-header">
        <div class="am-badge"><i class="fa-solid fa-quote-left"></i> Testimonials</div>
        <h2 class="am-title">Words From Our Supporters</h2>
        <p class="am-subtitle">Real feedback from well-wishers and donors supporting our journey.</p>
      </div>

      <div class="am-testimonial-grid">
        
        <div class="am-testimonial-card">
          <div class="quotes-icon"><i class="fa-solid fa-quote-left"></i></div>
          <h4>Plan, Organize, Impact</h4>
          <p>Joining the Jummah Giving initiative means reviving a Sunnah every week. Friday is the best day in Islam—a day of mercy, blessings, and answered duas.</p>
          <div class="am-testimonial-author">
            <img class="am-author-thumb" src="https://al-miftah.org/wp-content/uploads/2025/07/pexels-thirdman-8489271.png" alt="Fatema Jannat">
            <div class="am-author-meta">
              <h6>Fatema Jannat</h6>
              <span>Organizer-in-Chief</span>
            </div>
          </div>
        </div>

        <div class="am-testimonial-card">
          <div class="quotes-icon"><i class="fa-solid fa-quote-left"></i></div>
          <h4>Sadaqah Jariyah at Work</h4>
          <p>Witnessing the commitment of Al-Miftah towards educating underprivileged kids gives me immense confidence in their work and financial transparency.</p>
          <div class="am-testimonial-author">
            <img class="am-author-thumb" src="https://al-miftah.org/wp-content/uploads/2025/07/pexels-ahmed-akacha-3313934-19263993.png" alt="Steven Morgan">
            <div class="am-author-meta">
              <h6>Steven Morgan</h6>
              <span>Community Donor</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

</div>
