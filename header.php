<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="https://www.facebook.com/2008/fbml" <?php language_attributes() ?> itemscope itemtype="http://schema.org/Blog">
<head>
	<!-- Meta -->
	<meta charset="<?php bloginfo('charset') ?>" />
	<meta name="viewport" content="width=device-width" />
<?php 
if( get_option('sb_facebook_og') == TRUE ) { 
?>
	<!-- Facebook Open Graph (ALWAYS) -->
	<meta property="og:site_name" content="<?php bloginfo('name') ?>" />
<?php 
	if( get_option('facebook_appid') ) {
?>
	<meta property="fb:app_id" content="<?php echo get_option('sb_facebook_appid') ?>" />
<?php
	}
	if( is_single() ) { 
?>
	<!-- Facebook Open Graph (SINGLE) -->
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php the_title() ?>"/>
	<meta property="og:url" content="<?php the_permalink() ?>"/>
	<meta property="og:description" content="<?php sandbox_post_description() ?>" />
	<meta property="og:image" content="<?php sandbox_post_image() ?>" />
<?php 
	} else { 
?>
	<!-- Facebook Open Graph (NOT SINGLE) -->
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php bloginfo('name') ?>" />
	<meta property="og:url" content="<?php bloginfo('url') ?>" />
	<meta property="og:description" content="<?php bloginfo('description') ?>" />
	<meta property="og:image" content="<?php echo get_option('sb_website_logo') ?>" />
<?php 
	} 
}
if( get_option('sb_google_plus') == TRUE ) {
	if( is_single() ) { ?>
	<!-- Google Plus One (SINGLE) -->
	<meta itemprop="name" content="<?php the_title() ?>">
	<meta itemprop="description" content="<?php sandbox_post_description() ?>">
	<meta itemprop="image" content="<?php sandbox_post_image() ?>">
	<?php } else { ?>
	<!-- Google Plus One (NOT SINGLE) -->
	<meta itemprop="name" content="<?php bloginfo('name') ?>">
	<meta itemprop="description" content="<?php bloginfo('description') ?>">
	<meta itemprop="image" content="<?php echo get_option('sb_website_logo') ?>">
<?php 
	} 
} 
?>
	<!-- Title -->
	<title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ) ?></title>

	<!-- CSS -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/style.css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/shortcodes.css" />

	<!-- RSS & Pingback -->
	<link rel="alternate" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
<?php if( get_option('facebook_appid') ) { ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=<?php echo get_option('facebook_appid') ?>";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>
<section id="wrapper" class="hfeed">

	<header id="header">
		<h1 id="blog-title"><span><a href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" rel="home"><?php bloginfo('name') ?></a></span></h1>
		<div id="blog-description"><?php bloginfo('description') ?></div>
	</header><!--  #header -->

	<section id="access">
		<div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', 'sandbox' ) ?>"><?php _e( 'Skip to content', 'sandbox' ) ?></a></div>
		<?php sandbox_globalnav() ?>
	</section><!-- #access -->
