<?php

if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	exit();
	
//All options
$bnt_optNames = array('bnt_basics', 'bnt_styles', 'bnt_ticker', 'widget_bnt_widget');

foreach ($bnt_optNames as $bnt_opt) {
	delete_option($bnt_opt);
}
