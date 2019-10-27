<?php /* Template Name: Events Template */ ?>
<?php get_header(); ?>


<?php 
	$displayExpiredEvents = get_theme_mod('displayExpiredEvents', 'yes');
	$terms = get_terms('event_categories' ); 
?>

 <div class="container" style="padding-top:80px;">
        <div class="row">
        
        	<?php if( $displayExpiredEvents === 'yes' ) : ?>
            
            	<div class="span6">

                    <div class="pm-dropdown pm-staff-menu float-left">
                        <div class="pm-dropmenu">
                            <p class="pm-menu-title"><?php esc_attr_e('Sort by date', 'localization'); ?></p>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="pm-dropmenu-active">
                            <ul>
                            
                                <?php 
                                
                                    echo '<li><a href="#" id="active">'.esc_attr__('Current Events', 'localization').'</a></li>';
                                    echo '<li><a href="#" id="inactive">'.esc_attr__('Past Events', 'localization').'</a></li>';
                                   
                                ?>
                            
                            </ul>
                        </div>
                    </div> 
                    <!-- /dropdown -->
                
                </div>
            
            <?php endif; ?>        
        
            <div class="span<?php echo $displayExpiredEvents === 'yes' ? '6' : '12'; ?>">

				<?php if ($terms && !is_wp_error($terms)) : ?>
                    
                    <div class="pm-dropdown pm-staff-menu">
                        <div class="pm-dropmenu">
                            <p class="pm-menu-title"><?php esc_attr_e('Sort by category', 'localization'); ?></p>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="pm-dropmenu-active">
                            <ul>
                            
                                <?php 
                                
                                    //$term_slugs_arr = array();
                                    echo '<li><a href="#" id="all">'.esc_attr__('View all', 'localization').'</a></li>';
                                    foreach ($terms as $term) {
                                        //$term_slugs_arr[] = $term->slug;
                                        echo '<li><a href="#" id="'.$term->slug.'">'.$term->name.'</a></li>';
                                    }
                                    //$terms_slug_str = join( " ", $term_slugs_arr);
                                ?>
                            
                            </ul>
                        </div>
                    </div> 
                    <!-- /dropdown -->                        
                
                <?php endif; ?>
            
		</div>
    </div>
</div>

<?php

	$eventsPostOrder = get_theme_mod('eventsPostOrder', 'DESC');
	$sortEventsbyEventDate = get_theme_mod('sortEventsbyEventDate', 'on');
	
	$todaysDate = date( 'Y-m-d' ); //This date format is required by WordPress to match dates
	
	if($sortEventsbyEventDate === 'on') {
				
		if($displayExpiredEvents === 'yes') {
			
			//Fetch all event posts
			$arguments = array(
				'post_type' => 'post_events',
				'post_status' => 'publish',
				'orderby' => 'meta_value',
				'meta_key' => 'pm_event_date_meta',
				'order' => $eventsPostOrder,
				//'posts_per_page' => -1,
				'posts_per_page' => -1,
				//'tag' => get_query_var('tag')
			);
			
		} else {
			
			//Do not fetch expired events
			$arguments = array(
				'post_type' => 'post_events',
				'post_status' => 'publish',
				'orderby' => 'meta_value',
				'meta_key' => 'pm_event_date_meta',
				'order' => $eventsPostOrder,
				//'posts_per_page' => -1,
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => 'pm_event_date_meta',
						'value' => $todaysDate,
						'compare' => '>=',
						'type' => 'DATE'
					)
				),
				//'tag' => get_query_var('tag')
			);
			
		}
				
		
		
	} else {
		
		if($displayExpiredEvents === 'yes') {
			
			//Fetch all event posts
			$arguments = array(
				'post_type' => 'post_events',
				'post_status' => 'publish',
				'order' => $eventsPostOrder,
				//'posts_per_page' => -1,
				'posts_per_page' => -1,
				//'tag' => get_query_var('tag')
			);
			
		} else {
			
			//Do not fetch expired events
			$arguments = array(
				'post_type' => 'post_events',
				'post_status' => 'publish',
				'order' => $eventsPostOrder,
				//'posts_per_page' => -1,
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => 'pm_event_date_meta',
						'value' => $todaysDate,
						'compare' => '>=',
						'type' => 'DATE'
					)
				),
				//'tag' => get_query_var('tag')
			);
			
		}
		
		
		
	}

	$post_query = new WP_Query($arguments);

?>

<div class="container pm_paddingVertical40 pm_event_post">
    <div class="row">
    
    	<div id="pm-isotope-organizers-container">
        
        	<?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
    
				<?php get_template_part('content', 'eventpost'); ?>
            
            <?php endwhile; else: ?>
            
                <div class="span12">
                    <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
                </div>
             
            <?php endif; ?>
            
            <?php wp_reset_postdata(); ?>
        
        </div><!-- /isotope -->

    </div> <!-- /row -->
</div> <!-- /container -->  

<?php get_footer(); ?>