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

function recordListReg($nama_List,$main_query,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required,$two_form){
global $ANOM_VARS,$_POST,$_GET,$_SESSION;
$jml_tgl = ListValueCount($field_type_name,"date","|");
$user=cmsDB();
$select_table = cmsDB();
$item=cmsDB();
$status=cmsDB();
$autotext=cmsDB();
$autotext2=cmsDB();
$qchild=cmsDB();
$search=cmsDB();
$log_query = cmsDB();
$showdata= cmsDB();
$showdata2= cmsDB();
$showdata_= cmsDB();
$showdata2_= cmsDB();
//Query User Admin
//echo $field_type_name;

//QUERY INSERT
if(isset($_GET["insert"])){
	if(listFind($field_name,"maps")){
		$posmap=listFind($field_name,"maps");
		$field_nameupdate=ListSetAt($field_name,$posmap,"lon,lat"); 
		$strsql = "insert into ".$nama_table."(".$field_nameupdate.",insert_date,insert_by,update_date,update_by) values(";
	}else{
		$strsql = "insert into ".$nama_table."(".$field_name.",insert_date,insert_by,update_date,update_by) values(";
	}
	$lstvalue = "";
	
	for($field=1;$field<=listLen($field_name);$field++){
		$fname = listGetAt($field_name,$field);
		$ftype_org= listGetAt($field_type_name,$field,"#");
		$ftype = listGetAt($ftype_org,2,"|");
		$autonum = listGetAt($ftype_org,3,"|"); 
		$autonum = listGetAt($autonum,2,"^");//auto number id
		if($ftype=="file"){
			if(strlen($_FILES[$fname]['name'])){
				$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_files/';
				$uploadfile = $uploaddir . "upload" . "_".$fname."_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload" . "_" .$fname."_". date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
					//echo "File is valid, and was successfully uploaded.\n";
					$file_doc = $uploadfile_alias;
				} else {
					echo "<script>alert('File Too Big, Poor Connection to upload that file Size..');history.back();</script>";
					die();
					$file_doc = "";
				}
			}else{
					$file_doc = "";
			}
			$lstvalue = listAppend($lstvalue,"'".$file_doc."'");
			
		
		}elseif($ftype=="multiselect"){
			
			$strlist = "";
			foreach ($_POST[$fname] as $names)
			{
				$strlist = listAppend($strlist,$names);
			}
			$lstvalue = listAppend($lstvalue,"'".$strlist."'");
			
		}elseif($ftype=="geotag"){
			include 'geotaging_extractor.php';
			//echo "masuk<BR>";
			$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
			$uploadfile = $uploaddir . "upload_".$nama_table . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
			$uploadfile_alias = "upload_".$nama_table . "_" .  date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
			if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
				//echo "File is valid, and was successfully uploaded.\n";
				$file_doc = $uploadfile_alias;
			} else {
				echo "File Too Big, Poor Connection to upload that file Size";
				die();
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
				
		
				//list($lat,$lng,$dtaken)=getCoordinates($target);
				//list($lat,$lng,$dtaken) = getCoordinates_new($target);
				/*
				$getDataGeotag = getCoordinates_new($target);
				$lat = $getDataGeotag[0];
				$lon = $getDataGeotag[1];
				$dtaken = $getDataGeotag[2];
				*/
				//if(strlen($lat)<>0){ 
					//echo "<script>alert('".$getDataGeotag[0]."+++ ".$getDataGeotag[1]."++".$getDataGeotag[2]."');</script>";
					//die();
					//echo " lat : ".$lat." - lon : ".$lng." - dtaekn : ".gmdate("Y-m-d H:i:s", $dtaken)."<br>";die();
				
				//}
				/*$strf .= " lon, lat, dpic, ";
				$strf_isi .= "'".$lng."', '".$lat."', '".gmdate("Y-m-d H:i:s", $dtaken)."', ";*/
			}else{
				echo "<script>alert('JPG Format & Geo Tag Please..');history.back();</script>";die();
			}
			
			
			//echo $file_doc ."---";
			if(strlen($file_doc)){
				$file_name = $ANOM_VARS["www_file_path"] . 'upload_photo/'. $file_doc;
				$geo = new geotaging_extractor();
				$result = $geo->getCoordinates($file_name);
				
				if( $result !== FALSE )
				{
					$lat = $result[0];
					$lon = $result[1];
					$dtaken = $result[2];
					touch($file_name,$dtaken);
					
					$lstvalue = listAppend($lstvalue,"'".$file_doc."'");
					$lstvalue = listAppend($lstvalue,"'".$lon."'");
					$lstvalue = listAppend($lstvalue,"'".$lat."'");
					$lstvalue = listAppend($lstvalue,"'".$dtaken."'");
					
				}else{
					echo "<script>alert('No Geo Tag in Uploaded Photo..');history.back();</script>";die();
				}
				
				//echo "<script>alert('".$lat."+++ ".$lon."++".$dtaken."');</script>";die();
					
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
			$fname = listGetAt($field_name,$field);
			$lstvalue = listAppend($lstvalue,"'".postParamSimple($fname)."'");
			
		}elseif($ftype=="maps"){
			$coord=str_replace("}","",postParamSimple($fname));
			$lon=listGetAt(listGetAt($coord,2),2,":");
			$lat=listGetAt(listGetAt($coord,1),2,":");
			$lstvalue = listAppend($lstvalue,"'".$lon."'");
			$lstvalue = listAppend($lstvalue,"'".$lat."'");
		}else{
			$fname = listGetAt($field_name,$field);
			$lstvalue = listAppend($lstvalue,"'".postParamSimple($fname)."'");
		}
		
	}
	$strsql = $strsql . $lstvalue;
	$strsql = $strsql .",'".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] .",'".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] .")";
	//echo $strsql;die();
	$user->query($strsql);
	$maxID=$user->lastInsertID();
	opt_insertqry($maxID);

	//TRIGGER TABEL log_query
	$queryLog = " select column_name from INFORMATION_SCHEMA.COLUMNS where table_schema = '".$ANOM_VARS["db_name"]."' and table_name = '".$nama_table. "'";
	
	$showdata->query($queryLog);
    $queryLog2= " select * from ".$nama_table." where " .$primary_id. " = " .$maxID;
    $showdata2->query($queryLog2);
    for($z=1;$z<=listLen($showdata->valueList('column_name'));$z++){
		$variabel = $variabel.'|'.$showdata2->valueList(listGetAt($showdata->valueList('column_name'),$z));
	}
	$insert_qry = 'insert into log_query(tabel_name,id_trx,query,data_after,trx_type,trx_uid) values ("'.$nama_table.'","'.$maxID.'","'.$strsql.'","'.$variabel.'","NEW","'.$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] .'")';
	$log_query->query($insert_qry);
   //AKHIR TRIGGER TABEL log_query

	echo "<script>alert('Record Saved..!');location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";
	die();
	//
}
//QUERY UPDATE
if(isset($_GET["update"])){
	$strsql = "update ".$nama_table." set ";
	$lstvalue = "";
	for($field=1;$field<=listLen($field_name);$field++){
		$fname = listGetAt($field_name,$field);
		$ftype_org= listGetAt($field_type_name,$field,"#");
		$ftype = listGetAt($ftype_org,2,"|");
		if($ftype=="file"){
			if(strlen($_FILES[$fname]['name'])){
				$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_files/';
				$uploadfile = $uploaddir . "upload_".$fname."_". $nama_table . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload_".$fname."_".$nama_table . "_" .  date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				
				if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
					//echo "File is valid, and was successfully uploaded.\n";
					$file_doc = $uploadfile_alias;
				} else {
					echo "<script>alert('File Too Big, Poor Connection to upload that file Size..');history.back();</script>";
					die();
					$file_doc = "";
				}
			}else{
					$file_doc = "";
			}
			
			
			if(strlen($file_doc)){
				$lstvalue = listAppend($lstvalue,$fname."='".$file_doc."'");
			}
			
		}elseif($ftype=="multiselect"){
			/* Update in Optional Query
			$strlist = "";
			foreach ($_POST[$fname] as $names)
			{
				$strlist = listAppend($strlist,$names);
			}
			$lstvalue = listAppend($lstvalue,$fname."='".$strlist."'");
			*/
		}elseif($ftype=="geotag"){
			include 'geotaging_extractor.php';
			//echo "masuk<BR>";
			$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
			$uploadfile = $uploaddir . "upload_".$nama_table . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
			$uploadfile_alias = "upload_".$nama_table . "_" .  date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
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
						$dtaken = $result[2];
						touch($file_name,$dtaken);
						if(uriParam("tmp")=='templates/ref_buyer/index.php'){
							$lonfile = "lon";
							$latfile = "lat";
						}else{
							$lonfile = listGetAt($fname,1,"_") . "_lon";
							$latfile = listGetAt($fname,1,"_") . "_lat";
							$datefile = listGetAt($fname,1,"_") . "_date";
						}
						
						$lstvalue = listAppend($lstvalue,$fname."='".$file_doc."'");
						$lstvalue = listAppend($lstvalue,$lonfile."='".$lon."'");
						$lstvalue = listAppend($lstvalue,$latfile."='".$lat."'");
						$lstvalue = listAppend($lstvalue,$datefile."='".$dtaken."'");
						
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
		}elseif($ftype=="date"){
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
		}else{
			$lstvalue = listAppend($lstvalue,$fname."='".postParamSimple($fname)."'");
		}
	}
	$strsql = $strsql . $lstvalue;
	
	$strsql = $strsql . ",update_date='".date("Y-m-d H:i:s")."',update_by=".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
	
	$strsql = $strsql . " where ".$primary_id ."=".decryptStringArray(uriParam($primary_id));
	//echo $strsql;die();

	// DAPET DATA BEFORE UNTUK LOG_QUERY
	$queryLog = " select column_name from INFORMATION_SCHEMA.COLUMNS where table_schema = '".$ANOM_VARS["db_name"]."' and table_name = '".$nama_table. "'";

	$showdata->query($queryLog);
    $queryLog2= " select * from ".$nama_table." where " .$primary_id. " = " .decryptStringArray(uriParam($primary_id));
    $showdata2->query($queryLog2);
    for($z=1;$z<=listLen($showdata->valueList('column_name'));$z++){
		$variabel = $variabel.'|'.$showdata2->valueList(listGetAt($showdata->valueList('column_name'),$z));
	}
	// AKHIR DAPET DATA BEFORE UNTUK LOG_QUERY

	$user->query($strsql);
	opt_updateqry(decryptStringArray(uriParam($primary_id)));

	//TRIGGER TABEL log_query
	$queryLog1 = " select column_name from INFORMATION_SCHEMA.COLUMNS where table_schema = '".$ANOM_VARS["db_name"]."' and table_name = '".$nama_table. "'";
	$showdata_->query($queryLog1);
	$queryLog3= " select * from ".$nama_table." where " .$primary_id. " = " .decryptStringArray(uriParam($primary_id));
	$showdata2_->query($queryLog3);
	for($z=1;$z<=listLen($showdata_->valueList('column_name'));$z++){
		$variabel2 = $variabel2.'|'.$showdata2_->valueList(listGetAt($showdata_->valueList('column_name'),$z));
	}
	$insert_qry = 'insert into log_query(tabel_name,id_trx,query,data_before,data_after,trx_type,trx_uid) values ("'.$nama_table.'","'.decryptStringArray(uriParam($primary_id)).'","'.$strsql.'","'.$variabel.'","'.$variabel2.'","UPDATE","'.$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] .'")';
	$log_query->query($insert_qry);
   //AKHIR TRIGGER TABEL log_query

	echo "<script>alert('Data Successfully Updated..');location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";die();
	
}

