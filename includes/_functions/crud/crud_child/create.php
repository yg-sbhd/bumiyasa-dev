<?
function _productChildNoPop($child_enable,$child_name,$child_main_query,$nama_table_child,$primary_id_child,$field_name_child,$field_type_child,$field_child_require,$record_show_child){
	global $_POST,$_GET;
	
	$user=cmsDB();
	$select_table = cmsDB();
	$item=cmsDB();
	$status=cmsDB();
	$autotext=cmsDB();
	$autotext2=cmsDB();
	$qchild=cmsDB();
	$search=cmsDB();

if(isset($_GET["insert_child"])){
	// echo "string yesah";
	// die();
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
			
		}elseif($ftype=="number" || $ftype=="number1" || $ftype=="number-readonly"){
			$valnumber = str_replace(",", "",$_POST[$fname]);
			$lstvalue = listAppend($lstvalue,"'".$valnumber."'");
			
		}else{
			$fname = listGetAt($field_name_child,$field);
			$lstvalue = listAppend($lstvalue,"'".postParamSimple($fname)."'");
		}
	}
	$strsql = $strsql . $lstvalue;
	$strsql = $strsql .",'".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")].", '".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")].", '".decryptStringArray(uriParam($_primary_id))."')";
	// echo $strsql;die();
	
	$user->query($strsql);
	$maxID=$user->lastInsertID();
	opt_insertqrychild($maxID);
	echo "<script>location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&edit=yes&".$_primary_id."=".uriParam($_primary_id)."&refresh=".md5("mdYHis")."#child';</script>";
	// echo "<script>location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."#child';</script>";
	die();
}

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
	// echo $strsql;die();
	$user->query($strsql);
	opt_updateqrychild(postParam($primary_id_child));
	echo "<script>location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&edit=yes&".$_primary_id."=".uriParam($_primary_id)."&refresh=".md5("mdYHis")."#child';</script>";
	die();
	
}

