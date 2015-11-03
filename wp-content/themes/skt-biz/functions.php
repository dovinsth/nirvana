<?php
/**
 * SKT Biz functions and definitions
 *
 * @package SKT Biz
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'skt_biz_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_biz_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'skt-biz', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_image_size('homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skt-biz' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => '19539b'
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // skt_biz_setup
add_action( 'after_setup_theme', 'skt_biz_setup' );


function skt_biz_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'skt-biz' ),
		'description'   => __( 'Appears on blog page sidebar', 'skt-biz' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Widget 1', 'skt-biz' ),
		'description'   => __( 'Appears on footer', 'skt-biz' ),
		'id'            => 'widget-1',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Widget 2', 'skt-biz' ),
		'description'   => __( 'Appears on footer', 'skt-biz' ),
		'id'            => 'widget-2',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Widget 3', 'skt-biz' ),
		'description'   => __( 'Appears on footer', 'skt-biz' ),
		'id'            => 'widget-3',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'skt_biz_widgets_init' );

add_filter('widget_text', 'do_shortcode');

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

function skt_biz_font_url(){
		$font_url = '';
		
		/* Translators: If there are character in your theme are not 
		* supported by Open Sans, translate this to 'off'. Do not
		* tranalate this to your own language.
		*/
		$open_sans = _x('on', 'Open Sans font: on or off', 'skt-biz');
		
		if('off' !== $open_sans){
				$font_families = 'Open Sans:300,400,400italic,600,700,700italic,800';
			}
				
			$query_args = array(
			'family'	=>  $font_families,
		); 
		
		$font_url = add_query_arg($query_args, '//fonts.googleapis.com/css');
		return $font_url;
}

function skt_biz_scripts() {
		wp_enqueue_style('skt-biz-fonts', skt_biz_font_url(), array());
		wp_enqueue_style( 'skt_biz-basic-style', get_stylesheet_uri() );
		wp_enqueue_style( 'skt_biz-editor-style', get_template_directory_uri()."/editor-style.css" );
		wp_enqueue_style( 'skt_biz-nivoslider-style', get_template_directory_uri()."/css/nivo-slider.css" );	
		wp_enqueue_style( 'skt_biz-base-style', get_template_directory_uri()."/css/style_base.css" );
		wp_enqueue_style( 'skt_biz-icomoon-style', get_template_directory_uri()."/css/icomoon.css" );
		wp_enqueue_script( 'skt_biz-nivo-script', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
		wp_enqueue_script( 'skt_biz-custom_js', get_template_directory_uri() . '/js/custom.js' );
		wp_enqueue_style( 'skt_biz-responsive', get_template_directory_uri()."/css/theme-responsive.css"); 

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_biz_scripts' );

function skt_biz_ie_stylesheet(){
	global $wp_styles;
	
	/** Load our IE-only stylesheet for all versions of IE.
	*   <!--[if lt IE 9]> ... <![endif]-->
	*
	*  Note: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
	*  calling the wp_enqueue_style() function. If you are trying to load a stylesheet for all browsers
	*  EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
	*  properly handle non-IE conditional comments.
	*/
	wp_enqueue_style('skt-biz-ie', get_template_directory_uri().'/css/ie.css', array('skt-biz-style'));
	$wp_styles->add_data('skt-biz-ie','conditional','IE');
	}
add_action('wp_enqueue_scripts','skt_biz_ie_stylesheet');


// add ie conditional html5 to header
function skt_biz_add_ie_html5() {
global $is_IE;
if ($is_IE)
echo '<!--[if lt IE 9]>';
echo '<script src="'.get_template_directory_uri().'/js/html5.js"></script>';
echo '<![endif]-->';
}
add_action('wp_head', 'skt_biz_add_ie_html5');


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

/**
 * Load custom functions file.
 */
require get_template_directory() . '/inc/custom-functions.php';


function skt_biz_custom_blogpost_pagination( $wp_query ){
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

// get slug by id
function skt_biz_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}



function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}
