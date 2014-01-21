<?php

  // Post per page depending on blog id
  $post_per_page  = is_main_site() ? 8 : 9;

  // Get if is manual
  $manual = get_option( 'pleroma_home_manual' );

  // If is manual
  if ( $manual ) {

    // Get ID's of posts
    $ids = array(
      get_option( 'pleroma_home_featured_1' ),
      get_option( 'pleroma_home_featured_2' ),
      get_option( 'pleroma_home_featured_3' ),
      get_option( 'pleroma_home_featured_4' ),
      get_option( 'pleroma_home_featured_5' ),
      get_option( 'pleroma_home_featured_6' ),
      get_option( 'pleroma_home_featured_7' ),
      get_option( 'pleroma_home_featured_8' )
    );

    // Set arguments
    $args = array(
      'post_type'       => array( 'post', 'page', 'event' ),
      'post__in'        => $ids,
      'orderby'         => 'post__in',
      'meta_key'        => '_thumbnail_id',
      'posts_per_page'  => $post_per_page
    );

  // If is not manual but sticky
  } else {

    // Get sticky posts
    $sticky = get_option( 'sticky_posts' );

    // If sticky posts 
    if ( $sticky ) {

      // Sort posts
      rsort ( $sticky );

      // Set arguments
      $args = array(
        'post__in'            => array_slice( $sticky, 0, $post_per_page ),
        'meta_key'            => '_thumbnail_id',
        'posts_per_page'      => $post_per_page,
        'ignore_sticky_posts' => 1
      );

    // If there are not sticky posts, then show posts sorted by date
    } else {

      // Set arguments
      $args = array(
        'meta_key'            => '_thumbnail_id',
        'posts_per_page'      => $post_per_page,
        'ignore_sticky_posts' => 1
      );

    }

  }

  // Set query posts
  query_posts( $args );

  // Reset row depending on the blog id
  $reset_row = is_main_site() ? 4 : 3;

?>

<?php if ( have_posts() ) : ?>

<!-- .carousel-posts -->
<div id="featuredPosts" class="carousel carousel-posts carousel-stop slide">

  <!-- .carousel-inner -->
  <div class="carousel-inner">
    <div class="item active">
      <?php

        // Loop the posts
        while ( have_posts() ) : the_post();

        // Reset 'row' if there are more than four entries
        if ( $wp_query->post_count > $reset_row && $wp_query->current_post == $reset_row ) {
          echo '</div><div class="item">';
        }

        // Get partial by post format
        get_template_part( 'partials/content-featured', get_post_format() );

        endwhile;

      ?>
    </div>
  </div><!-- /.carousel-inner -->

  <?php if ( $wp_query->post_count > $reset_row ) : ?>
  <!-- .carousel-controls -->
  <div class="carousel-controls hidden-xs hidden-sm">        
    
    <a class="left carousel-control" href="#featuredPosts" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>

    <a class="right carousel-control" href="#featuredPosts" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>

  </div><!-- /.carousel-controls -->
  <?php endif; ?>

</div><!-- /.carousel-posts -->

<?php endif; ?>
