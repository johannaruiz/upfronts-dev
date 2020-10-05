<?php

function add_developer_role(){

  // Add Developer Role, Essentially admin with a different name.
  // A workaround to hide menu items available to an admin from the dashboard.
  $result = add_role( 'developer', __('Developer' ), array(
    'activate_plugins' => true,
    'delete_others_pages' => true,
    'delete_others_posts' => true,
    'delete_pages' => true,
    'delete_posts' => true,
    'delete_private_pages' => true,
    'delete_private_posts' => true,
    'delete_published_pages' => true,
    'delete_published_posts' => true,
    'edit_dashboard' => true,
    'edit_others_pages' => true,
    'edit_others_posts' => true,
    'edit_posts' => true,
    'edit_pages' => true,
    'edit_private_posts' => true,
    'edit_private_pages' => true,
    'edit_published_posts' => true,
    'edit_published_pages' => true,
    'edit_theme_options' => true,
    'export' => true,
    'import' => true,
    'list_users' => true,
    'manage_categories' => true,
    'manage_links' => true,
    'manage_options' => true,
    'moderate_comments' => true,
    'promote_users' => true,
    'publish_pages' => true,
    'publish_posts' => true,
    'read_private_pages' => true,
    'read_private_posts' => true,
    'read' => true,
    'remove_users' => true,
    'switch_themes' => true,
    'upload_files' => true,
    'customize' => true,
    'delete_site' => true,
    'update_core' => true,
    'update_plugins' => true,
    'update_themes' => true,
    'install_plugins' => true,
    'install_themes' => true,
    'upload_plugins' => true,
    'upload_themes' => true,
    'delete_themes' => true,
    'delete_plugins' => true,
    'edit_plugins' => true,
    'edit_themes' => true,
    'edit_files' => true,
    'edit_users' => true,
    'create_users' => true,
    'delete_users' => true,
    'unfiltered_html' => true
    )
  );

  // Checks to see if the Role exists
  if ( null !== $result ):
    echo "New Role Created";
  else:
    echo "The Developer role already exists";
  endif;

  // Get the current User and add the role of user to them.
  if ( current_user_can('administrator') ):
    $current_user = wp_get_current_user();
    $current_user->add_role('developer');
  else:
  endif;
}

/**
 * Clean up script tags loaded by WordPress
 */
add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($input) {
  $input = str_replace("type='text/javascript' ", '', $input);
  return str_replace("'", '"', $input);
}

/**
 * Clean up CSS link tags loaded by WordPress
 */
add_filter('style_loader_tag', 'clean_style_tag');
function clean_style_tag($input){
  $input = str_replace("type='text/css' ", '', $input);
  return str_replace("'", '"', $input);
}

/**
 * ACF Google Maps API Key Initialization
 */
function my_acf_init() {
  acf_update_setting('google_api_key', 'YOURAPIGOESHERE`');
}

add_action('acf/init', 'my_acf_init');

/**
 * Function to generate UUID with PHP
 */
function generate_uuid() {
  return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    mt_rand( 0, 0xffff ),
    mt_rand( 0, 0x0fff ) | 0x4000,
    mt_rand( 0, 0x3fff ) | 0x8000,
    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
  );
}

/**
 * Function to remove pages from the sidebar in the dashboard
 */
function custom_menu_page_removing() {
  remove_menu_page( 'edit-comments.php' );
  remove_menu_page('edit.php');
  if ( !is_admin() ){
    remove_menu_page('plugins.php');
    remove_menu_page('plugin-install.php');
    remove_menu_page('plugin-editor.php');
  }
  if ( !current_user_can('administrator') ){
    remove_menu_page('tools.php');
  }
}
add_action('admin_menu', 'custom_menu_page_removing');

//TODO: Tie these functions into a plugin for Developer/Admin dashboard
/**
 * Function to remove widgets from the main dashboard in WordPress
 */
