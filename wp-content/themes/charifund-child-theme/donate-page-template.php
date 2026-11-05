<?php
/**
 * Template Name: Donation Page
 * Description: Beautiful charity donation page
 */
get_header();
?>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Crimson+Pro:wght@300;400;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --forest: #0d2b1a; --deep: #1a3d28; --mid: #2d6a4f;
  --sage: #52b788; --mint: #95d5b2; --gold: #c9a84c;
  --gold2: #e8c97a; --cream: #fdf6e3; --warm: #f5efe0; --text: #1a2e1f;
}
body { background: var(--cream); font-family: 'Crimson Pro', Georgia, serif; color: var(--text); overflow-x: hidden; }

/* SIDE DECOR IMAGES (Desktop) */
.dn-side-decor-img {
    position: absolute;
    width: 25%;
    max-width: 300px;
    height: auto;
    opacity: 0.12;
    filter: brightness(1.2);
    pointer-events: none;
    z-index: 1;
    animation: fadeUp 1s 0.2s ease both;
}
.dn-decor-left { left: 2%; top: 55%; transform: translateY(-50%) rotate(-10deg); }
.dn-decor-right { right: 2%; top: 55%; transform: translateY(-50%) scaleX(-1) rotate(10deg); }

/* TOP DECOR IMAGE (Mobile Container) */
.dn-hero-top-img {
    display: none;
    width: 100%;
    text-align: center;
}

/* HERO SECTION */
.dn-hero { min-height: 100vh; background: var(--forest); position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 80px 20px; }
.dn-hero::after { content: ''; position: absolute; left: 0; right: 0; bottom: 0; height: 3px; background: linear-gradient(90deg, transparent, var(--gold), transparent); }
.dn-hero-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 80% 60% at 20% 50%, rgba(45,106,79,.45) 0%, transparent 60%), radial-gradient(ellipse 60% 80% at 80% 30%, rgba(201,168,76,.12) 0%, transparent 55%), radial-gradient(ellipse 40% 40% at 60% 80%, rgba(82,183,136,.15) 0%, transparent 50%); }
.dn-particle { position: absolute; width: 4px; height: 4px; border-radius: 50%; background: var(--gold); opacity: 0; animation: particleFly linear infinite; pointer-events: none; }
@keyframes particleFly { 0% { opacity: 0; transform: translateY(0) scale(0); } 20% { opacity: .6; transform: translateY(-60px) scale(1); } 100% { opacity: 0; transform: translateY(-300px) scale(.3) translateX(40px); } }

