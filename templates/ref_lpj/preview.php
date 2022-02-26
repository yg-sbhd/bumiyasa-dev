<?php

$show_site  = cmsDB();
$show       = cmsDB();
$lpj_type   = cmsDB();
$lpj_biaya  = cmsDB();
$lpj_biaya_desc  = cmsDB();
$total_price = cmsDB();

$id = decryptStringArray(uriParam('lpj_id'));

$show_qry = "select * from ref_lpj where lpj_id=".$id;
$show->query($show_qry);
$show->next();

$qry = "select * from master_group_location where group_location_id=2";
$show_site->query($qry);
$show_site->next();


$lpj_type_qry = "select * from ref_lpj_type where lpj_type_id=".$show->row('lpj_type_id');
$lpj_type->query($lpj_type_qry);
$lpj_type->next();

$lpj_biaya_qry = "select distinct ppd_tipe_biaya_id from ref_lpj_biaya where is_deleted=0 and lpj_id=".$id;
$lpj_biaya->query($lpj_biaya_qry);
$list_type_biaya = strlen($lpj_biaya->valueList("ppd_tipe_biaya_id")) ? $lpj_biaya->valueList("ppd_tipe_biaya_id") : 0 ;
$lpj_biaya_qry = "select ppd_tipe_biaya_id, name from master_ppd_tipe_biaya where ppd_tipe_biaya_id in(".$list_type_biaya.") order by order_level";
$lpj_biaya->query($lpj_biaya_qry);

