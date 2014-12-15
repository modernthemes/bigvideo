<?php
/**
 * bigvideo admin functions
 *
 * @package bigvideo
 */
 
 
 /**
 * Enqueue scripts and styles. 
 */
 
 function bigvideo_admin_scripts() {  
 
 wp_enqueue_style( 'bigvideo-mb.YTPlayer_css', get_stylesheet_directory_uri() . '/css/mb.YTPlayer.css', array(), 'screen' );
 wp_enqueue_style( 'bigvideo-mb.YTPlayer_css_1', get_stylesheet_directory_uri() . '/video/mb.YTPlayer.css', array(), 'screen' );
   
}
add_action( 'wp_enqueue_scripts', 'bigvideo_admin_scripts' );


// admin area styling
function custom_colors() {
   echo '<style type="text/css">
          #setting-error-tgmpa {
			border-left: 4px solid #37b492;
			background: url(http://modernthemes.net/wp-content/uploads/2014/11/default_bg.png) repeat repeat #fff;
			padding: 15px 20px;
			}
		  #setting-error-tgmpa p {
			font-size: 14px;
			font-weight: 300 !important; 
			color: #404040;
			margin: 0;
		  }
		  #setting-error-tgmpa p strong {
			font-weight: 300 !important;
		  }
		  #setting-error-tgmpa p strong a {
			font-size: 14px !important;
			text-decoration: none !important;
			color: #37b492 !important;
			font-weight: 600 !important;
		  }
			
         </style>';
}

add_action('admin_head', 'custom_colors');

/**
 * Modern WordPress Help Notice
 */

add_action('admin_notices', 'example_admin_notice');

function example_admin_notice() {
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'example_ignore_notice') ) {
        echo '<div class="updated" style="border-left: 4px solid #7dc8ea; background: url(http://modernthemes.net/wp-content/uploads/2014/11/MWP_bg.png) repeat repeat #fff; padding: 15px 20px;"><p style="font-size: 14px; font-weight: 300;">'; 
        printf(__('Need help or customization for your WordPress website? <a style="text-decoration: none;" href="http://modernwp.net" target=_blank">Click here</a> to visit us at Modern WordPress | <a style="text-decoration: none;" href="%1$s">Close</a>'), '?example_nag_ignore=0');
        echo "</p></div>";
	}
}

add_action('admin_init', 'example_nag_ignore');

function example_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['example_nag_ignore']) && '0' == $_GET['example_nag_ignore'] ) {
             add_user_meta($user_id, 'example_ignore_notice', 'true', true);
	}
}


/**
 *TGM Plugin activation.
 */
require_once get_template_directory() . '/panel/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'bigvideo_recommend_plugin' ); 
function bigvideo_recommend_plugin() {
 
    $plugins = array(
        // Include plugin from the WordPress Plugin Repository
		array(
			'name' 		=> 'Advanced Custom Fields', // http://wordpress.org/plugins/advanced-custom-fields/
			'slug' 		=> 'advanced-custom-fields',
			'required' 	=> false
		),

		array(
			'name'		=> 'TinyMCE Advanced', // http://wordpress.org/plugins/tinymce-advanced/
			'slug'		=> 'tinymce-advanced',
			'required'	=> false
		),
		
		array(
			'name'		=> 'Black Studio TinyMCE Widget', // http://wordpress.org/plugins/black-studio-tinymce-widget/
			'slug'		=> 'black-studio-tinymce-widget',
			'required'	=> false
		),
		
		array(
			'name'		=> 'Shortcodes Ultimate', // http://wordpress.org/plugins/shortcodes-ultimate/
			'slug'		=> 'shortcodes-ultimate',
			'required'	=> false
		),
		
		array(
			'name'		=> 'WordPress SEO', // http://wordpress.org/plugins/wordpress-seo/
			'slug'		=> 'wordpress-seo',
			'required'	=> false
		)        
    );
 
    tgmpa( $plugins);
 
} 