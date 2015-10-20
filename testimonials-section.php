<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$testi_bg_image = $modality_theme_options['testi_bg_image'];

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

$testi = array(
	0 => array(
		'image' => esc_attr($modality_theme_options['testi_author_one_image']),
		'text' => esc_attr($modality_theme_options['testi_author_one_text']),
		'author' => esc_attr($modality_theme_options['testi_author_one']),
        'title' => esc_attr($modality_theme_options['testi_author_one_title'])
	),
	1 => array(
        'image' => esc_attr($modality_theme_options['testi_author_two_image']),
		'text' => esc_attr($modality_theme_options['testi_author_two_text']),
		'author' => esc_attr($modality_theme_options['testi_author_two']),
        'title' => esc_attr($modality_theme_options['testi_author_two_title'])
	),
	2 => array(
        'image' => esc_attr($modality_theme_options['testi_author_three_image']),
		'text' => esc_attr($modality_theme_options['testi_author_three_text']),
		'author' => esc_attr($modality_theme_options['testi_author_three']),
        'title' => esc_attr($modality_theme_options['testi_author_three_title'])
	)
);

$clients = array(
    0 => array('image' => esc_attr($modality_theme_options['testi_client_one_image'])),
    1 => array('image' => esc_attr($modality_theme_options['testi_client_two_image'])),
    2 => array('image' => esc_attr($modality_theme_options['testi_client_three_image'])),
    3 => array('image' => esc_attr($modality_theme_options['testi_client_four_image'])),
    4 => array('image' => esc_attr($modality_theme_options['testi_client_five_image'])),
    5 => array('image' => esc_attr($modality_theme_options['testi_client_six_image']))
);
?>
<!-- Divider: Testimonials -->
<section class="divider parallax layer-overlay overlay-dark" style="background-image: url(<?php echo esc_url($testi_bg_image); ?>)">
  <div class="container-fluid pt-0 pb-0" style="padding:0;">
    <div class="section-content">
      <div class="row" style="margin:0;">
        <div class="col-md-6 bg-solid-color pt-110 pb-80">
          <div class="clients-logo style2 text-center">
            <div class="row">
                <?php foreach ($clients as $key => $client) {
                    ?>
                    <div class="col-xs-6 col-sm-4 col-md-4">
                      <div class="item"><a href="#"><img alt="" src="<?php echo $client['image']; ?>"></a></div>
                    </div>
                    <?php
                } ?>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 pt-120">
          <div class="testimonial-carousel style2 bullet-white mb-60">
              <?php
              foreach ($testi as $k => $item) {
                  ?>
                  <div class="item">
                    <div class="thumb"><img src="<?php echo $item['image']; ?>" alt="" width="90" class="img-circle"></div>
                    <div class="content">
                      <p><?php echo $item['text']; ?></p>
                      <h5 class="author text-white"><?php echo $item['author']; ?></h5>
                      <h6 class="title text-white"><?php echo $item['title']; ?></h6>
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
