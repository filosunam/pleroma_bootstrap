<?php
  
  // Sidebar Info 2
  if ( is_active_sidebar( 'sidebar-info-2' ) ) {
    echo '<div class="sidebar">';
      dynamic_sidebar( 'sidebar-info-2' );
    echo '</div>';
  }
