<?php
/**
 Template Name: Home Page
 *
 * The Template for the Home Page
 *
 * @package bigvideo 
 */

get_header(); ?> 

		<div class="video-overlay">
		
			<?php if( get_theme_mod( 'active_overlay' ) == '') : ?> 
				<?php if ( is_active_sidebar('overlay-text') ) : ?>
            	 
            		<div class="home-text wow fadeInUp">
	 					<?php dynamic_sidebar('overlay-text'); ?>
            		</div><!-- .home-text --> 
            	
	 			<?php endif; ?>
        	<?php endif; ?>
			<?php // end if ?> 
        
        </div><!-- .video-overlay -->
       	  
        
        <?php if( get_theme_mod( 'active_intro' ) == '') : ?>
        
    		<span id="collections"></span>
     			<div class="home-info">
            		<div class="grid grid-pad wow fadeInLeft">
                    <?php if ( is_active_sidebar('intro-area') ) : ?>
                    	<div class="col-8-12">
    					<?php dynamic_sidebar('intro-area'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( get_theme_mod( 'bigvideo_intro_picture' ) ) : ?>
                    	<div class="col-4-12 widget-picture"> 
                    	<img src="<?php echo get_theme_mod( 'bigvideo_intro_picture' ); ?>" class="aligncenter"  width="225" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' >
                        </div> 
                    <?php endif; ?>
            		</div><!-- .grid-pad --> 
     			</div><!-- .home-info -->
	 	
        
        <?php endif; ?>
		<?php // end if ?>
        
        <?php if( get_theme_mod( 'active_collections' ) == '') : ?>
    
    	<?php if ( is_active_sidebar('home-middle-widgets') ) : ?>  
			 <div id="home-box-2">
				<?php dynamic_sidebar('home-middle-widgets'); ?> 
			</div><!-- .home-box-2 --> 
		<?php endif; ?>
        
        <?php endif; ?>
		<?php // end if ?>
        
       
        <div class="grid grid-pad">
         <?php if( get_theme_mod( 'active_button' ) == '') : ?>
        	
			<?php if ( get_theme_mod( 'bigvideo_ctalink_url' ) ) : ?> 
        		<div class="col-1-1 home-cta">
             		<a href="<?php echo get_page_link(get_theme_mod('bigvideo_ctalink_url'))?>">
        			<button class="view-more wow fadeInUp" data-wow-delay="0.15s">
        			<?php $bigvideo_ctalink = get_theme_mod( 'bigvideo_ctalink' ); 
						if (!empty($bigvideo_ctalink)) { 
						echo $bigvideo_ctalink; 
						}
					?>
        			</button>
        			</a>
        		</div><!-- .home-cta -->  
        	<?php else : ?> 
     		<?php endif; ?>
        
		<?php endif; ?>
		<?php // end if ?> 
        </div><!-- .grid grid-pad --> 
        
        <?php if( get_theme_mod( 'active_before_footer' ) == '') : ?>  
    
    		<div class="home-info">
            	<div class="grid grid-pad wow fadeInRight"> 
                	<?php if ( get_theme_mod( 'bigvideo_bf_picture' ) ) : ?> 
                    	<div class="col-4-12 bf-widget-picture"> 
                    		<img src="<?php echo get_theme_mod( 'bigvideo_bf_picture' ); ?>" class="aligncenter"  width="250" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' > 
                        </div>
                    <?php endif; ?>
					
					<?php if ( is_active_sidebar('home-before-footer') ) : ?>
                    	<div class="col-8-12 last-title">  
    						<?php dynamic_sidebar('home-before-footer'); ?> 
                       	</div> 
                    <?php endif; ?> 
                </div><!-- .grid-pad --> 
    		</div><!-- .home-info --> 
        
        <?php endif; ?>
		<?php // end if ?>
    

<?php get_footer(); ?>