<?php
$show_site=cmsDB();
$qry = "select * from master_group_location where group_location_id=2";

$show_site->query($qry);

$show_site->next();
?>
<style>
            table.table-bordered{
                border:1px solid #000;
                table-layout:auto;
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
            
            table tbody>tr>td{
                border-top: none !important;
                word-break:break-all;
                
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
                        <td><h3 class="text-center"><b>Perhitungan Jam Lembur</b></h3></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Nomor PI</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>00/PJL/mm/site/tahun</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-5">
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Nomor LKPB</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>00/PPL/mm/site/tahun</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
                
            <div class="row">
                <div class="col-md-6">
                    <p style="font-size: 12px; margin:auto !important;"><b>A. RENCANA KEGIATAN</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <table style="font-size: 12px;">
                            <tr>
                                <td>Hari</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Uraian Kegiatan</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-6">
                    <p style="font-size: 12px; margin:auto !important;"><b>B. RENCANA KEGIATAN</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;" width="7%";>NO</td>
                                    <td style="text-align: center; vertical-align: middle;" width="28%";>Nama</td>
                                    <td style="text-align: center; vertical-align: middle;" width="21%";>Tanggal Lembur</td>
                                    <td style="text-align: center; vertical-align: middle;" width="13%";>Jam Lembur</td>
                                    <td style="text-align: center; vertical-align: middle;" width="13%";>Total Jam Lembur </td>
                                    <td style="text-align: center; vertical-align: middle;" width="18%";>Total Biaya  Lemburan</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;" colspan="5"><b>Total Biaya</b></td>
                                        <td>Rp 1.275.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <table class="table table-bordered" style="background-color:#d8d8d8;">
                            <tr>
                                <td colspan="2" style="text-align: center;vertical-align: middle;">
                                    <b>Persetujuan</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;width:40%;">
                                    Dibuat Oleh
                                </td>
                                <td rowspan="2" style="text-align: left; vertical-align: top;word-wrap:break-word;width:60%;" >
                                   <p> Catatan : &nbsp;</p>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="position:relative;" height="100px;">
                                    <p class="text-center" style="position:absolute;top:65%; left: 0; right:0;font-weight:bold;"><b>EKA DHARMA</b></p>
                                    <p class="text-center" style="position:absolute;top:80%; left: 0; right:0;"><b>HRD Manager</b></p></td>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    
</div>