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
});

</script>
<?php if($message):?>
<div class="m4j_success" style="position: absolute; display:block; right:0; margin-top: 10px;"><?php echo $message; ?></div>
<?php endif;?>

<div style="display:block; width: 100%; ">
	<h1><?php echo $heading; ?></h1>
</div>
<div class"m4jCLR"></div>
<div class="m4jConfigInfo" style="margin-bottom: 20px;"><?php echo M4J_LANG_BACKUP_DESC;?></div>
<div class"m4jCLR"></div>

<?php if($error):?>
<div style="color:red;"><?php echo $error; ?></div>
<?php endif;?>
<form id="exportForm" name="exportForm" method="post" action="<?php echo M4J_BACKUP.M4J_REMEMBER_CID_QUERY; ?>" >
	<input type="hidden" name="export" value="1"></input>
	<fieldset>
		<legend><?php echo M4J_LANG_DB_EXPORT; ?></legend>
		<div style="display:block; float:left;">
			<label style="float:left; line-height:17px; margin-right: 10px;"><?php echo M4J_LANG_IGNORE_RECORDS; ?>:</label>
			<?php echo MForm::specialCheckbox("no_storage", 0);?>
		</div>
		
		<div style="display:block; float:left;">
			<label style="float:left; line-height:17px; margin-right: 10px; margin-left: 10px;"><?php echo M4J_LANG_IGNORE_APPS; ?>:</label>
			<?php echo MForm::specialCheckbox("no_apps", 0);?>
		</div>
		
		<div style="display:block; float:left;">
			<label style="float:left; line-height:17px; margin-right: 10px; margin-left: 10px;"><?php echo M4J_LANG_IGNORE_CONFIG; ?>:</label>
			<?php echo MForm::specialCheckbox("no_config", 0);?>
		</div>
		<a class="m4jSelect m4jSelectAccept" style="position: absolute; right: 0; width: 100px; margin-right: 10px; margin-top: -10px;" onclick="javascript: dojo.byId('exportForm').submit(); return false;">
			<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px;"><?php echo M4J_LANG_START_EXPORT; ?></div>
		</a> 
	</fieldset>	
</form>
	
<fieldset>
<legend><?php echo M4J_LANG_DB_IMPORT; ?></legend>
<form id="importForm" name="importForm" method="post" action="<?php echo M4J_BACKUP.M4J_REMEMBER_CID_QUERY; ?>" enctype="multipart/form-data" >
<input type="hidden" name="import" value="1"></input>
<input type="file" name="sql_file" size="150" style="float:left; width: 700px;"></input>
<a class="m4jSelect m4jSelectAccept" style="position: absolute; right: 0; width: 100px; margin-right: 10px; margin-top: -10px;" onclick="javascript: dojo.byId('importForm').submit(); return false;">
	<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px;"><?php echo M4J_LANG_START_IMPORT; ?></div>
</a> 


</form>
</fieldset>	

<center><span style="font-size: 48px; color:red;"><?php echo M4J_LANG_ONLYPRO;?></span></center>


