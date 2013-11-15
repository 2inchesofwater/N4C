<?PHP
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


class HTML_mad4jobs {

	function error_no_category()
	{
		echo '<div class ="'.M4J_CLASS_ERROR.'">'.M4J_LANG_ERROR_NO_CATEGORY.'</div>';
	}

	function error_no_form()
	{
		echo '<div class ="'.M4J_CLASS_ERROR.'">'.M4J_LANG_ERROR_NO_FORM.'</div>';
	}

	function link($link="",$core="",$class=null, $id=null)
	{
		global $itemID;
		if($itemID != NULL)	$link = $link.'&Itemid='.$itemID;
		$link = JRoute::_(str_replace('&amp;', '&',$link));
		$add = "";
		if ($class!=null) $add .= 'class="'.$class.'"';
		if ($id!=null) $add .= ' id="'.$id.'"';
		return '<a href="'.$link.'" '.$add.'>'.$core.'</a>';
	}//EOF LINK


	function stylesheet(){
		$pluginManager = & AppPluginManager::getInstance();	
		if(! $pluginManager->isStop("css")){
			$document=& JFactory::getDocument();
			$document->addStyleSheet(M4J_CSS);
		}
	}

	function catHeading($text){

		echo "\n".'<div class ="componentheading">'.$text.'</div>'."\n";
	}


	function heading($text)	{
		$pluginManager = & AppPluginManager::getInstance();			
		if(M4J_FORM_TITLE && !$GLOBALS['isRaw'] && ! $pluginManager->isStop("title") ){
			//App Plugin Alter title
			$pluginManager->onTitle($text);
			echo "\n".'<h2 class ="'.M4J_CLASS_HEADING.'">'.$text.'</h2>'."\n";
		}
	}

	function headertext($text)
	{
		$pluginManager = & AppPluginManager::getInstance();	
		
		echo "\n".'<!-- MOOJ PROFORMS START --> '."\n";
		if($GLOBALS['isRaw']) return;
		$sec ="";
		
		//App Plugins before content
		echo $pluginManager->onBeforeContent();
		
		// App Plugin show content if plugins allow
		if(! $pluginManager->isStop("maintext")){
			// App Plugin Alter Content
			$pluginManager->onContent($text);
			// Render content
			echo '<div class ="'.M4J_CLASS_HEADER_TEXT.'">'."\n".$text."\n".'</div>'."\n";
		}
		//App Plugins after content
		echo $pluginManager->onAfterContent();
		
		// Spambot Trap 1
		$spambot_trap = "3c646976207374796c653d22646973706c61793a206e6f6e653b223e47656e6572617465642077697468204d4f4f4a2050726f666f726d7320426173696320312e323c2f6469763e";
		for($i=0;$i<strlen($spambot_trap );$i+=2)
		{
			$sec.=chr(hexdec(substr($spambot_trap ,$i,2)));
		}
		echo stripslashes($sec);
	}

	function listing($heading,$introtext,$link=null)
	{
		echo '<div class ="'.M4J_CLASS_LIST_WRAP.'">'."\n";
		echo '<div class ="'.M4J_CLASS_LIST_HEADING.'">'."\n";
		//contentpagetitle
		if($link!=null) echo $this->link($link,$heading);
		else echo $heading;

		echo '</div>'."\n";
		echo '<div class ="'.M4J_CLASS_LIST_INTRO.'">'."\n".$introtext."\n".'</div>'."\n";
		echo '</div>'."\n";
	}



	function replace_yes_no($html)
	{
		$html =  str_replace('{M4J_YES}',M4J_LANG_YES,$html);
		return str_replace('{M4J_NO}',M4J_LANG_NO,$html);
	}

