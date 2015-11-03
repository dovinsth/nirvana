<?php
/* Template Name: Contact Us */
?>
<?php get_header()?>

<?php $page_id = get_ID_by_slug("contact_us");
$post = get_post_field('post_content', $page_id);

?>

<div class="content-area">
    <div class="container">
        <section class="site-main" id="sitemain">
            <div class="blog-post">
                <?php   
    if ($post)
    {

        

            // echo "hello";
            echo $post;
        
    }

    
    
?>



            </div><!-- blog-post -->
        </section>
        <?php get_sidebar();?>
        <div class="clear"></div>
    </div>
</div>
	
<?php get_footer(); ?>
