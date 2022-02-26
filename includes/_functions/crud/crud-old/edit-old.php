<?if(isset($_GET["edit"])){
	$edit=cmsDB();
	
	if(is_numeric(decryptStringArray(uriParam($primary_id))) == false){
		//echo $primary_id ." = " . decryptStringArray(uriParam($primary_id)). " -- Invalid Parameter<BR>Jancuuk Njajal2x kon...";die();
		echo  " Invalid Paramete";die();
	}
	$strsql = "select * from ".$nama_table." where ".$primary_id."=".decryptStringArray(uriParam($primary_id));
	//echo $strsql;
	$edit->query("select * from ".$nama_table." where ".$primary_id."=".decryptStringArray(uriParam($primary_id)));
	$edit->next();

	$get_primary_id = listGetAt($_SERVER["QUERY_STRING"],3,"&");
	$_primary_id = listGetAt($get_primary_id,1,"=");

  ?>
	<form action="<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&<?=$primary_id?>=<?=uriParam($primary_id)?>&edit=yes&update=yes&refresh=<?=md5("mdYHis")?>" method="post" name="updateform" enctype="multipart/form-data" id="updateform" class="form-horizontal">
	    <div class="padding-15px">
       		<div class="form-new">
	          <div class="modal-header">
	             <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> -->
	             <h4 class="modal-title"><i class="icon-info-sign"></i> <?=$form_edit_title?></h4>
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
						$required="required='required'";
					}else{
						$required="";
					}
				?>	
				<?if($two_form == 'yes'){?>
					<div class="col-md-6">
				<?}else{?>
					<div class="col-md-12">
				<?}?>
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
					<?}elseif($field_type_ori=="text-readonly"){?>
						<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> readonly>
					<?}elseif($field_type_ori=="auto-text"){?>
						<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" readonly>
					<?}elseif($field_type_ori=="checkbox"){?>
						<input name="<?=$field_name_ori?>" type="checkbox" value="1"  class="form-control" <?=$required?> <?if($edit->row($field_name_ori)==1){echo "checked";}?> style="padding: 8px 0;"> 
					<?}elseif($field_type_ori=="number"){?>
						<input name="<?=$field_name_ori?>" type="text" value="<?=number_format($edit->row($field_name_ori),2)?>" maxlength="<?=$field_size?>" class="form-control number-format"  <?=$required?>>
					<?}elseif($field_type_ori=="percentage"){?>
						<div class="input-group input-medium margin-top-10">
							<div id="editSlider" class="bg-green"></div>
							<input id="editFormSlider" name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" class="form-control"  maxlength="3" readonly <?=$required?>>                                   
							<span class="input-group-addon">%</span>
						</div>
						<script>
							$('#editSlider').slider({
							  min: 0,
							  max: 100,
							  value : $('#editFormSlider').val(),
							  slide: function(event, ui) {
								$('#editFormSlider').val(ui.value);
							  }
							});
						</script>
					<?}elseif($field_type_ori=="number_otorisasi"){
						if(isset($_GET[md5("approved_".date("mdY"))])){?>
							<input name="<?=$field_name_ori?>" type="text" value="<?=number_format($edit->row($field_name_ori),2)?>" maxlength="<?=$field_size?>" class="form-control number-format"  <?=$required?>>
							<input name="<?=$field_name_ori?>_uid" type="hidden" value="<?=uriParam(md5("uid".date("mdY")))?>">
						<?}else{?>
							<input name="<?=$field_name_ori?>" type="text" value="<?=number_format($edit->row($field_name_ori),2)?>" maxlength="<?=$field_size?>" class="form-control number-format"  <?=$required?> readonly>
							<a href="javascript:PopWindow('templates/pwd_require.php?tmp=<?=uriParam("tmp")?>&action=edit&primary_id=<?=$primary_id?>&<?=$primary_id?>=<?=$edit->row($primary_id)?>&fname=updateform.<?=$field_name_ori?>&ref=<?=md5(date("mdyHis"))?>','frmpop','500','200',',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" class="btn green"><i class="icon-key"></i></a>
						<?}?>
					<?}elseif($field_type_ori=="number-readonly"){?>
						<input name="<?=$field_name_ori?>" type="text" value="<?=number_format($edit->row($field_name_ori),2)?>" maxlength="<?=$field_size?>" class="form-control"  <?=$required?> readonly>
					<?}elseif($field_type_ori=="number1"){?>
						<input name="<?=$field_name_ori?>" type="text" value="<?=number_format($edit->row($field_name_ori),2)?>" maxlength="<?=$field_size?>" class="form-control"  <?=$required?>>
					<?}elseif($field_type_ori=="textarea"){?>
						<textarea name="<?=$field_name_ori?>" rows="<?=$field_row?>" class="form-control"  <?=$required?>><?=$edit->row($field_name_ori)?></textarea>
					<?}elseif($field_type_ori=="file"){?>
						<input name="<?=$field_name_ori?>" type="FILE" value="" maxlength="<?=$field_size?>" class="form-control"  <?=$required?> accept="image/*;capture=camera;">
						<?if(strlen($edit->row($field_name_ori))){?>
							<a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$edit->row($field_name_ori)?>" target="_new">[ Lihat Dokumen ]</a>
						<?}?>
					<?}elseif($field_type_ori=="geotag"){?>
						<input name="<?=$field_name_ori?>" type="FILE" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control"  accept="image/*;capture=camera;">
						<?if(strlen($edit->row($field_name_ori))){?>
							<a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$edit->row($field_name_ori)?>" target="_new">[ Lihat Dokumen ]</a>
						<?}?>	
					<?}elseif($field_type_ori=="geoval"){?>
							
					<?}elseif($field_type_ori=="date"){?>
						<input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=datesql2date($edit->row($field_name_ori))?>"  <?=$required?> /> 
					<?}elseif($field_type_ori=="time"){
							$time_sql = $edit->row($field_name_ori);
							$hour = intval(listGetAt($time_sql,1,":"));
							$minute = intval(listGetAt($time_sql,2,":"));
						?>
								<!-- <input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=$edit->row($field_name_ori)?>"  <?=$required?>/> -->
								 <!-- &nbsp; -->
								<select name="<?=$field_name_ori?>_timehour" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
									<?for($i=0;$i<=23;$i++){
										if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
									?>
										<option value="<?=$i?>" <?if($hour==$i){ echo "selected";}?>><?=$zero.$i?></option>
									<?}?>
									</select>&nbsp;:&nbsp;
									<select name="<?=$field_name_ori?>_timeminute" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
									<?for($i=0;$i<=59;$i=$i+1){
										if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
										?>
										<option value="<?=$i?>" <?if($minute==$i){ echo "selected";}?>><?=$zero.$i?></option>
									<?}?>
								</select>
					<?}elseif($field_type_ori=="time-readonly"){
							$time_sql = $edit->row($field_name_ori);
							$hour = listGetAt($time_sql,1,":");
							$minute = listGetAt($time_sql,2,":");
						?>
							<!-- <input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=$edit->row($field_name_ori)?>"  <?=$required?>/> -->
								 <!-- &nbsp; -->
							<select name="<?=$field_name_ori?>_timehour" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;" readonly>
								<option value="<?=$hour?>"><?=$hour?></option>
							</select>
							&nbsp;:&nbsp;
							<select name="<?=$field_name_ori?>_timeminute" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;" readonly>
									<option value="<?=$minute?>"><?=$minute?></option>
							</select>
					<?}elseif($field_type_ori=="date-readonly"){?>
						<input name="<?=$field_name_ori?>" class="form-control"  size="10" type="text" value="<?=datesql2date($edit->row($field_name_ori))?>"  <?=$required?> readonly> 
					
					<?}elseif($field_type_ori=="datefromtime"){
							$time_sql = listGetAt($edit->row($field_name_ori),2," ");
							$hour = intval(listGetAt($time_sql,1,":"));
							$minute = intval(listGetAt($time_sql,2,":"));
						?>
								<input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=datesql2date($edit->row($field_name_ori))?>"  <?=$required?>/>
								 &nbsp;
								<select name="<?=$field_name_ori?>_timehour" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=23;$i++){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
								?>
									<option value="<?=$i?>" <?if($hour==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>&nbsp;:&nbsp;
								<select name="<?=$field_name_ori?>_timeminute" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=59;$i=$i+1){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
									?>
									<option value="<?=$i?>" <?if($minute==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>
					
					<?}elseif($field_type_ori=="datefromtimetotime"){
							$time_sql = listGetAt($edit->row($field_name_ori),2," ");
							$hour = intval(listGetAt($time_sql,1,":"));
							$minute = intval(listGetAt($time_sql,2,":"));

							$time_sql_to = listGetAt($edit->row($field_name_ori."_to"),2," ");
							$hour_to = intval(listGetAt($time_sql_to,1,":"));
							$minute_to = intval(listGetAt($time_sql_to,2,":"));
						?>

								<input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=datesql2date($edit->row($field_name_ori))?>"  <?=$required?>/>
								 &nbsp;
								<select name="<?=$field_name_ori?>_timehour" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=23;$i++){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
								?>
									<option value="<?=$i?>" <?if($hour==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>&nbsp;:&nbsp;
								<select name="<?=$field_name_ori?>_timeminute" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=59;$i=$i+1){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
									?>
									<option value="<?=$i?>" <?if($minute==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>

								<span style="background: #ddd; padding: 10px; margin-right: 3px;"> To </span>


								<select name="<?=$field_name_ori?>_timehour_end" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=23;$i++){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
								?>
									<option value="<?=$i?>" <?if($hour_to==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>&nbsp;:&nbsp;
								<select name="<?=$field_name_ori?>_timeminute_end" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=59;$i=$i+1){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
									?>
									<option value="<?=$i?>" <?if($minute_to==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>
					<?}elseif($field_type_ori=="datefromtimetotime-readonly"){
							$time_sql = listGetAt($edit->row($field_name_ori),2," ");
							$hour = intval(listGetAt($time_sql,1,":"));
							$minute = intval(listGetAt($time_sql,2,":"));

							$time_sql_to = listGetAt($edit->row($field_name_ori."_to"),2," ");
							$hour_to = intval(listGetAt($time_sql_to,1,":"));
							$minute_to = intval(listGetAt($time_sql_to,2,":"));
						?>

								<input name="<?=$field_name_ori?>" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=datesql2date($edit->row($field_name_ori))?>"  <?=$required?>/ disabled>
								 &nbsp;
								<select name="<?=$field_name_ori?>_timehour" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=23;$i++){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
								?>
									<option value="<?=$i?>" <?if($hour==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>&nbsp;:&nbsp;
								<select name="<?=$field_name_ori?>_timeminute" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=59;$i=$i+1){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
									?>
									<option value="<?=$i?>" <?if($minute==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>

								<span style="background: #ddd; padding: 10px; margin-right: 3px;"> To </span>


								<select name="<?=$field_name_ori?>_to_timehour_end" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=23;$i++){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
								?>
									<option value="<?=$i?>" <?if($hour_to==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>&nbsp;:&nbsp;
								<select name="<?=$field_name_ori?>_to_timeminute_end" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
								<?for($i=0;$i<=59;$i=$i+1){
									if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
									?>
									<option value="<?=$i?>" <?if($minute_to==$i){ echo "selected";}?>><?=$zero.$i?></option>
								<?}?>
								</select>			
			

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
							//echo $strsql."<BR>";
							
							$select_table->next();
							$sel_id = $select_table->row("id");
							if($sel_id==""){
								$sel_id=0;
							}
							$sel_name =$select_table->row("name");
							// echo "Nama : ".$field_isi_select;
							if(listFind($field_query,"where"," ")){
								$strsql = $field_query;
							}else{
								$strsql = $field_query;
							}
							$select_table->query($strsql);
							
							
							//echo $strsql;
							//echo "asal : ".$field_asal;
							?>
							<select name="<?=$field_asal?>" id="<?=$field_asal?>" class="form-control input-big select2me" >
									<option value="" <?if($sel_id == 0) { echo "selected"; }?> >&nbsp;</option>
								<?while($select_table->next()){?>
									<option value="<?=$select_table->row("id")?>" <?if($sel_id == $select_table->row("id")) { echo "selected"; }?> >
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
								$primary_text= listGetAt($record_show,1);
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
							  <option value="0" selected disabled></option>

							 <?while($select_table->next()){?>
								<option value="<?=$select_table->row("id")?>" <?if($select_table->row("id")==$edit->row($field_name_ori)){ echo " selected";}?>>
									<?=$select_table->row("name")?>
								</option>
							 <?}?>
							</select>
							<input type='hidden' name='<?=$field_name_ori?>' value='<?=$edit->row($field_name_ori)?>'>
					<?}elseif($field_type_ori=="moreselect"){
							$field_query=$field_size;
							$select_table->query($field_query);
							?>
							<select class="form-control multi-select" name="<?=$field_name_ori?>[]" multiple="" id="my_multi_select3">
								<option value="0" selected disabled></option>

								<?while($select_table->next()){?>
									<option value="<?=$select_table->row("id")?>" <? if(listFind($edit->row($field_name_ori),$select_table->row("id"))){ echo " selected";}?>>
									<?=$select_table->row("name")?>
									</option>
								<?}?>
							</select><!--&nbsp;Ctrl+Klik to select more than 1 (one)-->
					<?}elseif($field_type_ori=="maps"){?>
						<!-- Remark From this system -->
							
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
		            
					<?$akses = edit_filter(uriParam("tmp"), $edit->row('status_id'), $edit->row('insert_by'));?>
					<?if(_checkauth("Edit")){?>
						<?if($akses){?>
					        <button type="button" class="btn green" onclick="_cekValid(document.updateform);">Update</button>
				        <?}else{?>
					        <button type="button" class="btn green" onclick="_cekValid(document.updateform);">Update</button>

				        	<?}?>
					<?}?>

					<?if(_checkauth("Delete")){?>
						<?if($akses){?>
					   		<button type="button" class="btn red" onclick="if(confirm('Are You Sure Want to Delete this Record?')){ self.location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&delete=yes&<?=$primary_id?>=<?=uriParam($primary_id)?>&ref=<?=md5(date("mdyHis"))?>';} ">Delete</button>
						<?}else{?>
					   		<button type="button" class="btn red" onclick="if(confirm('Are You Sure Want to Delete this Record?')){ self.location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&delete=yes&<?=$primary_id?>=<?=uriParam($primary_id)?>&ref=<?=md5(date("mdyHis"))?>';} ">Delete</button>


						<?}?>
					<?}?>


					<?if(_checkauth("Print")){?>
						<a class="btn green" href="<?$_SERVER["SCRIPT_NAME"]?>?tmp=templates/print/<?=listLast($nama_table,"_")?>.php&<?=$primary_id?>=<?=uriParam($primary_id)?>&refresh=<?=md5(date("mdYHis"))?>">Print <i class="icon-print"></i></a>
					<?}?> 
			
						<button type="button" onclick="self.location='?tmp=<?=uriParam('tmp')?>&ref=<?=md5(date("mdYHis"))?>'" class="btn default"><B>Cancel</B></button>    
						<!-- <button type="button" onclick="history.back();" class="btn default"><B>Canceld</B></button>     -->

			<?
			if(strlen($additionalButton)){
				// echo "<BR><BR>";
				_workFlowButton($additionalButton);
			}
			
			//if(uriParam("tmp")=="templates/bahanbaku/terima.php" || uriParam("tmp")=="templates/penjualan/ekspor.php"){
			if($edit->row("verify")==0){?>
				<?if(_checkauth("verify")){?>
			<button type="button" class="btn green" onclick="if(confirm('Are You Sure Want to Verify this Transaction, Data will not be able to edit or deleted?')){ location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&edit=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&verify=yes&ref=<?=md5(date("mdYHis"))?>';} ">Verify Transaction</button>
			<? }
			}?>
			
			</div></div></div></div></div></div></form>			
			<!-- Form Tambahan utk Penjualan Ekspor produk -->
			<?/*if(isset($_GET["edit"]) && isset($_GET["penjualanexp_id"])){
				_productexport($nama_table,$primary_id,$nama_table_child,$primary_id_child,$field_name_child,$field_type_child,$record_show_child);
			}else */
			// =============== parsing Child ===============//
			//echo $child_main_query;
			$verify = $edit->row("verify");
			$status_code = $edit->row("status_id");

			if(isset($_GET["edit"]) && $child_enable == "yes"){
				_productChildNoPop($child_main_query,$nama_table,$primary_id,$nama_table_child,$primary_id_child,$field_name_child,$field_type_child,$record_show_child,$verify,$status_code,$record_show_sum);
			}
			// ============================================//
			// =============== parsing verify ===============//
			if (uriParam("verify")=="yes") {
				
				verify_transaction($nama_table,$primary_id,$nama_table_child,$primary_id_child,$field_name_child,$field_type_child,$record_show_child,$verify);
				
			}
			// =============== parsing verify ===============//
			

			
			?>

		               <!-- END SAMPLE TABLE PORTLET-->
                              <!-- END FORM--> 
		</div>
		</div>
		
		<div class="modal fade" id="newform" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="">
		        <div class="modal-header">
		            <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
		            <h4 class="modal-title">Tambah Produk</h4>
		        </div>
		        <div class="modal-body">
		        <?
		        $get_primary_id = listGetAt($_SERVER["QUERY_STRING"],3,"&");
				$_primary_id = listGetAt($get_primary_id,1,"=");
		        ?>
		        	<form name="newchild" action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&insert_child=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&refresh=<?=md5("mdYHis")?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
		        	<input type="hidden" name="<?=$_primary_id?>" value="<?=uriParam($_primary_id)?>">
		        		<?for($field=1;$field<=listLen($field_type_child,"#");$field++){
						$field_detail=listGetAt($field_type_child,$field,"#"); //Ambil Detail Field
						$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
						$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
						$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
						$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
						$field_label=listGetAt($field_detail,4,"|"); //Ambil Field Label
						?>
						<div class="form-group">
							  <label  class="col-md-3 control-label">
							  <font size=-1>
								<?=$field_label?>
							   <?if(listFind($field_child_require,$field_name_ori)){?>
							   	<font color="red"> *</font>
							   <?}?></font>
							   </label>
						               <div class="col-md-9">
								<?if($field_type_ori=="text"){?>
									<input name="<?=$field_name_ori?>" type="text" value="" maxlength="<?=$field_size?>" class="form-control" <?=$required?>>
								<?}elseif($field_type_ori=="text-readonly"){?>
									<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> readonly>
								<?}elseif($field_type_ori=="file"){?>
									<input name="<?=$field_name_ori?>" type="FILE" value="" size="<?=$field_size?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?>  accept="image/*;capture=camera;">
									
								<?}elseif($field_type_ori=="number"){?>
									<input name="<?=$field_name_ori?>" type="text" value="0.00" maxlength="<?=$field_size?>" class="form-control number-format" <?=$required?>>
								<?}elseif($field_type_ori=="number-readonly"){?>
									<input name="<?=$field_name_ori?>" type="text" value="0.00" maxlength="<?=$field_size?>" class="form-control" <?=$required?> readonly>
								<?}elseif($field_type_ori=="number1"){?>
										<input name="<?=$field_name_ori?>" type="text" value="1.00" maxlength="<?=$field_size?>" class="form-control" <?=$required?>>
								<?}elseif($field_type_ori=="checkbox"){?>
									<input name="<?=$field_name_ori?>" type="checkbox" value="1"  class="form-control" <?=$required?> style="padding: 8px 0;">
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
								<?}elseif($field_type_ori=="date-readonly"){?>
									<input name="<?=$field_name_ori?>" class="form-control"  size="10" type="text" value=""  <?=$required?> readonly>
								
								<?}elseif($field_type_ori=="select"){
									$field_query=$field_size;
									$select_table->query($field_query);
									if($select_table->recordCount()==1){
										$autosel = "yes";
									}else{
										$autosel = "no";
									}
								?>
									<select name="<?=$field_name_ori?>"  class="form-control input-big select2me" data-placeholder="Select..." <?=$required?>>
										<option value=""></option>
										<?while($select_table->next()){
											if($field_name_ori=="negara_id"){
												if($select_table->row("id")=="101"){
													$selected = "selected";
												}else{
													$selected = "";
												}
											}
											?>
											<option value="<?=$select_table->row("id")?>" <?if($autosel=="yes"){ echo " selected";}?> <?=$selected?>>
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
									remark From this system
									<?//}?>
								<?}?>	   
							</div>
						</div>
						<?
						}
						?>
						<div class="form-actions fluid">
							<div class="col-md-offset-3 col-md-9" align="left">
								<button type="button" class="btn green" onclick="_cekChildValid(document.newchild);">Save</button>
					      		<button type="button" class="btn red" data-dismiss="modal" class="btn default">Close</button>                           
							</div>
						</div>
		        	</form>
		        </div>
		    </div>
		</div>
		</div>

		

		

	
<?}?>