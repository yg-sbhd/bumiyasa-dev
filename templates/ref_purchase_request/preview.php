<?php

$show           = cmsDB();
$show_site      = cmsDB();
$subject        = cmsDB();
$component      = cmsDB();
$applicant      = cmsDB();
$lkpb           = cmsDB();
$detail         = cmsDB();
$ttd_applicant  = cmsDB();
$ttd_reviewed   = cmsDB();
$ttd_approved   = cmsDB();



$pr_id = decryptStringArray(uriParam("purchase_request_id"));


$query = "select * from ref_purchase_request where purchase_request_id=".$pr_id;
// echo $query;
$show->query($query);
$show->next();


$qry_site = "select * from master_group_location where group_location_id=".$show->row('group_location_id');
// echo $qry_site;
$show_site->query($qry_site);
$show_site->next();

$subject->query("select * from master_pr_subject where pr_subject_id=".$show->row('pr_subject_id'));
$subject->next();

$component->query("select * from master_pr_component where pr_component_id=".$show->row('pr_component_id'));
$component->next();

$applicant->query("select * from master_pr_applicant where pr_applicant_id=".$show->row('pr_applicant_id'));
$applicant->next();

$lkpb->query("select * from ref_lkpb where lkpb_id=".$show->row('lkpb_id'));
$lkpb->next();

$ttd_applicant->query("select * from ref_user where user_id=".$show->row('insert_by'));
$ttd_applicant->next();

$ttd_reviewed->query("select * from ref_user where user_id=".$component->row('review_user_id'));
$ttd_reviewed->next();

$ttd_approved->query("select * from ref_user where user_id=".$component->row('approve_user_id'));
$ttd_approved->next();


?>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form Purchase Request</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Finance / Purchase Request / Preview</li>
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
                    <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>" style="width: 100px;">
                </td>
                <td class="p-3">
                    <h3><b><?=$show_site->row("group_name")?></b></h3>
                    <p><?=$show_site->row("group_address")?></p>
                </td>
            </tr>
        </table>

        <table class="w-100 mb-3">
             <tr>
                <td><h4 class="text-center"><b><u>Purchase Request</u></b></h4></td>
            </tr>
        </table>
        <table class="w-100 mb-3">
            <tr>
                <td>
                    <div class="row justify-content-between">
                        <div class="col-6"> 
                            <table>
                                <tr>
                                    <td>PR Number</td>
                                    <td>:</td>
                                    <td><? echo strlen($show->row('purchase_request_no')) ? $show->row('purchase_request_no') : '-';?></td>        
                                </tr>
                                         
                                <tr>
                                    <td>PR Date</td>
                                    <td>:</td>
                                    <td><?=$show->row('date')?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                 <tr>
                                    <td>Subject</td>
                                    <td>:</td>
                                    <td><?=$subject->row('name')?></td>
                                </tr>

                                <tr>
                                    <td>Component</td>
                                    <td>:</td>
                                    <td><?=$component->row('name')?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">To</td>
                                    <td  style="vertical-align: top;">:</td>
                                    <td><?=$subject->row('functional_id_txt')?></td>
                                </tr>
                                <tr>
                                    <td>Applicant</td>
                                    <td>:</td>
                                    <td><?=$applicant->row('name')?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Delivery Date</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;"><?=datesql2date($show->row('delivery_date'))?></td>
                                </tr>
                                                                  
                            </table>
                        </div>
                        <div class="col-6"> 

                            <table>
                                <tr>
                                    <td>LKPB Number</td>
                                    <td>:</td>
                                    <td><? echo strlen($lkpb->row('lkpb_no')) ? $lkpb->row('lkpb_no') : '-';?></td>        
                                </tr>
                                <tr>
                                    <td>LKPB Date</td>
                                    <td>:</td>
                                    <td><? echo strlen($lkpb->row('date')) ? datesql2date($lkpb->row('date')) : '-';?></td>        
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                    <table>
                                        <tr>
                                            <td><b>SHIP To :</b></td>
                                        </tr>
                                        <tr>
                                            <td><?=$show->row('ship_to_name')?></td>
                                        </tr>
                                        <tr>
                                            <td><?=$show->row('ship_to_company')?></td>
                                        </tr>
                                        <tr>
                                            <td><?=$show->row('ship_to_address')?></td>
                                        </tr>
                                        <tr>
                                            <td><?=$show->row('ship_to_phone')?></td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <table class="w-100 mb-3 border-table" style="text-align: center;vertical-align: middle;">
            <tr>
                <th width="5%" align="left"><b>No</b></th>
                <th width="35%"><b>Product Name</b></th>
                <th width="20%"><b>Brand</b></th>
                <th width="30%"><b>Specification</b></th>
                <th width="10%"><b>Qty</b></th>
            </tr>

            <?
            $detail->query("select * from ref_purchase_request_detail where is_deleted=0 and purchase_request_id=".$show->row('purchase_request_id'));
            if ($detail->recordCount()) {
                $no=1;
                while ($detail->next()) {?>
                    <tr>
                        <td align="left"><?=$no?></td>
                        <td align="left"><?=$detail->row('product_name')?></td>
                        <td align="left"><?=$detail->row('brand')?></td>
                        <td align="left"><?=$detail->row('spesification')?></td>
                        <td align="right"><?=$detail->row('qty')?></td>
                    </tr> 
                <?
                $no++;
                }
            }else{
                echo "<tr><td colspan='5' align='center' style='color:red'>-Item tidak ada-</td></tr>";
            }
            ?>


        </table>
        
        <table class="w-100">
             <tr>
                <td><b>Approval</b></td>
            </tr>
        </table>

        <table class="w-100 border-table">
            <tr>
                <td width="20%" style="vertical-align: top;">
                    <p class="text-center" style="margin-top:10px;">Applicant</p>
                    <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                        <!-- GAMBAR TTD -->
                        <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$ttd_applicant->row('ttd')?>"> -->
                    </div>
                    <p class="text-center" style="margin:auto !important;bottom: 2px;left: 0;right: 0;"><b><?=$ttd_applicant->row('full_name')?></b></p>
                </td>
                <td width="20%" style="vertical-align: top">
                    <p class="text-center" style="margin-top:10px;">Reviewed</p>
                    <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                        <!-- GAMBAR TTD -->
                        <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$ttd_reviewed->row('ttd')?>"> -->
                    </div>
                    <p class="text-center" style="margin:auto !important;bottom: 2px;left: 0;right: 0;"><b><?=$ttd_reviewed->row('full_name')?></b></p>
                </td>
                <td width="20%" style="vertical-align: top">
                    <p class="text-center" style="margin-top:10px;" >Approved</p>
                    <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                        <!-- GAMBAR TTD -->
                        <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$ttd_approved->row('ttd')?>"> -->
                    </div>
                    <p class="text-center" style="margin:auto !important;bottom: 2px;left: 0;right: 0;"><b><?=$ttd_approved->row('full_name')?></b></p>
                </td>
                <td style="text-align: left; vertical-align: top;word-wrap:break-word;">
                    <p style="margin:10px 0px 1px 0px;">Catatan : </p>
                    <div style="min-height: 140px;">
                        <span><?=$show->row('notes')?></span>
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