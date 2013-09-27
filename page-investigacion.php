<?php if ( get_current_blog_id() == 1 ) { // if parent home ?>

<?php get_header(); ?>

        <div class="row-fluid">
          <div class="span9 offset3">
            <h1 class="h3 lead" itemprop="headline"><?php the_title(); ?></h1>
          </div>
        </div>

        <div class="row-fluid">

          <div class="span3">
            <?php get_sidebar('page-1'); ?>
          </div>

          <div id="main" role="main" class="span9">

            <?php

              $ids = array(
                        get_option('pleroma_project_featured_1')
                      , get_option('pleroma_project_featured_2')
                      , get_option('pleroma_project_featured_3')
                      , get_option('pleroma_project_featured_4')
                      , get_option('pleroma_project_featured_5')
                    );
              
              $ids = array_filter($ids); // remove nulls

              if ( is_array($ids) ) :

            ?>

            <div id="myCarousel" class="carousel carousel-fade slide">
              <div class="carousel-inner">
                <?php 
                  $i = 0; foreach( $ids as $id ) :

                    $post = get_post( $id );

                    if ( has_post_thumbnail() ) { $i++;
                      $active = ($i == 1) ? 'active ' : '';
                ?>
                <div class="<?php print $active ?>item">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'large' ); ?>
                  </a>
                </div>
                <?php } ?>
                <?php endforeach; ?>
              </div>

              <?php if ( $i > 1 ) : ?>
              <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
              <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
              <?php endif; ?>
            </div>

            <?php endif; // end slider ?>

            <div class="row-fluid">
              <div class="span8">
                <?php
                  if (have_posts()) : 
                    while (have_posts()) : 
                      the_post();
                      the_content();
                    endwhile; 
                  endif;
                ?>
              </div><!-- /.span8 -->

              <div class="span4">
                <?php get_sidebar('page-2'); ?>
              </div><!-- /.span4 -->
            
            </div>
          </div><!-- /.span9 -->

        </div><!-- /.row-fluid -->

<?php get_footer(); ?>

<?php

  } else 
  { 
    get_template_part( 'page' );
  }

?>