<?
function opt_insertqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
	
}
function opt_updateqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
}
function opt_deleteqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
}
/*
ref_application` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_title` varchar(128) DEFAULT NULL,
  `app_session_code` char(20) DEFAULT NULL,
  `app_desc` text,
  `app_ico` varchar(128) DEFAULT NULL,
  `app_logo` varchar(128) DEFAULT NULL,
  `report_logo` varchar(128) DEFAULT NULL,
  `wide_report_header_text` varchar(128) DEFAULT NULL,
  `small_report_header_rext` varchar(128) DEFAULT NULL,
  
*/
//$main_query="select * from ista_company where is_deleted=0 ";
$main_query="";
$nama_table = "ref_application";
$primary_id = "app_id";
$secondary_id="";
$secondary_id_value=uriParam("traveler_id");

$form_type="edit_form";
$var_url = "&travpass_id=1";
$primary_id_value = "1";
$form_title = "Application Variable Form";



//$form_new_title = "New Data Company";

$field_name = "app_title,app_desc,app_session_code,app_ico,app_logo,report_logo,wide_report_header_text,small_report_header_rext";
$field_alias_name = "Application Title,Description,Session Code,Application Icon (.ico),App Logo (.png),Report Logo (.png),Wide Report Title,Small Report Title";

//comp_code,comp_name,contact_name,email,corp_id,comptype_id,other_email,parentcompany_id,phone1,phone2,fax,address1,negara_id,propinsi_id,npwp
$field_type_name = "app_title|text|50^0";
$field_type_name = $field_type_name . "#app_desc|textarea|50^0";
$field_type_name = $field_type_name . "#app_session_code|text|50^5";
$field_type_name = $field_type_name . "#app_ico|file|50^0";
$field_type_name = $field_type_name . "#app_logo|file|50^0";
$field_type_name = $field_type_name . "#report_logo|file|50^0";
$field_type_name = $field_type_name . "#wide_report_header_text|textarea|50^0";
$field_type_name = $field_type_name . "#small_report_header_rext|textarea|50^0";


$search_field = "";

$field_required="app_title,app_desc,app_session_code";
$start_variable=$var_url;
$form_variable=$var_url;
$cancel_variable="?refresh=".md5(date("mdYHis"));

formgenerator($form_type,$form_title,$main_query,$nama_table,$primary_id,$primary_id_value,$secondary_id,$secondary_id_value,$field_name,$field_alias_name,$field_type_name,$field_required,$start_variable,$form_variable,$cancel_variable);
//recordListNoPop($nama_List,$main_query,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required);

?>