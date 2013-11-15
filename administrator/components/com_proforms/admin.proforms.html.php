<?php
/**
* @name MOOJ Proforms 
* @version 1.0
* @package proforms
* @copyright Copyright (C) 2008-2010 Mad4Media. All rights reserved.
* @author Dipl. Inf.(FH) Fahrettin Kutyol
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Please note that some Javascript files are not under GNU/GPL License.
* These files are under the mad4media license
* They may edited and used infinitely but may not repuplished or redistributed.  
* For more information read the header notice of the js files.
**/


defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
//++++++++++++++++++++++++++++++++ New Class HTML_HELPERS_m4j +++++++++++++++++++++++++++++++ //
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
class HTML_HELPERS_m4j{

	function dbError($error)
	{
		echo "<script type='text/javascript'>alert('".$error."');</script>";
	}//EOF dbERROR
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function image($image="",$link=null,$alt=null,$width=null,$height=null,$border=0,$add_remember=null,$info = "" , $onclick = null)
	{
		
		if($alt == M4J_LANG_LINK_TO_MENU){
			$info = ' info="'.M4J_LANG_LINK_THIS_FORM.'" ';
		}
		if($alt == M4J_LANG_LINK_CAT_TO_MENU){
			$n= explode("name=",$link);
			$name = explode("&",$n[1]);
			
			$catName = "<span style='color:green;font-weight: bold;'>".urldecode($name[0])."</span>";
			$info = ' info="'.sprintf(M4J_LANG_LINK_THIS_CAT,$catName).'" ';
			
			if(strpos(M4J_REMEMBER_CID_QUERY,"remember_cid=-2"))$info = ' info="'.M4J_LANG_LINK_THIS_CAT_ALL.'" ';
			
			if(strpos(M4J_REMEMBER_CID_QUERY,"remember_cid=-1"))$info = ' info="'.M4J_LANG_LINK_THIS_NO_CAT.'" ';
		}
		
		if($info != "") $alt = "";
		
		
		$out="";
		if($link)
		{
			$out.='<a href="'.$link;
			if($add_remember==null) $out .= M4J_REMEMBER_CID_QUERY . '" ';
			if($onclick){
				$out .= 'onclick ="javascript: '.$onclick.'" ';
			}
			$out .= '>';
		}
		$out.='<img src="'.M4J_IMAGES.$image.'" border="'.$border.'" ';
		if($alt) $out.='alt="'.$alt.'" title="'.$alt.'" ';
		if($width) $out.='width="'.$width.'" ';
		if($height) $out.='height="'.$height.'" ';
		$out.= $info.' />';
		if($link) $out.='</a>';
		return $out;
	}//EOF IMAGE
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function spacer($width='16px',$height='16px')
	{
		return $this->image('spacer.png',null,null,$width,$height);
	}//EOF CAPTION

	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function caption($caption,$right=null,$m4j_breadcrump=null)
	{
		if(!$right)
		echo'<h1>'.$caption.'</h1>';
		else
		echo'<table width="100%" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
				 <td><h1 class="m4j_toLeft">'.$caption.'</h1></td>
				 <td><div class="m4j_toRight">'.$right.'</div></td>
				 </tr></tbody></table>';
		if($m4j_breadcrump!=null)
		echo'<span class="m4j_breadcrump">'.$m4j_breadcrump.'</span>';
	}//EOF CAPTION

	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function init_table($head=null)
	{
		
		echo '<table border="0" align="center" cellpadding="0" cellspacing="0" class="list" id="m4jTableList"><tbody>';
			
		if($head)
		{
			echo'<tr>';
			$size = sizeof($head);
			for($t=0;$t<$size;$t++)
			echo'<th>'.$head[$t].'</th>';
			echo'</tr>';
		}
	}//EOF INIT TABLE

	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function table_row($rowArray,$even,$widthArray, $class = null , $display = true)
	{
		$display = ($display) ? '' : ' style="display:none;" ';
		
		if($even) echo '<tr class="even '.$class.'" rowover="1" valign="top"'.$display.'>';
		else  echo '<tr class="odd '.$class.'" rowover="2" valign="top"'.$display.'>';
			
		$size = sizeof($rowArray);
		for($t=0;$t<$size;$t++)
		echo'<td width="'.$widthArray[$t].'">'.$rowArray[$t].'</td>';
		echo'</tr>';
	}//EOF TABLE_ROW
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function int2lang($number)
	{
		if($number==1) return M4J_LANG_YES;
		else return M4J_LANG_NO;
	}//EOF CLOSE TABLE
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function close_table()
	{
		echo'</tbody></table>';
	}//EOF CLOSE TABLE
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function link($link="",$core="",$class=null, $id=null)
	{
		$add = "";
		if ($class!=null) $add .= 'class="'.$class.'"';
		if ($id!=null) $add .= ' id="'.$id.'"';
		return '<a href="'.$link.M4J_REMEMBER_CID_QUERY.'" '.$add.'>'.$core.'</a>';
	}//EOF LINK
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function delete_button($link,$id,$extra= NULL , $atts = NULL, $change_image = NULL)
	{
		$image = ($change_image)? $change_image : "remove.png";
		$href = $link.M4J_DELETE.M4J_REMEMBER_CID_QUERY."&id=".$id;		
		return '<a href ="'. $href .'" text="'. M4J_LANG_DELETE_CONFIRM. $extra .'" class="m4jGetDelete" '.$atts.'>'."\n".
			   '<img src="'. M4J_IMAGES .$image.'" border="0" align="top" title="'. M4J_LANG_DELETE .'"></img>'."\n".
			   '</a>'."\n";		
	}//EOF DELETE BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function edit_button($link,$id,$alt = M4J_LANG_EDIT)
	{
		return $this->image("pen-small.png",$link.M4J_HIDE_BAR.M4J_EDIT."&id=".$id,$alt);
	}//EOF EDIT BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function edit_by_name($name,$link,$id,$alt = M4J_LANG_EDIT)
	{
		$link .= M4J_REMEMBER_CID_QUERY;
		return '<a href="'.$link.M4J_HIDE_BAR.M4J_EDIT."&id=".$id.'">'.$name.'</a>'."\n";
	}//EOF EDIT BY NAME
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function copy_button($link,$id,$alt = M4J_LANG_DO_COPY, $hide=null,$eid=null)
	{
		$eid_query = '';
		if ($eid) $eid_query = '&eid='.$eid;
		return $this->image("copy.png",$link.$hide.$eid_query.M4J_COPY."&id=".$id,$alt);
	}//EOF COPY BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function up_down_button($link,$id,$sort_order)
	{
		return $this->image("up.png",$link.M4J_UP."&id=".$id."&sort_order=".$sort_order,M4J_LANG_UP, null, null, 0, null, '' , "return m4jOnce(this);").
		$this->spacer('5px').
		$this->image("down.png",$link.M4J_DOWN."&id=".$id."&sort_order=".$sort_order,M4J_LANG_DOWN, null, null, 0, null, '', "return m4jOnce(this);");
	}//EOF UP & DOWN BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function storage_button($link,$id,$alt = M4J_LANG_READ_STORAGES)
	{
		return $this->image("database.png",$link.M4J_HIDE_BAR."&id=".$id,$alt);
	}//EOF STORAGE BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function span($text='', $class=null)
	{
		$out = '<span ';
		if($class) $out .= 'class ="'.$class.'">'.$text.'</span>';
		return $out;
	}//EOF SPAN
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function element_edit_button($link,$id,$eid,$form,$alt = M4J_LANG_EDIT)
	{
		return $this->image("pen-small.png",$link.M4J_HIDE_BAR.M4J_EDIT."&id=".$id."&eid=".$eid."&form=".$form,$alt);
	}//EOF ELEMENT DELETE BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function element_edit_by_name($name,$link,$id,$eid,$form,$alt = M4J_LANG_EDIT)
	{
		$link .= M4J_REMEMBER_CID_QUERY;
		return '<a href="'.$link.M4J_HIDE_BAR.M4J_EDIT."&id=".$id."&eid=".$eid."&form=".$form.'">'.$name.'</a>'."\n";
	}//EOF ELEMENT EDIT BY NAME
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function element_delete_button($link,$id,$eid)
	{
		$href = $link.M4J_HIDE_BAR.M4J_DELETE .M4J_REMEMBER_CID_QUERY. "&id=".$id."&eid=".$eid;		
		return '<a href ="'. $href .'" text="'. M4J_LANG_DELETE_CONFIRM. '" class="m4jGetDelete">'."\n".
			   '<img src="'. M4J_IMAGES .'remove.png" border="0" align="top" title="'. M4J_LANG_DELETE .'"></img>'."\n".
			   '</a>'."\n";	
	}//EOF ELEMENT DELETE BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function element_up_down_button($link,$id,$eid,$sort_order)
	{
		return $this->image("up.png",$link.M4J_HIDE_BAR.M4J_UP."&id=".$id."&eid=".$eid."&sort_order=".$sort_order,M4J_LANG_UP).
		$this->spacer('5px').
		$this->image("down.png",$link.M4J_HIDE_BAR.M4J_DOWN."&id=".$id."&eid=".$eid."&sort_order=".$sort_order,M4J_LANG_DOWN);
	}//EOF ELEMENT UP & DOWN BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function category_menu($rows=null,$selected=-2,$jump=null,$hide_all=null,$link=false)
	{
		global $database;
		$out = "";
		$select_all = '';
		$select_no = '';
		if($selected==null) $selected =-2;
		if($hide_all && $selected==-2) $selected=-1;
		if($selected ==-2) $select_all ='selected="selected"';
		if($selected ==-1) $select_no ='selected="selected"';

		if($jump) $jump = 'onchange="javascript: jump(this,\''.$jump.M4J_REMEMBER_CID_QUERY.'&cid=\');" ';


		if(!$hide_all)	$out .= M4J_LANG_CATEGORY.': ';
		$out .= '<select id="m4j_category" name="m4j_category" '.$jump;
		if($hide_all) $out .= 'style="width:100%"';
		$out .= '>';
		if(!$hide_all)
		$out .= '<option value="-2" '.$select_all.'>'.M4J_LANG_ALL_FORMS.'</option>';
		$out .= '<option value="-1" '.$select_no.'>'.M4J_LANG_NO_CATEGORYS.'</option>';
		$out .= '<optgroup label="'.M4J_LANG_CATEGORY.'">';
		$name = '';
		foreach ($rows as $row)
		{
			$out .= '<option value="'.$row->cid.'" ';
			if($selected==$row->cid)
			{
				$out .= 'selected="selected" ';
				$name = MReady::_($row->name);
			}
			$out .= '>'.MReady::_($row->name).'</option>';
		}
		$out .= '</optgroup></select>';
		$name = urlencode($name);
		if($link && ! _M4J_IS_J16)
		$out .= $this->image("link2cat.png",M4J_LINK. "&id=-999".M4J_HIDE_BAR."&name=".$name, M4J_LANG_LINK_CAT_TO_MENU);
		return $out;
	}//EOF CATEGORY MENU
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function active_button($link,$id,$active,$hide=null,$eid=null)
	{
		$eid_query ='';
		$hide_query ='';
		if($eid)
		$eid_query ='&eid='.$eid;
		if($hide)
		$hide_query =M4J_HIDE_BAR;
			
			
		if($active==1)
		return $this->image("active.png",$link.M4J_UNPUBLISH. "&id=".$id.$eid_query.$hide_query, M4J_LANG_HOVER_ACTIVE_ON);
		else
		return $this->image("not_active.png",$link.M4J_PUBLISH. "&id=".$id.$eid_query.$hide_query, M4J_LANG_HOVER_ACTIVE_OFF);


	}//EOF ACTIVE  BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function required_button($link,$id,$required,$hide=null,$eid=null)
	{
		$eid_query ='';
		$hide_query ='';
		if($eid)
		$eid_query ='&eid='.$eid;
		if($hide)
		$hide_query =M4J_HIDE_BAR;
			
			
		if($required==1)
		return $this->image("required.png",$link.M4J_NOT_REQUIRED. "&id=".$id.$eid_query.$hide_query, M4J_LANG_HOVER_REQUIRED_ON);
		else
		return $this->image("not_required.png",$link.M4J_REQUIRED. "&id=".$id.$eid_query.$hide_query, M4J_LANG_HOVER_REQUIRED_OFF);


	}//EOF ACTIVE  BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	
	function usermail_button(){
		return $this->image("is_usermail.png",null,null,"16px","16px","0",null,'info="'.M4J_LANG_USERMAIL_TOOLTIP.'"');
	}//EOF USERMAIL  BUTTON
	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	
	function replace_yes_no($html)
	{
		$html =  str_replace('{M4J_YES}',M4J_LANG_YES,$html);
		return str_replace('{M4J_NO}',M4J_LANG_NO,$html);
	}//EOF replace_yes_no
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function link_button($link,$id,$form_name=null,$linkcid = -2)
	{
		return $this->image("link.png",$link.M4J_HIDE_BAR."&id=".$id."&cid=".$linkcid ."&name=".$form_name,M4J_LANG_LINK_TO_MENU);
			
	}//EOF DELETE BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function advice($text,$view=0)
	{
		switch($view)
		{
			case 0:
				echo $text;
				break;
					
			case 1:
				echo '<h1>'.$text.'</h1><br/>';
				break;
					
			case 2:
				echo '<h2>'.$text.'</h2><br/>';
				break;
					
			case 3:
				echo '<h3>'.$text.'</h3><br/>';
				break;
					
			case 4:
				echo '<p>'.$text.'</p>';
				break;
					
			case 5:
				echo '<b>'.$text.'</b>';
				break;
					
		}

	}//EOF ADVICE
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function config_feedback($action)
	{
		switch($action)
		{
			case 1:
				return '<span class="m4j_success">'.M4J_LANG_CONFIG_RESET.'</span>';
				break;
					
			case 2:
				return'<span class="m4j_success">'.M4J_LANG_CONFIG_SAVED.'</span>';
				break;
		}
	}//EOF config feedback
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function info_button($info,$print = null)
	{
		$out ='<img src="'.M4J_IMAGES.'info.png" class="m4jInfoButton" info="'.$info.'" mleft="-5"></img>'."\n";
		if($print) {
			echo $out;
			return null;
		}else return $out;			
		
	}//EOF INFO BUTTON
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	
	function fitString($string = null,$length = 25){
		if(strlen($string)>$length){
			return substr($string,0,($length-3))."...";
		}else{
			return $string;
		}
	}
	
