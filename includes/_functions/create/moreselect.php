<?
$field_query=$field_size;
									$select_table->query($field_query);
									?> 
									<select name="<?=$field_name_ori?>[]" class="multi-select" multiple="" id="my_multi_select3" >
	                                    <?while($select_table->next()){?>
											<option value="<?=$select_table->row("id")?>">
												<?=$select_table->row("name")?>
											</option>
										<?}?>
	                                </select>