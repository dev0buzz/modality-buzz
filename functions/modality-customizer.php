<?php
/**
 * Modality functions and definitions
 *
 * @package Modality
*/

function modality_customize_register($wp_customize){

	class WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
        	<label>
        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        	<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        	</label>
        	<?php
		}
	}

	class WP_Customize_Info_Control extends WP_Customize_Control {
		public $type = 'info';

		public function render_content() {
			?>
				<strong> <?php _e('If you like my work. Buy me a coffee.','modality'); ?></strong>
                <div class="donate">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="VJP4U4NDG2P9Y">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>
				<p class="btn">
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/faq/"><?php _e('Theme Support','modality') ?></a><br><br>
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/preview/Modality/"><?php _e('View Theme Demo','modality') ?></a><br><br>
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/modality/#theme-pricing"><?php  _e('Upgrade to Pro','modality') ?></a>
				</p>
        	<?php
		}
	}

	// Google Fonts
	$google_fonts = array(
		'Crimson Text' => 'Crimson Text',
		'Open Sans'	=> 'Open Sans',
		'sans-serif'	=> 'sans-serif',
	);

	// Opacity
	$opacity = array(
		'1' => '1',
		'0.9'	=> '0.9',
		'0.8'	=> '0.8',
		'0.7'	=> '0.7',
		'0.6'	=> '0.6',
		'0.5'	=> '0.5',
		'0.4'	=> '0.4',
		'0.3'	=> '0.3',
		'0.2'	=> '0.2',
		'0.1'	=> '0.1',
		'0'	=> '0',
	);

	// Sidebar Position
	$theme_layout = array('col1' => __('No Sidebars','modality'), 'col2-l' => __('Right Sidebar','modality'), 'col2-r' => __('Left Sidebar','modality'));

	// Blog Content
	$blog_content = array('excerpt' => __('Excerpt','modality'),'full' => __('Full Content','modality'));

	// Post Navigation Links Location
	$post_nav_array = array(
		'disable' => __('Disable', 'modality'),
		'sidebar' => __('Main Sidebar', 'modality'),
		'below' => __('Below Content', 'modality'),

	);

	// Post Info Location
	$post_info_array = array(
		'disable' => __('Disable', 'modality'),
		'above' => __('Above Content', 'modality'),

	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	//  =============================
    //  = Theme Options Panel       =
    //  =============================
	$wp_customize->add_panel( 'theme_options', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Modality Theme Options', 'modality' ),
	));

	//  =============================
    //  = Theme Info Section        =
    //  =============================
	$wp_customize->add_section( 'Theme Settings', array(
    	'title'          => __( 'Theme Information', 'modality' ),
    	'priority'       => 999,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[theme_info]', array(
    	'default'        => '',
		'sanitize_callback' => 'modality_no_sanitize',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Info_Control($wp_customize, 'theme_info', array(
        'label'    => __('', 'modality'),
        'section'  => 'Theme Settings',
        'settings' => 'modality_theme_options[theme_info]',
    )));

	//  =============================
    //  = General Section           =
    //  =============================
	$wp_customize->add_section( 'General Settings', array(
    	'title'          => __( 'Theme General Settings', 'modality' ),
    	'priority'       => 1000,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[theme_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'theme_color', array(
        'label'    => __('Theme Color', 'modality'),
        'section'  => 'General Settings',
        'settings' => 'modality_theme_options[theme_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[breadcrumbs]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('breadcrumbs', array(
        'settings' => 'modality_theme_options[breadcrumbs]',
        'label'    => __('Display Breadcrumbs', 'modality'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[animation]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => true,
    ));

    $wp_customize->add_control('animation', array(
        'settings' => 'modality_theme_options[animation]',
        'label'    => __('Enable Animation', 'modality'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[responsive_design]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('responsive_design', array(
        'settings' => 'modality_theme_options[responsive_design]',
        'label'    => __('Enable Resposive Design', 'modality'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[scrollup]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('scrollup', array(
        'settings' => 'modality_theme_options[scrollup]',
        'label'    => __('Enable Scrollup', 'modality'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[scrollup_color]', array(
    	'default'        => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'scrollup_color', array(
        'label'    => __('ScrollUp Color', 'modality'),
        'section'  => 'General Settings',
        'settings' => 'modality_theme_options[scrollup_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[scrollup_hover_color]', array(
    	'default'        => '#FFFFFF',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'scrollup_hover_color', array(
        'label'    => __('ScrollUp Hover Color', 'modality'),
        'section'  => 'General Settings',
        'settings' => 'modality_theme_options[scrollup_hover_color]',
    )));

	//  =============================
    //  = Logo Section              =
    //  =============================

	$wp_customize->add_section( 'Logo Settings', array(
    	'title'          => __( 'Theme Logo Settings', 'modality' ),
    	'priority'       => 1001,
		'panel' => 'theme_options',
	) );
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_width]', array(
        'default'        => '300',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_width', array(
        'label'      => __('Logo Width (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_width]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_height]', array(
        'default'        => '30',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_height', array(
        'label'      => __('Logo Height (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_height]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_top_margin]', array(
        'default'        => '8',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_top_margin', array(
        'label'      => __('Logo Top Margin (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_top_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_left_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_left_margin', array(
        'label'      => __('Logo Left Margin (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_left_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_bottom_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_bottom_margin', array(
        'label'      => __('Logo Bottom Margin (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_bottom_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_right_margin]', array(
        'default'        => '25',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_right_margin', array(
        'label'      => __('Logo Right Margin (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_right_margin]',
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[logo]', array(
        'default'           => get_template_directory_uri() . '/images/escope-logo-white.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label'    => __('Image Logo', 'modality'),
        'section'  => 'Logo Settings',
        'settings' => 'modality_theme_options[logo]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_alt_text]', array(
        'default'        => 'Logo',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_alt_text', array(
        'label'      => __('Logo ALT Text', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_alt_text]',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[logo_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('logo_uppercase', array(
        'settings' => 'modality_theme_options[logo_uppercase]',
        'label'    => __('Logo Uppercase', 'modality'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//===============================
     $wp_customize->add_setting('modality_theme_options[google_font_logo]', array(
		'sanitize_callback' => 'modality_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Crimson Text',

    ));

    $wp_customize->add_control( 'google_font_logo', array(
        'settings' => 'modality_theme_options[google_font_logo]',
        'label'   => __('Select logo font family','modality'),
        'section' => 'Logo Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_font_size]', array(
        'default'        => '24',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_font_size', array(
        'label'      => __('Logo Font Size (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_font_size]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_font_weight]', array(
        'default'        => '700',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('logo_font_weight', array(
        'label'      => __('Logo Font Weight', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_font_weight]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[text_logo_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_logo_color', array(
        'label'    => __('Logo Color', 'modality'),
        'section'  => 'Logo Settings',
        'settings' => 'modality_theme_options[text_logo_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[enable_logo_tagline]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));

    $wp_customize->add_control('enable_logo_tagline', array(
        'settings' => 'modality_theme_options[enable_logo_tagline]',
        'label'    => __('Display Tagline Underneath Logo', 'modality'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[tagline_font_size]', array(
        'default'        => '16',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('tagline_font_size', array(
        'label'      => __('Tagline Font Size (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[tagline_font_size]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[tagline_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'tagline_color', array(
        'label'    => __('Tagline Color', 'modality'),
        'section'  => 'Logo Settings',
        'settings' => 'modality_theme_options[tagline_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[tagline_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('tagline_uppercase', array(
        'settings' => 'modality_theme_options[tagline_uppercase]',
        'label'    => __('Tagline Uppercase', 'modality'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Navigation Section        =
    //  =============================

	$wp_customize->add_section( 'Navigation Settings', array(
    	'title'          => __( 'Theme Navigation Settings', 'modality' ),
    	'priority'       => 1002,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting('modality_theme_options[menu_sticky]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('menu_sticky', array(
        'settings' => 'modality_theme_options[menu_sticky]',
        'label'    => __('Sticky Menu', 'modality'),
        'section'  => 'Navigation Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[menu_top_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('menu_top_margin', array(
        'label'      => __('Menu Top Margin (px)', 'modality'),
        'section'    => 'Navigation Settings',
        'settings'   => 'modality_theme_options[menu_top_margin]',
    ));
	//===============================
     $wp_customize->add_setting('modality_theme_options[google_font_menu]', array(
		'sanitize_callback' => 'modality_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Open Sans',

    ));

    $wp_customize->add_control( 'google_font_menu', array(
        'settings' => 'modality_theme_options[google_font_menu]',
        'label'   => __('Select Menu Font Family','modality'),
        'section' => 'Navigation Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[nav_font_size]', array(
        'default'        => '12',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('nav_font_size', array(
        'label'      => __('Menu Font Size (px)', 'modality'),
        'section'    => 'Navigation Settings',
        'settings'   => 'modality_theme_options[nav_font_size]',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[menu_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('menu_uppercase', array(
        'settings' => 'modality_theme_options[menu_uppercase]',
        'label'    => __('Menu Uppercase', 'modality'),
        'section'  => 'Navigation Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_font_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_font_color', array(
        'label'    => __('Navigation Menu Font Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_font_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_border_color]', array(
    	'default'        => '#c9c9c9',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_border_color', array(
        'label'    => __('Navigation Menu Border Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_bg_color]', array(
    	'default'        => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_color', array(
        'label'    => __('Navigation Menu Background Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[nav_bg_trans]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('nav_bg_trans', array(
        'settings' => 'modality_theme_options[nav_bg_trans]',
        'label'    => __('Navbar Transparent', 'modality'),
        'section'  => 'Navigation Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_bg_sub_color]', array(
    	'default'        => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_sub_color', array(
        'label'    => __('SubMenu Background Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_bg_sub_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_hover_font_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_hover_font_color', array(
        'label'    => __('Menu Hover Font Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_hover_font_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_bg_hover_color]', array(
    	'default'        => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_hover_color', array(
        'label'    => __('Menu Background Hover Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_bg_hover_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_cur_item_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_cur_item_color', array(
        'label'    => __('Selected Menu Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_cur_item_color]',
    )));
	//  =============================
    //  = Typography Section        =
    //  =============================
	$wp_customize->add_section( 'Typography Settings', array(
    	'title'          => __( 'Theme Typography Settings', 'modality' ),
    	'priority'       => 1003,
		'panel' => 'theme_options',
	) );
	//===============================
     $wp_customize->add_setting('modality_theme_options[google_font_body]', array(
		'sanitize_callback' => 'modality_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Crimson Text',

    ));

    $wp_customize->add_control( 'google_font_body', array(
        'settings' => 'modality_theme_options[google_font_body]',
        'label'   => __('Select Body Font Family','modality'),
        'section' => 'Typography Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[body_font_size]', array(
        'default'        => '15',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('body_font_size', array(
        'label'      => __('Body Font Size (px)', 'modality'),
        'section'    => 'Typography Settings',
        'settings'   => 'modality_theme_options[body_font_size]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[body_font_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_font_color', array(
        'label'    => __('Body Font Color', 'modality'),
        'section'  => 'Typography Settings',
        'settings' => 'modality_theme_options[body_font_color]',
    )));
	//  =============================
    //  = Contact Section           =
    //  =============================
	$wp_customize->add_section( 'Contact Settings', array(
    	'title'          => __( 'Theme Contact Settings', 'modality' ),
    	'priority'       => 1014,
		'panel' => 'theme_options',
	) );
	//===============================
    $wp_customize->add_setting('modality_theme_options[contact_bg_image]', array(
        'default'           => get_template_directory_uri() . '/images/bg/bg12.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'contact_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Contact Settings',
        'settings' => 'modality_theme_options[contact_bg_image]',
    )));
	//===============================
	/*$wp_customize->add_setting( 'modality_theme_options[header_bg_color]', array(
    	'default'        => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label'    => __('Header Background Color', 'modality'),
        'section'  => 'Contact Settings',
        'settings' => 'modality_theme_options[header_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[header_opacity]', array(
        'default'        => '1',
		'sanitize_callback' => 'modality_sanitize_opacity',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('header_opacity', array(
        'label'      => __('Header Background Color Opacity', 'modality'),
        'section'    => 'Contact Settings',
        'settings'   => 'modality_theme_options[header_opacity]',
        'type'    => 'select',
        'choices'    => $opacity,
    ));*/
	//===============================
	$wp_customize->add_setting('modality_theme_options[contact_detail_enable]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('contact_detail_enable', array(
        'settings' => 'modality_theme_options[contact_detail_enable]',
        'label'    => __('Display Contact Section', 'modality'),
        'section'  => 'Contact Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[contact_address]', array(
        'default'        => '1234 Street Name, City Name, United States',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('contact_address', array(
        'label'      => __('Address', 'modality'),
        'section'    => 'Contact Settings',
        'settings'   => 'modality_theme_options[contact_address]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[contact_phone]', array(
        'default'        => '(123) 456-7890',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('contact_phone', array(
        'label'      => __('Phone Number', 'modality'),
        'section'    => 'Contact Settings',
        'settings'   => 'modality_theme_options[contact_phone]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[contact_email]', array(
        'default'        => 'info@yourdomain.com',
		'sanitize_callback' => 'modality_sanitize_email',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('contact_email', array(
        'label'      => __('Email', 'modality'),
        'section'    => 'Contact Settings',
        'settings'   => 'modality_theme_options[contact_email]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[address_color]', array(
    	'default'        => '#cccccc',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'address_color', array(
        'label'    => __('Top Section Font Color', 'modality'),
        'section'  => 'Contact Settings',
        'settings' => 'modality_theme_options[address_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[top_head_color]', array(
    	'default'        => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'top_head_color', array(
        'label'    => __('Top Section Color', 'modality'),
        'section'  => 'Contact Settings',
        'settings' => 'modality_theme_options[top_head_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[contact_pricing_url]', array(
        'default'        => '#',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('contact_pricing_url', array(
        'label'      => __('Pricing URL', 'modality'),
        'section'    => 'Contact Settings',
        'settings'   => 'modality_theme_options[contact_pricing_url]',
    ));
	//  =============================
    //  = Home Page Section         =
    //  =============================
	$wp_customize->add_section( 'Home Settings', array(
    	'title'          => __( 'Theme Home Page Settings', 'modality' ),
    	'priority'       => 1005,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting('modality_theme_options[image_slider_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('image_slider_on', array(
        'settings' => 'modality_theme_options[image_slider_on]',
        'label'    => __('Enable Image Slider', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[features_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('features_section_on', array(
        'settings' => 'modality_theme_options[features_section_on]',
        'label'    => __('Display Features Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[about_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('about_section_on', array(
        'settings' => 'modality_theme_options[about_section_on]',
        'label'    => __('Display About Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[services_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('services_section_on', array(
        'settings' => 'modality_theme_options[services_section_on]',
        'label'    => __('Display Services Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[works_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('works_section_on', array(
        'settings' => 'modality_theme_options[works_section_on]',
        'label'    => __('Display Works Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[testi_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('testi_section_on', array(
        'settings' => 'modality_theme_options[testi_section_on]',
        'label'    => __('Display Testimonials Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[content_boxes_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));

    $wp_customize->add_control('content_boxes_section_on', array(
        'settings' => 'modality_theme_options[content_boxes_section_on]',
        'label'    => __('Display Content Boxes Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[getin_home_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('getin_home_on', array(
        'settings' => 'modality_theme_options[getin_home_on]',
        'label'    => __('Display Get In Touch Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[blog_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('blog_section_on', array(
        'settings' => 'modality_theme_options[blog_section_on]',
        'label'    => __('Display Blog Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[products_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('products_section_on', array(
        'settings' => 'modality_theme_options[products_section_on]',
        'label'    => __('Display Products Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[latest_posts_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('latest_posts_on', array(
        'settings' => 'modality_theme_options[latest_posts_on]',
        'label'    => __('Display Blog Posts', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[social_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('social_section_on', array(
        'settings' => 'modality_theme_options[social_section_on]',
        'label'    => __('Display Social Links', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Image Slider Section      =
    //  =============================
	$wp_customize->add_section( 'Slider Settings', array(
    	'title'          => __( 'Theme Image Slider Settings', 'modality' ),
    	'priority'       => 1006,
		'panel' => 'theme_options',
	) );
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[slider_info]', array(
        'default'        => 'http://revolution.themepunch.com/',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('slider_info', array(
        'label'      => __('Slider using revolution slider', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[slider_info]',
    ));
	//===============================
    /*$wp_customize->add_setting( 'modality_theme_options[slider_height]', array(
        'default'        => '500',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('slider_height', array(
        'label'      => __('Image Slider Height (px)', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[slider_height]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[image_slider_cat]', array(
        'default'        => '',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('image_slider_cat', array(
        'label'      => __('Image Slider Category', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[image_slider_cat]',
        'type'    => 'select',
        'choices'    => $options_categories,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[slideshow_speed]', array(
        'default'        => '5000',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('slideshow_speed', array(
        'label'      => __('Slideshow Interval', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[slideshow_speed]',
		'description' => __('1000 = 1 second, default value: 5000', 'modality'),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[animation_speed]', array(
        'default'        => '800',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('animation_speed', array(
        'label'      => __('Animation Speed', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[animation_speed]',
		'description' => __('1000 = 1 second, default value: 800', 'modality'),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[slider_num]', array(
        'default'        => '3',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('slider_num', array(
        'label'      => __('Number of Slides', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[slider_num]',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[captions_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => true,
    ));

    $wp_customize->add_control('captions_on', array(
        'settings' => 'modality_theme_options[captions_on]',
        'label'    => __('Enable Slider Captions', 'modality'),
        'section'  => 'Slider Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[captions_pos_left]', array(
        'default'        => '0',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('captions_pos_left', array(
        'label'      => __('Caption Position Left %', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[captions_pos_left]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[captions_pos_top]', array(
        'default'        => '120',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('captions_pos_top', array(
        'label'      => __('Caption Position Top (px)', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[captions_pos_top]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[captions_width]', array(
        'default'        => '70',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('captions_width', array(
        'label'      => __('Caption Width %', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[captions_width]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[captions_title_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_title_color', array(
        'label'    => __('Caption Title Color', 'modality'),
        'section'  => 'Slider Settings',
        'settings' => 'modality_theme_options[captions_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[captions_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_text_color', array(
        'label'    => __('Captions Text Color', 'modality'),
        'section'  => 'Slider Settings',
        'settings' => 'modality_theme_options[captions_text_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[captions_button_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_button_color', array(
        'label'    => __('Captions Button Color', 'modality'),
        'section'  => 'Slider Settings',
        'settings' => 'modality_theme_options[captions_button_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[captions_button]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('captions_button', array(
        'settings' => 'modality_theme_options[captions_button]',
        'label'    => __('Enable Captions Button', 'modality'),
        'section'  => 'Slider Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[caption_button_text]', array(
        'default'        => 'Read More',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('caption_button_text', array(
        'label'      => __('Captions Button Text', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[caption_button_text]',
    ));*/
	//  =============================
    //  = Footer Section            =
    //  =============================
	$wp_customize->add_section( 'Footer Settings', array(
    	'title'          => __( 'Theme Footer Settings', 'modality' ),
    	'priority'       => 1024,
		'panel' => 'theme_options',
	) );
	//===============================
    $wp_customize->add_setting('modality_theme_options[footer_logo]', array(
        'default'           => get_template_directory_uri() . '/images/escope-logo-dark.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label'    => __('Footer Logo', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_logo]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_bg_color]', array(
    	'default'        => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
        'label'    => __('Footer Background Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[copyright_bg_color]', array(
    	'default'        => '#FAFAFA',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'copyright_bg_color', array(
        'label'    => __('Copyright Section Background Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[copyright_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_widget_title_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_title_color', array(
        'label'    => __('Footer Widget Title Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_widget_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_widget_title_border_color]', array(
    	'default'        => '#444444',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_title_border_color', array(
        'label'    => __('Footer Widget Title Border Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_widget_title_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_widget_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_text_color', array(
        'label'    => __('Footer Widget Text Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_widget_text_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_widget_text_border_color]', array(
    	'default'        => '#444444',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_text_border_color', array(
        'label'    => __('Footer Widget Text Border Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_widget_text_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_social_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_social_color', array(
        'label'    => __('Footer Social Icons Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_social_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[footer_widgets]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('footer_widgets', array(
        'settings' => 'modality_theme_options[footer_widgets]',
        'label'    => __('Enable Footer Widgets', 'modality'),
        'section'  => 'Footer Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[footer_copyright_text]', array(
        'default'        => 'Copyright '.date('Y').' '.get_bloginfo('site_title'),
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('footer_copyright_text', array(
        'label'      => __('Copyright Text', 'modality'),
        'section'    => 'Footer Settings',
        'settings'   => 'modality_theme_options[footer_copyright_text]',
    ));
	//  =============================
    //  = Layout Section            =
    //  =============================
	$wp_customize->add_section( 'Layout Settings', array(
    	'title'          => __( 'Theme Layout Settings', 'modality' ),
    	'priority'       => 1004,
		'panel' => 'theme_options',
	) );
	//===============================
     $wp_customize->add_setting('modality_theme_options[layout_settings]', array(
		'sanitize_callback' => 'modality_sanitize_theme_layout',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'col1',

    ));

    $wp_customize->add_control( 'layout_settings', array(
        'settings' => 'modality_theme_options[layout_settings]',
        'label'   => __('Theme Layout','modality'),
        'section' => 'Layout Settings',
        'type'    => 'radio',
        'choices'    => $theme_layout,
    ));
	//  =============================
    //  = Blog Section              =
    //  =============================
	$wp_customize->add_section( 'Blog Settings', array(
    	'title'          => __( 'Theme Blog Settings', 'modality' ),
    	'priority'       => 1012,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_posts_home_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_home_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_home_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[blog_posts_home_image]', array(
        'default'           => get_template_directory_uri() . '/images/bg/bg33.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_posts_home_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_home_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_tweet_account]', array(
        'default'        => 'LumiaIndonesia',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('blog_tweet_account', array(
        'label'      => __('Twitter Feed @', 'modality'),
        'section'    => 'Blog Settings',
        'settings'   => 'modality_theme_options[blog_tweet_account]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_posts_top_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_top_color', array(
        'label'    => __('Top Section Background Color', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_top_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_posts_top_font_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_top_font_color', array(
        'label'    => __('Top Section Font Color', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_top_font_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_section_header]', array(
        'default'        => 'Blog',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('blog_section_header', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'Blog Settings',
        'settings'   => 'modality_theme_options[blog_section_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_section_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('blog_section_text', array(
        'label'      => __('Section Text', 'modality'),
        'section'    => 'Blog Settings',
        'settings'   => 'modality_theme_options[blog_section_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_num_posts]', array(
        'default'        => '4',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('blog_num_posts', array(
        'label'      => __('Number of Posts', 'modality'),
        'section'    => 'Blog Settings',
        'settings'   => 'modality_theme_options[blog_num_posts]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_cat_posts]', array(
        'default'        => '',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('blog_cat_posts', array(
        'label'      => __('Latest News Category', 'modality'),
        'section'    => 'Blog Settings',
        'settings'   => 'modality_theme_options[blog_cat_posts]',
        'type'    => 'select',
        'choices'    => $options_categories,
    ));
	//===============================
    /*$wp_customize->add_setting('modality_theme_options[blog_posts_top_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_posts_top_image', array(
        'label'    => __('Top Section Image', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_top_image]',
    )));*/
	//===============================
     $wp_customize->add_setting('modality_theme_options[blog_content]', array(
		'sanitize_callback' => 'modality_sanitize_blog_content',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'excerpt',

    ));

    $wp_customize->add_control( 'blog_content', array(
        'settings' => 'modality_theme_options[blog_content]',
        'label'   => __('Blog Content','modality'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $blog_content,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_excerpt]', array(
        'default'        => '50',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('blog_excerpt', array(
        'label'      => __('Blog Excerpt Length', 'modality'),
        'section'    => 'Blog Settings',
        'settings'   => 'modality_theme_options[blog_excerpt]',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[simple_paginaton]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));

    $wp_customize->add_control('simple_paginaton', array(
        'settings' => 'modality_theme_options[simple_paginaton]',
        'label'    => __('Use Simple Pagination', 'modality'),
        'section'  => 'Blog Settings',
        'type'     => 'checkbox',
    ));
	//===============================
     $wp_customize->add_setting('modality_theme_options[post_navigation]', array(
		'sanitize_callback' => 'modality_sanitize_post_nav',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'sidebar',

    ));

    $wp_customize->add_control( 'post_navigation', array(
        'settings' => 'modality_theme_options[post_navigation]',
        'label'   => __('Post Navigation Links','modality'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $post_nav_array,
    ));
	//===============================
     $wp_customize->add_setting('modality_theme_options[post_info]', array(
		'sanitize_callback' => 'modality_sanitize_post_info',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'above',

    ));

    $wp_customize->add_control( 'post_info', array(
        'settings' => 'modality_theme_options[post_info]',
        'label'   => __('Post Info Position','modality'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $post_info_array,
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[featured_img_post]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));

    $wp_customize->add_control('featured_img_post', array(
        'settings' => 'modality_theme_options[featured_img_post]',
        'label'    => __('Featured Image Inside the Post', 'modality'),
        'section'  => 'Blog Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Products Section          =
    //  =============================
	$wp_customize->add_section( 'Products Settings', array(
    	'title'          => __( 'Theme Products Section', 'modality' ),
    	'priority'       => 1013,
		'panel' => 'theme_options',
	) );
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[products_section_header]', array(
        'default'        => 'Latest Products',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('products_section_header', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'Products Settings',
        'settings'   => 'modality_theme_options[products_section_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[products_section_text]', array(
        'default'        => 'Choose from our shop',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('products_section_text', array(
        'label'      => __('Section Text', 'modality'),
        'section'    => 'Products Settings',
        'settings'   => 'modality_theme_options[products_section_text]',
    ));
	//  =============================
    //  = Works Section             =
    //  =============================
	$wp_customize->add_section( 'Works Settings', array(
    	'title'          => __( 'Theme Works Section', 'modality' ),
    	'priority'       => 1010,
		'panel' => 'theme_options',
	) );
	//===============================
	/*$wp_customize->add_setting( 'modality_theme_options[works_bg_color]', array(
    	'default'        => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'works_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Works Settings',
        'settings' => 'modality_theme_options[works_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[works_header_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'works_header_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'Works Settings',
        'settings' => 'modality_theme_options[works_header_color]',
    )));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[works_section_header]', array(
        'default'        => 'Works',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('works_section_header', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'Works Settings',
        'settings'   => 'modality_theme_options[works_section_header]',
    ));
	//===============================
	/*$wp_customize->add_setting( 'modality_theme_options[works_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'works_text_color', array(
        'label'    => __('Subtitle Color', 'modality'),
        'section'  => 'Works Settings',
        'settings' => 'modality_theme_options[works_text_color]',
    )));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[works_section_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('works_section_text', array(
        'label'      => __('Section Text', 'modality'),
        'section'    => 'Works Settings',
        'settings'   => 'modality_theme_options[works_section_text]',
    ));
	//===============================
    /*$wp_customize->add_setting( 'modality_theme_options[works_button_text]', array(
        'default'        => 'Get Started',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('works_button_text', array(
        'label'      => __('Button Text', 'modality'),
        'section'    => 'Works Settings',
        'settings'   => 'modality_theme_options[works_button_text]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[works_button_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'works_button_color', array(
        'label'    => __('Subtitle Color', 'modality'),
        'section'  => 'Works Settings',
        'settings' => 'modality_theme_options[works_button_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[works_button_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('works_button_url', array(
        'label'      => __('Button URL', 'modality'),
        'section'    => 'Works Settings',
        'settings'   => 'modality_theme_options[works_button_url]',
    ));*/
	//  =============================
    //  = Features Settings         =
    //  =============================
	$wp_customize->add_section( 'Features Settings', array(
    	'title'          => __( 'Theme Features Section', 'modality' ),
    	'priority'       => 1008,
		'panel' => 'theme_options',
	) );
	//===============================
	/*$wp_customize->add_setting( 'modality_theme_options[features_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[features_bg_color]',
    )));*/
	//===============================
    $wp_customize->add_setting('modality_theme_options[features_bg_image]', array(
        'default'           => get_template_directory_uri() . '/images/bg/bg5.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'features_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[features_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[features_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_title_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[features_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[features_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_text_color', array(
        'label'    => __('Text Color', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[features_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[features_section_title]', array(
        'default'        => 'Featured Works',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('features_section_title', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[features_section_title]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[features_section_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('features_section_desc', array(
        'label'      => __('Description Text', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[features_section_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[features_instagram_acc]', array(
        'default'        => 'vapeboss.id',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('features_instagram_acc', array(
        'label'      => __('Instagram Account', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[features_instagram_acc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[features_instagram_clientid]', array(
        'default'        => '8c1144b4c5ba4cc3a56536e374e31e6b',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('features_instagram_clientid', array(
        'label'      => __('Instagram Account ID', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[features_instagram_clientid]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[features_instagram_count]', array(
        'default'        => '5',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('features_instagram_count', array(
        'label'      => __('Instagram Item Count', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[features_instagram_count]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_divider_text]', array(
        'default'        => 'Working Process',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_divider_text', array(
        'label'      => __('Divider Text', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_divider_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_one]', array(
        'default'        => 'Concept',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_one', array(
        'label'      => __('Feature #1 Title', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_one]',
    ));
	//===============================
    /*$wp_customize->add_setting( 'modality_theme_options[feature_one_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_one_desc', array(
        'label'      => __('Feature #1 Description', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_one_desc]',
    ));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_one_icon]', array(
        'default'        => 'pe-7s-light',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_one_icon', array(
        'label'      => __('Feature #1 Icon', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_one_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    /*$wp_customize->add_setting('modality_theme_options[feature_one_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_one_image', array(
        'label'    => __('Feature #1 Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[feature_one_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_one_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_one_url', array(
        'label'      => __('Feature #1 URL', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_one_url]',
    ));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_two]', array(
        'default'        => 'Design',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_two', array(
        'label'      => __('Feature #2 Title', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_two]',
    ));
	//===============================
    /*$wp_customize->add_setting( 'modality_theme_options[feature_two_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_two_desc', array(
        'label'      => __('Feature #2 Description', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_two_desc]',
    ));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_two_icon]', array(
        'default'        => 'pe-7s-paint-bucket',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_two_icon', array(
        'label'      => __('Feature #2 Icon', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_two_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    /*$wp_customize->add_setting('modality_theme_options[feature_two_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_two_image', array(
        'label'    => __('Feature #2 Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[feature_two_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_two_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_two_url', array(
        'label'      => __('Feature #2 URL', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_two_url]',
    ));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_three]', array(
        'default'        => 'Development',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_three', array(
        'label'      => __('Feature #3 Title', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_three]',
    ));
	//===============================
    /*$wp_customize->add_setting( 'modality_theme_options[feature_three_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_three_desc', array(
        'label'      => __('Feature #3 Description', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_three_desc]',
    ));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_three_icon]', array(
        'default'        => 'pe-7s-paint',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_three_icon', array(
        'label'      => __('Feature #3 Icon', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_three_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    /*$wp_customize->add_setting('modality_theme_options[feature_three_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_three_image', array(
        'label'    => __('Feature #3 Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[feature_three_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_three_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_three_url', array(
        'label'      => __('Feature #3 URL', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_three_url]',
    ));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_four]', array(
        'default'        => 'Launch',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_four', array(
        'label'      => __('Feature #4 Title', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_four]',
    ));
	//===============================
    /*$wp_customize->add_setting( 'modality_theme_options[feature_four_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_four_desc', array(
        'label'      => __('Feature #4 Description', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_four_desc]',
    ));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_four_icon]', array(
        'default'        => 'pe-7s-rocket',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_four_icon', array(
        'label'      => __('Feature #4 Icon', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_four_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    /*$wp_customize->add_setting('modality_theme_options[feature_four_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_four_image', array(
        'label'    => __('Feature #4 Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[feature_four_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_four_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('feature_four_url', array(
        'label'      => __('Feature #4 URL', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_four_url]',
    ));*/
	//  =============================
    //  = About Us Settings         =
    //  =============================
	$wp_customize->add_section( 'About Settings', array(
    	'title'          => __( 'Theme About Us Section', 'modality' ),
    	'priority'       => 1007,
		'panel' => 'theme_options',
	) );
	//===============================
	/*$wp_customize->add_setting( 'modality_theme_options[about_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_bg_color]',
    )));*/
	//===============================
    $wp_customize->add_setting('modality_theme_options[about_bg_image]', array(
        'default'           => get_template_directory_uri() . '/images/bg/bg28.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'about_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[about_section_image]', array(
        'default'           => get_template_directory_uri() . '/images/photos/about-img1.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'about_section_image', array(
        'label'    => __('Section Image', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_section_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_header_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_header_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_header_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[about_section_header]', array(
        'default'        => 'About Us',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_header', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_text_color', array(
        'label'    => __('Text Color', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[about_section_header_text]', array(
        'default'        => 'We use strategy and design to connect brands and people through the things they love.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize,'about_section_header_text', array(
        'label'      => __('Section Header', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_header_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[about_section_text]', array(
        'default'        => 'We are a creative, multi-disciplined web & digital design studio in Texas. We have a great understanding when it comes to designing and developing websites. We ensure everything we build has been optimised for smartphones, tablets & desktops.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize,'about_section_text', array(
        'label'      => __('Section Text', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_text]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_icon_one]', array(
        'default'        => 'pe-7s-camera',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_icon_one', array(
        'label'      => __('Icon #1', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_icon_one]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_icon_two]', array(
        'default'        => 'pe-7s-headphones',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_icon_two', array(
        'label'      => __('Icon #2', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_icon_two]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_icon_three]', array(
        'default'        => 'pe-7s-science',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_icon_three', array(
        'label'      => __('Icon #3', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_icon_three]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_title_one]', array(
        'default'        => 'What We Do',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_title_one', array(
        'label'      => __('Section Title #1', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_title_one]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_title_two]', array(
        'default'        => 'What We Love',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_title_two', array(
        'label'      => __('Section Title #2', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_title_two]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_title_three]', array(
        'default'        => 'What We Believe in',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_title_three', array(
        'label'      => __('Section Title #3', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_title_three]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_text_one]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_text_one', array(
        'label'      => __('Section Text #1', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_text_one]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_text_two]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_text_two', array(
        'label'      => __('Section Text #2', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_text_two]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_section_text_three]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_section_text_three', array(
        'label'      => __('Section Text #3', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_text_three]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_icon_one]', array(
        'default'        => 'pe-7s-phone',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_icon_one', array(
        'label'      => __('Divider Icon #1', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_icon_one]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_icon_two]', array(
        'default'        => 'pe-7s-leaf',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_icon_two', array(
        'label'      => __('Divider Icon #2', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_icon_two]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_icon_three]', array(
        'default'        => 'pe-7s-magic-wand',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_icon_three', array(
        'label'      => __('Divider Icon #3', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_icon_three]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_icon_four]', array(
        'default'        => 'pe-7s-check',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_icon_four', array(
        'label'      => __('Divider Icon #4', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_icon_four]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_icon_five]', array(
        'default'        => 'pe-7s-timer',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_icon_five', array(
        'label'      => __('Divider Icon #5', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_icon_five]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_title_one]', array(
        'default'        => 'Responsive Design',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_title_one', array(
        'label'      => __('Divider Title #1', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_title_one]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_title_two]', array(
        'default'        => 'Clean Code',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_title_two', array(
        'label'      => __('Divider Title #2', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_title_two]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_title_three]', array(
        'default'        => 'Unique Design',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_title_three', array(
        'label'      => __('Divider Title #3', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_title_three]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_title_four]', array(
        'default'        => 'W3 Validated',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_title_four', array(
        'label'      => __('Divider Title #4', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_title_four]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_title_five]', array(
        'default'        => 'Faster Load Time',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_title_five', array(
        'label'      => __('Divider Title #5', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_title_five]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_text_one]', array(
        'default'        => 'Lorem ipsum dolor sit amet',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_text_one', array(
        'label'      => __('Divider Text #1', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_text_one]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_text_two]', array(
        'default'        => 'Lorem ipsum dolor sit amet',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_text_two', array(
        'label'      => __('Divider Text #2', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_text_two]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_text_three]', array(
        'default'        => 'Lorem ipsum dolor sit amet',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_text_three', array(
        'label'      => __('Divider Text #3', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_text_three]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_text_four]', array(
        'default'        => 'Lorem ipsum dolor sit amet',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_text_four', array(
        'label'      => __('Divider Text #4', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_text_four]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_divider_text_five]', array(
        'default'        => 'Lorem ipsum dolor sit amet',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('about_divider_text_five', array(
        'label'      => __('Divider Text #5', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_divider_text_five]',
    ));
	//  =============================
    //  = Our Services Settings     =
    //  =============================
	$wp_customize->add_section( 'Services Settings', array(
    	'title'          => __( 'Theme Services Section', 'modality' ),
    	'priority'       => 1009,
		'panel' => 'theme_options',
	) );
	//===============================
	/*$wp_customize->add_setting( 'modality_theme_options[services_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_bg_color]',
    )));*/
	//===============================
    $wp_customize->add_setting('modality_theme_options[services_bg_image]', array(
        'default'           => get_template_directory_uri() . '/images/bg/bg16.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'services_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[services_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_title_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[services_text_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_text_color', array(
        'label'    => __('Section Text Color', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[services_section_title]', array(
        'default'        => 'Services',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('services_section_title', array(
        'label'      => __('Section Text', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[services_section_title]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[services_section_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'services_section_desc', array(
        'label'      => __('Description Text', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[services_section_desc]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[services_image]', array(
        'default'           => get_template_directory_uri() . '/images/services-three-imacs.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'services_image', array(
        'label'    => __('Section Image', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_one]', array(
        'default'        => 'Web Development',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_one', array(
        'label'      => __('Service #1 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_one]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_one_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_one_desc', array(
        'label'      => __('Service #1 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_one_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_one_icon]', array(
        'default'        => 'pe-7s-monitor',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_one_icon', array(
        'label'      => __('Service #1 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_one_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_two]', array(
        'default'        => 'Logo Design',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_two', array(
        'label'      => __('Service #2 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_two]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_two_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_two_desc', array(
        'label'      => __('Service #2 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_two_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_two_icon]', array(
        'default'        => 'pe-7s-box2',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_two_icon', array(
        'label'      => __('Service #2 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_two_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_three]', array(
        'default'        => 'SEO',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_three', array(
        'label'      => __('Service #3 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_three]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_three_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_three_desc', array(
        'label'      => __('Service #3 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_three_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_three_icon]', array(
        'default'        => 'pe-7s-search',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_three_icon', array(
        'label'      => __('Service #3 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_three_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_four]', array(
        'default'        => 'Branding',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_four', array(
        'label'      => __('Service #4 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_four]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_four_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_four_desc', array(
        'label'      => __('Service #4 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_four_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_four_icon]', array(
        'default'        => 'pe-7s-paint',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_four_icon', array(
        'label'      => __('Service #4 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_four_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_five]', array(
        'default'        => 'Marketing',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_five', array(
        'label'      => __('Service #5 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_five]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_five_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_five_desc', array(
        'label'      => __('Service #5 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_five_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_five_icon]', array(
        'default'        => 'pe-7s-network',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_five_icon', array(
        'label'      => __('Service #5 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_five_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_six]', array(
        'default'        => '24/7 Support',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_six', array(
        'label'      => __('Service #6 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_six]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_six_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_six_desc', array(
        'label'      => __('Service #6 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_six_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_six_icon]', array(
        'default'        => 'pe-7s-help2',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_six_icon', array(
        'label'      => __('Service #6 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_six_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_one]', array(
        'default'        => '12',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_one', array(
        'label'      => __('Divider #1 Value', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_one]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_one_duration]', array(
        'default'        => '1500',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_one_duration', array(
        'label'      => __('Divider #1 Duration', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_one_duration]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_one_icon]', array(
        'default'        => 'pe-7s-stopwatch',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_one_icon', array(
        'label'      => __('Divider #1 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_one_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_one_text]', array(
        'default'        => 'Years of Experience',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_one_text', array(
        'label'      => __('Devider #1 Text', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_one_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_two]', array(
        'default'        => '1430',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_two', array(
        'label'      => __('Divider #2 Value', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_two]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_two_duration]', array(
        'default'        => '4000',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_two_duration', array(
        'label'      => __('Divider #2 Duration', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_two_duration]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_two_icon]', array(
        'default'        => 'pe-7s-portfolio',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_two_icon', array(
        'label'      => __('Divider #1 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_two_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_two_text]', array(
        'default'        => 'Projects Completed',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_two_text', array(
        'label'      => __('Devider #2 Text', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_two_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_three]', array(
        'default'        => '146',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_three', array(
        'label'      => __('Divider #3 Value', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_three]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_three_duration]', array(
        'default'        => '5500',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_three_duration', array(
        'label'      => __('Divider #3 Duration', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_three_duration]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_three_icon]', array(
        'default'        => 'pe-7s-portfolio',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_three_icon', array(
        'label'      => __('Divider #3 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_three_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_three_text]', array(
        'default'        => 'Happy Clients',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_three_text', array(
        'label'      => __('Devider #3 Text', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_three_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_four]', array(
        'default'        => '8572',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_four', array(
        'label'      => __('Divider #4 Value', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_four]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_four_duration]', array(
        'default'        => '5500',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_four_duration', array(
        'label'      => __('Divider #4 Duration', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_four_duration]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_four_icon]', array(
        'default'        => 'pe-7s-coffee',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_four_icon', array(
        'label'      => __('Divider #4 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_four_icon]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_divider_four_text]', array(
        'default'        => 'Cup of Coffee',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('service_divider_four_text', array(
        'label'      => __('Devider #4 Text', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_divider_four_text]',
    ));
	//  =============================
    //  = Testimonials Settings     =
    //  =============================
	$wp_customize->add_section( 'Testi Settings', array(
    	'title'          => __( 'Theme Testimonials Section', 'modality' ),
    	'priority'       => 1011,
		'panel' => 'theme_options',
	) );
	//===============================
	/*$wp_customize->add_setting( 'modality_theme_options[testi_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'testi_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_bg_color]',
    )));*/
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_bg_image]', array(
        'default'           => get_template_directory_uri() . '/images/bg/bg2.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_one]', array(
        'default'        => 'Jane Doe',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_one', array(
        'label'      => __('Testi #1 Name', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_one]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_one_title]', array(
        'default'        => 'Developer',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_one_title', array(
        'label'      => __('Testi #1 Title', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_one_title]',
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_author_one_image]', array(
        'default'           => get_template_directory_uri() . '/images/testimonials/1.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_author_one_image', array(
        'label'    => __('Testi #1 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_author_one_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_one_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_one_text', array(
        'label'      => __('Testi #1 Text', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_one_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_two]', array(
        'default'        => 'John Doe',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_two', array(
        'label'      => __('Testi #2 Name', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_two]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_two_title]', array(
        'default'        => 'Designer',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_two_title', array(
        'label'      => __('Testi #2 Title', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_two_title]',
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_author_two_image]', array(
        'default'           => get_template_directory_uri() . '/images/testimonials/2.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_author_two_image', array(
        'label'    => __('Testi #2 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_author_two_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_two_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_two_text', array(
        'label'      => __('Testi #2 Text', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_two_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_three]', array(
        'default'        => 'Devi Deva',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_three', array(
        'label'      => __('Testi #2 Name', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_three]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_three_title]', array(
        'default'        => 'Web Developer',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_three_title', array(
        'label'      => __('Testi #3 Title', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_three_title]',
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_author_three_image]', array(
        'default'           => get_template_directory_uri() . '/images/testimonials/3.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_author_three_image', array(
        'label'    => __('Testi #3 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_author_three_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[testi_author_three_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('testi_author_three_text', array(
        'label'      => __('Testi #3 Text', 'modality'),
        'section'    => 'Testi Settings',
        'settings'   => 'modality_theme_options[testi_author_three_text]',
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_client_one_image]', array(
        'default'           => get_template_directory_uri() . '/images/clients/1.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_client_one_image', array(
        'label'    => __('Client #1 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_client_one_image]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_client_two_image]', array(
        'default'           => get_template_directory_uri() . '/images/clients/2.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_client_two_image', array(
        'label'    => __('Client #2 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_client_two_image]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_client_three_image]', array(
        'default'           => get_template_directory_uri() . '/images/clients/3.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_client_three_image', array(
        'label'    => __('Client #3 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_client_three_image]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_client_four_image]', array(
        'default'           => get_template_directory_uri() . '/images/clients/4.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_client_four_image', array(
        'label'    => __('Client #4 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_client_four_image]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_client_five_image]', array(
        'default'           => get_template_directory_uri() . '/images/clients/5.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_client_five_image', array(
        'label'    => __('Client #5 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_client_five_image]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[testi_client_six_image]', array(
        'default'           => get_template_directory_uri() . '/images/clients/6.png',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'testi_client_six_image', array(
        'label'    => __('Client #6 Image', 'modality'),
        'section'  => 'Testi Settings',
        'settings' => 'modality_theme_options[testi_client_six_image]',
    )));
	//  =============================
    //  = Content Boxes Settings    =
    //  =============================
	$wp_customize->add_section( 'CB Settings', array(
    	'title'          => __( 'Theme Content Boxes Section', 'modality' ),
    	'priority'       => 1015,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cont_bg_color]', array(
    	'default'        => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cont_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'CB Settings',
        'settings' => 'modality_theme_options[cont_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[cntbx_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cntbx_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'CB Settings',
        'settings' => 'modality_theme_options[cntbx_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cntbx_title_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cntbx_title_color', array(
        'label'    => __('Titles Color', 'modality'),
        'section'  => 'CB Settings',
        'settings' => 'modality_theme_options[cntbx_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cont_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cont_text_color', array(
        'label'    => __('Text Color', 'modality'),
        'section'  => 'CB Settings',
        'settings' => 'modality_theme_options[cont_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[first_column_header]', array(
        'default'        => 'Responsive Design',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('first_column_header', array(
        'label'      => __('First Column Header', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[first_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[first_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'first_column_text', array(
        'label'      => __('First Column Text', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[first_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[first_column_image]', array(
        'default'        => 'fa-tablet',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('first_column_image', array(
        'label'      => __('First Column Image', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[first_column_image]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[first_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('first_column_url', array(
        'label'      => __('First Column URL', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[first_column_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[second_column_header]', array(
        'default'        => 'High Quality',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('second_column_header', array(
        'label'      => __('Second Column Header', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[second_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[second_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'second_column_text', array(
        'label'      => __('Second Column Text', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[second_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[second_column_image]', array(
        'default'        => 'fa-umbrella',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('second_column_image', array(
        'label'      => __('Second Column Image', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[second_column_image]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[second_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('second_column_url', array(
        'label'      => __('Second Column URL', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[second_column_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[third_column_header]', array(
        'default'        => 'Tons of Features',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('third_column_header', array(
        'label'      => __('Third Column Header', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[third_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[third_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'third_column_text', array(
        'label'      => __('Third Column Text', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[third_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[third_column_image]', array(
        'default'        => 'fa-cog',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('third_column_image', array(
        'label'      => __('Third Column Image', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[third_column_image]',
		'description' => sprintf( __( 'Enter Font Stroke icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Stroke Website</a>', 'modality' ), 'http://themes-pixeden.com/font-demos/7-stroke/index.html' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[third_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('third_column_url', array(
        'label'      => __('Third Column URL', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[third_column_url]',
    ));
	//  =============================
    //  = Get In Touch Settings     =
    //  =============================
	$wp_customize->add_section( 'GIT Settings', array(
    	'title'          => __( 'Theme Get In Touch Section', 'modality' ),
    	'priority'       => 1016,
		'panel' => 'theme_options',
	));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getin_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[getin_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'getin_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getin_header_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_header_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_header_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getin_section_header]', array(
        'default'        => 'Get In Touch with Us',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('getin_section_header', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'GIT Settings',
        'settings'   => 'modality_theme_options[getin_section_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getin_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_text_color', array(
        'label'    => __('Subtitle Color', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getin_section_text]', array(
        'default'        => 'If you have any questions, do not hesitate to contact us',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('getin_section_text', array(
        'label'      => __('Subtitle Text', 'modality'),
        'section'    => 'GIT Settings',
        'settings'   => 'modality_theme_options[getin_section_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getin_button_text]', array(
        'default'        => 'Contact us now',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('getin_button_text', array(
        'label'      => __('Button Text', 'modality'),
        'section'    => 'GIT Settings',
        'settings'   => 'modality_theme_options[getin_button_text]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getin_button_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_button_color', array(
        'label'    => __('Button Color', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_button_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getin_button_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('getin_button_url', array(
        'label'      => __('Button URL', 'modality'),
        'section'    => 'GIT Settings',
        'settings'   => 'modality_theme_options[getin_button_url]',
    ));
	//  =============================
    //  = Latest News Settings      =
    //  =============================
	$wp_customize->add_section( 'News Settings', array(
    	'title'          => __( 'Theme Latest News Section', 'modality' ),
    	'priority'       => 1017,
		'panel' => 'theme_options',
	));
	//===============================
	/*$wp_customize->add_setting( 'modality_theme_options[blog_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[blog_bg_image]', array(
        'default'           => get_template_directory_uri() . '/images/bg/bg33.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_bg_image]',
    )));*/
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_cat]', array(
        'default'        => '',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('blog_cat', array(
        'label'      => __('Latest News Category', 'modality'),
        'section'    => 'News Settings',
        'settings'   => 'modality_theme_options[blog_cat]',
        'type'    => 'select',
        'choices'    => $options_categories,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[num_posts]', array(
        'default'        => '2',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('num_posts', array(
        'label'      => __('Number of Posts', 'modality'),
        'section'    => 'News Settings',
        'settings'   => 'modality_theme_options[num_posts]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_section_title]', array(
        'default'        => 'Latest News',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('blog_section_title', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'News Settings',
        'settings'   => 'modality_theme_options[blog_section_title]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_title_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_post_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_post_color', array(
        'label'    => __('Post Title Color', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_post_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_meta_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_meta_color', array(
        'label'    => __('Post Meta Color', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_meta_color]',
    )));
	//  =============================
    //  = Social Settings           =
    //  =============================
	$wp_customize->add_section( 'Social Settings', array(
    	'title'          => __( 'Theme Social Links', 'modality' ),
    	'priority'       => 1018,
		'panel' => 'theme_options',
		'description' => __("Enter your profile URL. To remove it, just leave it blank","modality"),
	));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[social_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'social_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Social Settings',
        'settings' => 'modality_theme_options[social_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[social_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'social_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Social Settings',
        'settings' => 'modality_theme_options[social_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[facebook_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('facebook_link', array(
        'label'      => __('Facebook', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[facebook_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[twitter_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('twitter_link', array(
        'label'      => __('Twitter', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[twitter_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[google_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('google_link', array(
        'label'      => __('Google Plus', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[google_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[linkedin_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('linkedin_link', array(
        'label'      => __('LinkedIn', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[linkedin_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[instagram_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('instagram_link', array(
        'label'      => __('Instagram', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[instagram_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[vimeo_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('vimeo_link', array(
        'label'      => __('Vimeo', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[vimeo_link]',
    ));

}

add_action('customize_register', 'modality_customize_register');


/**
 * Sets up theme custom styling
 *
 */
function modality_theme_custom_styling() {
	$modality_theme_options = modality_get_options( 'modality_theme_options' );
	/**
	 * General Settings
	 */
	$theme_color = $modality_theme_options['theme_color'];
	$scrollup_color = $modality_theme_options['scrollup_color'];
	$scrollup_hover_color = $modality_theme_options['scrollup_hover_color'];
	/**
	 * Logo Settings
	 */
	$logo_width = $modality_theme_options['logo_width'];
	$logo_height = $modality_theme_options['logo_height'];
	$logo_top_margin = $modality_theme_options['logo_top_margin'];
	$logo_left_margin = $modality_theme_options['logo_left_margin'];
	$logo_bottom_margin = $modality_theme_options['logo_bottom_margin'];
	$logo_right_margin = $modality_theme_options['logo_right_margin'];
	$logo_uppercase = $modality_theme_options['logo_uppercase'];
	$google_font_logo = $modality_theme_options['google_font_logo'];
	$logo_font_size = $modality_theme_options['logo_font_size'];
	$logo_font_weight = $modality_theme_options['logo_font_weight'];
	$text_logo_color = $modality_theme_options['text_logo_color'];
	$tagline_font_size = $modality_theme_options['tagline_font_size'];
	$tagline_color = $modality_theme_options['tagline_color'];
	$tagline_uppercase = $modality_theme_options['tagline_uppercase'];
	/**
	 * Navigation Settings
	 */
	$menu_sticky = $modality_theme_options['menu_sticky'];
	$menu_top_margin = $modality_theme_options['menu_top_margin'];
	$google_font_menu = $modality_theme_options['google_font_menu'];
	$nav_font_size = $modality_theme_options['nav_font_size'];
	$menu_uppercase = $modality_theme_options['menu_uppercase'];
	$nav_font_color = $modality_theme_options['nav_font_color'];
	$nav_border_color = $modality_theme_options['nav_border_color'];
	$nav_bg_color = $modality_theme_options['nav_bg_color'];
	$nav_bg_trans = $modality_theme_options['nav_bg_trans'];
	$nav_bg_sub_color = $modality_theme_options['nav_bg_sub_color'];
	$nav_hover_font_color = $modality_theme_options['nav_hover_font_color'];
	$nav_bg_hover_color = $modality_theme_options['nav_bg_hover_color'];
	$nav_cur_item_color = $modality_theme_options['nav_cur_item_color'];
	/**
	 * Typography Settings
	 */
	$google_font_body = $modality_theme_options['google_font_body'];
	$body_font_size = $modality_theme_options['body_font_size'];
	$body_font_color = $modality_theme_options['body_font_color'];
	/**
	 * Contact Settings
	 */
	$header_bg_color = $modality_theme_options['header_bg_color'];
	$header_opacity = $modality_theme_options['header_opacity'];
	$address_color = $modality_theme_options['address_color'];
	$top_head_color = $modality_theme_options['top_head_color'];
	/**
	 * Image Slider
	 */
	$slider_height = $modality_theme_options['slider_height'];
	$captions_pos_left = $modality_theme_options['captions_pos_left'];
	$captions_pos_top = $modality_theme_options['captions_pos_top'];
	$captions_width = $modality_theme_options['captions_width'];
	$captions_title_color = $modality_theme_options['captions_title_color'];
	$captions_text_color = $modality_theme_options['captions_text_color'];
	$captions_button_color = $modality_theme_options['captions_button_color'];
	/**
	 * Footer Settings
	 */
	$footer_bg_color = $modality_theme_options['footer_bg_color'];
	$copyright_bg_color = $modality_theme_options['copyright_bg_color'];
	$footer_widget_title_color = $modality_theme_options['footer_widget_title_color'];
	$footer_widget_title_border_color = $modality_theme_options['footer_widget_title_border_color'];
	$footer_widget_text_color = $modality_theme_options['footer_widget_text_color'];
	$footer_widget_text_border_color = $modality_theme_options['footer_widget_text_border_color'];
	$footer_social_color = $modality_theme_options['footer_social_color'];
	/**
	 * Blog Settings
	 */
	$blog_posts_home_color = $modality_theme_options['blog_posts_home_color'];
	$blog_bg_color = $modality_theme_options['blog_bg_color'];
	$blog_title_color = $modality_theme_options['blog_title_color'];
	$blog_post_color = $modality_theme_options['blog_post_color'];
	$blog_meta_color = $modality_theme_options['blog_meta_color'];
	$blog_posts_top_color = $modality_theme_options['blog_posts_top_color'];
	$blog_posts_top_font_color = $modality_theme_options['blog_posts_top_font_color'];
	/**
	* Works Section
	*/
	$works_bg_color = $modality_theme_options['works_bg_color'];
	$works_header_color = $modality_theme_options['works_header_color'];
	$works_text_color = $modality_theme_options['works_text_color'];
	$works_button_color = $modality_theme_options['works_button_color'];
	/**
	* Features Section
	*/
	$features_bg_color = $modality_theme_options['features_bg_color'];
	$features_text_color = $modality_theme_options['features_text_color'];
	$features_title_color = $modality_theme_options['features_title_color'];
	/**
	* About Section
	*/
	$about_text_color = $modality_theme_options['about_text_color'];
	$about_bg_color = $modality_theme_options['about_bg_color'];
	$about_header_color = $modality_theme_options['about_header_color'];
	/**
	* Our Services Section
	*/
	$services_bg_color = $modality_theme_options['services_bg_color'];
	$services_title_color = $modality_theme_options['services_title_color'];
	$services_text_color = $modality_theme_options['services_text_color'];
	/**
	* Call To Action Section
	*/
	$testi_bg_color = $modality_theme_options['testi_bg_color'];
	$testi_sm_color = $modality_theme_options['testi_sm_color'];
	$testi_big_color = $modality_theme_options['testi_big_color'];
	/**
	* Content Boxes Section
	*/
	$cont_text_color = $modality_theme_options['cont_text_color'];
	$cont_bg_color = $modality_theme_options['cont_bg_color'];
	$cntbx_title_color = $modality_theme_options['cntbx_title_color'];
	/**
	* Get in Touch Section
	*/
	$getin_header_color = $modality_theme_options['getin_header_color'];
	$getin_text_color = $modality_theme_options['getin_text_color'];
	$getin_button_color = $modality_theme_options['getin_button_color'];
	$getin_bg_color = $modality_theme_options['getin_bg_color'];
	/**
	* Social Section
	*/
	$social_color = $modality_theme_options['social_color'];

	$output = '';

	/**
	 * General Settings
	 */
	if ( $theme_color )
	$output .= 'blockquote, address, .page-links a:hover, .post-format-wrap {border-color:' . $theme_color . '}' . "\n";
	$output .= '.meta span i, .more-link, .post-title h3:hover, #main .standard-posts-wrapper .posts-wrapper .post-single .text-holder-full .post-format-wrap p.link-text a:hover, .breadcrumbs .breadcrumbs-wrap ul li a:hover, #article p a, .navigation a, .link-post i.fa, .quote-post i.fa, #article .link-post p.link-text a:hover, .link-post p.link-text a:hover, .quote-post span.quote-author, .post-single ul.link-pages li a strong, .post-info span i, .footer-widget-col ul li a:hover, .sidebar ul.link-pages li.next-link a span, .sidebar ul.link-pages li.previous-link a span, .sidebar ul.link-pages li i, .row .row-item .service i.fa {color:' . $theme_color . '}' . "\n";
	$output .= 'input[type="submit"],button, .page-links a:hover {background:' . $theme_color . '}' . "\n";
	$output .= '.search-submit,.wpcf7-form-control,.main-navigation ul ul, .content-boxes .circle, .feature .circle, .section-title-right:after, .boxtitle:after, .section-title:after, .content-btn, #comments .form-submit #submit {background-color:' . $theme_color . '}' . "\n";

	if ( $scrollup_color )
	$output .= '.back-to-top {color:' . $scrollup_color . '}' . "\n";

	if ( $scrollup_hover_color )
	$output .= '.back-to-top i.fa:hover {color:' . $scrollup_hover_color . '}' . "\n";

	/**
	 * Logo Settings
	 */
	if ( $logo_width )
	$output .= '#logo {width:' . $logo_width . 'px }' . "\n";

	if ( $logo_height )
	$output .= '#logo {height:' . $logo_height . 'px }' . "\n";

	if ( $logo_top_margin )
	$output .= '#logo { margin-top:' . $logo_top_margin . 'px }' . "\n";

	if ( $logo_left_margin )
	$output .= '#logo { margin-left:' . $logo_left_margin . 'px }' . "\n";

	if ( $logo_bottom_margin )
	$output .= '#logo { margin-bottom:' . $logo_bottom_margin . 'px }' . "\n";

	if ( $logo_right_margin )
	$output .= '#logo { margin-right:' . $logo_right_margin . 'px }' . "\n";

	if ( $logo_uppercase == '1' )
	$output .= '#logo {text-transform: uppercase }' . "\n";

	if ( $google_font_logo )
	$output .= '#logo {font-family:"' . $google_font_logo . '",sans-serif}' . "\n";

	if ( $logo_font_size )
	$output .= '#logo {font-size:' . $logo_font_size . 'px }' . "\n";

	if ( $logo_font_weight )
	$output .= '#logo {font-weight:' . $logo_font_weight . '}' . "\n";

	if ( $text_logo_color )
	$output .= '#logo a {color:' . $text_logo_color . '}' . "\n";

	if ( $tagline_font_size )
	$output .= '#logo h5.site-description {font-size:' . $tagline_font_size . 'px }' . "\n";

	if ( $tagline_color )
	$output .= '#logo .site-description {color:' . $tagline_color . '}' . "\n";

	if ( $tagline_uppercase == '0' )
	$output .= '#logo .site-description {text-transform: none}' . "\n";

	if ( $tagline_uppercase == '1' )
	$output .= '#logo .site-description {text-transform: uppercase}' . "\n";

	/**
	 * Navigation Settings
	 */
	if ( $menu_top_margin )
	$output .= '#navbar {margin-top:'. $menu_top_margin .'px}' . "\n";

	if ( $google_font_menu )
	$output .= '#navbar ul li a {font-family:"' . $google_font_menu . '",sans-serif}' . "\n";

	if ( $nav_font_size )
	$output .= '#navbar ul li a {font-size:' . $nav_font_size . 'px}' . "\n";

	if ( $menu_uppercase == '1' )
	$output .= '#navbar ul li a {text-transform: uppercase;}' . "\n";

	if ( $nav_font_color )
	$output .= '.navbar-nav li a {color:' . $nav_font_color . '}' . "\n";

	if ( $nav_border_color )
	$output .= '.dropdown-menu {border-bottom: 5px solid ' . $nav_border_color . '}' . "\n";

	if ( $nav_bg_color )
		if ( $nav_bg_trans != '1')
		$output .= '.navbar-nav {background-color:' . $nav_bg_color . '}' . "\n";

	if ( $nav_bg_sub_color )
	$output .= '.dropdown-menu { background:'.$nav_bg_sub_color . '}' . "\n";

	if ( $nav_hover_font_color )
	$output .= '.navbar-nav li a:hover {color:' . $nav_hover_font_color . '}' . "\n";

	if ( $nav_bg_hover_color )
	$output .= '.navbar-nav ul li a:hover, .navbar-nav ul li a:focus, .navbar-nav ul li a.active, .navbar-nav ul li a.active-parent, .navbar-nav ul li.current_page_item a, #menu-navmenu li a:hover { background:' . $nav_bg_hover_color . '}' . "\n";

	if ( $nav_cur_item_color )
	$output .= '.active a { color:' . $nav_cur_item_color . ' !important}' . "\n";
	/**
	 * Typography Settings
	 */
	if ( $google_font_body != 'None' )
	$output .= 'body {font-family:"' . $google_font_body . '",sans-serif}' . "\n";

	if ( $body_font_size )
	$output .= 'body {font-size:' . $body_font_size . 'px !important}' . "\n";

	if ( $body_font_color )
	$output .= 'body {color:' . $body_font_color . '}' . "\n";
	/**
	 * Contact Settings
	 */
	if ( $header_bg_color )
	$output .= '#header-holder { background-color: ' . $header_bg_color . '}' . "\n";

	if ( $header_opacity )
	$output .= '#header-holder {opacity:'. $header_opacity .'}' . "\n";

	if ( $address_color )
	$output .= '#header-top .top-phone,#header-top p, #header-top a, #header-top i { color:' . $address_color . '}' . "\n";

	if ( $top_head_color )
	$output .= '#header-top { background-color: ' . $top_head_color . '}' . "\n";
	/**
	 * Image Slider
	 */
	if ( $slider_height )
	$output .= '.banner ul li { height:' . $slider_height . 'px;}' . "\n";

	if ( $captions_title_color )
	$output .= '.banner .inner h1 { color:' . $captions_title_color . '}' . "\n";

	if ( $captions_text_color )
	$output .= '.banner .inner p { color: ' . $captions_text_color . '}' . "\n";

	if ( $captions_button_color )
	$output .= '.banner .btn { color: ' . $captions_button_color . '}' . "\n";
	$output .= '.banner .btn { border-color: ' . $captions_button_color . '}' . "\n";

	if ( $captions_pos_left )
	$output .= '.banner .inner { padding-left: ' . $captions_pos_left . '%}' . "\n";

	if ( $captions_pos_top )
	$output .= '.banner .inner { padding-top: ' . $captions_pos_top . 'px}' . "\n";

	if ( $captions_width )
	$output .= '.banner .inner { width: ' . $captions_width . '%}' . "\n";
	/**
	 * Footer Settings
	 */
	if ( $footer_bg_color )
	$output .= '#footer { background-color:' . $footer_bg_color . '}' . "\n";

	if ( $copyright_bg_color )
	$output .= '#copyright { background-color:' . $copyright_bg_color . '}' . "\n";

	if ( $footer_widget_title_color )
	$output .= '.footer-widget-col h4 { color:' . $footer_widget_title_color . '}' . "\n";

	if ( $footer_widget_title_border_color )
	$output .= '.footer-widget-col h4 { border-bottom: 4px solid ' . $footer_widget_title_border_color . '}' . "\n";

	if ( $footer_widget_text_color )
	$output .= '.footer-widget-col a, .footer-widget-col { color:' . $footer_widget_text_color . '}' . "\n";

	if ( $footer_widget_text_border_color )
	$output .= '.footer-widget-col ul li { border-bottom: 1px solid ' . $footer_widget_text_border_color . '}' . "\n";

	if ( $footer_social_color )
	$output .= '#social-bar-footer ul li a i { color:' . $footer_social_color . '}' . "\n";
	/**
	 * Blog Settings
	 */
	if ($blog_posts_home_color)
	$output .= '.home-blog {background: none repeat scroll 0 0 ' . $blog_posts_home_color . '}' . "\n";

	if ($blog_meta_color)
	$output .= '.from-blog .post-info span a, .from-blog .post-info span {color:' . $blog_meta_color . ';}' . "\n";

	if ($blog_post_color)
	$output .= '.from-blog h3 {color:' . $blog_post_color . ';}' . "\n";

	if ($blog_title_color)
	$output .= '.from-blog h2 {color:' . $blog_title_color . ';}' . "\n";

	if ($blog_bg_color)
	$output .= '.from-blog {background: none repeat scroll 0 0 ' . $blog_bg_color . ';}' . "\n";

	if ($blog_posts_top_color)
	$output .= '.blog-top-image {background: none repeat scroll 0 0 ' . $blog_posts_top_color . ';}' . "\n";

	if ($blog_posts_top_font_color)
	$output .= '.blog-top-image h1.section-title, .blog-top-image h1.section-title-right {color:' . $blog_posts_top_font_color . ';}' . "\n";
	/**
	* Get Started Section
	*/

	if ($works_button_color)
	$output .= '.get-strated-button { background-color: ' . $works_button_color . '}' . "\n";

	if ($works_header_color)
	$output .= '#get-started h2 { color: ' . $works_header_color . '}' . "\n";

	if ($works_text_color)
	$output .= '.get-strated-left span { color: ' . $works_text_color . '}' . "\n";

	if ($works_bg_color)
	$output .= '#get-started { background: none repeat scroll 0 0 ' . $works_bg_color . '}' . "\n";
	/**
	* Features Section
	*/
	if ( $features_bg_color )
	$output .= '#features { background-color:' . $features_bg_color . ';}' . "\n";

	if ( $features_text_color )
	$output .= 'h4.sub-title, #features p { color:' . $features_text_color . ';}' . "\n";

	if ( $features_title_color )
	$output .= '#features .section-title, #features h3 { color:' . $features_title_color . ';}' . "\n";
	/**
	* About Section
	*/
	if ($about_text_color)
	$output .= '.about p {color:' . $about_text_color . ';}' . "\n";

	if ($about_header_color)
	$output .= '.about h2 {color:' . $about_header_color . ';}' . "\n";

	if ($about_bg_color)
	$output .= '.about {background: none repeat scroll 0 0 ' . $about_bg_color . ';}' . "\n";
	/**
	* Our Services Section
	*/
	if ( $services_bg_color )
	$output .= '#services { background-color:' . $services_bg_color . ';}' . "\n";

	if ( $services_title_color )
	$output .= '#services h2, #services h3 { color:' . $services_title_color . ';}' . "\n";

	if ( $services_text_color )
	$output .= '#services p { color:' . $services_text_color . ';}' . "\n";
	/**
	* Call To Action Section
	*/
	if ( $testi_big_color )
	$output .= '.cta h2 { color:' . $testi_big_color . ';}' . "\n";

	if ( $testi_sm_color )
	$output .= '.cta h4 { color:' . $testi_sm_color . ';}' . "\n";

	if ( $testi_bg_color )
	$output .= '.cta { background-color:' . $testi_bg_color . ';}' . "\n";
	/**
	* Content Boxes Section
	*/
	if ( $cntbx_title_color )
	$output .= '.content-boxes h4 { color:' . $cntbx_title_color . ';}' . "\n";

	if ($cont_text_color)
	$output .= '.content-boxes {color:' . $cont_text_color. '}' . "\n";

	if ($cont_bg_color)
	$output .= '.content-boxes {background: none repeat scroll 0 0 ' . $cont_bg_color . '}' . "\n";
	/**
	* Get in Touch Section
	*/
	if ($getin_bg_color)
	$output .= '.get-in-touch { background-color: ' . $getin_bg_color . '}' . "\n";

	if ($getin_header_color)
	$output .= '.get-in-touch h2.boxtitle {color:' . $getin_header_color . ';}' . "\n";

	if ($getin_text_color)
	$output .= '.get-in-touch h4.sub-title {color:' . $getin_text_color . ';}' . "\n";

	if ( $getin_button_color )
	$output .= '.git-link { color: ' . $getin_button_color . '}' . "\n";
	$output .= '.git-link { border-color: ' . $getin_button_color . '}' . "\n";
	/**
	* Social Section
	*/
	if ( $social_color )
	$output .= '.social { background-color: ' . $social_color . '}' . "\n";

	// Output styles
	if ( isset( $output ) && $output != '' ) {
		$output = strip_tags( $output );
		$output = "<!--Custom Styling-->\n<style media=\"screen\" type=\"text/css\">\n" . esc_html($output) . "</style>\n";
		echo $output;
	}
}
add_action('wp_head','modality_theme_custom_styling');

/**
 * Sanitization for checkbox input
 *
 * @param $input string (1 or empty) checkbox state
 * @return $output '1' or false
 */
function modality_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}

/**
 * Sanitization for font style
 */
function modality_sanitize_font_style( $value ) {
	$recognized = modality_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_font_style', current( $recognized ) );
}

/**
 * Sanitization for opacity value
 */
function modality_sanitize_opacity( $value ) {
	$recognized = modality_opacity();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_opacity', current( $recognized ) );
}

/**
 * Sanitization for layout value
 */
function modality_sanitize_theme_layout( $value ) {
	$recognized = modality_layout();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_layout', current( $recognized ) );
}

/**
 * Sanitization for navigation position
 */
function modality_sanitize_post_nav( $value ) {
	$recognized = modality_post_nav();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_post_nav', current( $recognized ) );
}

/**
 * Sanitization for post info position
 */
function modality_sanitize_post_info( $value ) {
	$recognized = modality_post_info();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_post_info', current( $recognized ) );
}

/**
 * Sanitization for blog content value
 */
function modality_sanitize_blog_content( $value ) {
	$recognized = modality_blog_content();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_blog_content', current( $recognized ) );
}

function modality_sanitize_cat ( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option ) ) {
		$output = $input;
	}
	return $output;
}

/**
 * Sanitization callback function
 */
function modality_sanitize_cb( $input ) {
	return wp_kses_post( $input );
}

/**
 * Sanitization to validate that the input value is an integer
 */
function modality_sanitize_number( $input ) {
	return absint( $input );
}

/**
 * Sanitization for image position
*/
function modality_sanitize_image_pos( $input ) {
	$valid = array(
       'left' => 'left',
        'right' => 'right',
        'center' => 'center',
	);

	if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function modality_sanitize_image_repeat( $input ) {
	$valid = array(
		'no-repeat' => 'no-repeat',
		'repeat' => 'repeat',
		'repeat-x' => 'repeat-x',
		'repeat-y' => 'repeat-y',
	);

	if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function modality_sanitize_email( $email ) {
	if(is_email( $email )){
		return $email;
	}else{
		return '';
	}
}

/**
 * Function for options that do not require sanitization.
 */
function modality_no_sanitize( $input ) {
}

function modality_font_styles() {
	$default = array(
		'Crimson Text' => 'Crimson Text',
		'Open Sans'	=> 'Open Sans',
		'sans-serif'	=> 'sans-serif',
		);
	return apply_filters( 'modality_font_styles', $default );
}

function modality_opacity() {
	$default = array(
		'1' => '1',
		'0.9'	=> '0.9',
		'0.8'	=> '0.8',
		'0.7'	=> '0.7',
		'0.6'	=> '0.6',
		'0.5'	=> '0.5',
		'0.4'	=> '0.4',
		'0.3'	=> '0.3',
		'0.2'	=> '0.2',
		'0.1'	=> '0.1',
		'0'	=> '0',
	);
	return apply_filters( 'modality_opacity', $default );
}

function modality_layout() {
	$default = array(
	'col1' => 'col1',
	'col2-l' => 'col2-l',
	'col2-r' =>'col2-r',
	);
	return apply_filters( 'modality_layout', $default );
}

function modality_blog_content() {
	$default = array(
	'excerpt' => 'excerpt',
	'full' => 'full',
	);
	return apply_filters( 'modality_blog_content', $default );
}

function modality_post_nav() {
	$default = array(
		'disable' => 'disable',
		'sidebar' => 'sidebar',
		'below' => 'below',
	);
	return apply_filters( 'modality_post_nav', $default );
}

function modality_post_info() {
	$default = array(
		'disable' => 'disable',
		'above' => 'above',
	);
	return apply_filters( 'modality_post_info', $default );
}

function modality_get_option_defaults() {
	$defaults = array(
		'theme_color' => '#777777',
		'breadcrumbs' => '1',
		'animation' => true,
		'responsive_design' => '1',
		'scrollup' => '1',
		'scrollup_color' => '#888888',
		'scrollup_hover_color' => '#FFFFFF',
		'logo_width' => '300',
		'logo_height' => '30',
		'logo_top_margin' => '8',
		'logo_left_margin' => '0',
		'logo_bottom_margin' => '0',
		'logo_right_margin' => '25',
		'logo' => get_template_directory_uri() . '/images/escope-logo-white.png',
		'logo_alt_text' => 'Logo',
		'logo_uppercase' => '1',
		'google_font_logo' => 'Crimson Text',
		'logo_font_size' => '24',
		'logo_font_weight' => '700',
		'text_logo_color' => '#ffffff',
		'enable_logo_tagline' => false,
		'tagline_font_size' => '16',
		'tagline_color' => '#ffffff',
		'tagline_uppercase' => '1',
		'menu_sticky' => '1',
		'menu_top_margin' => '0',
		'google_font_menu' => 'Open Sans',
		'nav_font_size' => '12',
		'menu_uppercase' => '1',
		'nav_font_color' => '#ffffff',
		'nav_border_color' => '#c9c9c9',
		'nav_bg_color' => '#1a1a1a',
		'nav_bg_trans' => '1',
		'nav_bg_sub_color' => '#1a1a1a',
		'nav_hover_font_color' => '#777777',
		'nav_bg_hover_color' => '#1a1a1a',
		'nav_cur_item_color' => '#777777',
		'google_font_body' => 'Crimson Text',
		'body_font_size' => '15',
		'body_font_color' => '#777777',
		'header_bg_color' => '#1a1a1a',
		'header_opacity' => '1',
		'contact_bg_image' => get_template_directory_uri() . '/images/bg/bg12.jpg',
		'contact_detail_enable' => '1',
		'contact_address' => '1234 Street Name, City Name, United States',
		'contact_phone' => '(123) 456-7890',
		'contact_email' => 'info@yourdomain.com',
		'contact_pricing_url' => '#',
		'address_color' => '#cccccc',
		'top_head_color' => '#252525',
		'image_slider_on' => '1',
		'works_section_on' => '1',
		'features_section_on' => '1',
		'about_section_on' => '1',
		'services_section_on' => '1',
		'testi_section_on' => '1',
		'content_boxes_section_on' => false,
		'getin_home_on' => '1',
		'products_section_on' => '1',
		'blog_section_on' => '1',
		'latest_posts_on' => '1',
		'social_section_on' => '1',
		'slider_info' => 'http://revolution.themepunch.com/',
		'slider_height' => '500',
		'image_slider_cat' => '',
		'slideshow_speed' => '5000',
		'animation_speed' => '800',
		'slider_num' => '3',
		'captions_on' => true,
		'captions_pos_left' => '0',
		'captions_pos_top' => '120',
		'captions_width' => '70',
		'captions_title_color' => '#ffffff',
		'captions_text_color' => '#ffffff',
		'captions_button_color' => '#ffffff',
		'captions_button' => '1',
		'caption_button_text' => 'Read More',
		'footer_logo' => get_template_directory_uri() . '/images/escope-logo-dark.png',
		'footer_bg_color' => '#FAFAFA',
		'copyright_bg_color' => '#111111',
		'footer_widget_title_color' => '#ffffff',
		'footer_widget_title_border_color' => '#444444',
		'footer_widget_text_color' => '#ffffff',
		'footer_widget_text_border_color' => '#444444',
		'footer_social_color' => '#ffffff',
		'footer_widgets' => '1',
		'footer_copyright_text' => 'Copyright '.date('Y').' '.get_bloginfo('site_title'),
		'layout_settings' => 'col1', /* col1:no-sidebar col2-l:right-sidebar col2-r:left-sidebar */
		'blog_posts_home_color' => '#ffffff',
		'blog_posts_home_image' => get_template_directory_uri() . '/images/bg/bg33.jpg',
		'blog_posts_top_color' => '#eeeeee',
		'blog_posts_top_font_color' => '#111111',
		'blog_section_header' => 'Blog',
		'blog_section_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'blog_tweet_account' => 'LumiaIndonesia',
		'blog_num_posts' => '6',
		'blog_cat_posts' => '',
		'blog_posts_top_image' => '',
		'blog_content' => 'excerpt',
		'blog_excerpt' => '50',
		'simple_paginaton' => false,
		'post_navigation' => 'sidebar',
		'post_info' => 'above',
		'featured_img_post' => '1',
		'products_section_header' => 'Latest Products',
		'products_section_text' => 'Choose from our shop',
		'works_bg_color' => '#252525',
		'works_header_color' => '#ffffff',
		'works_section_header' => 'Works',
		'works_text_color' => '#ffffff',
		'works_section_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'works_button_text' => 'Get Started',
		'works_button_color' => '#777777',
		'works_button_url' => '',
		'features_bg_color' => '#ffffff',
		'features_bg_image' => get_template_directory_uri() . '/images/bg/bg5.jpg',
		'features_title_color' => '#111111',
		'features_text_color' => '#111111',
		'features_section_title' => 'Featured Works',
		'features_section_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'features_instagram_acc' => 'vapeboss.id',
		'features_instagram_clientid' => '8c1144b4c5ba4cc3a56536e374e31e6b',
		'features_instagram_count' => '5',
		'feature_divider_text' => 'Working Process',
		'feature_one' => 'Concept',
		'feature_one_desc' => 'Lorem ipsum dolor sit',
		'feature_one_icon' => 'pe-7s-light',
		'feature_one_image' => '',
		'feature_one_url' => '',
		'feature_two' => 'Design',
		'feature_two_desc' => 'Lorem ipsum dolor sit',
		'feature_two_icon' => 'pe-7s-paint-bucket',
		'feature_two_image' => '',
		'feature_two_url' => '',
		'feature_three' => 'Development',
		'feature_three_desc' => 'Lorem ipsum dolor sit',
		'feature_three_icon' => 'pe-7s-paint',
		'feature_three_image' => '',
		'feature_three_url' => '',
		'feature_four' => 'Launch',
		'feature_four_desc' => 'Lorem ipsum dolor sit',
		'feature_four_icon' => 'pe-7s-paint',
		'feature_four_image' => '',
		'feature_four_url' => '',
		'about_bg_color' => '#eeeeee',
		'about_bg_image' => get_template_directory_uri() . '/images/bg/bg28.jpg',
		'about_section_image' => get_template_directory_uri() . '/images/photos/about-img1.jpg',
		'about_header_color' => '#111111',
		'about_section_header' => 'About Us',
		'about_text_color' => '#111111',
		'about_section_header_text' => 'We use strategy and design to connect brands and people through the things they love.',
		'about_section_text' => 'We are a creative, multi-disciplined web & digital design studio in Texas. We have a great understanding when it comes to designing and developing websites. We ensure everything we build has been optimised for smartphones, tablets & desktops.',
		'about_section_icon_one' => 'pe-7s-camera',
		'about_section_icon_two' => 'pe-7s-headphones',
		'about_section_icon_three' => 'pe-7s-science',
		'about_section_title_one' => 'What We Do',
		'about_section_title_two' => 'What We Love',
		'about_section_title_three' => 'What we believe in',
		'about_section_text_one' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'about_section_text_two' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'about_section_text_three' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'about_divider_icon_one' => 'pe-7s-phone',
		'about_divider_icon_two' => 'pe-7s-leaf',
		'about_divider_icon_three' => 'pe-7s-magic-wand',
		'about_divider_icon_four' => 'pe-7s-check',
		'about_divider_icon_five' => 'pe-7s-timer',
		'about_divider_title_one' => 'Responsive Design',
		'about_divider_title_two' => 'Clean Code',
		'about_divider_title_three' => 'Unique Design',
		'about_divider_title_four' => 'W3 Validated',
		'about_divider_title_five' => 'Faster Load Time',
		'about_divider_text_one' => 'Lorem ipsum dolor sit amet',
		'about_divider_text_two' => 'Lorem ipsum dolor sit amet',
		'about_divider_text_three' => 'Lorem ipsum dolor sit amet',
		'about_divider_text_four' => 'Lorem ipsum dolor sit amet',
		'about_divider_text_five' => 'Lorem ipsum dolor sit amet',
		'services_bg_color' => '#ffffff',
		'services_bg_image' => get_template_directory_uri() . '/images/bg/bg16.jpg',
		'services_title_color' => '#111111',
		'services_text_color' => '#777777',
		'services_section_title' => 'Services',
		'services_section_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'services_image' => get_template_directory_uri() . '/images/services-three-imacs.png',
		'service_one' => 'Web Development',
		'service_one_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_one_icon' => 'pe-7s-monitor',
		'service_two' => 'Logo Design',
		'service_two_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_two_icon' => 'pe-7s-box2',
		'service_three' => 'SEO',
		'service_three_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_three_icon' => 'pe-7s-search',
		'service_four' => 'Branding',
		'service_four_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_four_icon' => 'pe-7s-paint',
		'service_five' => 'Marketing',
		'service_five_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_five_icon' => 'pe-7s-network',
		'service_six' => '24/7 Support',
		'service_six_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_six_icon' => 'pe-7s-help2',
		'service_divider_one' => '12',
		'service_divider_one_duration' => '1500',
		'service_divider_one_icon' => 'pe-7s-stopwatch',
		'service_divider_one_text' => 'Years of Experience',
		'service_divider_two' => '1430',
		'service_divider_two_duration' => '4000',
		'service_divider_two_icon' => 'pe-7s-portfolio',
		'service_divider_two_text' => 'Projects Completed',
		'service_divider_three' => '146',
		'service_divider_three_duration' => '5500',
		'service_divider_three_icon' => 'pe-7s-smile',
		'service_divider_three_text' => 'Happy Clients',
		'service_divider_four' => '8572',
		'service_divider_four_duration' => '5500',
		'service_divider_four_icon' => 'pe-7s-coffee',
		'service_divider_four_text' => 'Cup of Coffee',
		'testi_bg_color' => '#eeeeee',
		'testi_bg_image' => get_template_directory_uri() . '/images/bg/bg2.jpg',
		'testi_author_one' => 'Jane Doe',
		'testi_author_one_title' => 'Developer',
		'testi_author_one_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
		'testi_author_one_image' => get_template_directory_uri() . '/images/testimonials/1.jpg',
		'testi_author_two' => 'John Doe',
		'testi_author_two_title' => 'Designer',
		'testi_author_two_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
		'testi_author_two_image' => get_template_directory_uri() . '/images/testimonials/2.jpg',
		'testi_author_three' => 'Devi Deva',
		'testi_author_three_title' => 'Web Developer',
		'testi_author_three_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
		'testi_author_three_image' => get_template_directory_uri() . '/images/testimonials/3.jpg',
		'testi_client_one_image' => get_template_directory_uri() . '/images/clients/1.png',
		'testi_client_two_image' => get_template_directory_uri() . '/images/clients/2.png',
		'testi_client_three_image' => get_template_directory_uri() . '/images/clients/3.png',
		'testi_client_four_image' => get_template_directory_uri() . '/images/clients/4.png',
		'testi_client_five_image' => get_template_directory_uri() . '/images/clients/5.png',
		'testi_client_six_image' => get_template_directory_uri() . '/images/clients/6.png',
		'testi_sm_color' => '#111111',
		'testi_section_big_header' => 'Creative People That Make Awesome Things',
		'testi_big_color' => '#111111',
		'testi_button_text' => 'Get in touch',
		'testi_button_url' => '',
		'cont_bg_color' => '#252525',
		'cntbx_bg_image' => '',
		'cntbx_title_color' => '#ffffff',
		'cont_text_color' => '#ffffff',
		'first_column_header' => 'Responsive Design',
		'first_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'first_column_image' => 'fa-tablet',
		'first_column_url' => '',
		'second_column_header' => 'High Quality',
		'second_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'second_column_image' => 'fa-umbrella',
		'second_column_url' => '',
		'third_column_header' => 'Tons of Features',
		'third_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'third_column_image' => 'fa-cog',
		'third_column_url' => '',
		'getin_bg_color' => '#eeeeee',
		'getin_bg_image' => '',
		'getin_header_color' => '#111111',
		'getin_section_header' => 'Get In Touch with Us',
		'getin_text_color' => '#111111',
		'getin_section_text' => 'If you have any questions, do not hesitate to contact us',
		'getin_button_text' => 'Contact us now',
		'getin_button_color' => '#111111',
		'getin_button_url' => '',
		'blog_bg_color' => '#ffffff',
		'blog_bg_image' => get_template_directory_uri() . '/images/bg/bg33.jpg',
		'blog_cat' => '',
		'num_posts' => '2',
		'blog_section_title' => 'Latest News',
		'blog_title_color' => '#111111',
		'blog_post_color' => '#111111',
		'blog_meta_color' => '#111111',
		'facebook_link' => '#',
		'twitter_link' => '#',
		'google_link' => '#',
		'linkedin_link' => '#',
		'instagram_link' => '#',
		'vimeo_link' => '#',
		'social_color' => '#eeeeee',
		'social_bg_image' => '',
	);
	return apply_filters( 'modality_get_option_defaults', $defaults );
}

function modality_get_options() {
    // Options API
    return wp_parse_args(
        get_option( 'modality_theme_options', array() ),
        modality_get_option_defaults()
    );
}
