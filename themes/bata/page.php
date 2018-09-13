<?php get_header(); ?>


<?php if (is_page('management')) : ?>
	<?php locate_template('management/template-management.php',true)?>
	<?php else : ?>




        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>

                	<?php the_content(); ?>

		<?php endwhile;  ?>

		<?php endif;?>
		<?php endif;?>


<?php get_footer();  ?>