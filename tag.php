<?php
/**
 * The template for displaying posts by tag
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
                
                <?php reactor_inner_content_before(); ?>
                
				<header class="archive-header row collapse">
                    <div class="large-4 medium-4 small-12 columns">
                        <h1 <?php post_class('archive-title'); ?>><?php echo single_tag_title( '', false ); ?></h1>
                    </div>
                    <div class="large-6 medium-6 hide-for-small columns">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-logo.png" alt="Coverage header logo" class="header-logo" />
                    </div>
                    <div class="clear"></div>
                </header><!-- .archive-header -->
                
				<?php // get the loop
				get_template_part('loops/loop', 'tagpage'); ?>
                
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->

            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>