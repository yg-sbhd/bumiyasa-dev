<?
$show_detail = cmsDB();
$is_deleted = " and is_deleted=0";
if($child_main_query_2!=""){
	if(listFind($child_main_query_2,"where"," ")){
		$child_main_query_2 = $child_main_query_2. "and ".$_primary_id."=".decryptStringArray(uriParam($_primary_id)).$is_deleted ;
	}else{
		$child_main_query_2 = $child_main_query_2. "where ".$_primary_id."=".decryptStringArray(uriParam($_primary_id)).$is_deleted;
	}
	$show_detail->query($child_main_query_2);
}else{
	$show_detail->query("select * from ".$nama_table_child_3." where ".$_primary_id."=".decryptStringArray(uriParam($_primary_id)).$is_deleted);
}
?>
<div class="card" id="child_2">
	<div class="card-body">
		<div class="row px-3" style="border-bottom: 1px solid #eee;">
			<div class="col-1 p-1">No</div>
			<?
          	for($field=1;$field<=listLen($record_show_child_2,"~");$field++){
				$row_detail = listGetAt($record_show_child_2,$field,"~");
				$row_field = listGetAt($row_detail,1,"|");
				$row_fname=listGetAt($row_field,1,"^");
				$row_fname_type=listGetAt($row_field,2,"^");
				$row_aliasName = listGetAt($row_detail,2,"|");
				$row_align = listGetAt($row_detail,3,"|");
				$row_sort = listGetAt($row_detail,4,"|");
             ?>

			<div class="col p-1"><?=$row_aliasName?></div>
			<?}?>
		</div>
		<div class="row px-3">
			<?
			$no=0;
			while ($show_detail->next()) {
					$no++;			

				?>
				<div class="col-md-12">
					<div class="row">
						<div class="col-1 p-1">
							<a href="#" data-toggle="modal" data-target="#editModal-<?=$show_detail->row($primary_id_child_2)?>" data-original-title="" title="">
								<?=$no;?>
							</a>
						</div>
						
						<?
						for($field=1;$field<=listLen($record_show_child_2,"~");$field++){
							$row_detail = listGetAt($record_show_child_2,$field,"~");
							$row_field = listGetAt($row_detail,1,"|");
							$row_fname=listGetAt($row_field,1,"^");
							$row_fname_type=listGetAt($row_field,2,"^");
							$row_aliasName = listGetAt($row_detail,2,"|");
							$row_align = listGetAt($row_detail,3,"|");
							$row_sort = listGetAt($row_detail,4,"|");
		            	?>
							<div class="col p-1">
								<?=$show_detail->row($row_field)?>
							</div>
						
						<?}?>
					</div>
				</div>

				<div class="modal fade" id="editModal-<?=$show_detail->row($primary_id_child_2)?>" tabindex="-1" role="dialog" aria-labelledby="editModal-<?=$show_detail->row($primary_id_child_2)?>" style="display: none;" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
						<div class="modal-content">
	 						<form action="<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&edit=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&update_child_2=yes&refresh=<?=md5("mdYHis")?>#child_2" method="post" name="updatechildform_2" enctype="multipart/form-data" id="updateform_2" class="form-horizontal">
								
												
								<div class="modal-header">
									<h6 class="modal-title">Edit Item</h6>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
								</div>
								<div class="modal-body">
									<div class="row px-3">
										<?
							          	for($field=1;$field<=listLen($record_show_child_2,"~");$field++){
											$row_detail = listGetAt($record_show_child_2,$field,"~");
											$row_field = listGetAt($row_detail,1,"|");
											$row_fname=listGetAt($row_field,1,"^");
											$row_fname_type=listGetAt($row_field,2,"^");
											$row_aliasName = listGetAt($row_detail,2,"|");
											$row_align = listGetAt($row_detail,3,"|");
											$row_sort = listGetAt($row_detail,4,"|");
							             ?>
											<div class="col p-1"><?=$row_aliasName?></div>
										<?}?>
									</div>
									<div class="row px-3">
										<input type="hidden" name="<?=$primary_id_child_2?>" value="<?=$show_detail->row($primary_id_child_2)?>">
										<?
										for($field=1;$field<=listLen($record_show_child_2,"~");$field++){
											$row_detail = listGetAt($record_show_child_2,$field,"~");
											$row_field = listGetAt($row_detail,1,"|");
											$row_fname=listGetAt($row_field,1,"^");
											$row_fname_type=listGetAt($row_field,2,"^");
											$row_aliasName = listGetAt($row_detail,2,"|");
											$row_align = listGetAt($row_detail,3,"|");
											$row_sort = listGetAt($row_detail,4,"|");
							             ?>
											<div class="col p-1">
												<input class="w-100" type="text" name="<?=$row_field?>" value="<?=$show_detail->row($row_field)?>">
											</div>
										<?}?>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal" data-original-title="" title="">Delete</button> -->
									<button type="button" class="btn btn-secondary btn-sm" onclick="if(confirm('Anda Yakin Hapus Data Ini?')){ location='<?$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&delete_child_2=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&<?=$primary_id_child_2?>=<?=$show_detail->row($primary_id_child_2)?>&ref=<?=md5(date("mdyHis"))?>#child_2';} " data-target="#child">Delete</button>
									
                                    <button type="submit" class="btn btn-primary btn-sm" data-target="#child_2" >Update</button>

									<!-- <button class="btn btn-primary btn-sm" type="button" data-original-title="" title="">Update</button> -->
								</div>
							</form>

						</div>
					</div>
				</div>

			<?}?>
		</div>

		<form action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&edit=yes&<?=$_primary_id?>=<?=uriParam($_primary_id)?>&insert_child_2=yes&refresh=<?=md5("mdYHis")?>" method="post" name="newformchild_2" enctype="multipart/form-data" id="newformchild_2" class="form-horizontal">

			<div class="row px-3">
				<div class="col-1 p-1">
					?
				</div>
				<?
				for($a=1;$a<=listLen($field_type_child_2, '#');$a++){
					$field_detail=listGetAt($field_type_child_2,$a,"#"); //Ambil Detail Field
					$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
					// echo $field_name_ori;
					$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
					$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
					$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
					
					if(listFind($field_child_require_2,$field_name_ori)){
						$required_child_2="required='required'";
					}else{
						$required_child_2="";
					}
				?>
					<div class="col p-1">
						<input class="w-100" type="text" name="<?=$field_name_ori?>" <?=$required_child_2?>>
					</div>
				
				<?}?>

				<!-- <div class="col-12" align="center">
					<button type="button" class="btn btn-success btn-sm" onclick="location='<?=$url_new?>';"><i class="icon-save icon-white"></i> &nbsp; Save</button>
				</div> -->
			</div>
			<div class="row px-3">
				<div class="col" align="center">
					<button type="button" class="btn btn-success btn-sm" onclick="_cekChildValid(document.newformchild_2);">
						<i class="icon-save icon-white"></i> &nbsp; Save
					</button>
				</div>
			</div>
		</form>

<!-- 			<div class="col p-1">
				<button type="button" class="btn btn-light btn-sm" onclick="location='<?=$url_new?>';" class="btn default"><i class="icofont icofont-swoosh-left icon-black"></i> Save</button>
			</div> -->
		<!-- </div> -->
	</div>
	<div class="card-footer">
		
	</div>
</div>