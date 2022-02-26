<?
$show         = cmsDB();

$show_site    = cmsDB();

$master_lkpb  = cmsDB();

$head         = cmsDB();

$send         = cmsDB();

$auto         = cmsDB();


$user_id = $_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
$id = decryptStringArray(uriParam("lkpb_id"));



$qry_lkpb = "select * from master_lkpb where is_deleted=0";

$master_lkpb->query($qry_lkpb);



$query = "select * from ref_lkpb where lkpb_id=".$id;

$show->query($query);

$show->next();



$qry = "select * from master_group_location where group_location_id=".$show->row("group_location_id");

$show_site->query($qry);

$show_site->next();



$itself = true;

if($show_site->row('position') == 'HO'){

  // $qry2 = "select * from "



}else{

  $head->query("select user_id, full_name, superior_id from ref_user where user_id=".$show->row('insert_by'));

  $head->next();

  $superior_id   = $head->row('superior_id');

  $superior_name = $head->row('full_name');



  if($superior_id <> 0){

    $itself = false;

    $head->query("select user_id, full_name from ref_user where user_id=".$superior_id);

    $head->next();

    $superior_name = $head->row('full_name');

  }

}

?>

<table width="100%">
    <tr>
        <td align="center" style="font-size: 16px;"><b><u>Laporan Kejadian Potensi Bahaya</u></b></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="50%">
            <table cellpadding="2" cellspacing="0">
                <tr>
                    <td align="left">Nomor</td>
                    <td align="left">:</td>
                    <td align="left"><?=$show->row("lkpb_no")?></td>
                </tr>
                <tr>
                    <td align="left">Tanggal</td>
                    <td align="left" width="10">:</td>
                    <td align="left"><?=datesql2date($show->row("date"))?></td>
                </tr>
                <tr>
                    <td align="left">Dept / Lokasi</td>
                    <td align="left">:</td>
                    <td align="left"><?=$show_site->row("group_name_alias")?></td>
                </tr>
                <tr>
                    <td align="left">Jam Terjadi</td>
                    <td align="left">:</td>
                    <td align="left"><?=hourMinute($show->row("hour"))?></td>
                </tr>
            </table>
        </td>
        <td width="50%">
            <table cellpadding="2" cellspacing="0">
                <?php
                    while ($master_lkpb->next()) { ?>
                    <tr>
                        <td align="left" width="5%">
                            <?if(ListFind($show->row("master_lkpb_id"), $master_lkpb->row("master_lkpb_id"))){
                                echo '<span style="font-family: fontawesome;color">&#xf14a;</span>';
                            }else{
                                echo '<span style="font-family: fontawesome;color">&#xf0c8;</span>';
                            }?>
                        </td>
                        <td align="left" ><i>&nbsp;<?=$master_lkpb->row("name")?></i></td>
                    </tr>
                <? } ?>
            </table>
        </td>
    </tr>
</table>

<table width="100%" border="1" cellspacing="0">
    <tr>
        <td width="80%" align="left" valign="top" style="padding: 5px 5px;height: 100px" >
            <p><b>Uraian terjadinya potensi bahaya dan atau insiden</b></p>
            <p><?=$show->row("uraian")?></p>
        </td>
        <td width="20%" align="center" valign="top"  style="padding: 5px 5px;height: 100px" >
            <b>Kepala unit</b>
            <? if ($show->row('status_id') == 1){ ?>
                &nbsp;
            <? }else if($show->row('status_id') == 4){?>
                &nbsp;
            <? } ?>
            <p><?=$superior_name?></p>
        </td>
    </tr>

</table>
<table width="100%">
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align="center" style="font-size: 12px">
            <b>POTENSI BAHAYA/NEAR MISS INVESTIGATION (dilakukan oleh atasan terkait)</b>
        </td>
    </tr>
</table>

<table width="100%">
       <tr>
           <td style="vertical-align: top;" width="18%">Akar Masalah</td>
           <td style="vertical-align: top;" width="2%">:</td>
           <td width="70%"><?=$show->row("akar_masalah")?></td>
       </tr>
       <tr>
           <td style="vertical-align: top;">Tindakan Sementara</td>
           <td style="vertical-align: top;">:</td>
           <td><?=$show->row("tindakan_sementara")?></td>
       </tr>
       <tr>
           <td style="vertical-align: top;">Tanggal Penerapan</td>
           <td style="vertical-align: top;">:</td>
           <td><?=datesql2date($show->row("tanggal_penerapan"))?></td>
       </tr>
       
</table>
<table width="100%" border="1" cellspacing="0">
    <tr>
        <td style="vertical-align : top;text-align:left;padding:5px 10px;">
            <p><b>Documentation</b></p>
            <div style="text-align: center;">
                <?if(strlen($show->row('documentation1')) > 5){?>
                    <img style="width: 300px" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation1')?>">
                <?}?>

                <?if(strlen($show->row('documentation2')) > 5){?>
                    <img style="width: 300px" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation2')?>">
                <?}?>

                <?if(strlen($show->row('documentation3')) > 5){?>
                    <img style="width: 300px" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation3')?>">
                <?}?>

                <?if(strlen($show->row('documentation4')) > 5){?>
                    <img style="width: 300px" src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show->row('documentation4')?>">
                <?}?>
            </div>
        </td>
    </tr>

</table>