<?php

$show_site=cmsDB();
$show = cmsDB();

$id = decryptStringArray(uriParam('payment_request_id'));

$show_qry = "select * from ref_payment_request where payment_request_id=".$id;
$show->query($show_qry);
$show->next();

$qry = "select * from master_group_location where group_location_id=2";
$show_site->query($qry);
$show_site->next();

?>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form Payment Request</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Financial / Payment Request / Preview</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div style="overflow-x: auto;">
<div class="A4" id="printArea">
        <section class="sheet padding-10mm">
            <table class="w-100">
                <tr>
                    <td>
                        <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>">
                    </td>
                    <td class="p-3">
                        <h3><b><?=$show_site->row("group_name")?></b></h3>
                        <p><?=$show_site->row("group_address")?></p>
                    </td>
                </tr>
            </table>
            <table class="w-100 mb-3">
             <tr>
                <td><h4 class="text-center"><b><u>Permohonan Pembayaran</u></b></h4></td>
            </tr>
            </table>
            <table class="w-100 mb-1">

                <tr>

                    <td width="10%">Nomor</td>

                    <td width="1%">:</td>

                    <td width="89%">
                    <!-- 099/BIE/04/10/2021 -->
                        <? echo strlen($show->row('payment_request_no')) ? $show->row('payment_request_no') : "<i>auto generate</i>";?>
                        
                    </td>

                </tr>

                <tr>

                    <td>Tanggal</td>

                    <td>:</td>

                    <td>
                        <? echo strlen($show->row('date')) ? datesql2date($show->row('date')) : "<i>auto generate</i>";?>
                    </td>

                </tr>

                <tr>

                    <td>Perihal</td>

                    <td>:</td>

                    <td><?=$show->row('perihal')?></td>

                </tr>

            </table>
            <table class="w-100">

                <tr>

                    <td width="10%">Pemohon</td>

                    <td width="1%">:</td>

                    <td width="89%">
                        <? echo get_from_db("ref_user", "full_name", "user_id", $show->row('pemohon_user_id'))?>
                    </td>

                </tr>

                <tr>

                    <td>Jabatan</td>

                    <td>:</td>

                    <td>-</td>

                </tr>

            </table>
            <table class="w-100">

                <p style="margin:auto !important;">Berdasarkan Surat Perintah / Memo / lainnya : Permohonan Pembayaran</p>

                <tr>

                    <td width="10%">Nomor</td>

                    <td width="1%">:</td>

                    <td width="89%"><?=$show->row('nomor')?></td>

                </tr>

                <tr>

                    <td>Tanggal</td>

                    <td>:</td>

                    <td><?=datesql2date($show->row('tanggal'))?></td>

                </tr>

            </table>

            <!-- <hr style="display: block;margin-top: 0.5em;margin-bottom: 0.5em;margin-left: auto;margin-right: auto; height:1px; background: #000;"> -->
            <hr>
            <table class="w-100 mb-1">
                
                <p style="margin:auto !important;">Dibayarkan Kepada</p>

                <tr>

                    <td width="20%">Nama</td>

                    <td width="1%">:</td>

                    <td width="79%"><?=$show->row('to_name')?></td>

                </tr>

                <tr>

                    <td>Nomor Rekening</td>

                    <td>:</td>

                    <td><?=$show->row('to_rekening')?></td>

                </tr>

            </table>
            <table class="w-100 mb-2">

                <tr>

                    <td width="18%">Currency</td>

                    <td width="1%">:</td>
                    <td><?=$show->row('rfq_currency_id_txt')?></td>
<!-- 
                    <td width="25%">IDR </td>

                    <td width="1%">/</td>

                    <td width="45%">USD</td> -->

                </tr>

                <tr>

                    <td>Nilai Pembayaran</td>

                    <td>:</td>

                    <td><b>Rp <?=number_format($show->row('nominal'),2)?></b></td>

                    <td></td>

                    <td></td>

                </tr>

                <tr>

                    <td>Terbilang</td>

                    <td>:</td>

                    <td colspan="3">Seratus lima belas juta tujuh ratus dua puluh ribu rupiah</td>

                </tr>

            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <p style="font-size: 12px; margin:auto !important;"><b>Approval</b></p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="w-100 mb-3 border-table">
                <tr>
                    <td width="18%">
                        <p class="text-center" style="margin-top:10px;">Pemohon</p>
                        
                        <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;">
                            <!-- GAMBAR TTD -->
                            <!-- <img width="80" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                        </div>
        
                        <p class="text-center" style="font-weight:bold;margin:auto !important;">Devilia Anggraini</p>
        
                        <p class="text-center" style="font-weight:bold;margin:auto !important;">Tgl : 04 Okt 2021</p>
                        
                    </td>
                    <td width="26%">
                        <p class="text-center" style="margin-top:10px;">Manager Fin & Acct</p>
                        
                        <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;">
                            <!-- GAMBAR TTD -->
                            <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                        </div>
        
                        <p class="text-center" style="font-weight:bold;margin:auto !important;">Harmawan</p>
        
                        <p class="text-center" style="font-weight:bold;margin:auto !important;">Tgl : 04 Okt 2021</p>
                        
                    </td>
                    <td width="18%">
                        <p class="text-center" style="margin-top:10px;">Direktur Keuangan</p>
                        
                        <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;">
                            <!-- GAMBAR TTD -->
                            <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                        </div>
        
                        <p class="text-center" style="font-weight:bold;margin:auto !important;">Iqror Nuso Bhekti</p>
        
                        <p class="text-center" style="font-weight:bold;margin:auto !important;">Tgl : 04 Okt 2021</p>
                        
                    </td>
                    <td width="18%">
                        <p class="text-center" style="margin-top:10px;">Direktur Utama</p>
                        
                        <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;">
                            <!-- GAMBAR TTD -->
                            <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                        </div>
        
                        <p class="text-center" style="font-weight:bold;margin:auto !important;">Taufan Wijaya</p>
        
                        <p class="text-center" style="font-weight:bold;margin:auto !important;">Tgl : 04 Okt 2021</p>
                        
                    </td>
                </tr>
            </table>
            <table class="w-100 border-table">
                <tr>
                    <td>
                        <div style=";min-height: 220px;">
                            <p style="margin:5px 0px;word-wrap:break-word;"><b>Catatan : 
                                
                            </b><?=$show->row('notes')?></p>
            
                        </div>
                    </td>
                </tr>
            </table>
        </section>
    </div>
</div>  
<div class="form-group text-center">
        <button onclick="printDiv('printArea')" type="button" class="btn btn-success"><i class="fa fa-print"></i> Print this page</button>
        <button type="button" class="btn btn-light" onclick="history.back()">Back</button>
</div>