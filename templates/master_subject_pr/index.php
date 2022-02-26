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



$nama_List = "List Subject PR";

$main_query="select * from master_subject_pr where is_deleted = 0";

$nama_table = "master_subject_pr";

$primary_id = "subject_pr_id";

$form_new_title = "Form Add Subject PR";

$form_edit_title = "Form Edit Subject PR";

$field_name = "name,functional_id,notes";

$field_alias_name = "Name,Funtional,Notes";

$field_required = "name,functional_id";



$field_type_name = "name|text|50^0";

$field_type_name = $field_type_name . "#functional_id|select|select functional_id as id,name as name from master_functional^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";



$search_field = "name,functional_id";

$record_show = "name|Name|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show. "functional_id|Functional|left|sort_on|link_on|sub_query_off~";



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

