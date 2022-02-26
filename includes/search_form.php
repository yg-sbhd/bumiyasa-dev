<?
function search_form($form_type,$form_title,$field_name,$field_alias_name,$field_type_name){
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

//Query User Admin
// echo $field_type_name . '<p>';
?>
    <form id="form" name="searchfrmgen" action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&refresh=<?=md5("mdYHis")?>" class="form-horizontal hidden-print" role="form" enctype="multipart/form-data" method="post">
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
                        <div class="col-md-3 nopadding">  
                            <div class="form-group">
                                <label  class="col-md-5 control-label" style="padding-right: 10px; padding-left: 4px;">
                                    <font size=-1>
                                          
			
			<?
			if(isset($_POST["chk_". $field_name_ori])){
				$checked = " checked";
				$valfield = postParam("chk_". $field_name_ori);
			}else{
				$checked = " ";
				$valfield = "";
			}
			
			?>
			
			<input name="chk_<?=$field_name_ori?>" type="checkbox" value="<?=$valfield?>"  class="form-control" <?=$checked?>>
			<?=listGetAt($field_alias_name,$field)?>
                                        <?if(listFind($field_required,$field_name_ori)){?>
                                        <font color="red"> *</font>
                                        <?}?>
                                    </font>
                                </label>
                                <div class="col-md-7" style="">
                                    <?if($field_type_ori=="text"){?>
                                        <input name="<?=$field_name_ori?>" type="text" value="<?=$valfield?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> <?=$field_row?>>
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
                                    <?}elseif($field_type_ori=="two-date"){?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input name="<?=$field_name_ori?>" class="form-control form-control-inline input-small date-picker"  size="10" type="text" value=""  <?=$required?>/>
                                            </div>
                                            <div class="col-md-1 text-center"><p style="margin-bottom: 0" class="text-right">s/d</p>
                                                <i class="icon-resize-horizontal"></i>
                                            </div>
                                            <div class="col-md-4">
                                                <input name="<?=$field_name_ori?>_2" class="form-control form-control-inline input-small date-picker"  size="5" type="text" value=""  <?=$required?>/>
                                            </div>
                                            
                                        </div>
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
                                        
                                            if(isset($_POST["chk_".$field_name_ori])){
                                                $isi_id = postParam($field_name_ori);
                                            }else{
                                            $isi_id = 0;
                                           }
			//echo $isi_id;
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
                <!-- End of Form New -->
                
                    		<button type="button" class="btn green pull-right" onclick="document.searchfrmgen.submit();" ><i class="icon-search"></i> Search</button>
                    <?
                    $url_string = str_replace('new_form=yes&', '',$_SERVER["QUERY_STRING"]);
                    $url_new ="?".$url_string."&ref".md5(date("mdYHis"));
                    /*if(isset($_GET["search"])){
                        $url_new =$url_string."&ref".md5(date("mdYHis"));
                    }else{
                        $url_new = "?&ref".md5(date("mdYHis"));
                    }*/
                    ?>                       
            </div>
                               
            </div>
             </div></div></div>
             </form>    
	<P>
<?

}?>					