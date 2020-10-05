<?php
/**
* Template part for displaying page content in page.php
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package foxlive
*/

$current_id = get_the_ID();
$children = get_children($current_id);
$parent = get_post_ancestors($current_id);
$theme_type = get_field('field_5f49f85bb5f02', 'option');
$use_thin_header = get_field('field_5f4800b119aa4','option');
$thin_header_class = '';
if ( $use_thin_header ):
  $thin_header_class = 'thin-header';
else:
  $thin_header_class = $thin_header_class;
endif;

$use_activity_layout = get_field('field_5e9ed61201d62', 'option');
$activity_layout_artwork = get_field('field_5e9effc3e1059', 'option');

$use_landing_tile = get_field('field_5ea69f336ae58', 'option');
$landing_tile = get_field('field_5ea6a65969859', 'option');
?>
<?php
$live_event_args = array(
	'post_type'         =>  'live-event',
	'posts_per_page'    =>  -1,
	'order'             =>  'ASC',
	'orderby'           =>  'date',
);
$live_event_query = new WP_Query($live_event_args);
$current_id = get_the_ID();
?>
<?php if ( $theme_type == 'activity' ): ?>
	<?php
		$activity_args = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'post_parent' => 2,
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'post__not_in' => array($current_id)
		);
		$activity_query = new WP_Query($activity_args);
		$activity_tagline = get_field('field_5e9fe8d64c12e', 'option');
	?>
	<header class="<?php echo $thin_header_class; ?>">
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
    $activity_presenter_details = get_field('field_5e9f342d602d4');
    $main_description = get_field('field_5e9f92c7c56e8');
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
          <div class="activity-intro-copy">
            <?php if ( $activity_presenter_details ): ?>
              <p class="presenter">Host: <?php echo $activity_presenter_details; ?></p>
            <?php endif; ?>
            <?php echo $main_description; ?>
          </div>
        </div>
      </div>
      <?php
        $activity_downloads = get_field('field_5e9f92f1c56e9');
        $activity_count = count($activity_downloads);
      ?>
      <?php if ( $activity_downloads ): ?>
        <div class="row download-content">
          <div class="columns small-12 text-center">
          <?php if ( have_rows('field_5e9f92f1c56e9') ): ?>
            <?php while ( have_rows('field_5e9f92f1c56e9') ): the_row();
              $download_button_copy = get_sub_field('field_5e9f930ac56ea');
              $download_button_url = get_sub_field('field_5e9f9338c56eb');
            ?>
              <a href="<?php echo $download_button_url['url']; ?>" download="<?php echo $download_button_url['filename']; ?>" class="button"><?php echo $download_button_copy; ?></a>
            <?php endwhile; ?>
          <?php endif; ?>
          </div>
        </div>
      <?php else: ?>
      <?php endif; ?>
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
          <?php endwhile; wp_reset_query(); ?>
        <?php endif; ?>
      </div>
    </div>
  </main>
<?php elseif ( $theme_type == 'webconnected' ): ?>
	<?php
		// Web Connected Stuff Goes Here
	?>
<?php else: ?>
	<?php
	$event_video_feed = get_field('event_video_feed');
	$event_title = get_the_title();
	$event_video_title_attributes = ' title="'. $event_title .'"></iframe>';
	if ( $event_video_feed ):
	  $event_video_feed = '<div class="responsive-embed widescreen">' . str_replace('></iframe>', $event_video_title_attributes,  $event_video_feed) . '</div>';
	else:

	endif;
	$event_chat_feed = get_field('event_chat_feed');
	$video_feed_thumbnail = get_field('event_video_feed_thumbnail');
	?>
	<header class="<?php echo $thin_header_class; ?>">
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
		<?php if ( $live_event_query->have_posts() ): ?>
			<?php while ( $live_event_query->have_posts() ): $live_event_query->the_post(); ?>
				<main id="main-content">
		      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		        <div class="row align-center">
		          <?php if ( $event_chat_feed ): ?>
		            <div class="columns small-12 medium-7 large-8">
		              <?php echo $event_video_feed; ?>
		            </div>
		            <div class="columns small-12 medium-5 large-4 chat-column">
									<div class="event-chat-copy">
										<?php if ( $default_chat_prompt_copy ): ?>
											<?php echo $default_chat_prompt_copy; ?>
										<?php else: ?>
											<p>Please sign in to chat with us!</p>
										<?php endif; ?>
									</div>
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
		<?php else: ?>
			<main id="main-content">
	      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	        <div class="row align-center">
	          <?php if ( $event_chat_feed ): ?>
	            <div class="columns small-12 medium-7 large-8">
	              <?php echo $event_video_feed; ?>
	            </div>
	            <div class="columns small-12 medium-5 large-4 chat-column">
								<div class="event-chat-copy">
									<?php if ( $default_chat_prompt_copy ): ?>
										<?php echo $default_chat_prompt_copy; ?>
									<?php else: ?>
										<p>Please sign in to chat with us!</p>
									<?php endif; ?>
								</div>
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
		<?php endif; ?>
<?php endif; ?>
