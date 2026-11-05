<?php 
include 'header.php'; 
require_once 'admin-panel/db.php';

// Fetch gallery images from database
$stmt = $pdo->query("SELECT * FROM custom_gallery ORDER BY id DESC");
$gallery = $stmt->fetchAll();
?>

<section class="common-banner">
    <div class="container">
       <div class="row">
          <div class="common-banner__content text-center">
             <span class="sub-title"><i class="fa-solid fa-camera"></i> Photos & Moments</span>              
             <h2 class="title-animation">Trust Photo Gallery</h2>
          </div>
       </div>
    </div>
    <div class="banner-bg">
       <img src="assets/images/pattern.jpg" onerror="this.src='https://al-miftah.org/wp-content/uploads/2025/01/pattern.jpg'" alt="Banner Pattern">
    </div>
</section>

<div id="content" class="site-content" style="padding: 80px 0; background: #faf8f5;">
    <div class="container">
        <div class="row gutter-30">
            <?php if (empty($gallery)): ?>
                <div class="col-12 text-center" style="padding: 60px 0;">
                    <i class="fa-solid fa-images" style="font-size: 48px; color: #c8963e; margin-bottom: 20px;"></i>
                    <h3>Abhi koi photo upload nahi hui hai.</h3>
                    <p style="color: #666;">Jaldi hi school aur relief drives ki tasweerein add ki jayengi!</p>
                </div>
            <?php else: ?>
                <?php foreach ($gallery as $item): ?>
                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="gallery-card" style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 8px 25px rgba(0,0,0,0.05); border:1px solid #eee; transition:all 0.3s ease;">
                        <div style="position:relative; overflow:hidden; height:260px;">
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" onerror="this.src='https://al-miftah.org/wp-content/uploads/2026/02/Gemini_Generated_Image_trr507trr507trr5.png'" alt="Gallery Item" style="width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease;" class="gal-img" />
                        </div>
                        <?php if (!empty($item['caption'])): ?>
                        <div style="padding:16px 20px; font-size:14px; font-weight:600; color:#122f2a; border-top:1px solid #f0f0f0;">
                            <?php echo htmlspecialchars($item['caption']); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.gallery-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
.gallery-card:hover .gal-img { transform: scale(1.06); }
</style>

<?php include 'footer.php'; ?>
