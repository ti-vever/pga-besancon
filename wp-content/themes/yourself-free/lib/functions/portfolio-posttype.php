<?php

/************************************************************/
//			CREATE PORTFOLIO POST TYPE
/************************************************************/

/* codex : 
   http://codex.wordpress.org/Function_Reference/register_post_type 
   http://codex.wordpress.org/Function_Reference/register_taxonomy	   
*/

/* Register post type */

function pi_create_portfolio_post_type() 
{
	$labels = array(
		'name' => __( 'Portfolio', 'theme_textdomain' ),
		'singular_name' => __( 'Portfolio', 'theme_textdomain' ),
		'rewrite' => array('slug' => __( 'portfolios', 'theme_textdomain' )),
		'add_new' => _x('Add New', 'portfolio'),
		'add_new_item' => __('Add New Portfolio', 'theme_textdomain'),
		'edit_item' => __('Edit Portfolio', 'theme_textdomain'),
		'new_item' => __('New Portfolio', 'theme_textdomain'),
		'view_item' => __('View Portfolio', 'theme_textdomain'),
		'search_items' => __('Search Portfolio', 'theme_textdomain'),
		'not_found' =>  __('No portfolios found', 'theme_textdomain'),
		'not_found_in_trash' => __('No portfolios found in Trash', 'theme_textdomain'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields','excerpt', 'comments')
	  ); 
	  
	  register_post_type(__( 'portfolio', 'theme_textdomain' ),$args);
}


/* Update messages */

function pi_portfolio_updated_messages( $messages ) {

  $messages[__( 'portfolio' )] = 
  	array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Portfolio updated. <a href="%s">View portfolio</a>', 'theme_textdomain'), esc_url( get_permalink() ) ),
		2 => __('Custom field updated.', 'theme_textdomain'),
		3 => __('Custom field deleted.', 'theme_textdomain'),
		4 => __('Portfolio updated.', 'theme_textdomain'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s', 'theme_textdomain'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Portfolio published. <a href="%s">View portfolio</a>', 'theme_textdomain'), esc_url( get_permalink() ) ),
		7 => __('Portfolio saved.', 'theme_textdomain'),
		8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview portfolio</a>', 'theme_textdomain'), esc_url( add_query_arg( 'preview', 'true', get_permalink() ) ) ),
		9 => sprintf( __('Portfolio scheduled. <a target="_blank" href="%s">Preview portfolio</a>', 'theme_textdomain'), esc_url( get_permalink() ) ),
		10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview portfolio</a>', 'theme_textdomain'), esc_url( add_query_arg( 'preview', 'true', get_permalink() ) ) ),
  );
  
  return $messages;
  
}  


/* Register taxonomies */

function pi_register_portfolio_taxonomies(){
	register_taxonomy("portfolio-category", array("portfolio"), array("hierarchical" => true, "label" => __( "Portfolio Categories", 'theme_textdomain' ), "singular_label" => __( "Portfolio Category", 'theme_textdomain' ), "rewrite" => array('slug' => 'portfolio-category', 'hierarchical' => true)));
}

add_action( 'init', 'pi_register_portfolio_taxonomies', 0 );
add_action( 'init', 'pi_create_portfolio_post_type' );
add_filter('post_updated_messages', 'pi_portfolio_updated_messages');
?>