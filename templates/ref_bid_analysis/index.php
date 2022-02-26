<!-- <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_bid_analysis/preview.php')?>">preview</a>

<a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_bid_analysis/comparation.php')?>">comparation</a>

<a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_bid_analysis/comparation_edit.php')?>">comparation edit</a> -->
<?
$show_detail = cmsDB();
$show = cmsDB();
$qry = "select * from ref_bid_analys where is_deleted=0 order by update_date desc";
$show->query($qry);
?>

<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Bid Analysis</h5>
      </div>
      <div class="col-lg-6">
        <ol class="breadcrumb pull-right mb-1">
          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; Financial / Bid Analysis</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <!-- <div class="card-header"> -->
                    <!-- <h5>Zero Configuration</h5><span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:</span> -->
                  <!-- </div> -->
                  <div class="card-body">
                    <?
                    $add = false;
                    if(_checkauth("New")){
                      $add = true;
                    }
                    if($add){
                    ?>

                      <a class="btn btn-success btn-sm mb-3" href="?tmp=<?=encryptStringArray('templates/ref_bid_analysis/comparation.php')?>&ref=<?=md5(date('mdYHis'))?>" data-original-title="" title=""><span class="fa fa-plus"></span> Add New</a>
                    <?}?>

                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Bid Analysis Number</th>
                            <th>Date</th>
                            <th>Vendor</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Last Update</th>
                            <th>By</th>
                            <th>Form</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?
                          $no=0;
                          while ($show->next()) {
                            $no++;
                          ?>
                          <tr>
                            <td><?=$no?></td>
                            <td><?=$show->row('bid_analys_no')?></td>
                            <td><?=datesql2date($show->row('date'))?></td>
                            <td><?=$show->row('selected_vendor_id_txt')?></td>
                            <td><?=number_format($show->row('contract_price'),2)?></td>
                            <td>
                            	<?
                            	$show_detail->query("select status_color from ref_status where status_id=". $show->row('status_id'));
                                $show_detail->next();
                                echo "<span class='badge ".$show_detail->row('status_color')."'>".$show->row('status_id_txt')."</span>";
                               ?>
                            </td>
                            <td>
                            	<a href="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=encryptStringArray('templates/ref_bid_analysis/comparation_edit.php')?>&bid_analys_id=<?=encryptStringArray($show->row('bid_analys_id'))?>&refresh=<?=md5("mdYHis")?>">
                            		<?=datesql2datetime($show->row('update_date'));?>
                            	</a>
                            </td>
                            <td>
                            	<?=$show->row('update_by_txt')?>
                            </td>
                            <td class='text-center'>
                                <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_bid_analysis/preview.php')?>&bid_analys_id=<?=encryptStringArray($show->row('bid_analys_id'))?>">
                                  <i class="fa fa-clipboard fa-2x"></i>
                                </a>
                            </td>

                        </tr>
                          <?  
                          }
                          ?>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
             </div>
         </div>
     <!-- </div> -->
              <!-- Zero Configuration  Ends-->
