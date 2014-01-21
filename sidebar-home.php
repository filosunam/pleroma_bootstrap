<?php
  
  // Sidebar Home
  if ( is_active_sidebar( 'sidebar-home' ) ) {
    echo '<div class="hidden-xs hidden-sm">';
      dynamic_sidebar( 'sidebar-home' );
    echo '</div>';
  }
