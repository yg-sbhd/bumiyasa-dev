<?
	$autotext->query("select * from ref_numbering where num_id=".$field_row);
	$autotext->next();
	$max_no=$autotext->row("maxres_no")+1;
	$autotext2->query("update ref_numbering set maxres_no=".$max_no." where num_id=".$field_row);
	$format_no=$autotext->row("format_no");
	$format_no=str_replace('[datetime]',date("Ymd"),$format_no);
	$format_no=str_replace('[max_no]',$max_no,$format_no);
?>
<input name="<?=$field_name_ori?>" type="text" value="<?=$format_no?>" maxlength="<?=$field_size?>" class="form-control" readonly>