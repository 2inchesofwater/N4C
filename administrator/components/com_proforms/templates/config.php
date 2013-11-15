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

global $m4jConfig_live_site, $helpers;
?>
<script type="text/javascript">

	
	dojo.addOnLoad(function(){
		
		setTimeout(function(){
			var advice = dojo.query(".m4j_success")[0];
			if(advice !== undefined){
				dojo.style(advice, "opacity", "1");
				dojo.fadeOut({node:advice}).play();
			}
		},4000);
		
		var tab = <?php echo $tab; ?>;
		var tabElement = dojo.query( ".tabNo"+tab)[0];
		if(tabElement){
			switch(tab){
			case 0: 
				cTab.set('m4jMainConfig','configTab',tabElement,0);
				break;
			case 1: 
				cTab.set('m4jDisplay','configTab',tabElement,1);
				break;
			case 2: 
				cTab.set('m4jSecurity','configTab',tabElement,2);
				break;
			case 3: 
				cTab.set('m4jCSSConfig','configTab',tabElement,3);
				break;
			case 4: 
				cTab.set('m4jEditCSS','configTab',tabElement,4);
				break;
				
			case 5: 
				cTab.set('m4jPatch','configTab',tabElement,5);
				break;
			}
		}
	});
	
</script>

<form id="m4jForm" name="m4jForm" method="post"
	action="<?PHP echo M4J_CONFIG; ?>" enctype="multipart/form-data">

<input type="hidden" name="tab" value="<?php echo $tab; ?>" id="tabField" ></input>

<div class="m4j_tabs_back">
	<div style="display:block;height:35px;  padding-left:10px; padding-right: 10px;">
			<?php $helpers->caption($heading,$feedback);?>	
	</div>

	<div class="m4jTabLabelWrap">
	<div class="tabNo0 ieJobTabWidth m4jActiveTab" id="configTab" onclick="cTab.set('m4jMainConfig','configTab',this,0); return false;" ><?PHP echo M4J_LANG_MAIN_CONFIG;?><span></span></div>
	<div class="tabNo1 ieJobTabWidth" onclick="cTab.set('m4jDisplay','configTab',this,1); return false;" ><?PHP echo M4J_LANG_DISPLAY;?><span></span></div>
	<div class="tabNo2" onclick="cTab.set('m4jSecurity','configTab',this,2); return false;" ><?PHP echo M4J_LANG_SECURITY;?><span></span></div>
	<div class="tabNo3 ieJobTabWidth" onclick="cTab.set('m4jCSSConfig','configTab',this,3); return false;" ><?PHP echo M4J_LANG_CSS_CONFIG;?><span></span></div>
	<div class="tabNo4 ieJobTabWidth" onclick="cTab.set('m4jEditCSS','configTab',this,4); return false;" ><?PHP echo M4J_LANG_CSS_EDIT;?><span></span></div>
	<div class="tabNo5 ieJobTabWidth" onclick="cTab.set('m4jPatch','configTab',this,5); return false;" ><?PHP echo "Patch";?><span></span></div>
		
	</div>
