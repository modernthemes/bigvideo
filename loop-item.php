<?php
// this is your loop for the featured collections widget  
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
	<a href="<?php the_permalink(); ?>">
		<figure class="item-thumb">
			<?php the_post_thumbnail(); ?> 
		</figure><!-- .item-thumb -->

		<div class="item-overlay">
			<div class="item-info">
				<p class="item-title">
					<?php
						
						if ( !empty($title) ) {
							echo $title;
						} else {
							the_title();
						}
					?>
				</p><!-- item-title -->
                
				<?php if ( get_post_type() == 'Collection' ) : ?>
					<?php
						global $post;
						$ids = get_post_meta($post->ID, true);
						$photos = count( explode(',', $ids) );
					?>
					 
				<?php endif; ?>
			</div><!-- .item-info -->
		</div><!-- .item-overlay -->
	</a>
</div><!-- post -->