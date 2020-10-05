<?php
/**
* Template part for displaying page content in page.php
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package foxlive
*/
	$front_page_id = get_option('page_on_front');
	$children = get_children($front_page_id);

	$page_category = get_the_category();
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

	$default_chat_prompt_copy = get_field('field_5f5851bb19094', 'option');
?>
  <?php if ( $theme_type == 'basic' ):
		$live_event_args = array(
	  	'post_type'         =>  'live-event',
	  	'posts_per_page'    =>  -1,
	  	'order'             =>  'ASC',
	  	'orderby'           =>  'date',
	  );
	  $live_event_query = new WP_Query($live_event_args);
	?>
	<?php if ( $live_event_query->have_posts() ): ?>

    <?php while ( $live_event_query->have_posts() ): $live_event_query->the_post();
    $event_video_feed = get_field('event_video_feed');
		$event_video_row_width = get_field('video_row_width');
    $event_title = get_the_title();
    $event_video_title_attributes = ' title="'. $event_title .'"></iframe>';
    if ( $event_video_feed ):
      $event_video_feed = '<div class="responsive-embed widescreen">' . str_replace('></iframe>', $event_video_title_attributes,  $event_video_feed) . '</div>';
    else:

    endif;
    $event_chat_feed = get_field('event_chat_feed');
		$event_chat_feed_position = get_field('chat_feed_position');
		// in-page-right
		// floating-bottom
		// floating-right
    $video_feed_thumbnail = get_field('event_video_feed_thumbnail');
    ?>
    <header class="<?php echo $thin_header_class; ?>">
			<?php if ( $event_video_row_width == 'wide' ): ?>
				<div class="row expanded">
			<?php else: ?>
				<div class="row">
			<?php endif; ?>
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
				<?php if ( $event_video_row_width == 'wide' ): ?>
					<div class="row expanded align-center">
				<?php else: ?>
					<div class="row align-center">
				<?php endif; ?>
          <?php if ( $event_chat_feed ): ?>
						<?php if ( $event_chat_feed_position != 'in-page-right' ): ?>
							<div class="columns small-12 medium-12 large-12">
	              <?php echo $event_video_feed; ?>
	            </div>
							<div class="columns small-12 floating-chat">
								<!--<div class="event-chat-copy">
									<?php if ( $default_chat_prompt_copy ): ?>
										<?php echo $default_chat_prompt_copy; ?>
									<?php else: ?>
										<p>Please sign in to chat with us!</p>
									<?php endif; ?>
								</div>-->
	              <?php echo $event_chat_feed; ?>
							</div>
						<?php else: ?>
							<div class="columns small-12 medium-9 large-9">
	              <?php echo $event_video_feed; ?>
	            </div>
	            <div class="columns small-12 medium-3 large-3 chat-column">
								<div class="event-chat-copy">
									<?php if ( $default_chat_prompt_copy ): ?>
										<?php echo $default_chat_prompt_copy; ?>
									<?php else: ?>
										<p>Please sign in to chat with us!</p>
									<?php endif; ?>
								</div>
	              <?php echo $event_chat_feed; ?>
	            </div>
						<?php endif; ?>
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
	<?php else:
		$event_video_feed = get_field('event_video_feed');
		$event_video_row_width = get_field('video_row_width');
    $event_title = get_the_title();
    $event_video_title_attributes = ' title="'. $event_title .'"></iframe>';
    if ( $event_video_feed ):
      $event_video_feed = '<div class="responsive-embed widescreen">' . str_replace('></iframe>', $event_video_title_attributes,  $event_video_feed) . '</div>';
    else:

    endif;
    $event_chat_feed = get_field('event_chat_feed');
		$event_chat_feed_position = get_field('chat_feed_position');
    $video_feed_thumbnail = get_field('event_video_feed_thumbnail');
	?>
	<header class="<?php echo $thin_header_class; ?>">
		<?php if ( $event_video_row_width == 'wide' ): ?>
			<div class="row expanded">
		<?php else: ?>
			<div class="row">
		<?php endif; ?>
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
			<?php if ( $event_video_row_width == 'wide' ): ?>
				<div class="row expanded align-center">
			<?php else: ?>
				<div class="row align-center">
			<?php endif; ?>
        <?php if ( $event_chat_feed ): ?>
					<?php if ( $event_chat_feed_position != 'in-page-right' ): ?>
						<div class="columns small-12 medium-12 large-12">
	            <?php echo $event_video_feed; ?>
	          </div>
						<div class="columns small-12 floating-chat">
							<!--<div class="event-chat-copy">
								<?php if ( $default_chat_prompt_copy ): ?>
									<?php echo $default_chat_prompt_copy; ?>
								<?php else: ?>
									<p>Please sign in to chat with us!</p>
								<?php endif; ?>
							</div>-->
	            <?php echo $event_chat_feed; ?>
						</div>
					<?php else: ?>
						<div class="columns small-12 medium-9 large-9">
	            <?php echo $event_video_feed; ?>
	          </div>
	          <div class="columns small-12 medium-3 large-3 chat-column">
							<div class="event-chat-copy">
								<?php if ( $default_chat_prompt_copy ): ?>
									<?php echo $default_chat_prompt_copy; ?>
								<?php else: ?>
									<p>Please sign in to chat with us!</p>
								<?php endif; ?>
							</div>
	            <?php echo $event_chat_feed; ?>
	          </div>
					<?php endif; ?>
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
  <?php elseif ( $theme_type == 'activity' ):
		$activity_args = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'post_parent' => $front_page_id,
			'order' => 'ASC',
			'orderby' => 'menu_order'
		);
		$activity_query = new WP_Query($activity_args);
		$activity_tagline = get_field('field_5e9fe8d64c12e', 'option');

		$featured_video = get_field('field_5e9f9293c56e7');
    $main_description = get_field('field_5e9f3436602d5');
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
  <?php elseif ( $theme_type == 'webconnected' ):
		$event_video_feed = get_field('event_video_feed');
		preg_match('/src="(.+?)"/', $event_video_feed, $matches);
		$iframe_src = $matches[1];

		$event_video_row_width = get_field('video_row_width');
    $event_title = get_the_title();
    $event_video_title_attributes = ' title="'. $event_title .'"></iframe>';
		$meetmo_source = get_field('meetmo_source');
    if ( $event_video_feed ):
      $event_video_feed = '<div class="responsive-embed widescreen">' . str_replace('></iframe>', $event_video_title_attributes,  $event_video_feed) . '</div>';
    else:

    endif;
		if ( is_user_logged_in() ):

			if ( !empty($meetmo_source) ):

				if ( isset($_COOKIE['jwt-webconnected-demo']) ):
					$meetmo_source .= '?jwt=' . $_COOKIE['jwt-webconnected-demo'];
					$event_video_feed = str_replace($iframe_src, $meetmo_source, $event_video_feed);
				else:
					$event_video_feed = $event_video_feed;
				endif;
			else:
			endif;
		else:
		endif;
    $event_chat_feed = get_field('event_chat_feed');
		$event_chat_feed_position = get_field('chat_feed_position');
    $video_feed_thumbnail = get_field('event_video_feed_thumbnail');
	?>
		<div class="off-canvas-wrapper">
			<!--<div class="off-canvas position-right off-canvas-absolute"  data-transition="overlap" id="offCanvas" data-off-canvas>
				<div class="off-canvas-navigation">
					<?php //TODO: Update Nav to be dynamic Finish by Monday ?>
					<ul class="menu vertical">
	          <?php wp_nav_menu( array(
	            'theme_location'   => 'menu-2',
	            'container'        => '',
	            'menu_class'       => '',
	            'items_wrap'       => '%3$s'
	          ) ); ?>
	        </ul>
				</div>
			</div>-->
			<div class="off-canvas-content" data-off-canvas-content>
				<header class="<?php echo $thin_header_class; ?>">
					<?php if ( $event_video_row_width == 'wide' ): ?>
						<div class="row expanded">
					<?php else: ?>
						<div class="row">
					<?php endif; ?>
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
			      <div class="column small-12 medium-4 text-right">
							<!--<button type="button" class="button" data-toggle="offCanvas"><i class="fas fa-bars" aria-hidden="true"></i></button>-->
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
						<?php if ( $event_video_row_width == 'wide' ): ?>
							<div class="row expanded align-center">
						<?php else: ?>
							<div class="row align-center">
						<?php endif; ?>
			        <?php if ( $event_chat_feed ): ?>
								<?php if ( $event_chat_feed_position != 'in-page-right' ): ?>
									<div class="columns small-12 medium-12 large-12">
				            <?php echo $event_video_feed; ?>
				          </div>
									<div class="columns small-12 floating-chat">
										<!--<div class="event-chat-copy">
											<?php if ( $default_chat_prompt_copy ): ?>
												<?php echo $default_chat_prompt_copy; ?>
											<?php else: ?>
												<p>Please sign in to chat with us!</p>
											<?php endif; ?>
										</div>-->
				            <?php echo $event_chat_feed; ?>
									</div>
								<?php else: ?>
									<div class="columns small-12 medium-9 large-9">
				            <?php echo $event_video_feed; ?>
				          </div>
									<div class="columns small-12 medium-3 large-3 chat-column">
										<div class="event-chat-copy">
											<?php if ( $default_chat_prompt_copy ): ?>
												<?php echo $default_chat_prompt_copy; ?>
											<?php else: ?>
												<p>Please sign in to chat with us!</p>
											<?php endif; ?>
										</div>
				            <?php echo $event_chat_feed; ?>
				          </div>
								<?php endif; ?>
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
			</div>
		</div>
	<?php else: ?>

	<?php endif; ?>