function remove_dashboard_widgets() {
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box('dashboard_primary','dashboard','side');
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function add_user_link_widget_function(){
  $add_user_url = admin_url('user-new.php');
  echo '<a style="display:inline-block; padding: 0.5rem 1rem; color: #ffffff; background-color: #2c9ae5; margin: 1rem 0;" href="'. $add_user_url .'">Add New User</a>';
}

function user_last_login( $user_login, $user ){
  update_user_meta( $user->ID, 'last_login', time() );
}
add_action( 'wp_login', 'user_last_login', 10, 2 );

function list_all_users(){
  $blog_users = get_users();
  echo '<style>.hab-dashboard-user{ border-bottom: 1px solid #ddd; padding: 1rem 0 1rem; } .hab-dashboard-user:first-of-type{ margin-top: -11px; } .hab-dashboard-user:last-child{ border-bottom: none; padding: 1rem 0 5px; }</style>';
  foreach ( $blog_users as $blog_user ):
    $blog_user_id = $blog_user->ID;
    $blog_user_login_name = $blog_user->user_nicename;
    $blog_user_display_name = $blog_user->display_name;
    $blog_user_role = $blog_user->roles[0];
    $last_login =  get_user_meta($blog_user->ID, 'last_login', true);
    if ( empty($last_login) ):
      $last_login = 'Never';
    else:
      $last_login = date('F j, Y g:i a', $last_login);
    endif;

    echo '<div class="hab-dashboard-user">';
    echo '<span><strong>Name: </strong>' . $blog_user_display_name . '</span><br />';
    echo '<span><strong>Role: </strong>' . ucfirst($blog_user_role) .'</span><br />';
    echo '<span><strong>Last Login: </strong>' . $last_login .'</span>';
    echo '</div>';
  endforeach;
}

function add_custom_dashboard_widgets(){
  wp_add_dashboard_widget(
    'add_new_user',
    'Add New User',
    'add_user_link_widget_function'
  );

  wp_add_dashboard_widget(
    'list_users',
    'Users, Role &amp; Last Login',
    'list_all_users'
  );
}

add_action('wp_dashboard_setup', 'add_custom_dashboard_widgets');

/**
 * Change the number of items returned by WordPress search
 */
function change_wp_search_size($query) {
  if ( $query->is_search ){
    $query->query_vars['posts_per_page'] = -1;
    return $query;
  }
}
add_filter('pre_get_posts', 'change_wp_search_size');

/**
 * Function to display a child category name
 * When using the category ID = $cat
 */
function child_category($cat){
  foreach( ( get_the_category() ) as $childcat ) {
    if ( cat_is_ancestor_of( $cat, $childcat ) ) {
      echo $childcat->cat_name . ' ';
    } elseif ( cat_is_ancestor_of( $cat, $childcat ) && count( $childcat ) > 1 ){
      echo $childcat->cat_name . ', ';
    }
  }
}

/**
 * Function to check if is parent or child
 */
function is_tree($pid) {
  global $post;
  if(is_page()&&($post->post_parent==$pid||is_page($pid))):
    return true;
  else:
    return false;
  endif;
}

/**
 * Function for a Pseudo Custom Walker with Foundation
 * The is_tree function needs to be included if this is used
 */
function build_custom_menu($registered_name){

  global $post;
  $current_item_class = '';
  $menu_item_class = '';
  $menu_group_class = '';
  $child_menu_item_class = '';
  $current_parent = array_reverse(get_post_ancestors($post->ID));
  $parent_page = get_page($current_parent[0]);
  $parent_page_slug = strtolower($parent_page->post_name);
  $parent = array();
  $menu_name = $registered_name;

  if ( ($locations = get_nav_menu_locations() ) && isset($locations[$menu_name]) ){

    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $parent_id = 0;

    foreach( (array) $menu_items as $key => $menu_item ){

      $navItemParent = (int) $menu_item->object_id;
      $currentPageID = (int) $post->post_parent;

      if($menu_item->menu_item_parent == 0){

        $parent_id = $menu_item->db_id;
        $title = $menu_item->title;
        $url = $menu_item->url;
        $type = strtolower($menu_item->type);

        if ( $type == 'post_type_archive' ):
          $type = $type;
        elseif ( $type = 'post_type' ):
          $type = 'page';
        endif;

        if ( $navItemParent == $currentPageID ):
          $subpage = "match";
        else:
          $subpage = null;
        endif;

        $type_name = strtolower($menu_item->title);
        $classes = $menu_item->classes;
        array_push($parent, array("title" => $title, "url" => $url, "classes" => $classes, "type" => $type, "typename" => $type_name, "subpage" => $subpage, "child" => array() ) );
      } else if( $menu_item->menu_item_parent == $parent_id ){
        $title = $menu_item->title;
        $url = $menu_item->url;
        $type = strtolower($menu_item->type);
        if ( $type == 'post_type_archive' ):
          $type = $type;
        elseif ( $type = 'post_type' ):
          $type = 'page';
        endif;
        $type_name = strtolower($menu_item->title);
        $child_parent_id = $menu_item->menu_item_parent;
        $classes = $menu_item->classes;
        array_push($parent[count($parent) - 1]["child"], array("title" => $title, "url" => $url, "classes" => $classes, "type" => $type, "typename" => $type_name, "parentid" => $child_parent_id));
      } else{
      }
    }
  }

  foreach ($parent as $key => $value) {
    if( empty($value["child"]) ){ //strtolower(str_replace(".", "", $friendly_parent))
      $friendly_parent = str_replace(" ", "-", $value["title"]);
      $formatted_class = strtolower(str_replace(".", "", $friendly_parent));
      if ( is_page($friendly_parent) ){
        $current_page = $current_item_class;
      } elseif( is_post_type_archive($value["typename"]) || is_post_type_archive($value["classes"]) || is_singular($value["typename"]) || is_singular($value["classes"]) ){
        $current_page = $current_item_class;
      } elseif( is_page($value["classes"]) ){
        $current_page = $current_item_class;
      } elseif( $value["subpage"] != null ){
        $current_page = $current_item_class;
      } else {
        $current_page = "";
      }
      if ( $value["classes"]){
        $added_classes = $value["classes"][0];
      } else {
        $added_classes = "";
      }
      if ( !empty($current_page) ):
        if ( !empty($added_classes) ):
          $classes_combined = $formatted_class . " " . $current_page . " " . $added_classes;
        else:
          $classes_combined = $formatted_class . " " . $current_page;
        endif;
      else:
        $classes_combined = $formatted_class;
      endif;

      echo '<li><a class="'. $classes_combined .' '. $menu_item_class .' " href="' . $value["url"] .'">' . '<span>'. $value["title"] .'</span>' . '</a></li>';
    } else {
      $friendly_child = str_replace(" ", "-", $value["title"]);
      if ( is_page( strtolower($friendly_child) ) ){
        $current_page = $current_item_class;
      } elseif ( is_post_type_archive(get_post_type()) || is_singular(get_post_type()) ){
        $current_page = $current_item_class;
      } elseif ( $post->$post_parent ){
        $current_page = $current_item_class;
      } else {

      }
      echo '<li class="'. $menu_group_class .'">
      <a href="' . $value["url"] . '" class="'. $child_menu_item_class .' ' . strtolower(str_replace(".", "", $friendly_child)) . ' ' . $current_page .'">' . '<span>'. $value["title"] .'</span>' . '</a>' . '<ul class="menu vertical">';
      foreach ($value["child"] as $key => $value) {
      $friendly_children = str_replace(" ", "-", $value["title"]);
      if ( is_page($friendly_children) || is_page($value["child_parent_id"])){
        $current_page = $current_item_class;
      } elseif ( is_post_type_archive(get_post_type()) || is_singular(array('work', 'passions', 'blog', 'careers')) ){
        $current_page = $current_item_class;
      } elseif ( is_tree($post->ID) ){
        $current_page = $current_item_class;
      }
      if ( !empty($current_page) ){
        echo '<li><a class="' . strtolower(str_replace(" ", "-", $friendly_children)) . ' '. $current_page .'" href="' . $value["url"] . '">' . '<span>' . $value["title"] . '</span>' . '</a></li>';
      } else {
        echo '<li><a class="' . strtolower(str_replace(" ", "-", $friendly_children)) . '" href="' . $value["url"] . '">' . '<span>'. $value["title"] .'</span>' . '</a></li>';
      }

      }
      echo '</ul></li>';
    }
  }
}

/**
 * Add Custom Image Sizes
 * Update this function with custom image names and dimensions
 * Use image name so that it's pulled into the edito
 */
add_image_size( 'headshot-small', 150, 150 );
add_image_size( 'headshot-mid', 225, 225 );
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {
  return array_merge( $sizes, array(
    'headshot-small' => __( 'Headshot (150x150)' ),
    'headshot-mid' => __( 'Headshot (225x225)' ),
  ) );
}

/**
 * Move the position of Gravity Forms in the dashboard sidebar
 */

add_filter( 'gform_menu_position', 'my_gform_menu_position' );

function my_gform_menu_position( $position ) {
    return 50;
}

/**
 * The following functions disable comments in WordPress:
 * disable_comments_post_types_support
 * disable_comments_status
 * disable_comments_hide_existing_comments
 */
function disable_comments_post_types_support() {
   $post_types = get_post_types();
   foreach ($post_types as $post_type) {
      if(post_type_supports($post_type, 'comments')) {
         remove_post_type_support($post_type, 'comments');
         remove_post_type_support($post_type, 'trackbacks');
      }
   }
}
add_action('admin_init', 'disable_comments_post_types_support');

function disable_comments_status() {
   return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

function disable_comments_hide_existing_comments($comments) {
   $comments = array();
   return $comments;
}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

/**
 * Function for a custom read more link with no ellipsis.
 */
function excerpt_more_sans_ellipsis(){
 global $post;
 return '. <a class="moretag hab-read-more" href="'. get_permalink($post->ID) . '" rel="no-follow"><span>Read more</span></a>';
}
add_filter('excerpt_more', 'excerpt_more_sans_ellipsis');

/**
 * Alternate custom excerpt lenght for the above function
 */
function custom_excerpt_length($length) {
 return 13;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

/**
 * Alternate custom excerpt function
 */
function alternate_excerpt($length_callback = '', $more_callback = ''){
  global $post;
  if ( function_exists($length_callback) ) {
    add_filter('excerpt_length', $length_callback);
  }
  if ( function_exists($more_callback) ) {
    add_filter('excerpt_more', $more_callback);
  }
  $text = the_time('F j, Y') . " &mdash; " . get_the_excerpt();
  echo $text;
}

function custom_post_types_and_custom_taxonomies(){

  register_post_type( 'locations', array(
    'labels' => array(
      'name' => __( 'Locations' ),
      'singular_name' => __( 'Location' ),
      'add_new' => __( 'Add New Location' ),
      'add_new_item' => __( 'Add New Location' ),
      'edit_item' => __( 'Edit Location' ),
      'new_item' => __( 'New Location' ),
      'view_item' => __( 'View Location' ),
      'search_items' => __( 'Search Locations' ),
      'not_found' => __( 'No Locations found' ),
      'not_found_in_trash' => __( 'No Locations found in Trash' ),
      'parent_item_colon' => __( 'Parent Location:' ),
      'menu_name' => __( 'Locations' )
    ),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'locations' ),
    'capability_type' => 'post',
    'exclude_from_search' => false,
    'has_archive' => false,
    'hierarchical' => true,
    'menu_position' => 21,
    'menu_icon' => 'dashicons-location-alt',
    'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions' )
  ));

  register_taxonomy( 'careers_category', array( 'careers' ), array(
    'labels'	   => array(
      'name' => __( 'Careers Categories' ),
      'singular_name' => __( 'Careers Category' ),
      'search_items' => __( 'Search Careers Categories' ),
      'all_items' => __( 'All Careers Categories' ),
      'parent_item' => __( 'Parent Careers Category' ),
      'parent_item_colon' => __( 'Parent Careers Category:' ),
      'edit_item' => __( 'Edit Careers Category' ),
      'update_item' => __( 'Update Careers Category' ),
      'add_new_item' => __( 'Add New Careers Category' ),
      'new_item_name' => __( 'New Genre Careers Category' ),
      'menu_name' => __( 'Careers Categories' ),
    ),
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'careers_category' )
  ) );

  flush_rewrite_rules();
}
add_action( 'init', 'custom_post_types_and_custom_taxonomies' );

