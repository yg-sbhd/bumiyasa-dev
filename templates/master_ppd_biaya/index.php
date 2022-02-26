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



$nama_List = "Jenis Biaya Perjalanan Dinas";

$main_query="";

$nama_table = "master_ppd_tipe_biaya";

$primary_id = "ppd_tipe_biaya_id";

$form_map = " / Master Data / Perjalanan Dinas / Master Tipe Biaya";

$form_new_title = "Form Add Component Tipe Biaya";

$form_edit_title = "Form Edit Component Tipe Biaya";

$field_name = "name,order_level,notes";

$field_alias_name = "Name,Order,Notes";

$field_required = "name,order_level";


$field_type_name = "name|text|50^0";
$field_type_name = $field_type_name . "#order_level|text|50^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";


$search_field = "";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";


$record_show = "name|Name|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "order_level|Order Level|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show . "update_date|Last Update|center|sort_on|link_on|datetime~";
$record_show = $record_show . "update_by_txt|Update By|center|sort_on|link_off|sub_query_off~";



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
