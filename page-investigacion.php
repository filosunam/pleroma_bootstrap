<?php

  // Check if is parent blog
  if ( is_main_site() ) :

?>

<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <div class="col-md-9 col-md-offset-3">
      <h1 class="h3 hidden-xs">
        <?php the_title(); ?>
      </h1>
    </div>
  </div><!-- /.row -->
</div><!-- /.container -->

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <!-- .col-md-3 -->
    <div class="col-md-3">
      <!-- .navbar.navbar-stacked -->
      <nav class="navbar navbar-default navbar-stacked" role="navigation">    
        <!-- .navbar-header -->
        <div class="navbar-header">
          <a class="navbar-brand visible-xs" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
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
    
    <!-- #main.col-md-9 -->
    <div id="main" role="main" class="col-md-9">
      <?php

        // Get ids
        $ids = array(
          get_option( 'pleroma_project_featured_1' ),
          get_option( 'pleroma_project_featured_2' ),
          get_option( 'pleroma_project_featured_3' ),
          get_option( 'pleroma_project_featured_4' ),
          get_option( 'pleroma_project_featured_5' )
        );
        
        // Set arguments
        $args = array(
          'post_type'       => 'research-project',
          'post__in'        => $ids,
          'meta_key'        => '_thumbnail_id',
          'posts_per_page'  => 5
        );

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

              // Displays item
              echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . $thumbnail . '</a>';
              
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

      <?php endif; // end check if exist posts ?>

      <?php

        // Set arguments
        $args = array(
          'post_type'       => 'research-project',
          'orderby'         => 'rand',
          'meta_key'        => '_thumbnail_id',
          'posts_per_page'  => 9
        );

        // Set query posts
        query_posts( $args );

        // Check if exists posts
        if ( have_posts() ) :

      ?>

      <!-- .row -->
      <div class="row">
        <?php while ( have_posts() ) : the_post(); ?>
          <div class="col-md-4 col-xs-6 research-featured" id="post-<?php the_ID(); ?>">
            <a href="<?php echo get_permalink(); ?>">
              <?php the_post_thumbnail( 'medium', array( 'class' => 'img-responsive img-thumbnail' ) ); ?>
              <div class="title">
                <span><?php the_title() ?></span>
              </div>
            </a>
          </div>
        <?php endwhile; ?>
      </div><!-- /.row -->

      <?php endif; ?>
    </div><!-- /#main.col-md-9 -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>

<?php

  // If is child blog
  else:

    // Displays page default template
    get_template_part( 'page' );
  
  endif;

?>
