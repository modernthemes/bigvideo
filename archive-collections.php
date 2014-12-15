<?php
/**
Template Name: Collection Archive
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package bigvideo
 */
 
get_header(); ?>

	<?php 
	// set your page header with a featured image  
	if ( have_posts() ) : 
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
		<h1 class="page-title">
			<?php _e( 'My Collections', 'bigvideo' ); ?>
		</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
	</header><!-- .page-header --> 
            
	<div class="page-wrap">
		<div class="grid grid-pad">
			<div id="primary" class="content-area single-collection-wrap collection-reel">
				<main id="main" class="site-main" role="main">
				
				<?php /* Start the Loop */ ?>
				<?php 	$args = array( 'post_type' => 'collection', 'posts_per_page' => -1 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

				<?php endwhile; ?>

					<?php bigvideo_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- grid --> 
	</div><!-- page-wrap -->
     
<?php get_footer(); ?>
