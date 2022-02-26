<?
require_once("../../config.php");
$nama_List = "Master Table User";
$nama_table = "ref_user";
$primary_id = "user_id";
$form_new_title = "New Form User";
$form_edit_title = "Edit Form User";
$field_name = "user_name,";
$field_name = $field_name . "pwd,";
$field_name = $field_name . "full_name,";
$field_name = $field_name . "group_id,";
$field_name = $field_name . "group_location_id,";
$field_name = $field_name . "functional_id,";
$field_name = $field_name . "phone,";
$field_name = $field_name . "email,";
$field_name = $field_name . "superior_id,";
$field_name = $field_name . "notes";

$field_alias_name = "User Name : ,";
$field_alias_name = $field_alias_name . "Password : ,";
$field_alias_name = $field_alias_name . "Full Name : ,";
$field_alias_name = $field_alias_name . "Group User : ,";
$field_alias_name = $field_alias_name . "Company / Site : ,";
$field_alias_name = $field_alias_name . "Functional : ,";
$field_alias_name = $field_alias_name . "Phone : ,";
$field_alias_name = $field_alias_name . "Email : ,";
$field_alias_name = $field_alias_name . "Superior : ,";
$field_alias_name = $field_alias_name . "Notes : ";

$field_type_name = "user_name|text|20^";
$field_type_name = $field_type_name . "#pwd|password|50^0";
$field_type_name = $field_type_name . "#full_name|text|50^0";
$field_type_name = $field_type_name . "#group_id|select|select group_id as id,group_name as name from ref_group where is_deleted=0^0";
$field_type_name = $field_type_name . "#group_location_id|select|select group_location_id as id,group_name as name from master_group_location where is_deleted=0 order by group_name asc^0";
$field_type_name = $field_type_name . "#functional_id|select|select functional_id as id,name as name from master_functional where is_deleted=0 order by name asc^0";
$field_type_name = $field_type_name . "#phone|text|50^0";
$field_type_name = $field_type_name . "#email|text|50^0";
$field_type_name = $field_type_name . "#superior_id|select|select user_id as id,full_name as name from ref_user where is_deleted=0 order by full_name asc^0";

$field_type_name = $field_type_name . "#notes|textarea|50^0";


$search_field = "user_name,full_name,group_id";
$record_show = "user_name|User Name|center|sort_on|link_on,full_name|Full Name|center|sort_on|link_on,group_id|Group|center|sort_on|link_off";

_recordList($nama_List,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show);
?>