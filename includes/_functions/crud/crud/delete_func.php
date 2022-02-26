<?
	if(isset($_GET["delete"])){
		if(is_numeric(decryptStringArray(uriParam($primary_id))) == true){
			$user = cmsDB();
			// $strsql = "update ".$nama_table." set is_deleted=1 where ".$primary_id."=".uriParam($primary_id);
			$strsql = "update ".$nama_table." set is_deleted=1,delete_date='".date("Y-m-d H:i:s")."',delete_by=".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]." where ".$primary_id."=".decryptStringArray(uriParam($primary_id));
	
			//echo $strsql;die();
			$user->query($strsql);
			
			opt_deleteqry(uriParam($primary_id));
			//$strsql = "delete from ".$nama_table_child." where ".$primary_id."=".uriParam($primary_id);
			//$user->query($strsql);
			//echo $strsql;
			echo "<script>location='".$_SERVER["SCRIPT_NAME"]. "?tmp=".uriParam("tmp")."&refresh=".md5("mdYHis")."';</script>";die();
		}else{
			echo  " Invalid Parameter!!";die();
		}
	}
?>