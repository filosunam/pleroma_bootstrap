<?php
/**
 * The template for displaying a research projects by archive
 */
?>

<?php get_header(); ?>

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">
    <div class="col-md-8 col-md-offset-4 col-lg-9 col-lg-offset-3">
      <h1 class="h3 hidden-xs">
        <span class="text-muted">Línea de investigación:</span> <?php single_cat_title(); ?><hr>
      </h1>
    </div>
  </div><!-- /.row -->
</div><!-- /.container -->

<!-- .container -->
<div class="container">
  <!-- .row -->
  <div class="row">

    <!-- .col-md-4.col-lg-3 -->
    <div class="col-md-4 col-lg-3">
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
    </div><!-- /.col-md-4.col-lg-3 -->
    
    <!-- #main.col-md-8.col-lg-9 -->
    <div id="main" class="col-md-8 col-lg-9" role="main">
      <div class="row">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" class="col-md-6 col-lg-4">
              <p>
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                  <?php the_post_thumbnail( 'small', array( 'class' => 'img-responsive img-thumbnail' ) ); ?>
                </a>
              </p>
              <header class="entry-header">
                <p class="entry-title">
                  <a href="<?php echo get_permalink(); ?>">
                    <strong><?php the_title(); ?></strong></a>
                </p>
              </header>
              <div class="entry-content">
                <?php the_excerpt(); ?>
              </div>

              <?php

                // Set empty array
                $categories = array();

                // Get the terms of "research_category" by research ID
                $categories_list = get_the_terms( get_the_ID(), 'research_category' );

                // If is array
                if ( is_array( $categories_list ) ) {

                  echo '<footer class="entry-meta well well-sm">';
                  
                  // Assign the category to categories array
                  foreach ( $categories_list as $key => $value ) {
                    $categories[] = '<a href="'. get_term_link( $value->slug, 'research_category' ) .'">'. $value->name .'</a>';
                  }

                  // Implode to display the categories
                  echo 'Categorías: ' . implode( $categories, ', ' );

                  echo '</footer>';

                }

              ?>
            </article>
        <?php endwhile; endif; ?>
      </div>
      <?php

        // Get pagination
        the_pagination();

      ?>
    </div><!-- /#main.col-md-8.col-lg-9 -->

  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
