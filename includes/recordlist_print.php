<?
function recordListPrint($nama_List,$main_query,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required){
global $ANOM_VARS,$_POST,$_GET,$_SESSION;
$jml_tgl = ListValueCount($field_type_name,"date","|");
$user=cmsDB();
$select_table = cmsDB();
$item=cmsDB();
$status=cmsDB();
$autotext=cmsDB();
$autotext2=cmsDB();
$qchild=cmsDB();
$search=cmsDB();
$custom=cmsDB();
//Query User Admin
//echo $field_type_name;
?>
<!-- BEGIN PAGE CONTENT-->

<div class="col-md-12">
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box green">
  <div class="portlet-title">
     <div class="caption"><i class="icon-globe"></i><?=$nama_List?></div>
     <div class="tools">
        <!---<a href="javascript:;" class="collapse"></a>--->
        <!---<a href="#portlet-config" data-toggle="modal" class="config"></a>--->
        <a href="javascript:;" class="reload"></a>
        <!---<a href="javascript:;" class="remove"></a>--->
     </div> 
  </div>
  <div class="portlet-body">
 <?
	//No. of Row
	$page_row = 20;
	$admin=cmsDB();
	$custom=cmsDB();
	/*if(isset($_GET["paging"])){
		$paging= $_GET["paging"];
	}else{
		$paging=1;
	}
	if($paging==1){
		$start_row = 0;
	}else{
		$start_row = ($paging * $page_row)-$page_row;
	}
	$no=$start_row+1;*/
	$no=1;
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
						if($tipe_field=="text" || $tipe_field=="textarea" || $tipe_field=="auto-text"){
							if(uriParam($name_field."_opr")=="="){
								$lstsearch=$lstsearch." and " . $name_field . "='".uriParam($name_field)."'";
							}elseif(uriParam($name_field."_opr")=="like"){
								$lstsearch=$lstsearch." and " . $name_field . " like '%".uriParam($name_field)."%'";
							}
							
						}elseif($tipe_field=="select" || $tipe_field=="select-read"){
							$lstsearch=$lstsearch." and " . $name_field . " in (".uriParam($name_field).")";
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
				if(uriParam("tmp")=="templates/po_supplier/index.php"){
					if(isset($_GET["lst_spb"])){
						$search_word=$search_word." and po_supplier_id in (".uriParam("lst_spb").")";
					}
				}
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
		$strsql = $main_query;
		
	}else{
		$strsql = "select * from ".$nama_table." where 1 ";
	}
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
	//$strsql = $strsql . " " . $ordersort." limit ".$start_row.",".$page_row;
	$strsql = $strsql . " " . $ordersort;
	$admin->query($strsql);
	
	//echo "Query : -->". $strsql;
	//die();
	//echo "from ".ListValueCount(strtolower($strsql),"from"," ");die();
 ?>
<div class="modal-dialog hidden-print" >				 
 <form action="<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&search=yes&print_recordlist=yes&refresh=<?=md5("mdYHis")?>" method="post" name="search_form">
  <div style="text-align:right">
	Search <input name="txtsearch" type="text" size="20" style="font-size: 14px;font-weight: normal;color: #333333;  background-color: #ffffff;border: 1px solid #e5e5e5;border-radius: 0; width: 200px;" placeholder="Enter text"> 
	<button type="submit" class="btn green" >Search</button>
	<a class="btn green" data-toggle="modal" href="#advance_search">Advance Search <i class="icon-search"></i></a>
	<a class="btn blue hidden-print" onclick="javascript:window.print();">Print <i class="icon-print"></i></a> 
  </div>
  </form>
  </div>
  <?if(uriParam("tmp")=="templates/report/lmkb.php" && isset($_GET["print_recordlist"])){

	if(isset($_GET["search"])){
	$customSQL = "";
		if(uriParam("chk_perusahaan_id")=="on"){
			$custom->query("select nama_perusahaan as name, alamat as addr, contact_phone as notel, kabupaten_id, propinsi_id from ref_perusahaan where perusahaan_id = ".uriParam("perusahaan_id"));
			$custom->next();
			$c_name = $custom->row("name");
			$c_addr = $custom->row("addr");
			$c_telp = $custom->row("notel");
			$kabupaten_id = $custom->row("kabupaten_id");
			$propinsi_id = $custom->row("propinsi_id");

			$custom->query("select kabupaten_nama as name from  ref_kabupaten where kabupaten_id = ".$kabupaten_id);
			$custom->next();
			$kabupaten = $custom->row("name");


			$custom->query("select propinsi_nama as name from  ref_propinsi where propinsi_id = ".$propinsi_id);
			$custom->next();
			$propinsi = $custom->row("name");
		}
  ?>
  

  <div class="col-md-12">	
  <table width="100%">
	<tr>
		<td width="350px">Nama Perusahaan <br> IUPHHK/IPHHK/IPK/ILS/IUIPHHK/IPKL *)</td>
		<td width="1px">:</td>
		<td><?=$c_name;?><td>
	</tr>
	<tr>
		<td>Alamat Perusahaan </td>
		<td>:</td>
		<td><?=$c_addr?></td>
	</tr>
	<tr>
		<td>Nomor Telepon </td>
		<td>:</td>
		<td><?=$c_telp?></td>
	</tr>
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="center"><b>LAPORAN MUTASI KAYU BULAT</b></td>
	</tr>
	<tr>
		<td colspan="3" align="center">Nomor : ..............................</td>
	</tr>
	<tr>
		<td colspan="3" align="center">Bulan : .............................. Tahun .............<td>
	</tr>
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<table width="100%">
				<tr>
					<td width="150px">Provinsi</td>
					<td width="1px">:</td>
					<td><?=$propinsi?></td>
					<td width="350px" align="right">Lokasi TPK Hutan / TPK Antara </td>
					<td width="1px">:</td>
					<td><?=$c_addr?></td>
				</tr>
				<tr>
					<td>Kabupaten / Kota</td>
					<td>:</td>
					<td><?=$kabupaten?></td>
					<td align="right">Industri / Gudang Penampungan *) </td>
					<td>:</td>
					<td>..............</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
  </table>
  
  </div>
  <?	}
	}
  ?>

  <?if(uriParam("tmp")=="templates/report/lmko.php" && isset($_GET["print_recordlist"])){

	if(isset($_GET["search"])){
	$customSQL = "";
		if(uriParam("chk_perusahaan_id")=="on"){
			$custom->query("select nama_perusahaan as name, alamat as addr, contact_phone as notel, kabupaten_id, propinsi_id from ref_perusahaan where perusahaan_id = ".uriParam("perusahaan_id"));
			$custom->next();
			$c_name = $custom->row("name");
			$c_addr = $custom->row("addr");
			$c_telp = $custom->row("notel");
			$kabupaten_id = $custom->row("kabupaten_id");
			$propinsi_id = $custom->row("propinsi_id");

			$custom->query("select kabupaten_nama as name from  ref_kabupaten where kabupaten_id = ".$kabupaten_id);
			$custom->next();
			$kabupaten = $custom->row("name");


			$custom->query("select propinsi_nama as name from  ref_propinsi where propinsi_id = ".$propinsi_id);
			$custom->next();
			$propinsi = $custom->row("name");
		}
  ?>
  <div class="col-md-12">	
  <table width="100%">
	<tr>
		<td width="350px">Nama Perusahaan <br> IUPHHK/IPHHK/IPK/ILS/IUIPHHK/IPKL *)</td>
		<td width="1px">:</td>
		<td><?=$c_name;?><td>
	</tr>
	<tr>
		<td>Alamat Perusahaan </td>
		<td>:</td>
		<td><?=$c_addr;?><td>
	</tr>
	<tr>
		<td>Nomor Telepon </td>
		<td>:</td>
		<td><?=$c_telp;?><td>
	</tr>
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="center"><b>LAPORAN MUTASI KAYU OLAHAN</b></td>
	</tr>
	<tr>
		<td colspan="3" align="center">Nomor : ..............................</td>
	</tr>
	<tr>
		<td colspan="3" align="center">Bulan : .............................. Tahun .............<td>
	</tr>
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<table width="100%">
				<tr>
					<td width="150px">Provinsi</td>
					<td width="1px">:</td>
					<td><?=$propinsi?></td>
					<td width="350px" align="right">Lokasi TPK Hutan / TPK Antara </td>
					<td width="1px">:</td>
					<td><?=$c_addr?></td>
				</tr>
				<tr>
					<td>Kabupaten / Kota</td>
					<td>:</td>
					<td><?=$kabupaten?></td>
					<td align="right">Industri / Gudang Penampungan *) </td>
					<td>:</td>
					<td>..............</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
  </table>
  
  </div>
  <?}
  }?>
  
               <!-- <table class="table table-bordered table-striped table-condensed flip-content">-->
        <table class="table table-striped  table-hover">
                    <thead>
	<tr>
                          <th><font size=-2> No</font></th>
		  <!---$record_show = "judul_hutan|Judul Hutan|center|sort_on,keterangan|Keterangan Hutan|left|sort_off"-->
		  <?for($field=1;$field<=listLen($record_show,"~");$field++){
			$row_detail = listGetAt($record_show,$field,"~");
			$row_field = listGetAt($row_detail,1,"|");
			$row_fname=listGetAt($row_field,1,"^");
			$row_fname_type=listGetAt($row_field,2,"^");
			$row_aliasName = listGetAt($row_detail,2,"|");
			$row_align = listGetAt($row_detail,3,"|");
			$row_sort = listGetAt($row_detail,4,"|");
	  ?>
			 <th>
				 <div class='text-center' valign="top">
					<font size=-2> <?=$row_aliasName?></font>
					 
				 </div>
			  </th>
		  <?}?>
                         <th><div align="center"><font size=-2> Insert Date</font></div>
                       </tr>
                    </thead>
                    <tbody>
	<?
	//$no=1;
	$divno=1;
	while($admin->next()){?>
                       <tr class="highlight">
                          <td class='text-right'><font size=-3><?=$no;?>.<font></td>
							  
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
					$query_field="<i class=\"icon-camera-retro\"></i>";
				}elseif($sub_query=="maps"){	
					$query_child="";
					$query_field="<i class=\"icon-globe\"></i>";
					$query_field=$rmap;
				}else{
					$query_child=listGetAt($sub_query,1,"#");
					$query_field=listGetAt($sub_query,2,"#");
				}
				
				$pos_field = listFind($field_name,$row_fname);
				$pos_type = listGetAt($field_type_name,$pos_field,"#");
				$pos_type_field = listGetAt($pos_type,2,"|");
	switch ($row_align){
		case "left": $algn = "class='text-left'";break;
		case "right": $algn = "class='text-right'";break;
		case "center": $algn = "class='text-center'";break;
	}
				?>
				<td <?=$algn;?>><font size=-2>
					
						<?if($pos_type_field=='select' || $pos_type_field=='select-read'){
							$pos_type_qry = listGetAt($pos_type,3,"|");
							$pos_type_qry = listGetAt($pos_type_qry,1,"^");
							//echo $pos_type_qry."<BR>".$row_fname."<P>";
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
						}else{
							if($row_fname_type=="number"){
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
									if(strlen($query_child) && strlen($query_field)){
										//echo $query_field."<P>";
										$qchild_all = $query_child. " where ".$primary_id . "=" . $admin->row($primary_id);
										//echo $qchild_all;
										$qchild->query($qchild_all);
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
										opt_recordshow($admin->row($primary_id),$admin->row($row_fname),$row_fname);
									}
								}
							}
						}
						?>
					</font>
					</td>
		  <?}?>
                          <td class='text-center'><font size=-3><?=$admin->row("insert_date")?></font></td>
                        
                       </tr>
	  <?
	  $no++;
	  $divno++;
	  }?>

	  				<? if(uriParam("tmp")=="templates/bahanbaku/stok.php"){
					$custom->query("select sum(fisik_jumlah) as fisik_jml, sum(fisik_volume) as fisik_vol, sum(fisik_berat) as fisik_brt from tbl_penerimaan_bhbaku");
	  				$custom->next();
	  				?>
	  					<tr>
	  						<td colspan="6" align="center"><font size=-1>Total</font></td>
	  						<td align="center"><font size=-1>
	  							<?=number_format($custom->row("fisik_jml"),0,",",".")?> |
	  							<?=number_format($custom->row("fisik_vol"),0,",",".")?> m3 |
	  							<?=number_format($custom->row("fisik_brt"),0,",",".")?> Kg
	  						</font></td>
	  				<?
					$custom->query("select sum(pengeluaran_jml) as fisik_jml, sum(pengeluaran_volume) as fisik_vol, sum(pengeluaran_berat) as fisik_brt from tbl_pengeluaran_bhbaku");
	  				$custom->next();
	  				?>
	  						<td align="center"><font size=-1>
	  							<?=number_format($custom->row("fisik_jml"),0,",",".")?> |
	  							<?=number_format($custom->row("fisik_vol"),0,",",".")?> m3 |
	  							<?=number_format($custom->row("fisik_brt"),0,",",".")?> Kg
	  						</font></td>
	  					</tr>
                    <? }?>
                    </tbody>
                 </table>
				</div>
              </div>
           </div> 
		   
			
           <!-- END EXAMPLE TABLE PORTLET-->
        </div>
