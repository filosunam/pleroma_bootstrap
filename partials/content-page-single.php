<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <!-- article -->
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <!-- .entry-header -->
    <header class="entry-header">
      <?php if ( is_front_page() ) : ?>
        <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
        <h1 class="h3"><?php the_title(); ?></h1>
      <?php else : ?>
        <h1 class="h3"><?php the_title(); ?></h1>
      <?php endif; ?>
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
    </footer><!-- /.entry-meta -->

  </article><!-- /article -->

<?php endwhile; endif; ?>
