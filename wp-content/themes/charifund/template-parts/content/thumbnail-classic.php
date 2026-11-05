<?php
/**
 * Post Thumbnail Functions
 * @package charifund
 * @since 1.0.0
 */

$charifund = charifund();
if (has_post_thumbnail()): ?>
    <div class="thumbnail">
        <?php $charifund->post_thumbnail('post-thumbnail'); ?>
    </div>
<?php endif; ?>