<?
require_once("config.php");
//session_start();
	$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] = "";
	$_SESSION["auth_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] = "";
	$_SESSION["auth_file_".$ANOM_VARS["app_session_code"]  . date("mdY")] = "";
	$_SESSION["group_id_".$ANOM_VARS["app_session_code"]  . date("mdY")] = "";
	$_SESSION["group_name_".$ANOM_VARS["app_session_code"]  . date("mdY")] = "";
	$_SESSION["user_name_".$ANOM_VARS["app_session_code"]  . date("mdY")] = "";
	$_SESSION["full_name_" .$ANOM_VARS["app_session_code"] . date("mdY")] = "";
	//$_SESSION["gbuyer_id" . date("mdY")] ="";
	session_destroy();
	//session_unset();
	echo "<script>location='login.php?refresh=".md5(date("mdYHis"))."';</script>";die();
?>