<?php
/**
 * Theater Trial Theme Functions
 *
 * @package Theater Trial
 * @author Daniel J. Schneider (@schneidan) & Eric J. Lubbers (@ericjlubbers)
 * @since 0.1
 * @copyright Copyright (c) 2015, The Denver Post
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Child Theme Features
 * The following function will allow you to remove features included with Reactor
 *
 * Remove the comment slashes (//) next to the functions
 * For add_theme_support, remove values from arrays to disable parts of the feature
 * remove_theme_support will disable the feature entirely
 * Reference the functions.php file in Reactor for add_theme_support functions
 */
add_action('after_setup_theme', 'reactor_child_theme_setup', 11);


function reactor_child_theme_setup() {

    /* Support for menus */
	// remove_theme_support('reactor-menus');
	// add_theme_support(
	// 	'reactor-menus',
	// 	array('top-bar-l', 'top-bar-r', 'main-menu', 'side-menu', 'footer-links')
	// );
	
	/* Support for sidebars
	Note: this doesn't change layout options */
	remove_theme_support('reactor-sidebars');
	add_theme_support(
	   'reactor-sidebars',
	   array('primary', 'secondary', 'footer' )
	);
	
	/* Support for layouts
	Note: this doesn't remove sidebars */
	// remove_theme_support('reactor-layouts');
	// add_theme_support(
	// 	'reactor-layouts',
	// 	array('1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c')
	// );
	
	/* Support for custom post types */
	remove_theme_support('reactor-post-types');
	// add_theme_support(
	// 	'reactor-post-types',
	// 	array('slides', 'portfolio')
	// );
	
	/* Support for page templates */
	remove_theme_support('reactor-page-templates');
	add_theme_support(
	   'reactor-page-templates',
	 	array('front-page')
	);
	
	/* Remove support for background options in customizer */
	 remove_theme_support('reactor-backgrounds');
	
	/* Remove support for font options in customizer */
	// remove_theme_support('reactor-fonts');
	
	/* Remove support for custom login options in customizer */
	// remove_theme_support('reactor-custom-login');
	
	/* Remove support for breadcrumbs function */
	 remove_theme_support('reactor-breadcrumbs');
	
	/* Remove support for page links function */
	// remove_theme_support('reactor-page-links');
	
	/* Remove support for page meta function */
	// remove_theme_support('reactor-post-meta');
	
	/* Remove support for taxonomy subnav function */
	// remove_theme_support('reactor-taxonomy-subnav');
	
	/* Remove support for shortcodes */
	// remove_theme_support('reactor-shortcodes');
	
	/* Remove support for tumblog icons */
	 remove_theme_support('reactor-tumblog-icons');
	
	/* Remove support for other langauges */
	// remove_theme_support('reactor-translation');
		
}

// add a favicon to the site
function blog_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_bloginfo('stylesheet_directory').'/favicon.ico" />' . "\n";
}
add_action('wp_head', 'blog_favicon');
add_action('admin_head', 'blog_favicon');

// Hide the Wordpress admin bar for everyone
function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

// Function to add featured image in RSS feeds
function featured_image_in_rss($content)
{
    // Global $post variable
    global $post;
    // Check if the post has a featured image
    if (has_post_thumbnail($post->ID))
    {
        $content = get_the_post_thumbnail($post->ID, 'full', array('style' => 'margin-bottom:10px;')) . $content;
    }
    return $content;
}
// Add the filter for RSS feeds Excerpt
add_filter('the_excerpt_rss', 'featured_image_in_rss');
//Add the filter for RSS feed content
add_filter('the_content_feed', 'featured_image_in_rss');

// Disable those annoying pingbacks from our own posts
function disable_self_trackback( &$links ) {
  foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'disable_self_trackback' );

// remove Jetpack OpenGraph tags and Twitter Cards
add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );
add_filter( 'jetpack_disable_twitter_cards', '__return_true', 99 );

// allow script tags in editor
function allow_script_tags( $allowedposttags ){
  $allowedposttags['script'] = array(
      'src' => true,
      'height' => true,
      'width' => true,
    );
  return $allowedposttags;
}
add_filter('wp_kses_allowed_html','allow_script_tags', 1);

// Disables automatic Wordpress core updates:
define( 'WP_AUTO_UPDATE_CORE', false );