//QUERY DELETE
if(isset($_GET["delete"])){
	// $strsql = "update ".$nama_table." set is_deleted=1,delete_by=".$_SESSION["user_id" . date("mdY")]." where ".$primary_id."=".decryptStringArray(uriParam($primary_id));
	$strsql = "update ".$nama_table." set is_deleted=1,delete_date='".date("Y-m-d H:i:s")."',delete_by=".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] ." where ".$primary_id."=".decryptStringArray(uriParam($primary_id));

	$user->query($strsql);
	// opt_deleteqry(decryptStringArray(uriParam($primary_id)));
	//TRIGGER TABEL log_query
	$queryLog1 = " select column_name from INFORMATION_SCHEMA.COLUMNS where table_schema = '".$ANOM_VARS["db_name"]."' and table_name = '".$nama_table. "'";
	$showdata_->query($queryLog1);
	$queryLog3= " select * from ".$nama_table." where " .$primary_id. " = " .decryptStringArray(uriParam($primary_id));
	$showdata2_->query($queryLog3);
	for($z=1;$z<=listLen($showdata_->valueList('column_name'));$z++){
		$variabel2 = $variabel2.'|'.$showdata2_->valueList(listGetAt($showdata_->valueList('column_name'),$z));
	}
	$insert_qry = 'insert into log_query(tabel_name,id_trx,query,data_before,data_after,trx_type,trx_uid) values ("'.$nama_table.'","'.decryptStringArray(uriParam($primary_id)).'","'.$strsql.'","'.$variabel.'","'.$variabel2.'","DELETE","'.$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] .'")';
	$log_query->query($insert_qry);
	//$strsql = "delete from ".$nama_table_child." where ".$primary_id."=".uriParam($primary_id);
	//$user->query($strsql);
	//echo $strsql;
	echo "<script>alert('Data Successfully Updated..');location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";die();
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
		<?}?>
	<?}?>
	<?if(uriParam("tmp")=="templates/do/index.php"){?>
		if(frm.qty.value>50){ 
				alert('Please Input below 50m3 !'); 
				frm.qty.focus();
				return false;
		}
	<?}?>
		frm.submit();
	}
	</script>
<?}?>



