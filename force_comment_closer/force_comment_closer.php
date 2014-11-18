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
			add_action('admin_menu',array($this,'updateCommentStatus'));

		}
	}
	
	function set_enqueue() {
		wp_enqueue_script("force_comment_closer",plugin_dir_url( __FILE__ ) ."force_comment_closer.js",array(),"1.0",true);
	}
	
	function updateCommentStatus() {
		$input = filter_input(INPUT_POST,"force_comment_closer");
		if($input === self::PARAM_OPEN or $input === self::PARAM_CLOSE){
			check_admin_referer();
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
