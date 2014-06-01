<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <!-- .col-md-8.col-lg-9 -->
    <div class="col-md-8 col-lg-9">
      <?php

        // Get category slider
        $category_slider = get_option( 'pleroma_home_slider' );
        $category_slider = !$category_slider ? -1 : $category_slider;

        // Display carousel if is home
        if ( is_home() ) :

          // Set arguments
          $args = array(
            'cat'             => $category_slider,
            'posts_per_page'  => 6,
            'meta_key'        => '_thumbnail_id'
          );

          // Set query posts
          query_posts( $args );

          // Check if exists at least one
          if ( $wp_query->post_count > 0 ) :

      ?>

      <!-- #CarouselHome -->
      <div id="CarouselHome" class="carousel carousel-fade highlight slide">
        <?php if ( $wp_query->post_count > 1 ) : ?>
        <!-- .carousel-indicators -->
        <ol class="carousel-indicators">
          <?php
            // Display indicators
            for ( $i = 0; $i < $wp_query->post_count; $i++ ) {
              echo '<li data-target="#CarouselHome" data-slide-to="' . $i . '" class="' . ( $i == 0 ? ' active' : '' ) . '"></li> ';
            }
          ?>
        </ol><!-- /.carousel-indicators -->
        <?php endif; ?>

        <!-- .carousel-inner -->
        <div class="carousel-inner">
          <?php

            // Loop the posts
            while ( have_posts() ) : the_post();

                // Set 'active' class the first post in te loop
                $active = $wp_query->current_post == 0 ? 'active' : '';

                // Get link image with 'large' size
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

          ?>
          <!-- .item -->
          <div class="item <?php echo $active ?>">
            <?php

              // Thumbnail
              $thumbnail = '<img src="' . $large_image_url[0] . '" alt="' . the_title_attribute( 'echo=0' ) . '">';

              // Add link to all formats except to 'image' format
              switch ( get_post_format() ) {
                case 'image':
                  echo $thumbnail;
                  break;

                case 'link':
                  echo '<a href="' . strip_tags( get_the_content() ) . '" title="' . get_the_title() . '">' . $thumbnail . '</a>';
                  echo '<a href="' . strip_tags( get_the_content() ) . '" class="carousel-caption">' . get_the_title() . '</a>';
                  break;

                default:
                  echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . $thumbnail . '</a>';
                  echo '<a href="' . get_permalink() . '" class="carousel-caption">' . get_the_title() . '</a>';
                  break;

              }

            ?>
            <!-- <div class="carousel-caption"><?php the_title() ?></div> -->
          </div><!-- /.item -->
          <?php endwhile; // End the loop ?>
        </div><!-- /.carousel-inner -->

        <?php if ( $wp_query->post_count > 1 ) : ?>
        <!-- .carousel-controls -->
        <div class="carousel-controls">
          <a class="left carousel-control" href="#CarouselHome" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#CarouselHome" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div><!-- /.carousel-controls -->
        <?php endif; ?>
      </div><!-- /#CarouselHome -->

        <?php endif; ?>
      <?php endif; ?>
    </div><!-- /.col-md-8.col-md-9 -->

    <!-- .col-md-4.col-lg-3 -->
    <div class="col-md-4 col-lg-3">
      <?php

        // If has 'secondary' nav menu
        if ( has_nav_menu( 'secondary' ) ) :

      ?>
      <!-- .nav-titled -->
      <nav class="nav-titled widget hidden-xs hidden-sm">
        <?php

          // Get menu locations
          $menus = get_nav_menu_locations();

          // Get nav menu object for display nav name
          echo '<h4 class="nav-title">' . wp_get_nav_menu_object( $menus['secondary'] )->name . '</h4>';

          // // Display secondary nav
          pleroma_secondary_nav();

        ?>
      </nav><!-- /.nav-titled -->
      <?php endif; // has 'secondary' nav menu ?>

      <?php

        // Get sidebar home
        get_sidebar( 'home' );

      ?>
    </div><!-- /.col-md-4.col-lg-3 -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php

  // Display featured posts
  get_template_part( 'index', 'featured' );

?>


<!-- .wrapper.wrapper-default -->
<div class="wrapper wrapper-default wrapper-margin-bottom">
  <?php if ( get_bloginfo( 'language' ) == 'es-ES' ) : ?>

  <!-- .container -->
  <div class="container">
    <!-- .row -->
    <div class="row">
      <!-- .col-md-5.col-lg-4 -->
      <div class="col-md-5 col-lg-4 featured-events">
        <?php

          // Set arguments for get last events
          $args = array(
            'title'           => '',
            'numberposts'     => 4,
            'showpastevents'  => 0,
            'template'        => '',
            'no_events'       => __( 'No events found', 'eventorganiser' )
          );

          // If there are events
          if ( eo_get_events( $args ) ) :

        ?>
        <?php the_widget( 'EO_Event_List_Widget', $args ); ?>
        <a class="btn btn-sm btn-default" href="/calendario-de-eventos">
          <span class="glyphicon glyphicon-calendar"></span>
          <?php _e( 'Events Calendar', 'eventorganiser' ); ?>
        </a>
        <?php endif; ?>
      </div><!-- /.col-md-5.col-lg-4 -->
      <!-- .col-md-7.col-lg-8 -->
      <div class="col-md-7 col-lg-8">
        <?php

          // Get ID of research product
          $research_product = get_option('pleroma_research_product');

          // Check if ID exists
          if ( $research_product ) :

            // Set query posts
            query_posts(
              array(
                'p'         => $research_product,
                'post_type' => array( 'post', 'page', 'event' ),
                'meta_key'  => '_thumbnail_id'
              )
            );

            // Check if the post exists
            if ( have_posts() ) : the_post();

              // Get partial of research product
              get_template_part( 'partials/content-featured', 'research-product' );

            endif;

          endif;

        ?>

        <!-- .row.hidden-xs.hidden-sm -->
        <div class="row hidden-xs hidden-sm">
        <?php

          // Get ID's of research projects
          $ids = array(
            get_option( 'pleroma_project_featured_1' ),
            get_option( 'pleroma_project_featured_2' ),
            get_option( 'pleroma_project_featured_3' )
          );

          // Set arguments
          $args = array(
            'post_type' => 'research-project',
            'post__in'  => $ids,
            'orderby'   => 'post__in',
            'meta_key'  => '_thumbnail_id'
          );

          // Set query posts
          query_posts($args);

          if ( have_posts() ) :

            while ( have_posts() ) : the_post();

              // Get partial of research project
              get_template_part( 'partials/content-featured', 'research' );

            endwhile;
          endif;

        ?>
        </div><!-- /.row -->

      </div><!-- /.col-md-7.col-lg-8 -->
    </div><!-- /.row -->
  </div><!-- ./container -->
  
  <?php endif; ?>
</div><!-- /.wrapper.wrapper-default -->


<?php get_footer(); ?>
