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

<div id="appInstallWrap" style="position: relative; display:block; width:100%; height:1px;">
	<div id="dropDownAppInstall">
		<div style=" display:block; position:absolute;  width: 100%; bottom: 0;">
	
			<div class="appInstallInnerWrap">
				<form id="installForm" name="installForm" method="post" action="<?php echo M4J_APPLIST.M4J_REMEMBER_CID_QUERY; ?>" enctype="multipart/form-data" >
					<input type="hidden" name="install" value="1"></input>
					<div style="float:left; margin-top: 5px;">
					<img src="<?php echo M4J_IMAGES?>eject.png" style="float:left; margin-top: -2px; margin-right:5px; cursor: pointer; "  onclick="javascript: toggleInstallApp(); " align="top"/>
					<input type="file" name="install_file" size="120" style="float:left; width: 600px;"></input>
					</div>
					<a  class="m4jSelect m4jSelectAccept" style="float:right; width: 180px; margin-right: 10px; margin-top: -4px;" onclick="javascript: dojo.byId('installForm').submit(); return false;">
						<div class="m4jSelectExtend" style="font-size:12px; padding-top: 3px;"><?php echo JText::_("Upload")." &amp; ". JText::_("Install"); ?></div>
					</a> 
				</form>
				<div class="m4jCLR"></div>
			</div>
		</div>
	</div>
</div>




<?php if($error):?>
<div style="color:red;"><?php echo $error; ?></div>
<?php endif;?>

<?php if($message):?>
<div class="m4j_success" style="position: absolute; display:block; right:0; margin-top: 10px;"><?php echo $message; ?></div>
<?php endif;?>


	<div style="display: block; height: 35px; padding-left: 10px; padding-right: 10px;">
			<h1><?php echo $heading; ?></h1>	
	</div>
	
	

		<form id="m4jForm" name="m4jForm" method="post" action="<?php echo M4J_APPLIST.M4J_REMEMBER_CID_QUERY; ?>" enctype="multipart/form-data" >
				



		<input type="hidden" name="task" id="m4jTask" value=""></input>
		<input type="radio"" name="aid" value="" style="display:none;"></input>
		<table id="m4jTableList" width="100%" cellspacing="1" cellpadding="0" border="0"
			align="center" class="list">
			<tbody>
				<tr>
					<th style="width: 10px"></th>
					<th><?PHP echo M4J_LANG_ACTIVE;?><img src="<?php echo M4J_IMAGES; ?>info.png" border="0" align="top" style="margin-left:4px;" info="<?php echo M4J_LANG_ACTIVEAPP_DESC; ?>" /></th>
					<th ><?PHP echo M4J_LANG_NAME;?></th>
					<th><?PHP echo M4J_LANG_ADMINISTRATION;?> <img src="<?php echo M4J_IMAGES; ?>info.png" border="0" align="top" style="margin-left:4px;" info="<?php echo M4J_LANG_ADMINISTRATION_DESC; ?>" /></th>
					<th ><?PHP echo M4J_LANG_FRONTEND;?> <img src="<?php echo M4J_IMAGES; ?>info.png" border="0" align="top" style="margin-left:4px;" info="<?php echo M4J_LANG_FRONTEND_VIEW_DESC; ?>" /></th>
					<th ><?PHP echo M4J_LANG_PLUGIN;?> <img src="<?php echo M4J_IMAGES; ?>info.png" border="0" align="top" style="margin-left:4px;" info="<?php echo M4J_LANG_PLUGIN_DESC; ?>" /></th>
					<th ><?PHP echo M4J_LANG_AUTHOR;?></th>
					<th ><?PHP echo M4J_LANG_CREATED;?></th>
					<th ><?PHP echo M4J_LANG_VERSION;?></th>
					<th ><?PHP echo M4J_LANG_ORDERING;?></th>
				</tr>
		<?PHP
		$count = 1;
		foreach ($appInfo as $info){	
		$odd = 	$count++%2;		
		?>
		<tr class="<?php echo $odd ? "odd" : "even"; ?>">
			<td><input type="radio"" name="aid" value="<?php echo $info->aid; ?>" style="border: none;"></input></td>
			<td align="center" style="width: 55px;">
				<?php if ($info->active):?>
				<a href="<?php echo $uri . "&amp;aid=" .$info->aid . "&amp;active=0" ;  ?>">
					<img src="<?php echo M4J_IMAGES; ?>active.png" border="0" align="top" style="margin-left:4px;" info="<?php echo M4J_LANG_ACTIVE. "<br>" .M4J_LANG_KLICKFORDEACTIVATE ; ?>" />
				</a>
				<?php else: ?>
				<a href="<?php echo $uri . "&amp;aid=" .$info->aid . "&amp;active=1" ;  ?>">
					<img src="<?php echo M4J_IMAGES; ?>not_active.png" border="0" align="top" style="margin-left:4px;" info="<?php echo M4J_LANG_NOT_ACTIVE. "<br>" .M4J_LANG_KLICKFORACTIVATE ; ?>" />
				</a>
				<?php endif;?>
			</td>
			<td ><?PHP echo $info->name;  if($info->desc){ ?><img src="<?php echo M4J_IMAGES; ?>info.png" border="0" align="top" style="margin-left:4px;" info="<?php echo $info->desc; ?>" />   <?php }?></td>
			<td align="center"  style="width: 80px">
			<?php if ($info->hasAdmin):?>
				<a href="<?php echo M4J_ADMINAPPS; ?>&amp;app=<?php echo $info->app . M4J_REMEMBER_CID_QUERY; ?>" class="startAppAdmin" style="color: #ffffff;">
					<?php echo M4J_LANG_START; ?>
				</a>
			<?php else: ?>
				<img src="<?php echo M4J_IMAGES; ?>optin0.png" border="0" align="top" style="margin-left:4px;" />
			<?php endif;?>
				
			
			</td>
			<td style="width:80px;" align="center">
				<img src="<?php echo M4J_IMAGES;?>optin<?php echo $info->hasView ? "1" : "0" ; ?>.png" border="0" align="top" style="margin-left:4px;" />
			</td>
			<td style="width:60px;" align="center">	
				<img src="<?php echo M4J_IMAGES;?>optin<?php echo $info->hasPlugin ? "1" : "0" ; ?>.png" border="0" align="top" style="margin-left:4px;" />
			</td>
			<td ><?PHP echo $info->author; ?><img src="<?php echo M4J_IMAGES; ?>info.png" border="0" align="top" style="margin-left:4px;" info="<?php echo $info->additionalInfo; ?>" /> </td>
			<td style="width:60px;" ><?PHP echo $info->created; ?></td>
			<td style="width:45px;"><?PHP echo $info->version; ?></td>
			<td style="width:70px;" align="center" >
			<?php echo $helpers->up_down_button(M4J_APPLIST, $info->aid, $info->sort_order); ?>
			</td>
		</tr>
		
		<?php }//EOF AppInfo?>
		
	</tbody>
</table>

</form>


