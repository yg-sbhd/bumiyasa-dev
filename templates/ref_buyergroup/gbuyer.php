<?
require_once("../../config.php");
$nama_List = "Master Table Group Buyer";
$nama_table = "ref_groupproject";
$primary_id = "groupproject_id";
$form_new_title = "New Form Group Buyer";
$form_edit_title = "Edit Form Group Buyer";
$field_name = "group_code,group_name,description";
$field_alias_name = "Group Code, Group Buyer Name,Description";
$field_type_name = "group_code|text|50^0#group_name|text|50^0#description|textarea|50^3";
$search_field = "group_code,group_name,description";
$record_show = "group_code|Group Code|center|sort_on|link_on,group_name|Group Name|center|sort_on|link_on,description|Description|center|sort_on|link_on";

_recordList($nama_List,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show);
?>
					 
					