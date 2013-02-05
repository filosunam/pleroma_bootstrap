<?php get_header(); ?>
        <div class="row-fluid">
          <div class="span9">

            <div id="main" role="main">
              <h1 class="lead h3 hide"><?php single_cat_title(); ?></h1>
              <?php if (!is_paged()) : ?>

                <div id="myCarousel" class="carousel slide carousel-fade">
                  <div class="carousel-inner">
                    <?php

                      if (get_option('pleroma_boletin_manual')) {
                        
                        $ids = array(
                          get_option('pleroma_boletin_featured_1'),
                          get_option('pleroma_boletin_featured_2'),
                          get_option('pleroma_boletin_featured_3'),
                          get_option('pleroma_boletin_featured_4'),
                          get_option('pleroma_boletin_featured_5'),
                        );

                      } else
                      {

                        query_posts( array( 'cat' => get_option('pleroma_boletin_slider'), 'posts_per_page' => 5 ) );

                        $ids = array();
                        while(have_posts()):
                          the_post();
                          $ids[] = get_the_ID();
                        endwhile;

                      }

                      $i = 0;
                      foreach($ids as $id)
                      {

                        $post = get_post($id);
                        if ($post->ID):

                          if (has_post_thumbnail())
                          {
                            $i++;
                            $active = ($i == 1) ? 'active ' : '';

                    ?>
                      <div class="<?php print $active ?>item">
                        <a href="<?php the_permalink(); ?>">
                          <?php the_post_thumbnail('large'); ?>
                        </a>
                        <div class="carousel-caption">
                          <p><?php the_title() ?></p>
                        </div>
                      </div>
                    <?php } // end has_post_thumbnail ?>
                    <?php endif; // end if $post->ID ?>
                    <?php } // end foreach ?>
                  </div>

                  <?php if ( $i > 1 ) : ?>
                  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                  <?php endif; ?>

                </div>
              <?php endif; ?>

            </div><!-- /#main -->
            
            <div class="row-fluid">
              <div class="span8">
                <?php wp_reset_query(); ?>
                <?php get_template_part( 'archive', 'single' ); ?>
              </div><!-- /.span8 -->
              
              <div class="span4">
                <?php get_sidebar(1); // sidebar 1 ?>
              </div><!-- /.span4 -->

            </div><!-- /#row-fluid -->
          </div><!-- /.span9 -->

          <div class="span3">
            <?php get_sidebar(2); // sidebar 2 ?>
          </div><!-- /.span3 -->

        </div><!-- /.row-fluid -->

<?php get_footer(); ?>