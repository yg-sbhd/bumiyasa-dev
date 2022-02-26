<?
//require_once("../../config.php");
$group=cmsDB();
$auth=cmsDB();
$subauth=cmsDB();
$subauth2=cmsDB();
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
			$strsql = $strsql . ",'".date("Y-m-d H:i:s")."',".$_SESSION["user_id" . date("mdY")].")";
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
<form action="?tmp=<?=uriParam("tmp")?>&insert=yes&group_id=<?=$group_id?>&refresh=<?=md5("mdYHis")?>" method="post">
<!-- BEGIN PAGE CONTENT-->
 <div class="row">
	<div class="col-md-12">
	   <!-- BEGIN EXAMPLE TABLE PORTLET-->
	   <div class="portlet box light-grey">
		  <div class="portlet-title">
			 <div class="caption"><i class="icon-globe"></i>Edit Authorization for Group : <font color="red"><B><?=$group_name?></B></font> </div>
			 <div class="tools">
				<!---<a href="javascript:;" class="collapse"></a>-->
				<!---<a href="#portlet-config" data-toggle="modal" class="config"></a>-->
				<a href="javascript:;" class="reload"></a>
				<!---<a href="javascript:;" class="remove"></a>-->
			 </div> 
		  </div>
		 <div class="portlet-body">
			<div align="left">
                		<a class="btn default" href="?tmp=templates/ref_groupauth/index.php&ref=<?=md5(date("mdyHis"))?>"><< Back</a>
			</div><BR>
			<table class="table table-striped table-bordered table-hover" id="sample_1">
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
						  <td><font color="green"><B><?=$auth->row("auth_name")?></B></font></td>
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
						  <td><font color="green"><B><?=$subauth->row("auth_name")?></B></font></td>
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
							  <td><font size="-1">[ <?=$subauth2->row("auth_name")?> ]</font></td>
							  <td align="center">
								  <input type="checkbox" name="create_<?=$subauth2->row("auth_id")?>" value="1"   <?if(listFind($lstauth,$subauth2->row("auth_id"))){ echo " checked";}?>>
								  
							  </td>
							 
							  </tr>
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
			
		  </div>
	   </div> 
	 
	</div>
 </div>
 <div align="center">
   <button type="submit" class="btn default">Update Authorization</button>
</div>
  </form>