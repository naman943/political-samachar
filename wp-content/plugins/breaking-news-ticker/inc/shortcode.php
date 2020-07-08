<?php 

/* breaking_news_ticker_shortcode()
*
* @since      2.0
* @package    breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/

function breaking_news_ticker_shortcode($atts, $news){

    $activate = bnt_get_option('activate_deactivate', 'bnt_basics', 'Yes');

    if($activate !== 'Yes') {
        return $news;
    }

    extract(shortcode_atts( array (
        'post_type'   => 'post',
        'id'              => 1,
        'title'           => 'Breaking News',
        'show_posts'      => 5,
        'bnt_cat'         => '',
        'orderby'         => 'date',
        'order'           => 'DESC',
        'bgcolor'         => '333333',
        'tbgcolor'        => '222222',
        'border_width'    => '0',
        'border_color'    => '222222',
        'date_color'      => 'b23737',
        'controls_btn_bg' => 'dd3333',
        'border_style'    => 'solid',
        'border_radius'   => '0',
        't_length'        => '35',
        'bnt_speed'       => 500,
        'bnt_direction'   => 'up',
        'bnt_interval'    => 3000,
        'bnt_height'      => 'auto',
        'bnt_buttons'     => 'on',
        'show_date'       => 'show'
    ), 

    $atts, 'newsticker' ) );

    $breaking_nt_query = new Wp_Query( array (
        'post_type'         => $post_type,
        'posts_per_page'    => $show_posts,
        'category__in'      => $bnt_cat,
        'orderby'           => $orderby,
        'order'             => $order,

    ));

    $news= '<div class="bnt-shortcode" style="background-color:#'.$bgcolor.'; border-width:'.$border_width.'px; border-color:#'.$border_color.'; border-style:'.$border_style.'; border-radius:'.$border_radius.'px;">';

    $news.='<div class="bnt-title" style="background-color: #'.$tbgcolor.';">'.$title.'';
    $news.='<span style=" border-color: transparent transparent transparent #'.$tbgcolor.';"></span>';
    $news.='</div>'; // end .bnt-title

    $news.='<div class="bnt-inner">';
    $news.='<div id="bnt-'.$id.'">';
    $news.='<ul>';

    while($breaking_nt_query->have_posts()) : $breaking_nt_query->the_post();
    $post_id = get_the_id();

    $length = $t_length;
    $short_title = get_the_title('', '', false);
    $short_title = substr($short_title, 0, $length);
    $news.= '<li><a href="'.get_permalink().'">' .$short_title.' ...</a>';

    if ($show_date == 'show') {
        $news.= '<span style="color:#'.$date_color.';" class="bnt-entry-meta">'.get_the_time('F j, Y').'</span>';
    }

    $news.= '</li>';
    endwhile;

    $news.='</ul>';  // end ul
    $news.='</div>'; // end #bnt
    $news.='</div>'; // end .bnt-inner
    
    if ($bnt_buttons == 'on') {
        $news.= '<div class="shotcode-controls">';
        $news.= '<span style="background-color: #'.$controls_btn_bg.';" id="prev-button-'.$id.'">prev</span>
                <span style="background-color: #'.$controls_btn_bg.';" id="next-button-'.$id.'">next</span>';
        $news.= '</div>'; // end Controls
    }

    $news.= '</div>'; // end .bnt-shortcode
    $sq = "'";
    $news.='<script>'; 
    $news.='jQuery(document).ready(function(){
            jQuery("#bnt-'.$id.'").easyTicker({
                direction: '.$sq.$bnt_direction.$sq.',
                speed: '.$bnt_speed.',
                interval:'.$bnt_interval.',
                height: '.$sq.$bnt_height.$sq.',
                visible: 1, 
                controls: {
                    down:"#next-button-'.$id.'",
                    up:"#prev-button-'.$id.'"
                }
            });
        });
    ';

    $news.='</script>'; 

//Reset Query Data
wp_reset_query();

return $news;

}

?>