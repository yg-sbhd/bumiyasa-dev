<?
require_once("../../config.php");
?>
<!-- BEGIN PAGE CONTENT-->
 <div class="row">
	<div class="col-md-12">
	   <!-- BEGIN EXAMPLE TABLE PORTLET-->
	   <div class="portlet box light-grey">
		  <div class="portlet-title">
			 <div class="caption"><i class="icon-globe"></i>Group Authorization</div>
			 <div class="tools">
				<!---<a href="javascript:;" class="collapse"></a>--->
				<!---<a href="#portlet-config" data-toggle="modal" class="config"></a>--->
				<a href="javascript:;" class="reload"></a>
				<!---<a href="javascript:;" class="remove"></a>--->
			 </div> 
		  </div>
		 
		  
		  <div class="portlet-body">
			
			 <?
				$admin=cmsDB();
				$admin->query("select * from ref_group");
			 ?>
			 
			<table class="table table-striped table-bordered table-hover" id="sample_1">
				<thead>
				
				   <tr>
					  <th>No</th>
					  <th>Group Name </th>
					  <th>Description</th>
					  
				   </tr>
				</thead>
				<tbody>
				<?
				$no=1;
				while($admin->next()){?>
				   <tr class="odd gradeX">
					  <td align=right><?=$no;?>.</td>
					  <td>
						<a  href="javascript:get_method('templates/ref_groupauth/edit.php?group_id=<?=$admin->row("group_id")?>&editauth=yes&ref=<?=md5(date("mdyHis"))?>')">
						<?=$admin->row("group_name")?>
						</a>
					  </td>
					  <td ><?=$admin->row("notes")?></td>
					  
				   </tr>
				  <?
				  $no++;
				  }?>
				   
				</tbody>
			 </table>
			
		  </div>
	   </div> 
	 
	</div>
 </div>
 