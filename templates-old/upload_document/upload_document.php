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

	$query = "select * from ref_document_upload where is_deleted=0";

}



if($group_id <> 3){

	$query = "select * from ref_document_upload where is_deleted=0 and insert_by=".$user_id;



	// $query = "select * from ref_document_upload where is_deleted=0 and group_id REGEXP ".$group_id;

}





$nama_List = "Document Upload";

$main_query= $query;

$nama_table = "ref_document_upload";

$primary_id = "document_upload_id";

$form_new_title = "Form Add Document";

$form_edit_title = "Form Edit Document";



$field_name = "name,";

$field_name = $field_name . "document_number,";

$field_name = $field_name . "document1,";

// $field_name = $field_name . "document2,";

$field_name = $field_name . "notes";



$field_alias_name = "Document Name,";

$field_alias_name = $field_alias_name . "Document Number,";

$field_alias_name = $field_alias_name . "File,";

// $field_alias_name = $field_alias_name . "File 2,";

$field_alias_name = $field_alias_name . "Notes";



$field_required = "name,document_number,document1";



$field_type_name = "name|text|50^0";

$field_type_name = $field_type_name . "#document_number|text|50^0";

$field_type_name = $field_type_name . "#document1|file|50^0";

// $field_type_name = $field_type_name . "#document2|file|50^0";

$field_type_name = $field_type_name . "#notes|textarea|50^0";



// $field_type_name = $field_type_name . "#srv_id|select|select srv_id as id, srv_label as name from _rf_srv^0";



// $field_type_name = $field_type_name . "#mrtg|text|50^0";



// $field_type_name = $field_type_name . "#status_id|select|select status_id as id, status_name as name from ref_status^0";

$search_field = "name,document_number";

$record_show = "name|Doc. Name|center|sort_on|link_on|sub_query_off~";

$record_show = $record_show .  "document_number|Doc. Number|center|sort_on|link_off|sub_query_off~";

$record_show = $record_show .  "document1|Document|center|sort_off|link_off|files~";

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



