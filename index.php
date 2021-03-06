<?

require_once("config.php");

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

    <title>Dashboard - BUMIYASA</title>

    <!-- Google font-->

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">

    <!-- Font Awesome-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/fontawesome.css">

    <!-- ico-font-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/icofont.css">

    <!-- Themify icon-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/themify.css">

    <!-- Flag icon-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/flag-icon.css">

    <!-- Feather icon-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/feather-icon.css">

    <!-- Plugins css start-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/animate.css">

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/chartist.css">

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/date-picker.css">

    <!-- Plugins css Ends-->

    <!-- Bootstrap css-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/bootstrap.css">

    <!-- App css-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/style.css">

    <link id="color" rel="stylesheet" href="<?=$base_www?>/assets/css/color-1.css" media="screen">

    <!-- Responsive css-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/responsive.css">



      <!-- latest jquery-->

  <script src="<?=$base_www?>/assets/js/jquery-3.5.1.min.js"></script>

    <!-- HIGHCHART   -->

 

 <script src="<?=$base_www?>/assets/js/highchart/code/highcharts.js"></script>

<script src="<?=$base_www?>/assets/js/highchart/code/modules/vector.js"></script>

<script src="<?=$base_www?>/assets/js/highchart/code/modules/exporting.js"></script>



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

    document.getElementById('process').innerHTML = "<img width=400 height=400 src='loading.gif''>";

  }

  if(request.readyState == 4){

    var data = request.responseText;

    // console.log()

  console.log("data =", data);



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

function _chk(frm){

  $val=eval(frm+'.checked');

  if($val==true){

    eval(frm + "_txt.value='1';");

  }else{

    eval(frm + "_txt.value='0';");

  }

  

}

</script>

<script language="javascript">

function CloseLoading(){

  //alert('test');

  //document.getElementById('loading').visibility = 'hidden';

  // $("#loading").hide();

  $("#process").hide();

  }

  </script>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->



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

  </head>

  <!-- <body onload="startTime()"> -->

  <body onload="CloseLoading();">



  <div id="process"></div>



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

    <div class="page-wrapper compact-wrapper" id="pageWrapper">

      <?include_once 'includes/index/header.php';?>

    </div>

    <!-- Page Header Ends                              -->

    <!-- Page Body Start-->

    <div class="page-body-wrapper sidebar-icon">

      <!-- Page Sidebar Start-->

      <?include_once 'includes/index/sidebar.php';?>

      

      <!-- Page Sidebar Ends-->

      <div class="page-body">

      <?include_once 'includes/index/sidebar.php';?>

      

      <?include_once 'includes/index/index_main.php';?>



      </div>

      <!-- Container-fluid starts-->

      

        <!-- Container-fluid Ends-->

      <!-- footer start-->

      <footer class="footer">

        <div class="container-fluid">

          <div class="row">

            <div class="col-md-6 footer-copyright">

              <p class="mb-0">Copyright 2021 ?? PT BUMIYASA.</p>

            </div>

            <div class="col-md-6">

              <p class="pull-right mb-0">Hand crafted & made with <i class="fa fa-heart font-secondary"></i></p>

            </div>

          </div>

        </div>

      </footer>

    </div>

  </div>





  <!-- Bootstrap js-->

  <script src="<?=$base_www?>/assets/js/bootstrap/popper.min.js"></script>

  <script src="<?=$base_www?>/assets/js/bootstrap/bootstrap.js"></script>

  <!-- feather icon js-->

  <script src="<?=$base_www?>/assets/js/icons/feather-icon/feather.min.js"></script>

  <script src="<?=$base_www?>/assets/js/icons/feather-icon/feather-icon.js"></script>

  <!-- Sidebar jquery-->

  <script src="<?=$base_www?>/assets/js/sidebar-menu.js"></script>

  <script src="<?=$base_www?>/assets/js/config.js"></script>

  <!-- Plugins JS start-->

  <!-- Plugins JS Ends-->



  <!-- Theme js-->

  <script src="<?=$base_www?>/assets/js/script.js"></script>

  <!-- <script src="<?=$base_www?>/assets/js/theme-customizer/customizer.js"></script> -->

  <!-- login js-->

  <!-- Plugin used-->

</body>

</html>