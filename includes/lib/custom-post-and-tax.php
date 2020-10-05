<?php
function custom_post_types_and_custom_taxonomies(){

  register_post_type( 'live-event', array(
    'labels' => array(
      'name' => __( 'Live Events' ),
      'singular_name' => __( 'Live Event' ),
      'add_new' => __( 'Add New Live Event' ),
      'add_new_item' => __( 'Add New Live Event' ),
      'edit_item' => __( 'Edit Live Event' ),
      'new_item' => __( 'New Live Event' ),
      'view_item' => __( 'View Live Event' ),
      'search_items' => __( 'Search Live Events' ),
      'not_found' => __( 'No Live Events found' ),
      'not_found_in_trash' => __( 'No Live Events found in Trash' ),
      'parent_item_colon' => __( 'Parent Live Event:' ),
      'menu_name' => __( 'Live Events' )
    ),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'live', 'with_front' => false ),
    'capability_type' => 'page',
    'exclude_from_search' => true,
    'has_archive' => false,
    'hierarchical' => true,
    'menu_position' => 21,
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-video-alt3',
    'supports' => array( 'title', 'thumbnail', 'revisions' )
  ));

  register_taxonomy( 'event-type', array( 'live-event' ), array(
    'labels'	   => array(
      'name' => __( 'Event Types' ),
      'singular_name' => __( 'Event Type' ),
      'search_items' => __( 'Search Event Types' ),
      'all_items' => __( 'All Event Types' ),
      'parent_item' => __( 'Parent Event Type' ),
      'parent_item_colon' => __( 'Parent Event Type:' ),
      'edit_item' => __( 'Edit Event Type' ),
      'update_item' => __( 'Update Event Type' ),
      'add_new_item' => __( 'Add New Event Type' ),
      'new_item_name' => __( 'New Genre Event Type' ),
      'menu_name' => __( 'Event Types' ),
    ),
    'hierarchical' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'live-events/event-types' )
  ) );
  flush_rewrite_rules();
}
add_action( 'init', 'custom_post_types_and_custom_taxonomies' );
?>
