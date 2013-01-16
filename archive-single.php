					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <div class="media" id="post-<?php the_ID(); ?>" role="article">
								<p>
									<span class="label label-important">
										<?php print strtoupper(get_the_time('M')); ?>
										<?php the_time('j'); ?>
										<?php the_time('Y'); ?>
									</span>
								</p>

								<div class="pull-right">
									<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail') ?></a>
								</div>
					
						    <div class="media-body">
									<h4 class="media-heading">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
											<?php the_title(); ?>
										</a>
									</h4>
							    <div class="media">
							    	<?php the_excerpt(); ?>
							  	</div>
						    </div> <!-- /.media-body -->
					
					    </div> <!-- /.media -->
							<hr>
					    <?php endwhile; ?>	

					    <?php endif; ?>