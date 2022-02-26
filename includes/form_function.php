<?
function add_text($field_name_ori, $required){
	echo "<input type='text' name='".$field_name_ori."' class='form-control'  ".$required." />";
}

function add_text_readonly($field_name_ori, $required){
	echo "<input type='text' name='".$field_name_ori."_text' class='form-control'  ".$required." disabled />";
	echo "<input type='hidden' name='".$field_name_ori."' class='form-control' />";

}

function add_textarea($field_name_ori, $required){
	echo "<textarea name='".$field_name_ori."' class='form-control' ".$required."></textarea>";
}

function add_textarea_readonly($field_name_ori, $required){
	echo "<textarea name='".$field_name_ori."' class='form-control' ".$required." disabled></textarea>";
}

function add_number($field_name_ori, $required){
	echo "<input type='number' name='".$field_name_ori."' class='form-control'  ".$required." />";
}

function add_number_readonly($field_name_ori, $required){
	echo "<input type='number' name='".$field_name_ori."_text' class='form-control'  ".$required." disabled />";
	echo "<input type='hidden' name='".$field_name_ori."' class='form-control' />";

}

function add_int($field_name_ori, $required){
	echo "<input type='number' name='".$field_name_ori."' class='form-control'  ".$required." />";
}

function add_int_readonly($field_name_ori, $required){
	echo "<input type='number' name='".$field_name_ori."_text' class='form-control'  ".$required." disabled />";
	echo "<input type='hidden' name='".$field_name_ori."' class='form-control' />";
}

function add_decimal($field_name_ori, $required){
	echo "<input type='text' name='".$field_name_ori."' class='form-control'  ".$required." placeholder='0.00' />";
}

function add_decimal_readonly($field_name_ori, $required){
	echo "<input type='text' name='".$field_name_ori."_text' class='form-control'  ".$required." placeholder='0.00' disabled />";
	echo "<input type='hidden' name='".$field_name_ori."' class='form-control' />";
}

function add_telephone($field_name_ori, $required){
	echo "<input type='tel' name='".$field_name_ori."' class='form-control'  ".$required." />";
}

function add_telephone_readonly($field_name_ori, $required){
	echo "<input type='tel' name='".$field_name_ori."_text' class='form-control'  ".$required." disabled />";
	echo "<input type='hidden' name='".$field_name_ori."' class='form-control' />";
}

function add_email($field_name_ori, $required){
	echo "<input type='email' name='".$field_name_ori."' class='form-control'  ".$required." />";
}

function add_email_readonly($field_name_ori, $required){
	echo "<input type='email' name='".$field_name_ori."_text' class='form-control'  ".$required." disabled />";
	echo "<input type='hidden' name='".$field_name_ori."' class='form-control' />";

}

function add_date_now($field_name_ori, $required){
	echo  "<input type='text' name='".$field_name_ori."' class='datepicker-here form-control digits' value='".date("d/m/Y")."'  ".$required." />";
}

function add_date_now_readonly($field_name_ori, $required){
	echo  "<input type='text' name='".$field_name_ori."' class='datepicker-here form-control digits' value='".date("d/m/Y")."'  ".$required." disabled/>";
}

function add_date($field_name_ori, $required){
	echo  "<input type='text' name='".$field_name_ori."' class='datepicker-here form-control digits' ".$required." />";
}

function add_date_readonly($field_name_ori, $required){
	echo  "<input type='text' name='".$field_name_ori."_text' class='form-control' ".$required." disabled />";
	echo  "<input type='hidden' name='".$field_name_ori."' class='form-control' />";

}

function add_time($field_name_ori, $required){
	?>

	<select name="<?=$field_name_ori?>_timehour" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
	<?for($i=0;$i<=23;$i++){
		if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
	?>
		<option value="<?=$i?>" <?if($i==date('H')){echo "selected";}?>><?=$zero.$i?></option>
	<?}?>
	</select>
	&nbsp;:&nbsp;
	<select name="<?=$field_name_ori?>_timeminute" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;">
	<?for($i=0;$i<=59;$i=$i+1){
		if(strlen($i)==1){ $zero = "0";}else{$zero ="";}
		?>
		<option value="<?=$i?>"><?=$zero.$i?></option>
	<?}?>
	</select>
	<?
}

