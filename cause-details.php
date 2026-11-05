<?php 
include 'header.php'; 
require_once 'admin-panel/db.php';

// Get ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch cause from database
$stmt = $pdo->prepare("SELECT * FROM custom_causes WHERE id = ?");
$stmt->execute([$id]);
$cause = $stmt->fetch();

if (!$cause) {
    echo '<div class="container text-center" style="padding: 100px 0;">
            <i class="fa-solid fa-circle-exclamation" style="font-size:48px; color:#c8963e; margin-bottom:15px;"></i>
            <h2>Cause Not Found</h2>
            <p>Yeh campaign maujood nahi hai ya remove kar di gayi hai.</p>
            <a href="causes.php" class="btn--primary" style="display:inline-block; margin-top:15px;">Back to Causes</a>
          </div>';
    include 'footer.php';
    exit;
}

$raised = (float)($cause['raised_amount'] ?? 0);
$goal = (float)($cause['goal_amount'] ?? 1);
if ($goal <= 0) $goal = 1;
$pct = round(($raised / $goal) * 100);
if ($pct > 100) $pct = 100;
$img = !empty($cause['image_url']) ? $cause['image_url'] : 'assets/images/cause-default.jpg';
?>

<section class="common-banner">
    <div class="container">
       <div class="row">
          <div class="common-banner__content text-center">
             <span class="sub-title"><i class="fa-solid fa-hand-holding-heart"></i> <?php echo htmlspecialchars($cause['category'] ?? 'Campaign'); ?></span>
             <h2 class="title-animation"><?php echo htmlspecialchars($cause['title']); ?></h2>
          </div>
       </div>
    </div>
    <div class="banner-bg">
       <img src="assets/images/pattern.jpg" onerror="this.src='https://al-miftah.org/wp-content/uploads/2025/01/pattern.jpg'" alt="Banner Pattern">
    </div>
</section>