//Shortcode

function inline_highlight( $atts, $content = null ){
  $a = shortcode_atts(array(
    'color'  =>  ''
  ), $atts);
  $color = $a['color'];
  return '<p class="highlight ' . $color . '">'. $content .'</p>';
}
add_shortcode('callout', 'inline_highlight');
/**
 * [two_column][double_left]Content Goes Here[/double_left][double_right]Content Goes Here[/double_right][/two_column]
 */
function add_two_column_content( $atts, $content = null ){
  $a = shortcode_atts(array(), $atts);
  return '<div class="row">'. do_shortcode($content) .'</div>';
}
add_shortcode('two_column', 'add_two_column_content');

function double_left_column( $atts, $content = null ){
  $a = shortcode_atts(array(), $atts);
  return '<div class="large-6 medium-6 small-12 columns">'. $content .'</div>';
}
add_shortcode('double_left', 'double_left_column');

function double_right_column( $atts, $content = null ){
  $a = shortcode_atts(array(), $atts);
  return '<div class="large-6 medium-6 small-12 columns">'. $content .'</div>';
}
add_shortcode('double_right', 'double_right_column');

/**
 * [three_column][triple_left]Content Goes Here[/triple_left][triple_center]Content Goes Here[/triple_center][triple_right]Content Goes Here[/triple_right][/three_column]
 */

