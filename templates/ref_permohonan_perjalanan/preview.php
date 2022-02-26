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
                        <td><h3 class="text-center"><b>Permohonan Perjalanan Dinas</b></h3></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                    <div class="col-md-8">
                        <table style="font-size: 12px;">
                            <tr>
                                <td>Kepada</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td>Financial Officer</td>
                            </tr>
                            <tr>
                                <td>Dari</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td>Departemen Operasional</td>
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td>Permohonan Perjalanan Dinas</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table style="font-size: 12px;">
                            <tr>
                                <td>Nomor PD</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td>…../PD/…../……....../….....</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
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
                            <td>Waktu</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>30 November s/d 4 Desember 2020</td>
                        </tr>
                        <tr>
                            <td>Lokasi Tujuan</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>PLTM Cijampang, PLN Rayon, PLN Area dan PLN Distribusi Jawa Barat</td>
                        </tr>
                        <tr>
                            <td>Kegiatan</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>Pembuatan Berita Acara Tagihan Bulan November</td>
                        </tr>
                    </table>
                </div>
                <br>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <p style="font-size: 12px; margin:auto !important;"><b>A. RENCANA KEGIATAN</b></p>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;" width="30%";>Hari, Tanggal</th>
                                        <th style="text-align: center; vertical-align: middle;" width="70%";>Uraian Kegiatan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Senin, 30/11/2020</td>
                                            <td>1. Perjalanan menuju lokasi PLTM Cijampang</td>
                                        </tr>
                                        <tr>
                                            <td>Selasa, 1/12/2020</td>
                                            <td>1. Pembacaan kWh Meter bersama PLN</td>
                                        </tr>
                                        <tr>
                                            <td>Rabu, 2/12/2020</td>
                                            <td>1. Pembuatan Berita Acara di PLN Rayon dan PLN Area</td>
                                        </tr>
                                        <tr>
                                            <td>Kamis, 3/12/2020</td>
                                            <td>1. Pembuatan Berita Acara di PLN Rayon dan PLN Area</td>
                                        </tr>
                                        <tr>
                                            <td>Jumat, 4/12/2020</td>
                                            <td>1. Pembuatan Berita Acara Tagihan Bulan November</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p style="font-size: 12px; margin:auto !important;"><b>B. RENCANA KEGIATAN</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;" width="5%";>NO</td>
                                    <td style="text-align: center; vertical-align: middle;" width="45%";>Uraian Kegiatan</td>
                                    <td style="text-align: center; vertical-align: middle;" width="7%";>Qty</td>
                                    <td style="text-align: center; vertical-align: middle;" width="7%";>Unit</td>
                                    <td style="text-align: center; vertical-align: middle;" width="18%";>Harga Satuan</td>
                                    <td style="text-align: center; vertical-align: middle;" width="18%";>Jumlah Biaya</td>
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
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;Biaya Transportasi (Travel Jakarta-Cianjur) PP</td>
                                        <td>2</td>
                                        <td>trip</td>
                                        <td>Rp 150.000</td>
                                        <td>Rp 300.000</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;Biaya Transportasi (Travel Cianjur-Cijampang)</td>
                                        <td>1</td>
                                        <td>trip</td>
                                        <td>Rp 100.000</td>
                                        <td>Rp 100.000</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><b>PENGINAPAN</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;Biaya Penginapan</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>Rp   -</td>
                                        <td>Rp   -</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><b>KONSUMSI / ALLOWANCE</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-&nbsp;Almitra Batran</td>
                                        <td>5</td>
                                        <td>hari</td>
                                        <td>Rp 175.000</td>
                                        <td>Rp 875.000</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><b>LAIN - LAIN</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>Rp   -</td>
                                        <td>Rp   -</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;" colspan="5">Total Biaya</td>
                                        <td>Rp 1.275.000</td>
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
                    <div class="col-md-3" style="border:1px solid #000; min-height: 200px !important;">
                        <p class="text-center" style="margin-top:10px;">Pemohon</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">ALMITRA BATRAN</p>
                        <p class="text-center" style="position:absolute; top:80%; left: 0; right:0;">Staff Operasional </p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 200px !important;">
                        <p class="text-center" style="margin-top:10px;">Diketahui</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">EGAR ADISTIRA</p>
                        <p class="text-center" style="position:absolute; top:80%; left: 0; right:0;">OPS Manager</p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 200px !important;">
                        <p class="text-center" style="margin-top:10px;">Disetujui</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">IRAWAN HARI P</p>
                        <p class="text-center" style="position:absolute; top:80%; left: 0; right:0;">OPS Director</p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 200px !important;">
                        <p class="text-left" style="margin-top:10px;word-wrap:break-word;">Catatan : </p>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="background-color:#d8d8d8;border:1px solid #000;min-height: 200px !important;">
                    <p style="margin:5px 5px 0px 0px;word-wrap:break-word;">Verifikasi : </p>
                </div>
            </div>
        </div>
    </div>
    
</div>