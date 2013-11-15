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

JSText::add(array(
	"errornotemplate"=>M4J_LANG_ERROR_NO_TEMPLATE
));

global $m4jConfig_live_site, $helpers;
?>
<script type="text/javascript">
	var XHRALIAS = "<?php echo M4J_LOAD_XHR;?>falias&fids=";
	
	dojo.addOnLoad(function(){
		var tab = <?php echo $tab; ?>;
		var tabElement = dojo.query( ".tabNo"+tab)[0];
		if(tabElement){
			switch(tab){
			case 0: 
				cTab.set('m4jMainConfig','configTab',tabElement,0);
				break;
			case 1: 
				cTab.set('m4jEmailTab','configTab',tabElement,1);
				break;
			case 2: 
				cTab.set('m4jIntroText','configTab',tabElement,2);
				break;
			case 3: 
				cTab.set('m4jMainText','configTab',tabElement,3);
				break;
			case 4: 
				cTab.set('m4jAfterSending','configTab',tabElement,4);
				break;
			case 5: 
				cTab.set('m4jPaypalTab','configTab',tabElement,5);
				break;
			case 6: 
				cTab.set('m4jCodeTab','configTab',tabElement,6);
				break;
			case 7: 
				cTab.set('m4jOptTab','configTab',tabElement,7);
				break;
			}
		}
	});
	
</script>

<form id="m4jForm" name="m4jForm" method="post"
	action="<?PHP echo M4J_JOBS_NEW.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR ?>" onsubmit="return evalRequired();">

<input type="hidden" name="tab" value="<?php echo $tab; ?>" id="tabField" ></input>

<div class="m4j_tabs_back"
	style="background-position: 0px 20px; height: 78px;">
<div
	style="display: block; height: 55px; padding-left: 10px; padding-right: 10px;">
<?php $helpers->caption($heading,$feedback,$breadcrumbs);?></div>

<div class="ieJobTabWidth m4jTabLabelWrap">
<div class="tabNo0 m4jActiveTab" id="configTab"
	onclick="cTab.set('m4jMainConfig','configTab',this,0); return false;"><?PHP echo M4J_LANG_MAIN_CONFIG;?><span></span></div>
<div class="tabNo1 ieJobTabWidth40 m4jEmailTab" 
	onclick="cTab.set('m4jEmailTab','configTab',this,1); return false;"><?PHP echo M4J_LANG_EMAIL;?><span></span></div>
<div class="tabNo2 ieJobTabWidth"
	onclick="cTab.set('m4jIntroText','configTab',this,2); return false;"><?PHP echo M4J_LANG_INTROTEXT;?><span></span></div>
<div class="tabNo3 ieJobTabWidth"
	onclick="cTab.set('m4jMainText','configTab',this,3); return false;"><?PHP echo M4J_LANG_MAINTEXT;?><span></span></div>
<div class="tabNo4 ieJobTabWidth"
	onclick="cTab.set('m4jAfterSending','configTab',this,4); return false;"><?PHP echo M4J_LANG_AFTER_SENDING;?><span></span></div>
<div class="tabNo5 ieJobTabWidth40"
	onclick="cTab.set('m4jPaypalTab','configTab',this,5); return false;" style="color:red;" info="<?php echo M4J_LANG_ONLYPRO_DESC; ?>"><?PHP echo M4J_LANG_PAYPAL;?><span></span></div>	
<div class="tabNo6 ieJobTabWidth40"
	onclick="cTab.set('m4jCodeTab','configTab',this,6); return false;" style="color:red;" info="<?php echo M4J_LANG_ONLYPRO_DESC; ?>"><?PHP echo M4J_LANG_CODE;?><span></span></div>
<div class="tabNo7 ieJobTabWidth40"
	onclick="cTab.set('m4jOptTab','configTab',this,7); return false;" style="color:red;" info="<?php echo M4J_LANG_ONLYPRO_DESC; ?>"><?PHP echo M4J_LANG_OPTIN;?><span></span></div>

	
</div>
</div>

<div class="m4jTabWrap " id="configTabWrap">
<?php 
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
 * ++++ MAIN TAB 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
?>
<div class="m4jTabContent" id="m4jMainConfig">

