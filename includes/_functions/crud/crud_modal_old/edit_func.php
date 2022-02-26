<?
if(isset($_GET["update"])){
		$strsql = "update ".$nama_table." set ";
		$lstvalue = "";
		for($field=1;$field<=listLen($field_name);$field++){
			$fname = listGetAt($field_name,$field);
			$ftype_org= listGetAt($field_type_name,$field,"#");
			$ftype = listGetAt($ftype_org,2,"|");
			//echo $fname . "<BR>";
			if($ftype=="file"){
				$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_file/';
				$uploadfile = $uploaddir . "upload_".$nama_table . "_" . date("mdYHis")."_".listFirst($_FILES[$fname]['name'],".").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload_".$nama_table . "_" .  date("mdYHis")."_".listFirst($_FILES[$fname]['name'],".").".". listLast($_FILES[$fname]['name'],".");
				
				//if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
				if(is_uploaded_file($_FILES[$fname]['tmp_name'])){
					//echo "File is valid, and was successfully uploaded.\n";
					copy($_FILES[$fname]['tmp_name'], $uploadfile);

					$file_doc = $uploadfile_alias;
				} else {
					$file_doc = "";
				}
				if(strlen($file_doc)){
					$lstvalue = listAppend($lstvalue,$fname."='".$file_doc."'");
				}
			}elseif($ftype=="image"){
				$uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
				$uploadfile = $uploaddir . "upload_".$nama_table . "_" . date("mdYHis")."_".listFirst($_FILES[$fname]['name'],".").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload_".$nama_table . "_" .  date("mdYHis")."_".listFirst($_FILES[$fname]['name'],".").".". listLast($_FILES[$fname]['name'],".");
				
				//if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
				if(is_uploaded_file($_FILES[$fname]['tmp_name'])){
					//echo "File is valid, and was successfully uploaded.\n";
					copy($_FILES[$fname]['tmp_name'], $uploadfile);

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
			}elseif($ftype=="moreselect"){
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
			}elseif($ftype=="select"){
				if (!empty($_POST[$fname])) {
					$lstvalue = listAppend($lstvalue,$fname."='".postParamSimple($fname)."'");
				}else{
					$lstvalue = listAppend($lstvalue,$fname."='0'");
				}
				
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
				
			}elseif($ftype=="password"){	
				if(trim(postParam($fname))<>""){
					$fname = listGetAt($field_name,$field);
					$lstvalue = listAppend($lstvalue,$fname."=PASSWORD('".postParamSimple($fname)."')");
				}
			}elseif($ftype=="date"  || $ftype=="date-readonly"){
				$date_org = $_POST[$fname];
				$year=listGetAt($date_org,3,"/");
				$month=listGetAt($date_org,2,"/");
				$day=listGetAt($date_org,1,"/");
				$date_fix=$year . "-" . $month . "-".$day." 00:00:00";
				$lstvalue = listAppend($lstvalue,$fname."='".$date_fix."'");
			}elseif($ftype=="time" || $ftype=="time-readonly"){
				$date_org = $_POST[$fname];
				// $year=listGetAt($date_org,3,"/");
				// $month=listGetAt($date_org,2,"/");
				// $day=listGetAt($date_org,1,"/");
				// $date_fix=$year . "-" . $month . "-".$day;
				$time_org = $_POST[$fname."_timehour"].":".$_POST[$fname."_timeminute"].":00";
				$lstvalue = listAppend($lstvalue,$fname."='".$time_org ."'");
			
			}elseif($ftype=="datefromtime" || $ftype=="datefromtime-readonly"){
				$date_org = $_POST[$fname];
				$year=listGetAt($date_org,3,"/");
				$month=listGetAt($date_org,2,"/");
				$day=listGetAt($date_org,1,"/");
				$date_fix=$year . "-" . $month . "-".$day;
				$time_org = $_POST[$fname."_timehour"].":".$_POST[$fname."_timeminute"].":00";
				//$lstvalue = listAppend($lstvalue,"'".$date_fix." ". $time_org ."'");
				$lstvalue = listAppend($lstvalue,$fname."='".$date_fix." ". $time_org."'");
			
			}elseif($ftype=="datefromtimetotime" || $ftype=="datefromtimetotime-readonly"){
				$date_org = $_POST[$fname];
				$year=listGetAt($date_org,3,"/");
				$month=listGetAt($date_org,2,"/");
				$day=listGetAt($date_org,1,"/");
				$date_fix = $year . "-" . $month . "-".$day;
				$time_org = $_POST[$fname."_timehour"].":".$_POST[$fname."_timeminute"].":00";
				$lstvalue = listAppend($lstvalue,$fname."='".$date_fix." ". $time_org."'");
				
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
		$strsql = $strsql . " where ".$primary_id ."=".decryptStringArray(uriParam($primary_id));
		//echo $strsql;die();
		$user->query($strsql);
		
		update_relational(decryptStringArray(uriParam($primary_id)), $nama_table, $primary_id, $relational_txt);

		opt_updateqry(decryptStringArray(uriParam($primary_id)));
		// die();

		// echo "<script>alert('Data Successfully Updated..');location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";die();
		echo "<script>;location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";die();
		
	}