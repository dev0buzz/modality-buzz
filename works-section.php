<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );

$title = esc_attr($modality_theme_options['works_section_header']);
$title = str_replace(substr($title, 0, 2), "<span>".substr($title, 0, 2)."</span>", $title);

$section_text = esc_attr($modality_theme_options['works_section_text']);

// show products cat
$taxonomy     = 'product_cat';
$orderby      = 'name';
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';
$empty        = 0;

$args = array(
       'taxonomy'     => $taxonomy,
       'orderby'      => $orderby,
       'show_count'   => $show_count,
       'pad_counts'   => $pad_counts,
       'hierarchical' => $hierarchical,
       'title_li'     => $title,
       'hide_empty'   => $empty
);
$woo_cats = get_categories( $args );
// end show products cat

// show products
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 11,
    'orderby' => 'rand'
);
$loop = new WP_Query( $args );
?>
<!-- Section: works -->
<section id="works">
  <div class="container pb-0">
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
  </div>
  <div class="container-fluid pt-0 pb-0">
    <div class="row">
      <div class="section-content">
        <!-- protfolio nav -->
        <div class="filter_padder" >
          <div class="filter_wrapper" style="max-width:650px;">
            <div class="filter selected active" data-category="cat-all">All</div>
            <?php
            foreach ($woo_cats as $key => $cat) {
                echo '<div class="filter" data-category="cat-'.$cat->slug.'">'.$cat->name.'</div>';
            }
            ?>
            <div class="clear"></div>
          </div>
        </div>

        <!-- protfolio items -->
        <div class="megafolio-container" data-padding="15" data-layoutarray="[5,6]">
            <?php
            while ( $loop->have_posts() ) : $loop->the_post(); global $product; $woo_cat = get_the_terms($loop->post->ID,'product_cat');
            if (has_post_thumbnail( $loop->post->ID )) {
                $image_src = wp_get_attachment_image_src(get_post_thumbnail_id($loop->post->ID), 'shop_catalog');
                $image_src = $image_src[0];
            }  else {
                $image_src = woocommerce_show_product_thumbnails();
            }
            ?>
            <div class="mega-entry cat-all cat-<?php echo $woo_cat[0]->slug; ?>" id="mega-entry-2" data-src="<?php echo $image_src; ?>" data-width="504" data-height="400">
              <div class="mega-hover">
                <div class="mega-hovertitle">
                  <?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>
                </div>
                <a href="<?php echo get_permalink( $loop->post->ID ) ?>">
                  <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
                </a>
                <a data-lightbox="gallery" href="<?php echo $image_src; ?>">
                  <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
                </a>
              </div>
            </div>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
          <?php /*<div class="mega-entry cat-all cat-print" id="mega-entry-2" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/1.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">White Art
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/1.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-print" id="mega-entry-2" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/2.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Super Vector
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/2.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-photoshop" id="mega-entry-3" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/3.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Studio Creative Art
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/3.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-photography" id="mega-entry-4" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/4.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Advanced Creative Sketch
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/4.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-branding" id="mega-entry-5" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/5.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Black & White Art
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/5.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-print" id="mega-entry-6" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/6.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Photography Action
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/6.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-photoshop" id="mega-entry-7" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/7.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Vector Isometric Effect
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/7.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-photoshop" id="mega-entry-7" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/8.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Vector Isometric Effect
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/8.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-photoshop" id="mega-entry-7" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/9.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Vector Isometric Effect
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/9.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-photoshop" id="mega-entry-7" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/10.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Vector Isometric Effect
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/10.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>
          <div class="mega-entry cat-all cat-photography" id="mega-entry-8" data-src="<?php bloginfo('template_url'); ?>/images/portfolio/11.jpg" data-width="504" data-height="400">
            <div class="mega-hover">
              <div class="mega-hovertitle">Vintage Photoshop Action
                <div class="mega-hoversubtitle">Awesome portfolio item</div>
              </div>
              <a href="#">
                <div class="mega-hoverlink"><i class="pe-7s-link"></i></div>
              </a>
              <a data-lightbox="gallery" href="<?php bloginfo('template_url'); ?>/images/portfolio/11.jpg">
                <div class="mega-hoverview"><i class="pe-7s-look"></i></div>
              </a>
            </div>
          </div>*/ ?>
        </div>
      </div>
    </div>
  </div>
</section>
