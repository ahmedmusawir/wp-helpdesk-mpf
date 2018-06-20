<?php 

/**
* PLUGIN DEACTIVATION CLASS
*/
class MPFWPHekpdeskDeactivate
{
	function __construct()
	{
		# code...
	}

	public static function deactivate() {

		flush_rewrite_rules();

	   	global $wpdb;
     	
     	$table_name = $wpdb->prefix . 'helpdesk_table';
     	$sql = "DROP TABLE IF EXISTS $table_name";
     	$wpdb->query($sql);			

	}

}
