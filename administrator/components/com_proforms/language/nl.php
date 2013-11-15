<?php
	/**
	* @version $Id: Mooj 10041 2008-03-18 21:48:13Z fahrettinkutyol $
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
	
	$m4j_lang_elements[1]= 'Checkbox';
	$m4j_lang_elements[2]= 'Ja/Nee Selectie';
	$m4j_lang_elements[10]= 'Datum';
	$m4j_lang_elements[20]= 'Tekstveld';
	$m4j_lang_elements[21]= 'Tekstgebied';
	$m4j_lang_elements[30]= 'Menu(enkelvoudige keuze)';
	$m4j_lang_elements[31]= 'Selectie Menu(enkelvoudige keuze)';
	$m4j_lang_elements[32]= 'Radiobuttons(enkelvoudige keuze)';
	$m4j_lang_elements[33]= 'Checkbox Groep(meervoudige keuze)';
	$m4j_lang_elements[34]= 'Lijst(meervoudige keuze)';
	
	
	define('M4J_LANG_FORMS','Formulieren');
	define('M4J_LANG_TEMPLATES','Templates');
	define('M4J_LANG_CATEGORY','Categorie');
	define('M4J_LANG_CONFIG','Configuratie');
	define('M4J_LANG_HELP','Info & Help');
	define('M4J_LANG_CANCEL','Annuleren');
	define('M4J_LANG_PROCEED','Doorgaan');
	define('M4J_LANG_SAVE','Opslaan');
	define('M4J_LANG_NEW_FORM','Nieuw formulier');
	define('M4J_LANG_NEW_TEMPLATE','Nieuw template');
	define('M4J_LANG_ADD','Toevoegen');
	define('M4J_LANG_EDIT_NAME','Naam en beschrijving van deze template bewerken');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Nieuw template');
	define('M4J_LANG_TEMPLATE_NAME','Naam van deze template');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Naam van deze template bewerken');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Korte beschrijving (Voor intern gebruik. Mag leeg gelaten worden.)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Korte beschrijving bewerken');
	define('M4J_LANG_DELETE','Verwijderen');
	define('M4J_LANG_DELETE_CONFIRM','Weet u zeker dat u dit item wilt verwijderen?');
	define('M4J_LANG_NEW_CATEGORY','Nieuwe categorie');
	define('M4J_LANG_NAME','Naam');
	define('M4J_LANG_SHORTDESCRIPTION','Korte beschrijving');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Items');
	define('M4J_LANG_EDIT','Bewerken');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Items -> Bewerken');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Gelieve een naam voor deze template in te voeren!');
	define('M4J_LANG_AT_LEAST_ONE','Dit item kan niet verwijderd worden<br/>Hier moet minstens &eacute;&eacute;n element aanwezig zijn.');	
	define('M4J_LANG_EDIT_ELEMENT','Element van template bewerken: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Gelieve een categorienaam in te voeren');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Gelieve een geldig e-mailadres in te voeren of het veld leeg te laten.<br/>');
	define('M4J_LANG_EMAIL','E-mail');
	define('M4J_LANG_POSITION','Rangschikking');
	define('M4J_LANG_ACTIVE','Actief');
	define('M4J_LANG_UP','Omhoog');
	define('M4J_LANG_DOWN','Omlaag');
	define('M4J_LANG_EDIT_CATEGORY','Categorie bewerken');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Elementen van template: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Voeg nieuw element in template in: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Gelieve een vraag in te voeren.');
	define('M4J_LANG_REQUIRED','Vereist');
	define('M4J_LANG_QUESTION','Vraag');
	define('M4J_LANG_TYPE','Type');
	define('M4J_LANG_YES','Ja');		
	define('M4J_LANG_NO','Nee');	
	define('M4J_LANG_ALL_FORMS','Alle formulieren');
	define('M4J_LANG_NO_CATEGORYS','Zonder categorie');
	define('M4J_LANG_FORMS_OF_CATEGORY','Formulieren uit de categorie: ');
	define('M4J_LANG_PREVIEW','Voorbeeld');
	define('M4J_LANG_DO_COPY','Kopi&euml;ren');		
	define('M4J_LANG_COPY','Kopi&euml;ren');
	define('M4J_LANG_VERTICAL','Vertikaal');
	define('M4J_LANG_HORIZONTAL','Horizontaal');
	define('M4J_LANG_EXAMPLE','Voorbeeld');
	define('M4J_LANG_CHECKBOX','Knop');	
	define('M4J_LANG_DATE','Datum');
	define('M4J_LANG_TEXTFIELD','Tekstveld');
	define('M4J_LANG_OPTIONS','Gespecifieerde opties');
	define('M4J_LANG_CHECKBOX_DESC','Een eenvoudige Ja/Nee vraag.');
	define('M4J_LANG_DATE_DESC','Gebruiker moet een datum invullen.');
	define('M4J_LANG_TEXTFIELD_DESC','Gebruiker moet een woord invullen.');
	define('M4J_LANG_OPTIONS_DESC','Gebruiker selecteert een of meer antwoorden uit de gespecificeerde items. ');
	define('M4J_LANG_CLOSE_PREVIEW','Voorbeeld sluiten');
	define('M4J_LANG_Q_WIDTH','Breedte van de vraag-kolom. (links)');
	define('M4J_LANG_A_WIDTH','Breedte van de antwoord-kolom (rechts)');
	define('M4J_LANG_OVERVIEW','Overzicht');
	define('M4J_LANG_UPDATE_PROCEED','& Doorgaan');
	define('M4J_LANG_NEW_ITEM','Nieuw item');
	define('M4J_LANG_EDIT_ITEM','Item wewerken');
	define('M4J_LANG_CATEGORY_NAME','Categorienaam');
	define('M4J_LANG_EMAIL_ADRESS','E-mailadres');
	define('M4J_LANG_ADD_NEW_ITEM','Nieuw item toevoegen:');
	define('M4J_LANG_YOUR_QUESTION','Uw vraag');
	define('M4J_LANG_REQUIRED_LONG','Vereist?');
	define('M4J_LANG_HELP_TEXT','Help Tekst. Geef gebruikers een hint of uitleg bij uw vraag. (niet noodzakelijk)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Soort knop:');
	define('M4J_LANG_ITEM_CHECKBOX','Checkbox.');
	define('M4J_LANG_YES_NO_MENU','Ja/Nee menu.');
	define('M4J_LANG_YES_ON','Ja/Aan.');
	define('M4J_LANG_NO_OFF','Nee/Uit.');
	define('M4J_LANG_INIT_VALUE','Initi&euml;le waarde:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Soort tekstveld:');
	define('M4J_LANG_ITEM_TEXTFIELD','Tekstveld');
	define('M4J_LANG_ITEM_TEXTAREA','Tekstgebied');
	define('M4J_LANG_MAXCHARS_LONG','Maximum karakters:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Uitlijning:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Breedte in pixels</b> <br/>(Voeg \'%\' toe voor percentage. Leeg = Automatisch passend)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Aantal zichtbare regels:</b><br/> (Enkel voor tekstgebied)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Menu</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Radiobuttons</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Lijst</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(enkelvoudige keuze)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Checkbox Groep</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Lijst</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(meervoudige keuze, met \'CTRL\' & linker muisknop)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Enkelvoudige keuze (Slechts &eacute;&eacute;n item kan geselecteerd worden):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Meervoudige keuze (Meerdere items kunnen geselecteerd worden):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Type van selectie:');
	define('M4J_LANG_ROWS_LIST','<b>Aantal zichtbare regels:</b><br/> (Enkel voor Lijsten)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Uitlijning: </b> <br/>(Enkel voor Radiobuttons en Checkbox Groepen)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Specifi&euml;er de antwoorden.<br/>Lege velden worden genegeerd.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Introtekst. Zal enkel getoond worden op categorie-sites.');
	define('M4J_LANG_TITLE','Titel');
	define('M4J_LANG_ERROR_NO_TITLE','Gelieve een titel in te voeren.');
	define('M4J_LANG_USE_HELP','Helptekst voor frontend hulp');
	define('M4J_LANG_TITLE_FORM','Formuliertitel');
	define('M4J_LANG_INTROTEXT','Introtekst');
	define('M4J_LANG_MAINTEXT','Hoofdtekst');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','E-mail introtekst. (Zal enkel getoond worden in e-mails.)');
	define('M4J_LANG_TEMPLATE','Template');
	define('M4J_LANG_LINK_TO_MENU','Link aan menu');
	define('M4J_LANG_LINK_CAT_TO_MENU','Link huidige categorie aan een menu');
	define('M4J_LANG_LINK_TO_CAT','Link categorie: ');
	define('M4J_LANG_LINK_TO_FORM','Link formulier: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Link om alle formulieren zonder een categorie te tonen');
	define('M4J_LANG_LINK_TO_ALL_CAT','Link om \'Alle categori&euml;en\' te tonen');
	define('M4J_LANG_CHOOSE_MENU','Kies een menu om naar te linken: ');
	define('M4J_LANG_MENU','Menu: ');
	define('M4J_LANG_NO_LINK_NAME','Gelieve een linknaam in te voeren.');
	define('M4J_LANG_PUBLISHED','Gepubliceerd:');
	define('M4J_LANG_PARENT_LINK','Bovenliggende link');
	define('M4J_LANG_LINK_NAME','Linknaam');
	define('M4J_LANG_ACCESS_LEVEL','Toegangsniveau:');
	define('M4J_LANG_EDIT_MAIN_DATA','Basisdata bewerken');
	define('M4J_LANG_LEGEND','Legende');
	define('M4J_LANG_LINK','Link');
	define('M4J_LANG_IS_VISIBLE',' is gepubliceerd');
	define('M4J_LANG_IS_HIDDEN',' is niet gepubliceerd');
	define('M4J_LANG_FORM','Formulier');
	define('M4J_LANG_ITEM','Item');
	define('M4J_LANG_IS_REQUIRED','Vereist');
	define('M4J_LANG_IS_NOT_REQUIRED','Niet wereist');
	define('M4J_LANG_ASSIGN_ORDER','Rangschikking');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Rankschikking is niet mogelijk voor \'Alle formulieren\' !<br/>');
	define('M4J_LANG_EDIT_FORM','Formulieren bewerken');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Gepubliceerd! Klik=Niet gepubliceerd');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Niet gepubliceerd! Klik=Gepubliceerd');
	define('M4J_LANG_HOVER_REQUIRED_ON','Vereist! Klik= Niet vereist');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Niet vereist! Klik= Vereist');
	define('M4J_LANG_DESCRIPTION','Beschrijving');
	define('M4J_LANG_AREA','Gebied');
	define('M4J_LANG_ADJUSTMENT','Configuratie');
	define('M4J_LANG_VALUE','Waarde');
	define('M4J_LANG_MAIN_CONFIG','Hoofdconfiguratie:');
	define('M4J_LANG_MAIN_CONFIG_DESC','U kunt alle hoofdparameters hier wijzigen. Als u alle hoofdparameters  (incl. CSS) wenst te resetten naar hun default-waarden, klik reset.');
	define('M4J_LANG_CSS_CONFIG','CSS oarameters:');
	define('M4J_LANG_CSS_CONFIG_DESC','Deze parameters zijn vereist voor visuele presentatie van de fontend. Indien u niet ervaren bent met het gebruik van (eigen) externe CSS, laat u deze waarden best ongewijzigd!');
	define('M4J_LANG_RESET','Reset');
			
	define('M4J_LANG_EMAIL_ROOT', 'Hoofd e-mailadres: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Maximum aantal antwoorden <br/> Gespecificeerde keuze: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Voorbeeld breedte: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Voorbeeld hoogte: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Duur captcha (in min): ' );
	define('M4J_LANG_HELP_ICON', 'Help icoon: ' );
	define('M4J_LANG_HTML_MAIL', 'HTML e-mail: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Toon legenda: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'Het hoofd e-mailadres wordt gebruikt indien de categorie noch het formulier een e-mailadres gespecificeerd krijgen.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Deze waarde beperkt het maximum aantal antwoorden voor een lijst \'Gespecificeerde opties\'. Deze waarde moet numeriek zijn.' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Breedte van het template-voorbeeld. Deze waarde wordt enkel gebruikt indien u geen voorbeeldbreedte specificeert in de basisdata van een template.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Hoogte van het template-voorbeeld. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Hoort bij de frontend. Deze waarde bepaalt de maximumduur van een Captcha\'s geldigheid. Indien deze duur verstrijkt, dient een nieuwe Captcha-code ingevoerd te worden, zelfs indien de voorgaande correct was.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Definieer de kleur van het help-icoon.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Kies Ja als u HTML e-mails wenst te ontvangen. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Kies Ja als u een legenda wenst te tonen in de backend.' );
	
	define('M4J_LANG_CLASS_HEADING', 'Hoofdtitel:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Tekst hoofding:' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Lijst- Wrap:' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Lijst- Titel:' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Lijst- Introtekst:' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Formulier- Wrap:' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Formulier- Tabel:' );
	define('M4J_LANG_CLASS_ERROR', 'Fouttekst:' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Verzendknop Wrap:' );
	define('M4J_LANG_CLASS_SUBMIT', 'Verzendknop:' );
	define('M4J_LANG_CLASS_REQUIRED', 'Vereist * css:' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Titel van een site ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Inhoud na de titel. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap van een lijstitem.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Titel van een lijstitem. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Introtekst van een lijstitem. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap van een formuliervak. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Tabel waarin alle formulier-items worden getoond.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - CSS class van fout-teksten. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap van de verzendknop.' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - CSS class  van de verzendknop. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - CSS class van het \' <b>*</b> \' karakter om de vereiste velden aan te geven.' );
	
	define('M4J_LANG_INFO_HELP','Info & Help');


		
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Captcha techniek: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Gewoon');
	
		//New To Version 1.1.7
	define('M4J_LANG_CONFIG_RESET','Configuratie is succesvol gereset.');
	define('M4J_LANG_CONFIG_SAVED','Configuratie is succesvol opgeslagen.');
	define('M4J_LANG_CAPTCHA_DESC', ' Er kunnen enkele problemen optreden bij het gebruik van de standaard-css-captcha in combinatie met sommige servers en templates. In dit geval hebt u het alternatief te kiezen voor een gewone captcha. Als de gewone captcha uw probleem niet oplost kies dan voor "Bijzondere"' );
	define('M4J_LANG_SPECIAL','Bijzondere');
	
	define('M4J_LANG_MAIL_ISO','E-mail tekenset');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');	
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Attachment'; 
	define('M4J_LANG_ATTACHMENT','Bestandsbijlage');
 	define('M4J_LANG_ATTACHMENT_DESC','Gebruiker kan een bestand verzenden via een formulier.');
 	define('M4J_LANG_TYPE_OF_ATTACHMENT','Vul de parameters in voor dit bestands-upload-veld:');
 	define('M4J_LANG_ALLOWED_ENDINGS','Toegelaten bestandsextensies.');
 	define('M4J_LANG_MAXSIZE','Maximum bestandsgrootte.');
 	define('M4J_LANG_BYTE','Byte');
 	define('M4J_LANG_KILOBYTE','Kilobyte');
 	define('M4J_LANG_MEGABYTE','Megabyte');
 	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Gelieve alle bestandsformaten in te voeren, zonder punt ervoor en van elkaar gescheiden door <b>een komma</b>. Als u velden leeg laat, zullen alle bestandsextensies aanvaard worden en/of alle groottes toegestaan zijn. Voor de gemakkelijkheid, kunt u kiezen uit onderstaande extensies die automatisch toegevoegd zullen worden.');
 	define('M4J_LANG_IMAGES','Afbeeldingen');
 	define('M4J_LANG_DOCS','Documenten');
 	define('M4J_LANG_AUDIO','Audio');
 	define('M4J_LANG_VIDEO','Video');            
 	define('M4J_LANG_DATA','Data');
 	define('M4J_LANG_COMPRESSED','Compressie');
 	define('M4J_LANG_OTHERS','Andere');
 	define('M4J_LANG_ALL','Alle');
	
	// New to Version 1.1.9
	define('M4J_LANG_FROM_NAME','Naam afzender');
	define('M4J_LANG_FROM_EMAIL','E-mail afzender');
	define('M4J_LANG_FROM_NAME_DESC','Vul de naam van de afzender in die in de e-mail getoond moet worden.<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','Vul het e-mailadres in die als afzender van de e-mail gebruikt moet worden.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Pas op! Alle formulieren die dit template gebruiken worden ook verwijderd!');
		
	// New to Proforms 1.0
	
	define('M4J_LANG_STORAGES','Databaserecords van het formulier: ');
	define('M4J_LANG_READ_STORAGES','Databaserecords');
	define('M4J_LANG_EXPORT','Export');
	define('M4J_LANG_CSV_EXPORT','CSV Export');
	define('M4J_LANG_WORKAREA','Werkvak');
	define('M4J_LANG_WORKAREA_DESC','Breedte in pixels van het beheerder werkvak');
	define('M4J_LANG_STORAGE_WIDTH','Breedte van een database0item');
	define('M4J_LANG_STORAGE_WIDTH_DESC','Breedte in pixels van een database-item dat wordt getoond in een databaserecord.<br> Voeg geen px or % toe!');
	define('M4J_LANG_RECEIVED','Ontvangen');
	define('M4J_LANG_PROCESS','Verwerken');
	define('M4J_LANG_DATABASE','Database');
	define('M4J_LANG_USERMAIL','Uniek e-mailadres');
	define('M4J_LANG_USERMAIL_DESC','Hiermee bepaalt u het veld met het unieke e0mailadres van de gebruiker. U kunt geen gebruik maken van de optie `Bevestigingsmail` als er geen uniek e-mailadres is gegeven. Er mag slechts &eacute;&eacute;n uniek adres per template worden gebruikt.');
	define('M4J_LANG_USERMAIL_TOOLTIP','Dit veld is een uniek e-mailadres. De status van het unieke e-mailadres is altijd `verplicht`!');
	define('M4J_LANG_MATH','Mathematisch');
	define('M4J_LANG_RE_CAPTCHA','reCAPTCHA');
	define('M4J_LANG_ITEM_PASSWORD','Wachtwoord');
	$m4j_lang_elements[22]= 'Password';
	define('M4J_LANG_MAX_UPLOAD_ALLOWED','Uw server staat een maximale uploadgrootte toe van ');
	define('M4J_LANG_CSS_EDIT', 'Wijzigen CSS');
	define('M4J_LANG_NO_FRONT_STYLESHEET','Het frontend stylesheetbestand bestaat niet! ');
	define('M4J_LANG_HTML','HTML');
	define('M4J_LANG_HTML_DESC','Geeft de mogelijkheid om eigen HTML-code te plaatsen tussen de formulierelementen.');
	$m4j_lang_elements[50]= 'HTML';
	define('M4J_LANG_EXTRA_HTML',' - EXTRA HTML - ');
	define('M4J_LANG_RESET_DESC','Herstellen van de configuratie naar de standaard instelling.');
	define('M4J_LANG_SECURITY','Captcha &amp; Veiligheid');
	define('M4J_LANG_RECAPTCHA_THEME','reCaptcha Thema');
	define('M4J_LANG_RECAPTCHA_THEME_DESC','Als u gebruik maakt van reCaptcha kunt u het thema veranderen.');
	define('M4J_LANG_SUBMISSION_TIME','Verzendsnelheid (in ms)');
	define('M4J_LANG_SUBMISSION_TIME_DESC','Deze waarde is in millisecondes, en bepaalt de toegestane tijd tussen opbouw van het formulier op het scherm en de verzending. Als die tijd korter is dan hier aangegeven, wordt de invoer als spam gemarkeerd en geweigerd.');
	define('M4J_LANG_FORM_TITLE','Toon titel');
	define('M4J_LANG_FORM_TITLE_DESC','Bepaalt of de titel van het formulier getoond wordt. Geldt alleen voor het tonen van het formulier en niet voor de lijsten van een categorie.');
	define('M4J_LANG_SHOW_NO_CATEGORY','Toon zonder categorie"');
	define('M4J_LANG_SHOW_NO_CATEGORY_DESC','Hier kunt u bepalen hoe de pseudocategorie `zonder categorie` getoond wordt. Afhankelijk van de instelling wordt dit wel of niet getoond in het  overzicht met de categorie&euml;n.');
	define('M4J_LANG_FORCE_CALENDAR','Engelse kalendar afdwingen');
	define('M4J_LANG_FORCE_CALENDAR_DESC','Bij sommige front-end taalinstellingen kan de kalender niet functioneren zoals verwacht. U kunt dan instellen dat de Engelse kalender wordt gebruikt.');
	define('M4J_LANG_LINK_THIS_CAT_ALL','Koppel een overzicht van alle categorie&euml;n aan een menu.');
	define('M4J_LANG_LINK_THIS_NO_CAT','Koppel alle formulieren van een bepaalde categorie aan een menu.');
	define('M4J_LANG_LINK_THIS_CAT','Koppel alle formulieren in de categorie \'%s\' als een lijst aan een menu.');
	define('M4J_LANG_LINK_THIS_FORM','Koppel dit formulier aan een menu.');
	define('M4J_LANG_LINK_ADVICE','U kunt categorie&euml;n en formulieren alleen met de gegeven knop [%s] aan een menu koppelen!');
	define('M4J_LANG_HELP_TEXT_SHORT','Helptekst');
	define('M4J_LANG_ROWS','Rijen');
	define('M4J_LANG_WIDTH','Breedte');
	define('M4J_LANG_ALIGNMENT','Uitlijnen');
	define('M4J_LANG_SHOW_USER_INFO','Toon gebruikers gegevens');
	define('M4J_LANG_SHOW_USER_INFO_DESC','Toon een lijst met verzamelde gebruikergegevens in een e-mail. Bijv:Joomla gebruikernaam, Joomla e-mailadres gebruiker, browser, OS, etc. Deze informatie wordt niet getoond in de bevestigingse-mail, die aan de gebruiker van het formulier wordt gestuurd.');
	define('M4J_LANG_FRONTEND','Frontend');
	define('M4J_LANG_ADMIN','Admin');
	define('M4J_LANG_DISPLAY','Toon');
	define('M4J_LANG_FORCE_ADMIN_LANG','Bepaal admin taal');
	define('M4J_LANG_FORCE_ADMIN_LANG_DESC','Normaal herkent Proform de Admin-taal. Hier kunt u een taal instellen.');
	define('M4J_LANG_USE_JS_VALIDATION','Javascript validatie');
	define('M4J_LANG_USE_JS_VALIDATION_DESC','Hier kunt u de Javascript formuliervalidatie instellen. Indien UIT, worden de velden pas na verzenden gecontroleerd.');
	define('M4J_LANG_PLEASE_SELECT','Maak een keuze');
	define('M4J_LANG_LAYOUT','Layout');
	define('M4J_LANG_DESC_LAYOUT01','Een kolom');
	define('M4J_LANG_DESC_LAYOUT02','Twee kolommen');
	define('M4J_LANG_DESC_LAYOUT03','Drie kolommen');
	define('M4J_LANG_DESC_LAYOUT04','Kop met twee kolommen en footer met &eacute;&eacute;n kolom');
	define('M4J_LANG_DESC_LAYOUT05','Kop met &eacute;&eacute;n kolom en footer met twee kolommen');
	define('M4J_LANG_USE_FIELDSET','Groepering gebruiken:');
	define('M4J_LANG_LEGEND_NAME','Legenda:');
	define('M4J_LANG_LEFT_COL','Linkerkolom:');
	define('M4J_LANG_RIGHT_COL','Rechterkolom:');
	define('M4J_LANG_FOR_POSITION',' voor positie %s');
	define('M4J_LANG_LAYOUT_POSITION','Layout positie');
	define('M4J_LANG_PAYPAL','PayPal');
	define('M4J_LANG_EMAIL_TEXT','E-mail tekst');
	define('M4J_LANG_CODE','Code');
	define('M4J_LANG_NEVER','Nooit');
	define('M4J_LANG_EVER','Ooit');
	define('M4J_LANG_ASK','Vragen');
	define('M4J_LANG_AFTER_SENDING','Na verzenden');
	define('M4J_LANG_CONFIRMATION_MAIL','Bevestigingse0mail');
	define('M4J_LANG_TEXT_FOR_CONFIRMATION','E-mail alleen-tekst voor bevestigingsmail?');
	define('M4J_LANG_SUBJECT','Onderwerp');
	define('M4J_LANG_ADD_TEMPLATE','Voeg formuliertemplate toe');
	define('M4J_LANG_INCLUDED_TEMPLATES','Geselecteerde formulier template(s)');
	define('M4J_LANG_ADVICE_USERMAIL_ERROR',"Een formulier mag slechts &eacute;&eacute;n uniek e-mailadres bevatten. U heeft al een uniek e-mailadres gekoppeld aan het template van dit formulier.");
	define('M4J_LANG_STANDARD_TEXT','Standaard tekst');
	define('M4J_LANG_REDIRECT','Omleiding');
	define('M4J_LANG_CUSTOM_TEXT','Aangepaste tekst');
	define('M4J_LANG_ERROR_NO_FORMS','U kunt alleen een formulier aanmaken indien u tenminste &eacute;&eacute;n template heeft aangemaakt. Er is nog geen formuliertemplate aangemaakt. Wilt u een nieuw formuliertemplate aanmaken?');
	define('M4J_LANG_USE_PAYPAL','Gebruik PayPal');
	define('M4J_LANG_USE_PAYPAL_SANDBOX','Gebruik PayPal Sandbox');
	define('M4J_LANG_HEIGHT','Hoogte');
	define('M4J_LANG_CLASS_RESET','Reset-knop');
	define('M4J_LANG_CLASS_RESET_DESC','<b>INPUT-Tag</b> - CSS class voor de reset-knop.');
	define('M4J_LANG_PAYPAL_PARAMETERS','Paypal configuratie');
	define('M4J_LANG_PAYPAL_ID','Uw PayPal ID (e-mail)');
	define('M4J_LANG_PAYPAL_PRODUCT_NAME','Productnaam');
	define('M4J_LANG_PAYPAL_QTY','Hoeveelheid');
	define('M4J_LANG_PAYPAL_NET_AMOUNT','Netto hoeveelheid (eenheids prijs)');
	define('M4J_LANG_PAYPAL_CURRENCY_CODE','Valutacode');
	define('M4J_LANG_PAYPAL_ADD_TAX','Plus BTW (Totaalbedrag, niet een percentage!) ');
	define('M4J_LANG_PAYPAL_RETURN_URL','Return adres na een succesvolle transactie (URL met http)');
	define('M4J_LANG_PAYPAL_CANCEL_RETURN_URL','Return adres wanneer een transactie is afgebroken (URL met http) ');
	define('M4J_LANG_SERVICE','Service');
	define('M4J_LANG_SERVICE_KEY','Servicesleutel');
	define('M4J_LANG_EDIT_KEY','Wijzig / Vernieuw sleutel');
	define('M4J_LANG_CONNECT','Verbinden');
	define('M4J_LANG_NONE','Geen');
	define('M4J_LANG_ALPHABETICAL','Alfabetisch');
	define('M4J_LANG_ALPHANUMERIC','Alfanumeriek');
	define('M4J_LANG_NUMERIC','Numeriek');
	define('M4J_LANG_INTEGER','Integer');
	define('M4J_LANG_FIELD_VALIDATION','Validatie');
	define('M4J_LANG_SEARCH','Zoeken');
	define('M4J_LANG_ANY','-ELKE-');
	define('M4J_LANG_JOBS_EMAIL_INFO','Indien u hier geen e-mailadres opgeeft, wordt het adres van de gekoppelde categorie gebruikt. <br /> Indien ook hier geen e-mailadres is toegekend, wordt het globale adres gebruikt (zie configuratie).');
	define('M4J_LANG_JOBS_INTROTEXT_INFO','De introtekst is de tekst die wordt getoond bij een (categorie) formulieroverzicht. Deze tekst verschijnt niet op het formulier zelf.');
	define('M4J_LANG_JOBS_MAINTEXT_INFO','De hoofdtekst verschijnt bovenaan het formulier.');
	define('M4J_LANG_JOBS_AFTERSENDING_INFO','Hier kunt u aangeven wat er wordt getoond na verzending van het formulier.');
	define('M4J_LANG_JOBS_PAYPAL_INFO','Na verzending kunt u de gebruiker doorsturen naar PayPal. Voer de bedragen met een decimale punt i.p.v. een komma in: 24.50 in plaats van 24,50! <br /> Als u gebruik maakt van PayPal zal de actie ingesteld bij `Na verzenden` overgeslagen worden!');
	define('M4J_LANG_JOBS_CODE_INFO','U kunt ook eigen code (HTML, JS <b> maar geen PHP </b>) aan het einde van een formulier, of na de verzendpagina toevoegen:<br /> bijv. Google Analytics of Conversion. De `Na verzenden code` wordt niet aangeroepen als u gebruik maakt van `Na verzenden doorsturen` of de PayPal functie.');
	define('M4J_LANG_ERROR_COLOR','Fout kleur');
	define('M4J_LANG_ERROR_COLOR_DESC','Als de Javascript formulier validatie een fout detecteert, wordt de rand van het veld in een afwijkende kleur getoond. Hier kunt u die kleur instellen (Hexadecimaal zonder #).');
	define('M4J_LANG_CONFIG_DISPLAY_INFO','Hier kunt u de waardes veranderen die van invloed zijn op het tonen van de frontend of de backend.');
	define('M4J_LANG_CONFIG_CAPTCHA_INFO','Hier kunt u de instellingen van de beveiligingscode (captcha) en andere beveiligingsinstellingen aanpassen.');
	define('M4J_LANG_CONFIG_RESET_INFO','Het stylesheet wordt niet hersteld naar de basiswaardes, alleen de CSS classnaam van de CSS instelling!');
	define('M4J_LANG_SERVICE_DESC1',
	'Indien u beschikt over een servicesleutel, kunt u hier toegang krijgen tot de Proforms Service Helpdesk.<br/>
	Daarvoor dient u hier de sleutel in te voeren en op te slaan. Daarna dient u verbinding te maken met de Service Helpdesk server via de knop "Connect".<br/>  
	<br/> 
	U kunt de Service Helpdesk alleen via het Admin deel van Proforms bereiken.<br/>  
	Directe toegang is niet toegestaan.<br/>  
	<br/> 
	Elke Servicesleutel is tijdelijk en kan niet meer gebruikt worden na de serviceperiode. De Servicesleutel is alleen geldig voor &eacute;&eacute;n domein / Joomla installatie. Bij het eerste bezoek aan de helpdesk wordt u gevraagd of u de sleutel wilt registreren voor het huidige domein /Joomla installatie. Als u op OK drukt krijgt u toegang tot de helpdesk. Vervolgens kunt u de helpdesk alleen bereiken met deze sleutel vanaf het admindeel van het geregistreerde domein / Joomla installatie.<br/>  
	<br/><span style="color:red"> 
	Als deze installatie (domein) zich bevindt achter een firewall, of niet publiek toegankelijk is (draait bijv. op een lokale server), kunnen wij door technische redenen geen service verlenen (zie Technical Requirements and Conditions of use).<br/>  
	</span><br/> 
	De Proforms Helpdesk biedt informatie over het product, de mogelijkheid om in contact tte komen met ons (directe verzoeken via onze website of via email worden niet gehonoreerd) en downloads voor upgradepakketten, en andere modules of plug-ins voor Mooj Proforms.<br/>  
	<br/> 
	De helpdesk is `under construction` en groeit iedere dag. Zodra de ombouw gereed is ontvangt u een update pakket dat voorziet in een automatische upgrade functie.<br/>  
	<br/> 
	De domeinbeperking geldt alleen voor de helpdeskservice. De functionaliteit van Proforms wordt niet beïnvloed.<br/> 
	<br/> 
	');
	define('M4J_LANG_SEARCH_IN',' Zoeken in ');
	
	// New To Proforms 1.0.5
	define('M4J_LANG_ORDERING','Volgorde');
	define('M4J_LANG_DESC','Nieuwste eerst');
	define('M4J_LANG_ASC','Nieuwste laatste');
	define('M4J_LANG_ERROR_NO_TEMPLATE','U moet minimaal &eacute;&eacute;n formulier template toekennen aan het formulier!');
	define('M4J_LANG_TRUNCATE','Leeg');
	define('M4J_LANG_REALLY_TRUNCATE','Weet u zeker dat u alle records wilt verwijderen?');
	define('M4J_LANG_NO_DB_RECORDS','Geen records!');
	define('M4J_LANG_SEARCH_FAIL','Er voldoen geen records aan uw zoekquery:  %s');
	define('M4J_LANG_COMMA','Komma');
	define('M4J_LANG_SEMICOLON','Puntkomma');
	define('M4J_LANG_ANSWER','Antwoord');
	define('M4J_LANG_SERVER_INFO','Server Info');
	define('M4J_LANG_PRINT','Print');
	define('M4J_LANG_STORAGE_CONFIG','Configuratie van databaserecords');
	define('M4J_LANG_TABLE_VIEW','Tabel tonen');
	define('M4J_LANG_USE_QUESTIONS','Toon vragen');
	define('M4J_LANG_USE_ALIAS','Toon alias');
	define('M4J_LANG_USE_QUESTIONS_DESC','Wordt getoond in de tabelkop en bij de kop van de export van de vragen. Indien de vraag leeg is wordt de alias getoond');
	define('M4J_LANG_USE_ALIAS_DESC','Toont de aliassen in de tabelkop en de kop van de export van de vragen. Als een alias leeg is wordt de vraag getoond.');
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR_ADDITION',' Of voer een alias in.');
	define('M4J_LANG_USE_QUESTIONS_DESC_FE','Toont de vraag. Indien een vraag leeg is wordt de alias getoond.');
	define('M4J_LANG_USE_ALIAS_DESC_FE','Toont de alias. Als de alias leeg is wordt de vraag getoond.');
	define('M4J_LANG_DATA_LISTING_CONFIRMATION','Data lijst bij bevestigings mail');
	define('M4J_LANG_DATA_LISTING','Data lijst bij standaard mail');
	define('M4J_LANG_ALIAS_ADVICE','U kunt veldwaardes toevoegen via de editor door invoer van de alias tussen accolades [ <b>{ALIAS}</b> ]. Velden zonder alias worden niet verwerkt. <br/> ATTENTIE: [De automatische insert functie kan niet 100% compatibel zijn met IE] ');
	define('M4J_LANG_INSERT_FIELD_VALUE','Voer veldwaardes in');

// New To Proforms 1.1
	define('M4J_LANG_ARTICLES','Artikelen');
	define('M4J_LANG_OPTIN_REDIRECT','Opt-In omleiding');
	define('M4J_LANG_OPTIN_MAIL','Opt-In bevestigingsmail');
	define('M4J_LANG_DOUBLE_OPTIN_DESC','Met de double-opt-in prodcedure kunt u gebruikers inzendingen laten bevestigen conform de wet in de meeste landen.<br/> U heeft voor deze functie actieve data-opslag nodig!');
	define('M4J_LANG_ARTICLE_LINK_INFO','Link naar een artikel');
	define('M4J_LANG_OPT_REDIRECT_DESC','U kunt gebruikers naar elke URL omleiden nadat ze succesvol hun inzending hebben bevestigd. Om de omleidingssite kunt u gebruikers zonodig informeren over hun succesvolle bevestiging. Als u dit veld leeg laat wordt een standaardtekst gebruikt.');
	define('M4J_LANG_OPTOUT_REDIRECT_DESC','U kunt gebruikers naar elke URL omleiden nadat ze hun bevestiging hebben ingetrokken. Op de omleidingssite kunt u gebruikers zonodig informeren over hun succesvolle intrekking. Als u dit veld leeglaat wordt een standaardtekst gebruikt.');
	define('M4J_LANG_OPTOUT_REDIRECT','Opt-Out omleiding');
	define('M4J_LANG_OPTOUT_MAIL','Opt-Out bevestigingsmail');
	define('M4J_LANG_OPTIIN_ACTIVATE','Activeer double opt-in');
	define('M4J_LANG_OPTIN_EMAIL_OPTION','Verstuur admin e-mail alleen na bevestiging gebruiker');
	define('M4J_LANG_OPTIN_EMAIL_OPTION_DESC','Als u deze optie activeert ontvangt u alleen een e-mail (de standaardmail) als de gebruiker succesvol de inzending bevestigd.');
	define('M4J_LANG_CONFIRMATION','Bevestiging');
	define('M4J_LANG_CONFIRMED','Bevestigd');
	define('M4J_LANG_NOT_CONFIRMED','Niet bevestigd');
	define('M4J_LANG_OPTIN','Opt-In');
	define('M4J_LANG_OPTOUT','Opt-Out');
	define('M4J_LANG_OPTIN_NO_CONFIRMATION_EMAIL','Geen bevestigingse-mail');
	define('M4J_LANG_OPTIN_NO_CONFIRMATION_EMAIL_DESC','Als u deze optie activeert, wordt geen bevestigingse-mail verzonden voor opt-in of opt-out. Indien geactiveerd worden gebruikers alleen omgeleid of zien de standaardbevestiging/intrekkingstekst.');
	define('M4J_LANG_OPTIN_DESC','Hier kunt u de e-mail instellen die wordt verzonden naar een gebruiker als deze succesvol een inzending bevestigd. Door het activeren van de optie `Geen bevestigingse-mail` kunt u het versturen van deze e-mail deactiveren. U kunt de gebruikelijke alias bladwijzers gebruiken voor het voorinvullen van waarden in de e-mail. Hiertoe dient u een alias in te stellen tussen accolades. Door {J_OPT_OUT} te gebruiken kunt u een link toepassen voor het intrekken van de bevestiging.');
	define('M4J_LANG_OPTOUT_DESC','Hier kunt u een e-mail instellen die wordt verzonden naar een gebruiker als deze succesvol een bevestiging intrekt. Door het activeren van de optie `Geen bevestigingse-mail` kunt u het versturen van deze e-mail deactiveren. U kunt de gebruikelijke alias bladwijzers gebruiken voor het voorinvullen van waarden in de e-mail. Hiertoe dient u een alias in te stellen  tussen accolades. Door {J_OPT_IN} te gebruiken kunt u een link toepassen voor verdere bevestiging.');
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','U heeft de inzending bevestigd op  %s.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','U heeft uw inzending op %s ingetrokken.');
	define('M4J_LANG_OPTIN_FILTER','Bevestigingsfilter');
	define('M4J_LANG_NO_OPTIN_ADVICE','U moet database-opslag activeren voor het gebruik van de double-opt-in functie. U kunt database-opslag activeren op het tabblad: %s  met de optie %s.');
	define('M4J_LANG_OPTIN_SUBJECT','Opt-In e-mailonderwerp');
	define('M4J_LANG_OPTOUT_SUBJECT','Opt-Out e-mailonderwerp');
	define('M4J_LANG_TEXT_FOR_CONFIRMATION_DESC','Als u deze optie activeert, wordt de e-mailtekst alleen toegevoegd aan bevestigingse-mails. Dit betekent dat de admin e-mail alleen de standaard inzendingslijst bevat als inzendingslijst is geactiveerd.');
	define('M4J_LANG_DATA_LISTING_CONFIRMATION_DESC','Als deze optie is geactiveerd, bevat de BEVESTIGINGSE-MAIL (als versturen bevestigingse-mail is ingesteld) de standaardlijst van alle inzendingen.');
	define('M4J_LANG_DATA_LISTING_DESC','Als deze optie is geactiveerd, bevat de HOOFD-ADMIN_EMAIL (naar de vooringestelde e-mailadres(sen)) de standaardlijst van alle inzendingen.');
	define('M4J_LANG_EMAIL_FORMAT_DESC','Vul e-mailadres(sen) voor de hoofd (admin) e-mail(s) hier in. Meerdere e-mailadressen (indien ondersteund door uw mailserver) moeten van elkaar gescheiden worden door een puntkomma [;] of een komma [,]. Test of uw mailserver puntkomma- of kammagescheiden notaties ondersteund. U kunt nooit beide notaties tegelijk gebruiken.');
	define('M4J_LANG_EMAIL_SUBJECT_DESC','Vul hier een e-mailonderwerp in. Dit onderwerp wordt ook gebruikt voor de bevestigingse-mail. U kunt invulwaarden in het onderwerp invoegen door een alias bladwijzer toe te voegen. Dit moet tussen accolades staan en aan het overeenkomende veld moet een alias zijn toegewezen.');
	define('M4J_LANG_STORAGE_MAIL_HEADING','E-mailbeheer! - Formulier');
	define('M4J_LANG_STORAGE_MAIL_DESTINATION','Bestemming');
	define('M4J_LANG_MAIL_DESTINATION','Bestemming');
	define('M4J_LANG_ALL_RECORDS','Alle records');
	define('M4J_LANG_FILTERED_RECORDS','Zoekqueries');
	define('M4J_LANG_MAIL_ONLY_CONFIRMED','Verstuur e-mail alleen naar bevestigde records.');
	define('M4J_LANG_TO','Aan');
	define('M4J_LANG_MAIL_ADDRESS_IS','E-mailadres is');
	define('M4J_LANG_UNIQUE_OF_FORM','uniek e-mailadres van het formulier');
	define('M4J_LANG_USER_MAIL_ADDRESS','e-mailadres van de Joomla gebruiker (systeemadres)');
	define('M4J_LANG_SENDING_CONDITIONS','Verzendopties');
	define('M4J_LANG_FIELD_ITEM','Velditem');
	define('M4J_LANG_PROGRESS','voortgang');
	define('M4J_LANG_SECONDS','Secondes');
	define('M4J_LANG_NORMAL','Normaal');
	define('M4J_LANG_HIGH','Hoog');
	define('M4J_LANG_PRIO','Prioriteit');
	define('M4J_LANG_SENDING_INTERVAL','Verzendinterval');
	define('M4J_LANG_MAILS_AT_ONCE','Mails gelijktijdig');
	define('M4J_LANG_SEND','Verstuur');
	define('M4J_LANG_SAVE_AS_TEMPLATE','Opslaan als sjabloon');
	define('M4J_LANG_GET_FROM_TEMPLATE','Vanaf sjabloon aanmaken');
	define('M4J_LANG_SENDING_BEGUN','Verzenden e-mail gestart');
	define('M4J_LANG_SENDING_ADVICE_1','Sluit het browservenster niet!');
	define('M4J_LANG_SENDING_ADVICE_2','Sluit deze popup niet!');
	define('M4J_LANG_SENDING_ADVICE_3','Ververs de website niet!');
	define('M4J_LANG_SENDING_ADVICE_4','Zorg dat uw sessie niet is verlopen.<br/>Als deze is verlopen, annuleer dan het verzendproces en log opnieuw in!');
	define('M4J_LANG_SENDING_ADVICE_5','Als u het verzenden wilt annuleren, kllik dan op de knop Annulerenin de rechterbovenhoek!');
	define('M4J_LANG_FOUND_STORAGE_ITEMS','Records gevonden');
	define('M4J_LANG_PROTOCOL','Protocol');
	define('M4J_LANG_NOFROMNAME','Vul een formuliernaam in.');
	define('M4J_LANG_NOFROMMAIL','Vul een Van e-mailadresin.');
	define('M4J_LANG_NOVALIDFROMADDRESS','Het Van e-mailadres is geen geldig e-mailadres.');
	define('M4J_LANG_NO_SUBJECT','Vul een onderwerp in!');
	define('M4J_LANG_OVERWRITE_DELETE','Overschrijven / Verwijderen');
	define('M4J_LANG_BODY_TOGGLE_DESC','Selecteer EERST of u HTML e-mails wilt gebruiken of niet. Bij het wisselen tussen HTML e-mail en niet-HTML e-mail wordt eenmaal aangemaakte e-mailinhoud niet overgenomen door de overeenkomende editor. Dit is omdat er andere opmaakfouten ontstaan!');
	define('M4J_LANG_FROMNAME','Van naam');
	define('M4J_LANG_FROMMAIL','Van e-mailadres');
	define('M4J_LANG_CLOSE','Sluiten');
	define('M4J_LANG_SENDING_CANCELED','Verzenden is geannuleerd!');
	define('M4J_LANG_MAIL_SENDING_END','Verzenden voltooid!');
	define('M4J_LANG_SENDING_CHUNK','Verzenden blok');
	define('M4J_LANG_SENT','Verzonden');
	define('M4J_LANG_FAILED','Niet verzonden');
	define('M4J_LANG_NOVALIDADDRESS','zonder geldig e-mailadres.');
	define('M4J_LANG_APPS_HEADING','Apps voor formulier');
	define('M4J_LANG_INSTALL_UNINSTALL','Installeren/Deinstalleren');
	define('M4J_LANG_BACKUP','Import/Export');
	define('M4J_LANG_START_EXPORT','Start export');
	define('M4J_LANG_START_IMPORT','Start import');
	define('M4J_LANG_DB_EXPORT','Database export');
	define('M4J_LANG_DB_IMPORT','Database import');
	define('M4J_LANG_IGNORE_CONFIG','Negeren configuratiegegevens');
	define('M4J_LANG_IGNORE_APPS','Negeren App-gegevens');
	define('M4J_LANG_IGNORE_RECORDS','Negeren invulwaarden');
	define('M4J_LANG_BACKUPERROR_1','Het backupbestand is niet compatibel met de PRO-versie maar met de BASIC-versie.');
	define('M4J_LANG_BACKUPERROR_2','Het backupbestand is niet compatibel met deze build (%s)');
	define('M4J_LANG_BACKUPERROR_3','Het bestand is geen Proforms backupbestand');
	define('M4J_LANG_BACKUPERROR_4','Uploaden backupbestand mislukt. Controleer of u schrijfrechten heeft op de Joomla-map "tmp".');
	define('M4J_LANG_BACKUPERROR_5','U heeft geen bestand geupload of het is geen SQL-bestand.');
	define('M4J_LANG_BACKUPERROR_6','Fout opgetreden bij verwerken backup, het bestand lijkt beschadigd of uw MySQL is niet compatibel met de backup.');
	define('M4J_LANG_EXTENSIONS','Extensies');
	define('M4J_LANG_APPS','Apps');
	define('M4J_LANG_ACTIVEAPP_DESC','Niet-actieve Apps kunnen niet worden gebruikt op formulieren en/of worden niet getoond in de  frontend als ze een frontendweergave hebben.');
	define('M4J_LANG_ADMINISTRATION','Admin');
	define('M4J_LANG_ADMINISTRATION_DESC','Als een App een algemene toepassing / beheergedeelte heeft, kunt u daar naar toe met de overeenkomende  \'Start\' knop hieronder.');
	define('M4J_LANG_START','Start');
	define('M4J_LANG_FRONTEND_VIEW_DESC','Als een App een frontendweergave heeft kunt u linken naar de frontendweergave via het standaard Joomla-menusysteem. Configuratie van de App voor elk formulier gaat via de overeenkomende  \'App\' knop op het formulieroverzichtgedeelte.');
	define('M4J_LANG_PLUGIN','Plugin');
	define('M4J_LANG_PLUGIN_DESC','Toont of de App een plugin heeft. Plugins hebben invloed op de presentatie en implementatie van formulieren. Configuratie van de App voor elk formulier gaat via de overeenkomende \'App\' knop op het formulieroverzichtgedeelte.');
	define('M4J_LANG_AUTHOR','Auteur / Info');
	define('M4J_LANG_CREATED','Geinstalleerd');
	define('M4J_LANG_VERSION','Versie');
	define('M4J_LANG_NOT_ACTIVE','Niet actief');
	define('M4J_LANG_REALLYUNINSTALL_APP','Wilt u de geselecteerde App werkelijk deinstalleren??');
	define('M4J_LANG_NOAPPSELECTED','Geen App geselecteerd!');
	define('M4J_LANG_KLICKFORACTIVATE','Klik voor activeren');
	define('M4J_LANG_KLICKFORDEACTIVATE','Klik voor deactiveren');
	define('M4J_LANG_HELPDESK','Helpdesk');
	define('M4J_LANG_TEXT','Tekst');
	define('M4J_LANG_ADDOPTION','Toevoegen optie');
	define('M4J_LANG_USEVALUES','Gebruik verschillende waarden');
	define('M4J_LANG_USEVALUES_DESC','Indien geactiveerd kunt u verschillende waarden gebruiken. Indien gedeactiveerd is de ingevulde waarde gelijk aan de tekst.  Als u `verschillende waarden` gebruikt met een blanco waarde en dit formulierelement heeft ingesteld op `verplicht`, wordt dit vertaald als niet geselecteerd. Als u het cijfer 0 (nul) gebruikt wordt het niet getoond in de database of in e-mails. Gebruik in plaats daarvan `0.0`!');
	define('M4J_LANG_ERROR_ALIAS', "Een alias moet uit tenminste 2 karakters bestaan en mag geen van de volgende karakters bevatten:\u000a   /, \\\ , ? , & , [ , ] , ( , ) , * , + , \\\", \' ");
	define('M4J_LANG_BACKUP_DESC','Vertrouw geen externe backupbestanden, tenzij ze afkomstig zijn van Mad4Media / Mooj.org of door ons zijn gecertificeerd!<br/>Externe backupbestanden kunnen kwalijke code bevatten en kunnen uw database beschadigen of uw Joomla-omgeving.<br><b>Als u een backup importeert gaan alle oude (huidige) instellingen onherstelbaar verloren!</b>');
	define('M4J_LANG_INFO','Informatie');
	define('M4J_LANG_NOAPPFORJID','Er is geen App met frontendweergave (geactiveerd) voor dit formulier');
	define('M4J_LANG_ITEM_HIDDEN','Verborgen veld');
	$m4j_lang_elements[23]= 'Verborgen veld';
	define('M4J_LANG_PAYPAL_LC','Taal-Landcode');
	define('M4J_LANG_PAYPAL_LC_DESC','U kunt de taal instellen die de PayPal-startpagina zal gebruiken. Paypal gebruiktlandcodes in plaats van taalcodes. PayPal ondersteunt ook een klein aantal landcodes. Als u een niet ondersteunde landcode instelt, gebruikt PayPal in plaats daarvan `US` (Amerikaans Engels). Als u geen landcode gebruikt, toont Paypal de taal die gedetecteerd wordt door de browser van de gebruiker (indien ondersteund anders Engels).');
	define('M4J_LANG_DONT_USE','Niet gebruiken');
	define('M4J_LANG_IMPORTANT_INFO','Belangrijke informatie');
	define('M4J_LANG_IMPORTANT_INFO_INNER','E-mailbeheer gebruikt een nieuwe techniek voor het snel verzenden groepsmail.<br/> Als u `Sendmail` of `PHPmail` in de Joomla-configuratie heeft ingesteld en groepsmail in te kleine intervallen verstuurt is het mogelijk dat uw hostingprovider dit interpreteert als spam door een gekaapte website. <br/> Er zijn hostingproviders die uw website en alle andere websites op dit IP-adres onmiddelijk voor een tijd sluiten of totdat u contact met hen opneemt. Gedurende deze tijd kan niemand uw website(s) benaderen..<br/> Daarom adviseren we altijd de `SMTP` methode te gebruiken voor groepsmail en verzendintervallen te kiezen waarbij elk blok pas start met verzenden als het vorige blok is voltooid.<br/>Lees voor het gebruiken van de e-mailbeheerder voor het versturen van groepsmail de bijbehorende handleiding. Beschikbaar in het Engels via de Helpdesk.<br/><b>In verband met de GPL licentie is er geen garantie voor deze software.<br/>Mad4Media is niet aansprakelijk voor welke schade dan ook als gevolg van het gebruik van deze software</b>');
	define('M4J_LANG_APPINSTALL_SUCCESS','App is succesvol ge&iuml;stalleerd! ');
	define('M4J_LANG_APPUNINSTALL_SUCCESS','App is succesvol gede&iuml;stalleerd! ');
	define('M4J_LANG_PATCHINSTALL_SUCCESS','Patch is succesvol ge&iuml;stalleerd! ');	
	define('M4J_LANG_BACKUP_SUCCESS','Uw Proforms database is succesvol hersteld! ');
	define('M4J_LANG_ONLYPRO','Alleen voor PRO versie!');
	define('M4J_LANG_ONLYPRO_DESC','<span style=\'color:red; font-weight:bold\'>Deze functie is alleen beschikbaar voor de PRO versie!</span>');
	define('M4J_LANG_ONLYONETEMPLATE','Met de Basic versie kunt u slechts EEN formuliersjabloon toewijzen. <br> In de PRO versie kunt u uw formulier vanuit verschillende sjablonen samenstellen!');
?>