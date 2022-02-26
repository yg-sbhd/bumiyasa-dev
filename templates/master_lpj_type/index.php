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

$nama_List = "LPJ Type";
$main_query="";
$nama_table = "ref_lpj_type";
$primary_id = "lpj_type_id";
$form_map = " / Master / LPJ / Tipe Lembar Pertanggung Jawaban";
$form_new_title = "Form Add LPJ Type";
$form_edit_title = "Form Edit LPJ Type";
$field_name = "name,perihal,notes";
$field_alias_name = "Name,Perihal,Notes";
$field_required = "name,perihal";

$field_type_name = "#name|text|50^0";
$field_type_name = $field_type_name . "#perihal|text|50^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";

$search_field = "";
$record_show = "name|Name|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "perihal|Perihal|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "update_date|Last Update|left|sort_on|link_off|datetime~";
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

recordListNoPop(
	$nama_List,
	$main_query,
	$nama_table,
	$primary_id,
	$form_map,
	$form_new_title,
	$form_edit_title,
	$field_name,
	$field_alias_name,
	$field_type_name,
	$search_field,
	$record_show,
	$relational_txt,
	$field_required,
	$child_enable,
	$child_name,
	$child_main_query,
	$nama_table_child,
	$primary_id_child,
	$field_name_child,
	$field_type_child,
	$field_child_require,
	$record_show_child,
	$child_enable_2,
	$child_name_2,
	$child_main_query_2,
	$nama_table_child_2,
	$primary_id_child_2,
	$field_name_child_2,
	$field_type_child_2,
	$field_child_require_2,
	$record_show_child_2,
	$child_enable_3,
	$child_name_3,
	$child_main_query_3,
	$nama_table_child_3,
	$primary_id_child_3,
	$field_name_child_3,
	$field_type_child_3,
	$field_child_require_3,
	$record_show_child_3,
	$record_show_sum,
	$two_form,
	$additionalButton
);