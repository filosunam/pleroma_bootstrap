<?php

  // Display primary nav if is child blog
  if ( ! is_main_site() ) :

?>

<!-- .navbar.navbar-stacked -->
<nav class="navbar navbar-default navbar-stacked" role="navigation">    
  <!-- .navbar-header -->
  <div class="navbar-header">
    <a class="navbar-brand visible-xs" href="<?php echo get_option( 'siteurl' ) ?>"><?php echo get_option( 'blogname' ) ?></a>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary2-navbar-collapse">
      <span class="sr-only">Navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div><!-- /.navbar-header -->
  <!-- .navbar-collapse -->
  <div class="collapse navbar-collapse" id="primary2-navbar-collapse">
    <?php
      
      // Displays nav menu
      wp_nav_menu(
        array(
          'theme_location'  => 'primary',
          'container'       => false,
          'depth'           => 3,
          'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
          'fallback_cb'     => 'pleroma_nav_menu_args'
        )
      );

    ?>
  </div><!-- .navbar-collapse -->
</nav><!-- /.navbar.navbar-stacked -->

<?php endif; ?>

<?php

  // Sidebar 1
  if ( is_active_sidebar( 'sidebar-1' ) ) {
    // Hide sidebar to small and extremely small screen devices
    echo '<div class="sidebar '
        . ( ! is_main_site() ? 'hidden-xs hidden-sm' : '' ) .'">';
      dynamic_sidebar( 'sidebar-1' );
    echo '</div>';
  }

?>
