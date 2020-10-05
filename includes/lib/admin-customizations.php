<?php
/**
 * Replace Howdy with custom text
 */
function replace_howdy( $wp_admin_bar ){
  $my_account = $wp_admin_bar -> get_node('my-account');
  $new_phrase = str_replace( 'Howdy', 'Welcome' , $my_account->title );
  $wp_admin_bar->add_node( array('id' => 'my-account', 'title' => $new_phrase ) );
}

/**
 * Function to remove pages from the admin depending on user type
 */
function custom_menu_page_removing() {
  remove_menu_page( 'edit-comments.php' );
  if ( !is_admin() ){
    remove_menu_page('plugins.php');
    remove_menu_page('plugin-install.php');
    remove_menu_page('plugin-editor.php');
  }
  if ( !current_user_can('administrator') && !current_user_can('developer') ){
    remove_menu_page('tools.php');
  }
}


/**
 * Function to make Yoast be at the bottom of the page
 */
function yoasttobottom() {
  return 'low';
}

/**
 * Function to add BNM information in the dashboard of the theme footer
 */
function remove_footer_admin () {
  echo '<span id="footer-thankyou">Theme developed by <a href="http://bravenewmedia.net" target="_blank" style="text-decoration:none; color: #d8554d;"><img src="https://bravenewmedia.net/wp-content/themes/brave-new-media/favicons/favicon.ico" style="max-width: 24px; height: auto; vertical-align: text-bottom; margin-right: 6px;" />Brave New Media</a></span>';
}

if ( !function_exists( 'mastertheme_admin_customization' ) ):
  function mastertheme_admin_customization(){
    add_filter( 'admin_bar_menu', 'replace_howdy', 25 );
    add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
    add_action('admin_menu', 'custom_menu_page_removing');
    add_filter('admin_footer_text', 'remove_footer_admin');
  }
endif;
add_action( 'after_setup_theme', 'mastertheme_admin_customization' );

?>
