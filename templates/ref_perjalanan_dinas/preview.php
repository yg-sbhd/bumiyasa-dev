<?php

$show_site=cmsDB();
$show = cmsDB();
$ppd_personil = cmsDB();
$ppd_kegiatan = cmsDB();
$ppd_kegiatan_desc = cmsDB();
$ppd_biaya = cmsDB();
$ppd_biaya_desc = cmsDB();
$total_price = cmsDB();



$qry = "select * from master_group_location where group_location_id=1";
$show_site->query($qry);
$show_site->next();

$id = decryptStringArray(uriParam("ppd_id"));
$show_qry = "select * from ref_ppd where ppd_id=".$id;
$show->query($show_qry);
$show->next();

$ppd_personil_qry = "SELECT ref_ppd_personil.user_id, ref_user.full_name, ref_group.group_name FROM ref_ppd_personil 
 LEFT JOIN ref_user ON (ref_user.user_id=ref_ppd_personil.user_id) 
 LEFT JOIN ref_group ON (ref_group.group_id=ref_user.group_id) WHERE ref_ppd_personil.is_deleted=0 AND ppd_id=".$id;
// echo $ppd_personil_qry;
$ppd_personil->query($ppd_personil_qry);

$ppd_kegiatan_qry = "select distinct date from ref_ppd_kegiatan where is_deleted=0 and ppd_id=".$id." order by date";
$ppd_kegiatan->query($ppd_kegiatan_qry);


$ppd_biaya_qry = "select distinct ppd_tipe_biaya_id from ref_ppd_biaya where is_deleted=0 and ppd_id=".$id;
$ppd_biaya->query($ppd_biaya_qry);
$list_type_biaya = strlen($ppd_biaya->valueList("ppd_tipe_biaya_id")) ? $ppd_biaya->valueList("ppd_tipe_biaya_id") : 0 ;
$ppd_biaya_qry = "select ppd_tipe_biaya_id, name from master_ppd_tipe_biaya where ppd_tipe_biaya_id in(".$list_type_biaya.") order by order_level";
$ppd_biaya->query($ppd_biaya_qry);