	function checkMailURL($value, $maskSearch = null)
		{
		$validate = new M4J_validate();
		$valueView = ($maskSearch==1) ? $this->maskSearch($value): $value ;
		if ($validate->email($value))
			return '<a href="mailto:'.$value.'">'. $valueView .'</a>';
		elseif ($validate->url($value)) 
			{
			if(substr_count(strtolower($value),'http') == 1 || substr_count(strtolower($value),'https') == 1) return '<a href="'.$value.'"  target="_blank">'.$valueView.'</a>';
			else  return '<a href="http://'.$value.'" target="_blank">'.$valueView.'</a>';
			}
			else return $valueView;
		}

	function maskSearch($string = null){
		if( ! M4J_IS_SEARCH) return $string;
		
//		$pos = stripos(M4J_IS_SEARCH);
		
		$result = str_ireplace(M4J_IS_SEARCH, '<b style="color:red;">'.M4J_IS_SEARCH.'</b>',$string);
		return $result;
		
	}	
	
		
}//EOF CLASS HTML_HELPERS_m4j

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// +++++++++++++++++++++++++++++++ New Class HTML_m4j ++++++++++++++++++++++++++++++++++++++++//
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
class HTML_m4j{

	function error($error=null){
		if($error)	echo'<p class="errorMessage">'.$error.'</p>';
	}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function jsText(){
		JSText::add(array(
			"yes"=>M4J_LANG_YES,
			"no"=>M4J_LANG_NO,
			"errornotitle"=>M4J_LANG_ERROR_NO_TITLE
		));
	}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	
	function head($location,$error=null){

		global $m4jConfig_live_site, $id,$helpers;
		$GLOBALS['m4jAdviceLocation']  = $location;
		
		$workareaWidth =  (isset($_COOKIE["workarea"]) && ($_COOKIE["workarea"] == 1 ) && isset($_COOKIE["workareawidth"])) ?
						  (int) $_COOKIE["workareawidth"] :
						  (int) M4J_WORKAREA ;
		
	    echo '<style><!-- 
	    html {
			height:100%;
			padding-bottom: 1px;
		} --></style>';

	    echo '<script type="text/javascript" language="javascript">document.getElementById("toolbar-box").style.display="none";</script>';
	    
	    $appsOverview = "";
	    if($location == M4J_ADMINAPPS){
	    	$appsCancelURI = M4J_APPLIST.M4J_REMEMBER_CID_QUERY; 
	    	$appsOverview =  '<div class="appsOverviewWrap">
	    					 	<a id="appsOverview" 
	    					 	   href="'.$appsCancelURI.'" 
	    					 	   class="appsoverview" 
	    					 	   style="margin-top: 5px; line-height: 18px;"
	    					 	   onmouseover="javascript: appsOverviewAnim(1);"
	    					 	   onmouseout="javascript: appsOverviewAnim(0);" >
	    					 	   <span>
	    					 	   Apps '.M4J_LANG_OVERVIEW.'</span></a>
	    					 </div>';
	    }
	    
	    
		//BOF echo
		echo '
		<center>
		<div class="m4j_main" id="m4jMain" style="width:'. $workareaWidth .'px">'.$appsOverview.'
			<div id="m4jPanelExpand" class="panelExpand" state="0" workarea="'.(int) M4J_WORKAREA.'" onclick="javascript: workareaExpand(this); " ></div>
		
		
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tbody>
		    <tr>
		      <td width="18px" class="topCorner" valign="top"><img src="'.M4J_IMAGES.'round_left.png" width="18px" height="64px" border="0" /></td>
		      <td valign="top" class="m4j_toolbar_back">
		      <div style="display:block; width:100%; height:64px; float:left;">';
		//EOF echo
		
		$mToolBar  = null;
		
		$advice = '<img src="'.M4J_IMAGES.'advice.png" style="padding:0; margin:0;  margin-top: -77px; margin-left: -23px; border:none; position:absolute; " />';
		//IF toolbar is enabled
		if(M4J_NOBAR!=1)
		//BOF echo
			echo'
				  <table style="display:block;" height="64" border="0" cellpadding="0" cellspacing="0" class="m4j_toLeft">
			  <tr>
				<td height="64" align="center" valign="top"><a href="'.M4J_JOBS.M4J_REMEMBER_CID_QUERY.'" class="m4j"><img src="'.M4J_IMAGES.'jobs.png" alt="'.M4J_LANG_FORMS.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_FORMS.'</a>'.m4jShowAdvice(M4J_JOBS).'</td>
				<td width="10"></td>
				<td height="64" align="center" valign="top"><a href="'.M4J_FORMS.M4J_REMEMBER_CID_QUERY.'" class="m4j"> <img src="'.M4J_IMAGES.'forms.png" alt="'.M4J_LANG_TEMPLATES.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_TEMPLATES.'</a>'.m4jShowAdvice(M4J_FORMS).'</td>
				<td width="10"></td>
				<td height="64" align="center" valign="top"><a href="'.M4J_CATEGORY.M4J_REMEMBER_CID_QUERY.'" class="m4j"> <img src="'.M4J_IMAGES.'category.png" alt="'.M4J_LANG_CATEGORY.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_CATEGORY.'</a>'.m4jShowAdvice(M4J_CATEGORY).'</td>
				<td width="10"></td>
				<td height="64" align="center" valign="top"><a href="'.M4J_CONFIG.M4J_REMEMBER_CID_QUERY.'" class="m4j"> <img src="'.M4J_IMAGES.'config.png" alt="'.M4J_LANG_CONFIG.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_CONFIG.'</a>'.m4jShowAdvice(M4J_CONFIG).'</td>
				<td width="10"></td>
			
				<td height="64" align="center" valign="top"><a href="'.M4J_APPLIST.M4J_REMEMBER_CID_QUERY.'" class="m4j"> <img src="'.M4J_IMAGES.'appicon.png" alt="'.M4J_LANG_APPS.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_APPS.'</a>'.m4jShowAdvice(M4J_APPLIST).'</td>
				<td width="10"></td>
				<td height="64" align="center" valign="top"><a href="'.M4J_BACKUP.M4J_REMEMBER_CID_QUERY.'" class="m4j"> <img src="'.M4J_IMAGES.'backup.png" alt="'.M4J_LANG_BACKUP.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_BACKUP.'</a>'.m4jShowAdvice(M4J_BACKUP).'</td>
				<td width="10"></td>

				<td height="64" align="center" valign="top"><a href="'.M4J_HELP.M4J_REMEMBER_CID_QUERY.'" class="m4j"> <img src="'.M4J_IMAGES.'help.png" alt="'.M4J_LANG_HELP.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_HELP.'</a>'.m4jShowAdvice(M4J_HELP).'</td>
			    <td width="10"></td>
				<td height="64" align="center" valign="top"><a href="'.M4J_SERVICE.M4J_REMEMBER_CID_QUERY.'" class="m4j"> <img src="'.M4J_IMAGES.'service.png" alt="'.M4J_LANG_HELPDESK.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_HELPDESK.'</a>'.m4jShowAdvice(M4J_SERVICE).'</td>
			</tr>
				</table>';
		//EOF echo
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
		// ELSE toolbar is disabled
		else
		{
			//BOF echo
			echo'
		  <table  style="display:block;" height="64" border="0" cellpadding="0" cellspacing="0" class="m4j_toLeft">
			  <tr>
				<td height="64" align="center" valign="top">';
			//EOF echo

			//++++++++++++++++++++++++++++++++ BOF Routing the CancelButton ++++++++++++++++++++++++++++++++++ //
			switch($location)
			{
				default:
					echo'<a href="javascript:history.go(-1)" class="m4j">';
					break;

				case M4J_JOBS_NEW:
					echo '<a href="'.M4J_JOBS.M4J_REMEMBER_CID_QUERY.'" class="m4j">';
					break;

				case M4J_DATASTORAGE:
					echo '<a href="'.M4J_JOBS.M4J_REMEMBER_CID_QUERY.'" class="m4j">';
					echo '	   <img src="'.M4J_IMAGES.'back.png" alt="'.M4J_LANG_OVERVIEW.
				     '" width="48" height="48" border="0" /><br/>'.M4J_LANG_OVERVIEW.'</a>
						  </td>
			 			</tr>
		  			  </table>	
					 ';
					break;
					
				case M4J_APPS:
					$appsCancelURI = isset($_REQUEST["returnedit"]) ? M4J_JOBS_NEW.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.M4J_EDIT."&amp;id=".$id : M4J_JOBS.M4J_REMEMBER_CID_QUERY; 
					echo '<a href="'.$appsCancelURI.'" class="m4j">';
					break;
					

				case M4J_ADMINAPPS:
					$mToolBar = MToolBar::getInstance();
					$appsCancelURI = M4J_APPLIST.M4J_REMEMBER_CID_QUERY; 
					echo $mToolBar->render("left");
					echo '</td></tr></table>';
					break;	
					
					
				case M4J_FORM_NEW:
					echo '<a href="'.M4J_FORMS.M4J_REMEMBER_CID_QUERY.'" class="m4j">';
					break;

				case M4J_FORM_ELEMENTS:
					echo '<a href="'.M4J_FORMS.M4J_REMEMBER_CID_QUERY.'" class="m4j">';
					echo '	   <img src="'.M4J_IMAGES.'back.png" alt="'.M4J_LANG_OVERVIEW.
				     '" width="48" height="48" border="0" /><br/>'.M4J_LANG_OVERVIEW.'</a>
						  </td>
			 			</tr>
		  			  </table>	
					 ';
					break;

				case M4J_CATEGORY_NEW:
					echo '<a href="'.M4J_CATEGORY.M4J_REMEMBER_CID_QUERY.'" class="m4j">';
					break;

				case M4J_ELEMENT:
					global $id;
					echo '<a href="'.M4J_FORM_ELEMENTS.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&id='.$id.'" class="m4j" id="elementCancel">';
					break;

				case M4J_LINK:
					echo '<a href="'.M4J_JOBS.M4J_REMEMBER_CID_QUERY.'" class="m4j">';
					break;

			};
			//++++++++++++++++++++++++++++++++ EOF Routing the CancelButton ++++++++++++++++++++++++++++++++++ //




			//BOF echo
			if($location!= M4J_FORM_ELEMENTS && $location!= M4J_DATASTORAGE & $location!= M4J_ADMINAPPS )
			echo '	   <img src="'.M4J_IMAGES.'cancel.png" alt="'.M4J_LANG_CANCEL.'" width="48" height="48" border="0" /><br/>'.M4J_LANG_CANCEL.'</a>
				</td>
			 </tr>
		  </table>	
		';
			//EOF echo
		}//EOF ELSE

		//BOF echo
		echo'
		<table  style="" height="64" border="0" cellpadding="0" cellspacing="0" class="m4j_toRight">
		  <tr>
		    <td width="200px;" align="right" valign="top">';
		//EOF echo
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
		//++++++++++++++++++++++++++++++ Routing headers right button ++++++++++++++++++++++++++++++++++ //
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

		switch($location){

			//++++++++++++++++++++++++++++++ FORMS / DEFAULT ++++++++++++++++++++++++++++++++++ //

			default:
			case M4J_JOBS:
				//BOF echo
				$countForms = MDB::count("#__m4j_forms");
				if($countForms>0){
					$jobsLink = '<a href="'.M4J_JOBS_NEW.M4J_HIDE_BAR.M4J_NEW_JOB_CID_QUERY.M4J_REMEMBER_CID_QUERY.'" class="m4j">';
				}else{
					$jobsLink = '<script type="text/javascript">var m4jNewFormsURL = "'.
					M4J_FORM_NEW.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'"; '."\n".
					'var m4jNoFormsPrompt= "'.M4J_LANG_ERROR_NO_FORMS.'"; '."\n".
					'function noformserror(){
						if(confirm(m4jNoFormsPrompt)){
							window.location.href = m4jNewFormsURL;	
						}
					}'.
					'</script>'.
					'<a style="cursor:pointer;" onclick = "javascript: noformserror(); return false;" class="m4j">';
				}
				echo'
				<div class="m4j_toRight">
					<table  height="64" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td height="64" align="center" valign="top">
									'.$jobsLink.'
										<img src="'.M4J_IMAGES.'new_job.png" alt="'.M4J_LANG_NEW_FORM.'" width="48" height="48" border="0" /><br />'.M4J_LANG_NEW_FORM.'</a>
							</td>
						  </tr>
						</table>
					</div>
						';
				
				//EOF echo
					
				break;
					
				//++++++++++++++++++++++++++++++ NEW/EDIT FORMS ++++++++++++++++++++++++++++++++++ //
			case M4J_JOBS_NEW:
				if(M4J_EDITFLAG !=1)
				{
					//BOF echo
					echo'
				<div class="m4j_toRight">	
				<table  height="64" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="64" align="center" valign="top">
								<a href="javascript:m4j_submit(\'apply_new\')" class="m4j">
						<img src="'.M4J_IMAGES.'apply.png" alt="'.M4J_LANG_ADD.'" class="button" />
						'.JText::_("Apply").'</a>
					</td>
				
					<td height="64" align="center" valign="top">
								<a href="javascript:m4j_submit(\'new\')" class="m4j">
						<img src="'.M4J_IMAGES.'add.png" alt="'.M4J_LANG_ADD.'" class="button" />
						'.M4J_LANG_ADD.'</a>
						</td>
					  </tr>
					</table>
					</div>
					';
					//EOF echo
				}
				else
				{
					//BOF echo
					echo'
			<div class="m4j_toRight">		
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
		       <tr>
				<td height="64" align="center" valign="top">
							<a href="javascript:m4j_submit(\'apply\')" class="m4j">
					<img src="'.M4J_IMAGES.'apply.png" alt="'.M4J_LANG_ADD.'" class="button" />
					'.JText::_("Apply").'</a>
				</td>
			  
				<td height="64" align="center" valign="top">
				<a href="javascript:m4j_submit(\'update\')" class="m4j">
					<img src="'.M4J_IMAGES.'proceed.png" alt="'.M4J_LANG_SAVE.'" width="48" height="48" border="0" /><br />'.M4J_LANG_SAVE.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
					//EOF echo
				}
				break;
					
				//++++++++++++++++++++++++++++++ DATA STORAGE ++++++++++++++++++++++++++++++++++ //
			case M4J_DATASTORAGE:

				//BOF echo
				global $id;
				$search = isset($_REQUEST['search']) ? '&search='. urlencode(JRequest::getString('search',null)) : '';
				$optinfilter = "&optinfilter=".JRequest::getInt("optinfilter",0);
				$ordering = "&ordering=".JRequest::getInt("ordering",0);
				
				echo'
				<div class="m4j_toRight" style="display:block;" >
				<table  width="100%" height="64" border="0" cellpadding="0" cellspacing="0">
				  <tr>
				  <td height="64" align="center" valign="top">
						<a onclick="javascript: mWindow.iFrame(\''.M4J_STORAGE_MAIL.$id.M4J_REMEMBER_CID_QUERY.'&tmpl=component\',{width:960,height:600}); return false;" class="m4j">
							<img src="'.M4J_IMAGES.'mail.png" alt="'.JText::_("Email").'" class="button" style="display:inline;"/>
							'.JText::_("Email").'</a> 
				  </td>
				  
				  
				  <td height="64" align="center" valign="top">
						<a onclick="javascript: mWindow.iFrame(\''.M4J_STORAGE_CONFIG.$id.M4J_REMEMBER_CID_QUERY.'&tmpl=component\',{width:800,height:600}); return false;" class="m4j">
							<img src="'.M4J_IMAGES.'database_config.png" alt="'.M4J_LANG_CONFIG.'" class="button" style="display:inline;" />
							'.M4J_LANG_CONFIG.'</a> 
				  </td>
				  <td width="10px">'.$helpers->spacer(10,48).'</td>
				  
				  <td height="64" align="center" valign="top">
						<a href="'.M4J_DATASTORAGE.'&task=truncate&id='.$id.$search.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.'" onclick="javascript: return m4jConfirm(\''.M4J_LANG_REALLY_TRUNCATE.'\');" class="m4j">
							<img src="'.M4J_IMAGES.'truncate.png" alt="'.M4J_LANG_TRUNCATE.'" class="button" />
							'.M4J_LANG_TRUNCATE.'</a> 
				</td>
				  <td width="10px">'.$helpers->spacer(10,48).'</td>
				  
					<td height="64" align="center" valign="top">
								<a onclick="javascript: m4jExportDropDown(); return false;" class="m4j">
						<img src="'.M4J_IMAGES.'database_export.png" alt="'.M4J_LANG_CSV_EXPORT.'"  class="button" />
						'.M4J_LANG_EXPORT.'</a>
						</td>
					  </tr>
					</table>
					</div>
				
					<div id="m4jExportWrap" style="position:absolute; display:block;width:240px; height:0px; background-color:#000000; right:0; margin-top:64px; z-index:100; overflow:hidden;border: 4px solid #3c9c29; border-top: 0px solid transparent;">
					<div style="position:absolute; display:block; float:left; left:0; bottom:0;width:100%;height:62px; text-align:center;">
					
					<table  height="64" border="0" cellpadding="0" cellspacing="0" width="100%">
				  		<tr>
				  		
				  		<td height="64" align="center" valign="top">
				  			<img src="'.M4J_IMAGES.'eject.png" alt="'.JText::_("Close").'" style="margin-left: 5px; margin-top:20px; cursor:pointer; " onclick="javascript: m4jExportClose();" />
				  		</td>
				  		<td height="64"  align="center" valign="top">
				  		
						<a class="m4j" style="background-image:none;" info="'.M4J_LANG_ONLYPRO_DESC.'">
							<img src="'.M4J_IMAGES.'xls.png" alt="Excel"  align="bottom" /><br>
							Excel
						</a>
						
						</td>				  		
				  		
				  		<td height="64"  align="center" valign="top">
				  		
						<a class="m4j" style="background-image:none;"  info="'.M4J_LANG_ONLYPRO_DESC.'">
							<img src="'.M4J_IMAGES.'csv.png" alt="'.M4J_LANG_COMMA.'"  align="bottom" /><br>
							'.M4J_LANG_COMMA.'
						</a>
						
						</td>
						<td height="64" align="center" valign="top">
						
						<a class="m4j" style="background-image:none;"  info="'.M4J_LANG_ONLYPRO_DESC.'">
							<img src="'.M4J_IMAGES.'csv.png" alt="'.M4J_LANG_SEMICOLON.'" align="bottom" /><br>
							'.M4J_LANG_SEMICOLON.'
						</a>
						
						</td>
				  		</tr>
				  	</table>
					</div>
					</div>					
					';
				//EOF echo

				break;

				//++++++++++++++++++++++++++++++ APPS ++++++++++++++++++++++++++++++++++ //
				
				case M4J_APPS:
					echo '<img src="'.M4J_IMAGES.'appsheading.png" alt="Apps" />';
				break;	
				
				
				//++++++++++++++++++++++++++++++ ADMIN APPS  right side ++++++++++++++++++++++++++++++++++ //
				
				case M4J_ADMINAPPS:
					$mToolBarRight =  $mToolBar->render("right");
					if($mToolBarRight){
						echo'<div class="m4j_toRight">'.$mToolBarRight.'</div>';
					}
					else echo '<img src="'.M4J_IMAGES.'appsheading.png" alt="Apps" />';
				break;	
				
				//++++++++++++++++++++++++++++++ TEMPLATES ++++++++++++++++++++++++++++++++++ //

			case M4J_FORMS:
				//BOF echo
				echo'
			<div class="m4j_toRight">	
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="64" align="center" valign="top">
				<a href="'.M4J_FORM_NEW.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'" class="m4j">
					<img src="'.M4J_IMAGES.'new.png" alt="'.M4J_LANG_NEW_TEMPLATE.'" width="48" height="48" border="0" />
					<br />'.M4J_LANG_NEW_TEMPLATE.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
				//EOF echo
					
					
					
				break;

				//++++++++++++++++++++++++++++++ NEW/EDIT TEMPLATE ++++++++++++++++++++++++++++++++++ //
			case M4J_FORM_NEW:

				if(M4J_EDITFLAG !=1)
				{
					//BOF echo
					echo'
			<div class="m4j_toRight">		
			<table  height="64" border="0" cellpadding="0" cellspacing="0" >
			  <tr>
				<td height="64" align="center" valign="top">
				<a onclick="javascript: submitOnNew();" class="m4j">
					<img src="'.M4J_IMAGES.'next.png" alt="'.M4J_LANG_PROCEED.'" class="button" />
					'.M4J_LANG_PROCEED.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
					//EOF echo
				}
				else
				{
					//BOF echo
					echo'
		<div class="m4j_toRight" style="display:block; width: 112px;">
		<table  height="64" border="0" cellpadding="0" cellspacing="0" >
		  <tr>
			<td height="64" align="center" valign="top">
						<a onclick="javascript: submitOnUpdate();" class="m4j">
							<img src="'.M4J_IMAGES.'proceed.png" alt="'.M4J_LANG_SAVE.'" class="button" />
							'.M4J_LANG_SAVE.'</a> 
				</td>
				<td height="64" align="center" valign="top" width="90px;">
					<a onclick="javascript: submitOnUpdateProceed();" class="m4j">
					<img src="'.M4J_IMAGES.'next.png" alt="'.M4J_LANG_UPDATE_PROCEED.'" class="button" align="center" />
					<nobr>'.M4J_LANG_UPDATE_PROCEED.'</nobr></a>
				</td>
				
				
				
			  </tr>
			</table>
			</div>
			';
					//EOF echo

				}

				break;
					
					
				//++++++++++++++++++++++++++++++ TEMPLATE ELEMENTS ++++++++++++++++++++++++++++++++++ //

			case M4J_FORM_ELEMENTS:
				//BOF echo
				echo'
			<div class="m4j_toRight">	
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="64" align="center" valign="top">
							<a href="" onclick="javascript: fadePreview(1);return false;" class="m4j" >
								<img src="'.M4J_IMAGES.'preview.png" alt="'.M4J_LANG_PREVIEW.'" class="button" />
								'.M4J_LANG_PREVIEW.'</a>
					</td>
				  </tr>
				</table>
				</div>
				';
				//EOF echo
				break;

				//++++++++++++++++++++++++++++++ NEW/EDIT ELEMENT ++++++++++++++++++++++++++++++++++ //
			case M4J_ELEMENT:
				if(M4J_EDITFLAG !=1)
				{
					//BOF echo
					echo'
			<div class="m4j_toRight">		
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="64" align="center" valign="top">
				<a onclick = "javascript:m4j_element_submit(\'new\');" class="m4j">
					<img src="'.M4J_IMAGES.'add.png" alt="'.M4J_LANG_ADD.'" class="button"  />
					'.M4J_LANG_ADD.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
					//EOF echo
				}
				else
				{
					//BOF echo
					echo'
			<div class="m4j_toRight">		
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="64" align="center" valign="top"><a onclick = "javascript:m4j_element_submit(\'update\');" class="m4j"><img src="'.M4J_IMAGES.'proceed.png" alt="'.M4J_LANG_SAVE.'" width="48" height="48" border="0" /><br />'.M4J_LANG_SAVE.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
					//EOF echo
				}
				break;
					
				//++++++++++++++++++++++++++++++ CATEGORY ++++++++++++++++++++++++++++++++++ //
			case M4J_CATEGORY:

				//BOF echo
				echo'
			<div class="m4j_toRight">	
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="64" align="center" valign="top">
				<a href="'.M4J_CATEGORY_NEW.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'" class="m4j">
					<img src="'.M4J_IMAGES.'new_category.png" alt="'.M4J_LANG_NEW_CATEGORY.'" width="48" height="48" border="0" />
					<br />'.M4J_LANG_NEW_CATEGORY.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
				//EOF echo
				break;
					
				//++++++++++++++++++++++++++++++ EDIT/NEW CATEGORY ++++++++++++++++++++++++++++++++++ //

			case M4J_CATEGORY_NEW:
				if(M4J_EDITFLAG !=1)
				{
					//BOF echo
					echo'
				<div class="m4j_toRight">	
				<table  height="64" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="64" align="center" valign="top">
								<a href="javascript:m4j_submit(\'apply_new\')" class="m4j">
						<img src="'.M4J_IMAGES.'apply.png" alt="'.M4J_LANG_ADD.'" class="button" />
						'.JText::_("Apply").'</a>
					</td>
					<td height="64" align="center" valign="top">
								<a href="javascript:m4j_submit(\'new\')" class="m4j">
						<img src="'.M4J_IMAGES.'add.png" alt="'.M4J_LANG_ADD.'"  class="button"  />
						'.M4J_LANG_ADD.'</a>
						</td>
					  </tr>
					</table>
				</div>
					';
					//EOF echo
				}
				else
				{
					//BOF echo
					echo'
			<div class="m4j_toRight">
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			  	<td height="64" align="center" valign="top">
								<a href="javascript:m4j_submit(\'apply\')" class="m4j">
						<img src="'.M4J_IMAGES.'apply.png" alt="'.M4J_LANG_ADD.'" class="button" />
						'.JText::_("Apply").'</a>
				</td>
			  
				<td height="64" align="center" valign="top">
				<a href="javascript:m4j_submit(\'update\')" class="m4j">
					<img src="'.M4J_IMAGES.'proceed.png" alt="'.M4J_LANG_SAVE.'" width="48" height="48" border="0" /><br />'.M4J_LANG_SAVE.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
					//EOF echo
				}
				break;
					
				//++++++++++++++++++++++++++++++ CONFIGURATION ++++++++++++++++++++++++++++++++++ //
			case M4J_CONFIG:
				//BOF echo
				echo'
			<div class="m4j_toRight">	
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>			  
				<td height="64" align="center" valign="top">
				<a href="javascript:m4j_submit(\'update\')" class="m4j">
					<img src="'.M4J_IMAGES.'proceed.png" alt="'.M4J_LANG_SAVE.'" width="48" height="48" border="0" /><br />'.M4J_LANG_SAVE.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
				//EOF echo
					
					
				break;
				
			//++++++++++++++++++++++++++++++ APPLIST ++++++++++++++++++++++++++++++++++ //
			case M4J_APPLIST:
					//BOF echo
				echo'
				<div class="m4j_toRight">	
				<table  height="64" border="0" cellpadding="0" cellspacing="0">
				  <tr>	
				  
				  	<td height="64" align="center" valign="top">
						<a href="" onclick ="javascript: return askUninstall(\''.M4J_LANG_REALLYUNINSTALL_APP.'\',\''.M4J_LANG_NOAPPSELECTED.'\');" class="m4j">
						<img src="'.M4J_IMAGES.'truncate.png" alt="'.JText::_("Uninstall").'" width="48" height="48" border="0" /><br />'.JText::_("Uninstall").'</a>
					</td>
				  	
					<td style="width: 10px;" ></td>
				  
				  
					<td height="64" align="center" valign="top">
					<a href="javascript: toggleInstallApp();" class="m4j">
						<img src="'.M4J_IMAGES.'un-install.png" alt="'.M4J_LANG_SAVE.'" width="48" height="48" border="0" /><br />'.JText::_("Install").'</a>
					</td>
				  </tr>
				</table>
				</div>
				';
				//EOF echo
				break;	
				
				
			//++++++++++++++++++++++++++++++ BACKUP ++++++++++++++++++++++++++++++++++ //
			case M4J_BACKUP:
				//BOF echo
				echo'';
				//EOF echo
				break;			
				
				//++++++++++++++++++++++++++++++ HELP ++++++++++++++++++++++++++++++++++ //
			case M4J_HELP:
				//BOF echo
				echo'
			<div class="m4j_toRight">	
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="64" align="center" valign="top">
				<a href="http://www.mad4media.de" target="_blank" class="m4j">
					<img src="'.M4J_IMAGES.'mad4media.png" alt="Mad4Media Home" width="64" height="64" border="0" /></a>
				</td>
			  </tr>
			</table>
			</div>
			';
				//EOF echo
				break;

			//++++++++++++++++++++++++++++++ SERVICE ++++++++++++++++++++++++++++++++++ //
			case M4J_SERVICE:
				//BOF echo
				echo'
			<div class="m4j_toRight">	
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="64" align="center" valign="top">
				<a href=""  onclick="javascript: fadeService(1); return false;" class="m4j">
					<img src="'.M4J_IMAGES.'connect.png" alt="'.M4J_LANG_CONNECT.'" width="48" height="48" border="0" /><br />'.M4J_LANG_CONNECT.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
				//EOF echo
				break;				
				
				//++++++++++++++++++++++++++++++ LINK ++++++++++++++++++++++++++++++++++ //
			case M4J_LINK:
		  //BOF echo
				if(defined('M4J_LINK_FORM_READY'))
				echo'
			<div class="m4j_toRight">	
			<table  height="64" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="64" align="center" valign="top">
				<a href="javascript:m4j_submit(\'new\')" class="m4j">
					<img src="'.M4J_IMAGES.'add.png" alt="'.M4J_LANG_ADD.'" width="48" height="48" border="0" />
					<br />'.M4J_LANG_ADD.'</a>
				</td>
			  </tr>
			</table>
			</div>
			';
				//EOF echo
		  break;
		}//EOF Switch

		
		$decor = _M4J_IS_J16 ? "m4j_blue_decor" : "m4j_green_decor"; 
		//BOF echo
		echo '
			</div>
			</td>
			  </tr>
			</table>
			</td>
			
