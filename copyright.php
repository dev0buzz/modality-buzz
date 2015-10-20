<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
?>
<div class="row text-center">
	<div class="col-md-12">
		<p class="font-14 m-0"><?php echo esc_attr($modality_theme_options['footer_copyright_text']);?></p>
  	</div>
</div>
