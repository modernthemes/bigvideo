<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package bigvideo
 */

get_header(); ?>


<?php $image = get_stylesheet_directory_uri() . '/images/default-bg.jpg'; ?>

	<header class="page-header" style="background-image: url('<?php echo $image; ?>'); background-size: cover; background-position: top center;"> 
		<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'bigvideo' ); ?></h1>
	</header><!-- .entry-header -->

<div class="page-wrap">
<div class="grid grid-pad">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
					<h3><?php _e( 'There seems to have been an error.', 'bigvideo' ); ?></h3>

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'bigvideo' ); ?></p>

					<?php get_search_form(); ?>

					

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>