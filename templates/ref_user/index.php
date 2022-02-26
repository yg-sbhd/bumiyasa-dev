<?
function opt_insertqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
	$list_txt = "update_by_txt";
	for($field=1;$field<=listLen($list_txt);$field++){
		
	}
	
}
function opt_updateqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();
	
	
}
function opt_deleteqry($id){
	global $_POST,$_GET;
	$qry=cmsDB();
}


$nama_List = "Master Table User";
$nama_table = "ref_user";
$primary_id = "user_id";
$form_map = " / Setting / Users";
$form_new_title = "New Form User";
$form_edit_title = "Edit Form User";
$field_name = "user_name,";
$field_name = $field_name . "pwd,";
$field_name = $field_name . "full_name,";
$field_name = $field_name . "group_id,";
$field_name = $field_name . "group_location_id,";
$field_name = $field_name . "functional_id,";
$field_name = $field_name . "phone,";
$field_name = $field_name . "email,";
$field_name = $field_name . "superior_id,";
$field_name = $field_name . "photo,";
$field_name = $field_name . "ttd,";
$field_name = $field_name . "status_id,";
$field_name = $field_name . "notes";

$field_alias_name = "User Name,";
$field_alias_name = $field_alias_name . "Password,";
$field_alias_name = $field_alias_name . "Full Name,";
$field_alias_name = $field_alias_name . "Group User,";
$field_alias_name = $field_alias_name . "Company / Site,";
$field_alias_name = $field_alias_name . "Functional,";
$field_alias_name = $field_alias_name . "Phone,";
$field_alias_name = $field_alias_name . "Email,";
$field_alias_name = $field_alias_name . "Superior,";
$field_alias_name = $field_alias_name . "Profil Picture,";
$field_alias_name = $field_alias_name . "Signature,";
$field_alias_name = $field_alias_name . "Status User,";
$field_alias_name = $field_alias_name . "Notes";

$field_type_name = "user_name|text|20^";
$field_type_name = $field_type_name . "#pwd|password|50^0";
$field_type_name = $field_type_name . "#full_name|text|50^0";
$field_type_name = $field_type_name . "#group_id|select|select group_id as id,group_name as name from ref_group where is_deleted=0^0";
$field_type_name = $field_type_name . "#group_location_id|select|select group_location_id as id,group_name as name from master_group_location where is_deleted=0^0";
$field_type_name = $field_type_name . "#functional_id|select|select functional_id as id,name as name from master_functional where is_deleted=0^0";
$field_type_name = $field_type_name . "#phone|text|50^0";
$field_type_name = $field_type_name . "#email|text|50^0";
$field_type_name = $field_type_name . "#superior_id|select|select user_id as id,full_name as name from ref_user where is_deleted=0 and status_id=5^0";
$field_type_name = $field_type_name . "#photo|image|50^0";
$field_type_name = $field_type_name . "#ttd|image|50^0";
$field_type_name = $field_type_name . "#status_id|select|select status_id as id, status_name as name from ref_status where is_deleted=0 and form='user'^0";
$field_type_name = $field_type_name . "#notes|textarea|50^0";

$field_required = "user_name,full_name,group_id,status_id";
$search_field = "";

$relational_txt = "update_by|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "group_id|group_id|select|select group_name as name, group_id as id from ref_group~";
$relational_txt = $relational_txt . "group_location_id|group_location_id|select|select group_name as name, group_location_id as id from master_group_location~";
$relational_txt = $relational_txt . "functional_id|functional_id|select|select name as name, functional_id as id from master_functional~";
$relational_txt = $relational_txt . "superior_id|user_id|select|select full_name as name, user_id as id from ref_user~";
$relational_txt = $relational_txt . "status_id|status_id|select|select status_name as name, status_id as id from ref_status";

$record_show = "user_name|User Name|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "full_name|Full Name|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "group_id_txt|Group|left|sort_on|link_off~";
$record_show = $record_show . "ttd|Signature|center|link_off|sort_on|image~";
$record_show = $record_show . "photo|Picture|center|link_off|sort_on|image~";
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

recordList($nama_List,$main_query,$nama_table,$primary_id,$form_map,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required,$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query,$two_form,$additionalButton,$record_show_sum,$relational_txt);
?>