<?
require_once("../../config.php");
$nama_List = "Master Table Group User";
$nama_table = "ref_group";
$primary_id = "group_id";
$form_new_title = "New Form - Group User";
$form_edit_title = "Edit Form - group User";
$field_name = "group_name,notes";
$field_alias_name = "Group Name,Description";
$field_type_name = "group_name|text|50^0#notes|textarea|50^3";
$search_field = "group_name,notes";
$record_show = "group_name|Group Name|center|sort_on|link_on,notes|Description|center|sort_on|link_on";

_recordList($nama_List,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show);
?>