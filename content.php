<?php
/**
 * @package bigvideo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="blog-entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php bigvideo_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
    	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bigvideo' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bigvideo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?> 
	
    <footer class="entry-footer">
    
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'bigvideo' ), '<span class="edit-link">', '</span>' ); ?>
	
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
