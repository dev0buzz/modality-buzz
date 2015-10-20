<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$blog_bg_image = $modality_theme_options['blog_posts_home_image'];
$blog_cat = $modality_theme_options['blog_cat_posts'];
$num_posts = $modality_theme_options['blog_num_posts'];
$blog_tweet_account = $modality_theme_options['blog_tweet_account'];

$title = esc_attr($modality_theme_options['blog_section_header']);
$title = str_replace(substr($title, 0, 2), "<span>".substr($title, 0, 2)."</span>", $title);

$section_text = esc_attr($modality_theme_options['blog_section_text']);

$fromblog_query = new WP_Query(
	array(
		'posts_per_page' => $num_posts,
		'cat' 	=> $blog_cat
	)
);
?>
<!-- Section: Blog -->
<section id="blog">
  <div class="container">
	<div class="section-title">
	  <div class="row">
		<div class="col-md-6">
		  <div class="esc-heading small-border left-heading">
			<h2><?php echo $title; ?></h2>
			<p><?php echo $section_text; ?></p>
		  </div>
		</div>
	  </div>
	</div>
	<div class="section-content">
	  <div class="row multi-row-clearfix">
		<div class="blog-posts clearfix">
			<?php while ( $fromblog_query->have_posts() ): $fromblog_query->the_post(); ?>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<article class="post clearfix">
					  <div class="entry-header">
						<div class="entry-date"> <span class="day"><?php echo get_the_date('d'); ?></span> <span class="month"><?php echo get_the_date('M'); ?></span> </div>
						<a href="<?php esc_url(the_permalink()); ?>">
						<h4 class="entry-title"><?php the_title(); ?></h4>
						</a>
						<div class="clearfix"></div>
						<div class="post-thumb box-hover-effect effect1">
						<?php if ( has_post_thumbnail() ) { ?>
							  <a href="<?php esc_url(the_permalink()); ?>"><?php the_post_thumbnail('full'); ?></a>
						<?php } else { ?>
							  <img class="img-responsive" alt="slide" src="<?php echo get_template_directory_uri() ?>/images/assets/slide.jpg">
						<?php } ?>
						  <div class="overlay">
							<div class="details">
							  <div class="icons"><i class="fa fa-link"></i></div>
							</div>
							<a href="<?php esc_url(the_permalink()); ?>">Read more</a>
						  </div>
						</div>
					  </div>
					  <hr>
					  <div class="entry-content">
						<?php the_excerpt(); ?>
					  </div>
					</article>
					<?php //get_template_part('owlpost','info'); ?>
				</div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	  </div>
	</div>
  </div>
</section>

<!-- Divider: twitter -->
<div class="twitter-account" style="display:none;"><?php echo $blog_tweet_account; ?></div> <!-- modified by dev0buzz -->
<section class="divider parallax layer-overlay overlay-dark" style="background-image:url(<?php echo esc_url($blog_bg_image); ?>)">
  <div class="container tweet">
	<div class="row">
	  <div class="col-md-12 text-center">
		<i class="fa fa fa-twitter font-48 mb-30 text-white"></i>
		<div class="twitter-feed twitter-carousel twitter-white text-center"></div>
	  </div>
	</div>
  </div>
</section>
<?php wp_enqueue_script( 'fromblog', get_template_directory_uri() .'/js/fromblog.js' , array( 'jquery' ), '', true ); ?>
