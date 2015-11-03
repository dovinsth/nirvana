<?php
/**
 * Clovemix functions and definitions
 *
 * @package Clovemix
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'clovemix_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function clovemix_setup() {
	global $content_width; 
		if ( ! isset( $content_width ) ) {
    	$content_width = 810;
}

	load_theme_textdomain( 'clovemix', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_image_size('clovemix-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'clovemix' ),
		'footer' => __( 'Footer Menu', 'clovemix' ),
	) );
	add_theme_support( 'custom-background', array(
			  'default-color' => '#000000',
			  'default-image' => '',
 ) );
	add_editor_style( 'editor-style.css' );
}
endif; // clovemix_setup
add_action( 'after_setup_theme', 'clovemix_setup' );


function clovemix_widgets_init() {    
	register_sidebar( array(
		'name'          => __( 'Sidebar Main', 'clovemix' ),
		'description'   => __( 'Appears on all site', 'clovemix' ),
		'id'            => 'sidebar-main',
		'before_widget' => '<aside id="%1$s" class="sidebar-area %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget_title">',
		'after_title'   => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'clovemix_widgets_init' );


function clovemix_font_url(){
		$font_url = '';
		
		/* Translators: If there are any character that are
		* not supported by PT Sans, translate this to off, do not
		* translate into your own language.
		*/
		$ptsans = _x('on', 'PT Sans font:on or off','clovemix');
		
		/* Translators: If there are any character that are
		* not supported by Tangerine, translate this to off, do not
		* translate into your own language.
		*/
		$tang = _x('on', 'Tangerine font:on or off','clovemix');
		
		if('off' !== $ptsans || 'off' !==  $tang){
			$font_family = array();
			
			if('off' !== $ptsans){
				$font_family[] = 'PT Sans:300,400,600,700,800,900';
			}
			
			if('off' !== $tang){
				$font_family[] = 'Tangerine:400,700';
			}
			
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function clovemix_scripts() {	
	wp_enqueue_style( 'clovemix-font', clovemix_font_url(), array() );
	wp_enqueue_style( 'clovemix-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'clovemix-editor-style', get_template_directory_uri()."/editor-style.css" );
	wp_enqueue_style( 'clovemix-responsive-style', get_template_directory_uri()."/css/theme-responsive.css" );
	wp_enqueue_style( 'clovemix-nivoslider-style', get_template_directory_uri()."/css/nivo-slider.css" );	
	wp_enqueue_style( 'clovemix-base-style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_script( 'clovemix-nivo-script', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'clovemix-custom_js', get_template_directory_uri() . '/js/custom.js' );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clovemix_scripts' );

function clovemix_ie_stylesheet(){
	global $wp_styles;
	
	/** Load our IE-only stylesheet for all versions of IE.
	*   <!--[if lt IE 9]> ... <![endif]-->
	*
	*  Note: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
	*  calling the wp_enqueue_style() function. If you are trying to load a stylesheet for all browsers
	*  EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
	*  properly handle non-IE conditional comments.
	*/
	wp_enqueue_style('clovemix-ie', get_template_directory_uri().'/css/ie.css', array('clovemix-style'));
	$wp_styles->add_data('clovemix-ie','conditional','IE');
	}
add_action('wp_enqueue_scripts','clovemix_ie_stylesheet');


function clovemix_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $page_format as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	}
}

// Define urls

define('site_url','http://flythemes.net/');
define('pro_theme_url','http://flythemes.net/wordpress-themes/clovemix-restaurant-wordpress-theme/');
define('theme_doc','http://flythemes.net/documentation/clovemix-doc/');



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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


function clovemix_custom_blogpost_pagination( $wp_query ){
	$big = 999999999; // need an unlikely integer
	if ( get_query_var('paged') ) { $pageVar = 'paged'; }
	elseif ( get_query_var('page') ) { $pageVar = 'page'; }
	else { $pageVar = 'paged'; }
	$pagin = paginate_links( array(
		'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 		=> '?'.$pageVar.'=%#%',
		'current' 		=> max( 1, get_query_var($pageVar) ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text'		=> '&laquo; Prev',
		'next_text' 	=> 'Next &raquo;',
		'type'  => 'array'
	) ); 
	if( is_array($pagin) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $pagin as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	} 
}

function clovemix_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'clovemix_custom_excerpt_length', 999 );

function clovemix_credit_link(){
		return "Theme by <a href=".esc_url(site_url)." target='_blank'>Flythemes</a>";
	}