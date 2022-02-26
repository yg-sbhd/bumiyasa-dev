<?
// encryptStringArray
function decryptStringArray ($stringArray, $key = "psiprojex2020"){
  //$s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($key))), "\0"));
  $s = base64_decode($stringArray);
  return $s;
}
 
function encryptStringArray ($stringArray, $key = "psiprojex2020") {
  //$s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5($key)))), '+/=', '-_,');
  $s = base64_encode($stringArray);
  return $s;
}

function prepareUrl($url, $key = "sistem kluhr"){
  $url = explode("?",$url,2);
  if(sizeof($url) <= 1)
      return $url;
  else
      return $url[0]."?params=".encryptStringArray($url[1],$key);
}

function findURI($params,$key = "sistem kluhr") {
  $params = decryptStringArray($params,$key);
    return $params;
}

function setREQ($params,$key = "sistem kluhr") {
  $params = decryptStringArray($params,$key);
  $param_pairs = explode('&',$params);
  foreach($param_pairs as $pair){
    $split_pair = explode('=',$pair);
    $_REQUEST[$split_pair[0]] = $split_pair[1];
  }
}

function isEmail($str = "") {
	return preg_match("/^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$/i",$str);
}

function isDate($str = "") {
	return preg_match("/^([0-9]{1,4})[-\/]{1}([0-9]{1,4})[-\/]{1}([0-9]{1,4})$/i",$str);
}

function isDateTime($str = "") {
	return preg_match("/^([0-9]{1,4})[-\/]{1,4}([0-9]{1,4})[-\/]{1}([0-9]{1,4})[ ]{1}([0-9]{1,2})[:]{1}([0-9]{1,2})[:]{1}([0-9]{1,2})$/i",$str);
}

function parseDate($str = "") {
	$rs[0] = 0;
	$rs[1] = 0;
	$rs[2] = 0;
	if (preg_match("/^([0-9]{1,4})[-\/]{1}([0-9]{1,4})[-\/]{1}([0-9]{1,4})$/i",$str,$d)) {
		for ($i = 1; $i < count($d); $i++) $rs[$i-1] = $d[$i];
	}
	return $rs;
}

function parseDateTime($str = "") {
	$rs[0] = 0;
	$rs[1] = 0;
	$rs[2] = 0;
	$rs[3] = 0;
	$rs[4] = 0;
	$rs[5] = 0;
	if (preg_match("/^([0-9]{1,4})[-\/]{1,4}([0-9]{1,4})[-\/]{1}([0-9]{1,4})[ ]{1}([0-9]{1,2})[:]{1}([0-9]{1,2})[:]{1}([0-9]{1,2})$/i",$str,$d)) {
		for ($i = 1; $i < count($d); $i++) {
			$rs[$i - 1] = $d[$i];
		}
	}
	return $rs;
}

function location($url = "") {
	if ($url=="") return;
	header("Location: ".$url);
}

function jsformat($str) {
	$result = $str;
	$result = str_replace("\\","\\\\",$result); $result = str_replace("\f","\\f",$result); $result = str_replace("\b","\\b",$result); $result = str_replace("\r","\\r",$result);
	$result = str_replace("\t","\\t",$result); $result = str_replace("\'","\\'",$result); $result = str_replace("\"","\\\"",$result); $result = str_replace("\n","\\n",$result);
	return $result;
}

function disableCaching() {
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s",gmmktime()+3600)." GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
}