function add_time_readonly($field_name_ori, $required){
	?>

	<select name="<?=$field_name_ori?>_timehour" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;" readonly>
		<option value="<?=date('H')?>"><?=date('H')?></option>
	</select>
	&nbsp;:&nbsp;
	<select name="<?=$field_name_ori?>_timeminute" style="height: 34px; border: 1px solid #ddd; margin-top: -1px;" readonly>
		<option value="<?=date('i')?>"><?=date('i')?></option>
	</select>
	<?
}

function add_radio($field_name_ori, $field_query, $required){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;

	// $field_query=$field_size;
	$select_table = cmsDB();
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
	
	<div class="form-group m-t-10 m-checkbox-inline mb-0 custom-radio-ml">
		<?
	while($select_table->next()){?>

		<div class="radio radio-primary"> 
 			<div class="radio radio-primary">
	            <input id="<?=$select_table->row('id')?>" type="radio" name="<?=$field_name_ori?>" value="<?=$select_table->row('id')?>" data-original-title="" title="">
	            <label class="mb-0" for="<?=$select_table->row('id')?>"><?=$select_table->row('name')?></label>
	          </div>
 		</div>

		<?
	}
	echo "</div>";

}

function add_multi_checkbox($field_name_ori, $field_query, $required){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;

	// $field_query=$field_size;
	$select_table = cmsDB();
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
	
	<div class="form-group m-t-8">
		<?
	while($select_table->next()){?>

 		<div class="checkbox checkbox-primary">
        	<input id="<?=$select_table->row('id')?>" type="checkbox" value="<?=$select_table->row("id")?>" name="<?=$field_name_ori?>[]" data-original-title="" title="">
        	<label for="<?=$select_table->row('id')?>"><?=$select_table->row('name')?></label>
      	</div>

		<?
	}
	echo "</div>";

}


function add_select($field_name_ori, $field_query, $required){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;

	// $field_query=$field_size;
	$select_table = cmsDB();
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

	<select name="<?=$field_name_ori?>" id="<?=$field_name_ori?>" class="form-control js-example-basic-single col-sm-12" data-placeholder="Select..." <?=$required?>>
		<option value="0" selected></option>
		<?while($select_table->next()){?>
			<option value="<?=$select_table->row("id")?>" <?if($isi_id ==$select_table->row("id")){ echo " selected"; }?> <?if($autosel=="yes"){ echo " selected";}?>>
				<?=$select_table->row("name")?>
			</option>
		 <?}?>
	</select>

	
<?
}

function add_select_link($field_name_ori, $field_query, $required, $field_name_ori_target){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;

	// $field_query=$field_size;
	$select_table = cmsDB();
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

	<select name="<?=$field_name_ori?>" id="<?=$field_name_ori?>" class="form-control js-example-basic-single col-sm-12" data-placeholder="Select..." <?=$required?>>
		<option value="0" selected></option>
		<?while($select_table->next()){?>
			<option value="<?=$select_table->row("id")?>" <?if($isi_id ==$select_table->row("id")){ echo " selected"; }?> <?if($autosel=="yes"){ echo " selected";}?>>
				<?=$select_table->row("name")?>
			</option>
		 <?}?>
	</select>

	<script type="text/javascript">
		var selectElem = document.getElementById('<?=$field_name_ori?>')
		var pElem = document.getElementById('<?=$field_name_ori_target?>')

		selectElem.addEventListener('change', function() {
		  var index = selectElem.selectedIndex;
		  // console.log(index);
		  // Add that data to the <p>
		  pElem.innerHTML = 'selectedIndex: ' + index;
		})
	</script>
	
<?
}


function add_select_readonly($field_name_ori, $field_query, $required){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	$select_table = cmsDB();
	$select_table->query($field_query);
	?>

			<select name="<?=$field_name_ori?>_2"  id="<?=$field_name_ori?>_2" class="form-control select2me" data-placeholder="Select..." disabled>
			<!-- <option value="0" selected disabled></option> -->

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
<?
}

