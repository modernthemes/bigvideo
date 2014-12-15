<?php
/* This is the featured collections widget
 *  
 * This is the widget that pulls the featured collections custom post type to the home page of the theme
 *
 * @package bigvideo 
 */
 
// Add Collection image support
if ( function_exists( 'add_theme_support' ) ) {  
	add_theme_support( 'post-thumbnails' );
}

add_action( 'widgets_init', 'register_Collection_widget' );
function register_Collection_widget() {
	register_widget( 'Collection_Widget' );
}
class Collection_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'Collection-widget', 'description' => __( 'Choose and display a featured collection post on your homepage' ) );
		$control_ops = array(  );
		parent::WP_Widget( 'Collection_Widget', __( 'Featured Collections' ), $widget_ops, $control_ops ); 
	}  

	function form( $instance ) {
		$Collection_id = ''; // initialize the variable
		if (isset($instance['Collection'])) {
			$Collection = esc_attr($instance['Collection']); 
		};
		$show_Collection_post_title  = isset( $instance['show_Collection_post_title'] ) ? $instance['show_Collection_post_title'] : true;
		$show_Collection_image  = isset( $instance['show_Collection_image'] ) ? $instance['show_Collection_image'] : true;
		$apply_content_filters  = isset( $instance['apply_content_filters'] ) ? $instance['apply_content_filters'] : true;
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'Collection' ); ?>"> <?php echo __( 'Featured collection post to display:', 'Collection_Widget' ) ?>
				<select class="widefat" id="<?php echo $this->get_field_id( 'Collection' ); ?>" name="<?php echo $this->get_field_name( 'Collection' ); ?>">
				<?php query_posts('post_type=collection&post_status=publish&numberposts=-1'); 
				if ( have_posts() ) : while ( have_posts() ) : the_post();  
					$currentID = get_the_ID();
					if( $currentID == $Collection )
						$extra = 'selected' and
						$widgetExtraTitle = get_the_title();
					else
						$extra = '';
						echo '<option value="'.$currentID.'" '.$extra.'>'.get_the_title().'</option>';
					endwhile; else:
					echo '<option value="empty">' . __( 'No content blocks available', 'Collection_Widget' ) . '</option>';
				endif; ?>
				</select> 
			</label>
		</p>
		
		 

		<p>
			<?php
				echo '<a href="post.php?post=' . $Collection . '&action=edit">' . __( 'Edit Content', 'Collection_Widget' ) . '</a>' ;
			?>
		</p>

				<?php wp_reset_query(); ?>

		 <?php  
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['Collection'] = strip_tags( $new_instance['Collection'] );
		$instance['show_Collection_post_title'] = $new_instance['show_Collection_post_title'];
		$instance['show_Collection_image'] = $new_instance['show_Collection_image'];
		
		return $instance;
	}

	function widget($args, $instance) { 
		extract($args);
		$Collection  = ( $instance['Collection'] != '' ) ? esc_attr($instance['Collection']) : __('Find', 'Collection_Widget');
		// Add support for WPML Plugin.
		if ( function_exists( 'icl_object_id' ) ){ 
			$Collection = icl_object_id( $Collection, 'content_block', true );
		}
		// Variables from the widget settings.
		$show_Collection_post_title = isset( $instance['show_Collection_post_title'] ) ? $instance['show_Collection_post_title'] : false;
		$show_Collection_image  = isset($instance['show_Collection_image']) ? $instance['show_Collection_image'] : false;
		
		
		// Output the query to find the Collection post
		query_posts( 'post_type=collection&p=' . $Collection );
		while (have_posts()) : the_post();
			echo $before_widget;
			get_template_part('loop', 'item', array('title' => $title));
			echo $after_widget; 
		endwhile;
		wp_reset_query();  
	}  

}

?>