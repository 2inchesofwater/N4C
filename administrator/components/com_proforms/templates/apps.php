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
?>
<script type="text/javascript" src="<?php echo M4J_JS_APPS;?>"></script>
<table cellpadding="0" cellspacing="0" border="0" width="100%" >
<tr>
	<td colspan="3"><h1 class="m4j_toLeft"><?php echo M4J_LANG_APPS_HEADING; ?>: <?php echo $formName; ?></h1></td>
</tr>
  <tr>
    <td style="width:170px;" align="left" valign="top">
    	<div class="appListing">
    	
    		<?php foreach($appInfo as $info){?>
    		
      		<a href="<?php echo M4J_APPS.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY?>&amp;id=<?php echo $id; ?>&amp;app=<?php echo $info->app; ?>" 
      		   class="app<?php echo ($app == $info->app) ? "On" : ""?>"
      		   info="<?php echo $info->desc; ?>">
      			
      		<?php 
      		$imgsrc = "appoff";
      		if($info->active){
      			$imgsrc = ($app == $info->app) ? "appon4dark" : "appon";
      		}
      		
      		?>	
      			
      			<img src="<?php echo M4J_IMAGES .$imgsrc; ?>.png" border="0" /><?php echo $info->name; ?>
      		</a>
      		<?php }?>
    	</div>
    	<div class="m4jCLR"></div>
    </td>
    <td style="width:10px;"></td>

	<td  align="left" valign="top">
    
    <?php if($app):?>
	    <?php if(! defined("_APPS_NO_FORM")):?>
		    <form id="appForm" name="appForm" method="post" action="<?php echo M4J_APPS.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY?>&amp;id=<?php echo $id; ?>&amp;app=<?php echo $app; ?>" enctype="multipart/form-data">
		    <input type="hidden" name="send" value="1"></input>
		    <div class="m4j_tabs_back" style=" background-position: 0px 10px; border: 1px solid #d0d0d0;">   		
		    	<span style="float:left; margin-left: 10px; font-size: 18px; font-weight: bold; line-height: 32px; color: #135CAE; ">
		    	<?php echo AText::_("name"); ?>
		    	</span>		
		    	<a id="m4jSaveServiceKey" class="m4jSelect" style="position: absolute; right: 0; width: 100px; margin-right: 10px; margin-top: 10px;" onclick="javascript: return appFormSubmit(); ">
					<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px;"><?php echo M4J_LANG_SAVE; ?></div>
				</a> 
			<div class="m4jCLR"></div>	
		    <div><span style="display:block; height: 17px; margin-left: 10px; float:left; font-size: 14px; font-weight: bold; margin-right: 10px; line-height: 20px;"><?php echo M4J_LANG_ACTIVE?>:</span> <?php echo MForm::specialCheckbox("appactivestate", JRequest::getInt("appactivestate",$appactivestate)); ?></div>
		    <div class="m4jCLR"></div>	     		
		    </div>  
		    <div class="m4jCLR"></div>
		   
	    <?php endif;?> 		
	    
   		<?php echo $appBody; ?>
   		
	 	<?php if(! defined("_APPS_NO_FORM")):?>
	    	</form>
	    <?php endif;?>	
    <?php endif;?>
    
    <?php 
    // Write actions outside the form tag
    if($outsideForm){
    	echo $outsideForm;
    }
    ?>
    
    
    </td>
  </tr>
</table>


<div id="fieldBalloon" class="fieldBalloon" style="top: 0px; left: -9999em;" >
	<img id="fbBalloonClose" src="<?php echo M4J_IMAGES; ?>close.png" border="0" />
	<div class="fbWrap" id="fbContentNode"></div>
	<a id="switchAliasNode" class="switchAlias" alias="<?php echo M4J_LANG_USE_ALIAS; ?>" question="<?php echo M4J_LANG_USE_QUESTIONS; ?>" onclick="javascript: FieldBalloon.switchAlias(); return false;"><?php echo M4J_LANG_USE_ALIAS; ?></a> 
</div>


<div id="aliasBalloon" class="fieldBalloon" style="top: 0px; left: -9999em;" >
	<img id="aliasBalloonClose" src="<?php echo M4J_IMAGES; ?>close.png" border="0" />
	<div class="fbWrap" id="aliasContentNode"></div>
</div>