function timestampReformat($timestamp = "") {
	if (strlen($timestamp) < 14)
		return mktime();
	else
		return mktime(substr($timestamp,8,2),substr($timestamp,10,2),substr($timestamp,11,2),substr($timestamp,4,2),substr($timestamp,6,2),substr($timestamp,0,4));
}
function clean($string) {
   $string = str_replace(" ", "-", $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
function postParam($name = "",$value = "") {
	global $_POST;
	if (isset($_POST[$name])) {
		//$string = str_replace(" ", " ", $_POST[$name]); // Replaces all spaces with hyphens.
		$string = preg_replace("/[^ \w]+/", '',$_POST[$name]); // Removes special chars.
		$postvar = $string;
		if (get_magic_quotes_gpc()) {
			if (is_array($postvar)) {
				$retArr = array();
				foreach ($postvar as $el) array_push($retArr,stripslashes($el));
				//return htmlspecialchars($retArr,ENT_QUOTES);
				return preg_replace('/-+/', '-',$retArr);
			} else return preg_replace('/-+/', '-',$postvar);
		} else
				//return htmlspecialchars($_POST[$name],ENT_QUOTES);
				return preg_replace('/-+/', '-',$postvar);
	} else
		$string = str_replace(" ", " ", $value); // Replaces all spaces with hyphens.
		$string = preg_replace("/[^ \w]+/", '', $string); // Removes special chars.
		return preg_replace('/-+/', '-',$string);
}
function postParamSimple($name = "",$value = "") {
	global $_POST;
	$remove = array(';',"'",'"'); 
	$file_name = str_replace($remove,'',$_POST[$name]);
	return htmlspecialchars($file_name);
}
function uriParam($name = "",$value = "") {
	global $_GET;
	if (isset($_GET[$name])) {
		$string = str_replace(" ", "-", $_GET[$name]); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		if (get_magic_quotes_gpc()) {
			if (is_array($_GET[$name])) {
				$retArr = array();
				foreach ($_GET[$name] as $el) array_push($retArr,stripslashes($el));
				return preg_replace('/-+/', '-',$retArr);
			} else return stripslashes($_GET[$name]);
		} else
				return $_GET[$name];
	} else
		$string = str_replace(" ", "-", $value); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		return preg_replace('/-+/', '-',$string);
}

function postFileParam($name = "") {
	global $_FILES;
	if (isset($_FILES[$name])) 
		return $_FILES[$name];
	else
		return array();
}

function cookieParam($name = "",$value = "") {
	global $_COOKIE;
	if (isset($_COOKIE[$name])) 
		if (get_magic_quotes_gpc()) {
			if (is_array($_COOKIE[$name])) {
				$retArr = array();
				foreach ($_COOKIE[$name] as $el) array_push($retArr,stripslashes($el));
				return $retArr;
			} else return stripslashes($_COOKIE[$name]);
		} else
			return $_COOKIE[$name];
	else
		return $value;
}

function getURI($varlist = "",$excvarlist = "",$outputifnotset = true) {
	global $_GET;
	
	$result = "";
	if ($varlist == "")
		$arr_varlist = array_keys($_GET);
	else
		$arr_varlist = explode(",",$varlist);
	$arr_excvarlist = explode(",",$excvarlist);
	
	for($i=0;$i<count($arr_varlist);$i++) 
		if (!in_array($arr_varlist[$i],$arr_excvarlist)) {
			if ($outputifnotset) if ($result != "") $result .= "&";
			if (!isset($_GET[$arr_varlist[$i]]) && $outputifnotset) {
				$result .= $arr_varlist[$i]."=";
			} elseif (isset($_GET[$arr_varlist[$i]])) {
				if (get_magic_quotes_gpc())
					$result .= $arr_varlist[$i]."=".rawurlencode(stripslashes($_GET[$arr_varlist[$i]]));
				else
					$result .= $arr_varlist[$i]."=".rawurlencode($_GET[$arr_varlist[$i]]);
			}
		}
	
	return $result;
}

function getURI2Form($varlist = "",$excvarlist = "",$outputifnotset = true) {
	global $_GET;
	
	$result = "";
	if ($varlist == "")
		$arr_varlist = array_keys($_GET);
	else
		$arr_varlist = explode(",",$varlist);
	$arr_excvarlist = explode(",",$excvarlist);
	
	for($i=0;$i<count($arr_varlist);$i++) 
		if (!in_array($arr_varlist[$i],$arr_excvarlist) && isset($_GET[$arr_varlist[$i]])) {
			if (!isset($_GET[$arr_varlist[$i]]) && $outputifnotset) {
				$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"\">";
			} elseif (isset($_GET[$arr_varlist[$i]])) {
				if (get_magic_quotes_gpc())
					$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"".htmlentities(stripslashes($_GET[$arr_varlist[$i]]))."\">";
				else
					$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"".htmlentities($_GET[$arr_varlist[$i]])."\">";
			}
		}
	
	return $result;
}

function getPost2Form($varlist = "",$excvarlist = "",$outputifnotset = true) {
	global $_POST;
	
	$result = "";
	if ($varlist == "") 
		$arr_varlist = array_keys($_POST);
	else 
		$arr_varlist = explode(",",$varlist);
	$arr_excvarlist = explode(",",$excvarlist);
	
	for($i=0;$i<count($arr_varlist);$i++) 
		if (!in_array($arr_varlist[$i],$arr_excvarlist) && isset($_POST[$arr_varlist[$i]])) {
			if (!isset($_POST[$arr_varlist[$i]]) && $outputifnotset) {
				$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"\">";
			} elseif (isset($_POST[$arr_varlist[$i]])) {
				$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"".htmlentities(stripslashes($_POST[$arr_varlist[$i]]))."\">";
			}
		}
	
	return $result;
}

function getPost2URI($varlist = "",$excvarlist = "",$outputifnotset = true) {
	global $_POST;
	
	$result = "";
	if ($varlist == "") 
		$arr_varlist = array_keys($_POST);
	else 
		$arr_varlist = explode(",",$varlist);
	$arr_excvarlist = explode(",",$excvarlist);
	
	for($i=0;$i<count($arr_varlist);$i++) 
		if (!in_array($arr_varlist[$i],$arr_excvarlist)) {
			if ($outputifnotset) if ($result != "") $result .= "&";
			if (!isset($_POST[$arr_varlist[$i]]) && $outputifnotset) {
				$result .= $arr_varlist[$i]."=";
			} elseif (isset($_POST[$arr_varlist[$i]])) {
				$result .= $arr_varlist[$i]."=".rawurlencode(stripslashes($_POST[$arr_varlist[$i]]));
			}
		}

	return $result;
}

function jsAlert($msg = "") {
?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	alert('<?=jsFormat($msg)?>');
//-->
</SCRIPT>
<?
}

function jsNavigate($url = "",$replacehistory = false) {
?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	<? if ($replacehistory) { ?>location.replace('<?=$url?>');<? } else { ?>location='<?=$url?>';<? } ?>
//-->
</SCRIPT>
<?
}

function jsAlertAndNavigate($msg = "",$url = "",$replacehistory = false) {
?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	alert('<?=jsFormat($msg)?>');
	<? if ($replacehistory) { ?>location.replace('<?=$url?>');<? } else { ?>location='<?=$url?>';<? } ?>
//-->
</SCRIPT>
<?
}

function jsRepostURIAndPostData($message = "",$frmAction = "",$frmName = "phpFormResubmit",$uri_varlist = "",$uri_excvarlist = "",$post_varlist = "",$post_excvarlist = "",$outputifnotset = true) {
	if (trim($frmName) == "" || trim($frmAction) == "") return;
?>
	<form action="<?=$frmAction.getURI($post_varlist,$post_excvarlist,$outputifnotset)?>" name="<?=$frmName?>" method="post">
		<?=getPost2Form($post_varlist,$post_excvarlist,$outputifnotset)?>
	</form>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	<? if (trim($message) != "") { ?>alert('<?=jsFormat($message)?>');<? } ?>
		document.<?=$frmName?>.submit();
  //-->
  </SCRIPT>
<?
}

function findOneOf($str,$spec) {
	$found = -1;
	for ($i=0; $i<strlen($spec); $i++) {
		$found = strpos($str,addslashes(substr($spec,$i,1)));
		if ($found > -1) {
			break;
		}
	}
	$found++;
	return ($found);
}

function ShowCalendar($Indx) {
	echo "<script type=\"text/javascript\">\n";
	echo " Calendar.setup({
	        inputField: \"InDate$Indx\",        // id of the input field
	        ifFormat: \"%d/%m/%Y\",       // format of the input field
	        showsTime: true,                    // will display a time selector
	        singleClick: false                  // double-click mode
	       });\n";
	echo "</script>\n";
}

