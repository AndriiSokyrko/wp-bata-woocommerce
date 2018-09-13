<?php
	/**
	 * The Template for displaying product archives, including the main shop page which is a post type archive
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
	 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
	 * as little as possible, but it does happen. When this occurs the version of the template file will.
	 * be bumped and the readme will list any important changes.
	 *
	 * @see 	    http://docs.woothemes.com/document/template-structure/
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     2.0.0
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
get_header();?>
 


<!--[if lt IE 8]>
<div class="container chromeframe">
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-error">
				You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
			</div>
		</div>
	</div>
</div>
<![endif]-->


	<?php locate_template('main/template-main.php', true)?>


<?php get_footer();?>