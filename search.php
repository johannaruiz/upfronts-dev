<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package foxlive
 */

get_header(); ?>
<div class="row">
  <div class="large-12 medium-12 small-12 columns">
    <?php
    if ( have_posts() ) : ?>

      <header>
        <h1><?php
          /* translators: %s: search query. */
          printf( esc_html__( 'Search Results for: %s', 'foxlive' ), '<span>' . get_search_query() . '</span>' );
          ?>
        </h1>
      </header><!-- .page-header -->

      <?php

      while ( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', 'search' );

      endwhile;

      the_posts_navigation();

    else :

      get_template_part( 'template-parts/content', 'none' );

    endif; ?>
  </div>
</div>
<?php

get_footer();
