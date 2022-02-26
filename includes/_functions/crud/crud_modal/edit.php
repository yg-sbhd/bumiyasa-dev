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

	<div class="container-fluid">
	  <div class="page-header">
	    <div class="row">
	      <div class="col-lg-6">
	        <h5><i class="fa fa-pencil"></i> <?=$form_edit_title?></h5>
	      </div>
	      <div class="col-lg-6">
	        <ol class="breadcrumb pull-right mb-1">
	          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; <?=$form_map?> / Edit</li>
	        </ol>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">
				<form action="<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&<?=$primary_id?>=<?=uriParam($primary_id)?>&edit=yes&update=yes&refresh=<?=md5("mdYHis")?>" method="post" name="updateform" enctype="multipart/form-data" id="updateform" class="form-horizontal">
					<div class="card">
						<div class="card-body">
							<div class="row">
							<?
							$popupcount=1;
							for($field=1;$field<=listLen($field_name);$field++){
								$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
								$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
								$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
								$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
								$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
								
								if(listFind($field_required,$field_name_ori)){
									$required="required='required'";
								}else{
									$required="";
								}
								?>
							
								<div class="col-md-12">
									<div class="form-group row text-left text-md-right">
										<label  class="col-md-4 col-form-label">
											<font size=-1>
												<?=listGetAt($field_alias_name,$field)?>
												<?if(listFind($field_required,$field_name_ori)){?>
													<font color="red"> *</font>
												<?}?>
											</font>
										</label>
										<div class="col-md-8" align="left">
						<?if($field_type_ori=="text" || $field_type_ori=="telephone"){?>
							<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> <?=$field_row?>>
						<?}elseif($field_type_ori=="text-readonly"){?>
							<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>" maxlength="<?=$field_size?>" class="form-control" <?=$required?> readonly>
						<?}elseif($field_type_ori=="password"){?>
							<input name="<?=$field_name_ori?>" type="password" value="" maxlength="<?=$field_size?>" class="form-control" <?=$required?>>

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
						
						<?}elseif($field_type_ori=="image"){?>
							<input name="<?=$field_name_ori?>" type="FILE" value="" maxlength="<?=$field_size?>" class="form-control"  <?=$required?> accept="image/*;capture=camera;">
							<?if(strlen($edit->row($field_name_ori))){?>
								<a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$edit->row($field_name_ori)?>" target="_new">[ Lihat Dokumen ]</a>
							<?}?>

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
									
						<?}elseif($field_type_ori=="select-read" || $field_type_ori=="select-readonly"){
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
							</div>
						</div>
									
						<div class="card-footer">
							<div class="col-md-12" align="center">
								<?if (_checkauth("Edit")  || uriParam('tmp') == encryptStringArray('templates/ref_user/index.php') || uriParam('tmp') == encryptStringArray('templates/ref_usergroup/index.php') ){?>
									<button type="button" class="btn btn-success btn-sm" onclick="_cekValid(document.updateform);">
										<i class="icon-pencil icon-white"></i> &nbsp; Update
									</button>
								<?}?>
								
								<?if(_checkauth("Delete")  || uriParam('tmp') == encryptStringArray('templates/ref_user/index.php') || uriParam('tmp') == encryptStringArray('templates/ref_usergroup/index.php') ){?>
									<button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are You Sure Want to Delete this Record?')){ self.location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&delete=yes&<?=$primary_id?>=<?=uriParam($primary_id)?>&ref=<?=md5(date("mdyHis"))?>';}">
										<i class="icon-trash icon-white"></i> &nbsp; Delete
									</button>
								<?}?>
								
								<?
								$url_string = str_replace('new_form=yes&', '',$_SERVER["QUERY_STRING"]);
								$url_new ="?tmp=".uriParam('tmp')."&ref=".md5(date("mdYHis"));
								/*if(isset($_GET["search"])){
								$url_new =$url_string."&ref".md5(date("mdYHis"));
								}else{
								$url_new = "?&ref".md5(date("mdYHis"));
								}*/
								?>
								<button type="button" class="btn btn-light btn-sm" onclick="location='<?=$url_new?>';" class="btn default"><i class="icofont icofont-swoosh-left icon-black"></i> Cancel</button>
							</div>
						</div>
					</div>
				</form>
			</div>
<?}?>