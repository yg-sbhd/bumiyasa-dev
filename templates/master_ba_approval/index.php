<?
function opt_insertqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
	
}
function opt_updateqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();
	
	
}
function opt_deleteqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();
}

$nama_List = "Bid Analysis Approval";
$main_query="";
$nama_table = "master_ba_approval";
$primary_id = "ba_approval_id";
$form_map = " / Master Data / Bid Analysis / Bid Analysis Approval";
$form_new_title = "Form Add Bid Analysis Approval";
$form_edit_title = "Form Edit Bid Analysis Approval";
$field_name = "group_id,user_id,approval_order,notes";
$field_alias_name = "Group,User,Approval Order,Notes";
$field_required = "group_id,user_id,approval_order";

$field_type_name = "group_id|select|select group_id as id, group_name as name from ref_group where is_deleted=0^0";
$field_type_name = $field_type_name . "#user_id|select|select user_id as id, full_name as name from ref_user where is_deleted=0^0";
$field_type_name = $field_type_name . "#approval_order|text|50^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";


$search_field = "name";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt ."group_id|group_id|select|select group_name as name, group_id as id from ref_group~";
$relational_txt = $relational_txt ."user_id|user_id|select|select full_name as name, user_id as id from ref_user~";


$record_show = "group_id_txt|Approval|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "user_id_txt|Approval Person|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show . "approval_order|Approval Order|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show . "update_date|Last Update|left|sort_on|link_on|datetime~";
$record_show = $record_show . "update_by_txt|Update By|left|sort_on|link_off|sub_query_off~";

$nama_table_child = "";
$primary_id_child = "";
$field_type_child = "";
$field_child_require = "";
$record_show_child = "";

//penjumlahan (SUM) utk recordlist
$record_show_sum = "";
$child_enable = "no";
$two_form = "no";
$additionalButton ="";

recordListNoPop($nama_List,$main_query,$nama_table,$primary_id,$form_map,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required,$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query,$two_form,$additionalButton,$record_show_sum,$relational_txt);