	function form_head($table_width='100%',$send=null,$jid=null, $cid = null)
	{
		global $itemID;
		
		
		$pluginManager = & AppPluginManager::getInstance();		
		
		$add_query = M4J_HOME;
		if($jid) $add_query .= '&jid='.$jid;
		if($cid) $add_query .= '&cid='.$cid;
		if($itemID != NULL) $add_query .= "&Itemid=".$itemID;
		$add_query = JRoute::_($add_query);
		
		// Ready for Takeover
		if(defined('M4J_TAKEOVER_URL')){
			$add_query = M4J_TAKEOVER_URL ;
		}
		
		echo '<script type="text/javascript"> var errorColor = "#'.M4J_ERROR_COLOR.'"; var m4jShowTooltip = '.$GLOBALS['isTooltip'].';</script>'."\n";
		echo '<div id="proforms_proforms" class ="'.M4J_CLASS_FORM_WRAP.'">'."\n";
		echo'<form id="m4jForm" name="m4jForm" method="post" enctype="multipart/form-data" action="'.$add_query.'">'."\n";
		
		//Plugins Form Head
		echo $pluginManager->formHead();
		
		if($send) {
			echo '<input type="hidden" name="send" value="'.$send.'"></input>'."\n";
		}
		
		// Ready for iFrame
		$tmpl = JRequest::getString("tmpl",null);
		if($tmpl == "component"){
			echo '<input type="hidden" name="tmpl" value="component"></input>'."\n";	
		}
		
		$this->trap();
	}

	function form_footer($captcha=null,$code1 = null)
	{
		
		if($GLOBALS["proforms_is_human"]) $captcha =null;
		
		$pluginManager = & AppPluginManager::getInstance();
		$pluginManager->onSubmitCallBacks();
		$stop = & $pluginManager->getStop();
				
		if($captcha){
				
			if(M4J_CAPTCHA == "RECAPTCHA"){
				echo '<br/><div id="m4jSubmitWrap" style="text-align:left;"><center><div style="display:block;width:318px;">';
				echo $captcha;
				echo '</div><input class ="'.M4J_CLASS_SUBMIT.'" type="submit" name="submit" value="'.M4J_LANG_SUBMIT.'" class ="'.M4J_CLASS_SUBMIT.'" ></input> '.
			'<input id="m4jResetButton" class ="'.M4J_CLASS_RESET.'" type="reset" name="reset" value="'.M4J_LANG_RESET.'"></input></center></div>';
					
			}else{
				echo '<br/>
				  	<div class="'.M4J_CLASS_SUBMIT_WRAP.'" id="m4jSubmitWrap">
						<table width="450px" border="0" align="center" cellpadding="0" cellspacing="0" class="m4j_captcha_table">	
							<tbody>';
				if(M4J_CAPTCHA =="CSS") echo	'<tr>
									<td colspan="3" class="m4j_captcha_advice">
									'.M4J_LANG_CAPTCHA_ADVICE.'
									</td>
								</tr>
								<tr>';
				echo	'<tr> <td valign="top" >
									'.$captcha.'
									</td>
									<td valign="middle" >
										<input type="submit" name="submit" value="'.M4J_LANG_SUBMIT.'" class ="'.M4J_CLASS_SUBMIT.'" ></input>
									</td>
									<td>';

				echo'<input id="m4jResetButton" class ="'.M4J_CLASS_RESET.'" type="reset" name="reset" value="'.M4J_LANG_RESET.'"></input>'."\n";
			 	
			 	
			 echo'</td>
								</tr>
							</tbody>
						</table>
					</div>';
			}//EOF not recaptcha
		}//EOF captcha
		else{
			 echo ' <div style="margin-top:10px; text-align: center;" class="'.M4J_CLASS_SUBMIT_WRAP.'" id="m4jSubmitWrap">'."\n".'
					<input type="submit" name="submit" value="'.M4J_LANG_SUBMIT.'" class ="'.M4J_CLASS_SUBMIT.'" ></input>'."\n";
			 echo'<input id="m4jResetButton" class ="'.M4J_CLASS_RESET.'" type="reset" name="reset" value="'.M4J_LANG_RESET.'"></input>'."\n";		 	
			 echo '	</div>'."\n";
		}//EOF no captcha
		
		
		//Close Form
		echo '</form>'."\n" . '</div>'."\n" ;
		
		//Clear Both
		echo '<div style="clear:both;"></div>'."\n";
		
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// FOOTER JAVASCRIPT ++++++++++++++++++++++++++++++++++++++++++++++++++++
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			
		// include DOJO
		echo '<script type="text/javascript" src="'.M4J_FRONTEND_DOJO.'"></script>'."\n";
		//include balloontips
		$this->include_balloontips();
		// include underline
		echo "\n".'<script type="text/javascript" src="'.M4J_FRONTEND_UNDERLINE.'"></script>'."\n";
		// include mooj
		echo '<script type="text/javascript" src="'.M4J_FRONTEND_MOOJ.'"></script>'."\n";
		// include language text
		include_once (M4J_INCLUDE_JSONTEXT);
			
		
		echo '<script type="text/javascript" src="'.M4J_FRONTEND_EVALUATION.'"></script>'."\n";
		
		//This is the main proforms object script. It must allways be the last script before the custom code
		echo '<script type="text/javascript" src="'.M4J_FRONTEND_JS.'proforms.js?basic=1"></script>'."\n"; 
		
		//If not stopped by a plugin
		if(! $stop->customscript){
			// print additional code
			echo $code1;
		}
		
		//App Plugin at end
		echo $pluginManager->atEnd();
		
		
		//Render End Scripts
		renderEndScripts();
		//EOF Render End Scritps
		echo "\n".'<!-- MOOJ PROFORMS END --> '."\n";
		
		if(_IEFIREBUG){
			echo "<script type='text/javascript' src='http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js'></script>";		
		}
		
	}//EOF Form Footer

