<?
function _recordList($nama_List,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show){
		global $ANOM_VARS,$_POST,$_GET;
		$user=cmsDB();
		$select_table = cmsDB();
		$item=cmsDB();
		//Query User Admin
		if(isset($_POST["insert"])){
			$strsql = "insert into ".$nama_table." (".$field_name.",insert_date,insert_by,update_date,update_by) values (";
			$lstvalue = "";
			for($field=1;$field<=listLen($field_name);$field++){
				$fname = listGetAt($field_name,$field);
				$ftype_org= listGetAt($field_type_name,$field,"#");
				$ftype = listGetAt($ftype_org,2,"|");
				if($ftype=="password"){
					$fname = listGetAt($field_name,$field);
					$lstvalue = listAppend($lstvalue,"PASSWORD('".postParamSimple($fname)."')");
				}elseif($ftype=="multiselect"){
					echo "string ";
					if (!empty($_POST[$fname])) {
						$strlist = "";
						foreach ($_POST[$fname] as $names)
						{
							$strlist = listAppend($strlist,$names);
						}
						$lstvalue = listAppend($lstvalue,"'".$strlist."'");
					}else{
						$lstvalue = listAppend($lstvalue,"'0'");
					}
					echo $lstvalue;
				}else{
					$fname = listGetAt($field_name,$field);
					$lstvalue = listAppend($lstvalue,"'".postParamSimple($fname)."'");
				}
			}
			$strsql = $strsql . $lstvalue;
			$strsql = $strsql .",'".date("Y-m-d H:i:s")."','".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] ."','".date("Y-m-d H:i:s")."','".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] ."')";
			// echo $strsql;die();
			$user->query($strsql);
		}
		if(isset($_POST["update"])){
			$strsql = "update ".$nama_table." set ";
			$lstvalue = "";
			for($field=1;$field<=listLen($field_name);$field++){
				$fname = listGetAt($field_name,$field);
				$ftype_org= listGetAt($field_type_name,$field,"#");
				$ftype = listGetAt($ftype_org,2,"|");
				if($ftype=="password"){
					if(trim(postParam($fname))<>""){
						$fname = listGetAt($field_name,$field);
						$lstvalue = listAppend($lstvalue,$fname."=PASSWORD('".postParamSimple($fname)."')");
					}
				}elseif($ftype=="multiselect"){
					if (!empty($_POST[$fname])) {
						$strlist = "";
						foreach ($_POST[$fname] as $names)
						{
							$strlist = listAppend($strlist,$names);
						}
						$lstvalue = listAppend($lstvalue,$fname."='".$strlist."'");
					}else{
						$lstvalue = listAppend($lstvalue,$fname."='0'");
					}
				}else{
					$fname = listGetAt($field_name,$field);
					$lstvalue = listAppend($lstvalue,$fname."='".postParamSimple($fname)."'");
				}
			}
			$strsql = $strsql . $lstvalue;
			$strsql = $strsql . ",insert_date='".date("Y-m-d H:i:s")."',insert_by='".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] ."'";
			$strsql = $strsql . "where ".$primary_id ."=".postParamSimple($primary_id);
			$user->query($strsql);
			//echo $strsql;
		}

		if(isset($_GET["delete"])){
			// $strsql = "delete from ".$nama_table." where ".$primary_id."=".uriParam($primary_id);
			$strsql = "update ".$nama_table." set is_deleted=1, delete_date='".date("Y-m-d H:i:s")."', delete_by='".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."' where ".$primary_id."=".uriParam($primary_id);
			$user->query($strsql);
			// echo $strsql;
			// die();
		}
		?>
		<div class="row">
            <div class="col-md-12">
		<!-- BEGIN PAGE CONTENT-->
