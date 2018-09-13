<?php
	/**
	 * The template for displaying search results pages
	 *
	 * @package WordPress
	 * @subpackage Twenty_Sixteen
	 * @since Twenty Sixteen 1.0
	 */

	get_header(); ?>



<div class="container-fluid main" role="main">
	<div class="primary-content">
		<h1 class="text-center no-banner">Search Results</h1>
		<div class="row">

			<div class="col-sm-12 searchResults">


				<p class="searchQuery">You searched for "<?php echo esc_html( get_search_query() )?>"</p>



				<div id="SearchResults">

					<?php if(have_posts()):?>
					<?php while(have_posts()): the_post()?>
					<div class="row result">
						<div class="col-sm-3">
							<img class="img-responsive" src="<?php echo get_the_post_thumbnail_url()?>" alt="company profil doing business with us HR2">
						</div>
						<div class="col-sm-9">
							<h4 class="h3">
								<a href="<?php the_permalink()?>">
									<?php the_title()?>
								</a>
							</h4>
							<p><?php the_excerpt()?></p>
							<p>
								<a class="readMoreLink" href="<?php the_permalink()?>" title="Read more about &quot;Doing business with us&quot;">Read more about "Doing business with us"...</a>
							</p>
						</div>
					</div>
					<?php endwhile;?>
					<?php endif;?>







				</div>



			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