			<td  width="18px" height="64px" class="topCorner" valign="top"><img src="'.M4J_IMAGES.'round_right.png" width="18px" height="64" /></td>
		</tr>
		<tr>
			<td  height="4px" colspan="3" valign="top" align="left" class="'.$decor.'"></td>
		</tr>
				
		<tr>
		    <td width="18px" height="400px" class="m4j_left_shadow"><img src="'.M4J_IMAGES.'spacer.png" width="18px" height="300px" border="0" /></td>
		    <td valign="top" style="background-color: #fff;  font-size: 12px;">
		  		<div class="m4j_content">
				  
	';//*EOF echo

	HTML_m4j::error($error);
	}

	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function footer($includePreview = true){
		global $helpers;
		
		$includePreview = $includePreview ? '<script type="text/javascript" src="'.M4J_JS_PREVIEW.'"></script>' : '' ;
		
		echo '	  </div>
	  </td>
      <td width="18" valign="top" class="m4j_right_shadow"><img src="'.M4J_IMAGES.'spacer.png" width="18px" height="300px" border="0" /></td>
    </tr>
    </tbody>
  </table>
</div>

  <p>'.$helpers->image("copyleft.png").' <a href="http://www.mad4media.de">mad4media </a> - Some icons by <a href="http://www.dryicons.com" target="_blank">dryicons.com</a></p>
  </center>
  
  <script type="text/javascript" src="'.M4J_JS.'proforms-footer.js"></script>
  <script type="text/javascript" src="'.M4J_JS_INFO.'"></script>
  '.$includePreview.'
  <script type="text/javascript" src="'.M4J_JS.'parsing.js"></script>
';

	if(function_exists("renderEndScripts")){
		renderEndScripts();
	}	
		
		
		
	// Output Debug	
	if(_M4J_DEBUG) MDebug::out();
	}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function new_form($name="",$desc="",$id=-1,$qwidth=300,$awidth=400,$use_help=1){

		$yes_query ="";
		$no_query = "";
		if ($use_help==1) $yes_query = 'selected="selected"'; else $no_query = 'selected="selected"';


		echo'
		<form id="m4jForm" name="m4jForm" method="post" action="'.M4J_FORM_NEW.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'">
        
		
		  '.M4J_LANG_TEMPLATE_NAME.'<br />
		    <input name="name" type="text" id="name" size="80" maxlength="80"  value="'.$name.'" />
            <br /><br/>
		  	'.M4J_LANG_TEMPLATE_DESCRIPTION.'<br />
		  <input name="description" size="80" value="'.$desc.'" id="description" style="width:100%;"></input>
		  <p>&nbsp;</p>
		  '.M4J_LANG_Q_WIDTH.'<br />
		    <input name="qwidth" type="text" id="qwidth" size="80" maxlength="80"  value="'.$qwidth.'" />
            <br /><br/>
		 	'.M4J_LANG_A_WIDTH.'<br />
		    <input name="awidth" type="text" id="awidth" size="80" maxlength="80"  value="'.$awidth.'" />
            <br /><br/>
			'.M4J_LANG_USE_HELP.'<br />
			<select name="use_help" id="use_help">
			<option value="1" '.$yes_query.' >'.M4J_LANG_YES.
			'</option><option value="0" '.$no_query.' >'.M4J_LANG_NO.
			'</option></select>
		
		  <p>
		    <input name="task" type="hidden" id="task" />
			<input name="editID" type="hidden" id="editID" value='.$id.' />
	        </p>
	    </form>
		';
	}//EOF new_form
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function new_category($name="",$alias=null,$email="",$id=-1,$active=1,$intro_value=null,$access = 0){

		echo'
			<form id="m4jForm" name="m4jForm" method="post" action="'.M4J_CATEGORY_NEW.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'">
        	<table cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr><td width="80%" valign="top" align="left" >		
		  '.M4J_LANG_CATEGORY_NAME.'<br />
		    <input name="name" type="text" id="name" size="80" maxlength="100" value="'.$name.'" style="width:95%;" />
            </td><td width="20%" valign="top" align="left" >
			'.JText::_("alias").'<br />
			<input name="alias" type="text" id="alias" value="'.$alias.'" size="80" maxlength="80" style="width:200px;" />
			</td><br/></tr><tr>
			<td align="left" valign="top"> <br/>
          '.M4J_LANG_EMAIL_ADRESS.'<br />
          <input name="email" type="text" id="email" size="80" maxlength="100"  value="'.$email.'" style="width:95%;" />
     	  </td> <td align="left" valign="top"> <br/>'.JText::_("Access") . '<br /> '.
		  MForm::access($access) .	
     	  '</td>
          </tr></tbody></table><br />
		  '.M4J_LANG_ACTIVE.'<br />
		  '.MForm::specialCheckbox("active",(int) $active);

			
		echo '
		    <input name="task" type="hidden" id="task" />
			<input name="editID" type="hidden" id="editID" value='.$id.' /><br><br><div class="m4jConfigInfo">
          '.M4J_LANG_CATEGORY_INTRO_LONG.'</div>
		  <div align="left">';
		MEditorArea('intro',$intro_value,'intro','100%','240','75','30');
		echo'</div><br /></form><br>';
	}//EOF new_category
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function form_elements_table_head(){
		echo '<table width="100%">
	   		 <tbody>
			 <tr>
			 <td valign="top">';
	}//EOF formelements table head
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function form_elements_menu($fid,$template_name){

		echo '</td>
		  <td width="190px" valign="top" id="m4jGetElButtons"><span class="m4j_add_item">'.M4J_LANG_ADD_NEW_ITEM.'</span>';
		echo'<a info="'.M4J_LANG_CHECKBOX_DESC.'" mleft="-5" href="'.M4J_ELEMENT.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&id='.$fid.'&form=1&template_name='.$template_name.'" class="m4j_element_button">
		 <span class="m4j_add_element_text"><b>'.M4J_LANG_CHECKBOX.'</b></span></a>';
		echo'<a info="'.M4J_LANG_DATE_DESC.'" mleft="-5" href="'.M4J_ELEMENT.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&id='.$fid.'&form=10&template_name='.$template_name.'" class="m4j_element_button">
		 <span class="m4j_add_element_text"><b>'.M4J_LANG_DATE.'</b></span></a>';
		echo'<a info="'.M4J_LANG_TEXTFIELD_DESC.'" mleft="-5" href="'.M4J_ELEMENT.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&id='.$fid.'&form=20&template_name='.$template_name.'" class="m4j_element_button">
		 <span class="m4j_add_element_text"><b>'.M4J_LANG_TEXTFIELD.'</b></span></a>';
		echo'<a info="'.M4J_LANG_OPTIONS_DESC.'" mleft="-5" href="'.M4J_ELEMENT.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&id='.$fid.'&form=30&template_name='.$template_name.'" class="m4j_element_button">
		 <span class="m4j_add_element_text"><b>'.M4J_LANG_OPTIONS.'</b></span></a>';
		echo'<a info="'.M4J_LANG_ATTACHMENT_DESC.'" mleft="-5" href="'.M4J_ELEMENT.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&id='.$fid.'&form=40&template_name='.$template_name.'" class="m4j_element_button">
		 <span class="m4j_add_element_text"><b>'.M4J_LANG_ATTACHMENT.'</b></span></a>';
		echo'<a info="'.M4J_LANG_HTML_DESC.'<br>'.M4J_LANG_ONLYPRO_DESC.'" mleft="-5" href="'.M4J_ELEMENT.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&id='.$fid.'&form=50&template_name='.$template_name.'" class="m4j_element_button">
		 <span class="m4j_add_element_text"><b>'.M4J_LANG_HTML.'<span style="color:red"> - PRO!</span></b></span></a>';
		echo '</td>
	       </tr>
		   <tbody>
		   </table>';
	}//EOF formelements menu
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	
	function element_html_form_head($html,$active,$layout="layout01",$slot=1){
		
		
		
		echo'
		<center><span style="font-size: 48px; color:red;">'.M4J_LANG_ONLYPRO.'</span></center>
		';
	}//EOF element html form head
	
	
	
	
	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
	function element_form_head($question='',$alias=null,$align = 0, $required=null,$active=1,$help=null,$layout="layout01",$slot=1){

		$width='500px';
		echo'
		<form id="m4jForm" name="m4jForm" method="post" action="'.M4J_ELEMENT.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'">
		  <table width="100%" border="0" cellpadding="0" cellspacing="0"> </tbody>
		   <tr> <td width="'.$width.'" valign="top">
		
			  <table width="'.$width.'" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
				  <td colspan="3">
				  '.M4J_LANG_YOUR_QUESTION.'<br />
				  <input class="m4j_textfield" style="width:95%;" name="question" type="text" id="question" size="80"  value="'.$question.'" /><br />
				  </td>
				  <td >
				  '.JText::_("Alias").'<br />
				  <input class="m4j_textfield" style="width:100%;" name="alias" type="text" id="alias" size="80"  value="'.$alias.'" /><br />
				  </td>
			  </tr>
			  <tr>
				<td width="25%" valign="top">
					'.M4J_LANG_ACTIVE.'<br />
					'.MForm::specialCheckbox("active",(int) $active).'		  
				</td>
				<td width="25%" valign="top">
					'.M4J_LANG_REQUIRED_LONG.'<br />
					'.MForm::specialCheckbox("required",(int) $required,"m4jToggleRequired",0).'
				</td>
				
				<td width="25%" align="left" valign="top">
					'.M4J_LANG_ALIGNMENT.'<br />
					'.MForm::specialCheckbox("align",(int) $align,"m4jToggleAlignment",1).'	
				</td>
				
				<td width="25%" align="left" valign="top" style="color:red;">
					<span info="'.M4J_LANG_ONLYPRO_DESC.'">
					'.M4J_LANG_LAYOUT_POSITION.' PRO! <br />
					'.MForm::slotSelect($layout,$slot).'	
					</span>
				</td>
				
				
				
			  </tr>
			  <tr>
			  	<td colspan="4"><span>
				   '.M4J_LANG_HELP_TEXT_SHORT." ".$GLOBALS['helpers']->info_button(M4J_LANG_HELP_TEXT).'</span>
				   	<textarea class="m4j_textarea" name="help" cols="80" rows="5" id="help">'.$help.'</textarea>
				</td>
			   </tr>
		</tbody></table>
		';
	} //EOF element_form_head
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function element_form_footer($id=null, $eid=null, $template_name=null,$right_column=null){
			
		echo '</td><td valign="top" align="center">';
		echo $right_column;
		echo '</td></tr></tbody></table>';
		echo '
		    <input name="task" type="hidden" id="task" />
			<input name="template_name" type="hidden" id="template_name" value="'.$template_name.'"/>
		    <input name="id" type="hidden" id="id" value="'.$id.'" />
			<input name="eid" type="hidden" id="eid" value="'.$eid.'" />
	    </form>
		';
	}//EOF element_form_footer
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function element_yes_no($form,$checked=1){?>

<table width="500" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3"><br />
		<?PHP echo M4J_LANG_TYPE_OF_CHECKBOX; ?><br />
		</td>
	</tr>
	<tr rowover="1"	>
		<td valign="top"><label> <input type="radio" name="form" value="1"
		<?php if($form==1) echo'checked ';?> /> <b><?PHP echo M4J_LANG_ITEM_CHECKBOX; ?></b></label></td>
		<td align="right"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		<td width="100px">
		<div align="right"><input name="demo" type="checkbox" id="demo"
			value="demo" checked="checked" /></div>
		</td>
	</tr>
	<tr rowover="1"	>
		<td valign="top"><label> <input type="radio" name="form" value="2"
		<?php if($form==2) echo'checked ';?> /> <b><?PHP echo M4J_LANG_YES_NO_MENU; ?></b></label></td>
		<td align="right"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		<td>
		<div align="right"><select name="demo" id="demo">
			<option selected="selected"><?PHP echo M4J_LANG_YES; ?></option>
			<option><?PHP echo M4J_LANG_NO; ?></option>
		</select></div>
		</td>
	</tr>

	<tr>
		<td colspan="3"><br />
		<?PHP echo M4J_LANG_INIT_VALUE; ?><br />
		</td>
	</tr>
	<tr rowover="1"	>
		<td valign="top" colspan="3"><label> <input type="radio"
			name="checked" value="1" <?php if($checked==1) echo'checked ';?> /> <b><?PHP echo M4J_LANG_YES_ON; ?></b></label></td>
	</tr>
	<tr rowover="1">
		<td valign="top" colspan="3"><label> <input type="radio"
			name="checked" value="0" <?php if($checked==0) echo'checked ';?> /> <b><?PHP echo M4J_LANG_NO_OFF; ?></b></label></td>
	</tr>


</table>
		<?PHP
}//EOF element_yes_no
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

