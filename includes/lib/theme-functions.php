<?php

function getUA(){

  $u = $_SERVER['HTTP_USER_AGENT'];

  $isIE9  = (bool)preg_match('/msie 9./i', $u );
  $isIE10 = (bool)preg_match('/msie 10./i', $u );
  $isIE11 = (bool)preg_match('/rv:11./i', $u);
  $isEdge = (bool)preg_match('/Edge/i', $u);

  if( $isIE9 ){
    $ieVersion = " ie9";
  } elseif( $isIE10 ){
    $ieVersion = " ie10";
  } elseif( $isIE11 ){
    $ieVersion = " ie11";
  } elseif ( $isEdge ){
    $ieVersion = " edge";
  } else {
    $ieVersion = "";
  }

  $ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');

  if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0; rv:11.0') !== false)) {
    $isIE = "ie";
  } else {
    $isIE = "";
  }

  echo $isIE;
  echo $ieVersion;

}

add_filter('manage_users_columns', 'pippin_add_user_id_column');
function pippin_add_user_id_column($columns) {
    $columns['company'] = 'Company';
    return $columns;
}
add_action('manage_users_custom_column',  'pippin_show_user_id_column_content', 10, 3);
function pippin_show_user_id_column_content($value, $column_name, $user_id) {
  $user = get_userdata( $user_id );
  $uid = 'user_' . $user_id;
  $company = get_field('company', $uid);
  if ( 'company' == $column_name ){
    return $company;
    return $value;
  }
}

add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
  //var_dump($item);
  if ( 46 === $item->ID ) { // change 1161 to the ID of your menu item.
    $atts['data-open'] = 'contact';
  } elseif ( 39 === $item->ID ){
    $atts['data-open'] = 'contact';
  }
  return $atts;
}, 10, 3 );
