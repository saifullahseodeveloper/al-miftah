<?php
/**
 * Custom Comment Area Modification
 * @package charifund
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'charifund_comment_modification' ) ) {
	function charifund_comment_modification($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		$comment_class = empty( $args['has_children'] ) ? '' : 'parent';
		?>

		<<?php echo esc_attr($tag); ?> <?php comment_class('item ' . $comment_class .' ' ); ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>" class="">
		<?php endif; ?>


		<div class="single-comment-wrap"><!-- single comment wrap -->
            <?php if( get_comment_type(get_comment_ID()) == 'comment' ): ?>
			<div class="thumb">
				<?php if ( $args['avatar_size'] != 0 ){ echo get_avatar( $comment, 80 );};?>
			</div>
            <?php endif;?>
			<div class="content">
				<h4 class="title"><?php printf( '%s', get_comment_author() ); ?></h4>
                <span class="date"> <?php printf('<span class="date">%s</span>',get_comment_date());?></span>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'charifund' ); ?></em>
				<?php endif; ?>
				<?php comment_text(); ?>
				<?php
				comment_reply_link( array_merge( $args, array(
					'reply_text' => esc_html__('Reply','charifund') ,
					'before' => '',
					'class'  => '',
					'depth' => $depth,
					'max_depth' => $args['max_depth']
				) ) );
				?>
			</div>
		</div><!-- //. single comment wrap -->
		<?php if ( 'div' != $args['style'] ) : ?>
			</div>
		<?php endif;
	}
}