<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <article itemscope id="post-<?php the_ID(); ?>" role="article" itemtype="http://schema.org/BlogPosting">
    
    <?php if (!is_front_page()) { ?>
    <header class="article-header">

      <?php
        if ( has_post_thumbnail() ) :
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
        $format_img      = '<img src="%s" alt="%s">';
      ?>
      <figure>
        <?php printf( $format_img, $large_image_url[0], the_title_attribute('echo=0') ); ?>
      </figure>
      <?php endif; ?>
    
      <h1 class="h3 lead" itemprop="headline"><?php the_title(); ?></h1>
    
    </header> <!-- end article header -->
    <?php } ?>
    
    <section class="post-content" itemprop="articleBody">
    
      <?php the_content(); ?>
    
    </section> <!-- end article section -->

    <footer class="article-footer">

      <?php the_tags('<p class="tags"><span class="tags-title">Etiquetado con:</span> ', ', ', '</p>'); ?>
  
    </footer> <!-- end article footer -->
    
    <?php //comments_template(); ?>

  </article>

<?php endwhile; ?>

<?php endif; ?>
