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




$main_query="select * from master_group_location where group_location_id<>0 and is_deleted=0";

$nama_table = "master_group_location";

$primary_id = "group_location_id";

$nama_List = "List of Site";

$form_map = "Master Data / List of Site";

$form_new_title = "Form Add Company";

$form_edit_title = "Form Edit Company";

$field_name = "group_code,group_name,group_name_alias,group_address,npwp,npwp_address,director,telp,notes,image";

$field_alias_name = "Code,Company,Company Alias,Address,NPWP, NPWP Adress, Director, Telp, Notes,Logo";

$field_required = "group_code,group_name,group_name_alias,group_address,image";



$field_type_name = "#group_code|text|50^0";

$field_type_name = $field_type_name . "#group_name|text|50^0";

$field_type_name = $field_type_name . "#group_name_alias|text|50^0"; 

$field_type_name = $field_type_name . "#group_address|textarea|50^0"; 

$field_type_name = $field_type_name . "#npwp|text|50^0"; 

$field_type_name = $field_type_name . "#npwp_address|text|50^0"; 

$field_type_name = $field_type_name . "#director|text|50^0"; 

$field_type_name = $field_type_name . "#telp|telephone|50^0"; 



$field_type_name = $field_type_name . "#notes|textarea|50^0"; 

$field_type_name = $field_type_name . "#image|file|50^0"; 





//$field_type_name = $field_type_name . "#level_id|select|select level_id as id, level_name as name from ref_prv_level^0";





$search_field = "group_code,group_name";

$record_show = "group_code|Code|left|sort_on|link_on|sub_query_off~";

$record_show = $record_show . "group_name|Company|left|sort_on|link_off|sub_query_off~";

$record_show = $record_show . "group_name_alias|Company Alias|left|sort_on|link_off|sub_query_off~";

$record_show = $record_show . "update_date|Last Update|left|sort_on|link_off|sub_query_off~";

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



recordListNoPop($nama_List,$main_query,$nama_table,$primary_id,$form_map,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required,$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query,$two_form,$additionalButton,$record_show_sum);

