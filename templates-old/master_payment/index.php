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

$nama_List = "Payment";
$main_query="";
$nama_table = "master_payment";
$primary_id = "payment_id";
$form_new_title = "Form Add Payment";
$form_edit_title = "Form Edit Payment";
$field_name = "name,notes";
$field_alias_name = "Name,Notes";
$field_required = "name";

$field_type_name = "#name|text|50^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";

$search_field = "name";
$record_show = "name|Name|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "notes|Notes|left|sort_on|link_on|sub_query_off~";

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

recordListNoPop($nama_List,$main_query,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required,$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query,$two_form,$additionalButton,$record_show_sum);
