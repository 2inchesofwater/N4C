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

	/**  ENGLISH VERSION. NEEDS TO BE TRANSLATED */


	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
	
	$m4j_lang_elements[1]= 'Checkbox';
	$m4j_lang_elements[2]= 'Selezione Si/No';
	$m4j_lang_elements[10]= 'Data';
	$m4j_lang_elements[20]= 'Campo testo';
	$m4j_lang_elements[21]= 'Textarea';
	$m4j_lang_elements[30]= 'Menu(a scelta singola)';
	$m4j_lang_elements[31]= 'Menu selezione(a scelta singola)';
	$m4j_lang_elements[32]= 'Radiobutton(a scelta singola)';
	$m4j_lang_elements[33]= 'Checkbox(a scelta multipla)';
	$m4j_lang_elements[34]= 'Lista(a scelta multipla)';
	
	
	define('M4J_LANG_FORMS','Formulari');
	define('M4J_LANG_TEMPLATES','Modelli');
	define('M4J_LANG_CATEGORY','Categoria');
	define('M4J_LANG_CONFIG','Configurazione');
	define('M4J_LANG_HELP','Info & Aiuto');
	define('M4J_LANG_CANCEL','Cancella');
	define('M4J_LANG_PROCEED','Procedi');
	define('M4J_LANG_SAVE','Salva');
	define('M4J_LANG_NEW_FORM','Nuovo Formulario');
	define('M4J_LANG_NEW_TEMPLATE','Nuovo modello');
	define('M4J_LANG_ADD','Aggiungi');
	define('M4J_LANG_EDIT_NAME','Modifica nome e descrizione modello');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Nuovo modello');
	define('M4J_LANG_TEMPLATE_NAME','Nome di questo modello');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Modifica nome di questo modello');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Descrizione breve (per uso interno: non indispensabile)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Modifica descrizione breve');
	define('M4J_LANG_DELETE','Cancella');
	define('M4J_LANG_DELETE_CONFIRM','Vuoi veramente cancellare questa voce?');
	define('M4J_LANG_NEW_CATEGORY','Nuova Categoria');
	define('M4J_LANG_NAME','Nome');
	define('M4J_LANG_SHORTDESCRIPTION','Descrizione breve');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Voci');
	define('M4J_LANG_EDIT','Modifica');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Voci -> Modifica');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Prego inserire un nome per questo modello!');
	define('M4J_LANG_AT_LEAST_ONE','Questa voce non pu&ograve; essere cancellata!<br/>Ci deve essere almeno un elemento qui.');	

	
	define('M4J_LANG_EDIT_ELEMENT','Modifica elemento del modello: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Prego inserire nome categoria');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Prego inserire un valido indirizzo email oppure lasciar vuoto.<br/>');
	define('M4J_LANG_EMAIL','Email');
	define('M4J_LANG_POSITION','Riordina');
	define('M4J_LANG_ACTIVE','Attiva');
	define('M4J_LANG_UP','Su');
	define('M4J_LANG_DOWN','Gi&ugrave;');
	define('M4J_LANG_EDIT_CATEGORY','Modifica Categoria');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Elementi del Modello: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Inserisci nuovo elemento al modello: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Prego inserire una domanda.');
	define('M4J_LANG_REQUIRED','Richiesto');
	define('M4J_LANG_QUESTION','Domanda');
	define('M4J_LANG_TYPE','Tipo');
	define('M4J_LANG_YES','Si');		
	define('M4J_LANG_NO','No');	
	define('M4J_LANG_ALL_FORMS','Tutti i formulari');
	define('M4J_LANG_NO_CATEGORYS','Senza Categoria');
	define('M4J_LANG_FORMS_OF_CATEGORY','Formulario della Categoria: ');
	define('M4J_LANG_PREVIEW','Anteprima');
	define('M4J_LANG_DO_COPY','Copia');		
	define('M4J_LANG_COPY','Copia');
	define('M4J_LANG_VERTICAL','Verticale');
	define('M4J_LANG_HORIZONTAL','Orizzontale');
	define('M4J_LANG_EXAMPLE','Esempio');
	define('M4J_LANG_CHECKBOX','Spunta');	
	define('M4J_LANG_DATE','Data');
	define('M4J_LANG_TEXTFIELD','Campo testo');
	define('M4J_LANG_OPTIONS','Scelta');
	define('M4J_LANG_CHECKBOX_DESC','Semplice domanda con risposta Si/No.');
	define('M4J_LANG_DATE_DESC','L\'utente deve inserire una data.');
	define('M4J_LANG_TEXTFIELD_DESC','L\'utente deve inserire del testo.');
	define('M4J_LANG_OPTIONS_DESC','L\'utente seleziona una o pi&ugrave; risposte dalle voci specificate. ');
	define('M4J_LANG_CLOSE_PREVIEW','Chiudi anteprima');
	define('M4J_LANG_Q_WIDTH','Larghezza della colonna contenente le domande (parte sinistra)');
	define('M4J_LANG_A_WIDTH','Larghezza della colonna contenente le risposte (parte destra)');
	define('M4J_LANG_OVERVIEW','Visualizza');
	define('M4J_LANG_UPDATE_PROCEED','& Procedi');
	define('M4J_LANG_NEW_ITEM','Nuova voce');
	define('M4J_LANG_EDIT_ITEM','Edita voce');
	define('M4J_LANG_CATEGORY_NAME','Nome Categoria');
	define('M4J_LANG_EMAIL_ADRESS','Indirizzo Email');
	define('M4J_LANG_ADD_NEW_ITEM','Aggiungi nuova voce:');
	define('M4J_LANG_YOUR_QUESTION','La tua domanda');
	define('M4J_LANG_REQUIRED_LONG','Richiesta?');
	define('M4J_LANG_HELP_TEXT','Testo di aiuto. Fornisci un aiuto riguardante la domanda (non indispensabile)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Tipo di spunta:');
	define('M4J_LANG_ITEM_CHECKBOX','Checkbox.');
	define('M4J_LANG_YES_NO_MENU','Menu Si/No.');
	define('M4J_LANG_YES_ON','Si/On.');
	define('M4J_LANG_NO_OFF','No/Off.');
	define('M4J_LANG_INIT_VALUE','Valore iniziale:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Tipo di campo testo:');
	define('M4J_LANG_ITEM_TEXTFIELD','Textfield (a riga singola)');
	define('M4J_LANG_ITEM_TEXTAREA','Textarea (a pi&ugrave; righe)');
	define('M4J_LANG_MAXCHARS_LONG','Massimo numero caratteri:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Allineamento testo:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Larghezza in Pixel</b> <br/>(Aggiungi \'%\' per impostare larghezza in percenutale. Vuoto =&gt; Larghezza automatica)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Numero righe visibili:</b><br/> (Solo per Textarea)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Menu</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Radiobuttons</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Lista</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(scelta singola)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Checkbox Group</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Lista</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(scelta multipla, premendo \'CTRL\' e sinistro mouse');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Scelta singola (Solo una voce pu&ograve; essere selezionata):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Scelta multipla (Possono essere selezionate pi&ugrave; voci):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Tipo di selezione:');
	define('M4J_LANG_ROWS_LIST','<b>Numero righe visibili:</b><br/> (Solo per le Liste)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Allineamento: </b> <br/>(Solo per Radiobuttons e Checkbox Groups)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Specifica la risposta.<br/>Se vuota, viene ignorata.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Testo introduttivo. Viene visualizzato solo sulle categorie.');
	define('M4J_LANG_TITLE','Titolo');
	define('M4J_LANG_ERROR_NO_TITLE','Prego specificare un titolo.');
	define('M4J_LANG_USE_HELP','Testo di aiuto per il suggerimento (baloontip)');
	define('M4J_LANG_TITLE_FORM','Titolo formulario');
	define('M4J_LANG_INTROTEXT','Testo introduttivo');
	define('M4J_LANG_MAINTEXT','Testo principale');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Testo introduttivo riportato nell\'email che sar&agrave; generata');
	define('M4J_LANG_TEMPLATE','Modello');
	define('M4J_LANG_LINK_TO_MENU','Inserisci Link al Menu');
	define('M4J_LANG_LINK_CAT_TO_MENU','Inserisci Link al Menu per la Categoria corrente');
	define('M4J_LANG_LINK_TO_CAT','Link Categoria: ');
	define('M4J_LANG_LINK_TO_FORM','Link Formulario: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Link per visualizzare tutti i Formulari senza categoria ');
	define('M4J_LANG_LINK_TO_ALL_CAT','Link per visualizzare \'Tutte le categorie\'');
	define('M4J_LANG_CHOOSE_MENU','Scegli un menu da linkare: ');
	define('M4J_LANG_MENU','Menu: ');
	define('M4J_LANG_NO_LINK_NAME','prego inserire il nome del link.');
	define('M4J_LANG_PUBLISHED','Pubblicato:');
	define('M4J_LANG_PARENT_LINK','Link precedente');
	define('M4J_LANG_LINK_NAME','Nome Link');
	define('M4J_LANG_ACCESS_LEVEL','Access Level:');
	define('M4J_LANG_EDIT_MAIN_DATA','Modifica valori principali');
	define('M4J_LANG_LEGEND','Legenda');
	define('M4J_LANG_LINK','Link');
	define('M4J_LANG_IS_VISIBLE',' &egrave; pubblicato');
	define('M4J_LANG_IS_HIDDEN',' non &egrave; pubblicato');
	define('M4J_LANG_FORM','Formulario');
	define('M4J_LANG_ITEM','Item');
	define('M4J_LANG_IS_REQUIRED','Richiesto');
	define('M4J_LANG_IS_NOT_REQUIRED','Non richiesto');
	define('M4J_LANG_ASSIGN_ORDER','Riordina');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Riordino non possibile per \'Tutti i Formulari\' !<br/>');
	define('M4J_LANG_EDIT_FORM','Modifica Formulari');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Pubblicato! Click=&gt;rimuovi pubblicazione');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Non pubblicato! Click=&gt;pubblica');
	define('M4J_LANG_HOVER_REQUIRED_ON','Richiesto! Click=&gt;non richiesto');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Non richiesto! Click=&gtk;richiesto');
	define('M4J_LANG_DESCRIPTION','Descrizione');
	define('M4J_LANG_AREA','Area');
	define('M4J_LANG_ADJUSTMENT','Configurazione');
	define('M4J_LANG_VALUE','Valore');
	define('M4J_LANG_MAIN_CONFIG','Configuration principale:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Puoi configurare i valori principali qui. Se vuoi ripristinare i valori principali (incluso CSS) ai valori di default, premi Reset.');
	define('M4J_LANG_CSS_CONFIG','Impostazioni CSS:');
	define('M4J_LANG_CSS_CONFIG_DESC','Queste impostazioni sono richiste per la visualizzazione all\'utente. Se non hai esperienza con l\'inclusione di tuoi CSS esterni, non cambiare questi valori!');
	define('M4J_LANG_RESET','Reset');
			
	define('M4J_LANG_EMAIL_ROOT', 'Indirizzo Email principale: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Massimo numero di risposte <br/> Scelte specificate: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Larghezza anteprima: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Altezza anteprima: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Durata del Captcha (in min): ' );
	define('M4J_LANG_HELP_ICON', 'Icona di aiuto: ' );
	define('M4J_LANG_HTML_MAIL', 'Email in HTML: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Visualizza Legenda: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'L\'indirizzo email principale viene usato se al formulario non &egrave; stato specificato n&eacute; una categoria n&eacute un indirizzo email.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Questo valore numerico limita il numero massimo di risposte per una voce \'Scelta\'.' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Larghezza dell\'anteprima modello. Questo valore viene usato solo qualora non sia stato assegnato al template la larghezza dell\'anteprima.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Altenzza dell\'anteprima modello. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Trascorso il valore di minuti impostati, il Captcha sar&agrave; considerato invalido e dovr&agrave; quindi essere ricaricato (e quindi reinserito) per poter trasmettere il formulario.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Definisce il colore dell\'icona di aiuto.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Se preferisci ricevere mail in HTML, scegli Si. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Se vuoi visualizzare una legenda, scegli Si.' );
	
	define('M4J_LANG_CLASS_HEADING', 'Main Headline:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Header Text' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Listing- Wrap ' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Listing- Headline' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Listing- Introtext ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Form- Wrap ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Form- Table ' );
	define('M4J_LANG_CLASS_ERROR', 'Error Text' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Submit Button Wrap' );
	define('M4J_LANG_CLASS_SUBMIT', 'Submit Button ' );
	define('M4J_LANG_CLASS_REQUIRED', 'Required * css ' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Headline of a site ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Content after the headline. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap of a listing item.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Headline of a listing item. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Introtext of a listing item. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap of a form area. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Table where all the form items are displayed.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - CSS class of error messages. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap of the submit button ' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - CSS class of the submit button. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - CSS class of the \' <b>*</b> \' char to declare required fields.' );
	
	define('M4J_LANG_INFO_HELP','Informazioni ed aiuto');
	
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Tecnica generazione Captcha: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Semplice');
	
	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','La configurazione &egrave; stata ripristinata correttamente.');
		define('M4J_LANG_CONFIG_SAVED','La configurazione &egrave; stata salvata correttamente.');
		define('M4J_LANG_CAPTCHA_DESC', ' Sono stati riscontrati alcuni problemi utilizzando la tecnica captcha CSS con alcuni server e modelli. In questo caso puoi scegliere fra tecnica captcha CSS e Semplice. Se il Captcha Semplice non risolve il problema, scegli \'Speciale\'' );
		define('M4J_LANG_SPECIAL','Speciale');
	
	
	define('M4J_LANG_MAIL_ISO','Codifica Email');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');		
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Allegato';	
	define('M4J_LANG_ATTACHMENT','File Allegato');
	define('M4J_LANG_ATTACHMENT_DESC','L\'utente pu&ograve; trasferire un file attraverso il formulario.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Inserire parametri per questo campo trasferimento file:');
	define('M4J_LANG_ALLOWED_ENDINGS','Estensioni file accettate.');
	define('M4J_LANG_MAXSIZE','Massima dimensione file.');
	define('M4J_LANG_BYTE','Byte');
	define('M4J_LANG_KILOBYTE','Kilobyte');
	define('M4J_LANG_MEGABYTE','Megabyte');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Prego inserire tutte le estensioni, senza punto, suddivise da virgole.Se lasci in bianco, tutte le estensioni saranno accettate. Per facilitare l\'inserimento, cliccare sulla parte a destra dove sono elencate le estensioni.');
	define('M4J_LANG_IMAGES','Immagini');
	define('M4J_LANG_DOCS','Documenti');
	define('M4J_LANG_AUDIO','Audio');
	define('M4J_LANG_VIDEO','Video');										   
    define('M4J_LANG_DATA','Dati');
	define('M4J_LANG_COMPRESSED','Archivi');
	define('M4J_LANG_OTHERS','Altri');
	define('M4J_LANG_ALL','Tutti');
	
	// New to Version 1.1.9
	define('M4J_LANG_FROM_NAME','Email Da: Nome');
	define('M4J_LANG_FROM_EMAIL','Email Da: indirizzo');
	define('M4J_LANG_FROM_NAME_DESC','Inserisci un nome utilizzato come mittente per le email generate<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','Inserisci un indirizzo Email utilizzato per le email generate.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Attenzione! Tutti i formulari con questo Modello saranno cancellate!');
	

	/*
	* Please note that the include statement includes the missing laguage declarations for the version 1.0 (Starting Build 100)
	* It is located in the same folder as this file under "missing100.php"
	* If you want to translate these parts you need to open the missing100.php file, copy them here (starting at here!) and remove the include_once statement.
	* After this copy and remove action you can translate the language elements into your tounge.
	*/
	include_once('missing100.php');
		
	/*
	* Please note that the include statement includes the missing laguage declarations for the version 1.0.5 (Starting Build 104)
	* It is located in the same folder as this file under "missing104.php"
	* If you want to translate these parts you need to open the missing104.php file, copy them here (starting at here!) and remove the include_once statement.
	* After this copy and remove action you can translate the language elements into your tounge.
	*/
	include_once('missing104.php');
	
	/*
	* Please note that the include statement includes the missing laguage declarations for the version 1.1 (Starting Build 106)
	* It is located in the same folder as this file under "missing106.php"
	* If you want to translate these parts you need to open the missing106.php file, copy them here (starting at here!) and remove the include_once statement.
	* After this copy and remove action you can translate the language elements into your tounge.
	*/
	include_once('missing106.php');
?>
?>
