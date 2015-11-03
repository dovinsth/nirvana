<?php
/**
 * @package SKT Biz
 * Setup the WordPress core custom functions feature.
 *
*/
function skt_biz_content($limit) {
$content = explode(' ', get_the_content(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}	
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}

add_action('wp_enqueue_script', 'skt_biz_optionsframework_custom_scripts');
function skt_biz_optionsframework_custom_scripts() {
		wp_enqueue_script('skt-biz-custom-admin', get_template_directory_uri().'/js/custom-admin');
    }

// custom javascript for head
add_action('wp_head','hook_custom_javascript');
function hook_custom_javascript(){
    wp_enqueue_script('skt-biz-custom-hook', get_template_directory_uri().'/js/custom-hook.js');
  }

// get_the_content format text
function skt_biz_get_the_content_format( $str ){
	$raw_content = apply_filters( 'the_content', $str );
	$content = str_replace( ']]>', ']]&gt;', $raw_content );
	return $content;
}
// the_content format text
function skt_biz_the_content_format( $str ){
	echo skt_biz_get_the_content_format( $str );
}

// subhead section function
function skt_biz_sub_head_section( $more ) {
	$pgs = 0;
	do {
		$pgs++;
	} while ($more > $pgs);
	return $pgs;
}



function skt_biz_excerpt_more( $more ) {
	return '... ';
}
add_filter('excerpt_more', 'skt_biz_excerpt_more');


function skt_biz_getPostCategories(){
	$categories = get_the_category();
	$catOut = '';
	$separator = ', ';
	$catOutput = '';
	if($categories){
		foreach($categories as $category) {
			$catOutput .= '<a href="'.esc_url(get_category_link( $category->term_id )).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'skt-biz' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
		}
		$catOut = 'Categories: '.trim($catOutput, $separator);
	}
	return $catOut;
}

function str_lreplace($search, $replace, $subject){
	$pos = strrpos($subject, $search);
	if($pos !== false){
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}

define('SKT_THEME_URL_DIRECT','http://www.sktthemes.net/themes/skt_biz_pro/');
define('SKT_THEME_URL','http://sktthemes.net/themes');
define('SKT_URL','http://sktthemes.net');