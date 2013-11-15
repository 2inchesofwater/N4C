<?PHP
	/**
	* @version $Id: proforms 10041 2008-03-18 21:48:13Z fahrettinkutyol $
	* @package joomla
	* @copyright Copyright (C) 2008 Mad4Media. All rights reserved.
	* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
	* Joomla! is free software. This version may have been modified pursuant
	* to the GNU General Public License, and as distributed it includes or
	* is derivative of works licensed under the GNU General Public License or
	* other free or open source software licenses.
	* See COPYRIGHT.php for copyright notices and details.
	* @copyright (C) mad4media , www.mad4media.de
	*/

	/**  ENGLISH VERSION. NEEDS TO BE TRANSLATED */

	defined( '_JEXEC' ) or die( 'Direktni dostop do naslova ni dovoljen.' );

	define('M4J_LANG_FORM_CATEGORIES','Kategorije formularja');
	define('M4J_LANG_ERROR_NO_CATEGORY','Željena kategorija formularja ne obstaja ali ni objavljena');
	define('M4J_LANG_ERROR_NO_FORM','Izbrani formular ne obstaja ali ni objavljen');
	define('M4J_LANG_YES','Da');		
	define('M4J_LANG_NO','Ne');	
	
	define('M4J_LANG_NO_CATEGORY','Formular ne pripada nobeni kategoriji.');
	define('M4J_LANG_NO_CATEGORY_LONG','Tu lahko najdeš vse formularje katerim ni dodeljena kategorija.');
	define('M4J_LANG_SUBMIT','pošlji');
	define('M4J_LANG_MISSING','Manjkajoèe polje: ');
	define('M4J_LANG_ERROR_IN_FORM','Manjkajoèa zahtevana informacija:');
	define('M4J_LANG_ERROR_NO_MAIL_ADRESS','Za ta formular ni doloèen prejemnikov e-naslov. Sporoèila ni možno poslati.');
	define('M4J_LANG_ERROR_CAPTCHA','Napaèna varnostna koda!');
	define('M4J_LANG_MAIL_SUBJECT','Zadeva: ');
	define('M4J_LANG_CAPTCHA_ADVICE','Z miškinim kazalcem preletite levo sliko, ter prepišite varnostno kodo v desno vnosno polje.');
	define('M4J_LANG_REQUIRED_DESC','Obvezni podatki.');
	define('M4J_LANG_SENT_SUCCESS','Uspešno poslano.');
	
	//New To Version 1.1.8
	define('M4J_LANG_TO_LARGE','<br/> &nbsp;- Datoteka je prevelika ! Najveèja velikost: ');
	define('M4J_LANG_WRONG_ENDING','<br/> &nbsp;- Manjka datoteèna konènica !<br/> &nbsp;&nbsp; Dovoljene konènice: ');
	
	//New To Version 1.1.9
	define('M4J_LANG_SENT_ERROR','Med pošiljanjem sporoèila je prišlo do neznane napake.<br/> Sporoèilo ni bilo poslano!');
	
		
	//New To Proforms
	define('M4J_LANG_ERROR_USERMAIL','Vpiši veljaven e-naslov: ');
	define('M4J_LANG_RESET','reset');
	define('M4J_LANG_REQUIRED','Obvezno, ne sme biti prazno!');
	define('M4J_LANG_ERROR_PROMPT','Se opravièujemo. Nekateri vnešeni podatki niso veljavni in jih ni mogoèe obdelati. Neveljavna polja so oznaèena.');
	define('M4J_LANG_ALPHABETICAL','Obvezno z abecedo.');
	define('M4J_LANG_NUMERIC','Obvezno s številkami.');
	define('M4J_LANG_INTEGER','Mora biti celo število.');
	define('M4J_LANG_URL','Mora biti URL.');
	define('M4J_LANG_EMAIL','Mora biti veljaven e-naslov.');
	define('M4J_LANG_ALPHANUMERIC','Mora biti alfanumerièno.');
	define('M4J_LANG_PLEASE_SELECT','Prosim izberi');
	define('M4J_LANG_ASK2CONFIRM','Prosim pošlji mi potrditev.');
	define('M4J_LANG_ASK2CONFIRM_DESC','Èe obkjlukaš, boš prejel potrditveno e-pošto z vsebujoèimi podatki.');
	
	// New to Proforms 1.0.5
	define('M4J_LANG_ERROR_NO_TEMPLATE','This form hasn\'t been assigned to a form template!');
	
	// New to Proforms 1.1
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','ste potrdili vašo prijavo.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','ste prekliče potrditev vašo prijavo.');
?>