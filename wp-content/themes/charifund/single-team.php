<?php
/**
 * Single Team Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package charifund
 */

get_header();
$page_layout_meta = Charifund_Group_Fields_Value::page_layout_options('team_single');
?>
    <div id="primary" class="team-content-area team-details-page padding-top-100">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', 'team-single' );
                        endwhile; // End of the loop.
                        ?>
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
