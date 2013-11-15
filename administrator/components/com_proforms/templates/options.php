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

addScriptAtEnd(M4J_JS."options.js");
addScriptDeclarationAtEnd("
	OptManager.useValues = $use_values;
");

MDebug::pre($options);

$options = (substr($options, -1)== ";") ? substr($options, 0, -1) : $options;

$options = explode(";",$options);
$values = explode(";",$values);
$count = 0;
?>

	<div style="float:left; display:block;  width: 339px; margin-left: 35px; margin-bottom: 10px;">
		<span style="float:left; display:block; height: 17px; line-height: 17px; font-size: 14px;"><?php echo M4J_LANG_USEVALUES; ?><img src="<?php echo M4J_IMAGES; ?>info.png" border="0" align="top" style="margin-left:4px;" info="<?php echo M4J_LANG_USEVALUES_DESC; ?>" />: </span>
		<span style="float:left; margin-left:10px;">
		<?php echo MForm::specialCheckbox("use_values",(int) $use_values , "m4jToggleActive", 0 , "OptManager.toggleUseValues();"); ?>
		</span>
	</div>
	<div class="m4jCLR"></div>
	
	<a  class="m4jSelect unselectable" style="float:left; width: 309px; margin-left: 25px; margin-bottom: 10px;" onclick="javascript: OptManager.add(); return false;">
		<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px; text-align:left;"><?php echo M4J_LANG_ADDOPTION; ?></div>
	</a>
	<div class="m4jCLR"></div>
	
	<div id="optionsRootNode" class="unselectable" style="display:block; float:left; width: 400px;">

<?php foreach($options as $option){ ?>

	<div class="optionsWrap unselectable" >
		<div>
			<table cellspacing="0" cellpadding="0" border="0" style="width: 290px;">
				<tr>
					<td align="right" valign="middle" style="height:27px; padding-right:5px;"><?php echo M4J_LANG_TEXT; ?>: </td>
					<td align="left" valign="middle"><input class="optionInput" value="<?php echo $option; ?>" type="text" name="options[]" style="width:220px;" onmouseover="javascript: OptManager.setBubble(1); " onmouseout="javascript: OptManager.setBubble(0);"></input></td>
					<td align="right" valign="middle" style="width:20px;">
						<img class="selectable" src="<?php echo M4J_IMAGES?>remove.png" border="0" style="cursor:pointer;" onclick="javscript: OptManager.remove(this);" onmouseover="javascript: OptManager.setBubble(1); " onmouseout="javascript: OptManager.setBubble(0);"/>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle" class="optionValuesInputText" <?php echo $use_values ? "" : 'style="color: #888;"'; ?>><?php echo M4J_LANG_VALUE; ?>: </td>
					<td align="left" valign="middle"><input <?php echo $use_values ? "" : 'disabled'; ?> class="optionInput optionValuesInput"  value="<?php
					if(isset($values[$count])){
						echo $values[$count++]; 
					}else{
						$count++;
					} 
						 
					 ?>" type="text" name="values[]" style="width:220px;" onmouseover="javascript: OptManager.setBubble(1); " onmouseout="javascript: OptManager.setBubble(0); "></input></td>
					<td align="right" valign="middle">
						<img class="selectable" src="<?php echo M4J_IMAGES?>copy.png" border="0"  style="cursor:pointer;"  onclick="javscript: OptManager.copy(this);" onmouseover="javascript: OptManager.setBubble(1); " onmouseout="javascript: OptManager.setBubble(0);" />
					</td>
				</tr>
			</table>	
		</div>
	</div>

<?php } ?>


	</div>



<div id="optionsFactoryNode" style="border: 1px solid red;">
	<div>
		<table cellspacing="0" cellpadding="0" border="0" style="width: 290px;">
			<tr>
				<td align="right" valign="middle" style="height:27px; padding-right:5px;"><?php echo M4J_LANG_TEXT; ?>: </td>
				<td align="left" valign="middle"><input class="optionInput" value="" type="text" name="options[]" style="width:220px;" onmouseover="javascript: OptManager.setBubble(1); " onmouseout="javascript: OptManager.setBubble(0);"></input></td>
				<td align="right" valign="middle" style="width:20px;">
					<img src="<?php echo M4J_IMAGES?>remove.png" border="0" style="cursor:pointer;" onclick="javscript: OptManager.remove(this);" onmouseover="javascript: OptManager.setBubble(1); " onmouseout="javascript: OptManager.setBubble(0);"/>
				</td>
			</tr>
			<tr>
				<td align="right" valign="middle" class="optionValuesInputText" {textdisabled} ><?php echo M4J_LANG_VALUE; ?>: </td>
				<td align="left" valign="middle"><input {inputdisabled} class="optionInput optionValuesInput"  value="" type="text" name="values[]" style="width:220px;" onmouseover="javascript: OptManager.setBubble(1); " onmouseout="javascript: OptManager.setBubble(0); "></input></td>
				<td align="right" valign="middle">
					<img src="<?php echo M4J_IMAGES?>copy.png" border="0"  style="cursor:pointer;"  onclick="javscript: OptManager.copy(this);" onmouseover="javascript: OptManager.setBubble(1); " onmouseout="javascript: OptManager.setBubble(0);" />
				</td>
			</tr>
		</table>	
	</div>
</div>

