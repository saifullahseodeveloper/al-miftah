<?php 
include 'header.php'; 
require_once 'admin-panel/db.php';

// Fetch blogs from database
$stmt = $pdo->query("SELECT * FROM custom_blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll();
?>

<section class="common-banner">
    <div class="container">
       <div class="row">
          <div class="common-banner__content text-center">
             <span class="sub-title"><i class="fa-solid fa-book-open"></i> Insights & Teachings</span>              
             <h2 class="title-animation">Our Blog & Articles</h2>
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
            <?php if (empty($blogs)): ?>
                <div class="col-12 text-center" style="padding: 60px 0;">
                    <i class="fa-solid fa-newspaper" style="font-size: 48px; color: #c8963e; margin-bottom: 20px;"></i>
                    <h3>Abhi koi article publish nahi hua hai.</h3>
                    <p style="color: #666;">Jaldi hi naye educational & Islamic articles shaya honge!</p>
                </div>
            <?php else: ?>
                <?php foreach ($blogs as $blog): 
                    $img = !empty($blog['image_url']) ? $blog['image_url'] : 'assets/images/blog-default.jpg';
                ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="blog-card" style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 8px 25px rgba(0,0,0,0.05); border:1px solid #eee; display:flex; flex-direction:column; height:100%; transition:all 0.3s ease;">
                        <img src="<?php echo htmlspecialchars($img); ?>" onerror="this.src='https://al-miftah.org/wp-content/uploads/2026/02/Gemini_Generated_Image_trr507trr507trr5.png'" alt="<?php echo htmlspecialchars($blog['title']); ?>" style="width:100%; height:220px; object-fit:cover;" />
                        <div style="padding:25px; flex:1; display:flex; flex-direction:column;">
                            <div style="font-size:12px; color:#888; margin-bottom:10px;">
                                <i class="fa-regular fa-calendar" style="color:#c8963e;"></i> <?php echo date('d M, Y', strtotime($blog['created_at'])); ?>
                            </div>
                            <h3 style="font-size:19px; font-weight:700; color:#122f2a; margin-bottom:12px; line-height:1.4;">
                                <?php echo htmlspecialchars($blog['title']); ?>
                            </h3>
                            <div style="font-size:14px; color:#667471; line-height:1.6; margin-bottom:20px; flex-grow:1;">
                                <?php echo htmlspecialchars(mb_substr(strip_tags($blog['content']), 0, 130)) . '...'; ?>
                            </div>
                            <div style="border-top:1px solid #f0f0f0; padding-top:15px; margin-top:auto;">
                                <a href="blog-details.php?id=<?php echo $blog['id']; ?>" style="color:#1B6B3A; font-weight:700; text-decoration:none; font-size:14px; display:inline-flex; align-items:center; gap:6px;">
                                    Read Full Article <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.blog-card:hover { transform: translateY(-6px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-color:#c8963e; }
</style>

<?php include 'footer.php'; ?>
