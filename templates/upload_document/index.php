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



$qry = cmsDB();



$user_id 			= $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")];

$group_id 			= $_SESSION["group_id_".$ANOM_VARS["app_session_code"]  . date("mdY")];

$group_location_id 	= $_SESSION["group_location_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];



if($group_id == 3){

	$query = "select * from ref_document_sop where is_deleted=0";

	// $query_select = "";

}



if($group_id <> 3){

	$query = "select * from ref_document_sop where is_deleted=0 and group_id REGEXP ".$group_id;

	// $query_select = " and group_location_id in (".$group_location_id.")";

}



$nama_List = "Document SOP";

$main_query= $query;

$nama_table = "ref_document_sop";

$primary_id = "document_sop_id";

$form_map = " / Document / Document SOP";

$form_new_title = "Form Add Document SOP";

$form_edit_title = "Form Edit Document SOP";



$field_name = "document_name,";

if($group_id==3){

	$field_name = $field_name . "group_id,";

}

$field_name = $field_name . "file_document,";

$field_name = $field_name . "description";


$field_alias_name = "Document Name,";

if($group_id==3){

	$field_alias_name = $field_alias_name . "Group Access,";

}

$field_alias_name = $field_alias_name . "File Document,";

$field_alias_name = $field_alias_name . "Description";



$field_required = "document_name,file_document";




$field_type_name = "document_name|text|50^0";

if($group_id==3){

	$field_type_name = $field_type_name . "#group_id|multiselect|select group_id as id, group_name as name from ref_group where is_deleted=0^0";

}



$field_type_name = $field_type_name . "#file_document|file|50^0";



$field_type_name = $field_type_name . "#description|textarea|50^0";




$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "group_id|group_id|multiselect|select group_name as name, group_id as id from ref_group~";


$search_field = "document_name";



$record_show = "document_name|Document Name|left|sort_on|link_on|sub_query_off~";

if($group_id==3){

	$record_show = $record_show . "group_id_txt|Document Access|left|sort_on|link_off|sub_query_off~";

}


$record_show = $record_show .  "description|Description|left|sort_off|link_off|sub_query_off~";

$record_show = $record_show . "update_date|Last Update|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show . "update_by_txt|Update By|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show .  "file_document|Document|center|sort_off|link_off|files~";



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




