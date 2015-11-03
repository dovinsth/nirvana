<section id="home_slider">
   <?php
   if( of_get_option('slide1',true) == 1){ ?>
   <div class="slider-wrapper theme-default">
       <div id="slider" class="nivoSlider">
          <img src="<?php echo get_template_directory_uri(); ?>/images/slides/slide1.jpg" />
      </div>
      <div class="nivo-caption" style="display:block;">
        <div class="slide_info">
          <h1><?php _e('Go to Appearance >> Theme Options >> Restore Defaults.','skt-biz'); ?></h1>
          <p><?php _e('Go to Appearance >> Theme Options >> Restore Defaults.','skt-biz'); ?></p>
      </div>
  </div>
</div>
<?php 
} else {
 $slAr = array();
 $m = 0;
 for ($i=1; $i<6; $i++) {
    if ( of_get_option('slide'.$i, true) != "" ) {
       $imgSrc 	= of_get_option('slide'.$i, true);
       $imgTitle	= of_get_option('slidetitle'.$i, true);
       $imgDesc	= of_get_option('slidedesc'.$i, true);
       $imgLink	= of_get_option('slideurl'.$i, true);
       if ( strlen($imgSrc) > 3 ) {
          $slAr[$m]['image_src'] = of_get_option('slide'.$i, true);
          $slAr[$m]['image_title'] = of_get_option('slidetitle'.$i, true);
          $slAr[$m]['image_desc'] = of_get_option('slidedesc'.$i, true);
          $slAr[$m]['image_link'] = of_get_option('slideurl'.$i, true);
          $m++;
      }
  }
}
$slideno = array();
if( $slAr > 0 ){
    $n = 0;?>
    <div class="slider-wrapper theme-default"><div id="slider" class="nivoSlider">
        <?php 
        foreach( $slAr as $sv ){
            $n++; ?><img src="<?php echo $sv['image_src']; ?>" alt="<?php echo $sv['image_title'];?>" title="<?php if ( ($sv['image_title']!='') && ($sv['image_desc']!='') ) { echo '#slidecaption'.$n ; } ?>" /><?php
            $slideno[] = $n;
        }
        ?>
        </div><?php
        foreach( $slideno as $sln ){ ?>
        <div id="slidecaption<?php echo $sln; ?>" class="nivo-html-caption">
            <div class="slide_info">
                <?php if( of_get_option('slidetitle'.$sln, true) != '' ){ ?>
                <h1><?php echo of_get_option('slidetitle'.$sln, true); ?></h1>
                <?php } ?>
                <?php if( of_get_option('slidedesc'.$sln, true) != '' ){ ?>
                <p><?php echo of_get_option('slidedesc'.$sln, true); ?></p>
                <?php } ?>
                </div><?php                            
                if( of_get_option('slideurl'.$sln, true) != '' ){ ?>
                <p class="slide_more"><a href="<?php echo esc_url(of_get_option('slideurl'.$sln, true)); ?>"><?php _e('Read More','skt-biz'); ?></a></p><?php 
            } ?>
            </div><?php 
        } ?>
    </div>
    <div class="clear"></div><?php 
} }
?>
</section>