function element_date($width=null){?>
	<input name="form" type="hidden" id="form" value="10" />
	<table width="500" border="0" cellpadding="0" cellspacing="1">
	<tr>
		<td colspan="3">
			<br>
			<b><?PHP echo M4J_LANG_OPTICAL_ALIGNMENT; ?></b>
		</td>
	</tr>

	<tr class="even" rowover="1">
		<td valign="top" align="left">
			<?PHP echo M4J_LANG_WIDTH.$GLOBALS['helpers']->info_button(M4J_LANG_ITEM_WIDTH_LONG); ?>
		<td>
				
		<td valign="top">
			<div align="right">
				<input class="m4j_demo_field" name="width" type="text" id="width" value="<?PHP echo $width;?>" ></input>
			</div>
		</td>
	</tr>	
	</table>
<?php }//EOF element_date
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

function element_text($form,$maxchars=60,$element_rows=3,$width='100%',$usermail=0,$eval=0, $hidden_value = null){?>

<table width="500" border="0" cellpadding="0" cellspacing="1">
	<tr>
		<td colspan="3"><br />
		<?PHP echo M4J_LANG_TYPE_OF_TEXTFIELD; ?><br />
		<br />
		</td>
	</tr>
	
	<tr class="even" rowover="1">
		<td valign="top" align="left">
			<label> 
				<input type="radio" name="form"	value="20" <?php if($form==20) echo'checked ';?> /> 
				<b><?PHP echo M4J_LANG_ITEM_TEXTFIELD; ?></b>
			</label>
			
			<span class="m4jRowsInputSpan"  style="color:red;" >
				<img src="<?php echo M4J_IMAGES;?>top2right.png" class="m4jInfoButton" style="float:left;"></img>
				<span style="float:left;"><?PHP echo M4J_LANG_USERMAIL."? "; echo $GLOBALS['helpers']->info_button(M4J_LANG_USERMAIL_DESC.'<br>'.M4J_LANG_ONLYPRO_DESC); ?>: </span>
				<span class="m4jUserMail" onclick="javascript: userMailCheck(this);"
					  id="" mleft="-10" info="<?php echo M4J_LANG_NO; ?>">
				
				</span> PRO! 
				<input type="hidden" name="uniquemail" id="usermailContainer" value="<?php echo $usermail; ?>"></input>
				<input type="hidden" name="usermail"  value="0"></input>
				
			</span>		
		</td>
		
		<td align="right" valign="top"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		
		<td width="100px" valign="top">
			<div align="right">
				<input class="m4j_demo_field" name="demo" type="text" size="18" value="" ></input>
			</div>
		</td>
	</tr>
	
	<tr class="even" rowover="1">
		<td valign="top" align="left">
			<label> 
				<input type="radio" name="form"	value="21" <?php if($form==21) echo'checked ';?> />
				<b><?PHP echo M4J_LANG_ITEM_TEXTAREA; ?></b>
			</label>
			<br/>
			<span class="m4jRowsInputSpan" >
				<img src="<?php echo M4J_IMAGES;?>top2right.png" class="m4jInfoButton"></img>
				<?php echo M4J_LANG_ROWS.$GLOBALS['helpers']->info_button(M4J_LANG_ROWS_TEXTAREA);?>: 
				<input style="width:32px;" name="element_rows" type="text" id="element_rows" value="<?PHP echo $element_rows;?>" ></input>
			</span>
		</td>
		
		<td align="right" valign="top"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		
		<td valign="top" align="right">
			<div align="right">
			<textarea class="m4j_demo_field" name="demo" cols="15" rows="3"></textarea>
			</div>
		</td>
		
	</tr>
	
	<tr class="even" rowover="1">
		<td valign="top" align="left">
			<label> 
				<input type="radio" name="form"	value="22" <?php if($form==22) echo'checked ';?> ></input> 
				<b><?PHP echo M4J_LANG_ITEM_PASSWORD; ?></b>
			</label>
		</td>
		
		<td align="right" valign="top"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		
		<td width="100px" valign="top">
			<div align="right">
				<input class="m4j_demo_field" name="demo" type="password" size="18" value="PROFORMS" />
			</div>
		</td>
		
	</tr>
	
	
	<tr class="even" rowover="1">
		<td valign="top" align="left" colspan="3">
			<label> 
				<input type="radio" name="form"	value="23" <?php if($form==23) echo'checked ';?> ></input> 
				<b><?PHP echo M4J_LANG_ITEM_HIDDEN; ?></b>
			</label>
			<br/>
			<span class="m4jRowsInputSpan" >
				<img src="<?php echo M4J_IMAGES;?>top2right.png" class="m4jInfoButton"></img>
				<?php echo M4J_LANG_VALUE; ?>: 
				<input style="width:410px;" name="hidden_value" type="text" id="hidden_value" value="<?PHP echo $hidden_value;?>" ></input>
			</span>
		</td>
		
		
		
	</tr>
	
	
	
	<tr><td colspan="3" height="5px"></td></tr>
	
	<tr class="even" rowover="1">
		<td valign="top" align="left" >
			<b><?PHP echo M4J_LANG_MAXCHARS_LONG; ?></b>
		</td>
		<td></td>
		<td valign="top">
			<div align="right">
				<input class="m4j_demo_field" name="maxchars" type="text" id="maxchars" value="<?PHP echo $maxchars;?>" ></input>
			</div>
		</td>
	</tr>
	
	<tr >
		<td colspan="3" style="height:5px;" ></td>
	</tr>
	
	
	<tr class="even" rowover="1">
		<td valign="top" align="left"  style="color:red;">
			<b><?PHP echo M4J_LANG_FIELD_VALIDATION; ?> PRO!</b>
		</td>
		<td></td>
		<td valign="top">
			<div align="right">
				<?php 
				$evaluation = array(
					array("text"=>M4J_LANG_NONE,"val"=>""),
					array("text"=>M4J_LANG_ALPHABETICAL,"val"=>"1"),
					array("text"=>M4J_LANG_ALPHANUMERIC,"val"=>"6"),
					array("text"=>M4J_LANG_NUMERIC,"val"=>"2"),
					array("text"=>M4J_LANG_INTEGER,"val"=>"3"),
					array("text"=>M4J_LANG_EMAIL,"val"=>"4"),
					array("text"=>"URL","val"=>"5")					
				);
				echo MForm::select("no",$evaluation,"",$size= MFORM_DROP_DOWN,null, 'style="width:100px; color: red;" info="'.M4J_LANG_ONLYPRO_DESC.'"');
				?>
			</div>
		</td>
	</tr>
	
	<tr>
		<td colspan="3">
			<br>
			<b><?PHP echo M4J_LANG_OPTICAL_ALIGNMENT; ?></b>
		</td>
	</tr>

	<tr class="even" rowover="1">
		<td valign="top" align="left">
			<?PHP echo M4J_LANG_WIDTH.$GLOBALS['helpers']->info_button(M4J_LANG_ITEM_WIDTH_LONG); ?>
		<td>
				
		<td valign="top">
			<div align="right">
				<input class="m4j_demo_field" name="width" type="text" id="width" value="<?PHP echo $width;?>" ></input>
			</div>
		</td>
	</tr>
	
	<tr height="12px">
		<td colspan="3"></td>
	</tr>
</table>
		<?PHP
}//EOF element_text
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

