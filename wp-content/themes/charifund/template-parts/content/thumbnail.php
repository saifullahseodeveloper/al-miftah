<?php
/**
 * Post Thumbnail 
 * @package charifund
 * @since 1.0.0
 */
?>

 <div class="thumbnail">
    <?php
    if (has_post_thumbnail() && get_post_type() == 'post') {
        charifund()->post_thumbnail('post-thumbnail');
    }
    ?>
</div>
