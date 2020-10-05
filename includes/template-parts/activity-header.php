<?php
  $use_thin_header = get_field('field_5f4800b119aa4','option');
  $thin_header_class = '';
  if ( $use_thin_header ):
    $thin_header_class = 'thin-header';
  else:
    $thin_header_class = $thin_header_class;
  endif;
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
