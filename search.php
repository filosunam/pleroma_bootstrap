<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">

  <?php if ( is_main_site() ) : ?>

    <!-- #main.col-sm-8.col-md-6 -->
    <div id="main" class="col-sm-8 col-md-6" role="main">
      <h1 class="h4">
        <span class="glyphicon glyphicon-search"></span>
        <?php _e( 'Buscar', 'pleromabootstrap' ); ?> "<?php echo esc_attr( get_search_query() ); ?>"
      </h1>

      <?php

        // Get partial of archive
        get_template_part( 'partials/content-archive', 'single' );

        // Get pagination
        the_pagination();

      ?>

      <?php if ( ! have_posts() ) : ?>

      <!-- .well -->
      <div class="well">
        <strong><?php _e( 'Disculpa, no hay resultados.', 'pleromabootstrap' ); ?></strong> <br>
        <?php  _e( 'Intenta de nuevo la búsqueda.', 'pleromabootstrap' ); ?>
      </div><!-- /.well -->

      <?php endif; ?>
    </div><!-- /#main.col-sm-8.col-md-6 -->

    <!-- .col-sm-4.col-md-6 -->
    <div class="col-sm-4 col-md-6">
      <!-- .row -->
      <div class="row">
        <!-- .col-md-6 -->   
        <div class="col-md-6">
          <?php

            // Sidebar 1
            get_sidebar( 1 );

          ?>
        </div><!-- /.col-md-6 -->
        <!-- .col-md-6 -->
        <div class="col-md-6">
          <?php

            // Sidebar 2
            get_sidebar( 2 );

          ?>
        </div><!-- /.col-md-6 -->
      </div>
      <!-- /.row -->     
    </div><!-- /.col-sm-4.col-md-6 -->
      
  <?php else : ?>

    <!-- .col-md-3 -->
      <div class="col-md-3">
        <?php

          // Sidebar 1
          get_sidebar( 1 );

        ?>
      </div><!-- /.col-md-3 -->

      <!-- #main.col-md-6 -->
      <div id="main" class="col-md-6" role="main">
        <?php

          // Get breadcrumb
          the_breadcrumb();

        ?>
        
        <h1 class="h4">
          <span class="glyphicon glyphicon-search"></span>
          <?php _e( 'Buscar', 'pleromabootstrap' ); ?> "<?php echo esc_attr( get_search_query() ); ?>"
        </h1>

        <?php

          // Get partial of archive
          get_template_part( 'partials/content-archive', 'single' );

          // Get pagination
          the_pagination();

        ?>

        <?php if ( ! have_posts() ) : ?>

        <!-- .well -->
        <div class="well">
          <strong><?php _e( 'Disculpa, no hay resultados.', 'pleromabootstrap' ); ?></strong> <br>
          <?php  _e( 'Intenta de nuevo la búsqueda.', 'pleromabootstrap' ); ?>
        </div><!-- /.well -->

        <?php endif; ?>
      </div> <!-- /#main.col-md-6 -->

      <!-- .col-md-3 -->
      <div class="col-md-3">
        <?php

          // Sidebar 2
          get_sidebar( 2 );

        ?>
      </div><!-- /.col-md-3 -->

  <?php endif;?>

  </div> <!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
