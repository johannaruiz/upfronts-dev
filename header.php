<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foxlive
 */

  // Configuration Options
  $theme_class = get_field('field_5ec21974d4504', 'option');
  $theme_type = get_field('field_5f49f85bb5f02', 'option');

  // Theme Styles Override Conditional
  $override_predefined_defaults = get_field('field_5ec212ca04fd0', 'option');

  // Header Options
  $header_bg_color = get_field('field_5ec216d0ad576', 'option');
  $header_bg_opacity = get_field('field_5f49f9f434563', 'option');
  if ( !empty($header_bg_opacity) ):
    $header_bg_opacity = $header_bg_opacity / 100;
  else:
    $header_bg_opacity = 1;
  endif;
  $split = str_split(str_replace('#', '', $header_bg_color), 2);
  $r = hexdec($split[0]);
  $g = hexdec($split[1]);
  $b = hexdec($split[2]);
  $final_header_bg_color = '';
  if ( $header_bg_color ):
    $final_header_bg_color = "rgba(" . $r . ", " . $g . ", " . $b . ", ". $header_bg_opacity .")";
  else:
    $final_header_bg_color = $header_bg_color;
  endif;
  $header_copy_color = get_field('field_5ec216dead577', 'option');
  $header_logo_max_width = get_field('field_5ef0fa23e3ea8', 'option');
  // Page Content Options
  if ( $override_predefined_defaults ):
		$header_button_color = get_field('field_5f669d2ca30f2', 'option');
    $page_content_background_color = get_field('field_5ec2130b04fd1', 'option');
    $page_content_copy_color = get_field('field_5ec2140804fd6', 'option');
    $page_content_link_color = get_field('field_5ec2133804fd2', 'option');
    $page_content_input_background_color = get_field('field_5ec2136704fd3', 'option');
    $page_content_input_background_color_active_state = get_field('field_5ec23444254a5', 'option');
    $page_content_input_copy_color = get_field('field_5ec213be04fd5', 'option');
    $page_content_input_placeholder_color = get_field('field_5ec22631aa3c0', 'option');
    $page_content_submit_button_color = get_field('field_5ec2137804fd4', 'option');
    $page_content_submit_button_color_active_state = get_field('field_5ec23465254a6', 'option');
    // Modal Options
    $modal_content_background_color = get_field('field_5ec23584254a9', 'option');
    $modal_content_copy_color = get_field('field_5ec217e9f83bc', 'option');
    $modal_content_link_color = get_field('field_5ec217faf83bd', 'option');
    $modal_content_input_background_color = get_field('field_5ec21805f83be', 'option');
    $modal_content_input_background_color_active_state = get_field('field_5ec23476254a7', 'option');
    $modal_content_input_copy_color = get_field('field_5ec2260aaa3bf', 'option');
    $modal_content_input_placeholder_color = get_field('field_5ec226c2aa3c2', 'option');
    $modal_submit_button_color = get_field('field_5ec21819f83bf', 'option');
    $modal_submit_button_color_active_state = get_field('field_5ec23483254a8', 'option');
    $display_title_in_navbar = get_field('field_5f0defe899b33', 'option');
  else:
  endif;

  // Background Images
  $default_bg = get_field('default_background_image', 'option');
  $logged_in_bg = get_field('logged_in_background_image', 'option');

  // Alternate Layout Options
  $use_alternate_layout = get_field('field_5e9ed61201d62', 'option');
  if ( $use_alternate_layout ):
    $alternative_layout_artwork = get_field('field_5e9effc3e1059', 'option');
    $alternate_background_color = get_field('field_5e9f03e6b0151', 'option');
    $alternate_header_color = get_field('field_5e9f042f8d24e', 'option');
  else:

  endif;

  $request_uri = $_SERVER['REQUEST_URI'];
  if ( $use_alternate_layout ):
    $added_class = 'activity-theme';
    if ( $theme_class ):
      $added_class .= ' ' . $theme_class;
    endif;
  else:
    if ( strpos($request_uri, 'pilights') !== false ):
      $added_class = 'pilights';
      if ( $theme_class ):
        $added_class .= ' ' . $theme_class;
      else:
        $added_class = $added_class;
      endif;
    elseif ( strpos($request_uri, 'ultimatetagomd') !== false || strpos($request_uri, 'ultimatetagipg') !== false || strpos($request_uri, 'ultimatetagcarat') !== false || strpos($request_uri, 'ultimatetagfox') !== false || strpos($request_uri, 'ultimatetagmindshare') !== false ):
      $added_class = 'ultimatetag';
      if ( $theme_class ):
        $added_class .= ' ' . $theme_class;
      else:
        $added_class = $added_class;
      endif;
    else:
      $added_class = '';
      if ( $theme_class ):
        $added_class .= ' ' . $theme_class;
      else:
        $added_class = '';
      endif;
    endif;
  endif;