.dn-hero-content { position: relative; z-index: 2; text-align: center; max-width: 760px; }
.dn-eyebrow { display: inline-flex; align-items: center; gap: 8px; background: rgba(201,168,76,.15); border: 1px solid rgba(201,168,76,.35); color: var(--gold2); font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 3px; padding: 8px 18px; border-radius: 40px; margin-bottom: 28px; animation: fadeUp .8s ease both; }
.dn-hero h1 { font-family: 'Playfair Display', serif; font-size: clamp(42px, 7vw, 80px); font-weight: 900; color: #fff; line-height: 1.05; margin-bottom: 24px; animation: fadeUp .8s .15s ease both; }
.dn-hero h1 em { font-style: italic; color: var(--gold2); }
.dn-hero-sub { font-size: clamp(17px, 2.5vw, 21px); color: rgba(255,255,255,.7); line-height: 1.7; max-width: 560px; margin: 0 auto 40px; animation: fadeUp .8s .3s ease both; font-weight: 300; }
.dn-hero-cta { display: inline-flex; align-items: center; gap: 10px; background: var(--gold); color: var(--forest); font-family: 'Playfair Display', serif; font-weight: 700; font-size: 17px; padding: 16px 36px; border-radius: 50px; border: none; cursor: pointer; transition: all .3s; box-shadow: 0 8px 32px rgba(201,168,76,.4); animation: fadeUp .8s .45s ease both; text-decoration: none; }
.dn-hero-cta:hover { background: var(--gold2); transform: translateY(-3px); }

/* STATS */
.dn-stats-strip { background: var(--deep); }
.dn-stats-inner { display: flex; justify-content: center; flex-wrap: wrap; border-top: 1px solid rgba(255,255,255,.08); }
.dn-stat { flex: 1; min-width: 180px; padding: 36px 28px; text-align: center; border-right: 1px solid rgba(255,255,255,.08); }
.dn-stat:last-child { border-right: none; }
.dn-stat-num { font-family: 'Playfair Display', serif; font-size: 40px; font-weight: 900; color: var(--gold2); display: block; line-height: 1; margin-bottom: 6px; }
.dn-stat-label { font-size: 12px; color: rgba(255,255,255,.5); font-family: 'DM Mono', monospace; letter-spacing: 1px; }

/* WHY */
.dn-why { padding: 100px 20px; background: var(--warm); position: relative; }
.dn-why::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--forest), var(--sage), var(--gold)); }
.dn-section-label { font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 3px; color: var(--mid); text-align: center; margin-bottom: 14px; }
.dn-section-title { font-family: 'Playfair Display', serif; font-size: clamp(30px, 5vw, 52px); font-weight: 800; color: var(--forest); text-align: center; margin-bottom: 16px; line-height: 1.15; }
.dn-section-title em { font-style: italic; color: var(--mid); }
.dn-section-sub { text-align: center; font-size: 18px; color: #555; max-width: 560px; margin: 0 auto 60px; line-height: 1.7; font-weight: 300; }
.dn-causes { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; max-width: 1000px; margin: 0 auto; }
.dn-cause-card { background: #fff; border-radius: 20px; padding: 36px 28px; border: 1.5px solid rgba(45,106,79,.12); box-shadow: 0 4px 24px rgba(0,0,0,.05); transition: all .3s; }
.dn-cause-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(0,0,0,.1); }
.dn-cause-icon { font-size: 42px; margin-bottom: 18px; display: block; }
.dn-cause-card h3 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--forest); margin-bottom: 10px; }
.dn-cause-card p { font-size: 15px; color: #666; line-height: 1.7; font-weight: 300; }
.dn-cause-tag { display: inline-block; margin-top: 16px; background: rgba(82,183,136,.12); color: var(--mid); font-family: 'DM Mono', monospace; font-size: 11px; padding: 4px 12px; border-radius: 20px; letter-spacing: .5px; }

/* DONATE SECTION - redesigned to match the forest / gold / cream vibe */
.dn-donate-section { padding: 110px 20px; background: var(--forest); position: relative; overflow: hidden; }
.dn-donate-section::before { content: ''; position: absolute; top: -100px; right: -100px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(201,168,76,.08) 0%, transparent 70%); pointer-events: none; }
.dn-donate-section .dn-section-label { color: var(--gold); }
.dn-donate-section .dn-section-title { color: #fff; }
.dn-donate-section .dn-section-sub { color: rgba(255,255,255,.65); }
.dn-donate-card { max-width: 860px; margin: 0 auto; position: relative; z-index: 2; background: rgba(255,255,255,.06); border: 1px solid rgba(201,168,76,.30); border-radius: 28px; padding: 52px 44px; backdrop-filter: blur(10px); box-shadow: 0 24px 64px rgba(0,0,0,.30); text-align: center; }
.dn-gold-rule { width: 64px; height: 2px; background: var(--gold); margin: 0 auto 28px; opacity: .8; }
.dn-plan-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin: 0 auto 36px; }
.dn-plan-card { background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.12); border-radius: 20px; padding: 28px 20px; transition: all .3s; }
.dn-plan-card:hover { transform: translateY(-4px); border-color: rgba(201,168,76,.55); background: rgba(255,255,255,.09); }
.dn-plan-card.featured { border-color: rgba(201,168,76,.65); background: rgba(201,168,76,.10); }
.dn-plan-name { font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 2px; color: var(--gold2); margin-bottom: 12px; }
.dn-plan-amount { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 900; color: #fff; line-height: 1; margin-bottom: 8px; }
.dn-plan-period { font-size: 14px; color: rgba(255,255,255,.6); font-weight: 300; }
.dn-plan-note { font-size: 13px; color: rgba(255,255,255,.55); margin-top: 10px; line-height: 1.6; font-weight: 300; }
.dn-button-wrap { text-align: center; margin: 8px auto 20px; position: relative; z-index: 2; }
.dn-secure-note { font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: .5px; color: rgba(255,255,255,.5); line-height: 1.8; }
.dn-secure-note strong { color: var(--gold2); font-weight: 500; }

/* STEPS */
.dn-steps-section { padding: 90px 20px; background: var(--cream); }
.dn-steps { display: flex; justify-content: center; gap: 0; max-width: 860px; margin: 0 auto; flex-wrap: wrap; position: relative; }
.dn-steps::before { content: ''; position: absolute; top: 40px; left: calc(12.5% + 20px); right: calc(12.5% + 20px); height: 2px; background: linear-gradient(90deg, var(--sage), var(--gold)); opacity: .3; }
.dn-step { flex: 1; min-width: 160px; text-align: center; padding: 0 16px; }
.dn-step-circle { width: 80px; height: 80px; border-radius: 50%; background: var(--deep); border: 3px solid var(--sage); display: flex; align-items: center; justify-content: center; font-size: 28px; margin: 0 auto 20px; box-shadow: 0 8px 24px rgba(0,0,0,.12); transition: all .3s; }
.dn-step:hover .dn-step-circle { transform: scale(1.1); }
.dn-step h4 { font-family: 'Playfair Display', serif; font-size: 17px; font-weight: 700; color: var(--forest); margin-bottom: 8px; }
.dn-step p { font-size: 14px; color: #777; line-height: 1.6; font-weight: 300; }

/* TRUST */
.dn-trust { background: var(--deep); padding: 60px 20px; text-align: center; }
.dn-trust-title { font-family: 'Playfair Display', serif; font-size: 28px; color: #fff; margin-bottom: 36px; }
.dn-trust-badges { display: flex; justify-content: center; flex-wrap: wrap; gap: 16px; }
.dn-trust-badge { display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12); border-radius: 50px; padding: 12px 22px; font-size: 14px; color: rgba(255,255,255,.8); }

/* FINAL CTA */
.dn-final-cta { padding: 120px 20px; background: var(--warm); text-align: center; }
.dn-final-cta h2 { font-family: 'Playfair Display', serif; font-size: clamp(32px, 5vw, 56px); font-weight: 900; color: var(--forest); line-height: 1.15; margin-bottom: 20px; }
.dn-final-cta h2 em { font-style: italic; color: var(--mid); }
.dn-final-cta p { font-size: 19px; color: #666; max-width: 480px; margin: 0 auto 40px; line-height: 1.7; font-weight: 300; }
.dn-donate-now-btn { display: inline-flex; align-items: center; gap: 12px; background: var(--forest); color: var(--gold2); font-family: 'Playfair Display', serif; font-weight: 700; font-size: 18px; padding: 18px 44px; border-radius: 50px; text-decoration: none; transition: all .3s; box-shadow: 0 8px 32px rgba(13,43,26,.25); }
.dn-donate-now-btn:hover { background: var(--deep); transform: translateY(-4px); color: var(--gold2); }

@keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
@keyframes floatCoin { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-12px); } }
.dn-reveal { opacity: 0; transform: translateY(40px); transition: opacity .7s ease, transform .7s ease; }
.dn-reveal.visible { opacity: 1; transform: translateY(0); }

/* RESPONSIVE FIXES */
@media(max-width: 768px) {
    .dn-side-decor-img { display: none !important; }
    .dn-hero-top-img {
    display: flex !important;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-bottom: 28px;
}
.dn-hero-top-img img {
    width: 170px;
    height: 170px;
    object-fit: contain;
    opacity: 0.95;
    display: block;
    margin: 0 auto;
    filter: brightness(1.2) drop-shadow(0 6px 20px rgba(201,168,76,0.55));
    animation: floatCoin 3.5s ease-in-out infinite;
}
    .dn-hero { padding: 40px 20px; }
    .dn-donate-card { padding: 36px 22px; }
    .dn-plan-grid { grid-template-columns: 1fr; }
    .dn-steps::before { display: none; }
}
</style>

<section class="dn-hero">
  <div class="dn-hero-bg"></div>

  <img src="https://al-miftah.org/wp-content/uploads/2026/04/WhatsApp_Image_2026-03-31_at_1.47.44_PM-removebg-preview-1.png" class="dn-side-decor-img dn-decor-left">
  <img src="https://al-miftah.org/wp-content/uploads/2026/04/WhatsApp_Image_2026-03-31_at_1.47.44_PM-removebg-preview-1.png" class="dn-side-decor-img dn-decor-right">

  <div class="dn-particle" style="left:10%;animation-duration:8s;animation-delay:0s"></div>
  <div class="dn-particle" style="left:25%;animation-duration:11s;animation-delay:2s;background:var(--sage)"></div>
  <div class="dn-particle" style="left:50%;animation-duration:9s;animation-delay:4s"></div>
  <div class="dn-particle" style="left:70%;animation-duration:13s;animation-delay:1s;background:var(--sage)"></div>
  <div class="dn-particle" style="left:85%;animation-duration:10s;animation-delay:6s"></div>

  <div class="dn-hero-content">
    <div class="dn-hero-top-img">
        <img src="https://al-miftah.org/wp-content/uploads/2026/04/WhatsApp_Image_2026-03-31_at_1.47.44_PM-removebg-preview-1.png">
    </div>

    <div class="dn-eyebrow">* &nbsp;&nbsp; Al-Miftah CHARITY FOUNDATION &nbsp;&nbsp; *</div>
    <h1>Ek Rupee Bhi<br><em>Badal Sakta Hai</em><br>Zindagi</h1>
    <p class="dn-hero-sub">Aapka donation seedha zaroortmand logon tak pahunchta hai &mdash; koi beechwaala nahi, koi commission nahi. Sirf insaniyat.</p>
    <button class="dn-hero-cta" onclick="document.getElementById('dn-donate').scrollIntoView({behavior:'smooth'})">
      Abhi Donate Karein &rarr;
    </button>
  </div>
</section>

<section class="dn-stats-strip">
  <div class="dn-stats-inner">
    <div class="dn-stat dn-reveal"><span class="dn-stat-num" data-count="1240">0</span><div class="dn-stat-label">FAMILIES HELPED</div></div>
    <div class="dn-stat dn-reveal"><span class="dn-stat-num" data-count="350">0</span><div class="dn-stat-label">ACTIVE DONORS</div></div>
    <div class="dn-stat dn-reveal"><span class="dn-stat-num" data-prefix="Rs." data-count="8">0</span><div class="dn-stat-label">LAKH+ DONATED</div></div>
    <div class="dn-stat dn-reveal"><span class="dn-stat-num" data-count="100" data-suffix="%">0</span><div class="dn-stat-label">TRANSPARENT</div></div>
  </div>
</section>

<section class="dn-why">
  <div style='text-align: center;color: rgb(45, 106, 79);font-size: 11px;font-family: "'><strong><span style="font-size: 20px;">HAMARA KAAM</span></strong></div>
  <h2 class="dn-section-title dn-reveal">Har Donation Ka <em>Seedha Asar</em> Hota Hai</h2>
  <p class="dn-section-sub dn-reveal">Aapka har ek rupya ek real insaan ki zindagi mein farq laata hai. Yeh kuch areas hain jahan hum kaam karte hain.</p>

  <div class="dn-causes">
    <div class="dn-cause-card dn-reveal">
      <span class="dn-cause-icon">&#128218;</span>
      <h3>Taleem</h3>
      <p>Garib bacchon ki padhai ke liye books, uniform aur school fees ka intezam karte hain.</p>
      <span class="dn-cause-tag">EDUCATION</span>
    </div>
    <div class="dn-cause-card dn-reveal">
      <span class="dn-cause-icon">&#10084;</span>
      <h3>Sehat</h3>
      <p>Beemar logon ke ilaaj mein madad karte hain &mdash; dawai se lekar operation tak.</p>
      <span class="dn-cause-tag">HEALTHCARE</span>
    </div>
    <div class="dn-cause-card dn-reveal">
      <span class="dn-cause-icon">&#127859;</span>
      <h3>Bhojan</h3>
      <p>Bhookhe ghar waalon ke liye khana pahunchate hain &mdash; koi bhooka na soye.</p>
      <span class="dn-cause-tag">FOOD &amp; NUTRITION</span>
    </div>
    <div class="dn-cause-card dn-reveal">
      <span class="dn-cause-icon">&#127968;</span>
      <h3>Aashray</h3>
      <p>Besahara logon ke rehne ka intezam karte hain aur pakke makaan banane mein saath dete hain.</p>
      <span class="dn-cause-tag">SHELTER</span>
    </div>
  </div>
</section>

<section class="dn-donate-section" id="dn-donate">
  <div class="dn-donate-card dn-reveal">
    <div class="dn-section-label">DONATE KAREIN</div>
    <div class="dn-gold-rule"></div>
    <h2 class="dn-section-title" style="color:#fff;">Ek Chhota Donation,<br><em style="color:var(--gold2)">Ek Badi Muskaan</em></h2>
    <p class="dn-section-sub" style="color:rgba(255,255,255,.65); margin-bottom:40px;">Apni marzi se ek plan chunein, phir secure checkout me apni details bharein.</p>

    <div class="dn-plan-grid">
      <div class="dn-plan-card">
        <div class="dn-plan-name">MONTHLY</div>
        <div class="dn-plan-amount">&#8377;30</div>
        <div class="dn-plan-period">har mahina</div>
        <div class="dn-plan-note">Roz ki chhoti madad, lagatar asar.</div>
      </div>
      <div class="dn-plan-card featured">
        <div class="dn-plan-name">YEARLY</div>
        <div class="dn-plan-amount">&#8377;365</div>
        <div class="dn-plan-period">har saal</div>
        <div class="dn-plan-note">Saal bhar ka saath, ek hi baar me.</div>
      </div>
      <div class="dn-plan-card">
        <div class="dn-plan-name">LIFETIME</div>
        <div class="dn-plan-amount">&#8377;7,786</div>
        <div class="dn-plan-period">ek baar</div>
        <div class="dn-plan-note">Ek hi donation, lambi yaadein.</div>
      </div>
    </div>

    <div class="dn-button-wrap">
    <form><script src="https://cdn.razorpay.com/static/widget/subscription-button.js" data-subscription_button_id="pl_Tu9TZO67rbfjaA" data-button_theme="brand-color" async> </script> </form>
    </div>

    <div class="dn-secure-note">SECURE CHECKOUT<br><strong>Recurring donation ko donor kabhi bhi cancel kar sakta hai.</strong></div>
  </div>
</section>

<section class="dn-steps-section">
  <div class="dn-section-label">KITNA AASAAN HAI</div>
  <h2 class="dn-section-title dn-reveal">3 Minute Mein <em>Donate Karein</em></h2>
  <div class="dn-steps">
    <div class="dn-step dn-reveal">
      <div class="dn-step-circle">1</div>
      <h4>Plan Chunein</h4>
      <p>Monthly, Yearly ya Lifetime me se apni marzi ka plan chunein</p>
    </div>
    <div class="dn-step dn-reveal">
      <div class="dn-step-circle">2</div>
      <h4>Details Bharein</h4>
      <p>Secure checkout me apna naam aur contact details bharein</p>
    </div>
    <div class="dn-step dn-reveal">
      <div class="dn-step-circle">3</div>
      <h4>Confirm Karein</h4>
      <p>Checkout confirm karein &mdash; donation record ho jayega</p>
    </div>
  </div>
</section>

<section class="dn-trust">
  <h3 class="dn-trust-title dn-reveal">Aap Hum Par Bharosa Kyun Karein?</h3>
  <div class="dn-trust-badges">
    <div class="dn-trust-badge dn-reveal"><span>&#128274;</span> 100% Transparent</div>
    <div class="dn-trust-badge dn-reveal"><span>&#128202;</span> Regular Reports</div>
    <div class="dn-trust-badge dn-reveal"><span>0</span> Zero Commission</div>
  </div>
</section>

<section class="dn-final-cta">
  <h2 class="dn-reveal">Aaj Kisi Ki <em>Muskaan</em> Baniye</h2>
  <a href="#dn-donate" class="dn-donate-now-btn dn-reveal" onclick="document.getElementById('dn-donate').scrollIntoView({behavior:'smooth'});return false;">
    Donate Karein &nbsp;&rarr;
  </a>
</section>

<script>
var obs = new IntersectionObserver(function(entries) {
  entries.forEach(function(e, i) {
    if (e.isIntersecting) {
      setTimeout(function(){ e.target.classList.add('visible'); }, i * 80);
      obs.unobserve(e.target);
    }
  });
}, { threshold: 0.12 });
document.querySelectorAll('.dn-reveal').forEach(function(el){ obs.observe(el); });

function animateCounter(el) {
  var target = parseInt(el.getAttribute('data-count'));
  var prefix = el.getAttribute('data-prefix') || '';
  var suffix = el.getAttribute('data-suffix') || '';
  var start = null;
  function step(ts) {
    if (!start) start = ts;
    var p = Math.min((ts - start) / 1800, 1);
    var e = 1 - Math.pow(1 - p, 3);
    el.textContent = prefix + Math.floor(e * target) + suffix;
    if (p < 1) requestAnimationFrame(step);
    else el.textContent = prefix + target + suffix;
  }
  requestAnimationFrame(step);
}
var cobs = new IntersectionObserver(function(entries) {
  entries.forEach(function(e) {
    if (e.isIntersecting) { animateCounter(e.target); cobs.unobserve(e.target); }
  });
}, { threshold: 0.5 });
document.querySelectorAll('[data-count]').forEach(function(el){ cobs.observe(el); });
</script>

<?php get_footer(); ?>
