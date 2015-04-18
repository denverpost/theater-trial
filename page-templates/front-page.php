<?php
/**
 * Template Name: Front Page
 *
 * @package Reactor
 * @subpackage Page-Templates
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
                    <div class="large-10 medium-10 small-12 large-centered medium-centered columns">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-logo.png" alt="Coverage header logo" class="header-logo" />
                    </div>
                    <div class="clear"></div>
                </header><!-- .archive-header -->

                <?php reactor_inner_content_before(); ?>
                        
                    <?php get_template_part('loops/loop', 'frontpage'); ?>
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>
