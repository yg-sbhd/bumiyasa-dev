<?

// echo "string";

// echo "<p>";

// echo "string2 ";

// echo $_GET['group_location_id'];

require_once '../../../config.php';



$unit1 = cmsDB();
$unit2 = cmsDB();
$month = cmsDB();
$today = cmsDB();
$site = cmsDB();

$site->query("select group_name_alias from master_group_location where group_location_id=".$_GET['group_location_id']);
$site->next();

$today->query("SELECT SUM(kwh) as kwh FROM ref_logsheet_production WHERE group_location_id=".$_GET['group_location_id']." and date='".date("Y-m-d")."'");
$today->next();
if ($today->row('kwh') <> null) {
	$total_today = number_format($today->row('kwh'), 2);
}else{
	$total_today = "0.00";
}

$month->query("SELECT SUM(kwh) AS kwh FROM ref_logsheet_production WHERE group_location_id=".$_GET['group_location_id']." GROUP BY YEAR(DATE), MONTH(DATE)");
$month->next();
if ($month->row('kwh') <> null) {
   $total_month = number_format($month->row('kwh'), 2);
}else{
   $total_month = "0.00";
}


$unit2->query("select kontrol_20kv_load_kw from ref_logsheet where is_deleted=0 and unit_id=1 and group_location_id=".$_GET['group_location_id']." and date='".date("Y-m-d")."'");

$chars = '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23';

$array = explode(',', $chars);



$value_unit1;

$value_unit2;

foreach($array as $value) {

	$query = "select kontrol_20kv_load_kw from ref_logsheet where is_deleted=0 and unit_id=1 and group_location_id=".$_GET['group_location_id']." and date='".date("Y-m-d")."' and hour(jam)='".$value."'";

	$unit1->query($query);

	if($unit1->recordCount()){

		$unit1->next();

		if($value == 23){

			$value_unit1 = $value_unit1 . $unit1->row('kontrol_20kv_load_kw');

		}else{

			$value_unit1 = $value_unit1 . $unit1->row('kontrol_20kv_load_kw') . ',';

		}

	}else{

		if($value == 23){

			$value_unit1 = $value_unit1 . '0.00';

		}else{

			$value_unit1 = $value_unit1 . '0.00' .',';



		}

	}



	$query2 = "select kontrol_20kv_load_kw from ref_logsheet where is_deleted=0 and unit_id=2 and group_location_id=".$_GET['group_location_id']." and date='".date("Y-m-d")."' and hour(jam)='".$value."'";

	$unit2->query($query2);

	if($unit2->recordCount()){

		$unit2->next();

		if($value == 23){

			$value_unit2 = $value_unit2 . $unit2->row('kontrol_20kv_load_kw');

		}else{

			$value_unit2 = $value_unit2 . $unit2->row('kontrol_20kv_load_kw') . ',';

		}

	}else{

		if($value == 23){

			$value_unit2 = $value_unit2 . '0.00';

		}else{

			$value_unit2 = $value_unit2 . '0.00' .',';



		}

	}

}

?>



<div id="container-<?=$_GET['group_location_id']?>" style="min-width: 310px; height: 300px; margin: 0 auto"></div>

<script type="text/javascript">



var str = "[<?=$value_unit1?>]",

array1 = str.match(/\d+(?:\.\d+)?/g).map(Number)



var str2 = "[<?=$value_unit2?>]",

array2 = str2.match(/\d+(?:\.\d+)?/g).map(Number)



Highcharts.chart('container-<?=$_GET['group_location_id']?>', {

    chart: {

        type: 'line'

    },

    credits:{

    	enabled: false

  	},

    title: {
    	useHTML: true,
        text: `<?=$site->row('group_name_alias')?> 
        		<span style=margin-left:8%;font-size:12px> Total Production Today : <b><?=$total_today?></b> Kwh</span> 
        		<span style=margin-left:8%;font-size:12px> Total this month <b><?=$total_month?></b> Kwh</span>`,
        align: 'left',

    },

    // subtitle: {
    // 	text: 'Total Production Today : <?=$total_today?> Kwh | Total this month <?=$total_month?> Kwh'
    // },

    xAxis: {

        categories: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11','12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23']

    },

    yAxis: {

        title: {

            text: 'Load (KW)'

        }

    },

    plotOptions: {

        line: {

            dataLabels: {

                enabled: true,
				style: {
                    fontWeight: 'light'
                }

            },

            enableMouseTracking: false

        }

    },
    exporting: {
    	allowHTML: true,
	    filename: '<?=$site->row('group_name_alias')?>_<?=date("d-m-Y")?>',
	    chartOptions: {
            // ...
        }
	},

    series: [{

        name: 'UNIT 1',

        data: array1

    }, {

        name: 'UNIT 2',

        data: array2

    }]

});

		</script>