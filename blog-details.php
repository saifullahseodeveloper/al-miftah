<?php 
include 'header.php'; 
require_once 'admin-panel/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM custom_blogs WHERE id = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch();

if (!$blog) {
    echo '<div class="container text-center" style="padding: 100px 0;">
            <h2>Article Not Found</h2>
            <p>Yeh article maujood nahi hai.</p>
            <a href="blog.php" class="btn--primary" style="display:inline-block; margin-top:15px;">Back to Blog</a>
          </div>';
    include 'footer.php';
    exit;
}

$img = !empty($blog['image_url']) ? $blog['image_url'] : 'assets/images/blog-default.jpg';
?>

<section class="common-banner">
    <div class="container">
       <div class="row">
          <div class="common-banner__content text-center">
             <span class="sub-title"><i class="fa-solid fa-book-open"></i> Al-Miftah Publications</span>
             <h2 class="title-animation"><?php echo htmlspecialchars($blog['title']); ?></h2>
          </div>
       </div>
    </div>
    <div class="banner-bg">
       <img src="assets/images/pattern.jpg" onerror="this.src='https://al-miftah.org/wp-content/uploads/2025/01/pattern.jpg'" alt="Banner Pattern">
    </div>
</section>

<div id="content" class="site-content" style="padding: 70px 0; background: #faf8f5;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <article style="background:#fff; border-radius:18px; padding:40px; box-shadow:0 8px 30px rgba(0,0,0,0.05); border:1px solid #eee;">
                    <img src="<?php echo htmlspecialchars($img); ?>" onerror="this.src='https://al-miftah.org/wp-content/uploads/2026/02/Gemini_Generated_Image_trr507trr507trr5.png'" alt="Blog Image" style="width:100%; border-radius:14px; max-height:450px; object-fit:cover; margin-bottom:25px;" />
                    
                    <div style="display:flex; gap:20px; font-size:13.5px; color:#777; margin-bottom:20px; border-bottom:1px solid #f0f0f0; padding-bottom:15px;">
                        <span><i class="fa-regular fa-calendar" style="color:#c8963e;"></i> <?php echo date('d M, Y', strtotime($blog['created_at'])); ?></span>
                        <span><i class="fa-solid fa-user" style="color:#1B6B3A;"></i> Al-Miftah Editorial</span>
                    </div>

                    <h1 style="font-size:32px; font-weight:800; color:#122f2a; margin-bottom:25px; line-height:1.3;">
                        <?php echo htmlspecialchars($blog['title']); ?>
                    </h1>

                    <div style="font-size:16.5px; line-height:1.9; color:#4a5568;">
                        <?php echo nl2br(htmlspecialchars($blog['content'])); ?>
                    </div>

                    <div style="margin-top:40px; padding-top:20px; border-top:1px solid #f0f0f0; display:flex; justify-content:space-between; align-items:center;">
                        <a href="blog.php" style="color:#1B6B3A; font-weight:700; text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> All Articles</a>
                        <a href="donate.php" style="background:#c8963e; color:#fff; padding:10px 24px; border-radius:30px; text-decoration:none; font-weight:700; font-size:13px;">Support Our Trust</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
