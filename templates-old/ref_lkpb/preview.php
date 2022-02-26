<?
$show         = cmsDB();
$show_site    = cmsDB();
$master_lkpb  = cmsDB();
$head         = cmsDB();
$send         = cmsDB();
$auto         = cmsDB();

$user_id = $_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
$id = decryptStringArray(uriParam("lkpb_id"));

$qry_lkpb = "select * from master_lkpb where is_deleted=0";
$master_lkpb->query($qry_lkpb);

$query = "select * from ref_lkpb where lkpb_id=".$id;
$show->query($query);
$show->next();

$qry = "select * from master_group_location where group_location_id=".$show->row("group_location_id");
$show_site->query($qry);
$show_site->next();

$itself = true;
if($show_site->row('position') == 'HO'){
  // $qry2 = "select * from "

}else{
  $head->query("select user_id, full_name, superior_id from ref_user where user_id=".$show->row('insert_by'));
  $head->next();
  $superior_id   = $head->row('superior_id');
  $superior_name = $head->row('full_name');

  if($superior_id <> 0){
    $itself = false;
    $head->query("select user_id, full_name from ref_user where user_id=".$superior_id);
    $head->next();
    $superior_name = $head->row('full_name');
  }
}


if(isset($_GET['action'])){
  // if($_GET['action'] == 1){
    if($_GET['action']==2 && $show->row('status_id') == 0){
        number_lkpb($id);
    }

    // _process_status($_GET['action'], 'lkpb', $id, postParamSimple("note"));
    if(in_array($show->row('status_id'), [0,3,4])){
      _process_status($_GET['action'], 'lkpb', $id, postParamSimple("note"), $user_id, $superior_id);
    }

    if(in_array($show->row('status_id'), [2])){
      // echo $show->row('insert_by'); die();
      _process_status($_GET['action'], 'lkpb', $id, postParamSimple("note"), $user_id, $show->row('insert_by'));
    }

  // }else{
    // _process_status($_GET['action'], 'lkpb', $id, postParamSimple("note"));

  // }

  echo "<script>location='".$_SERVER["SCRIPT_NAME"]."?tmp=".uriParam("tmp")."&lkpb_id=".uriParam('lkpb_id')."';</script>";
  die();
}
?>

