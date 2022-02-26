<?
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