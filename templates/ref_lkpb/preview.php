<?
$show         = cmsDB();
$show_site    = cmsDB();
$master_lkpb  = cmsDB();
$head         = cmsDB();
$send         = cmsDB();
$auto         = cmsDB();
$group        = cmsDB();

// Master Data
$qry_lkpb = "select * from master_lkpb where is_deleted=0";
$master_lkpb->query($qry_lkpb);

$user_id = $_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
$id = decryptStringArray(uriParam("lkpb_id"));

$query = "select * from ref_lkpb where lkpb_id=".$id;
$show->query($query);
$show->next();

$qry = "select * from master_group_location where group_location_id=".$show->row("group_location_id");
$show_site->query($qry);
$show_site->next();

// $qry_group = "select parent_id from ref_group where"e
$group_ = getParentGroupFromInsertBy($show->row('insert_by'));

$head_qry = "select user_id, full_name, ttd from ref_user where user_id=".$show->row('insert_by');
$head->query($head_qry);
$head->next();
$created_user_id   = $head->row('user_id');
$created_user_name = $head->row('full_name');
$created_ttd = $head->row('ttd');

$head_qry = "select user_id, full_name, ttd from ref_user where is_deleted=0 and group_id=".$group_." and group_location_id=".$show->row("group_location_id");
$head->query($head_qry);
$head->next();
$superior_id   = $head->row('user_id');
$superior_name = $head->row('full_name');
$superior_ttd  = $head->row('ttd');

$itself = true;

$btn_send     = false; //status 0 ke 2
$btn_revise   = false; //status 2 ke 3 
$btn_reject   = false; //status 2 ke 4
$btn_approve  = false; //status 2 ke 100
$btn_close    = false;

if($show->row("status_id") == 0 && $show->row('insert_by') == $sesi_user_id){
  $btn_send    = true;
}elseif($show->row("status_id") == 2 && $superior_id == $sesi_user_id){
  $btn_approve = true;
  $btn_revise  = true;
  $btn_reject  = true;
}elseif($show->row("status_id") == 3 && $show->row('insert_by') == $sesi_user_id){
  $btn_send    = true;
// }elseif($show->row("status_id") == 3 && $show->row('insert_by') == $sesi_user_id){

}

// if($show_site->row('position') == 'HO'){
//   // $qry2 = "select * from "
// }else{
//   $head->query("select user_id, full_name, superior_id from ref_user where user_id=".$show->row('insert_by'));
//   $head->next();
//   $superior_id   = $head->row('superior_id');
//   $superior_name = $head->row('full_name');
//   if($superior_id <> 0){
//     $itself = false;
//     $head->query("select user_id, full_name from ref_user where user_id=".$superior_id);
//     $head->next();
//     $superior_name = $head->row('full_name');
//   }
// }

if(isset($_GET['action'])){
    if(($_GET['action']==2 || $_GET['action']==100) && $show->row('status_id') == 0){
        number_lkpb($id);
    }
    _process_status($_GET['action'], 'lkpb', $id, postParamSimple("note"), postParamSimple("from_user_id"), postParamSimple("to_user_id"));

    // OUTSTANDING
    // insert_outstanding(
    //   'lkpb', 
    //   $show->row('lkpb_no'), 
    //   $_GET['action'], 
    //   encryptStringArray('templates/ref_lkpb/preview.php').'&lkpb_id='.encryptStringArray($id), 
    //   $created_user_id, 
    //   $superior_id
    // );

    echo "<script>location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&lkpb_id=".uriParam('lkpb_id')."';</script>";
    die();
}

?>


<?if($show->row("status_id") <> 0){ //status selain draft
  $log = cmsDB();

  $log_query = "select ref_status_log.*, status_name, status_name_alias, color, icon from ref_status_log inner join ref_status on (ref_status.status_id=ref_status_log.status_id) where ref_status_log.form='lkpb' and form_id=".$id." order by status_log_id";

  $log->query($log_query);

  ?>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form LKPB</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / HSE / LKPB / Preview</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div style="display:inline-block;width:100%;overflow-y:auto;">
        <ul class="timeline timeline-horizontal">
          <?while ($log->next()) {?>
            <li class="timeline-item">
              <div class="timeline-badge <?=$log->row('color')?>"><i class="fa <?=$log->row("icon")?>"></i></div>
              <div class="timeline-panel shadow-box">
                <div class="timeline-heading">
                  <h5 class="timeline-title"><?=$log->row('status_name_alias')?></h5>
                  <p class="text-muted font-size-12px"><i class="glyphicon glyphicon-time"></i> <?=datesql2datetime($log->row('insert_date'))?> | <i class="glyphicon glyphicon-user"></i> <?=_get_user_name($log->row('insert_by'))?></p>
                </div>
                <div class="timeline-body">
                  <p>Note: <?if($log->row('notes')<>''){echo $log->row('notes');}else{echo "-";}?></p>
                </div>
              </div>
            </li>
          <?}?>
        </ul>
      </div>
    </div>
  </div>
</div>

  <br>

  <?}?>


