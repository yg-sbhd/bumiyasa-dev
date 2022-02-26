<?
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
									