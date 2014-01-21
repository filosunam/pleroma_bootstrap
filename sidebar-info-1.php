<?php
  
  // Sidebar Info 1
  if ( is_active_sidebar( 'sidebar-info-1' ) ) {
    echo '<div class="sidebar">';
      dynamic_sidebar( 'sidebar-info-1' );
    echo '</div>';
  }