function add_three_column_content( $atts, $content = null ){
  $a = shortcode_atts(array(), $atts);
  return '<div class="row">'. do_shortcode($content) .'</div>';
}
add_shortcode('three_column', 'add_three_column_content');

function triple_left_column( $atts, $content = null ){
  $a = shortcode_atts(array(), $atts);
  return '<div class="large-4 medium-4 small-12 columns">'. $content .'</div>';
}
add_shortcode('triple_left', 'triple_left_column');

function triple_center_column( $atts, $content = null ){
  $a = shortcode_atts(array(), $atts);
  return '<div class="large-4 medium-4 small-12 columns">'. $content .'</div>';
}
add_shortcode('triple_center', 'triple_center_column');

function triple_right_column( $atts, $content = null ){
  $a = shortcode_atts(array(), $atts);
  return '<div class="large-4 medium-4 small-12 columns">'. $content .'</div>';
}
add_shortcode('triple_right', 'triple_right_column');

/**
 * Add to admin column
 */
function posts_columns($defaults){
  $defaults['my_post_thumbs'] = __('Featured Image');
  return $defaults;
}

function posts_custom_columns($column_name, $id){
  if($column_name === 'my_post_thumbs'){
      the_post_thumbnail('thumbnail');
  }
}
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

/**
 * Update realationship fields bidirectially
 */
