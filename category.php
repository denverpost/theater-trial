<?php
/**
 * The template for displaying posts by category
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
                
                <div class="large-9 medium-10 hide-for-small large-centered medium-centered columns page-header">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-logo.png" alt="Coverage header logo" class="header-logo" />
                </div>

                <header class="archive-header row collapse">
                    <?php tt_archive_next_prev(); ?>
                    <div class="large-8 medium-6 small-12 large-centered medium-centered columns">
                        <h1 <?php post_class('archive-title'); ?>><?php echo single_cat_title( '', false ); ?></h1>
                    </div>
                    <div class="clear"></div>
                </header><!-- .archive-header -->
                
				<?php // get the loop
				get_template_part('loops/loop', 'catpage'); ?>
                
                </div><!-- .columns -->

            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>