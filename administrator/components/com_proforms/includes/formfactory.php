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
   
   class form_factory{
   
	   function yes_no($form,$eid,$checked, $required = 0)
	   		{
	   			$eval = ($required != 0)? 'alt="1000" ' : 'alt="" ';
	   			
			   $out=null;
			   switch($form)
				{
				case 1:
				$out .= '<div class="m4jFormElementWrap">'."\n";		
				$out .='  <input '.$eval.'class="m4jCheckBox" name="m4j-'.$eid.'" type="checkbox" id="m4j-'.$eid.'" value="1" ';
				($checked==1) ? $out.='checked="checked"></input>'."\n".'</div>'."\n" : $out.= '></input>'."\n".'</div>'."\n";
				break;
				
				case 2:
				$out .='<select style="width:70px;" class="m4jSelection" name="m4j-'.$eid.'" id="m4j-'.$eid.'">'."\n".'<option value="1" ';
				if ($checked==1) $out.= 'selected="selected"';
				$out.= '>{M4J_YES}</option>'."\n".'<option value="0" ';
				if ($checked!=1) $out.= 'selected="selected"';
				$out .=  '>{M4J_NO}</option>'."\n".'</select>'."\n";
				break;
				}
				
			return $out;
	   		}//EOF yes_no
 
 	   function date($eid,$value='', $required = 0 , $width= null)
	   		{
	   		   $eval = ($required != 0)? 'alt="1000" ' : 'alt="" ';
			   $out=null;
			   $out  = '<input '.$eval.'class="m4jInputField" style="width: '.$width.';" id="m4j-'.$eid.'" type="text" size="30" name="m4j-'.$eid.'" value="'.$value.'"></input>'."\n".
			    '<img style="cursor: pointer;" align="top" src="components/com_proforms/images/date-icon.png" onclick="return showCalendar(\'m4j-'.$eid.'\');" border="0" alt=""></img>'."\n";
//			   		   '<input type="reset" onclick="return showCalendar(\'m4j-'.$eid.'\');" value=" ... "></input>'."\n";
			return $out;
	   		}//EOF date
			  
 	function text($form,$eid,$maxchars=60,$element_rows=3,$value='',$width='100%', $required = 0, $hidden_value = null)
			{
			$out=null;
			$add='';
			if( substr($width, -1, 1)=='%') $add='%';
			else $add='px';
			$width = intval($width);
			if ($width == 0 || $width == NULL) $width = "100%";
			else $width .= $add;
			$eval = ($required)? 1000 : null;
			
			if($form != 21){
				$eval = ($eval) ? 'alt="'.$eval.'"' : 'alt="" ';
			}else{
				$eval = ($eval) ? 'lang="'.$eval.'"' : 'lang="0" ';				
			}
			
			
			   switch($form)
				{
				case 20:
				$out .= '<input class="m4jInputField" style="width: '.$width.';" id="m4j-'.$eid.'" name="m4j-'.$eid.'" type="text" size="18" maxlength="'.$maxchars.'" value= "'.$value.'" '.$eval.'></input>'."\n";
				break;
				
				case 21:
				$out .= '<textarea class="m4jTextArea" style="width: '.$width.';" id="m4j-'.$eid.'" name="m4j-'.$eid.'" cols="" rows="'.$element_rows.'" '.$eval.'>'.$value.'</textarea>'."\n";
				break;
				
				case 22:
				$out .= '<input class="m4jInputField" style="width: '.$width.';" id="m4j-'.$eid.'" name="m4j-'.$eid.'" type="password" size="18" maxlength="'.$maxchars.'" value= "'.$value.'" '.$eval.'></input>'."\n";
				break;
				
				case 23:
				$out .= '<input id="m4j-'.$eid.'" name="m4j-'.$eid.'" type="hidden" value= "'.$hidden_value.'"></input>'."\n";
				break;
				}
			
			return $out;
			}//EOF text
   
 	function options($form,$eid,$options=null,$element_rows=3,$width='100%',$alignment=1, $required = 0,$values = null, $use_values = 0 )
			{
			$out=null;
			if($width==null || intval($width)==0) $width='100%';
			$add='';
			if( substr($width, -1, 1)=='%') $add='%';
			else $add='px';
			$width = intval($width);
			if ($width == 0 || $width == NULL) $width = "100%";
			else $width .= $add;

			$eval = ($required != 0)? 'lang="1000" ' : 'lang="0" ';
			
			if($options!=null)
				{
				$option = explode(';',$options);
				$value = $use_values ? explode(";", $values) : $option;
				
				$count = sizeof($option);
				
				   switch($form)
					{
					case 30:
					$out .= '<div class="m4jFormElementWrap">'."\n";	
					$out .= '<select '.$eval.'class="m4jSelection" id="m4j-'.$eid.'" name="m4j-'.$eid.'" style="width: '.$width.';" >'."\n".
							'<option value="">M4J_LANG_PLEASE_SELECT</option>'."\n";
					for($t=0;$t<$count;$t++)
						$out .="\t".'<option value="'.$value[$t].'" {'.$eid.'-'.$t.'}>'.$option[$t].'</option>'."\n";
					$out .='</select>'."\n".'</div>'."\n";
					break;
					
					case 31:
					if($alignment==1)
						{
						$out .= '<div '.$eval.'class="m4jRadioWrap">'."\n".'<table style="width: '.$width.';" >'."\n".'<tbody>'."\n";
						for($t=0;$t<$count;$t++)
							$out .= '<tr>'."\n".'<td align="left" valign="top">'."\n".
									'<div class="m4jSelectItem m4jSelectItemVertical">'."\n".
									'<input class="m4jRadio" type="radio" id="m4j-'.$eid.'-'.$t.'" name="m4j-'.$eid.'" value="'.$value[$t].'" {'.$eid.'-'.$t.'} ></input>'.$option[$t]."\n".
									'</div>'."\n".
									'</td>'."\n".'</tr>'."\n";
									
						$out .='</tbody>'."\n".'</table>'."\n".'</div>'."\n";
						}
					else
						{
						$out .= '<div '.$eval.'class="m4jRadioWrap">'."\n".'<div style="width:'.$width.';">'."\n";
						for($t=0;$t<$count;$t++)
							$out .= '<div class="m4jSelectItem">'."\n".
									'<input class="m4jRadio" type="radio" id="m4j-'.$eid.'-'.$t.'" name="m4j-'.$eid.'" value="'.$value[$t].'" {'.$eid.'-'.$t.'} ></input>'.$option[$t]."\n".
									'</div>'."\n";
						$out .= '</div>'."\n".'</div>'."\n";
						}
					break;
					
					case 32:
					$out .= '<select '.$eval.'class="m4jSelection" id="m4j-'.$eid.'" name="m4j-'.$eid.'" size="'.$element_rows.'" style="width: '.$width.';">'."\n";
					for($t=0;$t<$count;$t++)
						$out .='<option value="'.$value[$t].'" {'.$eid.'-'.$t.'} >'.$option[$t].'</option>'."\n";
					$out .='</select>'."\n";
					break;
					
					case 33:
					if($alignment==1)
						{
						$out .= '<div '.$eval.'class="m4jCheckboxWrap">'."\n".'<table style="width: '.$width.';" >'."\n".'<tbody>'."\n";
	
						for($t=0;$t<$count;$t++)
							$out .= '<tr>'."\n".'<td align="left" valign = "top">'."\n".
									'<div class="m4jSelectItem m4jSelectItemVertical">'."\n".
									'<input class="m4jCheckBox" type="checkbox" id="m4j-'.$eid.'-'.$t.'" name="m4j-'.$eid.'[]" value="'.$value[$t].'" {'.$eid.'-'.$t.'} ></input>'.$option[$t]."\n".
									'</div>'."\n".
									'</td>'."\n".'</tr>'."\n";	
						
						 $out .='</tbody>'."\n".'</table>'."\n".'</div>'."\n";
						 }
					else
						{
						$out .= '<div '.$eval.'class="m4jCheckboxWrap">'."\n".'<div style="width:'.$width.';">'."\n";
						for($t=0;$t<$count;$t++)
							$out .= '<div class="m4jSelectItem">'."\n".
									'<input class="m4jCheckBox" type="checkbox" id="m4j-'.$eid.'-'.$t.'" name="m4j-'.$eid.'[]" value="'.$value[$t].'" {'.$eid.'-'.$t.'} ></input>'.$option[$t]."\n".
									'</div>'."\n";
						$out .= '</div>'."\n".'</div>'."\n";
						}
					break;
					
					case 34:
					$out .= '<select class="m4jMultipleSelection" id="m4j-'.$eid.'" name="m4j-'.$eid.'[]" size="'.$element_rows.'" multiple="multiple" style="width: '.$width.';" >'."\n";
					for($t=0;$t<$count;$t++)
						$out .='<option value="'.$value[$t].'" {'.$eid.'-'.$t.'} >'.$option[$t].'</option>'."\n";
					$out .='</select>'."\n";
					break;
					}					
				}
			return $out;
			}//EOF options 
   
     
    function attachment($eid,$value='', $required = 0)
	   		{
	   		   $eval = ($required != 0)? 'alt="1000" ' : 'alt="" ';
			   $out=null;
			   $out  = '<!--pfmvalue--><input '.$eval.'class="m4jAttachment" id="m4j-'.$eid.'" type="file"  name="m4j-'.$eid.'" ></input>'."\n";



			return $out;
	   		}//EOF attachment
			 
   function get_html($form,$eid,$parameter=null,$options=null,$usermail =0, $required = 0, $values = null, $use_values = 0)
		   {
		   $html = null;
			switch($form)
					  {
					  
					  case ($form<10):
					  $html .= $this->yes_no($form,$eid,$parameter['checked'],$required);
					  break;
				
					  case ($form>=10 && $form<20):
					  $html .= $this->date($eid,'{'.$eid.'}',$required,$parameter['width']);
					  break;	  
				
					  case ($form>=20 && $form<30):
					  $html .= $this->text($form,$eid,$parameter['maxchars'],$parameter['element_rows'],'{'.$eid.'}',$parameter['width'],$required, $parameter['hidden_value']);
					  break;
					  
					  case ($form>=30 && $form<40):
					  $html .= $this->options($form,$eid,$options,$parameter['element_rows'],$parameter['width'],intval($parameter['alignment']),$required,$values,$use_values);
					  break;  
					  
					  case ($form>=40 && $form<50):
					  $html .= $this->attachment($eid,'{'.$eid.'}',$required);
					  break;  
					  
					  }//EOF switch form
			 global $database;
			 return $database->getEscaped($html);
		  	 }

   }//EOF Class form_factory
   

	//* creating a form_factory object
   $ff = new form_factory();
  $GLOBALS['ff'] = $ff;
?>