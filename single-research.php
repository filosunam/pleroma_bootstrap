<?php
/**
 * The template for displaying a single research
 */
?>

<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">

    <!-- .col-md-3 -->
    <div class="col-md-3">
      <h4 class="widget-title hidden-xs"><?php _e( 'Líneas de investigación' ); ?></h4>
      <!-- .navbar.navbar-stacked -->
      <nav class="navbar navbar-default navbar-stacked" role="navigation">    
        <!-- .navbar-header -->
        <div class="navbar-header">
          <a class="navbar-brand visible-xs" href="<?php echo get_permalink(); ?>"><?php _e( 'Líneas de investigación' ); ?></a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#researchlines-navbar-collapse">
            <span class="sr-only">Navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div><!-- /.navbar-header -->
        <!-- .navbar-collapse -->
        <div class="collapse navbar-collapse" id="researchlines-navbar-collapse">
          <ul class="nav navbar-nav">
          <?php

            // Get current term
            $current = get_query_var( 'term' );

            // Set taxonomy variable
            $taxonomy = 'research_category';

            // Get terms depending on taxonomy
            $categories = get_terms( $taxonomy, '' );

            // Check if categories exist
            if ( $categories ) {

              // For each category
              foreach ( $categories as $category ) {

                // Display <li> element
                echo '<li '. ( $current === $category->slug ? 'class="active"' : '' ) . '>';
                echo '<a href="' . esc_attr( get_term_link( $category, $taxonomy ) ) . '">' . $category->name . '</a>';
                echo '</li>';

              }

            }

          ?>
          </ul>
        </div><!-- .navbar-collapse -->
      </nav><!-- /.navbar.navbar-stacked -->

      <?php

        // Sidebar Page 1
        get_sidebar('page-1');

      ?>

    </div><!-- /.col-md-3 -->
    
    <!-- #main.col-md-3 -->
    <div id="main" class="col-md-6" role="main">
      <?php

        // Get partial of single research
        get_template_part( 'partials/content-research', 'single' );

      ?>
    </div><!-- /#main.col-md-3 -->
    
    <!-- .col-md-3 -->
    <div class="col-md-3">

      <?php 

        // Get the ID
        $post_id = get_the_ID();

        // Add default arguments
        $widget_args = array(
          'before_title' => '<h4 class="widget-title h4 lead">'
        );

        // RSS Link
        $rss = get_post_meta( $post_id, 'rp_rss_link', true );

        if ($rss) {

          // RSS widget options
          $rss_options = array(
            'title' => 'Productos recientes', // Title of the Widget
            'url' => esc_url( $rss ), // URL of the RSS Feed
            'items' => 10, // Number of items to be displayed
            'show_summary' => 0, // Show post excerpts?
            'show_author' => 0, // Set 1 to display post author
            'show_date' => 0 // Set 1 to display post dates
          );

          // Add custom arguments to RSS widget
          $widget_args['after_title'] = 
              '</h4><div class="alert alert-info" style="text-align: center">Productos recientes del proyecto '
            . 'en el <a href="http://ru.ffyl.unam.mx" style="color: inherit;">Repositorio RUFFYL</a></div>';

          // Show the widget
          the_widget( 'WP_Widget_RSS', $rss_options, $widget_args );
          
        }

      ?>

    </div><!-- /.col-md-3 -->

  </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
