<div class="input-group input-large margin-top-10">
	<div id="newSlider" class="bg-green"></div>
	<input id="newFormSlider" name="<?=$field_name_ori?>" type="text" value="0" class="form-control"  maxlength="3" readonly <?=$required?>>                                   
	<span class="input-group-addon">%</span>
 </div>
<script>
	$('#newSlider').slider({
	  min: 0,
	  max: 100,
	  slide: function(event, ui) {
		$('#newFormSlider').val(ui.value);
	  }
	});
</script>