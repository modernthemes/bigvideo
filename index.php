<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package bigvideo
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>
	<?php if (has_post_thumbnail( $post->ID ) ): ?>	
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0]; ?>
	<?php else :
	$image = get_stylesheet_directory_uri() . '/images/default-bg.jpg'; ?>
	<?php endif; ?>
	
    <header class="page-header" style="background-image: url('<?php echo $image; ?>'); background-size: cover; background-position: top center;"> 
		<h1 class="entry-title">From the blog...</h1>
	</header><!-- .entry-header -->

	<div class="page-wrap">
		<div class="grid grid-pad">
			<div id="primary" class="content-area single-collection-wrap blog-reel">
				<main id="main" class="site-main" role="main">

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

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
