<?php
/**
 * bigvideo functions and definitions
 *
 * @package bigvideo
 */

/**
 * Theme updater 
 */ 
require_once('inc/wp-updates-theme.php'); 
new WPUpdatesThemeUpdater_907( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );
  
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'bigvideo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bigvideo_setup() { 

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on bigvideo, use a find and replace
	 * to change 'bigvideo' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bigvideo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' ); 
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails', array( 'post', 'collection',  ) ); 
	add_theme_support( 'post-thumbnails' ); 
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bigvideo' ),
	) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form', 
		'gallery',
	) );
	}
	endif; // bigvideo_setup
	add_action( 'after_setup_theme', 'bigvideo_setup' );

	/**
	* Allow SVG files. You're welcome. 
	*/

	function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
	}
	add_filter( 'upload_mimes', 'cc_mime_types' );

	/**
	 * Register your google fonts
	 */
	
	function load_fonts() {
            wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:300,600');
            wp_enqueue_style( 'googleFonts'); 
        }
    
    add_action('wp_print_styles', 'load_fonts');
	
	/**
	* Register Font Awesome
	*/
	
	add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );
	/**
	* Register and load font awesome CSS files using a CDN.
	*
	* @link http://www.bootstrapcdn.com/#fontawesome
	* @author FAT Media
	*/
	function prefix_enqueue_awesome() {
	wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' ); 
	}  

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bigvideo_custom_background_args', array(
		'default-color' => '000',
		'default-image' => '',
	) ) );

	/**
 	* Register widget area.
 	*
 	* @link http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	function bigvideo_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bigvideo' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>', 
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar(array(
			'name' => __( 'Video Overlay Text', 'bigvideo'),
			'id' => 'overlay-text',
			'description' => __( 'Widgets here will be placed as the video overlay text', 'bigvideo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
			'after_widget' => '</aside><a data-scroll href="#collections"><i class="fa fa-angle-down home-arrow"></i></a>',
			'before_title' => '<h2>', 
			'after_title' => '</h2>'
	) );
	
	register_sidebar(array(
			'name' => __( 'Home Page Introduction', 'bigvideo'),
			'id' => 'intro-area',
			'description' => __( 'This widget area will populate the introduction section on the home page', 'bigvideo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="wow fadeInLeft">',
			'after_title' => '</h3>' 
	) );
	
	register_sidebar(array(
			'name' => __( 'Home Page Featured Widgets', 'bigvideo'),
			'id' => 'home-middle-widgets',
			'description' => __( 'Place your featured widgets here and they will populate on the home page.  Its like magic split into 3 columns.  But make sure there are three.', 'bigvideo' ),
			'before_widget' => '<div class="col-1-3 featured-pad wow fadeInUp home-work"><aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside></div>',  
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
	) );
	
	register_sidebar(array(
			'name' => __( 'Home Page Before Footer', 'bigvideo'),
			'id' => 'home-before-footer',
			'description' => __( 'This is where your content will go for the section before the footer', 'bigvideo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="wow fadeInRight">', 
			'after_title' => '</h3>'
	) );
	
	//Register the sidebar widgets   
	register_widget( 'bigvideo_Video_Widget' );
	register_widget( 'bigvideo_Contact_Info' );
	
	}
	add_action( 'widgets_init', 'bigvideo_widgets_init' );

	/**
 	* Enqueue scripts and styles. 
 	*/
	function bigvideo_scripts() { 
	wp_enqueue_style( 'bigvideo-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts'));
	
		if( $headings_font ) {
		wp_enqueue_style( 'bigvideo-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
		} else {
		wp_enqueue_style( 'bigvideo-montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700');
		}
		if( $body_font ) {
		wp_enqueue_style( 'bigvideo-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );
		} else {
		wp_enqueue_style( 'bigvideo-source-sans', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,600');
		} 
		
	if ( file_exists( get_stylesheet_directory_uri() . '/inc/my_style.css' ) ) {
	wp_enqueue_style( 'bigvideo-mystyle', get_stylesheet_directory_uri() . '/inc/my_style.css', array(), false, false );
		} 
		
	wp_enqueue_style( 'bigvideo-menustyle', get_stylesheet_directory_uri() . '/css/jPushMenu.css', array(), '1.0' );

	if ( is_admin() ) {
		wp_enqueue_style( 'bigvideo-codemirror', get_stylesheet_directory_uri() . '/css/codemirror.css', array(), '1.0' );
		}

	if ( get_theme_mod('bigvideo_animate') != 1 ) {
		
		wp_enqueue_script( 'bigvideo-wow', get_template_directory_uri() . '/js/wow.js', array('jquery'), true ); 
		wp_enqueue_style( 'bigvideo-animation-css', get_stylesheet_directory_uri() . '/css/animation.css', array() );
		wp_enqueue_style( 'bigvideo-animate-css', get_stylesheet_directory_uri() . '/css/animate.css', array() );
		wp_enqueue_script( 'bigvideo-wow-init', get_template_directory_uri() .  '/js/wow-init.js', array( 'jquery' ), true );
	}
  
	wp_enqueue_script( 'bigvideo-jPushMenu.js', get_template_directory_uri() . '/js/jPushMenu.js', array('jquery'), false, false ); 
	wp_enqueue_script( 'bigvideo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true ); 
	wp_enqueue_script( 'bigvideo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'bigvideo-mb.YTPlayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.js', array('jquery'), false, true, 1);
	
	wp_enqueue_script( 'bigvideo-slider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), true );
	wp_enqueue_script( 'bigvideo-codemirrorJS', get_template_directory_uri() . '/js/codemirror.js', array(), false, true);
	wp_enqueue_script( 'bidvideo-cssJS', get_template_directory_uri() . '/js/css.js', array(), false, true);
	wp_enqueue_script( 'bidvideo-placeholder', get_template_directory_uri() . '/js/jquery.placeholder.js', array('jquery'), false, true);
 	wp_enqueue_script( 'bidvideo-placeholdertext', get_template_directory_uri() . '/js/placeholdertext.js', array('jquery'), false, true); 
	
	if ( is_page_template( 'page-contact.php' ) ) {  
	wp_enqueue_script( 'bidvideo-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'bidvideo-verif', get_template_directory_uri() . '/js/verify.js', array('jquery'), false, true);  
	}
	
	wp_enqueue_script( 'bigvideo-bigvideoscripts', get_template_directory_uri() . '/js/bvscripts.js', array('jquery'), true ); 
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bigvideo_scripts' );

/**
 * Load html5shiv
 */
function bigvideo_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'bigvideo_html5shiv' );

/**
 * Change the excerpt length
 */
function bigvideo_excerpt_length( $length ) {
	
	$excerpt = get_theme_mod('exc_length', '30'); 
	return $excerpt; 

}

add_filter( 'excerpt_length', 'bigvideo_excerpt_length', 999 ); 
 			
/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php'; 

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php'; 

/**
 * Let's Read More 
 */
function excerpt_read_more_link($output) {
 global $post;
 return $output . '<a href="'. get_permalink($post->ID) . '"><button class="read-more">Read More</button></a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link'); 
								
/**
 * register the cool youtube video background files 
 */
require get_template_directory() . '/video/mbYTPlayer-admin.php'; 

/**
 * Include custom post types
 */
require get_template_directory() . '/inc/collection.php';

/**
 * Include admin panel files
 */
require get_template_directory() . '/panel/functions-admin.php';

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php'; 

/**
 * Include additional custom features.
 */
require get_template_directory() . '/inc/socialicons.php'; 
require get_template_directory() . '/inc/my-custom-css.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php'; 

/**
 * register your custom widgets
 */
require get_template_directory() . "/widgets/collection-widget.php";
require get_template_directory() . "/widgets/contact-info.php";
require get_template_directory() . "/widgets/video-widget.php"; 

/**
 * Custom Post Display Functions
 */

add_filter('excerpt_length', 'my_excerpt_length');
 
function my_excerpt_length($length) {
 
    return 25;
}
 
add_filter('excerpt_more', 'new_excerpt_more');  
 
function new_excerpt_more($text){ 
 
    return '';
}

/**
 * Include all custom post types here (one custom post type per file)
 */

if ( function_exists( 'add_theme_support' ) ) {
   add_theme_support('post-thumbnails', array( 'post', 'page', 'bv_collection_post', 'collection') ); 
    set_post_thumbnail_size( 800, 600, true ); // Normal post thumbnails
    add_image_size( 'screen-shot', 800, 600 ); // Full size screen 
}

function portfolio_thumbnail_url($pid){
    $image_id = get_post_thumbnail_id($pid); 
    $image_url = wp_get_attachment_image_src($image_id,'screen-shot'); 
    return  $image_url[0]; 
}

// Youtube Video Player time...

define("MBYTPLAYER_VERSION", "1.8.9");


function isMobile()
{
// Check the server headers to see if they're mobile friendly
    if (isset($_SERVER["HTTP_X_WAP_PROFILE"])) {
        return true;
    }
// If the http_accept header supports wap then it's a mobile too
    if (preg_match("/wap.|.wap/i", $_SERVER["HTTP_ACCEPT"])) {
        return true;
    }
    if (preg_match("/iphone|ipad/i", $_SERVER["HTTP_USER_AGENT"])) {
        return true;
    }
// None of the above? Then it's probably not a mobile device.
    return false;
}

function mbYTPlayer_install()
{
// add and update our default options upon activation
    update_option('mbYTPlayer_version', MBYTPLAYER_VERSION);
    add_option('mbYTPlayer_donate', 'false');
    add_option('mbYTPlayer_home_video_url', '');
    add_option('mbYTPlayer_show_controls', 'false');
    add_option('mbYTPlayer_show_videourl', 'false');
    add_option('mbYTPlayer_mute', 'false');
    add_option('mbYTPlayer_start_at', 'false');
    add_option('mbYTPlayer_stop_at', 'false');
    add_option('mbYTPlayer_ratio', '16/9');
    add_option('mbYTPlayer_loop', 'false');
    add_option('mbYTPlayer_opacity', '1');
    add_option('mbYTPlayer_quality', 'default');
    add_option('mbYTPlayer_add_raster', 'false');
    add_option('mbYTPlayer_track_ga', 'true');
    add_option('mbYTPlayer_stop_onclick', 'false');
    add_option('mbYTPlayer_realfullscreen', 'true');
}
register_activation_hook(__FILE__, 'mbYTPlayer_install');

$mbYTPlayer_donate = get_option('mbYTPlayer_donate');
$mbYTPlayer_home_video_url = get_option('mbYTPlayer_home_video_url');
$mbYTPlayer_version = get_option('mbYTPlayer_version');
$mbYTPlayer_show_controls = get_option('mbYTPlayer_show_controls');
$mbYTPlayer_show_videourl = get_option('mbYTPlayer_show_videourl');
$mbYTPlayer_ratio = get_option('mbYTPlayer_ratio');
$mbYTPlayer_mute = get_option('mbYTPlayer_mute');
$mbYTPlayer_start_at = get_option('mbYTPlayer_start_at');
$mbYTPlayer_stop_at = get_option('mbYTPlayer_stop_at');
$mbYTPlayer_loop = get_option('mbYTPlayer_loop');
$mbYTPlayer_opacity = get_option('mbYTPlayer_opacity');
$mbYTPlayer_quality = get_option('mbYTPlayer_quality');
$mbYTPlayer_add_raster = get_option('mbYTPlayer_add_raster');
$mbYTPlayer_track_ga = get_option('mbYTPlayer_track_ga');
$mbYTPlayer_realfullscreen = get_option('mbYTPlayer_realfullscreen');

$mbYTPlayer_stop_onclick = get_option('mbYTPlayer_stop_onclick');

//set up defaults if these fields are empty
if ($mbYTPlayer_version != MBYTPLAYER_VERSION) {
    $mbYTPlayer_version = MBYTPLAYER_VERSION;
}
if (empty($mbYTPlayer_donate)) {
    $mbYTPlayer_donate = "false";
}
if (empty($mbYTPlayer_show_controls)) {
    $mbYTPlayer_show_controls = "false";
}
if (empty($mbYTPlayer_show_videourl)) {
    $mbYTPlayer_show_videourl = "false";
}
if (empty($mbYTPlayer_ratio)) {
    $mbYTPlayer_ratio = "auto";
}
if (empty($mbYTPlayer_mute)) {
    $mbYTPlayer_mute = "false";
}
if (empty($mbYTPlayer_start_at)) {
    $mbYTPlayer_start_at = 0;
}
if (empty($mbYTPlayer_stop_at)) {
    $mbYTPlayer_stop_at = 0;
}

if (empty($mbYTPlayer_loop)) {
    $mbYTPlayer_loop = "false";
}
if (empty($mbYTPlayer_opacity)) {
    $mbYTPlayer_opacity = "1";
}
if (empty($mbYTPlayer_quality)) {
    $mbYTPlayer_quality = "default";
}
if (empty($mbYTPlayer_add_raster)) {
    $mbYTPlayer_add_raster = "false";
}
if (empty($mbYTPlayer_track_ga)) {
    $mbYTPlayer_add_raster = "true";
}
if (empty($mbYTPlayer_stop_onclick)) {
    $mbYTPlayer_stop_onclick = "false";
}
if (empty($mbYTPlayer_realfullscreen)) {
    $mbYTPlayer_realfullscreen = "true";
}

//action link http://www.wpmods.com/adding-plugin-action-links

function mbYTPlayer_action_links($links, $file)
{
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    // check to make sure we are on the correct plugin
    if ($file == $this_plugin) {
        // the anchor tag and href to the URL we want. For a "Settings" link, this needs to be the url of your settings page
        $settings_link = '<a href="' . site_url() . '/wp-admin/options-general.php?page=wpmbytplayer/mbYTPlayer-admin.php">Settings</a>';
        // add the link to the list
        array_unshift($links, $settings_link); 
    }

    return $links;
}

add_filter('plugin_action_links', 'mbYTPlayer_action_links', 10, 2);


// scripts to go in the header and/or footer
function mbYTPlayer_init()
{
    global $mbYTPlayer_version;

    load_plugin_textdomain('mbYTPlayer', false, basename( dirname( __FILE__ ) ) . '/languages/' );

    if (isset($_COOKIE['ytpdonate']) && $_COOKIE['ytpdonate'] !== "false") {
        update_option('mbYTPlayer_donate', "true");
        echo '
            <script type="text/javascript">
                expires = "; expires= -10000";
                document.cookie = "ytpdonate=false" + expires + "; path=/";
            </script>
        ';
    }
 
}
add_action('wp_enqueue_scripts', 'mbYTPlayer_init');

function mbYTPlayer_player_head()
{
    global $mbYTPlayer_home_video_url, $mbYTPlayer_show_controls, $mbYTPlayer_ratio, $mbYTPlayer_show_videourl, $mbYTPlayer_start_at, $mbYTPlayer_stop_at, $mbYTPlayer_mute, $mbYTPlayer_loop, $mbYTPlayer_opacity, $mbYTPlayer_quality, $mbYTPlayer_add_raster, $mbYTPlayer_track_ga,$mbYTPlayer_realfullscreen, $mbYTPlayer_stop_onclick;

    if (isMobile())
        return false;

    if ($mbYTPlayer_stop_onclick == "true")
        $mbYTPlayer_stop_onclick = "true";
    else
        $mbYTPlayer_stop_onclick = "false";

    echo '
	<!-- mbYTPlayer -->
	<script type="text/javascript">

    function onYouTubePlayerAPIReady() {
    	if(ytp.YTAPIReady)
		    return;
	    ytp.YTAPIReady=true;
	    jQuery(document).trigger("YTAPIReady");
    }

    jQuery.mbYTPlayer.rasterImg ="' . plugins_url('/images/', __FILE__) . 'raster.png";
	jQuery.mbYTPlayer.rasterImgRetina ="' . plugins_url('/images/', __FILE__) . 'raster@2x.png";

	jQuery(function(){
        jQuery(".mbYTPMovie").mb_YTPlayer()
	});

	</script>
	<!-- end mbYTPlayer -->
	';

    if ((is_home() || is_front_page()) && !isMobile()) {

        if (empty($mbYTPlayer_home_video_url))
            return false;

        $vids = explode(',', $mbYTPlayer_home_video_url);
        $n = rand(0, count($vids)-1);
        $mbYTPlayer_home_video_url_revised = $vids[$n];

        $mbYTPlayer_start_at = $mbYTPlayer_start_at > 0 ? $mbYTPlayer_start_at : 1;
        $mbYTPlayer_player_homevideo = '<div id=\"bgndVideo_home\" data-property=\"{videoURL:\'' . $mbYTPlayer_home_video_url_revised . '\', opacity:' . $mbYTPlayer_opacity . ', autoPlay:true, containment:\'body\', startAt:' . $mbYTPlayer_start_at . ', stopAt:' . $mbYTPlayer_stop_at . ', mute:' . $mbYTPlayer_mute . ', optimizeDisplay:true, showControls:' . $mbYTPlayer_show_controls . ', printUrl:' . $mbYTPlayer_show_videourl . ', loop:' . $mbYTPlayer_loop . ', addRaster:' . $mbYTPlayer_add_raster . ', quality:\'' . $mbYTPlayer_quality . '\', ratio:\'' . $mbYTPlayer_ratio . '\', realfullscreen:\'' . $mbYTPlayer_realfullscreen . '\', stopMovieOnClick:\'' . $mbYTPlayer_stop_onclick . '\', gaTrack:\'' . $mbYTPlayer_track_ga . '\'}\"></div>';
        echo '
	<!-- mbYTPlayer Home -->
	<script type="text/javascript">
	jQuery(function(){
	    var homevideo = "' . $mbYTPlayer_player_homevideo . '";
	    jQuery("body").prepend(homevideo);
	    jQuery("#bgndVideo_home").mb_YTPlayer();
    });

	</script>
	<!-- end mbYTPlayer Home -->
        ';
    }

};
// ends mbYTPlayer_player_head function

add_action('wp_footer', 'mbYTPlayer_player_head',20); 