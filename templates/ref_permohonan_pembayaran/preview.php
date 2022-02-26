<?php
$show_site=cmsDB();
$qry = "select * from master_group_location where group_location_id=2";

$show_site->query($qry);

$show_site->next();
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="border: 1px dotted #000;">
            <div class="row">
                <div class="col-md-3">
                    <img src="<?=$ANOM_VARS["www_file_url"]?>upload_files/<?=$show_site->row('image')?>">
                </div>
                <div class="col-md-9">
                    <h3><b><?=$show_site->row("group_name")?></b></h3>
                    <?=$show_site->row("group_address")?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center"><b><u>Permohonan Pembayaran</u></b></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Nomor</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>099/BIE/04/10/2021</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>04 Oktober 2021</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>Jasa Konsultasi perndampingan Teknis</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Pemohon</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>Devilia Anggraini</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="col-md-12">
                    <table style="font-size: 12px;">
                        <p style="font-size: 12px;">Berdasarkan Surat Perintah / Memo / lainnya : Permohonan Pembayaran</p>
                        <tr>
                            <td>Nomor</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>009/WCN-BIE/IX/2021</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>27 September 2021</td>
                        </tr>
                    </table>
                    <hr style="display: block;margin-top: 0.5em;margin-bottom: 0.5em;margin-left: auto;margin-right: auto; height:1px; background: #000;">
                </div>
                <div class="col-md-12">
                    <table style="font-size: 12px;">
                        <tr>
                            <td colspan="2">Dibayarkan Kepada</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>PT. Wecon</td>
                        </tr>
                        <tr>
                            <td>Nomor Rekening</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>Mandiri - No. Rek. 141.0013612668</td>
                        </tr>
                    </table>
                    <br>
                    <table style="font-size: 12px;">
                        <tr>
                            <td>Currency</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>IDR </td>
                            <td>/</td>
                            <td>  USD</td>
                        </tr>
                        <tr>
                            <td>Nilai Pembayaran</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td><b>Rp 115720000</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Terbilang</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td colspan="3">Seratus lima belas juta tujuh ratus dua puluh ribu rupiah</td>
                        </tr>
                    </table>
                </div>
                <br>
                <br>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <p style="font-size: 12px; margin:auto !important;"><b>Approval</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-3" style="border:1px solid #000; min-height: 200px !important;">
                        <p class="text-center" style="margin-top:10px;">Pemohon</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">Devilia Anggraini</p>
                        <p class="text-left" style="margin-left:15px;position:absolute;font-weight:bold; top:80%; left: 0; right:0;">Tgl : 04 Okt 2021</p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 200px !important;">
                        <p class="text-center" style="margin-top:10px;">Manager Fin & Acct</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">Harmawan</p>
                        <p class="text-left" style="margin-left:15px;position:absolute;font-weight:bold; top:80%; left: 0; right:0;">Tgl : 04 Okt 2021</p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 200px !important;">
                        <p class="text-center" style="margin-top:10px;">Direktur Keuangan</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">Iqror Nuso Bhekti</p>
                        <p class="text-left" style="margin-left:15px;position:absolute;font-weight:bold; top:80%; left: 0; right:0;">Tgl :</p>
                    </div>
                    <div class="col-md-3" style="border:1px solid #000;min-height: 200px !important;">
                        <p class="text-center" style="margin-top:10px;">Direktur Utama</p>
                        <p class="text-center" style="position:absolute; top:65%; left: 0; right:0;font-weight:bold;">Taufan Wijaya</p>
                        <p class="text-left" style="margin-left:15px;position:absolute;font-weight:bold; top:80%; left: 0; right:0;">Tgl :</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="border:1px solid #000;min-height: 220px !important;">
                <p style="margin:5px 0px;word-wrap:break-word;"><b>Catatan : </b>Permohonan Pembayaran, Kwitansi, Faktur Pajak, Absensi & Perhitungan Invoice Technical Assistance, terlampir</p>
            </div>
        </div>
    </div>
    
</div>