function datesql2date ($datesql) {
	if(strlen($datesql)){
		$tgl = listGetAt($datesql,1," ");
		$my_year = listGetAt($tgl,1,"-");
		$my_month = listGetAt($tgl,2,"-");
		$my_day = listGetAt($tgl,3,"-");
		
		$date = "$my_day/$my_month/$my_year";
	}else{
		$date = "";
	}
	return $date;
}

function datesql2datetime($datesql) {
	if(strlen($datesql)){
		$tgl = listGetAt($datesql,1," ");
		$year=listGetAt($tgl,1,"-");
		$month=listGetAt($tgl,2,"-");
		$day=listGetAt($tgl,3,"-");

		$waktu = listGetAt($datesql,2," ");
		$hour=listGetAt($waktu,1,":");
		$minute=listGetAt($waktu,2,":");
		$second=listGetAt($waktu,3,":");

		$date = $day."/". $month ."/".$year. " ".$hour.":".$minute.":".$second;
		//$date = $year."-".$month."-".$day;
	}
	return $date;
}

function date2sql($datesql) {
	if(strlen($datesql)){
		$tgl = listGetAt($datesql,1," ");
		$year=listGetAt($tgl,3,"/");
		$month=listGetAt($tgl,2,"/");
		$day=listGetAt($tgl,1,"/");

		$date =$year."-".$month."-".$day;
	}
	return $date;
}

