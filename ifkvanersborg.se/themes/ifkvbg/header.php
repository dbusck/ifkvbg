<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1.0" />
	<title><?php wp_title(''); ?></title>
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico?v=2" rel="shortcut icon" type="image/x-icon" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/ios_icons/apple-touch-icon-114x114-precomposed.png">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_uri(); ?>" />
	<!--[if lte IE 8]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie8/ie8.css">
	<![endif]-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<?php flush(); ?>

<body <?php body_class(); ?>>

	<!--HEADER-->
	<header>
		<div class="center">
			<a class="skip-link" href="#content" title="Gå till innehåll">Gå till innehåll</a>
			
			<a class="btn menu-btn"></a>
			
			<ul class="nav main-nav">
				<?php wp_nav_menu(array(
 				'theme_location'  => 'header-menu',
 				'menu'            => 'Header Menu',
 				'container'       => false,
				'menu_class'      => 'nav main-nav',
 				'echo'            => true,
 				'fallback_cb'     => 'wp_page_menu',
				'items_wrap'      => '%3$s',
				'depth'           => '1',
				)); ?>
			</ul>
			
		</div>
	</header>