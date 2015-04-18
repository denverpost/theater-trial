<?php
/**
 * Post Content
 * hook in the content for post formats
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Post category overline Icons
 * in all formats when tumblog icons are enabled
 * 
 * @since 1.0.0
 */
function reactor_do_overline() {
	if ( is_single() ) {
		$categories_list = '';
		$categories = get_the_category();
		foreach($categories as $category) {
			if ( strtolower($category->slug) != 'uncategorized' && $category->category_parent == 0) {
				$categories_list = $category;
			}
		} ?>
        <header class="archive-header">
            <h2 <?php post_class('archive-title'); ?>><a href="<?php echo get_category_link(intval($categories_list->term_id) ); ?>"><?php echo $categories_list->cat_name; ?></a></h2>
        </header><!-- .archive-header -->
	<?php }
}
//add_action('reactor_post_before', 'reactor_do_overline', 2);

/**
 * Post header meta
 * in all formats
 * 
 * @since 1.0.0
 */
function reactor_do_post_header_meta() {

	reactor_post_meta( array( 'date_only'=>true ) );
	global $wp;
	global $post;

	$classes = ' ' . implode( ' ', get_post_class() );
	$text = html_entity_decode(get_the_title());
	if ( (is_single() || is_page() ) && has_post_thumbnail($post->ID) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	} else {
		$image = get_stylesheet_directory_uri() . '/images/logo-large.png';
	}
	$desc = ( get_the_excerpt() != '' ? get_the_excerpt() : get_bloginfo('description') );
	$post_url = urlencode( get_current_page_url() . '#post-' . $post->ID );
	$social_string = '<div class="post-body-social' . $classes . '"><ul class="inline-list">';
	//Twitter button
	$social_string .= sprintf(
	    '<li class="post-meta-social pm-twitter"><a href="javascript:void(0)" onclick="javascript:window.open(\'http://twitter.com/share?text=%1$s&amp;url=%2$s&amp;via=%3$s&amp;hashtags=%4$s\', \'twitwin\', \'left=20,top=20,width=500,height=500,toolbar=1,resizable=1\');"><span class="fi-social-twitter"></span></a></li>',
	    urlencode( html_entity_decode( $text, ENT_COMPAT, 'UTF-8') . ':' ),
	    $post_url,
	    'denverpost',
	    'theatershooting'
	);
	//Facebook share
	$social_string .= sprintf(
	    '<li class="post-meta-social pm-facebook"><a href="javascript:void(0)" onclick="javascript:window.open(\'http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]=%1$s&amp;p[images][0]=%2$s&amp;p[title]=%3$s&amp;p[summary]=%4$s\', \'fbwin\', \'left=20,top=20,width=500,height=500,toolbar=1,resizable=1\');"><span class="fi-social-facebook"></span></a></li>',
	    $post_url,
	    rawurlencode( $image[0] ),
	    urlencode( html_entity_decode( $text, ENT_COMPAT, 'UTF-8' ) ),
	    urlencode( html_entity_decode( $desc, ENT_COMPAT, 'UTF-8' ) )
	);
	//Google plus share
	$social_string .= sprintf(
	    '<li class="post-meta-social pm-googleplus"><a href="javascript:void(0)" onclick="javascript:window.open(\'http://plus.google.com/share?url=%1$s\', \'gpluswin\', \'left=20,top=20,width=500,height=500,toolbar=1,resizable=1\');"><span class="fi-social-google-plus"></span></a></li>',
	    $post_url
	);
	//Linkedin share
	$social_string .= sprintf(
	    '<li class="post-meta-social pm-linkedin"><a href="javascript:void(0)" onclick="javascript:window.open(\'http://www.linkedin.com/shareArticle?mini=true&amp;url=%1$s&amp;title=%2$s&amp;source=%3$s\', \'linkedwin\', \'left=20,top=20,width=500,height=500,toolbar=1,resizable=1\');"><span class="fi-social-linkedin"></span></a></li>',
	    $post_url,
	    urlencode( html_entity_decode( $text, ENT_COMPAT, 'UTF-8' ) ),
	    'http://www.denverpost.com'
	);
	//Reddit submit
	$social_string .= sprintf(
	    '<li class="post-meta-social pm-reddit"><a href="javascript:void(0)" onclick="javascript:window.open(\'http://www.reddit.com/submit?url=%1$s&amp;title=%2$s\', \'redditwin\', \'left=20,top=20,width=900,height=700,toolbar=1,resizable=1\');"><span class="fi-social-reddit"></span></a></li>',
	    $post_url,
	    urlencode( html_entity_decode( $text, ENT_COMPAT, 'UTF-8' ) )
	);
	$social_string .= '<div class="clear"></div></ul></div>';
	echo $social_string;
}
add_action( 'reactor_post_before', 'reactor_do_post_header_meta', 1 );

