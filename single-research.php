<?php
/**
 * The template for displaying a single research
 */

// Get template header
get_header(); ?>

<div class="row-fluid">

  <!-- Get sidebar -->
  <div class="span3">
    <!-- Categories -->
    <div class="widget">
      <h4 class="widget-title h4 lead">
        <?php _e('Líneas de investigación'); ?>
      </h4>
      <ul class="nav nav-tabs nav-stacked">
      <?php

        $cats = array();
        $current = get_the_terms( get_the_ID(), 'research_category' );
        foreach ($current as $key => $cat) {
          $cats[] = $cat->slug;
        }

        $taxonomy = 'research_category';
        $categories = get_terms( $taxonomy, '' );

        if ($categories) {
          foreach ( $categories as $category ) {
            echo '<li '. (array_search($category->slug, $cats) !== false ? 'class="active"' : '') . '>';
            echo '<a href="' . esc_attr(get_term_link( $category, $taxonomy )) . '">' . $category->name . '</a>';
            echo '</li>';
          }
        }

      ?>
      </ul>
    </div>
    <?php get_sidebar('page-1'); // sidebar page 1 ?>
  </div>
  
  <!-- Main -->
  <div id="main" class="span6" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="research-project" id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">
      <!-- Header -->
      <header>
        <?php
          if ( has_post_thumbnail() ) :
          $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
          $format_img      = '<img src="%s" alt="%s">';
        ?>
        <figure>
          <?php printf( $format_img, $large_image_url[0], the_title_attribute('echo=0') ); ?>
        </figure>
        <?php endif; ?>
        <h1 class="h3 lead" itemprop="headline"><?php echo the_title(); ?></h1>
        <p class="well well-small">
          <?php

            $categories = array();
            $categories_list = get_the_terms( get_the_ID(), 'research_category' );

            if (count($categories_list) > 0) {
              
              foreach ($categories_list as $key => $value) {
                $categories[] = '<a href="'. get_term_link( $value->slug, 'research_category' ) .'" class="label">'. $value->name .'</a>';
              }

              echo 'Líneas de investigación: ' . implode($categories, ' ');
            }

          ?>
        </p>
      </header>
      <!-- Content -->
      <section class="post-content" itemprop="articleBody">
        <?php the_content(); ?>
      </section>
    </article>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
  
  <!-- Get options-->
  <div class="span3">

    <?php 

      // Get the ID
      $post_id = get_the_ID();

      // Add default arguments
      $widget_args = array(
        'before_title' => '<h4 class="widget-title h4 lead">'
      );

    ?>

    <?php

      // RSS Link
      $rss = get_post_meta( $post_id, 'rp_rss_link', true );

      if ($rss) {

        // RSS widget options
        $rss_options = array(
          'title' => 'Productos recientes',  // Title of the Widget
          'url' => esc_url($rss), // URL of the RSS Feed
          'items' => 10, // Number of items to be displayed
          'show_summary' => 0, // Show post excerpts?
          'show_author' => 0, // Set 1 to display post author
          'show_date' => 0 // Set 1 to display post dates
        );

        // Add custom arguments to RSS widget
        $widget_args['after_title'] = 
            '</h4><div class="alert alert-info" style="text-align: center">Productos recientes del proyecto '
          . 'en el <a href="http://ru.ffyl.unam.mx" style="color: inherit;">Repositorio RUFFYL</a></div>';

        // Show the widget
        the_widget( 'WP_Widget_RSS', $rss_options, $widget_args );
        
      }

    ?>

  </div>

</div>

<!-- Get template footer -->
<?php get_footer(); ?>
