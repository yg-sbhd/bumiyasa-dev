<?php
require_once "../config.php";
require_once __DIR__ . '/mpdf/vendor/autoload.php';

// $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);
// echo  __DIR__ . '/custom/font/directory';die();
function printPdf($logo, $header, $sub_header, $html, $footer_name){
global $_SESSION,$ANOM_VARS,$CMS_VARS,$_GET,$_POST;

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

// print_r($defaultConfig);

// print_r($defaultFontConfig);
// die();


$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/custom/font',
    ]),
    'fontdata' => $fontData + [
        'fontawesome' => [
            // 'R' => 'fa-solid-900.ttf',
            'R' => 'fa-regular-400.ttf',
        ]
    ],
    // 'default_font' => 'frutiger'
]);

ob_start();
// include "../../config-pdf.php";
include "../".$html; 
$template = ob_get_contents();
ob_end_clean();

        $html_txt ="
        <table cellspacing=\"2\" cellpadding=\"1\" align=\"left\" width=\"100%\">
        	<tr>
        		<td rowspan=\"2\" align=\"left\" width=\"70\"> <img width=\"60\" src=".$logo." /></td>
        		<td valign=\"middle\" align=\"left\" style=\"font-size:20px;\"><b>".$header."</b></td>
        	</tr>
        	<tr>
        		<td valign=\"middle\" align=\"left\">".$sub_header."</td>
        	</tr>
        </table>
        ";

$mpdf->SetHTMLHeader($html_txt, 'O', false);
$mpdf->setFooter($footer_name.'||{PAGENO} of {nbpg}');

$mpdf->AddPage('', // L - landscape, P - portrait 
        '', '', '', '',
        10, // margin_left
        10, // margin right
       35, // margin top
       30, // margin bottom
        10, // margin header
        5); // margin footer
$mpdf->WriteHTML($template);



$mpdf->Output();

}

if (isset($_GET['print']) && $_GET['print'] == 'yes') {
	# code...
	$logo = $_POST['logo'];
	$header = $_POST['header'];
	$sub_header = $_POST['sub_header'];
	$html = $_POST['html'];
	$footer_name = $_POST['footer_name'];

	// echo $logo . "<p>";
	// echo $header . "<p>";
	// echo $sub_header . "<p>";
	// echo $html . "<p>";
	// echo $footer_name . "<p>";



	printPdf($logo, $header, $sub_header, $html, $footer_name);
}
