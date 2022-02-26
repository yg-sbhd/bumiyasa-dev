<?$field_query=$field_size;
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