$total_price->query("select SUM(total_price) as total_price from ref_ppd_biaya where is_deleted=0 and ppd_id=".$id);
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
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form Perjalanan Dinas</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Financial / Perjalanan Dinas / Preview</li>
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

                    <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>" style="width: 150px;">

                    </td>

                    <td class="bg-head" style="text-align:center;"><h5><b><i>Record</i></b></h5></td>

                </tr>

                <tr>

                    <td><h3 class="text-center"><b>Permohonan Perjalanan Dinas</b></h3></td>

                </tr>

            </table>

            <table class="w-100 mb-2">
                <tr>
                    <td>
                        <div class="row justify-content-between">
                            <div class="col-7">
                                <table>
                                    <tr>
                    
                                        <td width="30%">Kepada</td>

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

                                        <td><?=$show->row('perihal')?></td>

                                    </tr>
                                </table>
                            </div>
                            <div class="col-5">
                                <table>
                                    <tr>
                        
                                        <td width="30%">Nomor PD</td>
                        
                                        <td width="1%">:</td>
                        
                                        <td>…../PD/…../……....../….....</td>
                        
                                    </tr>
                        
                                    <tr>
                        
                                        <td>Tanggal</td>
                        
                                        <td>:</td>
                        
                                        <td>…..............................</td>
                        
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>



            <table class="w-100 mb-3">

                <tr>

                    <td width="17%">Waktu</td>

                    <td width="1%">:</td>

                    <td><?=datesql2date($show->row('date_start'))?> &nbsp;s/d&nbsp; <?=datesql2date($show->row('date_end'))?></td>

                </tr>

                <tr>

                    <td>Lokasi Tujuan</td>

                    <td>:</td>

                    <td><?=$show->row('tujuan')?></td>

                </tr>

                <tr>

                    <td>Kegiatan</td>

                    <td>:</td>

                    <td><?=$show->row('kegiatan')?></td>

                </tr>

            </table>
            
            <table class="w-100">
                <tr>
                    <td>
                        <p style="font-size: 12px; margin:auto !important;"><b>A. RENCANA PERSONIL</b></p>
                    </td>
                </tr>
            </table>

             <table class="w-100 mb-2">
                <tr>
                    <td>
                        <div class="col-12">
                            <table class="w-100 border-table">
                                <tr>
                
                                    <th style="text-align: center; vertical-align: middle;" width="5%">No</th>
                                    <th style="text-align: center; vertical-align: middle;" width="">Nama</th>
                                    <th style="text-align: center; vertical-align: middle;" width="">Departemen</th>
                                </tr>
                                <?
                                if ($ppd_personil->recordCount()) {
                                    $no=1;
                                    while ($ppd_personil->next()) {
                                        ?>
                                        <tr>
                                            <td><?=$no;?>.</td>
                                            <td><?=$ppd_personil->row('full_name')?></td>
                                            <td><?=$ppd_personil->row('group_name')?></td>
                                        </tr>
                                        <?
                                    $no++;
                                    }
                                }else{?>
                                    <tr>
                                        <td colspan="3" style="text-align: center; vertical-align: middle;">-- Personil not found --</td>
                                    </tr>
                                <?}?>

                            </table>

                        </div>
                    </td>
                </tr>
            </table>


            <table class="w-100">
                <tr>
                    <td>
                        <p style="font-size: 12px; margin:auto !important;"><b>B. RENCANA KEGIATAN</b></p>
                    </td>
                </tr>
            </table>

            <table class="w-100 mb-2">
                <tr>
                    <td>
                        <div class="col-12">
                            <table class="w-100 border-table">
                                <tr>
                
                                    <th style="text-align: center; vertical-align: middle;" width="">Hari, Tanggal</th>
                
                                    <th style="text-align: center; vertical-align: middle;" width="">Uraian Kegiatan</th>
                
                                </tr>
                                <?
                                if ($ppd_kegiatan->recordCount()) {
                                    while ($ppd_kegiatan->next()) {
                                    ?>

                                    <tr>
                                        <td style="text-align: center; vertical-align: top;" width="30%">
                                            <?=getDayDateIndonesia($ppd_kegiatan->row('date'));?>
                                        </td>
                                        <td>
                                            <table>
                                                <?
                                                $ppd_kegiatan_desc_qry = "select kegiatan from ref_ppd_kegiatan where is_deleted=0 and ppd_id=".$id." and date='".$ppd_kegiatan->row('date')."'";
                                                $ppd_kegiatan_desc->query($ppd_kegiatan_desc_qry);
                                                $n = 1;
                                                while ($ppd_kegiatan_desc->next()) {
                                                ?>
                                                <tr>
                                                    <td width="5%"><?=$n?>.</td>
                                                    <td><?=$ppd_kegiatan_desc->row('kegiatan')?></td>
                                                </tr>
                                                <?
                                                $n++;
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    </tr>
                                    <?
                                    }
                                }?>

                            </table>
                        </div>

                    </td>
                </tr>



            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <p style="font-size: 12px; margin:auto !important;"><b>C. BIAYA KEGIATAN</b></p>
                    </td>
                </tr>
            </table>


            <table class="w-100">
                <tr>
                    <td>
                        <div class="col-12">
                            <table class="w-100 border-table">
                                <tr>
                
                                    <th style="text-align: center; vertical-align: middle;" width="5%";>No</th>
                
                                    <th style="text-align: center; vertical-align: middle;" width="45%";>Uraian Kegiatan</th>
                
                                    <th style="text-align: center; vertical-align: middle;" width="7%";>Qty</th>
                
                                    <th style="text-align: center; vertical-align: middle;" width="7%";>Unit</th>
                
                                    <th style="text-align: center; vertical-align: middle;" width="18%";>Harga Satuan</th>
                
                                    <th style="text-align: center; vertical-align: middle;" width="18%";>Jumlah Biaya</th>
                
                                </tr>
                                
                                <?
                                if($ppd_biaya->recordCount()){
                                    $x=1;
                                    while ($ppd_biaya->next()) {?>
                                        <tr>
                                            <td style="text-align: right"><b><?=$x;?>.</b></td>
                                            <td colspan="5"><b><?=$ppd_biaya->row('name')?></b></td>
                                        </tr>

                                        <?
                                        $ppd_biaya_desc_qry = "select * from ref_ppd_biaya where is_deleted=0 and ppd_id=".$id." and ppd_tipe_biaya_id=".$ppd_biaya->row('ppd_tipe_biaya_id');
                                        $ppd_biaya_desc->query($ppd_biaya_desc_qry);
                                        while ($ppd_biaya_desc->next()) {
                                            ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>-</td>
                                                            <td><?=$ppd_biaya_desc->row('uraian_biaya')?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="text-align: right;"><?=number_format($ppd_biaya_desc->row('qty'),2);?></td>
                                                <td style="text-align: center;"><?=get_from_db('master_unit_qty','name','unit_qty_id',$ppd_biaya_desc->row('unit_qty_id'))?></td>
                                                <td style="text-align: right"><?=number_format($ppd_biaya_desc->row('price'),2)?></td>
                                                <td style="text-align: right;"><?=number_format($ppd_biaya_desc->row('total_price'),2)?></td>
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

            
                                <tr>
            
                                    <td style="text-align:right;" colspan="5"><b>Total Biaya</b></td>
            
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
                        <p class="text-center" style="margin-top:10px;">Pemohon</p>
                        <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                            <!-- GAMBAR TTD -->
                            <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                        </div>
                
                        <p class="text-center" style="margin:auto !important;font-weight:bold;">ALMITRA BATRAN</p>
                
                        <p class="text-center" style="margin:auto !important;">Staff Operasional</p>
                    </td>
                    <td width="20%" style="vertical-align: top;">
                        <p class="text-center" style="margin-top:10px;">Diketahui</p>
                        <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                        <!-- GAMBAR TTD -->
                            <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                        </div>
            
                        <p class="text-center" style="margin:auto !important;font-weight:bold;">EGAR ADISTIRA</p>
            
                        <p class="text-center" style="margin:auto !important;">OPS Manager</p>
                    </td>
                    <td width="20%" style="vertical-align: top;">
                        <p class="text-center" style="margin-top:10px;">Disetujui</p>
                        <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                            <!-- GAMBAR TTD -->
                            <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                        </div>
                        <p class="text-center" style="margin:auto !important;font-weight:bold;">IRAWAN HARI P</p>
            
                        <p class="text-center" style="margin:auto !important;">OPS Director</p>
                    </td>
                    <td width="40%" style="text-align: left; vertical-align: top;word-wrap:break-word;">
                        <p style="margin-top:10px;">Catatan : </p>
                        <div style="min-height: 100px;">
                            <span><!-- catatan max 300kata -->
                            <!-- Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Cras ultricies ligula sed magna dictum porta. Vivamus magna justo,lacinia eget consectetur sed, convallis at telluslacinia eget consectetur sed, convallis at tellus lacinia eget consectetur sed, convallis at tellus.convallistellus -->
                            </span>
                        </div>
                        
                    </td>
                </tr>
            </table>
            <table class="w-100 border-table bg-grey">
                <tr>
                    <td>
                        <div style="min-height: 120px !important;">
            
                            <p style="margin:5px 5px 0px 0px;word-wrap:break-word;">Verifikasi : 
                            <!-- input data -->
                            <!-- Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Cras ultricies ligula sed magna dictum porta. Vivamus magna justo,lacinia eget consectetur sed, convallis at telluslacinia eget consectetur sed, convallis at tellus lacinia eget consectetur sed, convallis at tellus.convallistellus -->
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