<?php
/**
* Template part for displaying page content in page.php
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package foxlive
*/

$use_activity_layout = get_field('field_5e9ed61201d62', 'option');
$activity_layout_artwork = get_field('field_5e9effc3e1059', 'option');

$use_landing_tile = get_field('field_5ea69f336ae58', 'option');
$landing_tile = get_field('field_5ea6a65969859', 'option');
?>

<?php if ( $use_activity_layout ):
  $activity_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent' => 2,
    'order' => 'ASC',
    'orderby' => 'menu_order'
  );
  $activity_query = new WP_Query($activity_args);
  $activity_tagline = get_field('field_5e9fe8d64c12e', 'option');
?>
  <header>
    <div class="row">
      <div class="column flex-container align-middle small-12 medium-8">
        <?php if ( has_custom_logo() ): ?>
          <?php the_custom_logo(); ?>
        <?php else: ?>
          <img id="fox-logo" src="<?php bloginfo('template_directory'); ?>/includes/assets/images/logo.svg" alt="Fox Live" />
        <?php endif; ?>
        <div class="event-title">
          <?php if ( $activity_tagline ): ?>
            <h1><img src="<?php echo $activity_tagline['url']; ?>" alt="<?php echo $activity_tagline['alt']; ?>"></h1>
          <?php else: ?>
            <h1><?php echo get_the_title(); ?></h1>
          <?php endif; ?>
        </div><!-- /.event-title -->
      </div><!-- /.column flex-container -->
      <div class="column small-12 medium-4">
        <ul class="menu">
          <?php wp_nav_menu( array(
            'theme_location'   => 'menu-1',
            'container'        => '',
            'menu_class'       => '',
            'items_wrap'       => '%3$s'
          ) ); ?>
        </ul><!-- /.menu -->
      </div><!-- /.column small-12 medium-4 -->
    </div><!-- /.row -->
  </header>
  <?php
    $featured_video = get_field('field_5e9f9293c56e7');
    $main_description = get_field('field_5e9f3436602d5');
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
<?php else:
  // Event
?>
  <?php if ( have_posts() ): ?>
    <?php while ( have_posts() ): the_post();
    $event_video_feed = get_field('event_video_feed');
    $event_title = get_the_title();
    //echo $event_video_feed;
    $event_video_title_attributes = ' title="'. $event_title .'"></iframe>';
    //echo $event_video_title_attributes;
    if ( $event_video_feed ):
      $event_video_feed = '<div class="responsive-embed widescreen">' . str_replace('></iframe>', $event_video_title_attributes,  $event_video_feed) . '</div>';
    else:

    endif;

    $event_chat_feed = get_field('event_chat_feed');
    if ( $event_chat_feed ):
      //$event_chat_feed = '<div class="responsive-embed portrait"><iframe src="'.$event_chat_feed.'"></iframe></div>';
      //$event_chat_feed = '<div class="responsive-embed portrait">'.$event_chat_feed.'</div>';
    else:

    endif;
    $video_feed_thumbnail = get_field('event_video_feed_thumbnail');
    ?>
    <header>
      <div class="row">
        <div class="column flex-container align-middle small-12 medium-8">
          <?php if ( has_custom_logo() ): ?>
            <?php the_custom_logo(); ?>
          <?php else: ?>
            <img id="fox-logo" src="<?php bloginfo('template_directory'); ?>/includes/assets/images/logo.svg" alt="Fox Live" />
          <?php endif; ?>
          <div class="event-title">
            <h1><?php echo $event_title; ?></h1>
          </div><!-- /.event-title -->
        </div><!-- /.column flex-container -->
        <div class="column small-12 medium-4">
          <ul class="menu">
            <?php wp_nav_menu( array(
              'theme_location'   => 'menu-1',
              'container'        => '',
              'menu_class'       => '',
              'items_wrap'       => '%3$s'
            ) ); ?>
          </ul><!-- /.menu -->
        </div><!-- /.column small-12 medium-4 -->
      </div><!-- /.row -->
    </header>
    <main id="main-content">
      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="row align-center">
          <?php if ( $event_chat_feed ): ?>
            <div class="columns small-12 medium-7">
              <?php echo $event_video_feed; ?>
            </div>
            <div class="columns small-12 medium-5">
              <?php echo $event_chat_feed; ?>
            </div>
          <?php else: ?>
            <div class="columns small-12">
              <?php if ( $event_video_feed ): ?>
                <?php echo $event_video_feed; ?>
              <?php else: ?>
                <?php if ( $video_feed_thumbnail ): ?>
                  <img src="<?php echo $video_feed_thumbnail['url']; ?>" alt="<?php echo $video_feed_thumbnail['alt']; ?>">
                <?php else: ?>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div><!-- #post-<?php the_ID(); ?> -->
    </main>
    <?php endwhile; ?>
  <?php endif; ?>

<?php endif; ?>
