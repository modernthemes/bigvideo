<?php
/**
 * bigvideo Theme Customizer
 *
 * @package bigvideo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function bigvideo_theme_customizer( $wp_customize ) {
	
	//allows donations
    class bigvideo_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() {
        ?>

        <?php
        }
    }	
	
	// Donations
    $wp_customize->add_section(
        'bigvideo_theme_info',
        array(
            'title' => __('Like Big Video? Help Us Out.', 'bigvideo'),
            'priority' => 5, 
            'description' => __('We do all we can do to make all our themes free for you. While we enjoy it, and it makes us happy to help out, a little appreciation can help us to keep theming.</strong><br/><br/> Please help support our mission and continued development with a donation of $5, $10, $20, or if you are feeling really kind $100..<br/><br/> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7LMGYAZW9C5GE" target="_blank" rel="nofollow"><img class="" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" alt="Make a donation to ModernThemes" /></a>'), 
        )
    );  
	 
    //Donations section
    $wp_customize->add_setting('bigvideo_help', array(   
			'sanitize_callback' => 'bigvideo_no_sanitize', 
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new bigvideo_Info( $wp_customize, 'bigvideo_help', array(
        'section' => 'bigvideo_theme_info', 
        'settings' => 'bigvideo_help', 
        'priority' => 10
        ) )
    ); 
	
	// Fonts  
    $wp_customize->add_section(
        'bigvideo_typography',
        array(
            'title' => __('Google Fonts', 'bigvideo' ),
            'priority' => 39,    
        )
    );
	
    $font_choices = 
        array(
			'Montserrat:400,700' => 'Montserrat',
            'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Raleway:400,700' => 'Raleway',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',     
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Oswald:400,700' => 'Oswald',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'bigvideo_sanitize_fonts',
        )
    );
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
            'description' => __('Select your desired font for the headings. Montserrat is the default Heading font.', 'bigvideo'),
            'section' => 'bigvideo_typography',
            'choices' => $font_choices
        )
    );
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'bigvideo_sanitize_fonts',
        )
    );
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
            'description' => __( 'Select your desired font for the body. Source Sans Pro is the default Body font.', 'bigvideo' ), 
            'section' => 'bigvideo_typography',  
            'choices' => $font_choices 
        ) 
    );
	
	//Animations
	$wp_customize->add_section( 'bigvideo_animations' , array(  
	    'title'       => __( 'Animations', 'bigvideo' ),
	    'priority'    => 22, 
	    'description' => 'We can make things fly across the screen.',
	) );
	
    $wp_customize->add_setting(
        'bigvideo_animate',
        array(
            'sanitize_callback' => 'bigvideo_sanitize_checkbox',
            'default' => 0,
        )       
    );
    $wp_customize->add_control( 
        'bigvideo_animate',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box if you want to disable the animations.', 'bigvideo'),
            'section' => 'bigvideo_animations',  
            'priority' => 1,           
        )
    );

	// Logo upload
    $wp_customize->add_section( 'bigvideo_logo_section' , array(  
	    'title'       => __( 'Logo and Icons', 'bigvideo' ),
	    'priority'    => 25,
	    'description' => 'Upload a logo to replace the default site name and description in the header. Also, upload your site favicon and Apple Icons.',
	) );

	$wp_customize->add_setting( 'bigvideo_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bigvideo_logo', array(
		'label'    => __( 'Logo', 'bigvideo' ),
		'section'  => 'bigvideo_logo_section', 
		'settings' => 'bigvideo_logo',
		'priority' => 1,
	) ) );
	
	// Logo Width
	$wp_customize->add_setting( 'logo_size', 
	array(
	    'sanitize_callback' => 'bigvideo_sanitize_text',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'logo_size', array( 
		'label'    => __( 'Change the width of the Logo in PX', 'bigvideo' ),
		'description'    => __( 'Only enter numeric value', 'bigvideo' ), 
		'section'  => 'bigvideo_logo_section', 
		'settings' => 'logo_size',   
		'priority'   => 2
	) ) );
	
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default' => (get_stylesheet_directory_uri() . '/images/favicon.png'),
			'sanitize_callback' => 'esc_url_raw',
		) 
	);
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
               'label'          => __( 'Upload your favicon (16x16 pixels)', 'bigvideo' ),
			   'type' 			=> 'image',
               'section'        => 'bigvideo_logo_section',
               'settings'       => 'site_favicon',
               'priority' => 2,
            )
        )
    );
    //Apple touch icon 144
    $wp_customize->add_setting(
        'apple_touch_144',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_144',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (144x144 pixels)', 'bigvideo' ),
               'type'           => 'image',
               'section'        => 'bigvideo_logo_section',
               'settings'       => 'apple_touch_144',
               'priority'       => 11,
            )
        )
    );
    //Apple touch icon 114
    $wp_customize->add_setting(
        'apple_touch_114',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw', 
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_114',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (114x114 pixels)', 'bigvideo' ),
               'type'           => 'image',
               'section'        => 'bigvideo_logo_section',
               'settings'       => 'apple_touch_114',
               'priority'       => 12,
            )
        )
    );
    //Apple touch icon 72
    $wp_customize->add_setting(
        'apple_touch_72',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_72',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (72x72 pixels)', 'bigvideo' ),
               'type'           => 'image',
               'section'        => 'bigvideo_logo_section',
               'settings'       => 'apple_touch_72',
               'priority'       => 13,
            )
        )
    );
    //Apple touch icon 57
    $wp_customize->add_setting(
        'apple_touch_57',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_57',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (57x57 pixels)', 'bigvideo' ),
               'type'           => 'image',
               'section'        => 'bigvideo_logo_section',
               'settings'       => 'apple_touch_57',
               'priority'       => 14,
            )
        )
    );

	// Highlight and link color
    $wp_customize->add_setting( 'bigvideo_link_color', array(
        'default'           => ' ',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bigvideo_link_color', array(
        'label'	   => 'Link and Highlight Color',
        'section'  => 'colors',
        'settings' => 'bigvideo_link_color', 
    ) ) );
		
	// Front Page
	$wp_customize->add_section( 'frontpage-custom' , array(
    	'title' => __( 'Front Page Options', 'bigvideo' ),
    	'priority' => 30, 
    	'description' => __( 'Customize your front page area. Remember most of your front page custom options are located in the widgets area.', 'bigvideo' )
	) );
	
	// hide overlay section
	$wp_customize->add_setting('active_overlay',
	array(
	        'sanitize_callback' => 'bigvideo_sanitize_checkbox',
	    ) 
	);    
	
	$wp_customize->add_control( 
    'active_overlay', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Overlay Section',  
        'section' => 'frontpage-custom',
		'priority'   => 1
    ));
	
	// hide intro section
	$wp_customize->add_setting('active_intro',
	array(
	        'sanitize_callback' => 'bigvideo_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_intro', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Intro Section',  
        'section' => 'frontpage-custom',
		'priority'   => 2
    ));
	
	// hide collections section
	$wp_customize->add_setting('active_collections',
	array(
	        'sanitize_callback' => 'bigvideo_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_collections', 
    array(
        'type' => 'checkbox', 
        'label' => 'Hide Collections Section',
        'section' => 'frontpage-custom',
		'priority'   => 3
    ));
	
	// hide call to action section
	$wp_customize->add_setting('active_button',
	array(
	        'sanitize_callback' => 'bigvideo_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_button', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Call-to-Action Button',  
        'section' => 'frontpage-custom',
		'priority'   => 4
    ));
	
	// hide before footer section
	$wp_customize->add_setting('active_before_footer',
	array(
	        'sanitize_callback' => 'bigvideo_sanitize_checkbox',
	    ) 
	); 
	
	$wp_customize->add_control( 
    'active_before_footer', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Before Footer Section',  
        'section' => 'frontpage-custom',
		'priority'   => 5
    ));
	
	// Intro Picture
	$wp_customize->add_setting( 'bigvideo_intro_picture', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bigvideo_intro_picture', array(
		'label'    => __( 'Intro Section Picture', 'bigvideo' ),
		'section'  => 'frontpage-custom', 
		'settings' => 'bigvideo_intro_picture',
		'priority' => 6
	) ) );
	
	// Before Footer Picture
	$wp_customize->add_setting( 'bigvideo_bf_picture', array(
		'sanitize_callback' => 'esc_url_raw', 
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bigvideo_bf_picture', array(
		'label'    => __( 'Before Footer Picture', 'bigvideo' ),
		'section'  => 'frontpage-custom', 
		'settings' => 'bigvideo_bf_picture', 
		'priority' => 7
	) ) );
	
	// Front Page Link
	$wp_customize->add_setting( 'bigvideo_ctalink', 
	array( 
		'default' => 'All Collections',
	    'sanitize_callback' => 'bigvideo_sanitize_int', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bigvideo_ctalink', array(
	'default' => 'All Collections',
    'label' => __( 'Front Page Call-to-Action Text', 'bigvideo' ),
    'section' => 'frontpage-custom',
    'settings' => 'bigvideo_ctalink',
	'priority'   => 8 
	) ) ); 
	
	// Page header background
    $wp_customize->add_section( 'bigvideo_header_background' , array(  
	    'title'       => __( 'Default Page Options', 'bigvideo' ),
	    'priority'    => 35,
	    'description' => 'Upload a file to display as the fallback for the header background of your pages',
	) );

	$wp_customize->add_setting( 'bigvideo_headerbg', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bigvideo_headerbg', array( 
		'label'    => __( 'Page Header Background', 'bigvideo' ),
		'section'  => 'bigvideo_header_background', 
		'settings' => 'bigvideo_headerbg', 
	) ) );
	
	// Page Drop Downs
	 $wp_customize->add_setting('bigvideo_ctalink_url', 
	 array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'bigvideo_sanitize_int' 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bigvideo_cta_url', array( 
    'label' => __( 'Front Page Call-to-Action URL', 'bigvideo' ),
    'section' => 'frontpage-custom', 
	'type' => 'dropdown-pages',
    'settings' => 'bigvideo_ctalink_url',    
	) ) );
	
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => __( 'Footer Options', 'bigvideo' ),  
    	'priority' => 36, 
    	'description' => __( 'Customize your footer area', 'bigvideo' ) 
	) );
	
	// Footer Byline Text
	$wp_customize->add_setting( 'bigvideo_footerid', 
	array(
	    'sanitize_callback' => 'bigvideo_sanitize_text',
	) );
	   
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bigvideo_footerid', array(
    'label' => __( 'Footer Byline Text', 'bigvideo' ),
    'section' => 'footer-custom',
    'settings' => 'bigvideo_footerid', 
	) ) ); 

    // Choose excerpt or full content on blog
    $wp_customize->add_section( 'bigvideo_layout_section' , array( 
	    'title'       => __( 'Layout', 'bigvideo' ),
	    'priority'    => 37,
	    'description' => 'Change how bigvideo displays posts',
	) ); 

	$wp_customize->add_setting( 'bigvideo_post_content', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'bigvideo_sanitize_index_content', 
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bigvideo_post_content', array(
		'label'    => __( 'Post content', 'bigvideo' ),
		'section'  => 'bigvideo_layout_section',
		'settings' => 'bigvideo_post_content',
		'type'     => 'radio',
		'choices'  => array(
			'option1' => 'Excerpts',
			'option2' => 'Full content', 
			),
	) ) );
	
	//Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
        )       
    );
    $wp_customize->add_control( 'exc_length', array( 
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'bigvideo_layout_section',
        'label'       => __('Excerpt length', 'bigvideo'),
        'description' => __('Choose your excerpt length here. Default: 30 words', 'bigvideo'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ), 
    ) );  

	// Set site name and description to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 10;
	$wp_customize->get_section('nav')->priority = 11;  

	// Enqueue scripts for real-time preview
	wp_enqueue_script( 'bigvideo-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ) );
 

}
add_action('customize_register', 'bigvideo_theme_customizer'); 


/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function bigvideo_sanitize_hex_color( $color ) {
	if ( '#FF0000' === $color ) 
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}

//Integers
function bigvideo_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
//Text
function bigvideo_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//Checkboxes 
function bigvideo_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {  
		return 1;
	} else {
		return '';
	}
}

//Sanitizes Fonts 
function bigvideo_sanitize_fonts( $input ) {  
    $valid = array(
            'Montserrat:400,700' => 'Montserrat',
            'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Raleway:400,700' => 'Raleway',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',     
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Oswald:400,700' => 'Oswald',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt', 
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
} 

/**
 * Sanitizes our post content value (either excerpts or full post content).
 *
 * @since 1.7
 */
function bigvideo_sanitize_index_content( $content ) {
	if ( 'option2' == $content ) {
		return 'option2';
	} else {
		return 'option1';
	}
}

//No sanitize 
function bigvideo_no_sanitize( $input ) {
}

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function bigvideo_add_customizer_css() {
	$color = bigvideo_sanitize_hex_color( get_theme_mod( 'bigvideo_link_color' ) );
	?>
	<!-- bigvideo customizer CSS -->
	<style>
	
		body {
			border-color: <?php echo $color; ?>;
		}
		.post-navigation span { background: <?php echo $color; ?>; } 
		a, a:hover, a:active, .fa:hover, .widget-area a, .site-header a, .entry-meta a  {
			color: <?php echo $color; ?>;
		}
		
	</style>
<?php }
add_action( 'wp_head', 'bigvideo_add_customizer_css' );