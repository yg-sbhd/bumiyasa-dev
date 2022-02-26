<?php
$show_site=cmsDB();
$qry = "select * from master_group_location where group_location_id=2";

$show_site->query($qry);

$show_site->next();
?>
<style>
            table.table-bordered{
                border:1px solid #000;
                table-layout: auto;
                width:100%;
            }
            table.table-bordered > thead > tr > th{
                border:1px solid #000;
                text-align: center;
                font-size:12px;
            }
            table.table-bordered > thead > tr > td{
                border:1px solid #000;
                text-align: center;
                font-size:12px;
            }
            table.table-bordered.table-head > tbody > tr > td{
                border:2px solid #000;
            }
            table.table-bordered > tbody > tr > td{
                border:1px solid #000;
                word-break:break-all;
                font-size:12px;
            }
        </style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="border: 1px dotted #000;">
            <div class="row">
                <table class="table table-bordered table-head">
                    <tr>
                        <td rowspan="2" width="150px" align="center">
                        <img src="<?=$ANOM_VARS["www_file_url"]?>upload_files/<?=$show_site->row('image')?>">
                        </td>
                        <td style="background-color: #1f497d; color: white; text-align:center;"><h5><b><i>Record</i></b></h5></td>
                    </tr>
                    <tr>
                        <td><h3 class="text-center"><b>Pertanggung Jawaban KAS Kecil</b></h3></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Nomor PJPD</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>00/LPJKK/mm/site/tahun</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>…..............................</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Kepada</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>Financial Officer</td>
                        </tr>
                        <tr>
                            <td>Dari</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>Departemen / PLTM …....................................</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>LPJ Kas Kecil</td>
                        </tr>
                    </table>
                </div>
                <br>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <p style="font-size: 12px; margin:auto !important;"><b>A. PELAKSANAAN KEGIATAN</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td width="5%";>NO</td>
                                    <td width="35%";>Uraian Biaya</td>
                                    <td width="5%";>Qty</td>
                                    <td width="5%";>Unit</td>
                                    <td width="10%";>No. Bukti</td>
                                    <td width="20%";>Harga Satuan</td>
                                    <td width="20%";>Jumlah Biaya</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><b>TRANSPORTASI</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;&nbsp;Biaya Transportasi (Sewa Mobil/kend. Umum)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;&nbsp;Biaya BBM</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;&nbsp;Biaya Tol</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;&nbsp;.........</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><b>PENGINAPAN</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;&nbsp;Biaya Penginapan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><b>KONSUMSI / ALLOWANCE</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;&nbsp;.........</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;&nbsp;.........</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><b>LAIN - LAIN</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;&nbsp;.........</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp   -</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;" colspan="6">Total Biaya</td>
                                        <td>Rp   -</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <p><i>Dengan Huruf &nbsp;:&nbsp;&nbsp;  Satu Juta Dua Ratus Tujuh Puluh Lima Ribu Rupiah</i></u></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p style="font-size: 12px; margin:auto !important; padding-bottom:5px;"><b>B. PERTANGGUNG JAWABAN</b></p>
                    <div class="container">
                        <table style="font-size: 12px;">
                            <tr>
                                <td>Dana Diterima</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td>Rp            -</td>
                            </tr>
                            <tr>
                                <td>Dana Pengeluaran</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td>Rp            -</td>
                            </tr>
                            <tr>
                                <td>Sisa Dana</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td>Rp            -</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <br>

            <div class="row">
                <div class="col-md-12" style="background-color:#d8d8d8;font-weight:bold;border:1px solid #000;">
                    <p class="text-center" style="margin-top:10px;">Persetujuan</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="background-color:#d8d8d8;border:1px solid #000;min-height: 120px !important;">
                <div class="row">
                    <div class="col-md-3" style="border:1px solid #000; min-height: 120px !important;">
                        <p class="text-center" style="margin-top:10px;">Dibuat Oleh</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">NAMA</p>
                        <p class="text-center" style="position:absolute; top:80%; left: 0; right:0;">Jabatan </p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 120px !important;">
                        <p class="text-center" style="margin-top:10px;">Diketahui</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">EGAR ADISTIRA</p>
                        <p class="text-center" style="position:absolute; top:80%; left: 0; right:0;">OPS Manager</p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 120px !important;">
                        <p class="text-center" style="margin-top:10px;">Disetujui</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">IRAWAN HARI P</p>
                        <p class="text-center" style="position:absolute; top:80%; left: 0; right:0;">OPS Director</p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 120px !important;">
                        <p class="text-left" style="margin-top:10px;word-wrap:break-word;">Catatan : </p>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="background-color:#d8d8d8;border:1px solid #000;min-height: 120px !important;">
                    <p style="margin:5px 5px 0px 0px;word-wrap:break-word;">Verifikasi : </p>
                </div>
            </div>
        </div>
    </div>
    
</div>