<?php 

global $serviceDb;

function create_db_table() {
   global $wpdb;
   global $serviceDb;
   $table_name = $wpdb->prefix . "service";
   if ($wpdb->get_var("show tables like service") != 'service')
   {   
   $sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  ftitle VARCHAR(55) NOT NULL,
  content TEXT NOT NULL,
  img VARCHAR(55) NOT NULL,
  UNIQUE KEY id (id)
    );";
 
   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
   }
   
}

create_db_table();

?>