$total_price->query("select SUM(total_price) as total_price from ref_lpj_biaya where is_deleted=0 and lpj_id=".$id);
$_total_price = 0;
if ($total_price->recordCount()) {
    $total_price->next();
    $_total_price = $total_price->row('total_price');
}
?>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form Lembar Pertanggun Jawaban</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Financial / LPJ / Preview</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div style="overflow-x: auto;">
<div class="A4" id="printArea">

    <section class="sheet padding-10mm">

        <table class="w-100 border-table mb-3">

            <tr>

                <td rowspan="2" width="150px" align="center">

                <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>">

                </td>

                <td class="bg-head" style="text-align:center;"><h5><b><i>Record</i></b></h5></td>

            </tr>

            <tr>

                <td><h4 class="text-center"><b>Pertanggung Jawaban <?=$lpj_type->row('perihal')?></b></h4></td>

            </tr>

        </table>
        <table class="w-100 mb-1">

            <tr>

                <td width="20%">Nomor PJPD</td>

                <td width="1%">:</td>

                <td>00/LPJKK/mm/site/tahun</td>

            </tr>

            <tr>

                <td>Tanggal</td>

                <td>:</td>

                <td>…..............................</td>

            </tr>

        </table>
        <table class="w-100">

            <tr>

                <td width="20%">Kepada</td>

                <td width="1%">:</td>

                <td>
                    <?
                        echo get_from_db("ref_group", "group_name", "group_id", $show->row('to_group_id'));
                    ?>
                </td>

            </tr>

            <tr>

                <td>Dari</td>

                <td>:</td>

                <td>
                    <?
                        echo get_from_db("ref_group", "group_name", "group_id", $show->row('from_group_id'));
                    ?>
                </td>

            </tr>

            <tr>

                <td>Perihal</td>

                <td>:</td>

                <td>LPJ <?=$lpj_type->row('perihal')?></td>

            </tr>

        </table>
        
        <table class="w-100">
            <tr>
                <td>
                    <p style="font-size: 12px; margin:auto !important;"><b>A. PELAKSANAAN KEGIATAN</b></p>
                </td>
            </tr>
        </table>
        <table class="w-100">
            <tr>
                <td>
                    <div class="col-12">
                        <table class="w-100 border-table">
                            <tr style="text-align: center;vertical-align: middle;">
                
                                <td width="5%" >NO</td>
                
                                <td width="35%" >Uraian Biaya</td>
                
                                <td width="5%" >Qty</td>
                
                                <td width="5%" >Unit</td>
                
                                <td width="10%" >No. Bukti</td>
                
                                <td width="20%" >Harga Satuan</td>
                
                                <td width="20%" >Jumlah Biaya</td>
                
                            </tr>

                            <?
                                if($lpj_biaya->recordCount()){
                                    $x=1;
                                    while ($lpj_biaya->next()) {?>
                                        <tr>
                                            <td style="text-align: right"><b><?=$x;?>.</b></td>
                                            <td colspan="6"><b><?=$lpj_biaya->row('name')?></b></td>
                                        </tr>

                                        <?
                                        $lpj_biaya_desc_qry = "select * from ref_lpj_biaya where is_deleted=0 and lpj_id=".$id." and ppd_tipe_biaya_id=".$lpj_biaya->row('ppd_tipe_biaya_id');
                                        $lpj_biaya_desc->query($lpj_biaya_desc_qry);
                                        while ($lpj_biaya_desc->next()) {
                                            ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>-</td>
                                                            <td><?=$lpj_biaya_desc->row('uraian_biaya')?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="text-align: right;"><?=number_format($lpj_biaya_desc->row('qty'),2);?></td>
                                                <td style="text-align: center;"><?=get_from_db('master_unit_qty','name','unit_qty_id',$lpj_biaya_desc->row('unit_qty_id'))?></td>
                                                <td><?=$lpj_biaya_desc->row('no_bukti')?></td>
                                                <td style="text-align: right"><?=number_format($lpj_biaya_desc->row('price'),2)?></td>
                                                <td style="text-align: right;"><?=number_format($lpj_biaya_desc->row('total_price'),2)?></td>
                                            </tr>
                                        <?
                                        }
                                    $x++;
                                    }

                                }else{?>
                                    <tr>
                                        <td colspan="6" style="text-align: center;color: red">-- Biaya kegiatan not found --</td>
                                    </tr>
                                <?
                                }
                                ?>

                            <!-- <tr>
                
                                <td style="text-align: center;vertical-align: middle;"><b>1</b></td>
                
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
                
                                <td style="text-align: center;vertical-align: middle;"><b>2</b></td>
                
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
                
                                <td style="text-align: center;vertical-align: middle;"><b>3</b></td>
                
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
                
                                <td style="text-align: center;vertical-align: middle;"><b>4</b></td>
                
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
                
                            </tr> -->
                
                            <tr>
                
                                <td style="text-align:right;" colspan="6">Total Biaya</td>
                
                                <!-- <td>Rp   -</td> -->
                                <td style="text-align: right; vertical-align: middle;">Rp <?=number_format($_total_price,2)?></td>

                
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <table class="w-100 mb-2">
            <tr>
                <td>
                    <div class="col-12">
                        <p style="margin:auto !important;"><i>Dengan Huruf &nbsp;:&nbsp;&nbsp;  Satu Juta Dua Ratus Tujuh Puluh Lima Ribu Rupiah</i></u></p>
                    </div>
                </td>
            </tr>
        </table>
        <table class="w-100 mb-2">
            <p style="font-size: 12px; margin:auto !important; padding-bottom:5px;"><b>B. PERTANGGUNG JAWABAN</b></p>
            <tr>
                <td>
                    <div class="col-12">
                        <table>
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
                </td>
            </tr>
        </table>
        <table class="w-100 border-table bg-grey">
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center" style="margin:5px auto !important;"><b>Persetujuan</b></p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <table class="w-100 border-table bg-grey">
            
            <tr>
                <td width="20%" style="vertical-align: top;">
                    <p class="text-center" style="margin-top:10px;">Dibuat Oleh</p>
                    <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                        <!-- GAMBAR TTD -->
                        <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>">
                    </div>
            
                    <p class="text-center" style="margin:auto !important;font-weight:bold;">NAMA</p>
            
                    <p class="text-center" style="margin:auto !important;">Jabatan </p>
                </td>
                <td width="20%" style="vertical-align: top;">
                    <p class="text-center" style="margin-top:10px;">Diketahui</p>
                    <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                    <!-- GAMBAR TTD -->
                    <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>">
                     </div>
        
                    <p class="text-center" style="margin:auto !important;font-weight:bold;">EGAR ADISTIRA</p>
        
                    <p class="text-center" style="margin:auto !important;">OPS Manager</p>
                </td>
                <td width="20%" style="vertical-align: top;">
                    <p class="text-center" style="margin-top:10px;">Disetujui</p>
                    <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                        <!-- GAMBAR TTD -->
                        <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>">
                    </div>
                    <p class="text-center" style="margin:auto !important;font-weight:bold;">IRAWAN HARI P</p>
        
                    <p class="text-center" style="margin:auto !important;">OPS Director</p>
                </td>
                <td width="40%" style="text-align: left; vertical-align: top;word-wrap:break-word;">
                    <p style="margin-top:10px;">Catatan : </p>
                    <div style="min-height: 100px;">
                        <span><!-- catatan max 300kata -->Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Cras ultricies ligula sed magna dictum porta. Vivamus magna justo,lacinia eget consectetur sed, convallis at telluslacinia eget consectetur sed, convallis at tellus lacinia eget consectetur sed, convallis at tellus.convallistellus</span>
                    </div>
                    
                </td>
            </tr>
        </table>
        <table class="w-100 border-table bg-grey">
            <tr>
                <td>
                    <div style="min-height: 120px !important;">
        
                        <p style="margin:5px 5px 0px 0px;word-wrap:break-word;">Verifikasi : 
                        <!-- input data -->Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Cras ultricies ligula sed magna dictum porta. Vivamus magna justo,lacinia eget consectetur sed, convallis at telluslacinia eget consectetur sed, convallis at tellus lacinia eget consectetur sed, convallis at tellus.convallistellus
                        </p>
        
                    </div>
                </td>
            </tr>
            
        </table>

    </section>

</div>
<div class="form-group text-center">
    <button onclick="printDiv('printArea')" type="button" class="btn btn-success"><i class="fa fa-print"></i> Print this page</button>
    <button type="button" class="btn btn-light" onclick="history.back()">Back</button>

</div>