<?php
/**
 * The default template for displaying a single post page with sidebar(s).
 */
?>

<?php 
	$postSlider = get_post_meta(get_the_ID(), 'pm_enable_slider_system', true);   
	$sliderTransition = get_post_meta(get_the_ID(), 'pm_post_slide_transition_meta', true);  
	
	$displaySocialMeta = get_theme_mod('displaySocialMeta','on');    
	$displayCommentsCount = get_theme_mod('displayCommentsCount','on');     
	$displayCategories = get_theme_mod('displayCategories','on'); 
	$displayTags = get_theme_mod('displayTags','on'); 
	$displayComments = get_theme_mod('displayComments','on');    
	
	$getPostLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
	$postLayout = $getPostLayout !== '' ? $getPostLayout : 'no-sidebar';
	
	$get_pm_post_disable_featured_image_meta = get_post_meta( get_the_ID(), 'pm_post_disable_featured_image_meta', true );
	$pm_post_disable_featured_image_meta = $get_pm_post_disable_featured_image_meta === '' ? 'no' : $get_pm_post_disable_featured_image_meta;
	
	$enablePostAuthorInfo = get_theme_mod('enablePostAuthorInfo', 'on');
?>

<!-- Post content -->
<div class="pm_span_header">
	  <h4>
      
		<?php if( $enablePostAuthorInfo === 'on' ) : ?>
            <span><?php esc_attr_e('Posted', 'localization') ?> <?php the_time('l F d, Y'); ?> <?php esc_attr_e('by', 'localization') ?> <?php the_author(); ?></span>
        <?php endif; ?> 
		
        <?php if($displaySocialMeta === 'on') : ?>
                
            <a class="fa fa-twitter pm_tip twitter-share-button" title="<?php esc_attr_e('Share on Twitter', 'localization'); ?>" href="https://twitter.com/share?url=<?php urlencode(the_permalink()); ?>&text=<?php urlencode(the_title()); ?>" target="_blank"></a>
            <a class="fa fa-facebook pm_tip" title="<?php esc_attr_e('Share on Facebook', 'localization'); ?>" href="http://www.facebook.com/share.php?u=<?php urlencode(the_permalink()); ?>" target="_blank"></a>
            <a class="fa fa-linkedin pm_tip" title="<?php esc_attr_e('Share on Linkedin', 'localization'); ?>" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(site_url()); ?>&title=<?php urlencode(the_title()); ?>&summary=<?php echo urlencode(get_the_excerpt()); ?>&source=<?php echo urlencode(site_url()); ?>" target="_blank"></a>
            <a class="fa fa-google pm_tip" title="<?php esc_attr_e('Share on Google Plus', 'localization'); ?>" href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" target="_blank"></a>
        
        <?php endif; ?>
        
	  </h4>
</div><!-- /pm_span_header -->

<?php if($postSlider === 'yes') { ?>

	<div class="flexslider" id="slider">
		<ul class="slides"> 
		<?php

		   /* get the slider array */
		   $list = get_post_meta($post->ID, 'pm_post_slides', true);
		   $slideCounter = 1;

			if (!empty($list)) {
				foreach ($list as $slide) {
											
					echo '<li><img src="' . $slide . '" alt="Slide '. $slideCounter .'" /></li>';
					
					$slideCounter++;
				}
			}
		
		?>
		</ul>
	</div>
	
	<script type="text/javascript">
		(function($) {
			
			$(window).load(function() {
				$('#slider').flexslider({
					 animation: "<?php echo $sliderTransition; ?>",
					controlNav: false,
					animationLoop: true,
					slideshow: false,
			   });
			});
													
		})(jQuery);
	
	</script>
	
<?php } else { ?>

	<?php if( $pm_post_disable_featured_image_meta === 'no' ) { ?>
        
		<?php if(has_post_thumbnail()) { ?>
            <?php the_post_thumbnail(); ?>
        <?php } ?>
    
    <?php } else { ?>
    
    	<br /><br />
    
    <?php } ?>  

<?php } ?>

<?php the_content(); ?>
<?php
	wp_link_pages();
?>

<div class="pm_single_post_tags_container">
	<div class="pm_single_post_tags">
		
        <?php if($displayCategories === 'on') : ?>
            <i class="fa fa-folder"></i> <?php the_category(', ');?>
        <?php endif; ?>            
        
        <?php if($displayTags === 'on') : ?>
        	<?php if(has_tag()) : ?>
                &nbsp;<i class="fa fa-tags"></i> <?php the_tags('',', '); ?>
            <?php endif; ?>
        <?php endif; ?>
        
        
	</div>
    
    <?php if($displayCommentsCount === 'on') : ?>
        
        <div class="pm_single_post_comment_count">
            <i class="fa fa-comments"></i> <?php echo get_comments_number(); ?> <?php esc_attr_e('comments', 'localization') ?>
        </div>
    
    <?php endif; ?>
	
</div>
<!-- Post content end -->


<?php if($displayComments === 'on') : ?>

	<?php if( $postLayout === 'no-sidebar' ) { ?>
    
    	<div class="span12">
			<?php comments_template( '', true ); ?>
        </div>
    
    <?php } else { ?>
    
    	<?php comments_template( '', true ); ?>
    
    <?php } ?>
    
<?php endif; ?>