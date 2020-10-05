<?php
/**
 * Enqueue scripts and styles.
 */
function foxlive_scripts() {
  global $wp_styles;
  $theme_version = wp_get_theme()->Version;
  if ( !is_admin() ):
    //wp_deregister_script('jquery');
    wp_enqueue_script('bjquery', get_template_directory_uri() . '/node_modules/jquery/dist/jquery.min.js', $theme_version, true);
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/node_modules/foundation-sites/dist/js/foundation.min.js', array('bjquery'), $theme_version, true );
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/node_modules/what-input/dist/what-input.min.js', array('bjquery'), $theme_version, true );
    wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.min.js', array('bjquery'), $theme_version, true );
    wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array('bjquery'), $theme_version, true );
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array('bjquery'), $theme_version, true );
  endif;
  wp_enqueue_style( 'foxlive-style', get_stylesheet_uri() );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
	wp_localize_script( 'wp-api', 'wpApiSettings', array(
    'root' => esc_url_raw( rest_url() ),
    'nonce' => wp_create_nonce( 'wp_rest' )
	) );
	wp_enqueue_script('wp-api');
}

function codeless_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}

function wps_deregister_styles() {
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  if ( !is_user_logged_in() ){
    wp_deregister_style('dashicons');
  }
}

function foxlive_head_cleanup(){
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wp_generator' );
  remove_action( 'wp_head', 'feed_links', 2 );
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );
  remove_action( 'wp_head', 'index_rel_link' );
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'adjacent_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
  remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
  //remove_action('wp_head', 'print_emoji_detection_script', 7);
  //remove_action('wp_print_styles', 'print_emoji_styles');
  //remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  //remove_action( 'admin_print_styles', 'print_emoji_styles' );
}

function mastertheme_login_logo(){
$custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_dimensions = wp_get_attachment_metadata($custom_logo_id);
$logo_width = $custom_logo_dimensions['width'];
$logo_height = $custom_logo_dimensions['height'];
$logo_url = wp_get_attachment_image_src($custom_logo_id, 'full');
$black = '#000000';
$white = '#ffffff';
$red = '#9B2335';
?>
  <style type="text/css">
    body.login{
      background: <?php echo $black; ?>;
    }
    .login #backtoblog a, .login #nav a{
      color: <?php echo $white;?> !important;
    }
    .login label{
      color: <?php echo $dark_blue; ?> !important;
    }
    .login h1 a{
      background-image: url('<?php echo $logo_url[0]; ?>') !important;
      height: <?php echo $logo_height . 'px'; ?> !important;
      width: <?php echo $logo_width . 'px'; ?> !important;
      background-size: <?php echo $logo_width . 'px'; ?> !important;
      margin: 0 auto 20px !important;
    }
    .login #login_error, .login .message{
      border-left: 4px solid <?php echo $red; ?> !important;
      color: <?php echo $dark_blue;?> !important;
    }
    .login #login_error{
      border-left-color: <?php echo $red; ?> !important;
    }
    .login #nav a{
      text-decoration: underline;
    }
    .login #wp-submit{
      background: <?php echo $black;?>;
      box-shadow: none;
      text-shadow: none;
      border: none;
    }
  </style>
  <?php
}

function foxlive_start(){
  add_action( 'init', 'foxlive_head_cleanup' );
  //add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );
  add_filter('the_generator', 'joints_rss_version');
  add_action( 'wp_enqueue_scripts', 'foxlive_scripts' );
  add_action('login_enqueue_scripts', 'mastertheme_login_logo');
  //add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2 );
  //add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2 );
}

add_action('after_setup_theme', 'foxlive_start');

add_filter('wp_nav_menu_items', 'add_logout_link', 10, 2);
function add_logout_link($items, $args){
    if( $args->theme_location == 'menu-1' ){
        $logout_url = wp_logout_url(home_url());
        $items .= '<li><a title="Logout" href="'. $logout_url .'">' . __( 'Logout' ) . '</a></li>';
    }
    return $items;
}

gravity_form_enqueue_scripts(1, true);

