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

  while ( have_posts() ) : the_post();
    get_template_part( 'includes/template-parts/content', 'front-page' );
  endwhile;

  get_footer();
