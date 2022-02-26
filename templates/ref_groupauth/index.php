<div class="container-fluid">
	<div class="page-header">
		<div class="row">
			<div class="col-lg-6">
				<i class="fa fa-desktop"></i> &nbsp; <h5 class="d-inline-block">Group Authorization</h5>
			</div>
			<div class="col-lg-6">
				<ol class="breadcrumb pull-right mb-1">
					<li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; / Setting / Group Authorization</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					
					<?
					$admin=cmsDB();
					$admin->query("select * from ref_group");
					?>
					
					<table class="table table-striped table-bordered table-hover standar-font" id="sample_1">
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
									<!--<a  href="javascript:get_method('templates/ref_groupauth/edit.php?group_id=<?=$admin->row("group_id")?>&editauth=yes&ref=<?=md5(date("mdyHis"))?>')">-->
									<a  href="index-template.php?tmp=<?=encryptStringArray('templates/ref_groupauth/edit.php')?>&group_id=<?=$admin->row("group_id")?>&editauth=yes&ref=<?=md5(date("mdyHis"))?>">
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
