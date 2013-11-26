<?php
/**
 * The template for displaying a research projects by archive
 */

// Get template header
get_header(); ?>

<?php

  // Default excerpt
  add_filter('excerpt_more', function ($excerpt) {
    return ' [...]';
  });

?>

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

    <?php get_sidebar('page-1'); // sidebar page 1 ?>
  </div>
  
  <!-- Main -->
  <div id="main" class="span9" role="main">
    <h1 class="h3 lead">Línea de investigación: <?php single_cat_title(); ?></h1>
    <?php if (have_posts()) : $i = 0; ?> 
    <div class="row-fluid">
      <?php while (have_posts()) : the_post(); $i++; ?>

        <?php if ($i % 3 === 1) { ?>
          </div><div class="row-fluid">
        <?php } ?>

        <div class="span4">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <p>
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail( 'small' ); ?>
              </a>
            </p>
            <header class="entry-header">
              <p class="entry-title">
                <a href="<?php echo get_permalink(); ?>">
                  <strong><?php the_title(); ?></strong></a>
              </p>
            </header>
            <div class="entry-content">
              <?php the_excerpt(); ?>
            </div>

            <footer class="entry-meta well well-small">
              <?php

                $categories = array();
                $categories_list = get_the_terms( get_the_ID(), 'research_category' );

                if (count($categories_list) > 0) {
                  
                  foreach ($categories_list as $key => $value) {
                    $categories[] = '<a href="'. get_term_link( $value->slug, 'research_category' ) .'">'. $value->name .'</a>';
                  }

                  if (count($categories_list) > 1) {
                    echo 'Categorías: ';
                  } else {
                    echo 'Categoría: ';
                  }

                  echo implode($categories, ', ');
                }

              ?>
            </footer>
          </article>

        </div>

      <?php endwhile; ?>
    </div>

    <?php page_navi(); ?>
    <?php endif; ?>
  </div>

</div>

<!-- Get template footer -->
<?php get_footer(); ?>
