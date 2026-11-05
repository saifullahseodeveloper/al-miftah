<?php 
include 'header.php'; 
require_once 'admin-panel/db.php';

// Fetch causes from database
$stmt = $pdo->query("SELECT * FROM custom_causes ORDER BY id DESC");
$causes = $stmt->fetchAll();
?>

<section class="common-banner">
    <div class="container">
       <div class="row">
          <div class="common-banner__content text-center">
             <span class="sub-title"><i class="fa-solid fa-hand-holding-heart"></i> Start donating to poor children</span>              
             <h2 class="title-animation">Our Causes & Campaigns</h2>
          </div>
       </div>
    </div>
    <div class="banner-bg">
       <img src="assets/images/pattern.jpg" onerror="this.src='https://al-miftah.org/wp-content/uploads/2025/01/pattern.jpg'" alt="Banner Pattern">
    </div>
    <div class="shape">
       <img src="assets/images/About-bg-Img.jpg" onerror="this.src='https://al-miftah.org/wp-content/uploads/2025/07/About-bg-Img.jpg'" alt="Shape">
    </div>
</section>

<div id="content" class="site-content" style="padding: 80px 0; background: #fdfaf4;">
    <div class="container">
        <div class="row gutter-30">
            <?php if (empty($causes)): ?>
                <div class="col-12 text-center" style="padding: 60px 0;">
                    <i class="fa-solid fa-heart-circle-exclamation" style="font-size: 48px; color: #c8963e; margin-bottom: 20px;"></i>
                    <h3>Abhi koi active campaign nahi hai.</h3>
                    <p style="color: #666;">Jaldi hi naye charity causes update honge!</p>
                </div>
            <?php else: ?>
                <?php foreach ($causes as $cause): 
                    $raised = (float)($cause['raised_amount'] ?? 0);
                    $goal = (float)($cause['goal_amount'] ?? 1);
                    if ($goal <= 0) $goal = 1;
                    $pct = round(($raised / $goal) * 100);
                    if ($pct > 100) $pct = 100;
                    $img = !empty($cause['image_url']) ? $cause['image_url'] : 'assets/images/cause-default.jpg';
                ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="cause-card">
                        <img class="card-img" src="<?php echo htmlspecialchars($img); ?>" onerror="this.src='https://al-miftah.org/wp-content/uploads/2026/02/Gemini_Generated_Image_trr507trr507trr5.png'" alt="<?php echo htmlspecialchars($cause['title']); ?>" />
                        <div class="card-body">
                            <div class="card-category"><?php echo htmlspecialchars($cause['category'] ?? 'Education'); ?></div>
                            <h3 class="card-title"><?php echo htmlspecialchars($cause['title']); ?></h3>
                            <div class="card-desc">
                                <?php echo htmlspecialchars(mb_substr($cause['description'], 0, 130)) . '...'; ?>
                            </div>
                            <div class="progress-label">
                                <span class="raised-pct"><?php echo $pct; ?>% Raised</span>
                                <span>Goal: ₹<?php echo number_format($goal); ?></span>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: <?php echo $pct; ?>%;"></div>
                            </div>
                            <div class="card-footer">
                                <div class="raised-info">
                                    <strong>₹<?php echo number_format($raised); ?></strong>
                                    <span>Raised so far</span>
                                </div>
                                <a class="donate-btn" href="cause-details.php?id=<?php echo $cause['id']; ?>">Donate Now</a>
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
.cause-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid #eef2eb;
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 10px 30px rgba(0,0,0,0.04);
  transition: all 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}
.cause-card:hover { transform: translateY(-7px); box-shadow: 0 18px 40px rgba(27,107,58,0.12); border-color: #c8963e; }
.cause-card .card-img { width: 100%; height: 230px; object-fit: cover; background: #eee; }
.cause-card .card-body { padding: 25px; flex: 1; display: flex; flex-direction: column; }
.cause-card .card-category { font-size: 11px; font-weight: 700; color: #C8963E; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
.cause-card .card-title { font-size: 19px; font-weight: 700; color: #122f2a; margin-bottom: 12px; line-height: 1.4; }
.cause-card .card-desc { font-size: 13.5px; color: #667471; line-height: 1.6; margin-bottom: 20px; flex-grow: 1; }
.cause-card .progress-label { display: flex; justify-content: space-between; font-size: 13px; color: #555; margin-bottom: 8px; font-weight: 600; }
.cause-card .raised-pct { color: #1B6B3A; font-weight: 700; }
.cause-card .progress-bar-bg { background: #e8f5ed; border-radius: 10px; height: 9px; margin-bottom: 20px; overflow: hidden; }
.cause-card .progress-bar-fill { background: linear-gradient(90deg, #1B6B3A, #38a169); height: 100%; border-radius: 10px; transition: width 0.6s ease; }
.cause-card .card-footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f0f0f0; padding-top: 18px; margin-top: auto; }
.cause-card .raised-info strong { color: #1B6B3A; font-size: 17px; display: block; line-height: 1.2; }
.cause-card .raised-info span { font-size: 11.5px; color: #888; }
.cause-card .donate-btn { background: #1B6B3A; color: #fff; font-weight: 700; font-size: 13px; padding: 10px 22px; border-radius: 30px; text-decoration: none; transition: 0.3s; box-shadow: 0 4px 12px rgba(27,107,58,0.25); }
.cause-card .donate-btn:hover { background: #C8963E; color: #fff; transform: scale(1.04); }
</style>

<?php include 'footer.php'; ?>