<div id="content" class="site-content" style="padding: 70px 0; background: #faf8f5;">
    <div class="container">
        <div class="row">
            <!-- Left Main Column -->
            <div class="col-lg-8 mb-5">
                <div class="cause-detail-box" style="background:#fff; border-radius:18px; padding:35px; box-shadow:0 8px 30px rgba(0,0,0,0.05); border:1px solid #eee;">
                    <img src="<?php echo htmlspecialchars($img); ?>" onerror="this.src='https://al-miftah.org/wp-content/uploads/2026/02/Gemini_Generated_Image_trr507trr507trr5.png'" alt="Cause Image" style="width:100%; border-radius:14px; max-height:450px; object-fit:cover; margin-bottom:30px;" />
                    
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <span style="font-size:13px; font-weight:700; color:#c8963e; text-transform:uppercase; letter-spacing:1px;"><?php echo htmlspecialchars($cause['category'] ?? 'Education Trust'); ?></span>
                        <span style="font-size:13px; color:#888;"><i class="fa-regular fa-calendar"></i> <?php echo date('d M, Y', strtotime($cause['created_at'])); ?></span>
                    </div>

                    <h1 style="font-size:30px; font-weight:800; color:#122f2a; margin-bottom:20px;"><?php echo htmlspecialchars($cause['title']); ?></h1>
                    
                    <!-- Progress Section -->
                    <div style="background:#f4f9f6; padding:22px; border-radius:12px; margin-bottom:30px; border:1px solid #d8ede0;">
                        <div style="display:flex; justify-content:space-between; margin-bottom:10px; font-weight:700;">
                            <span style="color:#1B6B3A; font-size:16px;"><?php echo $pct; ?>% Raised</span>
                            <span style="color:#555; font-size:15px;">Goal: ₹<?php echo number_format($goal); ?></span>
                        </div>
                        <div style="background:#ddeee3; border-radius:10px; height:12px; overflow:hidden; margin-bottom:12px;">
                            <div style="width:<?php echo $pct; ?>%; height:100%; background:linear-gradient(90deg, #1B6B3A, #48bb78); border-radius:10px;"></div>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:13.5px; color:#666;">
                            <span>Raised: <strong style="color:#1B6B3A;">₹<?php echo number_format($raised); ?></strong></span>
                            <span>Remaining: <strong style="color:#c8963e;">₹<?php echo number_format(max(0, $goal - $raised)); ?></strong></span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div style="font-size:16px; line-height:1.8; color:#4a5568;">
                        <?php echo nl2br(htmlspecialchars($cause['description'])); ?>
                    </div>

                    <!-- Direct Donation CTA Box -->
                    <div style="margin-top:40px; padding:30px; background:linear-gradient(135deg, #122f2a, #1B6B3A); border-radius:16px; color:#fff; text-align:center;">
                        <h3 style="color:#fff; font-size:24px; font-weight:700; margin-bottom:10px;">Is Mission Mein Hissa Lein</h3>
                        <p style="color:#e2e8f0; font-size:14px; max-width:550px; margin:0 auto 20px;">Aapki chhoti si madad bhi kisi mustahiq bachche ki zindagi badal sakti hai. Abhi donate karein.</p>
                        <a href="donate.php?cause_id=<?php echo $cause['id']; ?>" class="btn--primary" style="background:#c8963e; color:#fff; padding:14px 35px; border-radius:30px; font-weight:700; text-decoration:none; display:inline-block; font-size:15px; box-shadow:0 6px 20px rgba(0,0,0,0.2);">
                            Donate to this Cause <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Trust Bank Info -->
                <div style="background:#fff; border-radius:18px; padding:30px; box-shadow:0 8px 30px rgba(0,0,0,0.05); border:1px solid #eee; margin-bottom:30px;">
                    <h3 style="font-size:20px; font-weight:800; color:#122f2a; margin-bottom:20px; border-bottom:2px solid #f0f0f0; padding-bottom:12px;">
                        <i class="fa-solid fa-building-columns" style="color:#1B6B3A;"></i> Direct Bank Transfer
                    </h3>
                    <p style="font-size:13px; color:#666; margin-bottom:15px;">Aap Trust ke official account par direct transfer kar sakte hain:</p>
                    <div style="background:#f9fbf9; padding:16px; border-radius:10px; border:1px dashed #b7e4c7; font-size:13.5px; line-height:1.7;">
                        <div><strong>A/C Name:</strong> AL-MIFTAH EDUCATIONAL TRUST</div>
                        <div><strong>Bank:</strong> HDFC Bank</div>
                        <div><strong>A/C No:</strong> 50200088991122</div>
                        <div><strong>IFSC:</strong> HDFC0001234</div>
                        <div><strong>UPI ID:</strong> <span style="color:#1B6B3A; font-weight:700;">almiftah@upi</span></div>
                    </div>
                    <div style="margin-top:20px; text-align:center;">
                        <a href="donate.php?cause_id=<?php echo $cause['id']; ?>" style="color:#1B6B3A; font-weight:700; text-decoration:none; font-size:14px;">
                            Upload Payment Screenshot &rarr;
                        </a>
                    </div>
                </div>

                <!-- Emergency Helpline -->
                <div style="background:#fff; border-radius:18px; padding:30px; box-shadow:0 8px 30px rgba(0,0,0,0.05); border:1px solid #eee;">
                    <h3 style="font-size:20px; font-weight:800; color:#122f2a; margin-bottom:15px;">
                        <i class="fa-solid fa-phone" style="color:#c8963e;"></i> Need Assistance?
                    </h3>
                    <p style="font-size:14px; color:#666; line-height:1.6;">Donation ya admission ke mutalliq kisi bhi sawal ke liye humse rabta karein:</p>
                    <a href="tel:+918840432382" style="display:block; font-size:18px; font-weight:800; color:#1B6B3A; text-decoration:none; margin:10px 0;">+91 8840432382</a>
                    <a href="mailto:info@al-miftah.org" style="color:#666; text-decoration:none; font-size:14px;">info@al-miftah.org</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
