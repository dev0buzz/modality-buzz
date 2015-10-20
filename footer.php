<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );

$footer_logo = $modality_theme_options['footer_logo'];
$blog_cat = $modality_theme_options['blog_cat'];
$num_posts = $modality_theme_options['num_posts'];

$section_title = esc_attr($modality_theme_options['blog_section_title']);

$fromblog_query = new WP_Query(
	array(
		'posts_per_page' => $num_posts,
		'cat' 	=> $blog_cat
	)
);

$args = array(
    'depth'       => 1,
	'sort_column' => 'menu_order, post_title',
	'menu_class'  => 'menu',
	'include'     => '',
	'exclude'     => '',
	'echo'        => true,
	'show_home'   => false,
	'link_before' => '',
	'link_after'  => ''
);
?>
	<?php /*<div class="clear"></div>
	<div id="footer">
	<?php if ( $modality_theme_options['footer_widgets'] == '1') { ?>
		<div id="footer-wrap">
			<?php  get_sidebar('footer'); ?>
		</div><!--footer-wrap-->
	<?php } ?>
	</div><!--footer-->*/?>

	<!-- Footer -->
	<?php if ( $modality_theme_options['footer_widgets'] == '1') { ?>
    <footer id="footer" class="footer p-0">
      <div class="container pt-70 pb-70">
        <div class="row">
          <div class="col-sm-6 col-md-3">
            <div class="footer-widget">
              <img height="35" src="<?php echo esc_url($footer_logo); ?>" alt="">
              <p class="mt-20 mb-20"><?php echo get_bloginfo ( 'description' ); ?></p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="footer-widget">
              <h4 class="widget-title"><?php echo $section_title; ?></h4>
			  <?php while ( $fromblog_query->have_posts() ): $fromblog_query->the_post(); ?>
				  <article class="post media-post clearfix pb-0 mb-10">
	                <a class="post-thumb" href="<?php esc_url(the_permalink()); ?>"><?php the_post_thumbnail(array(70,70)); ?></a>
	                <div class="post-right">
	                  <h5 class="post-title mt-0"><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h5>
	                  <div class="post-date">
	                    <p>By <?php the_author(); ?>, <?php $d = get_the_date('d M Y'); echo $d; ?></p>
	                  </div>
	                </div>
	              </article>
			  <?php endwhile; wp_reset_query(); ?>
              <!--<div class="mt-10 text-right"><a class="font-12" href="#">Read all...</a></div>-->
            </div>
          </div>
          <div class="col-sm-6 col-md-2">
            <div class="footer-widget">
              <h4 class="widget-title">Pages</h4>
              <?php wp_page_menu( $args ); ?>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="footer-widget">
              <h4 class="widget-title">Connect with us!</h4>
              <p class="mb-20">If you like this site then please share on <br>social media!</p>
			  <?php if ($modality_theme_options['social_section_on'] == '1') {
				  get_template_part( 'social', 'section' );
			  } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid bg-solid-color bg-dark p-20">
		  <?php get_template_part( 'copyright' ); ?>
      </div>
    </footer>
	<?php } ?>

<?php
//wp_enqueue_script('owl', get_template_directory_uri() . '/js/owl.carousel.js', array( 'jquery' ),'', false);
wp_footer();
?>
</body>
</html>
