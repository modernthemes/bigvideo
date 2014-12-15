<?php
/**
Template Name: Blog Archive
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package bigvideo
 */
 
get_header(); ?>


	<?php if ( have_posts() ) : ?>
	<?php if (has_post_thumbnail( $post->ID ) ): 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0]; 
	elseif ( (empty($image) ) && get_theme_mod( 'bigvideo_headerbg' )  ) : 
  	$image = get_theme_mod( 'bigvideo_headerbg' ); 
	else : 
   	$image = get_stylesheet_directory_uri() . '/images/default-bg.jpg';   ?> 
	<?php endif; ?>

			<header class="page-header" style="background-image: url('<?php echo $image; ?>'); background-size: cover; background-position: top center;">
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'bigvideo' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'bigvideo' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'bigvideo' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'bigvideo' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'bigvideo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bigvideo' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'bigvideo' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'bigvideo');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'bigvideo');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'bigvideo' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'bigvideo' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'bigvideo' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'bigvideo' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'bigvideo' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'bigvideo' );

						elseif ( is_post_type_archive( 'collection' ) ) :
							_e( 'My Collections', 'bigvideo' );

						else :
							_e( 'Archives', 'bigvideo' );

						endif;
					?>
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
