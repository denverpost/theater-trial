<?php
/**
 * The template for displaying all single posts
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

	<div id="primary" class="site-content">
    
    	<?php reactor_content_before(); ?>
    
        <div id="content" role="main">
        	<div class="row">
                <div class="large-8 medium-12 small-12 large-centered medium-centered columns" id="frontpagemain">
                
                <header class="archive-header row collapse">
                    <div class="large-10 medium-10 small-12 large-centered medium-centered columns page-header">
                        <a href="<?php echo home_url(); ?>" title="Homepage link"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-logo.png" alt="Coverage header logo" class="header-logo" /></a>
                    </div>
                    <div class="clear"></div>
                </header><!-- .archive-header -->
                
                <?php reactor_inner_content_before(); ?>
                
					<?php // start the loop
                    while ( have_posts() ) : the_post(); ?>
                    
                    <div class="large-3 medium-12 small-12 columns">
                        <?php reactor_post_before(); ?>
                    </div>

                    <div class="large-9 medium-12 small-12 columns">
                        <?php // get post format and display template for that format
                            get_template_part('post-formats/format', 'frontpage'); ?>
                    </div>
                    
                    <div class="row">
                        <div class="large-12 medium-12 small-12 text-center columns">
                        <?php dp_infinite_ad_widget($post->ID); ?>
                        </div>
                    </div>
        
                    <?php endwhile; // end of the loop ?>
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>