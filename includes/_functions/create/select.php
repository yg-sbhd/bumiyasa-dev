<?
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
	<option value="" selected disabled></option>
	<?while($select_table->next()){?>
		<option value="<?=$select_table->row("id")?>" <?if($isi_id ==$select_table->row("id")){ echo " selected"; }?> <?if($autosel=="yes"){ echo " selected";}?>>
			<?=$select_table->row("name")?>
		</option>
	 <?}?>
</select>