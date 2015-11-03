<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Biz
 */
?>
	<div class="clear"></div>
</div>
<footer id="footer">
	<div class="container">
        <aside class="widget">
            <?php dynamic_sidebar('widget-1'); ?>
        </aside>
        <aside class="widget">
        	<?php dynamic_sidebar('widget-2'); ?>
        </aside>
        <aside class="widget last">
        <?php dynamic_sidebar('widget-3'); ?>
        </aside>
        <div class="clear"></div>
    </div>

</footer>
<div id="copyright">
	<div class="container">
    	<div class="left">
        	<?php if( of_get_option('footertext',true) == 1) { ?>
            	<?php _e('Go to Appearance >> Theme Options >> Restore.'); ?>
            <?php } else { ?>
				<?php echo of_get_option('footertext', true); ?>
            <?php } ?>
        </div>
    	<div class="right">
        	<?php if( of_get_option('footerlinks', true) == 1) { ?>
            	<?php _e('Go to Appearance >> Theme Options >> Restore Defaults.','skt-biz'); ?>
            <?php } else { ?>
				<?php echo of_get_option('footerlinks', true); ?>
            <?php } ?>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>