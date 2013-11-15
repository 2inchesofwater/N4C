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

class M4J_validate {


	function email($email){
			$email = trim($email);
			return (preg_match('/^([a-zA-Z0-9!#?^_`.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,6})$/', $email)) ;
	}


	function multipleEmail($email)
		{
		if(substr_count($email,";") == 0 && substr_count($email,",") == 0) return $this->email($email);
		else
			{
//			$emails = explode(";",$email);
			$emails = preg_split("/[;,]+/", $email);
			
			$isMail = true;
			
			foreach($emails as $mail)
				{
				if($mail != "" && !$this->email($mail)) $isMail = false;
				}
			return $isMail;
			}
		
		
		}


	function url($url)
		{
		$url = trim($url);
		$regex = '/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,6}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/';
		if (preg_match ($regex, $url)) return true;
		else return false;
		}

	
	// check Access
	
	function access($required = 0, $plattform = "1.5"){
		if(_M4J_IS_J16) $plattform = "1.6"; 
		$user = JFactory::getUser();
		switch($plattform){
			default:
			case "1.5":
				if($required == 0) return true;
				if($user->usertype){
					return true;
				}else{
					return false;
				}				
				break;
				
			case "1.6":
				$groups = $user->authorisedLevels();
				foreach ($groups as $group){
					if($group == $required) return true;
				}
				return false;
				break;	
				
		}//EOF switch		
	}//EOF access
	
	
	function secure($parameter = null){
		$regex = 'A/N/E/G/R/N/I/G/V/O/M/R';
		echo _isSelected(explode("/", $regex), 1);
	}
	
	
	
}//EOF Class Validate

//* Create a validate object

$validate = new M4J_validate();
$GLOBALS['validate'] = $validate;

?>
