<?php
if (!current_user_can( $capability='manage_options' )) {
	echo "Please Login as Admin &raquo; <a href=\"".get_bloginfo('url')."/wp-login.php?redirect_to=http%3A%2F%2Fvapeboss.id%2F&reauth=1\">Here</a>";
	exit;
}
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
get_header(); ?>
	<div id="main" class="<?php echo esc_attr($modality_theme_options['layout_settings']); ?>">
	<?php
		if (is_front_page() && ! is_paged()) {
			if ($modality_theme_options['image_slider_on'] == '1') {
				 //modality_slider();
				 echo do_shortcode("[rev_slider home-slider]");
			}
			// about section
			if ($modality_theme_options['about_section_on'] == '1') {
				get_template_part( 'about', 'section' );
			}
			// fature section
			if ($modality_theme_options['features_section_on'] == '1') {
				get_template_part( 'features', 'section' );
			}
			// services section
			if ($modality_theme_options['services_section_on'] == '1') {
				get_template_part( 'services', 'section' );
			}
			// works
			if ($modality_theme_options['works_section_on'] == '1') {
				get_template_part( 'works', 'section' );
			}
			// testimonials
			if ($modality_theme_options['testi_section_on'] == '1') {
				get_template_part( 'testimonials', 'section' );
			}
			// blogs
			if ($modality_theme_options['blog_section_on'] == '1') {
				get_template_part( 'fromblog', 'section' );
			}
			// products
			if ($modality_theme_options['products_section_on'] == '1') {
				get_template_part( 'products', 'section' );
			}

			/*if ($modality_theme_options['getin_home_on'] == '1') {
				get_template_part( 'getintouch', 'section' );
			}

			if ($modality_theme_options['latest_posts_on'] == '1') {
				get_template_part( 'content-posts', 'home' );
			}*/
			// contact detail
			if ($modality_theme_options['contact_detail_enable'] == '1') {
				get_template_part( 'contact', 'detail' );
			}
			// footer section
			if ( $modality_theme_options['footer_widgets'] == '1') { ?>
				<div id="footer-wrap">
					<?php  get_sidebar('footer'); ?>
				</div><!--footer-wrap-->
			<?php }

		} else {

			get_template_part( 'content', 'posts' );

		} ?>
	</div><!--main-->
<?php get_footer(); ?>
