<?
require_once("../config.php");
$kabupaten_id=cmsDB();
//echo uriParam("q");
if(isset($_GET["q"])){
	$query=str_replace("|"," ",uriParam("q"));
	$query=str_replace("`","'",$query);
	$query=str_replace("-","'",$query);
	$main_query=listGetAt($query,1,"~");
	$record_show=listGetAt($query,2,"~");
	$search_field=listGetAt($query,2,"~");
	$header_name = listGetAt($query,3,"~");
	$primary_id= listGetAt($query,4,"~");
	$primary_text= listGetAt($record_show,1);
	
}else{
	echo "Invalid Input";die();
}

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
<script language="javascript">
//Add alert message when error occur 
//window.onerror = function(msg, err_url, line) {alert('Unkwon Error :) ' + line);}
//Detects browser type 
function makeObject(){
	var x; 
	var browser = navigator.appName; 
	if(browser == "Microsoft Internet Explorer"){
		x = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		x = new XMLHttpRequest();
	}
	return x;
}

//Call function 
var request = makeObject();

//The get method AJAX 
function get_method(addr){
	var data = addr;
	request.open('get', data);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = output; 
	request.send('');
}

//The POST method AJAX 
function post_method(addr,field,optional){
	var inputan = new Array();
	var get_var = new Array();
	inputan = field.split(",");
	//alert(inputan.length);
	var pars_param = "";
	for(i=0;i<inputan.length;i++){
		//alert();
		get_var = inputan[i].split(".");
		pars_param = pars_param + get_var[1] + "=" + eval("document."+ inputan[i] + ".value") + "&";
	}
	pars_param = pars_param + optional;
	//alert(pars_param);
	//alert(addr);
	request.open('post', addr);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = output; 
	request.send(pars_param);
			
}

function output(){
	if(request.readyState == 1){
		//You can add animated gif while loading // 
		document.getElementById('process').innerHTML = "<img width=400 height=400 src='../loading.gif''>";
	}
	if(request.readyState == 4){
		var data = request.responseText;
		document.getElementById('output').innerHTML = data;
		document.getElementById('process').innerHTML = "";
	}
}
function _selsubmit(frm,addr,pars_var){
	addr = addr + '&'+ pars_var +'=' + eval("document."+ frm + ".value");
	get_method(addr);
}
//The difference between POST and GET, POST method support or can transffer large data... 

function _goto(addr){
	//addr_to = addr + '&page='+ document.frmpage.selpage.options[document.frmpage.selpage.selectedIndex].value;
	var select = document.getElementsByName('selpage')[0];
	//alert(select.options[select.selectedIndex].value);	
	//alert(selpage);
	addr_to = addr + '&page='+ select.options[select.selectedIndex].value;
	//alert(addr_to);
	get_method(addr_to);
}

function printdiv(printpage)
{
	var headstr = "<html><head><title></title></head><body>";
	var footstr = "</body>";
	var newstr = document.all.item(printpage).innerHTML;
	var oldstr = document.body.innerHTML;
	document.body.innerHTML = headstr+newstr+footstr;
	window.print();
	document.body.innerHTML = oldstr;
	return false;
}
function check_spec_char(object_value,spec_char)
{
	if (object_value.length == 0)	
		return true;
	
	if (spec_char == null)
		return false;
			
    if (spec_char.length == 0)
		spec_char = '~`/-!$#%^&*()+={}[]|\\:;"\'<,>?';
						
	var check;				
	for (var i = 0; i < object_value.length; i++)
	{
		check = spec_char.indexOf(object_value.charAt(i));
		if (check > 0)
			return false;
		else if (check == 0) 
			return false;
	}	
	
	return true;
}

function _pilih(x,y)
{
	var url = document.referrer;
	// alert(url)
	//var formNames = opener.document.getElementById("form").attributes["name"].value;
	var pop_url = document.location.href; 
	var str = y.split("|");
	//alert('<? echo uriParam("fname");?>');
	// opener.document.newfrmchild.id_barang.value="1234";
	opener.document.<?=uriParam("fname")?>.value=x;
	opener.document.<?=uriParam("fname")?>_2.value=y;

	// alert(document.referrer);
	window.close();
}
</script>
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
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
 <div id="process"></div>
