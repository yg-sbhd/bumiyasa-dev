<?php
include "../../config.php";
$pltm = get_from_db("master_group_location", "group_name_alias", "group_location_id", decryptStringArray(uriParam('group_location_id')));
$unit = decryptStringArray(uriParam('unit_id'));
$date = datesql2date(decryptStringArray(uriParam('date')));
$name = $pltm." - unit ".$unit." - ".$date;
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Logsheet ".$name.".xls");

   $select_unit = cmsDB();

   $show_unit = cmsDB();

   $unit = cmsDB();

   // $sum = cmsDB();

   $production= cmsDB();

   if (isset($_GET['add_production']) && uriParam('add_production')=='yes') {
     edit_production_kwh(uriParam('group_location_id'), uriParam('date'), postParamSimple('production'));
     ?>
     <script>
       location='index-template.php?tmp=<?=uriParam('tmp')?>&group_location_id=<?=uriParam('group_location_id')?>&unit_id=<?=uriParam('unit_id')?>&date=<?=uriParam('date')?>'
     </script>
     <?
     die();
     
   }

   $select_unit->query("select * from master_group_location");


   // if(isset($_GET["search"])){

   //    $query   = "select * from master_group_location where group_location_id=2";

   //    $date    = date("d/m/Y"); 

   //    $unit_id = uriParam('unit_id');

   // }else if($_POST["frmSearch"]=="yes"){

   //    $site    = $_POST['group_location_id'];

   //    $date    = $_POST['calendar'];

   //    $unit_id = $_POST['unit_id'];



   //    $query   = "select * from master_group_location where group_location_id=".$site;

   //    $query2  = "select * from master_unit where unit_id=".$unit_id;



   // }else{

   //    $query   = "select * from master_group_location where group_location_id=2";

   //    $query2  = "select * from master_unit where unit_id=1";

   //    $unit_id = 1;

   //    $site = 1;

   //    $date    = date("d/m/Y");

   // }



   if(isset($_GET['group_location_id']) && isset($_GET['unit_id']) && isset($_GET['date'])){

      $param1 = decryptStringArray(uriParam('group_location_id'));

      $param2 = decryptStringArray(uriParam('unit_id'));

      $param3 = decryptStringArray(uriParam('date'));

      $query   = "select * from master_group_location where group_location_id=".$param1;

      $query2  = "select * from master_unit where unit_id=".$param2;

   }

   $show_unit->query($query);

   $show_unit->next();

   $unit->query($query2);

   $unit->next();

   // $tomorrow = date ('Y-m-d',strtotime('+1 day', strtotime($param3)));

   $qry_production = "select kwh from ref_logsheet_production where group_location_id='".decryptStringArray(uriParam('group_location_id'))."' and  date='".decryptStringArray(uriParam('date'))." and is_deleted=0'";
   $production->query($qry_production);
   if($production->recordCount()){
      $production->next();
      $total_kwh = $production->row('kwh');
   }else{
     $total_kwh = 0.00;
   }
   // $qry_sum = "SELECT SUM(kontrol_20kv_load_kw) as total FROM ref_logsheet WHERE is_deleted=0 and date_jam >=

   //  '".$param3." 10:00:00' AND date_jam<='".$tomorrow." 09:59:00' and unit_id=$param2 and group_location_id=$param1";

   // $sum->query($qry_sum);

   // $sum->next();

?>
<!-- 

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Form Logsheet</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Logsheet / Preview</li>
        </ol>
      </div>
    </div>
  </div>
