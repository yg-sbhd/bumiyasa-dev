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

function opt_deletchildeqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();	
}

$qry=cmsDB();	
$user_approve = cmsDB();
$user_approve->query("select review_user_id, approve_user_id from master_pr_component where is_deleted=0");
// $user_approve->next();
// echo $user_approve->valueList('review_user_id');
$qry_form_select = '';
// if($sesi_position == 'ADMIN' || $sesi_position == 'COMMISSIONER' || $sesi_position == 'DIRECTOR'){
// if($sesi_position == 'ADMIN'){
// 	$query = "select * from ref_lkpb where is_deleted=0 and status_id not in (0) or insert_by=".$sesi_user_id;
// }else{
// 	$qry->query("select show_lst_group from ref_group where is_deleted=0 and group_id=".$sesi_group_id);
// 	$qry->query("select user_id from ref_user where group_id in (".$qry->valueList('show_lst_group').")");
// 	if(in_array($sesi_user_id, $user_approve->valueList('review_user_id')) || in_array($sesi_user_id, $user_approve->valueList('approve_user_id'))){
// 		$query = "select * from ref_lkpb where is_deleted=0 and status_id not in (0) or insert_by=".$sesi_user_id;
// 	}else{
// 		$query = "select * from ref_lkpb where is_deleted=0 and status_id not in (0) and insert_by in (".$qry->valueList('user_id').") or insert_by=".$sesi_user_id;;
// 	}
// }

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

$nama_List 		 = "Purchase Request";
$main_query 	 = "";
$nama_table 	 = "ref_purchase_request";
$primary_id 	 = "purchase_request_id";
$form_map 		 = " / Financial / Purchase Request";
$form_new_title  = "Form Add Purchase Request";
$form_edit_title = "Form Edit Purchase Request";

$field_name = "purchase_request_no,";
$field_name = $field_name . "date,";
$field_name = $field_name . "group_location_id,";
$field_name = $field_name . "lkpb_id,";
$field_name = $field_name . "pr_subject_id,";
$field_name = $field_name . "pr_component_id,";
$field_name = $field_name . "pr_applicant_id,";
$field_name = $field_name . "delivery_date,";
$field_name = $field_name . "ship_to_name,";
$field_name = $field_name . "ship_to_company,";
$field_name = $field_name . "ship_to_address,";
$field_name = $field_name . "ship_to_phone,";
$field_name = $field_name . "notes";

$field_alias_name = "Purchase Request Number,";
$field_alias_name = $field_alias_name . "Purchase Request Date,";
$field_alias_name = $field_alias_name . "Company,";
$field_alias_name = $field_alias_name . "LKPB Number,";
$field_alias_name = $field_alias_name . "Subject,";
$field_alias_name = $field_alias_name . "Component,";
$field_alias_name = $field_alias_name . "Applicant,";
$field_alias_name = $field_alias_name . "Delivery Date,";
$field_alias_name = $field_alias_name . "Ship To (<b>Name</b>),";
$field_alias_name = $field_alias_name . "Ship To (<b>Company</b>),";
$field_alias_name = $field_alias_name . "Ship To (<b>Address</b>),";
$field_alias_name = $field_alias_name . "Ship To (<b>Phone Number</b>),";
$field_alias_name = $field_alias_name . "Note";


$field_required = "group_location_id,pr_subject_id,pr_component_id,pr_applicant_id,delivery_date,ship_to_name";


$field_type_name = "purchase_request_no|text-readonly|50^0";
$field_type_name = $field_type_name . "#date|text-readonly|50^0";

$field_type_name = $field_type_name . "#group_location_id|select|select group_location_id as id, CONCAT(group_name_alias, ' (',group_name,')') as name from master_group_location where is_deleted=0 and group_location_id<>0".$qry_group_location_id."^0";

$field_type_name = $field_type_name . "#lkpb_id|select|select lkpb_id as id, lkpb_no as name from ref_lkpb where is_deleted=0 and status_id=100^0";

$field_type_name = $field_type_name . "#pr_subject_id|select|select pr_subject_id as id, name as name from master_pr_subject where is_deleted=0^0";

$field_type_name = $field_type_name . "#pr_component_id|select|select pr_component_id as id, name as name from master_pr_component where is_deleted=0^0";

$field_type_name = $field_type_name . "#pr_applicant_id|select|select pr_applicant_id as id, name as name from master_pr_applicant where is_deleted=0^0";

$field_type_name = $field_type_name . "#delivery_date|date|50^0";

$field_type_name = $field_type_name . "#ship_to_name|text|50^0";
$field_type_name = $field_type_name . "#ship_to_company|text|50^0";
$field_type_name = $field_type_name . "#ship_to_address|text|50^0";
$field_type_name = $field_type_name . "#ship_to_phone|text|50^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";



$search_field = "";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "group_location_id|group_location_id|select|select group_name_alias as name, group_location_id as id from master_group_location~";

$relational_txt = $relational_txt . "group_location_id|group_location_id|select|select group_name_alias as name, group_location_id as id from master_group_location~";
$relational_txt = $relational_txt . "lkpb_id|lkpb_id|select|select lkpb_no as name, lkpb_id as id from ref_lkpb~";
$relational_txt = $relational_txt . "pr_subject_id|pr_subject_id|select|select name as name, pr_subject_id as id from master_pr_subject~";
$relational_txt = $relational_txt . "pr_component_id|pr_component_id|select|select name as name, pr_component_id as id from master_pr_component~";
$relational_txt = $relational_txt . "pr_applicant_id|pr_applicant_id|select|select name as name, pr_applicant_id as id from master_pr_applicant~";

$relational_txt = $relational_txt . "status_id|status_id|select|select status_name as name, status_id as id from ref_status~";


$record_show = "purchase_request_no|PR No|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show. "group_location_id_txt|Company|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show. "lkpb_id_txt|LKPB Ref|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "update_date|Last Update|center|sort_on|link_on|datetime~";
$record_show = $record_show . "update_by_txt|Update By|center|sort_on|link_off|sub_query_off~";

$nama_table_child = "ref_purchase_request_detail";
$child_main_query = "";
$primary_id_child = "purchase_request_detail_id";
$field_name_child = "product_name,";
$field_name_child = $field_name_child . "brand,";
$field_name_child = $field_name_child . "spesification,";
$field_name_child = $field_name_child . "qty";
		   
$field_type_child = "product_name|text|50^2|Product Name";
$field_type_child = $field_type_child . "#brand|text|50^2|Brand";
$field_type_child = $field_type_child . "#spesification|text|50^3|Spesification";
$field_type_child = $field_type_child . "#qty|select|select unit_qty_id as id, name as name from master_unit_qty where is_deleted=0^2|Unit";
$field_type_child = $field_type_child . "#qty|text|50^2|Qty";

$field_child_require = "product_name,brand,spesification,qty";

$record_show_child = "product_name|Product Name|left|sort_off|sub_query_off~";
$record_show_child = $record_show_child . "brand|Brand|left|sort_off|sub_query_off~";
$record_show_child = $record_show_child . "spesification|Spesification|left|sort_off|sub_query_off~";
$record_show_child = $record_show_child . "unit_qty_id|Unit|left|sort_off|sub_query_off~";
$record_show_child = $record_show_child . "qty|Qty|left|sort_off|sub_query_off~";

//penjumlahan (SUM) utk recordlist
$record_show_sum = "";
$child_enable = "yes";
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