<table width="100%" border="0" cellspacing="0" cellpadding="6">
	<tr>
		<td valign="top" align="left"><?PHP echo M4J_LANG_TITLE_FORM; ?><br />
		<input name="title" type="text" id="title"
			value="<?PHP echo $title; ?>" size="50" maxlength="60"
			style="width: 100%" /></td>

		<td valign="top" align="left" width="300px"><?PHP echo JText::_("alias"); ?><br />
		<input name="alias" type="text" id="alias" style="width: 100%"
			value="<?PHP echo $alias; ?>" maxlength="80" /> <br />
		</td>
		
	</tr>
	<tr>
		<td align="left" valign="top">		
		<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:-8px;">
			<tr>
				<td align="left" valign="top"><?PHP echo M4J_LANG_ACTIVE; ?><br />
				<?php echo MForm::specialCheckbox("active",(int) $active); ?> <br />
				</td>
				<td align="left" valign="top"><?PHP echo M4J_LANG_CAPTCHA; ?><br />
				<?php echo MForm::specialCheckbox("captcha",(int) $captcha); ?> <br />
				</td>
				<td align="left" valign="top"><?PHP echo M4J_LANG_PROCESS; ?><br />
				<select id="m4jProcess" style="margin-top: 2px;" size="1" name="process">
					<option selected="selected" value="0"><?php echo M4J_LANG_EMAIL; ?></option>
					<option style="color:red;" value="0" info="<?php echo M4J_LANG_ONLYPRO_DESC; ?>"><?php echo M4J_LANG_DATABASE; ?></option>
					<option style="color:red;" value="0" info="<?php echo M4J_LANG_ONLYPRO_DESC; ?>"><?php echo M4J_LANG_EMAIL."+".M4J_LANG_DATABASE; ?></option>
				</select>
				
				
				</td>
				
				<td align="left" valign="top">
					<?PHP echo JText::_("Access"); ?><br />
					<?php echo MForm::access($access);   ?>
				</td>
							
				<td align="left" valign="top">
				<div style="color:red;" info="<?php echo M4J_LANG_ONLYPRO_DESC; ?>">
					<?PHP echo M4J_LANG_CONFIRMATION_MAIL; ?>
					<br />
					<?php
					
					$confirmationArray = array(
					array("val" => "0","text" => M4J_LANG_NEVER),
					array("val" => "1","text" => M4J_LANG_EVER),
					array("val" => "2","text" => M4J_LANG_ASK)
					);
					echo MForm::select(
						"confirmation",
						$confirmationArray,
						0,
						MFORM_DROP_DOWN,
						null,
						'style="margin-top:2px; color:red;"'
						);
					?> 
				</div>
				</td>
				
				
			</tr>
		</table>
		</td>
		<td align="left" valign="top">	
			<div style="margin-top:-8px;">
				<img alt="" src="<?php echo M4J_IMAGES?>cat.png" align="top" border="0" style="float:left; margin-top:2px; margin-right:5px;"></img>
				<div style="display:block; float:left; width:250px;">
				<?PHP echo M4J_LANG_CATEGORY; ?><br />
				<?PHP echo $helpers->category_menu($categories,$cid,null,1)?> 
				</div>
			</div>
		</td>
		
		</tr>
		</table>
		
