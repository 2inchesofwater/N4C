<?PHP
/**
* @name MOOJ Proforms 
* @version 1.0
* @package proforms
* @copyright Copyright (C) 2008-2010 Mad4Media. All rights reserved.
* @author Dipl. Inf.(FH) Fahrettin Kutyol
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPLF"
* Please note that some Javascript files are not under GNU/GPL License.
* These files are under the mad4media license
* They may edited and used infinitely but may not repuplished or redistributed.  
* For more information read the header notice of the js files.
**/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
remember_cid();
if($id==-1) m4jRedirect(M4J_FORMS.M4J_REMEMBER_CID_QUERY);

if(!$form = JRequest::getInt('form',null))  m4jRedirect(M4J_FORM_ELEMENTS.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.'&id='.$id);
else $form = intval($form);

include_once(M4J_INCLUDE_FUNCTIONS);
include_once(M4J_INCLUDE_FORMFACTORY);

JSText::add(array(
	"errorelement1" => M4J_LANG_ELEMENT_NO_QUESTION_ERROR . M4J_LANG_ELEMENT_NO_QUESTION_ERROR_ADDITION,
	"errorelement2" => M4J_LANG_ERROR_ALIAS
));


$error = null;
// Check if this is a html field
$isHTML = false;
if ($form>=50 && $form<60) $isHTML = true;

$question = $database->getEscaped(JRequest::getString('question',null));
$alias = $database->getEscaped(JRequest::getString('alias',null));
$isProcess = (trim($question) != "") || (trim($alias) != "" || $isHTML ) ;

$help= htmlspecialchars( $database->getEscaped( JRequest::getString('help',null) ) );
$align = JRequest::getInt('align',0);
$active = 1;
$required = JRequest::getInt("required",0);
$eid = JRequest::getInt("eid",-1);
$html = $database->getEscaped(JRequest::getString('html', null, 'default', JREQUEST_ALLOWHTML));
$slot = JRequest::getInt('slot',1);

$template_name = JRequest::getString('template_name',null);

$hidden_value = null;

$option_count = 0;
$p_array=null;
$width = '';
$maxchars = 60;
$checked = 1;
$alignment = 1;
$maxchars = 60;
$element_rows = 3;
$endings= '';
$maxsize= '';
$measure = 1024;

$parameters = '';

$use_values = JRequest::getInt('use_values',0);
$options = ''; $values = '';
makeOptionsAndValues($options,$values);


if( $isHTML && ! $question) $question = M4J_LANG_EXTRA_HTML;

// Get the layout
$query = "SELECT `layout` FROM #__m4j_forms WHERE fid='".$id."' LIMIT 1";
$database->setQuery( $query );
$result = $database->loadObject();

if($eid==-1 && ($task=='update' || $task=='edit')) m4jRedirect(M4J_FORMS.M4J_REMEMBER_CID_QUERY);

$max_sort = (int) MDB::getMax("#__m4j_formelements", "`fid`='".$id."' AND slot='".$slot."'");

