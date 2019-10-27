<?php get_header(); ?>

<?php 
	
	$eventDate = get_post_meta(get_the_ID(), 'pm_event_date_meta', true);	
	$month = date_i18n("M", strtotime($eventDate));
	$day = date_i18n("d", strtotime($eventDate));
	$year = date_i18n("Y", strtotime($eventDate));
	
	$pm_event_start_time_meta = get_post_meta( $post->ID, 'pm_event_start_time_meta', true );
	$pm_event_end_time_meta = get_post_meta( $post->ID, 'pm_event_end_time_meta', true );
				
	$eventTip = get_post_meta(get_the_ID(), 'pm_event_tooltip_meta', true);
	$eventIconFile = get_post_meta(get_the_ID(), 'pm_event_icon_meta', true);
	$eventIcon = $eventIconFile == '' ? 'fa fa-calendar' : $eventIconFile;
	$countdown = get_post_meta(get_the_ID(), 'pm_event_countdown_meta', true);
	$pm_event_panel_info_meta = get_post_meta(get_the_ID(), 'pm_event_panel_info_meta', true);
?>

<div class="container pm_paddingVertical80 pm_event_single_post">
    <div class="row">
    
    	<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
        
        	<div class="span12">
                
                <div class="pm_span_header">
                  <h4>
                        <div class="pm_event_single_post_time">
                        
                        	<?php if($pm_event_panel_info_meta == 'eventTitle') {//event title ?>
                            
                            	<span><?php the_title(); ?> - <?php echo $month; ?> <?php echo $day; ?>, <?php echo $year; ?></span>
                                
                            <?php } elseif($pm_event_panel_info_meta == 'eventMeta') {//meta info ?>
                            	<span><i class="fa fa-user"></i> <?php esc_attr_e('Organizer','localization') ?>: <?php the_author(); ?> &nbsp;  <i class="fa fa-clock-o"></i> <?php the_time('l F d, Y'); ?></span>
                            <?php } else {//default meta ?>
                            	<span><i class="fa fa-user"></i> <?php esc_attr_e('Organizer','localization') ?>: <?php the_author(); ?> &nbsp;  <i class="fa fa-clock-o"></i> <?php the_time('l F d, Y'); ?></span>
                            <?php } ?>
                            
                        </div>
                        <?php if($eventTip !== '') { ?>
                                <a class="<?php echo esc_attr($eventIcon); ?> pm_tip" title="<?php echo esc_attr($eventTip); ?>"></a>
                        <?php } else { ?>
                                <a class="<?php echo esc_attr($eventIcon); ?>"></a>
                        <?php } ?>
                        
                    </h4>
                </div><!-- /pm_span_header -->
                                    
            </div><!-- /span12 -->
            
              <div class="span2 pm_event_single_post_countdown_container">
                 <div class="pm_event_single_post_countdown">
                 
                    <ul class="pm_event_post_countdown_ul<?php echo $countdown !== '' ? '' : ' extra-line-height' ?>">
                    
                        <li><i class="<?php echo esc_attr($eventIcon); ?>"></i></li>
                        <li><p><?php echo $day; ?></p></li>
                        <li><p><?php echo $month; ?></p></li>
                        <?php if( !empty($pm_event_start_time_meta)&& !empty($pm_event_end_time_meta) && !empty($countdown) ) : ?>
                            <li><p class="pm_event_time"><?php echo esc_attr($pm_event_start_time_meta); ?> <?php echo $pm_event_end_time_meta !== '' ? '- ' . esc_attr($pm_event_end_time_meta) : ''; ?></p></li>
                        <?php endif; ?>
                        
                        <?php if( $countdown !== '' ) : ?>
                        
                        	<li>
                                <div class="pm_event_counter">
                                    <?php $secondaryColor = get_option('secondaryColor', '#ACDB05'); ?>
                                    <input class="knob days" data-width="100" data-min="0" data-max="365" data-displayPrevious=true data-fgColor="<?php echo $secondaryColor; ?>" data-readOnly="true" value="1">
                                </div>
                            </li>
                            
                            <li><p class="pm_event_days_left"><?php esc_attr_e('days left','localization'); ?></p></li>
                        
                        <?php endif; ?>   
                    
                    </ul>
                    
                    <?php if( !empty($pm_event_start_time_meta)&& !empty($pm_event_end_time_meta) && empty($countdown) ) : ?>
                        <p class="pm_event_time"><?php echo esc_attr($pm_event_start_time_meta); ?> <?php echo $pm_event_end_time_meta !== '' ? '- ' . esc_attr($pm_event_end_time_meta) : ''; ?></p>
                    <?php endif; ?>
                     
                 </div>
              </div>
                
              <div class="span10 pm_event_single_post_content">
                    
                    <?php 
					
						$pm_event_disable_featured_image_meta = get_post_meta( $post->ID, 'pm_event_disable_featured_image_meta', true );
						$pm_event_disable_featured_image_meta_final = $pm_event_disable_featured_image_meta === '' ? 'no' : $pm_event_disable_featured_image_meta;
						
						if($pm_event_disable_featured_image_meta === 'no') :
						
							if( has_post_thumbnail() ) :
								the_post_thumbnail();
							endif;
						
						endif;						
					
					?>                    
                    
                    <?php the_content(); ?>
                    
                    <!-- Event details goes here -->
                    <?php 
						$pm_event_details_display_meta = get_post_meta( $post->ID, 'pm_event_details_display_meta', true );
						$pm_event_details_date_meta = get_post_meta( $post->ID, 'pm_event_details_date_meta', true );
						$pm_event_details_time_meta = get_post_meta( $post->ID, 'pm_event_details_time_meta', true );
						
						$cats = wp_get_post_terms($post->ID, 'event_categories'); 
						$tags = wp_get_post_terms($post->ID, 'event_tags'); 
					?>
                    
                    
                    <?php if($pm_event_details_display_meta === "yes") : ?>
                    
                    	<div class="row">
                        	<div class="span4 pm-row-spacer">
                        
                                <p class="pm-event-info-column-title"><strong><?php esc_attr_e('Details', 'localization'); ?></strong></p>
                            
                                <table class="pm_event_details_table">
                                
                                  <?php if( !empty($pm_event_details_date_meta)) : ?>
                                    <tr>
                                      <td><strong><?php esc_attr_e('Date', 'localization'); ?>:</strong> <?php echo esc_attr($pm_event_details_date_meta); ?></td>
                                    </tr>
                                  <?php endif; ?>
                                  
                                  <?php if( !empty($pm_event_details_time_meta)) : ?>
                                    <tr>
                                      <td><strong><?php esc_attr_e('Time', 'localization'); ?>:</strong> <?php echo esc_attr($pm_event_details_time_meta); ?></td>
                                    </tr>
                                  <?php endif; ?>                                  
                                  
                                    <?php $catsLen = count($cats); ?>
        
                                    <?php if($catsLen > 0) { ?>
                                    
                                        <tr>
                                            <td><strong><?php esc_attr_e('Event Category', 'localization'); ?>:</strong>
                                            
                                                <?php 
                                            
                                                    $catCounter = 0;
                                            
                                                    foreach($cats as $cat){ 
                                                    
                                                        $catCounter++;
                                                    
                                                        $term_link = get_term_link( $cat );
                                                        
                                                        if($catsLen > 1){
                                                            
                                                            if($catCounter >= $catsLen){
                                                                echo '<a href="' . $term_link . '">' . $cat->name . '</a> '; 
                                                            } else {
                                                                echo '<a href="' . $term_link . '">' . $cat->name . '</a>, '; 
                                                            }
                                                            
                                                        } else {
                                                            echo '<a href="' . $term_link . '">' . $cat->name . '</a>';	
                                                        }
                                                        
                                                        
                                                    }
                                                
                                                ?>
                                            
                                            </td>
                                        </tr>
                                    
                                    <?php } ?>
                                    
									<?php $tagsLen = count($tags); ?>

                                    <?php if($tagsLen > 0) { ?>
                                    
                                        <tr>
                                            <td><strong><?php esc_attr_e('Event Tags', 'localization'); ?>:</strong> 
                                            
                                            <?php 
                                            
                                                $tagCounter = 0;
                                        
                                                foreach($tags as $tag){ 
                                                
                                                    $tagCounter++;
                                                
                                                    $term_link = get_term_link( $tag );
                                                    if($tagsLen > 1){
                                                        
                                                        if($tagCounter >= $tagsLen){
                                                            echo '<a href="' . $term_link . '">' . $tag->name . '</a>'; 
                                                        } else {
                                                            echo '<a href="' . $term_link . '">' . $tag->name . '</a>, '; 
                                                        }
                                                        
                                                    } else {
                                                        echo '<a href="' . $term_link . '">' . $tag->name . '</a>';	
                                                    }
                                                    
                                                }
                                            
                                            ?>
                                            
                                            </td>
                                        </tr>
                                    
                                    <?php } ?>
                                    
                                </table>
    
                            </div>
                    
                    <?php endif; ?>
                    
                    
                    <!-- Organizer details goes here -->
                    <?php 
						$pm_event_organizer_display_meta = get_post_meta( $post->ID, 'pm_event_organizer_display_meta', true );
						$pm_event_organizer_name_meta = get_post_meta( $post->ID, 'pm_event_organizer_name_meta', true );
						$pm_event_organizer_phone_meta = get_post_meta( $post->ID, 'pm_event_organizer_phone_meta', true );
						$pm_event_organizer_email_meta = get_post_meta( $post->ID, 'pm_event_organizer_email_meta', true );
						$pm_event_organizer_website_meta = get_post_meta( $post->ID, 'pm_event_organizer_website_meta', true );
					?>
                    
                    <?php if($pm_event_organizer_display_meta === "yes") : ?>
                    
                    	
                        	<div class="span4 pm-row-spacer">
                            	
                                <p class="pm-event-info-column-title"><strong><?php esc_attr_e('Organizer', 'localization'); ?></strong></p>
                            
                                <table class="pm_event_details_table">
                                
                                  <?php if( !empty($pm_event_organizer_name_meta)) : ?>
                                    <tr>
                                      <td><strong><?php echo esc_attr($pm_event_organizer_name_meta); ?></strong> </td>
                                    </tr>
                                  <?php endif; ?>
                                  
                                  <?php if( !empty($pm_event_organizer_phone_meta)) : ?>
                                    <tr>
                                      <td><strong><?php esc_attr_e('Phone', 'localization'); ?>:</strong> <?php echo esc_attr($pm_event_organizer_phone_meta); ?></td>
                                    </tr>
                                  <?php endif; ?>
                                  
                                  <?php if( !empty($pm_event_organizer_email_meta)) : ?>
                                    <tr>
                                      <td><strong><?php esc_attr_e('Email', 'localization'); ?>:</strong> <a href="mailto:<?php echo esc_attr($pm_event_organizer_email_meta); ?>"><?php echo esc_attr($pm_event_organizer_email_meta); ?></a></td>
                                    </tr>
                                  <?php endif; ?>
                                  
                                  <?php if( !empty($pm_event_organizer_website_meta)) : ?>
                                    <tr>
                                      <td><strong><?php esc_attr_e('Website', 'localization'); ?>:</strong> <a href="<?php echo esc_url($pm_event_organizer_website_meta); ?>" target="_blank"><?php echo esc_attr($pm_event_organizer_website_meta); ?></a></td>
                                    </tr>
                                  <?php endif; ?>
                                  
                                </table>
                                
                            </div>
                        
                    
                    <?php endif; ?>
                    
                    
                    <!-- Venue details goes here -->
                    <?php 
						$pm_event_venue_display_meta = get_post_meta( $post->ID, 'pm_event_venue_display_meta', true );
						$pm_event_venue_name_meta = get_post_meta( $post->ID, 'pm_event_venue_name_meta', true );
						$pm_event_venue_address_meta = get_post_meta( $post->ID, 'pm_event_venue_address_meta', true );
						$pm_event_venue_city_meta = get_post_meta( $post->ID, 'pm_event_venue_city_meta', true );
						$pm_event_venue_state_meta = get_post_meta( $post->ID, 'pm_event_venue_state_meta', true );
						$pm_event_venue_zip_meta = get_post_meta( $post->ID, 'pm_event_venue_zip_meta', true );
						$pm_event_venue_country_meta = get_post_meta( $post->ID, 'pm_event_venue_country_meta', true );
						$pm_event_venue_phone_meta = get_post_meta( $post->ID, 'pm_event_venue_phone_meta', true );
						$pm_event_venue_email_meta = get_post_meta( $post->ID, 'pm_event_venue_email_meta', true );
						$pm_event_venue_website_meta = get_post_meta( $post->ID, 'pm_event_venue_website_meta', true );
						$pm_event_venue_google_map_meta = get_post_meta( $post->ID, 'pm_event_venue_google_map_meta', true );
					?>
                    
                    <?php if($pm_event_venue_display_meta === "yes") : ?>
                                        
                    	<div class="span8 pm-row-spacer">
                        
                        	<p class="pm-event-info-column-title"><strong><?php esc_attr_e('Venue', 'localization'); ?></strong></p>
                            
                            <table class="pm_event_details_table">
                            
                              <?php if( !empty($pm_event_venue_name_meta)) : ?>
                              	<tr>
                                  <td><strong><?php echo esc_attr($pm_event_venue_name_meta); ?></strong> </td>
                                </tr>
                              <?php endif; ?>
                              
                              <?php if( !empty($pm_event_venue_address_meta)) : ?>
                              	<tr>
                                  <td>
                                      <p class="pm-no-margin"><?php echo esc_attr($pm_event_venue_address_meta); ?> <br />
                                      <?php echo esc_attr($pm_event_venue_city_meta); ?>, <?php echo esc_attr($pm_event_venue_state_meta); ?> <?php echo esc_attr($pm_event_venue_zip_meta); ?> <?php echo esc_attr($pm_event_venue_country_meta); ?> <?php echo !empty($pm_event_venue_google_map_meta) ? ' <a href="#" id="pm-toggle-event-google-map">'. esc_attr__('+ Google Map', 'localization') .'</a>' : ''; ?> </p>
                                  </td>
                                </tr>
                              <?php endif; ?>
                              
                              <?php if( !empty($pm_event_venue_phone_meta)) : ?>
                              	<tr>
                                    <td><strong><?php esc_attr_e('Phone', 'localization'); ?>:</strong> <?php echo esc_attr($pm_event_venue_phone_meta); ?></td>
                                </tr>
                              <?php endif; ?>
                              
                              <?php if( !empty($pm_event_venue_email_meta)) : ?>
                              	<tr>
                                    <td><strong><?php esc_attr_e('Email', 'localization'); ?>:</strong> <a href="mailto:<?php echo esc_attr($pm_event_venue_email_meta); ?>"><?php echo esc_attr($pm_event_venue_email_meta); ?></a></td>
                                </tr>
                              <?php endif; ?>
                              
                              <?php if( !empty($pm_event_venue_website_meta)) : ?>
                              
                              	<tr>
                                  <td><strong><?php esc_attr_e('Website', 'localization'); ?>:</strong> <a href="<?php echo esc_url($pm_event_venue_website_meta); ?>" target="_blank"><?php echo esc_attr($pm_event_organizer_website_meta); ?></a></td>
                                </tr>
                              
                              <?php endif; ?>
                              
                            </table>
                            
                            <?php if( !empty($pm_event_venue_google_map_meta) ) : ?>
                                
                                <div class="pm-event-info-google-map-container" id="pm-event-info-google-map">
                                    <div class="pm-event-info-google-map">
                                        <?php echo $pm_event_venue_google_map_meta; ?>
                                    </div>
                                </div>
                            
                            <?php endif; ?>
                        
                    	</div>                        
                    
                    <?php endif; ?>
                    
                    </div><!-- end of row -->
                    
                    
              </div>
              
              <?php
              	
				//calculate days remaining based on countdown date
				$dateConverted = str_replace(',', '-', $countdown);
				$rem = strtotime($dateConverted) - time();
				$days = ceil($rem / 86400);
			  
			  ?>
              
              
              
              	<div class="pm_countdown_mini_container">
                    <ul class="pm_countdown_mini_ul">
                        <li class="pm_countdown_icon"><i class="fa fa-calendar"></i></li>
                        <li class="pm_countdown_date"><strong><?php echo $day; ?></strong> <?php echo $month; ?></li>
                        <?php if( !empty($countdown) ) : ?>
                        	<li class="pm_countdown_days_left"><strong>  <?php echo $days; ?>  </strong> <?php esc_attr_e('days left','localization'); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
              
              
        
        <?php }
                
		} else { ?>
			
			<?php esc_attr_e('There is no event available.', 'localization'); ?>
				
		<?php } ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php if($countdown !== '') { ?>

    <!-- localize variable -->
    <?php
        
        $countdownDates = explode(",", $countdown);
        $year = $countdownDates[0];
        $month = $countdownDates[1];
        $day = $countdownDates[2];
        
        wp_enqueue_script( 'js_handler', true );
        $array = array( 
            'pmYear' => $year,
            'pmMonth' => $month,
            'pmDay' => $day,
        );
        wp_localize_script( 'js_handler', 'pmobject', $array );
        
?>

<?php } ?>

<?php get_footer(); ?>