<fieldset class="jobsFieldSet">
	<legend>
		<img alt="" src="<?php echo M4J_IMAGES?>addtemplate.png" align="top" border="0" style="float:left; margin-top:0px; margin-right:5px;">
		<?PHP echo M4J_LANG_TEMPLATE; ?>
	</legend>	

	<table width="100%" border="0" cellspacing="10px" cellpadding="10px" style="margin-top: -10px;">
		<tr>
		<!-- +++++++++++++++++SELECTED TEMPLATES +++++++++++++++++++++++++++++ -->
			<td width="50%" valign="top" align="left">
				<div class="m4jSelectionHeading">
					<span><?php echo M4J_LANG_INCLUDED_TEMPLATES; ?>
						<a onclick="javascript: resetTemplate(); return false;" 
						   class="m4jReset" 
						   style="float:right;margin-right:-10px; border-left: 1px solid #898989;" >
						<?php echo M4J_LANG_RESET;?>
						</a>
					</span>
				</div>	
				<div class="m4jSelectionWrap" id="m4jSelectedTemplates">
				<?php 
					$fid2Template = array();
					foreach ($templates as $template){
						$fid2Template[$template->fid] = $template;
					}
					
					$hasUserMail = false;
					foreach ($fid as $formID){
						$tpl = $fid2Template[$formID];
				?>
					<a class="m4jSelect m4jSelected" 
					   id="m4jTemplate_<?php echo (int) $formID; ?>" 
					   fid="<?php echo (int) $formID; ?>"
					   usermail = "0"
					   onclick="javascript: addTemplate(this); return false;"
					   <?php if($template->description != ""){
							echo ' info="'.$tpl->description.'"';
					   }?>>
						<div class="m4jSelectExtend">
						<?php 
						$tpl->name = $helpers->fitString($tpl->name,45);
						echo $tpl->name;
						?>
						</div>
						<span class="m4jValueContainer" id="valueContainer_<?php echo (int) $tpl->fid; ?>"><input type="hidden" value="<?php echo (int) $tpl->fid; ?>" name="fid[]"></input></span>
					</a>					  				   
					<?php 
					}//eof foreach fid ?>						  				   
				</div>
				<div class="m4jCLR"></div>
				<script type="text/javascript">
				var m4jHasUserMail = false;
				
				function m4jUserMailPrompt(){
					alert("<?php echo M4J_LANG_ADVICE_USERMAIL_ERROR; ?>");
				}
				</script>
			</td>
			<!-- +++++++++++++++++ AVAILABLE TEMPLATES +++++++++++++++++++++++++++++ -->
			<td width="50%" valign="top" align="left">
				
				<!-- REMOVE THIS -->
				<!-- <input type="hidden" name="fid" value ="<?php echo $template->fid; ?>"></input> -->
				<!-- EOF REMOVE THIS -->
				
			<div class="m4jSelectionHeading"><span><?php echo M4J_LANG_ADD_TEMPLATE; ?></span></div>	
			<div class="m4jSelectionWrap" id="m4jTemplateSelection">	
					<?php 
					
					foreach ($templates as $template){
						if(! in_array($template->fid, $fid)){
					
					?>
					<a class="m4jSelect" 
					   id="m4jTemplate_<?php echo (int) $template->fid; ?>" 
					   fid="<?php echo (int) $template->fid; ?>"
					   usermail = "0"
					   onclick="javascript: addTemplate(this); return false;"
					   <?php if($template->description != ""){
							echo ' info="'.$template->description.'"';
					   }?>>
						<div class="m4jSelectExtend">
						<?php 
						$template->name = $helpers->fitString($template->name,45);
						echo $template->name;
						?>
						</div>
						<span class="m4jValueContainer" id="valueContainer_<?php echo (int) $template->fid; ?>"></span>
					</a>					  				   
					<?php 
						}// EOF fid != $template->fid
					}//eof foreach templates?>				  				   
			</div>
			<div class="m4jCLR"></div>	
				
				
			</td>
		</tr>
	</table>
</fieldset>	

<center><span style="color:red;"><?php echo M4J_LANG_ONLYONETEMPLATE; ?></span></center>


</div><?php //EOF MAIN TAB?>

<?php 
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
 * ++++ EMAIL TAB 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
?>

