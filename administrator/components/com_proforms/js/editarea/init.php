<?php 

	$id = (isset($_REQUEST['id']))? addslashes(strip_tags($_REQUEST['id'])):null;
	$syntax = (isset($_REQUEST['syntax']))? addslashes(strip_tags($_REQUEST['syntax'])):null;
	$lang = (isset($_REQUEST['lang']))? addslashes(strip_tags($_REQUEST['lang'])):'en';
	if( !$id || !$syntax) exit;
?>
editAreaLoader.init({
			id : "<?php echo $id; ?>"		
			,syntax: "<?php echo $syntax; ?>"
			,allow_resize: false
			,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
			,language: "<?php echo $lang; ?>"
			,start_highlight: true		
			});

addEditArea('<?php echo $id; ?>');