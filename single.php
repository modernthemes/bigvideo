<?php
/**
 * The Template for displaying all single posts.
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
				<main id="main" class="site-main" role="main">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content">
            
            	<div class="entry-meta">
					<?php bigvideo_posted_on(); ?>
				</div><!-- .entry-meta -->
				
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'bigvideo' ),
						'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">  
		
				<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'bigvideo' ) );

				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'bigvideo' ) );

				if ( ! bigvideo_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'bigvideo' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'bigvideo' );
				}

				} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'bigvideo' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'bigvideo' );
				}

				} // end check for categories on this blog

					printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink()
				);
				?> 

				<?php edit_post_link( __( 'Edit', 'bigvideo' ), '<span class="edit-link">', '</span>' ); ?>
				
                </footer><!-- .entry-footer -->
				</article><!-- #post-## --> 


			<?php bigvideo_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .grid -->
	</div><!-- .page-wrap -->

	<?php get_footer(); ?>