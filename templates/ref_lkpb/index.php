<?
function opt_insertqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();

    _process_status(0, 'lkpb', $maxID, "LKPB dibuat", $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")], $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")]);
	
	insert_outstanding(
		'lkpb', 
		'-', 
		0, 
		encryptStringArray('templates/ref_lkpb/preview.php').'&lkpb_id='.encryptStringArray($maxID), 
		$_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")], 
		$_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")]
	);
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
$qry2 = cmsDB();

$qry_form_select = '';
if($sesi_position == 'ADMIN'){
	$query = "select * from ref_lkpb where is_deleted=0 and status_id not in (0) or insert_by=".$sesi_user_id;
	$qry_group_location_id = "";
}else{
	$qry->query("select show_lst_lkpb from ref_group where is_deleted=0 and group_id=".$sesi_group_id);
	$qry->query("select user_id from ref_user where group_id in (".$qry->valueList('show_lst_lkpb').")");
	$query = "select * from ref_lkpb where is_deleted=0 and status_id not in (0) and insert_by in (".$qry->valueList('user_id').") or insert_by=".$sesi_user_id;

	$qry_group_location_id = " and group_location_id in (".$sesi_group_location_id.")";
}

$nama_List = "Laporan Kejadian Potensi Bahaya";
$main_query= $query;
$nama_table = "ref_lkpb";
$primary_id = "lkpb_id";
$form_map = " / HSE / LKPB";
$form_new_title = "Form Add LKPB";
$form_edit_title = "Form Edit LKPB";

$field_name = "lkpb_no,";
$field_name = $field_name ."date,";
$field_name = $field_name ."group_location_id,";
$field_name = $field_name ."hour,";
$field_name = $field_name ."master_lkpb_id,";
$field_name = $field_name ."uraian,";
$field_name = $field_name ."akar_masalah,";
$field_name = $field_name ."tindakan_sementara,";
$field_name = $field_name ."tanggal_penerapan,";
$field_name = $field_name ."documentation1,";
$field_name = $field_name ."documentation2,";
$field_name = $field_name ."documentation3,";

if(!isset($_GET["edit"]) && !isset($_GET["new_form"])){
	$field_name = $field_name ."documentation4,";
	$field_name = $field_name ."status_id";
}else{
	$field_name = $field_name ."documentation4";
}

$field_alias_name = "Nomor,";
$field_alias_name = $field_alias_name . "Tanggal,";
$field_alias_name = $field_alias_name . "Nama Perusahaan,";
$field_alias_name = $field_alias_name . "Jam Terjadi,";
$field_alias_name = $field_alias_name . "Bahaya,";
$field_alias_name = $field_alias_name . "Uraian,";
$field_alias_name = $field_alias_name . "Akar Masalah,";
$field_alias_name = $field_alias_name . "Tindakan Sementara,";
$field_alias_name = $field_alias_name . "Tanggal Penerapan,";
$field_alias_name = $field_alias_name . "Dokumentasi,";
$field_alias_name = $field_alias_name . "Dokumentasi 2,";
$field_alias_name = $field_alias_name . "Dokumentasi 3,";
if(!isset($_GET["edit"]) && !isset($_GET["new_form"])){
	$field_alias_name = $field_alias_name . "Dokumentasi 4,";
	$field_alias_name = $field_alias_name . "Status";
}else{
	$field_alias_name = $field_alias_name . "Dokumentasi 4";
}


$field_type_name = "lkpb_no|text-readonly|50^0";
$field_type_name = $field_type_name . "#date|date-readonly|50^0";
$field_type_name = $field_type_name . "#group_location_id|select|select group_location_id as id, CONCAT(group_name_alias, ' (',group_name,')') as name from master_group_location where is_deleted=0 and group_location_id<>0".$qry_group_location_id."^0";
$field_type_name = $field_type_name . "#hour|time|50^0";
$field_type_name = $field_type_name . "#master_lkpb_id|multi-checkbox|select master_lkpb_id as id, name as name from master_lkpb where is_deleted=0^0";

$field_type_name = $field_type_name . "#uraian|textarea|50^0";
$field_type_name = $field_type_name . "#akar_masalah|textarea|50^0";
$field_type_name = $field_type_name . "#tindakan_sementara|textarea|50^0";
$field_type_name = $field_type_name . "#tanggal_penerapan|date-now|50^0";
$field_type_name = $field_type_name . "#documentation1|image|50^0";
$field_type_name = $field_type_name . "#documentation2|image|50^0";
$field_type_name = $field_type_name . "#documentation3|image|50^0";
$field_type_name = $field_type_name . "#documentation4|image|50^0";

if(!isset($_GET["edit"]) && !isset($_GET["new_form"])){
	$field_type_name = $field_type_name . "#status_id|select|select status_id as id, status_name as name from ref_status^0";
}

$field_required = "group_location_id,hour_timehour";

$search_field = "group_location_id,status_id";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "group_location_id|group_location_id|select|select group_name_alias as name, group_location_id as id from master_group_location~";
$relational_txt = $relational_txt . "master_lkpb_id|master_lkpb_id|multiselect|select name as name, master_lkpb_id as id from master_lkpb~";
$relational_txt = $relational_txt . "status_id|status_id|select|select status_name as name, status_id as id from ref_status~";


$record_show = "lkpb_no|Nomor|center|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "group_location_id_txt|Perusahaan|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "status_id_txt|Status|center|sort_on|link_off|status~";
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
