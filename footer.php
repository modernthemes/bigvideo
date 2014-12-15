<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package bigvideo
 */
?>

	</section><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    	<div class="grid grid-pad"> 
        
        	<div class="footer-content col-1-1">
        		<p style="margin-bottom: .5em;"><a href="#go-to-top"><i class="fa fa-angle-up"></i></a></p><!-- up arrow --> 
        		<div><?php echo bigvideo_media_icons(); ?></div> <!-- .social media icons --> 
        	</div><!-- .footer-content --> 
        
			<div class="site-info col-1-1">
        
        		<?php if ( get_theme_mod( 'bigvideo_footerid' ) ) : ?>
        			<?php echo get_theme_mod( 'bigvideo_footerid' ); ?>  
				<?php else : ?>  
    				<?php	printf( __( 'Theme: %1$s by %2$s', 'bigvideo' ), 'bigvideo', '<a href="http://modernthemes.net/" rel="designer">modernthemes.net</a>' ); ?> 
				<?php endif; ?> 
        
			</div><!-- .site-info -->
        
        </div><!-- grid -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
