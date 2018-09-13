<?php /**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Bata
 * @since Bata 1.0
 */?>
<!DOCTYPE html>
<!-- saved from url=(0027)https://thebatacompany.com/ -->
<html class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!--<base href="https://thebatacompany.com/">--><base href="."><!--[if lte IE 6]></base><![endif]-->
	<title>"<?php echo get_bloginfo('description')?>" » Bata Corporation</title>
	<meta name="generator" content="SilverStripe - http://silverstripe.org">

	<!-- Optimized with the Silverstripe SEO module  (score 0) -->
	<link rel="canonical" href="https://thebatacompany.com/">


	<meta property="og:locale" content="en_GB">

	<meta property="og:type" content="article">
	<meta property="og:title" content="<?php echo get_bloginfo('name')?>">
	<meta property="og:description" content="<?php echo get_bloginfo('description')?>">
	<meta property="og:url" content="<?php echo get_bloginfo('url')?>">
	<meta property="og:site_name" content="<?php echo get_bloginfo('name')?>">


	<meta property="article:published_time" content="2017-05-02T10:33:17+00:00">
	<meta property="article:modified_time" content="2018-01-24T16:53:40+00:00">

	<!-- / Silverstripe SEO module. -->
	<!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri()?>/image/icons/favicon.ico">
	<meta property="og:title" content="<?php echo get_bloginfo('name')?>">


	<meta property="og:site_name" content="Bata Corporation">



	<meta property="og:description" content="<?php echo get_bloginfo('description')?>">



	<meta property="og:url" content="<?php echo get_bloginfo('description')?>">



	<meta property="og:image" content="<?php echo get_bloginfo('description')?>">


	<link rel="icon" sizes="16x16" href="<?php echo get_template_directory_uri()?>/image/icons/icon-16.png">
	<link rel="icon" sizes="32x32" href="<?php echo get_template_directory_uri()?>/image/icons/icon-32.png">
	<link rel="icon" sizes="48x48" href="<?php echo get_template_directory_uri()?>/image/icons/icon-48.png">
	<link rel="icon" sizes="64x64" href="<?php echo get_template_directory_uri()?>/image/icons/icon-64.png">
	<link rel="icon" sizes="128x128" href="<?php echo get_template_directory_uri()?>/image/icons/icon-128.png">
	<link rel="icon" sizes="196x196" href="<?php echo get_template_directory_uri()?>/image/icons/icon-196.png">

	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri()?>/image/icons/icon-60.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri()?>/image/icons/icon-76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri()?>/image/icons/icon-120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri()?>/image/icons/icon-152.png">
	<script>
		themedir = 'themes/bata';
	</script>
<!--	<link href="./Love living in Batas. » Bata Corporation_files/css" rel="stylesheet">-->
<!---->
<!---->
<!--	<link rel="stylesheet" type="text/css" href="./Love living in Batas. » Bata Corporation_files/stylesheet.css">-->

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<body id="HomePage" class="banner-page" style="">

<header class="navbar navbar-default" role="banner">


	<p class="bata-link">
<!--		--><?php //if(has_custom_logo()):?>
<!--		--><?php //echo get_custom_logo();?>
<!--		--><?php //endif;?>
<!--		<a href="http://www.bata.com/" target="_blank">-->
<!--			<img class="img-responsive" src="--><?php //echo get_template_directory_uri();  ?><!--/image/icon-bata-website.png" alt="bata">-->
<!--		</a>-->

	</p>


	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 col-xl-2">
				<div class="navbar-header">
					<a class="navbar-brand navbar-logo" href="https://thebatacompany.com/">

						<img class="img-responsive" src="<?php echo get_template_directory_uri();  ?>/image/bata-large-640-da363e.png" alt="Bata Corporation">

					</a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
			</div>
			<div class="col-md-9 col-xl-10">
				<?php get_navigation();?>
			</div>
		</div>
	</div>
</header>

<!--[if lt IE 8]>
<div class="container chromeframe">
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-error">
				You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browserupgrade your browser</a> to improve your experience.
			</div>
		</div>
	</div>
</div>
<![endif]-->