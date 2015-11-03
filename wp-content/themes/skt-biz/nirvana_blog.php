<?php
/* Template Name: Nirvana Blog */

get_header(); ?>

<?php 



$args = array(
    'numberposts' => 1,
    'offset' => 0,
    'category' => get_cat_ID('nirvana_blog') ,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true 
    );
$recentpost = wp_get_recent_posts( $args, ARRAY_A );

$args = array(
    'numberposts' => 5,
    'offset' => 0,
    'category' => get_cat_ID('nirvana_blog') ,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true );

    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
?>

<div class="content-area">
    <div class="container">
        <section class="site-main" id="sitemain">
            <div class="blog-post">
                <?php   
   
    if ($recentpost)
    {
        echo $recentpost;
        echo '<h2>'. $recentpost["post_title"] . '</h2>';
        echo 'sdf';
    }

    if ($recent_posts)
    {

        foreach( $recent_posts as $recent ){

            echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
            echo "<BR>";
        }
    }
    
?>



            </div><!-- blog-post -->
        </section>
        <?php get_sidebar();?>
        <div class="clear"></div>
    </div>
</div>
    
<?php get_footer(); ?>

