

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

	defined( '_JEXEC' ) or die( 'Priamy prístup k tejto stránke je zakáný');

	define('M4J_LANG_FORM_CATEGORIES','Formulárové kategórie');
	define('M4J_LANG_ERROR_NO_CATEGORY','Vyžiadaná kategória neexistuje, alebo nebola publikovaná.');
	define('M4J_LANG_ERROR_NO_FORM','Vyžiadaná formulár neexistuje, alebo nebol publikovaná.');
	define('M4J_LANG_YES','Áno');		
	define('M4J_LANG_NO','Nie');	
	
	define('M4J_LANG_NO_CATEGORY','Bez kategórie');
	define('M4J_LANG_NO_CATEGORY_LONG','Tu môžte najsť všetky formuláre, ktoré niesu priradené ku kategórie.');
	define('M4J_LANG_SUBMIT','Poslať');
	define('M4J_LANG_MISSING','Chýbajúce pole: ');
	define('M4J_LANG_ERROR_IN_FORM','Chýbajúce požadované informácie:');
	define('M4J_LANG_ERROR_NO_MAIL_ADRESS','Nieje určená cieľová adresa pre tento formulár, správa nemohla byť zaslaná.');
	define('M4J_LANG_ERROR_CAPTCHA','Zlý bezpeznostný kód, alebo vypršanie validity!');
	define('M4J_LANG_MAIL_SUBJECT','Formulárová správa: ');
	define('M4J_LANG_CAPTCHA_ADVICE','Prejdite myšou nad textové pole a napíšte bezpečnostný kód.');
	define('M4J_LANG_REQUIRED_DESC','Vyžadované informácie.');
	define('M4J_LANG_SENT_SUCCESS','Správa bola úspešne zaslaná.');
	
	//New To Version 1.1.8
	define('M4J_LANG_TO_LARGE','<br/> &nbsp;- Súbor je príliš veľký! Maximum: ');
	define('M4J_LANG_WRONG_ENDING','<br/> &nbsp;- Zlá prípona súboru !<br/> &nbsp;&nbsp; Povolené prípony: ');

	
	//New To Version 1.1.9
	define('M4J_LANG_SENT_ERROR','Počas posielania sa vyskytla chyba... <br/> Email nebol zaslaný!');
	
	//New to Proforms
	define ( 'M4J_LANG_ERROR_USERMAIL', 'Musíte zadať platnú e-mailovú adresu:');
	define ( 'M4J_LANG_RESET', 'reset');
	define ( 'M4J_LANG_REQUIRED', 'Je potrebné, a nesmie byť prázdna.');
	define ( 'M4J_LANG_ERROR_PROMPT', 'naše ospravedlnenie. Niektoré zadanej údaje nie sú platné a nemôžu byť spracované. zodpovedajúce polia sú označené.');
	define ( 'M4J_LANG_ALPHABETICAL', 'musia byť abecedy.');
	define ( 'M4J_LANG_NUMERIC', 'musia sa údaj.');
	define ( 'M4J_LANG_INTEGER', 'musia byť celé číslo.');
	define ( 'M4J_LANG_URL', 'musia byť URL.');
	define ( 'M4J_LANG_EMAIL', 'musia byť platnú e-mailovú adresu.');
	define ( 'M4J_LANG_ALPHANUMERIC', 'musia byť alfanumerické.');
	define ( 'M4J_LANG_PLEASE_SELECT', 'Vyberte');
	define ( 'M4J_LANG_ASK2CONFIRM', 'Prosím pošlite mi potvrdenie.');
	define ( 'M4J_LANG_ASK2CONFIRM_DESC', 'Ak aktivujete toto políčko, dostanete potvrdzovací e-mail z predložených údajov.');
	// New to Proforms 1.0.5
	define('M4J_LANG_ERROR_NO_TEMPLATE','This form hasn\'t been assigned to a form template!');
	
	// New to Proforms 1.1
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','Ty potvrdili svoje podanie.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','Máte zrušené potvrdenie vášho podania.');
?>