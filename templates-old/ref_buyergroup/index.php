<?
require_once("../../config.php");
$nama_List = "Master Table Group Project";
$nama_table = "ref_buyergroup";
$primary_id = "gbuyer_id";
$form_new_title = "New Form Group Project";
$form_edit_title = "Edit Form Group Project";
$field_name = "gbuyer_name,notes,area_id";
$field_alias_name = "Group Project Name,Description,Working Area";
$field_type_name = "gbuyer_name|text|50^0#notes|textarea|50^3#area_id|select|select area_id as id,area_name as name from ref_workingarea^0";
$search_field = "gbuyer_name,notes";
$record_show = "gbuyer_name|Group Project Name|center|sort_on|link_on,notes|Description|center|sort_on|link_on,area_id|Working Area|center|sort_off|link_off";

_recordList($nama_List,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show);
?>
					 
					