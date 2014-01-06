<?php
  
  $manual            = get_option( 'pleroma_home_manual' );
  $category_featured = get_option( 'pleroma_home_featured' );

  if ( $manual ) {

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

    $args = array(
      'post_type'       => array( 'post', 'page', 'event' ),
      'post__in'        => $ids,
      'orderby'         => 'post__in',
      'posts_per_page'  => -1
    );

  } else
  {

    $sticky = get_option( 'sticky_posts' );

    if ( $sticky ) {

      rsort( $sticky );

      $args = array(
        'post__in'            => array_slice( $sticky, 0, 5 ),
        'ignore_sticky_posts' => 1
      );

    } else {

      $args = array(
        'posts_per_page'      => 4,
        'ignore_sticky_posts' => 0
      );

    }

  }

  query_posts( $args );

?>

<?php if (have_posts() ) : ?>
<div id="featuredPosts" class="carousel carousel-stop slide">
  <div class="carousel-inner">
    <div class="row-fluid active item">
      <div class="span12">

      <?php $i = 0; while ( have_posts() ) : the_post(); $i++;  ?>

        <?php
          if ( 'video' === get_post_format() ) {
            get_template_part( 'featured', 'video' );
          } else {
        ?>

        <div id="post-<?php the_ID(); ?>" role="article" class="span3">
          <header class="article-header">
              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail( 'small' ); ?>
              </a>
            <h4>
              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
              </a>
            </h4>    
          </header> <!-- end article header -->
          <p>
            <?php
              if ( get_current_blog_id() != 1 ) {
                the_excerpt();
              }
            ?>
          </p>
        </div> <!-- end article -->

        <?php } ?>

        <hr class="visible-phone">

        <?php if ( $wp_query->post_count > 4 && $i % 4 === 0 ) { ?>
          </div>
        </div>
        <div class="row-fluid item">
          <div class="span12">
        <?php } ?>

      <?php endwhile; ?>
      </div>
    </div>
  </div>
  <?php if ( $wp_query->post_count > 4 ) { ?>
  <a class="carousel-control left" href="#featuredPosts" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#featuredPosts" data-slide="next">&rsaquo;</a>
  <?php } ?>
</div>
<?php endif; ?>