function add_multiselect($field_name_ori, $field_query, $required){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	$select_table = cmsDB();
	
	// $field_query=$field_size;
	$select_table->query($field_query);
	
	?>
	<select  class="col-md-12 form-control" name="<?=$field_name_ori?>[]" multiple="yes"  size="10">
		<?while($select_table->next()){?>
			<option value="<?=$select_table->row("id")?>">
				<?=$select_table->row("name")?>
			</option>
		<?}?>
	</select>
<?
}

function add_file($field_name_ori, $required){
	echo "<input type='file' name='".$field_name_ori."' class='form-control'  ".$required." />";
}

function add_image($field_name_ori, $required){
	echo "<input type='file' name='".$field_name_ori."' class='form-control'  ".$required." />";
}


function add_password($field_name_ori, $required){
	echo  "<input type='password' name='".$field_name_ori."'' class='form-control' />";
}


function edit_text($field_name_ori, $value, $field_size, $required, $field_row){
	echo "<input type='text' name='".$field_name_ori."' class='form-control' value='".$value."' maxlength='".$field_size."' ".$required." " .$field_row." /> ";
}

function edit_date($field_name_ori, $value, $field_size, $required, $field_row){
	echo "<input type='text' name='".$field_name_ori."' class='datepicker-here form-control digits' value='".datesql2date($value)."' maxlength='".$field_size."' ".$required." " .$field_row." /> ";
}

function edit_select($field_name_ori, $field_query, $required, $field_isi_select){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	$select_table = cmsDB();
	// $field_query=$field_size;
	$field_id = listGetAt($field_query,2," ");
	// $field_isi_select = $field_asal;
	// echo "isi : ".$edit->row($field_name_ori);
	if($field_id<>$field_name_ori){
		$field_asal = $field_name_ori;
		$field_name_ori = $field_id;
	}else{
		$field_asal = $field_name_ori;
	}
	// echo $field_query." | " . $field_name_ori;
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
	// echo $sel_id ."==". $select_table->row("id");
	
	//echo $strsql;
	//echo "asal : ".$field_asal;
	?>
	<select name="<?=$field_asal?>" id="<?=$field_asal?>" class="form-control js-example-basic-single w-100" style="width: 100% !important">
			<option value="" <?if($sel_id == 0) { echo "selected"; }?> >&nbsp;</option>
		<?while($select_table->next()){?>
			<option value="<?=$select_table->row("id")?>" <?if($sel_id == $select_table->row("id")) { echo "selected"; }?> >
					<?=$select_table->row("name")?>
			</option>
		<?}?>
	</select>
<?
}



