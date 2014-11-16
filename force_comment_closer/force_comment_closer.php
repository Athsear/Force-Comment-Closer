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
	function __construct() {
		GLOBAL $pagenow;
		if (is_admin() and $pagenow == "edit.php") {
			add_action("admin_enqueue_scripts",array($this,"set_enqueue"));
			$input = filter_input(INPUT_POST,"force_comment_closer");
			if($input == "open" or $input == "close") {
				GLOBAL $wpdb;
				$sql = "UPDATE ".$wpdb->posts." SET comment_status = %s";
				if(filter_input(INPUT_POST,"force_comment_closer") == "close") {
					$wpdb->query($wpdb->prepare($sql,"close"));
				} else if(filter_input(INPUT_POST,"force_comment_closer") == "open"){
					$wpdb->query($wpdb->prepare($sql,"open"));
				}
			}
		}
	}
	
	function set_enqueue() {
		wp_enqueue_script("force_comment_closer",plugin_dir_url( __FILE__ ) ."force_comment_closer.js",array(),"1.0",true);
	}
}
