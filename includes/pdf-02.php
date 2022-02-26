<?php
require_once('tcpdf/tcpdf.php');
// echo "string";
class MYPDF extends TCPDF {
    //Page header
     public function setCompany($var){
        $this->company = $var;
    }

    public function setLogo($var){
    	$this->logo = $var;
    }

    public function setHeader_($var){
    	$this->header_ = $var;
    }

    public function setSubHeader_($var){
    	$this->subHeader_ = $var;
    }

    public function setfooter_($var){
    	$this->footer_ = $var;
    }

    public function Header() {
        // Logo
        // $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $image_file = $this->logo;
        // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, 'C');
        // Set font
        // $this->SetFont('helvetica', 'B', 14);
        // Title
     
        // $this/->Cell(0, 18, $this->header_, 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // $this->SetFont('helvetica', 'B', 12);

        // $this->Cell(0, 20, $this->subHeader_, 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $file_gambar = "<img src=\"".$image_file."\" width=\"100px\" />";
        $html_txt ="
      

        <table cellspacing=\"2\" cellpadding=\"1\" align=\"left\" width=\"900px\">
        	<tr>
        		<td rowspan=\"2\" align=\"left\" width=\"70\">".$file_gambar."</td>
        		<td valign=\"middle\" align=\"left\" style=\"font-size:20px;\"><b>".$this->header_."</b></td>
        	</tr>
        	<tr>
        		<td valign=\"middle\" align=\"left\">".$this->subHeader_ ."</td>
        	</tr>
        </table>
        ";
        $this->writeHTML($html_txt, true, true, false, false, '');


    }
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    	$this->Cell(0, 10, $this->company, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
function printPdf($logo, $header, $sub_header, $html, $footer_name){
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 003');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
	}

	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('helvetica', '', 10);

	// add a page
	// $pdf->CustomHeaderText = "Header Page 1";
	// $pdf->setCompany($header);
	$pdf->setHeader_($header);
	$pdf->setSubHeader_($sub_header);


	$pdf->setLogo($logo);

	$pdf->AddPage();

	// set some text to print
	$txt = file_get_contents("http://localhost/bumiyasa-dev/index-print.php?print=templates/ref_lkpb/preview-print.php&lkpb_id=Mg==");

	// print a block of text using Write()
	$txt = utf8_decode($txt);
	$pdf->writeHTML($txt, true, false, true, false, '');
	// $pdf->Image('@' ,);

	//Close and output PDF document

$pdf->Output('example_003.pdf', 'I');
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