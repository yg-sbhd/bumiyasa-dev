<?
include "../../config.php";
$show = cmsDB();

$id=$_POST["group_location_id"];
if (isset($_POST["group_location_id"])) {
	// $qry = "select request_for_quotation_id, request_for_quotation_no from ref_request_for_quotation where group_location_id =".$_GET['id'];
	// $qry
	$qry = "select request_for_quotation_id, request_for_quotation_no from ref_request_for_quotation where group_location_id =".$id;
// }else{
}
$show->query($qry);

// $results_array = array();
while ($show->next()) {
		echo "<option value='" . $show->row('request_for_quotation_id') . "'>" . $show->row('request_for_quotation_no') . "</option>";
	    // $results_array[$show->row('request_for_quotation_id')] = $show->row('request_for_quotation_no');
}

// echo json_encode($results_array);
?>