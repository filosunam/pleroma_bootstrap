          <?php
            
            $manual            = get_option('pleroma_home_manual');
            $category_featured = get_option('pleroma_home_featured');

            if ( $manual ) {

              $ids = array(
                        get_option('pleroma_home_featured_1')
                      , get_option('pleroma_home_featured_2')
                      , get_option('pleroma_home_featured_3')
                      , get_option('pleroma_home_featured_4')
                    );

              $args = array(
                  'post_type' => array( 'post', 'page', 'event')
                , 'post__in'  => $ids
                , 'orderby'   => 'post__in'
              );

            } else
            {

              $args = array(
                  'cat'            => $category_featured
                , 'posts_per_page' => 4
              );

            }

            query_posts($args);

            if (have_posts()) : while ( have_posts() ) : the_post();
             
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
              <?php the_excerpt(); ?>
            </div> <!-- end article -->
            <hr class="hidden-desktop">

          <?php endwhile; ?>
          <?php endif; ?>