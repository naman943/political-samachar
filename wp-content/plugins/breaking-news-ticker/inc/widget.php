<?php 

class bnt_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
			'bnt_widget', // Base ID
			__( 'Breaking News', 'breaking-nt' ), // Name
			array( 'description' => __( 'A Breaking News Ticker Widget', 'breaking-nt' ), ) // Args
		);
	}

	public function widget($args, $instance) {


		$thumb_width  = ! empty( $instance['thumb_width'] ) ? absint( $instance['thumb_width'] ) : '600';
		$thumb_height  = ! empty( $instance['thumb_height'] ) ? absint( $instance['thumb_height'] ) : '350';

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		} ?> 

		<?php
			$arr = array(
				'posts_per_page'    => $instance['posts_per_page'],
				'post_type'         => 'post',
        		'category__in'      => $instance['t_category']					
        		);

			$bnt_query = new WP_Query($arr);

		?> 


			<div class="bnt_widget">
			<div id="my_<?php echo $this->id; ?>">
			<ul>
			<?php while($bnt_query->have_posts()) : $bnt_query->the_post(); ?>
				<li>
					<div class="bnt-widget-container">
						<?php
							$yes = $instance['no_thumb'];

							if ($yes !== 'No') { ?>

						<div class="bnt-thumbnail">
						
							<a href="<?php echo get_permalink(); ?>"> <?php

								if( has_post_thumbnail() ) {
									$thumb = get_post_thumbnail_id();
									$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
									$image = aq_resize( $img_url, $thumb_width, $thumb_height, true ); //resize & crop img
										echo '<img src="'.$image.'">';
								}
								else {
									echo '<img src="'.BNT_THUMB_IMG.'" height="'.$thumb_height.'" width="'.$thumb_width.'">';
								}

							 ?></a>

						</div>

						<?php } else {

							}
						?>

						<div class="bnt-content">
							<h3 class="bnt-post-title">
								<a href="<?php echo get_permalink(); ?>"><?php
									$length = $instance['title_length'];
									$short_title	= the_title('', '', false);
									$short_title	= substr($short_title, 0, $length);
									echo $short_title;
								?></a></h3>

								<span class="widget-entry-meta"><?php the_time('F j, Y'); ?></span>

							<p><?php
								$limit = $instance['content_length'];
								echo bnt_excerpt($limit); 
							?></p>

						</div>
					</div> <!-- widget container -->
				</li>
			<?php endwhile; ?>
			</ul>
		</div>

			<script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery("#my_<?php echo $this->id; ?>").easyTicker({
                        	direction: '<?php echo $instance['ticker_direction']; ?>',
                        	speed: <?php echo $instance['ticker_speed']; ?>,
							interval: <?php echo $instance['ticker_duration']; ?>,
							height: 'auto',
                        	visible: <?php echo $instance['max_posts']; ?>,
                        	mousePause: <?php 
    									$var = $instance['ticker_pauseOnHover'];
    										if ($var !== 'No') {
    											echo 1;
    										} else {
    											echo 0;
    										}
    									?>,
                        	controls: {
                                down: '#prev_<?php echo $this->id; ?>',
                                up: '#next_<?php echo $this->id; ?>'
                            }
                        });
                 });
            </script>

			<?php wp_reset_postdata(); ?>

			<div id="controls" class="widget-controls">
                <span id="prev_<?php echo $this->id; ?>">prev</span>
                <span id="next_<?php echo $this->id; ?>">next</span>
            </div>

		</div>

	<?php

		echo $args['after_widget'];

	}

	public function form($instance) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Breaking News', 'breaking-nt' );
		$posts_per_page = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : 10;
		$title_length = ! empty( $instance['title_length'] ) ? $instance['title_length'] : 35;
		$content_length = ! empty( $instance['content_length'] ) ? $instance['content_length'] : 10;
		$no_thumb = ! empty( $instance['no_thumb'] ) ? $instance['no_thumb'] : 'Yes';
		$thumb_width = ! empty( $instance['thumb_width'] ) ? $instance['thumb_width'] : 600;
		$thumb_height = ! empty( $instance['thumb_height'] ) ? $instance['thumb_height'] : 350;
		
		$ticker_direction = ! empty( $instance['ticker_direction'] ) ? $instance['ticker_direction'] : 'Up';
		$ticker_speed = ! empty( $instance['ticker_speed'] ) ? $instance['ticker_speed'] : 500;
		$ticker_duration = ! empty( $instance['ticker_duration'] ) ? $instance['ticker_duration'] : 3000;
		$max_posts = ! empty( $instance['max_posts'] ) ? $instance['max_posts'] : 2;
		$ticker_pauseOnHover = ! empty( $instance['ticker_pauseOnHover'] ) ? $instance['ticker_pauseOnHover'] : 'Yes';

		?>

