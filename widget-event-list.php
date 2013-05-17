<?php

global $eo_event_loop, $eo_event_loop_args;

//Date % Time format for events
$date_format  = 'M j';
$time_format  = 'g:i A';

//The list ID / classes
$id           = $eo_event_loop_args['id'];
$classes      = $eo_event_loop_args['class'];

?>

<?php if( $eo_event_loop->have_posts() ): ?>

  <ul id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($classes);?>" > 

    <?php while( $eo_event_loop->have_posts() ): $eo_event_loop->the_post(); ?>

      <?php 
        //Generate HTML classes for this event
        $eo_event_classes = eo_get_event_classes();

        //For non-all-day events, include time format
        $format = ( eo_is_all_day() ? $date_format : $date_format.' \<\b\r\> '.$time_format );

        $fields = get_post_custom();
        $lugar  = $fields['lugar'][0];
      ?>

      <li class="<?php echo esc_attr(implode(' ',$eo_event_classes)); ?> clearfix" >

        <div class="date muted">
          <b><?php echo eo_get_the_start('l'); ?></b>
          <?php echo eo_get_the_start($format); ?>
        </div>
        <div class="event">
          <h3 class="h5">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
              <?php the_title(); ?>
            </a>
          </h3>
          <small>
            <?php if ($lugar){ ?>
              <em><?php echo $lugar ?></em>.
            <?php } ?>
            <?php echo eo_get_venue_name(); ?>.</small>
        </div>
        <?php if($eo_event_loop->current_post < $eo_event_loop->post_count - 1) { ?>
          <hr>
        <?php } ?>

      </li>

    <?php endwhile; ?>

  </ul>

<?php elseif( ! empty($eo_event_loop_args['no_events']) ): ?>

  <ul id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($classes);?>" > 
    <li class="eo-no-events" > <?php echo $eo_event_loop_args['no_events']; ?> </li>
  </ul>

<?php endif; ?>