<?php get_header(); ?>

<!-- .container -->
<div class="container">
	<!-- .row -->
	<div class="row">
		<!-- .col-md-3 -->
	  <div class="col-md-3">
	    <?php

	    	// Sidebar 1
	    	get_sidebar( 1 );

	    ?>
	  </div><!-- /.col-md-3 -->

	  <!-- .col-md-9 -->
	  <div class="col-md-9">

	    <?php

	    	// Get category slider
	      $category_slider = get_option( 'pleroma_home_slider' );
        $category_slider = !$category_slider ? -1 : $category_slider;

	      // Displays carousel if is home and category ID exists
	      if ( is_home() ) :

          // Set arguments
          $args = array(
            'cat'                 => $category_slider,
            'posts_per_page'      => 6,
            'meta_key'            => '_thumbnail_id',
            'ignore_sticky_posts' => 1
          );

          // Set query posts
          query_posts( $args );

          // Check if exists at least one
          if ( $wp_query->post_count > 0 ) :

	    ?>
      <!-- #CarouselHome -->
      <div id="CarouselHome" class="carousel slide">
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

              // Set 'active' class the first post in the loop
              $active = $wp_query->current_post == 0 ? 'active' : '';

              // Get link image with 'large' size
              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

              // Set format link
              $format_link = '<a href="%1$s" alt="%2$s">%3$s</a>';

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
      <?php

      		// If post count > 0
      		endif;

      	// If is home and category ID exists
	    	endif;

	    ?>
	    <!-- .wrapper.wrapper-default -->
	    <div class="wrapper wrapper-default">
	    	<div class="row">
	    		<?php

	    			// Display featured posts
	    			get_template_part( 'index', 'featured' );

	    		?>
	    	</div>
	    </div><!-- /.wrapper.wrapper-default -->
	    
		</div><!-- /.col-md-9 -->
	</div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
