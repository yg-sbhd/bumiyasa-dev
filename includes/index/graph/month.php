<?
require_once '../../../config.php';
$month = cmsDB();
$query = "SELECT SUM(kwh) AS kwh FROM ref_logsheet_production WHERE group_location_id=".$_GET['group_location_id']." GROUP BY YEAR(DATE), MONTH(DATE)";
// echo $query;
$month->query($query);
$month->next();
if ($month->row('kwh') <> null) {
	echo number_format($month->row('kwh'), 2);
}else{
	echo "0.00";
}

?>