function dateTime2sql($datesql) {
	if(strlen($datesql)){
		$tgl = listGetAt($datesql,1," ");
		$year=listGetAt($tgl,3,"/");
		$month=listGetAt($tgl,2,"/");
		$day=listGetAt($tgl,1,"/");

		$waktu = listGetAt($datesql,2," ");
		$hour=listGetAt($waktu,1,":");
		$minute=listGetAt($waktu,2,":");
		$second=listGetAt($waktu,3,":");

		$date =$year."-".$month."-".$day." ".$hour.":".$minute.":".$second;
		//$date = $year."-".$month."-".$day;
	}
	return $date;
}

function sqlToDatePhp($mysqldate){
	$phpdate = strtotime( $mysqldate );
	$mysqldate = date( 'd-m-Y', $phpdate );
	return $mysqldate;
}

function sqlToTimePhp($mysqldate){
	$phpdate = strtotime( $mysqldate );
	$mysqldate = date( 'H:i', $phpdate );
	return $mysqldate;
}

function timeDiff($firstTime,$lastTime) {
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);
    $timeDiff=$lastTime-$firstTime;
    return $timeDiff;
}

function formatTimes($num_hours){
	$sisabagi = $num_hours%3600;
	$hasilbagi = ($num_hours-$sisabagi)/3600;
	$menit = $sisabagi / 60;
	$hasilbagi = sprintf("%02s", $hasilbagi);
	$menit = sprintf("%02s", $menit);
	return $hasilbagi.":".$menit;
}

function Date2SQLnoTime($date){
	$tgl = listGetAt($date,1,"/");
	$bln = listGetAt($date,2,"/");
	$thn = listGetAt($date,3,"/");

	return $getDate = $thn."-".$bln."-".$tgl;
}

function onlyHour($time){
	$hour 	= listGetAt($time,1,":");
	$minute = listGetAt($time,2,":");
	$second = listGetAt($time,3,":");

	return $getTime = $hour;
}

function hourMinute($time){
	$hour 	= listGetAt($time,1,":");
	$minute = listGetAt($time,2,":");
	$second = listGetAt($time,3,":");

	return $getTime = $hour.":".$minute;
}

function getDayIndonesia($date){
    if($date != '0000-00-00'){
        $data = hari(date('D', strtotime($date)));
    }else{
        $data = '-';
    }
    return $data;
}

