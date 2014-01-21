<?php

  // Columns
  //
  // Parent blog:
  // |------|------|------|------|    > large
  // |-----|-----|-----|-----|        > medium
  // |----|----|                      > small
  // |---|---|                        > x-small
  //
  // Child blog:
  // |------|------|------|           > larga
  // |-----|-----|-----|              > medium
  // |----|----|----|                 > small
  // |---|---|---|                    > x-small
  //
  $columns = is_main_site() ? 'col-xs-6 col-md-3' : 'col-xs-4';

?>
<!-- .post-article -->
<div id="post-<?php the_ID(); ?>" role="article" class="post-article <?php echo $columns ?>">
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
  <!-- .post-body -->
  <div class="post-body hidden-xs hidden-sm">  
    <?php

      // Displays excerpt only child blogs
      if ( ! is_main_site() )
        the_excerpt();

    ?>
  </div><!-- /.post-body -->
</div><!-- /.post-article -->
