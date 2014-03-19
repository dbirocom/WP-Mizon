<?php
	
	require_once(dirname(__FILE__) . '/../../../wp-config.php');
	                                     
	nocache_headers();
	
	if(!get_option('wpr_options')) {
		return false;
	}
	
	if(isset($_REQUEST['code']) && $_REQUEST['code'] == get_option('wpr_cron')) {
	
		require_once( dirname(__FILE__) . '/wprobot.php' );
		wpr_run_cron($_REQUEST['id']);		
	}