<body class="page-header-fixed" id="output">

	<form action="" method="post" name="updateform" enctype="multipart/form-data" id="updateform" class="form-horizontal">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		   <div class="portlet box light-green">
		      <div class="portlet-title">
		  <?
			//No. of Row
			$page_row = 10;
			$admin=cmsDB();
			if(isset($_GET["paging"])){
				$paging= $_GET["paging"];
			}else{
				$paging=1;
			}
			if($paging==1){
				$start_row = 0;
			}else{
				$start_row = ($paging * $page_row)-$page_row;
			}
			$no=$start_row+1;
			
			//Sorting & Ordering
			if(isset($_GET["orderby"])){
				$orderby = "order by " .$_GET["orderby"];
			}else{
				$orderby = "order by insert_date desc";
			}
			if(isset($_GET["sortby"])){
				$sortby = $_GET["sortby"];
			}else{
				$sortby = "";
			}
			$ordersort = $orderby . " " . $sortby;
			
			//Searching
			
			
			if(isset($_POST["search"])){
				if(strlen($search_field)){
					if(isset($_POST["txtsearch"])){
						$search_word = "  and (";
						for($i=1;$i<=listLen($search_field);$i++){
							if($i==1){
								$search_word = $search_word . listGetAt($search_field,$i) ." like '%".postParamSimple("txtsearch")."%'"; 
							}else{
								$search_word = $search_word . " or " . listGetAt($search_field,$i) ." like '%".postParamSimple("txtsearch")."%'"; 
							}
						}
						$search_word = $search_word . ")";
					}
				}else{
					$search_word = "";
				}
				$keyword = $_POST["txtsearch"];
			}elseif(isset($_GET["search"])){
				if(strlen($search_field)){
					if(isset($_GET["txtsearch"])){
						$search_word = "  and (";
						for($i=1;$i<=listLen($search_field);$i++){
							if($i==1){
								$search_word = $search_word . listGetAt($search_field,$i) ." like '%".uriParam("txtsearch")."%'"; 
							}else{
								$search_word = $search_word . " or " . listGetAt($search_field,$i) ." like '%".uriParam("txtsearch")."%'"; 
							}
							
						}
						$search_word = $search_word . ")";
					}
					
				}else{
					$search_word = "";
				}
				$keyword = $_GET["txtsearch"];
			}else{
				$search_word ="";
			}
			//echo "Search : ". $search_word;
			if(strlen($search_word)){
				if(strlen($main_query)){
					if(ListValueCount(strtolower($main_query),"where"," ") >=  1){
						if(strlen(trim($search_word))){
							$admin->query($main_query." ".$search_word);
							//$search_word = " " . $search_word;
						}
						
					}else{
						if(strlen(trim($search_word))){
							$admin->query($main_query." where 1 ".$search_word);
							//echo "query : " . $main_query." where 1 ".$search_word;
							//$search_word = " where 1 " . $search_word;
						}
					}
					
					$no_record = $admin->recordCount();
				}else{
					$admin->query("select count(*) as no_record from ".$nama_table."  where 1 ".$search_word);
					$admin->next();
					$no_record = $admin->row("no_record");
				}
			}else{
				
				if(strlen($main_query)){
					$admin->query($main_query ." order by ".$primary_id." asc");
					$no_record = $admin->recordCount();
				}else{
					$admin->query("select count(*) as no_record from ".$nama_table);
					$admin->next();
					$no_record = $admin->row("no_record");
				}
			}
			
			//$no_record = $admin->recordCount();
			$no_page = ceil($no_record/$page_row);
			//echo $no_page . "--" . $no_record;die();
			
			$strsql = $main_query;
			if(ListValueCount(strtolower($strsql),"where"," ") >= 1){
				if(strlen(trim($search_word))){
					$search_word = " " . $search_word;
				}
				
			}else{
				if(strlen(trim($search_word))){
					$search_word = " where 1 " . $search_word;
				}
			}
			//echo "search : " . $search_word;
			if(strlen(trim($search_word))){
				$strsql = $strsql .  $search_word;
			}
			$strsql = $strsql . " order by " . $primary_id ." asc limit ".$start_row.",".$page_row;
			$admin->query($strsql);
			//echo $strsql;

		 ?>

		 <form action="" method="post" name="search_form" id="search_form">
			  <div style="text-align:right">
				  Search <input name="txtsearch" class="btn default" type="text" size="20" style="font-size: 14px;font-weight: normal;color: #333333;  background-color: #ffffff;border: 1px solid #e5e5e5;border-radius: 0; width: 200px;" placeholder="Enter text"> 
				  <? if (isset($_GET['prop_id'])): ?>
				  	  <button type="button" class="btn default" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>?q=<?=uriParam("q")?>&fname=<?=uriParam("fname")?>&prop_id=<?=uriParam('prop_id')?>','updateform.txtsearch','search=yes&refresh=<?=md5("mdYHis")?>')" >Search</button>
				  <? else: ?>
				  	  <button type="button" class="btn default" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>?q=<?=uriParam("q")?>&fname=<?=uriParam("fname")?>','updateform.txtsearch','search=yes&refresh=<?=md5("mdYHis")?>')" >Search</button>
				  <? endif; ?>
						 
			  </div>
		  </form>
		  <div class="table-scrollable">
		        <table class="table table-striped table-bordered table-hover" id="sample_1">
		             <thead>
				<tr>
				<td align=center>[x]</td>
                  			<td align=center>No</td>
				  <!---$record_show = "judul_hutan|Judul Hutan|center|sort_on,keterangan|Keterangan Hutan|left|sort_off"-->
				  <?for($field=1;$field<=listLen($header_name);$field++){?>
						 <td align="center">
							 <?=listGetAt($header_name,$field)?>
						  </td>
				  <?}?>
		  		 </tr>
		   </thead>
		            <tbody>
			<?
			//$no=1;
			while($admin->next()){
				?>
		        <tr class="odd gradeX">
			      <td align=right><font size=-2>
			      	
					<a href="javascript:_pilih('<?=$admin->row($primary_id)?>','<?=$admin->row($primary_text)?>')"> [ Pilih ] </a>
				  </font></td>
		                  <td align=right><font size=-2><?=$no;?>.</font></td>
				   <?for($field=1;$field<=listLen($record_show);$field++){
					  	 $row_fname = listGetAt($record_show,$field);

					if($row_fname=="kabupaten_id"){
						$kabupaten_id->query("select kabupaten_nama as name from ref_kabupaten where kabupaten_id = '".$admin->row($row_fname)."'");
						$kabupaten_id->next();
				?>
				<td  align="center"><font size=-2><?=$kabupaten_id->row("name")?></font></td>
				<?
					}else{
				?>
				  	<td  align="center"><font size=-2><?=$admin->row($row_fname)?></font></td>

				  <?}
				}?>
			  </tr>
			  <?
			  $no++;
			  }?>
		               
		            </tbody>
		         </table>
			</div>
			<!-- Paging-->
			   <form name=frmpage>
			   <div style="text-align:right;color: black">
			   Page : 
			   <? if (isset($_GET['prop_id'])): ?>
			   		<select name="groupname" onchange="get_method('<?=$_SERVER["SCRIPT_NAME"]?>?q=<?=uriParam("q")?>&fname=<?=uriParam("fname")?>&prop_id=<?=uriParam('prop_id')?>&search=yes&txtsearch=<?=$keyword?>&paging='+ document.frmpage.groupname.value +'&ref=<?=md5(date("mdyHis"))?>')" style="font-size: 14px;font-weight: normal;color: #333333;  background-color: #ffffff;border: 1px solid #e5e5e5;border-radius: 0; width: 50px;">
			   <? else: ?>
			   		<select name="groupname" onchange="get_method('<?=$_SERVER["SCRIPT_NAME"]?>?q=<?=uriParam("q")?>&fname=<?=uriParam("fname")?>&search=yes&txtsearch=<?=$keyword?>&paging='+ document.frmpage.groupname.value +'&ref=<?=md5(date("mdyHis"))?>')"  style="font-size: 14px;font-weight: normal;color: #333333;  background-color: #ffffff;border: 1px solid #e5e5e5;border-radius: 0; width: 50px;">
			   <? endif; ?>
			   
					<?for($i=1;$i<=$no_page;$i++){ ?>
						<option value="<?=$i?>" <?if($paging==$i){ echo " selected";}?>><?=$i?></option>
					<?}?>
			   </select> of <B><?=$no_page?></B> Page(s) from <B><?=$no_record?></B> Record(s)
			   </div>
			   </form>
			   <!-- End of Paging-->
		      </div>
		   </div> 
		   
			
		   <!-- END EXAMPLE TABLE PORTLET-->
		</div>
		</div>
		<!-- END PAGE CONTENT-->
		
	</form>
	
      <!-- END PAGE -->    
	  
</body>
<!-- END BODY -->
</html>