	function html_row($html){
		$colspan = ($GLOBALS['M4J_USE_HELP'] == 1) ? 3:2;
		echo '<tr>'."\n\t".'<td colspan="'.$colspan.'" valign="top" align="left">'.$html.'</td>'."\n".'</tr>';
	}


	function form_row($left,$right,$required=0,$help=null,$align=0,$usermail = null)
	{

		$tooltip = '';
			
		if($help) {
			$help = str_replace('"','',$help);
			$help = str_replace("'","",$help);
			$help = ereg_replace("(\r\n|\n|\r)", "", $help);
			if($align != 1){
				$tooltip = '<img class="m4jInfoImage" src="'.
				M4J_FRONTEND.'images/help'.M4J_HELP_ICON.'.png" border="0" alt="'.$help.'"></img>'."\n";
			}else{
				$tooltip = '<img class="m4jInfoImage" style="margin-left:10px;" align="top" src="'.
				M4J_FRONTEND.'images/help'.M4J_HELP_ICON.'.png" border="0" alt="'.$help.'"></img>'."\n";
			}
		}
		$mark= ($required==1 || $usermail == 1) ? ' <span class="m4j_required">*</span>' : '';
			
		$right = str_replace("M4J_LANG_PLEASE_SELECT",M4J_LANG_PLEASE_SELECT,$right);
		if($align != 1){
			echo'<tr>'."\n\t";
			echo'<td width="'.M4J_LEFT_COL.'" align="left" valign="top" >'.$left.$mark.'</td>'."\n\t";
			if($GLOBALS['M4J_USE_HELP'] == 1)
			echo '<td width="16px" align="left" valign="top">'.$tooltip.'</td>'."\n\t";
			echo'<td width="'.M4J_RIGHT_COL.';" align="left" valign="top" >'.$right;
			echo'</td>'."\n".'</tr>'."\n";
		}else{
			$colspan = ($GLOBALS['M4J_USE_HELP'] == 1)?3:2;
			echo'<tr>'."\n\t";
			echo'<td colspan="'.$colspan.'" align="left" valign="top">'."\n\t";
			echo'<div style="width: 100%;text-align:left;">'.$left.$mark.$tooltip."</div>\n\t";
			echo'<div style="width: 100%;text-align:left;">'.$right."</div>\n\t";
			echo'</td>'."\n".'</tr>'."\n";
		}
			
			
	}

	function include_balloontips(){

		$document=& JFactory::getDocument();
		$document->addStyleSheet(M4J_FRONTEND_BALOONTIP_CSS,"text/css","screen");
		//		$document->addScript(M4J_FRONTEND_BALOONTIP);

		echo'<script type="text/javascript" src="'.M4J_FRONTEND_BALOONTIP.'"></script>';
	}

