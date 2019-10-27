<?php

/*

Plugin Name: Events Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your events
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_events_widget');

//register our widget
function pm_events_widget() {
	register_widget('pm_eventposts_widget');
}

//pm_eventposts_widget class
class pm_eventposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_eventposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_eventposts_widget',
			'description' => esc_attr__('Display your events.','localization')
		);
		
		parent::__construct('pm_eventposts_widget', esc_attr__('[Micro Themes] - Events','localization'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => '', 
			'category' => '', 
			'numOfPosts' => '3',
			'postOrder' => 'ASC'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$category = $instance['category'];
		$numOfPosts = $instance['numOfPosts'];
		$postOrder = $instance['postOrder'];
		$sortbyEventDate = $instance['sortbyEventDate'];
		
		?>
        
        	<p><?php esc_attr_e('Title:','localization') ?> <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            
            <p><?php esc_attr_e('Category Slug:','localization') ?> <input class="widefat" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo esc_attr($category); ?>" /></p>
            
            <p><?php esc_attr_e('Number of Events to show:','localization') ?> <input class="widefat" name="<?php echo $this->get_field_name('numOfPosts'); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
            
            
            
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['postOrder'] = strip_tags( $new_instance['postOrder'] );
		$instance['sortbyEventDate'] = strip_tags( $new_instance['sortbyEventDate'] );		
		
		return $instance;
		
	}//end of update function
	
	
	
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Events', 'localization' ) : $instance['title'], $instance, $this->id_base );
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		$category = empty( $instance['category'] ) ? '' : $instance['category'];
		$postOrder = empty( $instance['postOrder'] ) ? 'ASC' : $instance['postOrder'];
		$sortbyEventDate = empty( $instance['sortbyEventDate'] ) ? 'yes' : $instance['sortbyEventDate'];
		
		
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		/*
		post_author 
		post_date
		post_date_gmt
		post_content
		post_title
		post_category
		post_excerpt
		post_status
		comment_status 
		ping_status
		post_name
		comment_count 
		*/
		
		//retrieve recent posts
		
		$todaysDate = date( 'Y-m-d' ); //This date format is required by WordPress to match dates
		
		if( $category !== '' ){//Fetch events by category
				
			$arguments = array(
				'post_type' => 'post_events',
				'post_status' => 'publish',
				'orderby' => 'meta_value',
				'meta_key' => 'pm_event_date_meta',
				'order' => 'ASC',
				'posts_per_page' => $numOfPosts,
				'tax_query' => array(
					array(
						'taxonomy' => 'event_categories',
						'field' => 'slug',
						'terms' => array( $category )
					)
				),
				'meta_query' => array(
					array(
						'key' => 'pm_event_date_meta',
						'value' => $todaysDate,
						'compare' => '>=',
						'type' => 'DATE'
					)
				),
			);
			
		} else {
					
			$arguments = array(
				'post_type' => 'post_events',
				'post_status' => 'publish',
				'orderby' => 'meta_value',
				'meta_key' => 'pm_event_date_meta',
				'order' => 'ASC',
				'posts_per_page' => $numOfPosts,
				'meta_query' => array(
					array(
						'key' => 'pm_event_date_meta',
						'value' => $todaysDate,
						'compare' => '>=',
						'type' => 'DATE'
					)
				),
			);
			
		}
		
						
		$recent_posts = wp_get_recent_posts($arguments, ARRAY_A);
		
		echo '<ul class="pm-events-widget">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			$eventDate = get_post_meta($recent["ID"], 'pm_event_date_meta', true);	
			$month = date_i18n("M", strtotime($eventDate));
			$day = date_i18n("d", strtotime($eventDate));
			$year = date_i18n("Y", strtotime($eventDate));
			
			$excerpt = $recent["post_excerpt"];
			
			echo '<li>';
			
				echo '
					<div class="pm-events-widget-date">
						<i class="fa fa-calendar"></i>
						<p>'.$day.'</p>
						<p>'.$month.'</p>
					</div>
					<div class="pm-events-widget-info">
						<p><b>'.$recent["post_title"].'</b></p>
						<p>'.pm_hope_string_limit_words($excerpt,8) .'...</p>
						<a href="'.get_permalink($recent["ID"]).'" class="green button-small pm-event-widget-btn">
							<span>'. esc_attr__('View Event','localization') .'</span>
							<i class="fa fa-chevron-right"></i>
						</a>
					</div>
				';
			
			echo '</li>';
			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;
		

		
	}//end of widget function
	
}//end of class

?>