switch($task)
{

	case 'new':
			
			
		$active = m4jGetParam( $_REQUEST,'active');
		$dbOptions = null;		
		switch($form)
		{

			case ($form<10):
				$parameters .= make_param('checked');
				break;
					
			case ($form>=10 && $form<20):
					$parameters .= make_param('width');
				break;
					
			case ($form>=20 && $form<30):
					
				$parameters .= make_param('maxchars');
				$parameters .= make_param('element_rows');
				$parameters .= make_param('width');
				$parameters .= make_param('hidden_value');

				break;

			case ($form>=30 && $form<40):
				
				$dbOptions = $options ."\n" . $values;
				$parameters .= make_param('element_rows');
				$parameters .= make_param('width');
				$parameters .= make_param('alignment');
				$parameters .= make_param('use_values');
				break;

			case ($form>=40 && $form<50):
					
				$parameters .= make_param('endings');
				$parameters .= make_param('maxsize');
				$parameters .= make_param('measure');
				break;

			case ($form>=50 && $form<60):
				// Do nothing
				break;



		}//EOF SWITCH FORM

		if( $isProcess )
		{
			$query = "INSERT INTO #__m4j_formelements"
			. "\n ( fid, required, active, usermail, align, question, alias, form, parameters, options, help, slot, sort_order )"
			. "\n VALUES"
			. "\n ( '".$id."', '".$required."', '".$active."', '0', '".$align."', '".$question."', '".$alias."','".$form."','".$parameters.
								"','".$dbOptions."','".$help."','".$slot."','".($max_sort+1)."' )";

			$database->setQuery($query);
			if (!$database->query()) $helpers->dbError($database->getErrorMsg());

			$insert_id = $database->insertid();

			if(!$html && !$isHTML) $html = $ff->get_html($form,$insert_id,parameters($parameters),$options,0,$required,$values,$use_values);


			$query = "UPDATE #__m4j_formelements "
			. "\n SET"
			. "\n html = '".$html."' "
			. "\n WHERE eid = ".$insert_id;

			$database->setQuery($query);
			if (!$database->query()) $helpers->dbError($database->getErrorMsg());

			m4jRedirect(M4J_FORM_ELEMENTS.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.'&id='.$id.'&template_name='.$template_name.'&slot='.$slot);
		}
		else
		{
			$error .= M4J_LANG_ELEMENT_NO_QUESTION_ERROR . M4J_LANG_ELEMENT_NO_QUESTION_ERROR_ADDITION;
		}
		break;
		//EOF NEW

			case 'edit':

				if($eid>-1)
				{
					$query = "SELECT * FROM #__m4j_formelements WHERE eid = '".$eid."' LIMIT 1";
					$database->setQuery( $query );
					$rows = $database->loadObjectList();

					$question = $rows[0]->question;
					$alias = $rows[0]->alias;
					$help= $rows[0]->help;
					$active= $rows[0]->active;
					$required = $rows[0]->required;
					$p_array = parameters($rows[0]->parameters);
					
					$dbOptions = explode("\n", $rows[0]->options);
					$options = $dbOptions[0];
					$values = (isset($dbOptions[1])) ? $dbOptions[1] : null;
					
					$align = $rows[0]->align;
					$slot = $rows[0]->slot;

					switch($form)
					{
							
					  case ($form<10):
					  	if($p_array) $checked = $p_array['checked'];
					  break;

					  case ($form>=10 && $form<20):
						if($p_array) $width = $p_array['width'];
					  break;

					  case ($form>=20 && $form<30):
					  if($p_array)
					  {
					  	$maxchars = $p_array['maxchars'];
					  	$element_rows = $p_array['element_rows'];
					  	$width = $p_array['width'];
					  	$hidden_value = isset($p_array['hidden_value']) ? $p_array['hidden_value'] : null;
					  }
					  break;

					 case ($form>=30 && $form<40):
							if($p_array){
					  	$element_rows = $p_array['element_rows'];
					  	$width = $p_array['width'];
					  	$alignment = $p_array['alignment'];
					  	$use_values = (array_key_exists('use_values',$p_array))? $p_array['use_values']:0;
					  	
					  }
					   break;
					   
					 case ($form>=40 && $form<50):
							if($p_array)
					  {
					  	$endings = (array_key_exists('endings',$p_array))? $p_array['endings']:null;
					  	$maxsize = (array_key_exists('maxsize',$p_array))? intval($p_array['maxsize']):null;
					  	$measure = (array_key_exists('measure',$p_array))? intval($p_array['measure']):1024;
					  }
					  break;

						case ($form>=50 && $form<60):
							$html = $rows[0]->html;
							break;
					}//EOF switch form
				}//EOF eid>-1

				break;
				//EOF EDIT

				
		case 'update':
			if($eid>-1)	{
					$active = m4jGetParam( $_REQUEST,'active');
					$dbOptions = null;	
					switch($form){

						case ($form<10):
							$parameters .= make_param('checked');
							break;
								
						case ($form>=10 && $form<20):
							$parameters .= make_param('width');
							break;
								
						case ($form>=20 && $form<30):
								
							$parameters .= make_param('maxchars');
							$parameters .= make_param('element_rows');
							$parameters .= make_param('width');
							$parameters .= make_param('hidden_value');
							break;

						case ($form>=30 && $form<40):
							
							$dbOptions = $options ."\n" . $values;
							$parameters .= make_param('element_rows');
							$parameters .= make_param('width');
							$parameters .= make_param('alignment');
							$parameters .= make_param('use_values');
							break;

						case ($form>=40 && $form<50):
								
							$parameters .= make_param('endings');
							$parameters .= make_param('maxsize');
							$parameters .= make_param('measure');
							break;

						case ($form>=50 && $form<60):
							// Do nothing
							break;
					}//EOF SWITCH FORM
					
					if($isProcess){

						if(!$html && !$isHTML) $html = $ff->get_html($form,$eid,parameters($parameters),$options,0,$required,$values,$use_values);
						
						$tbl = "#__m4j_formelements";
						$old = null;
						$newPos = null;
						if(MDB::slotChanged($eid,$slot)){
							$newPos = $max_sort +1;
							$old = MDB::get($tbl,"slot",MDB::_("eid",$eid));
						}
						
						$query = "UPDATE #__m4j_formelements "
						. "\n SET"
						. "\n required = '".$required."', "
						. "\n active = '".$active."', "
						. "\n usermail = '0', "
						. "\n align = '".$align."', "
						. "\n question = '".$question."', "
						. "\n alias = '".$alias."', "
						. "\n form = '".$form."', "
						. "\n parameters = '".$parameters."', "
						. "\n options = '".$dbOptions."', "
						. "\n help = '".$help."', "
						. "\n slot = '".$slot."', "
						. "\n html = '".$html."' "
						. "\n WHERE eid = ".$eid;

						$database->setQuery($query);
						if (!$database->query()) $helpers->dbError($database->getErrorMsg());

						if($newPos){
							MDB::setSortOrder($tbl,$newPos,MDB::_("eid",$eid));
							MDB::refactorOrder($tbl, MDB::_(array( "slot"=>$old[0]->slot,"fid"=>$id)));
							
						}
						
						m4jRedirect(M4J_FORM_ELEMENTS.M4J_REMEMBER_CID_QUERY.M4J_HIDE_BAR.'&id='.$id.'&template_name='.$template_name.'&slot='.$slot);
					}// EOF question is not null
					else{
						$error .= M4J_LANG_ELEMENT_NO_QUESTION_ERROR .M4J_LANG_ELEMENT_NO_QUESTION_ERROR_ADDITION;
					}//EOF question equals null
						
						
						
				}//EOF eid>-1
				break;
				//EOF UPDATE

}//EOF Switch Task