</div>

	<div class="m4jTabWrap" id="configTabWrap">
		<div class="m4jTabContent" id ="m4jMainConfig" >

		<div class="m4jConfigInfo"><?PHP echo M4J_LANG_MAIN_CONFIG_DESC;?></div>
		<table width="100%" cellspacing="1" cellpadding="0" border="0"
			align="center" class="list">
			<tbody>
				<tr>
					<th width="16%"><?PHP echo M4J_LANG_ADJUSTMENT;?></th>
					<th><?PHP echo M4J_LANG_VALUE;?></th>
					<th width="56%"><?PHP echo M4J_LANG_DESCRIPTION;?></th>
				</tr>
		<?PHP
		$value = array(M4J_EMAIL_ROOT,M4J_FROM_NAME,M4J_FROM_EMAIL,M4J_MAIL_ISO);

		$name = array( 'email_root','from_name','from_email','mail_iso' );

		$area = array(M4J_LANG_EMAIL_ROOT,M4J_LANG_FROM_NAME,M4J_LANG_FROM_EMAIL,M4J_LANG_MAIL_ISO);

		$desc = array(M4J_LANG_EMAIL_ROOT_DESC,M4J_LANG_FROM_NAME_DESC,M4J_LANG_FROM_EMAIL_DESC,M4J_LANG_MAIL_ISO_DESC);

		$even = true;
		for($t=0;$t<sizeof($value);$t++)
		{
			HTML_m4j::config_list_wrap($area[$t],$name[$t],$value[$t],'<span>'. $desc[$t]. '</span>',$even);
			$even = !$even;
		}

		?>

		<tr class="even">
			<td width="250"><?PHP echo M4J_LANG_HTML_MAIL; ?></td>
			<td width="28%"><?php echo MForm::specialCheckbox("html_mail",(int) M4J_HTML_MAIL);?></td>
			<td><span><?PHP echo M4J_LANG_HTML_MAIL_DESC; ?></span></td>
		</tr>
		
		<tr class="odd">
			<td width="250"><?PHP echo M4J_LANG_SHOW_USER_INFO; ?></td>
			<td width="28%"><?php echo MForm::specialCheckbox("show_user_info",(int) M4J_SHOW_USER_INFO);?></td>
			<td><span><?PHP echo M4J_LANG_SHOW_USER_INFO_DESC; ?></span></td>
		</tr>
		<tr class="even">
			<td width="250" style="color:red;" info="<?php echo M4J_LANG_ONLYPRO_DESC; ?>"><?PHP echo M4J_LANG_USE_JS_VALIDATION; ?></td>
			<td width="28%"><?php echo MForm::specialCheckbox("use_js_validation",(int) M4J_USE_JS_VALIDATION);?></td>
			<td><span><?PHP echo M4J_LANG_USE_JS_VALIDATION_DESC .'<br/><span style="color:red;">'. M4J_LANG_ONLYPRO_DESC ; ?></span></td>
		</tr>
		
	</tbody>
</table>

</div><?php //EOF MAIN TAB ?>

