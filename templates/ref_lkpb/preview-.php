<?php
$show_site=cmsDB();
$qry = "select * from master_group_location where group_location_id=2";

$show_site->query($qry);

$show_site->next();
?>
<style>
    table > tbody > tr > td{
        padding-right:5px;
    }
    .border-table{
        border:1px solid #000;
    }
    .border-table > thead > tr > th{
        border:1px solid #000;
    }
    .border-table > tbody > tr > td{
        border:1px solid #000;
    }
</style>
<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form LKPB</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / LKPB / Preview</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<button onclick="printDiv('printArea')">Print this page</button>


<div style="overflow-x: auto;">
    <div class="A4" id="printArea">
        <section class="sheet padding-10mm">
            <table class="w-100">
                <tr>
                    <td>
                        <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>">
                    </td>
                    <td class="pl-3">
                        <h3><b><?=$show_site->row("group_name")?></b></h3>
                        <p><?=$show_site->row("group_address")?></p>
                    </td>
                </tr>
            </table>
            <table class="w-100 mb-3">
                <tr>
                    <td> <h4 class="text-center"><b><u>Laporan Kejadian Potensi Bahaya</u></b></h4></td>
                </tr>
            </table>
            <table class="w-100 mb-3">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-7">
                                <table>
                                    <tr>
                                        <td width="">Nomor</td>
                                        <td width="">:</td>
                                        <td width="">By system (00/LKPB/III/LGW/2021)</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>By system (Date)</td>
                                    </tr>
                                    <tr>
                                        <td>Dept / Lokasi</td>
                                        <td>:</td>
                                        <td>Select from the list</td>
                                    </tr>
                                    <tr>
                                        <td>Jam Terjadi</td>
                                        <td>:</td>
                                        <td>Input jam </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-5">
                                <table>
                                    <tr>
                                        <td><i class="icon-check"></i></td>
                                        <td>Pekerjaan Tidak Aman </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>

            </table>
            <table class="w-100 mb-3 border-table">
                <tr>
                    <td width="80%" style="vertical-align : top;text-align:left;">
                        <p><b>Uraian terjadinya potensi bahaya dan atau insiden</b></p>
                        <div style="min-height:120px">
                        <!-- Data Uraian -->
                        </div>
                    </td>
                    <td width="20%" style="position:relative;">
                        <p class="text-center"><b>Kepala unit</b></p>
                        <div style="min-height: 120px;">
                            <p class="text-center" style="position: absolute;top:35%;color: red;left: 0;right: 0;"><b>APPROVED</b></p>
                            <p class="text-center" style="position: absolute;bottom: 2px;left: 0;right: 0;">Nama</p>
                        </div>
                    </td>
                </tr>

            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <p class="text-center"><b>POTENSI BAHAYA/NEAR MISS INVESTIGATION (dilakukan oleh atasan terkait)</b></p>
                    </td>
                </tr>
            
            <table class="w-100 mb-3">
                   <tr>
                       <td width="20%">Akar Masalah</td>
                       <td width="1%">:</td>
                       <td width="70%"></td>
                   </tr>
                   <tr>
                       <td>Tindakan Sementara</td>
                       <td>:</td>
                       <td></td>
                   </tr>
                   <tr>
                       <td>Tanggal Penerapan</td>
                       <td>:</td>
                       <td></td>
                   </tr>
                   
            </table>
            <table class="w-100 border-table">
                <tr>
                    <td>
                        <p><b>Documentation</b></p>
                        <div style="height: 150px;">
                        <!-- File Document -->
                        </div>
                    </td>
                </tr>
            </table>
                
            
            
        </section>
    </div>

    