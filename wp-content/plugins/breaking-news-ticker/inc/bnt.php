<?php 

/* 
* breaking_news_ticker()
*
* @since      2.1
* @package    Breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/

function breaking_news_ticker($bnt) {

	$activate = bnt_get_option('activate_deactivate', 'bnt_basics', 'Yes');

	if($activate !== 'Yes') {
		return $bnt;
	}

	$bnt_q = new Wp_Query( array (
        'post_type'         => bnt_get_option('bnt_post_type', 'bnt_basics', 'post'),
        'posts_per_page'    => bnt_get_option('posts_per_page', 'bnt_basics', '5'),
        'orderby'           => 'date',
        'order'             => bnt_get_option('posts_order', 'bnt_basics', 'DESC'),
        'category__in'      => bnt_get_option('bnt_cat', 'bnt_basics', ''),
    ));

    $bnt= '<div class="breaking-news-ticker">';

        $bnt.= '<div class="breaking-news-ticker-title">'.bnt_get_option('main_title', 'bnt_basics', 'Breaking News').' <span></span></div>';

        $bnt.='<div class="bnt-inner"><div id="main-bnt"><ul>';
        
    while($bnt_q->have_posts()) : $bnt_q->the_post();

        $post_id = get_the_id();
        $length = bnt_get_option('title_length', 'bnt_styles', 55);
        $short_title = the_title('', '', false);
        $short_title = substr($short_title, 0, $length);
        $bnt.= '<li>';
        $bnt.= '<a href="'.get_permalink().'"> '.$short_title.' ...';
        $bnt.= '</a>';
        $date = bnt_get_option('display_date', 'bnt_basics', 'Yes');
        if($date == 'Yes') {
            $bnt.= '<span class="entry-meta">';
            $bnt.= get_the_time('F j, Y');
            $bnt.= '</span>';
         }

        $bnt.= '</li>';
        endwhile;

    $bnt.= '</ul></div></div>'; //end box
    
    $controls = bnt_get_option('controls', 'bnt_ticker', 'Yes');

    if($controls == 'Yes') {
   
        $bnt.= '<div class="controls">
                <span id="prev-btn">prev</span>
                <span id="next-btn">next</span>
            </div>';

    }

    $bnt.= '</div>';

//Reset Query Data
wp_reset_query();

 echo $bnt;

}


/* init_ticker()
*
* @since      2.0
* @package    breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/
function init_ticker() {  ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#main-bnt").easyTicker({    
            direction: '<?php echo bnt_get_option('direction', 'bnt_ticker', 'up'); ?>',
            speed: <?php echo bnt_get_option('speed', 'bnt_ticker', 500); ?>,
            interval: <?php echo bnt_get_option('interval', 'bnt_ticker', 3000); ?>,
            height: 'auto',
            visible: 1,
            mousePause: <?php echo bnt_get_option('mouse_pause', 'bnt_ticker', 1); ?>,
            controls: {
                down: '#prev-btn',
                up: '#next-btn'
            }
         });
    });
</script>
    <?php
}