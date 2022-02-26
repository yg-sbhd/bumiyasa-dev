<?
function insert_outstanding($form_txt, $letter_no, $status_id, $tmp, $from_user, $to_user){
  global $_SESSION,$CMS_VARS,$_GET,$_POST;
  $qry = cmsDB();

  $query = "insert into ref_user_outstanding (form, letter_no, status_id, tmp, from_user, to_user, insert_by, insert_date) values ('".$form_txt."', '".$letter_no."', '".$status_id."', '".$tmp."', '".$from_user."', '".$to_user."', '".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")]."', '".date("Y-m-d")."')";
  $qry->query($query);
  return;
}

function getParentGroupFromInsertBy($insert_by){
  global $_POST,$_GET,$_SESSION;
  $qry = cmsDB();
  $qry_usr = "select group_id from ref_user where user_id=".$insert_by;
  $qry->query($qry_usr);
  $qry->next();
  $get_group = $qry->row('group_id');
  $qry_group = "select parent_id from ref_group where group_id=".$get_group;
  $qry->query($qry_group);
  if ($qry->recordCount()) {
    $qry->next();
    return $qry->row('parent_id');
  }else{
    return 0;
  }
}
  
function approval_lkpb($link, $action, $form_name, $from_user_id=0, $to_id=0, $to_txt=null){?>
	<form action="?tmp=<?=uriParam("tmp")?>&<?=$link?>=<?=uriParam($link)?>&action=<?=$action?>" method="post" name="updateform" enctype="multipart/form-data" id="updateform" class="form-horizontal">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title"><?=$form_name?></h4>
             <button type="button" class= "close" data-dismiss="modal" aria-hidden="true"></button>
          </div>

          <div class="modal-body">
            <?php if ($to_txt <> null): ?>
              <div class="form-group">
                  <label class="col-md-12 control-label text-left">To:</label>
                  <div class="col-md-12">
                    <input type="text" class="form-control w-100" disabled value="<?=$to_txt?>">
                  </div>
               </div>
            <?php endif ?>

             <div class="form-group">
                <label class="col-md-12 control-label text-left">Message:</label>
                <div class="col-md-12">
                  <textarea name="note" class="form-control"></textarea>
                </div>
             </div>
          </div>

          <div class="modal-footer">
             <input type="text" name="to_user_id" value="<?=$to_id?>">
             <input type="text" name="from_user_id" value="<?=$from_user_id?>">
             <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
             <button type="Submit" class="btn btn-success">Submit</button>
          </div>
       </div>
    </div>
  </form>
<?}

function _process_status($status, $form, $id, $notes, $from, $to){
	global $_POST,$_GET;
	$send = cmsDB();
  $send->query("select status_name from ref_status where status_id=".$status);
  $send->next();
  $status_name = $send->row('status_name');
	$qry = "insert into ref_status_log 
		(status_id, form, form_id, notes, dari, untuk, insert_date, insert_by) 
		values 
		(".$status.", '$form', $id, '$notes', $from, $to, '".date("Y-m-d H:i:s")."', ".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")].")";
  	$send->query($qry);
  	$send->query("update ref_lkpb set status_id=$status, status_id_txt='".$status_name."' where lkpb_id=".$id);	

}

function edit_filter($tmp, $status_id, $insert_by){

	$user_id 			= $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")];

	$group_id 			= $_SESSION["group_id_".$ANOM_VARS["app_session_code"]  . date("mdY")];

	$group_location_id 	= $_SESSION["group_location_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];

	$access = false;

	if(decryptStringArray($tmp) == "templates/ref_lkpb/index.php"){

		if($group_id == 3){

			$access = true;

		}else{

			if(($status_id == 0 || $status_id == 3) && $insert_by == $user_id){

				$access = true;

			}

			

		}



	}



	return $access;

}



function _get_status_name($id){

	global $_POST,$_GET;

	$show = cmsDB();

	$show->query("select status_name, status_name_alias, status_color from ref_status where status_id=".$id);

	$show->next();

	return "<span class='label label-sm ".$show->row('status_color')."'>".$show->row('status_name')."</span>";

}

function edit_production_kwh($group_location_id, $kwh, $date, $start_time, $end_time){
  global $_POST,$_GET;

  $show = cmsDB();
  $today = strtotime($date .' 10:00 AM');
  $tomorrow = strtotime($date .' +1 day 09:59 AM');

  $qry  = "select * from ref_logsheet_production where group_location_id='".$group_location_id."' and date='".$date."' and is_deleted=0";
  // echo " show = " . $qry;
  $show->query($qry);
  
  if($show->recordCount()){
    $query = "update ref_logsheet_production set kwh='$kwh', start_time='".$start_time."', end_time='".$end_time."',update_date='".date("Y-m-d H:i:s")."', update_by='".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")]."' where group_location_id='".$group_location_id."' and date='".$date."' and is_deleted=0";
  }else{
    $query = "insert into ref_logsheet_production (group_location_id, date, kwh, start_time, end_time, insert_date, insert_by, update_date, update_by) values ('".$group_location_id."','".$date."','".$kwh."', '".$start_time."', '".$end_time."','".date("Y-m-d H:i:s")."','".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")]."','".date("Y-m-d H:i:s")."','".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")]."')"; 
  }
  // echo $query;
  $show->query($query);
  // die();
  return;
}

