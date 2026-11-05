<?php
// Admin Panel Common Sidebar
$cur_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <i class="fa-solid fa-leaf"></i> Al Miftah CMS
    </div>
    <ul class="nav-links">
        <li><a href="index.php" class="<?= $cur_page === 'index.php' ? 'active' : '' ?>"><i class="fa-solid fa-house"></i> Dashboard</a></li>
        <li><a href="users.php" class="<?= in_array($cur_page, ['users.php', 'user-detail.php']) ? 'active' : '' ?>"><i class="fa-solid fa-users"></i> Users List</a></li>
        <li><a href="tree.php" class="<?= $cur_page === 'tree.php' ? 'active' : '' ?>"><i class="fa-solid fa-sitemap"></i> Referral Tree</a></li>
        <li><a href="kyc.php" class="<?= $cur_page === 'kyc.php' ? 'active' : '' ?>"><i class="fa-solid fa-id-card"></i> KYC Approvals</a></li>
        <li><a href="donations.php" class="<?= $cur_page === 'donations.php' ? 'active' : '' ?>"><i class="fa-solid fa-hand-holding-dollar"></i> Donations</a></li>
        <li><a href="sms-settings.php" class="<?= $cur_page === 'sms-settings.php' ? 'active' : '' ?>"><i class="fa-solid fa-mobile-screen"></i> SMS / OTP</a></li>
        <li><a href="causes.php" class="<?= $cur_page === 'causes.php' ? 'active' : '' ?>"><i class="fa-solid fa-hand-holding-heart"></i> Causes</a></li>
        <li><a href="events.php" class="<?= $cur_page === 'events.php' ? 'active' : '' ?>"><i class="fa-solid fa-calendar-days"></i> Events</a></li>
        <li><a href="blogs.php" class="<?= $cur_page === 'blogs.php' ? 'active' : '' ?>"><i class="fa-solid fa-newspaper"></i> Blogs</a></li>
        <li><a href="gallery.php" class="<?= $cur_page === 'gallery.php' ? 'active' : '' ?>"><i class="fa-solid fa-images"></i> Gallery</a></li>
        <li><a href="contacts.php" class="<?= $cur_page === 'contacts.php' ? 'active' : '' ?>"><i class="fa-solid fa-envelope"></i> Inquiries</a></li>
    </ul>
    <a href="logout.php" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
</aside>
