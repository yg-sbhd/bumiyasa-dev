<?php
if(isset($_GET["insert"])){

	$strsql = "insert into ".$nama_table."(".$field_name.",insert_date,insert_by,update_date,update_by) values(";
	
	$lstvalue = "";
		
	for($field=1;$field<=listLen($field_name);$field++){
		$fname = listGetAt($field_name,$field);
		$ftype_org= listGetAt($field_type_name,$field,"#");
		$ftype = listGetAt($ftype_org,2,"|");
		$autonum = listGetAt($ftype_org,3,"|"); 
		$autonum = listGetAt($autonum,2,"^");//auto number id
		
		if($ftype=="file"){
			$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_files/';
			$uploadfile = $uploaddir . "upload" . "_" . date("mdYHis")."_".listFirst($_FILES[$fname]['name'],".").".". listLast($_FILES[$fname]['name'],".");
			$uploadfile_alias = "upload" . "_" . date("mdYHis")."_".listFirst($_FILES[$fname]['name'],".").".". listLast($_FILES[$fname]['name'],".");
			//if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
			if(is_uploaded_file($_FILES[$fname]['tmp_name'])){
				//echo "File is valid, and was successfully uploaded.\n";
				copy($_FILES[$fname]['tmp_name'], $uploadfile);
				//echo "File is valid, and was successfully uploaded.\n";
				$file_doc = $uploadfile_alias;
			} else {
				//echo "File is Invalid, and was successfully uploaded.\n";
				$file_doc = "";
			}
			
			$lstvalue = listAppend($lstvalue,"'".$file_doc."'");
		}elseif($ftype=="image"){
			$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
			$uploadfile = $uploaddir . "upload" . "_" . date("mdYHis")."_".listFirst($_FILES[$fname]['name'],".").".". listLast($_FILES[$fname]['name'],".");
			$uploadfile_alias = "upload" . "_" . date("mdYHis")."_".listFirst($_FILES[$fname]['name'],".").".". listLast($_FILES[$fname]['name'],".");
			//if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
			if(is_uploaded_file($_FILES[$fname]['tmp_name'])){
				//echo "File is valid, and was successfully uploaded.\n";
				copy($_FILES[$fname]['tmp_name'], $uploadfile);
				//echo "File is valid, and was successfully uploaded.\n";
				$file_doc = $uploadfile_alias;
			} else {
				//echo "File is Invalid, and was successfully uploaded.\n";
				$file_doc = "";
			}
			
			$lstvalue = listAppend($lstvalue,"'".$file_doc."'");
			
		}elseif($ftype=="multiselect" || $ftype=="moreselect"){
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
		// }elseif($ftype=="moreselect"){
		// 	if (!empty($_POST[$fname])) {
		// 		$strlist = "";
		// 		foreach ($_POST[$fname] as $names)
		// 		{
		// 			$strlist = listAppend($strlist,$names);
		// 		}
		// 		$lstvalue = listAppend($lstvalue,"'".$strlist."'");
		// 	}else{
		// 		$lstvalue = listAppend($lstvalue,"'0'");
		// 	}	
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
					$lstvalue = listAppend($lstvalue,"'".$file_doc."'");
					$lstvalue = listAppend($lstvalue,"'".$lon."'");
					$lstvalue = listAppend($lstvalue,"'".$lat."'");
					
				}else{
					echo "<script>alert('No Geo Tag in Uploaded Photo..');history.back();</script>";die();
				}
			}else{
				echo "<script>alert('Photo Can not be uploaded..');history.back();</script>";die();
			}
		}elseif($ftype=="password"){	
			$fname = listGetAt($field_name,$field);
			$lstvalue = listAppend($lstvalue,"PASSWORD('".postParamSimple($fname)."')");
		}elseif($ftype=="geoval"){	
			//ignore, sudah di isi diatas
		
		}elseif($ftype=="date" || $ftype=="date-readonly"){
			$date_org = $_POST[$fname];
			$year=listGetAt($date_org,3,"/");
			$month=listGetAt($date_org,2,"/");
			$day=listGetAt($date_org,1,"/");
			$date_fix=$year . "-" . $month . "-".$day." 00:00:00";
			$lstvalue = listAppend($lstvalue,"'".$date_fix."'");
		
		}elseif($ftype=="datefromtime" || $ftype=="datefromtime-readonly"){
			$date_org = $_POST[$fname];
			$year=listGetAt($date_org,3,"/");
			$month=listGetAt($date_org,2,"/");
			$day=listGetAt($date_org,1,"/");
			$date_fix=$year . "-" . $month . "-".$day;
			$time_org = $_POST[$fname."_timehour"].":".$_POST[$fname."_timeminute"].":00";
			$lstvalue = listAppend($lstvalue,"'".$date_fix ." " . $time_org ."'");
		
		}elseif($ftype=="datefromtimetotime" || $ftype=="datefromtimetotime-readonly"){
			$date_org = $_POST[$fname];
			$year=listGetAt($date_org,3,"/");
			$month=listGetAt($date_org,2,"/");
			$day=listGetAt($date_org,1,"/");
			$date_fix = $year . "-" . $month . "-".$day;
			$time_org = $_POST[$fname."_timehour"].":".$_POST[$fname."_timeminute"].":00";
			$lstvalue = listAppend($lstvalue,"'".$date_fix ." " . $time_org ."'");
		}elseif($ftype=="time" || $ftype=="time-readonly"){
			$date_org = $_POST[$fname];
			// $year=listGetAt($date_org,3,"/");
			// $month=listGetAt($date_org,2,"/");
			// $day=listGetAt($date_org,1,"/");
			// $date_fix=$year . "-" . $month . "-".$day;
			$time_org = $_POST[$fname."_timehour"].":".$_POST[$fname."_timeminute"].":00";
			echo "string = " . $time_org;
			$lstvalue = listAppend($lstvalue,"'".$time_org ."'");
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
			
		}elseif($ftype=="number" || $ftype=="number1" || $ftype=="number-readonly"  || $ftype=="number_otorisasi" || $ftype=="int" || $ftype=="decimal"){
			$valnumber = str_replace(",", "",$_POST[$fname]);
			$lstvalue = listAppend($lstvalue,"'".$valnumber."'");
			
		}else{
			$fname = listGetAt($field_name,$field);
			$lstvalue = listAppend($lstvalue,"'".postParamSimple($fname)."'");
		}
		
	}
	$strsql = $strsql . $lstvalue;

	$strsql = $strsql .",'".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")].",'".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")].")";
	// echo $strsql;die();
	$user->query($strsql);
	$maxID=$user->lastInsertID();

	update_relational($maxID, $nama_table, $primary_id, $relational_txt);


	opt_insertqry($maxID);
	
		// echo "<script>alert('Record Saved..!');location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";
		echo "<script>location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";

	die();
	//
	}




?>