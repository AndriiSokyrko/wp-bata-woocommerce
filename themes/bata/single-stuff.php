<?php
	/**
	 * The template for displaying all single posts and attachments
	 *
	 * @package WordPress
	 * @subpackage Twenty_Sixteen
	 * @since Twenty Sixteen 1.0
	 */

	get_header(); ?>
<div class="container-fluid main" id="section-doing-business-with-us">


	<div class="focuspoint primary-image primary-content text-black row" data-focus-x="0" data-focus-y="0"
	     data-image-w="1772" data-image-h="738">
		<img src="<?php echo get_the_post_thumbnail_url()?>"
		     alt="company profil doing business with us HR3" >

		<div class="padded-content clearfix">

			<?php

				while ( have_posts() ) : the_post();
					?>
					<div class="col-md-6 col-md-push-6">
						<h1 class="text-right"><?php the_title()?></h1>


						<div class="content"><p><span style="font-size: 16px;">
									<?php the_excerpt()?></span>
							</p>
							<ul class="h6">
								<li><span>wholesale partner</span></li>
								<li><span>franchise partner</span></li>
								<li><span>supplier</span></li>
							</ul>
							<p>For further help, please use the contact form below.</p></div>

					</div>
				<?php endwhile; ?>


		</div>
	</div>


</div>
<?php get_footer()?>