<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  
  <!-- article -->
  <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">

    <header>
      <h1 class="h3" itemprop="headline"><?php the_title(); ?></h1>
    </header> <!-- end article header -->

    <section class="post-content" itemprop="articleBody">
      <?php the_content(); ?>
      <?php

        // Do sociable
        if( function_exists( 'do_sociable' ) ){
          do_sociable();
        }
          
      ?>
    </section> <!-- end article section -->

    <footer class="article-footer" style="clear: both">
      <div class="well">
        <?php _e("Publicada", "pleromabootstrap"); ?>
        <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>  <?php the_time('F j, Y'); ?></time>
        <?php if ( get_the_category() ) : ?>
        <span class="amp">&</span> <?php _e("archivada en", "pleromabootstrap"); ?> <?php the_category(', '); ?>
        <?php endif; ?>
        <?php the_tags('<p class="tags">', ', ', '</p>'); ?>
      </div>
    </footer>
  </article><!-- /article -->

<?php endwhile; endif; ?>
