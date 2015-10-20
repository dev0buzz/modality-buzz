<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$social_bg_image = $modality_theme_options['social_bg_image'];
?>
		<ul class="social-icons square list-inline">
			<?php if($modality_theme_options['facebook_link']): ?>
				<li><a href="<?php echo esc_url($modality_theme_options['facebook_link']); ?>" target="_blank" title="<?php _e('Facebook','modality'); ?>"><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>
			<?php if($modality_theme_options['twitter_link']): ?>
				<li><a href="<?php echo esc_url($modality_theme_options['twitter_link']); ?>" target="_blank" title="<?php _e('Twitter','modality'); ?>"><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>
			<?php if($modality_theme_options['google_link']): ?>
				<li><a href="<?php echo esc_url($modality_theme_options['google_link']); ?>" target="_blank" title="<?php _e('Google+','modality'); ?>"><i class="fa fa-google-plus"></i></a></li>
			<?php endif; ?>
			<?php if($modality_theme_options['linkedin_link']): ?>
				<li><a href="<?php echo esc_url($modality_theme_options['linkedin_link']); ?>" target="_blank" title="<?php _e('LinkedIn','modality'); ?>"><i class="fa fa-linkedin"></i></a></li>
			<?php endif; ?>
			<?php if($modality_theme_options['instagram_link']): ?>
				<li><a href="<?php echo esc_url($modality_theme_options['instagram_link']); ?>" target="_blank" title="<?php _e('Instagram','modality'); ?>"><i class="fa fa-instagram"></i></a></li>
			<?php endif; ?>
			<?php if($modality_theme_options['vimeo_link']): ?>
				<li><a href="<?php echo esc_url($modality_theme_options['vimeo_link']); ?>" target="_blank" title="<?php _e('Vimeo','modality'); ?>"><i class="fa fa-vimeo-square"></i></a></li>
			<?php endif; ?>
		</ul>