<?if(isset($_GET["edit"])){
	//FORM EDIT
	$edit=cmsDB();
	$strsql = "select * from ".$nama_table." where ".$primary_id."=".decryptStringArray(uriParam($primary_id));
	//echo $strsql;
	$edit->query("select * from ".$nama_table." where ".$primary_id."=".decryptStringArray(uriParam($primary_id)));
	$edit->next();

  ?>
  	<div class="modal-dialog" <?if($two_form == 'yes'){?>style="width: 1000px"<?}?>>
		<form action="?tmp=<?=uriParam("tmp")?>&<?=$primary_id?>=<?=uriParam($primary_id)?>&update=yes&refresh=<?=md5("mdYHis")?>" method="post" name="updateform" enctype="multipart/form-data" id="updateform" class="form-horizontal">
	        <div class="modal-content" >
	            <div class="modal-header">
	            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		 			<h4 class="modal-title"><a href="javascript:PopWindow('openLog.php?tbl=<?=encryptStringArray($nama_table)?>&idkey=<?=encryptStringArray($primary_id)?>&idx=<?=uriParam($primary_id)?>&','winlog','500','300','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no')"><i class="icon-info-sign"></i> </a> - <?=$form_edit_title?></h4>
	            </div>
	            <div class="modal-body">
	          		<div class="portlet-body form">
	                 	<!-- BEGIN FORM BODY-->
	                 	<div class="form-body">
	                 		<div class="row">
								<?for($field=1;$field<=listLen($field_name);$field++){?>
									<?
									$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
									$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
									$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
									$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
									$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
									?>
									<?if($field_type_ori=="geoval"){?>
								
									<?}else{?>
										<?
										if(listFind($field_required,$field_name_ori)){
											$required="required=''required'";
										}else{
											$required="";
										}
										?>
										<!-- PECAH FORM DIBAGI 2 ATAU TIDAK -->
										<?if($two_form == 'yes'){?>
											<div class="col-md-6">
										<?}else{?>
											<div class="col-md-12">
										<?}?>
					                        <div class="form-group">
					                            <label  class="col-md-3 control-label">
													<?=listGetAt($field_alias_name,$field);?>
													  <?if(listFind($field_required,$field_name_ori)){?>
												   		<font color="red"> *</font>
													<?}?>
									   			</label>
						                        <div class="col-md-9">
													<?if($field_type_ori=="text"){?>
														<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?>>
													<?}elseif($field_type_ori=="text-readonly"){?>
														<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> readonly>
													<?}elseif($field_type_ori=="auto-text"){?>
														<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" readonly>
													<?}elseif($field_type_ori=="checkbox"){?>
														<input name="<?=$field_name_ori?>" type="checkbox" value="1"  class="form-control" <?=$required?> <?if($edit->row($field_name_ori)==1){echo "checked";}?>> 
													<?}elseif($field_type_ori=="radio"){?>
														
							                             <label class="radio-inline">
							                             <input name="<?=$field_name_ori?>" type="radio" value="1"  <?=$required?> <?if($edit->row($field_name_ori)==1){echo " checked";}?>>Yes
							                             </label>
							                             <label class="radio-inline">
							                             <input name="<?=$field_name_ori?>" type="radio" value="0"  <?=$required?> <?if($edit->row($field_name_ori)==0){echo " checked";}?>>No
							                             </label> 
													<?}elseif($field_type_ori=="number"){?>
														<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control"  <?=$required?>>
													<?}elseif($field_type_ori=="textarea"){?>
														<textarea name="<?=$field_name_ori?>" rows="<?=$field_row?>" class="form-control"  <?=$required?>><?=$edit->row($field_name_ori)?></textarea>
													<?}elseif($field_type_ori=="file"){?>
														<? $url_popup = "index-child.php?
														table=".encryptStringArray($nama_table)."&
														field=".encryptStringArray($field_name_ori)."&
														primary=".encryptStringArray($primary_id)."&
														id=".uriParam($primary_id); 

														?>
														<script>
															function _checkfile(){
																if (document.updateform.<?=$field_name_ori?>.value == '') {
																	alert('tidak ada file yang ditampilkan');
																}else{
																	window.open('<?=$ANOM_VARS["www_file_url"]?>upload_photo/'+document.updateform.<?=$field_name_ori?>.value);
																}
															}
														</script>
														<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" readonly>
														<a class="btn btn-warning" href="javascript:PopupWindow('<?=$url_popup?>','frmpop');"><i class="icon-plus"></i> Upload File</a>
														<?//if(strlen($edit->row($field_name_ori))){?>
															<a class="btn default yellow-stripe" href="javascript:_checkfile()">[Show Attachement] <i class="icon-search"></i></a>

														<?//}?>
													<!-- 	<input name="<?=$field_name_ori?>" type="FILE" value="" maxlength="<?=$field_size?>" class="form-control"  <?=$required?> accept="image/*;capture=camera;">
														<?if(strlen($edit->row($field_name_ori))){?>
															<a href="<?=$ANOM_VARS["www_file_url"]?>upload_files/<?=$edit->row($field_name_ori)?>" target="_new">[ Lihat Dokumen ]</a>
														<?}?> -->
													<?}elseif($field_type_ori=="geotag"){?>
														<input name="<?=$field_name_ori?>" type="FILE" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control"  accept="image/*;capture=camera;">
														<?if(strlen($edit->row($field_name_ori))){?>
															<a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$edit->row($field_name_ori)?>" target="_new">[ Lihat Dokumen ]</a>
														<?}?>	
													<?}elseif($field_type_ori=="geoval"){?>
															
													<?}elseif($field_type_ori=="date"){?>
														<input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=datesql2date($edit->row($field_name_ori))?>"  <?=$required?> /> 
														
													<?}elseif($field_type_ori=="select"){
														$field_query=$field_size;?>
														<select name="<?=$field_name_ori?>" id="<?=$field_name_ori?>" class="form-control input-big select2me" >
														<?
														if(listFind($field_query,"where"," ")){
															$field_query=listGetAt($field_query,1,"where");
															$select_table->query($field_query . " and " . $field_name_ori . "='". $edit->row($field_name_ori)."'");
														}else{
															$select_table->query($field_query . " where " . $field_name_ori . "='". $edit->row($field_name_ori)."'");
													   	}
														$select_table->next();
														?>
														<option value="<?=$select_table->row("id")?>" selected><?=$select_table->row("name")?></option>
														<?
														if(listFind($field_query,"where"," ")){
															$select_table->query($field_query . " and " . $field_name_ori . "<>'". $edit->row($field_name_ori)."'");
														}else{
															$select_table->query($field_query . " where " . $field_name_ori . "<>'". $edit->row($field_name_ori)."'");
														}
														?>
														<?while($select_table->next()){?>
															<option value="<?=$select_table->row("id")?>" <?if($select_table->row("id")==$edit->row($field_name_ori)){ echo " selected";}?>>
																<?=$select_table->row("name")?>
															</option>
														 <?}?>
														</select>
															
													
													<?}elseif($field_type_ori=="multiselect"){
														$field_query=$field_size;
														$select_table->query($field_query);
														?>
														<select multiple="multiple" class="multi-select" id="my_multi_select3" name="<?=$field_name_ori?>[]">
											                                    <?while($select_table->next()){?>
															<option value="<?=$select_table->row("id")?>" <?if(listFind($edit->row($field_name_ori),$select_table->row("id"))){ echo " selected";}?>>
																<?=$select_table->row("name")?>
															</option>
															<?}?>
														</select>
													<?}elseif($field_type_ori=="select-read"){
														$field_query=$field_size;
														$select_table->query($field_query);
													?>
														<select name="<?=$field_name_ori?>_2" class="form-control" data-placeholder="Select..." disabled>
														 <?while($select_table->next()){?>
															<option value="<?=$select_table->row("id")?>" <?if($select_table->row("id")==$edit->row($field_name_ori)){ echo " selected";}?>>
																<?=$select_table->row("name")?>
															</option>
														 <?}?>
														</select>
														<input type='hidden' name='<?=$field_name_ori?>' value='<?=$edit->row($field_name_ori)?>'>
													<?}elseif($field_type_ori=="maps"){?>
														Remark FRom this system
													<?}?>
												</div>
											</div>
										</div>
									<?}?>
				                <?}?>

				                <?
								$lstfieldname = "";
								for($field=1;$field<=listLen($field_name);$field++){
									$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
									$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
									$lstfieldname=listAppend($lstfieldname,"updateform.".$field_name_ori); 
								}?>
								</div>
					            				<!-- START CLASS FORM-ACTIONS FLUID -->
							 					<div class="form-actions fluid">
					                                <div class="form-group" align="center">
														<?if(_checkauth("Edit")){?>
											                <button type="button" class="btn blue" onclick="_cekValid(document.updateform);">Update</button>
														<?}?>
														<?if(_checkauth("Delete")){?>
														   <button type="button" class="btn red" onclick="if(confirm('Are You Sure Want to Delete this Record?')){ location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&delete=yes&<?=$primary_id?>=<?=uriParam($primary_id)?>&ref=<?=md5(date("mdyHis"))?>';} ">Delete</button>
													    <?}?>
														 <?if(_checkauth("Print")){?>
															<a class="btn blue" href="<?$_SERVER["SCRIPT_NAME"]?>?tmp=templates/print/<?=listLast($nama_table,"_")?>.php&<?=$primary_id?>=<?=uriParam($primary_id)?>&refresh=<?=md5(date("mdYHis"))?>">Print <i class="icon-print"></i></a>
														<?}?> 
														<button data-dismiss="modal" class="btn default" type="button">Close</button>                  
					            					</div>
												</div>
					            				<!-- END CLASS FORM-ACTIONS FLUID -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
                              <!-- END FORM--> 
	</div>
<?}?>
				
<?if(!isset($_GET["edit"]) && !isset($_GET["newform"])){?>
	<!-- BEGIN PAGE CONTENT-->

	<div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet box">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-globe"></i><font color="#000000"><?=$nama_List?></font></div>
                     <div class="tools">
                        <!---<a href="javascript:;" class="collapse"></a>--->
                        <!---<a href="#portlet-config" data-toggle="modal" class="config"></a>--->
                        <a href="javascript:;" class="reload"></a>
                        <!---<a href="javascript:;" class="remove"></a>--->
                     </div> 
                  </div>
	      <div class="portlet-body">
		         <div class="table-toolbar">
		            <div class="btn-group"><BR>
		               <!--<a class="btn default" data-toggle="modal" data-target="#responsive" href="index-popup.php?tmp=<?=uriParam("tmp")?>&newform=yes&ref=<?=md5(date("mdyHis"))?>"><?=$form_new_title?> <i class="icon-plus"></i></a>-->
			<?if(_checkauth("New")){?>
				<a class="btn green" data-toggle="modal" href="#addresponsive"><?=$form_new_title?> <i class="icon-plus"></i></a>
			<?}?>   
		            </div>
		            <!---<div class="btn-group pull-right">
		               <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
		               </button>
		               <ul class="dropdown-menu pull-right">
		                  <li><a href="#">Print</a></li>
		                  <li><a href="#">Save as PDF</a></li>
		                  <li><a href="#">Export to Excel</a></li>
		               </ul>
		            </div>--->
		         </div>
		 <?
			//No. of Row
			$page_row = 10;
			$admin=cmsDB();
			$custom=cmsDB();
			if(isset($_GET["paging"])){
				$paging= $_GET["paging"];
			}else{
				$paging=1;
			}
			if($paging==1){
				$start_row = 0;
			}else{
				$start_row = ($paging * $page_row)-$page_row;
			}
			$no=$start_row+1;
			
			//Sorting & Ordering
			if(isset($_GET["orderby"])){
				$orderby = "order by " .$_GET["orderby"];
			}else{
				$orderby = "order by insert_date desc";
			}
			if(isset($_GET["sortby"])){
				$sortby = $_GET["sortby"];
			}else{
				$sortby = "";
			}
			$ordersort = $orderby . " " . $sortby;
			
			//Searching
			$search_word = " ";
			$txtsearch = " ";
			if(isset($_GET["search"])){
				if(strlen($search_field)){
					//echo "Masuk1";
					if(isset($_POST["txtsearch"])){
						$search_word = "  and (";
						for($i=1;$i<=listLen($search_field);$i++){
							if($i==1){
								$search_word = $search_word . listGetAt($search_field,$i) ." like '%".postParamSimple("txtsearch")."%'"; 
							}else{
								$search_word = $search_word . " or " . listGetAt($search_field,$i) ." like '%".postParamSimple("txtsearch")."%'"; 
							}
							
						}
						$search_word = $search_word . ")";
						$txtsearch = postParamSimple("txtsearch");
						//echo "pencarian : ".$txtsearch;
					
					}elseif(isset($_GET["txtsearch"])){
						//echo "Masuk2";
							//$search_word = "";
						$txtsearch =uriParam("txtsearch");
						$search_word = "  and (";
						for($i=1;$i<=listLen($search_field);$i++){
							if($i==1){
								$search_word = $search_word . listGetAt($search_field,$i) ." like '%".$txtsearch."%'"; 
							}else{
								$search_word = $search_word . " or " . listGetAt($search_field,$i) ." like '%".$txtsearch."%'"; 
							}
							
						}
						$search_word = $search_word . ")";
						
						
					}else{
						$txtsearch ="";
						$lstsearch="";
						for($s=1;$s<=listLen($search_field);$s++){
							$field_cari = listGetAt($search_field,$s);
							$pos_field = listFind($field_name,$field_cari);
							$name_field=listGetAt($field_name,$pos_field);
							$tipe_field = listGetAt(listGetAt($field_type_name,$pos_field,"#"),2,"|");
							//$qry_field = listGetAt(listGetAt($field_type_name,$pos_field,"#"),3,"|");
							//$qry_field = listGetAt($qry_field,1,"^");
							//$alias_field = listGetAt($field_alias_name,$pos_field);
							if(isset($_GET["chk_".$name_field])){
								if($tipe_field=="text" || $tipe_field=="textarea" || $tipe_field=="auto-text"){
									if(uriParam($name_field."_opr")=="="){
										$lstsearch=$lstsearch." and " . $name_field . "='".uriParam($name_field)."'";
									}elseif(uriParam($name_field."_opr")=="like"){
										$lstsearch=$lstsearch." and " . $name_field . " like '%".uriParam($name_field)."%'";
									}
									
								}elseif($tipe_field=="select" || $tipe_field=="select-read"){
									$lstsearch=$lstsearch." and " . $name_field . " in (".uriParam($name_field).")";
								}elseif($tipe_field=="number"){
									if(uriParam($name_field."_oprnumber")=="eq"){
										$lstsearch=$lstsearch." and " . $name_field . "=".uriParam($name_field);
									}elseif(uriParam($name_field."_oprnumber")=="gt"){
										$lstsearch=$lstsearch." and " . $name_field . ">".uriParam($name_field);
									}elseif(uriParam($name_field."_oprnumber")=="gte"){
										$lstsearch=$lstsearch." and " . $name_field . ">=".uriParam($name_field);
									}elseif(uriParam($name_field."_oprnumber")=="lt"){
										$lstsearch=$lstsearch." and " . $name_field . "<".uriParam($name_field);
									}elseif(uriParam($name_field."_oprnumber")=="lte"){
										$lstsearch=$lstsearch." and " . $name_field . "<=".uriParam($name_field);
									}	
								}elseif($tipe_field=="date"){
									$start_date="";
									$to_date="";
									if(isset($_GET[$name_field."_fromdate"])){
										$date_org = uriParam($name_field."_fromdate");
										$year=listGetAt($date_org,3,"/");
										$month=listGetAt($date_org,1,"/");
										$day=listGetAt($date_org,2,"/");
										$start_date=$year . "-" . $month . "-".$day." 00:00:00";
									}
									if(isset($_GET[$name_field."_todate"])){
										$date_org = uriParam($name_field."_todate");
										$year=listGetAt($date_org,3,"/");
										$month=listGetAt($date_org,1,"/");
										$day=listGetAt($date_org,2,"/");
										$to_date=$year . "-" . $month . "-".$day." 00:00:00";
									}
									if(strlen($start_date) && strlen($to_date)){
										$lstsearch=$lstsearch." and (" . $name_field . ">='".$start_date."' and " . $name_field . "<='".$to_date."')";
									}
									
								}
							}
						}
						$search_word=$lstsearch;
						if(uriParam("tmp")=="templates/po_supplier/index.php"){
							if(isset($_GET["lst_spb"])){
								$search_word=$search_word." and po_supplier_id in (".uriParam("lst_spb").")";
							}
						}
						//echo "Tambahan Search : " . $lstsearch;
					}
				}
			}
			//echo $search_word;
			if(strlen($search_word)){
				if(strlen($main_query)){
					$admin->query($main_query." ".$search_word);
					$no_record = $admin->recordCount();
				}else{
					$admin->query("select count(*) as no_record from ".$nama_table."  where 1 ".$search_word);
					$admin->next();
					$no_record = $admin->row("no_record");
				}
			}else{
				if(strlen($main_query)){
					$admin->query($main_query);
					$no_record = $admin->recordCount();
				}else{
					$admin->query("select count(*) as no_record from ".$nama_table);
					$admin->next();
					$no_record = $admin->row("no_record");
				}
			}
			
			
			$no_page = ceil($no_record/$page_row);
			//echo $no_page . "--" . $no_record;die();
			
			if(strlen($main_query)){
				$strsql = $main_query;
				
			}else{
				$strsql = "select * from ".$nama_table;
			}
			if(ListValueCount(strtolower($strsql),"where"," ") >= 1){
				if(strlen(trim($search_word))){
					$search_word = " " . $search_word;
				}
				
			}else{
				if(strlen(trim($search_word))){
					$search_word = " where " . $search_word;
				}
			}
			//echo "search : " . $search_word;
			if(strlen(trim($search_word))){
				$strsql = $strsql .  $search_word;
			}
			$strsql = $strsql . " " . $ordersort." limit ".$start_row.",".$page_row;
			$admin->query($strsql);
			
			// echo $strsql;
			//die();
			//echo "from ".ListValueCount(strtolower($strsql),"from"," ");die();
		 ?>
					 
	 <form action="<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&search=yes&refresh=<?=md5("mdYHis")?>" method="post" name="search_form">
	  <div style="text-align:right">
			  Search <input name="txtsearch" type="text" size="20" style="font-size: 14px;font-weight: normal;color: #333333;  background-color: #ffffff;border: 1px solid #e5e5e5;border-radius: 0; width: 200px;" placeholder="Enter text"> 
					 <button type="submit" class="btn blue" >Search</button>
					 <a class="btn green" data-toggle="modal" href="#advance_search">Advance Search <i class="icon-search"></i></a>
					 <?if(_checkauth("Print")){?>
					 <!--<a class="btn yellow" href="<?$_SERVER["SCRIPT_NAME"]?>?tmp=templates/print/print_all.php&nama_List=<?=$nama_List?>&main_query=<?=$strsql?>&record_show=<?=$record_show?>&refresh=<?=md5(date("mdYHis"))?>">Print <i class="icon-print"></i></a>-->
					<?}?> 
	  </div>
	  </form>
	  <!-- Paging-->
	  
	<form name=frmpage2>
	   <div style="text-align:left">
		   Page : 

		   <?
		   if(strlen($txtsearch)){
			   $addsearch = "&txtsearch=".$txtsearch;
		   }else{
			   $addsearch = " ";
		   }
		   ?>
		   <select name="groupname2" onchange="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging='+ document.frmpage2.groupname2.value +'&ref=<?=md5(date("mdyHis"))?>';"   class="form-control input-small select2me" data-placeholder="Select...">
				<?for($i=1;$i<=$no_page;$i++){ ?>
					<option value="<?=$i?>" <?if($paging==$i){ echo " selected";}?>><?=$i?></option>
				<?}?>
		   </select> of <B><?=number_format($no_page,0)?></B> Page(s) from <B><?=number_format($no_record,0)?></B> Record(s)
   	</div>
	</form>
	 <div style="text-align:center">
	 <a href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging=1&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-fast-backward"> Awal</i></a>&nbsp;&nbsp;
	 <a href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging=<?if(isset($_GET["paging"])){echo uriParam(paging)-1;}else{echo "1";}?>&ref=<?=md5(date("mdyHis"))?>';"> <i class="icon-step-backward"> Sebelumnya</i></a> 
	  &nbsp;&nbsp;|||&nbsp;&nbsp; 
	  <a href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging=<?if(isset($_GET["paging"])){echo uriParam(paging)+1;}else{echo "2";}?>&ref=<?=md5(date("mdyHis"))?>';">Berikutnya <i class="icon-step-forward"></i></a>&nbsp;&nbsp;
	  <a href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging=<?=$no_page;?>&ref=<?=md5(date("mdyHis"))?>';">Akhir <i class="icon-fast-forward"></i></a>
	  </div>
	   
	   
	   <!-- End of Paging-->
	  <div class="table-scrollable">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead>
		<tr style='font-size:10px; height: 2px;'>
                              <th style='background-color: #c3c5c8;' valign="middle">No</th>
		     <?if(uriParam("tmp")=='templates/po_buyer/index.php'){?>
			  <th style='background-color: #9bafcc;'>Time Line</th>
		     <?}?>
			  <!---$record_show = "judul_hutan|Judul Hutan|center|sort_on,keterangan|Keterangan Hutan|left|sort_off"-->
			  <?for($field=1;$field<=listLen($record_show,"~");$field++){
				$row_detail = listGetAt($record_show,$field,"~");
				$row_field = listGetAt($row_detail,1,"|");
				$row_fname=listGetAt($row_field,1,"^");
				$row_fname_type=listGetAt($row_field,2,"^");
				$row_aliasName = listGetAt($row_detail,2,"|");
				$row_align = listGetAt($row_detail,3,"|");
				$row_sort = listGetAt($row_detail,4,"|");
		  ?>
				 <th style='background-color: #c3c5c8;' valign="middle">
					 <div class='text-center' valign="top">
						 <?=$row_aliasName?>
						 <?if($row_sort=="sort_on"){?>
						 		<br>
							  <a  href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&orderby=<?=$row_fname?>&sortby=asc&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-chevron-up"></i></a>
							  <a  href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&orderby=<?=$row_fname?>&sortby=desc&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-chevron-down"></i></a>
						 <?}?>
					 </div>
				  </th>
			  <?}?>
                             <th style='background-color: #c3c5c8;'><div align="center">Update Date</div>

                             <th style='background-color: #c3c5c8;'><div align="center">Update By</div>
                           </tr>
                        </thead>
                        <tbody>
		<?
		//$no=1;
		$divno=1;
		while($admin->next()){?>
                           <tr class="highlight">
                              <td class='text-right'><font size=-1><?=$no;?>.</font></td>
		      <?if(uriParam("tmp")=='templates/po_buyer/index.php'){?>
			  <td class='text-center'><a href="<?$_SERVER["SCRIPT_NAME"]?>?tmp=templates/po_buyer/show_timeline.php&<?=$primary_id?>=<?=encryptStringArray($admin->row($primary_id))?>"><i class="icon-sitemap"></i></a></th>
		      <?}?>
			   <?for($field=1;$field<=listLen($record_show,"~");$field++){
					$row_detail = listGetAt($record_show,$field,"~");
					$row_field = listGetAt($row_detail,1,"|");
					$row_fname=listGetAt($row_field,1,"^");
					$row_fname_type=listGetAt($row_field,2,"^");
					$row_aliasName = listGetAt($row_detail,2,"|");
					$row_align = listGetAt($row_detail,3,"|");
					$row_sort = listGetAt($row_detail,4,"|");
					$link_on = listGetAt($row_detail,5,"|");
					$sub_query = listGetAt($row_detail,6,"|");
					if($sub_query=="sub_query_off"){
						$query_child="";
						$query_field="";
					}elseif($sub_query=="photo"){	
						$query_child="";
						$query_field="<i class=\"icon-camera-retro\"></i>";
					}elseif($sub_query=="maps"){	
						$query_child="";
						$query_field="<i class=\"icon-globe\"></i>";
						$query_field=$rmap;
					}else{
						$query_child=listGetAt($sub_query,1,"#");
						$query_field=listGetAt($sub_query,2,"#");
					}
					
					$pos_field = listFind($field_name,$row_fname);
					$pos_type = listGetAt($field_type_name,$pos_field,"#");
					$pos_type_field = listGetAt($pos_type,2,"|");
		switch ($row_align){
			case "left": $algn = "class='text-left'";break;
			case "right": $algn = "class='text-right'";break;
			case "center": $algn = "class='text-center'";break;
		}
					?>
					<td <?=$algn;?>><font size=-1>
						<?if(_checkauth("View")){?>
							<?if($link_on=="link_on"){?>
								<a href="index-popup.php?tmp=<?=uriParam("tmp")?>&edit=yes&<?=$primary_id?>=<?=encryptStringArray($admin->row($primary_id))?>&ref=<?=md5(date("mdyHis"))?>" data-target="#editfrm_<?=$divno?>"  data-toggle="modal">
							<?}?>
						<?}?>
						
							<?if($pos_type_field=='select' || $pos_type_field=='select-read'){
								$pos_type_qry = listGetAt($pos_type,3,"|");
								$pos_type_qry = listGetAt($pos_type_qry,1,"^");
								//echo $pos_type_qry."<BR>".$row_fname."<P>";
								if(listFind($pos_type_qry,"where"," ")){
									$item->query($pos_type_qry." and ".$row_fname."=".$admin->row($row_fname));
								}else{
									$item->query($pos_type_qry." where ".$row_fname."=".$admin->row($row_fname));
								}
								if($item->recordCount()){
									$item->next();
									$val_fname = $item->row("name");
								}else{
									$val_fname = "-Unknown-";
								}
								if($row_fname=="status_id"){
									$status->query("select status_color from ref_status where status_name='".$val_fname."'");
									if($status->recordCount()){
										$status->next();
										echo "<span class=\"label label-sm ". $status->row("status_color") ."\">".$val_fname."</span>";
									}else{
										echo $val_fname ;
									}
								}else{
									echo $val_fname;
								}
							}elseif($pos_type_field=='date'){
								echo datesql2date($admin->row($row_fname));
							}else{
								if($row_fname_type=="number"){
									if(is_numeric($admin->row($row_fname))){
										echo number_format($admin->row($row_fname), 2, ',', '.');
									}else{
										echo 0;
									}
								}else{
									if($sub_query=="photo"){
										if(strlen($admin->row($row_fname))){
											$nama_pict = $admin->row($row_fname);
											echo "<a href='". $ANOM_VARS["www_file_url"] ."upload_photo/". $admin->row($row_fname)  ."' target='_blank'>".$query_field."</a>";
										}else{
											echo "-";
										}
									}elseif($sub_query=="maps"){
										if(listLen($row_fname,"_")>1){
											$row_map = listGetAt($row_fname,1,"_");
											$row_map1 = $row_map."_lon";
											$row_map2 = $row_map."_lat";
										}else{
											//$row_map = listGetAt($row_fname,1,"_");
											$row_map1 = "lon";
											$row_map2 = "lat";
										}
										if(strlen($admin->row($row_map1)) && strlen($admin->row($row_map2))){
											$nama_lok = "Driver - Nopol: ".$admin->row('driver_name')." - ".$admin->row('vehicle')."<br>NO BLANKO:".$admin->row('do_no');
//											echo "<br><br><br><br>".$admin->row($row_map1)." ".$admin->row($row_map2)." ".$nama_pict;
											$rmap = ($admin->row($row_map1) and $admin->row($row_map2)) ? "<a href='#' onclick='xxrenderMap(".$admin->row($row_map2).",".$admin->row($row_map1).",\"".$nama_lok."\",\"".$nama_pict."\" )' role='button' class='btn btn-sm green' data-toggle='modal' data-target='#myMapModalOK'><i class='icon-map-marker'></i></a>" : "";
											echo $rmap;
//											echo "<a href='vmap.php?".$primary_id."=".$admin->row($primary_id)."&idlon=".$row_map1."&idlat=".$row_map2."&id=".$primary_id."&table=".$nama_table ."'  target='_blank'>".$query_field."</a>";
											
										}else{
											echo "-";
										}
									}else{
										if(strlen($query_child) && strlen($query_field)){
											//echo $query_field."<P>";
											$qchild_all = $query_child. " where ".$primary_id . "=" . $admin->row($primary_id);
											//echo $qchild_all;
											$qchild->query($qchild_all);
											if($qchild->recordCount()){
												$lstitem="";
												while($qchild->next()){
													$lstitem=$lstitem."- ";
													for($q=1;$q<=listLen($query_field,"^");$q++){
														$fchild=listGetAt($query_field,$q,"^");
														//echo "*".$fchild."*";
														$f_item = listGetAt($fchild,1,"-");
														$f_tipe = listGetAt($fchild,2,"-");
														//echo "*" . $f_tipe . "*";
														if($f_tipe=="number"){
															if(strlen($qchild->row($f_item))){
																$lstitem=$lstitem . number_format($qchild->row($f_item),  2, ',', '.') . " | ";
															}else{
																$lstitem=$lstitem . "0 | ";
															}
															
														}else{
															$lstitem=$lstitem. $qchild->row($f_item) . " | ";
														}
														//$lstitem=$lstitem. $qchild->row($fchild) . " | ";
													}
													$lstitem=substr($lstitem,0,strlen($lstitem)-2);
													$lstitem=$lstitem."<BR>";
													//echo listLen($lstitem,"<BR>")  . "-- ";
													
												}
												if(listLen($lstitem,"<BR>") > 1){
													echo "<font size='-1'>".$lstitem."</font>";
												}else{
													echo substr($lstitem,2,strlen($lstitem)-2);
													//echo $lstitem;
												}
											}else{
												echo "<font color=red>-Invalid Data-</font>";
											}
										}else{
											//Custom Field PO Buyer/SPM
											if(uriParam("tmp")=='templates/po_buyer/index.php' && $row_fname=='progress_invoice'){
												$custom->query("select qty,unit_id from tbl_po_buyer where po_buyer_id=".$admin->row("po_buyer_id"));
												$custom->next();
												$spm_qty = number_format($custom->row("qty"),0,",",".");
												$unit_id=$custom->row("unit_id");
												$custom->query("select unit_name from ref_unit where unit_id=".$unit_id);
												if($custom->recordCount()){
													$custom->next();
													$unit_name = " ".$custom->row("unit_name");
												}else{
													$unit_name = " m3";
												}
												$custom->query("select lst_do_id from tbl_invoice where status_id in (12,13) and lst_do_id<>'' and po_buyer_id=".$admin->row("po_buyer_id"));
												$lstdo = $custom->valueList("lst_do_id");
												if(strlen($lstdo)==0){
													$lstdo=0;
												}
												$custom->query("select sum(qty) as do_qty from tbl_do where is_deleted=0 and do_id in (".$lstdo.")");
												$custom->next();
												$do_qty = $custom->row("do_qty");
												if(strlen($do_qty)==0){
													$do_qty=0;
												}
												$do_qty = number_format($do_qty,0,",",".");
												echo $do_qty . "/". $spm_qty.$unit_name;
												
											}elseif(uriParam("tmp")=='templates/po_buyer/index.php' && $row_fname=='progress_paid'){
												$custom->query("select qty,unit_id from tbl_po_buyer where po_buyer_id=".$admin->row("po_buyer_id"));
												$custom->next();
												$spm_qty = number_format($custom->row("qty"),0,",",".");
												$unit_id=$custom->row("unit_id");
												$custom->query("select unit_name from ref_unit where unit_id=".$unit_id);
												if($custom->recordCount()){
													$custom->next();
													$unit_name = " ".$custom->row("unit_name");
												}else{
													$unit_name = " m3";
												}
												$custom->query("select lst_do_id from tbl_invoice where status_id in (14) and po_buyer_id=".$admin->row("po_buyer_id"));
												$lstdo = $custom->valueList("lst_do_id");
												if(strlen($lstdo)==0){
													$lstdo=0;
												}
												$custom->query("select sum(qty) as do_qty from tbl_do where is_deleted=0 and do_id in (".$lstdo.")");
												$custom->next();
												$do_qty = $custom->row("do_qty");
												if(strlen($do_qty)==0){
													$do_qty=0;
												}
												$do_qty = number_format($do_qty,0,",",".");
												echo $do_qty . "/". $spm_qty.$unit_name;
											}elseif(uriParam("tmp")=='templates/po_buyer/index.php' && $row_fname=='progress_qty'){
												$custom->query("select qty,unit_id from tbl_po_buyer where po_buyer_id=".$admin->row("po_buyer_id"));
												$custom->next();
												$spm_qty = number_format($custom->row("qty"),0,",",".");
												$unit_id=$custom->row("unit_id");
												$custom->query("select unit_name from ref_unit where unit_id=".$unit_id);
												if($custom->recordCount()){
													$custom->next();
													$unit_name = " ".$custom->row("unit_name");
												}else{
													$unit_name = " m3";
												}
												$custom->query("select sum(qty) as do_qty from tbl_do where is_deleted=0 and status_id in (11,15) and po_supplier_id in (select po_supplier_id from tbl_po_supplier where po_buyer_id=".$admin->row("po_buyer_id").")");
												$custom->next();
												$do_qty = $custom->row("do_qty");
												if(strlen($do_qty)==0){
													$do_qty=0;
												}
												$do_qty = number_format($do_qty,0,",",".");
												echo $do_qty . "/". $spm_qty.$unit_name;
											//Custom Field PO Supplier/SPB
											}elseif(uriParam("tmp")=='templates/po_supplier/index.php' && $row_fname=='progress_invoice'){
												$custom->query("select qty,unit_id from tbl_po_supplier where po_supplier_id=".$admin->row("po_supplier_id"));
												$custom->next();
												$unit_id = $custom->row("unit_id");
												$qty=$custom->row("qty");
												$spb_qty = number_format($qty,0,",",".");
												$custom->query("select unit_name from ref_unit where unit_id=".$unit_id);
												if($custom->recordCount()){
													$custom->next();
													$unit_name = " ".$custom->row("unit_name");
												}else{
													$unit_name = " m3";
												}
												
												
												$custom->query("select lst_do_id from tbl_supplier_invoice where lst_do_id<>'' and status_id in (12,13) and po_supplier_id=".$admin->row("po_supplier_id"));
												$lstdo = $custom->valueList("lst_do_id");
												if(strlen($lstdo)==0){
													$lstdo=0;
												}
												$custom->query("select sum(qty) as do_qty from tbl_do where is_deleted=0 and do_id in (".$lstdo.")");
												$custom->next();
												$do_qty = $custom->row("do_qty");
												if(strlen($do_qty)==0){
													$do_qty=0;
												}
												$do_qty = number_format($do_qty,0,",",".");
												echo $do_qty . "/". $spb_qty.$unit_name;
												
											}elseif(uriParam("tmp")=='templates/po_supplier/index.php' && $row_fname=='progress_paid'){
												$custom->query("select qty,unit_id from tbl_po_supplier where po_supplier_id=".$admin->row("po_supplier_id"));
												$custom->next();
												$spb_qty = number_format($custom->row("qty"),0,",",".");
												$unit_id=$custom->row("unit_id");
												$custom->query("select unit_name from ref_unit where unit_id=".$unit_id);
												if($custom->recordCount()){
													$custom->next();
													$unit_name = " ".$custom->row("unit_name");
												}else{
													$unit_name = " m3";
												}
												$custom->query("select lst_do_id from tbl_supplier_invoice where lst_do_id<>'' and status_id in (14) and po_supplier_id=".$admin->row("po_supplier_id"));
												$lstdo = $custom->valueList("lst_do_id");
												if(strlen($lstdo)==0){
													$lstdo=0;
												}
												$custom->query("select sum(qty) as do_qty from tbl_do where is_deleted=0 and do_id in (".$lstdo.")");
												$custom->next();
												$do_qty = $custom->row("do_qty");
												if(strlen($do_qty)==0){
													$do_qty=0;
												}
												$do_qty = number_format($do_qty,0,",",".");
												echo $do_qty . "/". $spb_qty.$unit_name;
											}elseif(uriParam("tmp")=='templates/po_supplier/index.php' && $row_fname=='progress_qty'){
												$custom->query("select qty,unit_id from tbl_po_supplier where po_supplier_id=".$admin->row("po_supplier_id"));
												$custom->next();
												$spb_qty = number_format($custom->row("qty"),0,",",".");
												$unit_id=$custom->row("unit_id");
												$custom->query("select unit_name from ref_unit where unit_id=".$unit_id);
												if($custom->recordCount()){
													$custom->next();
													$unit_name = " ".$custom->row("unit_name");
												}else{
													$unit_name = " m3";
												}
												$custom->query("select sum(qty) as do_qty from tbl_do where is_deleted=0 and status_id in (11,15) and po_supplier_id in (select po_supplier_id from tbl_po_supplier where po_supplier_id=".$admin->row("po_supplier_id").")");
												$custom->next();
												$do_qty = $custom->row("do_qty");
												if(strlen($do_qty)==0){
													$do_qty=0;
												}
												$do_qty = number_format($do_qty,0,",",".");
												echo $do_qty . "/". $spb_qty.$unit_name;
											}else{
												//Normal Field
												echo $admin->row($row_fname);
											}
										}
									}
								}
							}
						if(_checkauth("View")){
							if($link_on=="link_on"){ 
								echo "</a>";
							}
						}?>
					
						</font>
						</td>
			  <?}?>
                              <td class='text-center'><font size=-1><?=datesql2date($admin->row("update_date"))?></font></td>
                              <?
									$user->query("select * from ref_user where user_id=".$admin->row("insert_by"));  
									$user->next();
							       ?>
	                              <td class='text-center'>
	                              	<font size=-1>
	                              		<?if($user->recordCount()){ echo $user->row("user_name");
	                              		}else{ echo ' - '; }?>
	                              	</font>
	                              </td>
                            
                           </tr>
		  <?
		  $no++;
		  $divno++;
		  }?>
                           
                        </tbody>
                     </table>
					</div>
                  </div>
               </div> 
			  <div style="text-align:center">
				 <a href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging=1&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-fast-backward"> Awal</i></a>&nbsp;&nbsp;
				 <a href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging=<?if(isset($_GET["paging"])){echo uriParam(paging)-1;}else{echo "1";}?>&ref=<?=md5(date("mdyHis"))?>';"> <i class="icon-step-backward"> Sebelumnya</i></a> 
				  &nbsp;&nbsp;|||&nbsp;&nbsp; 
				  <a href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging=<?if(isset($_GET["paging"])){echo uriParam(paging)+1;}else{echo "2";}?>&ref=<?=md5(date("mdyHis"))?>';">Berikutnya <i class="icon-step-forward"></i></a>&nbsp;&nbsp;
				  <a href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging=<?=$no_page;?>&ref=<?=md5(date("mdyHis"))?>';">Akhir <i class="icon-fast-forward"></i></a>
			</div>
			   <!-- Paging-->
			   <form name=frmpage>
			   <div style="text-align:right">
			   Page : 
			   <select name="groupname" onchange="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?><?=$addsearch?>&paging='+ document.frmpage.groupname.value +'&ref=<?=md5(date("mdyHis"))?>';"   class="form-control input-small select2me" data-placeholder="Select...">
					<?for($i=1;$i<=$no_page;$i++){ ?>
						<option value="<?=$i?>" <?if($paging==$i){ echo " selected";}?>><?=$i?></option>
					<?}?>
			   </select> of <B><?=number_format($no_page,0)?></B> Page(s) from <B><?=number_format($no_record,0)?></B> Record(s)
			   </div>
			   </form>
			   
			    <!-- End of Paging-->
				
               <!-- END EXAMPLE TABLE PORTLET-->
            </div>
	<?}?>
         </div>
 
<!-- END PAGE CONTENT-->
<div class="modal fade" id="advance_search" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<form action="<?=$_SERVER["SCRIPT_NAME"]?>" class="form-horizontal" role="form" enctype="multipart/form-data" method="get" name="mst">
	       	<input type="hidden" name="tmp" value="<?=uriParam("tmp")?>">
		<input type="hidden" name="search" value="yes">
		<input type="hidden" name="refresh" value="<?=md5("mdYHis")?>">
		<div class="modal-content">
		          <div class="modal-header">
		             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		             <h4 class="modal-title">Advance Search</h4>
		          </div>
		          <div class="modal-body">
			<?
			for($s=1;$s<=listLen($search_field);$s++){
				$field_cari = listGetAt($search_field,$s);
				$pos_field = listFind($field_name,$field_cari);
				$name_field=listGetAt($field_name,$pos_field);
				$tipe_field = listGetAt(listGetAt($field_type_name,$pos_field,"#"),2,"|");
				$qry_field = listGetAt(listGetAt($field_type_name,$pos_field,"#"),3,"|");
				$qry_field = listGetAt($qry_field,1,"^");
				$alias_field = listGetAt($field_alias_name,$pos_field);
				//echo $field_cari." | " . $tipe_field. " | ". $qry_field  ."<P>";
			?>
				<div class="form-group">
					 <label  class="col-md-3 control-label">
						<input type="checkbox" name="chk_<?=$name_field?>" class="form-control">&nbsp;<font size="-1"><B><?=$alias_field?></B></font>
					 </label>
					<div class="col-md-9">
						<?if($tipe_field=="text" || $tipe_field=="textarea" || $tipe_field=="auto-text"){?>
							<select name="<?=$name_field?>_opr" class="form-control input-small select2me" data-placeholder="Select...">
								<option value="=">= (Equal)</option>
								<option value="like">LIKE</option>
							</select>&nbsp;
							<input type="text" name="<?=$name_field?>" size="50" placeholder="<?=$alias_field?>" class="form-control">
						<?}elseif($tipe_field=="select" || $tipe_field=="select-read"){
							$search->query($qry_field);
							echo "<select name=\"".$name_field."\" class=\"form-control input-big select2me\" data-placeholder=\"Select...\">";
							while($search->next()){
								echo "<option value='".$search->row("id")."'>".$search->row("name")."</option>";
							}
							echo "</select>";
							?>
							
						<?}elseif($tipe_field=="number"){?>
							<select name="<?=$name_field?>_oprnumber" class="form-control input-small select2me" data-placeholder="Select...">
								<option value="eq">= (Equal)</option>
								<option value="lt">< (Less Than)</option>
								<option value="lte"><= (Less Than Equal)</option>
								<option value="gt">> (Greater Than)</option>
								<option value="gte">>= (Greater Than Equal)</option>
							</select>&nbsp;
							<input type="text" name="<?=$name_field?>" size="40" value="0" class="form-control" placeholder="<?=$alias_field?>">
						<?}elseif($tipe_field=="date"){?>
							<font size="-2">From</font> <input name="<?=$name_field?>_fromdate" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"/>
							<BR><font size="-2">To</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="<?=$name_field?>_todate" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"/>
						<?}?>
							
					</div>
				</div>
			<?}?>
			<div class="form-actions fluid">
		                   <div class="col-md-offset-3 col-md-9" align="left">
				<button type="submit" class="btn blue">Search</button>
		      		<button type="button" data-dismiss="modal" class="btn default">Close</button>                           
		                   </div>
			</div>
			<?//=$search_field?>
			<?//=$field_name?>
			<?//=$field_type_name?>
			</div>
	        </div>
		</form>
	</div>
</div>

<div class="modal fade" id="addresponsive" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog modal-lg" <?if($two_form == 'yes'){?>style="width: 1000px;"<?}?>>
		<form action="?tmp=<?=uriParam("tmp")?>&insert=yes&refresh=<?=md5("mdYHis")?>" class="form-horizontal" role="form" enctype="multipart/form-data" method="post" name="newfrm">
	       <div class="modal-content">
		          <div class="modal-header">
		             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		             <h4 class="modal-title"><?=$form_new_title?></h4>
		          </div>
		          <div class="modal-body">
		          	<div class="portlet-body form">
	                    <div class="form-body">
							<div class="row">

				<!-- form new -->
				<?for($field=1;$field<=listLen($field_name);$field++){?>
				<?
				$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
				$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
				$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
				$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
				$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
				?>
				<?if($field_type_ori=="geoval"){?>
			
				<?}else{?>	
					<?
					if(listFind($field_required,$field_name_ori)){
						$required="required=''required'";
					}else{
						$required="";
					}
					?>
					<!-- PECAH FORM DIBAGI 2 ATAU TIDAK -->
					<?if($two_form == 'yes'){?>
						<div class="col-md-6">
					<?}else{?>
						<div class="col-md-12">
					<?}?>

					<div class="form-group">
						   <label  class="col-md-3 control-label"><?=listGetAt($field_alias_name,$field)?>
						   <?if(listFind($field_required,$field_name_ori)){?>
						   	<font color="red"> *</font>
						   <?}?>
						   </label>
					               <div class="col-md-9">
							<?if($field_type_ori=="text"){?>
								<input name="<?=$field_name_ori?>" type="text" value="" maxlength="<?=$field_size?>" class="form-control" <?=$required?>>
							<?}elseif($field_type_ori=="text-readonly"){?>
								<input name="<?=$field_name_ori?>" type="text" value="" maxlength="<?=$field_size?>" class="form-control" <?=$required?> readonly>
							<?}elseif($field_type_ori=="file"){?>
								<font color="red">::: Upload Dari Form Edit ::: </font><!---<input name="<?=$field_name_ori?>_disabled" type="FILE" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?>  accept="image/*;capture=camera;">-->
								<input name="<?=$field_name_ori?>" type="hidden" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control">
							<?}elseif($field_type_ori=="number"){?>
								<input name="<?=$field_name_ori?>" type="text" value="0.00" maxlength="<?=$field_size?>" class="form-control" <?=$required?>>
							<?}elseif($field_type_ori=="radio"){?>
								
						                         <label class="radio-inline">
						                             <input name="<?=$field_name_ori?>" type="radio" value="1"  <?=$required?>>Yes
						                             </label>
						                             <label class="radio-inline">
						                             <input name="<?=$field_name_ori?>" type="radio" value="0"  <?=$required?> checked>No
								</label>
							<?}elseif($field_type_ori=="checkbox"){?>
								<input name="<?=$field_name_ori?>" type="checkbox" value="1"  class="form-control" <?=$required?>>
							<?}elseif($field_type_ori=="auto-text"){?>
								<?
									$autotext->query("select * from ref_numbering where num_id=".$field_row);
									$autotext->next();
									$max_no=$autotext->row("maxres_no")+1;
									$autotext2->query("update ref_numbering set maxres_no=".$max_no." where num_id=".$field_row);
									$format_no=$autotext->row("format_no");
									$format_no=str_replace('[datetime]',date("Ymd"),$format_no);
									$format_no=str_replace('[max_no]',$max_no,$format_no);
								?>
								<input name="<?=$field_name_ori?>" type="text" value="<?=$format_no?>" maxlength="<?=$field_size?>" class="form-control" readonly>
							<?}elseif($field_type_ori=="textarea"){?>
								<textarea name="<?=$field_name_ori?>" rows="<?=$field_row?>" class="form-control"  <?=$required?>></textarea>
							<?}elseif($field_type_ori=="file"){?>
								<input name="<?=$field_name_ori?>" type="FILE" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?>  accept="image/*;capture=camera;">
							<?}elseif($field_type_ori=="geotag"){?>
								<input name="<?=$field_name_ori?>" type="FILE" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?>  accept="image/*;capture=camera;">
							<?}elseif($field_type_ori=="geoval"){?>
								
							<?}elseif($field_type_ori=="date"){?>
								<input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value=""  <?=$required?>/>
							<?}elseif($field_type_ori=="select"){
								$field_query=$field_size;
								$select_table->query($field_query);
							?>
								<select name="<?=$field_name_ori?>"  class="form-control input-big select2me" data-placeholder="Select..." <?=$required?>>
									<option value=""></option>
									<?while($select_table->next()){?>
										<option value="<?=$select_table->row("id")?>">
											<?=$select_table->row("name")?>
										</option>
									 <?}?>
								</select>
							<?}elseif($field_type_ori=="select-read"){
								$field_query=$field_size;
								$select_table->query($field_query);
							?>

									<select name="<?=$field_name_ori?>_2"  id="<?=$field_name_ori?>_2" class="form-control input-medium select2me" data-placeholder="Select..." disabled>
									 <?
									 $no=1;
									 while($select_table->next()){
										 if($no==1){
											 $val=$select_table->row("id");
										 }
										 ?>
										<option value="<?=$select_table->row("id")?>">
											<?=$select_table->row("name")?>
										</option>
									 <?	$no++;
								 		}?>
								</select>
								<input type="hidden" name="<?=$field_name_ori?>" value="<?=$val?>">
							<?}elseif($field_type_ori=="multiselect"){
								
								$field_query=$field_size;
								$select_table->query($field_query);
								?>
								<select multiple="multiple" class="multi-select" id="my_multi_select3" name="<?=$field_name_ori?>[]">
						                                    <?while($select_table->next()){?>
										<option value="<?=$select_table->row("id")?>">
											<?=$select_table->row("name")?>
										</option>
										<?}?>
								</select>
							<?}elseif($field_type_ori=="maps"){
								//if(!isset($_GET["edit"])){
								?>
								Remark From This system
								<?//}?>
							<?}?>	   
						</div>
					</div>
				</div>
				<?}?>
				<?}?>
			</div>
				<!-- End of Form New -->
				<div class="form-actions fluid">
			                   <div class="col-md-offset-3 col-md-9" align="left">
					<button type="button" class="btn blue" onclick="_cekValid(document.newfrm);">Save</button>
			      		<button type="button" data-dismiss="modal" class="btn default">Close</button>                           
			                   </div>
				</div>
			</div>
	         </div></div></div>
	         </form>
	 </div>
</div>

<?for($divno=1;$divno<=$page_row;$divno++){?>
<div class="modal fade" id="editfrm_<?=$divno?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
            <h4 class="modal-title">Edit</h4>
        </div>
        <div class="modal-body"></div>
    </div>
</div>
</div>


<div class="modal fade" id="myMapModalOK" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
           <!-- h4 class="modal-title"><div id="mapid"></div></h4 -->
        </div>
        <div class="modal-body">
           <div id="map_canvas" style="align:center; width: 100%; height: 400px;"></div>
           <!-- div id="map" style="align:center; width: 100%; height: 300px;"></div -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn default" data-dismiss="modal">Close</button>
        </div>
     </div>
  </div>
</div>
<?}?>


<?}?>


