<?
require_once("config.php");
$login = cmsDB();
$auth = cmsDB();
$area=cmsDB();
$group=cmsDB();

if(isset($_POST["login"])){
	if($_POST["login"]== md5("yes_".date("mdY"))){
		$txtname = $login->safeSQL($_POST["txtname"]);
		$pswd = $login->safeSQL($_POST["txtpassword"]);
		$strsql="select * from ref_user where is_deleted=0 and status_id=5 and user_name='".$txtname."' and pwd=PASSWORD('".$pswd."')";
		$login->query($strsql);
		// echo $strsql;die();
		if($login->recordCount()){
			$login->next();
			//echo "masuk";
			$user_id=$login->row("user_id");
			$user_name=$login->row("user_name");
			$full_name=$login->row("full_name");
			$superior_id=$login->row('superior_id');
			$group_location_id=$login->row("group_location_id");

			$auth->query("select group_id from ref_user where user_id=".$login->row("user_id"));
			$lstgroup = $auth->valueList("group_id");
			$auth->query("select * from ref_groupauthorization where group_id in (".$lstgroup.")");
			$lstauth="";
			$lstauthfile="";
			$lstauthdetail="";
			while($auth->next()){
				$lstauth=listAppend($lstauth,$auth->row("auth_id"));
				//$lstauthdetail=listAppend($lstauthdetail,$auth->row("is_create").",".$auth->row("is_review").",".$auth->row("is_update").",".$auth->row("is_delete"),"|");
			}

			$auth->query("select distinct(tmp) as tmp_file from ref_authorization where auth_id in (".$lstauth.")");
			$lstauthfile=$auth->valueList("tmp_file");
			$auth->query("select * from ref_group where group_id in (".$lstgroup.")");
			$auth->next();
			$group_name = $auth->row("group_name");
			$location = $auth->row("location");
			$position = $auth->row("position");
			$group_id=$lstgroup;
			if(listLen($lstauth)==0){$lstauth="0";};
			//session_start();
			$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] = $user_id;
			$_SESSION["auth_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] = $lstauth;
			$_SESSION["auth_file_".$ANOM_VARS["app_session_code"]  . date("mdY")] = $lstauthfile;
			$_SESSION["group_id_".$ANOM_VARS["app_session_code"]  . date("mdY")] = $group_id;
			$_SESSION["group_name_".$ANOM_VARS["app_session_code"]  . date("mdY")] = $group_name;
			$_SESSION["location_".$ANOM_VARS["app_session_code"]  . date("mdY")] = $location;
			$_SESSION["position_".$ANOM_VARS["app_session_code"]  . date("mdY")] = $position;
			$_SESSION["user_name_".$ANOM_VARS["app_session_code"]  . date("mdY")] = $user_name;
			$_SESSION["full_name_" .$ANOM_VARS["app_session_code"] . date("mdY")] = $full_name;
			$_SESSION["group_location_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] = $group_location_id;
			$_SESSION["superior_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] = $superior_id;


			echo "<script>location='".$base_www."/?refresh=".md5(date("mdYHis"))."';</script>";
			die();
		}else{
			echo "<script>location='".$base_www."/login.php?err_msg=yes&refresh=".md5(date("mdYHis"))."';</script>";
			die();
		}
	}else{
		echo "<script>location='".$base_www."/login.php?err_msg=yes&refresh=".md5(date("mdYHis"))."';</script>";
		die();
	}
}



?>

<!DOCTYPE html>

<html lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">

		<meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">

		<meta name="author" content="pixelstrap">

		<link rel="icon" href="<?=$base_www?>/library/_images/bumiyasa-logo-colored-1.svg" type="image/x-icon">

		<link rel="shortcut icon" href="<?=$base_www?>/library/_images/bumiyasa-logo-colored-1.svg" type="image/x-icon">

		<title>Login - BUMIYASA</title>

		<!-- Google font-->

		<link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">

		<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">

		<!-- Font Awesome-->

		<link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css">

		<!-- ico-font-->

		<link rel="stylesheet" type="text/css" href="assets/css/icofont.css">

		<!-- Themify icon-->

		<link rel="stylesheet" type="text/css" href="assets/css/themify.css">

		<!-- Flag icon-->

		<link rel="stylesheet" type="text/css" href="assets/css/flag-icon.css">

		<!-- Feather icon-->

		<link rel="stylesheet" type="text/css" href="assets/css/feather-icon.css">

		<!-- Plugins css start-->

		<!-- Plugins css Ends-->

		<!-- Bootstrap css-->

		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

		<!-- App css-->

		<link rel="stylesheet" type="text/css" href="assets/css/app.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">

		<link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">

		<!-- Responsive css-->

		<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

	</head>

	<body>

		<!-- Loader starts-->

		<div class="loader-wrapper">

			<div class="loader-index"><span></span></div>

			<svg>

				<defs></defs>

				<filter id="goo">

				<fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>

				<fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">    </fecolormatrix>

				</filter>

			</svg>

		</div>

		<!-- Loader ends-->

		<!-- page-wrapper Start-->

		<div class="page-wrapper">

			<div class="container-fluid p-0">

				<!-- login page with video background start-->

				<div class="auth-bg-video">

					<video id="bgvid" poster="assets/images/other-images/coming-soon-bg.jpg" playsinline="" autoplay="" muted="" loop="">

						<source src="assets/video/auth-bg.mp4" type="video/mp4">

					</video>

					<div class="authentication-box">

						<div class="mt-4">

							<div class="card-body card-login">

								<div class="cont text-center">
									<img class="logo" src="library/_images/bumiyasa-logo-colored.svg" alt="">

									<div>

										<form class="theme-form" action="<?=$base_www?>/login.php" method="POST" name="updateform" id="updateform">

											<h4>LOGIN</h4>


											<?if(isset($_GET["err_msg"]) && $_GET["err_msg"]=="yes"){?>

												<font color=red>Invalid Login..!</font>

											<?}?>

											<input type="hidden" name="login" value="<?=md5("yes_".date("mdY"))?>">

											<div class="form-group">


												<input class="form-control"  type="text" autocomplete="off" placeholder="Username" id="txtname" name="txtname" required="required" />

											</div>

											<div class="form-group">


												<input class="form-control" type="password" autocomplete="off" placeholder="Password" id="txtpassword" name="txtpassword" required="required" />

											</div>

											<div class="form-group mt-3 mb-0">

												<button class="btn btn-primary btn-block" type="submit">LOGIN</button>

											</div>

										</form>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

				<!-- login page with video background end-->

			</div>

		</div>

		<!-- latest jquery-->

		<script src="assets/js/jquery-3.5.1.min.js"></script>

		<!-- Bootstrap js-->

		<script src="assets/js/bootstrap/popper.min.js"></script>

		<script src="assets/js/bootstrap/bootstrap.js"></script>

		<!-- feather icon js-->

		<script src="assets/js/icons/feather-icon/feather.min.js"></script>

		<script src="assets/js/icons/feather-icon/feather-icon.js"></script>

		<!-- Sidebar jquery-->

		<script src="assets/js/sidebar-menu.js"></script>

		<script src="assets/js/config.js"></script>

		<!-- Plugins JS start-->

		<script src="assets/js/login.js"></script>

		<!-- Plugins JS Ends-->

		<!-- Theme js-->

		<script src="assets/js/script.js"></script>

		<!-- login js-->

		<!-- Plugin used-->

	</body>

</html>