function bidirectional_acf_update_value( $value, $post_id, $field  ) {
  $field_name = $field['name'];
  $field_key = $field['key'];
  $global_name = 'is_updating_' . $field_name;
  if( !empty($GLOBALS[ $global_name ]) ) return $value;
  $GLOBALS[ $global_name ] = 1;
  if( is_array($value) ) {
    foreach( $value as $post_id2 ) {
      $value2 = get_field($field_name, $post_id2, false);
      if( empty($value2) ) {
        $value2 = array();
      }
      if( in_array($post_id, $value2) ) continue;
      $value2[] = $post_id;
      update_field($field_key, $value2, $post_id2);
    }
  }
  $old_value = get_field($field_name, $post_id, false);
  if( is_array($old_value) ) {
    foreach( $old_value as $post_id2 ) {
      if( is_array($value) && in_array($post_id2, $value) ) continue;
      $value2 = get_field($field_name, $post_id2, false);
      if( empty($value2) ) continue;
      $pos = array_search($post_id, $value2);
      unset( $value2[ $pos] );
      update_field($field_key, $value2, $post_id2);
    }
  }
  $GLOBALS[ $global_name ] = 0;
    return $value;
}

add_filter('acf/update_value/name=related_posts', 'bidirectional_acf_update_value', 10, 3);
