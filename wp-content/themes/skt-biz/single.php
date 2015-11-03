<?php
/**
 * The Template for displaying all single posts.
 *
 * @package SKT Biz
 */

get_header(); ?>

<div id="primary" class="content-area">
    <div class="site-content container">
        <section class="site-main" id="sitemain">
            <div class="blog-post">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'single' ); ?>
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                    	comments_template();
                    ?>
                <?php endwhile; // end of the loop. ?>
            </div>
        </section>
        
        <div class="clear"></div>
    </div>
</div>
	
<?php get_footer(); ?>