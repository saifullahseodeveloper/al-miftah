<?php 
include 'header.php'; 
$sent = isset($_GET['sent']);
$err = isset($_GET['err']);
?>

<section class="common-banner">
    <div class="container">
       <div class="row">
          <div class="common-banner__content text-center">
             <span class="sub-title"><i class="fa-solid fa-envelope"></i> Get In Touch</span>              
             <h2 class="title-animation">Contact Us</h2>
          </div>
       </div>
    </div>
    <div class="banner-bg">
       <img src="assets/images/pattern.jpg" onerror="this.src='https://al-miftah.org/wp-content/uploads/2025/01/pattern.jpg'" alt="Image">
    </div>
</section>

<div id="content" class="site-content" style="padding: 80px 0; background: #faf8f5;">
    <div class="container">

        <?php if ($sent): ?>
        <div style="background:#e6f9ed; border:1.5px solid #52b788; color:#1b4332; padding:18px; border-radius:12px; margin-bottom:30px; text-align:center; font-weight:600; font-size:16px;">
            <i class="fa-solid fa-circle-check" style="font-size:22px; color:#1b6b3a; margin-right:8px;"></i>
            Shukriya! Aapka paigham hum tak pahunch gaya hai. Al-Miftah team aapse jaldi rabta karegi.
        </div>
        <?php endif; ?>

        <?php if ($err): ?>
        <div style="background:#fde8e8; border:1.5px solid #f98080; color:#9b1c1c; padding:14px; border-radius:12px; margin-bottom:30px; text-align:center; font-weight:600;">
            <i class="fa-solid fa-triangle-exclamation"></i> Barah-e-karam saari zaroori fields sahi se bharein.
        </div>
        <?php endif; ?>

        <div class="row gutter-60">
            <!-- Contact Info -->
            <div class="col-lg-6 mb-5">
                <div class="contact-info" style="margin-bottom: 30px;">
                    <span style="color: #C8963E; font-weight: 700; text-transform: uppercase; letter-spacing:1px;"><i class="fa-solid fa-headset"></i> We Are Here For You</span>
                    <h2 style="font-size: 34px; font-weight: 800; color:#122f2a; margin: 12px 0 25px;">Rabta Karein</h2>
                    
                    <div class="info-box d-flex align-items-center mb-4" style="background: #fff; padding: 22px; border-radius: 14px; border: 1px solid #eee; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                        <div class="icon" style="background: #1B6B3A; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 20px; flex-shrink:0;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h6 style="margin-bottom: 5px; font-weight: 700; color:#122f2a;">Markazi Pata (Address)</h6>
                            <p style="margin: 0; color: #666; font-size:14px;">Ranipur, Haidergarh, Barabanki, Uttar Pradesh, India - 225124</p>
                        </div>
                    </div>
                    
                    <div class="info-box d-flex align-items-center mb-4" style="background: #fff; padding: 22px; border-radius: 14px; border: 1px solid #eee; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                        <div class="icon" style="background: #1B6B3A; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 20px; flex-shrink:0;">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h6 style="margin-bottom: 5px; font-weight: 700; color:#122f2a;">Phone / WhatsApp Helpline</h6>
                            <p style="margin: 0; color: #666; font-size:14px;"><a href="tel:+918840432382" style="text-decoration: none; color: #1B6B3A; font-weight:700;">+91 8840432382</a> / +91-9918364993</p>
                        </div>
                    </div>
                    
                    <div class="info-box d-flex align-items-center mb-4" style="background: #fff; padding: 22px; border-radius: 14px; border: 1px solid #eee; box-shadow:0 4px 15px rgba(0,0,0,0.03);">
                        <div class="icon" style="background: #1B6B3A; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 20px; flex-shrink:0;">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h6 style="margin-bottom: 5px; font-weight: 700; color:#122f2a;">Official Email</h6>
                            <p style="margin: 0; color: #666; font-size:14px;"><a href="mailto:info@al-miftah.org" style="text-decoration: none; color: inherit;">info@al-miftah.org</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-6">
                <div class="contact-form-wrap" style="background: #fff; padding: 40px; border-radius: 18px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid #eee;">
                    <h4 style="font-size: 26px; font-weight: 800; color:#122f2a; margin-bottom: 8px;">Paigham Bhein</h4>
                    <p style="color: #666; font-size:14px; margin-bottom: 25px;">Aapka email secret rahega. Mandatory fields par * laga hai.</p>
                    
                    <form action="process-contact.php" method="POST" id="contact-form">
                        <div class="mb-3 position-relative">
                            <label style="font-size:13px; font-weight:700; color:#122f2a; margin-bottom:5px; display:block;">Full Name *</label>
                            <input type="text" name="name" placeholder="Aapka Poora Naam" required style="width: 100%; padding: 13px 18px; border: 1.5px solid #e0e0e0; border-radius: 10px; background: #fff; font-size:14px;">
                        </div>
                        
                        <div class="mb-3 position-relative">
                            <label style="font-size:13px; font-weight:700; color:#122f2a; margin-bottom:5px; display:block;">Email Address *</label>
                            <input type="email" name="email" placeholder="email@example.com" required style="width: 100%; padding: 13px 18px; border: 1.5px solid #e0e0e0; border-radius: 10px; background: #fff; font-size:14px;">
                        </div>
                        
                        <div class="mb-3 position-relative">
                            <label style="font-size:13px; font-weight:700; color:#122f2a; margin-bottom:5px; display:block;">Mobile Number</label>
                            <input type="tel" name="mobile" placeholder="Mobile Number" style="width: 100%; padding: 13px 18px; border: 1.5px solid #e0e0e0; border-radius: 10px; background: #fff; font-size:14px;">
                        </div>

                        <div class="mb-3 position-relative">
                            <label style="font-size:13px; font-weight:700; color:#122f2a; margin-bottom:5px; display:block;">Subject</label>
                            <input type="text" name="subject" placeholder="Inquiry Subject" style="width: 100%; padding: 13px 18px; border: 1.5px solid #e0e0e0; border-radius: 10px; background: #fff; font-size:14px;">
                        </div>
                        
                        <div class="mb-4 position-relative">
                            <label style="font-size:13px; font-weight:700; color:#122f2a; margin-bottom:5px; display:block;">Message *</label>
                            <textarea name="message" rows="4" placeholder="Aapka Paigham..." required style="width: 100%; padding: 13px 18px; border: 1.5px solid #e0e0e0; border-radius: 10px; background: #fff; font-size:14px; resize: vertical;"></textarea>
                        </div>
                        
                        <button type="submit" style="background: #1B6B3A; color: white; border: none; padding: 14px 35px; border-radius: 30px; font-weight: 700; width: 100%; font-size:15px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(27,107,58,0.25);">
                            Send Message <i class="fa-solid fa-paper-plane" style="margin-left: 8px;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