<div class="m4jTabContent" id ="m4jDisplay" style="left: -9999em;">
	<div class="m4jConfigInfo"><?PHP echo M4J_LANG_CONFIG_DISPLAY_INFO;?></div>
	<div class="m4jTabHeading"  style="margin-top: -8px;"><?php echo M4J_LANG_FRONTEND;?></div>
	<table width="100%" cellspacing="1" cellpadding="0" border="0"
			align="center" class="list">
			<tbody>
				<tr>
					<th width="16%"><?PHP echo M4J_LANG_ADJUSTMENT;?></th>
					<th><?PHP echo M4J_LANG_VALUE;?></th>
					<th width="56%"><?PHP echo M4J_LANG_DESCRIPTION;?></th>
				</tr>
				
		<tr class="even">
			<td width="250"><?PHP echo M4J_LANG_FORM_TITLE; ?></td>
			<td width="28%"><?php echo MForm::specialCheckbox("form_title",(int) M4J_FORM_TITLE);?></td>
			<td><span><?PHP echo M4J_LANG_FORM_TITLE_DESC; ?></span></td>
		</tr>
		
		<tr class="odd">
			<td width="250"><?PHP echo M4J_LANG_SHOW_NO_CATEGORY; ?></td>
			<td width="28%"><?php echo MForm::specialCheckbox("show_no_category",(int) M4J_SHOW_NO_CATEGORY);?></td>
			<td><span><?PHP echo M4J_LANG_SHOW_NO_CATEGORY_DESC; ?></span></td>
		</tr>
		
		<tr class="even">
			<td width="250"><?PHP echo M4J_LANG_FORCE_CALENDAR; ?></td>
			<td width="28%"><?php echo MForm::specialCheckbox("force_calendar",(int) M4J_FORCE_CALENDAR);?></td>
			<td><span><?PHP echo M4J_LANG_FORCE_CALENDAR_DESC; ?></span></td>
		</tr>
		<tr class="odd">
			<td width="250"><?PHP echo M4J_LANG_HELP_ICON; ?></td>
			<td width="28%"><?PHP
			$break = 0;
			for($t=0; $t<7;$t++)
			{
				echo'<label><input style="border:none;" type="radio" name="help_icon" value="'.$t.'"';
				if(M4J_HELP_ICON==$t) echo 'checked';
				echo'><img src="'.$m4jConfig_live_site.'/components/com_proforms/images/help'.$t.'.png" /></label>
			';
				if($break++==4) {$break=0; echo'<br/>';}
			}

			?></td>
			<td><span><?PHP echo M4J_LANG_HELP_ICON_DESC; ?></span></td>
		</tr>
				
		<tr class="even">
			<td width="250"><?PHP echo M4J_LANG_ERROR_COLOR; ?></td>
			<td width="28%"><input type="text" maxlength="6" value="<?php echo M4J_ERROR_COLOR; ?>" style="width: 200px;" id="error_color" name="error_color"></input></td>
			<td><span><?PHP echo M4J_LANG_ERROR_COLOR_DESC; ?></span></td>
		</tr>		
	</tbody></table>
	
	
	<div class="m4jTabHeading" style="margin-top:10px;"><?php echo M4J_LANG_ADMIN;?></div>
	<table width="100%" cellspacing="1" cellpadding="0" border="0"
			align="center" class="list">
			<tbody>
				<tr>
					<th width="16%"><?PHP echo M4J_LANG_ADJUSTMENT;?></th>
					<th><?PHP echo M4J_LANG_VALUE;?></th>
					<th width="56%"><?PHP echo M4J_LANG_DESCRIPTION;?></th>
				</tr>
	
	<tr class="even">
			<td width="250"><?PHP echo M4J_LANG_WORKAREA; ?></td>
			<td width="28%"><input type="text" maxlength="50" value="<?php echo M4J_WORKAREA; ?>" style="width: 200px;" name="wa"></input></td>
			<td><span><?PHP echo M4J_LANG_WORKAREA_DESC; ?></span></td>
	</tr>	
	
	<tr class="odd">
			<td width="250" style="color:red" info="<?php echo M4J_LANG_ONLYPRO_DESC;?>" ><?PHP echo M4J_LANG_STORAGE_WIDTH; ?></td>
			<td width="28%"><input info="<?php echo M4J_LANG_ONLYPRO_DESC;?>" type="text" maxlength="50" value="<?php echo M4J_STORAGE_TD; ?>" style="width: 200px;" id="storage_td" name="storage_td"></input></td>
			<td><span><?PHP echo M4J_LANG_STORAGE_WIDTH_DESC.'<br/><span style="color:red;">'. M4J_LANG_ONLYPRO_DESC ; ?></span></td>
	</tr>	
				
	<tr class="even">
			<td width="250"><?PHP echo M4J_LANG_SHOW_LEGEND; ?></td>
			<td width="28%"><?php echo MForm::specialCheckbox("show_legend",(int) M4J_SHOW_LEGEND);?></td>
			<td><span><?PHP echo M4J_LANG_SHOW_LEGEND_DESC; ?></span></td>
	</tr>			
	<?php 
	// get all available admin languages
		$array = array();
		$array[] = array("text"=> " - " . M4J_LANG_NO . " - " , "val"=> "");
		$dir = @opendir(M4J_LANG);
		while ($entry = @readdir($dir)){
			$pi = pathinfo(M4J_LANG.DS.$entry);
			if ($entry == '.' || $entry == '..') continue;			
			if(is_file(M4J_LANG.DS.$entry) && strtolower($pi['extension'])== "php" && substr($pi["basename"],0,7) != "missing"){
				$array[] = array("text"=> strtoupper(str_replace(".php","",$pi["basename"])), "val"=> str_replace(".php","",$pi["basename"]));
			}	
		}
		@closedir ($dir);
	
	?>		
	<tr class="odd">
			<td width="250"><?PHP echo M4J_LANG_FORCE_ADMIN_LANG; ?></td>
			<td width="28%"><?php echo MForm::select("force_admin_lang",$array,M4J_FORCE_ADMIN_LANG,1,null, 'style="width:200px;"')?></td>
			<td><span><?PHP echo M4J_LANG_FORCE_ADMIN_LANG_DESC; ?></span></td>
	</tr>		
			
			
			
				
	</tbody></table>
	
