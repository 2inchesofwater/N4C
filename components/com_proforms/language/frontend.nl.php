
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

	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

	define('M4J_LANG_FORM_CATEGORIES','Formulier Categori&euml;n');
	define('M4J_LANG_ERROR_NO_CATEGORY','Gevraagde formulier categorie bestaat niet of is niet gepubliceerd');
	define('M4J_LANG_ERROR_NO_FORM','Gevraagd formulier bestaat niet of is niet gepubliceerd');
	define('M4J_LANG_YES','Ja');		
	define('M4J_LANG_NO','Nee');	
	
	define('M4J_LANG_NO_CATEGORY','Zonder Categorie');
	define('M4J_LANG_NO_CATEGORY_LONG','Hier kunt u alle formulieren vinden die niet aan een categorie zijn toegewezen.');
	define('M4J_LANG_SUBMIT','Verzenden');
	define('M4J_LANG_MISSING','Ontbrekende velden: ');
	define('M4J_LANG_ERROR_IN_FORM','Ontbrekende vereiste informatie:');
	define('M4J_LANG_ERROR_NO_MAIL_ADRESS','Er is geen bestemmingsadres voor dit formulier. Bericht kon niet worden verzonden.');
	define('M4J_LANG_ERROR_CAPTCHA','Ontbrekende veiligheidscode of geldigheidsduur verlopen!');
	define('M4J_LANG_MAIL_SUBJECT','Formulierbericht: ');
	define('M4J_LANG_CAPTCHA_ADVICE','Beweeg met de muis over de afbeelding en vul de veiligheidscode die verschijnt in het tekstveld in.');
	define('M4J_LANG_REQUIRED_DESC','Vereiste informatie.');
	define('M4J_LANG_SENT_SUCCESS','Informatie succesvol verzonden.');

	//New To Version 1.1.8
   define('M4J_LANG_TO_LARGE','<br/> &nbsp;- Bestand is te groot! Maximum: ');
   define('M4J_LANG_WRONG_ENDING','<br/> &nbsp;- Bestandsformaat komt niet overeen!<br/> &nbsp;&nbsp; Toegelaten extensies: ');
   	
	//New To Version 1.1.9
	define('M4J_LANG_SENT_ERROR','Tijdens het verzenden is een fout opgetreden. <br/> Bericht is niet verzonden!');
		
	//New To Proforms
	define ( 'M4J_LANG_ERROR_USERMAIL', 'U moet een geldig e-mailadres in te voeren:');
	define ( 'M4J_LANG_RESET', 'Reset');
	define ( 'M4J_LANG_REQUIRED', 'noodzakelijk en mag niet leeg zijn.');
	define ( 'M4J_LANG_ERROR_PROMPT', 'Onze excuses. Enkele van de ingevoerde gegevens zijn niet geldig en kunnen niet worden verwerkt. De bijbehorende velden zijn gemarkeerd.');
	define ( 'M4J_LANG_ALPHABETICAL', 'moet worden alfabetisch.');
	define ( 'M4J_LANG_NUMERIC', 'moet numeriek zijn. ');
	define ( 'M4J_LANG_INTEGER', 'moet een geheel getal.');
	define ( 'M4J_LANG_URL', 'moet een URL.');
	define ( 'M4J_LANG_EMAIL', 'moet een geldig e-mailadres.');
	define ( 'M4J_LANG_ALPHANUMERIC', 'moet alfanumerieke.');
	define ( 'M4J_LANG_PLEASE_SELECT', 'Selecteer');
	define ( 'M4J_LANG_ASK2CONFIRM', 'Stuur mij een bevestiging.');
	define ( 'M4J_LANG_ASK2CONFIRM_DESC', 'Door dit selectievakje te activeren krijgt u een bevestigingsmail van de verstuurde gegevens.');
	// New to Proforms 1.0.5
	define('M4J_LANG_ERROR_NO_TEMPLATE','Dit formulier is niet gekoppeld aan een template!');
	
	// New to Proforms 1.1
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','U hebt bevestigd inzending.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','U heeft de intrekking van de bevestiging van uw inzending.');
	
?>