<?php

function bnt_load_textdomain() {
	load_plugin_textdomain( 'breaking-news-ticker', false, BNT_PLUGIN_MAIN_PATH . '/languages/' );
}

/* breaking_nt_wp_latest_jQuery()
*
* @since      2.0
* @package    breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/
function breaking_nt_wp_latest_jQuery() {
	     wp_enqueue_script('jquery');
}

/* breaking_nt_js_css()
*
* @since      2.0
* @package    breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/
function  breaking_nt_js_css() {
	if (!is_admin()) {
    	wp_enqueue_script( 'breaking-nt-js', BNT_TICKER_JS , array('jquery'), 1.0, false);
    	wp_enqueue_script( 'breaking-easing-js', BNT_EASING_JS , array('jquery'), 1.0, false);
    	wp_enqueue_style( 'breaking-nt-style', BNT_TICKER_CSS);
    }
}

function  breaking_nt_style() { 
	if (!is_admin()) {
		require_once(BNT_INC_FOLDER . 'style-css.php');
	}
}

/* breaking_nt_admin_css()
*
* @since      2.0
* @package    breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/

function breaking_nt_admin_css() {
	if (is_admin()) {
      wp_enqueue_script( 'breaking-nt-accordion-js', BNT_ACCORDION_JS , array('jquery'), 1.0, false);
      wp_enqueue_style( 'breaking-nt-admin-style', BNT_ADMIN_CSS);
      wp_enqueue_style( 'breaking-nt-widget-style', BNT_ACCORDION_CSS);
    }
}

/* bnt_shortCode_btn
*
* @since      2.0
* @package    breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/
function bnt_shortcode_btn($context) {
    $img = 'Breaking News';
 
    // set the container ID to assign to the popup box; later we will create a 
    // function to create all the contents to show
    // in the popup; it will be loaded into the body using the footer hook, 
    // but will be invisible until the media button is pressed
    $container_id = 'bnt_popup_container';
 
    //title of the popup window
    $title = 'Breaking News Ticker';
 
    $context .= "<a class='button thickbox' title='{$title}'href='#TB_inline?width=800&inlineId={$container_id}'>{$img}</a>";
 
    return $context;
}

// this will add some content in the wordpress footer
add_action('admin_footer', 'popup_content');
 
function popup_content() { ?>

	<script>
		function insert_code() {
			var id = jQuery("#add_id").val();
			var bnt_cat = jQuery("#add_cat").val();
			var t_length = jQuery("#add_ptl").val();
			var post_type = jQuery("#add_post_type").val();
			var title = jQuery("#add_title").val();
			var show_posts = jQuery("#add_posts").val();
			var bgcolor = jQuery("#add_tbg").val();
			var tbgcolor = jQuery("#add_bg").val();

			var bnt_speed = jQuery("#add_speed").val();
			var bnt_direction = jQuery("#add_dire").val();
			var bnt_interval = jQuery("#add_dura").val();
			var bnt_buttons = jQuery("#add_btn").val();


			var border_width = jQuery("#add_bw").val();
			var border_color = jQuery("#add_bc").val();
			var border_style = jQuery("#add_bs").val();
			var border_radius = jQuery("#add_br").val();
			var date_color = jQuery("#add_dc").val();
			var controls_btn_bg = jQuery("#add_cbb").val();
			var show_date = jQuery("#add_shd").val();
	 
			window.send_to_editor('[breaking_news_ticker id="' + id + '" t_length="' + t_length + '" bnt_cat="' + bnt_cat + '" post_type="' + post_type + '" title="' + title + '"  show_posts="' + show_posts + '" tbgcolor="'+ tbgcolor +'" bgcolor="'+ bgcolor +'" bnt_speed="' + bnt_speed + '" bnt_direction="' + bnt_direction + '" bnt_interval="' + bnt_interval + '" border_width="' + border_width + '" border_color="' + border_color + '" border_style="' + border_style + '" border_radius="' + border_radius + '" show_date="' + show_date + '" date_color="' + date_color + '" controls_btn_bg="' + controls_btn_bg + '" bnt_buttons="' + bnt_buttons + '"]');
		}

	</script>

	<div id="bnt_popup_container" style="display:none;">
		<div class="popup-inner">
		<h2> Shortcode Generator</h2>
	      	<div class="popup-form">
		      	<div class="form-left">
		        	
		        	<div class="input">
			        	<label for="add_id">Shortcode Id</label>
			        	<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="add_id" value="1"><br/>
			        	<span>Use a unique Id. Ex: 1, 99, 999</span>
			        </div>

			        <div class="input">
			        	<label for="add_ptl">Post Title length</label>
			        	<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="add_ptl" value="35"><br/>
			        	<span>Ex: 35, 40</span>
			        </div>

			        <div class="input">
			        	<label for="add_cat">Post Category</label>
			        	<select id="add_cat" multiple>
  						<option value="" selected="selected">All Category</option>
							<?php $category_ids = get_all_category_ids();
								foreach($category_ids as $cat_id) {
  									$cat_name = get_cat_name($cat_id); ?>
  						
  						<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>

						<?php } ?>
			        	</select>
			        	<span>Ex: up, down</span>
			        </div>

			        <div class="input">
			        	<label for="add_post_type">Post Type</label>
			        	<select id="add_post_type">
							<?php 
								$args = array(
									   'public'   => true
									);

								$output = 'names'; // names or objects, note names is the default
								$operator = 'and'; // 'and' or 'or'

								$bnt_post_types = get_post_types( $args, $output, $operator );
								foreach ( $bnt_post_types as $bnt_post_type ) {
  							?>
  						
  						<option value="<?php echo $bnt_post_type; ?>"><?php echo $bnt_post_type; ?></option>

						<?php } ?>
			        	</select>
			        	<span>Ex: up, down</span>
			        </div>

			        <div class="input">
			        	<label for="add_posts">Display Posts</label>
			        	<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="add_posts" value="5"><br/>
			        	<span>Enter the maximum number of posts. Default: 5</span>
			        </div>
			        
			        <div class="input">
			        	<label for="add_shd">Date Show/Hide</label>
			        	<select id="add_shd" name="add_shd">
			        		<option value="show">Show</option>
			        		<option value="hide">Hide</option>
			        	</select>
			        	<span>Ex: show, hide</span>
			        </div>

		        </div>

		        <div class="form-center">
		        	<div class="input">
			        	<label for="add_title">Ticker Title</label>
			        	<input id="add_title" value="Breaking News"><br/>
			        	<span>Ex: Breaking News, Latest Posts</span>
			        </div>

		        	<div class="input">
			        	<label for="add_tbg">Title Background Color</label>
			        	<input id="add_tbg" value="333333"><br/>
			        	<span>Ex: FFFFFF, DDDDDD [more details: <a href="http://www.colorpicker.com/" target="_blank">click here</a>]</span>
			        </div>

			        <div class="input">
			        	<label for="add_bg">Ticker Background Color</label>
			        	<input id="add_bg" value="222222"><br/>
			        	<span>Ex: 222222, 333333 [more details: <a href="http://www.colorpicker.com/" target="_blank">click here</a>]</span>
			        </div>

		        	<div class="input">
			        	<label for="add_bw">Border Width</label>
			        	<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="add_bw" value="0"><br/>
			        	<span>Ex: 5, 10</span>
			        </div>
			        <div class="input">
			        	<label for="add_bc">Border Color</label>
			        	<input id="add_bc" value="222222"><br/>
			        	<span>Ex: 222222, 333333 [more details: <a href="http://www.colorpicker.com/" target="_blank">click here</a>]</span>
			        </div>

			        <div class="input">
			        	<label for="add_dc">Date Color</label>
			        	<input id="add_dc" value="b23737"><br/>
			        	<span>Ex: 222222, 333333 [more details: <a href="http://www.colorpicker.com/" target="_blank">click here</a>]</span>
			        </div>

			        <div class="input">
			        	<label for="add_cbb">Controls Button Background</label>
			        	<input id="add_cbb" value="dd3333"><br/>
			        	<span>Ex: 222222, 333333 [more details: <a href="http://www.colorpicker.com/" target="_blank">click here</a>]</span>
			        </div>

		        </div>

		        <div class="form-right">
		        	<div class="input">
			        	<label for="add_speed">Ticker Speed</label>
			        	<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="add_speed" value="500"><br/>
			        	<span>Ex: 400, 500, 600</span>
			        </div>

			        <div class="input">
			        	<label for="add_dire">Ticker Direction</label>
			        	<select id="add_dire" name="add_dire">
			        		<option value="up">Up</option>
			        		<option value="down">Down</option>
			        	</select>
			        	<span>Ex: up, down</span>
			        </div>

			        <div class="input">
			        	<label for="add_dura">Ticker Duration</label>
			        	<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="add_dura" value="3000"><br/>
			        	<span>Ex: 2000, 3000</span>
			        </div>

			        <div class="input">
			        	<label for="add_btn">Ticker Buttons</label>
			        	<select id="add_btn" name="add_btn">
			        		<option value="on">ON</option>
			        		<option value="off">OFF</option>
			        	</select>
			        	<span>Ex: on, off</span>
			        </div>

			         <div class="input">
			        	<label for="add_bs">Border Style</label>
			        	<select id="add_bs" name="add_bs">
			        		<option value='solid'>Solid</option>
			        		<option value="dotted">Dotted</option>
			        		<option value="dashed">Dashed</option>
			        		<option value="double">Double</option>
			        	</select>
			        	<span>Ex: solid, dotted</span>
			        </div>

			        <div class="input">
			        	<label for="add_br">Border Radius</label>
			        	<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="add_br" value="0"><br/>
			        	<span>Ex: 5, 10</span>
			        </div>

		        </div>

	        </div>

	        <div>
	        	<input type="button" class="button-primary input-btn" value="Generate ShortCode" onclick="insert_code();">
	            <a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;">Cancel</a>
	         </div>
         </div>

	</div> <!-- end pupup container -->

	<?php
}


/* 
* bnt_plugin_action_links()
*
* @since      2.0
* @package    Breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/

function bnt_plugin_action_links($links) {
    
    $links[]= '<a href="'. get_admin_url( null, 'admin.php?page=breaking-news-ticker' ) .'" title="' . esc_attr( 'Breaking News Ticker Settings', 'breaking-nt' ) . '">' . __( 'Settings', 'breaking-nt' ) . '</a>';
	
	return $links;
}

/* 
* bnt_get_option()
*
* @since      2.0
* @package    Breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/

function bnt_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}

function register_bnt_widget() {
    register_widget( 'bnt_widget' );
}

/* 
* function excerpt()
*
* @since      2.3
* @package    Breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/


function bnt_excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'[...]';
      } else {
        $excerpt = implode(" ",$excerpt);
      }	
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }
?>