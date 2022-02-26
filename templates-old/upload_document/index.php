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

$form_new_title = "Form Tambah Document";

$form_edit_title = "Form Ubah Document";



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



// $field_type_name = $field_type_name . "#srv_id|select|select srv_id as id, srv_label as name from _rf_srv^0";



// $field_type_name = $field_type_name . "#mrtg|text|50^0";



// $field_type_name = $field_type_name . "#status_id|select|select status_id as id, status_name as name from ref_status^0";











$search_field = "document_name";



$record_show = "document_name|Document Name|left|sort_on|link_on|sub_query_off~";

if($group_id==3){

	$record_show = $record_show . "group_id|Document Access|center|sort_on|link_off|sub_query_off~";

}

$record_show = $record_show .  "file_document|Document|center|sort_off|link_off|files~";

$record_show = $record_show .  "description|Description|left|sort_off|link_off|sub_query_off~";







// $record_show = $record_show . "status_id|Status|center|sort_off|link_off|sub_query_off~";







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







?>