</div><?php //EOF DISPLAY TAB ?>

<div class="m4jTabContent" id ="m4jSecurity" style="left: -9999em;">
<div class="m4jConfigInfo"><?PHP echo M4J_LANG_CONFIG_CAPTCHA_INFO;?></div>
		<table width="100%" cellspacing="1" cellpadding="0" border="0"
			align="center" class="list">
			<tbody>
				<tr>
					<th width="16%"><?PHP echo M4J_LANG_ADJUSTMENT;?></th>
					<th><?PHP echo M4J_LANG_VALUE;?></th>
					<th width="56%"><?PHP echo M4J_LANG_DESCRIPTION;?></th>
				</tr>
		<tr class="even">
			<td width="250"><?PHP echo M4J_LANG_CHOOSE_CAPTCHA; ?></td>
			<td width="28%">
			<?php 
			$captchaArray = array(
								 array("val" => "RECAPTCHA","text" => M4J_LANG_RE_CAPTCHA),
								 array("val" => "CSS","text" => M4J_LANG_CSS),
								 array("val" => "SPECIAL","text" => M4J_LANG_SPECIAL),
								 array("val" => "SIMPLE","text" => M4J_LANG_SIMPLE),
								 array("val" => "MATH","text" => M4J_LANG_MATH)
								 );
			echo MForm::select("captcha",$captchaArray,M4J_CAPTCHA);
			?>
			</td>
			<td><span><?PHP echo M4J_LANG_CAPTCHA_DESC; ?></span></td>
		</tr>
		<tr class="odd">
			<td width="250"><?PHP echo M4J_LANG_RECAPTCHA_THEME; ?></td>
			<td width="28%">
			<?php 
			$recaptchaArray = array(
								 array("val" => "red","text" => "red"),
								 array("val" => "white","text" => "white"),
								 array("val" => "blackglass","text" => "blackglass"),
								 array("val" => "clean","text" => "clean"),
								 array("val" => "custom","text" => "custom")
								 );
			echo MForm::select("recaptcha",$recaptchaArray,M4J_RECAPTCHA);
			?>
			</td>
			<td><span><?PHP echo M4J_LANG_RECAPTCHA_THEME_DESC; ?></span></td>
		</tr>

<?PHP
		$value = array(M4J_CAPTCHA_DURATION,M4J_SUBMISSION_TIME);

		$name = array( 'captcha_duration','submission_time');

		$area = array(M4J_LANG_CAPTCHA_DURATION,M4J_LANG_SUBMISSION_TIME);

		$desc = array(M4J_LANG_CAPTCHA_DURATION_DESC,M4J_LANG_SUBMISSION_TIME_DESC);

		$even = true;
		for($t=0;$t<sizeof($value);$t++)
		{
			HTML_m4j::config_list_wrap($area[$t],$name[$t],$value[$t],'<span>'. $desc[$t]. '</span>',$even);
			$even = !$even;
		}

		?>
	</tbody>
</table>
</div><?php //EOF SECURITY TAB ?>


<div class="m4jTabContent" id ="m4jCSSConfig" style="left: -9999em;">


