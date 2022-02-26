<!-- BEGIN PAGE CONTENT-->
		
		<!-- RECORDLIST BEGIN -->
<div class="col-md-12">
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet">
		<div class="portlet-title">
			<div class="caption"><i class="icon-globe"></i><?=$nama_List?></div>
		</div>
		
		<div class="portlet-body">
			<div class="table-toolbar">
				<!-- SEARCH BOX-->
				<div class="col-md-12">
					<form action="<?=$_SERVER["SCRIPT_NAME"]?>" class="form-horizontal" role="form" enctype="multipart/form-data" method="get" name="mst">
						<input type="hidden" name="tmp" value="<?=uriParam("tmp")?>">
						<input type="hidden" name="search" value="yes">
						<input type="hidden" name="refresh" value="<?=md5("mdYHis")?>">
						<div class="col-md-12" style="margin: 0">
							
							<div class="modal-body" style="padding: 0;">
								<div class="form-group" style="margin-bottom: 0;">
									<?
									for($s=1;$s<=listLen($search_field);$s++){
									$field_cari 		= listGetAt($search_field,$s);
									$pos_field 			= listFind($field_name,$field_cari);
									$name_field			= listGetAt($field_name,$pos_field);
									$tipe_field 		= listGetAt(listGetAt($field_type_name,$pos_field,"#"),2,"|");
									$qry_field 			= listGetAt(listGetAt($field_type_name,$pos_field,"#"),3,"|");
									$qry_field_search 	= listGetAt($qry_field,2,"^");
									$qry_field 			= listGetAt($qry_field,1,"^");
									$alias_field 		= listGetAt($field_alias_name,$pos_field);
									//echo $field_cari." | " . $tipe_field. " | ". $qry_field  ."<P>";
										?>
										
										<label class="col-md-1 control-label" align="left" style="padding: 5px 0;">
											<input type="checkbox" name="chk_<?=$name_field?>" class="form-control"
											<?if (isset($_GET['search']) && isset($_GET['chk_'.$name_field])=='on'){ echo "checked"; }?>>&nbsp;<font size="-1"><?=$alias_field?></font>
										</label>
										<div class="col-md-2">
											<?if($tipe_field=="text" || $tipe_field=="text-readonly" || $tipe_field=="textarea" || $tipe_field=="auto-text"){?>
											<input type="hidden" name="<?=$name_field?>_opr" class="form-control" value="like">
											<input type="text" name="<?=$name_field?>" size="50" placeholder="search <?=$alias_field?>" class="form-control"
											<?if (isset($_GET['search'])){ ?>
											value = "<?=uriParam($name_field)?>"
											<?}?>
											><br>
											<?}elseif($tipe_field=="selectpopup"){
											//$search->query($qry_field);?>
											<input type="text" name="<?=$name_field?>" size="50" placeholder="<?=$alias_field?>" class="form-control">
											<input type="hidden" name="<?=$name_field?>_opr" class="form-control" value="like">
											<input type="hidden" name="<?=$name_field?>_hidden" class="form-control" value="<?=$qry_field?>"><?//=$qry_field?> <?//=$qry_field_search?>
											<input type="hidden" name="<?=$name_field?>_search_hidden" class="form-control" value="<?=$qry_field_search?>"><br>
											<?}elseif($tipe_field=="select" || $tipe_field=="select-read"){
											$search->query($qry_field);
											echo "<select name=\"".$name_field."\" class=\"form-control input-big select2me\" data-placeholder=\"Select ".$alias_field."....\">";?>
												<option value="" selected disabled></option>
												<?
												while($search->next()){?>
												<option value='<?=$search->row("id")?>' <?if($search->row("id")==uriParam($name_field)){ echo "selected";}?> ><?=$search->row("name")?></option>;
												<?}
											echo "</select>";
											?>
											&nbsp;<br>
											<?}elseif($tipe_field=="number"){?>
											<select name="<?=$name_field?>_oprnumber" class="form-control input-small select2me" data-placeholder="Select...">
												<option value="eq">= (Equal)</option>
												<option value="lt">< (Less Than)</option>
												<option value="lte"><= (Less Than Equal)</option>
												<option value="gt">> (Greater Than)</option>
												<option value="gte">>= (Greater Than Equal)</option>
											</select>&nbsp;
											<input type="text" name="<?=$name_field?>" size="20"
											<?if (isset($_GET['search'])){ ?>
											value = "<?=uriParam($name_field)?>"
											<?}else{?>
											value="0"
											<?}?>
											class="form-control" placeholder="<?=$alias_field?>">
											<?}elseif($tipe_field=="date" || $tipe_field=="date-readonly"){?>
											<!-- <font size="-2">From</font>
											<input name="<?=$name_field?>_fromdate" class="form-control form-control-inline date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"/>
											<BR><font size="-2">To</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="<?=$name_field?>_todate" class="form-control form-control-inline date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"/>
											&nbsp;<br>
											-->
											<div class="input-group input-daterange">
												<!-- <input type="text" class="form-control" name="from"> -->
												<input name="<?=$name_field?>_fromdate" class="form-control date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"/>
												<span class="input-group-addon" style="padding:0;">to</span>
												<!-- <input type="text" class="form-control" name="to"> -->
												<input name="<?=$name_field?>_todate" class="form-control date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"/>
											</div>
											<?}?>
											
										</div>
										
										<?}?>
										<?//=$search_field?>
										<?//=$field_name?>
										<?//=$field_type_name?>
										<button type="submit" class="btn green pull-right"><i class="icon-search"></i> Search</button>
									</div>
									
									
								</div>
							</div>
							<!-- <div class="col-md-12 form-actions fluid" align="right"  style="margin-top: 0">
								<button type="submit" class="btn green">&nbsp;&nbsp;&nbsp;&nbsp;Lakukan Pencarian&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;
							</div> -->
							<hr>
				</form>
			</div>
			<!-- END OF SEARCH BOX -->
			<div class="btn-group">
				<?if(_checkauth("New")){
					if($form_new_title!="") {
						if(isset($_GET["search"])){
							$url_new = "?tmp=".uriParam("tmp")."&new_form=yes&". $_SERVER["QUERY_STRING"]."&ref".md5(date("mdYHis"));
						}else{
							$url_new = "?tmp=".uriParam("tmp")."&new_form=yes&ref".md5(date("mdYHis"));
						}
						echo "<a class='btn default' href=".$url_new.">Add New <i class='icon-plus'></i></a>";
					}
				}?>   
            </div>
        </div>
			 <?
				//No. of Row
				$page_row = 10;
				$admin=cmsDB();
				$custom=cmsDB();
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
					$orderby = "order by ".$nama_table.".update_date desc";
				}
				if(isset($_GET["sortby"])){
					$sortby = $_GET["sortby"];
				}else{
					$sortby = "";
				}
				$ordersort = $orderby . " " . $sortby;
				
				//Searching
				if(isset($_GET["search"])){
					if(strlen($search_field)){
						if(isset($_POST["txtsearch"])){
							$search_word = "  and (";
							for($i=1;$i<=listLen($search_field);$i++){
								if($i==1){
									$search_word = $search_word . listGetAt($search_field,$i) ." like '%".postParamSimple("txtsearch")."%'"; 
								}else{
									$search_word = $search_word . " or " . listGetAt($search_field,$i) ." like '%".postParamSimple("txtsearch")."%'"; 
								}
								
							}
							$search_word = $search_word . ")";
						}else{
							$lstsearch="";
							for($s=1;$s<=listLen($search_field);$s++){
								$field_cari = listGetAt($search_field,$s);
								$pos_field = listFind($field_name,$field_cari);
								$name_field=listGetAt($field_name,$pos_field);
								$tipe_field = listGetAt(listGetAt($field_type_name,$pos_field,"#"),2,"|");
								//$qry_field = listGetAt(listGetAt($field_type_name,$pos_field,"#"),3,"|");
								//$qry_field = listGetAt($qry_field,1,"^");
								//$alias_field = listGetAt($field_alias_name,$pos_field);
								if(isset($_GET["chk_".$name_field])){
									if($tipe_field=="text" || $tipe_field=="text-readonly" || $tipe_field=="textarea" || $tipe_field=="auto-text"){
										if(uriParam($name_field."_opr")=="="){
											$lstsearch=$lstsearch." and " . $name_field . "='".uriParam($name_field)."'";
										}elseif(uriParam($name_field."_opr")=="like"){
											$lstsearch=$lstsearch." and " . $name_field . " like '%".uriParam($name_field)."%'";
										}
									}elseif($tipe_field=="selectpopup"){
										//uriParam($name_field."_search");
										//uriParam($name_field."_search_hidden");
										$search_tmp = cmsDB();
										$sql_src = trim(listGetAt(uriParam($name_field."_hidden"),1,"~"));
										if(ListValueCount(strtolower($sql_src),"where"," ") >= 1){
											if(uriParam($name_field."_opr")=="="){
												$strsql=$sql_src  . " and " .uriParam($name_field."_search_hidden")."='".trim(uriParam("$name_field"))."'";
											}elseif(uriParam($name_field."_opr")=="like"){
												$strsql=$sql_src  . " and " .uriParam($name_field."_search_hidden")." like '%".trim(uriParam("$name_field"))."%'";
											}
										}else{
											if(uriParam($name_field."_opr")=="="){
												$strsql=$sql_src  . " where " .uriParam($name_field."_search_hidden")."='".trim(uriParam("$name_field"))."'";
											}elseif(uriParam($name_field."_opr")=="like"){
												$strsql=$sql_src  . " where " .uriParam($name_field."_search_hidden")." like '%".trim(uriParam("$name_field"))."%'";
											}
										}
										//echo $strsql."<P>";
										$search_tmp->query($strsql);
										$var_val = listLast(uriParam($name_field."_hidden"),"~");
										if($search_tmp->recordCount()){
											$val_isi = $search_tmp->valueList($var_val);
										}else{
											$val_isi=0;
										}
										$lstsearch=$lstsearch." and " . $name_field . " in (".$val_isi.")";
										
									}elseif($tipe_field=="select" || $tipe_field=="select-read"){
										if(strlen(uriParam($name_field)) > 0 ){
											$val_isi = uriParam($name_field);
										}else{
											$val_isi=0;
										}
										$lstsearch=$lstsearch." and " . $name_field . " in (".$val_isi.")";
									}elseif($tipe_field=="number"){
										if(uriParam($name_field."_oprnumber")=="eq"){
											$lstsearch=$lstsearch." and " . $name_field . "=".uriParam($name_field);
										}elseif(uriParam($name_field."_oprnumber")=="gt"){
											$lstsearch=$lstsearch." and " . $name_field . ">".uriParam($name_field);
										}elseif(uriParam($name_field."_oprnumber")=="gte"){
											$lstsearch=$lstsearch." and " . $name_field . ">=".uriParam($name_field);
										}elseif(uriParam($name_field."_oprnumber")=="lt"){
											$lstsearch=$lstsearch." and " . $name_field . "<".uriParam($name_field);
										}elseif(uriParam($name_field."_oprnumber")=="lte"){
											$lstsearch=$lstsearch." and " . $name_field . "<=".uriParam($name_field);
										}	
									}elseif($tipe_field=="date"){
										$start_date="";
										$to_date="";
										if(isset($_GET[$name_field."_fromdate"])){
											$date_org = uriParam($name_field."_fromdate");
											$year=listGetAt($date_org,3,"/");
											$month=listGetAt($date_org,2,"/");
											$day=listGetAt($date_org,1,"/");
											$start_date=$year . "-" . $month . "-".$day;
										}
										if(isset($_GET[$name_field."_todate"])){
											$date_org = uriParam($name_field."_todate");
											$year=listGetAt($date_org,3,"/");
											$month=listGetAt($date_org,2,"/");
											$day=listGetAt($date_org,1,"/");
											$to_date=$year . "-" . $month . "-".$day;
										}
										if(strlen($start_date) && strlen($to_date)){
											$lstsearch=$lstsearch." and (" . $name_field . ">='".$start_date."' and " . $name_field . "<='".$to_date."')";
										}
										
									}
								}
							}
							$search_word=$lstsearch;
							// if(uriParam("tmp")=="templates/po_supplier/index.php"){
							// 	if(isset($_GET["lst_spb"])){
							// 		$search_word=$search_word." and po_supplier_id in (".uriParam("lst_spb").")";
							// 	}
							// }
							//echo "Tambahan Search : " . $lstsearch;
						}
					}else{
						$search_word = "";
					}
				}
				//echo $search_word;
				if(strlen($search_word)){
					if(strlen($main_query)){
						if(ListValueCount(strtolower($main_query),"where"," ") >= 1){
							if(strlen(trim($search_word))){
								$admin->query($main_query." ".$search_word);
								//$search_word = " " . $search_word;
							}
							
						}else{
							if(strlen(trim($search_word))){
								$admin->query($main_query." where 1 ".$search_word);
								//$search_word = " where 1 " . $search_word;
							}
						}
						
						$no_record = $admin->recordCount();
					}else{
						$admin->query("select count(*) as no_record from ".$nama_table."  where 1 ".$search_word);
						$admin->next();
						$no_record = $admin->row("no_record");
					}
				}else{
					if(strlen($main_query)){
						$admin->query($main_query);
						$no_record = $admin->recordCount();
					}else{
						$admin->query("select count(*) as no_record from ".$nama_table);
						$admin->next();
						$no_record = $admin->row("no_record");
					}
				}
				
				
				$no_page = ceil($no_record/$page_row);
				//echo $no_page . "--" . $no_record;die();
				
				if(strlen($main_query)){
					//echo "MAsuk dimari <P>";
					$strsql = $main_query;
					
				}else{
					$strsql = "select * from ".$nama_table." where 1 ";
				}
				//echo $strsql."<P>";
				if(ListValueCount(strtolower($strsql),"where"," ") >= 1){
					if(strlen(trim($search_word))){
						$search_word = " " . $search_word;
					}
					
				}else{
					if(strlen(trim($search_word))){
						$search_word = " where 1 " . $search_word;
					}
				}
				//echo "search : " . $search_word;
				if(strlen(trim($search_word))){
					$strsql = $strsql .  $search_word;
				}
				$strsql = $strsql . " " . $ordersort." limit ".$start_row.",".$page_row;
				$admin->query($strsql);
				
				//echo "Query : -->". $strsql;
				//die();
				//echo "from ".ListValueCount(strtolower($strsql),"from"," ");die();
			 ?>
			 
			 
		  	<div class="table-scrollable">
	                   <!-- <table class="table table-bordered table-striped table-condensed flip-content">-->
		        <table class="table table-striped table-hover standar-font" id="recordlistTable">
	                <thead>
						<tr style='font-size:10px; height: 2px;'>
				            <th style='background-color: #F9F9F9;text-align: center;'><font size="-1">No</font></th>
							<?if(uriParam("tmp") == encryptStringArray('templates/ref_lkpb/index.php')){?>
				                <th style='background-color: #F9F9F9;'><div align="center"><font size="-1">Form</font></div>
							<?}?>
						  	<?for($field=1;$field<=listLen($record_show,"~");$field++){
							$row_detail = listGetAt($record_show,$field,"~");
							$row_field = listGetAt($row_detail,1,"|");
							$row_fname=listGetAt($row_field,1,"^");
							$row_fname_type=listGetAt($row_field,2,"^");
							$row_aliasName = listGetAt($row_detail,2,"|");
							$row_align = listGetAt($row_detail,3,"|");
							$row_sort = listGetAt($row_detail,4,"|");?>
							<th style='background-color: #F9F9F9;'>
								<div class='text-center' valign="top">
									<?=$row_aliasName?>
									<?if($row_sort=="sort_on"){?>
									 	<br>
										<a  href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&orderby=<?=$row_fname?>&sortby=asc&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-chevron-up"></i></a>
										<a  href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&orderby=<?=$row_fname?>&sortby=desc&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-chevron-down"></i></a>
									<?}?>
								 	
								</div>
							</th>
						  	<?}?>
			
	                        <th style='background-color: #F9F9F9;'>
	                        	<div align="center">
	                        		

	                        		<font size="-1">Last Update</font>
	                        		<br>

	                        		<a  href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&orderby=update_date&sortby=asc&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-chevron-up"></i></a>
										<a  href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&orderby=update_date&sortby=desc&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-chevron-down"></i></a>
	                        	</div>
	                        </th>
			     			<th style='background-color: #F9F9F9;'>
			     				<div align="center">
			     					<font size="-1"> By</font>
			     					<br>
	                        		
	                        		<a  href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&orderby=update_by&sortby=asc&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-chevron-up"></i></a>
										<a  href="javascript:location='<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&orderby=update_by&sortby=desc&ref=<?=md5(date("mdyHis"))?>';"><i class="icon-chevron-down"></i></a>
			     				</div>
							</th>
							<?if(uriParam("tmp") == encryptStringArray('templates/logsheet/index.php')){?>
	                            <th style='background-color: #F9F9F9;'><div align="center"><font size="-1">Form Unit</font></div></th>
							<?}?>
	                	</tr>
	                </thead>
				<tbody>
			<?
			//$no=1;
			$divno=1;
			while($admin->next()){?>
	                           <tr class="highlight">
	                              <td class='text-right'><font size=-1><?=$no;?>.<font></td>
				<?if(uriParam("tmp") == encryptStringArray('templates/ref_lkpb/index.php')){?>
					<td class='text-center'>
						<a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_lkpb/preview.php')?>&lkpb_id=<?=encryptStringArray($admin->row($primary_id))?>"><i class=" icon-file-text"></i></a>
					</td>
				<?}?>



				   <?for($field=1;$field<=listLen($record_show,"~");$field++){
						$row_detail = listGetAt($record_show,$field,"~");
						$row_field = listGetAt($row_detail,1,"|");
						$row_fname=listGetAt($row_field,1,"^");
						$row_fname_type=listGetAt($row_field,2,"^");
						$row_aliasName = listGetAt($row_detail,2,"|");
						$row_align = listGetAt($row_detail,3,"|");
						$row_sort = listGetAt($row_detail,4,"|");
						$link_on = listGetAt($row_detail,5,"|");
						$sub_query = listGetAt($row_detail,6,"|");
						if($sub_query=="sub_query_off"){
							$query_child="";
							$query_field="";
						}elseif($sub_query=="photo"){	
							$query_child="";
							$query_field="<i class=\"icon-file\"></i>";
						}elseif($sub_query=="files"){	
							$query_child="";
							$query_field="<i class=\"icon-file\"></i>";
						}elseif($sub_query=="maps"){	
							$query_child="";
							$query_field="<i class=\"icon-globe\"></i>";
							$query_field=$rmap;
						}else{
							$query_child=listGetAt($sub_query,1,"#");
							$query_field=listGetAt($sub_query,2,"#");
						}
						//echo $sub_query."<P>";
						$pos_field = listFind($field_name,$row_fname);
						$pos_type = listGetAt($field_type_name,$pos_field,"#");
						$pos_type_field = listGetAt($pos_type,2,"|");
						switch ($row_align){
							case "left": $algn = "class='text-left'";break;
							case "right": $algn = "class='text-right'";break;
							case "center": $algn = "class='text-center'";break;
						}
						?>
						<td <?=$algn;?>><font size=-1>
							<?if(_checkauth("View")){?>
								<?if($link_on=="link_on"){
									if(isset($_GET["search"])){
										$url_view = "?tmp=".uriParam("tmp")."&edit=yes&".$primary_id."=".encryptStringArray($admin->row($primary_id))."&".$_SERVER["QUERY_STRING"]."&ref=".md5(date("mdyHis"));
										
									}else{
										$url_view = "?tmp=".uriParam("tmp")."&edit=yes&".$primary_id."=".encryptStringArray($admin->row($primary_id))."&ref=".md5(date("mdyHis"));
									}
									?>
									<a href="<?=$url_view?>">
								<?}?>
							<?}?>
							<?if(uriParam("tmp")=="templates/transaksi/index.php"){?>
								<?if($link_on=="link_on"){?>
									<a href="?tmp=templates/transaksi/forex_form.php&edit_form=yes&<?=$primary_id?>=<?=$admin->row($primary_id)?>&ref=<?=md5(date("mdyHis"))?>">
								<?}?>
							<?}
								//echo "xxxx".$pos_type_field;
							?>
								<?
								
								if($pos_type_field=='select' || $pos_type_field=='select-read'){
									$pos_type_qry = listGetAt($pos_type,3,"|");
									$pos_type_qry = listGetAt($pos_type_qry,1,"^");
									//echo $pos_type_qry."<BR>".$row_fname."<P>";
									if($sub_query == "sub_query_off"){
										if(listFind($pos_type_qry,"where"," ")){
											$item->query($pos_type_qry." and ".$row_fname."=".$admin->row($row_fname));
										}else{
											$item->query($pos_type_qry." where ".$row_fname."='".$admin->row($row_fname)."'");
										}
									}else{
										$sub_query_text = listGetAt($sub_query,1,"#");
										$sub_query_type =listGetAt(listGetAt($sub_query,2,"#"),2,"-");
										if($sub_query_type=="string"){
										//echo $sub_query_text. "--" . $sub_query_type."--<BR>";
											if(listFind($pos_type_qry,"where"," ")){
												$item->query($sub_query_text." where ".$row_fname."=".$admin->row($row_fname));
											}else{
												$item->query($sub_query_text." where ".$row_fname."=".$admin->row($row_fname));
											}
										}
										
									}
									
									if($item->recordCount()){
										$item->next();
										$val_fname = $item->row("name");
									}else{
										$val_fname = "-";
									}
									if($row_fname=="status_id"){
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
								}elseif($pos_type_field=='multiselect'){
									$pos_type_qry = listGetAt($pos_type,3,"|");
									$pos_type_qry = listGetAt($pos_type_qry,1,"^");
									//echo $pos_type_qry."<BR>".$row_fname."<P>";
									
									if(strlen($admin->row($row_fname))>0){
										$list_id = $admin->row($row_fname);
									}else{
										$list_id = 0;
									}

									if($sub_query == "sub_query_off"){
										if(listFind($pos_type_qry,"where"," ")){
											$item->query($pos_type_qry." and ".$row_fname." in (".$list_id.")");
										}else{
											$item->query($pos_type_qry." where ".$row_fname." in (".$list_id.")'");
										}
									}else{
										$sub_query_text = listGetAt($sub_query,1,"#");
										$sub_query_type =listGetAt(listGetAt($sub_query,2,"#"),2,"-");
										if($sub_query_type=="string"){
										//echo $sub_query_text. "--" . $sub_query_type."--<BR>";
											if(listFind($pos_type_qry,"where"," ")){
												$item->query($sub_query_text." where ".$row_fname." in (".$list_id.")");
												echo "";
											}else{
												$item->query($sub_query_text." where ".$row_fname." in (".$list_id. ")");
											}
										}
										
									}
									
									if($item->recordCount()){
										$val_fname= "";
										while($item->next()){
											$val_fname = $val_fname . $item->row("name") .', ';
										}
									}else{
										$val_fname = "-";
									}
									
									echo $val_fname;

								}elseif($pos_type_field=='selectpopup'){
									$pos_type_qry = listGetAt($pos_type,3,"|");
									//echo $pos_type_qry."<BR><BR>";
									$nama_key = listLast($pos_type_qry,"~");
									$pos_type_qry = listGetAt($pos_type_qry,1,"^");
									//echo $pos_type_qry."<P>";
									$pos_type_qry = trim(listGetAt($pos_type_qry,1,"~"));
									//echo $pos_type_qry."<BR>".$row_fname."<BR><BR>";
									//echo $pos_type_qry." where ".$row_fname."=".$admin->row($row_fname)."---".$nama_key."<BR>";
									if(listLen($nama_key,"^")>1){
										$nama_key = listGetAt($nama_key,2,"^");
									}
									//if(listFind($pos_type_qry,"where"," ")){
									if(ListValueCount(strtolower($pos_type_qry),"where"," ") == 1){
										$item->query($pos_type_qry." and ".$row_fname."='".$admin->row($row_fname)."'");
									}elseif(ListValueCount(strtolower($pos_type_qry),"where"," ") > 1){
										$item->query($pos_type_qry." and ".$row_fname."='".$admin->row($row_fname)."'");
									}else{
										//echo $pos_type_qry." where ".$row_fname."='".$admin->row($row_fname)."'";
										$item->query($pos_type_qry." where ".$row_fname."='".$admin->row($row_fname)."'");
										//echo "jml : ".$item->recordCount();
									}
									if($item->recordCount()){
										$item->next();
										//echo $nama_key."--";
										$val_fname = $item->row($nama_key);
										//echo $val_fname;
									}else{
										$val_fname = "-";
									}
									if($row_fname=="status_id"){
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
								}elseif($pos_type_field=='date'){
									echo datesql2date($admin->row($row_fname));
								}elseif($pos_type_field=='number'){
									if(is_numeric($admin->row($row_fname))){
										echo number_format($admin->row($row_fname), 2, ',', '.');
									}else{
										echo 0;
									}
								}else{
									
									if($sub_query=="photo"){
										if(strlen($admin->row($row_fname))){
											$nama_pict = $admin->row($row_fname);
											echo "<a href='". $ANOM_VARS["www_file_url"] ."upload_photo/". $admin->row($row_fname)  ."' target='_blank'>".$query_field."</a>";
										}else{
											echo "-";
										}
									}elseif($sub_query=="gambar"){
										if(strlen($admin->row($row_fname))){
											$nama_pict = $admin->row($row_fname);
											echo "<a href='". $ANOM_VARS["www_file_url"] ."upload_photo/". $admin->row($row_fname)  ."' target='_blank'>
													<img width='80' src='". $ANOM_VARS["www_file_url"] ."upload_photo/". $admin->row($row_fname)  ."'  />
												   </a>";
										}else{
											echo "-";
										}
									}elseif($sub_query=="verify"){
										
										$status->query("select status_color,status_name from ref_status where status_id='".$admin->row($row_fname) ."'");
										if($status->recordCount()){
											$status->next();
											echo "<span class=\"label label-sm ". $status->row("status_color") ."\">".$status->row("status_name") ."</span>";
										}else{
											echo "-Unknown Status-" ;
										}
										
									}elseif($sub_query=="files"){
										if(strlen($admin->row($row_fname))){
											$nama_pict = $admin->row($row_fname);
											echo "<a href='". $ANOM_VARS["www_file_url"] ."upload_photo/". $admin->row($row_fname)  ."' target='_blank'>".$query_field."</a>";
										}else{
											echo "-";
										}
									}elseif($sub_query=="maps"){
										if(listLen($row_fname,"_")>1){
											$row_map = listGetAt($row_fname,1,"_");
											$row_map1 = $row_map."_lon";
											$row_map2 = $row_map."_lat";
										}else{
											//$row_map = listGetAt($row_fname,1,"_");
											$row_map1 = "lon";
											$row_map2 = "lat";
										}
										if(strlen($admin->row($row_map1)) && strlen($admin->row($row_map2))){
											$nama_lok = "Here !";
//											echo "<br><br><br><br>".$admin->row($row_map1)." ".$admin->row($row_map2)." ".$nama_pict;
											$rmap = ($admin->row($row_map1) and $admin->row($row_map2)) ? "<a href='#' onclick='xxrenderMap(".$admin->row($row_map2).",".$admin->row($row_map1).",\"".$nama_lok."\",\"".$nama_pict."\" )' role='button' class='btn btn-sm green' data-toggle='modal' data-target='#myMapModalOK'><i class='icon-map-marker'></i></a>" : "";
											echo $rmap;
//											echo "<a href='vmap.php?".$primary_id."=".$admin->row($primary_id)."&idlon=".$row_map1."&idlat=".$row_map2."&id=".$primary_id."&table=".$nama_table ."'  target='_blank'>".$query_field."</a>";
											
										}else{
											echo "-";
										}
									}else{
										//echo "masuk sini";
										if(strlen($query_child) && strlen($query_field)){
											//echo "---".$query_field."<P>";
											$fname_query=listGetAt($query_field,1,"-");
											$fname_query_type=listGetAt($query_field,2,"-");
											$qchild_all = $query_child. " where " .$nama_table.".".$primary_id . "='" . $admin->row($primary_id)."'";
											//echo $qchild_all;
											$qchild->query($qchild_all);
											/*if($qchild->recordCount()){
												$qchild->next();
												if($fname_query_type=="number"){
													echo number_format($qchild->row($fname_query),2);
												}else{
													echo $qchild->row($fname_query);
												}
											}*/
											if($qchild->recordCount()){
												$lstitem="";
												while($qchild->next()){
													$lstitem=$lstitem."- ";
													for($q=1;$q<=listLen($query_field,"^");$q++){
														$fchild=listGetAt($query_field,$q,"^");
														//echo "*".$fchild."*";
														$f_item = listGetAt($fchild,1,"-");
														$f_tipe = listGetAt($fchild,2,"-");
														//echo "*" . $f_tipe . "*";
														if($f_tipe=="number"){
															if(strlen($qchild->row($f_item))){
																$lstitem=$lstitem . number_format($qchild->row($f_item),  2, ',', '.') . " | ";
															}else{
																$lstitem=$lstitem . "0 | ";
															}
															
														}else{
															$lstitem=$lstitem. $qchild->row($f_item) . " | ";
														}
														//$lstitem=$lstitem. $qchild->row($fchild) . " | ";
													}
													$lstitem=substr($lstitem,0,strlen($lstitem)-2);
													$lstitem=$lstitem."<BR>";
													//echo listLen($lstitem,"<BR>")  . "-- ";
													
												}
												if(listLen($lstitem,"<BR>") > 1){
													echo "<font size='-1'>".$lstitem."</font>";
												}else{
													echo substr($lstitem,2,strlen($lstitem)-2);
													//echo $lstitem;
												}
											}else{
												echo "<font color=red>-Invalid Data-</font>";
											}
											
											
										}else{
											//Custom Field PO Buyer/SPM
											//echo "sss";
											opt_recordshow($admin->row($primary_id),$admin->row($row_fname),$row_fname);
										}
									}
									
								}
							if(_checkauth("View")){
								if($link_on=="link_on"){ 
									echo "</a>";
								}
							}?>
							<?if(uriParam("tmp")=="templates/ref_supplier/index.php" || uriParam("tmp")=="templates/ref_buyer/index.php"){?>
								<?if($link_on=="link_on"){
									echo "</a>";
								}?>
							<?}?>
							</font>
							</td>
				  <?}?>
					
	                              	<td class='text-center'>
	                              		<font size=-1><?=datesql2datetime($admin->row("update_date"))?></font>
	                              	</td>

	                              	<td class='text-center'>
								    	<?
										$user->query("select * from ref_user where user_id=".$admin->row("update_by"));  
										$user->next();
								       	?>
	                              		<font size=-1>
	                              			<?if($user->recordCount()){ echo $user->row("full_name");
	                              			}else{ echo ' - '; }?>
	                              		</font>
	                              	</td>

	                             <?if(uriParam("tmp") == encryptStringArray('templates/logsheet/index.php')){?>
									<td class='text-center'>
										<a href="index-template.php?tmp=<?=encryptStringArray('templates/logsheet/preview.php')?>&group_location_id=<?=encryptStringArray($admin->row('group_location_id'))?>&unit_id=<?=encryptStringArray($admin->row('unit_id'))?>&date=<?=encryptStringArray($admin->row('date'))?>"><i class="icon-bar-chart"></i></a>
									</td>
								<?}?>
		

	                           </tr>
			  <?
			  $no++;
			  $divno++;
			  }?>
	
			
	                        </tbody>
	                     </table>
						</div>
	                  </div>
	               </div> 
		   <!-- Paging-->
		   <center>
		<button type="button" class="btn btn-secondary" onclick="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?>&paging=1&ref=<?=md5(date("mdyHis"))?>';">First </button>
		<button type="button" class="btn btn-secondary" onclick="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?>&paging=<?=$paging-1?>&ref=<?=md5(date("mdyHis"))?>';"><</button>&nbsp;&nbsp; 
		<button type="button" class="btn btn-secondary" onclick="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?>&paging=<?=$paging+1?>&ref=<?=md5(date("mdyHis"))?>';">></button>
		<button type="button" class="btn btn-secondary" onclick="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?>&paging=<?=$no_page?>&ref=<?=md5(date("mdyHis"))?>';">Last</button>
		
		<br><br><B>Page :  <font color="red"><?=number_format($paging,0)?></font> of Total Page : <B><font color="green"><?=number_format($no_page,0)?></font></B> | Total Data : <B><?=number_format($no_record,0)?></B> Record(s)
		
	   	</center>
		
		    <!-- End of Paging-->
					
	               <!-- END EXAMPLE TABLE PORTLET-->
	            </div>