function _add_production($act, $group_location_id, $date){
  global $_POST,$_GET,$_SESSION;
  
  $today = strtotime($date .' 10:00 AM');
  $tomorrow = strtotime($date .' +1 day 09:59 AM');
  $realtime = strtotime($date . '10:01 AM');


  $production = cmsDB();
  // $qry_production = "select kwh, date from ref_logsheet_production where group_location_id='".$group_location_id."' and date='".date('Y-m-d')." and is_deleted=0'";
  $qry_production = "select kwh, date, start_time, end_time from ref_logsheet_production where is_deleted=0 and date='".$date."' and group_location_id='".$group_location_id."' and (start_time <= ".$realtime." and end_time >= ".$realtime.") ";
  // echo $qry_production;
   $production->query($qry_production);
   if($production->recordCount()){
      $production->next();
      $action_update = true;
      $total_kwh = $production->row('kwh');
      $start_time = $production->row('start_time');
      $end_time = $production->row('end_time');
      $date_production = $production->row('date');
   }else{
    $action_update = false;
     $total_kwh = '0.00';
     $start_time = $today;
     $end_time = $tomorrow;
     $date_production = $date;
   }

   $update_prod = false;
   if($_SESSION["group_id_".$ANOM_VARS["app_session_code"]  . date("mdY")] == 3 ){
     if(isset($_GET['new_form']) && $_GET['new_form'] == 'yes'){
        $update_prod = false;
     }else{
        $update_prod = true;
     }
   }else{
     if($action_update){
        $update_prod = false;
     }else{
        $update_prod = true;
     }
   }
?>


<div class="card-header">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group row text-left text-md-right">
        <label  class="col-md-4 col-form-label">
          Total Production
        </label>
        <div class="col-md-8 input-group" align="left">
          <input class="form-control" type="text" placeholder="0.00" value="<?=$total_kwh?>" disabled>
          <div class="input-group-append">
            <span class="input-group-text">Kwh</span> 
              <?if($update_prod){?>
              &nbsp;
              <a class="btn btn-success" data-toggle="modal" href="#responsive"><i class="icon-pencil"></i> Update</a>
              <?}?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="responsive" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <form action="index-template.php?tmp=<?=uriParam('tmp')?>&group_location_id=<?=uriParam('group_location_id')?>&unit_id=<?=uriParam('unit_id')?>&date=<?=uriParam('date')?>&add_production=yes" method="POST"> -->
      <?if($act == 'edit'){?>
        <form action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&updateform=yes&update_total_production=yes&refresh=<?=md5("mdYHis")?>" method="POST">
          <input type="hidden" name="group_location_id" value="<?=$group_location_id?>">
      <?}else{?>
        <form action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&new_form=yes&insert_total_production=yes&refresh=<?=md5("mdYHis")?>" method="POST">

      <?}?>
        <input type="hidden" name="date_production" value="<?=$date_production?>">
        <input type="hidden" name="start_time" value="<?=$start_time?>">
        <input type="hidden" name="end_time" value="<?=$end_time?>">

        <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Input Total KWH</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <p>Total KWH</p>
              <input type="text" name="production" class="col-md-12 form-control" value="<?=$total_kwh?>">
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-light">Close</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
        
      </form>
    </div>
  </div>
</div>
<?

}

?>