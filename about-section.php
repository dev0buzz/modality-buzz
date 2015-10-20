<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$about_bg_image = $modality_theme_options['about_bg_image'];
$about_section_image = $modality_theme_options['about_section_image'];

$title = esc_attr($modality_theme_options['about_section_header']);
$title = str_replace(substr($title, 0, 2), "<span>".substr($title, 0, 2)."</span>", $title);

$section_header = esc_attr($modality_theme_options['about_section_header_text']);
$section_text = esc_attr($modality_theme_options['about_section_text']);

$sections = array(
	0 => array(
		'icon' => esc_attr($modality_theme_options['about_section_icon_one']),
		'title' => esc_attr($modality_theme_options['about_section_title_one']),
		'text' => esc_attr($modality_theme_options['about_section_text_one'])
	),
	1 => array(
		'icon' => esc_attr($modality_theme_options['about_section_icon_two']),
		'title' => esc_attr($modality_theme_options['about_section_title_two']),
		'text' => esc_attr($modality_theme_options['about_section_text_two'])
	),
	2 => array(
		'icon' => esc_attr($modality_theme_options['about_section_icon_three']),
		'title' => esc_attr($modality_theme_options['about_section_title_three']),
		'text' => esc_attr($modality_theme_options['about_section_text_three'])
	)
);

$divider = array(
	0 => array(
		'icon' => esc_attr($modality_theme_options['about_divider_icon_one']),
		'title' => esc_attr($modality_theme_options['about_divider_title_one']),
		'text' => esc_attr($modality_theme_options['about_divider_text_one'])
	),
	1 => array(
		'icon' => esc_attr($modality_theme_options['about_divider_icon_two']),
		'title' => esc_attr($modality_theme_options['about_divider_title_two']),
		'text' => esc_attr($modality_theme_options['about_divider_text_two'])
	),
	2 => array(
		'icon' => esc_attr($modality_theme_options['about_divider_icon_three']),
		'title' => esc_attr($modality_theme_options['about_divider_title_three']),
		'text' => esc_attr($modality_theme_options['about_divider_text_three'])
	),
	3 => array(
		'icon' => esc_attr($modality_theme_options['about_divider_icon_four']),
		'title' => esc_attr($modality_theme_options['about_divider_title_four']),
		'text' => esc_attr($modality_theme_options['about_divider_text_four'])
	),
	4 => array(
		'icon' => esc_attr($modality_theme_options['about_divider_icon_five']),
		'title' => esc_attr($modality_theme_options['about_divider_title_five']),
		'text' => esc_attr($modality_theme_options['about_divider_text_five'])
	)
);
?>
<!-- Section: About -->
<section id="about">
  <div class="container">
	<div class="section-title">
	  <div class="row">
		<div class="col-md-6">
		  <div class="esc-heading small-border left-heading">
			<h2><?php echo $title; ?></h2>
		  </div>
		</div>
	  </div>
	</div>
	<div class="section-content">
	  <div class="row">
		<div class="col-md-5 text-center"><img src="<?php echo esc_url($about_section_image); ?>" alt=""></div>
		<div class="col-md-7 pl-30">
		  <p class="lead"><?php echo $section_header; ?></p>
		  <p><?php echo $section_text; ?></p>
		  <div class="mt-30">
			  <?php
			  foreach ($sections as $key => $s) {
			  	?>
				<div class="icon-box left medias"> <a href="#about" class="media-left pull-left"><i class="<?php echo $s['icon']; ?>"></i></a>
				  <div class="media-body">
					<h4 class="media-heading heading"><?php echo $s['title']; ?></h4>
					<p><?php echo $s['text']; ?></p>
				  </div>
				</div>
				<?php
			  }
			  ?>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</section>

<!-- Divider: About -->
<section class="divider parallax layer-overlay overlay-dark" style="background-image:url(<?php echo esc_url($about_bg_image); ?>)">
  <div class="container">
	<div class="section-content text-center">
	  <div class="row">
		<div class="col-md-12 mt-30">
		  <div class="features-carousel">
			  <?php
			  foreach ($divider as $k => $item) {
				  ?>
				  <div class="item">
				    <i class="<?php echo $item['icon']; ?> mb-10 text-white"></i>
				    <h5 class="text-white"><?php echo $item['title']; ?></h5>
				    <p class="text-black-light"><?php echo $item['text']; ?></p>
				  </div>
				  <?php
			  }
			  ?>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</section>
