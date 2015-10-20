<?php
/**
 * Template Name: Gallery Instagram Owl Slider
 * by dev0buzz@gmail.com
 */

 /**
  * The Template for displaying all single posts.
  *
  * @package Modality
  */
 $modality_theme_options = modality_get_options( 'modality_theme_options' );

 $instagram_acc = esc_attr($modality_theme_options['features_instagram_acc']);
 $instagram_cid = esc_attr($modality_theme_options['features_instagram_clientid']);
 $instagram_cnt = esc_attr($modality_theme_options['features_instagram_count']);

 get_header(); ?>
 	<div id="main-" class="main-content <?php echo esc_attr($modality_theme_options['layout_settings']);?>" style="background: #000000;">
        <div class="instagram-account hide"><?php echo $instagram_acc; ?></div>
        <div class="instagram-clientid hide"><?php echo $instagram_cid; ?></div>
        <div class="instagram-count hide"><?php echo $instagram_cnt; ?></div>
        <div class="featured-gallery style3"></div>
 	</div><!--main-->
 <?php get_footer(); ?>