<div class="m4jTabContent" id="m4jEmailTab" style="left: -9999em;">

		<div class="m4jConfigInfo" style="margin-top:5px; margin-bottom:10px;"><?PHP echo M4J_LANG_JOBS_EMAIL_INFO; ?></div>
		<table width="100%" cellpadding="0" cellspacing="0" border="0" style="">
			<tr>
				<td align="left" valign="top" >
				
					<?PHP echo M4J_LANG_EMAIL; ?> <img src="components/com_proforms/images/info.png" info="<?php echo M4J_LANG_EMAIL_FORMAT_DESC; ?>" align="top" /><br />
					<input name="email" type="text" id="email" style="width: 99%"
						value="<?PHP echo $email; ?>"  maxlength="200"/>
					<br />
				</td>
			</tr>
			<tr>
				<td height="10px"> </td>
			</tr>
			<tr>
				<td align="left" valign="top" >
					<?PHP echo M4J_LANG_SUBJECT; ?> <img src="components/com_proforms/images/info.png" info="<?php echo M4J_LANG_EMAIL_SUBJECT_DESC; ?>" align="top" /><br />
					<input name="subject" type="text" id="subject" style="width: 99%"
						value="<?PHP echo $subject; ?>"  maxlength="200"/>
					<br />
				</td>
			</tr>
			<tr>
				<td height="10px"> </td>
			</tr>			
			<tr>
				<td align="left" valign="top">
				
					<table width="100%" cellpadding="0" cellspacing="0" border="0"><tbody><tr>
					
					<td align="left" valign="middle" width="215px">
					
						<?PHP echo M4J_LANG_DATA_LISTING; ?>  <img src="components/com_proforms/images/info.png" info="<?php echo M4J_LANG_DATA_LISTING_DESC; ?>" align="top" />
					</td>
					<td align="left" valign="top" width="80px">
						<?php echo MForm::specialCheckbox("data_listing",(int) $data_listing); ?>
					</td>
					<td><span></span>
				
					</td>
					</tr></tbody></table>
					<div id="m4jSelectAliasForHidden" class="m4jFieldAliasSelect m4jFASHidden">
						<div class="m4jConfigInfo" style="width: 90%; margin-top: 4px;"><?PHP echo M4J_LANG_ALIAS_ADVICE; ?></div>
						<div id="m4jSelectAliasForHiddenContent" style="display:block; margin: 10px;"></div> 
					</div>
					<img id="m4jSelectAliasForHiddenClose" src="<?php echo M4J_IMAGES;?>remove.png" class="m4jFASClose" onclick="javascript: isAliasWindow = ! isAliasWindow; setAliasWindow(0);"/>
					<img id="m4jSelectAliasForHiddenOpen" src="<?php echo M4J_IMAGES;?>add12.png" class="m4jFASClose" style="display:block;" onclick="javascript: showAliasWindow('hidden');"/>	
				</td>
		 	</tr>
		 	<tr>
				<td height="10px"> </td>
			</tr>
			<tr>
				<td align="left" valign="top" >
					<table width="100%" cellpadding="0" cellspacing="0" border="0"  style="font-size: 12px;"><tr>
					<td align="left" valign="top"><?PHP echo M4J_LANG_EMAIL_TEXT; ?></td>
					<td align="right" valign="top"><a class="m4jAddAliasButton" onclick="javascript: showAliasWindow('hidden'); return false;"><?php echo M4J_LANG_INSERT_FIELD_VALUE; ?></a> </td>
					</tr></table>
					<?php  MEditorArea('hidden',$hidden,'hidden','100%','300','75','30');
							if(function_exists("file_get_contents")){
								$e = file_get_contents( JPATH_BASE.DS.'components'.DS.'com_proforms'.DS.'includes'.DS.'evolution.php');
								$e = explode("_5a547');", $e); $f = explode('DEFINE("_M4J_', $e[1]); $g= md5(trim($f[0]));
								if($g!="d73107c5f4d6fa5a4b4fa69c3475c708") define('M4J_LANG_NEWJOBS_NEXT',1);
							}
					?>
				</td>
			</tr>
		</table>
</div>
		<?php //EOF EMAIL TAB?>

<?php 
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
 * ++++ INTROTEXT TAB 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
?>

<div class="m4jTabContent" id="m4jIntroText" style="left: -9999em;">
<div class="m4jConfigInfo" style="margin-top:5px;"><?PHP echo M4J_LANG_JOBS_INTROTEXT_INFO;?></div>
<?PHP MEditorArea('introtext',$introtext,'introtext','100%','400','75','30'); ?>
</div>
<?php //EOF INTROTEXT TAB?>

<?php 
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
 * ++++ MAIN TEXT TAB 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
?>

<div class="m4jTabContent" id="m4jMainText" style="left: -9999em;">
<div class="m4jConfigInfo" style="margin-top:5px;"><?PHP echo M4J_LANG_JOBS_MAINTEXT_INFO;?></div>
<?php MEditorArea('maintext',$maintext,'maintext','100%','400','75','30'); ?>
</div>
<?php //EOF MAIN TEXT TAB?>

<?php 
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
 * ++++ AFTER SENDING TAB 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
?>
<div class="m4jTabContent" id="m4jAfterSending" style="left: -9999em;">
<div class="m4jConfigInfo" style="margin-top:5px;"><?PHP echo M4J_LANG_JOBS_AFTERSENDING_INFO;?></div>

