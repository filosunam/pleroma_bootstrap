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

              $sticky = get_option('sticky_posts');

              if ($sticky) {

                rsort($sticky);

                $args = array(
                  'post__in'            => array_slice($sticky, 0, 5),
                  'ignore_sticky_posts' => 1
                );

              } else {

                $args = array(
                  'posts_per_page'      => 4,
                  'ignore_sticky_posts' => 0
                );

              }

            }

            query_posts($args);

          ?>

        <?php if (have_posts()) : ?>
        <div class="row-fluid">
          <div class="span12">

          <?php while ( have_posts() ) : the_post(); ?>
          
            <?php
              if ('video' === get_post_format()) { 
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
              <p><?php the_excerpt(); ?></p>
            </div> <!-- end article -->

            <?php } ?>

            <hr class="visible-phone">

          <?php endwhile; ?>
          </div>
        </div>

        <hr class="hidden-phone">
        <?php endif; ?>
