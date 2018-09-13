<?php
	/**
	 * Created by PhpStorm.
	 * User: user
	 * Date: 11.05.2018
	 * Time: 11:37
	 */
	class Wpb_Widget_Redister_Form extends WP_Widget {

		function __construct() {

			$widget_ops  = array(
				'classname'   => 'Widget_Redister_Form',
				'description' => __( 'Register form Avon' )
			);
			$control_ops = array(
				'width'  => 300,
				'height' => 350
			);
			parent::__construct( 'register_form', __( 'Register form Avon' ), $widget_ops, $control_ops );
		}


		public function widget( $args, $instance ) {
			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$subtitle = apply_filters( 'widget_title', empty( $instance['subtitle'] ) ? '' : $instance['subtitle'], $instance, $this->id_base );
			$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance, $this );
			$image = apply_filters( 'widget_text', empty( $instance['image'] ) ? '' : $instance['image'], $instance, $this );

			echo $args['before_widget'];
			 ?>
			<h1 class="text-xs-center h2 mb-1 pink">
				<?php if ( ! empty( $title ) ) {
					echo $args['before_title'] . $title . $args['after_title'];

				}  ?>
			</h1>
			<h4 class="text-xs-center pink mb-1"><strong>
				<?php if ( ! empty( $subtitle ) ) {
					echo $args['before_title'] . $subtitle . $args['after_title'];

				}  ?>
				</strong></h4>

				<div class="">
			<?php if ( ! empty( $text ) ) {
				echo   $text ; ?>
					<?php
 					?>
				</div>

			<?php }  ?>
									<div class="hidden-md-down">
										<div class="mb-1">
											<a href="https://avon.org.ua/#form" title="Акция AVON - подарок и скидка">

												<img class="rounded" src="

												<?php echo $image?>

												" alt="Подарок и скидка при регистрации"></a>
										</div>
										<div class="mb-1 hidden-plus camimg-0">
											<img class="rounded" src="
											<?php echo $image?>

											" alt="AVON"></div>
									</div>
									<div class="hidden-lg-up text-xs-center mb-1">
										<a href="https://avon.org.ua/#form" title="Акция AVON при регистрации">
											<img class="rounded" src="
											<?php echo $image?>
											" alt="Акция AVON при регистрации"></a>
									</div>

			<?php
			echo $args['after_widget'];
		}

		/**
		 * Handles updating settings for the current Text widget instance.
		 *
		 * @since 2.8.0
		 * @access public
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            WP_Widget::form().
		 * @param array $old_instance Old settings for this instance.
		 *
		 * @return array Settings to save or bool false to cancel saving.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance          = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['subtitle'] = sanitize_text_field( $new_instance['subtitle'] );
			$instance['image'] = sanitize_text_field( $new_instance['image'] );
			if ( current_user_can( 'unfiltered_html' ) ) {
				$instance['text'] = $new_instance['text'];
			} else {
				$instance['text'] = wp_kses_post( $new_instance['text'] );
			}
			$instance['filter'] = ! empty( $new_instance['filter'] );

			return $instance;
		}

		/**
		 * Outputs the Text widget settings form.
		 *
		 * @since 2.8.0
		 * @access public
		 *
		 * @param array $instance Current settings.
		 */
		public function form( $instance ) {
			$defaults = array(
				'title'    => 'AVON Украина - официальная регистрация, каталоги, акции',
				'subtitle' => 'Преимущества Вашей регистрации',
				'image'    =>  get_template_directory_uri().'/image/no-image.png',
				'text'     => '
				<ul class="custom-ul text-justify">
							<li><strong>Заказывайте продукцию AVON со скидкой</strong> для себя, либо зарабатывайте с помощю AVON, просто, демострируя каталог своему окружению. Выбор всегда за Вами.</li>
							<li><strong>Скидка в AVON</strong> - не просто приятный бонус, это <strong>ощутимая экономия</strong>! Сделайте свой первый заказ на 1000 грн. - к оплате будет представлен счет лишь ≈ 740 грн.</li>
							<li><strong>AVON дарит аромат новым представителям</strong>. Его регулярная цена составляет 200-250 грн. Более того, подарки можно получать с каждым заказом.</li>
						</ul>
				',

			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			$filter   = isset( $instance['filter'] ) ? $instance['filter'] : 0;
			$title    = sanitize_text_field( $instance['title'] );
			$subtitle = sanitize_text_field( $instance['subtitle'] );
			$image =    sanitize_text_field ($instance['image'] );
//			 echo $image.'sssss';
			?>
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				       name="<?php echo $this->get_field_name( 'title' ) ?>" type="text"
				       value="<?php echo $title; ?>"/></p>

			<p><label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>"
				       name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text"
				       value="<?php echo esc_attr( $subtitle ); ?>"/></p>

			<?php
			$w='100%';
			$h='auto';
			$value='';
			echo '<div>
				<img   data-src="' . $image . '" src="' . esc_attr($image) . '" width="' . $w . '" height="' . $h . '">
				<div> ';  ?>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>"
			       name="<?php echo $this->get_field_name( 'image' ); ?>" type="hidden"
			       value="<?php echo esc_attr( $image ); ?>"/>


			<?php echo '<button type="submit" class="upload_image_button button">Загрузить</button>
					<button type="submit" class="remove_image_button button">&times;</button>
				</div>
			</div>';
			?>

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