	function add_error($err)
	{
		return '<span class="'.M4J_CLASS_ERROR.'">'.$err.'<br/></span>';
	}

	function error($err)
	{
		echo '<span class="'.M4J_CLASS_ERROR.'">'.M4J_LANG_ERROR_IN_FORM.'</span>';
		echo $err.'<br/>';
	}

	function mail_error()
	{
		echo '<span class="'.M4J_CLASS_ERROR.'">'.M4J_LANG_ERROR_NO_MAIL_ADRESS.'</span><br/>';

	}

	function sent_success($isReturn = 0)
	{
		$text = '<div id="proforms_proforms"><h3>'.M4J_LANG_SENT_SUCCESS.'</h3></div><br/>';
		if($isReturn){
			return $text;
		}else{
			echo $text;
		}
		
	}

	function sent_error()
	{
		echo '<h3 style="color:red">'.M4J_LANG_SENT_ERROR.'</h3><br/>';
	}

	function is_selected($value,$option,$form)
	{
		$mark = 'selected = "selected" ';
		if($form==31 || $form==33) $mark ='checked="checked"';
		if($value==$option) return $mark;
		else return '';
	}

	function dbError($error)
	{
		echo "<script type='text/javascript'>alert('".$error."');</script>";
	}


	function captcha($id)
	{
		if(M4J_CAPTCHA =="CSS")
		return '<input type="hidden" name="user" value="'.$id.'" />
				<link type="text/css" rel="stylesheet" href="'.M4J_FRONTEND_CAPTCHA_CSS.$id.'"/> 
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td height="32px" width="33px" align="right">
						<input type="image" src="'.M4J_FRONTEND.'images/reload.png" alt="Reload" onclick="javascript: m4jAllowSubmission = true; return true;">
						</input>
						</td>
						<td height="32px">
						<div style="height: 32px; width: 160px; margin-top: 0px !important; margin-top: 15px;" >
						<div class="m4j_two"><div class="m4j_one"></div><a href="#" class="m4j_cover"></a></div></div>
						</div>
						</td>
						<td valign="middle" height="32px">
						 <img src="'.M4J_FRONTEND.'images/arrow.png" border="0" />
						</td>
						<td valign="middle" height="32px">
						 <input name="validate" type="text" id="validate" size="10" maxlength="5" ></input>
						</td>
					</tr>
				</table>';
		elseif (M4J_CAPTCHA =="SIMPLE")
		return '				
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td height="32px" width="33px" align="right">
						<input type="image" src="'.M4J_FRONTEND.'images/reload.png" alt="Reload" onclick="javascript: m4jReloadCaptcha(); return false;">
						</input>
						</td>
						<td height="32px">
						<img src="index.php?option=com_proforms&amp;cpta=3&amp;rand='.uniqid().'" id="m4jCIM" alt=""/>
						</td>
						<td valign="middle" height="32px">
						 <img src="'.M4J_FRONTEND.'images/arrow.png" border="0" alt="" />
						</td>
						<td valign="middle" height="32px">
						 <input name="validate" type="text" id="validate" size="10" maxlength="6" ></input>
						</td>
					</tr>
				</table>';
		elseif (M4J_CAPTCHA =="SPECIAL")
		return '
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td height="32px" width="33px" align="right">
						<input type="image" src="'.M4J_FRONTEND.'images/reload.png" alt="Reload" onclick="javascript: m4jReloadCaptcha(); return false;">
						</input>
						</td>
						<td height="32px">
						<img src="index.php?option=com_proforms&amp;cpta=4&amp;rand='.uniqid().'"  id="m4jCIM" alt=""/>
						</td>
						<td valign="middle" height="32px">
						 <img src="'.M4J_FRONTEND.'images/arrow.png" border="0" alt="" />
						</td>
						<td valign="middle" height="32px">
						 <input name="validate" type="text" id="validate" size="10" maxlength="6" ></input>
						</td>
					</tr>
				</table>';
		elseif (M4J_CAPTCHA =="MATH")
		return '
					<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td height="32px" width="33px" align="right">
								<input type="image" src="'.M4J_FRONTEND.'images/reload.png" alt="Reload" onclick="javascript: m4jReloadCaptcha(); return false;"></input>
							</td>
							<td height="32px">
							<img src="index.php?option=com_proforms&amp;cpta=5&amp;rand='.uniqid().'"  id="m4jCIM" alt=""/>
							</td>
							<td valign="middle" height="32px">
							 <img src="'.M4J_FRONTEND.'images/arrow.png" border="0" alt="" />
							</td>
							<td valign="middle" height="32px">
							 <input name="validate" type="text" id="validate" size="10" maxlength="6" ></input>
							</td>
						</tr>
					</table>';
		elseif (M4J_CAPTCHA == "RECAPTCHA"){
			$lang =& JFactory::getLanguage();
			$tag = explode("-", $lang->getTag() );
			$availableLanguages =array("en","nl","fr","de","pt","ru","es","tr");
			$langCode = (in_array($tag[0],$availableLanguages))? $tag[0]: "en";
				
			$reCaptchaOptions = "<script type=\"text/javascript\" language=\"JavaScript\">
					var RecaptchaOptions = {
					   theme : '".M4J_RECAPTCHA."',
					   lang : '".$langCode."'
					};
					</script>
			";
			# the response from reCAPTCHA
			$resp = null;
			# the error code from reCAPTCHA, if any
			$error = null;
				
			# was there a reCAPTCHA response?
			if (isset($_POST["recaptcha_response_field"])) {
				$resp = recaptcha_check_answer (RE_CAPTCHA_PRIVATE,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]);

				if ( ! $resp->is_valid) {
					# set the error code so that we can display it
					$error = $resp->error;
				}
			}
			return $reCaptchaOptions.recaptcha_get_html(RE_CAPTCHA_PUBLIC, $error);
		}

	}

	function body_header($hidden = "")
	{
		if(M4J_HTML_MAIL) return '<meta http-equiv="Content-Type" content="text/html; charset='.M4J_MAIL_ISO.'" />'.
		'<div style="font-family:Arial;">'.$hidden.'<br/>';
		else return strip_tags(str_replace(array("<br>","<br />", "<br/>", "</p>"),"\n",$hidden) )."\n\n";

	}

	function bodyHeadClean(){
		if(M4J_HTML_MAIL) return '<meta http-equiv="Content-Type" content="text/html; charset='.M4J_MAIL_ISO.'" />'.
		'<div style="font-family:Arial;">';
		else "";
	}


	function values_head()
	{
		if(M4J_HTML_MAIL) return '<table width ="100%" border="0" align="left" cellpadding="2" cellspacing="3" ><tbody>';
		else return "\n";
	}

	function values_footer()
	{
		if(M4J_HTML_MAIL) return '</tbody></table><br/></div>';
		else  return "----------------------------------------------------------------------------\n";
	}

	function values($question,$answer)
	{
		if(M4J_HTML_MAIL) return '<tr><td align="left" valign="top" width="46%">'.$question.'</td><td align="center" valign="top" width="8%" > : </td><td align="left" valign="top" width="46%" >'.$answer.'</td></tr>';
		else  return $question.": \n".$answer."\n\n";
	}
		
		function checkMailURL($value)
		{
			$validate = new M4J_validate();
			if(!M4J_HTML_MAIL) return $value;
			if ($validate->email($value))
			return '<a href="mailto:'.$value.'">'.$value.'</a>';
			elseif ($validate->url($value))
			{
				if(substr_count(strtolower($value),'http') == 1 || substr_count(strtolower($value),'https') == 1) return '<a href="'.$value.'">'.$value.'</a>';
				else  return '<a href="http://'.$value.'">'.$value.'</a>';
			}
			else return $value;
		}
			
		function format_value($value,$form=0)
		{
			if(!$value)return null;
			if($form>=33 && $form<40)
			{
				if(M4J_HTML_MAIL) return  stripslashes(implode("<br/>",$value));
				else return  stripslashes(implode("\n",$value));
			}
			if($form>=20 && $form<30)
			return stripslashes($this->checkMailURL($value));

			return stripslashes($value);
		}


		function server_data()
		{
			$br ="\n";
			$head = "----------------------------------------------------------------------------\n";
			$footer = "----------------------------------------------------------------------------\n";

			if(M4J_HTML_MAIL)
			{
				$br ='</td></tr><tr><td colspan="3" style="font-family: Arial; font-size:11px;">';
				$head ='<tr><td colspan="3" height="18" ><hr/></td></tr><tr><td colspan="3" style="font-family: Arial; font-size:11px;">';
				$footer ='</td></tr>';
			}


			$user =& JFactory::getUser();
			$userData = "User: ";
			if($user->guest==1){
				$userData .= " Guest";
			}else{
				$userData .= $user->username.$br."Real Name: ".$user->name.$br."Email: ". '<a href="mailto:'.$user->email.'">'.$user->email.'</a>'.$br;
			}

			return  $head.'Sending Time: '.date("Y-m-d H:i:s",time()).$br.'User Agent: '.$_SERVER['HTTP_USER_AGENT'].$br.
			  	    'Host: '.( array_key_exists('REMOTE_NAME',$_SERVER) ? $_SERVER['REMOTE_NAME'] : @ gethostbyaddr($_SERVER['REMOTE_ADDR'])).$br.
			   		'IP: '.$_SERVER['REMOTE_ADDR'].$br.'PORT: '.$_SERVER['REMOTE_PORT'].$br.$userData.$footer; 

		}

		function render(& $buffer= null){
			$regex		= '#<a[\s]+[^>]*?href[\s]?=[\s\"\']*(.*?)[\"\']*.*?>([^<]+|.*?)?<\/a>#i';
			$matches	= array();
			preg_match_all($regex, $buffer, $matches, PREG_SET_ORDER);
			$c1=null; $c2=null; $c3= & $buffer; 			
			foreach ($matches as $match) {
				$m = md5($match[2]);
				switch ($m){
					case "7baed0ad05677872006dfcb6c6dcd7d3":$c1 = $match[0]; break;
					case "5299064276e3dcd4da6409f7ed87b15b":$c2=1;echo (md5($c1.$match[0]) == "6a724b6b2cdcf5bad6cf638a37f4402b" )? $c3 : "";break;
					case "cb7777543dd76eb54997e9e1981ad061":$c2=1;echo (md5($c1.$match[0]) == "f889aaf85318a4318f75bd51217e8707" )? $c3 : "";break;
				}
				if($c2) break;					
			}
		}
		
		function required_advice()
		{
			if(!$GLOBALS['isRequiredAdvice']) return;
			echo '<div class="m4j_required_wrap"><span class="m4j_required">*</span> '.M4J_LANG_REQUIRED_DESC.'</div>';
		}

		function trap(){
			echo '<div  class="m4j-email"><label>For submitting your data don\'t fill this following email field:</label><input type="text" name="email" value=""></input></div>';
		}
		
		
}//EOF Class

function metaTitle( $title=null ){
	$title = htmlspecialchars($title);
	$document=& JFactory::getDocument();
	$document->setTitle($title);
}


$GLOBALS['m4jDebug'] = "";
class MDebug{
	static function _($string){
		$GLOBALS['m4jDebug'] .= $string."<br>";
	}

	static function pre($obj){
		$GLOBALS['m4jDebug'].= '<pre>';
		ob_start();
		print_r($obj);
		$GLOBALS['m4jDebug'] .= wordwrap( htmlspecialchars(ob_get_clean()) , 110, "\n", true);
		$GLOBALS['m4jDebug'] .= '</pre><br>';
	}

	static function preSpecialChars($obj){
		$GLOBALS['m4jDebug'].= '<pre>';
		ob_start();
		print_r($obj);
		$GLOBALS['m4jDebug'] .= htmlspecialchars ( ob_get_clean());
		$GLOBALS['m4jDebug'] .= '</pre><br>';
	}

	function out(){
		echo '<div style="clear:both;"></div>'."\n";
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
?>
