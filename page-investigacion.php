<?php if ( get_current_blog_id() === 1 ) { // if parent blog ?>

<?php get_header(); ?>

<div class="row-fluid">
  <div class="span9 offset3">
    <h1 class="h3 lead" itemprop="headline"><?php the_title(); ?></h1>
  </div>
</div>

<div class="row-fluid">

  <div class="span3">
    <!-- Categories -->
    <div class="widget">
      <h4 class="widget-title h4 lead">
        <?php _e('Líneas de investigación'); ?>
      </h4>
      <ul class="nav nav-tabs nav-stacked">
      <?php

        $current = get_query_var('term');
        $taxonomy = 'research_category';
        $categories = get_terms( $taxonomy, '' );

        if ($categories) {
          foreach ( $categories as $category ) {
            echo '<li '. ($current === $category->slug ? 'class="active"' : '') . '>';
            echo '<a href="' . esc_attr(get_term_link( $category, $taxonomy )) . '">' . $category->name . '</a>';
            echo '</li>';
          }
        }

      ?>
      </ul>
    </div>
    <?php get_sidebar('page-1'); ?>
  </div>

  <div id="main" role="main" class="span9">

    <?php

      // Get ids
      $ids = array(
        get_option('pleroma_project_featured_1'),
        get_option('pleroma_project_featured_2'),
        get_option('pleroma_project_featured_3'),
        get_option('pleroma_project_featured_4'),
        get_option('pleroma_project_featured_5')
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
        <div class="research-project <?php print $active ?>item" id="post-<?php the_ID(); ?>" role="article">
          <header class="article-header">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
              <?php the_post_thumbnail( 'large' ); ?>
            </a>
          </header>
          <footer class="article-footer">
            <h2 class="lead">
              <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
              </a>
            </h2>
          </footer>
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
        <div class="row-fluid">
          <?php

            // Args to get research projects
            $args = array(
              'sort_order' => 'desc',
              'sort_column' => 'menu_order',
              'exclude_tree' => '',
              'number' => 6,
              'post_type' => 'research-project',
              'post_status' => 'publish'
            );

            // Get Research Projects
            $projects = get_posts( $args );

            // Research projects
            foreach ($projects as $index => $project) :

          ?>

          <?php if( $index % 2 == 0 ) : ?>
            </div>
            <div class="row-fluid">
          <?php endif; ?>
      
          <div class="span6">
            <p>
              <?php
                $permalink = get_permalink($project->ID);
                $thumbnail = get_the_post_thumbnail($project->ID, 'medium');
              ?>

              <a href="<?php echo $permalink; ?>">
                <?php echo $thumbnail; ?>
              </a>

              <a href="<?php echo $permalink; ?>" style="font-size: 0.9em; display:block; background: #555; color: white; padding: 10px">
                <?php echo $project->post_title; ?>
              </a>
            </p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="span4">
        <?php get_sidebar('page-2'); ?>
      </div>
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
