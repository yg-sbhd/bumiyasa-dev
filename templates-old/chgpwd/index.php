<?
$pwd=cmsDB(); 
$user_id = $_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
if(isset($_GET["edit"])){
	/*echo "select * from ref_user where user_id=".$_SESSION["user_id" . date("mdY")]." and pwd=password('".postParamSimple("old_pwd")."')";
	echo "<BR>".postParamSimple("new_pwd") ." | ".postParamSimple("old_pwd") ." | ". postParamSimple("new_pwd2");
	die();*/
	if(postParamSimple("new_pwd") <> postParamSimple("new_pwd2")){
		echo "<script>alert('Your New Password and the Confirmed Password are Different\\nPlease Input Again!!');history.back();</script>";die();
	}
	$pwd->query("select * from ref_user where user_id=".$user_id." and pwd=password('".postParamSimple("old_pwd")."')");
	if($pwd->recordCount()){
		$pwd->query("update ref_user set pwd=password('".postParamSimple("new_pwd")."') where user_id=".$user_id);
		echo "<script>alert('Password Updated\\nPlease Logout to try your new password!');location='index.php?refresh=".md5(date("mdYHis"))."';</script>";die();
	}else{
		echo "<script>alert('User Are Not Exist..!\\nOR\\nMismatch in Password Entered');history.back();</script>";die();
	}
	
}
?>

		<div class="padding-15px">
		<form action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&edit=yes&refresh=<?=md5(date("mdYHis"))?>" class="form-horizontal" role="form" enctype="multipart/form-data" method="post" name="mst">
	       	
            <div class="portlet">
			<div class="portlet-title">
		             <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> -->
		             <h4><b>Change Password Form</b></h4>
			 </div>
		          <div class="portlet-body">
				<div class="form-group">
					 <label  class="col-md-3 control-label">
						Old Password :
					 </label>
					<div class="col-md-9">
						<input type="password" name="old_pwd" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					 <label  class="col-md-3 control-label">
						New Password :
					 </label>
					<div class="col-md-9">
						<input type="password" name="new_pwd" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					 <label  class="col-md-3 control-label">
						Confirm New Password :
					 </label>
					<div class="col-md-9">
						<input type="password" name="new_pwd2" class="form-control" >
					</div>
				</div>
			</div>
			<div class="form-actions fluid">
		                   <div class="col-md-offset-3 col-md-9" align="left">
				<button type="submit" class="btn blue">Update Password</button>
				<button type="button" class="btn red" onclick="location='index.php?refresh=<?=md5(date("mdYHis"))?>';">Cancel</button>
				</div>
			</div>
		
	        </div>
		</form>
	</div>