<?if(isset($_GET["edit"])){
		$edit=cmsDB();
		$edit->query("select * from ".$nama_table." where ".$primary_id."=".uriParam($primary_id));
		$edit->next();
  ?>
 		<div class="padding-15px">
 			<div class="portlet">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-user"></i><?=$form_edit_title?></div>
		   		</div>
                <div class="portlet-body form">
					<!-- BEGIN FORM-->
                    <form action="" method="post" name="updateform" id="updateform" class="form-horizontal">
                        <div class="form-body">
			
							<?for($field=1;$field<=listLen($field_name);$field++){?>   
	                            <div class="form-group">
	                                <label  class="col-md-3 control-label"><?=listGetAt($field_alias_name,$field);?></label>
	                            <div class="col-md-4">
								<?
								$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
								$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
								$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
								$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
								$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
								?>
								<?if($field_type_ori=="text"){?>
									<input name="<?=$field_name_ori?>" type="text" value="<?=$edit->row($field_name_ori)?>"  maxlength="<?=$field_size?>" class="form-control" placeholder="<?=listGetAt($field_alias_name,$field);?>">
								<?}elseif($field_type_ori=="password"){?>
									<input name="<?=$field_name_ori?>" type="password" value="" maxlength="<?=$field_size?>"  class="form-control" placeholder="Password">
								<?}elseif($field_type_ori=="textarea"){?>
									<textarea name="<?=$field_name_ori?>" rows="<?=$field_row?>" class="form-control"><?=$edit->row($field_name_ori)?></textarea>
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
								
								<?}elseif($field_type_ori=="select"){
									$field_query=$field_size;
									$select_table->query($field_query);
								?>
									<select name="<?=$field_name_ori?>" class="form-control select2me" data-placeholder="Select...">
									<option value="0" <?if($select_table->row("id")==$edit->row($field_name_ori)){ echo " selected";}?>>&nbsp;</option>
									<?while($select_table->next()){?>
										<option value="<?=$select_table->row("id")?>" <?if($select_table->row("id")==$edit->row($field_name_ori)){ echo " selected";}?>>
										<?=$select_table->row("name")?>
										</option>
									<?}?>
									</select>
								<?}?>   
                           	</div>
                        </div>
	                <?}?>
			 
				</div>
			<?
				$lstfieldname = "";
				for($field=1;$field<=listLen($field_name);$field++){
					$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
					$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
					$lstfieldname=listAppend($lstfieldname,"updateform.".$field_name_ori); 
				}
			?>
			
                                 <div class="form-actions fluid">
                                    <div class="col-md-offset-3 col-md-9">
                                       <button type="button" data-dismiss="modal"  class="btn green" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','<?=$lstfieldname?>','<?=$primary_id?>=<?=uriParam($primary_id)?>&update=yes&refresh=<?=md5("mdYHis")?>')" >Update</button>
			   <button type="button" data-dismiss="modal" class="btn red" onclick="if(confirm('Are You Sure Want to Delete this Record?')){ get_method('<?=$_SERVER["SCRIPT_NAME"]?>?delete=yes&<?=$primary_id?>=<?=uriParam($primary_id)?>&ref=<?=md5(date("mdyHis"))?>');} ">Delete</button>
			   <button type="button" data-dismiss="modal" class="btn default" onclick="get_method('<?=$_SERVER["SCRIPT_NAME"]?>?ref=<?=md5(date("mdyHis"))?>')">Cancel</button>                      
		          </div>
                                 </div>
                              </form>
                              <!-- END FORM--> 
                          </div>
                           </div>
		</div>

<?}?>
		

               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="padding-15px">
               <div class="portlet">
                  	<div class="portlet-title">
                     	<div class="caption"><i class="icon-globe"></i><?=$nama_List?></div>
                     	<div class="tools">
                        <!---<a href="javascript:;" class="collapse"></a>--->
                        <!---<a href="#portlet-config" data-toggle="modal" class="config"></a>--->
                        <!-- <a href="javascript:;" class="reload"></a> -->
                        <!---<a href="javascript:;" class="remove"></a>--->
                     	</div> 
                  	</div>
	  				<div class="portlet-body">
                     <div class="table-toolbar">
                        <div class="btn-group">
                          	<a class="btn green" data-toggle="modal" href="#responsive"><?=$form_new_title?> <i class="icon-plus"></i></a>
						   <!---<button id="sample_editable_1_new" class="btn green" onclick="get_method('index.php?pgid=index_kph_new&ref=<?=md5(date("mdyHis"))?>')">
                           Add New <i class="icon-plus"></i>
                           </button>--->
                        </div>
                        <!---<div class="btn-group pull-right">
                           <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                           </button>
                           <ul class="dropdown-menu pull-right">
                              <li><a href="#">Print</a></li>
                              <li><a href="#">Save as PDF</a></li>
                              <li><a href="#">Export to Excel</a></li>
                           </ul>
                        </div>--->
                     </div>
					 <?
						//No. of Row
						$page_row = 20;
						$admin=cmsDB();
						if(isset($_GET["paging"])){
							$paging= $_GET["paging"];
						}else{
							$paging=1;
						}
						if($paging==1){
							$start_row = 0;
						}else{
							$start_row = ($paging * $page_row)-$page_row;
						}
						$no=$start_row+1;
						
						//Sorting & Ordering
						if(isset($_GET["orderby"])){
							$orderby = "order by " .$_GET["orderby"];
						}else{
							$orderby = "order by insert_date desc";
						}
						if(isset($_GET["sortby"])){
							$sortby = $_GET["sortby"];
						}else{
							$sortby = "";
						}
						$ordersort = $orderby . " " . $sortby;
						
						//Searching
						if(isset($_POST["search"])){
							if(strlen($search_field)){
								$search_word = " and (";
								for($i=1;$i<=listLen($search_field);$i++){
									if($i==1){
										$search_word = $search_word . listGetAt($search_field,$i) ." like '%".postParamSimple("txtsearch")."%'"; 
									}else{
										$search_word = $search_word . " or " . listGetAt($search_field,$i) ." like '%".postParamSimple("txtsearch")."%'"; 
									}
									
								}
								$search_word = $search_word . ")";
							}else{
								$search_word = "";
							}
						}
						
						$admin->query("select count(*) as no_record from ".$nama_table." where is_deleted=0 ".$search_word);
						$admin->next();
						$no_record = $admin->row("no_record");
						$no_page = ceil($no_record/$page_row);
						//echo $no_page . "--" . $no_record;die();
						
						$strsql = "select * from ".$nama_table. " where is_deleted=0 " . $search_word." ".$ordersort." limit ".$start_row.",".$page_row;
						$admin->query($strsql);
						echo $strsql;
					 ?>
					 <form action="" method="post" name="search_form" id="search_form">
					  <div style="text-align:right">
							  Search <input name="txtsearch" type="text" size="20" style="font-size: 14px;font-weight: normal;color: #333333;  background-color: #ffffff;border: 1px solid #e5e5e5;border-radius: 0; width: 200px;" placeholder="Enter text"> 
									 <button type="button" class="btn green btn-sm" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','search_form.txtsearch','search=yes&refresh=<?=md5("mdYHis")?>')" ><i class="icon-search"></i> Search</button>
					  </div>
					  </form>
					  <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover standar-font" id="sample_1">
                        <thead>
							<tr>
                              <th>No</th>
							  <!---$record_show = "judul_hutan|Judul Hutan|center|sort_on,keterangan|Keterangan Hutan|left|sort_off"-->
							  <?for($field=1;$field<=listLen($record_show);$field++){
									$row_detail = listGetAt($record_show,$field);
									$row_fname = listGetAt($row_detail,1,"|");
									$row_aliasName = listGetAt($row_detail,2,"|");
									$row_align = listGetAt($row_detail,3,"|");
									$row_sort = listGetAt($row_detail,4,"|");
		switch ($row_align){
			case "left": $algn = "class='text-left'";break;
			case "right": $algn = "class='text-right'";break;
			case "center": $algn = "class='text-center'";break;
		}
							  ?>
									 <th <?=$algn;?>>
										 <?=$row_aliasName?>
										 <?if($row_sort=="sort_on"){?>
											  <a  href="javascript:get_method('<?=$_SERVER["SCRIPT_NAME"]?>?orderby=<?=$row_fname?>&sortby=asc&ref=<?=md5(date("mdyHis"))?>')"><img src="<?=$ANOM_VARS["www_img_url"]?>up.gif"> </a>
											  <a  href="javascript:get_method('<?=$_SERVER["SCRIPT_NAME"]?>?orderby=<?=$row_fname?>&sortby=desc&ref=<?=md5(date("mdyHis"))?>')"><img src="<?=$ANOM_VARS["www_img_url"]?>dn.gif"></a>
										 <?}?>
									  </th>
							  <?}?>
                             <th class='text-center'>Insert Date 
							  <a  href="javascript:get_method('<?=$_SERVER["SCRIPT_NAME"]?>?orderby=insert_date&sortby=asc&ref=<?=md5(date("mdyHis"))?>')"><img src="<?=$ANOM_VARS["www_img_url"]?>up.gif"> </a>
							  <a  href="javascript:get_method('<?=$_SERVER["SCRIPT_NAME"]?>?orderby=insert_date&sortby=desc&ref=<?=md5(date("mdyHis"))?>')"><img src="<?=$ANOM_VARS["www_img_url"]?>dn.gif"></a></th>
                              
                           </tr>
                        </thead>
                        <tbody>
						<?
						//$no=1;
						while($admin->next()){?>
                           <tr class="highlight">
                              <td class='text-right'><?=$no;?>.</td>
							   <?for($field=1;$field<=listLen($record_show);$field++){
								  	 $row_detail = listGetAt($record_show,$field);
									$row_field = listGetAt($row_detail,1,"|");
									$row_fname=listGetAt($row_field,1,"^");
									$row_fname_type=listGetAt($row_field,2,"^");
									$row_aliasName = listGetAt($row_detail,2,"|");
									$row_align = listGetAt($row_detail,3,"|");
									$row_sort = listGetAt($row_detail,4,"|");
									$link_on = listGetAt($row_detail,5,"|");
									$pos_field = listFind($field_name,$row_fname);
									$pos_type = listGetAt($field_type_name,$pos_field,"#");
									$pos_type_field = listGetAt($pos_type,2,"|");
							  ?>
								   <td>
									<?if($link_on=="link_on"){?>
										<a  href="javascript:get_method('<?=$_SERVER["SCRIPT_NAME"]?>?edit=yes&<?=$primary_id?>=<?=$admin->row($primary_id)?>&ref=<?=md5(date("mdyHis"))?>')">
									<?}?>
									<?if($pos_type_field=='select' || $pos_type_field=='select-read'){
										$pos_type_qry = listGetAt($pos_type,3,"|");
										$pos_type_qry = listGetAt($pos_type_qry,1,"^");
										if(listFind($pos_type_qry,"where"," ")){
											$item->query($pos_type_qry." and ".$row_fname."=".$admin->row($row_fname));
										}else{
											$item->query($pos_type_qry." where ".$row_fname."=".$admin->row($row_fname));
										}
										if($item->recordCount()){
											$item->next();
											$val_fname = $item->row("name");
										}else{
											$val_fname = "-Unknown-";
										}
									?>
									<?if($row_fname=="status_id"){
										$status->query("select status_color from ref_status where status_name='".$val_fname."'");
										if($status->recordCount()){
											$status->next();
											echo "<span class=\"label label-sm ". $status->row("status_color") ."\">".$val_fname."</span>";
										}else{
											echo $val_fname ;
										}
									}else{
										echo $val_fname;
									}
									?>
									<?}elseif($pos_type_field=='date'){?>
										<?=datesql2date($admin->row($row_fname))?>
									<?}else{?>
										<?if($row_fname_type=="number"){?>
											<? if(is_numeric($admin->row($row_fname))){?>
												<?=number_format($admin->row($row_fname), 2, ',', '.')?>
											<?}else{?>
												0
											<?}?>
										<?}else{?>
											<?=$admin->row($row_fname)?>
										<?}?>
										<?}?>
									
									<?if($link_on=="link_on"){?></a><?}?>
								  </td>
							  <?}?>
                              <td class='text-center'><?=$admin->row("insert_date")?></td>
                            
                           </tr>
						  <?
						  $no++;
						  }?>
                           
                        </tbody>
                     </table>
					</div>
                  </div>
               </div> 
           </div>
			   <!-- Paging-->
			   <form name=frmpage>
			   <div style="text-align:right">
			   Page : 
			   <select name="groupname" onchange="get_method('<?=$_SERVER["SCRIPT_NAME"]?>?paging='+ document.frmpage.groupname.value +'&ref=<?=md5(date("mdyHis"))?>')"  style="font-size: 14px;font-weight: normal;color: #333333;  background-color: #ffffff;border: 1px solid #e5e5e5;border-radius: 0; width: 50px;">
					<?for($i=1;$i<=$no_page;$i++){ ?>
						<option value="<?=$i?>" <?if($paging==$i){ echo " selected";}?>><?=$i?></option>
					<?}?>
			   </select> of <B><?=$no_page?></B> Page(s) from <B><?=$no_record?></B> Record(s)
			   </div>
			   </form>
			    <!-- End of Paging-->
				
               <!-- END EXAMPLE TABLE PORTLET-->
            </div>
         </div>
         <!-- END PAGE CONTENT-->
		 
		 <!-- NEW FORM /.modal -->
		 <div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
			 <form action="" method="post" name="sample_form" id="sample_form">
			   <div class="modal-content">
				  <div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					 <h4 class="modal-title"><?=$form_new_title?></h4>
				  </div>
				  <div class="modal-body">
					<table bordered cellpadding="5" class="font-size-12px">
					 <?
					 $map=0;
					 for($field=1;$field<=listLen($field_name);$field++){?>
						<tr>
							 <td align="right" valign="top">
								<?=listGetAt($field_alias_name,$field);?>
							 </td>
							 <td valign="top">
								<?
									$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
									$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
									$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
									$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
									$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
								?>
								<?if($field_type_ori=="text"){?>
									<input name="<?=$field_name_ori?>" type="text" value="" maxlength="<?=$field_size?>" size="<?=$field_size?>" class="col-md-12 form-control">
								<?}elseif($field_type_ori=="password"){?>
									<input name="<?=$field_name_ori?>" type="password" value="" maxlength="<?=$field_size?>" size="<?=$field_size?>" class="col-md-12 form-control">
									
								<?}elseif($field_type_ori=="textarea"){?>
									<textarea name="<?=$field_name_ori?>" rows="<?=$field_row?>" cols="<?=$field_size?>" class="col-md-12 form-control"></textarea>
								<?}elseif($field_type_ori=="multiselect"){
									
									$field_query=$field_size;
									$select_table->query($field_query);
									
									?>
									<select class="col-md-12 form-control" name="<?=$field_name_ori?>[]" multiple="yes"  size="10">
										<?while($select_table->next()){?>
											<option value="<?=$select_table->row("id")?>">
												<?=$select_table->row("name")?>
											</option>
										<?}?>
									</select>
									<!--&nbsp;Ctrl+Klik to select more than 1 (one)-->
								<?}elseif($field_type_ori=="select"){
									$field_query=$field_size;
									$select_table->query($field_query);
								?>
									<select name="<?=$field_name_ori?>" class="form-control select2me" data-placeholder="Select...">
									<option value="0">&nbsp;</option>
									<?while($select_table->next()){?>
										<option value="<?=$select_table->row("id")?>">
											<?=$select_table->row("name")?>
										</option>
									 <?}?>
									</select>
									
								<?}?>
							</td>
						</tr>
					<?}?>
					<?
					$lstfieldname = "";
					for($field=1;$field<=listLen($field_name);$field++){
						$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
						$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
						$lstfieldname=listAppend($lstfieldname,"sample_form.".$field_name_ori); 
					}?>
					
					 </table>
				  </div>
				  <div class="modal-footer">
					 <button type="button" data-dismiss="modal" class="btn btn-success" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','<?=$lstfieldname?>','insert=yes&refresh=<?=md5("mdYHis")?>')" >Save</button>
					 <button type="button" data-dismiss="modal" class="btn default">Close</button>
					 <!---<button type="button" data-dismiss="modal" class="btn default" onclick="get_method('?pgid=kph_new_master&ref=<?=md5(date("mdYhis"))?>')">Reload parent</button>--->
				  </div>
			   </div>
			   </form>
			</div>
		 </div>
		 <div class="modal fade" id="ajax" tabindex="-1" role="basic" aria-hidden="true">
			<img src="assets/img/ajax-modal-loading.gif" alt="" class="loading">
		 </div>
		 <!-- /.modal -->
<?}?>