//This function intelligently trims a body of text to a certain number of words, but will not break a sentence.
function smart_trim($instring, $truncation) {
	//remove shortcodes (and thereby images and embeds)
    $instring = strip_shortcodes( $instring );
    //a little regex kills datelines
    $instring = preg_replace("/\A((([A-Z ]+)\\,\s?([a-zA-Z ]+)\\.?)|[A-Z]+)\s?(&#8211;|&#8212;?)\s?/u", "", $instring);
    //replace closing paragraph tags with a space to avoid collisions after punctuation
    $instring = str_replace("</p>", " ", $instring);
    //strip the HTML tags and then kill the entities
    $string = html_entity_decode( strip_tags($instring), ENT_QUOTES, 'UTF-8');

    $matches = preg_split("/\s+/", $string);
    $count = count($matches);

    if($count > $truncation) {
        //Grab the last word; we need to determine if
        //it is the end of the sentence or not
        $last_word = strip_tags($matches[$truncation-1]);
        $lw_count = strlen($last_word);

        //The last word in our truncation has a sentence ender
        if($last_word[$lw_count-1] == "." || $last_word[$lw_count-1] == "?" || $last_word[$lw_count-1] == "!") {
            for($i=$truncation;$i<$count;$i++) {
                unset($matches[$i]);
            }

        //The last word in our truncation doesn't have a sentence ender, find the next one
        } else {
            //Check each word following the last word until
            //we determine a sentence's ending
            $ending_found = false;
            for($i=($truncation);$i<$count;$i++) {
                if($ending_found != true) {
                    $len = strlen(strip_tags($matches[$i]));
                    if($matches[$i][$len-1] == "." || $matches[$i][$len-1] == "?" || $matches[$i][$len-1] == "!") {
                        //Test to see if the next word starts with a capital
                        if($matches[$i+1][0] == strtoupper($matches[$i+1][0])) {
                            $ending_found = true;
                        }
                    }
                } else {
                    unset($matches[$i]);
                }
            }
        }
        $body = implode(' ', $matches);
        return $body;
    } else {
        return $string;
    }
}


// Exclude Pages from search
function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');

/**
 * Include posts from authors in the search results where
 * either their display name or user login matches the query string
 *
 * @author danielbachhuber
 */
add_filter( 'posts_search', 'db_filter_authors_search' );
function db_filter_authors_search( $posts_search ) {

    // Don't modify the query at all if we're not on the search template
    // or if the LIKE is empty
    if ( !is_search() || empty( $posts_search ) )
        return $posts_search;

    global $wpdb;
    // Get all of the users of the blog and see if the search query matches either
    // the display name or the user login
    add_filter( 'pre_user_query', 'db_filter_user_query' );
    $search = sanitize_text_field( get_query_var( 's' ) );
    $args = array(
        'count_total' => false,
        'search' => sprintf( '*%s*', $search ),
        'search_fields' => array(
            'display_name',
            'user_login',
        ),
        'fields' => 'ID',
    );
    $matching_users = get_users( $args );
    remove_filter( 'pre_user_query', 'db_filter_user_query' );
    // Don't modify the query if there aren't any matching users
    if ( empty( $matching_users ) )
        return $posts_search;
    // Take a slightly different approach than core where we want all of the posts from these authors
    $posts_search = str_replace( ')))', ")) OR ( {$wpdb->posts}.post_author IN (" . implode( ',', array_map( 'absint', $matching_users ) ) . ")))", $posts_search );
    return $posts_search;
}
/**
 * Modify get_users() to search display_name instead of user_nicename
 */
function db_filter_user_query( &$user_query ) {

    if ( is_object( $user_query ) )
        $user_query->query_where = str_replace( "user_nicename LIKE", "display_name LIKE", $user_query->query_where );
    return $user_query;
}

// Attempts to permanently disable the Visual Editor for all users, all the time.
add_filter( 'user_can_richedit', '__return_false', 50 );

// allows using Disqus on development deployments
function childtheme_disqus_development() {
?>
  <script type="text/javascript">
  // see http://docs.disqus.com/help/83/
  var disqus_developer = 1; // developer mode is on
  </script>
<?php }

// only enable this if the server is a .dev domain name
if ( strpos($_SERVER['HTTP_HOST'], 'localhost') !== FALSE )
  add_action('wp_head', 'childtheme_disqus_development', 100);


/* an ad that can be pulled in my the front-page loop */
function dp_infinite_ad_widget($iteration) {
    echo '<div class="inline-cube-ad"><iframe src="' . get_stylesheet_directory_uri() . '/ad.html" style="margin:1em auto;width:300px;height:250px;overflow:hidden;border:none;"></iframe></div>';
}

/**
 * Infinite Scroll
 */