function getDayDateIndonesia($date){
    if($date != '0000-00-00'){
        $data = hari(date('D', strtotime($date))).", ".date('d/m/Y', strtotime($date));
    }else{
        $data = '-';
    }
    return $data;
}

  
function hari($day) {
    $hari = $day;

    switch ($hari) {
        case "Sun":
            $hari = "Minggu";
            break;
        case "Mon":
            $hari = "Senin";
            break;
        case "Tue":
            $hari = "Selasa";
            break;
        case "Wed":
            $hari = "Rabu";
            break;
        case "Thu":
            $hari = "Kamis";
            break;
        case "Fri":
            $hari = "Jum'at";
            break;
        case "Sat":
            $hari = "Sabtu";
            break;
    }
    return $hari;
}



function linechart($chart_id){
		global $_GET;
		global $_COOKIE;
		global $_POST;
		//global $edition_id;
		
		$cekdb = cmsDB();
		$menu = cmsDB();
		$qCek = cmsDB();
		
		$sql = "select * from tbl_chart where chart_id=" . $chart_id;
		$cekdb->query($sql);
		$cekdb->next();
		$chart_title = $cekdb->row("chart_name");
		$x_title = $cekdb->row("y_title");
		$y_title = $cekdb->row("x_title");
		$panjang = $cekdb->row("panjang");
		$lebar = $cekdb->row("lebar");
		$type = $cekdb->row("type");
		$report = $cekdb->row("report_id");
		
		if($report==0){
			$sql = "select * from tbl_chartmember where chart_id=" . $chart_id;
			$qCek->query($sql);
			$lstx = "";
			$lsty = "";
			while($qCek->next()){
				$lstx = listAppend($lstx,$qCek->row("chart_value"));
				$lsty = listAppend($lsty,$qCek->row("chart_desc"));
			}
		}else{
			if($type == 3){
				$sql = "select * from tbl_reportdetail where report_id=" . $report . " order by col_1 desc";
			}else{
				$sql = "select * from tbl_reportdetail where report_id=" . $report;
			}
			$qCek->query($sql);
			$lstx = "";
			$lsty = "";
			while($qCek->next()){
				if($type == 3){
					$lstx = listAppend($lstx,$qCek->row("col_2"),"^");
					$lsty = listAppend($lsty,$qCek->row("col_1"),"^");
				}else{
					$lstx = listAppend($lstx,str_replace(",",".",$qCek->row("col_2")));
					$lsty = listAppend($lsty,str_replace(",",".",$qCek->row("col_1")));
				}
			}
		}
		if($type==1){
			echo "<img src='line_trx.php?chart_title= ". $chart_title . "&panjang=". $panjang ."&lebar=". $lebar ."&x_title=". $x_title ."&y_title=" . $y_title . "&lstx=". $lstx ."&lsty=". $lsty ."' border=0 align=top>";
		}elseif($type==2){
			echo "<img src='chart_bar.php?chart_title= ". $chart_title . "&panjang=". $panjang ."&lebar=". $lebar ."&x_title=". $x_title ."&y_title=" . $y_title . "&lstx=". $lstx ."&lsty=". $lsty ."' border=0 align=top>";
		}elseif($type==3){
?>
<table width="156" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="padding-left: 5px; width="100%" colspan="2" bgcolor="#2e80bc"><font color="#FFFFFF" face="Verdana,Tahoma" size="1"><b>
			      <?=$chart_title?></b></font></td>
			  </tr>
			  <? for($i==1;$i<=listLen($lstx,"^");$i++){ ?>
			  <tr>
			    <td width="69" style="padding-left: 5px;"><font color="#666666" face="Verdana,Tahoma" size="1"><?=listGetAt($lsty,$i,"^")?></font></td>
			    <td width="75" align="right" style="padding-right: 5px;"><font color="#666666" face="Verdana,Tahoma" size="1"><?=listGetAt($lstx,$i,"^")?></font></td>
			  </tr>
			  <? } ?>
</table>
  <?			
		}
}

