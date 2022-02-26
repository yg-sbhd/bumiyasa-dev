<?php

$show_site=cmsDB();

$qry = "select * from master_group_location where group_location_id=2";



$show_site->query($qry);



$show_site->next();

?>

<div class="container-fluid" style="overflow-x: auto !important;">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12 mx-auto" style="border: 1px dotted #000;">
                    <div class="table-responsive table-hover">
                        <table class="table"> 
                            <tr>
                                <td style="vertical-align : middle;text-align:center;" colspan="4">
                                <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_site->row('image')?>">
                                </td>
                                <td style="vertical-align : middle;text-align:left;" colspan="20">
                                <h3><b><?=$show_site->row("group_name")?></b></h3>
                                <p><?=$show_site->row("group_address")?></p>
                                </td>
                                <td style="vertical-align : middle;text-align:center;" colspan="10"><h4 style="padding-top:20px;"><b><u>BID ANALYSIS</u></b></h4></td>
                            </tr>
                            <tr>
                                <td colspan="4">BA Number</td>
                                <td>:</td>
                                <td colspan="29">By system (00/BA/III/LGW/2021)</td>
                            </tr>
                            <tr>
                                <td colspan="4">BA Dater</td>
                                <td>:</td>
                                <td colspan="29">By system (Date)</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="8"><b>PR Number</b></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="8"><b>RFQ Number</b></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="14"><b>Subject</b></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="4"><b>Currency</b></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="8">Select list PR Number</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="8">Select list RFQ Number</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="7">Call to Subject at RCD-FIN-01</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="7">Call to Component at RCD-FIN-01</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="4">call to currency at RCD-FIN-02</td>
                            </tr>
                            <tr>
                                <td style="vertical-align : middle;text-align:center; font-size:12px;" colspan="34"><b>COMPARATION DATA</b></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="10">Description</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">input Vendor 1 Name</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">input Vendor 2 Name</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">input Vendor 3 Name</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6" rowspan="3"><b>BUDGET ESTIMATE</b></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:left;" colspan="10">Quotation Number</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:left;" colspan="10">Quotation Date</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr class="table-border">
                                <th style="border:1px solid #000;vertical-align : middle;text-align:left;" colspan="8">Breakdown price at cost structure</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="2">Qty</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Unit Proce</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Amount</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Unit Proce</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Amount</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Unit Proce</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Amount</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Unit Proce</th>
                                <th style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Amount</th>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="8">call to Product Name at RCD-FIN-01</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="2">Call to Qty at RCD-FIN-01</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Input Price</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Input Price</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Input Price</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3">Input Price</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="8"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="1"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="1"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="3"></td>
                            </tr>
                            <tr class="table-border">
                                <td style="border:1px solid #000;vertical-align : middle;text-align:left;" colspan="10">Other's Factor</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr class="bordered">
                                <td style="vertical-align : middle;text-align:left;" colspan="1">1</td>
                                <td style="vertical-align : middle;text-align:left;" colspan="9">Term of Payment</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">Input Term of Payment from Quotation</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr class="bordered">
                                <td style="vertical-align : middle;text-align:left;" colspan="1">2</td>
                                <td style="vertical-align : middle;text-align:left;" colspan="9">Delivery Date</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">Input Delivery Date from Quotation</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr class="table-border">
                                <td style="border:1px solid #000;vertical-align : middle;text-align:left;" colspan="10">Scoring</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr class="bordered">
                                <td style="vertical-align : middle;text-align:left;" colspan="1">1</td>
                                <td style="vertical-align : middle;text-align:left;" colspan="9">Price</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">Input Price Score</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr class="bordered">
                                <td style="vertical-align : middle;text-align:left;" colspan="1">2</td>
                                <td style="vertical-align : middle;text-align:left;" colspan="9">Technical</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">Input Technical score</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr class="bordered">
                                <td style="vertical-align : middle;text-align:left;" colspan="1">3</td>
                                <td style="vertical-align : middle;text-align:left;" colspan="9">Other</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">Input Other's factor score</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:right;" colspan="10">Total Score</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"></td>
                            </tr>
                            <tr>
                                <td style="border:0 !important;"colspan="34"><b>Results of negotiations</b></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="5"><b>Selected Vendor</b></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:left;" colspan="13">Input Final Vendor</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="5"><b>Contracted Price</b></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:left;" colspan="13">Input Final Price</td>
                                <td colspan="3"></td>
                                <td style="vertical-align : middle;text-align:center;" colspan="10">Sign For Approval</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"><b>Operating Dept</b></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"><b>Financial Dept</b></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6"><b>Development Dept</b></td>
                                <td colspan="3" rowspan="3"></td>
                                <td height="70px" style="border:1px solid #000;vertical-align : bottom;text-align:center;" colspan="10" rowspan="3">COO / CFO</td>
                                <td colspan="3" rowspan="3"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">Approve / Disapprove</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">Approve / Disapprove</td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" colspan="6">Approve / Disapprove</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" height="70px" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" height="70px" colspan="6"></td>
                                <td style="border:1px solid #000;vertical-align : middle;text-align:center;" height="70px" colspan="6"></td>
                            </tr>
                            <tr>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
            
                        
            
                        <style>
            
                        .table{
            
                            font-size:12px;
            
                        }
                        .bordered{
                            border:1px solid #000;
                        }
                        .table-border{
                            font-weight:bold;
                            background-color:#d8d8d8;
                        }
            
                        .table > thead > tr > th{
            
                            border:0;
            
                            font-size:12px;
            
                        }
            
                        .table > thead > tr > td{
            
                            border:0;
            
                            font-size:12px;
            
                            word-break:break-all;
            
                        }
            
                        .table > tbody > tr > td{
            
                            border:0;
            
                            font-size:12px;
            
                            word-break:break-all;
            
                        }
            
                        </style>
            
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>