?>
<!doctype html>
<html <?php language_attributes(); getUA(); ?>>
<head>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P6XWCND');</script>
<!-- End Google Tag Manager -->
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-VhBcF/php0Z/P5ZxlxaEx1GwqTQVIBu4G4giRWxTKOCjTxsPFETUDdVL5B6vYvOt" crossorigin="anonymous">
  <?php wp_head(); ?>
  <?php if ( $use_alternate_layout ): ?>
    <style>
      body{
        background-color: <?php echo $alternate_background_color; ?> !important;
        background-image: none !important;
      }
    </style>
  <?php else: ?>

  <?php endif; ?>

  <?php if ( $default_bg || $logged_in_bg ): ?>
    <style>
      <?php if ( $default_bg ): ?>
      body{
        background-image: url('<?php echo $default_bg['url']; ?>');
      }
      <?php endif; ?>
      <?php if ( $logged_in_bg ): ?>
      body.home{
        background-image: url('<?php echo $logged_in_bg['url']; ?>');
      }
      <?php endif; ?>
    </style>
  <?php else: ?>
  <?php endif; ?>
  <?php if ( $override_predefined_defaults ): ?>
    <style media="screen">
    <?php if ( $theme_class ): ?>
			<?php if ( $header_button_color ): ?>
			<?php echo '.' . $theme_class; ?> header .button{
				background-color: <?php echo $header_button_color; ?>;
			}
			<?php echo '.' . $theme_class; ?> .off-canvas-navigation{
				background-color: <?php echo $header_button_color; ?>
			}
			<?php else: ?>
			<?php endif; ?>
      <?php echo '.'. $theme_class; ?> .page-content .content-container{
        background-color: <?php echo $page_content_background_color; ?>;
        color: <?php echo $page_content_copy_color; ?>;
      }

      <?php echo '.'. $theme_class; ?> .page-content .content-container a{
        color: <?php echo $page_content_link_color; ?>;
      }

      <?php echo '.'. $theme_class; ?> input:not([type="submit"]), <?php echo '.'. $theme_class; ?> textarea {
        <?php if ( $page_content_input_background_color ): ?>
          background-color: <?php echo $page_content_input_background_color; ?> !important;
        <?php endif; ?>
        <?php if ( $page_content_input_copy_color ): ?>
          color: <?php echo $page_content_input_copy_color; ?> !important;
        <?php endif; ?>
      }

      <?php if ( $page_content_copy_color ): ?>
        <?php echo '.'. $theme_class; ?> #wpaloginform p{
          color: <?php echo $page_content_copy_color; ?>;
        }
      <?php endif; ?>

      <?php if ( $modal_content_background_color ): ?>
      <?php echo '.' . $theme_class; ?> .reveal{
        background-color: <?php echo $modal_content_background_color; ?>;
      }
      <?php endif; ?>

      <?php if ( $modal_content_copy_color ): ?>
        <?php echo '.' . $theme_class; ?> .reveal h1,
        <?php echo '.' . $theme_class; ?> .reveal h2,
        <?php echo '.' . $theme_class; ?> .reveal h3,
        <?php echo '.' . $theme_class; ?> .reveal h4,
        <?php echo '.' . $theme_class; ?> .reveal h5,
        <?php echo '.' . $theme_class; ?> .reveal h6,
        <?php echo '.' . $theme_class; ?> .reveal ul,
        <?php echo '.' . $theme_class; ?> .reveal ol,
        <?php echo '.' . $theme_class; ?> .reveal p{
          color: <?php echo $modal_content_copy_color; ?>;
        }
        <?php echo '.'. $theme_class; ?> .reveal .assistance-intro{
          color: <?php echo $modal_content_copy_color; ?>;
        }
        <?php echo '.'. $theme_class; ?> #gform_confirmation_wrapper_1 #gform_confirmation_message_1{
          color: <?php echo $modal_content_copy_color; ?>;
        }

      <?php endif; ?>

      <?php if ( $modal_content_input_background_color ): ?>
        <?php echo '.' . $theme_class; ?> .reveal input, <?php echo '.' . $theme_class; ?> .reveal textarea{
          background-color: <?php echo $modal_content_input_background_color; ?> !important;
        }
      <?php endif; ?>

      <?php echo '.' . $theme_class; ?> .reveal input[type=submit]{
        background-color: <?php echo $modal_submit_button_color; ?> !important;
      }

      <?php if ( $modal_submit_button_color ): ?>
        <?php echo '.'. $theme_class; ?> #wpaloginform #wpa-submit{
          background-color: <?php echo $modal_submit_button_color; ?>;
        }
      <?php endif; ?>

      <?php if ( $modal_submit_button_color_active_state ): ?>
        <?php echo '.'. $theme_class; ?> #wpaloginform #wpa-submit:hover, <?php echo '.'. $theme_class; ?> #wpaloginform #wpa-submit:focus{
          background-color: <?php echo $modal_submit_button_color_active_state; ?>;
        }
      <?php endif; ?>

      <?php if ( $modal_content_link_color ): ?>
        <?php echo '.'. $theme_class; ?> .reveal a{
          color: <?php echo $modal_content_link_color; ?> !important;
        }
      <?php endif; ?>

      <?php echo '.'. $theme_class; ?> input:not([type="submit"]), <?php echo '.'. $theme_class; ?> textarea {
        <?php if ( $modal_content_input_background_color ): ?>
          background-color: <?php echo $modal_content_input_background_color; ?>;
        <?php endif; ?>
        <?php if ( $modal_content_input_copy_color ): ?>
          color: <?php echo $modal_content_input_copy_color; ?>;
        <?php endif; ?>
      }

      <?php if ( $modal_content_input_placeholder_color ): ?>

        <?php echo '.'. $theme_class; ?> .reveal ::-webkit-input-placeholder {
          color: <?php echo $modal_content_input_placeholder_color; ?> !important;
        }

        <?php echo '.'. $theme_class; ?> .reveal :-moz-placeholder {
          color: <?php echo $modal_content_input_placeholder_color; ?> !important;
        }

        <?php echo '.'. $theme_class; ?> .reveal ::-moz-placholder {
          color: <?php echo $modal_content_input_placeholder_color; ?> !important;
        }

        <?php echo '.'. $theme_class; ?> .reveal ::-ms-input-placeholder {
          color: <?php echo $modal_content_input_placeholder_color; ?> !important;
        }

        <?php echo '.'. $theme_class; ?> .reveal ::input-placeholder {
          color: <?php echo $modal_content_input_placeholder_color; ?> !important;
        }
      <?php endif; ?>

      <?php if ( $header_bg_color ): ?>
        <?php echo '.'. $theme_class; ?> header {
          <?php if ( $final_header_bg_color ): ?>
          background-color: <?php echo $final_header_bg_color; ?> !important;
          <?php else: ?>

          <?php endif; ?>

        }
      <?php endif; ?>

      <?php if ( $header_copy_color ): ?>
        <?php echo '.'. $theme_class; ?> header .row .column .menu li a, <?php echo '.'. $theme_class; ?> header .row .columns .menu li a {
          color: <?php echo $header_copy_color; ?>;
        }
      <?php endif; ?>
      <?php if ( $display_title_in_navbar ): ?>
      <?php else: ?>
        <?php echo '.'. $theme_class; ?> header .row .column .event-title, <?php echo '.'. $theme_class; ?> header .row .columns .event-title {
          display: none;
        }
      <?php endif; ?>

      <?php echo '.'. $theme_class; ?> header .row .column img, <?php echo '.'. $theme_class; ?> header .row .columns img {
        width: 100%;
        max-width: 300px;
      }

      <?php if ( $header_logo_max_width ): ?>
        <?php echo '.'. $theme_class; ?> header .row .column img, <?php echo '.'. $theme_class; ?> header .row .columns img {
          width: 100%;
          max-width: <?php echo $header_logo_max_width; ?>px;
        }
      <?php else: ?>
      <?php endif; ?>

      <?php if ( $page_content_input_placeholder_color ): ?>

        <?php echo '.'. $theme_class; ?> ::-webkit-input-placeholder {
          color: <?php echo $page_content_input_placeholder_color; ?> !important;
        }

        <?php echo '.'. $theme_class; ?> :-moz-placeholder {
          color: <?php echo $page_content_input_placeholder_color; ?> !important;
        }

        <?php echo '.'. $theme_class; ?> ::-moz-placholder {
          color: <?php echo $page_content_input_placeholder_color; ?> !important;
        }

        <?php echo '.'. $theme_class; ?> ::-ms-input-placeholder {
          color: <?php echo $page_content_input_placeholder_color; ?> !important;
        }

        <?php echo '.'. $theme_class; ?> ::input-placeholder {
          color: <?php echo $page_content_input_placeholder_color; ?> !important;
        }
      <?php endif; ?>

      <?php if ( $page_content_submit_button_color ): ?>
        <?php echo '.'. $theme_class; ?> .button {
          background-color: <?php echo $page_content_submit_button_color; ?>;
        }
      <?php endif; ?>

    <?php else: ?>
    <?php endif; ?>

  </style>
  <?php else: ?>
  <?php endif; ?>
</head>

<body <?php body_class($added_class); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P6XWCND"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'foxlive' ); ?></a>
