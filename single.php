<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package foxlive
 */

get_header(); ?>

  <div class="row">
    <div class="large-12 medium-12 small-12 columns">
      <?php
      while ( have_posts() ) : the_post();

        get_template_part( 'includes/template-parts/content', 'single' );

        the_post_navigation();

        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>
    </div>
  </div>

<?php

get_footer();
