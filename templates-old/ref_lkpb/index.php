<?
function opt_insertqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();

    _process_status(0, 'lkpb', $maxID, "LKPB dibuat", $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")], $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")]);

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

$qry->query("select position from master_group_location where group_location_id=".$group_location_id);
$qry->next();

if($group_id == 3){
	$query = "select * from ref_lkpb where is_deleted=0 and (status_id<>0 or insert_by=".$user_id.")";
	$query_select = "";
}

if($group_id <> 3){
	if($qry->row("position") == "Site"){

		$query = "select * from ref_lkpb where is_deleted=0 and group_location_id=".$group_location_id;
		if($group_id == 18){ //site manager
			$query .= " and insert_by =".$user_id." or status_id in (1,2,4)";	
		}

		if($group_id == 19){ //site wakil manager
			$query .= " and insert_by =".$user_id." or status_id in (3,4)";	
		}
	}

	$query_select = " and group_location_id in (".$group_location_id.")";
}

$nama_List = "Laporan Kejadian Potensi Bahaya";
$main_query= $query;
$nama_table = "ref_lkpb";
$primary_id = "lkpb_id";
$form_new_title = "Form Add LKPB";
$form_edit_title = "Form Edit LKPB";

$field_name = "lkpb_no,";
$field_name = $field_name ."group_location_id,";
$field_name = $field_name ."date,";
$field_name = $field_name ."hour,";
$field_name = $field_name ."master_lkpb_id,";
$field_name = $field_name ."uraian,";
$field_name = $field_name ."akar_masalah,";
$field_name = $field_name ."tindakan_sementara,";
$field_name = $field_name ."tanggal_penerapan,";
$field_name = $field_name ."documentation1,";
$field_name = $field_name ."documentation2,";
if(!isset($_GET["edit"]) && !isset($_GET["new_form"])){
	$field_name = $field_name ."documentation3,";
	$field_name = $field_name ."status_id";
}else{
	$field_name = $field_name ."documentation3";
}


$field_alias_name = "Nomor,";
$field_alias_name = $field_alias_name . "Nama Perusahaan,";
$field_alias_name = $field_alias_name . "Tanggal,";
$field_alias_name = $field_alias_name . "Jam Terjadi,";
$field_alias_name = $field_alias_name . "Bahaya,";
$field_alias_name = $field_alias_name . "Uraian,";
$field_alias_name = $field_alias_name . "Akar Masalah,";
$field_alias_name = $field_alias_name . "Tindakan Sementara,";
$field_alias_name = $field_alias_name . "Tanggal Penerapan,";
$field_alias_name = $field_alias_name . "Dokumentasi,";
$field_alias_name = $field_alias_name . "Dokumentasi 2,";
if(!isset($_GET["edit"]) && !isset($_GET["new_form"])){
	$field_alias_name = $field_alias_name . "Dokumentasi 3,";
	$field_alias_name = $field_alias_name . "Status";
}else{
	$field_alias_name = $field_alias_name . "Dokumentasi 3";
}


$field_type_name = "lkpb_no|text-readonly|50^0";
$field_type_name = $field_type_name . "#group_location_id|select|select group_location_id as id, group_name as name from master_group_location where is_deleted=0 and group_location_id<>0".$query_select."^0";
$field_type_name = $field_type_name . "#date|date|50^0";
$field_type_name = $field_type_name . "#hour|time|50^0";
$field_type_name = $field_type_name . "#master_lkpb_id|multiselect|select master_lkpb_id as id, name as name from master_lkpb where is_deleted=0^0";

$field_type_name = $field_type_name . "#uraian|textarea|50^0";
$field_type_name = $field_type_name . "#akar_masalah|textarea|50^0";
$field_type_name = $field_type_name . "#tindakan_sementara|textarea|50^0";
$field_type_name = $field_type_name . "#tanggal_penerapan|date|50^0";
$field_type_name = $field_type_name . "#documentation1|file|50^0";
$field_type_name = $field_type_name . "#documentation2|file|50^0";
$field_type_name = $field_type_name . "#documentation3|file|50^0";
if(!isset($_GET["edit"]) && !isset($_GET["new_form"])){
	$field_type_name = $field_type_name . "#status_id|select|select status_id as id, status_name as name from ref_status^0";
}

$field_required = "group_location_id";

$search_field = "group_location_id,status_id";

$record_show = "lkpb_no|Nomor|center|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "group_location_id|Perusahaan|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "status_id|Status|center|sort_on|link_off|sub_query_off~";

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