function add_categories_to_pages() {
  register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_categories_to_pages' );

class EventUser{
  var $userID;
	var $userName;
  var $firstName;
  var $lastName;
  var $emailAddress;
  var $company;
  var $userEventRole;
  var $userEventTier;
  var $userEventRooms;

  function setUserID($data){
    $this->user_id = $data;
  }
  function getUserID(){
    echo $this->user_id;
  }

	function setUserName($data){
    $this->user_name = $data;
  }
  function getUserName(){
    echo $this->user_name;
  }

  function setFirstName($data){
    $this->first_name = $data;
  }
  function getFirstName(){
    echo $this->first_name;
  }

  function setLastName($data){
    $this->last_name = $data;
  }
  function getLastName(){
    echo $this->last_name;
  }

  function setEmailAddress($data){
    $this->email_address = $data;
  }
  function getEmailAddress(){
    echo $this->email_address;
  }

  function setCompany($data){
    $this->company = $data;
  }
  function getCompany(){
    echo $this->company;
  }

  function setEventRole($data){
    $this->event_role = $data;
  }
  function getEventRole(){
    echo $this->event_role;
  }

  function setUserTier($data){
    $this->user_tier = $data;
  }
  function getUserTier(){
    echo $this->user_tier;
  }

  function setRoomAccess($data){
    $this->room_access = $data;
  }
  function getRoomAccess(){
    echo $this->room_access;
  }

}

function add_custom_users_api(){
  register_rest_route( 'wp/v2', '/getusers/eventusers/', array(
    'methods' => 'GET',
    'callback' => 'get_custom_users_data',
  ));
}

function get_custom_users_data(){
  $users = get_users();
  $user_api_info = array();
  foreach ($users as $user):
    $user_meta = get_user_meta($user->data->ID);
		$user_info = get_userdata($user->data->ID);
    $person = new EventUser;
    $person->user_id = $user->data->ID;

		if ( !empty( $user_meta['first_name'][0] ) ):
      $person->first_name = $user_meta['first_name'][0];
    endif;

    if ( !empty( $user_meta['last_name'][0] ) ):
      $person->last_name = $user_meta['last_name'][0];
    endif;

		if ( !empty($user_info->data->user_login) ):
			$person->user_name = $user_info->data->user_login;
		endif;

    if ( !empty( $user->data->user_email ) ):
      $person->email_address = $user->data->user_email;
    endif;

    if ( !empty( $user_meta['company'][0] ) ):
      $person->company = $user_meta['company'][0];
    endif;

    if ( !empty( $user_meta['user_event_role'][0] ) ):
      $person->user_event_role = $user_meta['user_event_role'][0];
    endif;

    if ( !empty( $user_meta['user_event_tier'][0] ) ):
      $person->user_event_tier = $user_meta['user_event_tier'][0];
    endif;

    if ( !empty( $user_meta['user_room_access'][0] ) ):
      $person->userEventRooms = $user_meta['user_room_access'][0];
    endif;
    $user_api_info = array_merge($user_api_info, [$user->data->user_login, $person]);
  endforeach;
  return json_encode($user_api_info);
}

add_action( 'rest_api_init', 'add_custom_users_api');
/*
function acf_to_rest_api($response, $post, $request) {
    if (!function_exists('get_fields')) return $response;

    if (isset($post)) {
        $acf = get_fields($post->id);
        $response->data['acf'] = $acf;
    }
    return $response;
}
add_filter('rest_prepare_post', 'acf_to_rest_api', 10, 3);

add_filter('json_prepare_post', 'json_api_encode_acf');

function json_api_encode_acf($post) {

    $acf = get_fields($post['ID']);

    if (isset($post)) {
      $post['acf'] = $acf;
    }
    return $post;
}

function wp_api_encode_acf($data,$post,$context){
    $customMeta = (array) get_fields($post['ID']);
    $data['meta'] = array_merge($data['meta'], $customMeta );
    return $data;
}

function wp_api_encode_acf_taxonomy($data,$post){
    $customMeta = (array) get_fields($post->taxonomy."_". $post->term_id );
    $data['meta'] = array_merge($data['meta'], $customMeta );
    return $data;
}

function wp_api_encode_acf_user($data,$post){
    $customMeta = (array) get_fields("user_". $data['ID']);
    $data['meta'] = array_merge($data['meta'], $customMeta );
    return $data;
}

add_filter('json_prepare_post', 'wp_api_encode_acf', 10, 3);
add_filter('json_prepare_page', 'wp_api_encode_acf', 10, 3);
add_filter('json_prepare_attachment', 'wp_api_encode_acf', 10, 3);
add_filter('json_prepare_term', 'wp_api_encode_acf_taxonomy', 10, 2);
add_filter('json_prepare_user', 'wp_api_encode_acf_user', 10, 2);
*/

add_action( 'rest_api_init', 'acf2api_hook_all_post_types', 99 );
function acf2api_hook_all_post_types(){

  //Get all the post types
  global $wp_post_types;
  $post_types = array_keys( $wp_post_types );

  //Loop through each one
  foreach ($post_types as $post_type) {

    //Add a filter for this post type
    add_filter( 'rest_prepare_'.$post_type, function($data, $post, $request){

      //Get the response data
      $response_data = $data->get_data();

      //Bail early if there's an error
      if ( $request['context'] !== 'view' || is_wp_error( $data ) ) {
          return $data;
      }

      //Get all fields
      $fields = get_fields($post->ID);
      //If we have fields...
      if ($fields){
        //Loop through them...
        foreach ($fields as $field_name => $value){
          //Set the meta
          $response_data[$field_name] = $value;
        }
      }

      //Commit the API result var to the API endpoint
      $data->set_data( $response_data );
      return $data;
    }, 10, 3);
  }
}

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ):

	$url = parse_url($_SERVER['REQUEST_URI']);
	$query = $url['query'];
	var_dump($query);
	$headers = apache_request_headers();
	$authorization = explode(' ', $headers['Authorization']); //array
	$api_url = $_POST['api_url'];

	if ( !empty($query) && $query == 'user_update' || $query == 'room_update' ):

		if ( !empty($authorization[1]) ):

			// If Authtoken is present, only validated tokens would be passed

			if ( !empty($query) && $query == 'user_update' ):
				// Update if the query parameter is for users
				$user_id = $_POST['user_id'];
				$user_tier = $_POST['user_event_tier'];
				$user_rooms = $_POST['user_room_access'];
				if ( !empty($user_id) ):
					//
				else:
					//
				endif;
				if ( !empty($user_tier) ):
					update_field( 'user_event_tier', $user_tier, 'user_' . $user_id );
				else:
					//
				endif;

				if ( !empty($user_rooms) ):
					update_field( 'user_room_access', $user_rooms, 'user_' . $user_id );
				else:
					//
				endif;
				http_response_code(200);
				$response = 'User ' . $user_id . ' updated successfully';
	      exit(json_encode($response));

			elseif ( !empty($query) && $query == 'room_update' ):
				$room_id = $_POST['room_id'];
				$current_layout = $_POST['current_layout'];
				$background_image = $_POST['current_background_image'];
				$lobby_video_url = $_POST['lobby_video_url'];

				if ( !empty($current_layout) ):
					update_field( 'current_layout', $current_layout, $room_id );
				else:
					//
				endif;

				if ( !empty($background_image) ):
					update_field( 'current_background_image', $background_image, $room_id );
				else:
					//
				endif;

				if ( !empty($lobby_video_url) ):
					update_field( 'lobby_video_url', $lobby_video_url, $room_id );
				else:
					//
				endif;

				http_response_code(200);
				$response = 'Room Information updated successfully';
	      exit(json_encode($response));
				// Update if the query parameter is for rooms
			else:
				// Do Nothing
			endif;

		else:
			http_response_code(400);
			$response = 'No authorization token present';
	    exit(json_encode($response));
		endif;
		//
	else:
		//
	endif;

