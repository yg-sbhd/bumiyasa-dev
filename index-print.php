<?

require_once("config-pdf.php");

?>

<!DOCTYPE html>

<html lang="en">

  <head>

    <meta http-equiv="Content-Type" content="application/pdf; charset=UTF-8">

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

    <link id="color" rel="stylesheet" href="<?=$base_www?>/assets/css/color-1.css" media="screen">

    <!-- Responsive css-->

    <link rel="stylesheet" type="text/css" href="<?=$base_www?>/assets/css/responsive.css">

     <!-- latest jquery-->
  <script src="<?=$base_www?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?=$base_www?>/assets/js/jquery.chained.remote.min.js"></script>

  <style type="text/css">
    table{
      border: 1px;
    }
    .icon-check {
  content: "\2713";
} 
  </style>
  </head>

  <!-- <body onload="startTime()"> -->

  <body>


       <?
        $tmp=uriParam("print");

       // echo $tmp."<BR>";

        try{

            include $tmp;

        } catch(Exception $e){;

          echo "invalid template variable";

          $e->getMessage();

        }


              

              ?>

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

  

</body>

</html>