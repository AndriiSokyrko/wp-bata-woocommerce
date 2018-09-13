<?php

	function get_rating_social_menu(){
		$templates[]='rating-social-menu.php';
		locate_template($templates, true);
	}
	// external type of image SVG....
	function wp39550_cancel_real_mime_check( $data, $file, $filename, $mimes ) {
		$wp_filetype = wp_check_filetype( $filename, $mimes );

		$ext             = $wp_filetype['ext'];
		$type            = $wp_filetype['type'];
		$proper_filename = $data['proper_filename'];

		return compact( 'ext', 'type', 'proper_filename' );
	}

	add_filter( 'wp_check_filetype_and_ext', 'wp39550_cancel_real_mime_check', 10, 4 );


	function extra_mime_types( $mimes ) {

		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}
	add_filter( 'upload_mimes', 'extra_mime_types' );

//	add_action( 'after_setup_theme', 'woocommerce_support' );
//	function woocommerce_support() {
//		add_theme_support( 'woocommerce' );
//	}
	function theme_prefix_setup() {
		add_theme_support( 'custom-logo' );
		add_theme_support( 'post-thumbnails' );
	}
	add_action( 'after_setup_theme', 'theme_prefix_setup' );


//	add_filter( 'get_custom_logo', 'filter_function_name_9438', 10, 2 );
//	function filter_function_name_9438( $html, $blog_id ){
//		 $hyml=preg_replace('/<img/','<img class="img-responsive"',$html);
//
//		return $html;
//	}

	function get_navigation(){
		$templates[]='navigation.php';
		locate_template($templates, true);
	}

	add_filter( 'get_custom_logo', 'filter_logo', 10, 2 );
	function filter_logo( $html, $blog_id ) {
		$html = preg_replace( '/class="custom-logo-link"/', 'class="navbar-brand"', $html );

		return $html;
	}

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wp-bata' ),
		'social'  => __( 'Social Links Menu', 'wp-bata' ),
	) );
	add_filter( 'nav_menu_css_class', '__return_empty_array' );


	function bata_scripts() {
		//include css
		wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/stylesheet.css' );

//		wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/styles.css' );
 		wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/css.css' );
 		wp_enqueue_style( 'UserForm', get_template_directory_uri() . '/css/UserForm.css' );
		wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/cssff98.css' );


		//include js

		wp_dequeue_script( 'jquery' );
		wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js' );
		wp_enqueue_script( 'javascript', get_template_directory_uri() . '/js/javascript.js' );
		wp_enqueue_script( 'en', get_template_directory_uri() . '/js/en.js' );

//		wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/myScript.js', array('jquery') );
//		wp_localize_script( 'ajax-script', 'ajax_object',
//			array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );

	}

	add_action( 'wp_enqueue_scripts', 'bata_scripts' );

	function bata_admin_scripts(){

		$sidebar_id = is_active_widget( 0,0,  'form-register' );
//		if( !$sidebar_id ){
//			if ( ! did_action( 'wp_enqueue_media' ) ) {
//				wp_enqueue_media();
//			}
//			wp_enqueue_script( 'myuploadscript', get_stylesheet_directory_uri() . '/js/myScript.js', array('jquery'), null, false );
//		}
	}
	add_action( 'admin_enqueue_scripts', 'bata_admin_scripts' );

	add_action( 'init', 'stuff_index' );
	function stuff_index() {

		register_post_type( 'stuff', array(
			'public'        => true,
			'supports'      => array( 'title', 'excerpt','editor', 'thumbnail','custom-fields' ),
			'menu_position' => 120,
			'menu_icon'     => admin_url() . 'images/media-button-other.gif',
			'labels'        => array(
				'name'         => 'Stuff',
				'all_items'    => 'All stuff',
				'add_new'      => 'Add new stuff',
				'add_new_item' => 'New stuff'
			),
			'taxonomies'          => array('category'),
		) );
	}

	add_filter( 'use_default_gallery_style', '__return_false' );


	//Gallary filter
	add_filter('post_gallery', 'my_post_gallery', 10, 2);
	function my_post_gallery( $output, $attr ) {
		global $post;

		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}

		extract( shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => '',
			'icontag'    => '',
			'captiontag' => '',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
		), $attr ) );

		$id = intval( $id );
		if ( 'RAND' == $order ) {
			$orderby = 'none';
		}

		if ( ! empty( $include ) ) {
			$include      = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array(
				'include'        => $include,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		// Here's your actual output, you may customize it to your need
//		$output = "<div class=\"slideshow-wrapper\">\n";
//		$output .= "<div class=\"preloader\"></div>\n";
//		$output .= "<ul data-orbit>\n";
		$output = '';
		// Now you loop through each attachment
		foreach ( $attachments as $id => $attachment ) {
			// Fetch the thumbnail (or full image, it's up to you)
//      $img = wp_get_attachment_image_src($id, 'medium');
//      $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
			$img = wp_get_attachment_image_src( $id, 'full' );

			$output .= "<li style=\"width: 1110px; float: left; display: block;\"> \n";
			$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
			$output .= "</li>\n";
		}

//		$output .= "</ul>\n";
//		$output .= "</div>\n";

		return $output;
	}


	//WIdget
	function wp_avon_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'wp-avon' ),
			'id'            => 'form-register',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'wp-avon' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		) );

		register_sidebar( array(
			'name'          => __( 'discount', 'wp-avon' ),
			'id'            => 'form-discount',
			'description'   => __( 'Add widgets here to appear in your discont sidebar.', 'wp-avon' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		) );
		register_sidebar( array(
			'name'          => __( 'actual-catalog', 'wp-avon' ),
			'id'            => 'actual-catalog',
			'description'   => __( 'Add widgets here to appear in your actual catalog sidebar.', 'wp-avon' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		) );
		register_sidebar( array(
			'name'          => __( 'contact-form', 'wp-avon' ),
			'id'            => 'contact-form',
			'description'   => __( 'Add widgets here to appear in your contact form sidebar.', 'wp-avon' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		) );


	}

	add_action( 'widgets_init', 'wp_avon_widgets_init' );

include 'Custom_Walker_Naw_Menu.php';


	function wpb_load_widget() {
		register_widget( 'Wpb_Widget_Redister_Form' );
		register_widget( 'Wpb_Widget_Discont_Form' );
		register_widget( 'Wpb_Widget_Actual_catalog' );
		register_widget( 'Wpb_Widget_Contact_Form' );
	}

	add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget
 include 'Wpb_Widget_Redister_Form.php';
 include 'Wpb_Widget_Discont_Form.php';
 include 'Wpb_Widget_Actual_catalog.php';
 include 'Wpb_Widget_Contact_Form.php';

//	require_once( 'wptuts-options/wptuts-options.php' );
	add_filter('pre_get_posts', 'tax_city_posts_per_page');
	function tax_city_posts_per_page( $query ) {
		if(!is_admin()) {
			$query->set( 'posts_per_page', 3 ); //ваше значение
		}
		return $query;
	}

	add_filter( 'nav_menu_link_attributes', 'filter_function_name_3020', 10, 4 );
	function filter_function_name_3020( $atts, $item, $args, $depth ){
		// filter...
		$count_posts = wp_count_posts();
		$published_posts = $count_posts->publish;
//		$idObj = get_category_by_slug('category-name');
//		$id = $idObj->term_id;
//		get_cat_ID()
//	  $cnt=get_category(ID категории)->category_count;
//		$item .= $item."  ".$count_posts;

		return $item;
	}

/* AJAX script
*/

	add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
	function myajax_data(){
		wp_enqueue_script( 'myuploadscript', get_stylesheet_directory_uri() . '/js/myScript.js', array('jquery'), null, false );

		wp_localize_script('myuploadscript', 'myajax',
			array(
				'url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('myajax-nonce')
			)
		);

	}

	add_action( 'wp_ajax_nopriv_myajax-submit', 'myajax_submit' );
	add_action( 'wp_ajax_myajax-submit', 'myajax_submit' );


	function myajax_submit(){
		// проверяем nonce код, если проверка не пройдена прерываем обработку
		check_ajax_referer( 'myajax-nonce', 'nonce_code' );


		if( isset( $_POST['names'] )
		    && isset( $_POST['email'] ) && is_email( $_POST['email'] ) // is_email() - встроенная функция WP для проверки корректности емайлов
		    && isset( $_POST['phone'] ) ) {

			$headers = array(
				"Content-type: text/html; charset=utf-8",
				"From: " . $_POST['names'] . " <" . $_POST['email'] . ">"
			);
			$message='This is masaage from '. $_POST['names'];
			$message .='Email '. $_POST['email'];
			$message .='Phone '. $_POST['phone'];
			$message .='Feel free to feedback. Best regards';

			if( wp_mail( get_option('admin_email'), 'Сообщение с сайта', wpautop( $message ), $headers ) ) {
				header('Location:' . site_url('/contact?msg=success') );
				echo 'OK';
				wp_die();
				
			} else{
				echo 'Error';
			}


		}

		// обрабатываем данные и возвращаем
//		echo 'Возвращаемые данные';

		// не забываем завершать PHP
		wp_die();
	}

//	function include_template_function( $template_path ) {
//		if ( get_post_type() == 'stuff' ) {
//			if ( is_single() ) {
//				// checks if the file exists in the theme first,
//				// otherwise serve the file from the plugin
//				if ( $theme_file = locate_template( array ( 'single-stuff.php' ) ) ) {
//					$template_path = $theme_file;
//				} else {
//					$template_path = plugin_dir_path( __FILE__ ) . '/single-stuff.php';
//				}
//			}
//		}
//		return $template_path;
//	}
//	add_filter( 'template_include', 'include_template_function', 99 );

//
//	function single($template) {
//		global $wp_query, $post;
//		if(file_exists(TEMPLATEPATH . 'single-stuff.php')) {
//			return TEMPLATEPATH . '/single-stuff.php';
//		}
//		if(file_exists(TEMPLATEPATH . '/single.php')) {
//			return TEMPLATEPATH . '/single.php';
//		}
//		return $template;
//	}
//	add_filter('single_template', 'single');
//

?>