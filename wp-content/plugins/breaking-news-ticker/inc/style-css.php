<style type="text/css">

	.breaking-news-ticker {
		border-radius: <?php echo bnt_get_option('border_radius', 'bnt_styles', '0'); ?>px;
		border-style: <?php echo bnt_get_option('border_style', 'bnt_styles', 'solid'); ?>;
		border-width: <?php echo bnt_get_option('border_width', 'bnt_styles', '1'); ?>px;
    	border-color: <?php echo bnt_get_option('border_color', 'bnt_styles', '#222222'); ?>;
    	background-color: <?php echo bnt_get_option('ticker_bg_color', 'bnt_styles', '#222222'); ?>;
	}

	.breaking-news-ticker ul li a,
	.breaking-news-ticker ul li a:link {
		color: <?php echo bnt_get_option('headline_title_color', 'bnt_styles', '#FFFFFF'); ?>;
		font-size: <?php echo bnt_get_option('headline_font_size', 'bnt_styles', '16'); ?>px;
	}

	div.breaking-news-ticker .breaking-news-ticker-title {
		font-size: <?php echo bnt_get_option('title_font_size', 'bnt_styles', '16'); ?>px;
		color: <?php echo bnt_get_option('title_font_color', 'bnt_styles', '#FFFFFF'); ?>;
		background-color: <?php echo bnt_get_option('title_bg_color', 'bnt_styles', '#333333'); ?>;
	}

	div.breaking-news-ticker .breaking-news-ticker-title span {
    	border-color: transparent transparent transparent <?php echo bnt_get_option('title_bg_color', 'bnt_styles', '#333333'); ?>;
	}
	
	.breaking-news-ticker .controls {
   		top: <?php echo bnt_get_option('control-top', 'bnt_ticker', '5'); ?>px;
	}

	.breaking-news-ticker .entry-meta {
		color:<?php echo bnt_get_option('date_color', 'bnt_styles', '#FFFFFF'); ?>;
	}

	.breaking-news-ticker .controls span {
    	background-color: <?php echo bnt_get_option('control_button_bg', 'bnt_styles', '#dd3333'); ?>
	}

</style>