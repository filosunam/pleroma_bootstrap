<?php

  // Get custom fields
  $fields = get_post_custom();

  // Link
  $link = isset( $fields['website'] ) ? $fields['website'][0] : null;

  // If not exists replace it with permalink
  $link = isset( $link ) ? $link : get_permalink();

?>
<!-- .post-article -->
<div id="post-<?php the_ID(); ?>" role="article" class="post-article post-featured-product hidden-xs hidden-sm">
  <!-- .post-header -->
  <header class="post-header">
    <!-- .post-thumbnail -->
    <div class="post-thumbnail">    
      <a href="<?php echo $link; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?>
      </a>
    </div><!-- /.post-thumbnail -->
  </header><!-- /.post-header -->
  <!-- .post-footer -->
  <footer class="post-footer">
    <!-- .post-title -->
    <h3 class="h4 post-title">
      <a href="<?php echo $link ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
      </a>
    </h3><!-- /.post-title -->
  </footer><!-- /.post-footer -->
</div><!-- /.post-article -->

<hr class="hidden-xs hidden-sm">
