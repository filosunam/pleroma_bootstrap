<!-- .post-article -->
<div id="post-<?php the_ID(); ?>" role="article" class="post-article post-featured-research col-md-4">
  <!-- .post-header -->
  <header class="post-header">
    <!-- .post-thumbnail -->
    <div class="post-thumbnail">    
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_post_thumbnail( 'small', array( 'class' => 'img-responsive img-thumbnail' ) ); ?>
      </a>
    </div><!-- /.post-thumbnail -->
    <!-- .post-title -->
    <h4 class="post-title">
      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
      </a>
    </h4><!-- /.post-title -->
  </header><!-- /.post-header -->
</div><!-- /.post-article -->
