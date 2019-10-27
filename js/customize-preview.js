/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'procast_theme-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});
	
	//Header textfields
	wp.customize( 'headerPostsListSelector', function( value ) {
		value.bind( function( to ) {
			$( '#pro-cast-posts-selector li.activator' ).text( to );
		});
	});
	
	//Reviews textfields
	wp.customize( 'keyRating1Text', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-review-rating-score-bar.level-one p' ).text( to );
		});
	});
	
	
	//Footer textfields
	wp.customize( 'newsletterFieldText', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-newsletter-field' ).val( to );
		});
	});
		
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
		
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	
	//Header slider options	
	wp.customize( 'headerHeight', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
	
				$( 'header' ).css({
					height : to + 'px',
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	wp.customize( 'headerPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
	
				$( 'header' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	
	
	
	//Header Colors
	wp.customize( 'headerBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'header' ).css({
					backgroundColor : to
				});	
				
				/*$( '.pro-cast-social-icons li' ).css({
					borderLeft : '1px solid' + to
					borderRight : '1px solid' + to
					borderBottom : '1px solid' + to
				});*/
				
				/*$( '.pro-cast-general-info' ).css({
					color : to
				});	*/
				
			}			
		});		
	});	
	
	wp.customize( 'subHeaderBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm_subheader_container' ).css({
					backgroundColor : to
				});					
			}			
		});		
	});		
	//end Header Colors


	//Footer slider options	
	wp.customize( 'footerPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'footer' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	wp.customize( 'footerNavPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.footer_info' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	wp.customize( 'footerInfoPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm_footer_info' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	//Footer colors
	wp.customize( 'footerBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm_footer_info' ).css({
					backgroundColor : to
				});					
			}			
		});		
	});	
	
	wp.customize( 'fatFooterBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'footer' ).css({
					backgroundColor : to
				});					
			}			
		});		
	});	
	
	wp.customize( 'fatFooterBorderColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'footer' ).css({
					borderTop : "8px solid" + to,
					borderBottom : "8px solid" + to
				});					
			}			
		});		
	});	
	
	//Global colors
	wp.customize( 'pageBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'body' ).css({
					backgroundColor : to
				});					
			}			
		});		
	});	
	
	wp.customize( 'filterMenuColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-dropmenu' ).css({
					backgroundColor : convertHex(to,90)
				});	
				
				$( '.pm-dropmenu-active' ).css({
					backgroundColor : convertHex(to,90)
				});					
			}			
		});		
	});	
	
	wp.customize( 'socialIconsColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.header_social_icons a' ).css({
					backgroundColor : convertHex(to,90)
				});	
				
				$( '.footer_social_icons a' ).css({
					backgroundColor : convertHex(to,90)
				});					
			}			
		});		
	});	
	
	wp.customize( 'searchFieldColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm_searchbar_container' ).css({
					backgroundColor : convertHex(to,90)
				});			
			}			
		});		
	});	
	
	wp.customize( 'searchFieldTextColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm_searchfield' ).css({
					color : to
				});			
			}			
		});		
	});	
	
	wp.customize( 'featuredColumnBorders', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.vc-featured-borders' ).css({
					borderBottom : "6px solid" + to,
					borderTop : "6px solid" + to
				});			
			}			
		});		
	});	


	
	
	wp.customize( 'primaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-range' ).css({
					backgroundColor : to
				});	
				
				$( '.page-numbers.current' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce #respond input#submit' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce a.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce button.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce input.button' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce #respond input#submit.alt' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce a.button.alt' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce button.button.alt' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce input.button.alt' ).css({
					backgroundColor : to
				});	
				
				$( '.product_meta > span > a' ).css({
					color : to
				});	
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce div.product form.cart .reset_variations' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce div.product p.price' ).css({
					color : to
				});	
				
				$( '.woocommerce div.product span.price' ).css({
					color : to
				});	
				
				$( '.woocommerce #respond input#submit' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce a.button' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce button.button' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce input.button' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-isotope-filter-system-expand' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-gallery-item-btns li a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-gallery-item-title' ).css({
					backgroundColor : to
				});
				
				$( '.pm-gallery-item-hover-btn' ).css({
					borderRightColor : to,
					borderBottomColor : to
				});
				
				$( '.pm-rounded-btn a.current' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-dots span.pm-currentDot' ).css({
					backgroundColor : to
				});
				
				$( '.pm-organizers-nav-links a' ).css({
					backgroundColor : to
				});
				
				$( '#reply-title' ).css({
					color : to
				});
				
				$( '.comment-reply-link' ).css({
					backgroundColor : to
				});
				
				$( '.wpcf7-submit' ).css({
					backgroundColor : to
				});
				
				$( '.coupon .button' ).css({
					backgroundColor : to
				});
				
				$( '.pm-cart-total-container .button' ).css({
					backgroundColor : to
				});
				
				$( '#place_order' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce input[type="submit"]' ).css({
					backgroundColor : to
				});
				
				$( '.checkout-button' ).css({
					backgroundColor : to
				});
				
				$( '.pm-column-border' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm_image_panel_header h4' ).css({
					backgroundColor : to
				});
				
				$( '.pm-added-to-cart-icon' ).css({
					backgroundColor : to
				});
				
				$( '.pm-sidebar h6' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-event-info-ul-date' ).css({
					borderRight : "1px solid" + to
				});
				
				$( '.pm_paginated-posts p' ).css({
					color : to
				});
				
				$( '.comments-title' ).css({
					color : to
				});
				
				$( '.pm_span_header h4' ).css({
					backgroundColor : to
				});
				
				$( '.sf-menu li.current-menu-item' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-events-widget-date i' ).css({
					color : to
				});
				
				$( '.pm-sidebar .tweet_list li a' ).css({
					color : to
				});
				
				$( '.recentcomments a' ).css({
					color : to
				});
				
				$( '.pm_events_container a' ).css({
					color : to
				});
				
				$( '.pm_events_container' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm_events_container .pm_events_img' ).css({
					borderLeft : "1px solid" + to,
					borderRight : "1px solid" + to
				});
				
				$( '.pm_event_single_post_countdown i' ).css({
					color : to
				});
				
				$( '.pm_organizer_single_details li' ).css({
					color : to
				});
				
				$( 'ol.commentlist li div.reply' ).css({
					backgroundColor : to
				});
					
				$( '#pm-accordionIcon' ).css({
					color : to
				});
				
				$( '.widget_footer h6' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '#pm-footer-nav li a' ).css({
					borderRight : "1px solid" + to
				});				
				
				$( '.single_add_to_cart_button' ).css({
					backgroundColor : to
				});
				
				$( '.widget_shopping_cart_content .buttons .wc-forward' ).css({
					backgroundColor : to
				});
				
				$( '.single_add_to_cart_button' ).css({
					backgroundColor : to
				});
				
				$( '.pm-custom-button.remove' ).css({
					backgroundColor : to
				});
				
				$( '.pm-shipping-calculator-btn' ).css({
					backgroundColor : to
				});
				
				$( '#pm-load-more' ).css({
					backgroundColor : to
				});
				
				$( '.btn.pm-owl-prev' ).css({
					color : to
				});
				
				$( '.btn.pm-owl-next' ).css({
					color : to
				});
				
				$( '.btn.pm-owl-play ' ).css({
					color : to
				});
							
			}			
		});		
	});			
					
					
	wp.customize( 'secondaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);
				$( 'input[type="submit"]' ).css({
					backgroundColor : to
				});
				
				$( 'input[type="reset"]' ).css({
					backgroundColor : to
				});
				
				$( 'input[type="button"]' ).css({
					backgroundColor : to
				});
					
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce span.onsale' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});	
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce .star-rating span' ).css({
					color : to
				});	
				
				$( '.woocommerce p.stars a' ).css({
					color : to
				});
				
				$( '.woocommerce-review-link' ).css({
					color : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid .select2-container' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid input.input-text' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid select' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid label' ).css({
					color : to
				});
				
				$( '.woocommerce form .form-row .required' ).css({
					color : to
				});
				
				$( '.woocommerce a.remove' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-error' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce-info' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce-message' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated .select2-container' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated input.input-text' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated select' ).css({
					borderColor : to
				});
				
				$( '.footer .widget_recent_entries ul li' ).css({
					color : to
				});
				
				$( '.footer .widget_archive ul li' ).css({
					color : to
				});
				
				$( '.footer .widget_categories ul li' ).css({
					color : to
				});
				
				$( '.pm-single-blog-post-categories .icon i' ).css({
					color : to
				});
				
				$( '.pm-single-blog-post-tags .icon i' ).css({
					color : to
				});
				
				$( '.pm-rounded-btn a' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm-slide-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-dots span' ).css({
					backgroundColor : to
				});
				
				$( '#pm_search_btn i' ).css({
					color : to
				});
				
				$( '.owl-item .pm-brand-item a' ).css({
					backgroundColor : to
				});
				
				$( '.pm_search_field_container #searchsubmit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-widget-star-rating li' ).css({
					color : to
				});
				
				$( '.comment-form-rating .stars span a' ).css({
					color : to
				});
				
				$( '.woocommerce-pagination .page-numbers li span.current' ).css({
					backgroundColor : to
				});
				
				$( '.pm-product-img-hover-container .onsale' ).css({
					backgroundColor : to
				});
				
				$( 'blockquote' ).css({
					borderLeft : "5px solid" + to
				});
				
				$( '.pm-event-info-ul-date li strong' ).css({
					color : to
				});
				
				$( '.pm-event-info-ul-date li p' ).css({
					color : to
				});
				
				$( '.header_donate_btn a' ).css({
					backgroundColor : to
				});
				
				$( '.pm_slider_btn_large' ).css({
					backgroundColor : to
				});
				
				$( '.pm_slider_btn a' ).css({
					backgroundColor : to
				});
				
				$( '#back-top a' ).css({
					color : to
				});
				
				$( '.pm-hover-item-details a' ).css({
					color : to
				});
				
				$( '.pm-hover-item-title-panel b' ).css({
					color : to
				});
				
				$( '.footer .recentcomments' ).css({
					color : to
				});
				
				$( '.tweet_list li a' ).css({
					color : to
				});
				
				$( '.newsletter_submit' ).css({
					backgroundColor : to
				});
				
				$( '.button-medium.searchBtn' ).css({
					backgroundColor : to
				});
				
				$( '.button-medium-theme.searchBtn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-event-widget-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-event-post-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm_events_container .pm_events_date p' ).css({
					color : to
				});
				
				$( '.pagination li.current' ).css({
					backgroundColor : to
				});
				
				$( '.searchBtn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-slider nav span.pm-prev' ).css({
					backgroundColor : convertHex(to, 70)
				});
				
				$( '.pm-slider nav span.pm-next' ).css({
					backgroundColor : convertHex(to, 70)
				});
							
			}			
		});		
	});	
	
	

	// Page layouts.
	/*wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );*/
	
	//convertHex('#A7D136',50)
	function convertHex(hex,opacity){
		hex = hex.replace('#','');
		r = parseInt(hex.substring(0,2), 16);
		g = parseInt(hex.substring(2,4), 16);
		b = parseInt(hex.substring(4,6), 16);
	
		result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
		return result;
	}

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	/*$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );*/

} )( jQuery );