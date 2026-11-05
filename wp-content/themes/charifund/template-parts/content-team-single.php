<?php
/**
 * Template part for displaying single team post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package charifund
 */

$charifund = charifund();
$charifund_meta = get_post_meta(get_the_ID(), 'charifund_team_options', true);
$img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
$img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'full', false) : '';
$img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
$img_alt = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : '';
$designation = isset($charifund_meta['designation']) && !empty($charifund_meta['designation']) ? $charifund_meta['designation'] : '';
$social_icons = isset($charifund_meta['social-icons']) && !empty($charifund_meta['social-icons']) ? $charifund_meta['social-icons'] : '';
$team_skills = isset($charifund_meta['team-skill']) && !empty($charifund_meta['team-skill']) ? $charifund_meta['team-skill'] : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('charifund-details-content-area team-details-section'); ?>>
	<div class="team-details-page">
        <div class="row">
            <div class="col-lg-5 text-center">
                <div class="details-thumb mb-4 mb-lg-0">
					<?php
                        //image condition here
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund-team-classic', false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

                        $team_single_meta_data = get_post_meta(get_the_ID(), 'charifund_team_options', true);
                        $social_icons = isset($team_single_meta_data['social-icons']) && !empty($team_single_meta_data['social-icons']) ? $team_single_meta_data['social-icons'] : '';
                        $phone = isset($team_single_meta_data['phone']) && !empty($team_single_meta_data['phone']) ? $team_single_meta_data['phone'] : '';
                        $email = isset($team_single_meta_data['email']) && !empty($team_single_meta_data['email']) ? $team_single_meta_data['email'] : '';
                    ?>
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
				</div>
			</div>
            <div class="col-lg-7 align-self-center ps-xl-5">
                <h3 class="mb-2"><?php echo esc_html(get_the_title()); ?></h3>
                <span class="designation"><?php echo esc_html($team_single_meta_data['designation']); ?></span>
				<div class="details mt-4 pt-3">
                    <h4><?php echo esc_html('About Me', 'charifund'); ?></h4>           
                    <ul class="social-media style-base mt-4 pt-3">
                        <?php
                        if (!empty($social_icons)) {
                            foreach ($social_icons as $item) {
                                printf('<li><a href="%1$s"><i class="%2$s"></i></a></li>', $item['url'], $item['icon']);
                            }
                        }
                        ?>
                    </ul>
                    <?php if (!empty($team_skills)) { ?>
                        <div class="team-skill">
                            <div class="row">
                                <?php foreach ($team_skills as $items) { ?>
                                    <div class="col-md-6">
                                        <div class="single-progressbar">
                                            <h6 class="subtitle">
                                                <?php echo esc_html($items['title']) ?>
                                                <span><?php echo esc_html($items['count_val']); ?>%</span>
                                            </h6>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr($items['count_val']);?>%" aria-valuenow="<?php echo esc_attr($items['count_val']);?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
    <div class="entry-content">
        <?php
        the_content();
        $charifund->link_pages();
        ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->