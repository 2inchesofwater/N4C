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

$disabled = (M4J_SERVICE_KEY != "") ? ' disabled="disabled"' : "" ;
$edit = (M4J_SERVICE_KEY == "") ? ' display:none;' : "" ;
$save = (M4J_SERVICE_KEY != "") ? ' display:none;' : "" ;
?>

	
	<table width="100%" cellpadding="0" cellspacing="0" border="0"><tbody>
		<tr>
			<td valign="top" align="left">
			<center><span style="font-size: 48px; color:red;"><?php echo M4J_LANG_ONLYPRO;?></span></center>
			<?php echo M4J_LANG_SERVICE_DESC1; ?>
			</td>
			
			<td valign="top" align="left" width="20px">
			<?php echo " "; ?>
			</td>
			
			
			<td valign="top" align="left" width="300px">
				<form id="m4jForm" name="m4jForm" method="post"	action="<?PHP echo M4J_SERVICE.M4J_REMEMBER_CID_QUERY ?>">
					<fieldset class="jobsFieldSet">
						<legend><?php echo M4J_LANG_SERVICE_KEY; ?></legend>
						<textarea name="service_key" id="m4jServiceKey" style="width:100%; height:40px;" <?php echo $disabled; ?>><?php echo M4J_SERVICE_KEY; ?></textarea>
						
						
						<a  id="m4jEditServiceKey" class="m4jSelect" style="margin-top: 10px;<?php echo $edit; ?>" onclick="javascript: m4jEditKey(this); return false;">
							<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px;"><?php echo M4J_LANG_EDIT_KEY; ?></div>
						</a>
							
							
						<table width="100%" cellpadding="0" cellspacing="0" border="0"><tbody>	
							<tr>
								<td valign="top" align="left">
								<a id="m4jSaveServiceKey" class="m4jSelect" style="margin-top: 10px;<?php echo $save; ?>" onclick="javascript: m4j_submit('update'); return false;">
									<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px;"><?php echo M4J_LANG_SAVE; ?></div>
								</a>		
						
								</td>
								<td valign="top" align="left">
								<a id="m4jServiceKeyResetButton" class="m4jSelect m4jSelectDisabled" style="margin-top: 10px;<?php echo $save; ?>" onclick="javascript: m4jResetServiceKey(this); return false;">
									<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px;"><?php echo M4J_LANG_CANCEL; ?></div>
								</a>	
								</td>
						</tbody></table>
					</fieldset>
					<input name="task" type="hidden" id="task" /> 
				</form>	
				
				<form id="m4jServiceConnect" name="m4jConnect" method="post" action="<?PHP echo M4J_SERVICE_CONNECT; ?>" target="m4jServiceIFrame">
				<input id="m4jSendServiceKey" type="hidden" name="service_key" value=""></input>
				<input type="hidden" name="live_site" value="<?php echo $GLOBALS['m4jConfig_live_site']; ?>"></input>
				<input type="hidden" name="identifier" value="<?php echo M4J_IDENTIFIER; ?>"></input>
				<input type="hidden" name="unique_id" value="<?php echo ($GLOBALS["_UNIQUE_ID"]) ? $GLOBALS["_UNIQUE_ID"] : M4J_UNIQUE_ID;  ?>"></input>
				</form>
				
			</td>
		</tr>
	</tbody></table>

<script type="text/javascript" src="<?php echo M4J_JS_SERVICE; ?>"></script>



