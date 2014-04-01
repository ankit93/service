<?php 
global $wpdb;
global $dataTable;
global $sIndexColumn;
global $aColumns;

$dataTable=$wpdb->prefix."service"; 
$sIndexColumn='id';
$aColumns = array('id','ftitle','content','img');

function  insertData($data){
		global $wpdb;
		global $dataTable;
		global $aColumns;
		$wpdb->query("INSERT INTO $dataTable(".implode(',', $aColumns).") VALUES (".implode(',', $data).")");
}
function updateData($updateData){
	    global $wpdb;
	    global $dataTable;
	    global $aColumns;
		global $sIndexColumn;
		$data='';
		for($i=1;$i<count($updateData);$i++){
		    $data.="`".$aColumns[$i]."`='".$updateData[$i]."',";
		}
		$data=substr($data,0,$data.length-1);
        $wpdb->query("UPDATE $dataTable SET $data WHERE `$sIndexColumn`='$updateData[0]'");	
}
function content(){
	    global $wpdb;
	    global $dataTable;
	    return  $wpdb->get_results("SELECT * FROM $dataTable");
  	}
function getDataById($dataById){
	   global $wpdb;
	   global $dataTable;
	   global $sIndexColumn;
	   return  $wpdb->get_results("SELECT * FROM $dataTable where $sIndexColumn=$dataById");
  	}
function nextContentId($currunt_id){
	   global $wpdb;
	   global $dataTable;
	   global $sIndexColumn;
	   $results=$wpdb->get_results("SELECT $sIndexColumn FROM $dataTable WHERE $sIndexColumn > $currunt_id limit 1");
	   return $results[0]->$sIndexColumn;
  	}
function prevContentId($currunt_id){
	   global $wpdb;
	   global $dataTable;
	   global $sIndexColumn;
	   $results=$wpdb->get_results("SELECT max($sIndexColumn) as id FROM $dataTable WHERE $sIndexColumn < $currunt_id");
	   return $results[0]->id;
  	}
function deleteData($dl){
	   global $wpdb;
	   global $dataTable;
	   global $sIndexColumn;
	   return  $wpdb->query("DELETE FROM $dataTable WHERE $sIndexColumn=$dl");
  	}
function totalData(){
	   global $wpdb;
	   global $dataTable;
	   global $sIndexColumn;
	   return  $wpdb->query("SELECT FOUND_ROWS() FROM $dataTable");     	
}