function showbanner($lstofbanner){
global $FJR_VARS;
?>
<table border="0" cellpadding="5" cellspacing="2" style="border-collapse: collapse" bordercolor="#111111" width="100%" >
<?
		$trans_db = cmsDB();
		$qCek = cmsDB();
		
		$sql = "select * from tadvertisement where ad_id in (".$lstofbanner.")";
		$trans_db->query($sql); 
		
   		while ($trans_db->next()) { 
?>
        <tr>
                  <td width="100%" valign="top">
				  <? if(strlen(trim($trans_db->row("ad_link")))){?>
				  	<a href="<?=trim($trans_db->row("ad_link"))?>" target="_blank">
				  <? } ?>
				  <img src='<?=$FJR_VARS["www_img_url"]?>banner/<?=$trans_db->row("ad_banner")?>' border="0" width="120" height="60">
				  <? if(strlen(trim($trans_db->row("ad_link")))){ ?>
				  	</a>
				  <? } ?>
				  </td>
  </tr>
        <tr>
		
				
<?		}?>
</table>
<? }

function getDirList ($dirName,$title) {
	global $FJR_VARS;
	echo "<b><u><font color='#2E7EC0'>".$title."</font></u></b><p>";
	$d = dir($dirName);
	echo "<table width='100%' cellpadding='2' cellspacing='0' border='0'>";
	$lstfile = "";
	while($entry = $d->read()) {
		$lstfile = listAppend($lstfile,$entry);
	}
	for($i=0;$i<listLen($lstfile);$i++){
		$entry = listGetAt($lstfile,listLen($lstfile)-$i);
		if ($entry != "." && $entry != "..") {
			if (is_dir($dirName."/".$entry)) {
				getDirList($dirName.$entry);
			}else{
				//echo $dirName.$entry."<br />";
				$dir_real = str_replace($FJR_VARS["www_file_path"],"",$dirName);
				$ext = listLast($entry,".");
				if($ext == "pdf" || $ext == "PDF"){
					echo "<tr><td><a href=\"javascript:PopWindow('../_cms/getfile.php?fn=".$dir_real.$entry."','winfile',800,600);\"><img src='".$FJR_VARS["www_img_url"]."icon_pdf.gif' border='0' width='20' height='20'  style='float: left'>&nbsp;".$entry."</a></td></tr>";
				}elseif($ext == "doc" || $ext == "DOC"){
					echo "<tr><td><a href=\"javascript:PopWindow('../_cms/getfile.php?fn=".$dir_real.$entry."','winfile',800,600);\"><img src='".$FJR_VARS["www_img_url"]."icon_msword.gif' border='0' width='20' height='20' style='float: left'>&nbsp;".$entry."</a></td></tr>";
				}elseif($ext == "xls" || $ext=="csv" || $ext=="xlk"){
					echo "<tr><td><a href=\"javascript:PopWindow('../_cms/getfile.php?fn=".$dir_real.$entry."','winfile',800,600);\"><img src='".$FJR_VARS["www_img_url"]."icon_msexcel.gif' border='0' width='20' height='20' style='float: left'>&nbsp;".$entry."</a></td></tr>";
				}elseif($ext == "ppt" || $ext == "PPT"){
					echo "<tr><td><a href=\"javascript:PopWindow('../_cms/getfile.php?fn=".$dir_real.$entry."','winfile',800,600);\"><img src='".$FJR_VARS["www_img_url"]."icon_mspoint.gif' border='0' width='20' height='20' style='float: left'>&nbsp;".$entry."</a></td></tr>";
				}
			}
		}
	}
	
	echo "</table>";
	$d->close();
}

function getCoordinates($filename) {
    if (extension_loaded('exif')) {
        $exif = exif_read_data($filename, 'EXIF');
        
        if (isset($exif['GPSLatitudeRef']) && isset($exif['GPSLatitude']) && 
            isset($exif['GPSLongitudeRef']) && isset($exif['GPSLongitude'])) {
            return array (
                exifToCoordinate($exif['GPSLatitudeRef'], $exif['GPSLatitude']), 
                exifToCoordinate($exif['GPSLongitudeRef'], $exif['GPSLongitude'])
            );
        }
    }
}

