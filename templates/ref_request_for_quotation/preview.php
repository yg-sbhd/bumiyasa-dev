<?php
$show_site=cmsDB();
$show = cmsDB();
$company = cmsDB();
$pr = cmsDB();
$vendor = cmsDB();
$detail = cmsDB();
$user = cmsDB();

$rfq_id = decryptStringArray(uriParam("request_for_quotation_id"));

$show->query("select * from ref_request_for_quotation where request_for_quotation_id=".$rfq_id);
$show->next();

$pr->query("select * from ref_purchase_request where purchase_request_id=".$show->row('purchase_request_id'));
$pr->next();

// $company_query = "select * from master_group_location where group_location_id in (.") ";
$company->query("select * from master_group_location where group_location_id=".$pr->row('group_location_id'));
$company->next();

$vendor->query("select * from master_vendor where vendor_id=".$show->row('vendor_id'));
$vendor->next();

$user->query("select * from ref_user where user_id=".$pr->row('insert_by'));
$user->next();
?>
<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form Request for Quotation</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Financial / Request for Quotation / Preview</li>
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
                        <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$company->row('image')?>" style="width: 100px;">
                    </td>
                    <td class="p-3">
                        <h3><b><?=$company->row("group_name")?></b></h3>
                        <p><?=$company->row("group_address")?></p>
                    </td>
                </tr>
            </table>

            <table class="w-100 mb-3">
                <tr>
                    <td><h4 class="text-center"><b><u>Request for Quotation</u></b></h4></td>
                </tr>
            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <div class="row justify-content-between">
                            <div class="col-6"> 
                                <table>
                                    <tr>
                                        <td>RFQ Number</td>
                                        <td>:</td>
                                        <td><? echo strlen($show->row('request_for_quotation_no')) ? $show->row('request_for_quotation_no') : '-';?></td>        
                                    </tr>
                                            
                                    <tr>
                                        <td>RFQ Date</td>
                                        <td>:</td>
                                        <td><?=$show->row('date')?></td>
                                    </tr>

                                    <tr>
                                        <td>Subject</td>
                                        <td>:</td>
                                        <td>Request for quotation</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="w-100 mb-3">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td><b>To :</b></td>
                                    </tr>
                                    <tr>
                                        <td><b><?=$vendor->row('vendor_name')?></b></td>
                                    </tr>
                                    <tr>
                                        <td><?=$vendor->row('vendor_company')?></td>
                                    </tr>
                                    <tr>
                                        <td><?=$vendor->row('vendor_address')?></td>
                                    </tr>
                                    <tr>
                                        <td><?=$vendor->row('vendor_phone')?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td><b>SHIP To :</b></td>
                                    </tr>
                                    <tr>
                                        <td><b><?=$pr->row('ship_to_name')?></b></td>
                                    </tr>
                                    <tr>
                                        <td><?=$pr->row('ship_to_company')?></td>
                                    </tr>
                                    <tr>
                                        <td><?=$pr->row('ship_to_address')?></td>
                                    </tr>
                                    <tr>
                                        <td><?=$pr->row('ship_to_phone')?></td>
                                    </tr>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="w-100 mb-3 border-table">
                <tr>
                    <th style="text-align: center;">Reference</th>
                    <th style="text-align: center;">Delivery Date</th>
                    <th style="text-align: center;">Term of Payment</th>
                    <th style="text-align: center;">Currency</th>
                </tr>
                <tr>
                    <td align="center"><?=$pr->row('purchase_request_no')?></td>
                    <td align="center"><?=datesql2date($pr->row('date'))?></td>
                    <td align="center"><?=get_from_db('master_rfq_payment', 'name', 'rfq_payment_id', $show->row('rfq_payment_id'))?></td>
                    <td align="center"><?=get_from_db('master_rfq_currency', 'name', 'rfq_currency_id', $show->row('rfq_currency_id'))?></td>
                </tr>
            </table>
            <table class="w-100 mb-3 border-table">
                <tr>
                    <th width="5%" style="text-align: center;">No</th>
                    <th width="30%" style="text-align: center;">Product Name</th>
                    <th width="25%" style="text-align: center;">Brand</th>
                    <th width="30%"style="text-align: center;">Specification</th>
                    <th width="10%"style="text-align: center;">Qty</th>
                </tr>
                <?
                $detail->query("select * from ref_purchase_request_detail where is_deleted=0 and purchase_request_id=".$pr->row('purchase_request_id'));
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
            <table class="w-100 mb-3">
                <tr>
                    <td>
                        <b>Question and Submission</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Further questions / clarifications can be sent to the Contact Person below:
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-12">
                            <table>
                                <tr>
                                    <td>Name</td>
                                    <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                    <td><?=$show->row('pic_name')?></td>
                                </tr>
                                <tr>
                                    <td>Telp Number</td>
                                    <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                    <td><?=$show->row('pic_phone')?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                    <td><?=$show->row('pic_email')?></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Bidding Documents can be submitted no later than : <?=getDayIndonesia(Date2SQLnoTime($show->row('document_date')))?>, <?=datesql2date($show->row('document_date'))?> 
                    </td>
                </tr>
            </table>
            <table class="w-100">
                <tr>
                    <td>
                        Best Regards,
                        <p><b><?=get_from_db('master_group_location', 'group_name', 'group_location_id', $pr->row('group_location_id'))?></b></p>
                        <div class="col-3" style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                            <!-- GAMBAR TTD -->
                            <!-- <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$user->row('ttd')?>"> -->
                        </div>
                        <p style="margin:auto !important;"><?=$user->row('full_name')?></p>
                        <!-- <p style="margin:auto !important;"><?=$user->row('group_location_id')?></p> -->
                    </td>
                </tr>
            </table>
        </section>
    </div>
    <div class="form-group text-center">
        <button onclick="printDiv('printArea')" type="button" class="btn btn-success"><i class="fa fa-print"></i> Print this page</button>
        <button type="button" class="btn btn-light" onclick="history.back()">Back</button>

    </div>