function custom_infinite_scroll_js() { ?>
    <script type="text/javascript">
    var infinite_scroll = {
        loading: {
            img: "<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif",
            msgText: "<?php _e( 'Loading more posts...', 'custom' ); ?>",
            finishedMsg: "<?php _e( 'All posts loaded.', 'custom' ); ?>"
        },
        "nextSelector":"ul.pagination li a.next",
        "navSelector":"ul.pagination",
        "itemSelector":".infinite-article",
        "contentSelector":"#frontpagemain",
        "bufferPx":80
    };
    jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll, function(newElements) {
            jQuery( infinite_scroll.contentSelector ).append('<div class="row"><div class="large-12 medium-12 small-12 text-center columns"><div class="inline-cube-ad"><iframe src="<?php echo get_stylesheet_directory_uri(); ?>/ad.html" style="margin:1em auto;width:300px;height:250px;overflow:hidden;border:none;"></iframe></div></div></div>');
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'custom_infinite_scroll_js', 100 );

/**
 * Video embeds
**/
function create_video_embed( $video_ID ){
    ?>
    <div class="vid-embed-wrap" id="videoEmbed">
      <div class="vid-height-space"></div>
        <div class="vid-embed video_<?php echo get_the_ID(); ?>" id="vid_<?php echo get_the_ID(); ?>" onclick="OO.Player.create('vid_<?php echo get_the_ID(); ?>', '<?php echo $video_ID; ?>', {'autoplay':true});"></div>
      <style>
         .video_<?php echo get_the_ID(); ?> { background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>') }
      </style>
        <div class="clear"></div>
      <img class=" <?php reactor_columns( array(3, 3, 3) ); ?> play_icon" src="<?php echo get_stylesheet_directory_uri() ?>/images/icon-pressplay.png" />
    </div>
   <?php
}

/**
 * A way to get the URL of the current page -- not the current post in the loop
 */
function get_current_page_url() {
    $pageURL = 'http';
    if( isset($_SERVER["HTTPS"]) ) {
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

/**
 * Completely disable all comments and pingbacks
 */

// Disable support for comments and trackbacks in post types
function tt_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'tt_disable_comments_post_types_support');

// Close comments on the front-end
function tt_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'tt_disable_comments_status', 20, 2);
add_filter('pings_open', 'tt_disable_comments_status', 20, 2);

// Hide existing comments
function tt_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'tt_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function tt_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'tt_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function tt_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'tt_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function tt_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'tt_disable_comments_dashboard');

// Remove comments links from admin bar
function tt_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'tt_disable_comments_admin_bar');

/**
 * Remove image links
 */
function remove_media_link( $form_fields, $post ) {
    unset( $form_fields['url'] );
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'remove_media_link', 10, 2 );
update_option('image_default_link_type','none');

function tt_change_feed_item_url( $url )
{
    $alt_link = get_post_meta( get_the_ID(), 'target_link', true );
    if ( wp_validate_redirect( $alt_link, $url ) ) {
        echo $alt_link;
    } else {
        echo home_url() . '/#post-' . get_the_ID();
    }
}
add_filter( 'the_permalink_rss', 'tt_change_feed_item_url', 20, 1 );


/**
 * Category and tag previous/next buttons
 * 
 * @since 1.0.0
 */
function tt_archive_next_prev() {
    if ( is_category() ) {
        $args = array(
            'orderby'       => 'name',
            'hide_empty'    => true
            );
        $categories = get_categories( $args );
        foreach( $categories as $all_cat ) {
            $cat_ids[] = $all_cat->term_id;
        }
        $this_cat = get_query_var( 'cat' );
        $this_cat_position = array_search( $this_cat, $cat_ids );
     
        $prev_cat_position = $this_cat_position - 1;
        if( $prev_cat_position >= 0 ) {
            $prev_cat_id = array_slice( $cat_ids, $prev_cat_position, 1 );
            echo '<div class="large-2 medium-3 small-4 left">';
            echo '<a href="' . get_category_link( $prev_cat_id[0] ) . '">&laquo; ' . get_category( $prev_cat_id[0] )->name . '</a>';
            echo '</div>';
        }
     
        $next_cat_position = $this_cat_position + 1;
        if( $next_cat_position < count( $cat_ids ) ) {
            $next_cat_id = array_slice( $cat_ids, $next_cat_position, 1 );
            echo '<div class="large-2 medium-3 small-4 right">';
            echo '<a href="' . get_category_link( $next_cat_id[0] ) . '">' . get_category( $next_cat_id[0] )->name . ' &raquo;</a>';
            echo '</div>';
        }
    } else if ( is_tag() ) {
        $args = array(
            'orderby'       => 'name',
            'name__like'    => 'Day ',
            'hide_empty'    => true
            );
        $tags = get_tags( $args );
        foreach( $tags as $all_tag ) {
            $tag_ids[] = $all_tag->term_id;
        }
        $curr_tag = get_query_var( 'tag' );
        $this_tag = get_term_by( 'slug', $curr_tag, 'post_tag')->term_id;
        $this_tag_position = array_search( $this_tag, $tag_ids );
     
        $prev_tag_position = $this_tag_position - 1;
        if( $prev_tag_position >= 0 ) {
            $prev_tag_id = array_slice( $tag_ids, $prev_tag_position, 1 );
            echo '<div class="large-2 medium-3 small-4 left">';
            echo '<a href="' . get_tag_link( $prev_tag_id[0] ) . '">&laquo; ' . get_tag( $prev_tag_id[0] )->name . '</a>';
            echo '</div>';
        }
     
        $next_tag_position = $this_tag_position + 1;
        if( $next_tag_position < count( $tag_ids ) ) {
            $next_tag_id = array_slice( $tag_ids, $next_tag_position, 1 );
            echo '<div class="large-2 medium-3 small-4 right">';
            echo '<a href="' . get_tag_link( $next_tag_id[0] ) . '">' . get_tag( $next_tag_id[0] )->name . ' &raquo;</a>';
            echo '</div>';
        }
    }
}
