<?
	date_default_timezone_set("Asia/Jakarta");
	// $base_path = "/home/u1008229/public_html/intranet/";
	// $base_www = "https://intranet.bumiyasa.com";
	// $base_url = "/intranet/";
	
	$base_path = "C:/xampp/htdocs/bumiyasa-dev/";
	$base_www = "http://localhost/bumiyasa-dev";
	$base_url = "/bumiyasa-dev/";
		
	session_start();
	//Open kalo >= php 7.0
	require_once($base_path."includes/mysql_mysqli.inc.php");
	require_once($base_path."includes/dbmysql.inc.php");
	require_once($base_path."includes/miscfunction.inc.php");
	require_once($base_path."includes/listfunction.inc.php");
	require_once($base_path."includes/defaultvar.inc.php");
	require_once($base_path."includes/recordlist_ajax.php");
	
	require_once($base_path."includes/recordlist_child.php");
	require_once($base_path."includes/recordlist.php");
	require_once($base_path."includes/recordlist_nopopup.php");
	require_once($base_path."includes/form_function.php");

	// require_once($base_path."includes/form_generator.php");
	// require_once($base_path."includes/report_generator.php");
	// require_once($base_path."includes/search_form.php");
	// require_once($base_path."includes/recordlist_print.php");
	require_once($base_path."includes/customfunction.inc.php");
	// require_once($base_path."includes/pdf.php");


	// require_once($base_path."includes/mailfunction.php");
	// require_once($base_path."includes/application.php");
		
	
	
	$urlString=$_SERVER["SCRIPT_NAME"];
	$scriptString=listGetAt($urlString,1,"?");
	//echo $urlString;die();
	//echo $scriptString;die();echo $_SESSION["user_id" . date("mdY")];die();
	// if(listLast($scriptString,"/") <> "login.php"){
		// if(!isset($_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")])){
			// echo "<script>location='login.php?refresh=".md5(date("mdYHis"))."';</script>";die();
			/*echo "<BR><BR><BR><BR>".$_SESSION["user_id" . date("mdY")]."<BR>";
			echo $_SESSION["user_name" . date("mdY")]."<BR>";
			echo $_SESSION["full_name" . date("mdY")]."<BR>";*/
		// }
	// }
?>