<div class="m4jAfterSendingWrap" id="afterSendingWrap">

	<div class="m4jAfterSending">
		<a onclick="javascript: changeASArrowStyle(this,0);" style="margin-left:15px;" <?php echo ($aftersending == 0) ? 'id="asSelected"' : ''; ?>><?php echo M4J_LANG_STANDARD_TEXT; ?></a>
		<a onclick="javascript: changeASArrowStyle(this,1);" <?php echo ($aftersending == 1) ? 'id="asSelected"' : ''; ?>><?php echo M4J_LANG_REDIRECT; ?></a>
		<a onclick="javascript: changeASArrowStyle(this,2);" <?php echo ($aftersending == 2) ? 'id="asSelected"' : ''; ?>><?php echo M4J_LANG_CUSTOM_TEXT;?></a>
	</div>

	<div class="m4jAfterSendingRight" id="arrow<?php echo $aftersending; ?>" ></div>

	<div style="width:370px; float:left; margin-top: 10px; visibility: <?php echo ($aftersending == 1) ? 'visible' : 'hidden'; ?>;" id="m4jRedirectWrap">
		URL
		<br/>
		<input name="redirect" type="text" id="m4jRedirection"
				value="<?PHP echo $redirect; ?>"  maxlength="200"
				style="width: 300px; float:left;" />	
				
		<div style="display:block; float:left; margin-left: 5px; margin-top: -3px;" info="<?php echo M4J_LANG_ARTICLE_LINK_INFO; ?>">
			<div class="button2-left"><div class="blank">
				<a onclick="javacsript: getArticle('m4jRedirection');"><?php echo M4J_LANG_ARTICLES; ?></a>
			</div></div>
		</div>		
		
	</div>
	<input type="hidden" name="aftersending" value="<?php echo $aftersending; ?>" id="m4jAfterSendingField"></input>
	
</div>

<div style="width: 100%; visibility: <?php echo ($aftersending == 2) ? 'visible' : 'hidden'; ?>;" id="m4jCustomTextWrap">

	<div id="m4jSelectAliasForCustomText" class="m4jFieldAliasSelect m4jFASCustomText">
		<div class="m4jConfigInfo" style="width: 90%; margin-top: 4px;"><?PHP echo M4J_LANG_ALIAS_ADVICE; ?></div>
		<div id="m4jSelectAliasForCustomTextContent" style="display:block; margin: 10px;"></div> 
	</div>
	<img id="m4jSelectAliasForCustomTextClose" src="<?php echo M4J_IMAGES;?>remove.png" class="m4jFASClose" style="margin-top:-2px;" onclick="javascript: isAliasWindow2 = ! isAliasWindow2; setAliasWindow2(0);"/>
	<img id="m4jSelectAliasForCustomTextOpen" src="<?php echo M4J_IMAGES;?>add12.png" class="m4jFASClose" style="display:block; margin-top:-2px;" onclick="javascript: showAliasWindow2('custom_text'); "/>


	<table width="100%" cellpadding="0" cellspacing="0" border="0"  style="font-size: 12px;"><tr>
		<td align="left" valign="top"><?PHP echo M4J_LANG_CUSTOM_TEXT; ?></td>
		<td align="right" valign="top"><a class="m4jAddAliasButton" onclick="javascript: showAliasWindow2('custom_text'); return false;"><?php echo M4J_LANG_INSERT_FIELD_VALUE; ?></a> </td>
	</tr></table>

	<?php 
	
	MEditorArea('custom_text',$custom_text,'custom_text','100%','380','75','30'); ?>
</div>


<script type="text/javascript">
 var arrowQuery = dojo.query(".m4jAfterSendingRight",dojo.byId("afterSendingWrap"));
 var m4jChangeArrowStyle = arrowQuery[0];
 arrowQuery = undefined;
</script>



</div>
<?php //EOF AFTER SENDING TAB?>

<?php 
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
 * ++++ PAYPAL TAB 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
?>
<div class="m4jTabContent" id="m4jPaypalTab" style="left: -9999em;">
<div class="m4jConfigInfo" style="margin-top:5px;margin-bottom:10px;"><?PHP echo M4J_LANG_JOBS_PAYPAL_INFO;?></div>

<div>
	<span style="float:left; margin-right: 10px; padding-top: 2px;"><?php echo M4J_LANG_USE_PAYPAL; ?>:</span>
	<?php echo MForm::specialCheckbox("is_paypal",0); ?> 
</div>
<div>
	<span style="float:left; margin-left: 20px; margin-right: 10px; padding-top: 2px;"><?php echo M4J_LANG_USE_PAYPAL_SANDBOX; ?>:</span>
	<?php echo MForm::specialCheckbox("is_sandbox",0); ?> 
</div>
<div class="m4jCLR"></div>

