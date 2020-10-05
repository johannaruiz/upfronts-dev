<?php
  get_template_part( 'includes/template-parts/activity', 'header' );
	
  $activity_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent' => 2,
    'category_name' => 'activity',
    'order' => 'ASC',
    'orderby' => 'menu_order'
  );
  $activity_query = new WP_Query($activity_args);
?>
  <?php
    $featured_video = get_field('field_5e9f9293c56e7');
    sss = get_field('field_5e9f3436602d5');
  ?>
  <main id="main-content" class="activity-layout">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="row">
        <div class="columns small-12">
          <?php if ( $featured_video ): ?>
            <div class="responsive-embed widescreen">
              <iframe src="<?php echo $featured_video; ?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
          <?php else: ?>
            <?php if ( has_post_thumbnail() ): ?>
              <?php the_post_thumbnail('full'); ?>
            <?php else: ?>
            <?php endif; ?>
          <?php endif; ?>
          <?php if ( $main_description ): ?>
            <div class="activity-intro-copy">
              <?php echo $main_description; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="activity-content-divider">
        <div class="row">
          <div class="columns">
            <h2 class="varsity">Activities With FOX</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if ( $activity_query->have_posts() ): ?>
          <?php while ( $activity_query->have_posts() ): $activity_query->the_post();
            $presenter_details = get_field('field_5e9f342d602d4');
            $activity_description = get_field('field_5e9f3436602d5');
          ?>
            <div class="columns small-6 medium-4 large-4 show-box">
              <div class="show-box-content-container">
                <a href="<?php echo get_the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                <div class="show-box-content">
                  <?php if ( $presenter_details ): ?>
                    <span>Host: <?php echo $presenter_details; ?></span>
                  <?php endif; ?>
                  <?php if ( $activity_description ): ?>
                    <?php echo $activity_description; ?>
                  <?php endif; ?>
                </div>
              </div>
          </div>
          <?php endwhile; wp_reset_query(); ?>
        <?php endif; ?>
      </div>
    </div>
  </main>
