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
    $name = 'layout01';
    $id = JRequest::getInt('lid',null);
    
    if($id==-1) $id = null;
    
    $layout = & MLayoutList::get($name);
    if($id){
    	$currentLayout = MLayoutList::getLayoutById($id);
    	$layout->addData($currentLayout->getData());
    	
    }
    $root = M4J_HTTP_LAYOUT.$layout->getName()."/";
    
    $tableLeftCol = "150px";
    
    $slots = (int) $layout->getParameter("positions");
    echo '<input type="hidden" name="slots" id="slotCount" value="'.$slots.'"></input>'."\n";
        

?>
	<div style="display: block; width:100%; float:left;" >
		<div class="m4jLayoutSlot"  style="margin-right: 10px; ">
		<img src="<?php echo $root."slot1.png"; ?>" border="0" align="top" ></img>
		</div>
		<span class="m4jSlotHeadinng">Position 1</span>
	</div>
	
	<div style="display: block; width:100%; float:left; padding-left: 10px; margin-top:10px;">
		<table cellpadding="4" cellspacing="0" border="0" width="100%" style="margin-bottom: 10px;"><tbody>
			<tr>
				<td valign="top" align="left" width="18px"><?php echo $helpers->image("fieldset.png"); ?></td>
				<td valign="top" align="left" width="<?php echo $tableLeftCol; ?>"><?php echo M4J_LANG_USE_FIELDSET; ?></td>
				<td valign="top" align="left"><?php echo MForm::specialCheckbox("use_fieldset[1]",(int) $layout->getValue(1,"use_fieldset"));?></td>
			</tr>
		
			<tr>
				<td valign="top" align="left" width="18px"><?php echo $helpers->image("width.png"); ?></td>
				<td valign="top" align="left" width="<?php echo $tableLeftCol; ?>"><?php echo M4J_LANG_WIDTH; ?></td>
				<td valign="top" align="left"><input style="width:190px;" type="text" name="width[1]" value="<?php echo $layout->getValue(1,"width"); ?>"></input> <b>px</b></td>
			</tr>
		
			<tr>
				<td valign="top" align="left" width="18px"><?php echo $helpers->image("height.png"); ?></td>
				<td valign="top" align="left" width="<?php echo $tableLeftCol; ?>"><?php echo M4J_LANG_HEIGHT; ?></td>
				<td valign="top" align="left"><input style="width:190px;" type="text" name="height[1]" value="<?php echo $layout->getValue(1,"height"); ?>"></input> <b>px</b></td>
			</tr>
		
		
			<tr>
				<td valign="top" align="left" width="18px"><?php echo $helpers->image("legend.png"); ?></td>
				<td valign="top" align="left" width="<?php echo $tableLeftCol; ?>"><?php echo M4J_LANG_LEGEND_NAME; ?></td>
				<td valign="top" align="left"><input style="width:220px;" type="text" name="legend[1]" value="<?php echo MReady::_($layout->getValue(1,"legend")); ?>"></input></td>
			</tr>
			
			<tr>
				<td valign="top" align="left" width="18px"><?php echo $helpers->image("align-left.png"); ?></td>
				<td valign="top" align="left" width="<?php echo $tableLeftCol; ?>"><?php 
					$forPosition = sprintf(M4J_LANG_FOR_POSITION, 1);
				
					echo M4J_LANG_LEFT_COL; 
					echo $helpers->info_button(M4J_LANG_Q_WIDTH.$forPosition);?></td>
				<td valign="top" align="left"><input style="width:190px;" type="text" name="left[1]" value="<?php echo $layout->getValue(1,"left"); ?>"></input> <b>px</b></td>
			</tr>
			
			<tr>
				<td valign="top" align="left" width="18px"><?php echo $helpers->image("align-right.png"); ?></td>
				<td valign="top" align="left" width="<?php echo $tableLeftCol; ?>"><?php 
					echo M4J_LANG_RIGHT_COL; 
					echo $helpers->info_button(M4J_LANG_A_WIDTH.$forPosition);
				?></td>
				<td valign="top" align="left"><input style="width:190px;" type="text" name="right[1]" value="<?php echo $layout->getValue(1,"right"); ?>"></input> <b>px</b></td>
			</tr>
			
		</tbody></table>
		
		
	</div>
