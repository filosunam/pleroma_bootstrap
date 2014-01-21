<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <!-- .col-md-9 -->
    <div class="col-md-9">

      <!-- #main -->
      <div id="main" role="main">
        <?php

          // Get category slider
          $category_slider = get_option( 'pleroma_boletin_slider' );

          // Get if is manual
          $manual = get_option( 'pleroma_boletin_manual' );

          // If is manual
          if ( $manual ) {

            // Get ID's of posts
            $ids = array(
              get_option( 'pleroma_boletin_featured_1' ),
              get_option( 'pleroma_boletin_featured_2' ),
              get_option( 'pleroma_boletin_featured_3' ),
              get_option( 'pleroma_boletin_featured_4' ),
              get_option( 'pleroma_boletin_featured_5' )
            );

            // Set arguments
            $args = array(
              'post_type'           => array( 'post', 'page', 'event' ),
              'post__in'            => $ids,
              'orderby'             => 'post__in',
              'meta_key'            => '_thumbnail_id',
              'posts_per_page'      => 5,
              'ignore_sticky_posts' => 1
            );

          // If is not manual
          } else {

            // Set arguments
            $args = array(
              'cat'                 => $category_slider,
              'meta_key'            => '_thumbnail_id',
              'posts_per_page'      => 5,
              'ignore_sticky_posts' => 1
            );

          }

          // Set query posts
          query_posts( $args );

          // Check if exists posts
          if ( have_posts() ) :

        ?>

        <!-- #CarouselHome -->
        <div id="CarouselHome" class="carousel carousel-fade slide">
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
                  
                  default:
                    echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . $thumbnail . '</a>';
                    break;

                }
                
              ?> 
              <div class="carousel-caption"><?php the_title() ?></div>
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
      </div><!-- /#main -->

      <!-- .row -->
      <div class="row">
        <!-- .col-md-8 -->
        <div class="col-md-8">
          <?php

            // Reset query
            wp_reset_query();

            // Get partial of archive
            get_template_part( 'partials/content-archive', 'single' );

            // Get pagination
            the_pagination();

          ?>
        </div><!-- /.col-md-8 -->

        <!-- .col-md-4 -->
        <div class="col-md-4">
          <?php

            // Sidebar 1
            get_sidebar( 1 );

          ?>
        </div><!-- /.col-md-4 -->
      </div><!-- /.row -->

    </div><!-- /.col-md-9 -->

    <!-- .col-md-3 -->
    <div class="col-md-3">
      <?php

        // Sidebar 2
        get_sidebar( 2 );

      ?>
    </div><!-- /.col-md-3 -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
