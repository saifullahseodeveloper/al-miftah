<?php
$preloader_title = cs_get_option('preloader_title');
$preloader_icon = cs_get_option('preloader_icon');
$preloader_bg_color = cs_get_option('preloader_bg_color');
$preloader_icon_bg_color = cs_get_option('preloader_icon_bg_color');
?>

<?php if(!empty($preloader_bg_color || $preloader_icon_bg_color)) : ?>
	<style>
		.preloader {
			background-color: <?php echo $preloader_bg_color; ?>;
		}
		.preloader-icon-bg {
			background-color: <?php echo $preloader_icon_bg_color; ?> !important;
		}
	</style>
<?php endif; ?>

<div class="preloader">
	<?php if(!empty($preloader_icon['url'])): ?>
		<img class="preloader-icon-img preloader-icon-bg" src="<?php echo esc_url($preloader_icon['url']); ?>" alt="img">
	<?php else : ?>
		<i class="icon-donation preloader-icon-bg"></i>
	<?php endif; ?>
    <?php if (!empty($preloader_title)) : ?>
        <p><?php echo esc_html($preloader_title); ?></p>
    <?php endif; ?>
</div>
