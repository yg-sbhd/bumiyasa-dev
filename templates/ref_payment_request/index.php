<?
function opt_insertqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
	// $qry2=cmsDB();
	// $qry->query("select * from ref_purchase_order where purchase_order_id=".$maxID);
	// $qry->next();
	// $qry2->query("select * from ref_bid_analys where bid_analys_id=".$qry->row('bid_analys_id'));
	// $qry2->next();
	// $qry_update = "update ref_purchase_order set purchase_request_id='".$qry2->row('purchase_request_id')."', request_for_quotation_id='".$qry2->row('request_for_quotation_id')."' where purchase_order_id=".$maxID;
	// $qry->query($qry_update);

}
function opt_updateqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();
	// $qry2=cmsDB();
	// $qry->query("select * from ref_purchase_order where purchase_order_id=".$id);
	// $qry->next();
	// $qry2->query("select * from ref_bid_analys where bid_analys_id=".$qry->row('bid_analys_id'));
	// $qry2->next();
	// $qry_update = "update ref_purchase_order set purchase_request_id='".$qry2->row('purchase_request_id')."', request_for_quotation_id='".$qry2->row('request_for_quotation_id')."' where purchase_order_id=".$id;
	// $qry->query($qry_update);
	
	
}
function opt_deleteqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();
}

$nama_List = "Payment Request";
$main_query="";
$nama_table = "ref_payment_request";
$primary_id = "payment_request_id";
$form_map = " / Financial / Payment Request";
$form_new_title = "Form Add Payment Request";
$form_edit_title = "Form Edit Payment Request";

$field_name = "payment_request_no,";
$field_name = $field_name . "date,";
$field_name = $field_name . "perihal,";
$field_name = $field_name . "pemohon_user_id,";
$field_name = $field_name . "nomor,";
$field_name = $field_name . "tanggal,";
$field_name = $field_name . "to_name,";
$field_name = $field_name . "to_rekening,";
$field_name = $field_name . "rfq_currency_id,";
$field_name = $field_name . "nominal,";
$field_name = $field_name . "notes";

$field_alias_name = "Payment Request No,";
$field_alias_name = $field_alias_name . "Date,";
$field_alias_name = $field_alias_name . "Perihal,";
$field_alias_name = $field_alias_name . "Pemohon,";
$field_alias_name = $field_alias_name . "Nomor,";
$field_alias_name = $field_alias_name . "Tanggal,";
$field_alias_name = $field_alias_name . "Dibayarkan A.N,";
$field_alias_name = $field_alias_name . "No Rekening,";
$field_alias_name = $field_alias_name . "Currency,";
$field_alias_name = $field_alias_name . "Nilai Pembayaran,";
$field_alias_name = $field_alias_name . "Notes";

$field_required = "perihal,pemohon_user_id";

$field_type_name = "payment_request_no|text-readonly|50^0";
$field_type_name = $field_type_name . "#date|date-readonly|50^0";
$field_type_name = $field_type_name . "#perihal|text|50^0";
$field_type_name = $field_type_name . "#pemohon_user_id|select|select user_id as id, full_name as name from ref_user where is_deleted=0^0";
$field_type_name = $field_type_name . "#nomor|text|50^0";
$field_type_name = $field_type_name . "#tanggal|date|50^0";
$field_type_name = $field_type_name . "#to_name|text|50^0";
$field_type_name = $field_type_name . "#to_rekening|text|50^0";
$field_type_name = $field_type_name . "#rfq_currency_id|select|select rfq_currency_id as id, name as name from master_rfq_currency where is_deleted=0^0";
$field_type_name = $field_type_name . "#nominal|text|50^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";


$search_field = "";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt ."pemohon_user_id|user_id|select|select user_id as id, full_name as name from ref_user~"
;
$relational_txt = $relational_txt ."rfq_currency_id|rfq_currency_id|select|select rfq_currency_id as id, name as name from master_rfq_currency~";
$relational_txt = $relational_txt ."status_id|status_id|select|select status_id as id, status_name as name from ref_status~";

$record_show = "payment_request_no|Payment Request No|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "perihal|Perihal|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show . "to_name|Payment To|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show . "nominal|Nominal|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show . "update_date|Last Update|left|sort_on|link_on|datetime~";
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
