<?if(isset($_GET[md5("approved_".date("mdY"))])){?>
	<input name="<?=$field_name_ori?>" type="text" value="0.00" maxlength="<?=$field_size?>" class="form-control number-format"  <?=$required?>>
	<input name="<?=$field_name_ori?>_uid" type="hidden" value="<?=uriParam(md5("uid".date("mdY")))?>">
<?}else{?>
	<input name="<?=$field_name_ori?>" type="text" value="0.00" maxlength="<?=$field_size?>" class="form-control number-format" <?=$required?> readonly>
	<a href="javascript:PopWindow('templates/pwd_require.php?ref=<?=md5(date("mdyHis"))?>','frmpop','500','200',',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" class="btn green"><i class="icon-key"></i></a>
<?}?>