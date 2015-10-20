<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );

$title = esc_attr($modality_theme_options['products_section_header']);
$title = str_replace(substr($title, 0, 2), "<span>".substr($title, 0, 2)."</span>", $title);
$section = esc_attr($modality_theme_options['products_section_text']);

?>
<!-- Section: Products -->
<section id="products">
  <div class="container">
    <div class="section-title">
      <div class="row">
        <div class="col-md-6">
          <div class="esc-heading small-border left-heading">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $section; ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="section-content">
      <div class="products">
        <div class="row multi-row-clearfix">
          <?php echo do_shortcode('[featured_products per_page="4" columns="4"]'); ?>
        </div>
      </div>
    </div>
  </div>
</section>