$show_detail = cmsDB();
$is_deleted = " and is_deleted=0";
if($child_main_query!=""){
	if(listFind($child_main_query,"where"," ")){
		$child_main_query = $child_main_query. "and ".$_primary_id."=".decryptStringArray(uriParam($_primary_id)).$is_deleted ;
	}else{
		$child_main_query = $child_main_query. "where ".$_primary_id."=".decryptStringArray(uriParam($_primary_id)).$is_deleted;
	}
	$show_detail->query($child_main_query);
}else{
	$show_detail->query("select * from ".$nama_table_child." where ".$_primary_id."=".decryptStringArray(uriParam($_primary_id)).$is_deleted);
}
?>
<div class="card" id="child">
	<div class="card-body">
		<h5><?=$child_name?></h5>
		<div class="row px-3" style="border-bottom: 1px solid #eee;">
			<div class="col-1 p-1">No</div>
			<?
          	for($field=1;$field<=listLen($record_show_child,"~");$field++){
				$row_detail = listGetAt($record_show_child,$field,"~");
				$row_field = listGetAt($row_detail,1,"|");
				$row_fname=listGetAt($row_field,1,"^");
				$row_fname_type=listGetAt($row_field,2,"^");
				$row_aliasName = listGetAt($row_detail,2,"|");
				$row_align = listGetAt($row_detail,3,"|");
				$row_sort = listGetAt($row_detail,4,"|");
             ?>

			<div class="col p-1"><?=$row_aliasName?></div>
			<?}?>
		</div>
		<div class="row px-3">
			<?
			$no=0;
			while ($show_detail->next()) {
					$no++;			

				?>
				<div class="col-md-12">
					<div class="row">
						<div class="col-1 p-1">
							<a href="#" data-toggle="modal" data-target="#editModal-<?=$show_detail->row($primary_id_child)?>" data-original-title="" title="">
								<?=$no;?>
							</a>
						</div>
						
						<?
						for($field=1;$field<=listLen($record_show_child,"~");$field++){
							$row_detail = listGetAt($record_show_child,$field,"~");
							$row_field = listGetAt($row_detail,1,"|");
							$row_fname=listGetAt($row_field,1,"^");
							$row_fname_type=listGetAt($row_field,2,"^");
							$row_aliasName = listGetAt($row_detail,2,"|");
							$row_align = listGetAt($row_detail,3,"|");
							$row_sort = listGetAt($row_detail,4,"|");
							$row_query = listGetAt($row_detail,5,"|");

		            	?>
							<div class="col p-1">

								<?
								// echo $row_query;
							if(listFind($row_query,"select"," ")){
								if(listFind($row_query,"where"," ")){
									$item->query($row_query." and ".$row_field."=".$show_detail->row($row_field));
								}else{
									$item->query($row_query." where ".$row_field."=".$show_detail->row($row_field));
								}

								if($item->recordCount()){
									$item->next();
									$val_fname = $item->row("name");
								}else{
									$val_fname = "-";
								}
								echo $val_fname;	
							}else{
								echo $show_detail->row($row_field);
							}?>
							</div>
						
						<?}?>
					</div>
				</div>

				<div class="modal fade" id="editModal-<?=$show_detail->row($primary_id_child)?>" tabindex="-1" role="dialog" aria-labelledby="editModal-<?=$show_detail->row($primary_id_child)?>" style="display: none;" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
						<div class="modal-content">
	 						<form action="<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&edit=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&update_child=yes&refresh=<?=md5("mdYHis")?>#child" method="post" name="updatechildform2" enctype="multipart/form-data" id="updateform" class="form-horizontal">
								
												
								<div class="modal-header">
									<h6 class="modal-title">Edit Item</h6>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
								</div>
								<div class="modal-body">
									<div class="row px-3">
										<?
							          	for($field=1;$field<=listLen($record_show_child,"~");$field++){
											$row_detail = listGetAt($record_show_child,$field,"~");
											$row_field = listGetAt($row_detail,1,"|");
											$row_fname=listGetAt($row_field,1,"^");
											$row_fname_type=listGetAt($row_field,2,"^");
											$row_aliasName = listGetAt($row_detail,2,"|");
											$row_align = listGetAt($row_detail,3,"|");
											$row_sort = listGetAt($row_detail,4,"|");
							             ?>
											<div class="col p-1"><?=$row_aliasName?></div>
										<?}?>
									</div>
									<div class="row px-3">
										<input type="hidden" name="<?=$primary_id_child?>" value="<?=$show_detail->row($primary_id_child)?>">
										
							             <?
										for($a=1;$a<=listLen($field_type_child, '#');$a++){
											$field_detail=listGetAt($field_type_child,$a,"#"); //Ambil Detail Field
											$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
											// echo $field_name_ori;
											$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
											$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
											$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
											
											if(listFind($field_child_require,$field_name_ori)){
												$required_child="required='required'";
											}else{
												$required_child="";
											}
										?>
											<div class="col p-1">
												<?
												if($field_type_ori == "select"){
													edit_select($field_name_ori, $field_size, $required_child, $show_detail->row($field_name_ori));
												}else{
													
													edit_text($field_name_ori, $show_detail->row($field_name_ori), $field_size, $required, $field_row);

												}
												?>
												<!-- <input class="w-100" type="text" name="<?=$row_field?>" value="<?=$show_detail->row($row_field)?>"> -->
											</div>
										<?}?>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal" data-original-title="" title="">Delete</button> -->
									<button type="button" class="btn btn-secondary btn-sm" onclick="if(confirm('Anda Yakin Hapus Data Ini?')){ location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&delete_child=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&<?=$primary_id_child?>=<?=$show_detail->row($primary_id_child)?>&ref=<?=md5(date("mdyHis"))?>#child';} " data-target="#child">Delete</button>
									
                                    <button type="submit" class="btn btn-primary btn-sm" data-target="#child" >Update</button>

									<!-- <button class="btn btn-primary btn-sm" type="button" data-original-title="" title="">Update</button> -->
								</div>
							</form>

						</div>
					</div>
				</div>

			<?}?>
		</div>

		<form action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&edit=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&insert_child=yes&refresh=<?=md5("mdYHis")?>" method="post" name="newformchild" enctype="multipart/form-data" id="newformchild" class="form-horizontal">

			<div class="row px-3">
				<div class="col-1 p-1">
					?
				</div>
				<?
				for($a=1;$a<=listLen($field_type_child, '#');$a++){
					$field_detail=listGetAt($field_type_child,$a,"#"); //Ambil Detail Field
					$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
					// echo $field_name_ori;
					$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
					$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
					$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
					
					if(listFind($field_child_require,$field_name_ori)){
						$required_child="required='required'";
					}else{
						$required_child="";
					}
				?>
					<div class="col-<?=$field_row?> p-1">
						<?if($field_type_ori=="text"){
							add_text($field_name_ori, $required_child);
						}elseif($field_type_ori=="text-readonly"){
							add_text_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="textarea"){
							add_textarea($field_name_ori, $required_child);
						}elseif($field_type_ori=="textarea-readonly"){
							add_textarea_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="int"){
							add_int_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="int-readonly"){
							add_int_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="number"){
							add_number_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="number-readonly"){
							add_number_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="decimal"){
							add_decimal_($field_name_ori, $required_child);
						}elseif($field_type_ori=="decimal-readonly"){
							add_decimal_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="telephone"){
							add_telephone($field_name_ori, $required_child);
						}elseif($field_type_ori=="date"){
							add_date($field_name_ori, $required_child);
						}elseif($field_type_ori=="date-readonly"){
							add_date_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="time"){
							add_time($field_name_ori, $required_child);
						}elseif($field_type_ori=="time-readonly"){
							add_time_readonly($field_name_ori, $required_child);
						}elseif($field_type_ori=="select"){
							add_select($field_name_ori, $field_size, $required_child);
						}elseif($field_type_ori=="select-readonly"){
							add_select_readonly($field_name_ori, $field_size, $required_child);
						}elseif($field_type_ori=="multiselect"){
							add_multiselect($field_name_ori, $field_size, $required_child);
						}?>
						<!-- <input class="w-100" type="text" name="<?=$field_name_ori?>" <?=$required_child?>> -->
					</div>
				
				<?}?>

				<!-- <div class="col-12" align="center">
					<button type="button" class="btn btn-success btn-sm" onclick="location='<?=$url_new?>';"><i class="icon-save icon-white"></i> &nbsp; Save</button>
				</div> -->
			</div>
			<div class="row px-3">
				<div class="col" align="center">
					<button type="button" class="btn btn-success btn-sm" onclick="_cekChildValid(document.newformchild);">
						<i class="icon-save icon-white"></i> &nbsp; Save
					</button>
				</div>
			</div>
		</form>

<!-- 			<div class="col p-1">
				<button type="button" class="btn btn-light btn-sm" onclick="location='<?=$url_new?>';" class="btn default"><i class="icofont icofont-swoosh-left icon-black"></i> Save</button>
			</div> -->
		<!-- </div> -->
	</div>
	<div class="card-footer">
		
	</div>
</div>
<?}?>