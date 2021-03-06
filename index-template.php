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

    <title>BUMIYASA</title>

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



    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/datatables.css">

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
  <script src="<?=$base_www?>/assets/js/jquery.chained.remote.min.js"></script>


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

function printDiv(divId) {
        // console.log("tes");
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = `
          <html>
            <head>
              <title>LKPB</title>
              <style type="text/css">
               
                .A3.landscape { width: 420mm }
                .A3, .A4.landscape { width: 297mm }
                .A4, .A5.landscape { width: 210mm; }
                .A5                    { width: 148mm }
                .letter, .legal    { width: 216mm }
                .letter.landscape      { width: 280mm }
                .legal.landscape       { width: 357mm }

                hr {
                  display: block;
                  height: 1px;
                  background: transparent;
                  width: 100%;
                  border: none;
                  border-top: solid 1px rgb(0, 0, 0);
                }
                .border-table > thead > tr > th{
                  border:1px solid #000;
                  padding: 0px 5px;
                }
                .border-table > tbody > tr > th{
                  border:1px solid #000;
                  padding: 0px 5px;
                }
                .border-table > tbody > tr > td{
                  border:1px solid #000;
                  padding: 0px 5px;
                }
                ._container{
                  min-height:100px;width:auto;
                  display:flex;
                }
                ._container img {
                  max-width: 33%;
                  padding: 5px 5px;
                  display: inline-block;
                  margin-left: auto;
                  margin-right: auto;
                }
                @page {
                  size: auto; 
                  margin: 5mm;
                }
                body {
                  margin:0;
                  padding:0;
                }
                tr {
                    page-break-inside: avoid;
                }
                td {
                    page-break-inside: avoid;
                }
                table { page-break-inside:auto;}
                table > tbody > tr > td{
                  padding-right:5px;
                  
                }
                .rotated {
                  -ms-writing-mode: tb-rl;
                  -webkit-writing-mode: vertical-rl;
                  writing-mode: tb-rl !important;
                  -ms-transform:rotate(180deg);
                  -o-transform:rotate(180deg);
                  transform: rotate(180deg);
                }
                .bg-grey{
                  -webkit-print-color-adjust: exact;
                  background-color:#d8d8d8 !important;
                }
                .bg-head{
                  -webkit-print-color-adjust: exact;
                  background-color: #1f497d;
                  color: white;
                }
                

              </style>
            </head>
            <body>
            `+ printContents + `
            </body>
          </html>
          `;
        window.print();
        document.body.innerHTML = originalContents;
      }

      // logsheet
      function printContent(divId) {
        // console.log("tes");
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = `
          <html>
            <head>
              <style type="text/css">
                table{
                  border-collapse: collapse !important;
                }
                .table-bordered{
                    border:1px solid #000 !important;
                }
                .table-bordered > thead > tr > td{
                    border:1px solid #000 !important;
                }
                .table-bordered > tbody > tr > td{
                    border:1px solid #000 !important;
                    
                }
                tr td{
                  padding: 0 !important;
                  margin: 0 !important;
                }
                @page {
                  size: auto; 
                  margin: 5mm;
                }
                body {
                  margin:0;
                  padding:0;
                }
                

              </style>
            </head>
            <body>
            `+ printContents + `
            </body>
          </html>
          `;
        window.print();
        document.body.innerHTML = originalContents;
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

<!-- </head> -->

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

    @page { size: A4 }
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

      

       <?

       // echo "================".$_SERVER["SCRIPT_NAME"];

        $tmp=decryptStringArray(uriParam("tmp"));

       //echo $tmp."<BR>";

        try{

            include $tmp;

        } catch(Exception $e){;

          echo "invalid template variable";

          $e->getMessage();

        }

              

              ?>

      </div>

      <!-- Container-fluid starts-->

      

        <!-- Container-fluid Ends-->

      <!-- footer start-->

    </div>

      <footer class="footer">

        <div class="container-fluid">

          <div class="row">

            <div class="col-md-6 footer-copyright">

              <p class="mb-0">Copyright 2021 ?? PT BUMIYASA.</p>

            </div>

          </div>

        </div>

      </footer>

    </div>

  </div>

  <!-- latest jquery-->

  <!-- <script src="<?=$base_www?>/assets/js/jquery-3.5.1.min.js"></script> -->

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

  <script src="<?=$base_www?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>

  <script src="<?=$base_www?>/assets/js/datatable/datatables/datatable.custom.js"></script>

  <script src="<?=$base_www?>/assets/js/datepicker/date-picker/datepicker.js"></script>

  <!-- <script src="<?=$base_www?>/assets/js/datepicker/date-picker/datepicker.en.js"></script> -->

  <!-- <script src="<?=$base_www?>/assets/js/datepicker/date-picker/datepicker.custom.js"></script> -->



  <script src="<?=$base_www?>/assets/js/tooltip-init.js"></script>

  <!-- Plugins JS Ends-->



  <!-- Theme js-->

  <script src="<?=$base_www?>/assets/js/script.js"></script>

  <!-- <script src="<?=$base_www?>/assets/js/theme-customizer/customizer.js"></script> -->

  <!-- login js-->

  <!-- Plugin used-->

  <script type="text/javascript">

    $(function(){

           $('#datatable-http').DataTable({

              "processing": true,

              "serverSide": true,

              "ajax":{

                      "url": "<?=$base_www?>/includes/_generator/datatables_serverside.php?action=<?=$nama_table?>",

                       // "url": "ajax/ajax_kontak.php?action=table_data",

                       "dataType": "json",

                       "type": "POST",

                       "data":function(outData){

                           // what is being sent to the server

                           console.log(outData);

                           return outData;

                       },

                     },

              "columns": [

                <?for($field=1;$field<=listLen($record_show,"~");$field++){

                  $row_detail = listGetAt($record_show,$field,"~");

                  $row_field = listGetAt($row_detail,1,"|");?>

                    {"data": "<?=$row_field?>"},

                <?}?>



              ]  

          });

        });

    

  </script>

<script type='text/javascript'>
  jQuery(document).ready(function(){
    
    $('#pd_id').val(0).hide();
    $('#ppd_id').val(0).hide();
    
    $('input:radio[name="lpj_type_id"]').change(
      function(){
        if ($('#2').is(':checked') && $(this).val() == '2') {
            $('#pd_id').show();
            $('#ppd_id').val(0).hide();
        }else if ($('#3').is(':checked') && $(this).val() == '3') {
            $('#pd_id').val(0).hide();
            $('#ppd_id').show();
        }else{
            $('#pd_id').val(0).hide();
            $('#ppd_id').val(0).hide();
        }
      }
    )
  });
</script>

</body>

</html>