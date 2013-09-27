<?php if (is_category() && !is_category('boletin')) { ?>
  <h1 class="lead h4">
    <span><?php _e("Archivos de categoría", "pleromabootstrap"); ?>:</span> <?php single_cat_title(); ?>
  </h1>

<?php } elseif (is_tag()) { ?> 
  <h1 class="lead h4">
    <span><?php _e("Entradas etiquetadas", "pleromabootstrap"); ?>:</span> <?php single_tag_title(); ?>
  </h1>

<?php } elseif (is_author()) { ?>
  <h1 class="lead h4">
    <span><?php _e("Publicado por", "pleromabootstrap"); ?>:</span> <?php get_the_author_meta('display_name'); ?>
  </h1>

<?php } elseif (is_day()) { ?>
  <h1 class="lead h4">
    <span><?php _e("Archivo diario", "pleromabootstrap"); ?>:</span> <?php the_time('l, F j, Y'); ?>
  </h1>

<?php } elseif (is_month()) { ?>
  <h1 class="lead h4">
    <span><?php _e("Archivo mensual", "pleromabootstrap"); ?>:</span> <?php the_time('F Y'); ?>
  </h1>

<?php } elseif (is_year()) { ?>
  <h1 class="lead h4">
    <span><?php _e("Archivo anual", "pleromabootstrap"); ?>:</span> <?php the_time('Y'); ?>
  </h1> 
<?php } ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="media" id="post-<?php the_ID(); ?>" role="article">
      <p>
        <span class="label label-important">
          <?php print strtoupper(get_the_time('M')); ?>
          <?php the_time('j'); ?>
          <?php the_time('Y'); ?>
        </span>
      </p>

      <div class="hidden-phone pull-right">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail') ?></a>
      </div>

      <div class="media-body">
        <h4 class="media-heading">
          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php the_title(); ?>
          </a>
        </h4>
        <div class="media">
          <?php the_excerpt(); ?>
        </div>
      </div> <!-- /.media-body -->

    </div> <!-- /.media -->

    <hr>

  <?php endwhile; ?>  

<?php endif; ?>
