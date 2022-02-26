<?
function formgenerator($form_type,$form_title,$main_query,$nama_table,$primary_id,$primary_id_value,$secondary_id,$secondary_id_value,$field_name,$field_alias_name,$field_type_name,$field_required,$start_variable,$form_variable,$cancel_variable){
global $ANOM_VARS,$_POST,$_GET,$_SESSION;

$popupmax = ListValueCount($field_type_name,"selectpopup","|");
//echo "Jumlah Popup : ".$popupmax;
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

//FORM VALIDATION GENERATOR	
if(listLen($field_required)){
?>
    <script>
    function _cekValid(frm){
        //alert("test : ");
        <?
        for($req=1;$req<=listLen($field_required);$req++){
            $nmfield=listGetAt($field_required,$req);
            $posfield=listFind($field_name,$nmfield);
            $ftype=listGetAt(listGetAt($field_type_name,$posfield),2,"|");
            $posfield_alias=listGetAt($field_alias_name,$posfield);
            
            if(!isset($_GET["edit"])){?>
                if(frm.<?=trim($nmfield)?>.value==''){ 
                    alert('Please Input <?=$posfield_alias?> !'); 
                    frm.<?=trim($nmfield)?>.focus();
                    return false;
                }
        <?
            }
        }?>
        var getURLs = document.location.href;
        frm.submit();
    }
    </script>
<?
}

if($form_type=="edit_form"){
    /* EDIT FORM GENERATOR */
    /*====================*/
    if(isset($_GET["updatefrmgen"])){
        $strsql = "update ".$nama_table." set ";
        $lstvalue = "";
        for($field=1;$field<=listLen($field_name);$field++){
            $fname = listGetAt($field_name,$field);
            $ftype_org= listGetAt($field_type_name,$field,"#");
            $ftype = listGetAt($ftype_org,2,"|");
            //echo $ftype . "<BR>";
            if($ftype=="file"){
               /* 
               $uploaddir = $ANOM_VARS["www_file_path"] . 'upload_files/';
                $uploadfile = $uploaddir . "upload_".$nama_table . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
                $uploadfile_alias = "upload_".$nama_table . "_" .  date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
                
                if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
                    //echo "File is valid, and was successfully uploaded.\n";
                    $file_doc = $uploadfile_alias;
                } else {
                    $file_doc = "";
                }
                if(strlen($file_doc)){
                    $lstvalue = listAppend($lstvalue,$fname."='".$file_doc."'");
                }
                */
                $uploaddir = $ANOM_VARS["www_file_path"] . 'upload_files/';
				$uploadfile = $uploaddir . "upload_".$nama_table . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				$uploadfile_alias = "upload_".$nama_table . "_" .  date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
				
				//if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
				if(is_uploaded_file($_FILES[$fname]['tmp_name'])){
                    //echo "File is valid, and was successfully uploaded.\n";
                    //echo $_FILES[$fname]['tmp_name']."--" . $uploadfile;
					copy($_FILES[$fname]['tmp_name'], $uploadfile);
					$file_doc = $uploadfile_alias;
				} else {
					$file_doc = "";
				}
				if(strlen($file_doc)){
                    //echo $file_doc;die();
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
        $strsql = $strsql . ",update_date='".date("Y-m-d H:i:s")."',update_by=".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] ;
        $strsql = $strsql . " where ".$primary_id ."=".$primary_id_value;
        //echo $strsql;die();
        $user->query($strsql);
        opt_updateqry(uriParam($primary_id));
        echo "<script>alert('Data Successfully Updated..');location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp").$form_variable."&refresh=".md5("mdYHis")."';</script>";die();
        
    }

    /*FORM EDIT BUILDER*/
    /*=================*/
    //if(isset($_GET["editfrmgen"])){
        $edit=cmsDB();
        $strsql = "select * from ".$nama_table." where ".$primary_id."=".$primary_id_value;
        //echo $strsql;
        $edit->query($strsql);
        $edit->next();
    
        $get_primary_id = listGetAt($_SERVER["QUERY_STRING"],3,"&");
        $_primary_id = listGetAt($get_primary_id,1,"=");
    
      ?>
        <form action="<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&updatefrmgen=yes<?=$form_variable?>&refresh=<?=md5("mdYHis")?>" method="post" name="updateformgen" enctype="multipart/form-data" id="updateform" class="form-horizontal">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title"><i class="icon-info-sign"></i> <?=$form_title?></h4>
                  </div>
                  <div class="modal-body">
                    <div class="portlet-body form">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label  class="col-md-3 control-label">
                        <font size=-1>
                        <?=listGetAt($field_alias_name,$field);?>
                          <?if(listFind($field_required,$field_name_ori)){?>
                               <font color="red"> *</font>
                        <?}?>
                        </font>
                       </label>
                        <div class="col-md-9">
                        <?if($field_type_ori=="text"){?>
                            <input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> <?=$field_row?>>
                        <?}elseif($field_type_ori=="auto-text"){?>
                            <input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" readonly>
                        <?}elseif($field_type_ori=="checkbox"){?>
                            <input name="<?=$field_name_ori?>" type="checkbox" value="1"  class="form-control" <?=$required?> <?if($edit->row($field_name_ori)==1){echo "checked";}?>> 
                            
                        <?}elseif($field_type_ori=="number"){?>
                            <input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control"  <?=$required?>>
                        <?}elseif($field_type_ori=="textarea"){?>
                            <textarea name="<?=$field_name_ori?>" rows="<?=$field_row?>" class="form-control"  <?=$required?>><?=$edit->row($field_name_ori)?></textarea>
                        <?}elseif($field_type_ori=="file"){?>
                            <input name="<?=$field_name_ori?>" type="FILE" value="" maxlength="<?=$field_size?>" class="form-control"  <?=$required?> accept="image/*;capture=camera;">
                            <?if(strlen($edit->row($field_name_ori))){?>
                                <a href="<?=$ANOM_VARS["www_file_url"]?>upload_files/<?=$edit->row($field_name_ori)?>" target="_new">[ Lihat Dokumen ]</a>
                            <?}?>
                        <?}elseif($field_type_ori=="geotag"){?>
                            <input name="<?=$field_name_ori?>" type="FILE" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control"  accept="image/*;capture=camera;">
                            <?if(strlen($edit->row($field_name_ori))){?>
                                <a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$edit->row($field_name_ori)?>" target="_new">[ Lihat Dokumen ]</a>
                            <?}?>	
                        <?}elseif($field_type_ori=="geoval"){?>
                                
                        <?}elseif($field_type_ori=="date"){?>
                            <input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=datesql2date($edit->row($field_name_ori))?>"  <?=$required?> /> 
                            
                        <?}elseif($field_type_ori=="select"){
                                $field_query=$field_size;
                                $field_id = listGetAt($field_query,2," ");
                                $field_isi_select = $edit->row($field_name_ori);
                                //echo "isi : ".$edit->row($field_name_ori);
                                if($field_id<>$field_name_ori){
                                    $field_asal = $field_name_ori;
                                    $field_name_ori = $field_id;
                                }else{
                                    $field_asal = $field_name_ori;
                                }
                                //echo $field_query." | " . $field_name_ori;
                                if(listFind($field_query,"where"," ")){
                                    //$field_query=listGetAt($field_query,1,"where");
                                    $strsql = $field_query . " and " . $field_name_ori . "='". $field_isi_select."'";
                                }else{
                                    $strsql = $field_query . " where " . $field_name_ori . "='". $field_isi_select."'";
                                   }
                                $select_table->query($strsql);
                                //echo $strsql."<BR>".
                                $select_table->next();
                                $sel_id = $select_table->row("id");
                                if($sel_id==""){
                                    $sel_id=0;
                                }
                                $sel_name =$select_table->row("name");
                                //echo "Nama : ".$sel_name;
                                if(listFind($field_query,"where"," ")){
                                    $strsql = $field_query . " and " . $field_name_ori . "<>'".  $field_isi_select."'";
                                    
                                }else{
                                    $strsql = $field_query . " where " . $field_name_ori . "<>'".  $field_isi_select ."'";
                                }
                                $select_table->query($strsql);
                                //echo $strsql;
                                //echo "asal : ".$field_asal;
                                ?>
                                <select name="<?=$field_asal?>" id="<?=$field_asal?>" class="form-control input-big select2me" >
                                <option value="<?=$sel_id?>" selected><?=$sel_name?></option>
                                <?while($select_table->next()){?>
                                    <option value="<?=$select_table->row("id")?>">
                                        <?=$select_table->row("name")?>
                                    </option>
                                 <?}?>
                             </select>
                        
                        <?}elseif($field_type_ori=="selectpopup"){
                                $field_query=$field_size;
                                 $querypopup = str_replace(" ","|",$field_query);
                                 $querypop = str_replace("|"," ",$field_query);
                                 $main_query=listGetAt($querypop,1,"~");
                                 $record_show=listGetAt($querypop,2,"~");
                                $primarytext_id= listGetAt($querypop,4,"~");
                                 if(listLen($record_show)>1){
                                    $primary_text= listGetAt($record_show,2);
                                }else{
                                    $primary_text= listGetAt($record_show,1);
                                }
                                 //$primary_text= listGetAt($record_show,2);
                                 $field_isi_select = $edit->row($field_name_ori);
                                // echo $main_query;
                                
                                //if(listFind($main_query ,"where"," ")){
                                
                                if(ListValueCount(strtolower($main_query),"where"," ") == 1){
                                    $strsql = $main_query  . " and " . $primarytext_id . "='". $field_isi_select."'";
                                }elseif(ListValueCount(strtolower($main_query),"where"," ") > 1){
                                    //$field_query=listGetAt($field_query,1,"where");
                                    $strsql = $main_query  . " and " . $primarytext_id . "='". $field_isi_select."'";
                                }else{
                                    $strsql = $main_query  . " where " . $primarytext_id . "='". $field_isi_select."'";
                                   }
                                $select_table->query($strsql);
                                //echo $strsql."<BR>";
                                
                                if($select_table->recordCount()){
                                    $select_table->next();
                                    $sel_id = $select_table->row($primarytext_id);
                                    $sel_name =$select_table->row($primary_text);
                                }else{
                                    $sel_id = "";
                                    $sel_name = "";
                                }
                                
                                ?>
                                <input name="<?=$field_name_ori?>_2" type="text" value="<?=$sel_name?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> disabled>
                                <input name="<?=$field_name_ori?>" type="hidden" value="<?=$sel_id?>" >
                                <a href="javascript:PopWindow('templates/selectpopup.php?q=<?=$querypopup?>&fname=updateform.<?=$field_name_ori?>&ref=<?=md5(date("mdyHis"))?>','frmpop','500','500',',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" class="btn green"><i class="icon-search"></i></a>
                                
                        
                        <?}elseif($field_type_ori=="multiselect"){
                                    $field_query=$field_size;
                                    $select_table->query($field_query);
                                    ?>
                                    <select  class="col-md-12 form-control" name="<?=$field_name_ori?>[]" multiple="yes" size="10">
                                                            <?while($select_table->next()){?>
                                        <option value="<?=$select_table->row("id")?>" <? if(listFind($edit->row($field_name_ori),$select_table->row("id"))){ echo " selected";}?>>
                                            <?=$select_table->row("name")?>
                                        </option>
                                    <?}?>
                                    </select><!--&nbsp;Ctrl+Klik to select more than 1 (one)-->
                                    
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
                            Remark From this system
                                
                        <?}?>
                                                
                                               </div>
                                            </div>
                                        </div>
                <?}?>
                              <?}?>
                          </div></div>
                <?
                $lstfieldname = "";
                for($field=1;$field<=listLen($field_name);$field++){
                    $field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
                    $field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
                    $lstfieldname=listAppend($lstfieldname,"updateform.".$field_name_ori); 
                }?>
                
                 <div class="form-actions fluid">
                                        <div class="form-group" align="center">
                
                <? if($edit->row("verify")==0){?>
                <?if(_checkauth("Edit")){?>
                    <button type="button" class="btn green" onclick="_cekValid(document.updateformgen);">Update</button>
                <?}?>
                <?if(_checkauth("Delete")){?>
                   <button type="button" class="btn red" onclick="if(confirm('Are You Sure Want to Delete this Record?')){ location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&delete=yes&<?=$primary_id?>=<?=uriParam($primary_id)?>&ref=<?=md5(date("mdyHis"))?>';} ">Delete</button>
                <?}?>
                
                 <?if(_checkauth("Print")){?>
                    <a class="btn green" href="<?$_SERVER["SCRIPT_NAME"]?>?tmp=templates/print/<?=listLast($nama_table,"_")?>.php&<?=$primary_id?>=<?=uriParam($primary_id)?>&refresh=<?=md5(date("mdYHis"))?>">Print <i class="icon-print"></i></a>
                <?}?> 
                
                <? 
                //if(uriParam("tmp")=="templates/bahanbaku/terima.php" || uriParam("tmp")=="templates/penjualan/ekspor.php"){
                if($edit->row("verify")==0){?>
                    <?if(_checkauth("verify")){?>
                        <button type="button" class="btn blue" onclick="if(confirm('Are You Sure Want to Verify this Transaction, Data will not be able to edit or deleted?')){ location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&edit=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&verify=yes&ref=<?=md5(date("mdYHis"))?>';} ">Verify Transaction</button>
                <? }}
                }?>
                <?
                $url_string = str_replace("edit=yes&","",$_SERVER["QUERY_STRING"]);
                //$_str = $primary_id . "=" . $admin->row($primary_id) ."&'';
                //$url_string = str_replace($_str,"",$url_string);
                //$url_new = "?". $url_string. "&ref=".md5(date("mdYHis"));
                ?>
                <button type="button" class="btn" onclick="location='<?=$cancel_variable;?>'" class="btn default">Cancel</button>                   
                </div>
            </div>
            </form>
                
            
    
                           <!-- END SAMPLE TABLE PORTLET-->
                                  <!-- END FORM--> 
            </div>
            </div>
    <?//}


}elseif($form_type=="new_form"){
    /* NEW FORM GENERATOR */
    /*====================*/
    if(isset($_GET["insertfrmgen"])){
        if(listFind($field_name,"maps")){
            $posmap=listFind($field_name,"maps");
            $field_nameupdate=ListSetAt($field_name,$posmap,"lon,lat"); 
            $strsql = "insert into ".$nama_table."(".$field_nameupdate.",".$secondary_id.",insert_date,insert_by) values(";
        }else{
            $strsql = "insert into ".$nama_table."(".$field_name.",".$secondary_id.",insert_date,insert_by) values(";
        }
        $lstvalue = "";
        
        for($field=1;$field<=listLen($field_name);$field++){
            $fname = listGetAt($field_name,$field);
            $ftype_org= listGetAt($field_type_name,$field,"#");
            $ftype = listGetAt($ftype_org,2,"|");
            $autonum = listGetAt($ftype_org,3,"|"); 
            $autonum = listGetAt($autonum,2,"^");//auto number id
            if($ftype=="file"){
                $uploaddir = $ANOM_VARS["www_file_path"] . 'upload_photo/';
                $uploadfile = $uploaddir . "upload" . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
                $uploadfile_alias = "upload" . "_" . date("mdYHis").".". listLast($_FILES[$fname]['name'],".");
                if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
                    //echo "File is valid, and was successfully uploaded.\n";
                    $file_doc = $uploadfile_alias;
                } else {
                    //echo "File is Invalid, and was successfully uploaded.\n";
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
                
                
                //echo $file_doc ."---";
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
        $strsql = $strsql .",'".$secondary_id_value."','".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] .")";
        //echo $strsql;die();
        $user->query($strsql);
        $maxID=$user->lastInsertID();
        opt_insertqry($maxID);
        
        echo "<script>alert('Record Saved..!, Please Insert Your Detail');location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&edit=yes&".$primary_id."=".$maxID."&".$secondary_id."=".$secondary_id_value."&refresh=".md5("mdYHis")."';</script>";
        die();
        //
    }
?>
    <form  id="form" name="newfrmgen" action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&insertfrmgen=yes&<?=$secondary_id?>=<?=$secondary_id_value?>&refresh=<?=md5("mdYHis")?>" class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
           <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title"><?=$form_title?></h4>
                  </div>
                  <div class="modal-body">
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
    
                <!-- form new -->
                <?
                $popupcount=1;
                for($field=1;$field<=listLen($field_name);$field++){?>
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
                        <div class="col-md-6">
                            
                        
                            <div class="form-group">
                                <label  class="col-md-3 control-label">
                                    <font size=-1>
                                           <?=listGetAt($field_alias_name,$field)?>
                                        <?if(listFind($field_required,$field_name_ori)){?>
                                        <font color="red"> *</font>
                                        <?}?>
                                    </font>
                                </label>
                                <div class="col-md-9">
                                    <?if($field_type_ori=="text"){?>
                                        <input name="<?=$field_name_ori?>" type="text" value="" maxlength="<?=$field_size?>" class="form-control" <?=$required?> <?=$field_row?>>
                                    <?}elseif($field_type_ori=="file"){?>
                                        <input name="<?=$field_name_ori?>" type="FILE" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?>  accept="image/*;capture=camera;">
                                    <?}elseif($field_type_ori=="number"){?>
                                        <input name="<?=$field_name_ori?>" type="text" value="0.00" maxlength="<?=$field_size?>" class="form-control" <?=$required?>>
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
                                        <input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"  <?=$required?>/>
                                    <?}elseif($field_type_ori=="selectpopup"){
                                        $field_query=$field_size;
                                        $qry_tmp = listGetAt($field_query,1,"~");
                                        $id_tmp = listLast($field_query,"~");
                                        $name_tmp = $field_row;
                                         $querypop = str_replace(" ","|",$field_query);
                                        //echo $qry_tmp."<BR>".$id_tmp."<BR>".$name_tmp."<BR>";
                                        $select_table->query($qry_tmp);
                                        if($select_table->recordCount()==1){
                                            $select_table->next();
                                            $id_input = $select_table->row($id_tmp);
                                            $name_input = $select_table->row($name_tmp);
                                        }else{
                                            $id_input ="";
                                            $name_input = "";
                                        }
                                         ?>
                                        <input name="<?=$field_name_ori?>_2" type="text" value="<?=$name_input?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> disabled>
                                        <input name="<?=$field_name_ori?>" type="hidden" value="<?=$id_input?>" >
                                        <a href="javascript:PopWindow('templates/selectpopup.php?q=<?=$querypop?>&fname=newfrm.<?=$field_name_ori?>&ref=<?=md5(date("mdyHis"))?>','frmpop','500','500',',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" class="btn green"><i class="icon-search"></i></a>
                                        
                                    <?}elseif($field_type_ori=="select"){
                                        $field_query=$field_size;
                                        $select_table->query($field_query);
                                        if($select_table->recordCount()==1){
                                            $autosel = "yes";
                                        }else{
                                            $autosel = "no";
                                        }
                                        if(isset($_GET["search"])){
                                            if(isset($_GET["chk_".$field_name_ori])){
                                                $isi_id = uriParam($field_name_ori);
                                            }
                                        }else{
                                            $isi_id = 0;
                                        }
                                    ?>
                                        <select name="<?=$field_name_ori?>"  class="form-control input-big select2me" data-placeholder="Select..." <?=$required?>>
                                            <option value=""></option>
                                            <?while($select_table->next()){?>
                                                <option value="<?=$select_table->row("id")?>" <?if($isi_id ==$select_table->row("id")){ echo " selected"; }?> <?if($autosel=="yes"){ echo " selected";}?>>
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
                                        <select  class="col-md-12 form-control" name="<?=$field_name_ori?>[]" multiple="yes"  size="10">
                                            <?while($select_table->next()){?>
                                                <option value="<?=$select_table->row("id")?>">
                                                    <?=$select_table->row("name")?>
                                                </option>
                                            <?}?>
                                        </select>
                                        <!--&nbsp;Ctrl+Klik to select more than 1 (one)-->
                                    <?}elseif($field_type_ori=="maps"){
                                        //if(!isset($_GET["edit"])){
                                        ?>
                                        Remark FRom This system
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
                    <button type="button" class="btn green" onclick="_cekValid(document.newfrmgen);">Save</button>
                    <?
                    $url_string = str_replace('new_form=yes&', '',$_SERVER["QUERY_STRING"]);
                    $url_new ="?".$url_string."&ref".md5(date("mdYHis"));
                    /*if(isset($_GET["search"])){
                        $url_new =$url_string."&ref".md5(date("mdYHis"));
                    }else{
                        $url_new = "?&ref".md5(date("mdYHis"));
                    }*/
                    ?>
                          <button type="button" class="btn red" onclick="location='<?=$cancel_variable?>';" class="btn default">Cancel</button>                           
                               </div>
                </div>
            </div>
             </div></div></div>
             </form>    


<?
}

if(isset($_GET["delete"])){
    $strsql = "delete from ".$nama_table." where ".$primary_id."=".uriParam($primary_id);
    //echo $strsql;die();
    $user->query($strsql);
    
    opt_deleteqry(uriParam($primary_id));
    //$strsql = "delete from ".$nama_table_child." where ".$primary_id."=".uriParam($primary_id);
    //$user->query($strsql);
    //echo $strsql;
    echo "<script>alert('Data Successfully Updated..');location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";die();
}
}?>					