<div style="overflow-x: auto;">
    <div class="A4" id="printArea">
        <section class="sheet padding-10mm">
            <table class="w-100">
                <tr>
                    <td>
                        <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>" style="width:150px;">
                    </td>
                    <td class="pl-3">
                        <h3><b><?=$show_site->row("group_name")?></b></h3>
                        <p><?=$show_site->row("group_address")?></p>
                    </td>
                </tr>
            </table>
            
            <table class="w-100 mb-1">
                <tr>
                    <td><p class="text-center" style="font-size: 18px;margin-bottom: 0px;"><b><u>Laporan Kejadian Potensi Bahaya</u></b></p></td>
                </tr>
            </table>
            <table class="w-100 mb-3" width="100%">
                <tr>
                    <td width="50%">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left">Nomor</td>
                                <td align="left">:</td>
                                <td align="left">
                                  <? echo strlen($show->row('lkpb_no')) ? $show->row('lkpb_no') : "<i style='color:red';>need to submit</i>";?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">Tanggal</td>
                                <td align="left" width="10">:</td>
                                <td align="left"><? echo strlen($show->row('lkpb_no')) ? datesql2date($show->row("date")) : "<i style='color:red';>need to submit</i>";?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">Dept / Lokasi</td>
                                <td align="left">:</td>
                                <td align="left"><?=$show_site->row("group_name_alias")?></td>
                            </tr>
                            <tr>
                                <td align="left">Jam Terjadi</td>
                                <td align="left">:</td>
                                <td align="left"><?=hourMinute($show->row("hour"))?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <?php
                                while ($master_lkpb->next()) { ?>
                                <tr>
                                    <td align="center">
                                        <table>
                                            <tr>
                                                <td>
                                                    <?if(ListFind($show->row("master_lkpb_id"), $master_lkpb->row("master_lkpb_id"))){
                                                        echo '<i class="fa fa-check-square-o"></i>';
                                                    }else{
                                                        echo '<i class="fa fa-square-o"></i>' ;
                                                    }?>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                            
                                    </td>
                                    <td align="left" ><i><?=$master_lkpb->row("name")?></i></td>
                                </tr>
                            <? } ?>
                        </table>
                    </td>
                </tr>
            </table>

            <table class="w-100 mb-3 border-table" border="1">
                <tr>
                    <td width="80%" style="vertical-align : top;text-align:left;padding:5px 10px;">
                        <p><b>Uraian terjadinya potensi bahaya dan atau insiden</b></p>
                        <div style="min-height:120px">
                        <!-- Data Uraian -->
                        <?=$show->row("uraian")?>
                        </div>
                    </td>
                    <td width="20%" style="position:relative;">
                        <p class="text-center"><b>Kepala unit</b></p>
                        <div style="min-height: 120px;">
                          <? if ($show->row('status_id') == 4){ ?>
                            <p class="text-center" style="position: absolute;top:35%;color: red;left: 0;right: 0;"><b>REJECTED</b></p>
                            <?
                            if($group_ == 0){?>
                            <p class="text-center" style="position: absolute;bottom: 2px;left: 0;right: 0;"><?=$created_user_name?></p>

                              <?}else{?>
                            <p class="text-center" style="position: absolute;bottom: 2px;left: 0;right: 0;"><?=$superior_name?></p>

                            <?}
                          }else if($show->row('status_id') >= 100){
                              if($group_ == 0){?>
                                <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$created_ttd?>" />
                            <p class="text-center" style="bottom: 2px;left: 0;right: 0;"><?=$created_user_name?></p>
                              <?}else{?>
                                <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$superior_ttd?>" />
                            <p class="text-center" style="bottom: 2px;left: 0;right: 0;"><?=$superior_name?></p>

                            <?}
                          } ?>
                        </div>
                    </td>
                </tr>

            </table>
            <table class="w-100">
              <tr>
                  <td>
                      <p class="text-center"><b>POTENSI BAHAYA/NEAR MISS INVESTIGATION (dilakukan oleh atasan terkait)</b></p>
                  </td>
              </tr>

            <table class="w-100 mb-3">
               <tr>
                   <td style="vertical-align: top;" width="18%">Akar Masalah</td>
                   <td style="vertical-align: top;" width="2%">:</td>
                   <td width="70%"><?=$show->row("akar_masalah")?></td>
               </tr>
               <tr>
                   <td style="vertical-align: top;">Tindakan Sementara</td>
                   <td style="vertical-align: top;">:</td>
                   <td><?=$show->row("tindakan_sementara")?></td>
               </tr>
               <tr>
                   <td style="vertical-align: top;">Tanggal Penerapan</td>
                   <td style="vertical-align: top;">:</td>
                   <td><?=datesql2date($show->row("tanggal_penerapan"))?></td>
               </tr>
            </table>

            <table class="w-100 border-table">
              <tr>
                <td style="vertical-align : top;text-align:left;padding:5px 10px;">
                  <p><b>Documentation</b></p>
                  <div style="text-align: center;">
                    <!-- File Document -->
                    <?if(strlen($show->row('documentation1')) > 5){?>
                      <a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation1')?>" target="blank_">  
                        <img style="width: 300px" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation1')?>" >
                      </a>
                    <?}?>

                    <?if(strlen($show->row('documentation2')) > 5){?>
                      <a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation2')?>" target="blank_">  
                        <img style="width: 300px" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation2')?>" >
                      </a>
                    <?}?>
                    <div style="margin-top: -17px;width: 100%">&nbsp;</div>

                    <?if(strlen($show->row('documentation3')) > 5){?>
                      <a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation3')?>" target="blank_">  
                        <img style="width: 300px" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation3')?>" >
                      </a>
                    <?}?>

                    <?if(strlen($show->row('documentation4')) > 5){?>
                      <a href="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation4')?>" target="blank_">  
                        <img style="width: 300px" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation4')?>" >
                      </a>
                    <?}?>
                  </div>
                </td>
              </tr>
            </table>                
        </section>
    </div>


    <div class="form-group" align="center">
      
      <?if($btn_send && $group_ <> 0){?>
        <a class="btn btn-primary" data-toggle="modal" href="#btn-2"><i class="fa fa-send"></i> Submit</a>
        <div id="btn-2" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <?approval_lkpb('lkpb_id', 2, 'Submit LKPB', $created_user_id, $superior_id, $superior_name);?>
        </div>
      <?}?>

      <?if($btn_revise){?>
        <a class="btn btn-warning" data-toggle="modal" href="#btn-3"><i class="fa fa-reply"></i> Revise</a>
        <div id="btn-3" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <?approval_lkpb('lkpb_id', 3, 'Revise LKPB', $superior_id, $created_user_id, $created_user_name);?>
        </div>
      <?}?>

      <?if($btn_reject){?>
        <a class="btn btn-danger" data-toggle="modal" href="#btn-4"><i class="fa fa-times"></i> Reject</a>
        <div id="btn-4" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <?approval_lkpb('lkpb_id', 4, 'Reject LKPB', $superior_id, $created_user_id, $created_user_name);?>
        </div>

      <?}?>

      <?if($btn_approve && $group_ <> 0){?>
        <a class="btn btn-primary" data-toggle="modal" href="#btn-100"><i class="fa fa-check"></i> Approve</a>
        <div id="btn-100" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <?approval_lkpb('lkpb_id', 100, 'Approve LKPB', $superior_id);?>
        </div>
      <?}else if($group_ == 0 && $show->row("status_id") <> 100 && $show->row("status_id") <> 101){?> 
        <!-- ATASAN LANGSUNG YANG MEMBUAT DAN MENGAPPROVE MEMBUAT -->
        <a class="btn btn-primary" data-toggle="modal" href="#btn-100"><i class="fa fa-check"></i> Submit</a>
        <div id="btn-100" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <?approval_lkpb('lkpb_id', 100, 'Approve LKPB', $created_user_id);?>
        </div>
      <?}?>

      <?if($show->row('status_id') == 100){?>
        <form style="display: inline-block;" method="post" action="<?=$base_www?>/includes/pdf.php?print=yes&lkpb_id=<?=encryptStringArray($id)?>" role="form" enctype="multipart/form-data">
          <input type="hidden" name="header" value="<?=$show_site->row('group_name')?>">
          <input type="hidden" name="logo" value="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>">
          <input type="hidden" name="sub_header" value="<?=$show_site->row('group_address')?>">
          <input type="hidden" name="html" value="templates/ref_lkpb/preview-print.php">
          <input type="hidden" name="footer_name" value="RCD-HSE-28">
          <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
        </form>
      <?}?>

      <?if($show->row('status_id') == 100){?>
        <a class="btn btn-light" data-toggle="modal" href="#btn-101"><i class="fa fa-lock"></i> Close Document</a>
        <div id="btn-101" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <?approval_lkpb('lkpb_id', 101, 'Closed LKPB', 5);?>
        </div>
      <?}?>

      <button type="button" class="btn btn-light" onclick="history.back()">Back</button>
    </div>
