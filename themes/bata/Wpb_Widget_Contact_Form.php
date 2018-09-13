<?php
	/**
	 * Created by PhpStorm.
	 * User: user
	 * Date: 11.05.2018
	 * Time: 11:37
	 */
	class Wpb_Widget_Contact_Form extends WP_Widget {

		function __construct() {

			$widget_ops  = array(
				'classname'   => 'Widget_Contact_Form',
				'description' => __( 'Contact form Avon' )
			);
			$control_ops = array(
				'width'  => 300,
				'height' => 350
			);
			parent::__construct( 'contact_form', __( 'Contact form Avon' ), $widget_ops, $control_ops );
		}


		public function widget( $args, $instance ) {
			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$subtitle = apply_filters( 'widget_title', empty( $instance['subtitle'] ) ? '' : $instance['subtitle'], $instance, $this->id_base );
			$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance, $this );
			$image = apply_filters( 'widget_text', empty( $instance['image'] ) ? '' : $instance['image'], $instance, $this );

			$soc_net_VK = apply_filters( 'widget_text', empty( $instance['soc_net_VK'] ) ? '' : $instance['soc_net_VK'], $instance, $this );
			$soc_net_Od = apply_filters( 'widget_text', empty( $instance['soc_net_Od'] ) ? '' : $instance['soc_net_Od'], $instance, $this );
			$soc_net_Fb = apply_filters( 'widget_text', empty( $instance['soc_net_Fb'] ) ? '' : $instance['soc_net_Fb'], $instance, $this );
			$soc_net_Ig = apply_filters( 'widget_text', empty( $instance['soc_net_Ig'] ) ? '' : $instance['soc_net_Ig'], $instance, $this );
			$soc_net_Yt = apply_filters( 'widget_text', empty( $instance['soc_net_Yt'] ) ? '' : $instance['soc_net_Yt'], $instance, $this );
			$soc_net_Av = apply_filters( 'widget_text', empty( $instance['soc_net_Av'] ) ? '' : $instance['soc_net_Av'], $instance, $this );
			$phone_1 = apply_filters( 'widget_text', empty( $instance['phone_1'] ) ? '' : $instance['phone_1'], $instance, $this );
			$phone_2 = apply_filters( 'widget_text', empty( $instance['phone_2'] ) ? '' : $instance['phone_2'], $instance, $this );
			$email_1 = apply_filters( 'widget_text', empty( $instance['email_1'] ) ? '' : $instance['email_1'], $instance, $this );

			echo $args['before_widget'];
			 ?>
			<h1 class="text-xs-center h2 mb-1 pink">
				<?php if ( ! empty( $title ) ) {
					echo $args['before_title'] . $title . $args['after_title'];

				}  ?>
			</h1>


			<div class="row clearfix contact">
				<div class="col-lg-4 text-xs-center mb-1">
					<div class="bg-faded text-xs-center">
						<img class="rounded" src="<?php echo $image?>" alt="Партнер AVON">
					</div>
				</div>
				<div class="col-lg-8 text-justify mb-1">
					<h5 class="mb-1 h3 pink text-xs-center">
						<?php if ( ! empty( $title ) ) {
							echo $args['before_title'] . $title . $args['after_title'];

						}  ?>
					</h5>
					<p class="mb-1 text-xs-center"><strong>
							<?php if ( ! empty( $subtitle ) ) {
								echo $args['before_title'] . $subtitle . $args['after_title'];

							}  ?>
						</strong></p>
					<p class="mb-1 text-xs-center">
						<?php if ( ! empty( $text ) ) {
							echo   $text ; ?>
						<?php }  ?>
					</p>
					<div class="row contacts">  
						<div class="col-md-4">
							<p><i class="fa fa-vk pink"></i><a href="ht <?php if ( ! empty( $soc_net_VK ) ) echo  $soc_net_VK ?>" class="c-more" target="_blank">Вконтакте</a></p>
							<p><i class="fa fa-odnoklassniki pink"></i><a href=" <?php if ( ! empty( $soc_net_Od ) ) echo  $soc_net_Od ?>" class="c-more" target="_blank">Одноклассники</a></p>
							<p><i class="fa fa-facebook pink"></i><a href=" <?php if ( ! empty( $soc_net_Fb ) ) echo  $soc_net_Fb ?>" class="c-more" target="_blank">Facebook</a></p>
						</div>
						<div class="col-md-5">
							<p><i class="fa pink fa-phone"></i><strong> <?php if ( ! empty( $phone_1 ) ) echo  $phone_1 ?></strong></p>
							<p><i class="fa pink fa-phone"></i><strong> <?php if ( ! empty( $phone_2 ) ) echo  $phone_2 ?></strong></p>
							<?php if ( ! empty( $email_1 ) )
							$email= explode("@", $email_1);
								$email_b= array_pop($email);
								$email_a= $email;
							?>
							<p><i class="fa pink fa-envelope-o"></i><a href="#chat" class="c-more">
									<?php if ( ! empty( $email_b ) ) echo  $email_b ?>
									<span class="fa-hide-mail">
									</span>
									<?php if ( ! empty( $email_a ) ) echo  $email_a ?>
							</p>
						</div>
						<div class="col-md-3">
							<p><i class="fa fa-instagram pink"></i><a href="<?php if ( ! empty( $soc_net_Ig ) ) echo  $soc_net_Ig ?>" class="c-more" target="_blank">Instagram</a></p>
							<p><i class="fa fa-youtube pink"></i><a href="<?php if ( ! empty( $soc_net_Yt ) ) echo  $soc_net_Yt ?>" class="c-more" target="_blank">Youtube</a></p>
							<p><i class="fa fa-avon pink"></i><a href="<?php if ( ! empty( $soc_net_Av ) ) echo  $soc_net_Av ?>" class="c-more" target="_blank">Мой AVON</a></p>
						</div>
					</div>
				</div>
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
			$instance['soc_net_VK'] = sanitize_text_field( $new_instance['soc_net_VK'] );
			$instance['soc_net_Od'] = sanitize_text_field( $new_instance['soc_net_Od'] );
			$instance['soc_net_Fb'] = sanitize_text_field( $new_instance['soc_net_Fb'] );
			$instance['soc_net_Ig'] = sanitize_text_field( $new_instance['soc_net_Ig'] );
			$instance['soc_net_Yt'] = sanitize_text_field( $new_instance['soc_net_Yt'] );
			$instance['soc_net_Av'] = sanitize_text_field( $new_instance['soc_net_Av'] );
			$instance['phone_1'] = sanitize_text_field( $new_instance['phone_1'] );
			$instance['phone_2'] = sanitize_text_field( $new_instance['phone_2'] );
			$instance['email_1'] = sanitize_text_field( $new_instance['email_1'] );


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
				'title'    => 'Алёна Стояновская - официальный представитель и партнер AVON',
				'subtitle' => 'Работаем по всей Украине',
				'image'    =>  get_template_directory_uri().'/image/avon_partner_alena.jpg',
				'text'     => '
				<p class="mb-1 text-xs-center">Добро пожаловать в мир красоты и успеха!<br>
				Используйте любой удобный способ для связи с нами - будем рады проконсультировать Вас.</p>
				',
				'soc_net_VK'    => 'https://vk.com/avon.berd',
				'soc_net_Od'    => 'https://ok.ru/profile/243879796722',
				'soc_net_Fb'    => 'https://www.facebook.com/avon.berd',
				'soc_net_Ig'    => 'https://instagram.com/alena.avon',
				'soc_net_Yt'    => 'https://www.youtube.com/channel/UCroQSBaD1IPf2IWJDnnknjg',
				'soc_net_Av'    => 'https://my.avon.ua/vitrina/elenastoyanovskaya',
				'phone_1'    => '+38 050 482-72-72',
				'phone_2'    => '+38 097 784-70-60',
				'email_1'    => 'avon.berdgmail.com',


			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			$filter   = isset( $instance['filter'] ) ? $instance['filter'] : 0;
			$title    = sanitize_text_field( $instance['title'] );
			$subtitle = sanitize_text_field( $instance['subtitle'] );
			$image =    sanitize_text_field ($instance['image'] );

			$soc_net_VK    = sanitize_text_field( $instance['soc_net_VK'] );
			$soc_net_Od    = sanitize_text_field( $instance['soc_net_Od'] );
			$soc_net_Fb    = sanitize_text_field( $instance['soc_net_Fb'] );
			$soc_net_Ig    = sanitize_text_field( $instance['soc_net_Ig'] );
			$soc_net_Yt    = sanitize_text_field( $instance['soc_net_Yt'] );
			$soc_net_Av    = sanitize_text_field( $instance['soc_net_Av'] );
			$phone_1    = sanitize_text_field( $instance['phone_1'] );
			$phone_2    = sanitize_text_field( $instance['phone_2'] );
			$email_1    = sanitize_text_field( $instance['email_1'] );

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

			<p><label for="<?php echo $this->get_field_id( 'soc_net_VK' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'soc_net_VK' ); ?>"
				       name="<?php echo $this->get_field_name( 'soc_net_VK' ) ?>" type="text"
				       value="<?php echo $soc_net_VK; ?>"/></p>

			<p><label for="<?php echo $this->get_field_id( 'soc_net_Od' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'soc_net_Od' ); ?>"
				       name="<?php echo $this->get_field_name( 'soc_net_Od' ) ?>" type="text"
				       value="<?php echo $soc_net_Od; ?>"/></p>
			<p><label for="<?php echo $this->get_field_id( 'soc_net_Fb' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'soc_net_Fb' ); ?>"
				       name="<?php echo $this->get_field_name( 'soc_net_Fb' ) ?>" type="text"
				       value="<?php echo $soc_net_Fb; ?>"/></p>
			<p><label for="<?php echo $this->get_field_id( 'soc_net_Ig' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'soc_net_Ig' ); ?>"
				       name="<?php echo $this->get_field_name( 'soc_net_Ig' ) ?>" type="text"
				       value="<?php echo $soc_net_Ig; ?>"/></p>
			<p><label for="<?php echo $this->get_field_id( 'soc_net_Yt' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'soc_net_Yt' ); ?>"
				       name="<?php echo $this->get_field_name( 'soc_net_Yt' ) ?>" type="text"
				       value="<?php echo $soc_net_Yt; ?>"/></p>
			<p><label for="<?php echo $this->get_field_id( 'soc_net_AV' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'soc_net_Av' ); ?>"
				       name="<?php echo $this->get_field_name( 'soc_net_Av' ) ?>" type="text"
				       value="<?php echo $soc_net_Av; ?>"/></p>
			<p><label for="<?php echo $this->get_field_id( 'phone_1' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'phone_1' ); ?>"
				       name="<?php echo $this->get_field_name( 'phone_1' ) ?>" type="text"
				       value="<?php echo $phone_1; ?>"/></p>
			<p><label for="<?php echo $this->get_field_id( 'phone_2' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'phone_2' ); ?>"
				       name="<?php echo $this->get_field_name( 'phone_2' ) ?>" type="text"
				       value="<?php echo $phone_2; ?>"/></p>
			<p><label for="<?php echo $this->get_field_id( 'email_1' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'email_1' ); ?>"
				       name="<?php echo $this->get_field_name( 'email_1' ) ?>" type="text"
				       value="<?php echo $email_1; ?>"/></p>



			<p><input id="<?php echo $this->get_field_id( 'filter' ); ?>"
			          name="<?php echo $this->get_field_name( 'filter' ); ?>"
			          type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label
					for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs' ); ?></label>
			</p>
			<?php


		}


	}


?>