/**
 * Front page main format
 * in format-standard
 * 
 * @since 1.0.0
 */
function reactor_post_frontpage_format() {

	if ( has_post_thumbnail() ) {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
	}
	$vidembed = get_post_meta( get_the_ID(), 'video_ID', true );	
	if ( $vidembed ) {
		?> <div class="frontpage-post"> 
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<?php create_video_embed( $vidembed );
	} else if ( isset( $large_image_url ) && strlen( $large_image_url[0] ) >= 1 ) { ?>
		<div class="frontpage-image frontpage-post">
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<div class="front-thumbnail" style="background-image:url('<?php echo $large_image_url[0]; ?>');">
				<div class="front-imgholder"></div>
			</div>
	<?php } else { ?>
		<div class="frontpage-post">
			<h2 class="entry-title"><?php the_title(); ?></h2>
	<?php } ?>
	</div>
<?php }
add_action('reactor_post_frontpage', 'reactor_post_frontpage_format', 1);

/**
 * Post header
 * in format-standard
 * 
 * @since 1.0.0
 */
function reactor_do_standard_header_titles() {
	$show_titles = reactor_option('frontpage_show_titles', 1);
	$link_titles = reactor_option('frontpage_link_titles', 0);
	if ( !$link_titles ) { ?>
		<h2 class="entry-title"><?php the_title(); ?></h2>
	<?php } else { ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __('%s', 'reactor'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php }
}
add_action('reactor_post_header', 'reactor_do_standard_header_titles', 3);

/**
 * Post thumbnail
 * in format-standard
 * 
 * @since 1.0.0
 */
function reactor_do_standard_thumbnail() { 
	$link_titles = reactor_option('frontpage_link_titles', 0);
	
	if ( has_post_thumbnail() ) { 
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		?>
		<div class="entry-thumbnail">
			<div class="mainimgholder"></div>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><div class="mainimg" style="background-image:url('<?php echo $large_image_url[0]; ?>');"></div></a>
		</div>
	<?php }
}
add_action('reactor_post_header', 'reactor_do_standard_thumbnail', 4);

/**
 * Single post nav 
 * in single.php
 * 
 * @since 1.0.0
 */
function reactor_do_nav_single() {
    if ( is_single() ) { 
    $exclude = ( reactor_option('frontpage_exclude_cat', 1) ) ? reactor_option('frontpage_post_category', '') : ''; ?>
        <nav class="nav-single">
            <!-- <span class="nav-previous alignleft">
            <?php //previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'reactor') . '</span> %title', false, $exclude); ?>
            </span> -->
            <span class="nav-next">
            <?php next_post_link('%link', 'Up next: %title', false, $exclude); ?>
            </span>
        </nav><!-- .nav-single -->
<?php }
}
add_action('reactor_post_after', 'reactor_do_nav_single', 1);

/**
 * No posts format
 * loop else in page templates
 * 
 * @since 1.0.0
 */
function reactor_do_loop_else() {
	get_template_part('post-formats/format', 'none');
}
add_action('reactor_loop_else', 'reactor_do_loop_else', 1);

?>