function element_options($form,$element_rows=3,$width='100%',$alignment=1){?>

<table width="500" border="0" cellpadding="0" cellspacing="1">
	<tr>
		<td colspan="3"><br />
		<?PHP echo M4J_LANG_TYPE_OF_OPTIONS; ?><br />
		</td>
	</tr>
	
	<tr>
		<td colspan="3"><br />
		<b><?PHP echo M4J_LANG_SINGLE_CHOICE_LONG; ?></b></td>
	</tr>
	
	<tr height="8px">
		<td colspan="3"></td>
	</tr>
	
	<tr rowover="1" >
		<td valign="top" align="left">
			<label> 
				<input type="radio" name="form"	value="30" <?php if($form==30) echo'checked ';?> ></input> 
				<?PHP echo M4J_LANG_DROP_DOWN; ?>
			</label>
		</td>
		
		<td align="right" valign="top"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		
		<td width="100px" valign="top">
		<div align="right">
			<select name="demo" class="m4j_demo_field">
				<option value="two">one</option>
				<option value="three">two</option>
				<option value="four">three</option>
			</select>
		</div>
		</td>
		
	</tr>
	
	<tr rowover="1">
		<td valign="top" align="left">
			<label> 
				<input type="radio" name="form"	value="31" <?php if($form==31) echo'checked ';?> ></input> 
				<?PHP echo M4J_LANG_RADIOBUTTONS; ?>
			</label>
		<br>
		<span class="m4jRowsInputSpan" >
			<img src="<?php echo M4J_IMAGES;?>top2right.png" class="m4jInfoButton"></img>
			<?PHP echo stripBold(getLeftOfBreak(M4J_LANG_ALIGNMENT_GROUPS)); ?>
			<select name="alignment" id="alignment" onchange="javascript: _('alignmentDummy').value = this.value;">
				<option value="0" <?PHP if($alignment==0) echo 'selected="selected"';?>><?PHP echo M4J_LANG_HORIZONTAL;?></option>
				<option value="1" <?PHP if($alignment==1) echo 'selected="selected"';?>><?PHP echo M4J_LANG_VERTICAL;?></option>
			</select>
		</span>			
		</td>
		
		<td align="right" valign="top"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		
		<td valign="top" align="right">
			<div align="right">
			<table class="m4j_demo_field">
				<tr>
					<td><label><input type="radio" name="demo" value="two" ></input>one</label></td>
				</tr>
				<tr>
				<td><label><input type="radio" name="demo" value="three" ></input>two</label></td>
				</tr>
				<tr>
				<td><label> <input type="radio" name="demo" value="four" ></input>three</label></td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
	
	<tr rowover="1">
		<td valign="top" align="left" style="height:50px;">
			<label>
			<input type="radio" name="form"	value="32" <?php if($form==32) echo'checked ';?> ></input> 
			<?PHP echo stripBreak(M4J_LANG_LIST_SINGLE); ?>
			</label>
		<br>
		<span class="m4jRowsInputSpan" >
			<img src="<?php echo M4J_IMAGES;?>top2right.png" class="m4jInfoButton"></img>
			<?PHP echo M4J_LANG_ROWS.$GLOBALS['helpers']->info_button(M4J_LANG_ROWS_LIST); ?>
			<input style="width:32px;" name="element_rows" id="elementRows" 
				   onkeyup="javascript: _('elementRowsDummy').value = this.value;"
				   type="text" id="element_rows" value="<?PHP echo $element_rows;?>" ></input>
		</span>	
		</td>
		
		<td align="right" valign="top"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		
		<td width="100px" valign="top">
			<div align="right">
				<select name="demo" size="3" class="m4j_demo_field">
					<option value="two">one</option>
					<option value="three">two</option>
					<option value="four">three</option>
				</select>
			</div>
		</td>
	</tr>

	<tr>
		<td colspan="3"><b><?PHP echo M4J_LANG_MULTIPLE_CHOICE_LONG; ?></b></td>
	</tr>
	
	<tr height="8px">
		<td colspan="3"> </td>
	</tr>
	
	<tr rowover="1">
		<td valign="top" align="left">
			<label> 
				<input type="radio" name="form"	value="33" <?php if($form==33) echo'checked ';?> ></input> 
				<?PHP echo M4J_LANG_CHECKBOX_GROUP; ?>
			</label>
		<br>
		<span class="m4jRowsInputSpan" >
			<img src="<?php echo M4J_IMAGES;?>top2right.png" class="m4jInfoButton"></img>
			<?PHP echo stripBold(getLeftOfBreak(M4J_LANG_ALIGNMENT_GROUPS)); ?>
			<select name="alignmentDummy" id="alignmentDummy" onchange="javascript: _('alignment').value = this.value;">
				<option value="0" <?PHP if($alignment==0) echo 'selected="selected"';?>><?PHP echo M4J_LANG_HORIZONTAL;?></option>
				<option value="1" <?PHP if($alignment==1) echo 'selected="selected"';?>><?PHP echo M4J_LANG_VERTICAL;?></option>
			</select>
		</span>	
		</td>
		
		<td align="right" valign="top"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		
		<td valign="top" align="right">
			<div align="right">
				<table class="m4j_demo_field">
					<tr>
						<td><label> <input type="checkbox" name="demo" value="two" ></input>one</label></td>
					</tr>
					<tr>
						<td><label> <input type="checkbox" name="demo" value="three" ></input>two</label></td>
					</tr>
					<tr>
						<td><label> <input type="checkbox" name="demo" value="four" ></input>three</label></td>
					</tr>
				</table>
			</div>
		</td>
		
	</tr>
	
	<tr rowover="1">
		<td valign="top" align="left" style="height:50px;">
			<label>
				<input type="radio" name="form"	value="34" <?php if($form==34) echo'checked ';?> ></input>
				<?PHP echo stripBreak(M4J_LANG_LIST_MULTIPLE); ?>
			</label>
		<br>
		<span class="m4jRowsInputSpan" >
			<img src="<?php echo M4J_IMAGES;?>top2right.png" class="m4jInfoButton"></img>
			<?PHP echo M4J_LANG_ROWS.$GLOBALS['helpers']->info_button(M4J_LANG_ROWS_LIST); ?>
			<input style="width:32px;" name="erDummy" id="elementRowsDummy" 
				   onkeyup="javascript: _('elementRows').value = this.value;"
				   type="text" id="element_rows" value="<?PHP echo $element_rows;?>" ></input>
		</span>	
		</td>
		
		<td align="right" valign="top"><?PHP echo M4J_LANG_EXAMPLE; ?>:</td>
		
		<td width="100px" valign="top">
			<div align="right">
				<select name="demo2[]" size="3"	class="m4j_demo_field" multiple="multiple">
					<option value="two">one</option>
					<option value="three">two</option>
					<option value="four">three</option>
				</select>
			</div>
		</td>
	</tr>
	
	<tr height="16px">
		<td colspan="3"></td>
	</tr>
	
	<tr>
		<td colspan="3"><b><?PHP echo M4J_LANG_OPTICAL_ALIGNMENT; ?></b></td>
	</tr>
	
	<tr rowover="1">
		<td valign="top" align="left">
			<?PHP echo M4J_LANG_WIDTH.$GLOBALS['helpers']->info_button(M4J_LANG_ITEM_WIDTH_LONG); ?>
		</td>
		
		<td> </td>
		
		<td valign="top">
			<div align="right">
				<input class="m4j_demo_field" name="width" type="text" id="width" value="<?PHP echo $width;?>" ></input>
			</div>
		</td>
	</tr>
	
	<tr height="12px">
		<td colspan="3"></td>
	</tr>
	
</table>
			<?PHP
}//EOF element_options
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

