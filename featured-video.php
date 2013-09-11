<div id="post-<?php the_ID(); ?>" role="article" class="span3">
  <header class="article-header">
    <a href="#modalPost-<?php the_ID(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" role="button" data-toggle="modal">
      <?php the_post_thumbnail( 'small' ); ?>
    </a>
    <h4>
      <a href="#modalPost-<?php the_ID(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" role="button" data-toggle="modal">
        <?php the_title(); ?>
      </a>
    </h4>    
  </header> <!-- end article header -->
</div> <!-- end article -->

<div id="modalPost-<?php the_ID(); ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><?php the_title(); ?></h3>
  </div>
  <div class="modal-body">
    <p><?php the_content(); ?> </p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  </div>
</div>
