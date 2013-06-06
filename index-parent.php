<?php get_header(); ?>
        
        <div class="row-fluid">
          <div class="span9">
            
          <?php

            $category_slides = get_option('pleroma_home_slider');

            if( is_home() && $category_slides ) : 

              $query = new wp_query(array(
                'cat' => $category_slides,
                'posts_per_page' => 8        
              ));

              if ( $query->post_count > 0 ) :

          ?>
            <div id="myCarousel" class="carousel carousel-fade slide">
              <div class="carousel-inner">
                <?php

                  $i = 0; while ( $query->have_posts() ) : $i++;

                    $active = ($i == 1) ? 'active ' : '';
                    $query->the_post();

                ?>
                <div class="<?php print $active ?>item">
                  <?php 
                    if ( has_post_thumbnail() ) {
                      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                      echo '<img src="' . $large_image_url[0] . '" alt="' . the_title_attribute('echo=0') . '">';
                    }
                  ?>
                  <div class="carousel-caption">
                    <p><?php the_title() ?></p>
                  </div>
                </div>
                <?php endwhile; ?>
              </div>

              <?php if ( $query->post_count > 1 ) : ?>
              <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
              <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
              <?php endif; ?>
            
            </div>
            <?php endif; // end if slides > 0 ?>
          <?php endif; // end if home ?>

          </div>

          <div class="span3">
            
            <?php if ( has_nav_menu( 'secondary' ) ) : ?>
            <nav class="nav-info">
              <h4><?php
                $menus = get_nav_menu_locations();
                echo wp_get_nav_menu_object($menus['secondary'])->name;
              ?></h4>
              <?php pleroma_secondary_nav() ?>
            </nav>
            <?php endif; // has_nav_menu ?>
            
            <p style="background: #464C5D; color: white; list-style: none; padding: 10px 0; text-align: center;">648 graduados licenciatura (2012)</p>
            <p style="background: #464C5D; color: white; list-style: none; padding: 10px 0; text-align: center">594 graduados posgrado (2012)</p>
          </div>
        </div>  

        <?php get_template_part( 'index', 'featured' ); ?>

        <div class="row-fluid">
          <?php

            $args = array(
                'title'          => ''
              , 'numberposts'    => 3
              , 'showpastevents' => 0
              , 'no_events'      => __('No events found', 'eventorganiser')
            );

            if( eo_get_events( $args ) ) :
            
          ?>
          <div class="span4 home-events">
            <h2 class="h3 lead"><?php _e('Events', 'eventorganiser'); ?></h2>
            <?php the_widget('EO_Event_List_Widget', $args); ?>
            <a class="btn btn-small" href="/calendario-de-eventos">
              <i class="icon-th"></i>
              <?php _e('Events Calendar', 'eventorganiser'); ?>
            </a>
          </div>
          <hr class="hidden-desktop">
          <?php endif; ?>

          <?php
            $research_product = get_option('pleroma_research_product');

            query_posts(array(
                'p'         => $research_product
              , 'post_type' => array( 'post', 'page', 'event' )
            ));

            if (have_posts()) :
          ?>
          <div class="span8">

            <?php
               while ( have_posts() ) : the_post();

                $fields   = get_post_custom();
                $website  = $fields['website'][0];
                $url      = !$website ? get_permalink() : $website;
            ?>

            <div class="home-product row-fluid hidden-phone" id="post-<?php the_ID(); ?>" role="article">
              <header class="span8 article-header">
                <a href="<?php echo $url ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                  <?php the_post_thumbnail( 'large' ); ?>
                </a>
              </header>
              <footer class="span4 article-footer">
                <h2 class="lead">
                  <a href="<?php echo $url ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h2>
              </footer>
            </div>

            <hr class="hidden-phone">

            <?php endwhile; ?>

            <div class="row-fluid hidden-phone">
              <?php
                $ids = array(
                          get_option('pleroma_project_featured_1')
                        , get_option('pleroma_project_featured_2')
                        , get_option('pleroma_project_featured_3')
                      );

                $args = array(
                    'post_type' => 'page'
                  , 'post__in'  => $ids
                  , 'orderby'   => 'post__in'
                );
                
                query_posts($args);

                if (have_posts()) : while (have_posts()) : the_post();
              ?>
              <div id="post-<?php the_ID(); ?>" role="article" class="span4">
                <header class="article-header">
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail( 'small' ); ?>
                  </a>
                  <h4>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </h4>
                </header>
              </div>
              <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>

          <?php endif; ?>
        </div>

<?php get_footer(); ?>