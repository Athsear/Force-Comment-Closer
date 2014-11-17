<?php

/*
  Plugin Name: Force Comment Closer
  Plugin URI: https://twitter.com/athsear
  Description: No description
  Author: Athsear'J.S.
  Version: 0.0.1
  Author URI: https://twitter.com/athsear
 */

$rotater = new force_comment_closer();

class force_comment_closer {
	const TARGET_PAGE = "edit.php";
	const PARAM_OPEN = "open";
	const PARAM_CLOSE = "close";
	
	function __construct() {
		GLOBAL $pagenow;
		if (is_admin() and $pagenow == self::TARGET_PAGE) {
			add_action("admin_enqueue_scripts",array($this,"set_enqueue"));
			$input = filter_input(INPUT_POST,"force_comment_closer");
			$checkUrl = admin_url() . self::TARGET_PAGE;
			
			if(strpos(filter_input(INPUT_SERVER,"HTTP_REFERER"),$checkUrl) === 0
				and ($input === self::PARAM_OPEN or $input === self::PARAM_CLOSE)){

				GLOBAL $wpdb;
				$sql = "UPDATE ".$wpdb->posts." SET comment_status = %s";
				if(filter_input(INPUT_POST,"force_comment_closer") === self::PARAM_CLOSE) {
					$wpdb->query($wpdb->prepare($sql,self::PARAM_CLOSE));
				} else if(filter_input(INPUT_POST,"force_comment_closer") === self::PARAM_OPEN){
					$wpdb->query($wpdb->prepare($sql,self::PARAM_OPEN));
				}
			}
		}
	}
	
	function set_enqueue() {
		wp_enqueue_script("force_comment_closer",plugin_dir_url( __FILE__ ) ."force_comment_closer.js",array(),"1.0",true);
	}
}
