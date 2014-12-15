<?php
/**
 * This is the template for displaying Collection posts
 *
 * @package bigvideo
 */

get_header(); ?>

	<?php 
	// set your page header with a featured image  
	while ( have_posts() ) : the_post(); 
 	if (has_post_thumbnail( $post->ID ) ): 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0]; 
	else :
	$image = get_stylesheet_directory_uri() . '/images/default-bg.jpg'; 
	endif; 
	?>  
	
	<header class="page-header" style="background-image: url('<?php echo $image; ?>'); background-size: cover; background-position: top center;"> 
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
    
	<div class="page-wrap">
		<div class="grid grid-pad">
			<div id="primary" class="content-area single-collection-wrap">
				<main role="main">
				
                	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
            		<div class="entry-content"> 
            		<ul class="bxslider">
			
					<?php  

 					$args = array(
   					'post_type' => 'attachment',
   					'numberposts' => -1,
   					'post_status' => null,
   					'post_parent' => $post->ID
  					);

  					$attachments = get_posts( $args );
     				if ( $attachments ) {
        			foreach ( $attachments as $attachment ) {
           			echo '<li>';
           			echo wp_get_attachment_image( $attachment->ID, 'full' );
           			echo '</li>';
          			}
     				}
 					?>
					</ul><!-- bxslider -->  
            
					<?php the_content(); ?>
						<?php
							wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'bigvideo' ),
							'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
				
					<?php edit_post_link( __( 'Edit', 'bigvideo' ), '<footer class="col-8-12 entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
					</article><!-- #post-## -->
            
					<?php endwhile; // end of the loop. ?>
            		<?php bigvideo_post_nav(); ?> 
            
				</main><!-- #main -->
			</div><!-- #primary --> 
		</div><!-- grid -->
	</div><!-- page-wrap --> 

<?php get_footer(); ?>