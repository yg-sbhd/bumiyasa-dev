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



$nama_List = "Component Purchase Request";

$main_query="";

$nama_table = "master_pr_component";

$primary_id = "pr_component_id";

$form_map = " / Master Data / Purchase Request / Master Component PR";

$form_new_title = "Form Add Component Purchase Request";

$form_edit_title = "Form Edit Component Purchase Request";

$field_name = "name,review_user_id,approve_user_id,notes";

$field_alias_name = "Name,User Review,User Approve,Notes";

$field_required = "name,review_user_id,approve_user_id";



$field_type_name = "name|text|50^0";

$field_type_name = $field_type_name . "#review_user_id|select|select user_id as id, full_name as name from ref_user where is_deleted=0 and status_id=5^0";

$field_type_name = $field_type_name . "#approve_user_id|select|select user_id as id, full_name as name from ref_user where is_deleted=0 and status_id=5^0";

$field_type_name = $field_type_name . "#notes|textarea|50^0";


$search_field = "";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "review_user_id|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "approve_user_id|user_id|select|select full_name as name, user_id as id from ref_user~";


$record_show = "name|Name|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show. "review_user_id_txt|User Reviewer|left|sort_on|link_off|sub_query_off~";
$record_show = $record_show. "approve_user_id_txt|User Approver|left|sort_on|link_off|sub_query_off~";
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



recordList($nama_List,$main_query,$nama_table,$primary_id,$form_map,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required,$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query,$two_form,$additionalButton,$record_show_sum,$relational_txt);