function opt_recordshow($id,$elseparam,$row_fname){
	global $_POST,$_GET;
	$custom=cmsDB();
	echo $elseparam;
}

function __TRUNC($value = 0, $digits = 0) {
	$value = number_format($value,0,",",".");
	// Validate parameters
	if ((!is_numeric($value)) || (!is_numeric($digits)))
	$digits	= floor($digits);

	// Truncate
	$adjust = pow(10, $digits);

	if (($digits > 0) && (rtrim(intval((abs($value) - abs(intval($value))) * $adjust),'0') < $adjust/10))
		return $value;
	$intval = intval($value * $adjust) / $adjust;
	$intval = $intval . ".000";

	
	return ($intval);
}

function __TRUNCtoString($value = 0){
	$value = str_replace(".", "", $value);
	return $value;

}

function __FormatNumber($value = 0){
	if($value==""){
		$value = 0;
	}else{
		$value = number_format($value,0,",",".");
	}
	return $value;
}

function _workFlowButton($additionalButton){
	//$additionalButton =[auth name]~[Button Color]~[Action URL]~[Alias_Name]~[icon_button]
	// echo $additionalButton;die();
	for($i=1;$i<=listLen($additionalButton,"#");$i++){
		$var_btn = listGetAt($additionalButton,$i,"#");
		$auth_name =  listGetAt($var_btn,1,"~");
		$btn_color = listGetAt($var_btn,2,"~");
		$url_action = listGetAt($var_btn,3,"~");
		$btn_alias = listGetAt($var_btn,4,"~");
		$btn_icon = listGetAt($var_btn,5,"~");
		// echo $var_btn."<BR>".$auth_name."<BR>";
		// if(_checkauth($auth_name)){
		?>
			<a class="btn <?=$btn_color?>" href="<?=$url_action?>"><?=$btn_alias?>&nbsp;<?=$btn_icon?></a>&nbsp;
		<?
		// }
	}
}

function _get_user_name($id_user){
	global $_SESSION,$ANOM_VARS,$_GET,$_POST;
	$show = cmsDB();
	$query = "select full_name from ref_user where user_id=".$id_user;
	$show->query($query);
	$show->next();
	return $show->row('full_name');

}

function update_relational($id, $nama_table, $primary_id, $relational_txt){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	
	$show = cmsDB();
	$update = cmsDB();

	$show->query("Select * From ".$nama_table." where ". $primary_id."=".$id);
	$show->next();

	$new_field="";

	for ($field=1; $field < listLen($relational_txt); $field++) { 
		
		$frow 			= listGetAt($relational_txt,$field,"~");
		$fname 			= listGetAt($frow,1,"|");
		$fname_alias 	= listGetAt($frow,2,"|");
		$ftype 			= listGetAt($frow,3,"|");
		$fquery 		= listGetAt($frow,4,"|"); 
		// echo "frow = " .$frow."<p>";
		// echo "fname = " .$fname."<p>";
		// echo "ftype = " .$ftype."<p>";
		// echo "fquery = " .$fquery."<p>";

		if($ftype == "select"){
			if(listFind($fquery,"where"," ")){
				$fquery = $fquery . " and " . $fname_alias . "='". $show->row($fname)."'";
			}else{
				$fquery = $fquery . " where " . $fname_alias . "='". $show->row($fname)."'";
		   	}
			$update->query($fquery);
			$update->next();
			$new_field = $new_field . $fname."_txt = '". $update->row('name') ."',";

		}elseif($ftype == "multiselect"){
			$lst = "0";
			if(strlen($show->row($fname))){
				$lst = $show->row($fname);
			}

			if(listFind($fquery,"where"," ")){
				$fquery = $fquery . " and " . $fname_alias . " in ('". $lst."')";
			}else{
				$fquery = $fquery . " where " . $fname_alias . " in ('". $lst."')";
		   	}

			$update->query($fquery);
			// $update->next();
			// echo $fquery . " where " . $fname_alias . " in (".$lst.") <p>";
			// echo $update->row('name');

			if($update->recordCount()){
				$val_fname= "";
				while($update->next()){
					$val_fname = $val_fname . $update->row("name") .', ';
				}

				$val_fname = substr($val_fname, 0, -2);
			
			}else{
				$val_fname = "-";
			}


			$new_field = $new_field . $fname."_txt = '". $val_fname ."',";

		}
	}

	$new_field = substr($new_field, 0, -1);
	
	$query = "update " . $nama_table . " set " . $new_field . " where " . $primary_id . "=".$id;
	
	$update->query($query);
	// echo $query;
	// die();
	return ;

}