<div class="m4jConfigInfo"><?PHP echo M4J_LANG_CSS_CONFIG_DESC;?></div>
<table width="100%" cellspacing="1" cellpadding="0" border="0"
	align="center" class="list">
	<tbody>
		<tr>
			<th width="16%"><?PHP echo M4J_LANG_AREA;?></th>
			<th>CSS</th>
			<th width="56%"><?PHP echo M4J_LANG_DESCRIPTION;?></th>
		</tr>

		<?PHP
		$value = array(M4J_CLASS_HEADING, M4J_CLASS_HEADER_TEXT, M4J_CLASS_LIST_WRAP, M4J_CLASS_LIST_HEADING, M4J_CLASS_LIST_INTRO,
		M4J_CLASS_FORM_WRAP, M4J_CLASS_FORM_TABLE, M4J_CLASS_ERROR, M4J_CLASS_SUBMIT_WRAP, M4J_CLASS_SUBMIT,M4J_CLASS_RESET, M4J_CLASS_REQUIRED);

		$name = array(
					'class_heading','class_header_text','class_list_wrap','class_list_heading','class_list_intro','class_form_wrap',                       
					'class_form_table','class_error','class_submit_wrap','class_submit','class_reset','class_required'                       
					);

					$area = array(M4J_LANG_CLASS_HEADING, M4J_LANG_CLASS_HEADER_TEXT, M4J_LANG_CLASS_LIST_WRAP, M4J_LANG_CLASS_LIST_HEADING,
			  M4J_LANG_CLASS_LIST_INTRO, M4J_LANG_CLASS_FORM_WRAP, M4J_LANG_CLASS_FORM_TABLE, M4J_LANG_CLASS_ERROR,
			  M4J_LANG_CLASS_SUBMIT_WRAP, M4J_LANG_CLASS_SUBMIT, M4J_LANG_CLASS_RESET, M4J_LANG_CLASS_REQUIRED);

			  $desc = array(M4J_LANG_CLASS_HEADING_DESC, M4J_LANG_CLASS_HEADER_TEXT_DESC, M4J_LANG_CLASS_LIST_WRAP_DESC,
			  M4J_LANG_CLASS_LIST_HEADING_DESC, M4J_LANG_CLASS_LIST_INTRO_DESC, M4J_LANG_CLASS_FORM_WRAP_DESC,
			  M4J_LANG_CLASS_FORM_TABLE_DESC, M4J_LANG_CLASS_ERROR_DESC, M4J_LANG_CLASS_SUBMIT_WRAP_DESC,
			  M4J_LANG_CLASS_SUBMIT_DESC, M4J_LANG_CLASS_RESET_DESC, M4J_LANG_CLASS_REQUIRED_DESC);

			  $even = true;
			  for($t=0;$t<sizeof($value);$t++)
			  {
			  	HTML_m4j::config_list_wrap($area[$t],$name[$t],$value[$t],'<span>'. $desc[$t]. '</span>',$even);
			  	$even = !$even;
			  }
			  ?>
	</tbody>
</table>
<br />

<br />
<br />
<input name="task" type="hidden" id="task" />
</div><?php //EOF CSS TAB ?>

	<div class="m4jTabContent" id="m4jEditCSS" style="left: -9999em;">
	<center><span style="font-size: 48px; color:red;"><?php echo M4J_LANG_ONLYPRO;?></span></center>
	</div> <?php //EOF EDIT AREA TAB ?>



<div class="m4jTabContent" id="m4jPatch" style="left: -9999em;">
	<br/>
	<input id="setPatch" type="hidden" name="patch" value="0"></input>
	<fieldset>
		<legend>Patch</legend>
		<input type="file" name="patchfile" size="150" style="float:left; width: 700px;"></input>
		<a class="m4jSelect m4jSelectAccept" 
		   style="position: absolute; right: 0; width: 100px; margin-right: 10px; margin-top: -10px;" 
		   onclick="javascript: dojo.byId('setPatch').value = '1'; dojo.byId('m4jForm').submit(); return false;">
			<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px;"><?php echo JText::_("Upload"); ?></div>
		</a> 
	</fieldset>
	
	<?php if ($installerOutput) echo $installerOutput; ?>
	
</div> <?php //EOF Patch ?>



</div> <?php //EOF TAB WRAP ?>
<input type="submit" name="reset" value="<?PHP echo M4J_LANG_RESET; ?>" style="margin-bottom:10px;" info="<?php echo M4J_LANG_RESET_DESC; ?>"></input>
<span>&nbsp; <?php echo M4J_LANG_CONFIG_RESET_INFO; ?></span>
</form>





<?php // Appending the Tab Areas ?>
<script type="text/javascript" language="javacript">
var cTab = new M4JTab(["m4jMainConfig","m4jDisplay","m4jSecurity","m4jCSSConfig","m4jEditCSS","m4jPatch"]);
dojo.addOnLoad(function(){
	_S("configTabWrap").height = ( cTab.getMaxHeight() + 25 ) + "px";
});
</script>
