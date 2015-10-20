<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$services_bg_image = $modality_theme_options['services_bg_image'];
$services_image = $modality_theme_options['services_image'];

$title = esc_attr($modality_theme_options['services_section_title']);
$title = str_replace(substr($title, 0, 2), "<span>".substr($title, 0, 2)."</span>", $title);

$section_text = esc_attr($modality_theme_options['services_section_desc']);

$boxes = array(
	0 => array(
		'icon' => esc_attr($modality_theme_options['service_one_icon']),
		'title' => esc_attr($modality_theme_options['service_one']),
		'text' => esc_attr($modality_theme_options['service_one_desc'])
	),
	1 => array(
		'icon' => esc_attr($modality_theme_options['service_two_icon']),
		'title' => esc_attr($modality_theme_options['service_two']),
		'text' => esc_attr($modality_theme_options['service_two_desc'])
	),
	2 => array(
		'icon' => esc_attr($modality_theme_options['service_three_icon']),
		'title' => esc_attr($modality_theme_options['service_three']),
		'text' => esc_attr($modality_theme_options['service_three_desc'])
	),
	3 => array(
		'icon' => esc_attr($modality_theme_options['service_four_icon']),
		'title' => esc_attr($modality_theme_options['service_four']),
		'text' => esc_attr($modality_theme_options['service_four_desc'])
	),
	4 => array(
		'icon' => esc_attr($modality_theme_options['service_five_icon']),
		'title' => esc_attr($modality_theme_options['service_five']),
		'text' => esc_attr($modality_theme_options['service_five_desc'])
	),
	5 => array(
		'icon' => esc_attr($modality_theme_options['service_six_icon']),
		'title' => esc_attr($modality_theme_options['service_six']),
		'text' => esc_attr($modality_theme_options['service_six_desc'])
	)
);

$divider = array(
	0 => array(
		'icon' => esc_attr($modality_theme_options['service_divider_one_icon']),
		'value' => esc_attr($modality_theme_options['service_divider_one']),
		'duration' => esc_attr($modality_theme_options['service_divider_one_duration']),
		'text' => esc_attr($modality_theme_options['service_divider_one_text'])
	),
	1 => array(
		'icon' => esc_attr($modality_theme_options['service_divider_two_icon']),
		'value' => esc_attr($modality_theme_options['service_divider_two']),
		'duration' => esc_attr($modality_theme_options['service_divider_two_duration']),
		'text' => esc_attr($modality_theme_options['service_divider_two_text'])
	),
	2 => array(
		'icon' => esc_attr($modality_theme_options['service_divider_three_icon']),
		'value' => esc_attr($modality_theme_options['service_divider_three']),
		'duration' => esc_attr($modality_theme_options['service_divider_three_duration']),
		'text' => esc_attr($modality_theme_options['service_divider_three_text'])
	),
	3 => array(
		'icon' => esc_attr($modality_theme_options['service_divider_four_icon']),
		'value' => esc_attr($modality_theme_options['service_divider_four']),
		'duration' => esc_attr($modality_theme_options['service_divider_four_duration']),
		'text' => esc_attr($modality_theme_options['service_divider_four_text'])
	)
);
?>
<!-- Section: Services -->
<section id="services">
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
	  <div class="row">
		<div class="col-md-12"><?php if ($services_image != "") {
			echo '<img class="img-responsive" alt="" src="'.esc_url($services_image).'">';
		} ?></div>
	  </div>
	  <div class="row multi-row-clearfix">
		  <?php
		  foreach ($boxes as $key => $box) {
			  $darker = ($key % 2)? "darker" : "";
		  	?>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
			  <div class="icon-box boxed <?php echo $darker; ?> mb-30"> <a href="#"><i class="<?php echo $box['icon']; ?>"></i></a>
				<h4 class="heading"><?php echo $box['title']; ?></h4>
				<p><?php echo $box['text']; ?></p>
			  </div>
			</div>
			<?php
		  }
		  ?>
	  </div>
	</div>
  </div>
</section>

<!-- Divider: Funfacts -->
<section class="divider parallax layer-overlay overlay-dark" style="background-image:url(<?php echo esc_url($services_bg_image); ?>)">
  <div class="container pt-100 pb-100">
	<div class="row">
		<?php
		foreach ($divider as $k => $f) {
			$border = ($k == (count($divider)-1))? "no-border" : "";
			?>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="funfact style2 <?php echo $border; ?>"> <i class="<?php echo $f['icon']; ?> text-white"></i>
					<h2 class="animate-number text-white" data-value="<?php echo $f['value']; ?>" data-animation-duration="<?php echo $f['duration']; ?>">0</h2>
					<span><?php echo $f['text']; ?></span>
				</div>
			</div>
			<?php
		}
		?>
	</div>
  </div>
</section>