function _image_upload($name, $attachname = '' , $dir = 'upload_photo/'){
	global $_SESSION,$ANOM_VARS,$_GET,$_POST;
	
	$uploaddir = $ANOM_VARS["www_file_path"] . $dir;
	$uploadfile = $uploaddir . "upload" . "_" . date("mdYHis")."_".listFirst(str_replace(" ","_",$name['name']),".").".". listLast($name['name'],".");
	$uploadfile_alias = "upload" . "_" . date("mdYHis")."_".listFirst(str_replace(" ","_",$name['name']),".").".". listLast($name['name'],".");
	//if (move_uploaded_file($_FILES[$fname]['tmp_name'], $uploadfile)) {
	if(is_uploaded_file($name['tmp_name'])){
		copy($name['tmp_name'], $uploadfile);
		//echo "File is valid, and was successfully uploaded.\n";
		$file_doc = $uploadfile_alias;
	} else {
		//echo "File is Invalid, and was successfully uploaded.\n";
		$file_doc = "";
	}
	return $file_doc;
	
}

function _image_show($name, $dir){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	$extensionList = array( "jpg", "png", "jpeg", );
	$fileName = $name;
	$pecah = explode(".", $fileName);
	$ekstensi = end($pecah);
	if (in_array($ekstensi, $extensionList)){ ?>
	
		<img src="<?=$dir?><?=$name?>" width="100" alt="<?=$name?>" />
	<? }else{ ?>
		<img src="<?=$CMS_VARS["www_img_url"]?>default/<?=$ekstensi?>.png" width="100" alt="blog-1" />
	<? } 
}

// =========================================== BUMIYASA =============================================

function getRomawi(){
    switch (date('n')){
        case 1: 
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
    }
}

function get_from_db($tabel, $field, $field_search, $id=""){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	$show=cmsDB();
	if ($id<>"") {
		$show->query("select ". $field . " from " .$tabel . " where " . $field_search . "=" . $id);
		if ($show->recordCount()) {
			$show->next();
			return $show->row($field);
		}else{
			return "-";
		}
		// echo "select ". $field . " from " .$tabel . " where " . $field_search . "=" . $id;
	}else{
		return;
	}
}

function number_lkpb($id){
	global $_SESSION,$CMS_VARS,$_GET,$_POST;
	$show=cmsDB();
	$qry=cmsDB();

	$qry->query("select group_location_id from ref_lkpb where lkpb_id=".$id);
	$qry->next();

	$qry->query("select group_code from master_group_location where group_location_id=".$qry->row('group_location_id'));
	$qry->next();

	// $number_format = number_lkpb($qry->row('group_code'));

	$show->query("select max(lkpb_no) as lkpb_no from ref_lkpb where lkpb_no like '%".$qry->row('group_code')."%' and lkpb_no like '%".date('Y')."%'");
	if($show->recordCount()){
		$show->next();
		$no = listGetAt($show->row('lkpb_no'), 1, "/");
		$no++;
		$no = sprintf("%03s", $no);
		$result = $no."/LKPB/".getRomawi()."/".$qry->row('group_code')."/".date("Y");
	}else{
		$result = "001/LKPB/".getRomawi()."/".$qry->row('group_code')."/".date("Y");
	}
	// return $result;
    $qry->query("update ref_lkpb set lkpb_no='".$result."', date='".date("Y-m-d")."' where lkpb_id=".$id);
}


?>