

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

	defined( '_JEXEC' ) or die( 'Hozzáférés megtagadva');

	define('M4J_LANG_FORM_CATEGORIES','Kategóriák');
	define('M4J_LANG_ERROR_NO_CATEGORY','Kérés megtagadva');
	define('M4J_LANG_ERROR_NO_FORM','Kérés megtagadva');
	define('M4J_LANG_YES','Igen');		
	define('M4J_LANG_NO','Nem');	
	
	define('M4J_LANG_NO_CATEGORY','Kategória nélkül');
	define('M4J_LANG_NO_CATEGORY_LONG','Itt találhatóak az űrlapok amelyek nincsenek kategóriához rendelve');
	define('M4J_LANG_SUBMIT','Küld');
	define('M4J_LANG_MISSING','Kitöltetlen mező: ');
	define('M4J_LANG_ERROR_IN_FORM','Hiányzó adatok az űrlapban!');
	define('M4J_LANG_ERROR_NO_MAIL_ADRESS','Az árajánlat nem lett elküldve!');
	define('M4J_LANG_ERROR_CAPTCHA','Hibás ellenőrző kód!');
	define('M4J_LANG_MAIL_SUBJECT','Üzenet tárgya: ');
	define('M4J_LANG_CAPTCHA_ADVICE','Vigye a kurzórt a kép fölé hogy lássa a kódot.');
	define('M4J_LANG_REQUIRED_DESC','Kötelezően kitöltendő mezők');
	define('M4J_LANG_SENT_SUCCESS','Levelét sikeresen továbbítottuk.');
	
	//New To Version 1.1.8
	define('M4J_LANG_TO_LARGE','<br/> &nbsp;- A fájl túl nagy! Maximum: ');
	define('M4J_LANG_WRONG_ENDING','<br/> &nbsp;- Hibás formátum !<br/> &nbsp;&nbsp; Engedélyezett formátum: ');

	
	//New To Version 1.1.9
	define('M4J_LANG_SENT_ERROR','Küldés közben hiba lépett fel <br/> Sikertelen üzenet küldés!');
	
	//New to Proforms
	define ( 'M4J_LANG_ERROR_USERMAIL', 'Meg kell adnia egy érvényes e-mail címe:');
	define ( 'M4J_LANG_RESET', 'Reset');
	define ( 'M4J_LANG_REQUIRED',' van szükség, és nem lehet üres. ');
	define ( 'M4J_LANG_ERROR_PROMPT', 'Our apologies. Néhány a bevitt adatok nem érvényes, és nem lehet feldolgozni. A megfelelő mezőket jelöli.');
	define ( 'M4J_LANG_ALPHABETICAL', 'Biztos ábécé.');
	define ( 'M4J_LANG_NUMERIC',' Must be numeric. ');
	define ( 'M4J_LANG_INTEGER', 'egésznek kell lennie. ');
	define ( 'M4J_LANG_URL', 'Meg kell adni egy URL-t. ');
	define ( 'M4J_LANG_EMAIL', 'Meg kell adni egy érvényes e-mail címet.');
	define ( 'M4J_LANG_ALPHANUMERIC', 'Biztos alfanumerikus.');
	define ( 'M4J_LANG_PLEASE_SELECT', 'Kérem válasszon');
	define ( 'M4J_LANG_ASK2CONFIRM', 'Legyen szíves küld én egy visszaigazolást.');
	define ( 'M4J_LANG_ASK2CONFIRM_DESC', 'Ha bekapcsolja ezt a négyzetet, akkor fog kapni egy visszaigazoló e-mailt a benyújtott adatokat.');
	// New to Proforms 1.0.5
	define('M4J_LANG_ERROR_NO_TEMPLATE','This form hasn\'t been assigned to a form template!');
	
	// New to Proforms 1.1
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','You megerősítették a benyújtás.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','Te visszavonták a visszajelzést küld a benyújtás.');
?>