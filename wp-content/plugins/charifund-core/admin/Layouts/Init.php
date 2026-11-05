<?php
namespace IMAddons\Admin\Layouts;

defined( 'ABSPATH' ) || exit;

class Init{

    public function __construct(){

        add_action( 'elementor/editor/footer', array( $this, 'render' ) );
		new Ajax();
		add_action('elementor/editor/after_enqueue_styles', array( $this, 'layout_contents' ) );
    }

	public function layout_contents() { 
		ob_start(); ?>
		<div class="widgetarea_iframe_modal"> 
			<?php include 'layouts.php'; ?>
		</div>
		<?php echo ob_get_clean();
	}

	public function render(){
		$files = glob( dirname(__FILE__) . '/views/*.php' );
		foreach ( $files as $file ) {
			$name = basename( $file, '.php' );
			ob_start();
			include $file;
			printf( '<script type="text/html" id="view-imaddons-%1$s">%2$s</script>', $name, ob_get_clean() );
		}
	}
}