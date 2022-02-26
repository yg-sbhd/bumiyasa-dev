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



$nama_List = "Request For Quotation";

$main_query="";

$nama_table = "ref_request_for_quotation";

$primary_id = "request_for_quotation_id";

$form_map = " / Financial / Request For Quotation";

$form_new_title = "Form Add Request For Quotation";

$form_edit_title = "Form Edit Request For Quotation";

$field_name = "request_for_quotation_no,";
$field_name = $field_name . "purchase_request_id,";
$field_name = $field_name . "date,";
$field_name = $field_name . "vendor_id,";
$field_name = $field_name . "rfq_payment_id,";
$field_name = $field_name . "rfq_currency_id,";
$field_name = $field_name . "pic_name,";
$field_name = $field_name . "pic_phone,";
$field_name = $field_name . "pic_email,";
$field_name = $field_name . "document_date,";
$field_name = $field_name . "notes";


$field_alias_name = "Request For Quotation Number,";
$field_alias_name = $field_alias_name . "Purchase Request Number,";
$field_alias_name = $field_alias_name . "Request For Quotation Date,";
$field_alias_name = $field_alias_name . "Vendor,";
$field_alias_name = $field_alias_name . "Payment Type,";
$field_alias_name = $field_alias_name . "Currency,";
$field_alias_name = $field_alias_name . "PIC Name,";
$field_alias_name = $field_alias_name . "PIC Phone,";
$field_alias_name = $field_alias_name . "PIC Email,";

$field_alias_name = $field_alias_name . "Bidding Document Date,";
$field_alias_name = $field_alias_name . "Note";


$field_required = "purchase_request_id,date,vendor_id,rfq_payment_id,rfq_currency_id,user_id,document_date";


$field_type_name = "request_for_quotation_no|text-readonly|50^0";
$field_type_name = $field_type_name . "#purchase_request_id|select|select purchase_request_id as id, purchase_request_no as name from ref_purchase_request where is_deleted=0^0";

$field_type_name = $field_type_name . "#date|date|50^0";
$field_type_name = $field_type_name . "#vendor_id|select|select vendor_id as id, vendor_company as name from master_vendor where is_deleted=0^0";

$field_type_name = $field_type_name . "#rfq_payment_id|select|select rfq_payment_id as id, name as name from master_rfq_payment where is_deleted=0^0";

$field_type_name = $field_type_name . "#rfq_currency_id|select|select rfq_currency_id as id, name as name from master_rfq_currency where is_deleted=0^0";
// $field_type_name = $field_type_name . "#user_id|select|select user_id as id, full_name as name from ref_user where is_deleted=0 and status_id=5^0";
$field_type_name = $field_type_name . "#pic_name|text|50^0";
$field_type_name = $field_type_name . "#pic_phone|text|50^0";
$field_type_name = $field_type_name . "#pic_email|text|50^0";

$field_type_name = $field_type_name . "#document_date|date|50^0";

$field_type_name = $field_type_name . "#notes|textarea|50^0";


$search_field = "";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
// $relational_txt = $relational_txt . "group_location_id|group_location_id|select|select group_name_alias as name, group_location_id as id from master_group_location~";
$relational_txt = $relational_txt . "purchase_request_id|purchase_request_id|select|select purchase_request_id as id, purchase_request_no as name from ref_purchase_request where is_deleted=0~";
$relational_txt = $relational_txt . "vendor_id|vendor_id|select|select vendor_id as id, vendor_company as name from master_vendor where is_deleted=0~";
$relational_txt = $relational_txt . "rfq_payment_id|rfq_payment_id|select|select rfq_payment_id as id, name as name from master_rfq_payment where is_deleted=0~";
$relational_txt = $relational_txt . "rfq_currency_id|rfq_currency_id|select|select rfq_currency_id as id, name as name from master_rfq_currency where is_deleted=0~";
// $relational_txt = $relational_txt . "user_id|user_id|select|select user_id as id, full_name as name from ref_user where is_deleted=0~";
$relational_txt = $relational_txt . "status_id|status_id|select|select status_id as id, status_name as name from ref_status where is_deleted=0~";


$record_show = "request_for_quotation_no|PR No|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show. "group_location_id_txt|Company|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show. "purchase_request_no|PR Ref|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "update_date|Last Update|center|sort_on|link_on|datetime~";
$record_show = $record_show . "update_by_txt|Update By|center|sort_on|link_off|sub_query_off~";


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
