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
function opt_insertqrychild($maxID){
	global $ANOM_VARS,$_POST,$_GET,$_SESSION;
	$qry=cmsDB();
}
function opt_updateqrychild($id){
	global $ANOM_VARS,$_POST,$_GET,$_SESSION;
	$qry=cmsDB();
}

function opt_correction_qry_child_insert(){
	global $_POST,$_GET;
	$qry=cmsDB();
}

function opt_correction_qry_child_edit($id){
	global $_POST,$_GET;
	$qry=cmsDB();
}

function opt_deletchildeqry($maxID){
	global $ANOM_VARS,$_POST,$_GET,$_SESSION;
	$qry=cmsDB();
}

$nama_List = "Vendor";
$main_query="";
$nama_table = "master_vendor";
$primary_id = "vendor_id";
$form_map = " / Master Data / List of Vendor";
$form_new_title = "Form Add Vendor";
$form_edit_title = "Form Edit Vendor";

$field_name = "kategori_rekanan_id,";
$field_name = $field_name . "vendor_company,";
$field_name = $field_name . "vendor_address,";
$field_name = $field_name . "npwp,";
$field_name = $field_name . "vendor_phone,";
$field_name = $field_name . "vendor_phone_2,";
$field_name = $field_name . "fax,";
$field_name = $field_name . "email_1,";
$field_name = $field_name . "email_2,";
$field_name = $field_name . "website,";
$field_name = $field_name . "vendor_name,";
$field_name = $field_name . "position,";
$field_name = $field_name . "established,";
$field_name = $field_name . "recommendation";

$field_alias_name = "Kategori Rekanan,";
$field_alias_name = $field_alias_name . "Company,";
$field_alias_name = $field_alias_name . "Address,";
$field_alias_name = $field_alias_name . "NPWP,";
$field_alias_name = $field_alias_name . "Phone,";
$field_alias_name = $field_alias_name . "Phone 1,";
$field_alias_name = $field_alias_name . "FAX,";
$field_alias_name = $field_alias_name . "Email,";
$field_alias_name = $field_alias_name . "Email 2,";
$field_alias_name = $field_alias_name . "Website,";
$field_alias_name = $field_alias_name . "Contact Name,";
$field_alias_name = $field_alias_name . "Jabatan,";
$field_alias_name = $field_alias_name . "Tahun Berdiri,";
$field_alias_name = $field_alias_name . "Rekomendasi dari";


$field_type_name = "kategori_rekanan_id|select|select kategori_rekanan_id as id, nama as name from master_kategori_rekanan^0"; 
$field_type_name = $field_type_name . "#vendor_company|text|50^0"; 
$field_type_name = $field_type_name . "#vendor_address|text|100^0";
$field_type_name = $field_type_name . "#npwp|text|50^0";
$field_type_name = $field_type_name . "#vendor_phone|text|50^0";
$field_type_name = $field_type_name . "#vendor_phone_2|text|50^0";
$field_type_name = $field_type_name . "#fax|text|50^0";
$field_type_name = $field_type_name . "#email_1|text|50^0";
$field_type_name = $field_type_name . "#email_2|text|50^0";
$field_type_name = $field_type_name . "#website|text|50^0";
$field_type_name = $field_type_name . "#vendor_name|text|50^0";
$field_type_name = $field_type_name . "#position|text|50^0";
$field_type_name = $field_type_name . "#established|text|50^0";
$field_type_name = $field_type_name . "#recommendation|text|50^0";

$search_field = "vendor_company";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "kategori_rekanan_id|kategori_rekanan_id|select|select nama as name, kategori_rekanan_id as id from master_kategori_rekanan~";


$record_show = "vendor_company|Company|left|sort_off|link_on|sub_query_off~";
$record_show = $record_show . "vendor_name|PIC|left|sort_off|link_off|sub_query_off~";
$record_show = $record_show . "vendor_address|Address|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show . "update_date|Last Update|left|sort_on|link_off|datetime~";
$record_show = $record_show . "update_by_txt|Update By|left|sort_on|link_off|sub_query_off~";

// $record_show = $record_show . "target_name|Target Name|left|sort_off|link_on|sub_query_off~";
// $record_show = $record_show . "project_id|Project Name|left|sort_off|link_off|sub_query_off~";
//$record_show = $record_show . "full_name|Project Leader|center|sort_off|link_off|
				//select full_name  from ref_user 
				//inner join p_project on ref_user.user_id=p_project.project_lead#full_name-text~";
//$record_show = $record_show . "project_lead|Project Leader|left|sort_off|link_off|sub_query_off~";
//$record_show = $record_show . "start_date|Start date|center|sort_off|link_off|sub_query_off~";
//$record_show = $record_show . "end_date|End Date|center|sort_off|link_off|sub_query_off~";
// $record_show = $record_show . "status_id|Status|center|sort_off|link_off|sub_query_off~";
$field_required = "vendor_company";

// $field_required="project_id,target_name,target_desc";


/* Child Chapter */
/*$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query*/
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
