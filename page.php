<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foxlive
 */

  get_header();

  if ( is_page('log-in') ):
    while ( have_posts() ) : the_post();
      get_template_part( 'includes/template-parts/content', 'log-in' );
    endwhile;
  elseif ( is_page('login-support') ):
    while ( have_posts() ) : the_post();
      get_template_part( 'includes/template-parts/content', 'login-support' );
    endwhile;
  elseif ( is_page('password-reset') ):
    while ( have_posts() ) : the_post();
      get_template_part( 'includes/template-parts/content', 'password-reset' );
    endwhile;
  elseif ( is_page('register') ):
    while ( have_posts() ) : the_post();
      get_template_part( 'includes/template-parts/content', 'register' );
    endwhile;
	elseif ( is_page('admin-login') ):
		while ( have_posts() ) : the_post();
			get_template_part( 'includes/template-parts/content', 'admin-login' );
		endwhile;
  else:
    while ( have_posts() ) : the_post();
      get_template_part( 'includes/template-parts/content', 'page' );
    endwhile;
  endif;

  get_footer();
