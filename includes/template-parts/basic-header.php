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
