<?
require_once '../../../config.php';
$today = cmsDB();
$query = "SELECT SUM(kwh) as kwh FROM ref_logsheet_production WHERE group_location_id=".$_GET['group_location_id']." and date='".date("Y-m-d")."'";
// echo $query;
$today->query($query);
$today->next();
if ($today->row('kwh') <> null) {
	echo number_format($today->row('kwh'),2);
}else{
	echo "0.00";
}

?>