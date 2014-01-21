<?php

  // Columns
  //
  // Parent blog:
  // |------|------|------|------|    > large
  // |-----|-----|-----|-----|        > medium
  // |----|----|                      > small
  // |---|---|                        > x-small
  //
  // Child blog:
  // |------|------|------|           > larga
  // |-----|-----|-----|              > medium
  // |----|----|----|                 > small
  // |---|---|---|                    > x-small
  //
  $columns = is_main_site() ? 'col-xs-6 col-md-3' : 'col-xs-4';

?>
<!-- .post-article -->
<div id="post-<?php the_ID(); ?>" role="article" class="post-article <?php echo $columns ?>">
  <!-- .post-header -->
  <header class="post-header">
    <!-- .post-thumbnail -->
    <div class="post-thumbnail">    
      <a href="#myModalPost<?php the_ID(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" role="button" data-toggle="modal">
        <?php the_post_thumbnail( 'small', array( 'class' => 'img-responsive img-thumbnail' ) ); ?>
      </a>
    </div><!-- /.post-thumbnail -->
    <!-- .post-title -->
    <h4 class="post-title">
      <a href="#myModalPost<?php the_ID(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" role="button" data-toggle="modal">
        <?php the_title(); ?>
      </a>
    </h4><!-- /.post-title -->
  </header><!-- /.post-header -->
</div><!-- /.post-article -->

<!-- .modal -->
<div class="modal" id="myModalPost<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelPost<?php the_ID(); ?>" aria-hidden="true">
  <!-- .modal-dialog -->
  <div class="modal-dialog">
    <!-- .modal-content -->
    <div class="modal-content">
      <!-- .modal-header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabelPost<?php the_ID(); ?>"><?php the_title(); ?></h4>
      </div><!-- /.modal-header -->
      <!-- .modal-body -->
      <div class="modal-body">
        <?php the_content(); ?>
      </div><!-- /.modal-body -->
      <!-- .modal-footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div><!-- /.modal-footer -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
