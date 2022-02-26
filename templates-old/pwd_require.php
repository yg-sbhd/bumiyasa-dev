<?
require_once("../config.php");
$login=cmsDB();
?>
<html>
<head>
   <meta charset="utf-8" />
   <title><?=$ANOM_VARS["www_title"]?></title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES -->
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/gritter/css/jquery.gritter.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/select2/select2_metro.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/clockface/css/clockface.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-colorpicker/css/colorpicker.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/jquery-multi-select/css/multi-select.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/jquery-tags-input/jquery.tagsinput.css" />
   <link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_url"]?>/assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
   <!-- END PAGE LEVEL STYLES -->
   <!-- BEGIN THEME STYLES --> 
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/css/themes/green.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="<?=$ANOM_VARS["www_url"]?>/assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
   
<style>
#process {
position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
  z-index: 1000;
}
</style>
<style>
#map {
            width: 100%;
	height: 300px;
        }
</style>
<?
if(isset($_GET[md5("cekpwd".date("mdYHi"))])){
	//echo "Masuk";die();
	$login=cmsDB();
	//cek user yg ada group super
	$strsql="select * from ref_user where pin=PASSWORD('".trim($_POST["txtpin"])."') and group_id=5";
	//echo $strsql;die();
	$login->query($strsql);
	if($login->recordCount()){
		//cek login yg pinnya itu
		$login->next();
		$user_id=$login->row("user_id");
		?>
		<script>
		window.opener.document.location.href = window.opener.document.location.href + '&<?=md5("approved_".date("mdY"))?>=yes&<?=md5("uid".date("mdY"))?>=<?=$user_id?>&ref=<?=date("mdYHis")?>';
		window.close();
		</script>
		<?
		//log
		die();
	}else{
		?>
		<script>
		alert("Pin Salah!! Coba Lagi..!");
		window.back();
		</script>
		<?
		
	}
}
?>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
 <div id="process"></div>
<body class="page-header-fixed" id="output">
	<BR>
	<center>
	<form action="pwd_require.php?<?=md5("cekpwd".date("mdYHi"))?>=yes&refresh=<?=date("mdYHis")?>" method="post" name="updateform" enctype="multipart/form-data" id="updateform" class="form-horizontal">
		Masukan PIN User Super :<BR>
		<input type="password" name="txtpin" max="5" maxlength="5">
		<a href="javascript:document.updateform.submit()" class="btn green"><i class="icon-lock"></i></a>
		
	</form>
	</center>
      <!-- END PAGE -->    
	  
</body>
<!-- END BODY -->
</html>