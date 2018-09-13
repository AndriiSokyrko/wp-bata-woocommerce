<?php
	/**
	 * Created by PhpStorm.
	 * User: user
	 * Date: 12.05.2018
	 * Time: 12:38
	 */
class Wpb_Widget_Discont_Form extends WP_Widget{
	function __construct() {

		$widget_ops  = array(
			'classname'   => 'Wpb_Widget_Discont_Form',
			'description' => __( 'Discont form Avon' )
		);
		$control_ops = array(
			'width'  => 300,
			'height' => 350
		);
		parent::__construct( 'discont_form', __( 'Discont form Avon' ), $widget_ops, $control_ops );
	}

	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$subtitle = apply_filters( 'widget_title', empty( $instance['subtitle'] ) ? '' : $instance['subtitle'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance, $this );
		$image = apply_filters( 'widget_text', empty( $instance['image'] ) ? '' : $instance['image'], $instance, $this );

		echo $args['before_widget'];
		?>
		<div class="col-xs-12 col-lg-6 clearfix pb-1">
			<div class="scissors"></div>
			<div class="card card-block pink m-0 pl-1 pr-1">
				<h3 class="h1 card-title solid pink">
					<?php if ( ! empty( $title ) ) {
						echo $args['before_title'] . $title . $args['after_title'];

					}  ?>
				</h3>
				<p class="card-text">
					<?php if ( ! empty( $title ) ) {
						echo  $text ;

					}  ?>

				</p>
				<a class="btn btn-outline-secondary pink" itemprop="url" href="/#form"
				   title="AVON Украина - официальная регистрация"><b>Получить скидку</b></a>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}


	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}
		$instance['filter'] = ! empty( $new_instance['filter'] );

		return $instance;
	}


	public function form( $instance ) {
		$defaults = array(
			'title'    => '-26% на продукцию',
			'text'     => '
			 Гарантированная скидка на первый заказ от 600грн. для новых представителей. 
			 Заполни анкету онлайн, чтобы принять участие в акции.
				',

		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$filter   = isset( $instance['filter'] ) ? $instance['filter'] : 0;
		$title    = sanitize_text_field( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ) ?>" type="text"
			       value="<?php echo $title; ?>"/></p>


		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?></label>
				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>"
				          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea>
		</p>

		<p><input id="<?php echo $this->get_field_id( 'filter' ); ?>"
		          name="<?php echo $this->get_field_name( 'filter' ); ?>"
		          type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs' ); ?></label>
		</p>
		<?php


	}




}

?>