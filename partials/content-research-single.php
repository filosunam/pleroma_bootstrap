<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <!-- article -->
  <article id="post-<?php the_ID(); ?>" class="research">

    <!-- .entry-header -->
    <header class="entry-header">
      <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
      <h1 class="h3"><?php the_title(); ?></h1>
      <?php

        // Set empty array
        $categories = array();

        // Get the terms of "research_category" by research ID
        $categories_list = get_the_terms( get_the_ID(), 'research_category' );

        // If is array
        if ( is_array( $categories_list ) ) {

          echo '<div class="well well-small">';
          
          // Assign the category to categories array
          foreach ( $categories_list as $key => $value ) {
            $categories[] = '<a href="'. get_term_link( $value->slug, 'research_category' ) .'" class="label label-default">'. $value->name .'</a>';
          }

          // Implode to display the categories
          echo 'Líneas de investigación: ' . implode( $categories, ' ' );

          echo '</div>';

        }

      ?>
    </header><!-- /.entry-header -->

    <!-- .entry-content -->
    <div class="entry-content">
      <?php

        // Displays the content
        the_content();

      ?>
    </div><!-- /.entry-header -->

    <!-- .entry-meta -->
    <footer class="entry-meta">
      <hr>
      <?php
        if ( is_user_logged_in() ) {
          echo '<a href="' . get_edit_post_link() . '" class="btn btn-success">Editar proyecto</a>';
        }
      ?>
    </footer><!-- /.entry-meta -->

  </article><!-- /article -->

<?php endwhile; endif; ?>
