<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package outlet
 */
?>


    
    


	<?php $image = get_stylesheet_directory_uri() . '/images/default-bg.jpg'; ?> 

		<header class="page-header" style="background-image: url('<?php echo $image; ?>'); background-size: cover; background-position: top center;"> 
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
		
        	<div class="entry-meta">
				<?php outlet_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

	<div class="grid grid-pad">
		<div class="col-1-1">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    		<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			<footer class="entry-footer">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'outlet' ) );
				if ( $categories_list && outlet_categorized_blog() ) :
				?>
			
            	<span class="cat-links">
					<?php printf( __( 'Posted in %1$s', 'outlet' ), $categories_list ); ?>
				</span>
			
				<?php endif; // End if categories ?>

				<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'outlet' ) );
				if ( $tags_list ) :
				?>
			
            	<span class="tags-links">
					<?php printf( __( 'Tagged %1$s', 'outlet' ), $tags_list ); ?>
				</span>
			
				<?php endif; // End if $tags_list ?>
		
				<?php endif; // End if 'post' == get_post_type() ?>

				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'outlet' ), __( '1 Comment', 'outlet' ), __( '% Comments', 'outlet' ) ); ?></span>
				<?php endif; ?>

				<?php edit_post_link( __( 'Edit', 'outlet' ), '<span class="edit-link">', '</span>' ); ?>
	
    		</footer><!-- .entry-footer -->
			
            </article><!-- #post-## -->
		</div><!-- col-1-1 -->
	</div><!-- grid -->