<fieldset class="jobsFieldSet">
<legend><?php echo M4J_LANG_PAYPAL_PARAMETERS; ?></legend>
<br />
<label><?php echo M4J_LANG_PAYPAL_ID; ?></label><br />
<input type="text" name="business"  style="width: 100%;" ></input><br /><br />
<label><?php echo M4J_LANG_PAYPAL_PRODUCT_NAME; ?></label><br />
<input type="text" name="item_name" style="width: 100%;" ></input><br /><br />

<table style="width: 100%;" cellpadding="2" cellspacing="2">
	<tbody>
		<tr>
			<td align="left" valign="top" style="width: 100px;">
				<label><?php echo M4J_LANG_PAYPAL_QTY; ?></label><br />
				<input type="text" name="quantity"  style="width: 100%;" ></input><br /><br />
			</td>
			
			<td align="left" valign="top" style="width: 180px;">
				<label><?php echo M4J_LANG_PAYPAL_NET_AMOUNT; ?></label><br />
				<input type="text" name="amount"  style="width: 100%;" ></input><br /><br />
			</td>
			
			<td align="left" valign="top">
				<label><?php echo M4J_LANG_PAYPAL_CURRENCY_CODE; ?></label><br />
				<?php 
				$currencies = array(
					array("val"=>"", "text"=>M4J_LANG_PLEASE_SELECT),
					array("val"=>"AUD", "text"=>"AUD"),
					array("val"=>"BRL", "text"=>"BRL"),
					array("val"=>"CAD", "text"=>"CAD"),
					array("val"=>"CZK", "text"=>"CZK"),
					array("val"=>"DKK", "text"=>"DKK"),
					array("val"=>"EUR", "text"=>"EUR"),
					array("val"=>"HKD", "text"=>"HKD"),
					array("val"=>"HUF", "text"=>"HUF"),
					array("val"=>"ILS", "text"=>"ILS"),
					array("val"=>"JPY", "text"=>"JPY"),
					array("val"=>"MYR", "text"=>"MYR"),
					array("val"=>"MXN", "text"=>"MXN"),
					array("val"=>"NOK", "text"=>"NOK"),
					array("val"=>"NZD", "text"=>"NZD"),
					array("val"=>"PHP", "text"=>"PHP"),
					array("val"=>"PLN", "text"=>"PLN"),
					array("val"=>"GBP", "text"=>"GBP"),
					array("val"=>"SGD", "text"=>"SGD"),
					array("val"=>"SEK", "text"=>"SEK"),
					array("val"=>"CHF", "text"=>"CHF"),
					array("val"=>"TWD", "text"=>"TWD"),
					array("val"=>"THB", "text"=>"THB"),
					array("val"=>"TRY", "text"=>"TRY"),
					array("val"=>"USD ", "text"=>"USD")
				);
				echo MForm::select("currency_code",
									$currencies,
									"",
									MFORM_DROP_DOWN,
									null,
									'id="paypalCurrencies"	onchange="javascript: dojo.byId(\'tax_currency\').innerHTML = this.value; "
									
									');			
				?>			
			</td>
			
			<td style="width: 24px" align="center"><span style="font-weight:bold; font-size: 16px;">+</span></td>
	
			<td align="left" valign="top" >
				<label><?php echo M4J_LANG_PAYPAL_ADD_TAX; ?></label><br/>
				<input type="text" name="tax"  style="width: 120px; float:left;" ></input>
				<span id="tax_currency" style="display:block; float:left; margin-left: 5px; <?php echo _M4J_IS_J16 ? "margin-top: 5px;" : ""; ?>"></span>			
			</td>
		</tr>
	</tbody>
</table>

<label><?php echo M4J_LANG_PAYPAL_LC; ?></label> <?php echo getInfoButton(M4J_LANG_PAYPAL_LC_DESC);?><div class="m4jCLR"></div>
<?php 
if(! isset($paypal->lc)) $paypal->lc = null;
$noCC = array( array("val"=> null, "text" => M4J_LANG_DONT_USE) );
echo MForm::select(
	"lc",
	array_merge($noCC,   m4jCountryDropDownArray(_M4J_COUNTRY_NAME_AND_ISO) ),
	"",
	MFORM_DROP_DOWN,
	null,
	'id="paypalLanguageCode" ');
			
?><br /><br />


<label><?php echo M4J_LANG_PAYPAL_RETURN_URL; ?></label><br />
<table width="100%" cellspacing="0" cellpadding="0"><tbody><tr>
<td valign="top">
	<input id="m4jPaypalReturn" type="text" name="return" style="width: 100%;" ></input>
</td>

<td style="width:80px;" valign="top">
	<div style="display:block; float:left; margin-left: 5px; margin-top: -3px;" info="<?php echo M4J_LANG_ARTICLE_LINK_INFO; ?>">
				<div class="button2-left"><div class="blank">
					<a onclick="javacsript: getArticle('m4jPaypalReturn',1);"><?php echo M4J_LANG_ARTICLES; ?></a>
				</div></div>
	</div>
</td>
</tr></tbody></table>

<br /><br />

<label><?php echo M4J_LANG_PAYPAL_CANCEL_RETURN_URL?></label><br />
<table width="100%" cellspacing="0" cellpadding="0"><tbody><tr>
<td valign="top">
<input id="m4jPaypalCancelReturn" type="text" name="cancel_return"  style="width: 100%;" ></input><br /><br />
</td>

<td style="width:80px;" valign="top" >
	<div style="display:block; float:left; margin-left: 5px; margin-top: -3px;" info="<?php echo M4J_LANG_ARTICLE_LINK_INFO; ?>">
				<div class="button2-left"><div class="blank">
					<a onclick="javacsript: getArticle('m4jPaypalCancelReturn',1);"><?php echo M4J_LANG_ARTICLES; ?></a>
				</div></div>
	</div>
</td>
</tr></tbody></table>

</fieldset>

<center><span style="font-size: 48px; color:red;"><?php echo M4J_LANG_ONLYPRO;?></span></center>

</div>
<?php //EOF PAYPAL TAB?>

<?php 
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
 * ++++ CODE TAB 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
?>

<div class="m4jTabContent" id="m4jCodeTab" style="left: -9999em;">
	<div class="m4jConfigInfo" style="margin-top:5px;margin-bottom:10px;"><?PHP echo M4J_LANG_JOBS_CODE_INFO;?></div>
	
	<div style="display:block; position: relative; ">
	<span style="display:block; z-index:200; position:absolute;">
	
		<span class="eaTab" 
			  id="tabHI" 
			  onclick="javascript: codeTab(this);"
			  onmouseover="javascript: this.style.textDecoration = 'underline';"
			  onmouseout="javascript: this.style.textDecoration = 'none';"
			  style="margin-right:-1px;">
		<?php echo M4J_LANG_FORM; ?>
		</span> 
		<span class="eaTab" 
			  onclick="javascript: codeTab(this,1);"
			  onmouseover="javascript: this.style.textDecoration = 'underline';"
			  onmouseout="javascript: this.style.textDecoration = 'none';">
		<?php echo M4J_LANG_AFTER_SENDING; ?>
		</span>
	</span>
	</div>
	<div class="m4jCLR"></div>
	<div style="position: relative; display:block; width:100%; height:420px; float:left; margin-top: 21px; z-index:1;">
		
		<div id="secondEditArea">
			<center><span style="font-size: 48px; color:red;"><?php echo M4J_LANG_ONLYPRO;?></span></center>
		</div>
		<div style="position: absolute; display:block; width:100%; height:420px; float:left; top:0px;" id="firstEditArea">
			<center><span style="font-size: 48px; color:red;"><?php echo M4J_LANG_ONLYPRO;?></span></center>
		</div>
		
	</div>

</div>
<?php //EOF CODE TAB ?>

<?php 
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
 * ++++ OPT-IN TAB 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
?>

<div class="m4jTabContent" id="m4jOptTab" style="left: -9999em;">
<div class="m4jConfigInfo" style="margin-top:5px;"><?PHP echo M4J_LANG_DOUBLE_OPTIN_DESC ;?></div>


	<center><span style="font-size: 48px; color:red;"><?php echo M4J_LANG_ONLYPRO;?></span></center>

</div>
<?php //EOF DOUBLE OPT IN TAB?>




</div>
<?php //EOF TAB WRAP ?> <input name="task" type="hidden" id="task" /> <input
	name="id" type="hidden" id="id" value="<?PHP echo $editID; ?>" /> <input
	name="former_cid" type="hidden" id="former_cid"
	value="<?PHP echo $cid; ?>" /></form>


<?php // New Job JS ?>
<script type="text/javascript" src="<?php echo M4J_JS_NEW_JOB; ?>"></script>

