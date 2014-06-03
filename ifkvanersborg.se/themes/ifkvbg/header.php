<!doctype html>
<html class="no-js" lang="sv" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1.0" />
	<title><?php wp_title(''); ?></title>
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/ios_icons/apple-touch-icon-114x114-precomposed.png">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/foundation.css" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/foundation-icons/foundation-icons.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_uri(); ?>" />
	<!--[if lte IE 8]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie8/ie8.css">
	<![endif]-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<?php flush(); ?>

<body <?php body_class(); ?>>
	<div id="fb-root"></div>
	
	<!--HEADER-->
	<header class="header clearfix" id="page-header">
      <div class="row">
			<a class="skip-link" href="#page-content" title="Gå till innehåll">Gå till innehåll</a>
			
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo left">
				<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/ifk_logo.png" alt="Logo">
			</a>

			<a class="btn search-btn right"><i class="fi-magnifying-glass"></i></a>
			<a class="btn menu-btn right caps hide-for-large-up">Meny <i class="fi-list"></i></a>
			
			<ul class="top-bar-section right nav show-for-large-up">
				<?php wp_nav_menu(array(
 				'theme_location'  => 'header-menu',
 				'menu'            => 'Header Menu',
 				'container'       => false,
				'menu_class'      => '',
 				'echo'            => true,
 				'fallback_cb'     => 'wp_page_menu',
				'items_wrap'      => '%3$s',
				'depth'           => '3',
				)); ?>
			</ul>
			
		</div>
	</header>

	<div class="search-form-wrapper">
		<div class="row">
			<?php get_search_form(); ?>
		</div>
	</div>