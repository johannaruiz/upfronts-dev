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
$default_event_tile = get_field('field_5f584b51db07f', 'option');
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
?>
<main id="main-content">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( $use_activity_layout ): ?>
      <?php if ( $use_landing_tile ): ?>
        <div class="row align-center">
          <div class="column small-12 medium-11">
            <img src="<?php echo $landing_tile['url']; ?>" alt="<?php echo $landing_tile['alt']; ?>" style="width: 100%;">
          </div>
        </div>
      <?php else: ?>
      <?php endif; ?>
      <div class="row align-justify align-middle">
        <div class="columns small-12 large-5 xlarge-5 event-sidebar">
          <div class="event-sidebar-content">
            <div class="event-sidebar-copy">
              <?php if ( $activity_layout_artwork ): ?>
                <img src="<?php echo $activity_layout_artwork['url']; ?>" alt="<?php echo $activity_layout_artwork['alt']; ?>">
              <?php else: ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
  			<div class="columns small-12 large-7 xlarge-6 page-content">
  				<div class="content-container">
  					<?php the_content(); ?>
  				</div><!-- /.content-container -->
  			</div>
  		</div>
    <?php else: ?>
      <?php if ( $use_landing_tile ): ?>
        <div class="row align-center">
          <div class="column small-12 medium-11">
            <img src="<?php echo $landing_tile['url']; ?>" alt="<?php echo $landing_tile['alt']; ?>" style="width: 100%;">
          </div>
        </div>
      <?php else: ?>
      <?php endif; ?>
      <div class="row align-justify align-middle">
  			<?php if ( $live_event_query->have_posts() ): ?>
  				<?php while ( $live_event_query->have_posts() ): $live_event_query->the_post();
  					$start_time_and_date = get_field('event_start_date_and_time');
  					$end_time_and_date = get_field('event_end_date_and_time');
  					$time_now = date('F j, Y g:i a');
  					$start_time_and_date_string = strtotime($start_time_and_date);
  					$end_time_and_date_string = strtotime($end_time_and_date);

  					$time_now_string = strtotime($time_now);
  					$event_title = get_the_title();
  					?>
  					<?php if ( (int) $time_now_string <= (int) $start_time_and_date || (int) $time_now_string <= $end_time_and_date_string ):
  						$status_text = 'On Air';
  						$status_class = 'on-air';
  					else :
  						$status_text = 'Off Air';
  						$status_class = 'off-air';
  					endif; ?>
  					<div class="columns small-12 large-5 xlarge-5 event-sidebar">
  						<div class="event-sidebar-content">
  							<div class="event-sidebar-copy">
                  <?php if ( has_post_thumbnail() ): ?>
                    <?php the_post_thumbnail('full'); ?>
                  <?php else: ?>
                    <span class="<?php echo $status_class; ?>"><em><?php echo $status_text; ?></em></span>
    								<img id="fox-logo" src="<?php bloginfo('template_directory'); ?>/includes/assets/images/logo.svg" alt="Fox Live" />
    								<h1><?php echo $event_title; ?></h1>
    								<?php if ( $start_time_and_date ): ?>
    									<?php echo "<p>{$start_time_and_date} PT</p>"; ?>
    								<?php endif; ?>
                  <?php endif; ?>
  							</div>
  						</div>
  					</div>
  				<?php endwhile; wp_reset_postdata(); ?>
				<?php else: ?>
					<div class="columns small-12 large-5 xlarge-5 event-sidebar">
						<div class="event-sidebar-content">
							<div class="event-sidebar-copy">
                <img src="<?php echo $default_event_tile['url']; ?>" alt="<?php echo $default_event_tile['alt']; ?>">
							</div>
						</div>
					</div>
  			<?php endif; ?>
  			<div class="columns small-12 large-7 xlarge-6 page-content">
  				<div class="content-container">
  					<?php the_content(); ?>
  				</div><!-- /.content-container -->
  			</div>
  		</div>
    <?php endif; ?>
	</div><!-- #post-<?php the_ID(); ?> -->
</main>