<div class="widget-bnt">
	<div class="bnt-widget-title"><h2><?php _e( 'Widget Options', 'breaking-nt'  ); ?></h2></div>
		<div data-accordion-group>
			<div id="1" class="accordion" data-accordion>
	    		<div class="bnt-control" data-control><?php _e( 'Basic Options', 'breaking-nt'  ); ?></div>
				<div class="basic-options"  data-content>

					<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title :', 'breaking-nt'  ); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Post Limit :', 'breaking-nt'  ); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo esc_attr( $posts_per_page ); ?>">
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 'max_posts' ); ?>"><?php _e( 'Display Posts :', 'breaking-nt'  ); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'max_posts' ); ?>" value="<?php echo esc_attr( $max_posts ); ?>">
					</p>

				</div>
			</div>

			<div id="2" class="accordion" data-accordion>
	    		<div class="bnt-control" data-control><?php _e( 'Content Options', 'breaking-nt' ); ?></div>
				<div class="basic-options" data-content>

					<p>
					<label for="<?php echo $this->get_field_id( 'no_thumb' ); ?>"><?php _e( 'Show Post Thumbnail :', 'breaking-nt'); ?></label> 
					<select class="widefat" id="<?php echo $this->get_field_id( 'no_thumb' ); ?>" name="<?php echo $this->get_field_name( 'no_thumb' ); ?>">
						<option value="Yes" <?php selected( $instance['no_thumb'], 'Yes'); ?>>
							<?php _e( 'Yes', 'breaking-nt'); ?>
						</option>
						<option value="No" <?php selected( $instance['no_thumb'], 'No'); ?>>
							<?php _e( 'No', 'breaking-nt'); ?>
						</option>
					</select>
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 'thumb_width' ); ?>"><?php _e( 'Thumbnail Width :', 'breaking-nt'); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" value="<?php echo esc_attr( $thumb_width ); ?>">
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 'thumb_height' ); ?>"><?php _e( 'Thumbnail Height :', 'breaking-nt'); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" value="<?php echo esc_attr( $thumb_height ); ?>">
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 'title_length' ); ?>"><?php _e( 'Post Title Length :', 'breaking-nt'); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'title_length' ); ?>" value="<?php echo esc_attr( $title_length ); ?>">
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 'content_length' ); ?>"><?php _e( 'Content Lenght :', 'breaking-nt'); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'content_length' ); ?>" value="<?php echo esc_attr( $content_length ); ?>">
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 't_category' ); ?>"><?php _e( 'Post Category :', 'breaking-nt'); ?></label> 
					<select class="widefat" id="<?php echo $this->get_field_id( 't_category' ); ?>" 
							name="<?php echo $this->get_field_name( 't_category' ); ?>"  multiple>
							
						
					 <option <?php selected( $instance['t_category'], ""); ?> value=""><?php _e( 'All Categories', 'breaking-nt'); ?></option>
						<?php $args = array( 'hide_empty' => 0 );
									$terms = get_terms( 'category', $args );
									if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
										$count = count( $terms );
										$i = 0;
										$term_list = '';
									foreach ( $terms as $term ) {
										$i++; 
									$cat_id = $term->term_id; ?>
					 			<option <?php selected( $instance['t_category'], "$cat_id"); ?> value="<?php echo $cat_id; ?>"><?php echo $term->name; ?></option>
						

									<?php if ($count != $i ) {
										$term_list .= ' &middot; ';
										}
									 }
								echo $term_list;
								} ?>
			        	</select>

				</div>
			</div>

			<div id="4" class="accordion" data-accordion>
	    		<div class="bnt-control" data-control><?php _e( 'Ticker Options', 'breaking-nt' ); ?></div>
				<div class="basic-options" data-content>
					<p>
					<label for="<?php echo $this->get_field_id( 'ticker_speed' ); ?>"><?php _e( 'Ticker Speed :', 'breaking-nt' ); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'ticker_speed' ); ?>" value="<?php echo esc_attr( $ticker_speed ); ?>">
					</p>
					<p>
					<label for="<?php echo $this->get_field_id( 'ticker_duration' ); ?>"><?php _e( 'Ticker Duration :', 'breaking-nt' ); ?></label> 
					<input class="widefat" type="text" name="<?php echo $this->get_field_name( 'ticker_duration' ); ?>" value="<?php echo esc_attr( $ticker_duration ); ?>">
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 'ticker_direction' ); ?>"><?php _e( 'Ticker Direction:', 'breaking-nt'); ?></label> 
					<select class="widefat" id="<?php echo $this->get_field_id( 'ticker_direction' ); ?>" name="<?php echo $this->get_field_name( 'ticker_direction' ); ?>">
						<option value="up" <?php selected( $instance['ticker_direction'], 'up'); ?>>
							<?php _e( 'Up', 'breaking-nt'); ?>
						</option>
						<option value="down" <?php selected( $instance['ticker_direction'], "down"); ?>>
							<?php _e( 'Down', 'breaking-nt'); ?>
						</option>
					</select>
					</p>

					<p>
					<label for="<?php echo $this->get_field_id( 'ticker_pauseOnHover' ); ?>"><?php _e( 'Ticker Pause On Hover:', 'breaking-nt'); ?></label> 
					<select class="widefat" id="<?php echo $this->get_field_id( 'ticker_pauseOnHover' ); ?>" name="<?php echo $this->get_field_name( 'ticker_pauseOnHover' ); ?>">
						<option value="Yes" <?php selected( $instance['ticker_pauseOnHover'], 'Yes'); ?>>
							<?php _e( 'Yes', 'breaking-nt'); ?>
						</option>
						<option value="No" <?php selected( $instance['ticker_pauseOnHover'], 'No'); ?>>
							<?php _e( 'No', 'breaking-nt'); ?>
						</option>
					</select>
					</p>
					
				</div>
			</div>
		</div>