function element_options_right($count=0,$options)
{
	$o_array = explode(';',$options);
	$explodeSize = sizeof($o_array);
	$out='';
	if($count>0)
	$out='<br/><div class="m4jConfigInfo" style="text-align:left; margin-left: 40px;">'.M4J_LANG_OPTIONS_VALUES_INTRO.'</div><br/>';
	for($t=0;$t<$count;$t++)
	{
		$value = ($t<$explodeSize)?$o_array[$t]:"";
		$out.='<div class="m4j_option_field_wrapper"><input class="m4j_option_field" name="option'.'-'.$t.'" type="text" id="option'.'-'.$t.'" size="80" maxlength="80" value="'.$value.'" /></div>';
	}
	return $out;
}//EOF element_options_right
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

function element_attachment($endings='',$maxsize='',$measure=1024){?>

<input name="form" type="hidden"
	id="form" value="40" />
<table width="500" border="0" cellpadding="0" cellspacing="1">
	<tr>
		<td colspan="3"><br />
		<?PHP echo M4J_LANG_TYPE_OF_ATTACHMENT; ?><br />
		<br />
		</td>
	</tr>

	<tr rowover="1">
		<td valign="top" align="left"><b><?PHP echo M4J_LANG_ALLOWED_ENDINGS; ?></b>
		</td>
		<td valign="top">
		<div align="right"><textarea class="m4j_demo_field"
			style="width: 300px;" name="endings" id="endings" rows="8"><?PHP echo $endings; ?></textarea>
		</div>
		</td>
	</tr>

	<tr rowover="1">
		<td valign="top" align="left"><b><?PHP echo M4J_LANG_MAXSIZE; ?></b>
		</td>
		<td valign="top">
		<div align="right">
		<table cellpadding="0" cellspacing="0" border="0">
			<tbody>
				<tr>
					<td><input class="m4j_demo_field" style="width: 200px;"
						name="maxsize" type="text" id="maxsize"
						value="<?PHP echo $maxsize; ?>" /></td>
					<td>
					<?php 
					$measureArray = array(
										 array("val" => "1","text" => M4J_LANG_BYTE),
										 array("val" => "1024","text" => M4J_LANG_KILOBYTE),
										 array("val" => "1048576","text" => M4J_LANG_MEGABYTE)
										 );
					echo MForm::select("measure",$measureArray,$measure,MFORM_DROP_DOWN,null,'class="m4j_demo_field" style="width:100px;"');
					?>
					</td>
				</tr>
			</tbody>
		</table><br/>
		<span style="display:block; width: 100%; text-align: center;"><?php echo M4J_LANG_MAX_UPLOAD_ALLOWED.'' . ini_get('upload_max_filesize'); ?></span>
		</div>
		</td>
	</tr>

	<tr height="12px">
		<td colspan="3"></td>
	</tr>
</table>


						<?PHP
}//EOF element_attachment
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
function element_attachment_right()
{
	
	$famillyNames = array(
		M4J_LANG_IMAGES, M4J_LANG_DOCS, M4J_LANG_AUDIO, M4J_LANG_VIDEO, M4J_LANG_DATA, M4J_LANG_COMPRESSED, M4J_LANG_OTHERS
	);
	
	$famillyEndings = array(
		array(
			"GIF" => "gif",	"JPG" => "jpg,jpeg", "PNG" => "png", "TIFF" => "tif,tiff", "BMP" => "bmp,rle,dib",
			"RAW" => "raw",	"ICO" => "ico,icon", "Corel Draw" => "cdr",	"Photoshop" => "psd,pdd"
		),
		array(
			"MS WORD" => "doc,docx,docm,dotx,dotm",	"PDF" => "pdf",	"RICH TEXT FORMAT" => "rtf", "POSTSCRIPT" => "ps",
			"LOTUS WORD PRO" => "lwp", "TEXT" => "txt,text", "MS WORKS" => "wps", "HTML" => "htm,html",	"OPEN DOCUMENT" => "odt,ods,odp",
			"POWERPOINT" => "pps,ppt,pptx,pptm,potx,potm,ppam,ppsx,ppsm"
		)
	
	
	);
	$out ='<div class="m4j_option_field_wrapper" align="left" style="padding-left:20px;">'.M4J_LANG_ELEMENT_ATTACHMENT_DESC.'
		

		<h4>'.M4J_LANG_IMAGES.' <a href="javascript: append(\'endings\',\'gif,jpg,jpeg,png,tif,tiff,bmp,rle,dib,raw,ico,icon,cdr,psd,pdd\');"> [ '.M4J_LANG_ALL.' ] </a></h4>
		        <a href="javascript: append(\'endings\',\'gif\');"> [ GIF ] </a> 
		        <a href="javascript: append(\'endings\',\'jpg,jpeg\');"> [ JPG ] </a> 
			    <a href="javascript: append(\'endings\',\'png\');"> [ PNG ] </a> 		
		        <a href="javascript: append(\'endings\',\'tif,tiff\');"> [ TIFF ] </a> 
				<a href="javascript: append(\'endings\',\'bmp,rle,dib\');"> [ BMP ] </a>
				<a href="javascript: append(\'endings\',\'raw\');"> [ RAW ] </a>  
		        <a href="javascript: append(\'endings\',\'ico,icon\');"> [ ICO ] </a> 
			    <a href="javascript: append(\'endings\',\'cdr\');"> [ Corel Draw ] </a> 		
		        <a href="javascript: append(\'endings\',\'psd,pdd\');"> [ Photoshop ] </a>		
		
		<br/>
		
		<h4>'.M4J_LANG_DOCS.' <a href="javascript: append(\'endings\',\'doc,docx,docm,dotx,dotm,pdf,rtf,ps,lwp,txt,text,wps,htm,html,odt,ods,odp,pps,ppt,pptx,pptm,potx,potm,ppam,ppsx,ppsm\');"> [ '.M4J_LANG_ALL.' ] </a></h4>
		        <a href="javascript: append(\'endings\',\'doc,docx,docm,dotx,dotm\');"> [ MS WORD ] </a> 
		        <a href="javascript: append(\'endings\',\'pdf\');"> [ PDF ] </a> 
			    <a href="javascript: append(\'endings\',\'rtf\');"> [ RICH TEXT FORMAT ] </a> 		
		        <a href="javascript: append(\'endings\',\'ps\');"> [ POSTSCRIPT ] </a> 
				<a href="javascript: append(\'endings\',\'lwp\');"> [ LOTUS WORD PRO ] </a><br/>
				<a href="javascript: append(\'endings\',\'txt,text\');"> [ TEXT ] </a>  
		        <a href="javascript: append(\'endings\',\'wps\');"> [ MS WORKS ] </a> 
			    <a href="javascript: append(\'endings\',\'htm,html\');"> [ HTML ] </a> 		
		        <a href="javascript: append(\'endings\',\'odt,ods,odp\');"> [ OPEN DOCUMENT ] </a>	
				<a href="javascript: append(\'endings\',\'pps,ppt,pptx,pptm,potx,potm,ppam,ppsx,ppsm\');"> [ POWERPOINT ] </a> 	

		<br/>
		
		<h4>'.M4J_LANG_AUDIO.' <a href="javascript: append(\'endings\',\'mp3,ra,ram,wav,wave,wma,au,mpa,m3u,aif,iff,mid,midi\');"> [ '.M4J_LANG_ALL.' ] </a></h4>
				<a href="javascript: append(\'endings\',\'mp3\');"> [ MP3 ] </a>
		        <a href="javascript: append(\'endings\',\'ra,ram\');"> [ REAL AUDIO ] </a> 
			    <a href="javascript: append(\'endings\',\'wav,wave\');"> [ WAV ] </a> 		
		        <a href="javascript: append(\'endings\',\'wma\');"> [ WMA ] </a>	
				<a href="javascript: append(\'endings\',\'au\');"> [ AU ] </a> 
				<a href="javascript: append(\'endings\',\'mpa\');"> [ MPA ] </a>  
			    <a href="javascript: append(\'endings\',\'m3u\');"> [ M3U ] </a> 	
		        <a href="javascript: append(\'endings\',\'aif\');"> [ AIF ] </a> 
		        <a href="javascript: append(\'endings\',\'iff\');"> [ IFF ] </a> 
		        <a href="javascript: append(\'endings\',\'mid,midi\');"> [ MIDI ] </a> 
		<br/>
		
		<h4>'.M4J_LANG_VIDEO.' <a href="javascript: append(\'endings\',\'avi,mov,movi,moov,qt,mp4,mpg,mpeg,rm,swf,\nwm,wmv,dvx,divx,flv,xvid\');"> [ '.M4J_LANG_ALL.' ] </a></h4>
				<a href="javascript: append(\'endings\',\'avi\');"> [ AVI ] </a>
		        <a href="javascript: append(\'endings\',\'mov,movi,moov,qt\');"> [ QUICKTIME ] </a> 
			    <a href="javascript: append(\'endings\',\'mp4\');"> [ MP4 ] </a> 		
		        <a href="javascript: append(\'endings\',\'mpg,mpeg\');"> [ MPG ] </a>	
				<a href="javascript: append(\'endings\',\'rm\');"> [ REAL MEDIA ] </a> 
				<a href="javascript: append(\'endings\',\'swf\');"> [ SHOCKWAVE ] </a>  <br/>
			    <a href="javascript: append(\'endings\',\'wm,wmv\');"> [ WINDOWS MEDIA ] </a> 	
		        <a href="javascript: append(\'endings\',\'dvx,divx\');"> [ DIVX ] </a> 
		        <a href="javascript: append(\'endings\',\'flv\');"> [ FLASH VIDEO ] </a> 
		        <a href="javascript: append(\'endings\',\'xvid\');"> [ XVID ] </a> 
		<br/>
		
		<h4>'.M4J_LANG_DATA.' <a href="javascript: append(\'endings\',\'xls,xlsx,xlsm,xltx,xltm,xlsb,xlam,csv,dat,db,sql,mdb,xml,123\');"> [ '.M4J_LANG_ALL.' ] </a></h4>
				<a href="javascript: append(\'endings\',\'xls,xlsx,xlsm,xltx,xltm,xlsb,xlam\');"> [ EXCEL ] </a>
		        <a href="javascript: append(\'endings\',\'csv\');"> [ CSV ] </a> 
			    <a href="javascript: append(\'endings\',\'dat\');"> [ DAT ] </a> 		
		        <a href="javascript: append(\'endings\',\'db\');"> [ DB ] </a>	
				<a href="javascript: append(\'endings\',\'sql\');"> [ SQL ] </a> 
				<a href="javascript: append(\'endings\',\'mdb,accdb,accde,accdt,accdr\');"> [ MS ACCESS ] </a>  <br/>
			    <a href="javascript: append(\'endings\',\'xml\');"> [ XML ] </a> 	
		        <a href="javascript: append(\'endings\',\'123\');"> [ LOTUS SPREADSHEET ] </a> 
		<br/>
		
		<h4>'.M4J_LANG_COMPRESSED.' <a href="javascript: append(\'endings\',\'zip,rar,gz,gzip,deb,pkg,sea,sit,sitx,arg,lha\');"> [ '.M4J_LANG_ALL.' ] </a></h4>
				<a href="javascript: append(\'endings\',\'zip\');"> [ ZIP ] </a>
		        <a href="javascript: append(\'endings\',\'rar\');"> [ RAR ] </a> 
			    <a href="javascript: append(\'endings\',\'gz,gzip\');"> [ GZ ] </a> 		
		        <a href="javascript: append(\'endings\',\'deb\');"> [ DEB ] </a>	
				<a href="javascript: append(\'endings\',\'pkg\');"> [ PKG ] </a> 
				<a href="javascript: append(\'endings\',\'sea\');"> [ SEA ] </a>  
			    <a href="javascript: append(\'endings\',\'sit,sitx\');"> [ SIT ] </a> 
				<a href="javascript: append(\'endings\',\'arj\');"> [ ARJ ] </a>  
			    <a href="javascript: append(\'endings\',\'lha\');"> [ LHA ] </a> 

		<h4>'.M4J_LANG_OTHERS.' <a href="javascript: append(\'endings\',\'exe,ttf,otf,fon,fnt,fla,php,php4,php5,\nj,jav,java,class,eml,cfg,bin,iso,vcd\');"> [ '.M4J_LANG_ALL.' ] </a></h4>
				<a href="javascript: append(\'endings\',\'exe\');"> [ EXE ] </a>
		        <a href="javascript: append(\'endings\',\'ttf,otf,fon,fnt\');"> [ FONTS ] </a> 
			    <a href="javascript: append(\'endings\',\'fla\');"> [ FLASH ] </a> 		
		        <a href="javascript: append(\'endings\',\'php,php4,php5\');"> [ PHP ] </a>	
				<a href="javascript: append(\'endings\',\'j,jav,java,class\');"> [ JAVA ] </a> 
				<a href="javascript: append(\'endings\',\'eml\');"> [ EMAIL ] </a>  <br/>
			    <a href="javascript: append(\'endings\',\'cfg\');"> [ CFG ] </a> 	
		        <a href="javascript: append(\'endings\',\'bin\');"> [ BIN ] </a> 
		        <a href="javascript: append(\'endings\',\'iso\');"> [ ISO ] </a> 
		        <a href="javascript: append(\'endings\',\'vcd\');"> [ VCD ] </a>	
	
			 </div>';
	return $out;
}//EOF element_attachment_right
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //


