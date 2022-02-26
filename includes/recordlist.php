<?
function _checkauth($name){
	//echo "string";
	global $ANOM_VARS,$_POST,$_GET,$_SESSION;	
	$checkauth=cmsDB();
	$tmp=decryptStringArray(uriParam("tmp"));
	$checkauth->query("select auth_id from ref_authorization where auth_name='".$name."' and tmp='".$tmp."'");
	$checkauth->next();
	$auth=$checkauth->row("auth_id");
	//echo "select auth_id from ref_authorization where auth_name='".$name."' and tmp='".$tmp."'<BR>".$_SESSION["auth_id" . date("mdY")] ."<BR>".$auth;
	if(listFind($_SESSION["auth_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] ,$auth)){
		return true;
	}else{
		return false;
	}
}

function _checkauth_index($name, $tmp){
	//echo "string";
	global $ANOM_VARS,$_POST,$_GET,$_SESSION;	
	$checkauth=cmsDB();
	$tmp=$tmp;
	$checkauth->query("select auth_id from ref_authorization where auth_name='".$name."' and tmp='".$tmp."'");
	$checkauth->next();
	$auth=$checkauth->row("auth_id");
	//echo "select auth_id from ref_authorization where auth_name='".$name."' and tmp='".$tmp."'<BR>".$_SESSION["auth_id" . date("mdY")] ."<BR>".$auth;
	if(listFind($_SESSION["auth_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] ,$auth)){
		return true;
	}else{
		return false;
	}
}

function recordList($nama_List,$main_query,$nama_table,$primary_id,$form_map,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required,$nama_table_child,$primary_id_child,$field_type_child,$field_child_require,$field_name_child,$record_show_child,$child_enable,$child_main_query,$two_form,$additionalButton,$record_show_sum,$relational_txt){
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

	if(isset($_GET["insert_child"])){
		$get_primary_id = listGetAt($_SERVER["QUERY_STRING"],3,"&");
		$_primary_id = listGetAt($get_primary_id,1,"=");
		$strsql = "insert into ".$nama_table_child."(".$field_name_child.",insert_date,insert_by,update_date,update_by,".$_primary_id.")values(";
		$lstvalue = "";
		for ($field=1; $field<=listLen($field_name_child) ; $field++) { 
			$fname=listGetAt($field_name_child,$field);
			$ftype_org=listGetAt($field_type_child,$field,"#");
			$ftype=listGetAt($ftype_org,2,"|");

			if($ftype=="file"){
				$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
				$uploadfile = $uploaddir . "upload" . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload" . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
					$file_doc = $uploadfile_alias;
				} else {
					$file_doc = "";
				}
				
				$lstvalue = listAppend($lstvalue,"'".$file_doc."'");
			}elseif($ftype=="multiselect"){
				if (!empty($_POST[$fname])) {
					$strlist = "";
					foreach ($_POST[$fname] as $names)
					{
						$strlist = listAppend($strlist,$names);
					}
					$lstvalue = listAppend($lstvalue,"'".$strlist."'");
				}else{
					$lstvalue = listAppend($lstvalue,"'0'");
				}
			}elseif($ftype=="geotag"){
				include 'geotaging_extractor.php';
				$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
				$uploadfile = $uploaddir . "upload_".$nama_table . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload_".$nama_table . "_" .  date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
					$file_doc = $uploadfile_alias;
				} else {
					$file_doc = "";
				}
				
				if(strtolower(listLast($_FILES[$fname]['name'],"."))=="jpg"){
					include 'includes/phpmetadata/EXIF.php';
					$target = $uploaddir . $file_doc;
					$exif_data = get_EXIF_JPEG($target);
			
					$imagepath = $target;
					$save = $target; //This is the new file you saving
			
					list($width, $height) = getimagesize($target);
			
					$ratio = $width/$height; // width/height
					if( $ratio > 1) {
						$modwidth = 500;
						$modheight = 500/$ratio;
					} else {
						$modwidth = 500*$ratio;
						$modheight = 500;
					}
					
					$tn = imagecreatetruecolor($modwidth, $modheight) ;
					$image = imagecreatefromjpeg($target) ;
					imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
			
					imagejpeg($tn, $save, 80) ;
					$jpeg_header_data = get_jpeg_header_data( $target );
			
					$jpeg_header_data = put_EXIF_JPEG( $exif_data, $jpeg_header_data );
					put_jpeg_header_data( $save, $target, $jpeg_header_data );
					
				}else{
					echo "<script>alert('JPG Format & Geo Tag Please..');history.back();</script>";die();
				}
				
				if(strlen($file_doc)){
					$file_name = $ANOM_VARS["www_file_path"] . 'upload_photo/'. $file_doc;
					$geo = new geotaging_extractor();
					$result = $geo->getCoordinates($file_name);
					
					if( $result !== FALSE )
					{
						$lat = $result[0];
						$lon = $result[1];
						$lstvalue = listAppend($lstvalue,"'".$file_doc."'");
						$lstvalue = listAppend($lstvalue,"'".$lon."'");
						$lstvalue = listAppend($lstvalue,"'".$lat."'");
						
					}else{
						echo "<script>alert('No Geo Tag in Uploaded Photo..');history.back();</script>";die();
					}
				}else{
					echo "<script>alert('Photo Can not be uploaded..');history.back();</script>";die();
				}
			}elseif($ftype=="geoval"){	
				//ignore, sudah di isi diatas
			
			}elseif($ftype=="date"){
				$date_org = $_POST[$fname];
				$year=listGetAt($date_org,3,"/");
				$month=listGetAt($date_org,2,"/");
				$day=listGetAt($date_org,1,"/");
				$date_fix=$year . "-" . $month . "-".$day." 00:00:00";
				$lstvalue = listAppend($lstvalue,"'".$date_fix."'");
				
			}elseif($ftype=="auto-text"){
				$autotext->query("update ref_numbering set max_no=max_no+1 where num_id=".$autonum);
				$fname = listGetAt($field_name_child,$field);
				$lstvalue = listAppend($lstvalue,"'".postParamSimple($fname)."'");
				
			}elseif($ftype=="maps"){
				$coord=str_replace("}","",postParamSimple($fname));
				$lon=listGetAt(listGetAt($coord,2),2,":");
				$lat=listGetAt(listGetAt($coord,1),2,":");
				$lstvalue = listAppend($lstvalue,"'".$lon."'");
				$lstvalue = listAppend($lstvalue,"'".$lat."'");
				
			}elseif($ftype=="number" || $ftype=="number1" || $ftype=="number-readonly"){
				$valnumber = str_replace(",", "",$_POST[$fname]);
				$lstvalue = listAppend($lstvalue,"'".$valnumber."'");
				
			}else{
				$fname = listGetAt($field_name_child,$field);
				$lstvalue = listAppend($lstvalue,"'".postParamSimple($fname)."'");
			}
		}
		$strsql = $strsql . $lstvalue;
		$strsql = $strsql .",'".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")].", '".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")].", '".uriParam($_primary_id)."')";
		//echo $strsql;die();
		
		if(uriParam("tmp") == 'templates/penjualan/jual_langsung.php' || uriParam("tmp") == 'templates/penjualan/sales_order.php' || uriParam("tmp") == 'templates/penjualan/invoice/invoice.php' || uriParam("tmp") == 'templates/penjualan/pembayaran/pembayaran_invoice.php' ){
			opt_correction_qry_child_insert();
		}
		
		$user->query($strsql);
		$maxID=$user->lastInsertID();
		opt_insertqrychild($maxID);
		// echo "<script>alert('Record Saved..!');location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&edit=yes&".$_primary_id."=".uriParam($_primary_id)."&refresh=".md5("mdYHis")."#child';</script>";
		echo "<script>alert('Record Saved..!');location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."#child';</script>";
		die();

	}

	include_once "_functions/crud/crud_modal/create_func.php";

	if(isset($_GET["update_child"])){
		$get_primary_id = listGetAt($_SERVER["QUERY_STRING"],3,"&");
		$_primary_id = listGetAt($get_primary_id,1,"=");

		$strsql = "update ".$nama_table_child." set ";
		$lstvalue = "";
		for($field=1;$field<=listLen($field_name_child);$field++){
			$fname = listGetAt($field_name_child,$field);
			$ftype_org= listGetAt($field_type_child,$field,"#");
			$ftype = listGetAt($ftype_org,2,"|");
			if($ftype=="file"){
				$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
				$uploadfile = $uploaddir . "upload_".$nama_table_child . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload_".$nama_table_child . "_" .  date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				
				if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
					//echo "File is valid, and was successfully uploaded.\n";
					$file_doc = $uploadfile_alias;
				} else {
					$file_doc = "";
				}
				if(strlen($file_doc)){
					$lstvalue = listAppend($lstvalue,$fname."='".$file_doc."'");
				}
				
			}elseif($ftype=="multiselect"){
				if (!empty($_POST[$fname])) {
					$strlist = "";
					foreach ($_POST[$fname] as $names)
					{
						$strlist = listAppend($strlist,$names);
					}
					$lstvalue = listAppend($lstvalue,$fname."='".$strlist."'");
				}else{
					$lstvalue = listAppend($lstvalue,$fname."='0'");
				}
			}elseif($ftype=="geotag"){
				include 'geotaging_extractor.php';
				//echo "masuk<BR>";
				$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
				$uploadfile = $uploaddir . "upload_".$nama_table_child . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload_".$nama_table_child . "_" .  date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
					//echo "File is valid, and was successfully uploaded.\n";
					$file_doc = $uploadfile_alias;
					if(strtolower(listLast($_FILES[$fname]['name'],"."))=="jpg"){
						include 'includes/phpmetadata/EXIF.php';
						$target = $uploaddir . $file_doc;
						$exif_data = get_EXIF_JPEG($target);
				
						$imagepath = $target;
						$save = $target;; //This is the new file you saving
				
						list($width, $height) = getimagesize($target);
				
						$ratio = $width/$height; // width/height
						if( $ratio > 1) {
							$modwidth = 500;
							$modheight = 500/$ratio;
						} else {
							$modwidth = 500*$ratio;
							$modheight = 500;
						}
						
						$tn = imagecreatetruecolor($modwidth, $modheight) ;
						$image = imagecreatefromjpeg($target) ;
						imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
				
						imagejpeg($tn, $save, 80) ;
						$jpeg_header_data = get_jpeg_header_data( $target );
				
						$jpeg_header_data = put_EXIF_JPEG( $exif_data, $jpeg_header_data );
						put_jpeg_header_data( $save, $target, $jpeg_header_data );
				
						//list($lat,$lng,$dtaken)=getCoordinates($target);
						/*if($mdebug==1) echo " lat : ".$lat." - lon : ".$lng." - dtaekn : ".gmdate("Y-m-d H:i:s", $dtaken)."<br>";
						$strf .= " lon, lat, dpic, ";
						$strf_isi .= "'".$lng."', '".$lat."', '".gmdate("Y-m-d H:i:s", $dtaken)."', ";*/
					}else{
						echo "<script>alert('JPG Format & Geo Tag Please..');history.back();</script>";die();
					}
					if(strlen($file_doc)){
						$file_name = $ANOM_VARS["www_file_path"] . 'upload_photo/'. $file_doc;
						$geo = new geotaging_extractor();
						$result = $geo->getCoordinates($file_name);
						
						if( $result !== FALSE )
						{
							$lat = $result[0];
							$lon = $result[1];
							$lonfile = listGetAt($fname,1,"_") . "_lon";
							$latfile = listGetAt($fname,1,"_") . "_lat";
							$lstvalue = listAppend($lstvalue,$fname."='".$file_doc."'");
							$lstvalue = listAppend($lstvalue,$lonfile."='".$lon."'");
							$lstvalue = listAppend($lstvalue,$latfile."='".$lat."'");
							
						}else{
							echo "<script>alert('No Geo Tag in Uploaded Photo..');history.back();</script>";die();
						}
					}else{
						
					}
					
				} else {
					$file_doc = "";
				}
				
				
				
				//echo $file_doc ."---";
				
			}elseif($ftype=="geoval"){	
				//ignore, sudah di isi diatas
			//}elseif($ftype=="number"){
				//$v_number = str_replace(",","",$_POST[$fname]);
				//$lstvalue = listAppend($lstvalue,"'".$v_number."'");
			}elseif($ftype=="date"  || $ftype=="date-readonly"){
				$date_org = $_POST[$fname];
				$year=listGetAt($date_org,3,"/");
				$month=listGetAt($date_org,2,"/");
				$day=listGetAt($date_org,1,"/");
				$date_fix=$year . "-" . $month . "-".$day." 00:00:00";
				$lstvalue = listAppend($lstvalue,$fname."='".$date_fix."'");
			}elseif($ftype=="maps"){
				$coord=str_replace("}","",postParamSimple($fname));
				$lon=listGetAt(listGetAt($coord,2),2,":");
				$lat=listGetAt(listGetAt($coord,1),2,":");
				$lstvalue = listAppend($lstvalue,"lon='".$lon."'");
				$lstvalue = listAppend($lstvalue,"lat='".$lat."'");
				
			}elseif($ftype=="number" || $ftype=="number1" || $ftype=="number-readonly"  || $ftype=="number_otorisasi"){
				$valnumber = str_replace(",", "",$_POST[$fname]);
				$lstvalue = listAppend($lstvalue,$fname."='".$valnumber."'");
			}else{
				$lstvalue = listAppend($lstvalue,$fname."='".postParamSimple($fname)."'");
			}
		}
		$strsql = $strsql . $lstvalue;
		$strsql = $strsql . ",update_date='".date("Y-m-d H:i:s")."',update_by=".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
		$strsql = $strsql . " where ".$primary_id_child ."=".postParam($primary_id_child);
		//echo $strsql;die();
		
		if(uriParam("tmp") == 'templates/penjualan/jual_langsung.php' || uriParam("tmp") == 'templates/penjualan/sales_order.php' || uriParam("tmp") == 'templates/penjualan/invoice/invoice.php' || uriParam("tmp") == 'templates/penjualan/pembayaran/pembayaran_invoice.php' ){
			opt_correction_qry_child_edit(postParam($primary_id_child));
		}
		$user->query($strsql);
		opt_updateqrychild(postParam($primary_id_child));
		echo "<script>alert('Data Successfully Updated..');location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&edit=yes&".$_primary_id."=".uriParam($_primary_id)."&refresh=".md5("mdYHis")."#child';</script>";die();
		
	}

	include_once "_functions/crud/crud_modal/edit_func.php";

	include_once "_functions/crud/crud_modal/delete_func.php";


	if(isset($_GET["delete_child"])){
		$strsql = "update ".$nama_table_child." set is_deleted=1,delete_date='".date("Y-m-d H:i:s")."',delete_by=".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]." where ".$primary_id_child."=".uriParam($primary_id_child);
		$user->query($strsql);
	    opt_deletchildeqry(uriParam($primary_id_child));
		echo "<script>alert('Data Successfully Updated..');location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&edit=yes&".$primary_id."=".uriParam($primary_id)."&refresh=".md5("mdYHis")."#child';</script>";die();
	}

	


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
	<?}
	if(listLen($field_child_require)){
	?>
		<script type="text/javascript">
			function _cekChildValid(frm){
				<?
				for($req=1;$req<=listLen($field_child_require);$req++){
					$nmfield=listGetAt($field_child_require,$req);
					//$f_name = listGetAt(listGetAt($field_type_child,$req,"#"),1,"|");
					$posfield=listFind($field_name_child,$nmfield);					
					$posfield_alias=listGetAt(listGetAt($field_type_child,$posfield,"#"),4,"|");
					?>
					if(frm.<?=trim($nmfield)?>.value==''){ 
						alert('Please Input <?=$posfield_alias?>');
						frm.<?=trim($nmfield)?>.focus();
						return false;
					}
					<?
				}
				?>
				frm.submit();
			}
		</script>
	<?}?>
	
	
<?	include "_functions/crud/crud_modal/create.php";?>
	
<?	include "_functions/crud/crud_modal/edit.php";?>

<?if(!isset($_GET["edit"]) && !isset($_GET["new_form"])){?>	
	<?	include "_functions/crud/crud_modal/read.php";?>
		
<?}?>
	         </div>
	 
	
	

	<?}?>
<?}?>