<?//}?>
</div>
 
<!-- END PAGE CONTENT-->
<div class="modal fade" id="advance_search" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<form action="<?=$_SERVER["SCRIPT_NAME"]?>" class="form-horizontal" role="form" enctype="multipart/form-data" method="get" name="mst">
	       	<input type="hidden" name="tmp" value="<?=uriParam("tmp")?>">
		<input type="hidden" name="search" value="yes">
		<input type="hidden" name="print_recordlist" value="yes">
		<input type="hidden" name="refresh" value="<?=md5("mdYHis")?>">
		<div class="modal-content">
		          <div class="modal-header">
		             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		             <h4 class="modal-title">Advance Search</h4>
		          </div>
		          <div class="modal-body">
			<?
			for($s=1;$s<=listLen($search_field);$s++){
				$field_cari = listGetAt($search_field,$s);
				$pos_field = listFind($field_name,$field_cari);
				$name_field=listGetAt($field_name,$pos_field);
				$tipe_field = listGetAt(listGetAt($field_type_name,$pos_field,"#"),2,"|");
				$qry_field = listGetAt(listGetAt($field_type_name,$pos_field,"#"),3,"|");
				$qry_field = listGetAt($qry_field,1,"^");
				$alias_field = listGetAt($field_alias_name,$pos_field);
				//echo $field_cari." | " . $tipe_field. " | ". $qry_field  ."<P>";
			?>
				<div class="form-group">
					 <label  class="col-md-3 control-label">
						<input type="checkbox" name="chk_<?=$name_field?>" class="form-control">&nbsp;<font size="-1"><B><?=$alias_field?></B></font>
					 </label>
					<div class="col-md-9">
						<?if($tipe_field=="text" || $tipe_field=="textarea" || $tipe_field=="auto-text"){?>
							<select name="<?=$name_field?>_opr" class="form-control input-small select2me" data-placeholder="Select...">
								<option value="=">= (Equal)</option>
								<option value="like">LIKE</option>
							</select>&nbsp;
							<input type="text" name="<?=$name_field?>" size="50" placeholder="<?=$alias_field?>" class="form-control">
						<?}elseif($tipe_field=="select" || $tipe_field=="select-read"){
							$search->query($qry_field);
							echo "<select name=\"".$name_field."\" class=\"form-control input-big select2me\" data-placeholder=\"Select...\">";
							while($search->next()){
								echo "<option value='".$search->row("id")."'>".$search->row("name")."</option>";
							}
							echo "</select>";
							?>
							
						<?}elseif($tipe_field=="number"){?>
							<select name="<?=$name_field?>_oprnumber" class="form-control input-small select2me" data-placeholder="Select...">
								<option value="eq">= (Equal)</option>
								<option value="lt">< (Less Than)</option>
								<option value="lte"><= (Less Than Equal)</option>
								<option value="gt">> (Greater Than)</option>
								<option value="gte">>= (Greater Than Equal)</option>
							</select>&nbsp;
							<input type="text" name="<?=$name_field?>" size="40" value="0" class="form-control" placeholder="<?=$alias_field?>">
						<?}elseif($tipe_field=="date"){?>
							<font size="-2">From</font> <input name="<?=$name_field?>_fromdate" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"/>
							<BR><font size="-2">To</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="<?=$name_field?>_todate" class="form-control form-control-inline input-medium date-picker"  size="10" type="text" value="<?=date("d/m/Y")?>"/>
						<?}?>
							
					</div>
				</div>
			<?}?>
			<div class="form-actions fluid">
		                   <div class="col-md-offset-3 col-md-9" align="left">
				<button type="submit" class="btn blue">Search</button>
		      		<button type="button" data-dismiss="modal" class="btn default">Close</button>                           
		                   </div>
			</div>
			<?//=$search_field?>
			<?//=$field_name?>
			<?//=$field_type_name?>
			</div>
	        </div>
		</form>
	</div>
</div>


<?}?>


