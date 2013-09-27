<?php

/****************************
 ********** SLIDER **********
 *** someday be a plugin? ***
 ****************************/  


//[slider current_post="0" category="" number="5" size="pleroma-700x320" caption="1" title="1" description="0"]
function slider_func( $atts ){
  extract( shortcode_atts( array(
    'category'     => '',
    'number'       => 5,
    'size'         => 'large',
    'caption'      => true,
    'title'        => true,
    'description'  => false,
    'current_post' => false,
  ), $atts ) );


  if(true == (bool) $current_post)
  {

    $images = get_children( array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
    if( count($images) > 0 )
    {

?>
<div id="myCarousel" class="carousel slide carousel-fade">
  <div class="carousel-inner">
<?php

      $i = 0; foreach ($images as $attachment_id => $image) : $i++;
        $active = ($i == 1) ? 'active ' : '';

        $img_title       = $image->post_title;   // title.
        $img_description = $image->post_content; // description.
        $img_alt         = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
        $img_alt         = empty($img_alt) ? $img_title : $img_alt;

        
          $big_array = image_downsize( $image->ID, $size );
          $img_src   = $big_array[0];
          $img_url   = wp_get_attachment_url($image->ID);

?>
    <div class="<?php print $active ?>item">
      <a href="<?php print $img_url ?>"><img src="<?php print $img_src ?>" alt="<?php print $img_alt ?>"></a>
      <?php if ( true == (bool) $caption ) : ?>
      <div class="carousel-caption">
        <?php if ( true == (bool) $title ) : ?>
        <p><?php print $img_title ?></p>
        <?php endif; ?>
        <?php if (true == (bool) $description) : ?>
        <p><?php print $img_description ?></p>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>

<?php endforeach; ?>
  </div>
      <?php if ( count($images) > 1 ) : ?>
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    <?php endif; ?>
</div>
<?php
    }

  } else // not current
  {

    $query = new wp_query(array(
      'category_name' => $category,
      'posts_per_page' => $number,
    ));

    if ( $query->post_count > 0 ) {

?>
<div id="myCarousel" class="carousel slide carousel-fade">
  <div class="carousel-inner">
    <?php

      $i = 0; while ( $query->have_posts() ) : $i++;

        $active = ($i == 1) ? 'active ' : '';
        $query->the_post();

    ?>
    <div class="<?php print $active ?>item">
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($size); ?></a>
      <?php if ( true == (bool) $caption ) : ?>
      <div class="carousel-caption">
        <?php if ( true == (bool) $title ) : ?>
        <p><?php the_title() ?></p>
        <?php endif; ?>
        <?php if (true == (bool) $description) : ?>
        <p><?php the_excerpt() ?></p>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php endwhile; ?>
  </div>

  <?php if ( $query->post_count > 1 ) : ?>
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
  <?php endif; ?>

</div>
<?php
    } // if slides > 0
  }
}
add_shortcode( 'slider', 'slider_func' );

?>
