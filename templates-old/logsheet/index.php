<?

function opt_insertqry($maxID){

	global $_POST,$_GET;

	$qry=cmsDB();

	$qry->query("select date, jam from ref_logsheet where logsheet_id=".$maxID);

	$qry->next();

	$query= "update ref_logsheet set date_jam='".$qry->row('date')." ".$qry->row('jam')."' where logsheet_id=".$maxID;

	$qry->query($query);

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

	global $ANOM_VARS,$_POST,$_GET,$_SESSION;

	$qry=cmsDB();

}

function opt_updateqrychild($id){

	global $ANOM_VARS,$_POST,$_GET,$_SESSION;

	$qry=cmsDB();

}



function opt_correction_qry_child_insert(){

	global $_POST,$_GET;

	$qry=cmsDB();

}



function opt_correction_qry_child_edit($id){

	global $_POST,$_GET;

	$qry=cmsDB();

}



function opt_deletchildeqry($maxID){

	global $ANOM_VARS,$_POST,$_GET,$_SESSION;

	$qry=cmsDB();

}



$qry = cmsDB();



$user_id 			= $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")];

$group_id 			= $_SESSION["group_id_".$ANOM_VARS["app_session_code"]  . date("mdY")];

$group_location_id 	= $_SESSION["group_location_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];



$qry->query("select position from master_group_location where group_location_id=".$group_location_id);

$qry->next();



if($group_id == 3){

	$query = "select * from ref_logsheet where is_deleted=0";

	$query_select = "";

}



if($group_id <> 3){

	if($qry->row("position") == "Site"){



		$query = "select * from ref_logsheet where is_deleted=0 and group_location_id=".$group_location_id;

		// if($group_id == 18){ //site manager

		// 	$query .= " and insert_by =".$user_id." or status_id in (1,2,4)";	

		// }



		// if($group_id == 19){ //site wakil manager

		// 	$query .= " and insert_by =".$user_id." or status_id in (3,4)";	

		// }

	}



	$query_select = " and group_location_id in (".$group_location_id.")";

}



$nama_List = "Logsheet";

$main_query= $query;

$nama_table = "ref_logsheet";

$primary_id = "logsheet_id";

$form_new_title = "Form Add Logsheet";

$form_edit_title = "Form Edit Logsheet";



$field_name = "group_location_id,";

$field_name = $field_name . "unit_id,";

$field_name = $field_name . "date,";

$field_name = $field_name . "jam,";

$field_name = $field_name . "kontrol_20kv_load_kw,";

$field_name = $field_name . "kontrol_20kv_arus_a,";

$field_name = $field_name . "kontrol_20kv_tegangan_kv,";

$field_name = $field_name . "kontrol_20kv_cos_q,";

$field_name = $field_name . "kontrol_generator_63_kv_load_kw,";

$field_name = $field_name . "kontrol_generator_63_kv_kvar,";

$field_name = $field_name . "kontrol_generator_63_kv_kva,";

$field_name = $field_name . "kontrol_generator_63_kv_arus_a_i1,";

$field_name = $field_name . "kontrol_generator_63_kv_arus_a_i2,";

$field_name = $field_name . "kontrol_generator_63_kv_arus_a_i3,";

$field_name = $field_name . "kontrol_generator_63_kv_tegangan_volt_rs,";

$field_name = $field_name . "kontrol_generator_63_kv_tegangan_volt_st,";

$field_name = $field_name . "kontrol_generator_63_kv_tegangan_volt_rt,";

$field_name = $field_name . "kontrol_generator_63_kv_freq_hz,";

$field_name = $field_name . "kontrol_exec_arus_exc,";

$field_name = $field_name . "kontrol_governor_temperatur_gav_open,";

$field_name = $field_name . "kontrol_governor_temperatur_press_oil,";

$field_name = $field_name . "kontrol_governor_temperatur_bearing_1,";

$field_name = $field_name . "kontrol_governor_temperatur_bearing_2,";

$field_name = $field_name . "kontrol_governor_temperatur_bearing_3,";

$field_name = $field_name . "kontrol_governor_temperatur_bearing_4,";

$field_name = $field_name . "kontrol_governor_temperatur_bearing_5,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_1,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_2,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_3,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_4,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_5,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_6,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_7,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_8,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_9,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_10,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_11,";

$field_name = $field_name . "kontrol_governor_temperatur_generator_12,";

$field_name = $field_name . "kontrol_governor_temperatur_baterai_a,";

$field_name = $field_name . "kontrol_governor_temperatur_baterai_v,";

$field_name = $field_name . "kontrol_governor_temperatur_suhu_ruang_gen,";

$field_name = $field_name . "kontrol_governor_temperatur_suhu_ruang,";

$field_name = $field_name . "kontrol_governor_temperatur_air_comp,";

$field_name = $field_name . "kontrol_governor_temperatur_trafo_c,";

$field_name = $field_name . "kontrol_governor_temperatur_water_level,";

$field_name = $field_name . "kontrol_governor_temperatur_gate_van,";

$field_name = $field_name . "kontrol_governor_temperatur_oil_tank_pressure,";

$field_name = $field_name . "kontrol_governor_temperatur_penstock_pressure,";

$field_name = $field_name . "kontrol_pressure_turbin_trubin_mpa,";

$field_name = $field_name . "kontrol_pressure_turbin_draft_tube_cm_hg,";

$field_name = $field_name . "kontrol_pressure_turbin_axial_mpa,";

$field_name = $field_name . "kontrol_pressure_turbin_cooling_mpa";





$field_alias_name = "Company,";

$field_alias_name = $field_alias_name . "Unit,";

$field_alias_name = $field_alias_name . "Date,";

$field_alias_name = $field_alias_name . "Hour,";

$field_alias_name = $field_alias_name . "<b>[KONTROL 20 kV]</b> Load KW,";

$field_alias_name = $field_alias_name . "<b>[KONTROL 20 kV]</b> Arus (A),";

$field_alias_name = $field_alias_name . "<b>[KONTROL 20 kV]</b> Tegangan (kV),";

$field_alias_name = $field_alias_name . "<b>[KONTROL 20 kV]</b> COS Q,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> Load kW,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> kVAR,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> kVA,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> Arus (A) <br /> I1,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> Arus (A) <br /> I2,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> Arus (A) <br /> I3,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> TEGANGAN (Volt) R-S,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> TEGANGAN (Volt) S-T,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> TEGANGAN (Volt) R-T,";

$field_alias_name = $field_alias_name . "<b>[KONTROL GENERATOR 6.3 kV]</b> Frequence Hz,";

$field_alias_name = $field_alias_name . "<b>[KONTROL EXC.]</b> Arus Exc.,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Gov Open,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Press Oil,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> BEARING 1,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> BEARING 2,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> BEARING 3,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> BEARING 4,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> BEARING 5,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 1,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 2,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 3,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 4,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 5,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 6,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 7,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 8,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 9,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 10,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 11,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> GENERATOR 12,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Baterai A,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Baterai V,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Suhu Ruang Generator,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Suhu Ruang,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Air Comp,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Trafo (C),";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Water Lavel,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Gate Van,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Oil Tank Pressure,";

$field_alias_name = $field_alias_name . "<b>KONTROL GOVERNOR & TEMPERATUR</b> <br /> Penstock Pressure,";

$field_alias_name = $field_alias_name . "<b>KONTROL PRESSURE TURBIN</b> <br /> Turbin (MPa),";

$field_alias_name = $field_alias_name . "<b>KONTROL PRESSURE TURBIN</b> <br /> Draft tube (Cm Hg),";

$field_alias_name = $field_alias_name . "<b>KONTROL PRESSURE TURBIN</b> <br /> Axial (MPa),";

$field_alias_name = $field_alias_name . "<b>KONTROL PRESSURE TURBIN</b> <br /> Cooling (MPa)";





if($group_id==3){

	$field_type_name = "group_location_id|select|select group_location_id as id, group_name as name from master_group_location where is_deleted=0".$query_select."^0"; 

}else{

	$field_type_name = "group_location_id|select-read|select group_location_id as id, group_name as name from master_group_location where is_deleted=0".$query_select."^0"; 

}



$field_type_name = $field_type_name . "#unit_id|select|select unit_id as id, unit_name as name from master_unit^0";

if($group_id==3){
	$field_type_name = $field_type_name . "#date|date|50^0";
	$field_type_name = $field_type_name . "#jam|time|50^0";
}else{
	$field_type_name = $field_type_name . "#date|date-readonly|50^0";
	$field_type_name = $field_type_name . "#jam|time-readonly|50^0";
}

$field_type_name = $field_type_name . "#kontrol_20kv_load_kw|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_20kv_arus_a|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_20kv_tegangan_kv|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_20kv_cos_q|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_load_kw|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_kvar|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_kva|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_arus_a_i1|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_arus_a_i2|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_arus_a_i3|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_tegangan_volt_rs|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_tegangan_volt_st|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_tegangan_volt_rt|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_generator_63_kv_freq_hz|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_exec_arus_exc|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_gav_open|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_press_oil|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_bearing_1|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_bearing_2|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_bearing_3|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_bearing_4|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_bearing_5|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_1|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_2|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_3|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_4|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_5|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_6|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_7|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_8|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_9|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_10|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_11|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_generator_12|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_baterai_a|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_baterai_v|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_suhu_ruang_gen|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_suhu_ruang|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_air_comp|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_trafo_c|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_water_level|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_gate_van|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_oil_tank_pressure|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_governor_temperatur_penstock_pressure|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_pressure_turbin_trubin_mpa|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_pressure_turbin_draft_tube_cm_hg|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_pressure_turbin_axial_mpa|decimal|50^0";

$field_type_name = $field_type_name . "#kontrol_pressure_turbin_cooling_mpa|decimal|50^0";



















// $field_type_name = $field_type_name . "#6|text|50^0";

// $field_type_name = $field_type_name . "#7|text|50^0";

// $field_type_name = $field_type_name . "#8|text|50^0";

// $field_type_name = $field_type_name . "#9|text|50^0";

// $field_type_name = $field_type_name . "#10|text|50^0";

// $field_type_name = $field_type_name . "#11|text|50^0";

// $field_type_name = $field_type_name . "#12|text|50^0";

// $field_type_name = $field_type_name . "#13|text|50^0";

// $field_type_name = $field_type_name . "#14|text|50^0";

// $field_type_name = $field_type_name . "#15|text|50^0";

// $field_type_name = $field_type_name . "#16|text|50^0";

// $field_type_name = $field_type_name . "#17|text|50^0";

// $field_type_name = $field_type_name . "#18|text|50^0";

// $field_type_name = $field_type_name . "#19|text|50^0";

// $field_type_name = $field_type_name . "#20|text|50^0";

// $field_type_name = $field_type_name . "#21|text|50^0";

// $field_type_name = $field_type_name . "#22|text|50^0";

// $field_type_name = $field_type_name . "#23|text|50^0";

// $field_type_name = $field_type_name . "#24|text|50^0";

// $field_type_name = $field_type_name . "#25|text|50^0";

// $field_type_name = $field_type_name . "#26|text|50^0";

// $field_type_name = $field_type_name . "#27|text|50^0";

// $field_type_name = $field_type_name . "#28|text|50^0";

// $field_type_name = $field_type_name . "#29|text|50^0";

// $field_type_name = $field_type_name . "#30|text|50^0";

// $field_type_name = $field_type_name . "#31|text|50^0";

// $field_type_name = $field_type_name . "#32|text|50^0";

// $field_type_name = $field_type_name . "#33|text|50^0";

// $field_type_name = $field_type_name . "#34|text|50^0";

// $field_type_name = "project_id|select|select project_id as id, concat(project_code , ' - ', project_name) as name from p_project where is_deleted=0 and project_id in (".$lstprojectid.")^5";

// $field_type_name = $field_type_name . "#target_code|text-readonly|50^5";

// $field_type_name = $field_type_name . "#target_name|text|50^5";

// $field_type_name = $field_type_name . "#target_desc|textarea|50^5";

// $field_type_name = $field_type_name . "#target_attach|file|50^5 order by user_name";

// //$field_type_name = $field_type_name . "#pic|select|select user_id as id, user_name as name from ref_user^5";

// $field_type_name = $field_type_name . "#status_id|select-read|select status_id as id, status_name as name from ref_status^5";



// $search_field = "group_location_id";

// $record_show = "group_location_id|Company|center|sort_off|link_on|sub_query_off~";

// $field_required = "group_location_id,date,jam";



$search_field = "group_location_id,date";



$record_show = "group_location_id|Company|center|sort_on|link_on|sub_query_off~";

$record_show = $record_show . "unit_id|Unit|center|sort_on|link_on|sub_query_off~";

$record_show = $record_show . "date|Month|center|sort_on|link_off|sub_query_off~";

// $record_show = $record_show . "jam|Hour|center|sort_off|link_off|sub_query_off~";



// $record_show = $record_show . "target_name|Target Name|left|sort_off|link_on|sub_query_off~";

// $record_show = $record_show . "project_id|Project Name|left|sort_off|link_off|sub_query_off~";

//$record_show = $record_show . "full_name|Project Leader|center|sort_off|link_off|

				//select full_name  from ref_user 

				//inner join p_project on ref_user.user_id=p_project.project_lead#full_name-text~";

//$record_show = $record_show . "project_lead|Project Leader|left|sort_off|link_off|sub_query_off~";

//$record_show = $record_show . "start_date|Start date|center|sort_off|link_off|sub_query_off~";

//$record_show = $record_show . "end_date|End Date|center|sort_off|link_off|sub_query_off~";

// $record_show = $record_show . "status_id|Status|center|sort_off|link_off|sub_query_off~";

$field_required = "group_location_id,unit_id,date";



// $field_required="project_id,target_name,target_desc";





/* Child Chapter */

/*$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query*/

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

