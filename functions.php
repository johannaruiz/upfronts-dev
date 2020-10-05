<?php
/**
 * foxlive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package foxlive
 */
/****************************************
Theme Setup
*****************************************/
$includes_path = '/includes/lib/';
/**
 * Theme Initialization
 */
require get_template_directory() . $includes_path . 'theme-setup.php';
require get_template_directory() . $includes_path . 'theme-initialization.php';
require get_template_directory() . $includes_path . 'admin-customizations.php';
require get_template_directory() . $includes_path . 'custom-post-and-tax.php';
require get_template_directory() . $includes_path . 'admin-options-pages.php';

/**
 * Custom Theme Functions
 */
require get_template_directory() . $includes_path . 'theme-functions.php';

//add_filter( 'wpmu_users_columns', 'status_column' );
//add_filter( 'manage_users_columns', 'status_column' );
//add_action( 'manage_users_custom_column', 'status_column_data', 10, 3 );
/*​
// Creates a new column in the network users table and puts it before a chosen column
function status_column( $columns ) {
    return status_add_element_to_array( $columns, 'status-column', 'Status', 'email' );
}
​
// Adds data to our new column
function status_column_data( $value, $column_name, $user_id ) {
​
    // If this our column, we return our data
    if ( 'status-column' == $column_name ) {
		$col_status = get_field('custom_status', 'user_'.$user_id);
		if($col_status !== '') :
    	    return $col_status;
		endif;
    }
​
    // If this is not any of our custom columns we just return the normal data
    return $value;
}
​
// Adds a new element in an array on the exact place we want (if possible).
function status_add_element_to_array( $original_array, $add_element_key, $add_element_value, $add_before_key ) {
​
    // This variable shows if we were able to add the element where we wanted
    $added = 0;
​
    // This will be the new array, it will include our element placed where we want
    $new_array = array();
​
    // We go through all the current elements and we add our new element on the place we want
    foreach( $original_array as $key => $value ) {
​
        // We put the element before the key we want
        if ( $key == $add_before_key ) {
            $new_array[ $add_element_key ] = $add_element_value;
​
            // We were able to add the element where we wanted so no need to add it again later
            $added = 1;
        }
​
        // All the normal elements remain and are added to the new array we made
        $new_array[ $key ] = $value;
    }
​
    // If we failed to add the element earlier (because the key we tried to add it in front of is gone) we add it now to the end
    if ( 0 == $added ) {
        $new_array[ $add_element_key ] = $add_element_value;
    }
​
    // We return the new array we made
    return $new_array;
}
*/
