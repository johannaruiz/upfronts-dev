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
