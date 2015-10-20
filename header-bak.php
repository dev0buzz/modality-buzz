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
</head>
<body <?php body_class(); ?>>
<div id="wrapper"> <!-- id="grid-container" -->
	<!-- preloader -->
    <div id="loading">
      <div id="loading-center">
        <div id="loading-center-absolute">
          <div class="loading-text">
            Loading ...
          </div>
          <div class="object" id="first_object"></div>
          <div class="object" id="second_object"></div>
          <div class="object" id="third_object"></div>
          <div class="object" id="forth_object"></div>
        </div>
      </div>
    </div>

	<div class="clear"></div>
		<?php $modality_theme_options = modality_get_options( 'modality_theme_options' );
		if ($modality_theme_options['header_top_enable'] == '1') {
			get_template_part( 'top', 'header' );
		} ?>
		<header class="header">
		<?php if (get_header_image()!='') { ?>
			<div id="header-holder2" style="background: url(<?php echo esc_url(header_image()); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
		<?php } else { ?>
			<div id="header-holder2">
		<?php } ?>
			<div id ="header-wrap" class="header-nav">
      			<nav role="navigation" class="navbar navbar-default navbar-dark navbar-fixed-top navbar-animated navbar-transparent">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="navbar-header">
									<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
									<div id="logo">
									<?php if ( $modality_theme_options['logo'] != '' ) { ?>
										<a id="header-logo" href="<?php echo esc_url( home_url( '/' ) ) ?>"><img src="<?php echo esc_url($modality_theme_options['logo']); ?>" alt="<?php echo esc_attr($modality_theme_options['logo_alt_text']); ?>"/></a>
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
								</div>
			        			<!--<div class="navbar-header">
			            			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			              			<span class="sr-only">Toggle navigation</span>
			              			<span class="icon-bar"></span>
			              			<span class="icon-bar"></span>
			              			<span class="icon-bar"></span>
			            			</button>
			          			</div><!--navbar-header-->
			          			<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" role="menu" style="height: 1px;">
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
			    						'menu_class' => 'nav-bar navbar-right',
			                			'fallback_cb'       => 'wp_page_menu',
									);

								}

								wp_nav_menu( $modality_default_menu );

								?>

			          			</div><!--/.nav-collapse -->
							</div>
						</div>
					</div>

					<?php /*<div class="container">
			          <div class="row">
			            <div class="col-md-12">
			              <div class="navbar-header">
			                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			                <!-- logo -->
			                <a id="header-logo" href="index.html" class="navbar-brand"><img height="35" src="<?php echo bloginfo('template_url')?>/images/logo_putih.png" alt=""></a> </div>
			              <div class="navbar-collapse collapse" id="navbar" aria-expanded="false" role="menu" style="height: 1px;">
			                <ul class="nav navbar-nav navbar-right">
			                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Home <i class="fa fa-angle-down caret"></i></a>
			                    <ul class="dropdown-menu">
			                      <li class="dropdown"><a href="#">Home - Agency (Single)<i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="agency-sp-default.html">Default Home</a></li>
			                          <li><a href="agency-sp-bg-image-parallax1.html">Image Parallax 1</a></li>
			                          <li><a href="agency-sp-bg-image-parallax2.html">Image Parallax 2</a></li>
			                          <li><a href="agency-sp-bg-image-slider1.html">Slider Background 1</a></li>
			                          <li><a href="agency-sp-bg-image-slider2.html">Slider Background 2</a></li>
			                          <li><a href="agency-sp-bg-youtube-video1.html">Youtube Background 1</a></li>
			                          <li><a href="agency-sp-bg-youtube-video2.html">Youtube Background 2</a></li>
			                          <li><a href="agency-sp-fullwidth-carousel1.html">Fullwidth Carousel 1</a></li>
			                          <li><a href="agency-sp-fullwidth-carousel2.html">Fullwidth Carousel 2</a></li>
			                          <li><a href="agency-sp-revolution-slider1.html">Slider Revolution 1</a></li>
			                          <li><a href="agency-sp-revolution-slider2.html">Slider Revolution 2</a></li>
			                          <li><a href="agency-sp-revolution-slider3.html">Slider Revolution 3</a></li>
			                          <li><a href="agency-sp-static-text.html">Static Text</a></li>
			                          <li><a href="agency-sp-text-boxes.html">Home Text Boxes</a></li>
			                          <li><a href="agency-sp-text-rotator.html">Text Rotator</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Agency (Multi)<i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="agency-mp-default.html">Default Home</a></li>
			                          <li><a href="agency-mp-bg-image-parallax1.html">Image Parallax 1</a></li>
			                          <li><a href="agency-mp-bg-image-parallax2.html">Image Parallax 2</a></li>
			                          <li><a href="agency-mp-bg-image-slider1.html">Slider Background 1</a></li>
			                          <li><a href="agency-mp-bg-image-slider2.html">Slider Background 2</a></li>
			                          <li><a href="agency-mp-bg-vimeo-video1.html">Vimeo Background 1</a></li>
			                          <li><a href="agency-mp-bg-vimeo-video2.html">Vimeo Background 2</a></li>
			                          <li><a href="agency-mp-bg-youtube-video1.html">Youtube Background 1</a></li>
			                          <li><a href="agency-mp-bg-youtube-video2.html">Youtube Background 2</a></li>
			                          <li><a href="agency-mp-fullwidth-carousel1.html">Fullwidth Carousel 1</a></li>
			                          <li><a href="agency-mp-fullwidth-carousel2.html">Fullwidth Carousel 2</a></li>
			                          <li><a href="agency-mp-revolution-slider1.html">Slider Revolution 1</a></li>
			                          <li><a href="agency-mp-revolution-slider2.html">Slider Revolution 2</a></li>
			                          <li><a href="agency-mp-revolution-slider3.html">Slider Revolution 3</a></li>
			                          <li><a href="agency-mp-static-text.html">Static Text</a></li>
			                          <li><a href="agency-mp-text-boxes.html">Home Text Boxes</a></li>
			                          <li><a href="agency-mp-text-rotator.html">Text Rotator</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Personal (Single)<i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="personal-sp-default.html">Default Home</a></li>
			                          <li><a href="personal-sp-bg-image-parallax1.html">Image Parallax 1</a></li>
			                          <li><a href="personal-sp-bg-image-parallax2.html">Image Parallax 2</a></li>
			                          <li><a href="personal-sp-bg-image-slider1.html">Slider Background 1</a></li>
			                          <li><a href="personal-sp-bg-image-slider2.html">Slider Background 2</a></li>
			                          <li><a href="personal-sp-bg-vimeo-video1.html">Vimeo Background 1</a></li>
			                          <li><a href="personal-sp-bg-vimeo-video2.html">Vimeo Background 2</a></li>
			                          <li><a href="personal-sp-bg-youtube-video1.html">Youtube Background 1</a></li>
			                          <li><a href="personal-sp-bg-youtube-video2.html">Youtube Background 2</a></li>
			                          <li><a href="personal-sp-fullwidth-carousel1.html">Fullwidth Carousel 1</a></li>
			                          <li><a href="personal-sp-fullwidth-carousel2.html">Fullwidth Carousel 2</a></li>
			                          <li><a href="personal-sp-revolution-slider1.html">Slider Revolution 1</a></li>
			                          <li><a href="personal-sp-revolution-slider2.html">Slider Revolution 2</a></li>
			                          <li><a href="personal-sp-revolution-slider3.html">Slider Revolution 3</a></li>
			                          <li><a href="personal-sp-static-text.html">Static Text</a></li>
			                          <li><a href="personal-sp-text-boxes.html">Home Text Boxes</a></li>
			                          <li><a href="personal-sp-text-rotator.html">Text Rotator</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Personal (Multi)<i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="personal-mp-default.html">Default Home</a></li>
			                          <li><a href="personal-mp-bg-image-parallax1.html">Image Parallax 1</a></li>
			                          <li><a href="personal-mp-bg-image-parallax2.html">Image Parallax 2</a></li>
			                          <li><a href="personal-mp-bg-image-slider1.html">Slider Background 1</a></li>
			                          <li><a href="personal-mp-bg-image-slider2.html">Slider Background 2</a></li>
			                          <li><a href="personal-mp-bg-vimeo-video1.html">Vimeo Background 1</a></li>
			                          <li><a href="personal-mp-bg-vimeo-video2.html">Vimeo Background 2</a></li>
			                          <li><a href="personal-mp-bg-youtube-video1.html">Youtube Background 1</a></li>
			                          <li><a href="personal-mp-bg-youtube-video2.html">Youtube Background 2</a></li>
			                          <li><a href="personal-mp-fullwidth-carousel1.html">Fullwidth Carousel 1</a></li>
			                          <li><a href="personal-mp-fullwidth-carousel2.html">Fullwidth Carousel 2</a></li>
			                          <li><a href="personal-mp-revolution-slider1.html">Slider Revolution 1</a></li>
			                          <li><a href="personal-mp-revolution-slider2.html">Slider Revolution 2</a></li>
			                          <li><a href="personal-mp-revolution-slider3.html">Slider Revolution 3</a></li>
			                          <li><a href="personal-mp-static-text.html">Static Text</a></li>
			                          <li><a href="personal-mp-text-boxes.html">Home Text Boxes</a></li>
			                          <li><a href="personal-mp-text-rotator.html">Text Rotator</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Blog <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="blog-home-postformat-multi-layout1.html">Multi Post Format 1</a></li>
			                          <li><a href="blog-home-postformat-multi-layout2.html">Multi Post Format 2</a></li>
			                          <li><a href="blog-home-postformat-multi-layout3.html">Multi Post Format 3</a></li>
			                          <li><a href="blog-home-postformat-multi-layout4.html">Multi Post Format 4</a></li>
			                          <li><a href="blog-home-postformat-image-layout1.html">Image Post Format 1</a></li>
			                          <li><a href="blog-home-postformat-image-layout2.html">Image Post Format 2</a></li>
			                          <li><a href="blog-home-postformat-image-layout3.html">Image Post Format 3</a></li>
			                          <li><a href="blog-home-postformat-image-layout4.html">Image Post Format 4</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Magazine <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="blog-magazine-layout1.html">Magazine Layout 1</a></li>
			                          <li><a href="blog-magazine-layout2.html">Magazine Layout 2</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Minimal <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="minimal-mp-agency-home.html">Agency Multipage</a></li>
			                          <li><a href="minimal-sp-agency-home.html">Agency Single Page</a></li>
			                          <li><a href="minimal-sp-agency-revolution-slider-layout1.html">Agency Revolution Slider 1</a></li>
			                          <li><a href="minimal-sp-agency-revolution-slider-layout2.html">Agency Revolution Slider 2</a></li>
			                          <li><a href="minimal-mp-personal-home.html">Personal Multipage</a></li>
			                          <li><a href="minimal-sp-personal-home.html">Personal Single Page</a></li>
			                          <li><a href="minimal-sp-personal-revolution-slider-layout1.html">Personal Revolution Slider 1</a></li>
			                          <li><a href="minimal-sp-personal-revolution-slider-layout2.html">Personal Revolution Slider 2</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Vertical Nav <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="vertical-nav-mp-agency-home.html">Agency Multipage</a></li>
			                          <li><a href="vertical-nav-sp-agency-home.html">Agency Single Page</a></li>
			                          <li><a href="vertical-nav-sp-agency-revolution-slider-layout1.html">Agency Revolution Slider 1</a></li>
			                          <li><a href="vertical-nav-sp-agency-revolution-slider-layout2.html">Agency Revolution Slider 2</a></li>
			                          <li><a href="vertical-nav-mp-personal-home.html">Personal Multipage</a></li>
			                          <li><a href="vertical-nav-sp-personal-home.html">Personal Single Page</a></li>
			                          <li><a href="vertical-nav-sp-personal-revolution-slider-layout1.html">Personal Revolution Slider 1</a></li>
			                          <li><a href="vertical-nav-sp-personal-revolution-slider-layout2.html">Personal Revolution Slider 2</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Mobile Nav <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="mobilenav-mp-agency-home.html">Agency Multipage</a></li>
			                          <li><a href="mobilenav-sp-agency-home.html">Agency Single Page</a></li>
			                          <li><a href="mobilenav-mp-personal-home.html">Personal Multipage</a></li>
			                          <li><a href="mobilenav-sp-personal-home.html">Personal Single Page</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Resume <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="resume-default-layout1.html">Default Layout 1</a></li>
			                          <li><a href="resume-default-layout2.html">Default Layout 2</a></li>
			                          <li><a href="resume-minimal-layout1.html">Minimal Layout 1</a></li>
			                          <li><a href="resume-minimal-layout2.html">Minimal Layout 2</a></li>
			                          <li><a href="resume-mobilenav-layout1.html">Mobilenav Layout 1</a></li>
			                          <li><a href="resume-mobilenav-layout2.html">Mobilenav Layout 2</a></li>
			                          <li><a href="resume-vertical-nav-layout1.html">Vertical Nav Layout 1</a></li>
			                          <li><a href="resume-vertical-nav-layout2.html">Vertical Nav Layout 2</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Landing <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="landing-page-applanding-layout1.html">App Landing Layout 1</a></li>
			                          <li><a href="landing-page-applanding-layout2.html">App Landing Layout 2</a></li>
			                          <li><a href="landing-page-applanding-layout3.html">App Landing Layout 3</a></li>
			                          <li><a href="landing-page-applanding-layout4.html">App Landing Layout 4</a></li>
			                          <li><a href="landing-page-online-course-layout1.html">Course Landing Layout 1</a></li>
			                          <li><a href="landing-page-online-course-layout2.html">Course Landing Layout 2</a></li>
			                          <li><a href="landing-page-online-course-layout3.html">Course Landing Layout 3</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Hot! <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="hot-multiscroll-slider.html">Multiscroll Slider</a></li>
			                          <li><a href="hot-fullpage-slider.html">Fullpage Slider</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Home - Shop <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="shop-home-layout1.html">Layout 1</a></li>
			                          <li><a href="shop-home-layout2.html">Layout 2</a></li>
			                        </ul>
			                      </li>
			                    </ul>
			                  </li>
			                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Features <i class="fa fa-angle-down caret"></i></a>
			                    <ul class="dropdown-menu">
			                      <li class="dropdown"><a href="#">Header <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li class="dropdown"><a href="#">Transparent <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="features-header-transparent.html">Fixed wide</a></li>
			                              <li><a href="features-header-transparent-fullwide.html">Full wide</a></li>
			                            </ul>
			                          </li>
			                          <li class="dropdown"><a href="#">White <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="features-header-white.html">Fixed wide</a></li>
			                              <li><a href="features-header-white-fullwide.html">Full wide</a></li>
			                            </ul>
			                          </li>
			                          <li class="dropdown"><a href="#">Dark <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="features-header-dark.html">Fixed wide</a></li>
			                              <li><a href="features-header-dark-fullwide.html">Full wide</a></li>
			                            </ul>
			                          </li>
			                          <li class="dropdown"><a href="#">Sticky White <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="features-header-sticky-white.html">Fixed wide</a></li>
			                              <li><a href="features-header-sticky-white-fullwide.html">Full wide</a></li>
			                            </ul>
			                          </li>
			                          <li class="dropdown"><a href="#">Sticky Dark <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="features-header-sticky-dark.html">Fixed wide</a></li>
			                              <li><a href="features-header-sticky-dark-fullwide.html">Full wide</a></li>
			                            </ul>
			                          </li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Menu <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="features-menu-style1.html">Style 1</a></li>
			                          <li><a href="features-menu-style2.html">Style 2</a></li>
			                          <li><a href="features-menu-style3.html">Style 3</a></li>
			                          <li><a href="features-menu-style4.html">Style 4</a></li>
			                          <li><a href="features-menu-style5.html">Style 5</a></li>
			                          <li><a href="features-header-vertical-nav.html">Vertical Nav</a></li>
			                          <li><a href="features-header-mobile-nav.html">Mobile Nav</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Photo Gallery <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li class="dropdown"><a href="#">Masonry <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="photo-gallery-masonry-3columns.html">3 Columns</a></li>
			                              <li><a href="photo-gallery-masonry-4columns.html">4 Columns</a></li>
			                              <li><a href="photo-gallery-masonry-5columns.html">5 Columns</a></li>
			                            </ul>
			                          </li>
			                          <li class="dropdown"><a href="#">Square <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="photo-gallery-square-3columns.html">3 Columns</a></li>
			                              <li><a href="photo-gallery-square-4columns.html">4 Columns Layout1</a></li>
			                              <li><a href="photo-gallery-square-4columns-layout2.html">4 Columns Layout2</a></li>
			                              <li><a href="photo-gallery-square-fullwidth-4columns.html">4 Columns Fullwidth Layout1</a></li>
			                              <li><a href="photo-gallery-square-fullwidth-4columns-layout2.html">4 Columns Fullwidth Layout2</a></li>
			                            </ul>
			                          </li>
			                          <li class="dropdown"><a href="#">Tiles <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="photo-gallery-tiles-gallery-layout1.html">Layout1</a></li>
			                              <li><a href="photo-gallery-tiles-gallery-layout1-fullwidth.html">Layout1 Fullwidth</a></li>
			                              <li><a href="photo-gallery-tiles-gallery-layout2.html">Layout2</a></li>
			                              <li><a href="photo-gallery-tiles-gallery-layout2-fullwidth.html">Layout2 Fullwidth</a></li>
			                            </ul>
			                          </li>
			                          <li class="dropdown"><a href="#">Swiper Slider <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                          	<ul class="dropdown-menu">
			                              <li><a href="photo-gallery-swiper-slider.html">Swiper Default</a></li>
			                              <li><a href="photo-gallery-swiper-slider-lazyload.html">Swiper Lazyload</a></li>
			                              <li><a href="photo-gallery-swiper-slider-with-thumb.html">Swiper Thumb</a></li>
			                            </ul>
			                          </li>
			                          <li><a href="photo-gallery-owl-carousel.html">Owl Slider</a></li>
			                          <li><a href="photo-gallery-revolution-kenburn-effect.html">Revolution Kenburn Effect</a></li>
			                          <li><a href="photo-gallery-maximage-slider.html">Maximage Slider</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Page Title <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="features-page-title-image-bg1.html">Image Bg 1</a></li>
			                          <li><a href="features-page-title-image-bg2.html">Image Bg 2</a></li>
			                          <li><a href="features-page-title-image-bg3.html">Image Bg 3</a></li>
			                          <li><a href="features-page-title-image-bg4.html">Image Bg 4</a></li>
			                          <li><a href="features-page-title-solid-bg1.html">Solid Bg 1</a></li>
			                          <li><a href="features-page-title-solid-bg2.html">Solid Bg 2</a></li>
			                          <li><a href="features-page-title-solid-bg3.html">Solid Bg 3</a></li>
			                          <li><a href="features-page-title-solid-bg4.html">Solid Bg 4</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Footer <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="features-footer-style1.html#footer">Style 1</a></li>
			                          <li><a href="features-footer-style2.html#footer">Style 2</a></li>
			                          <li><a href="features-footer-style3.html#footer">Style 3</a></li>
			                          <li><a href="features-footer-style4.html#footer">Style 4</a></li>
			                          <li><a href="features-footer-style5.html#footer">Style 5</a></li>
			                          <li><a href="features-footer-style6.html#footer">Style 6</a></li>
			                          <li><a href="features-footer-minimal1.html#footer">minimal 1</a></li>
			                          <li><a href="features-footer-minimal2.html#footer">minimal 2</a></li>
			                        </ul>
			                      </li>
			                    </ul>
			                  </li>
			                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Pages <i class="fa fa-angle-down caret"></i></a>
			                    <ul class="dropdown-menu multi-column columns-2">
			                      <li class="col-md-6">
			                        <ul class="multi-column-dropdown">
			                          <li><a href="page-about-us.html">About Us</a></li>
			                          <li><a href="page-about-me.html">About Me</a></li>
			                          <li><a href="page-services1.html">Services 1</a></li>
			                          <li><a href="page-services2.html">Services 2</a></li>
			                          <li><a href="page-team1.html">Team 1</a></li>
			                          <li><a href="page-team2.html">Team 2</a></li>
			                          <li><a href="page-pricing1.html">Pricing 1</a></li>
			                          <li><a href="page-pricing2.html">Pricing 2</a></li>
			                          <li><a href="page-faq1.html">FAQ 1</a></li>
			                          <li><a href="page-faq2.html">FAQ 2</a></li>
			                          <li><a href="page-faq3.html">FAQ 3</a></li>
			                        </ul>
			                      </li>
			                      <li class="col-md-6">
			                        <ul class="multi-column-dropdown">
			                          <li><a href="page-contact1.html">Contact 1</a></li>
			                          <li><a href="page-contact2.html">Contact 2</a></li>
			                          <li><a href="page-login.html">Login</a></li>
			                          <li><a href="page-register.html">Register</a></li>
			                          <li><a href="page-login-register.html">Login/Register</a></li>
			                          <li><a href="page-404-layout1.html">404 Layout 1</a></li>
			                          <li><a href="page-404-layout2.html">404 Layout 2</a></li>
			                          <li><a href="page-404-layout3.html">404 Layout 3</a></li>
			                          <li><a href="page-under-construction.html">Under Construction</a></li>
			                          <li><a href="page-coming-soon.html">Coming Soon</a></li>
			                        </ul>
			                      </li>
			                    </ul>
			                  </li>
			                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Portfolio <i class="fa fa-angle-down caret"></i></a>
			                    <ul class="dropdown-menu">
			                      <li class="dropdown"><a href="#">Grid <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="portfolio-grid-1-column.html">1 Column</a></li>
			                          <li><a href="portfolio-grid-2-columns.html">2 Columns</a></li>
			                          <li><a href="portfolio-grid-3-columns.html">3 Columns</a></li>
			                          <li><a href="portfolio-grid-4-columns.html">4 Columns</a></li>
			                          <li><a href="portfolio-grid-5-columns.html">5 Columns</a></li>
			                          <li><a href="portfolio-grid-6-columns.html">6 Columns</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Grid Fullwide <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="portfolio-grid-fullwide-1-column.html">1 Column</a></li>
			                          <li><a href="portfolio-grid-fullwide-2-columns.html">2 Columns</a></li>
			                          <li><a href="portfolio-grid-fullwide-3-columns.html">3 Columns</a></li>
			                          <li><a href="portfolio-grid-fullwide-4-columns.html">4 Columns</a></li>
			                          <li><a href="portfolio-grid-fullwide-5-columns.html">5 Columns</a></li>
			                          <li><a href="portfolio-grid-fullwide-6-columns.html">6 Columns</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Tiles <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="portfolio-tiles-layout1.html">Layout 1</a></li>
			                          <li><a href="portfolio-tiles-layout2.html">Layout 2</a></li>
			                          <li><a href="portfolio-tiles-layout3.html">Layout 3</a></li>
			                          <li><a href="portfolio-tiles-layout4.html">Layout 4</a></li>
			                          <li><a href="portfolio-tiles-layout5.html">Layout 5</a></li>
			                          <li><a href="portfolio-tiles-layout6.html">Layout 6</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Tiles Fullwide <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="portfolio-tiles-fullwide-layout1.html">Layout 1</a></li>
			                          <li><a href="portfolio-tiles-fullwide-layout2.html">Layout 2</a></li>
			                          <li><a href="portfolio-tiles-fullwide-layout3.html">Layout 3</a></li>
			                          <li><a href="portfolio-tiles-fullwide-layout4.html">Layout 4</a></li>
			                          <li><a href="portfolio-tiles-fullwide-layout5.html">Layout 5</a></li>
			                          <li><a href="portfolio-tiles-fullwide-layout6.html">Layout 6</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Masonry <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="portfolio-masonry-3-columns.html">3 Columns</a></li>
			                          <li><a href="portfolio-masonry-4-columns.html">4 Columns</a></li>
			                          <li><a href="portfolio-masonry-5-columns.html">5 Columns</a></li>
			                          <li><a href="portfolio-masonry-6-columns.html">6 Columns</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Masonry Fullwide <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="portfolio-masonry-fullwide-3-columns.html">3 Columns</a></li>
			                          <li><a href="portfolio-masonry-fullwide-4-columns.html">4 Columns</a></li>
			                          <li><a href="portfolio-masonry-fullwide-5-columns.html">5 Columns</a></li>
			                          <li><a href="portfolio-masonry-fullwide-6-columns.html">6 Columns</a></li>
			                        </ul>
			                      </li>
			                    </ul>
			                  </li>
			                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Blog <i class="fa fa-angle-down caret"></i></a>
			                    <ul class="dropdown-menu">
			                      <li class="dropdown"><a href="#">Standard <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="blog-standard-1-column.html">1 Column</a></li>
			                          <li><a href="blog-standard-1-column-left-sidebar.html">1 Column Left Sidebar</a></li>
			                          <li><a href="blog-standard-1-column-right-sidebar.html">1 Column Right Sidebar</a></li>
			                          <li><a href="blog-standard-1-column-both-sidebar.html">1 Column Both Sidebar</a></li>
			                          <li><a href="blog-standard-2-columns.html">2 Columns</a></li>
			                          <li><a href="blog-standard-2-columns-left-sidebar.html">2 Columns Left Sidebar</a></li>
			                          <li><a href="blog-standard-2-columns-right-sidebar.html">2 Columns Right Sidebar</a></li>
			                          <li><a href="blog-standard-3-columns.html">3 Columns</a></li>
			                          <li><a href="blog-standard-4-columns.html">4 Columns</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Standard Fullwide <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="blog-standard-fullwide-1-column-both-sidebar.html">1 Column Both Sidebar</a></li>
			                          <li><a href="blog-standard-fullwide-2-columns-both-sidebar.html">2 Columns Both Sidebar</a></li>
			                          <li><a href="blog-standard-fullwide-3-columns.html">3 Columns</a></li>
			                          <li><a href="blog-standard-fullwide-4-columns.html">4 Columns</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Masonry <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="blog-masonry-2-columns.html">2 Columns</a></li>
			                          <li><a href="blog-masonry-2-columns-left-sidebar.html">2 Columns Left Sidebar</a></li>
			                          <li><a href="blog-masonry-2-columns-right-sidebar.html">2 Columns Right Sidebar</a></li>
			                          <li><a href="blog-masonry-2-columns-both-sidebar.html">2 Columns Both Sidebar</a></li>
			                          <li><a href="blog-masonry-3-columns.html">3 Columns</a></li>
			                          <li><a href="blog-masonry-4-columns.html">4 Columns</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Masonry Fullwide <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="blog-masonry-fullwide-2-columns-both-sidebar.html">2 Columns Both Sidebar</a></li>
			                          <li><a href="blog-masonry-fullwide-3-columns.html">3 Columns</a></li>
			                          <li><a href="blog-masonry-fullwide-4-columns.html">4 Columns</a></li>
			                          <li><a href="blog-masonry-fullwide-5-columns.html">5 Columns</a></li>
			                          <li><a href="blog-masonry-fullwide-6-columns.html">6 Columns</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Single Post <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="blog-single.html">No Sidebar</a></li>
			                          <li><a href="blog-single-both-sidebar.html">Both Sidebar</a></li>
			                          <li><a href="blog-single-left-sidebar.html">Left Sidebar</a></li>
			                          <li><a href="blog-single-right-sidebar.html">Right Sidebar</a></li>
			                        </ul>
			                      </li>
			                    </ul>
			                  </li>
			                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Shop <i class="fa fa-angle-down caret"></i></a>
			                    <ul class="dropdown-menu">
			                      <li class="dropdown"><a href="#">Layout 1 <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="shop-category-style1-left-sidebar-2-columns.html">Style 1</a></li>
			                          <li><a href="shop-category-style1-left-sidebar-3-columns.html">Style 2</a></li>
			                          <li><a href="shop-category-style1-right-sidebar-2-columns.html">Style 3</a></li>
			                          <li><a href="shop-category-style1-right-sidebar-3-columns.html">Style 4</a></li>
			                          <li><a href="shop-category-style1-no-sidebar-2-columns.html">Style 5</a></li>
			                          <li><a href="shop-category-style1-no-sidebar-3-columns.html">Style 6</a></li>
			                          <li><a href="shop-category-style1-no-sidebar-4-columns.html">Style 7</a></li>
			                        </ul>
			                      </li>
			                      <li class="dropdown"><a href="#">Layout 2 <i class="fa fa-angle-right pull-right caret-right"></i></a>
			                        <ul class="dropdown-menu">
			                          <li><a href="shop-category-style2-left-sidebar-2-columns.html">Style 1</a></li>
			                          <li><a href="shop-category-style2-left-sidebar-3-columns.html">Style 2</a></li>
			                          <li><a href="shop-category-style2-right-sidebar-2-columns.html">Style 3</a></li>
			                          <li><a href="shop-category-style2-right-sidebar-3-columns.html">Style 4</a></li>
			                          <li><a href="shop-category-style2-no-sidebar-2-columns.html">Style 5</a></li>
			                          <li><a href="shop-category-style2-no-sidebar-3-columns.html">Style 6</a></li>
			                          <li><a href="shop-category-style2-no-sidebar-4-columns.html">Style 7</a></li>
			                        </ul>
			                      </li>
			                      <li><a href="shop-single-product.html">Single Product</a></li>
			                      <li><a href="shop-cart.html">Shopping Cart</a></li>
			                      <li><a href="shop-checkout.html">Checkout Page</a></li>
			                    </ul>
			                  </li>
			                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Elements <i class="fa fa-angle-down caret"></i></a>
			                    <ul class="dropdown-menu multi-column columns-2 last-child">
			                      <li class="col-md-6">
			                        <ul class="multi-column-dropdown">
			                          <li><a href="elements-accordion.html"><i class="fa fa-server"></i> Accordion</a></li>
			                          <li><a href="elements-alerts.html"><i class="fa fa-bell-o"></i> Alerts</a></li>
			                          <li><a href="elements-box-hover-effects.html"><i class="fa fa-dot-circle-o"></i> Box Hover Effects</a></li>
			                          <li><a href="elements-buttons.html"><i class="fa fa-link"></i> Buttons</a></li>
			                          <li><a href="elements-call-to-actions.html"><i class="fa fa-minus"></i> Call To Actions</a></li>
			                          <li><a href="elements-clients.html"><i class="fa fa-user"></i> Clients</a></li>
			                          <li><a href="elements-columns.html"><i class="fa fa-bars"></i> Columns</a></li>
			                          <li><a href="elements-divider.html"><i class="fa fa-indent"></i> Divider</a></li>
			                          <li><a href="elements-font-icons.html"><i class="fa fa-facebook"></i> Font Icons</a></li>
			                          <li><a href="elements-forms.html"><i class="fa fa-newspaper-o"></i> Forms</a></li>
			                          <li><a href="elements-funfacts.html"><i class="fa fa-flag-o"></i> Funfacts</a></li>
			                          <li><a href="elements-iconbox.html"><i class="fa fa-lightbulb-o"></i> Icon Box</a></li>
			                          <li><a href="elements-maps.html"><i class="fa fa-map-marker"></i> Maps</a></li>
			                          <li><a href="elements-media-embed.html"><i class="fa fa-play-circle-o"></i> Media Embed</a></li>
			                        </ul>
			                      </li>
			                      <li class="col-md-6">
			                        <ul class="multi-column-dropdown">
			                          <li><a href="elements-piecharts.html"><i class="fa fa-pie-chart"></i> Piecharts</a></li>
			                          <li><a href="elements-pricing-tables.html"><i class="fa fa-usd"></i> Pricing Tables</a></li>
			                          <li><a href="elements-progressbar.html"><i class="fa fa-circle-o-notch"></i> Progress Bars</a></li>
			                          <li><a href="elements-sitemap.html"><i class="fa fa-binoculars"></i> Sitemap</a></li>
			                          <li><a href="elements-sliders.html"><i class="fa fa-sliders"></i> Sliders</a></li>
			                          <li><a href="elements-social-icons.html"><i class="fa fa-share-alt"></i> Social Icons</a></li>
			                          <li><a href="elements-tabs.html"><i class="fa fa-table"></i> Tabs</a></li>
			                          <li><a href="elements-team.html"><i class="fa fa-users"></i> Team Members</a></li>
			                          <li><a href="elements-testimonials.html"><i class="fa fa-thumbs-up"></i> Testimonials</a></li>
			                          <li><a href="elements-timeline.html"><i class="fa fa-clock-o"></i> Timeline</a></li>
			                          <li><a href="elements-title.html"><i class="fa fa-pencil"></i> Title</a></li>
			                          <li><a href="elements-twitter.html"><i class="fa fa-twitter"></i> Twitter</a></li>
			                          <li><a href="elements-typography.html"><i class="fa fa-header"></i> Typography</a></li>
			                          <li><a href="elements-working-process.html"><i class="fa fa-sort-amount-asc"></i> Working Process</a></li>
			                        </ul>
			                      </li>
			                    </ul>
			                  </li>
			                  <li><a href="#" data-toggle="collapse" data-target="#top-search-bar" id="top-search-toggle"><i class="fa fa-search"></i></a></li>
			                  <li><a href="#"><i class="fa fa-shopping-cart"></i> (3)</a></li>
			                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Lang <i class="fa fa-angle-down caret"></i></a>
			                    <ul class="dropdown-menu last-child">
			                      <li><a href="#">English</a></li>
			                      <li><a href="#">Dutch</a></li>
			                    </ul>
			                  </li>
			                </ul>
			              </div>
			              <!--/.nav-collapse --></div>
			          </div>
			        </div>
			        <div id="top-search-bar" class="collapse">
			          <div class="container">
			            <form role="search" action="#" class="search_form_top" method="get">
			              <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
			              <span class="search-close"><i class="fa fa-times"></i></span>
			            </form>
			          </div>
			        </div>
					*/?>
      			</nav>
			</div><!--header-wrap-->
		</div><!--header-holder-->
	</header>