</div> -->

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table border="1" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <td style="vertical-align : middle;text-align:center;" rowspan="4" colspan="2">
                    <img src="<?=$ANOM_VARS["www_file_url"]?>upload_photo/<?=$show_unit->row('image')?>" style="max-height: 30px;">
                  </td>
                  <td style="vertical-align : middle;text-align:center;" rowspan="4" colspan="7">
                    <p><b><?=$show_unit->row('group_name')?></b></p>
                  </td>
                  <td style="vertical-align : middle;text-align:center;" rowspan="4" colspan="15"><b>LAPORAN HARIAN OPERASI <br />
                    <?=$show_unit->row('group_name_alias')?></b>
                  </td>
                  <td colspan="3"><b>Hari</b></td>
                  <td colspan="20"><?=hari(date('D', strtotime($param3)));?></td>
                  <td style="vertical-align : middle;text-align:center;" rowspan="4" colspan="3"><img src="<?=$ANOM_VARS["www_file_url"]?>upload_files/logo-pln.jpg" style="width: 30px;"></td>
                </tr>
                <tr>
                  <td colspan="3"><b>Tanggal</b></td>
                  <td colspan="20" align="left"><?=date("d-m-Y", strtotime($param3));?></td>
                </tr>
                <tr>
                  <td colspan="3"><b>Unit</b></td>
                  <td colspan="20"><?=$unit->row('unit_number')?> (<?=$unit->row('unit_name')?>)</td>
                </tr>
                <tr>
                  <td colspan="3"><b>Produksi</b></td>
                  <td colspan="20">
                    <?=$total_kwh?> Kwh
                </td>
              </tr>
              <tr>
                <td style="vertical-align : middle;text-align:center;" rowspan="3">JAM</td>
                <td style="vertical-align : middle;text-align:center;" colspan="4">KONTROL 20 kV</td>
                <td style="vertical-align : middle;text-align:center;" colspan="10">KONTROL GENERATOR 6,3 kV</td>
                <td style="vertical-align : middle;text-align:center;">Kontrol EXC.</td>
                <td style="vertical-align : middle;text-align:center;" colspan="29">KONTROL GOVERNOR & TEMPERATUR</td>
                <td style="vertical-align : middle;text-align:center;" colspan="4">KONTROL PRESSURE TURBIN</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="3">Note</td>

              </tr>
              <tr>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Load KW</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Arus (A)</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Teg. (kV)</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Cos Q</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Load KW</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">kVAR</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">kVA</td>
                <td style="vertical-align : middle;text-align:center;" colspan="3">Arus (A)</td>
                <td style="vertical-align : middle;text-align:center;" colspan="3">TEGANGAN (Volt)</td>
                <td style="vertical-align : middle;text-align:center;">Freq.</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Arus Exc.</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Gov Open</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Press Oil</td>
                <td style="vertical-align : middle;text-align:center;" colspan="5">BEARING</td>
                <td style="vertical-align : middle;text-align:center;" colspan="12">GENERATOR</td>
                <td style="vertical-align : middle;text-align:center;" colspan="2">Baterai</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Suhu Ruang Gen</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Suhu Ruang</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Air Comp</td>
                <td style="vertical-align : middle;text-align:center;">Trafo</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Water Lavel</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Gate Van</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Oil Tank Pressure</td>
                <td style="vertical-align : middle;text-align:center;" rowspan="2">Penstock Pressure</td>
                <td style="vertical-align : middle;text-align:center;">Turbin</td>
                <td style="vertical-align : middle;text-align:center;">Draft Tube</td>
                <td style="vertical-align : middle;text-align:center;">Axial</td>
                <td style="vertical-align : middle;text-align:center;">Cooling</td>
              </tr>
              <tr>
                <td style="vertical-align : middle;text-align:center;">I1</td>
                <td style="vertical-align : middle;text-align:center;">I2</td>
                <td style="vertical-align : middle;text-align:center;">I3</td>
                <td style="vertical-align : middle;text-align:center;">R-S</td>
                <td style="vertical-align : middle;text-align:center;">S-T</td>
                <td style="vertical-align : middle;text-align:center;">R-T</td>
                <td style="vertical-align : middle;text-align:center;">Hz</td>
                <td style="vertical-align : middle;text-align:center;">1</td>
                <td style="vertical-align : middle;text-align:center;">2</td>
                <td style="vertical-align : middle;text-align:center;">3</td>
                <td style="vertical-align : middle;text-align:center;">4</td>
                <td style="vertical-align : middle;text-align:center;">5</td>
                <td style="vertical-align : middle;text-align:center;">1</td>
                <td style="vertical-align : middle;text-align:center;">2</td>
                <td style="vertical-align : middle;text-align:center;">3</td>
                <td style="vertical-align : middle;text-align:center;">4</td>
                <td style="vertical-align : middle;text-align:center;">5</td>
                <td style="vertical-align : middle;text-align:center;">6</td>
                <td style="vertical-align : middle;text-align:center;">7</td>
                <td style="vertical-align : middle;text-align:center;">8</td>
                <td style="vertical-align : middle;text-align:center;">9</td>
                <td style="vertical-align : middle;text-align:center;">10</td>
                <td style="vertical-align : middle;text-align:center;">11</td>
                <td style="vertical-align : middle;text-align:center;">12</td>
                <td style="vertical-align : middle;text-align:center;">A</td>
                <td style="vertical-align : middle;text-align:center;">V</td>
                <td style="vertical-align : middle;text-align:center;">C</td>
                <td style="vertical-align : middle;text-align:center;">MPa</td>
                <td style="vertical-align : middle;text-align:center;">Cm Hg</td>
                <td style="vertical-align : middle;text-align:center;">MPa</td>
                <td style="vertical-align : middle;text-align:center;">MPa</td>
              </tr>
            </thead>
            <tbody>
              <?php
              $detail = cmsDB();
              $q = "select * from ref_logsheet where group_location_id=$param1 and unit_id=$param2 and date='".($param3)."'";
              $detail->query($q);
              $chars = '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23';
              $array = explode(',', $chars);
              foreach($array as $value) {?>
              <tr>
                <td><?=$value?>:00</td>
                <?
                $qry = "select * from ref_logsheet where group_location_id=$param1 and unit_id=$param2 and date='$param3' and hour(jam)='".$value."'";
                $detail->query($qry);
                ?>
                <?
                if ($detail->recordCount()) {
                
                while ($detail->next()) {?>
                <td><?=number_format($detail->row('kontrol_20kv_load_kw'),2)?></td>
                <td><?=number_format($detail->row('kontrol_20kv_arus_a'),2)?></td>
                <td><?=number_format($detail->row('kontrol_20kv_tegangan_kv'),2)?></td>
                <td><?=number_format($detail->row('kontrol_20kv_cos_q'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_load_kw'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_kvar'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_kva'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_arus_a_i1'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_arus_a_i2'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_arus_a_i3'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_tegangan_volt_rs'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_tegangan_volt_st'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_tegangan_volt_rt'),2)?></td>
                <td><?=number_format($detail->row('kontrol_generator_63_kv_freq_hz'),2)?></td>
                <td><?=number_format($detail->row('kontrol_exec_arus_exc'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_gav_open'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_press_oil'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_bearing_1'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_bearing_2'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_bearing_3'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_bearing_4'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_bearing_5'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_1'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_2'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_3'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_4'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_5'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_6'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_7'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_8'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_9'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_10'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_11'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_generator_12'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_baterai_a'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_baterai_v'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_suhu_ruang_gen'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_suhu_ruang'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_air_comp'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_trafo_c'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_water_level'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_gate_van'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_oil_tank_pressure'),2)?></td>
                <td><?=number_format($detail->row('kontrol_governor_temperatur_penstock_pressure'),2)?></td>
                <td><?=number_format($detail->row('kontrol_pressure_turbin_trubin_mpa'),2)?></td>
                <td><?=number_format($detail->row('kontrol_pressure_turbin_draft_tube_cm_hg'),2)?></td>
                <td><?=number_format($detail->row('kontrol_pressure_turbin_axial_mpa'),2)?></td>
                <td><?=number_format($detail->row('kontrol_pressure_turbin_cooling_mpa'),2)?></td>
                <td><?=$detail->row('notes')?></td>
                <?}?>
                <?}else{?>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <?}?>
              </tr>
              <?}?>
              <tr>
                <td style="background-color: red !important;">Max</td>
                <?
                $max = cmsDB();
                $qry_max = "select * from master_logsheet where group_location_id=$param1 and unit_id=$param2 and min_max='Max'";
                $max->query($qry_max);
                if ($max->recordCount()) {
                while ($max->next()) {?>
                <td><?=number_format($max->row('kontrol_20kv_load_kw'),2)?></td>
                <td><?=number_format($max->row('kontrol_20kv_arus_a'),2)?></td>
                <td><?=number_format($max->row('kontrol_20kv_tegangan_kv'),2)?></td>
                <td><?=number_format($max->row('kontrol_20kv_cos_q'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_load_kw'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_kvar'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_kva'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_arus_a_i1'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_arus_a_i2'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_arus_a_i3'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_tegangan_volt_rs'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_tegangan_volt_st'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_tegangan_volt_rt'),2)?></td>
                <td><?=number_format($max->row('kontrol_generator_63_kv_freq_hz'),2)?></td>
                <td><?=number_format($max->row('kontrol_exec_arus_exc'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_gav_open'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_press_oil'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_bearing_1'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_bearing_2'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_bearing_3'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_bearing_4'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_bearing_5'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_1'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_2'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_3'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_4'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_5'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_6'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_7'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_8'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_9'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_10'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_11'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_generator_12'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_baterai_a'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_baterai_v'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_suhu_ruang_gen'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_suhu_ruang'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_air_comp'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_trafo_c'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_water_level'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_gate_van'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_oil_tank_pressure'),2)?></td>
                <td><?=number_format($max->row('kontrol_governor_temperatur_penstock_pressure'),2)?></td>
                <td><?=number_format($max->row('kontrol_pressure_turbin_trubin_mpa'),2)?></td>
                <td><?=number_format($max->row('kontrol_pressure_turbin_draft_tube_cm_hg'),2)?></td>
                <td><?=number_format($max->row('kontrol_pressure_turbin_axial_mpa'),2)?></td>
                <td><?=number_format($max->row('kontrol_pressure_turbin_cooling_mpa'),2)?></td>
                <td>&nbsp;</td>
                <?}?>
                <?}else{?>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <?}?>
              </tr>
              
              <tr>
                <td style="background-color: yellow;">Min</td>
                <?
                $min = cmsDB();
                $qry_min = "select * from master_logsheet where group_location_id=$param1 and unit_id=$param2 and min_max='Min'";
                $min->query($qry_min);
                if ($min->recordCount()) {
                while ($min->next()) {?>
                <td><?=number_format($min->row('kontrol_20kv_load_kw'),2)?></td>
                <td><?=number_format($min->row('kontrol_20kv_arus_a'),2)?></td>
                <td><?=number_format($min->row('kontrol_20kv_tegangan_kv'),2)?></td>
                <td><?=number_format($min->row('kontrol_20kv_cos_q'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_load_kw'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_kvar'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_kva'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_arus_a_i1'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_arus_a_i2'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_arus_a_i3'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_tegangan_volt_rs'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_tegangan_volt_st'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_tegangan_volt_rt'),2)?></td>
                <td><?=number_format($min->row('kontrol_generator_63_kv_freq_hz'),2)?></td>
                <td><?=number_format($min->row('kontrol_exec_arus_exc'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_gav_open'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_press_oil'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_bearing_1'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_bearing_2'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_bearing_3'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_bearing_4'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_bearing_5'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_1'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_2'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_3'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_4'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_5'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_6'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_7'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_8'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_9'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_10'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_11'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_generator_12'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_baterai_a'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_baterai_v'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_suhu_ruang_gen'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_suhu_ruang'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_air_comp'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_trafo_c'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_water_level'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_gate_van'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_oil_tank_pressure'),2)?></td>
                <td><?=number_format($min->row('kontrol_governor_temperatur_penstock_pressure'),2)?></td>
                <td><?=number_format($min->row('kontrol_pressure_turbin_trubin_mpa'),2)?></td>
                <td><?=number_format($min->row('kontrol_pressure_turbin_draft_tube_cm_hg'),2)?></td>
                <td><?=number_format($min->row('kontrol_pressure_turbin_axial_mpa'),2)?></td>
                <td><?=number_format($min->row('kontrol_pressure_turbin_cooling_mpa'),2)?></td>
                <td>&nbsp;</td>
                <?}?>
                <?}else{?>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <?}?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>