function link_menu($rows,$jid,$name=null,$cid=null)
{
	global $helpers;
	if($cid){
		$cid = '&cid='.(int) $cid;
	}
	
	foreach ($rows as $row){
		$menutype = $row->menutype;
		echo $helpers->link(M4J_LINK.M4J_HIDE_BAR.M4J_MENUTYPE.$menutype.'&id='.$jid.$cid.'&name='.urlencode($name).'&title='.urlencode($row->title),$row->title,'m4j_menu').'<br/>';
	}

}//EOF element_options_right
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

function link_form($jid,$parent,$access,$published, $menutype,$name=null,$title=null,$cid=null)
{ 
	$cid = ($cid) ? '&cid='.$cid : '';
?>
<form id="m4jForm" name="m4jForm" method="post"
	action="<?PHP 
		
		$link = M4J_LINK.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&menutype='.$menutype.'&title='.$title.'&id='.$jid.$cid; 
		if($name) $link .='&name='.$name;
		echo $link;
		?>">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="50%" align="left" valign="top"><?PHP echo M4J_LANG_LINK_NAME; ?><br />
		<input name="link_name" type="text" id="link_name" size="80"
			maxlength="100" /> <br />
		<br />
		<?php echo JText::_("alias");?><br />
		<input name="alias" type="text" id="alias" size="80"
			maxlength="100" /> <br />
		<br />
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="50%" align="left" valign="top"><?PHP echo M4J_LANG_ACCESS_LEVEL; ?><br />

				<?PHP echo str_replace('name="access"','name="access" style="width:90%" ',$access); ?>
				<br />
				</td>
				<td width="50%" align="left" valign="top"><?PHP echo M4J_LANG_PUBLISHED; ?><br />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="60"><?PHP echo $published;?></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>

		<td width="50%" align="left" valign="top"><?PHP echo M4J_LANG_PARENT_LINK; ?><br />
		<?PHP echo  str_replace('name="parent"','name="parent" style="width:100%" ',$parent); ?>
		</td>
	</tr>
</table>
<input name="task" type="hidden" id="task" /></form>
		<?PHP }//EOF link_form

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //		

