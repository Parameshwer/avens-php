<?php
$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
if($segments[2] == 'medical' || $segments[2] == 'biotechnology' || $segments[2] == 'pharmaceutical' || $segments[2] == 'biotechnology') { 
	$journal_pages = array("Home"=> "home", "Aims & Scope" => "aims-scope", "Editorial Board" => "editorial-board","Instructions to Author" => "instructions-to-author","Manuscript Work Flow" => "manuscript-work-flow","Current Issue" => "current-issue","Articles in Press" =>"articles-in-press","Archive" => "archive");
	global $wpdb;
	$results = $wpdb->get_results( 'SELECT post_content, post_name, journal_id, category_id FROM wp_journal_posts WHERE post_slug = "'.$segments[4].'" AND journal_slug = "'.$segments[3].'"', ARRAY_A );	
	$journal_name = $wpdb->get_results( 'SELECT journal_name FROM wp_journals WHERE id="'.$results[0]['journal_id'].'
		" ', ARRAY_A );
	$category_name = $wpdb->get_results( 'SELECT category_name FROM wp_journal_main_categories WHERE category_id="'.$results[0]['category_id'].'" ', ARRAY_A );
	?>
	<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
/* git check*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $category_name[0]['category_name'] . ' | ' . $journal_name[0]['journal_name'] . ' | ' . $results[0]['post_name']; ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" href="http://localhost/avens-php/wp-content/themes/twentysixteen/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/avens-php/wp-content/themes/twentysixteen/theme.css">

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-main">
				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>

					<div id="site-header-menu" class="site-header-menu">
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu_class'     => 'primary-menu',
									 ) );
								?>
							</nav><!-- .main-navigation -->
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>',
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>
					</div><!-- .site-header-menu -->
				<?php endif; ?>
			</div><!-- .site-header-main -->

			<?php if ( get_header_image() ) : ?>
				<?php
					/**
					 * Filter the default twentysixteen custom header sizes attribute.
					 *
					 * @since Twenty Sixteen 1.0
					 *
					 * @param string $custom_header_sizes sizes attribute
					 * for Custom Header. Default '(max-width: 709px) 85vw,
					 * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
					 */
					$custom_header_sizes = apply_filters( 'twentysixteen_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
				?>
				<div class="header-image">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div><!-- .header-image -->
			<?php endif; // End header image check. ?>
		</header><!-- .site-header -->

		<div id="content" class="site-content">

		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<!-- <div class=" affix-top" data-spy="affix" data-offset-top="300" > -->
					<div class="mobile-category-nav visible-xs">
						<a href="#" id="mobile-post-navbtn">Menu</a>
						<ul class="mobile-post-nav">
							<?php 						
							foreach ($journal_pages as $key => $value) {
								echo '<li><a href=".$key.">".$value."</a></li>';
							}
							?>
						</ul>
					</div>
					<div>
						<div id="journal-sidebar-wrapper">
							<div id="journal-sidebar">
								<div id="nav-post">
									<ul class="post-nav">

										<?php 																						$url = get_bloginfo('url');								
										foreach ($journal_pages as $key => $value) {
											echo '<li><a href="'.$url.'/'.$segments[2].'/'.$segments[3].'/'.$value.'">'.$key.'</a></li>';
										}
										?>

									</ul>
								</div>
							</div>
						</div>
						<div class="journal-info-box">
						</div>
					</div>
				</div>		
				<div class="col-sm-8">		
					<div class="post-text-box">				
						<div id="post-content">
							<?php 							
							if(count($results) > 0) {
								if($results[0]["post_name"] && $results[0]["post_content"]) {
									echo '<h1>'.$results[0]["post_name"].'</h1>';
									echo '<p>'.$results[0]["post_content"].'</p>';										
								}
							} else {
								if($segments[4] == 'current-issue') {
									echo '<h1>Current Issue</h1>';
								} else if($segments[4] == 'articles-in-press') {
									echo '<h1>Articles In Press</h1>';							
								}else if($segments[4] == 'archive') {
									echo '<h1>Archive</h1>';
								}
							}
							?>
						</div>  	
					</div>
				</div>
			</div>
		</div>
</body>
<?php get_footer(); ?>
<?php } else {
	include('404-page.php');	
}
?>