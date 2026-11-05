<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Count_Down extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-count-down-widget';
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
		return esc_html__( 'Count Down', 'charifund-core' );
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
			'heading_title',
			[
				'label' => esc_html__( 'Count Down', 'charifund-core' ),
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
			'due_date',
			[
				'label' => esc_html__( 'Date', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
			]
		);
		


		$this->end_controls_section();


		// Section Title Settings ==================
		$this->start_controls_section(
			'section_title_settings',
			[
				'label' => __( 'Section Title Setting', 'charifund-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		

		// Section Title Alignment Control
		$this->add_control(
			'section_title_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'charifund-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'charifund-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'charifund-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'condition' => [
					'show_section_title' => 'show',
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .heading-three' => 'text-align: {{VALUE}} !important',
				],
			]
		);

		

		// Typography Control
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'section_title_typography',
				'label'     => __( 'Typography', 'charifund-core' ),
				'condition' => [
					'show_section_title' => 'show',
				],
				'selector'  => '{{WRAPPER}} h2.title-animation',
			]
		);

		// Section Title Color Control
		$this->add_control(
			'section_title_color',
			[
				'label'     => __( 'Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_section_title' => 'show',
				],
				'selectors' => [
					'{{WRAPPER}} h2.title-animation' => 'color: {{VALUE}} !important',
				],
			]
		);



		$this->end_controls_section();
		// End of Section Title Setting ==================



	
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

	<div class="count-down style1">
					<ul id="date"></ul>
				</div>

				<script>

					// Set the date we're counting down to
					var countDownDate = new Date("<?php echo $settings['due_date']; ?>").getTime();

					// Update the count down every 1 second
					var x = setInterval(function() {

						// Get today's date and time
						var now = new Date().getTime();

						// Find the distance between now and the count down date
						var distance = countDownDate - now;

						// Time calculations for days, hours, minutes and seconds
						var days = Math.floor(distance / (1000 * 60 * 60 * 24));
						var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
						var seconds = Math.floor((distance % (1000 * 60)) / 1000);

						document.getElementById("date").innerHTML = 

							`<li class="days">
								<h3 class="day">${days}</h3>
								<span>Days</span>
							</li>
							<li class="hours">
								<h3 class="hour">${hours}</h3>
								<span>Hours</span>
							</li>
							<li class="minutes">
								<h3 class="minute">${minutes}</h3>
								<span>Minutes</span>
							</li>
							<li class="seconds">
								<h3 class="second">${seconds}</h3>
								<span>Seconds</span>
							</li>`;

						if (distance < 0) {
							clearInterval(x);
							document.getElementById("date").innerHTML = "EXPIRED";
						}
					}, 1000);

				</script>



<?php  elseif ( 'style2' === $settings['style'] ) : ?>

    <div class="count-down count style2">
		<ul id="date"></ul>
	</div>
	<script>

					// Set the date we're counting down to
					var countDownDate = new Date("<?php echo $settings['due_date']; ?>").getTime();

					// Update the count down every 1 second
					var x = setInterval(function() {

						// Get today's date and time
						var now = new Date().getTime();

						// Find the distance between now and the count down date
						var distance = countDownDate - now;

						// Time calculations for days, hours, minutes and seconds
						var days = Math.floor(distance / (1000 * 60 * 60 * 24));
						var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
						var seconds = Math.floor((distance % (1000 * 60)) / 1000);

						document.getElementById("date").innerHTML = 

							`<li class="days">
								<h3 class="day">${days}</h3>
								<span>Days</span>
							</li>
							<li class="hours">
								<h3 class="hour">${hours}</h3>
								<span>Hours</span>
							</li>
							<li class="minutes">
								<h3 class="minute">${minutes}</h3>
								<span>Minutes</span>
							</li>
							<li class="seconds">
								<h3 class="second">${seconds}</h3>
								<span>Seconds</span>
							</li>`;

						if (distance < 0) {
							clearInterval(x);
							document.getElementById("date").innerHTML = "EXPIRED";
						}
					}, 1000);

				</script>

<?php elseif ( 'style3' === $settings['style'] ) : ?>

    <div class="count-down count style2 style3">
		<ul id="date"></ul>
	</div>
	    <script>

					// Set the date we're counting down to
					var countDownDate = new Date("<?php echo $settings['due_date']; ?>").getTime();

					// Update the count down every 1 second
					var x = setInterval(function() {

						// Get today's date and time
						var now = new Date().getTime();

						// Find the distance between now and the count down date
						var distance = countDownDate - now;

						// Time calculations for days, hours, minutes and seconds
						var days = Math.floor(distance / (1000 * 60 * 60 * 24));
						var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
						var seconds = Math.floor((distance % (1000 * 60)) / 1000);

						document.getElementById("date").innerHTML = 

							`<li class="days">
								<h3 class="day">${days}</h3>
								<span>Days</span>
							</li>
							<li class="hours">
								<h3 class="hour">${hours}</h3>
								<span>Hours</span>
							</li>
							<li class="minutes">
								<h3 class="minute">${minutes}</h3>
								<span>Minutes</span>
							</li>
							<li class="seconds">
								<h3 class="second">${seconds}</h3>
								<span>Seconds</span>
							</li>`;

						if (distance < 0) {
							clearInterval(x);
							document.getElementById("date").innerHTML = "EXPIRED";
						}
					}, 1000);

				</script>

<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Count_Down());