// FORM BID ANALYS
function edit_select_ba($field_asal, $field_query, $array_form, $field_name_ori, $result){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	$select_table = cmsDB();
	// $field_query=$field_size;
	// echo "string";
	// $field_id = listGetAt($field_query,2," ");
	// echo " 2 ";
	// $field_isi_select = $edit->row($field_name_ori);
	// echo " 3 ";
	//echo "isi : ".$edit->row($field_name_ori);
	// if($field_id<>$field_name_ori){
	// 	$field_asal = $field_name_ori;
	// 	$field_name_ori = $field_id;
	// }else{
	// 	$field_asal = $field_name_ori;
	// }
	//echo $field_query." | " . $field_name_ori;
	if(listFind($field_query,"where"," ")){
		//$field_query=listGetAt($field_query,1,"where");
		$strsql = $field_query . " and " . $field_name_ori . "=". $result;
	}else{
		$strsql = $field_query . " where " . $field_name_ori . "=". $result;
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


	// echo $strsql;
	//echo "asal : ".$field_asal;

	// echo $sel_id . " == " . $select_table->row("id");
	?>
	<select name="<?=$field_asal."[".$array_form."]"?>" id="<?=$field_asal?>" class="form-control js-example-basic-single col-sm-12 w-100" >
		<option value="" <?if($sel_id == 0) { echo "selected"; }?> >&nbsp;</option>
		<?while($select_table->next()){?>
			<option value="<?=$select_table->row("id")?>" <?if($sel_id == $select_table->row("id")) { echo "selected"; }?> >
				<?=$select_table->row("name")?>
			</option>
		<?}?>
	</select>
<?
}

function add_select_ba($field_name_ori, $field_query, $array_form, $required){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;

	// $field_query=$field_size;
	$select_table = cmsDB();
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

	<select name="<?=$field_name_ori."[".$array_form."]"?>"  class="form-control js-example-basic-single col-sm-12 w-100" data-placeholder="Select..." <?=$required?>>
		<option value="0" selected>&nbsp;</option>
		<?while($select_table->next()){?>
			<option value="<?=$select_table->row("id")?>" <?if($isi_id ==$select_table->row("id")){ echo " selected"; }?> <?if($autosel=="yes"){ echo " selected";}?>>
				<?=$select_table->row("name")?>
			</option>
		 <?}?>
	</select>
<?
}

function add_select_ba_vendor($field_name_ori, $field_query, $array_form, $required){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;

	// $field_query=$field_size;
	$select_table = cmsDB();
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

	<select name="<?=$field_name_ori."[".$array_form."]"?>" class="form-control js-example-basic-single col-sm-12 w-100" data-placeholder="Select..." onchange="javascript:select_vendor(this.name, this.value, 'rfq_<?=$field_name_ori?>')" id="<?=$field_name_ori?>" <?=$required?>>
		<option value="0" selected>&nbsp;</option>
		<?while($select_table->next()){?>
			<option value="<?=$select_table->row("id")?>" <?if($isi_id ==$select_table->row("id")){ echo " selected"; }?> <?if($autosel=="yes"){ echo " selected";}?>>
				<?=$select_table->row("name")?>
			</option>
		 <?}?>
	</select>
<?
}

// function edit_select_ba_vendor($field_asal, $field_query, $array_form, $field_name_ori, $result){
function edit_select_ba_vendor($field_name_ori, $field_query, $array_form, $field_asal, $result){

	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	$select_table = cmsDB();
	// $field_query=$field_size;
	// echo "string";
	// $field_id = listGetAt($field_query,2," ");
	// echo " 2 ";
	// $field_isi_select = $edit->row($field_name_ori);
	// echo " 3 ";
	//echo "isi : ".$edit->row($field_name_ori);
	// if($field_id<>$field_name_ori){
	// 	$field_asal = $field_name_ori;
	// 	$field_name_ori = $field_id;
	// }else{
	// 	$field_asal = $field_name_ori;
	// }
	//echo $field_query." | " . $field_name_ori;
	if(listFind($field_query,"where"," ")){
		//$field_query=listGetAt($field_query,1,"where");
		$strsql = $field_query . " and " . $field_asal . "=". $result;
	}else{
		$strsql = $field_query . " where " . $field_asal . "=". $result;
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


	// echo $strsql;
	//echo "asal : ".$field_asal;

	// echo $sel_id . " == " . $select_table->row("id");
	?>
	<select name="<?=$field_name_ori."[".$array_form."]"?>" onchange="javascript:select_vendor_edit(this.name, this.value, 'rfq_<?=$field_name_ori?>', <?=$result?>)" id="<?=$field_name_ori?>" class="form-control js-example-basic-single col-sm-12 w-100" >
		<option value="" <?if($sel_id == 0) { echo "selected"; }?> >&nbsp;</option>
		<?while($select_table->next()){?>
			<option value="<?=$select_table->row("id")?>" <?if($sel_id == $select_table->row("id")) { echo "selected"; }?> >
				<?=$select_table->row("name")?>
			</option>
		<?}?>
	</select>
<?
}

function add_date_ba($field_name_ori, $required){
	echo  "<input type='text' name='".$field_name_ori."'' class='datepicker-here form-control digits' value='".date("d/m/Y")."'  ".$required." />";
}

function add_text_ba($field_name_ori, $value=''){
	echo "<input type='text' name='".$field_name_ori."' class='form-control'  value='".$value."' />";
}

function add_hidden_ba($field_name_ori, $value){
	echo "<input type='hidden' name='".$field_name_ori."' class='form-control'  value='".$value."' />";
}
?>