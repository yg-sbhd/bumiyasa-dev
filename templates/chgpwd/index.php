<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Change Password</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Change Password</li>
        </ol>
      </div>
    </div>
  </div>
</div>

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

<div class="container-fluid">
    <div class="row">
              <div class="col-sm-12">
                <div class="card">


		<form action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&edit=yes&refresh=<?=md5(date("mdYHis"))?>" class="form-horizontal" role="form" enctype="multipart/form-data" method="post" name="mst">
	       	

		          <div class="card-body">
				<div class="form-group">
					 <label  class="col-md-12 control-label">
						Old Password :
					 </label>
					<div class="col-md-12">
						<input type="password" name="old_pwd" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					 <label  class="col-md-12 control-label">
						New Password :
					 </label>
					<div class="col-md-12">
						<input type="password" name="new_pwd" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					 <label  class="col-md-12 control-label">
						Confirm New Password :
					 </label>
					<div class="col-md-12">
						<input type="password" name="new_pwd2" class="form-control" >
					</div>
				</div>
			</div>
			<div class="card-footer">
		                   <div class="col-md-12" align="center">
				<button type="submit" class="btn btn-success">Update Password</button>
				<button type="button" class="btn btn-light" onclick="location='index.php?refresh=<?=md5(date("mdYHis"))?>';">Cancel</button>
				</div>
			</div>
		
	        </div>
		</form>
	</div>
</div>
