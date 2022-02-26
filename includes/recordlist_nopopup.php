<?
// function recordListNoPop($nama_List,$main_query,$nama_table,$primary_id,$form_map,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required,$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query,$two_form,$additionalButton,$record_show_sum,$relational_txt){

function recordListNoPop($nama_List,$main_query,$nama_table,$primary_id,$form_map,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,
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
){
global $ANOM_VARS,$_POST,$_GET,$_SESSION;
//echo $field_type_name."<P>";
$popupmax = ListValueCount($field_type_name,"selectpopup","|");
//echo "Jumlah Popup : ".$popupmax;
if(isset($_GET["print_recordlist"]) && uriParam("print_recordlist")=="yes"){
	recordListPrint($nama_List,$main_query,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required);
}else{
	$jml_tgl = ListValueCount($field_type_name,"date","|");
	$user=cmsDB();
	$select_table = cmsDB();
	$item=cmsDB();
	$status=cmsDB();
	$autotext=cmsDB();
	$autotext2=cmsDB();
	$qchild=cmsDB();
	$search=cmsDB();
	
	//Query User Admin
	//echo $field_type_name;
	if(isset($_GET['insert_total_production']) && $_GET['insert_total_production'] == 'yes'){
  		$group_location_id = $_SESSION["group_location_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
  		// echo "string sinin";
		edit_production_kwh($group_location_id, postParamSimple('production'), postParamSimple('date_production'), postParam('start_time'), postParam('end_time'));

		echo "<script>location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&new_form=yes&refresh=".md5("mdYHis")."#child';</script>";
		die();

	}

	if(isset($_GET['update_total_production']) && $_GET['update_total_production'] == 'yes'){
  		// $group_location_id = $_SESSION["group_location_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
  		// echo "string sinin";
		edit_production_kwh(postParam('group_location_id'), postParamSimple('production'), postParamSimple('date_production'), postParam('start_time'), postParam('end_time'));
		
		// die();
		echo "<script>location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."#child';</script>";
		die();

	}
	

	include_once "_functions/crud/crud/create_func.php";

	

	include_once "_functions/crud/crud/edit_func.php";

	include_once "_functions/crud/crud/delete_func.php";



	


	?>
	
	<?if(listLen($field_required)){?>
		<script>
		function _cekValid(frm){
			//alert("test : ");
		<?
		for($req=1;$req<=listLen($field_required);$req++){
			$nmfield=listGetAt($field_required,$req);
			$posfield=listFind($field_name,$nmfield);
			$ftype=listGetAt(listGetAt($field_type_name,$posfield),2,"|");
			$posfield_alias=listGetAt($field_alias_name,$posfield);
			?>
			<?if(!isset($_GET["edit"])){?>
				if(frm.<?=trim($nmfield)?>.value==''){ 
					alert('Please Input <?=$posfield_alias?> !'); 
					frm.<?=trim($nmfield)?>.focus();
					return false;
				}
			<? }?>
		<? }?>
		
		
		var getURLs = document.location.href;
		
		if(getURLs.search("produksi.php")>0 && getURLs.search("editchild")>0){
			if(frm.out_volume.value>frm.trx_stok_akhir_vol.value){
				alert('Value Volume Digunakan Melebihi Stok Akhir');
				frm.out_volume.focus();
				return false;
			}if(frm.out_berat.value>frm.trx_stok_akhir_brt.value){
			alert('Value Berat Digunakan Melebihi Stok Akhir');
				frm.out_berat.focus();
				return false;
			}if(frm.out_jumlah.value>frm.trx_stok_akhir_jml.value){
			alert('Value Jumlah Digunakan Melebihi Stok Akhir');
				frm.out_berat.focus();
				return false;
			}
		}

			frm.submit();
		}
		</script>
	<?}?>
	
	
<?	include "_functions/crud/crud/create.php";?>
	
<?	include "_functions/crud/crud/edit.php";?>

<?if(!isset($_GET["edit"]) && !isset($_GET["new_form"])){?>
	<?	include "_functions/crud/crud/read.php";?>
		
<?}?>
	         </div>
	 
	
	

	<?}?>
<?}?>

