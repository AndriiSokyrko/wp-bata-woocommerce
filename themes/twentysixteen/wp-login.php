<?php
	class WP_login extends WP_Widget {
		public function __construct() {
			parent::__construct( "wp_login", "wp login Widget",
				array( "description" => "A simple widget to show how WP Plugins work" ) );
		}

		public function form( $instance ) {
			$title = "";
			$text  = "";
			// если instance не пустой, достанем значения
			if ( ! empty( $instance ) ) {
				$title = $instance["title"];
				$text  = $instance["text"];
			}
			$tableId   = $this->get_field_id( "title" );
			$tableName = $this->get_field_name( "title" );
			echo '<label for="' . $tableId . '">Title</label><br>';
			echo '<input id="' . $tableId . '" type="text" name="' .
			     $tableName . '" value="' . $title . '"><br>';
			$textId   = $this->get_field_id( "text" );
			$textName = $this->get_field_name( "text" );
			echo '<label for="' . $textId . '">Text</label><br>';
			echo '<textarea id="' . $textId . '" name="' . $textName .
			     '">' . $text . '</textarea>';
		}

		public function update( $newInstance, $oldInstance ) {
			$values          = array();
			$values["title"] = htmlentities( $newInstance["title"] );
			$values["text"]  = htmlentities( $newInstance["text"] );

			return $values;
		}

		public function widget( $args, $instance ) { ?>

			<div class="wp-login">
				<?php echo get_template_part('form-posts')  ?>
				<?php echo get_template_part('form-register')  ?>
				<?php echo get_template_part('form-send')  ?>
				<?php echo get_template_part('form-test')  ?>
<!--				--><?php //wp_login_form(0); ?>
<!--				--><?php //echo get_template_part('form-newpost')  ?>

				<?php if ( ! is_user_logged_in() ) {
					echo "<p>Здравствуйте, <strong>гость</strong>!</p>"; ?>
					<li><a href="#form_newpost" id="a_newpost" class="newpost" >Добавить запись</a></li>
					<li><a href="#block_reg" id="a_register" class="single_image" >Регистрaция</a></li>
					<li><a href="#myformm" id="a_formm" class="a-formm" >Почта</a></li>
					<li><a href="#add" id="a_add" class="a-formm" >test</a></li>

					<?php  wp_login_form(); ?>
					<p><?php if ( get_option( 'users_can_register' ) ) : ?><a
						href="<?php echo esc_url( site_url( 'wp-login.php?action=register', 'login' ) ); ?>">
						<?php _e( 'Register' ); ?></a> | <?php endif; ?><a
					href="<?php bloginfo( 'wpurl' ); ?>/wp-login.php?action=lostpassword">Забыли пароль?</a></p><?php

				} else {
					global $user_identity;
					get_currentuserinfo(); ?>
					<p>Здравствуйте, <strong><?php echo $user_identity; ?></strong>!</p>
					<ul>
						<li><a href="<?php bloginfo( 'url' ); ?>/wp-admin/profile.php">Изменить профиль</a></li>
						<li><a href="<?php echo wp_logout_url( get_permalink() ); ?>">Выйти</a></li>
						<li><a href="#form-posts" id="a_posts" class="fancybox" >Добавить запись</a></li>
						<li><a href="#myformm"  class="myformm" >Почта</a></li>

						<!--						<a href="image_big.jpg"><img src="image_small.jpg" width="100" height="100" alt=""/></a>-->

					</ul>

				<?php } ?>
			</div>
			<?php
		}
	}
  function register_wp_login() {
		register_widget( 'WP_login' );
	}
	add_action( 'widgets_init', 'register_wp_login' );

?>