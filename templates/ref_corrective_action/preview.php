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
                    <h3 class="text-center"><b><u>Corrective Action Request (CAR)</u></b></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table style="font-size: 12px">
                        <tr>
                            <td>CAR Number</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>By system (00/LKPB/III/LGW/2021)</td>
                        </tr>
                        <tr>
                            <td>CAR Date</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>By system (Date)</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table style="font-size:12px">
                        <tr>
                            <td>Reff Number</td>
                            <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>By system (00/LKPB/III/LGW/2021)</td>
                        </tr>
                        <tr>
                            <td>Reff Date</td>
                            <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                            <td>By system (Date)</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-5">
                    <table  style="font-size: 12px">
                    <tr>
                            <td>CAR Type</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td><i class="icon-check-empty"></i></td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>Audit</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td><i class="icon-check-empty"></i></td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>Inspection</td>
                        </tr>
                    </table>
                    <br>
                    
                    <table style="font-size: 12px">
                      <tr>
                            <td>Dept / Location</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                            <td></td>
                        </tr>
                    </table>
                    <br>

                    <table style="font-size: 12px">
                      <tr>
                            <td>Auditor / Inspec</td>
                            <td>&nbsp;&nbsp;&nbsp;:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Auditee</td>
                            <td>&nbsp;&nbsp;&nbsp;:</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-7">
                    <table  style="font-size: 12px">
                        <tr>
                            <td width="30px;" style="border: 1px solid #000 !important;" class="rotated text-center" rowspan="6"><b>PURPOSE</b></td>
                            <td>&nbsp;</td>
                            <td><i class="icon-check-empty"></i></td>
                            <td>&nbsp;</td>
                            <td>Audit Mutu dan Lingkungan Internal.</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><i class="icon-check-empty"></i></td>
                            <td>&nbsp;</td>
                            <td>Karyawan yang menemukan ketidak sesuaian.</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><i class="icon-check-empty"></i></td>
                            <td>&nbsp;</td>
                            <td>Audit Mutu dan Lingkungan External.</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><i class="icon-check-empty"></i></td>
                            <td>&nbsp;</td>
                            <td>Keluhan Pelanggan.</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><i class="icon-check-empty"></i></td>
                            <td>&nbsp;</td>
                            <td>Keluhan Stake Holder.</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><i class="icon-check-empty"></i></td>
                            <td>&nbsp;</td>
                            <td>Other, specify : ..............................................</td>
                        </tr>
                    </table>
                </div>
            </div>
            <style>
                .rotated {
                    writing-mode: tb-rl;
                    transform: rotate(-180deg);
                }
            table.table-bordered{
                border:1px solid #000;
                margin-top:20px;
                table-layout: auto;
                width:100%;
            }
            table.table-bordered > thead > tr > th{
                border:1px solid #000;
                font-size: 12px;
            }
            table.table-bordered > tbody > tr > td{
                border:1px solid #000;
                word-break:break-all;
                font-size:12px;
            }
            table tbody>tr>td{
                border-top: none !important;
                word-break:break-all;
                
            }
            </style>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <table class="table table-bordered" >
                            <tr>
                                <td width="75%" colspan="3" style="text-align: left;vertical-align: top;">
                                    <b>Finding / Observation Details</b>
                                    <p></p>
                                </td>
                                <td width="25%">
                                    <table style="font-size:12px; align: center;" align="center">
                                        <tr>
                                            <td colspan="2" style="text-align: center;vertical-align: top;"><b>Category</b></td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;"><i class="icon-check-empty"></i></td>
                                            <td>Major</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;"><i class="icon-check-empty"></i></td>
                                            <td>Minor</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;"><i class="icon-check-empty"></i></td>
                                            <td>Observation</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" height="100px">
                                    <b>Penyebab terjadinya temuan / Root Cause</b>
                                    <p></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: center;vertical-align: middle;">
                                    <b>Corrective Action Details</b>
                                </td>
                            </tr>
                            <tr>
                                <td width="7%" style="text-align: center;vertical-align: middle;"><b>No</b></td>
                                <td width="43%" style="text-align: center;vertical-align: middle;"><b>Corrective Action</b></td>
                                <td width="25%" style="text-align: center;vertical-align: middle;"><b>PIC</b></td>
                                <td width="25%" style="text-align: center;vertical-align: middle;"><b>Due Date</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2">Auditor/Inspector Sign :</td>
                                <td colspan="2">Auditee Sign :</td>
                            </tr>
                            <tr style="background-color:#d8d8d8;">
                                <td  colspan="2" rowspan="2" style="position:relative;text-align: left; vertical-align: top;        word-wrap:break-word;" height="100px" width="30%">
                                    <div>
                                        <p>Verification : </p>
                                    </div>
                                    <br>

                                    <div>
                                        <p></p>
                                        <p class="text-right" style="border-top:1px solid #000;position:absolute;top:90%; left: 65%; right:5%;text-align:center;"><b>Auditor/Inspector</b></p>
                                    </div>
                                </td>
                                <td colspan="2" style="position:relative;" height="100px" width="30%">
                                    <p class="text-center" style="position:absolute;top:5%; left: 0; right:0;font-weight:bold;"><b>Approved</b></p>
                                    <p class="text-center" style="position:absolute;top:80%; left: 0; right:0;"><b>. . . . Director</b></p></td>
                                </td>
                            </tr>
                            <tr style="background-color:#d8d8d8;">
                                <td>
                                    <table style="font-size:12px;" align="center">
                                        <tr>
                                            <td align="center" colspan="2" style="text-align: center;"><b>CAR Status</b></td>
                                        </tr>
                                    </table>
                                    <table style="font-size:12px;" align="left">
                                        <tr>
                                            <td><i class="icon-check-empty"></i></td>
                                            <td>Closed</td>
                                        </tr>
                                        <tr>
                                            <td ><i class="icon-check-empty"></i></td>
                                            <td>Open</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="position:relative;" height="100px">
                                <p class="text-center" style="position:absolute;top:80%; left: 0; right:0;"><b>. . . . Director</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>