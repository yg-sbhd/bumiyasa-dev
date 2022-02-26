<?
function reportGenerator($nama_List,$main_query,$nama_table,$primary_id,$field_name,$field_type_name,$record_show,$paging_no){
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
<style>
    @page {
      size: auto;  /* auto is the initial value */
      margin: 0mm; /* this affects the margin in the printer settings */
    }
    @media print
    {
        body * { visibility: hidden; }
        #printcontent * { 
            visibility: visible;
        }
        @media print and (-webkit-min-device-pixel-ratio:0) {
         body { position: relative; }       
         #printcontent {
            position: absolute;
            top: 20px;
            left: 0;
            width: 100%;
            text-align: center;

         }

         #printcontent * {
          /*color: rgba(0, 0, 0.5, 0.5) !important;*/
         color: #000;
          -webkit-print-color-adjust: exact;
        }
      }
    }
</style>
  
<div style="text-align:right">
    <a class="btn blue hidden-print" onclick="javascript:window.print();">Print <i class="icon-print"></i></a> 
</div>
<BR>
<div id="printcontent">
<div class="col-md-12">
<!-- BEGIN EXAMPLE TABLE PORTLET-->

 <?
    //No. of Row
    $page_row = $paging_no;
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
    
    // echo "string ---- " .$main_query;
    $strsql = $main_query;
    $admin->query($strsql);
    $no_record = $admin->recordCount();
    $no_page = ceil($no_record/$page_row);
    
    $strsql = $strsql . " limit ".$start_row.",".$page_row;
    $admin->query($strsql);
    //echo $admin->recordCount();
    //echo "Query : -->". $strsql;
    //die();
    //echo "from ".ListValueCount(strtolower($strsql),"from"," ");die();
 ?>
  <div class='text-center' valign="top">
            <font size=+1><B><?=$nama_List?></B></font>
        </div>
<table class="table table-striped  table-hover">
    <thead>
   
    <tr>
    <th colspan=<?=listLen($record_show,"~")?>>&nbsp;</th>
    </tr>
    <tr>
        <th>
        <div class='text-right' valign="top">
        <font size=-1> No</font>
        </div>
        </th>
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
                    <font size=-1> <?=$row_aliasName?></font>
                     
                 </div>
              </th>
          <?}?>
                         
            </tr>
        </thead>
        <tbody>
    <?
    //$no=1;
    $divno=1;
    if($admin->recordCount()){
       while($admin->next()){?>
        <tr class="highlight">
            <td class='text-right'><font size=-3><?=$no;?>.<font></td>
                        
            <?
            for($field=1;$field<=listLen($record_show,"~");$field++){
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
        <td <?=$algn;?>>
            <font size=-2>
            <?if($pos_type_field=='select' || $pos_type_field=='select-read'){
                $pos_type_qry = listGetAt($pos_type,3,"|");
                $pos_type_qry = listGetAt($pos_type_qry,1,"^");
                // echo $pos_type_qry."<BR>".$row_fname."<P>";
                if(listFind($pos_type_qry,"where"," ")){
                    $item->query($pos_type_qry." and ".$row_fname."=".$admin->row($row_fname));
                }else{
                    $item->query($pos_type_qry." where ".$row_fname."=".$admin->row($row_fname));
                }

            // --------------EDITAN YOGI
                // $pos_type_qry = listGetAt($pos_type,3,"|");
                // $pos_type_qry = listGetAt($pos_type_qry,1,"^");

                // if(listFind($pos_type_qry,"where"," ")){
                //     $item->query($pos_type_qry." and ".$row_fname."=".$admin->row($row_fname));
                // }else{
                //     $field_name = listGetAt($pos_type_qry, 2, ' ');
                //     if ($field_name == $row_fname) {
                //         $item->query($pos_type_qry." where ".$row_fname."=".$admin->row($row_fname));
                //     }else{
                //         $item->query($pos_type_qry." where ".$field_name."=".$admin->row($row_fname));
                //     }
                // }
            // -------------- AKHIR EDITAN YOGI

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
            }elseif($pos_type_field=='two-date'){
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
//      echo "<br><br><br><br>".$admin->row($row_map1)." ".$admin->row($row_map2)." ".$nama_pict;
                            $rmap = ($admin->row($row_map1) and $admin->row($row_map2)) ? "<a href='#' onclick='xxrenderMap(".$admin->row($row_map2).",".$admin->row($row_map1).",\"".$nama_lok."\",\"".$nama_pict."\" )' role='button' class='btn btn-sm green' data-toggle='modal' data-target='#myMapModalOK'><i class='icon-map-marker'></i></a>" : "";
                            echo $rmap;
//      echo "<a href='vmap.php?".$primary_id."=".$admin->row($primary_id)."&idlon=".$row_map1."&idlat=".$row_map2."&id=".$primary_id."&table=".$nama_table ."'  target='_blank'>".$query_field."</a>";
                            
                        }else{
                            echo "-";
                        }
                    }else{
                        if(strlen($query_child) && strlen($query_field)){
                            $qchild_all = $query_child. " where $nama_table.".$primary_id . "=" . $admin->row($primary_id);
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
   
  
                    
        </tr>

      <?
      $no++;
      $divno++;
      }?>
    <?}else{?>
        <tr><td align="center" style="color:red" colspan="<?=1 + listLen($record_show,"~")?>">DATA TIDAK DITEMUKAN</td></tr>
    <?}?>


                    
                    </tbody>
                 </table>
                </div> 
                </div>
              </div>
           </div> 
           
            
           <!-- END EXAMPLE TABLE PORTLET-->
        </div>
        
    <!-- Paging-->
    <div align="center" class="hidden-print"><BR>
    <button type="button" class="btn blue hidden-print" onclick="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?>&paging=1&ref=<?=md5(date("mdyHis"))?>';">&lt;&lt; Awal </button>
    <button type="button" class="btn blue hidden-print" onclick="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?>&paging=<?=$paging-1?>&ref=<?=md5(date("mdyHis"))?>';">&lt; Sebelumnya</button>&nbsp;&nbsp; 
    <button type="button" class="btn blue hidden-print" onclick="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?>&paging=<?=$paging+1?>&ref=<?=md5(date("mdyHis"))?>';">Berikutnya &gt; </button>
    <button type="button" class="btn blue hidden-print" onclick="location='<?=$_SERVER["SCRIPT_NAME"]?>?<?=$_SERVER["QUERY_STRING"]?>&paging=<?=$no_page?>&ref=<?=md5(date("mdyHis"))?>';">Akhir &gt;&gt;</button>
    
    <br><br><B>Halaman :  <font color="red"><?=number_format($paging,0)?></font> dari Total Halaman : <B><font color="blue"><?=number_format($no_page,0)?></font></B> | Total Data : <B><?=number_format($no_record,0)?></B> Record(s)
    
    </div>
<?//}?>

 


<?}?>

