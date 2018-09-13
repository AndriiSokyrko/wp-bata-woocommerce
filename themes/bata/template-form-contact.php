<?php
	/*
	Template Name: Мой шаблон контактная инфорсация
	Template Post Type: post, page, product
	*/
	get_header(); ?>
?>


<section class="pb-3 wrap c-h container" style="min-height: 401px;">
	<h1>Контакты</h1> <hr>
	<?php
		dynamic_sidebar('contact-form');

	?>

	<?php
		while ( have_posts() ) : the_post(); ?>
			<?php
			the_content();?>
	<?php endwhile;?>
	 
	 </section>

<?php wp_reset_postdata();?>
<?php get_rating_social_menu(); ?>

<?php get_footer(); ?>