</div>
		<script>
         jQuery(document).ready(function(){
			jQuery('.accordion').accordion({
			    "transitionSpeed"	: 400,
			    "singleOpen"		: false
			});
		});
		</script>

		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance['title'] 				= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_per_page'] 	= ( ! empty( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '';
		$instance['post_height']		= ( ! empty( $new_instance['post_height'] ) ) ? $new_instance['post_height'] : '';
		$instance['max_posts']			= ( ! empty( $new_instance['max_posts'] ) ) ? $new_instance['max_posts'] : '';
		$instance['title_length']		= ( ! empty( $new_instance['title_length'] ) ) ? $new_instance['title_length'] : '';
		$instance['content_length']		= ( ! empty( $new_instance['content_length'] ) ) ? $new_instance['content_length'] : '';
		$instance['no_thumb']			= $new_instance['no_thumb'];
		$instance['thumb_width']		= $new_instance['thumb_width'];
		$instance['thumb_height']		= $new_instance['thumb_height'];
		$instance['t_category']   		= ( ! empty( $new_instance['t_category'] ) ) ? $new_instance['t_category'] : '';
		$instance['ticker_speed']   	= ( ! empty( $new_instance['ticker_speed'] ) ) ? $new_instance['ticker_speed'] : '';
		$instance['ticker_duration'] 	= ( ! empty( $new_instance['ticker_duration'] ) ) ? $new_instance['ticker_duration'] : '';
		$instance['ticker_direction'] 	= ( ! empty( $new_instance['ticker_direction'] ) ) ? $new_instance['ticker_direction'] : '';
		$instance['ticker_pauseOnHover'] = ( ! empty( $new_instance['ticker_pauseOnHover'] ) ) ? $new_instance['ticker_pauseOnHover'] : '';

		return $instance;
	}

} 


