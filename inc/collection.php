<?php

/*-------------------------------------------------------------------------------------------*/
/* bv_collection_post Post Type */
/*-------------------------------------------------------------------------------------------*/
class collection {
	
	function collection() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => 'Collections',
		    'singular_name' => 'Collection',
		    'add_new' => 'Add New Collection',
		    'all_items' => 'All Collections',
		    'add_new_item' => 'Add New Collection',
		    'edit_item' => 'Edit Collection',
		    'new_item' => 'New Collection',
		    'view_item' => 'View Collection',
		    'search_items' => 'Search Collection',
		    'not_found' =>  'No Collection found',
		    'not_found_in_trash' => 'No Collection found in trash', 
		    'parent_item_colon' => 'Parent Collection:',
		    'menu_name' => 'Collections' 
		);
		$args = array(
			'labels' => $labels,
			'description' => "A description for your Collection",
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_nav_menus' => true, 
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 20,
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array('title','editor','thumbnail','excerpt','custom-fields'), 
			'has_archive' => true,
			'rewrite' => false,
			'query_var' => true, 
			'can_export' => true
		); 
		register_post_type('collection',$args);
	}
}

$collection = new collection();


?>