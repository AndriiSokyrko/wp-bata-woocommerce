<?php
//	/*
//	Template Name: Мой шаблон management
//	Template Post Type: post, page, product
//	*/
//
//?>
<?php
//get_header();
?>



<div class="container-fluid main wwww">

	<div class="focuspoint primary-image primary-content text-white row" data-focus-x="0" data-focus-y="0" data-image-w="1920" data-image-h="1200">
		<img src="http://bata/wp-content/uploads/2018/05/managment/management-main.jpg" alt="management main" style="max-width: 100%; top: -1.625%; left: 0px;">

		<div class="padded-content clearfix">


			<div class="col-md-6">
				<h1>Leading by example.</h1>


				<div class="content"><p class="h6">As well as being a global brand, we are&nbsp;still a private family business, run by a&nbsp;passionate multicultural leadership team.</p></div>

			</div>
		</div>
	</div>



	<div class="primary-staff secondary-content">
		<div class="pos-holder">
			<div class="focuspoint summary-image row" data-focus-x="0" data-focus-y="0" data-image-w="1920" data-image-h="800">
				<img src="http://bata/wp-content/uploads/2018/05/managment/management-alexis-nasard3.jpg" alt="management alexis nasard3" style="max-height: 100%; top: 0px; left: -4.54545%;">
				<div class="overlay">
					<h2 class="h9"><span class="line">Chief Executive Officer</span></h2>
				</div>
			</div>
			<div class="row content d-flex align-items-center w-100">
				<div class="overlay-content col-xs-12 col-lg-5 aligned align-bottom align-left text-white">
					<h3 class="h2">Alexis Nasard</h3>
					<blockquote class="h3">
						Creativity, discipline and passionate leadership are key to winning long-term
					</blockquote>
					<p>

						Mr. Alexis Nasard has been Chief Executive Officer at Bata since April 2016.&nbsp; Previously with Heineken,&nbsp; Mr. Nasard has covered a broad range of leadership roles such as Global Chief Marketing Officer and President of Europe.

					</p>
					<p><button class="btn btn-link" data-toggle="modal" data-target="#modal-14">Learn More</button></p>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-14">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<img class="img-responsive" src="http://bata/wp-content/uploads/2018/05/managment/management-alexis-nasard3(1).jpg" alt="management alexis nasard3">
					<p>Mr. Alexis Nasard has been Chief Executive Officer at Bata since April 2016.&nbsp; Previously with Heineken,&nbsp; Mr. Nasard has covered a broad range of leadership roles such as Global Chief Marketing Officer and President of Europe.</p><p>Mr. Nasard also worked for 17 year with Procter and Gamble (P&amp;G) in Senior Management roles. His last assignment was General Manager of the Personal Care business for Central, Eastern Europe, the Middle-East and Africa at Procter and Gamble. &nbsp;Mr. Nasard holds an MBA degree from UC Berkeley Haas School of Business, USA and an MS and BS degree in Civil Engineering from the Saint Joseph University, Beirut, Lebanon</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>



	<div class="staff-members row">
			<?php
//			 global  $wp_query;
			$wp_query = new WP_Query(['post_type'=>'stuff', 'category_name'=>'staff-members']);
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		<div class="staff col-xs-12 col-sm-6 col-md-4 matchheight" style="height: 665px;">
			<div class="focuspoint summary-image row" data-focus-x="0.0916666666667" data-focus-y="0.106666666667"
			     data-image-w="1919" data-image-h="1200">
<!--				<img src="http://bata/wp-content/uploads/2018/05/managment//alberto-toni2.jpg" alt="alberto toni2" style="max-height: 100%; top: 0px; left: -24.0909%;">-->
				<?php the_post_thumbnail();?>
				<div class="overlay">

					<h2 class="h9"><span class="line"><?php echo get_post_meta(get_the_ID(),'wp-name',true)?></span></h2>
				</div>
			</div>
			<div class="content">
				<h3 class="h2"><?php echo get_metadata('stuff',$wp_query->ID,'wp_name')?></h3>
				<p class="matchheight-summary" style="height: 80px;">
					<?php the_excerpt();?>
<!--					Alberto Toni joined Bata as Chief Financial Officer in 2016; he is&nbsp;responsible&nbsp;of&nbsp;all aspects of finance&nbsp;management for the company globally. &nbsp;-->

				</p>
				<p><button class="btn btn-link" data-toggle="modal" data-target="#modal-<?php the_ID()?>">Learn More</button></p>
			</div>
		</div>
		<div class="modal fade" tabindex="-1" role="dialog" id="modal-<?php the_ID()?>">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
						<img class="img-responsive" src="<?php echo the_post_thumbnail_url();?>" alt="alberto toni2">
<!--						--><?php //the_post_thumbnail()?>
						<p>
							<?php the_content()?>
<!--							Alberto Toni joined Bata as Chief Financial Officer in 2016; he is&nbsp;responsible&nbsp;of&nbsp;all aspects of finance&nbsp;management for the company globally. &nbsp;</p><p>Previously, Mr Toni was Chief Financial Officer at Deoleo, world leader in the production and commercialization of the oil of olive. Prior to Deoleo, Mr. Toni&nbsp;has&nbsp;worked &nbsp;17 years for Heineken fulfilling various&nbsp;senior finance roles&nbsp;internationally. Mr. Toni holds a degree in economics from the Università Cattolica of Milano and he is also a chartered accountant and certified tax advisor.</p>-->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
			<?php   endwhile; ?>
		<?php  wp_reset_postdata();?>
	</div>


	<div class="key-leaders bg-grey row">
		<h2 class="text-center col-sm-12 h5">Key Leaders</h2>
		<?php
//			global  $wp_query;
			$wp_query1 = new WP_Query(['post_type'=>'stuff', 'category_name'=>'key-leaders']);
			while ( $wp_query1->have_posts() ) : $wp_query1->the_post(); ?>

		<div class="staff key col-xs-12 col-sm-6 col-md-4 matchheight" style="height: 375px;">
			<div class="focuspoint summary-image row" data-focus-x="0" data-focus-y="0" data-image-w="1920" data-image-h="1200">
				<img src="<?php echo the_post_thumbnail_url();?>" alt="management barbara franceschetto2" style="max-height: 100%; top: 0px; left: -18.1818%;">
			</div>
			<div class="content overlay">
				<h3 class="h9"><span class="line"><?php echo get_post_meta(get_the_ID(),'wp-stuff',true)?></span></h3>
				<h4 class="h7"><?php echo get_post_meta(get_the_ID(),'wp-name',true)?></h4>
				<!--<div class="overlay-content">
					<p>



					</p>
				</div>-->
			</div>
		</div>
			<?php   endwhile; ?>
		<?php  wp_reset_postdata();?>
	</div>

</div>

<?php
//get_footer();
//?>
