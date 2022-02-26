<?if(isset($_GET["new_form"])){?>
	<div class="container-fluid">
	  <div class="page-header">
	    <div class="row">
	      <div class="col-lg-6">
	        <h5><i class="fa fa-plus"></i> <?=$form_new_title?></h5>
	      </div>
	      <div class="col-lg-6">
	        <ol class="breadcrumb pull-right mb-1">
	          <li class="breadcrumb-item active"><a href="<?=$www_url?>"><i data-feather="home"></i></a> &nbsp; <?=$form_map?> / New</li>
	        </ol>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">
					<div class="card">
						<?
						if(uriParam('tmp') == encryptStringArray('templates/logsheet/index.php')){
							echo _add_production('create', $_SESSION["group_location_id_" .$ANOM_VARS["app_session_code"] . date("mdY")], date('Y-m-d'));
						}
						?>
				<form id="form" name="newfrm" action="<?=$_SERVER["SCRIPT_NAME"]?>?tmp=<?=uriParam("tmp")?>&new_form=yes&insert=yes&refresh=<?=md5("mdYHis")?>" class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
						<div class="card-body">
							<div class="row">

							<?
							$popupcount=1;
							for($field=1;$field<=listLen($field_name);$field++){
								$field_detail=listGetAt($field_type_name,$field,"#"); //Ambil Detail Field
								$field_name_ori=listGetAt($field_detail,1,"|"); //Ambil Field Name
								$field_type_ori=listGetAt($field_detail,2,"|"); //Ambil Field Type
								$field_size=listGetAt(listGetAt($field_detail,3,"|"),1,"^");  //Ambil Field Size
								$field_row=listGetAt(listGetAt($field_detail,3,"|"),2,"^"); //Ambil Field Row
								// $field_name_ori_target = 

								if(listFind($field_required,$field_name_ori)){
									$required="required='required'";
								}else{
									$required="";
								}
								?>
							
								<div class="col-md-12" id="<?=$field_name_ori?>" >
									<div class="form-group row text-left text-md-right">
										<label  class="col-md-4 col-form-label">
											<font size=-1>
												<?=listGetAt($field_alias_name,$field)?>
												<?if(listFind($field_required,$field_name_ori)){?>
													<font color="red"> *</font>
												<?}?>
											</font>
										</label>
										<div class="col-md-8" align="left">
											<?if($field_type_ori=="text"){
												add_text($field_name_ori, $required);
											}elseif($field_type_ori=="text-readonly"){
												add_text_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="textarea"){
												add_textarea($field_name_ori, $required);
											}elseif($field_type_ori=="textarea-readonly"){
												add_textarea_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="int"){
												add_int_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="int-readonly"){
												add_int_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="number"){
												add_number_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="number-readonly"){
												add_number_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="decimal"){
												add_decimal_($field_name_ori, $required);
											}elseif($field_type_ori=="decimal-readonly"){
												add_decimal_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="file"){
												// @include "create/file.php";
												add_file($field_name_ori, $required);
											}elseif($field_type_ori=="image"){
												// @include "create/file.php";
												add_image($field_name_ori, $required);
											}elseif($field_type_ori=="telephone"){
												add_telephone($field_name_ori, $required);
											}elseif($field_type_ori=="telephone-readonly"){
												add_telephone_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="email"){
												add_email($field_name_ori, $required);
											}elseif($field_type_ori=="email-readonly"){
												add_email_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="radio"){
												add_radio($field_name_ori, $field_size, $required);
											// }elseif($field_type_ori=="percentage"){
											// 	@include "create/percentage.php";
											// }elseif($field_type_ori=="number_authorization"){
											// 	@include "create/number_authorization.php";
											}elseif($field_type_ori=="checkbox"){
												@include "create/checkbox.php";
											}elseif($field_type_ori=="multi-checkbox"){
												// @include "create/checkbox.php";
												add_multi_checkbox($field_name_ori, $field_size, $required);

											// }elseif($field_type_ori=="auto-text"){
											// 	@include "create/auto_text.php";
											// }elseif($field_type_ori=="text"){
											// 	@include "create/auto_text.php";
											// }elseif($field_type_ori=="geotag"){
											// 	@include "create/auto_text.php";
											}elseif($field_type_ori=="date-now"){
												add_date_now($field_name_ori, $required);
											}elseif($field_type_ori=="date-now-readonly"){
												add_date_now_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="date"){
												add_date($field_name_ori, $required);
											}elseif($field_type_ori=="date-readonly"){
												add_date_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="time"){
												add_time($field_name_ori, $required);
												// @include "create/time.php";
											}elseif($field_type_ori=="time-readonly"){
												add_time_readonly($field_name_ori, $required);
											}elseif($field_type_ori=="password"){
												add_password($field_name_ori, $required);
											}elseif($field_type_ori=="datefromtime"){
												@include "create/datefromtime.php";
											}elseif($field_type_ori=="datefromtimetotime"){
												@include "create/datefromtimetotime.php";
											}elseif($field_type_ori=="datefromtimetotime-readonly"){
												@include "create/datefromtimetotime-readonly.php";
											}elseif($field_type_ori=="selectpopup"){
												@include "create/selectpopup.php";
											}elseif($field_type_ori=="select"){
												add_select($field_name_ori, $field_size, $required);
											}elseif($field_type_ori=="select-link"){
												add_select_link($field_name_ori, $field_size, $required, $field_row);

											}elseif($field_type_ori=="select-readonly"){
												add_select_readonly($field_name_ori, $field_size, $required);

												// @include "create/select_readonly.php";
											}elseif($field_type_ori=="multiselect"){
												add_multiselect($field_name_ori, $field_size, $required);

												// @include "create/multiselect.php";
											}elseif($field_type_ori=="moreselect"){
												@include "create/moreselect.php";
											}elseif($field_type_ori=="maps"){
											//if(!isset($_GET["edit"])){
											?>
											Remark FRom This system
											<?//}?>
											<?}?>
										</div>
									</div>
								</div>
							<?}?>
							</div>
						</div>
									
						<div class="card-footer">
							<div class="col-md-12" align="center">
								<?if (_checkauth("New") || uriParam('tmp') == encryptStringArray('templates/ref_user/index.php') || uriParam('tmp') == encryptStringArray('templates/ref_usergroup/index.php') ){?>
									<button type="button" class="btn btn-success btn-sm" onclick="_cekValid(document.newfrm);">
										<i class="icon-save icon-white"></i> &nbsp; Save
									</button>
								<?}?>
								
								<?
								$url_string = str_replace('new_form=yes&', '',$_SERVER["QUERY_STRING"]);
								$url_new ="?tmp=".uriParam('tmp')."&ref=".md5(date("mdYHis"));
								/*if(isset($_GET["search"])){
								$url_new =$url_string."&ref".md5(date("mdYHis"));
								}else{
								$url_new = "?&ref".md5(date("mdYHis"));
								}*/
								?>
								<button type="button" class="btn btn-light btn-sm" onclick="location='<?=$url_new?>';" class="btn default"><i class="icofont icofont-swoosh-left icon-black"></i> Cancel</button>
							</div>
				</form>
						</div>
					</div>
			</div>
<?}?>