<?php $settings = get_option('sb_settings'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="https://www.facebook.com/2008/fbml" <?php language_attributes() ?> itemscope itemtype="http://schema.org/Blog"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="https://www.facebook.com/2008/fbml" <?php language_attributes() ?> itemscope itemtype="http://schema.org/Blog"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="https://www.facebook.com/2008/fbml" <?php language_attributes() ?> itemscope itemtype="http://schema.org/Blog"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xmlns:fb="https://www.facebook.com/2008/fbml" <?php language_attributes() ?> itemscope itemtype="http://schema.org/Blog"><!--<![endif]-->
<head>
	<!-- Meta -->
	<meta charset="<?php bloginfo('charset') ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width" />

	<!-- Facebook Open Graph (ALWAYS) -->
	<meta property="og:site_name" content="<?php bloginfo('name') ?>" />
<?php if( $settings['site_fbappid'] != '' ) : ?>
	<meta property="fb:app_id" content="<?php echo $settings['site_fbappid'] ?>" />
<?php endif; ?>

<?php
if ( $settings['site_og'] == 1 ) :  
	if( is_single() ) :
?>
	<!-- Facebook Open Graph (SINGLE) -->
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php the_title() ?>"/>
	<meta property="og:url" content="<?php the_permalink() ?>"/>
	<meta property="og:description" content="<?php sandbox_post_description() ?>" />
	<meta property="og:image" content="<?php sandbox_post_image() ?>" />
<?php 
	else :
?>
	<!-- Facebook Open Graph (NOT SINGLE) -->
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php bloginfo('name') ?>" />
	<meta property="og:url" content="<?php echo home_url() ?>" />
	<meta property="og:description" content="<?php bloginfo('description') ?>" />
	<meta property="og:image" content="<?php echo $settings['site_logo'] ?>" />
<?php 
	endif;
endif; // site_og

if( $settings['site_gplus'] == 1 ) :
	if( is_single() ) :
?>
	<!-- Google Plus One (SINGLE) -->
	<meta itemprop="name" content="<?php the_title() ?>">
	<meta itemprop="description" content="<?php sandbox_post_description() ?>">
	<meta itemprop="image" content="<?php sandbox_post_image() ?>">
<?php else : ?>
	<!-- Google Plus One (NOT SINGLE) -->
	<meta itemprop="name" content="<?php bloginfo('name') ?>">
	<meta itemprop="description" content="<?php bloginfo('description') ?>">
	<meta itemprop="image" content="<?php echo $settings['site_logo'] ?>">
<?php 
	endif;
endif; // site_gplus 
?>
	<!-- Title -->
	<title><?php wp_title( '-', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ) ?></title>

	<!-- RSS & Pingback -->
	<link rel="alternate" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'sandbox' ), esc_html( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'sandbox' ), esc_html( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/main.css" />
	<link rel="stylesheet" href="<?php sandbox_enqueue_css() ?>" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/shortcodes.css" />

	<!-- Scripts -->
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head() // For plugins ?>
</head>

<body class="<?php sandbox_body_class() ?> custom-background">
<?php if( $settings['site_fbappid'] != '' ) : ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=<?php echo $settings['site_fbappid'] ?>";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<?php endif; ?>
<section id="wrapper" class="hfeed">

	<header id="header">
		<h1 id="blog-title"><span><a href="<?php echo home_url() ?>/" title="<?php echo esc_html( get_bloginfo('name'), 1 ) ?>" rel="home"><?php sandbox_header() ?></a></span></h1>

		<?php sandbox_globalnav() ?>
	</header><!--  #header -->