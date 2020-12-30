<?php
/**
 * Plugin Name: ProPerforma Call to Action Widget
 * Plugin URI: https://immerwiederfreitag.com
 * Description: A simple call to action widget.
 * Version: 1.0
 * Author: Marcel Freitag
 * Author URI: https://immerwiederfreitag.com
 */

function ppp_widget_enqueue_styles() {
	wp_register_style( 'widget_cta_css', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_style( 'widget_cta_css' );
}
add_action( 'wp_enqueue_scripts', 'ppp_widget_enqueue_styles' );

class ppp_Cta_Widget extends WP_Widget {

	public function __construct() {

		$widget_options = array (
			'classname' => 'ppp_cta_widget',
			'description' => 'Add a call to action to your theme sidebar'
		);

		parent::__construct( 'ppp_cta_widget', 'Call to Action', $widget_options );
	}

	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$link = ! empty( $instance['link'] ) ? $instance['link'] : 'Link';
		$text = ! empty( $instance['text'] ) ? $instance['text'] : 'Button text';
		?>

		<div class="form-group">
			<label for="<?php echo $this->get_field_id( 'title'); ?>">Title:</label>
			<input class="form-control" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</div>

		<div class="form-group">
			<label for="<?php echo $this->get_field_id( 'text'); ?>">Text in the call to action box:</label>
			<input class="form-control" type="text" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo esc_attr( $text ); ?>" />
		</div>

		<div class="form-group">
			<label for="<?php echo $this->get_field_id( 'link'); ?>">Your link:</label>
			<input class="form-control" type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_attr( $link ); ?>" />
		</div>

	<?php }

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = strip_tags( $new_instance['text'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		return $instance;

	}

	function widget( $args, $instance ) {
		//define variables
		$title = apply_filters( 'widget_title', $instance['title'] );
		$text = $instance['text'];
		$link = $instance['link'];

		echo $args['before_widget'];

		// load template with custom variables
		$template = dirname( __FILE__ ) . '/tpl/frontend.php';
		set_query_var('title', $title);
		set_query_var('link', $link);
		set_query_var('text', $text);
		load_template($template);

		echo $args['after_widget'];
	}
}

function ppp_register_cta_widget() {
	register_widget( 'ppp_Cta_Widget' );
}
add_action( 'widgets_init', 'ppp_register_cta_widget' );