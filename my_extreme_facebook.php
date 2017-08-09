<?php
/**
 * Plugin Name: My Extreme Facebook
 * Plugin URI: http://aaryanahmed.net/
 * Description: A widget that displays facebook page stream and likebox.
 * Version: 2.1.2
 * Author: Aaryan Ahmed AL-Amin
 * Author URI: http://aaryanahmed.net/
 */
 ?>
<?php 
add_action( 'widgets_init', 'register_my_extreme_facebook' );

function register_my_extreme_facebook() {
	register_widget( 'My_Extreme_Facebook_Widget' );
}

class My_Extreme_Facebook_Widget extends WP_Widget {
	
	function My_Extreme_Facebook_Widget() {
		$widget_ops = array( 'classname' => 'my_extreme_facebook', 'description' => __('A widget for facebook like box ', 'my_extreme_facebook') );
		$control_ops = array( 'width' => true, 'height' => true, 'id_base' => 'my_extreme_facebook-widget' );
		$this->WP_Widget( 'my_extreme_facebook-widget', __('My Extreme Facebook', 'my_extreme_facebook'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$page_id = $instance['page_id'];
		$color = $instance['color'];
		$height = $instance['height'];
		if(empty($page_id)) { $page_id = 'AaryansPlanet';  } else {	$page_id = explode('facebook.com/',$page_id); $page_id = $page_id[1]; }
		$width = $instance['width'];
		$show_faces = $instance['show_faces'];
		if($show_faces == 'on') { $show_faces = 'true';} else { $show_faces = 'false'; }
		$show_stream = $instance['show_stream'];
		if($show_stream == 'on') { $show_stream = 'true';} else { $show_stream = 'false'; }
		$show_header = $instance['show_header'];
		if($show_header == 'on') { $show_header = 'true';} else { $show_header = 'false'; }
		$show_border = $instance['show_border'];
		if($show_border == 'on') { $show_border = 'true';} else { $show_border = 'false'; }
		
		echo $before_widget;
		
		// Display the widget title
		if ( $title )
			echo $before_title . $title . $after_title;
		//Display the name

		$facebook_iframe_code = '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2F
								www.facebook.com%2F'.$page_id.'&amp;width='.$width.'&amp;height='.$height.'&amp;show_faces='.$show_faces.'&amp;
								colorscheme='.$color.'&amp;stream='.$show_stream.'&amp;show_border='.$show_border.'&amp;header='.$show_header.'" scrolling="no" frameborder="0" 
								style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';

		echo $facebook_iframe_code;
		
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_id'] = strip_tags( $new_instance['page_id'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['show_faces'] = strip_tags( $new_instance['show_faces'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['show_stream'] = strip_tags( $new_instance['show_stream'] );
		$instance['show_header'] = strip_tags( $new_instance['show_header'] );
		$instance['show_border'] = strip_tags( $new_instance['show_border'] );
	
		return $instance;
	}
	
	function form($instance) {
		//Set up some default widget settings.
		$defaults = array( 'title' => __('Facebook Feed', 'my_extreme_facebook'), 'page_id' => __('https://www.facebook.com/AaryansPlanet', 'my_extreme_facebook'),
							'width' => __('292', 'my_extreme_facebook'), 'show_faces' => __(true, 'my_extreme_facebook'),
							'color' => __('light', 'my_extreme_facebook'), 'show_stream' => __(true, 'my_extreme_facebook'),
							'show_header' => __(true, 'my_extreme_facebook'),'show_border' => __(true, 'my_extreme_facebook'),
							 'height' => __('590', 'my_extreme_facebook'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults );  ?>

	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'my_extreme_facebook'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	
	<p>
	<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e('Facebook page URL', 'my_extreme_facebook'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'page_id' ); ?>" name="<?php echo $this->get_field_name( 'page_id' ); ?>" value="<?php echo $instance['page_id']; ?>" />
	</p>
	
	<p>
	<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width', 'my_extreme_facebook'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" />
	</p>
	
	<p>
	<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height', 'my_extreme_facebook'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" />
	</p>
	
	<p>
	<label for="<?php echo $this->get_field_id( 'show_faces' ); ?>"><?php _e('Show Faces', 'my_extreme_facebook'); ?></label>
		<input class="widefat" class="checkbox" type="checkbox" <?php if( $instance['show_faces']) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show_faces' ); ?>" name="<?php echo $this->get_field_name( 'show_faces' ); ?>" />
	</p>
	
	<p>
	<label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e('Color', 'my_extreme_facebook'); ?></label>
		<select class="widefat" name="<?php echo $this->get_field_name( 'color' ); ?>">
		  <option  <?php if( $instance['color'] == 'light') echo 'selected'; ?> value="light">Light</option>
		  <option <?php if( $instance['color'] == 'dark') echo 'selected'; ?> value="dark">Dark</option>
		</select>
	</p>
	
	<p>
	<label for="<?php echo $this->get_field_id( 'show_stream' ); ?>"><?php _e('Show Stream', 'my_extreme_facebook'); ?></label>
		<input class="checkbox widefat" type="checkbox" <?php if( $instance['show_stream']) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show_stream' ); ?>" name="<?php echo $this->get_field_name( 'show_stream' ); ?>" />
	</p>
	
	<p>
	<label for="<?php echo $this->get_field_id( 'show_header' ); ?>"><?php _e('Show Header', 'my_extreme_facebook'); ?></label>
		<input class="checkbox widefat" type="checkbox" <?php if( $instance['show_header']) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show_header' ); ?>" name="<?php echo $this->get_field_name( 'show_header' ); ?>" />
	</p>
	
	<p>
	<label for="<?php echo $this->get_field_id( 'show_border' ); ?>"><?php _e('Show Border', 'my_extreme_facebook'); ?></label>
		<input class="checkbox widefat" type="checkbox" <?php if( $instance['show_border']) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show_border' ); ?>" name="<?php echo $this->get_field_name( 'show_border' ); ?>" />
	</p>
	<?php 	
	}

}
?>
