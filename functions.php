<?php
/**
 * Modality functions and definitions
 *
 * @package Modality
*/

// Use a child theme instead of placing custom functions here
// http://codex.wordpress.org/Child_Themes

/* ------------------------------------------------------------------------- *
 *  Load theme files
/* ------------------------------------------------------------------------- */
require_once ('functions/modality-functions.php'); 			// Theme Custom Functions
require_once ('functions/modality-customizer.php');			// Load Customizer
require_once ('functions/modality-image-sliders.php'); 		// Theme Custom Functions
require_once ('functions/modality-woocommerce.php');		// WooCommerce Support
require_once ('functions/wp_bootstrap_navwalker.php');

// add customize
add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
function add_search_box( $items, $args ) {
    $items .= '<li><a href="#" data-toggle="collapse" data-target="#top-search-bar" id="top-search-toggle"><i class="fa fa-search"></i></a></li>';
    return $items;
}
add_filter('wp_nav_menu_items','add_cart',10,2);
function add_cart($items, $args) {
    global $woocommerce;

    $custom_message = '';
    if($woocommerce->cart->get_cart_total() != '0'){
        $custom_message = '('.$woocommerce->cart->cart_contents_count.')';
    }

    $items .= '<li><a href="'.$woocommerce->cart->get_cart_url().'"><i class="fa fa-shopping-cart"></i> '.$custom_message.' </a></li>';
    return $items;
}
add_filter('wp_nav_menu_items','add_lang',10,2);
function add_lang($items, $args) {
    if (class_exists('google_language_translator')) {
        $items .= '<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Lang <i class="fa fa-angle-down caret"></i></a>
          '.do_shortcode('[google-translator]').'
        </li>';
    }
    return $items;
}
