<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', 'n1dn6c7iqygev2hdokl203wf3s73mabgf' );

// WooFramework
require_once ($functions_path . 'admin-init.php' );			// Framework Init

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php',			// Theme widgets
				'includes/theme-install.php',			// Theme Installation
				'includes/theme-woocommerce.php'		// WooCommerce overrides
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );
				
foreach ( $includes as $i ) {
	locate_template( $i, true );
}
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/

	add_action('product_cat_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1);
	add_action('product_cat_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1);
//Product Cat Create page
	function wh_taxonomy_add_new_meta_field() {
		?>
		<div class="form-field">
			<label for="wh_meta_title"><?php _e('Meta Title', 'wh'); ?></label>
			<input type="text" name="wh_meta_title" id="wh_meta_title">
			<p class="description"><?php _e('Enter a meta title, <= 60 character', 'wh'); ?></p>
		</div>
		<div class="form-field">
			<label for="wh_meta_desc"><?php _e('Meta Description', 'wh'); ?></label>
			<textarea name="wh_meta_desc" id="wh_meta_desc"></textarea>
			<p class="description"><?php _e('Enter a meta description, <= 160 character', 'wh'); ?></p>
		</div>
		<?php
	}

//Product Cat Edit page
	function wh_taxonomy_edit_meta_field($term) {

		//getting term ID
		$term_id = $term->term_id;

		// retrieve the existing value(s) for this meta field.
		$wh_meta_title = get_term_meta($term_id, 'wh_meta_title', true);
		$wh_meta_desc = get_term_meta($term_id, 'wh_meta_desc', true);
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="wh_meta_title"><?php _e('Meta Title', 'wh'); ?></label></th>
			<td>
				<input type="text" name="wh_meta_title" id="wh_meta_title" value="<?php echo esc_attr($wh_meta_title) ? esc_attr($wh_meta_title) : ''; ?>">
				<p class="description"><?php _e('Enter a meta title, <= 60 character', 'wh'); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="wh_meta_desc"><?php _e('Meta Description', 'wh'); ?></label></th>
			<td>
				<textarea name="wh_meta_desc" id="wh_meta_desc"><?php echo esc_attr($wh_meta_desc) ? esc_attr($wh_meta_desc) : ''; ?></textarea>
				<p class="description"><?php _e('Enter a meta description', 'wh'); ?></p>
			</td>
		</tr>
		<?php
	}

	add_action('edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);
	add_action('create_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);

// Save extra taxonomy fields callback function.
	function wh_save_taxonomy_custom_meta($term_id) {

		$wh_meta_title = filter_input(INPUT_POST, 'wh_meta_title');
		$wh_meta_desc = filter_input(INPUT_POST, 'wh_meta_desc');

		update_term_meta($term_id, 'wh_meta_title', $wh_meta_title);
		update_term_meta($term_id, 'wh_meta_desc', $wh_meta_desc);
	}
	function filter_wc_add_to_cart_message( $message, $product_id ) {
		// make filter magic happen here...

		return $message;
	};

// add the filter
	add_filter( 'wc_add_to_cart_message', 'filter_wc_add_to_cart_message', 10, 2 );

	add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
	function change_existing_currency_symbol( $currency_symbol, $currency ) {
		switch( $currency ) {
			case 'UAH': $currency_symbol = 'грн.'; break;
		}
		return $currency_symbol;
	}

	remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
	function woocommerce_pagination() { wp_pagenavi(); }
	add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10);

	 




?>