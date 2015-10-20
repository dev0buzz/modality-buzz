<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
?>
<!--<div id="header-top">
	<div class="pagetop-inner clearfix">
		<div class="top-left left">
			<p class="no-margin"><?php echo esc_attr($modality_theme_options['header_address']); ?></p>
		</div>
		<div class="top-right right">
			<span class="top-phone"><i class="fa fa-phone"></i><?php echo esc_attr($modality_theme_options['header_phone']); ?></span>
			<span class="top-email"><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr($modality_theme_options['header_email']); ?>"><?php echo esc_attr($modality_theme_options['header_email']); ?></a></span>
		</div>
	</div>
</div>-->
<!-- Section: Contact -->
<section id="contact" class="divider parallax" style="background-image:url('<?php echo esc_url($modality_theme_options['contact_bg_image']); ?>');">
  <div class="container pt-150 pb-150">
	<div class="section-content">
	  <div class="row">
		<div class="col-sm-12 col-md-4">
		  <div class="contact-info text-center">
			<i class="fa fa-phone font-36 mb-10"></i>
			<h4>Call Us</h4>
			<h6><?php echo esc_attr($modality_theme_options['contact_phone']); ?></h6>
		  </div>
		</div>
		<div class="col-sm-12 col-md-4">
		  <div class="contact-info text-center">
			<i class="fa fa-map-marker font-36 mb-10"></i>
			<h4>Address</h4>
			<h6><?php echo esc_attr($modality_theme_options['contact_address']); ?></h6>
		  </div>
		</div>
		<div class="col-sm-12 col-md-4">
		  <div class="contact-info text-center">
			<i class="fa fa-envelope font-36 mb-10"></i>
			<h4>Email</h4>
			<h6><a href="mailto:<?php echo esc_attr($modality_theme_options['contact_email']); ?>"><?php echo esc_attr($modality_theme_options['contact_email']); ?></a></h6>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</section>

<!-- Divider: Call To Action -->
<section class="divider bg-solid-color bg-dark text-center">
  <div class="container pt-40 pb-40">
	<div class="row">
	  <div class="call-to-action">
		<div class="col-sm-8 col-sm-offset-1">
		  <div class="icon"><i class="pe-7s-comment text-white"></i></div>
		  <h2 class="text-white mt-0">Like Our Works?</h2>
		  <h5 class="mt-10 text-white">Please feel free to contact us if you have any question.</h5>
		</div>
		<div class="col-sm-3"> <a class="btn btn-colored btn-white" href="<?php echo esc_attr($modality_theme_options['contact_pricing_url']); ?>">Ask Pricing</a> </div>
	  </div>
	</div>
  </div>
</section>
</div>
