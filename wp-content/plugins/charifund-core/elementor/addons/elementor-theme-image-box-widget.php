<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Theme_Image_Box extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-theme-image-box-widget';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Theme Image Box', 'charifund-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-flash';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories()
    {
        return ['charifund_widgets'];
    }
	
	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// Tab Start - 1

		$this->start_controls_section(
			'theme_image_box',
			[
				'label' => esc_html__( 'Theme Image Box', 'charifund-core' ),
			]
		);	
		
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Style', 'charifund-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => array(
					'style1'   => esc_html__( 'Style One', 'charifund-core' ),
					'style2'   => esc_html__( 'Style Two', 'charifund-core' ),
					'style3'   => esc_html__( 'Style Three', 'charifund-core' ),
				),
			]
		);
		
		$this->add_control(
			'image',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style1','style2','style3']],
				]
		);	
		
		$this->add_control(
			'alt_text',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2','style3']],
			]
		);

		$this->add_control(
			'image2',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style1','style2','style3']],
				]
		);	
		
		$this->add_control(
			'alt_text2',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2','style3']],
			]
		);

		$this->add_control(
			'image3',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style1','style2','style3']],
				]
		);	
		
		$this->add_control(
			'alt_text3',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2','style3']],
			]
		);

		$this->add_control(
			'image4',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style1','style2','style3']],
				]
		);	
		
		$this->add_control(
			'alt_text4',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2','style3']],
			]
		);

		$this->add_control(
			'image5',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style1','style2']],
				]
		);	
		
		$this->add_control(
			'alt_text5',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'video_link',
			[
			  'label' => __( 'Video Url', 'charifund-core' ),
			  'type' => Controls_Manager::URL,
			  'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
			  'show_external' => true,
			  'default' => [
				'url' => 'https://www.youtube.com/watch?v=Cn4G2lZ_g2I',
				'is_external' => true,
				'nofollow' => true,
			  ],
			  'condition'	=> ['style' => ['style1','style2']],
			
		   ]
		);	

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
			]
		);



		$this->end_controls_section();

	
		}

	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_tags = wp_kses_allowed_html('post');
		?>

	
<?php  if ( 'style1' === $settings['style'] ) : ?>

	<div class="help p-0">
		<div class="help__thumb">
			<div class="help__thumb-inner">
				<div class="thumb-top thumb">
				<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
				<?php endif;?>
				</div>
				<div class="thumb-lg thumb">
					<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
						<img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
					<?php endif;?>
					<div class="video-btn-wrapper">
						<a href="<?php echo esc_url($settings['video_link']['url']);?>" target="_blank"
						title="video Player" class="open-video-popup">
						<i class="icon-play"></i>
						</a>
					</div>
				</div>
				<div class="thumb thumb-bottom">
				<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
				<?php endif;?>
				</div>
				<div class="line">
				<?php  if ( !empty(esc_url($settings['image4']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image4']['id']);?>" alt="<?php echo esc_attr($settings['alt_text4']);?>"/>
				<?php endif;?>
				</div>
				<div class="grid-line">
				<?php  if ( !empty(esc_url($settings['image5']['id']) )) : ?>   
					<img class="base-img" src="<?php echo wp_get_attachment_url($settings['image5']['id']);?>" alt="<?php echo esc_attr($settings['alt_text5']);?>"/>
				<?php endif;?>
				</div>
				<div class="vertical-text">
					<h5><?php echo $settings['title'];?> </h5>
				</div>
			</div>
		</div>
	</div>


<?php  elseif ( 'style2' === $settings['style'] ) : ?>

	<div class="difference-two p-0">
		<div class="difference-two__thumb-wrapper">
			<div class="difference-two__thumb">
				<div class="thumb-lg">
					<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
						<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
					<?php endif;?>
					<div class="grid-line">
					<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
						<img class="base-img" src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
					<?php endif;?>
					</div>
					<div class="video-btn-wrapper">
						<a href="<?php echo esc_url($settings['video_link']['url']);?>" target="_blank"
						title="video Player" class="open-video-popup">
						<i class="icon-play"></i>
						</a>
					</div>
				</div>
				<div class="thumb-sm">
				<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
				<?php endif;?>
				</div>
			</div>
		</div>
	</div>

	<?php  elseif ( 'style3' === $settings['style'] ) : ?>

		<section class="difference-three p-0">
		<div class="difference-three__thumb d-none d-lg-block">
			<div class="difference-three__thumb-inner">
				<div class="thumb-lg">

					<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
						<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
					<?php endif;?>

				</div>
				<div class="spade">
					<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
						<img class="base-img" src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
					<?php endif;?>
				</div>
				<div class="thumb-sm">
				<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
				<?php endif;?>
				</div>
				<div class="line">
				<?php  if ( !empty(esc_url($settings['image4']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image4']['id']);?>" alt="<?php echo esc_attr($settings['alt_text4']);?>"/>
				<?php endif;?>
				</div>
			</div>
			</div>
         </section>

<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Theme_Image_Box());