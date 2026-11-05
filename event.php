<?php 
include 'header.php'; 
require_once 'admin-panel/db.php';

// Fetch events from database
$stmt = $pdo->query("SELECT * FROM custom_events ORDER BY event_date DESC");
$events = $stmt->fetchAll();
?>

<section class="common-banner">
    <div class="container">
       <div class="row">
          <div class="common-banner__content text-center">
             <span class="sub-title"><i class="fa-solid fa-calendar-days"></i> Community & Education</span>              
             <h2 class="title-animation">Upcoming & Past Events</h2>
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
            <?php if (empty($events)): ?>
                <div class="col-12 text-center" style="padding: 60px 0;">
                    <i class="fa-solid fa-calendar-xmark" style="font-size: 48px; color: #c8963e; margin-bottom: 20px;"></i>
                    <h3>Abhi koi upcoming event scheduled nahi hai.</h3>
                    <p style="color: #666;">Jaldi hi naye charity drives aur programme ki dates announce hongi!</p>
                </div>
            <?php else: ?>
                <?php foreach ($events as $event): 
                    $img = !empty($event['image_url']) ? $event['image_url'] : 'assets/images/event-default.jpg';
                    $event_time = strtotime($event['event_date']);
                ?>
                <div class="col-12 col-md-6 mb-4">
                    <div class="event-card" style="background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 8px 25px rgba(0,0,0,0.05); border:1px solid #eee; display:flex; flex-direction:column; md:flex-row; height:100%;">
                        <div style="position:relative;">
                            <img src="<?php echo htmlspecialchars($img); ?>" onerror="this.src='https://al-miftah.org/wp-content/uploads/2026/02/Gemini_Generated_Image_trr507trr507trr5.png'" alt="<?php echo htmlspecialchars($event['title']); ?>" style="width:100%; height:240px; object-fit:cover;" />
                            <div style="position:absolute; top:15px; left:15px; background:#1B6B3A; color:#fff; padding:8px 14px; border-radius:10px; text-align:center; font-weight:800; font-size:14px; line-height:1.2; box-shadow:0 4px 10px rgba(0,0,0,0.2);">
                                <span style="font-size:20px; display:block;"><?php echo date('d', $event_time); ?></span>
                                <span style="font-size:11px; text-transform:uppercase;"><?php echo date('M', $event_time); ?></span>
                            </div>
                        </div>
                        <div style="padding:28px; flex:1; display:flex; flex-direction:column;">
                            <div style="font-size:13px; color:#c8963e; font-weight:700; margin-bottom:8px;">
                                <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($event['location']); ?>
                            </div>
                            <h3 style="font-size:20px; font-weight:800; color:#122f2a; margin-bottom:12px; line-height:1.4;">
                                <?php echo htmlspecialchars($event['title']); ?>
                            </h3>
                            <p style="font-size:14px; color:#667471; line-height:1.6; margin-bottom:20px; flex-grow:1;">
                                <?php echo htmlspecialchars($event['description']); ?>
                            </p>
                            <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px solid #f0f0f0; padding-top:16px;">
                                <span style="font-size:13px; color:#888;"><i class="fa-regular fa-clock"></i> <?php echo date('h:i A', $event_time); ?></span>
                                <a href="contact-us.php" style="background:#1B6B3A; color:#fff; padding:8px 20px; border-radius:20px; font-weight:700; font-size:12.5px; text-decoration:none;">Join / Inquire</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
