<?php   
    /** 
    *Plugin Name: service
    *Plugin URI: http://www.vnt.net 
    *Description: Plugin for displaying service 
    *Author: C. Lupu 
    *Version: 1.0 
    *Author URI: http://www.vnt.net 
    */ 
   include_once (ABSPATH.'wp-includes/shortcodes.php');
   
 	function service() {
		include 'db.php';    //create table in database
  	}
	register_activation_hook( 'service.php', 'service' ); 
	
	//register_deactivation_hook( __FILE__, 'myplugin_deactivate' );
	
    function admin_service(){
		include 'admin_display.php';  
	}
	
	function add_service() {  
	   // $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position
	   
   		add_menu_page(".:: Service", "add service",1,"service","admin_service",'',80);  
	}
	add_action('admin_menu', 'add_service');
 
    function serviceDisplay(){
   			include 'public_display.php';
     } 
	 
 	add_shortcode('service', 'serviceDisplay');
 	
?>
