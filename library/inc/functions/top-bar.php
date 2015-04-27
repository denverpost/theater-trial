<?php 
/**
 * Top Bar Function
 * output code for the Foundation top bar structure
 * 
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if ( !function_exists('reactor_top_bar') ) {
	function reactor_top_bar( $args = '' ) {

		$defaults = array(
			'title'      => get_option( 'topbar_title', get_bloginfo('name') ),
			'title_url'  => home_url(),
			'menu_name'  => '',
			'left_menu'  => 'reactor_top_bar_l',
			'right_menu' => 'reactor_top_bar_r',
			'fixed'      => false,
			'contained'  => true,
			'sticky'     => false,
		);
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'reactor_top_bar_args', $args );
		
		/* call functions to create right and left menus in the top bar. defaults to the registered menus for top bar */
        $left_menu = ( ( $args['left_menu'] && is_callable( $args['left_menu'] ) ) ) ? call_user_func( $args['left_menu'], (array) $args ) : '';
        $right_menu = ( ( $args['right_menu'] && is_callable( $args['right_menu'] ) ) ) ? call_user_func( $args['right_menu'], (array) $args ) : '';
		
		// assemble classes for top bar
		$classes = array(); $output = '';
		$classes[] = ( $args['fixed'] ) ? 'fixed' : '';
		$classes[] = ( $args['contained'] ) ? 'contain-to-grid' : '';
		$classes[] = ( $args['sticky'] ) ? 'sticky' : '';
		$classes = array_filter( $classes );
		$classes = implode( ' ', array_map( 'esc_attr', $classes ) );
		
		// start top bar output
		if ( has_nav_menu('top-bar-l') || has_nav_menu('top-bar-r') ) {
			$output .= '<div class="top-bar-container ' . $classes . '">';
				$output .= '<nav class="top-bar" data-topbar>';
					$output .= '<ul class="title-area">';
						$output .= '<li class="name">';
							$output .= '<a href="http://www.denverpost.com"><img src="' . get_stylesheet_directory_uri() . '/images/logo-dp-small.png" /></a>';
							$output .= '<p><a href="' . $args['title_url'].'">' . $args['title'] . '</a></p>';
						$output .= '</li>';
						$output .= '<li class="toggle-topbar menu-icon"><a href="#"><span>' . $args['menu_name'] . '</span></a></li>';
					$output .= '</ul>';
					$output .= '<section class="top-bar-section">';
						$output .= reactor_topbar_parts();
						$output .= reactor_topbar_days();
						$output .= $right_menu;
					$output .= '</section>';
				$output .= '</nav>';
			$output .= '</div>';
			
		echo apply_filters('reactor_top_bar', $output, $args);	
	    }
	}
}


/**
 * Function to use search form in top bar
 * this chould be used as the callback for top bar menus
 *
 * @since 1.0.0
 */
if(!function_exists('reactor_topbar_days')) {
	function reactor_topbar_days( $args = '' ) {

		$args = array(
	        'orderby'       => 'name',
	        'name__like'    => 'Day ',
	        'hide_empty'    => true
	        );
	    $tags = get_tags( $args );

	    $output  = '<ul class="right"><li class="has-form"><div class="row collapse">';
	    $output .= '<select onChange="window.top.location.href=this.value">';
	    $output .= '<option selected disabled hidden value="">By Day</option>';
	    
	    foreach ( $tags as $tag ) {
	        $tag_link = get_tag_link( $tag->term_id );
	                
	        $output .= '<option value="' . $tag_link . '" title="' . $tag->name . '" class="' . $tag->slug . '">' . $tag->name . '</option>';
	    }
	    
	    $output .= '</select>';
		$output .= '</div></li></ul>';
	    
		return apply_filters('reactor_search_form', $output);
	}
}

/**
 * Function to use search form in top bar
 * this chould be used as the callback for top bar menus
 *
 * @since 1.0.0
 */
if(!function_exists('reactor_topbar_parts')) {
	function reactor_topbar_parts( $args = '' ) {
	
		$args = array(
	        'orderby'       => 'name',
	        'hide_empty'    => true
	        );
	    $categories = get_categories( $args );

	    $output  = '<ul class="right"><li class="has-form"><div class="row collapse">';
	    $output .= '<select onChange="window.top.location.href=this.value">';
	    $output .= '<option selected disabled hidden value="">By Segment</option>';
	    
	    foreach ( $categories as $category ) {
	    	if ( strtolower( $category->name ) != 'uncategorized' ) {
		        $category_link = get_category_link( $category->term_id );
		                
		        $output .= '<option value="' . $category_link . '" title="' . $category->name . '" class="' . $category->slug . '">' . $category->name . '</option>';
		    }
	    }
	    
	    $output .= '</select>';
		$output .= '</div></li></ul>';
	    
		return apply_filters('reactor_search_form', $output);
	}
}

/**
 * Function to use search form in top bar
 * this chould be used as the callback for top bar menus
 *
 * @since 1.0.0
 */
if(!function_exists('reactor_topbar_search')) {
	function reactor_topbar_search( $args = '' ) {
	
		$defaults = array(
			'side' => 'right',
		 );
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'reactor_top_bar_args', $args );
		
		$output  = '<ul class="' . $args['side'] . '"><li class="has-form">';
		$output .= '<form role="search" method="get" id="searchform" action="' . home_url() . '"><div class="row collapse">';
		$output .= '<div class="large-8 small-8 columns">';
		$output .= '<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__('Search', 'reactor') . '" />';
		$output .= '</div>';
		$output .= '<div class="large-4 small-4 end columns">';
		$output .= '<input class="button prefix" type="submit" id="searchsubmit" value="' . esc_attr__('Search', 'reactor') . '" />';
		$output .= '</div>';
		$output .= '</div></form>';	
		$output .= '</li></ul>';
		
		//return apply_filters('reactor_search_form', $output);
	}
}
