<?php get_header(); ?>

			
				<div class="container-fluid">
				
				    <div id="main" class="span6" role="main">
				
					    <?php if (is_category()) { ?>
						    <h1 class="lead h4">
							    <span><?php _e("Archivos de categoría:", "pleromabootstrap"); ?></span> <?php single_cat_title(); ?>
					    	</h1>
					    
					    <?php } elseif (is_tag()) { ?> 
						    <h1 class="lead h4">
							    <span><?php _e("Entradas etiquetadas:", "pleromabootstrap"); ?></span> <?php single_tag_title(); ?>
						    </h1>
					    
					    <?php } elseif (is_author()) { ?>
						    <h1 class="lead h4">
						    	<span><?php _e("Publicado por:", "pleromabootstrap"); ?></span> <?php get_the_author_meta('display_name'); ?>
						    </h1>
					    
					    <?php } elseif (is_day()) { ?>
						    <h1 class="lead h4">
	    						<span><?php _e("Archivo diario:", "pleromabootstrap"); ?></span> <?php the_time('l, F j, Y'); ?>
						    </h1>
		
		    			<?php } elseif (is_month()) { ?>
		    		    <h1 class="lead h4">
			    	    	<span><?php _e("Archivo mensual:", "pleromabootstrap"); ?></span> <?php the_time('F Y'); ?>
				        </h1>
					
					    <?php } elseif (is_year()) { ?>
				        <h1 class="lead h4">
				    	    <span><?php _e("Archivo anual:", "pleromabootstrap"); ?></span> <?php the_time('Y'); ?>
				        </h1>	
					    <?php } ?>

					    <?php get_template_part( 'archive', 'single' ); ?>

					    <?php page_navi(); ?>
			
    				</div> <!-- /.span6#main -->
    
    				<div class="span3">
	    				<?php get_sidebar(1); // sidebar 1 ?>
	    			</div> <!-- /.span3 -->

	    			<div class="span3">
	    				<?php get_sidebar(2); // sidebar 2 ?>
	    			</div> <!-- /.span3 -->
                
        </div> <!-- /.container-fluid -->

<?php get_footer(); ?>