<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="https://www.facebook.com/2008/fbml" <?php language_attributes() ?> itemscope itemtype="http://schema.org/Blog">
<head>
	<!-- Meta -->
	<meta charset="<?php bloginfo('charset') ?>" />
	<!-- Facebook Open Graph -->
	<meta property="og:site_name" content="<?php bloginfo('name') ?>" />
	<meta property="og:type" content="website" />
<?php if( get_option('facebook_appid') ) { ?>
	<meta property="fb:app_id" content="<?php echo get_option('facebook_appid') ?>" />
<?php } ?>
<?php if( is_single() ) { ?>
	<!-- Is Single -->
	<!-- Facebook Open Graph -->
	<meta property="og:title" content="<?php the_title() ?>"/>
	<meta property="og:url" content="<?php the_permalink() ?>"/>
	<meta property="og:description" content="<?php post_description() ?>" />
	<meta property="og:image" content="<?php post_image() ?>" />
	<!-- Google Plus One -->
	<meta itemprop="name" content="<?php the_title() ?>">
	<meta itemprop="description" content="<?php post_description() ?>">
	<meta itemprop="image" content="<?php post_image() ?>">
<?php } else { ?>
	<!-- Not Single -->
	<!-- Facebook Open Graph -->
	<meta property="og:title" content="<?php bloginfo('name') ?>" />
	<meta property="og:url" content="<?php bloginfo('url') ?>" />
	<meta property="og:description" content="<?php bloginfo('description') ?>" />
	<meta property="og:image" content="<?php bloginfo('stylesheet_directory') ?>/images/logo.png" />
	<!-- Google Plus One -->
	<meta itemprop="name" content="<?php bloginfo('name') ?>">
	<meta itemprop="description" content="<?php bloginfo('description') ?>">
	<meta itemprop="image" content="<?php bloginfo('stylesheet_directory') ?>/images/logo.png">
<?php } ?>

	<!-- Title -->
	<title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ) ?></title>

	<!-- CSS -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>" />

	<!-- RSS & Pingback -->
	<link rel="alternate" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

	<!-- Scripts -->
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head() // For plugins ?>
<?php if( get_option('google_analytics') ) { ?>
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo get_option("google_analytics") ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php } ?>
</head>

<body class="<?php sandbox_body_class() ?>">

<section id="wrapper" class="hfeed">

	<header id="header">
		<h1 id="blog-title"><span><a href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" rel="home"><?php bloginfo('name') ?></a></span></h1>
		<div id="blog-description"><?php bloginfo('description') ?></div>
	</header><!--  #header -->

	<section id="access">
		<div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', 'sandbox' ) ?>"><?php _e( 'Skip to content', 'sandbox' ) ?></a></div>
		<?php sandbox_globalnav() ?>
	</section><!-- #access -->
