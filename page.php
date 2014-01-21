<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">

    <?php if ( is_main_site() ) : ?>

    <!-- #main.col-md-6 -->
    <div id="main" role="main" class="col-md-6">
      <?php

        // Get partial of single page
        get_template_part( 'partials/content-page', 'single' );

      ?>
    </div><!-- /#main.col-md-6 -->

    <!-- .col-md-3 -->
    <div class="col-md-3">
      <?php

        // Sidebar Page 1
        get_sidebar( 'page-1' );

      ?>
    </div><!-- /.col-md-3 -->

    <!-- .col-md-3 -->
    <div class="col-md-3">
      <?php

        // Sidebar Page 2
        get_sidebar( 'page-2' );

      ?>
    </div><!-- /.col-md-3 -->          
    
    <?php else : ?>

    <!-- .col-md-3 -->
    <div class="col-md-3">
      <?php

        // Sidebar 1
        get_sidebar( 1 );

      ?>
    </div><!-- /.col-md-3 -->

    <!-- #main.col-md-6 -->
    <div id="main" role="main" class="col-md-6">
      <?php
        
        // Displays the breadcrumb
        the_breadcrumb();

        // Get partial of single page
        get_template_part( 'partials/content-page', 'single' );

      ?>
    </div><!-- /#main.col-md-6 -->

    <!-- .col-md-3 -->
    <div class="col-md-3">
      <?php

        // Sidebar 2
        get_sidebar( 2 );

      ?>
    </div><!-- /.col-md-3 -->

    <?php endif; ?>

  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
