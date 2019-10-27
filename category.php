<?php get_header(); ?>

<?php 
$blogTemplateLayout = get_theme_mod('blogTemplateLayout', 'full-width');
?>

<?php
	//global $paged;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$arguments = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $paged,
		'cat' => get_query_var('cat')
	);

	$blog_query = new WP_Query($arguments);

	
?>

<div class="container pm_paddingVertical60 pm_posts">
    <div class="row">
    
    	<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                
            <!-- LOOP -->
            
            <div class="span4">
                <article <?php post_class(); ?>>
                    <?php get_template_part( 'content', 'post' ); ?>
                </article>
            </div>
            
            <!-- LOOP -->
        
        <?php endwhile; else: ?>
             <p><?php esc_attr_e('No posts were found.', 'localization'); ?></p>
        <?php endif; ?> 
        
        
        <div class="span12">
        <?php  
            if(function_exists('pm_hope_kriesi_pagination')){
                pm_hope_kriesi_pagination();
            } else {
                posts_nav_link();	
            } 
            wp_reset_postdata();  
        ?>
        </div> 
    
    </div>
</div>

<?php get_footer(); ?>