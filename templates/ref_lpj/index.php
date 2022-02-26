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
	global $_POST,$_GET;
	$qry=cmsDB();

}

function opt_updateqrychild($id){
	global $_POST,$_GET;
	$qry=cmsDB();
}

function opt_deleteqrychild($id){
	global $_POST,$_GET;
	$qry=cmsDB();
}


$nama_List = "Lembar Pertanggung Jawaban";
$main_query= "";
$nama_table = "ref_lpj";
$primary_id = "lpj_id";
$form_map = " / Financial / Pertanggung Jawaban";
$form_new_title = "Form Add Pertanggung Jawaban";
$form_edit_title = "Form Edit Pertanggung Jawaban";

$field_name = "lpj_no,";
$field_name = $field_name ."date,";
$field_name = $field_name ."lpj_type_id,";
$field_name = $field_name ."pd_id,";
$field_name = $field_name ."ppd_id,";

$field_name = $field_name ."to_group_id,";
$field_name = $field_name ."from_group_id";
// $field_name = $field_name ."perihal,";
// $field_name = $field_name ."date_start,";
// $field_name = $field_name ."date_end,";
// $field_name = $field_name ."kegiatan";


$field_alias_name = "Pertanggung Jawaban No.,";
$field_alias_name = $field_alias_name . "Tanggal,";
$field_alias_name = $field_alias_name . "Jenis LPJ,";
$field_alias_name = $field_alias_name . "Permohonan Dana Ref No,";
$field_alias_name = $field_alias_name . "Perjalanan Dinas Ref No,";
$field_alias_name = $field_alias_name . "Kepada,";
$field_alias_name = $field_alias_name . "Dari";
// $field_alias_name = $field_alias_name . "Perihal,";
// $field_alias_name = $field_alias_name . "Dari Tanggal,";
// $field_alias_name = $field_alias_name . "Sampai Tanggal,";
// $field_alias_name = $field_alias_name . "Kegiatan";


$field_type_name = "lpj_no|text-readonly|50^0";
$field_type_name = $field_type_name . "#date|date-readonly|50^0";

$field_type_name = $field_type_name . "#lpj_type_id|radio|select lpj_type_id as id, name as name from ref_lpj_type where is_deleted=0^pd_id";
$field_type_name = $field_type_name . "#pd_id|select|select pd_id as id, pd_no as name from ref_pd where is_deleted=0^0";
$field_type_name = $field_type_name . "#ppd_id|select|select pd_id as id, pd_no as name from ref_pd where is_deleted=0^0";

$field_type_name = $field_type_name . "#to_group_id|select|select group_id as id, group_name as name from ref_group where is_deleted=0 and group_id<>0^0";
$field_type_name = $field_type_name . "#from_group_id|select|select group_id as id, group_name as name from ref_group where is_deleted=0 and group_id<>0^0";
// $field_type_name = $field_type_name . "#perihal|text|50^0";
// $field_type_name = $field_type_name . "#date_start|date|50^0";
// $field_type_name = $field_type_name . "#date_end|date|50^0";
// $field_type_name = $field_type_name . "#kegiatan|textarea|50^0";

$field_required = "lpj_type_id,to_group_id,from_group_id";

$search_field = "";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "lpj_type_id|lpj_type_id|select|select name as name, lpj_type_id as id from ref_lpj_type~";
$relational_txt = $relational_txt . "to_group_id|group_id|select|select group_name as name, group_id as id from ref_group~";
$relational_txt = $relational_txt . "from_group_id|group_id|select|select group_name as name, group_id as id from ref_group~";
$relational_txt = $relational_txt . "status_id|status_id|select|select status_name as name, status_id as id from ref_status~";


$record_show = "lpj_no|Nomor|center|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "to_group_id_txt|Dari|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "from_group_id_txt|Kepada|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "lpj_type_id_txt|Tipe|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "status_id_txt|Status|center|sort_on|link_off|status~";
$record_show = $record_show . "update_date|Last Update|left|sort_on|link_off|datetime~";
$record_show = $record_show . "update_by_txt|Update By|left|sort_on|link_off|sub_query_off~";

// $child_enable 		= "yes";
// $child_name 		= "Rencana Personil";
// $child_main_query 	= "";
// $nama_table_child 	= "ref_ppd_personil";
// $primary_id_child 	= "ppd_personil_id";
// $field_name_child 	= "user_id";
// $field_type_child 	= "user_id|select|select user_id as id, full_name as name from ref_user where is_deleted=0 and status_id=5^11|Personil";
// $field_child_require = "user_id";
// $record_show_child 	= "user_id|Personil|left|sort_off|select user_id as id, full_name as name from ref_user~";

// $child_enable 		= "yes";
// $child_name 		= "Rencana Kegiatan";
// $child_main_query 	= "";
// $nama_table_child 	= "ref_pd_kegiatan";
// $primary_id_child 	= "pd_kegiatan_id";
// $field_name_child 	= "kegiatan";
// $field_type_child 	= "kegiatan|text|50^11|Kegiatan";
// $field_child_require = "kegiatan";
// $record_show_child 	= "kegiatan|Kegiatan|left|sort_off|sub_query_off";

$child_enable 	= "yes";
$child_name 		= "Pelaksanaan Kegiatan";
$child_main_query = "";
$nama_table_child = "ref_lpj_biaya";
$primary_id_child = "lpj_biaya_id";
$field_name_child = "ppd_tipe_biaya_id,uraian_biaya,qty,unit_qty_id,no_bukti,price";
$field_type_child	= "ppd_tipe_biaya_id|select|select ppd_tipe_biaya_id as id, name as name from master_ppd_tipe_biaya where is_deleted=0^2|Tipe Biaya";
$field_type_child	= $field_type_child . "#uraian_biaya|text|50^4|Uraian Biaya";
$field_type_child	= $field_type_child . "#qty|text|50^1|Qty";
$field_type_child	= $field_type_child . "#unit_qty_id|select|select unit_qty_id as id, name as name from master_unit_qty where is_deleted=0^1|Unit";
$field_type_child	= $field_type_child . "#no_bukti|text|50^1|No. Bukti";
$field_type_child	= $field_type_child . "#price|text|50^2|Harga Satuan";

$field_child_require 	= "ppd_tipe_biaya_id,uraian_biaya,qty,unit_qty_id,price";
$record_show_child 	= "ppd_tipe_biaya_id|Tipe Biaya|left|sort_off|select ppd_tipe_biaya_id as id, name as name from master_ppd_tipe_biaya~";
$record_show_child 	= $record_show_child . "uraian_biaya|Uraian Biaya|left|sort_off|sub_query_off~";
$record_show_child 	= $record_show_child . "qty|Qty|left|sort_off|number~";
$record_show_child 	= $record_show_child . "unit_qty_id|Unit|left|sort_off|select unit_qty_id as id, name as name from master_unit_qty~";
$record_show_child 	= $record_show_child . "no_bukti|No. Bukti|left|sort_off|sub_query_off~";

$record_show_child 	= $record_show_child . "price|Harga Satuan|right|sort_off|decimal~";


//penjumlahan (SUM) utk recordlist
$record_show_sum = "";
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
