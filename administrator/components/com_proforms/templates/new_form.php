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

$layout_name = 'layout01';
$yes_query ="";
$no_query = "";
if ($use_help==1) $yes_query = 'selected="selected"'; else $no_query = 'selected="selected"';
?>
<form id="m4jForm" name="m4jForm" method="post"
	action="<?PHP M4J_FORM_NEW.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY ?>" >
	<?PHP M4J_LANG_TEMPLATE_NAME ?>
	<br />
	<div  style="display:block; width:100%; float:left; clear:both; margin-bottom:5px;">
		
		<div style="display:block; float:left;">
			<?php echo M4J_LANG_TEMPLATE_NAME; ?><br />
			<input name="name" type="text" id="name" size="80" maxlength="80"
				value="<?PHP echo $name; ?>" />
		</div>
		
		<div style="display:block; float:right;">
		<br/>
			<img src="<?php echo M4J_IMAGES; ?>tooltip-icon.png" border="0" align="top" style="float:left; margin-right:4px;"></img>
			<span style="float:left; margin-right:10px;padding-top:2px;">
			<?PHP echo M4J_LANG_USE_HELP; ?>
			</span>
			<?php echo MForm::specialCheckbox("use_help",(int) $use_help);?>
		</div> 
	</div>	
	
	<?PHP echo M4J_LANG_TEMPLATE_DESCRIPTION; ?><br />
	<input name="description" size="80" value="<?PHP echo $desc; ?>"
		id="description" style="width: 100%;"></input>
	<h1><?php echo M4J_LANG_LAYOUT;?></h1>
	
	<table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top: 0px;"><tbody>
		<tr>
			<td align="left" valign="top" width="462px">
				<div class="m4jLayoutBack" id="m4jLayoutWrap">			
				  <?php  echo MLayoutList::getIcons($layout_name); ?>				  				   
				</div>
				<div class="m4jCLR"></div>
				<div class="m4jConfigInfo">
				</div>
			</td>
			
			<td align="left" valign="top">
				 <div  id="layoutAttributes">
					
				</div>
			</td>
		
		</tr>
	</tbody></table>
	
	<div style="display:none;">
		<?PHP echo M4J_LANG_Q_WIDTH; ?><br />
		<input name="qwidth" type="text" id="qwidth" size="80" maxlength="80"
			value="<?PHP echo $qwidth; ?>" /> <br />
		<br />
		<?PHP echo M4J_LANG_A_WIDTH; ?><br />
		<input name="awidth" type="text" id="awidth" size="80" maxlength="80"
			value="<?PHP echo $awidth; ?>" /> <br />
		<br />
	</div>
	
	
	
	
	<input name="task" type="hidden" id="task" /> 
	<input name="editID" type="hidden" id="editID" value=<?PHP echo $id; ?> />
</form>

<script type="text/javascript">
	var errorNoName = "<?php echo M4J_LANG_TEMPLATE_NAME_REQUIRED; ?>";
	var XHRURL = "<?php echo M4J_LOAD_XHR;?>layout&name=";
	var XHRURLLID = "&lid=<?php echo $id ;?>";
	var INITXHR = "<?php echo M4J_LOAD_XHR;?>layout&name=layout01"+"&lid=<?php echo $id ;?>";
</script>

<script type="text/javascript" src="<?php echo M4J_JS_NEW_FORM; ?>"></script>

