<?php
if ( ! defined( 'ABSPATH')){
    exit; //Exit if access directly
}
?>

<!--<nav class="navbar-collapse collapse" role="navigation">-->


	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'       => 'nav',
			'container_class'=>'navbar-collapse collapse' ,
			'container_id'=>'menu-main',
			'menu'=>'ul',
			'menu_class'     => 'nav navbar-nav navbar-right search-nav',
			'walker' => new Custom_Walker_Naw_Menu(),
		) );
		?>
	<?php endif; ?>
	 
	<!-- Search Form -->



		 







