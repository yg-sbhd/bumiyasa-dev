<?
function opt_insertqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
	$qry->query("update ref_perusahaan set is_active=0");
	$qry->query("update ref_perusahaan set is_active=1 where perusahaan_id=".$maxID);
}
function opt_updateqry($maxID){
	global $_POST,$_GET;
	$qry=cmsDB();
	$qry->query("update ref_perusahaan set is_active=0");
	$qry->query("update ref_perusahaan set is_active=1 where perusahaan_id=".$maxID);
}
function opt_deleteqry(){
	global $_POST,$_GET;
	$qry=cmsDB();
}


$nama_List = "Profil Perusahaan";

$main_query="";
$nama_table = "ref_perusahaan";
$primary_id = "perusahaan_id";
$form_new_title = "Tambah Profil";
$form_edit_title = "Ubah Profil";
$field_name = "nama,alamat,telp,telp2,npwp,npwp_file,siup,siup_file,email,owner,owner_hp,owner_ktp,is_active";
$field_alias_name = "Nama Perusahaan,Alamat,No Telp,No Telp 2,NPWP No.,Dokumen NPWP,SIUP No,Dokumen SIUP,Email,Nama Pemilik,Hp Pemilik,KTP Pemilik,Aktif (Y/N)";


$field_type_name = "nama|text|50^0";
$field_type_name = $field_type_name . "#alamat|textarea|50^0";
$field_type_name = $field_type_name . "#telp|text|50^5";
$field_type_name = $field_type_name . "#telp2|text|50^5";
$field_type_name = $field_type_name . "#npwp|text|50^5";
$field_type_name = $field_type_name . "#npwp_file|file|50^5";
$field_type_name = $field_type_name . "#siup|text|50^5";
$field_type_name = $field_type_name . "#siup_file|file|50^5";
$field_type_name = $field_type_name . "#email|text|50^5";
$field_type_name = $field_type_name . "#owner|text|50^5";
$field_type_name = $field_type_name . "#owner_hp|text|50^5";
$field_type_name = $field_type_name . "#owner_ktp|file|50^5";
$field_type_name = $field_type_name . "#is_active|radio|10^5";

$search_field = "nama,alamat,telp,telp2,npwp,npwp_file,siup,siup_file,email,owner,owner_hp,owner_ktp";

$record_show =  "nama|Nama|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "alamat|Alamat|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "telp|Telp|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "telp2|Telp 2|left|sort_on|link_on|sub_query_off~";
$record_show = $record_show . "npwp|NPWP|left|sort_on|link_on|sub_query_off~";
$record_show =$record_show . "npwp_file|Dok NPWP|center|sort_off|link_off|photo~";
$record_show =$record_show . "owner_ktp|KTP Pemilik|center|sort_off|link_off|photo~";
$record_show = $record_show . "is_active|Aktif|center|sort_on|link_on|sub_query_off~";

$field_required="nama,alamat,telp,email";
recordListReg($nama_List,$main_query,$nama_table,$primary_id,$form_new_title,$form_edit_title,$field_name,$field_alias_name,$field_type_name,$search_field,$record_show,$field_required);

?>
