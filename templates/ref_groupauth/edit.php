<div class="container-fluid">
	<div class="page-header">
		<div class="row">
			<div class="col-lg-6">
				<i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Group Authorization</h5>
			</div>
			<div class="col-lg-6">
				<ol class="breadcrumb pull-right mb-1">
					<li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Setting / Group Authorization / Edit</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?
//require_once("../../config.php");
$group=cmsDB();
$auth=cmsDB();
$subauth=cmsDB();
$subauth2=cmsDB();
$subauth3=cmsDB();
$subauth4=cmsDB();

$insert=cmsDB();
if(isset($_GET["insert"])){
	//echo "insert mode";die();
	$group_id=uriParam("group_id");
	$group->query("delete from ref_groupauthorization where group_id=".$group_id);
	$auth->query("select * from ref_authorization order by auth_id asc");
	while($auth->next()){
		//echo $auth->row("auth_id") . "|".postParam("create_". $auth->row("auth_id"))."<BR>";
		if(isset($_POST["create_".$auth->row("auth_id")])){
			$strsql="insert into ref_groupauthorization(group_id,auth_id,insert_date,insert_by) values(".$group_id.",".$auth->row("auth_id");
			$strsql = $strsql . ",'".date("Y-m-d H:i:s")."',".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")].")";
			//echo $strsql."<BR>";
			$insert->query($strsql);
		}
		
	}
	//die();
}else{
	$group_id=uriParam("group_id");
	
}

$group->query("select * from ref_group where group_id=".$group_id);
if($group->recordCount()==0){
	echo "Invalid Parameter";die();
}else{
	$group->next();
	$group_name = $group->row("group_name");
}

$group->query("select * from ref_groupauthorization where group_id=".$group_id);
$lstauth = $group->valueList("auth_id");
//echo "auth ID : " . $lstauth; 

$auth->query("select * from ref_authorization where parent_id=0 order by auth_id asc");
?>
<style>
	h1,h2,h3,h4,h5,h6 {
		margin-top: 0;
		margin-bottom: 0;
	}
	.p-16{font-size: 16px;}
	.p-14{font-size: 14px;}
	.p-12{font-size: 12px;}
	.p-10{font-size: 10px;}

</style>
<form action="?tmp=<?=uriParam("tmp")?>&insert=yes&group_id=<?=$group_id?>&refresh=<?=md5("mdYHis")?>" method="post">
<!-- BEGIN PAGE CONTENT-->

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
		 <div class="card-body">

			<table class="table table-striped table-bordered table-hover standar-font" id="sample_1">
				<thead>
				<tr>
					  <th align="center" width="0">No</th>
					  <th align="center">Authorization Name </th>
					  <th align="center"><div align="center">Authorized</div></th>
				  </tr>
				</thead>
				
				<tbody>
				<?
				$no=1;
				$lstfieldname="";
				while($auth->next()){?>
					   <tr class="odd gradeX">
						  <td align=left><?=$no;?>.</td>
						  <td><font color="green"><p class="p-16"> - <?=$auth->row("auth_name")?></p></font></td>
						  <td align="center">
							  <input type="checkbox" name="create_<?=$auth->row("auth_id")?>" value="1" <?if(listFind($lstauth,$auth->row("auth_id"))){ echo " checked";}?>>
						  </td>
						  
					   </tr>
					   <?
					   $no1 = 1;
					   $subauth->query("select * from ref_authorization where parent_id=".$auth->row("auth_id")." order by auth_id asc");
					   //echo "select * from ref_authorization where parent_id=".$auth->row("auth_id")." order by auth_id asc | ".$subauth->recordCount()."<BR>";
					   while($subauth->next()){
					   ?>
					   	<tr class="odd gradeX">
						  <td align=left><?=$no?>.<?=$no1?></td>
						  <td><font color="blue"><p class="p-14"> - - <?=$subauth->row("auth_name")?></p></font></td>
						  <td align="center">
							  <input type="checkbox" name="create_<?=$subauth->row("auth_id")?>" value="1"  <?if(listFind($lstauth,$subauth->row("auth_id"))){ echo " checked";}?>>
							  
						  </td>
						
						  </tr>
						  <?
						  $no2=1;
						  $subauth2->query("select * from ref_authorization where parent_id=".$subauth->row("auth_id")." order by auth_id asc");
						   //echo "select * from ref_authorization where parent_id=".$subauth->row("auth_id")." order by auth_id asc | ".$subauth2->recordCount()."<BR>";
						   while($subauth2->next()){
						   ?>
						   	<tr class="odd gradeX">
							  <td align=left><?=$no?>.<?=$no1?>.<?=$no2?></td>
							  <td><font size="-1" color="red"><p class="p-12"> - - - <?=$subauth2->row("auth_name")?></p></font></td>
							  <td align="center">
								  <input type="checkbox" name="create_<?=$subauth2->row("auth_id")?>" value="1"   <?if(listFind($lstauth,$subauth2->row("auth_id"))){ echo " checked";}?>>
								  
							  </td>
							 
							</tr>

							<?
						  $no3=1;
						  $subauth3->query("select * from ref_authorization where parent_id=".$subauth2->row("auth_id")." order by auth_id asc");
						   //echo "select * from ref_authorization where parent_id=".$subauth->row("auth_id")." order by auth_id asc | ".$subauth2->recordCount()."<BR>";
						   while($subauth3->next()){
						   ?>
						   	<tr class="odd gradeX">
							  <td align=left><?=$no?>.<?=$no1?>.<?=$no2?>.<?=$no3?></td>
							  <td><font size="-1" ><p class="p-10"> - - - - <?=$subauth3->row("auth_name")?></p></font></td>
							  <td align="center">
								  <input type="checkbox" name="create_<?=$subauth3->row("auth_id")?>" value="1"   <?if(listFind($lstauth,$subauth3->row("auth_id"))){ echo " checked";}?>>
								  
							  </td>
							 
							</tr>
							<?
							  $no4=1;
							  $subauth4->query("select * from ref_authorization where parent_id=".$subauth3->row("auth_id")." order by auth_id asc");
							   //echo "select * from ref_authorization where parent_id=".$subauth->row("auth_id")." order by auth_id asc | ".$subauth2->recordCount()."<BR>";
							   while($subauth4->next()){
							   ?>
							   	<tr class="odd gradeX">
								  <td align=left><?=$no?>.<?=$no1?>.<?=$no2?>.<?=$no3?>.<?=$no4?></td>
								  <td><font size="-1" ><p class="p-10"> - - - - - - [ <?=$subauth4->row("auth_name")?> ]</p></font></td>
								  <td align="center">
									  <input type="checkbox" name="create_<?=$subauth4->row("auth_id")?>" value="1"   <?if(listFind($lstauth,$subauth4->row("auth_id"))){ echo " checked";}?>>
									  
								  </td>
								 
								</tr>
								<?	$no4++;
								}?>


							<?	$no3++;
							}?>

						<?	$no2++;
						}?>
					   <?
					    $no1++;
					   }?>
				  <?
				  $no++;
				  }?>
				   
				</tbody>
			 </table>

			 <div align="center" class="mt-5">
			   <button type="submit" class="btn btn-success">Update Authorization</button>
			   <button type="button" onclick="history.back();" class="btn btn-light">Back</button>

			</div>
			
		  </div>
	   </div> 
	 </div>
	</div>
 
  </form>