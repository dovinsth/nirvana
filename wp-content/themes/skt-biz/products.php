<?php
/* Template Name: Products */

get_header(); ?>

<?php $page_id = get_ID_by_slug("products");
$post = get_post_field('post_content', $page_id);

$args = array(
    'numberposts' => 5,
    'offset' => 0,
    'category' => get_cat_ID('products') ,
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
               <article>
                <p>
                <?php   
    if ($post)
    {

        

            // echo "hello";
            echo $post;
            echo "<BR>";
            echo "<BR>";
        
    }
    ?>
   
    <h1>
        Recent Posts</h1>
    <?php
    if ($recent_posts)
    {

        foreach( $recent_posts as $recent ){

            echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
            echo "<BR>";
        }
    }
    
?>

            
            </p></article>
            </div><!-- blog-post -->
        </section>
        <?php get_sidebar();?>
        <div class="clear"></div>
    </div>
</div>
	
<?php get_footer(); ?>
