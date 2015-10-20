<?php
/**
 * Template Name: Contact Us with Google Maps
 * by dev0buzz@gmail.com
 */

 /**
  * The Template for displaying all single posts.
  *
  * @package Modality
  */
 $modality_theme_options = modality_get_options( 'modality_theme_options' );
 get_header(); ?>
 	<div id="main" class="<?php echo esc_attr($modality_theme_options['layout_settings']);?>">
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
        <!-- Section Contact -->
        <section id="contact" class="divider bg-solid-color">
          <div class="container">
            <div class="section-content">
              <div class="row">
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                  <h3 class="mb-30">Interested in discussing?</h3>
                  <form role="form" id="contact-form">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" class="form-control" required name="contact_name" id="contact_name" placeholder="Enter Name">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" required class="form-control" name="contact_email" id="contact_email" placeholder="Enter Email">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" placeholder="Subject" required class="form-control" name="subject">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" required name="contact_message" id="contact_message"  placeholder="Enter Message" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-default" data-loading-text="Please wait...">Send your message</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <a data-targetmap="#map-canvas1" class="toggle-map" href="#"><span>Locate Us on Map</span></a>
          <div class="container-fluid p-0">
            <div id="map-canvas1" class="map-canvas" data-address="<?php echo esc_attr($modality_theme_options['contact_address']); ?>" style="display:none;"></div>
          </div>
        </section>
      <!-- end main-content -->
 	</div><!--main-->
 <?php get_footer(); ?>
