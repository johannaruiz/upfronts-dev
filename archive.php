<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foxlive
 */

get_header(); ?>

  <div class="row">
    <div class="large-12 medium-12 small-12 columns">
      <?php
      if ( have_posts() ) : ?>

        <header>
          <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
          ?>
        </header><!-- .page-header -->

        <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post();

          get_template_part( 'includes/template-parts/content', get_post_format() );

        endwhile;

        the_posts_navigation();

      else :

        get_template_part( 'includes/template-parts/content', 'none' );

      endif; ?>
    </div>
  </div>

<?php
get_footer();
