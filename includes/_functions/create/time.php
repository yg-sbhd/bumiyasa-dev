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