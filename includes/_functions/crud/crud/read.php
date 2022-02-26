<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block"><?=$nama_List?></h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; <?=$form_map?></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
    <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <!-- <div class="card-header"> -->
                    <!-- <h5>Zero Configuration</h5><span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:</span> -->
                  <!-- </div> -->
                  <div class="card-body">
                    <?
                    $add = false;
                    if(_checkauth("New") || uriParam('tmp') == encryptStringArray('templates/ref_user/index.php') || uriParam('tmp') == encryptStringArray('templates/ref_usergroup/index.php') ){
                      $add = true;
                    }
                    if($add){
                    ?>

                      <a class="btn btn-success btn-sm mb-3" href="?tmp=<?=uriParam('tmp')?>&new_form=yes&ref=<?=md5(date('mdYHis'))?>" data-original-title="" title=""><span class="fa fa-plus"></span> Add New</a>
                    <?}?>

                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <?for($field=1;$field<=listLen($record_show,"~");$field++){
                              $row_detail = listGetAt($record_show,$field,"~");
                              $row_field = listGetAt($row_detail,1,"|");
                              $row_aliasName = listGetAt($row_detail,2,"|");
                              $row_align = listGetAt($row_detail,3,"|");

                              switch ($row_align){
                                case "left": $algn = "left";break;
                                case "right": $algn = "right";break;
                                case "center": $algn = "center";break;
                              }
                              ?>
                                <th><div align="<?=$algn?>"><?=$row_aliasName?></div></th>
                            <?}?>

                            <!-- FOR PROJECT BUMIYASA -->
                            <?if(uriParam("tmp") == encryptStringArray('templates/logsheet/index.php')){?>
                              <th><div align="center">Form Unit</div></th>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_lkpb/index.php')){?>
                              <th><div align="center">Form</div></th>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_purchase_request/index.php')){?>
                              <th><div align="center">Form</div></th>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_request_for_quotation/index.php')){?>
                              <th><div align="center">Form</div></th>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_purchase_order/index.php')){?>
                              <th><div align="center">Form</div></th>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_payment_request/index.php')){?>
                              <th><div align="center">Form</div></th>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_perjalanan_dinas/index.php')){?>
                              <th><div align="center">Form</div></th>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_permohonan_dana/index.php')){?>
                              <th><div align="center">Form</div></th>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_lpj/index.php')){?>
                              <th><div align="center">Form</div></th>
                            <?}?>

                          </tr>
                        </thead>
                        <tbody>
                          <?
                          $show_all = cmsDB();
                          $show_detail = cmsDB();

                          $no=0;
                          if(strlen($main_query)){
                            $strsql = $main_query;
                          }else{
                            $strsql = "select * from ".$nama_table." where is_deleted=0 ";
                          }
                          $strsql = $strsql . " order by update_date desc";
                          $show_all->query($strsql);
                          while ($show_all->next()) {
                            $no++;
                          ?>
                          <tr>
                            <td><?=$no?></td>
                            <?for($field=1;$field<=listLen($record_show,"~");$field++){
                              $row_detail     = listGetAt($record_show,$field,"~");
                              $row_field      = listGetAt($row_detail,1,"|");
                              $row_aliasName  = listGetAt($row_detail,2,"|");
                              $row_align      = listGetAt($row_detail,3,"|");
                              $link_on        = listGetAt($row_detail,5,"|");
                              $sub_query      = listGetAt($row_detail,6,"|");

                              switch ($row_align){
                                case "left": $algn = "left";break;
                                case "right": $algn = "right";break;
                                case "center": $algn = "center";break;
                              }

                              ?>
                                <td>
                                  <div align="<?=$algn?>">
                                  <?
                                  if($link_on=="link_on"){
                                    $url_view = "?tmp=".uriParam("tmp")."&edit=yes&".$primary_id."=".encryptStringArray($show_all->row($primary_id))."&ref=".md5(date("mdyHis"));
                                    echo "<a href='".$url_view."'>".$show_all->row($row_field)."</a>";  

                                  }else{
                                    if($sub_query=="image"){
                                      if(strlen($show_all->row($row_field))){
                                        echo "<a href='". $ANOM_VARS["www_file_url"] ."upload_photo/". $show_all->row($row_field)  ."' target='_blank'>
                                          <img style='max-height:50px;' src='". $ANOM_VARS["www_file_url"] ."upload_photo/". $show_all->row($row_field)  ."'  />
                                           </a>";
                                      }else{
                                        echo "-";
                                      }
                                    }elseif($sub_query=="files"){
                                      if(strlen($show_all->row($row_field))){
                                        echo "<a href='". $ANOM_VARS["www_file_url"] ."upload_files/". $show_all->row($row_field)  ."' target='_blank'><i class='fa fa-file-zip-o fa-2x'></i>
                                           </a>";
                                      }else{
                                        echo "-";
                                      }
                                    }elseif ($sub_query=='status') {
                                      // echo substr($row_field, 0, -4);
                                      $show_detail->query("select status_color from ref_status where status_id=". $show_all->row(substr($row_field, 0, -4)) );
                                      $show_detail->next();
                                      echo "<span class='badge ".$show_detail->row('status_color')."'>".$show_all->row($row_field)."</span>";
                                    }elseif($sub_query=="date"){
                                      echo datesql2date($show_all->row($row_field));
                                    }elseif($sub_query=="datetime"){
                                      echo datesql2datetime($show_all->row($row_field));
                                    }elseif($sub_query=="hourminute"){
                                      echo sqlToTimePhp($show_all->row($row_field));
                                    }else{
                                      echo $show_all->row($row_field);
                                    }
                                  }?>

                                  </div>
                                </td>
                            <?}?>

                            <!-- FOR PROJECT BUMIYASA -->
                            <?if(uriParam("tmp") == encryptStringArray('templates/logsheet/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/logsheet/preview.php')?>&group_location_id=<?=encryptStringArray($show_all->row('group_location_id'))?>&unit_id=<?=encryptStringArray($show_all->row('unit_id'))?>&date=<?=encryptStringArray($show_all->row('date'))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_lkpb/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_lkpb/preview.php')?>&lkpb_id=<?=encryptStringArray($show_all->row($primary_id))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_purchase_request/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_purchase_request/preview.php')?>&purchase_request_id=<?=encryptStringArray($show_all->row($primary_id))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_request_for_quotation/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_request_for_quotation/preview.php')?>&request_for_quotation_id=<?=encryptStringArray($show_all->row($primary_id))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_purchase_order/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_purchase_order/preview.php')?>&purchase_order_id=<?=encryptStringArray($show_all->row($primary_id))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_payment_request/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_payment_request/preview.php')?>&payment_request_id=<?=encryptStringArray($show_all->row($primary_id))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_perjalanan_dinas/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_perjalanan_dinas/preview.php')?>&ppd_id=<?=encryptStringArray($show_all->row($primary_id))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_permohonan_dana/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_permohonan_dana/preview.php')?>&pd_id=<?=encryptStringArray($show_all->row($primary_id))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                            <?if(uriParam("tmp") == encryptStringArray('templates/ref_lpj/index.php')){?>
                              <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_lpj/preview.php')?>&lpj_id=<?=encryptStringArray($show_all->row($primary_id))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                              </td>
                            <?}?>

                          </tr>

                          <?  
                          }
                          ?>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
             </div>
              <!-- Zero Configuration  Ends-->
