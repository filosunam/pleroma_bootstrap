<?php
  
  // Sidebar 2
  if ( is_active_sidebar( 'sidebar-2' ) ) {
    echo '<div class="sidebar">';
      dynamic_sidebar( 'sidebar-2' );
    echo '</div>';
  }
