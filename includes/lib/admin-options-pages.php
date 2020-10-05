<?php
if ( function_exists('acf_add_options_page') ):
  $parent = acf_add_options_page(array(
    'page_title'    =>    'Extra Settings',
    'menu_title'    =>    'Extra Settings',
    'menu_slug'     =>    'extra-theme-settings',
    'capability'    =>    'edit_posts',
    'redirect'      =>    true,
    'icon_url'      =>    'dashicons-admin-generic',
    'position'      =>    79
  ));

  acf_add_options_sub_page(array(
    'page_title'    =>    'Global Settings',
    'menu_title'    =>    'Global Settings',
    'parent_slug'   =>    $parent['menu_slug'],
    'menu_slug'     =>    'extra-theme-settings/global-settings'
  ));

  acf_add_options_sub_page(array(
    'page_title'    =>    'Header Settings',
    'menu_title'    =>    'Header Settings',
    'parent_slug'   =>    $parent['menu_slug'],
    'menu_slug'     =>    'extra-theme-settings/header-settings'
  ));

  acf_add_options_sub_page(array(
    'page_title'    =>    'Footer Settings',
    'menu_title'    =>    'Footer Settings',
    'parent_slug'   =>    $parent['menu_slug'],
    'menu_slug'     =>    'extra-theme-settings/footer-settings'
  ));

  acf_add_options_sub_page(array(
    'page_title'    =>    'Miscellaneous Settings',
    'menu_title'    =>    'Misc Settings',
    'parent_slug'   =>    $parent['menu_slug'],
    'menu_slug'     =>    'extra-theme-settings/miscellaneous-settings'
  ));

  acf_add_options_sub_page(array(
    'page_title'    =>    '404 Page Settings',
    'menu_title'    =>    '404 Settings',
    'parent_slug'   =>    $parent['menu_slug'],
    'menu_slug'     =>    'extra-theme-settings/404-page-settings'
  ));

endif;
?>
