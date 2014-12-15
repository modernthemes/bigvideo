<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
	elseif ( (empty($image) ) && get_theme_mod( 'bigvideo_headerbg' )  ) : 
  	$image = get_theme_mod( 'bigvideo_headerbg' ); 
	else : 
   	$image = get_stylesheet_directory_uri() . '/images/default-bg.jpg';   
	endif; 
	?>   
	
	<header class="page-header" style="background-image: url('<?php echo $image; ?>'); background-size: cover; background-position: top center;"> 
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
    
	<div class="page-wrap">
		<div class="grid grid-pad">
			
            <div id="primary" class="content-area col-9-12">
				<main role="main">
			
            	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
                	<div class="entry-content">
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
				
                </main><!-- #main -->
			</div><!-- #primary -->
    
	<?php get_sidebar(); ?>
 
		</div><!-- grid -->  
	</div><!-- page-wrap -->  

<?php get_footer(); ?>
