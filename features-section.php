<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$features_bg_image = $modality_theme_options['features_bg_image'];

$title = esc_attr($modality_theme_options['features_section_title']);
$title = str_replace(substr($title, 0, 2), "<span>".substr($title, 0, 2)."</span>", $title);

$section_text = esc_attr($modality_theme_options['features_section_desc']);

$instagram_acc = esc_attr($modality_theme_options['features_instagram_acc']);
$instagram_cid = esc_attr($modality_theme_options['features_instagram_clientid']);
$instagram_cnt = esc_attr($modality_theme_options['features_instagram_count']);

$divider_text = esc_attr($modality_theme_options['feature_divider_text']);

$divider = array(
	0 => array(
		'icon' => esc_attr($modality_theme_options['feature_one_icon']),
		'text' => esc_attr($modality_theme_options['feature_one'])
	),
	1 => array(
		'icon' => esc_attr($modality_theme_options['feature_two_icon']),
		'text' => esc_attr($modality_theme_options['feature_two'])
	),
	2 => array(
		'icon' => esc_attr($modality_theme_options['feature_three_icon']),
		'text' => esc_attr($modality_theme_options['feature_three'])
	),
	3 => array(
		'icon' => esc_attr($modality_theme_options['feature_four_icon']),
		'text' => esc_attr($modality_theme_options['feature_four'])
	),
);
?>
<!-- Section: Featured works -->
<section>
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
  <div class="container-fluid p-0">
	<div id="feature" class="section-content">
	  <div class="row">
		<div class="col-md-12x">
			<div class="instagram-account hide"><?php echo $instagram_acc; ?></div>
			<div class="instagram-clientid hide"><?php echo $instagram_cid; ?></div>
			<div class="instagram-count hide"><?php echo $instagram_cnt; ?></div>
		  	<div class="featured-gallery style1"></div>
		</div>
	  </div>
	</div>
  </div>
</section>

<!-- Divider: working process -->
<section class="divider parallax layer-overlay overlay-dark" style="background-image:url(<?php echo esc_url($features_bg_image); ?>)">
  <div class="container pt-120 pb-150">
	<div class="section-content text-center">
	  <div class="row">
		<div class="col-md-12x mb-60">
		  <h2 class="text-white"><?php echo $divider_text; ?></h2>
		</div>
		<?php
		foreach ($divider as $key => $div) {
			?>
			<div class="col-xs-6 col-sm-6 col-md-3">
			  <div class="working-process">
				<h2 class="step"><?php echo ($key+1); ?></h2>
				<i class="<?php echo $div['icon']; ?>"></i>
				<h5 class="title"><?php echo $div['text']; ?></h5>
			  </div>
			</div>
			<?php
		}
		?>
	  </div>
	</div>
  </div>
</section>
