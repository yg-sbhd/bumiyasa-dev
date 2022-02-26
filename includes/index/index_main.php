
<br />
<?
include "index_outstanding.php";
$user_id          = $_SESSION["user_id_" .$ANOM_VARS["app_session_code"]. date("mdY")];
$group_id         = $_SESSION["group_id_".$ANOM_VARS["app_session_code"]  . date("mdY")];
$group_location_id   = $_SESSION["group_location_id_" .$ANOM_VARS["app_session_code"] . date("mdY")];
$location   = $_SESSION["location_" .$ANOM_VARS["app_session_code"] . date("mdY")];

$group = cmsDB();
$qry_group = " select * from master_group_location where ";
if($location=="SITE"){
   $qry_group .= " group_location_id in (".$group_location_id.") and is_deleted=0";
}else{
   $qry_group .= " group_location_id not in (0,1) and is_deleted=0";
}

$group->query($qry_group);
?>
<div class="container-fluid">
   <div class="row">
      <?while ($group->next()) {?>
         <div class="<?if($group->recordCount() > 1){ echo 'col-md-12';}else{echo 'col-md-12';}?>">
            <!-- BEGIN Portlet PORTLET-->
            <div class="card">
               <!-- <div class="card-header">
                  <div class="row">
                     <div class="col-md-4">
                        <div style="font-size: 18px;"><i class="icon-home"></i> <?=$group->row('group_name_alias')?></div>
                     </div>

                     <div class="col-md-4">
                        <div style="font-size: 14px;">Total Production Today : 
                           <div style="display: inline-block;" id="today_<?=$group->row('group_location_id')?>">
                           </div> Kwh
                        </div> 
                     </div>

                     <div class="col-md-4">
                        <div style="font-size: 14px;">Total Production This Month : 
                           <div style="display: inline-block;" id="month_<?=$group->row('group_location_id')?>">
                           </div> Kwh
                        </div>
                     </div>
                     
                  </div>
               </div> -->
               <div class="card-body">
                  <div id=<?=$group->row('group_location_id')?>>
                  </div>
               </div>
            </div>
         </div>  

        <script type="text/javascript">
         $(document).ready(function() {
            setInterval(function(){
               var id    = '<?=$group->row('group_location_id')?>';
               var today = '<?=$group->row('group_location_id')?>';
               var month = '<?=$group->row('group_location_id')?>';

               var url_  = 'includes/index/graph/index.php?group_location_id='+id;
               var image_load  = "<div class='ajax_loading width-20px' style='min-width: 310px; height: 300px; margin: 0 auto;background:#fff;'>Loading...</div>";
               $.ajax({
                  url: url_,
                  beforeSend: function(){
                     $('#'+id).html(image_load);
                  },  
                  type: "get", 
                  dataType: "html",
                  success: function(response){
                     $('#'+id).html(response);
                  },
                  error: function(){
                     alert("Terjadi kesalahan!");
                  },
               });
               return false;
            }, 100000);

            setInterval(function(){
               var id    = '<?=$group->row('group_location_id')?>';
               var today = '<?=$group->row('group_location_id')?>';
               var month = '<?=$group->row('group_location_id')?>';

               var url_        = 'includes/index/graph/today.php?group_location_id='+id;
               var image_load  = "<div>Loading...</div>";
               
               $.ajax({
                  url: url_,
                  beforeSend: function(){
                     $('#today_'+id).html(image_load);
                  },  
                  type: "get", 
                  dataType: "html",
                  success: function(response){
                     // console.log(response);
                     $('#today_'+id).html(response);
                  },
                  error: function(){
                     alert("Terjadi kesalahan function today!");
                  },
               });
               return false;  
            }, 100000);

            setInterval(function(){
               var id    = '<?=$group->row('group_location_id')?>';
               var today = '<?=$group->row('group_location_id')?>';
               var month = '<?=$group->row('group_location_id')?>';

               var url_        = 'includes/index/graph/month.php?group_location_id='+id;
               var image_load  = "<div>Loading...</div>";
               
               $.ajax({
                  url: url_,
                  beforeSend: function(){
                     $('#month_'+id).html(image_load);
                  },  
                  type: "get", 
                  dataType: "html",
                  success: function(response){
                     // console.log(response);
                     $('#month_'+id).text(response);
                  },
                  error: function(){
                     alert("Terjadi kesalahan function today!");
                  },
               });
               return false;  
            }, 100000);

            setInterval(_load_graph(<?=$group->row('group_location_id')?>), 100000);
            setInterval(_load_production_today(<?=$group->row('group_location_id')?>), 100000);
            setInterval(_load_production_month(<?=$group->row('group_location_id')?>), 100000);


            function _load_graph(id){
               var url_ = 'includes/index/graph/index.php?group_location_id='+id;
               var image_load  = "<div class='ajax_loading width-20px' style='min-width: 310px; height: 300px; margin: 0 auto;background:#fff;'>Loading...</div>";
               
               $.ajax({
                  url: url_,
                  beforeSend: function(){
                     $('#'+id).html(image_load);
                  },  
                  type: "get", 
                  dataType: "html",
                  success: function(response){
                     $('#'+id).html(response);
                  },
                  error: function(){
                     alert("Terjadi kesalahan!");
                  },
               });
               return false;  
            }

            function _load_production_today(id){
               var url_        = 'includes/index/graph/today.php?group_location_id='+id;
               var image_load  = "<div>Loading...</div>";
               
               $.ajax({
                  url: url_,
                  beforeSend: function(){
                     $('#today_'+id).html(image_load);
                  },  
                  type: "get", 
                  dataType: "html",
                  success: function(response){
                     // console.log(response);
                     $('#today_'+id).text(response);
                  },
                  error: function(){
                     alert("Terjadi kesalahan function today!");
                  },
               });
               return false;  
            }

            function _load_production_month(id){
               var url_        = 'includes/index/graph/month.php?group_location_id='+id;
               var image_load  = "<div>Loading...</div>";
               
               $.ajax({
                  url: url_,
                  beforeSend: function(){
                     $('#month_'+id).html(image_load);
                  },  
                  type: "get", 
                  dataType: "html",
                  success: function(response){
                     console.log(response);
                     $('#month_'+id).html(response);
                  },
                  error: function(){
                     alert("Terjadi kesalahan function today!");
                  },
               });
               return false;  
            }

            

         });
      </script>
      <?}?>
   </div>
</div>