function dataStorageSearch($jid= null,$options = null,$count=0, $limit=5, $limitstart=0){

	global $id;
	$search = M4J_IS_SEARCH ? '&search='. urlencode(M4J_IS_SEARCH) : '';
	if(M4J_SHOW_ALIAS === 0){
	?>
<a href="<?php echo M4J_DATASTORAGE.'&alias=1&id='.$id.$search.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR ;?>" 
   class="m4jQuestionAliasSwitch" >
   <span info="<?php echo M4J_LANG_USE_ALIAS_DESC; ?>"><?php echo M4J_LANG_USE_ALIAS;?></span></a>
<?php 
	}else{
		
?>
<a href="<?php echo M4J_DATASTORAGE.'&alias=0&id='.$id.$search.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR ;?>" 
   class="m4jQuestionAliasSwitch">
   <span info="<?php echo M4J_LANG_USE_QUESTIONS_DESC; ?>"><?php echo M4J_LANG_USE_QUESTIONS;?></span></a>

<?php }?>
<form name="m4jForm" id="m4jForm" action="<?php echo M4J_DATASTORAGE.M4J_HIDE_BAR."&id=".$jid.M4J_REMEMBER_CID_QUERY; ?>" method="post">
<table width="100%" cellpadding="0" cellspacing="0"><tr>
<td align="left" valign="top"  style="width: 600px;">
	<input id="searchBox" type="text" style="width:98%; height:16px;margin-bottom:10px;" name="search" value="<?php echo M4J_IS_SEARCH; ?>"></input>
</td>
<td align="right" valign="top" style="width: 24px;">
	<input style="border:none;" type="image" src="components/com_proforms/images/search.png" alt="<?php echo M4J_LANG_SEARCH;?>" title="<?php echo M4J_LANG_SEARCH;?>" align="top"></input>
</td>

<td  align="right"  valign="top"><?php echo M4J_LANG_SEARCH_IN; ?>: &nbsp;</td>
<td align="left" valign="top"  style="width: 160px;">
<?php 
echo MForm::select("col",$options,JRequest::getInt("col",0),MFORM_DROP_DOWN,null,'style="width: 150px;" id="searchIn" ');?>
</td>
</tr></table>

<div class="dsFilterWrap">
<span class="dsFilterItem">
<?php 
	echo M4J_LANG_OPTIN_FILTER .": ";
	$arr = array(
		array("val" => "0","text" => JText::_("All")),
		array("val" => "1","text" => M4J_LANG_CONFIRMED),
		array("val" => "2","text" => M4J_LANG_NOT_CONFIRMED)
	);
	echo MForm::select(
		"optinfilter",
		$arr,
		JRequest::getInt("optinfilter",0),
		MFORM_DROP_DOWN,
		null,
		' onchange = "_(\'cng\').value= 1;document.m4jForm.submit();" id="optInFilter"'
	);
?>
</span>
<input type="hidden" name="changed" value="" id="cng"></input>

<span class="dsFilterItem">
<span>&nbsp;&nbsp;&nbsp; <?php echo M4J_LANG_ORDERING; ?>: </span>
<?php
$ordering = array(
				array("val" => "0","text" => M4J_LANG_DESC),
				array("val" => "1","text" => M4J_LANG_ASC)
				);
				
echo MForm::select("ordering",$ordering,JRequest::getInt("ordering",0),MFORM_DROP_DOWN,null,'style="width: 170px; font-weight:bold;" onchange = "document.m4jForm.submit();"');?>

</span>
</div>


<table class="adminlist">
<tr>
<th class="title" style="display:table; width:100%; background-color: #f3f3f3; height:24px; padding-top:2px; text-align:center; ">

<?php 
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $count, $limitstart, $limit);
		echo str_replace("adminForm","m4jForm",str_replace("submitform()","document.m4jForm.submit()",$pageNav->getListFooter(  )) );
	
?>
</th></tr>
</table>

</form>
<?php 
}





function legend($mask=null){
			global $helpers;

			switch($mask)
			{
				case 'jobs':
					echo'<br/>'.M4J_LANG_LEGEND.'<br/>';
					echo '<table class="list" width="100%" border="0" cellspacing="0" cellpadding="0"><tbody>';
					echo '<tr valign="top"><td height="16px" valign="top" width="16px" >'.$helpers->image('active.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_FORM.M4J_LANG_IS_VISIBLE.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('not_active.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_FORM.M4J_LANG_IS_HIDDEN.'</td>';
					echo '<td  height="16px" valign="top" width="40px" >'.$helpers->image('up.png').
					 ' '.$helpers->image('down.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_ASSIGN_ORDER.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('copy.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_DO_COPY.'</td></tr><tr>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('remove.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_DELETE.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('pen-small.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_EDIT.'</td>';
					
					
					echo '<td height="16px" valign="top" align="right" width="16px" >'.$helpers->image('database.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_READ_STORAGES.'</td>';
					
					if(! _M4J_IS_J16){
						echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('link.png').
						 '</td><td height="16px" valign="top" >'.M4J_LANG_FORM.' '.M4J_LANG_LINK_TO_MENU.'</td>';
					
						echo '</tr><tr>';
						echo '<td height="16px" valign="top" width="16px" >'.$helpers->image('link2cat.png').
						 '</td><td colspan="4" height="16px" valign="top" >'.M4J_LANG_CATEGORY.' '.M4J_LANG_LINK_TO_MENU.'</td>';
					}else{
						echo '<td  height="16px" valign="top" width="16px" ></td>
							  <td height="16px" valign="top" ></td>';
					}
					
					
					
					echo '</tr></tbody></table>';
					break;

				case 'cat':
					echo'<br/>'.M4J_LANG_LEGEND.'<br/>';
					echo '<table class="list" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;"><tbody>';
					echo '<tr valign="top"><td height="16px" valign="top" width="16px" >'.$helpers->image('active.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_CATEGORY.M4J_LANG_IS_VISIBLE.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('not_active.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_CATEGORY.M4J_LANG_IS_HIDDEN.'</td>';
					echo '<td  height="16px" valign="top" width="40px" >'.$helpers->image('up.png').
					 ' '.$helpers->image('down.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_ASSIGN_ORDER.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('remove.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_DELETE.'</td>';
					echo '</tr><tr><td  height="16px" valign="top" width="16px" >'.$helpers->image('pen-small.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_EDIT.'</td>';
					
					if(! _M4J_IS_J16){
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('link2cat.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_CATEGORY.' '.M4J_LANG_LINK_TO_MENU.'</td>';
					}else{
						echo '<td  height="16px" valign="top" width="16px" ></td>
							  <td height="16px" valign="top" ></td>';	
					}
					
					echo '</tr></tbody></table>';
					break;

				case 'forms':
					echo'<br/>'.M4J_LANG_LEGEND.'<br/>';
					echo '<table class="list" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;"><tbody>';

					echo '<tr><td  height="16px" valign="top" width="16px" >'.$helpers->image('copy.png').
					 '</td><td height="16px" valign="top" width="100px"  >'.M4J_LANG_DO_COPY.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('remove.png').
					 '</td><td height="16px" valign="top" width="70px" >'.M4J_LANG_DELETE.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('pen-small.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_EDIT_MAIN_DATA.'</td></tr>';
					echo '</tbody></table>';
					break;
				case 'formelements':
					echo'<br/>'.M4J_LANG_LEGEND.'<br/>';
					echo '<table class="list" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;"><tbody>';
					echo '<tr valign="top"><td height="16px" valign="top" width="16px" >'.$helpers->image('active.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_ITEM.M4J_LANG_IS_VISIBLE.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('not_active.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_ITEM.M4J_LANG_IS_HIDDEN.'</td>';
					echo '<td height="16px" valign="top" width="16px" >'.$helpers->image('required.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_IS_REQUIRED.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('not_required.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_IS_NOT_REQUIRED.'</td></tr>';
					echo '<tr><td  height="16px" valign="top" width="40px" >'.$helpers->image('up.png').
					 ' '.$helpers->image('down.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_ASSIGN_ORDER.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('copy.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_DO_COPY.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('remove.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_DELETE.'</td>';
					echo '<td  height="16px" valign="top" width="16px" >'.$helpers->image('pen-small.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_EDIT.'</td></tr>';
					
					echo '<tr valign="top"><td height="16px" valign="top" width="16px" >'.$helpers->image('is_usermail.png').
					 '</td><td height="16px" valign="top" >'.M4J_LANG_USERMAIL.'</td>';
					echo '</tr>';
					echo '</tbody></table>';
					break;

			}

		}//EOF legend
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
		function config_list_wrap($area,$name,$value,$desc,$even,$width='250px')
		{?>
		<tr class="<?PHP echo (($even)?'even':'odd') ?>">
			<td width="<?PHP echo $width; ?>"><?PHP echo $area; ?></td>
			<td width="28%"><input name="<?PHP echo $name; ?>" type="text"
				id="<?PHP echo $name; ?>" style="width: 200px"
				value="<?PHP echo $value; ?>" maxlength="50"></td>
			<td><?PHP echo $desc; ?></td>
		</tr>
		<?PHP }//EOF config_list_wrap
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

		
		function slotTabs($layout="layout01",$activeSlot=1){
			echo MForm::layoutPos($layout,$activeSlot);
		}//EOF slotTabs	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //		
}//EOF HTML_m4j Class

$GLOBALS['m4jDebug'] = "";
class MDebug{
	function _($string){
		$GLOBALS['m4jDebug'] .= $string."<br>";
	}
	
	function pre($obj){
		$GLOBALS['m4jDebug'] .= '<pre>';
		ob_start();
			print_r($obj);
	    $GLOBALS['m4jDebug'] .= htmlspecialchars( ob_get_clean() );		
	    $GLOBALS['m4jDebug'] .= '</pre><br>';
	}
	
	function out(){
		echo '<center><div style="display:block;width:90%; text-align:left; padding:10px; color:black; border:1px solid #343434; background-color: #efefef; margin:10px;">'."\n";
		echo '<h3>Debug:</h3>'."\n";
		echo $GLOBALS['m4jDebug'];
		echo '</div></center>'."\n";

	}
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++

class MReady{
	
	function _($string){
		return str_replace('"',"&quot;",stripslashes($string) );
	}
	
	function change(& $string){
		$string = str_replace('"',"&quot;",stripslashes($string) );
	}
}

function m4jShowAdvice($loc){
	if($GLOBALS['m4jAdviceLocation'] == $loc){
		return '<img src="'.M4J_IMAGES.'advice.png" class="m4jShowAdvice" />' ;
	}else return '';
}






?>