else:
	// Do Nothing REQUEST_METHOD is not POST
endif;

function base64url_encode($data){
  // First of all you should encode $data to Base64 string
  $b64 = base64_encode($data);

  // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
  if ($b64 === false) {
    return false;
  }

  // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
  $url = strtr($b64, '+/', '-_');

  // Remove padding character from the end of line and return the Base64URL result
  return rtrim($url, '=');
}

function base64url_decode($data, $strict = false){
  // Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
  $b64 = strtr($data, '-_', '+/');

  // Decode Base64 string and return the original data
  return base64_decode($b64, $strict);
}

	add_filter('wp_authenticate_user', 'my_auth_login',1000,10);

	function my_auth_login ($user, $password) {
		if ( strpos($_SERVER['REQUEST_URI'], 'webconnected') ):

			$login_user_id = $user->data->ID;
			$user_id_string = 'user_' . $login_user_id;
			$user_meta = get_user_meta($login_user_id);
			$user_display_name = '';
			$user_first_name = '';
			$user_last_name = '';

			if ( $user_meta['first_name']['0'] ):
				$user_first_name = $user_meta['first_name'][0];
			else:
				$user_first_name = 'Anonymous User' . $login_user_id;
			endif;

			if ( $user_meta['last_name'][0] ):
				$user_last_name = $user_meta['last_name'][0];
			else:
				$user_last_name = '';
			endif;

			if ( !empty($user_last_name) ):
				$user_display_name = $user_first_name . ' ' . $user_last_name;
			else:
				$user_display_name = $user_first_name;
			endif;

			$user_email = $user->data->user_email;
			$user_password = $password;
			$encrypted_user_password = $user->data->user_login;
			$user_tier = get_field('user_event_tier', $user_id_string);
			$room_access = get_field('user_room_access', $user_id_string);
			$audience = 'meetmo';
			$issuer = 'meetmo';
			$subject = 'meetmo.io';

			$auth = array(
				'alg' => 'HS256',
				'typ' => 'JWT',
			);
			$json_auth = json_encode($auth);
			$encoded_auth = base64url_encode(json_encode($auth));

			$room = 'webconnected-demo';
			$expiration = date("Y-m-d", strtotime("+1 week"));
			$body = array();
			$context = array();
			$user_data = array();
			$user_info = array();
			$user_info['avatar'] = '';
			$user_info['name'] = $user_display_name;
			$user_info['email'] = $user_email;
			$user_info['id'] = $login_user_id;
			$user_info['role'] = $user_tier;
			$user_data['user'] = $user_info;
			$context['context'] = $user_data;
			$body = [$context];
			$body = array (
				'context' =>
				array (
					'user' =>
					array (
						'avatar' => 'https://secure.gravatar.com/avatar/825b2664c5b783013ce16a0736de9ab0',
						'name' => $user_display_name,
						'email' => $user_email,
						'id' => $login_user_id,
						'role' => $user_tier,
					),
				),
				'aud' => 'meetmo',
				'iss' => 'meetmo',
				'sub' => 'meetmo.io',
				'room' => $room,
				'exp' => strtotime($expiration),
				'moderator' => 'true',
			);

			$json_body = json_encode($body);
			$encoded_body = base64url_encode($json_body);

			$encoded_token = $encoded_auth . '.' . $encoded_body;

			setCookie('jwt-user', $user_email);
			setCookie('jwt-pass', $password);
			setCookie('jwt-auth', $json_auth);
			setCookie('jwt-body', $json_body);
			$current_url = $_SERVER['SCRIPT_URI'];

			if ( strpos($current_url, 'jwt-auth') ):
				//
			else:
				$curl = curl_init();
				$login_endpoints = array('wp-login.php', 'login');
				$website_url = str_replace($login_endpoints, '', $current_url);
				$token_url = 'wp-json/jwt-auth/v1/token?username=' . $user_email . '&password=' . $user_password ;
				$curl_url = $website_url . $token_url;
				curl_setopt_array($curl, array(
					CURLOPT_URL => $curl_url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => $json_body,
					CURLOPT_HTTPHEADER => array(
						"alg: HS256",
						"typ: JWT",
						"Content-Type: text/plain"
					),
				));

				$response = curl_exec($curl);
				$response_php = json_decode($response);
				$response_token = $response_php->token;
				var_dump($response_token);
				exit();
				$response_token_name = 'jwt-' . $room;
				setCookie($response_token_name, $response_token);
				curl_close($curl);
			endif;
			return $user;
		else:
			// Do Nothing
		endif;
	}

	function login_user($username){
		$user = get_user_by('login', $username );
		// If no error received, set the WP Cookie
		if ( !is_wp_error( $user ) )
		    {
		        wp_clear_auth_cookie();
		        wp_set_current_user ( $user->ID ); // Set the current user detail
		        wp_set_auth_cookie  ( $user->ID ); // Set auth details in cookie
		        $message = "Logged in successfully";
		    } else {
		        $message = "Failed to log in";
		    }

		echo $message;
	}