<?if($show->row("status_id") <> 0){ //status selain draft?>
  <?
  $log = cmsDB();
  $log_query = "select ref_status_log.*, status_name, status_name_alias, color, icon from ref_status_log inner join ref_status on (ref_status.status_id=ref_status_log.status_id) where ref_status_log.form='lkpb' and form_id=".$id." order by status_log_id";
  $log->query($log_query);
  ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div style="display:inline-block;width:100%;overflow-y:auto;">
        <ul class="timeline timeline-horizontal">
          <?while ($log->next()) {?>
            <li class="timeline-item">
              <div class="timeline-badge <?=$log->row('color')?>"><i class="<?=$log->row("icon")?>"></i></div>
              <div class="timeline-panel shadow-box">
                <div class="timeline-heading">
                  <h4 class="timeline-title"><?=$log->row('status_name_alias')?></h4>
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
  
  <br>
  <?}?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3" style="border: 1px dotted #000;"> 
      <div class="row">
        
        <div class="col-md-3">
          <img src="<?=$ANOM_VARS["www_file_url"]?>upload_files/<?=$show_site->row('image')?>">
        </div>
        <div class="col-md-9">
          <h3><b><?=$show_site->row("group_name")?></b></h3>
          <?=$show_site->row("group_address")?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" >
          <h3 class="text-center"><b><u>Laporan Kejadian Potensi Bahaya</u></b></h3>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-6">
          <table style="font-size: 12px;">
            <tr>
              <td>Nomor</td>
              <td>:</td>
              <td><?=$show->row("lkpb_no")?></td>
            </tr>
            <tr>
              <td>Tanggal</td>
              <td>:</td>
              <td><?=datesql2date($show->row("date"))?></td>
            </tr>
            <tr>
              <td>Dept / Lokasi</td>
              <td>:</td>
              <td><?=$show_site->row("group_name_alias")?></td>
            </tr>
            <tr>
              <td>Jam Terjadi</td>
              <td>:</td>
              <td><?=hourMinute($show->row("hour"))?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <table style="font-size: 12px;">
            
            <?php
            while ($master_lkpb->next()) { ?>
            <tr>
              <td>
                <?if(ListFind($show->row("master_lkpb_id"), $master_lkpb->row("master_lkpb_id"))){
                echo '<i class="icon-check"></i>';
                }else{
                echo '<i class="icon-check-empty"></i>';
                }?>
              </td>
              <td>&nbsp;&nbsp;</td>
              <td><i><?=$master_lkpb->row("name")?></i></td>
            </tr>
            <? } ?>
          </table>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="row" style="border: 1px solid #000;">
            <div class="col-md-9"  style="border-right: 1px solid #000; min-height: 100px !important;">
              <p><b>Uraian terjadinya potensi bahaya dan atau insiden</b></p>
              <?=$show->row("uraian")?>
            </div>
            <div class="col-md-3" style="min-height: 100px !important;">
              <p class="text-center"><b>Kepala unit</b></p>
              <? if ($show->row('status_id') == 1){ ?>
                <p class="text-center" style="position: absolute;top:35%;color: red;left: 0;right: 0;"><b>APPROVED</b></p>
              <? }else if($show->row('status_id') == 4){?>
                <p class="text-center" style="position: absolute;top:35%;color: red;left: 0;right: 0;"><b>REJECTED</b></p>
              <? } ?>
              <p class="text-center" style="position: absolute;bottom: 2px;left: 0;right: 0;"><?=$superior_name?></p>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <p class="text-center"><b>POTENSI BAHAYA/NEAR MISS INVESTIGATION (dilakukan oleh atasan terkait)</b></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="min-height: 30px;">
          Akar Masalah &nbsp;&nbsp;: &nbsp; <?=$show->row("akar_masalah")?>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12" style="min-height: 30px;">
          Tindakan Sementara &nbsp;&nbsp;: &nbsp; <?=$show->row("tindakan_sementara")?>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          Tanggal Penerapan &nbsp;&nbsp;: &nbsp; <?=datesql2date($show->row("tanggal_penerapan"))?>
        </div>
      </div>
      <br>
      <div class="row" style="border: 1px solid #000; min-height: 100px;">
        <div class="col-md-12">
          <p><b>Documentation</b></p>
          <?if(strlen($show->row('documentation1')) > 5){?>
          <img style="max-width: 100%;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation1')?>">
          <?}?>
          
          <?if(strlen($show->row('documentation2')) > 5){?>
          <img style="max-width: 100%;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation2')?>">
          <?}?>
          
          <?if(strlen($show->row('documentation3')) > 5){?>
          <img style="max-width: 100%;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation3')?>">
          <?}?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-actions fluid">
      <div class="form-group" align="center">
        <?if(($show->row('status_id') == 0 || $show->row('status_id') == 3) && $show->row('insert_by') == $user_id && $itself==false){?>
          <a class="btn blue" data-toggle="modal" href="#2">Send</a>
        <?}?>

        <?if($show->row('status_id') == 0 && $show->row('insert_by') == $user_id && $itself == true){?>
          <a class="btn blue" data-toggle="modal" href="#1">Approved</a>
        <?}else if($show->row('status_id') == 2 && $superior_id == $user_id){?>
          <a class="btn blue" data-toggle="modal" href="#1">Approved</a>
        <?}?>
    
        <?if($show->row('status_id') == 2 && $superior_id == $user_id){?>
          <a class="btn yellow" data-toggle="modal" href="#3">Revise</a>
          <a class="btn red" data-toggle="modal" href="#4">Reject</a>
        <?}?>
        
        <button type="button" class="btn default" onclick="history.back()">Back</button>
      </div>
    </div>
  </div>
  </div>
</div>

<div class="modal fade" id="1" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
  <?approval_lkpb('lkpb_id', 1, 'Send LKPB', $superior_name);?>
</div>

<div class="modal fade" id="2" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
  <?approval_lkpb('lkpb_id', 2, 'Send LKPB', $superior_name);?>
</div>

<div class="modal fade" id="3" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
  <?approval_lkpb('lkpb_id', 3, 'Send LKPB', $superior_name);?>
</div>

<div class="modal fade" id="4" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
  <?approval_lkpb('lkpb_id', 4, 'Send LKPB', $superior_name);?>
</div>