<?
function opt_insertqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
	$qry2=cmsDB();
	$qry->query("select * from ref_purchase_order where purchase_order_id=".$maxID);
	$qry->next();
	$qry2->query("select * from ref_bid_analys where bid_analys_id=".$qry->row('bid_analys_id'));
	$qry2->next();
	$qry_update = "update ref_purchase_order set purchase_request_id='".$qry2->row('purchase_request_id')."', request_for_quotation_id='".$qry2->row('request_for_quotation_id')."' where purchase_order_id=".$maxID;
	$qry->query($qry_update);

}
function opt_updateqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();
	$qry2=cmsDB();
	$qry->query("select * from ref_purchase_order where purchase_order_id=".$id);
	$qry->next();
	$qry2->query("select * from ref_bid_analys where bid_analys_id=".$qry->row('bid_analys_id'));
	$qry2->next();
	$qry_update = "update ref_purchase_order set purchase_request_id='".$qry2->row('purchase_request_id')."', request_for_quotation_id='".$qry2->row('request_for_quotation_id')."' where purchase_order_id=".$id;
	$qry->query($qry_update);
	
	
}
function opt_deleteqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();
}

$nama_List = "Purchase Order";
$main_query="";
$nama_table = "ref_purchase_order";
$primary_id = "purchase_order_id";
$form_map = " / Financial / Purchase Order";
$form_new_title = "Form Add Purchase Order";
$form_edit_title = "Form Edit Purchase Order";

$field_name = "purchase_order_no,";
$field_name = $field_name . "date,";
$field_name = $field_name . "bid_analys_id,";
$field_name = $field_name . "buyer_name,";
$field_name = $field_name . "seller_name,";
$field_name = $field_name . "notes";

$field_alias_name = "Purchase Order No,Date,Bid Analysis No,Buyer Name,Seller Name,Notes";
$field_required = "bid_analys_id,buyer_name,seller_name";

$field_type_name = "purchase_order_no|text-readonly|50^0";
$field_type_name = $field_type_name . "#date|date|50^0";
$field_type_name = $field_type_name . "#bid_analys_id|select|select bid_analys_id as id, bid_analys_no as name from ref_bid_analys where is_deleted=0^0";
$field_type_name = $field_type_name . "#buyer_name|text|50^0";
$field_type_name = $field_type_name . "#seller_name|text|50^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";


$search_field = "name";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt ."purchase_request_id|purchase_request_id|select|select purchase_request_id as id, purchase_request_no as name from ref_purchase_request~";
$relational_txt = $relational_txt ."request_for_quotation_id|request_for_quotation_id|select|select request_for_quotation_id as id, request_for_quotation_no as name from ref_request_for_quotation~";
$relational_txt = $relational_txt ."bid_analys_id|bid_analys_id|select|select bid_analys_id as id, bid_analys_no as name from ref_bid_analys~";

$record_show = "purchase_request_id_txt|PO Number|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "seller_name|Seller Name|left|sort_on|link_off|sub_query_off~";
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
