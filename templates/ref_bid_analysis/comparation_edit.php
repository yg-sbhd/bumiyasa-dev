<?
include "../../config.php";
$show = cmsDB();
$insert = cmsDB();
$delete=cmsDB();
$detail= cmsDB();
$detail_5 = cmsDB();
$update = cmsDB();
// $show->query("select * from ref_purchase_request_detail where is_deleted=0 and component_item<>5 and purchase_request_id=1");
$bid_analys_id = decryptStringArray(uriParam('bid_analys_id'));

if(isset($_GET['delete'])){
	$delete_qry = "update ref_bid_analys set is_deleted=1, delete_date='".date("Y-m-d H:i:s")."', delete_by='".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."' where bid_analys_id=".$bid_analys_id;
	$delete->query($delete_qry);

	$delete_qry = "update ref_bid_analys_detail set is_deleted=1, delete_date='".date("Y-m-d H:i:s")."', delete_by='".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."' where bid_analys_id=".$bid_analys_id;
	$delete->query($delete_qry);
	die();
	echo "<script>location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".encryptStringArray('templates/ref_bid_analysis/index.php')."&ref=".md5("mdYHis")."#child';</script>";
	die();

}
if(isset($_GET['submit'])){
	// echo $_POST['total_product'] . "<p>";
	$delete->query("delete from ref_bid_analys_detail where bid_analys_id=".$bid_analys_id);
	$q = "";

	foreach( $_POST['component_item'] as $key => $n) {
		if( $key > 3 ){
			if($key == 4){
				for ($i=4; $i < $_POST['total_product']; $i++) { 
					if(strlen($_POST['component'][$i]) > 0){
						// echo $_POST['component_item'][$key] .' = ' .$_POST['component'][$i]. ' / ' . $i.' <p>' ;
						$q = $q ."(";
						$q = $q . "'".$bid_analys_id."', ";
						$q = $q . "'".$_POST['component_item'][$key]."', ";
						$q = $q . "'".$_POST['component'][$i]."', ";
						$q = $q . "'".$_POST['qty'][$i]."', ";
						$q = $q . "'".$_POST['vendor1'][$i]."', ";
						$q = $q . "'".$_POST['vendor1_price'][$i]."', ";
						$q = $q . "'".$_POST['vendor1_amount'][$i]."', ";
						$q = $q . "'".$_POST['vendor2'][$i]."', ";
						$q = $q . "'".$_POST['vendor2_price'][$i]."', ";
						$q = $q . "'".$_POST['vendor2_amount'][$i]."', ";
						$q = $q . "'".$_POST['vendor3'][$i]."', ";
						$q = $q . "'".$_POST['vendor3_price'][$i]."', ";
						$q = $q . "'".$_POST['vendor3_amount'][$i]."', ";
						$q = $q . "'".$_POST['estimate_price'][$i]."', ";
						$q = $q . "'".$_POST['estimate_amount'][$i]."', ";
						$q = $q . "'".date("Y-m-d H:i:s")."', ";
						$q = $q . "'".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."', ";
						$q = $q . "'".date("Y-m-d H:i:s")."', ";
						$q = $q . "'".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."' ";
						$q = $q . "), ";	
					}
				}
			}else{
				echo "> ". $_POST['component_item'][$key] . " = ".$_POST['component'][$key+($_POST['total_product']-4)]." <p> ";

				$q = $q ."(";
				$q = $q . "'".$bid_analys_id."', ";
				$q = $q . "'".$_POST['component_item'][$key]."', ";
				$q = $q . "'".$_POST['component'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['qty'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor1'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor1_price'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor1_amount'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor2'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor2_price'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor2_amount'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor3'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor3_price'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['vendor3_amount'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['estimate_price'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".$_POST['estimate_amount'][$key+($_POST['total_product']-4)]."', ";
				$q = $q . "'".date("Y-m-d H:i:s")."', ";
				$q = $q . "'".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."', ";
				$q = $q . "'".date("Y-m-d H:i:s")."', ";
				$q = $q . "'".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."' ";
				$q = $q . "), ";	
			}
		}else{
			// echo $_POST['component_item'][$key] . " = ".$_POST['component'][$key]." <p> ";

			$q = $q ."(";
			$q = $q . "'".$bid_analys_id."', ";
			$q = $q . "'".$_POST['component_item'][$key]."', ";
			$q = $q . "'".$_POST['component'][$key]."', ";
			$q = $q . "'".$_POST['qty'][$key]."', ";
			$q = $q . "'".$_POST['vendor1'][$key]."', ";
			$q = $q . "'".$_POST['vendor1_price'][$key]."', ";
			$q = $q . "'".$_POST['vendor1_amount'][$key]."', ";
			$q = $q . "'".$_POST['vendor2'][$key]."', ";
			$q = $q . "'".$_POST['vendor2_price'][$key]."', ";
			$q = $q . "'".$_POST['vendor2_amount'][$key]."', ";
			$q = $q . "'".$_POST['vendor3'][$key]."', ";
			$q = $q . "'".$_POST['vendor3_price'][$key]."', ";
			$q = $q . "'".$_POST['vendor3_amount'][$key]."', ";
			$q = $q . "'".$_POST['estimate_price'][$key]."', ";
			$q = $q . "'".$_POST['estimate_amount'][$key]."', ";
			$q = $q . "'".date("Y-m-d H:i:s")."', ";
			$q = $q . "'".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."', ";
			$q = $q . "'".date("Y-m-d H:i:s")."', ";
			$q = $q . "'".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]."' ";
			$q = $q . "), ";	
		}
	}

	$q = substr($q, 0, -2);

	$query = "insert into ref_bid_analys_detail (bid_analys_id, component_item, component, qty, vendor1, vendor1_price, vendor1_amount, vendor2, vendor2_price, vendor2_amount, vendor3, vendor3_price, vendor3_amount, estimate_price, estimate_amount, insert_date, insert_by, update_date, update_by) values " . $q;
	// echo $query;
	$insert->query($query);

	$vendor_id = listLast($_POST['selected_vendor'], '-');
	$vendor_field = listFirst($_POST['selected_vendor'], '-');
	// echo "VENDOR_ID = ". $vendor_field . "<p>";

	$qry = "select ".$vendor_field." as name from ref_bid_analys_detail where bid_analys_id=".$bid_analys_id." and component_item=2";
	$detail->query($qry);
	$detail->next();

	$rfq_id = $detail->row("name");
	$rfq_id_txt = get_from_db("ref_request_for_quotation", "request_for_quotation_no", "request_for_quotation_id", $rfq_id);
	
	$detail->query("select purchase_request_id from ref_request_for_quotation where request_for_quotation_id=".$rfq_id);
	$detail->next();

	$pr_id = $detail->row("purchase_request_id");
	$pr_id_txt = get_from_db("ref_purchase_request", "purchase_request_no", "purchase_request_id", $pr_id);
	$vendor_id_txt = get_from_db("master_vendor", "vendor_company", "vendor_id", $vendor_id);
	$status_id_txt = get_from_db("ref_status", "status_name", "status_id", 0);
	$update_by_txt = get_from_db("ref_user", "full_name", "user_id", $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]  . date("mdY")]);


	$qry = "update ref_bid_analys set 
		purchase_request_id='".$pr_id."', 
		request_for_quotation_id='".$rfq_id."', 
		selected_vendor_id='".$vendor_id."', 
		selected_vendor_field='".$vendor_field."', 
		contract_price='".$_POST['contract_price']."', 
		update_by='".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"]  . date("mdY")]."', 
		update_date='".date("Y-m-d H:i:s")."', 
		purchase_request_id_txt='".$pr_id_txt."', 
		request_for_quotation_id_txt='".$rfq_id_txt."', 
		selected_vendor_id_txt='".$vendor_id_txt."' where bid_analys_id=".$bid_analys_id;
		// echo $qry; die();
	$update->query($qry);	
	echo "<script>location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".encryptStringArray('templates/ref_bid_analysis/comparation_edit.php')."&bid_analys_id=".encryptStringArray($bid_analys_id)."&refresh=".md5("mdYHis")."#child';</script>";
	die();
}



$show->query("select * from ref_bid_analys where bid_analys_id=".$bid_analys_id);
$show->next();

$detail->query("select * from ref_bid_analys_detail where is_deleted=0 and component_item<>5 and bid_analys_id=".$bid_analys_id." order by component_item");
$detail_5->query("select * from ref_bid_analys_detail where is_deleted=0 and component_item=5 and bid_analys_id=".$bid_analys_id." order by component_item");
// echo $detail_5->recordCount();

?>
<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Edit Bid Analysis</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; Financial / Bid Analysis / Edit</li>
        </ol>
      </div>
    </div>
  </div>
</div>


<div class="card">
	<form method="post" action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&submit=yes&bid_analys_id=<?=uriParam('bid_analys_id')?>">
		<div class="card-body bid-analys-form">
			<div class="form-group row text-right text-md-right">
				<label class="col-md-3 col-form-label">
					<font size="-1">Bid Analysis Number</font>
				</label>
				<div class="col-md-9" align="left">
					<input type="text" class="form-control" disabled="disabled" value="<?=$show->row('bid_analys_no')?>">
				</div>
			</div>
			<div class="form-group row text-right text-md-right">
				<label class="col-md-3 col-form-label">
					<font size="-1">Date</font>
				</label>
				<div class="col-md-9" align="left">
					<input type="text" class="datepicker-here form-control digits" name="date" value="<?=datesql2date($show->row('date'))?>">
				</div>
			</div>

			<table border="1">
				<?while ($detail->next()) {?>
				<?if($detail->row('component_item') == 1){?>
				<tr>
					<th colspan="3">
						Description
						<input type="hidden" name="component[0]" value="Description">
						<input type="hidden" name="component_item[0]" value="1">

						<!-- <input type="hidden" name="qty[0]"> -->
					</th>
															
					<th colspan="2">
						<? edit_select_ba_vendor("vendor1", "select CONCAT(vendor_name ,' (',vendor_company,')') as name, vendor_id as id from master_vendor where is_deleted=0", 0, "vendor_id", "'".$detail->row('vendor1')."'");?>
						<!-- <input type="hidden" name="vendor1_price[0]"> -->
						<!-- <input type="hidden" name="vendor1_amount[0]"> -->
					</th>

					<th colspan="2">
						<? edit_select_ba_vendor("vendor2", "select CONCAT(vendor_name ,' (',vendor_company,')') as name, vendor_id as id from master_vendor where is_deleted=0", 0, "vendor_id", "'".$detail->row('vendor2')."'");?>
						<!-- <input type="hidden" name="vendor2_price[0]"> -->
						<!-- <input type="hidden" name="vendor2_amount[0]"> -->
					</th>

					<th colspan="2">
						<? edit_select_ba_vendor("vendor3", "select CONCAT(vendor_name ,' (',vendor_company,')') as name, vendor_id as id from master_vendor where is_deleted=0", 0, "vendor_id", "'".$detail->row('vendor3')."'");?>
						<!-- <input type="hidden" name="vendor3_price[0]"> -->
						<!-- <input type="hidden" name="vendor3_amount[0]"> -->
					</th>
					<!-- <th colspan="2"><input type="text" name="" placeholder="Vendor 2"></th> -->
					<!-- <th colspan="2"><input type="text" name="" placeholder="Vendor 3"></th> -->
					<th colspan="2" rowspan="4" >
						Budget Estimate
						<!-- <input type="hidden" name="estimate_price[0]"> -->
						<!-- <input type="hidden" name="estimate_amount[0]"> -->
					</th>
				</tr>
				<?}?>
				<?if($detail->row('component_item') == 2){?>
				<tr>
					<td colspan="3">
						RFQ Number
						<input type="hidden" name="component[1]" value="RFQ Number">
						<input type="hidden" name="component_item[1]" value="2">
						<!-- <input type="hidden" name="qty[1]"> -->
					</td>

					<!-- <td colspan="2"><input type="text" name="vendor1[1]" value="<?=$detail->row('vendor1')?>" class="w-100"></td> -->
					<!-- <td colspan="2"><input type="text" name="vendor2[1]" value="<?=$detail->row('vendor2')?>" class="w-100"></td> -->
					<!-- <td colspan="2"><input type="text" name="vendor3[1]" value="<?=$detail->row('vendor3')?>" class="w-100"></td> -->

					<td colspan="2">
						<select name="vendor1[1]" class="form-control js-example-basic-single col-sm-12 w-100" id="rfq_vendor1">
						    <option value="<?=$detail->row('vendor1')?>" selected>
						    	<?
						    	echo get_from_db("ref_request_for_quotation", "request_for_quotation_no", "request_for_quotation_id", $detail->row('vendor1'));
						    	?>
						    </option>
						</select>
					</td>
					<td colspan="2">
						<select name="vendor2[1]" class="form-control js-example-basic-single col-sm-12 w-100" id="rfq_vendor2">
						    <option value="<?=$detail->row('vendor2')?>" selected>
						    	<?
						    	echo get_from_db("ref_request_for_quotation", "request_for_quotation_no", "request_for_quotation_id", $detail->row('vendor2'));
						    	?>
						    </option>
						</select>

<!-- 						<select name="vendor2[1]" class="form-control js-example-basic-single col-sm-12 w-100" id="rfq_vendor2">
						    <option value="" disabled readonly></option>
						</select> -->
					</td>
					<td colspan="2">
						<select name="vendor3[1]" class="form-control js-example-basic-single col-sm-12 w-100" id="rfq_vendor3">
						    <option value="<?=$detail->row('vendor3')?>" selected>
						    	<?
						    	echo get_from_db("ref_request_for_quotation", "request_for_quotation_no", "request_for_quotation_id", $detail->row('vendor3'));
						    	?>
						    </option>
						</select>
					</td>
				</tr>
				<?}?>
				<?if($detail->row('component_item') == 3){?>
				<tr>
					<td colspan="3">
						Quotation Number
						<input type="hidden" name="component[2]" value="Quotation Number">
						<input type="hidden" name="component_item[2]" value="3">

					</td>
					
					<td colspan="2"><input type="text" name="vendor1[2]" value="<?=$detail->row('vendor1')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor2[2]" value="<?=$detail->row('vendor2')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor3[2]" value="<?=$detail->row('vendor3')?>" class="w-100"></td>

<!-- 					<td colspan="2"><input type="text" name="vendor2[2]"></td>
					<td colspan="2"><input type="text" name="vendor3[2]"></td> -->
				</tr>
				<?}?>
				<?if($detail->row('component_item') == 4){?>

				<tr>
					<td colspan="3">
						Quotation Date
						<input type="hidden" name="component[3]" value="Quotation Date">
						<input type="hidden" name="component_item[3]" value="4">

					</td>
					<td colspan="2"><input type="text" name="vendor1[3]" value="<?=$detail->row('vendor1')?>" class="datepicker-here digits w-100"></td>
					<td colspan="2"><input type="text" name="vendor2[3]" value="<?=$detail->row('vendor2')?>" class="datepicker-here digits w-100"></td>
					<td colspan="2"><input type="text" name="vendor3[3]" value="<?=$detail->row('vendor3')?>" class="datepicker-here digits w-100"></td>
				</tr>
				<tr style="background: #efefef;">
					<td>Breakdown price at cost structure</td>
					<td align="center">Qty</td>
					<td align="center">Unit</td>

					<td align="center">Unit Price</td>
					<td align="center">Amount</td>

					<td align="center">Unit Price</td>
					<td align="center">Amount</td>

					<td align="center">Unit Price</td>
					<td align="center">Amount</td>

					<td align="center">Unit Price</td>
					<td align="center">Amount</td>
				</tr>
			

					<?
					$no = 4;
					while ($detail_5->next()) {?>
						<tr>
							<td width="28%">
								<input type="text" name="component[<?=$no?>]" value="<?=$detail_5->row('component')?>" class="w-100">
								<input type="hidden" name="component_item[4]" value="5">

							</td>
							<td><input type="text" name="qty[<?=$no?>]" value="<?=number_format($detail_5->row('qty'), 2)?>" class="w-100 text-right"></td>
							
							<td><input type="text" name="unit_qty_id[<?=$no?>]" value="<?=$show->row('unit_qty_id')?>" class="w-100"></td>

							<td><input type="text" name="vendor1_price[<?=$no?>]" value="<?=number_format($detail_5->row('vendor1_price'), 2)?>" class="w-100 text-right"></td>
							<td><input type="text" name="vendor1_amount[<?=$no?>]" value="<?=number_format($detail_5->row('vendor1_amount'), 2)?>" class="w-100 text-right"></td>

							<td><input type="text" name="vendor2_price[<?=$no?>]" value="<?=number_format($detail_5->row('vendor2_price'), 2)?>" class="w-100 text-right"></td>
							<td><input type="text" name="vendor2_amount[<?=$no?>]" value="<?=number_format($detail_5->row('vendor2_amount'), 2)?>" class="w-100 text-right"></td>

							<td><input type="text" name="vendor3_price[<?=$no?>]" value="<?=number_format($detail_5->row('vendor3_price'), 2)?>" class="w-100 text-right"></td>
							<td><input type="text" name="vendor3_amount[<?=$no?>]" value="<?=number_format($detail_5->row('vendor3_amount'), 2)?>" class="w-100 text-right"></td>

							<td><input type="text" name="estimate_price[<?=$no?>]" value="<?=number_format($detail_5->row('estimate_price'), 2)?>" class="w-100 text-right"></td>
							<td><input type="text" name="estimate_amount[<?=$no?>]" value="<?=number_format($detail_5->row('estimate_amount'), 2)?>" class="w-100 text-right"></td>
						</tr>
					<?
					$no++;
					}
					?>
					
					<tr>
						<td width="28%">
							<input type="text" name="component[<?=$no?>]" class="w-100"> 
							<input type="hidden" name="component_item[4]" value="5">
							<input type="hidden" name="total_product" value="<?=$no+1?>" >
						</td>
						
						<td><input type="text" name="qty[<?=$no?>]" value="" class="w-100"></td>

						<td><input type="text" name="vendor1_price[<?=$no?>]" class="w-100"></td>
						<td><input type="text" name="vendor1_amount[<?=$no?>]" class="w-100"></td>

						<td><input type="text" name="vendor2_price[<?=$no?>]" class="w-100"></td>
						<td><input type="text" name="vendor2_amount[<?=$no?>]" class="w-100"></td>

						<td><input type="text" name="vendor3_price[<?=$no?>]" class="w-100"></td>
						<td><input type="text" name="vendor3_amount[<?=$no?>]" class="w-100"></td>

						<td><input type="text" name="estimate_price[<?=$no?>]" class="w-100"></td>
						<td><input type="text" name="estimate_amount[<?=$no?>]" class="w-100"></td>
					</tr>
				<?}?>

				<?if($detail->row('component_item') == 6){?>

				<tr style="background: #efefef;">
					<td colspan="3">Other's Factor</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>

				<tr>
					<td colspan="3">
						1. Term of Payment
						<input type="hidden" name="component[<?=$no+2?>]" value="1. Term of Payment">
						<input type="hidden" name="component_item[5]" value="6">

					</td>
					<td colspan="2">
						<? edit_select_ba("vendor1", "select name as name, rfq_payment_id as id from master_rfq_payment where is_deleted=0", $no+2, "rfq_payment_id", "'".$detail->row('vendor1')."'");?>

						<!-- <input type="text" name="vendor1[<?=$no+2?>]" value="<?=$detail->row('vendor1')?>" class="w-100"></td> -->
					<td colspan="2">
						<? edit_select_ba("vendor2", "select name as name, rfq_payment_id as id from master_rfq_payment where is_deleted=0", $no+2, "rfq_payment_id", "'".$detail->row('vendor2')."'");?>

						<!-- <input type="text" name="vendor2[<?=$no+2?>]" value="<?=$detail->row('vendor2')?>" class="w-100"></td> -->
					<td colspan="2">
						<? edit_select_ba("vendor3", "select name as name, rfq_payment_id as id from master_rfq_payment where is_deleted=0", $no+2, "rfq_payment_id", "'".$detail->row('vendor3')."'");?>

						<!-- <input type="text" name="vendor3[<?=$no+2?>]" value="<?=$detail->row('vendor3')?>" class="w-100"></td> -->
				</tr>
				<?}?>
				<?if($detail->row('component_item') == 7){?>
				<tr>
					<td colspan="3">
						2. Delivery Date
						<input type="hidden" name="component[<?=$no+3?>]" value="2. Delivery Date">
						<input type="hidden" name="component_item[6]" value="7">

					</td>
					<td colspan="2"><input type="text" name="vendor1[<?=$no+3?>]" value="<?=$detail->row('vendor1')?>" class="datepicker-here digits w-100"></td>
					<td colspan="2"><input type="text" name="vendor2[<?=$no+3?>]" value="<?=$detail->row('vendor2')?>" class="datepicker-here digits w-100"></td>
					<td colspan="2"><input type="text" name="vendor3[<?=$no+3?>]" value="<?=$detail->row('vendor3')?>" class="datepicker-here digits w-100"></td>
				</tr>


				<tr style="background: #efefef;">
					<td colspan="3">Scoring</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td colspan="3">&nbsp;</td>

				</tr>
				<?}?>
				<?if($detail->row('component_item') == 8){?>


				<tr>
					<td colspan="3">
						1. Price
						<input type="hidden" name="component[<?=$no+4?>]" value="1. Price">
						<input type="hidden" name="component_item[7]" value="8">

					</td>
					<td colspan="2"><input type="text" name="vendor1[<?=$no+4?>]" value="<?=$detail->row('vendor1')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor2[<?=$no+4?>]" value="<?=$detail->row('vendor2')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor3[<?=$no+4?>]" value="<?=$detail->row('vendor3')?>" class="w-100"></td>
				</tr>
				<?}?>
				<?if($detail->row('component_item') == 9){?>

				<tr>
					<td colspan="3">
						2. Technical
						<input type="hidden" name="component[<?=$no+5?>]" value="2. Technical">
						<input type="hidden" name="component_item[8]" value="9">

					</td>
					<td colspan="2"><input type="text" name="vendor1[<?=$no+5?>]" value="<?=$detail->row('vendor1')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor2[<?=$no+5?>]" value="<?=$detail->row('vendor2')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor3[<?=$no+5?>]" value="<?=$detail->row('vendor3')?>" class="w-100"></td>
				</tr>
				<?}?>
				<?if($detail->row('component_item') == 10){?>

				<tr>
					<td colspan="3">
						3. Other
						<input type="hidden" name="component[<?=$no+6?>]" value="3. Other">
						<input type="hidden" name="component_item[9]" value="10">

					</td>
					<td colspan="2"><input type="text" name="vendor1[<?=$no+6?>]" value="<?=$detail->row('vendor1')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor2[<?=$no+6?>]" value="<?=$detail->row('vendor2')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor3[<?=$no+6?>]" value="<?=$detail->row('vendor3')?>" class="w-100"></td>
				</tr>
				<?}?>
				<?if($detail->row('component_item') == 11){?>

				<tr>
					<td colspan="3">
						Total Score
						<input type="hidden" name="component[<?=$no+7?>]" value="Total Score">
						<input type="hidden" name="component_item[10]" value="11">

					</td>
					<td colspan="2"><input type="text" name="vendor1[<?=$no+7?>]" value="<?=$detail->row('vendor1')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor2[<?=$no+7?>]" value="<?=$detail->row('vendor2')?>" class="w-100"></td>
					<td colspan="2"><input type="text" name="vendor3[<?=$no+7?>]" value="<?=$detail->row('vendor3')?>" class="w-100"></td>
				</tr>
				<?}?>
				<?}?>
			</table>

			<div class="form-group row text-right text-md-right mt-4">
				<label class="col-md-3 col-form-label">
					<font size="-1">Selected Final Vendor</font>
				</label>
				<div class="col-md-9" align="left">
					<? 
					// add_select_ba("vendor_id", "select CONCAT(vendor_name ,' (',vendor_company,')') as name, vendor_id as id from master_vendor where is_deleted=0", "required");?>
					<!-- <select id="selected_vendor" class="form-control" name="selected_vendor">
						<option value="0" id="selected_vendor_1" class="d-none">-</option>
						<option value="0" id="selected_vendor_2" class="d-none">-</option>
						<option value="0" id="selected_vendor_3" class="d-none">-</option>
					</select>
 -->
					<select id="selected_vendor" name="selected_vendor" class="form-control col-sm-12 w-100">
					    <option value="vendor1-<?=$show->row('selected_vendor_id')?>" id="selected_vendor_1" selected><?=$show->row('selected_vendor_id_txt')?></option>
						<option value="vendor2-0" id="selected_vendor_2" class="d-none">-</option>
						<option value="vendor3-0" id="selected_vendor_3" class="d-none">-</option>
					</select>

					<!-- <input type="text" class="form-control"> -->
				</div>
			</div>

			<div class="form-group row text-right text-md-right">
				<label class="col-md-3 col-form-label">
					<font size="-1">Contracted Price</font>
				</label>
				<div class="col-md-9" align="left">
					<input type="text" class="form-control" name="contract_price" value="<?=$show->row('contract_price')?>">
				</div>
			</div>

		</div>

		<div class="card-footer">
			<div class="row">
				<div class="col=12 mx-auto">
					<input type="submit" name="submit" value="Update" class="btn btn-success btn-sm">
						<button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are You Sure Want to Delete this Record?')){ self.location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&delete=yes&bid_analys_id=<?=uriParam('bid_analys_id')?>&ref=<?=md5(date("mdyHis"))?>';}">
							<i class="icon-trash icon-white"></i> &nbsp; Delete
						</button>
					<button type="button" onclick="location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=encryptStringArray("templates/ref_bid_analysis/index.php")?>'" class="btn btn-light btn-sm">Back</button>
				</div>
			</div>
		</div>
	</form>
