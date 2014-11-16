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
			wp_enqueue_script("force_comment_closer",plugin_dir_url( __FILE__ ) ."force_comment_closer.js",array(),"1.0",true);
			if(filter_input(INPUT_POST,"force_comment_closer") == "true") {
				GLOBAL $wpdb;
				$wpdb->query("UPDATE ".$wpdb->posts." SET comment_status = 'close'");
			}
		}
		
	}
}
