<?php
$show_site=cmsDB();
$show=cmsDB();
$show_detail=cmsDB();
$bid_analys = cmsDB();
$vendor = cmsDB();
$pr = cmsDB();
$rfq = cmsDB();

$id = decryptStringArray(uriParam('purchase_order_id'));

$show->query("select * from ref_purchase_order where purchase_order_id=".$id);
$show->next();

$detail_qry = "select * from ref_bid_analys_detail where bid_analys_id=".$id;
$show_detail->query($detail_qry);


$pr_query = "select * from ref_purchase_request where purchase_request_id=".$show->row('purchase_request_id');
$pr->query($pr_query);
$pr->next();

$qry_site = "select * from master_group_location where group_location_id =".$pr->row('group_location_id');
$show_site->query($qry_site);
$show_site->next();

$rfq_query = "select * from ref_request_for_quotation where request_for_quotation_id=". $show->row('request_for_quotation_id');
$rfq->query($rfq_query);
$rfq->next();

$bid_analys_query = "select * from ref_bid_analys where bid_analys_id=".$show->row('bid_analys_id');
$bid_analys->query($bid_analys_query);
$bid_analys->next();

$vendor->query("select * from master_vendor where vendor_id = " .$bid_analys->row('selected_vendor_id'));
$vendor->next();
?>
<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form Purchase Order</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Financial / Purchase Order / Preview</li>
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
                <td><h4 class="text-center"><b><u>Purchase Order</u></b></h4></td>
            </tr>
            </table>
            <table class="w-100 mb-3">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td>PO Number</td>
                                        <td>:</td>
                                        <td><? echo strlen($show->row('purchase_order_no')) ? $show->row('purchase_order_no') : "<i>auto generate</i>";?></td>
                                    </tr>
                                    <tr>
                                        <td>PO Date</td>
                                        <td>:</td>
                                        <td><? echo strlen($show->row('purchase_order_no')) ? $show->row('purchase_order_no') : "<i>auto generate</i>";?></td>
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
                        <div class="row justify-content-between">
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td><b>To :</b></td>
                                    </tr>
                                    <tr>
                                        <td><?=$vendor->row('vendor_name')?></td>
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
                                        <td><?=$pr->row('ship_to_name')?></td>
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
                <thead>
                    <tr>
                        <th width="30%" style="text-align: center;vertical-align: middle;">Reference PR</th>
                        <th width="30%" style="text-align: center;vertical-align: middle;">Reference BA</th>
                        <th width="20%" style="text-align: center;vertical-align: middle;">Delivery Date</th>
                        <th width="30%" style="text-align: center;vertical-align: middle;">Term of Payment</th>
                        <th width="20%" style="text-align: center;vertical-align: middle;">Currency</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="text-align: center;vertical-align: middle;">
                        <td><?=$show->row('purchase_request_id_txt')?></td>
                        <td><?=$show->row('request_for_quotation_id_txt')?></td>

                        <td><?=datesql2date($pr->row('delivery_date'))?></td>
                        <td>Select Term of Payment List</td>
                        <td>
                            <?=$rfq->row('rfq_currency_id_txt');?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="w-100 mb-3 border-table">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center;vertical-align: middle;">No</th>
                        <th width="30%" style="text-align: center;vertical-align: middle;">Item Description</th>
                        <th width="7%" style="text-align: center;vertical-align: middle;">Qty</th>
                        <th width="7%"style="text-align: center;vertical-align: middle;">Unit</th>
                        <th width="18%"style="text-align: center;vertical-align: middle;">Unit Price</th>
                        <th width="18%"style="text-align: center;vertical-align: middle;">Line Total</th>
                    </tr>
                    <tbody>
                        <?
                        $Sub_total = 0;
                        $no = 1;
                        if($show_detail->recordCount()){
                            while ($show_detail->next()) {
                                if($show_detail->row('component_item') == 5){
                                ?>
                                <tr>
                                    <td style="text-align: center;vertical-align: top;"><?=$no?></td>
                                    <td style="text-align: left;vertical-align: top;">
                                        <?=$show_detail->row('component')?>
                                        <!-- Input Product Name from quotation <br>
                                        Input Brand from quotation <br>
                                        Input spesification from quotation -->
                                    </td>
                                    <td style="text-align: center;vertical-align: top;"><?=number_format($show_detail->row('qty'),2)?></td>
                                    <td style="text-align: center;vertical-align: top;">PCS</td>
                                    <td style="text-align: right;vertical-align: top;">
                                        <?
                                        $vendor_selected_price = $bid_analys->row('selected_vendor_field');
                                        // echo $vendor_selected_price; 
                                        echo number_format($show_detail->row($vendor_selected_price."_price"),2)?>
                                            
                                    </td>
                                    <td style="text-align: right;vertical-align: top;">
                                        <?
                                        $vendor_selected_price = $bid_analys->row('selected_vendor_field');
                                        // echo $vendor_selected_price; 
                                        $Sub_total = $Sub_total + $show_detail->row($vendor_selected_price."_amount"); 
                                        echo number_format($show_detail->row($vendor_selected_price."_amount"),2);
                                        ?>
                                    </td>
                                </tr>        
                                <?
                                }
                            $no++;
                            }
                        }else{?>
                            <tr><td colspan="6" align="center">-Item not found-</td></tr>
                        <?
                        }   
                        ?>
                        <tr>
                            <td colspan="4" rowspan="3">
                                <p style="margin:auto;">SAY : </p>
                                <div style="min-height:50px">
                                <!-- input data -->
                                <? echo strlen($show->row('notes')) ? $show->row('notes') : '-';?>
                                </div>
                            </td>
                            <td>Sub-Total</td>
                            <td style="text-align:right;"><?=number_format($Sub_total,2)?></td>
                        </tr>
                        <tr>
                            <td>VAT 10%</td>
                            <td style="text-align:right;">
                                <?
                                $tax = $Sub_total * 0.1;
                                echo number_format($tax,2);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>TOTAL</b></td>
                            <td style="text-align:right;"><? echo number_format($Sub_total + $tax,2);?></td>
                        </tr>
                    </tbody>
                </thead>
            </table>
            <table class="w-100 mb-3">
                <tr>
                    <td>Note</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td width="1%" style="vertical-align: top;">1</td>
                    <td width="25%" style="vertical-align: top;">Billing Terms</td>
                    <td width="1%" style="vertical-align: top;">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td width="73%">
                        Billing by attaching the following documents <br>
                        -&nbsp;&nbsp;Invoice<br>
                        -&nbsp;&nbsp;Copy of Purchase Order that has been signed and stamped by the seller<br>
                        -&nbsp;&nbsp;Kwitansi dan Tax Receipts (Faktur PPN)
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">2</td>
                    <td style="vertical-align: top;">VAT invoice on behalf of</td>
                    <td style="vertical-align: top;">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>
                        <b>
                            <?=$show_site->row('group_name')?> <br>
                            <?=$show_site->row('group_address')?> <br>
                            <?=$show_site->row('npwp')?>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">3</td>
                    <td style="vertical-align: top;">Billing Deadline</td>
                    <td style="vertical-align: top;">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>Maximum 1 month after delivery</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">4</td>
                    <td  colspan="3" style="vertical-align: top;">Goods sent must be in accordance with the specifications listed in the PO and / or according to the sample approved by the buyer. if proven to have violated, it will be legally processed, the remaining invoice is not paid and compensates for all losses incurred</td>
                </tr>
            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <div class="row justify-content-around">
                            <div class="col-6" style="display: flex;justify-content: center;">
                                <table>
                                    <tr>
                                        <td>
                                        <p class="text-center"><b>Buyer</b></p>
                                        <!-- input data -->
                                        <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                                            <!-- GAMBAR TTD -->
                                            <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                                        </div>
                                        <p class="text-center"><b>(&nbsp;<?=$show->row('buyer_name')?>&nbsp;)</b></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6" style="display: flex;justify-content: center;">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-center"><b>Seller</b></p>
                                            <!-- input data -->
                                            <div style="min-height: 100px;display: flex;justify-content: center;align-items: center;padding-bottom:5px;">
                                                <!-- GAMBAR TTD -->
                                                <!-- <img  width="80px;" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                                            </div>
                                            <p class="text-center"><b>(&nbsp;<?=$show->row('seller_name')?>&nbsp;)</b></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
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