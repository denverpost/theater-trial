<?php
/**
 * The loop for displaying posts on the front page template
 *
 * @package Reactor
 * @subpackage loops
 * @since 1.0.0
 */
?>

<?php // get the options
$post_category = reactor_option('frontpage_post_category', '');
if ( -1 == $post_category ) { $post_category = ''; } // fix customizer -1
$number_posts = reactor_option('frontpage_number_posts', 3);
$post_columns = reactor_option('frontpage_post_columns', 3);
$page_links = reactor_option('frontpage_page_links', 0); ?>

					<?php // start the loop
					if ( get_query_var('paged') ) {
						$paged = get_query_var('paged');
					} elseif ( get_query_var('page') ) {
						$paged = get_query_var('page');
					} else {
						$paged = 1;
					}
	                $args = array( 
						'post_type'           => 'post',
						'cat'                 => $post_category,
						'posts_per_page'      => $number_posts,
						'paged'               => $paged
						);
					
					global $frontpage_query;
                    $frontpage_query = new WP_Query( $args ); ?>
                          
				    <?php if ( $frontpage_query->have_posts() ) : $i=0; ?>
                    
                    <?php reactor_loop_before(); ?>
                        
                        <?php while ( $frontpage_query->have_posts() ) : $frontpage_query->the_post(); global $more; $more = 0; $i++; ?>
                        	
                            <div class="row">
                            	<div class="large-3 medium-4 small-12 columns">
	                            	<?php reactor_post_before(); ?>
	                            </div>
                                
                                <div class="large-9 medium-8 small-12 columns">
	                                <?php // get post format and display template for that format
						            	get_template_part('post-formats/format', 'frontpage'); ?>
								</div>
							</div>

							<?php // try to insert an ad
							if ( $i % 5 == 0 ) { ?>
								<div class="row">
	                            	<div class="large-12 medium-12 small-12 text-center columns">
	                            	<?php dp_infinite_ad_widget($post->ID); ?>
									</div>
								</div>
							<?php } ?>

                        <?php endwhile; // end of the loop ?>

                    <?php reactor_loop_after(); ?>
                            
                    <?php // if no posts are found
					else : reactor_loop_else(); ?>

                    <?php endif; // end have_posts() check ?>