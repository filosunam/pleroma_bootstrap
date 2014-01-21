<?php

  // Creating new custom menu widget from WP_Nav_Menu_Widget
  class Navbar_Widget extends WP_Nav_Menu_Widget {

    function __construct() {

      // Set options
      $options = array(
        'description' => 'Añade una barra de navegación que puede colapsarse.'
      );

      // Config widget
      WP_Widget::__construct( 'navbar_widget', 'Barra de navegación', $options );

    }

    // Widget front-end
    public function widget( $args, $instance ) {

      // Get menu
      $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

      if ( !$nav_menu )
          return;

      // Get title
      $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

?>
  <nav class="navbar navbar-default navbar-stacked" role="navigation">
    <div class="navbar-header">
      <span class="navbar-brand visible-xs"><?php echo $instance[ 'title' ] ?></span>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-<?php echo $instance[ 'nav_menu' ] ?>-collapse">
        <span class="sr-only">Navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-<?php echo $instance[ 'nav_menu' ] ?>-collapse">
      <?php

        // Displays nav menu
        wp_nav_menu(
          array(
            'menu'        => $nav_menu,
            'items_wrap'  => '<ul class="nav navbar-nav">%3$s</ul>',
            'fallback_cb' => 'pleroma_nav_menu_args'
          )
        );

      ?>
    </div>
  </nav>

<?php

    }

  }

  // Register the widget
  function navbar_load_widget() {
    register_widget( 'Navbar_Widget' );
  }

  // Load the widget
  add_action( 'widgets_init', 'navbar_load_widget' );

?>
