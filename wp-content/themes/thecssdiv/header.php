<?php global $linen; ?>
<!DOCTYPE html>
<html <?php language_attributes( 'html' ) ?>>
<head>
	<?php if ( is_front_page() ) : ?>
		<title><?php bloginfo( 'name' ); ?></title>
	<?php elseif ( is_404() ) : ?>
		<title><?php _e( 'Page Not Found |', 'linen' ); ?> | <?php bloginfo( 'name' ); ?></title>
	<?php elseif ( is_search() ) : ?>
		<title><?php printf(__ ("Search results for '%s'", "linen"), get_search_query()); ?> | <?php bloginfo( 'name' ); ?></title>
	<?php else : ?>
		<title><?php wp_title($sep = '' ); ?> | <?php bloginfo( 'name' );?></title>
	<?php endif; ?>

	<!-- Basic Meta Data -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="copyright" content="<?php
		esc_attr( sprintf(
			__( 'Design is copyright %1$s The Theme Foundry', 'linen' ),
			date( 'Y' )
		) );
	?>" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" />

	<!-- WordPress -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="skip-content"><a href="#content"><?php _e( 'Skip to content', 'linen' ); ?></a></div>
	<div id="wrapper" class="clear">
		<div id="header" class="clear">
			<?php if ($linen->logoState() == 'true' ) : ?>
				<?php $upload_dir = wp_upload_dir(); ?>
				<div id="title-logo">
					<a href="<?php echo home_url( '/' ); ?>">
						<img src="<?php echo $linen->logoName(); ?>" alt="<?php if ($linen->logoAlt() !== '' ) echo $linen->logoAlt(); else echo bloginfo( 'name' ); ?>" />
					</a>
				</div>
				<?php if ($linen->logoTagline() == 'true' ) : ?>
					<div id="description">
						<h2><?php bloginfo( 'description' ); ?></h2>
					</div><!--end description-->
				<?php endif; ?>
			<?php else : ?>
				<?php if (is_home()) echo( '<h1 id="title">' ); else echo( '<div id="title">' );?><a href="<?php echo home_url(); ?>"><img id="frame" src="<?php echo get_stylesheet_directory_uri(); ?>/avatar.jpg" alt="" /><?php bloginfo( 'name' ); ?></a><?php if (is_home()) echo( '</h1>' ); else echo( '</div>' );?>
					<div id="description">
						<h2><?php bloginfo( 'description' ); ?></h2>
					</div><!--end description-->
			<?php endif; ?>
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'nav-1',
						'container_id'    => 'navigation',
						'container_class' => 'clear',
						'menu_class'      => 'nav',
						'fallback_cb'     => array( &$linen, 'main_menu_fallback') 
						)
					);
			?>
		</div><!--end header-->
		<?php if (($linen->sliderState() != '' ) && is_front_page() && !is_paged() && $linen->get_sticky_posts_count() >= 2 ) { ?>
			<?php get_template_part( 'tmpart-featured' ); ?>
		<?php } ?>
		<?php if (is_page_template( 'tm-left-sidebar.php' )) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		<div id="content" <?php if ( ( is_page_template( 'tm-no-sidebar.php' ) ) || ( $linen->sidebarDisable() == 'true' ) ) echo ( 'class="no-sidebar"' ); ?>>