HTML_m4j::head(M4J_ELEMENT,$error);
$m4j_breadcrump = M4J_LANG_TEMPLATES.' > '.M4J_LANG_ITEMS.' > ';

switch($form)
{

	case ($form<10):
		$m4j_breadcrump .= M4J_LANG_CHECKBOX  ;
		break;

	case ($form>=10 && $form<20):
		$m4j_breadcrump .= M4J_LANG_DATE ;
		break;

	case ($form>=20 && $form<30):
		$m4j_breadcrump .= M4J_LANG_TEXTFIELD ;
		break;
			
	case ($form>=30 && $form<40):
		$m4j_breadcrump .= M4J_LANG_OPTIONS ;
		break;
			
	case ($form>=40 && $form<50):
		$m4j_breadcrump .= M4J_LANG_ATTACHMENT ;
		break;
			
	case ($form>=50 && $form<60):
		$m4j_breadcrump .= M4J_LANG_HTML ;
		break;
			
}

if(M4J_EDITFLAG==1) $helpers->caption(M4J_LANG_EDIT_ELEMENT.$helpers->span(MReady::_($template_name),'m4j_green'),null, $m4j_breadcrump.' > '. M4J_LANG_EDIT_ITEM);
else $helpers->caption(M4J_LANG_NEW_ELEMENT_LONG.$helpers->span(MReady::_($template_name),'m4j_green'),null,$m4j_breadcrump.' > '. M4J_LANG_NEW_ITEM);


if($form>=50 && $form<60){
	HTML_m4j::element_html_form_head($html,$active,'layout01',$slot);
}else{
	HTML_m4j::element_form_head($question,$alias,$align,$required,$active,$help,'layout01',$slot);
}

$optionsRightArea="";
switch($form)
{

	case ($form<10):
		HTML_m4j::element_yes_no($form,$checked);
		break;

	case ($form>=10 && $form<20):
		HTML_m4j::element_date($width);
		break;

	case ($form>=20 && $form<30):
		HTML_m4j::element_text($form,$maxchars,$element_rows,$width,0,0, $hidden_value);
		break;
			
	case ($form>=30 && $form<40):
		HTML_m4j::element_options($form,$element_rows,$width,$alignment);
		$option_count= M4J_MAX_OPTIONS;
		
//		$optionsRightArea = HTML_m4j::element_options_right($option_count,$options);
		
		$args = array(
			"options" => $options,
			"values" => $values,
			"use_values" => $use_values
		);
		$optionsRightArea = MTemplater::get(M4J_TEMPLATES."options.php",$args);
		
		
		
		break;
			
	case ($form>=40 && $form<50):
		HTML_m4j::element_attachment($endings,$maxsize,$measure);
		break;
			
	case ($form>=50 && $form<60):
		// Do nothing
		break;
}

if($form>=40 && $form<50) HTML_m4j::element_form_footer($id, $eid,$template_name,HTML_m4j::element_attachment_right());
else HTML_m4j::element_form_footer($id, $eid,$template_name, $optionsRightArea);


addScriptDeclarationAtEnd('
	dojo.addOnLoad(function(){
		dojo.byId("elementCancel").href += "&slot='.$slot.'";
	});
');

HTML_m4j::footer();

?>
