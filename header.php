<?php
/**
 * The Header of the theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Modality
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body <?php body_class(); ?>>

<?php
// modality library
$modality_theme_options = modality_get_options( 'modality_theme_options' );

$sticky_wrapper = (is_home())? "" : "inner-sticky-wrapper";
?>

<div id="wrapper">
	<!-- preloader -->
    <div id="loading">
      <div id="loading-center">
        <div id="loading-center-absolute">
          Loading...
          <div class="object" id="first_object"></div>
          <div class="object" id="second_object"></div>
          <div class="object" id="third_object"></div>
          <div class="object" id="forth_object"></div>
        </div>
      </div>
    </div>

	<div class="clear"></div>
		<?php /*if (get_header_image()!='') { ?>
			<div id="header-holder" style="background: url(<?php echo esc_url(header_image()); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
		<?php } else { ?>
			<div id="header-holder">
		<?php } ?>
			<div id ="header-wrap">
      			<nav class="navbar navbar-default">
					<div id="logo">
						<?php if ( $modality_theme_options['logo'] != '' ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ) ?>"><img src="<?php echo esc_url($modality_theme_options['logo']); ?>" alt="<?php echo esc_attr($modality_theme_options['logo_alt_text']); ?>"/></a>
							<?php if ($modality_theme_options['enable_logo_tagline'] == '1' ) { ?>
								<h5 class="site-description"><?php echo esc_attr(bloginfo('description')); ?></h5>
							<?php } ?>
						<?php } else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ) ?>"><?php esc_attr(bloginfo( 'name' )); ?></a>
							<?php if ($modality_theme_options['enable_logo_tagline'] == '1' ) { ?>
								<h5 class="site-description"><?php echo esc_attr(bloginfo('description')); ?></h5>
							<?php } ?>
						<?php } ?>
					</div>
        			<div class="navbar-header">
            			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              			<span class="sr-only">Toggle navigation</span>
              			<span class="icon-bar"></span>
              			<span class="icon-bar"></span>
              			<span class="icon-bar"></span>
            			</button>
          			</div><!--navbar-header-->
          			<div id="navbar" class="navbar-collapse collapse">
					<?php
					if (has_nav_menu('main_navigation')) {

						$modality_default_menu = array(
    						'theme_location'  => 'main_navigation',
							'menu'       => 'main_navigation',
    						'depth'      => 0,
    						'container'  => false,
    						'menu_class' => 'nav navbar-nav',
                			'fallback_cb'       => 'wp_page_menu',
    						'walker'     => new wp_bootstrap_navwalker(),
						);

					} else {

						$modality_default_menu = array(
    						'theme_location'  => 'main_navigation',
							'menu'       => 'main_navigation',
    						'depth'      => 0,
    						'container'  => false,
    						'menu_class' => 'nav-bar',
                			'fallback_cb'       => 'wp_page_menu',
						);

					}

					wp_nav_menu( $modality_default_menu );

					?>

          			</div><!--/.nav-collapse -->

      </nav>
			</div><!--header-wrap-->
		</div><!--header-holder-->
*/?>
<!-- Header -->
<header class="header">
  <div class="header-nav <?php echo $sticky_wrapper; ?>">
	<!-- menu -->
	<nav role="navigation" class="navbar navbar-default navbar-dark navbar-fixed-top navbar-animated navbar-transparent">
	  <div class="container">
		<div class="row">
		  <div class="col-md-12">
			<div class="navbar-header">
			  <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			  <!-- logo -->
			  <?php if ( $modality_theme_options['logo'] != '' ) { ?>
				  <a href="<?php echo esc_url( home_url( '/' ) ) ?>" class="navbar-brand"><img src="<?php echo esc_url($modality_theme_options['logo']); ?>" alt="<?php echo esc_attr($modality_theme_options['logo_alt_text']); ?>"/></a>
				  <?php if ($modality_theme_options['enable_logo_tagline'] == '1' ) { ?>
					  <h5 class="site-description"><?php echo esc_attr(bloginfo('description')); ?></h5>
				  <?php } ?>
			  <?php } else { ?>
				  <a href="<?php echo esc_url( home_url( '/' ) ) ?>" class="navbar-brand"><?php esc_attr(bloginfo( 'name' )); ?></a>
				  <?php if ($modality_theme_options['enable_logo_tagline'] == '1' ) { ?>
					  <h5 class="site-description"><?php echo esc_attr(bloginfo('description')); ?></h5>
				  <?php } ?>
			  <?php } ?>
		    </div>
			<div class="navbar-collapse collapse" id="navbar" aria-expanded="false" role="menu" style="height: 1px;">
				<?php
				if (has_nav_menu('main_navigation')) {

					$modality_default_menu = array(
						'theme_location'  => 'main_navigation',
						'menu'       => 'main_navigation',
						'depth'      => 0,
						'container'  => false,
						'menu_class' => 'nav navbar-nav navbar-right',
						'fallback_cb'       => 'wp_page_menu',
						'walker'     => new wp_bootstrap_navwalker(),
					);

				} else {

					$modality_default_menu = array(
						'theme_location'  => 'main_navigation',
						'menu'       => 'main_navigation',
						'depth'      => 0,
						'container'  => false,
						'menu_class' => 'nav-bar',
						'fallback_cb'       => 'wp_page_menu',
					);

				}

				wp_nav_menu( $modality_default_menu );

				?>

		    </div>
			<!--/.nav-collapse --></div>
		</div>
		<div id="top-search-bar" class="collapse">
  		<div class="container">
  		  <form role="search" action="#" class="search_form_top" method="get" action="">
  			<input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="on">
  			<span class="search-close"><i class="fa fa-times"></i></span>
  		  </form>
  		</div>
  	  </div>
	  </div>

	</nav>
	<!-- end menu -->
  </div>
</header>
