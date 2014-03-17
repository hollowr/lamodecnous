<?php get_header(); ?>
            
                    <div class="entry">
                     
						<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                        	<h1  style="text-align:center;"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                            <div class="separator"></div>
                        	<?php the_content(); ?>
                        <?php endwhile ?>	
			
                            <div id="posts_navigation">
								<?php posts_nav_link(' ', 'Previous page', 'Next page'); ?>
                           </div>
            
                        <?php else : ?>
                    
                            <h2 class="center">Not Found</h2>
                            <p class="center">Sorry, but you are looking for something that isn't here.</p>
                            <?php include (TEMPLATEPATH . '/searchform.php'); ?>	
                    
                        <?php endif; ?>
                        
                    </div>
                <?php //get_sidebar(); ?>
                 
                 <!-- a Clearing DIV to clear the DIV's because overflow:auto doesn't work here -->
                 <div style="clear:both"></div>
                  
            	

<?php get_footer(); ?>