<!-- </div> -->


<script>  
 //    $(document).ready(function() {
 //    	$.ajax({
	//   		type: 'POST',
	//       	url: "templates/ref_bid_analysis/rfq_ajax.php?id="+result,
	//       	data: {group_location_id: name_rfq},
	//       	cache: false,
	//       	success: function(msg){
	//       		// console.log(msg);
	//           $("#vendor1").html(msg);

	//         }
	//     });

	// });
function select_vendor_edit(name_vendor, name_rfq, id_rfq, result){

  	$.ajax({
  		type: 'POST',
      	url: "templates/ref_bid_analysis/rfq_ajax.php",
      	data: {group_location_id: name_rfq},
      	cache: false,
      	success: function(msg){
      		// console.log(msg);
          $("#"+id_rfq).html(msg);

        }
    });


		console.log('kai')

	if($("#vendor1").find(":selected").val() > 0 || $("#vendor1").find(":selected").val() == ''){
		$('#selected_vendor_1').val('vendor1-'+$("#vendor1").find(":selected").val()).text($("#vendor1").find(":selected").text()).attr("class", "d-block");
		console.log('ka')
	}
	if($("#vendor2").find(":selected").val() > 0 || $("#vendor2").find(":selected").val() == ''){

		$('#selected_vendor_2').val('vendor2-'+$("#vendor2").find(":selected").val()).text($("#vendor2").find(":selected").text()).attr("class", "d-block");
	}
	if($("#vendor3").find(":selected").val() > 0 || $("#vendor3").find(":selected").val() == ''){

		$('#selected_vendor_3').val('vendor3-'+$("#vendor3").find(":selected").val()).text($("#vendor3").find(":selected").text()).attr("class", "d-block");
	}
}
 
    </script>