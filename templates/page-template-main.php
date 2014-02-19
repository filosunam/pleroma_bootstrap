<?php
/*
  Template Name: Columna izquierda y derecha
*/
?>

<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <!-- .col-md-3 -->
    <div class="col-md-3">
      <?php

        // Sidebar Page 1
        get_sidebar( 'page-1' );

      ?>
    </div><!-- /.col-md-3 -->

    <div id="main" role="main" class="col-md-6">
      <?php

        if ( ! is_main_site() ) {

          // Displays the breadcrumb
          the_breadcrumb();

        }

        // Get partial of single page
        get_template_part( 'partials/content-page', 'single' );

      ?>
    </div><!-- /.span6 -->

    <div class="col-md-3">
      <?php

        // Sidebar Page 2
        get_sidebar( 'page-2' );

      ?>
    </div><!-- /.col-md-3 -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
