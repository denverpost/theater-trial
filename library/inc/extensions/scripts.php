<?php
/**
 * Theater Trial Scripts
 * WordPress will add these scripts to the theme
 * 
 * @package Theater Trial
 * @author Daniel J. Schneider (@schneidan) & Eric J. Lubbers (@ericjlubbers)
 * @since 0.1
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see wp_register_script
 * @see wp_enqueue_script
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

add_action('wp_enqueue_scripts', 'reactor_register_scripts', 1);
add_action('wp_enqueue_scripts', 'reactor_enqueue_scripts');
 
function reactor_register_scripts() {
	// register scripts
	wp_register_script('modernizr-js', get_template_directory_uri() . '/library/js/vendor/custom.modernizr.js', array(), false, false);
	wp_register_script('jqueryui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js', array(), false, false);
	wp_register_script('foundation-js', get_template_directory_uri() . '/library/js/foundation.min.js', array(), false, true);
	wp_register_script('reactor-js', get_template_directory_uri() . '/library/js/reactor.js', array(), false, true);
	wp_register_script('mixitup-js', get_template_directory_uri() . '/library/js/mixitup.min.js', array(), false, true);
	//Added DJS
	wp_register_script('dfmcore-js', '//local.digitalfirstmedia.com/common/dfm/assets/js/dfm-core-level1.js', array(), false, false);
	wp_register_script('tt-functions', get_stylesheet_directory_uri() . '/library/js/functions.js', array(), false, true);
	wp_register_script('gads-js', '//www.googletagservices.com/tag/js/gpt.js', array(), false, false);
	wp_register_script('jquery-infinite', get_stylesheet_directory_uri() . '/library/js/jquery.infinitescroll.min.js', array(), false, true);
}

function reactor_enqueue_scripts() {
	if ( !is_admin() ) { 
		// enqueue scripts
		wp_enqueue_script('jquery');
		//wp_enqueue_script('zepto-js');
		wp_enqueue_script('modernizr-js');
		wp_enqueue_script('jqueryui');
		wp_enqueue_script('foundation-js');
		wp_enqueue_script('reactor-js');
		//Added DJS
		wp_enqueue_script('dfmcore-js');
		wp_enqueue_script('tt-functions');
		wp_enqueue_script('gads-js');
		wp_enqueue_script('jquery-infinite');

		// enqueue quicksand on portfolio page template
		if ( is_page_template('page-templates/portfolio.php') ) {
			wp_enqueue_script('mixitup-js');
		}
		
		// comment reply script for threaded comments
		if ( is_singular() && comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script('comment-reply'); 
		}
	}
}