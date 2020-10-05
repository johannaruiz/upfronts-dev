<main id="main-content">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
				<?php endwhile; ?>
			<?php endif;
			wp_reset_postdata(); ?>
			<div class="columns small-12 large-7 xlarge-6 page-content">
				<div class="content-container">
					<?php the_content(); ?>
				</div><!-- /.content-container -->
			</div>
		</div>
	</div><!-- #post-<?php the_ID(); ?> -->
</main>
