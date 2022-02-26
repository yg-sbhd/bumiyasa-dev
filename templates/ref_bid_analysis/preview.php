<?php
$show_site=cmsDB();
$show = cmsDB();
$detail = cmsDB();
$detail_5 = cmsDB();
$approval = cmsDB();
$bid_analys_id = decryptStringArray(uriParam('bid_analys_id'));

$qry="select * from ref_bid_analys where bid_analys_id=".$bid_analys_id;
$show->query($qry);
$show->next();


$qry = "select * from master_group_location where group_location_id in (select group_location_id from ref_purchase_request where purchase_request_id='".$show->row('purchase_request_id')."')";
$show_site->query($qry);
$show_site->next();

$detail->query("select * from ref_bid_analys_detail where is_deleted=0 and component_item<>5 and bid_analys_id=".$bid_analys_id." order by component_item");
$detail_5->query("select * from ref_bid_analys_detail where is_deleted=0 and component_item=5 and bid_analys_id=".$bid_analys_id." order by component_item");
?>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form Bid Analysis</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Financial / Bid Analysis / Preview</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div style="overflow-x: auto;">
<div class="A3 landscape" id="printArea">
        <section class="sheet padding-10mm">
            <table class="w-100 mb-3">
                <tr>
                    <td>
                        <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>" style="width: 100px;">
                    </td>
                    <td class="p-3">
                        <h3><b><?=$show_site->row("group_name")?></b></h3>
                        <p><?=$show_site->row("group_address")?></p>
                    </td>
                    <td>
                        <h4 style="padding-top:20px;"><b><u>BID ANALYSIS</u></b></h4>
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
                                        <td width="5%">BA Number</td>
                                        <td width="1%">:</td>
                                        <td width="20%"><? echo strlen($show->row('bid_analys_no')) ? $show->row('bid_analys_no') : '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td>BA Date</td>
                                        <td>:</td>
                                        <td><? echo strlen($show->row('bid_analys_no')) ? datesql2date($show->row('bid_analys_no')) : '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="w-100 mb-3 border-table">
                <tr>
                    <th style="text-align: center;vertical-align: middle;">PR Number</th>
                    <!-- <th style="text-align: center;vertical-align: middle;">RFQ Number</th> -->
                    <th style="text-align: center;vertical-align: middle;" colspan="2">Subject</th>
                    <th style="text-align: center;vertical-align: middle;">Currency</th>
                </tr>
                <tr style="text-align: center;vertical-align: middle;">
                    <td><?=$show->row('purchase_request_id_txt')?></td>
                    <!-- <td>Select list RFQ Number</td> -->
                    <td>
                        <? echo get_from_db("ref_purchase_request", "pr_subject_id_txt", "purchase_request_id", $show->row('purchase_request_id'));
                        ?>
                    </td>
                    <td>
                        <? echo get_from_db("ref_purchase_request", "pr_component_id_txt", "purchase_request_id", $show->row('purchase_request_id'));
                        ?>
                    </td>
                    <td>
                        <? echo get_from_db("ref_request_for_quotation", "rfq_currency_id_txt", "request_for_quotation_id", $show->row('request_for_quotation_id'));
                        ?>
                    </td>
                </tr>
            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <p style="text-align:center;margin:auto !important;"><b>COMPARATION DATA</b></p>
                    </td>
                </tr>
            </table>
            <table class="w-100 border-table">
                <?while ($detail->next()) {?>
                    <?if($detail->row('component_item') == 1){?>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;" width="28%" colspan="3">Description</th>
                            <th style="text-align: center; vertical-align: middle;" width="18%" colspan="2">
                                <? echo get_from_db("master_vendor", "vendor_company", "vendor_id", $detail->row('vendor1'));
                                ?>
                            </th>
                            <th style="text-align: center; vertical-align: middle;" width="18%" colspan="2">
                                <? echo get_from_db("master_vendor", "vendor_company", "vendor_id", $detail->row('vendor2'));
                                ?>
                            </th>
                            <th style="text-align: center; vertical-align: middle;" width="18%" colspan="2">
                                <? echo get_from_db("master_vendor", "vendor_company", "vendor_id", $detail->row('vendor3'));
                                ?>
                            </th>
                            <th style="text-align: center; vertical-align: middle;" width="18%" colspan="2" rowspan="4">BUDGET ESTIMATE</th>
                        </tr>
                    <?}?>
                    <?if($detail->row('component_item') == 2){?>
                        <tr>
                            <td colspan="3">RFQ Number</td>
                            <td colspan="2">
                                <? echo get_from_db("ref_request_for_quotation", "request_for_quotation_no", "request_for_quotation_id", $detail->row('vendor1'));
                                ?>
                            </td>
                            <td colspan="2">
                                 <? echo get_from_db("ref_request_for_quotation", "request_for_quotation_no", "request_for_quotation_id", $detail->row('vendor2'));
                                ?>
                            </td>
                            <td colspan="2">
                                 <? echo get_from_db("ref_request_for_quotation", "request_for_quotation_no", "request_for_quotation_id", $detail->row('vendor3'));
                                ?>
                            </td>
                        </tr>

                    <?}?>
                    <?if($detail->row('component_item') == 3){?>
                        <tr>
                            <td colspan="3">Quotation Number</td>
                            <td colspan="2"><?=$detail->row('vendor1')?></td>
                            <td colspan="2"><?=$detail->row('vendor2')?></td>
                            <td colspan="2"><?=$detail->row('vendor3')?></td>
                        </tr>
                    <?}?>
                    <?if($detail->row('component_item') == 4){?>
                        <tr>
                            <td colspan="3">Quotation Date</td>
                            <td colspan="2"><?=$detail->row('vendor1')?></td>
                            <td colspan="2"><?=$detail->row('vendor2')?></td>
                            <td colspan="2"><?=$detail->row('vendor3')?></td>
                        </tr>
                        <tr style= "background-color:#ccc; font-weight:bold;" >
                            <td style="text-align: center;vertical-align: middle;"  width="22%">Breakdown price at cost structure</td>
                            <td style="text-align: center;vertical-align: middle;"  width="6%">Qty</td>
                            <td style="text-align: center;vertical-align: middle;"  width="6%">Unit</td>
                            <td style="text-align: center;vertical-align: middle;"  width="9%">Unit Price</td>
                            <td style="text-align: center;vertical-align: middle;"  width="9%">Amount</td>
                            <td style="text-align: center;vertical-align: middle;"  width="9%">Unit Price</td>
                            <td style="text-align: center;vertical-align: middle;"  width="9%">Amount</td>
                            <td style="text-align: center;vertical-align: middle;"  width="9%">Unit Price</td>
                            <td style="text-align: center;vertical-align: middle;"  width="9%">Amount</td>
                            <td style="text-align: center;vertical-align: middle;"  width="9%">Unit Price</td>
                            <td style="text-align: center;vertical-align: middle;"  width="9%">Amount</td>
                        </tr>
                    <?
                    $no = 4;
                    while ($detail_5->next()) {?>
                        <tr>
                            <td width="28%">
                                <?=$detail_5->row('component')?>
                            </td>
                            <td align="right"><?=number_format($detail_5->row('qty'), 2)?></td>
                            <td align="center">-</td>

                            <td align="right"><?=number_format($detail_5->row('vendor1_price'), 2)?></td>
                            <td align="right"><?=number_format($detail_5->row('vendor1_amount'), 2)?></td>

                            <td align="right"><?=number_format($detail_5->row('vendor2_price'), 2)?></td>
                            <td align="right"><?=number_format($detail_5->row('vendor2_amount'), 2)?></td>

                            <td align="right"><?=number_format($detail_5->row('vendor3_price'), 2)?></td>
                            <td align="right"><?=number_format($detail_5->row('vendor3_amount'), 2)?></td>

                            <td align="right"><?=number_format($detail_5->row('estimate_price'), 2)?></td>
                            <td align="right"><?=number_format($detail_5->row('estimate_amount'), 2)?></td>
                        </tr>
                    <?
                    $no++;
                    }
                }
                ?>
                    

                 <!-- <tr style="text-align: center;vertical-align: middle;">
                    <td>dummy</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> -->
                <?if($detail->row('component_item') == 6){?>

                    <tr style= "background-color:#ccc; font-weight:bold">
                        <td colspan="3">Other's Factor</td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <td colspan="3">1. Term of Payment</td>
                        <td colspan="2">
                                 <? 
                                 echo get_from_db("master_rfq_payment", "name", "rfq_payment_id", $detail->row('vendor1'));
                                 ?>
                        </td>
                        <td colspan="2">
                            <? 
                                 echo get_from_db("master_rfq_payment", "name", "rfq_payment_id", $detail->row('vendor2'));
                                 ?>
                        </td>
                        <td colspan="2">
                            <? 
                                 echo get_from_db("master_rfq_payment", "name", "rfq_payment_id", $detail->row('vendor3'));
                                 ?>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                <?}?>
                <?if($detail->row('component_item') == 7){?>
                    <tr>
                        <td colspan="3">2. Delivery Date</td>
                        <td colspan="2"><?=$detail->row('vendor1')?></td>
                        <td colspan="2"><?=$detail->row('vendor2')?></td>
                        <td colspan="2"><?=$detail->row('vendor3')?></td>
                        <td colspan="2"></td>
                    </tr>
                    
                    <tr style= "background-color:#ccc; font-weight:bold">
                        <td colspan="3">Scoring</td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                    </tr>
                <?}?>
                <?if($detail->row('component_item') == 8){?>
                    <tr>
                        <td colspan="3">1. Price</td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor1'),2)?></td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor2'),2)?></td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor3'),2)?></td>
                        <td colspan="2" align="right"></td>
                    </tr>
                <?}?>
                <?if($detail->row('component_item') == 9){?>
                    <tr>
                        <td colspan="3">2. Technical</td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor1'),2)?></td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor2'),2)?></td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor3'),2)?></td>
                        <td colspan="2" align="right"></td>
                    </tr>
                <?}?>
                <?if($detail->row('component_item') == 10){?>
                    <tr>
                        <td colspan="3">3. Other</td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor1'),2)?></td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor2'),2)?></td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor3'),2)?></td>
                        <td colspan="2" align="right"></td>
                    </tr>
                <?}?>
                <?if($detail->row('component_item') == 11){?>
                    <tr>
                        <td style="text-align: right;" colspan="3">Total Score</td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor1'),2)?></td>
                        <td colspan="2" align="right"><?=number_format($detail->row('vendor2'),2)?></td>
                        <td colspan="2" align="right"></td>
                        <td colspan="2" align="right"></td>

                    </tr>
                <?}}?>
            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <p style="margin:auto !important;"><b>Results of negotiations</b></p>
                    </td>
                </tr>
            </table>
            <table class="w-100 mb-3">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-8">
                                <table class="border-table">
                                    <tr>
                                        <td width="10%" style="text-align: center;"><b>Selected Vendor</b></td>
                                        <td width="15%"><?=$show->row("selected_vendor_id_txt")?></td>
                                    </tr>
                                    <tr>
                                        <td width="" style="text-align: center;"><b>Contracted Price</b></td>
                                        <td width=""><?=number_format($show->row("contract_price"),2)?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-3">
                                <table>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="10%" ><p style="margin;auto;text-align: center;">Sign For Approval</p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-8">
                                <table class="border-table" style="text-align:center;">
                                    <tr>
                                        <th width="10%">Operating Dept</th>
                                        <th width="10%">Financial Dept</th>
                                        <th width="10%">Development Dept</th>
                                    </tr>
                                    <tr>
                                        <td>Approve / Disapprove</td>
                                        <td>Approve / Disapprove</td>
                                        <td>Approve / Disapprove</td>
                                    </tr>
                                    <tr>
                                        <?
                                        $qryy = "Select * from master_ba_approval where is_deleted=0 order by approval_order";
                                        $approval->query($qryy);
                                        while ($approval->next()) {
                                            if($approval->row('approval_order') == 1){?>
                                                <td>
                                                    <div style="justify-content: center;align-items: center;padding-bottom:5px;">
                                                    <div style="min-height: 100px;"></div>
                                                        <!-- <img  width="80px;" class="d-block mx-auto" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                                                        <p><?=$approval->row('user_id_txt')?></p>
                                                    </div>
                                                </td>
                                            <?
                                            }

                                            if($approval->row('approval_order') == 2){?>
                                                <td>
                                                    <div style="justify-content: center;align-items: center;padding-bottom:5px;">
                                                    <div style="min-height: 100px;"></div>
                                                        <!-- <img  width="80px;" class="d-block mx-auto" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                                                        <p><?=$approval->row('user_id_txt')?></p>
                                                    </div>
                                                </td>
                                           

                                            <?
                                            }

                                            if($approval->row('approval_order') == 3){?>
                                                <td>
                                                    <div style="justify-content: center;align-items: center;padding-bottom:5px;">
                                                    <div style="min-height: 100px;"></div>
                                                        <!-- <img  width="80px;" class="d-block mx-auto" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                                                        <p><?=$approval->row('user_id_txt')?></p>
                                                    </div>
                                                </td>
                                            <?
                                            }
                                        }
                                        ?>


                                    </tr>
                                </table>
                            </div>
                            <div class="col-3 ml-5">
                                <table class="border-table">
                                    <tr><td align="center"><b>President Director</b></td></tr>
                                    <tr><td align="center">Approve / Disapprove</td></tr>
                                    <tr>
                                        <td width="1%" align="center" style="position:relative;">
                                           <div style="justify-content: center;align-items: center;padding-bottom:5px;">
                                           <div style="min-height: 100px;"></div>
                                                        <!-- <img  width="80px;" class="d-block mx-auto" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>"> -->
                                                        <p>-</p>
                                                    </div>
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