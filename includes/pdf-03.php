    <?php
    // define('FPDF_FONTPATH','fpdf17/font/');
    require('fpdf/fpdf.php');
     
    class PDF extends FPDF
    {   
        public function setLogo($var){
            $this->logo = $var;
        }

        public function setHeader_($var){
            $this->header_ = $var;
        }

        public function setSubHeader_($var){
            $this->subHeader_ = $var;
        }
        //Page header
        function Header()
        {
            //Logo
            $this->Image($this->logo,10,10,15);
            //Arial bold 15
            $this->SetFont('Arial','B',14);
            //pindah ke posisi ke tengah untuk membuat judul
            $this->Cell(15);
            //judul
            $this->Cell(0,8,$this->header_,0,2,'');
            //pindah baris
            // $this->Ln(20);

            $this->SetFont('Arial','',10);
            // $this->Cell(12);

            $this->MultiCell(0,5,$this->subHeader_,0,'L');

            //buat garis horisontal
            // $this->Line(10,25,200,25);
        }
     
        //Page Content
        function Content()
        {   
            $this->SetFont('Arial','BU',14);
            // $this->Cell(0);
            $this->setY(25);

            $this->Cell(0,20,"Laporan Kejadian Potensi Bahaya",0,1,'C');
            $this->SetFont('Arial','',10);
            // $this->Cell(1);

            $this->setY(40);
            $this->Cell(30,6,"LKPB No",0,0,'L');
            $this->Cell(2,6,":",0,0,'L');
            $this->Cell(50,6,"00/00/00",0,1,'L');

            $this->Cell(30,6,"Tanggal",0,0,'L');
            $this->Cell(2,6,":",0,0,'L');
            $this->Cell(50,6,"00/00/00",0,1,'L');

            $this->Cell(30,6,"Dept / Lokasi",0,0,'L');
            $this->Cell(2,6,":",0,0,'L');
            $this->Cell(50,6,"00/00/00",0,1,'L');

            $this->Cell(30,6,"Jam Terjadi",0,0,'L');
            $this->Cell(2,6,":",0,0,'L');
            $this->Cell(50,6,"00/00/00",0,0,'L');
        
            $this->setXY(120, 40);

            $this->Cell(20,6,"tes1",0,0,'L');
            $this->Cell(0,6,"00/00/00",0,1,'L');
            $this->setX(120);

            $this->Cell(20,6,"tes2",0,0,'L');
            $this->Cell(0,6,"00/00/00",0,1,'L');
            $this->setX(120);
            
            $this->Cell(20,6,"tes3",0,0,'L');
            $this->Cell(0,6,"00/00/00",0,0,'L');

            $this->setY(70);
            $this->Cell(150,10,"Uraian Terjadinya potensi bahaya dan atau insiden",1,0,'L');
            $this->Cell(40,10,"Kepala Unit",1,1,'C');




            // $this->SetFont('Times','',12);
            // for($i=1; $i<=40; $i++)
            //     $this->Cell(0,10,'Laporan Mahasiswa '.$i,0,1);
        }
     
        //Page footer
        function Footer()
        {
            //atur posisi 1.5 cm dari bawah
            $this->SetY(-15);
            //buat garis horizontal
            // $this->Line(10,$this->GetY(),200,$this->GetY());
            //Arial italic 9
            $this->SetFont('Arial','I',9);
            //nomor halaman
            $this->Cell(0,10,'Page ' . $this->PageNo(),0,0,'R');
        }
    }
     
function printPdf($logo, $header, $sub_header, $html, $footer_name){

    //contoh pemanggilan class
    $pdf = new PDF('p','mm','A4');
    $pdf->AliasNbPages();
    $pdf->setHeader_($header);
    $pdf->setSubHeader_($sub_header);
    $pdf->setLogo($logo);
    $pdf->AddPage();
    $pdf->Content();
    $pdf->Output();
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
    ?>