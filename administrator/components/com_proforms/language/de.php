
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
	
	$m4j_lang_elements[1]= 'Kontrollk&auml;stchen';
	$m4j_lang_elements[2]= 'Ja/Nein Schalter';
	$m4j_lang_elements[10]= 'Datum';
	$m4j_lang_elements[20]= 'Textfeld';
	$m4j_lang_elements[21]= 'Textbereich';
	$m4j_lang_elements[30]= 'Men&uuml;(Einfach)';
	$m4j_lang_elements[31]= 'Optionsschaltergruppe(Einfach)';
	$m4j_lang_elements[32]= 'Liste(Einfach)';
	$m4j_lang_elements[33]= 'Kontrollschaltergruppe(Mehrfach)';
	$m4j_lang_elements[34]= 'Liste(Mehrfach)';
	
	define('M4J_LANG_FORMS','Formulare');
	define('M4J_LANG_TEMPLATES','Vorlagen');
	define('M4J_LANG_CATEGORY','Kategorie');
	define('M4J_LANG_CONFIG','Konfiguration');
	define('M4J_LANG_HELP','Info & Hilfe');
	define('M4J_LANG_CANCEL','Abbruch');
	define('M4J_LANG_PROCEED','Weiter');
	define('M4J_LANG_SAVE','Speichern');
	define('M4J_LANG_NEW_FORM','Neues Formular');
	define('M4J_LANG_NEW_TEMPLATE','Neue Vorlage');
	define('M4J_LANG_ADD','Hinzuf&uuml;gen');
	define('M4J_LANG_EDIT_NAME','Bearbeitung der Formularvorlage (Grunddaten)');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Anlegen einer neuen Formularvorlage (Grunddaten)');
	define('M4J_LANG_TEMPLATE_NAME','Name der Formularvorlage');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Name der Formularvorlage bearbeiten');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Kurzbeschreibung (f&uuml;r den Internen gebrauch. Kann leer gelassen werden)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Kurzbeschreibung bearbeiten');
	define('M4J_LANG_DELETE','L&ouml;schen');
	define('M4J_LANG_DELETE_CONFIRM','Wirklich l&ouml;schen?');
	define('M4J_LANG_NAME','Name');
	define('M4J_LANG_SHORTDESCRIPTION','Kurzbeschreibung');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Elemente');
	define('M4J_LANG_EDIT','Bearbeiten');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Elemente bearbeiten');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Bitte geben Sie einen Namen für die Formularvolage an !');
	define('M4J_LANG_AT_LEAST_ONE','L&ouml;schung nicht m&ouml;glich!<br/>Mindestens ein Element muss bestehen bleiben.');
	define('M4J_LANG_NEW_CATEGORY','Neue Kategorie');

	define('M4J_LANG_EDIT_ELEMENT','Bearbeitung eines Elementes der Vorlage: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Geben Sie bitte einen Kategorienamen an');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Geben Sie eine g&uuml;ltige email Adresse ein oder lassen Sie dieses Feld frei.<br/>');
	define('M4J_LANG_EMAIL','EMail');
	define('M4J_LANG_POSITION','Position');
	define('M4J_LANG_ACTIVE','Aktiv');
	define('M4J_LANG_UP','Hoch');
	define('M4J_LANG_DOWN','Runter');
	define('M4J_LANG_EDIT_CATEGORY','Kategorie bearbeiten');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Elemente der Vorlage: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Neues Element hinzuf&uuml;gen zur Vorlage: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Bitte geben Sie eine Frage ein.');
	define('M4J_LANG_REQUIRED','Pflicht');
	define('M4J_LANG_QUESTION','Frage');
	define('M4J_LANG_TYPE','Typ');
	define('M4J_LANG_YES','Ja');		
	define('M4J_LANG_NO','Nein');	
	define('M4J_LANG_ALL_FORMS','Alle Formulare');
	define('M4J_LANG_NO_CATEGORYS','Ohne Kategorie');
	define('M4J_LANG_FORMS_OF_CATEGORY','Formulare der Kategorie: ');
	define('M4J_LANG_PREVIEW','Vorschau');
	define('M4J_LANG_DO_COPY','Kopie erstellen');		
	define('M4J_LANG_COPY','Kopie');
	define('M4J_LANG_VERTICAL','Vertikal');
	define('M4J_LANG_HORIZONTAL','Horizontal');
	define('M4J_LANG_EXAMPLE','Beispiel');
	define('M4J_LANG_CHECKBOX','Schalter');	
	define('M4J_LANG_DATE','Datum');
	define('M4J_LANG_TEXTFIELD','Eingabefeld');
	define('M4J_LANG_OPTIONS','Vorgaben');
	define('M4J_LANG_CHECKBOX_DESC','Der Benutzer wird nach einer Ja/Nein Antwort gefragt.');
	define('M4J_LANG_DATE_DESC','Der Benutzer muss ein Datum eingeben.');
	define('M4J_LANG_TEXTFIELD_DESC','Der Benutzer gibt einen individuellen Text ein.');
	define('M4J_LANG_OPTIONS_DESC','Der Benutzer w&auml;hlt aus vorgegebenen Antworten aus. ');
	define('M4J_LANG_CLOSE_PREVIEW','Vorschau schlie&szlig;en');
	define('M4J_LANG_Q_WIDTH','Breite der Spalte in der die Fragen stehen. (Links)');
	define('M4J_LANG_A_WIDTH','Breite der Spalte in der die Antworten stehen. (Rechts)');
	define('M4J_LANG_OVERVIEW','&Uuml;bersicht');
	define('M4J_LANG_UPDATE_PROCEED','& Weiter');
	define('M4J_LANG_NEW_ITEM','Neues Element');
	define('M4J_LANG_EDIT_ITEM','Element bearbeiten');
	define('M4J_LANG_CATEGORY_NAME','Name der Kategorie');
	define('M4J_LANG_EMAIL_ADRESS','Email Adresse');
	define('M4J_LANG_ADD_NEW_ITEM','Neues Element hinzuf&uuml;gen:');
	define('M4J_LANG_YOUR_QUESTION','Ihre Frage');
	define('M4J_LANG_REQUIRED_LONG','Pflichtfeld');
	define('M4J_LANG_HELP_TEXT','Hilfe Text. Geben Sie dem Nutzer eine Hilfestellung zu Ihrer Frage (nicht zwingend erforderlich)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Hier geben Sie an von welchem Typ Ihr Schalter sein soll:');
	define('M4J_LANG_ITEM_CHECKBOX','Kontrollk&auml;stchen.');
	define('M4J_LANG_YES_NO_MENU','Ja/Nein Auswahl.');
	define('M4J_LANG_YES_ON','Ja bzw. An.');
	define('M4J_LANG_NO_OFF','Nein bzw. Aus.');
	define('M4J_LANG_INIT_VALUE','Anfangswert:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Hier geben Sie an von welchem Typ Ihr Eingabefeld sein soll:');
	define('M4J_LANG_ITEM_TEXTFIELD','Textfeld');
	define('M4J_LANG_ITEM_TEXTAREA','Textbereich');
	define('M4J_LANG_MAXCHARS_LONG','Maximale Zahl der einzugebenden Zeichen:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Optische Anpassungen:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Breite in Pixel</b> <br/>(F&uuml;r Prozentangaben \'%\' anh&auml;ngen. Leer = Automatische Anpassung)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Anzahl der sichtbaren Zeilen:</b><br/> (Nur bei Textbereich)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Men&uuml;</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Optionsschaltergruppe</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Liste</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Einfach)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Kontrollschaltergruppe</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Liste</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Mehrfach, mit \'STRG\' & linke Mousetaste)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Einfachauswahl (Nur eine Vorgabe kann ausgew&auml;hlt werden):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Mehrfachauswahl (Mehrere Vorgaben k&ouml;nnen ausgew&auml;hlt werden):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Hier geben Sie an von welchem Typ Ihr Auswahlfeld sein soll:');
	define('M4J_LANG_ROWS_LIST','<b>Anzahl der sichtbaren Zeilen:</b><br/> (Nur bei Liste)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Ausrichtung: </b> <br/>(Nur bei Optionsschalter- oder Kontrollschaltergruppe)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Geben Sie hier die Antwort- Vorgaben f&uuml;r Ihre Frage ein.<br/>Frei gelassene Felder werden ignoriert.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Geben Sie hier einen Einf&uuml;hrungstext ein. Wird nur bei der Darstellungen von Kategorien angezeigt.');
	define('M4J_LANG_TITLE','Titel');
	define('M4J_LANG_ERROR_NO_TITLE','Bitte geben Sie einen Titel ein.');
	define('M4J_LANG_USE_HELP','Hilfe Text als Baloontip im Frontend anzeigen ?');
	define('M4J_LANG_TITLE_FORM','Titel des Formulars');
	define('M4J_LANG_INTROTEXT','Introtext');
	define('M4J_LANG_MAINTEXT','Haupttext');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Introtext der EMail. (Erscheint als &Uuml;berschrift in der EMail die an Sie geschickt wird)');
	define('M4J_LANG_TEMPLATE','Formularvorlage');
	define('M4J_LANG_LINK_TO_MENU','Zu einem Men&uuml; verlinken');
	define('M4J_LANG_LINK_CAT_TO_MENU','Aktuelle Kategorie zu einem Men&uuml; verlinken');
	define('M4J_LANG_LINK_TO_CAT','Verlinkung der Kategorie: ');
	define('M4J_LANG_LINK_TO_FORM','Verlinkung des Formulars: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Verlinkung zur Auflistung aller Formulare ohne Kategorie');
	define('M4J_LANG_LINK_TO_ALL_CAT','Verlinkung zur Auflistung aller Kategorien');
	define('M4J_LANG_CHOOSE_MENU','W&auml;hlen Sie das Menu aus, zu dem Sie verlinken m&ouml;chten: ');
	define('M4J_LANG_MENU','Men&uuml;: ');
	define('M4J_LANG_NO_LINK_NAME','Bitte geben Sie einen Namen f&uuml;r diesen Link an.');
	define('M4J_LANG_PUBLISHED','Publiziert:');
	define('M4J_LANG_PARENT_LINK','&Uuml;bergeordneter Link');
	define('M4J_LANG_LINK_NAME','Name des Links');
	define('M4J_LANG_ACCESS_LEVEL','Zugriffsebene:');
	define('M4J_LANG_EDIT_MAIN_DATA','Grunddaten bearbeiten');
	define('M4J_LANG_LEGEND','Legende');
	define('M4J_LANG_LINK','Verlinkung');
	define('M4J_LANG_IS_VISIBLE',' wird angezeigt');
	define('M4J_LANG_IS_HIDDEN',' wird nicht angezeigt');
	define('M4J_LANG_FORM','Formular');
	define('M4J_LANG_ITEM','Element');
	define('M4J_LANG_IS_REQUIRED','Ist ein Pflichtfeld');
	define('M4J_LANG_IS_NOT_REQUIRED','Ist kein Pflichtfeld');
	define('M4J_LANG_ASSIGN_ORDER','Bestimmung der Reihenfolge');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Die Bestimmung der Reihenfolge ist bei der Auflistung aller Formulare nicht m&ouml;glich !<br/>');
	define('M4J_LANG_EDIT_FORM','Formular bearbeiten');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Ver&ouml;ffentlicht! Klick=Verstecken');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Nicht ver&ouml;ffentlicht! Klick=Ver&ouml;ffentlichen');
	define('M4J_LANG_HOVER_REQUIRED_ON','Pflichtfeld! Klick= Kein Pflichtfeld');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Kein Pflichtfeld! Klick= Pflichtfeld');
	define('M4J_LANG_DESCRIPTION','Erkl&auml;rung');
	define('M4J_LANG_AREA','Bereich');
	define('M4J_LANG_ADJUSTMENT','Einstellung');
	define('M4J_LANG_VALUE','Wert');
	define('M4J_LANG_MAIN_CONFIG','Haupteinstellungen:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Hier k&ouml;nnen Sie die Haupteinstellungen  &auml;ndern. Wenn Sie alle Einstellungen (inkl. CSS) in Ihren Grundzustand zur&uuml;cksetzen m&ouml;chten klicken Sie unten auf Zur&uuml;cksetzen.');
	define('M4J_LANG_CSS_CONFIG','CSS Einstellungen:');
	define('M4J_LANG_CSS_CONFIG_DESC','Diese Werte bestimmen die visuelle Darstellung des Frontend. Sollten Sie keine Erfahrungen in der Einbindung externer (eigener) CSS haben, ver&auml;ndern Sie diese Einstellungen nicht !');
	define('M4J_LANG_RESET','Zur&uuml;cksetzen');
			
	define('M4J_LANG_EMAIL_ROOT', 'Haupt- Emailadresse: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Maximale Vorgaben: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Vorschau Breite: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Vorschau H&ouml;he: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Captcha Dauer (in min): ' );
	define('M4J_LANG_HELP_ICON', 'Hilfe Symbol: ' );
	define('M4J_LANG_HTML_MAIL', 'HTML Email: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Legende anzeigen: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'Die Hauptemailadresse wird verwendet, wenn weder bei der Kategorie noch bei einem Formular eine Mailadresse angegeben wurde. ' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Wenn Sie einer Formularvorlage ein Vorgabenelement hinzuf&uuml;gen, beschreibt dieser Wert die Maximale Anzahl der m&ouml;glichen Vorgaben. Dieser Wert muss eine Zahl sein. ' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Die Breite der Vorschau einer Vorlage. Wird nur verwendet, wenn bei den Vorlage- Grunddaten die Breite der linken und rechten Spalte nicht angegben wurde. ' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Die H&ouml;he der Vorlagenvorschau. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Betrifft das Frontend. Diese Zahl gibt die mindest Dauer an in der ein CSS Captcha g&uuml;ltig ist. Sollte diese Dauer &uuml;berschritten werden, muss die Eingabe nochmal get&auml;tigt werden, auch wenn der Sicherheitscode richtig war. ' );
	define('M4J_LANG_HELP_ICON_DESC', 'Wenn Sie dem Benutzer die M&ouml;glichkeit einer Hilfestellung geben m&ouml;chten, erscheint ein Hilfesymbol. Hier bestimmen Sie die Farbe des Symbols. ' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Wenn Sie die Nachrichten im HTML Format erhalten m&ouml;chten, geben Sie Ja ein. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Wenn Sie eine Legende im Adminbereich eingeblendet haben wollen, geben Sie Ja ein. ' );
	
	define('M4J_LANG_CLASS_HEADING', 'Haupt&uuml;berschrift:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Seitenkopftext' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Listen- H&uuml;lle ' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Listen- &Uuml;berschrift ' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Listen- Introtext ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Formular- H&uuml;lle ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Formular- Tabelle ' );
	define('M4J_LANG_CLASS_ERROR', 'Fehlertext' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Senden - Button H&uuml;lle ' );
	define('M4J_LANG_CLASS_SUBMIT', 'Senden- Button ' );
	define('M4J_LANG_CLASS_REQUIRED', 'Pflichtfeld * css ' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Die &Uuml;berschrift einer Seite ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Der auf die Haupt&uuml;berschrift folgende Inhalt. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Die H&uuml;lle eines Elementes bei der Auflistung. ' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Die &Uuml;berschrift eines Listenelementes. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Der Introtext eines Listenelementes. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Die H&uuml;lle eines Formulars. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Die Tabelle in der die Formularfelder angezeigt werden. ' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - Erscheint bei Fehleingaben. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Die H&uuml;lle die den Senden Button umschlie&szlig;t. ' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - Der Sendenbutton an sich. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - Die Texteigenschaft des Sterns, welcher ein Pflichtfeld ausweist. ' );
	
	define('M4J_LANG_INFO_HELP','Info und Hilfe');
	
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Captcha Technik: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Einfach');
	
	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','Konfiguration wurde erfolgreich zur&uuml;ckgesetzt.');
		define('M4J_LANG_CONFIG_SAVED','Konfiguration wurde erfolgreich gespeichert.');
		define('M4J_LANG_CAPTCHA_DESC', 'Bei manchen Servern und unter einigen Templates wird das Standard-CSS-Captcha nicht richtig angezeigt. W&auml;hlen Sie CSS f&uuml;r das Standard-CSS-Captcha oder Einfach f&uuml;r ein normales Captcha. Wenn Sie weiterhin Probleme haben verwenden Sie "Spezial"' );
	define('M4J_LANG_SPECIAL','Spezial');
	
	define('M4J_LANG_MAIL_ISO','E-Mail Zeichensatz');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Datei Anhang';	
	define('M4J_LANG_ATTACHMENT','Datei Anhang');
	define('M4J_LANG_ATTACHMENT_DESC','Der Benutzer versendet eine Datei &uuml;ber das Formular.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Geben Sie hier die Parameter f&uuml;r die Datei&uuml;bermittlung an:');
	define('M4J_LANG_ALLOWED_ENDINGS','Zugelassene Dateiendungen.');
	define('M4J_LANG_MAXSIZE','Maximale Dateigr&ouml;&szlig;e.');
	define('M4J_LANG_BYTE','Byte');
	define('M4J_LANG_KILOBYTE','Kilobyte');
	define('M4J_LANG_MEGABYTE','Megabyte');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Bitte Endungen ohne einleitenden Punkt und getrennt durch <b>Kommas</b> eintragen.<br />
                                               Wenn Sie die Felder frei lassen werden alle Endungen zugelassen bzw. jede Gr&ouml;&szlig;e akzeptiert.
                                               Um Ihnen die Arbeit zu erleichtern, k&ouml;nnen Sie unterhalb auf die passende Endung klicken um diese automatisch hinzuzuf&uuml;gen.');
	define('M4J_LANG_IMAGES','Bilder');
	define('M4J_LANG_DOCS','Dokumente');
	define('M4J_LANG_AUDIO','Audio');
	define('M4J_LANG_VIDEO','Video');										   
    define('M4J_LANG_DATA','Daten');
	define('M4J_LANG_COMPRESSED','Kompression');
	define('M4J_LANG_OTHERS','Sonstige');
	define('M4J_LANG_ALL','Alle');
	
	// New to Version 1.1.9
	
	define('M4J_LANG_FROM_NAME','Absender Name');
	define('M4J_LANG_FROM_EMAIL','Absender Email');
	define('M4J_LANG_FROM_NAME_DESC','Geben Sie hier den Absendernamen an, der bei den Emails angezeigt werden soll.<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','Geben Sie hier die Absender- Emailadresse, an die bei den Emails eingebunden werden soll.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Achtung! Alle Formulare die diese Vorlage enthalten werden ebenfalls gel&ouml;scht!');
	
	// New to Proforms 1.0
	
	define('M4J_LANG_STORAGES','Datenbankeintr&auml;ge des Formulars: ');
	define('M4J_LANG_READ_STORAGES','Datenbankeintr&auml;ge');
	define('M4J_LANG_EXPORT','Exportieren');
	define('M4J_LANG_CSV_EXPORT','CSV Export');
	define('M4J_LANG_WORKAREA','Arbeistbereich');
	define('M4J_LANG_WORKAREA_DESC','Die Breite in Pixel des Arbeitfensters im Adminbereich. Anh&auml;nge wie px oder % werden gel&ouml;scht!');
	define('M4J_LANG_STORAGE_WIDTH','Breite Datenelement');
	define('M4J_LANG_STORAGE_WIDTH_DESC','Die Breite in Pixel eines Datenelementes in der Darstellung der Datenbankeintr&auml;ge.<br> Keinen Zusatz einfuegen wie px oder % !');
	define('M4J_LANG_RECEIVED','Empfangen am:');
	define('M4J_LANG_PROCESS','Verfahren');
	define('M4J_LANG_DATABASE','Datenbank');
	define('M4J_LANG_USERMAIL','Eindeutige Mailadresse');
	define('M4J_LANG_USERMAIL_DESC','Hiermit bestimmen Sie das Feld mit der eindeutigen Emailadresse des Benutzers. Ohne diese k&ouml;nnen Sie keine Best&auml;tigunsmails versenden. Es kann pro Formularvorlage immer nur eine eindeutige Emailadresse geben. Das Aktivieren l&ouml;scht eine bereits bestimmte eindeutige Adresse!');
	define('M4J_LANG_USERMAIL_TOOLTIP','Dieses Feld ist die eindeutige Emailadresse. Diese ist immer ein Pflichtfeld');
	define('M4J_LANG_MATH','Mathematisch');
	define('M4J_LANG_RE_CAPTCHA','reCAPTCHA');
	define('M4J_LANG_ITEM_PASSWORD','Passwort');
	$m4j_lang_elements[22]= 'Passwort';
	define('M4J_LANG_MAX_UPLOAD_ALLOWED','Ihr Server erlaubt einen maximalen Upload von ');
	define('M4J_LANG_CSS_EDIT', 'CSS bearbeiten');
	define('M4J_LANG_NO_FRONT_STYLESHEET','Die Frontend Stylesheet-Datei existiert nicht! ');
	define('M4J_LANG_HTML','HTML');
	define('M4J_LANG_HTML_DESC','Hiermit k&ouml;nnen Sie individuellen HTML Code zwischen den Formularelementen anzeigen lassen.');
	$m4j_lang_elements[50]= 'HTML';
	define('M4J_LANG_EXTRA_HTML',' - EXTRA HTML - ');
	define('M4J_LANG_RESET_DESC','Die Konfiguration auf die Grundeinstellung zur&uuml;cksetzen.');
	define('M4J_LANG_SECURITY','Captcha &amp; Sicherheit');
	define('M4J_LANG_RECAPTCHA_THEME','reCaptcha Theme');
	define('M4J_LANG_RECAPTCHA_THEME_DESC','Wenn Sie reCaptcha verwenden, k&ouml;nnen Sie hier das Aussehen ver&auml;ndern.');
	define('M4J_LANG_SUBMISSION_TIME','Sendegeschwindigkeit (in ms)');
	define('M4J_LANG_SUBMISSION_TIME_DESC','Dieser Wert in Millisekunden bestimmt die akzeptierte Zeit zwischen dem Aufbau eines Formulars und dessen Versendung. Ist eine Versendung schneller als der angegebene Rahmen, wird diese als Spam deklariert und abgelehnt.');
	define('M4J_LANG_FORM_TITLE','Titel anzeigen');
	define('M4J_LANG_FORM_TITLE_DESC','Bestimmt ob der Titel eines Formulars angezeigt wird. Gilt nur f&uuml;r die Formularanzeige und nicht f&uuml;r die Auflistung in einer Kategorie.');
	define('M4J_LANG_SHOW_NO_CATEGORY','Zeige "Ohne Kategorie"');
	define('M4J_LANG_SHOW_NO_CATEGORY_DESC','Hier k&ouml;nnen Sie die Darstellung der Pseudokategorie "Ohne Kategorie" bestimmen. Je nach Einstellung wird diese in Hauptauflistung dargestellt oder nicht.');
	define('M4J_LANG_FORCE_CALENDAR','Englischen Kalender erzwingen');
	define('M4J_LANG_FORCE_CALENDAR_DESC','Unter einigen Frontend- Sprachen kann die Kalenderfunktion nicht richtig funktionieren. Sie k&ouml;nnen hier die Verwendung eines englischsprachigen Kalenders erzwingen.');
	define('M4J_LANG_LINK_THIS_CAT_ALL','Die Auflistung aller Kategorien zu einem Men&uuml; verlinken.');
	define('M4J_LANG_LINK_THIS_NO_CAT','Alle Formulare die keiner Kategorie angeh&ouml;ren als Liste zu einem Men&uuml; verlinken.');
	define('M4J_LANG_LINK_THIS_CAT','Alle Formulare der Kategorie \'%s\' als Liste zu einem Men&uuml; verlinken.');
	define('M4J_LANG_LINK_THIS_FORM','Dieses Formular zu einem Men&uuml; verlinken.');
	define('M4J_LANG_LINK_ADVICE','Sie k&ouml;nnen Kategorien und Formulare nur mit den hier angegebenen Linkschaltern [ %s ] zu einem Men&uuml; verlinken!');
	define('M4J_LANG_HELP_TEXT_SHORT','Hilfetext');
	define('M4J_LANG_ROWS','Zeilen');
	define('M4J_LANG_WIDTH','Breite');
	define('M4J_LANG_ALIGNMENT','Ausrichtung');
	define('M4J_LANG_SHOW_USER_INFO','Zeige Benutzer-Info');
	define('M4J_LANG_SHOW_USER_INFO_DESC','Zeigt eine Auflistung der gesammelten Nutzerdaten in Emails. Z.B.: Joomla User Name, Joomla User Email, Browser, OS, etc. Diese Daten werden bei Best&auml;tigungsmails and den Absender des Formulars grunds&auml;tzlich nicht angezeigt.');
	define('M4J_LANG_FRONTEND','Frontend');
	define('M4J_LANG_ADMIN','Admin');
	define('M4J_LANG_DISPLAY','Darstellung');
	define('M4J_LANG_FORCE_ADMIN_LANG','Adminsprache erzwingen');
	define('M4J_LANG_FORCE_ADMIN_LANG_DESC','Im Normalzustand erkennt Proforms die Adminsprache automatisch. Hier k&ouml;nnen Sie eine Sprache erzwingen.');
	define('M4J_LANG_USE_JS_VALIDATION','Javascript Validierung');
	define('M4J_LANG_USE_JS_VALIDATION_DESC','Hier k&ouml;nnen Sie die Javascript Formularvalidierung ein und ausschalten. Wenn Sie diese Ausschalten, werden die Felder erst nach dem Abschicken auf G&uuml;ltigkeit gepr&uuml;ft.');
	define('M4J_LANG_PLEASE_SELECT','Bitte w&auml;hlen');
	define('M4J_LANG_LAYOUT','Layout');
	define('M4J_LANG_DESC_LAYOUT01','Eine Spalte');
	define('M4J_LANG_DESC_LAYOUT02','Zwei Spalten');
	define('M4J_LANG_DESC_LAYOUT03','Drei Spalten');
	define('M4J_LANG_DESC_LAYOUT04','Kopfzeile mit zwei Spalten und Fu&szlig;zeile mit einer Spalte');
	define('M4J_LANG_DESC_LAYOUT05','Kopfzeile mit einer Spalte und Fu&szlig;zeile mit zwei Spalten');
	define('M4J_LANG_USE_FIELDSET','Gruppierung verwenden:');
	define('M4J_LANG_LEGEND_NAME','Gruppenname:');
	define('M4J_LANG_LEFT_COL','Linke Spalte:');
	define('M4J_LANG_RIGHT_COL','Rechte Spalte:');
	define('M4J_LANG_FOR_POSITION',' f&uuml;r Position %s');
	define('M4J_LANG_LAYOUT_POSITION','Layout Position');
	define('M4J_LANG_PAYPAL','PayPal');
	define('M4J_LANG_EMAIL_TEXT','Email Text');
	define('M4J_LANG_CODE','Code');
	define('M4J_LANG_NEVER','Nie');
	define('M4J_LANG_EVER','Immer');
	define('M4J_LANG_ASK','Fragen');
	define('M4J_LANG_AFTER_SENDING','Nach dem Senden');
	define('M4J_LANG_CONFIRMATION_MAIL','Best&auml;tigungsmail');
	define('M4J_LANG_TEXT_FOR_CONFIRMATION','Emailtext nur f&uuml;r Best&auml;tigungsmail ?');
	define('M4J_LANG_SUBJECT','Betreff');
	define('M4J_LANG_ADD_TEMPLATE','Formularvorlage hinzuf&uuml;gen');
	define('M4J_LANG_INCLUDED_TEMPLATES','Enthaltene Vorlage(n)');
	define('M4J_LANG_ADVICE_USERMAIL_ERROR',"Ein Formular kann immer nur eine eindeutige Emailadresse besitzten! Sie haben diesem Formular bereits eine Vorlage mit eindeutiger Emailadresse zugewiesen.");
	define('M4J_LANG_STANDARD_TEXT','Standard Text');
	define('M4J_LANG_REDIRECT','Weiterleitung');
	define('M4J_LANG_CUSTOM_TEXT','Eigener Text');
	define('M4J_LANG_ERROR_NO_FORMS','Sie können nur ein Formular anlegen wenn Sie mindestens eine Formularvorlage erstellt haben. Sie haben noch keine Vorlage erstellt. Möchten Sie jetzt eine Vorlage erstellen?');
	define('M4J_LANG_USE_PAYPAL','Paypal verwenden');
	define('M4J_LANG_USE_PAYPAL_SANDBOX','Paypal Sandbox verwenden');
	define('M4J_LANG_HEIGHT','H&ouml;he');
	define('M4J_LANG_CLASS_RESET','Reset Button');
	define('M4J_LANG_CLASS_RESET_DESC','<b>INPUT-Tag</b> - Diese CSS Klasse &auml;ndert das Aussehen der Reset Schaltfl&auml;che.');
	define('M4J_LANG_PAYPAL_PARAMETERS','Paypal Einstellungen');
	define('M4J_LANG_PAYPAL_ID','Ihre PayPal ID (Email)');
	define('M4J_LANG_PAYPAL_PRODUCT_NAME','Produktbezeichnung');
	define('M4J_LANG_PAYPAL_QTY','Anzahl');
	define('M4J_LANG_PAYPAL_NET_AMOUNT','Nettopreis (St&uuml;ckpreis)');
	define('M4J_LANG_PAYPAL_CURRENCY_CODE','W&auml;hrungscode');
	define('M4J_LANG_PAYPAL_ADD_TAX','Zuz&uuml;gliche Umsatzsteuer (Gesamtbetrag und nicht prozentual!) ');
	define('M4J_LANG_PAYPAL_RETURN_URL','R&uuml;ckkehradresse nach erfolgreicher Transaktion (URL mit http)');
	define('M4J_LANG_PAYPAL_CANCEL_RETURN_URL','R&uuml;ckkehradresse wenn die Transaktion abgebrochen wird (URL mit http) ');
	define('M4J_LANG_SERVICE','Service');
	define('M4J_LANG_SERVICE_KEY','Service Schl&uuml;ssel');
	define('M4J_LANG_EDIT_KEY','Schl&uuml;ssel bearbeiten / erneuern');
	define('M4J_LANG_CONNECT','Verbinden');
	define('M4J_LANG_NONE','Keine');
	define('M4J_LANG_ALPHABETICAL','Alphabetisch');
	define('M4J_LANG_ALPHANUMERIC','Alphanumerisch');
	define('M4J_LANG_NUMERIC','Numerisch');
	define('M4J_LANG_INTEGER','Ganze Zahl');
	define('M4J_LANG_FIELD_VALIDATION','Validierung');
	define('M4J_LANG_SEARCH','Suchen');
	define('M4J_LANG_ANY','-BELIEBIG-');
	
	define('M4J_LANG_JOBS_EMAIL_INFO','Wenn Sie hier keine Emailadresse eingeben wird die Adresse der entsprechenden Kategorie verwendet.<br />Sollte dort auch keine Adresse angegeben sein wird die globale Adresse (siehe Konfiguration) verwendet.');
	define('M4J_LANG_JOBS_INTROTEXT_INFO','Der Introtext ist der Text der bei der (Kategorie-) Auflistung eines Formulars angezeigt wird. Dieser wird nicht im Formular angezeigt.');
	define('M4J_LANG_JOBS_MAINTEXT_INFO','Der Haupttext wird am Anfang des Formulars angezeigt.');
	define('M4J_LANG_JOBS_AFTERSENDING_INFO','Hier k&ouml;nnen Sie bestimmen was nach dem Abschicken der Formulardaten angezeigt werden soll.');
	define('M4J_LANG_JOBS_PAYPAL_INFO','Sie k&ouml;nnen nach dem Senden den Benutzer direkt zu Paypal weiterleiten. Bitte geben Sie Betr&auml;ge mit einem Punkt statt mit einem Komma an: 24.50 statt 24,50 ! <br />Wenn Sie PayPal verwenden werden die Aktionen aus "Nach dem Senden" &uuml;bergangen!');
	define('M4J_LANG_JOBS_CODE_INFO','Sie k&ouml;nnen auch eigenen Code (HTML,JS aber <b>kein PHP!</b>) am Ende des Formulars oder nach dem Senden einpflegen. <br /> Z.B.: Google Analytics oder Conversion. "Nach-dem-Senden-Code" wird nicht eingebunden wenn Sie nach dem Senden weiterleiten oder PayPal verwenden.');
	define('M4J_LANG_ERROR_COLOR','Fehler Farbe');
	define('M4J_LANG_ERROR_COLOR_DESC','Wenn bei der Javascriptvalidierung ein Fehler erkannt wird, erh&auml;lt das Feld eine Umrandung in einer speziellen Farbe. Hier k&ouml;nnen Sie die Farbe bestimmen (Hexadezimal ohne #).');
	define('M4J_LANG_CONFIG_DISPLAY_INFO','Hier k&ouml;nnen Sie diverse Werte einstellen die die Darstellung des Frontend oder des Backend beinflussen.');
	define('M4J_LANG_CONFIG_CAPTCHA_INFO','Hier bestimmen Sie die Technik der Sicherheitsabfrage und sonstige sicherheitsrelevanten Einstellungen.');
	define('M4J_LANG_CONFIG_RESET_INFO','Die Stylesheet Datei wird nicht zur&uuml;ckgesetzt nur die CSS Klassennamen aus den CSS Einstellungen!');
	define('M4J_LANG_SERVICE_DESC1',
	'
	Wenn Sie einen Service Schlüssel besitzen erhalten Sie hier Zugang zu dem Proforms Service Helpdesk.<br /> 
	Hierzu geben Sie den Schlüssel ein und speichern diesen. Danach verbinden Sie sich durch den  „Verbinden“-Schalter  mit dem Service Help-Desk-Server.<br /><br />
	Sie können den Service Helpdesk immer nur aus dem Adminbereich von Proforms erreichen.<br />
	Ein direkter Zugang ist nicht gestattet.<br /><br />
	Jeder Serviceschlüssel ist zeitlich begrenzt und kann nach dem Ablauf der Frist nicht mehr verwendet werden.
	Der Serviceschlüssel ist immer nur für eine Domain (Joomlainstallation) gültig. Bei dem ersten Besuch des Helpdesk werden Sie gefragt, ob Sie den Schlüssel auf die aktuelle Domain (Joomlainstallation) registrieren möchten. Wenn Sie mit „OK“ bestätigen, erhalten Sie Zugang zum Helpdesk. Danach können Sie den Helpdesk nur noch aus dem Adminbereich dieser Domain (Joomlainstallation) mit dem registrierten Schlüssel erreichen.<br />   
	<br /><span style="color:red">
	Wenn diese Installation (Domain) hinter einer Firewall bzw. nicht öffentlich zugänglich ist (z.B. auf einem lokalen Server läuft) können wir Ihnen aus technischen Gründen keinen Service anbieten (Siehe Produktanforderungen und AGB).<br /> 
	</span><br />
	Der Proforms Helpdesk bietet Informationen zu dem Produkt, die Möglichkeit uns zu kontaktieren (Direkte Anfragen über unsere Internetseite oder per Email werden ignoriert) und Downloads zu Upgradepaketen und sonstigen Modulen oder Plugins für Mooj Proforms.<br />
	<br />
	Der Helpdesk ist im Aufbau und wächst jeden Tag. Wenn der Aufbau fertig ist erhalten Sie eine Updatepaket das eine automatische Upgradefunktion ermöglicht.<br />
	<br />
	Die Domainrestriktion gilt nur für den Help-Desk-Service.  Funktionalität und Portierbarkeit von Proforms sind hiervon nicht berührt.<br /> 
	<br />
	');
	define('M4J_LANG_SEARCH_IN',' Suchen in ');
	
	// New To Proforms 1.0.5
	define('M4J_LANG_ORDERING','Sortierung');
	define('M4J_LANG_DESC','Neue zuerst');
	define('M4J_LANG_ASC','Neue zuletzt');
	define('M4J_LANG_ERROR_NO_TEMPLATE','Sie müssen dem Formular mindestens eine Formularvorlage zuweisen!');
	define('M4J_LANG_TRUNCATE','Leeren');
	define('M4J_LANG_REALLY_TRUNCATE','Wollen Sie wirklich alle Einträge löschen?');
	define('M4J_LANG_NO_DB_RECORDS','Keine Datensätze vorhanden!');
	define('M4J_LANG_SEARCH_FAIL','Es wurden keine mit Ihrer Suchanfrage - %s - übereinstimmenden Datensätze gefunden.');
	define('M4J_LANG_COMMA','Komma');
	define('M4J_LANG_SEMICOLON','Semikolon');
	define('M4J_LANG_ANSWER','Antwort');
	define('M4J_LANG_SERVER_INFO','Server Info');
	define('M4J_LANG_PRINT','Ausdrucken');
	define('M4J_LANG_STORAGE_CONFIG','Konfiguration der Datenbanksätze');
	define('M4J_LANG_TABLE_VIEW','Tabellendarstellung');
	define('M4J_LANG_USE_QUESTIONS','Fragen anzeigen');
	define('M4J_LANG_USE_ALIAS','Alias anzeigen');
	define('M4J_LANG_USE_QUESTIONS_DESC','Zeigt im Tabellenkopf und bei dem Kopf von Exporten die Fragen an, wenn diese nicht leer sind. Sonst die Aliase.');
	define('M4J_LANG_USE_ALIAS_DESC','Zeigt im Tabellenkopf und bei dem Kopf von Exporten den Alias an, wenn dieser nicht leer ist.Sonst die Frage');
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR_ADDITION',' Oder geben Sie mindestens einen Alias an.');
	define('M4J_LANG_USE_QUESTIONS_DESC_FE','Zeigt vorrangig Fragen an. Wenn eine Frage leer ist wird der Alias angezeigt.');
	define('M4J_LANG_USE_ALIAS_DESC_FE','Zeigt vorrangig Alias an. Wenn kein Alias vorhanden ist wird die Frage angezeigt.');
	define('M4J_LANG_DATA_LISTING_CONFIRMATION','Datenliste in Bestätigungsmail');
	define('M4J_LANG_DATA_LISTING','Datenliste in Standardmail');
	define('M4J_LANG_ALIAS_ADVICE','Sie können abgesendete Feldwerte im Editor wiedergeben indem Sie den Alias eines Feldes in geschweifte Klammern setzen [ <b>{ALIAS}</b> ]. <br/> Felder ohne Alias werden nicht berücksichtigt. ACHTUNG: [Das automatische Einsetzen ist nicht 100% IE kompatibel]');
	define('M4J_LANG_INSERT_FIELD_VALUE','Feldwerte einfügen');
	
	// New To Proforms 1.1
	define('M4J_LANG_ARTICLES','Inhalte');
	define('M4J_LANG_OPTIN_REDIRECT','Opt-In Weiterleitung');
	define('M4J_LANG_OPTIN_MAIL','Opt-In Bestätigungsmail');
	define('M4J_LANG_DOUBLE_OPTIN_DESC','Sie haben mit dem Double-Opt-In-Verfahren die Möglichkeit abgesandte Formulare gesetzeskonform bestätigen zu lassen.<br/> Bitte beachten Sie, dass hierzu die Speicherung der Daten in der Datenbank aktiviert sein muss!');
	define('M4J_LANG_ARTICLE_LINK_INFO','Link zu einem Inhaltsartikel');
	define('M4J_LANG_OPT_REDIRECT_DESC','Sie haben die Möglichkeit den Benutzer, bei erfolgreicher Bestätigung, an eine beliebige URL weiterzuleiten. Dort können Sie den Nutzer nach Ihren Vorstellungen über die erfolgreiche Bestätigung informieren. Wenn Sie dieses Feld frei lassen, wird der Benutzer mit einem Standardtext informiert.');
	define('M4J_LANG_OPTOUT_REDIRECT_DESC','Sie haben die Möglichkeit den Benutzer, bei erfolgreicher Abmeldung, an eine beliebige URL weiterzuleiten. Dort können Sie den Nutzer nach Ihren Vorstellungen über die erfolgreiche Abmeldung informieren. Wenn Sie dieses Feld frei lassen, wird der Benutzer mit einem Standardtext informiert.');
	define('M4J_LANG_OPTOUT_REDIRECT','Opt-Out Weiterleitung');
	define('M4J_LANG_OPTOUT_MAIL','Opt-Out Bestätigungsmail');
	define('M4J_LANG_OPTIIN_ACTIVATE','Double Opt-In aktivieren');
	define('M4J_LANG_OPTIN_EMAIL_OPTION','Admin Email versenden nur wenn bestätigt');
	define('M4J_LANG_OPTIN_EMAIL_OPTION_DESC','Wenn Sie diese Option aktivieren erhalten SIE nur eine Email wenn der Benutzer mit dem Opt-In-Verfahren seine Daten bestätigt hat.');
	define('M4J_LANG_CONFIRMATION','Bestätigung');
	define('M4J_LANG_CONFIRMED','Bestätigt');
	define('M4J_LANG_NOT_CONFIRMED','Nicht bestätigt');
	define('M4J_LANG_OPTIN','Opt-In');
	define('M4J_LANG_OPTOUT','Opt-Out');
	define('M4J_LANG_OPTIN_NO_CONFIRMATION_EMAIL','Keine Bestätigungsmail');
	define('M4J_LANG_OPTIN_NO_CONFIRMATION_EMAIL_DESC','Wenn Sie diese Option aktivieren werden bei dem Opt-In und bei dem Opt-Out Verfahren keine Bestätigungsemails versendet. Im aktivierten Zustand wird entweder ein Standardtext angezeigt oder zur angegebenen Internetseite weitergeleitet.');
	define('M4J_LANG_OPTIN_DESC','Hier geben Sie den Inhalt der Email an, die versendet wird wenn der Benutzer erfolgreich seine Angaben bestätigt hat. Mit der Option -Keine Bestätigungsmail- können Sie das Versenden von Bestätigungsmails unterbinden. Innerhalb der Email können Sie wie gewohnt die Inhalte von einzelnen Feldern einbinden indem Sie den Feld-Alias in geschweifte Klammern einbetten. Mit {J_OPT_OUT} binden Sie den Link zum Abmelden an.');
	define('M4J_LANG_OPTOUT_DESC','Hier geben Sie den Inhalt der Email an, die versendet wird wenn ein Benutzer sich abgemeldet hat. Mit der Option -Keine Bestätigungsmail- können Sie das Versenden von Bestätigungsmails unterbinden. Innerhalb der Email können Sie wie gewohnt die Inhalte von einzelnen Feldern einbinden indem Sie den Feld-Alias in geschweifte Klammern einbetten. Mit {J_OPT_IN} binden Sie den Link zur erneuten Bestätigung an.');
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','Sie haben Ihr Daten auf %s bestätigt.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','Sie haben Ihre Bestätigung auf %s widerrufen.');
	define('M4J_LANG_OPTIN_FILTER','Bestätigungsfilter');
	define('M4J_LANG_NO_OPTIN_ADVICE','Sie müssen die Datenbankspeicherung aktivieren um das Double-Opt-In-Verfahren nutzen zu können. Dies richten Sie unter dem Reiter: %s mit der Option: %s ein.');
	define('M4J_LANG_OPTIN_SUBJECT','Opt-In E-Mail Betreff');
	define('M4J_LANG_OPTOUT_SUBJECT','Opt-Out E-Mail Betreff');
	define('M4J_LANG_TEXT_FOR_CONFIRMATION_DESC','Ist diese Option aktiviert, wird ein Emailtext nur bei Bestätigungsmails eingefügt. D.h. die Adminemail enthält, wenn die Datenlistenoption aktiviert ist, lediglich die Datenliste.');
	define('M4J_LANG_DATA_LISTING_CONFIRMATION_DESC','Wenn diese Option aktiviert ist, werden einer BESTÄTIGUNGSMAIL (Wenn eingerichtet) die eingereichten Datenfelder in Form einer Liste angefügt.');
	define('M4J_LANG_DATA_LISTING_DESC','Wenn diese Option aktiviert ist, werden der HAUPT-EMAIL [An die angegebene Emailaddresse(n)] die eingereichten Datenfelder in Form einer Liste angefügt.');
	define('M4J_LANG_EMAIL_FORMAT_DESC','Bitte geben Sie hier die E-Mail Adresse(n) für die Hauptemail an. Mehrfach- Adressen (Soweit das Ihr Mailserver unterstützt) trennen Sie bitte mit einem Semikolon [;] oder einem Komma [,]. Bitte testen Sie ob Ihr Mailserver die Semikolon- oder die Komma-Notation unterstützt. Sie können nicht beide Notationen verwenden.');
	define('M4J_LANG_EMAIL_SUBJECT_DESC','Bitte geben Sie einen Betreff ein. Der Betreff wir auch für die Bestätigungsmail verwendet. Sie können auch hier Feldwerte einfügen indem Sie einen Feldalias in geschweifte Klammern setzen.');
	define('M4J_LANG_STORAGE_MAIL_HEADING','Emailmanager! - Formular');
	define('M4J_LANG_STORAGE_MAIL_DESTINATION','Zielbestimmung');
	define('M4J_LANG_MAIL_DESTINATION','Zielbestimmung');
	define('M4J_LANG_ALL_RECORDS','Alle Einträge');
	define('M4J_LANG_FILTERED_RECORDS','Suchergebnisse');
	define('M4J_LANG_MAIL_ONLY_CONFIRMED','Email nur an bestätigte Einräge versenden');
	define('M4J_LANG_TO','An');
	define('M4J_LANG_MAIL_ADDRESS_IS','Emailadresse ist');
	define('M4J_LANG_UNIQUE_OF_FORM','Eindeutige Emailadresse des Formulars');
	define('M4J_LANG_USER_MAIL_ADDRESS','Adresse des Joomla Users (Systemadresse)');
	define('M4J_LANG_SENDING_CONDITIONS','Sendeoptionen');
	define('M4J_LANG_FIELD_ITEM','Feldelement');
	define('M4J_LANG_PROGRESS','Fortschritt');
	define('M4J_LANG_SECONDS','Sekunden');
	define('M4J_LANG_NORMAL','Normal');
	define('M4J_LANG_HIGH','Hoch');
	define('M4J_LANG_PRIO','Priorität');
	define('M4J_LANG_SENDING_INTERVAL','Sendeintervall');
	define('M4J_LANG_MAILS_AT_ONCE','Mails auf einmal');
	define('M4J_LANG_SEND','Senden');
	define('M4J_LANG_SAVE_AS_TEMPLATE','Als Vorlage Speichern');
	define('M4J_LANG_GET_FROM_TEMPLATE','Aus Vorlage erstellen');
	define('M4J_LANG_SENDING_BEGUN','Die Versendung der Emails hat begonnen!');
	define('M4J_LANG_SENDING_ADVICE_1','Schließen Sie nicht das Browser Fenster!');
	define('M4J_LANG_SENDING_ADVICE_2','Schließem Sie nicht das Popup!');
	define('M4J_LANG_SENDING_ADVICE_3','Laden Sie nicht die Seite neu!');
	define('M4J_LANG_SENDING_ADVICE_4','Achten Sie darauf, dass Ihre Session nicht abgelaufen ist. <br/>Sollte Sie abgelaufen sein brechen Sie den Sendevorgang ab und melden Sie sich neu an!');
	define('M4J_LANG_SENDING_ADVICE_5','Wenn Sie den Sendevorgang abbrechen möchten, klicken Sie den Abbruch Knopf auf der rechten oberen Seite!');
	define('M4J_LANG_FOUND_STORAGE_ITEMS','Gefundene Einträge');
	define('M4J_LANG_PROTOCOL','Protokoll');
	define('M4J_LANG_NOFROMNAME','Geben Sie bitte einen Absendernamen an.');
	define('M4J_LANG_NOFROMMAIL','Geben Sie bitte eine Absender-Emailadresse an.');
	define('M4J_LANG_NOVALIDFROMADDRESS','Die Absender-Emailadresse ist keine gültige Emailadresse.');
	define('M4J_LANG_NO_SUBJECT','Bitte geben Sie einen Betreff ein!');
	define('M4J_LANG_OVERWRITE_DELETE','Überschreiben / Löschen');
	define('M4J_LANG_BODY_TOGGLE_DESC','Bitte bestimmen Sie zuerst ob Sie HTML Mails verwenden wollen oder nicht. Bei dem Umschalten zwischen HTML und Nicht-HTML-Mails werden bereits erstellte Mailinhalte nicht in das jeweilige Eingabefenster übernommen weil die automatische Konvertierung zwangsweise zu Fehlern in der Formatierung führen würde!');
	define('M4J_LANG_FROMNAME','Absendername');
	define('M4J_LANG_FROMMAIL','Absender-Email');
	define('M4J_LANG_CLOSE','Schließen');
	define('M4J_LANG_SENDING_CANCELED','Versendung abgebrochen!');
	define('M4J_LANG_MAIL_SENDING_END','Versendung der Emails ist beendet!');
	define('M4J_LANG_SENDING_CHUNK','Sendeabschnitt');
	define('M4J_LANG_SENT','Versendet');
	define('M4J_LANG_FAILED','Nicht vesendet');
	define('M4J_LANG_NOVALIDADDRESS','ohne gültige Emailadresse.');
	define('M4J_LANG_APPS_HEADING','Apps für Formular');
	define('M4J_LANG_INSTALL_UNINSTALL','Installieren/Deinstallieren');
	define('M4J_LANG_BACKUP','Import/Export');
	define('M4J_LANG_START_EXPORT','Export starten');
	define('M4J_LANG_START_IMPORT','Import starten');
	define('M4J_LANG_DB_EXPORT','Datenbank Export');
	define('M4J_LANG_DB_IMPORT','Datenbank Import');
	define('M4J_LANG_IGNORE_CONFIG','Konfigurationsdaten ignorieren');
	define('M4J_LANG_IGNORE_APPS','App-Daten ignorieren');
	define('M4J_LANG_IGNORE_RECORDS','Benutzereinträge ignorieren');
	define('M4J_LANG_BACKUPERROR_1','Die Backupdatei ist nicht kompatibel mit der Pro-Version sondern mit der Basic-Version.');
	define('M4J_LANG_BACKUPERROR_2','Die Backupdatei ist nicht kompatibel zu diesem Build (%s)');
	define('M4J_LANG_BACKUPERROR_3','Die Datei ist keine Proforms Backupdatei');
	define('M4J_LANG_BACKUPERROR_4','Fehler beim Hochladen der Datei! Bitte überprüfen Sie ob der Joomlaordner "tmp" die richtigen Schreibrechte besitzt oder ob Sie überhaupt Schreibrechte besitzen.');
	define('M4J_LANG_BACKUPERROR_5','Es wurde entweder keine Datei hochgeladen oder die Datei ist keine SQL Datei.');
	define('M4J_LANG_BACKUPERROR_6','Ein Fehler ist beim Ausführen des Backups aufgetreten. Die Datei scheint beschädigt zu sein oder Ihr MySQL ist nicht kompatibel zum Backup.');
	define('M4J_LANG_EXTENSIONS','Erweiterungen');
	define('M4J_LANG_APPS','Apps');
	
	define('M4J_LANG_ACTIVEAPP_DESC','Inaktive Apps können nicht auf Formulare angewandt werden oder werden im Frontend nicht angezeigt, wenn Sie eine Frontenddarstellung besitzen.');
	define('M4J_LANG_ADMINISTRATION','Admin');
	define('M4J_LANG_ADMINISTRATION_DESC','Wenn ein App einen generellen Anwendungs- bzw. Administrationsbereich besitzt, können Sie diesen mit \'Start\' aufrufen.');
	define('M4J_LANG_START','Start');
	define('M4J_LANG_FRONTEND_VIEW_DESC','Wenn dieses App eine Frontendanzeige besitzt, können Sie die Frontendanzeige über ein Menü verlinken. Die Konfiguration erfolgt für jedes Formular über den Knopf: \'App\' in der Formularauflistung.');
	define('M4J_LANG_PLUGIN','Plugin');
	define('M4J_LANG_PLUGIN_DESC','Zeigt an ob das App ein Plugin besitzt. Plugins beeinflussen ein Formular in der Darstellung und Ausführung. Die Konfiguration erfolgt für jedes Formular über den Knopf: \'App\' in der Formularauflistung.');
	define('M4J_LANG_AUTHOR','Author / Info');
	define('M4J_LANG_CREATED','Installiert');
	define('M4J_LANG_VERSION','Version');
	define('M4J_LANG_NOT_ACTIVE','Nicht aktiv');
	define('M4J_LANG_REALLYUNINSTALL_APP','Möchten Sie das ausgewählte App wirklich deinstallieren?');
	define('M4J_LANG_NOAPPSELECTED','Sie haben kein App ausgewählt!');
	define('M4J_LANG_KLICKFORACTIVATE','Klicken zur Aktivierung');
	define('M4J_LANG_KLICKFORDEACTIVATE','Klicken zur Deaktivierung');
	define('M4J_LANG_HELPDESK','Helpdesk');
	define('M4J_LANG_TEXT','Text');
	define('M4J_LANG_ADDOPTION','Option hinzufügen');
	define('M4J_LANG_USEVALUES','Abweichende Werte verwenden');
	define('M4J_LANG_USEVALUES_DESC','Wenn diese Option aktiviert ist können Sie abweichende Werte verwenden. Ist diese Option deaktiviert sind die übermittelten Werte gleich den Texten. Bitte beachten Sie, dass wenn ein Wertfeld leer glassen wird und es sich hierbei um ein Pflichtfeld handelt, dass dieses als nicht ausgewählt angesehen wird. Wenn Sie die Zahl 0 verwenden wird dieses in Emails und Datenbank nicht angezeigt. Verwenden Sie stattdessen den Ausdruck 0.0');
	define('M4J_LANG_ERROR_ALIAS', "Ein Alias muss aus mindestens 2 Buchstaben bestehen und darf nicht folgende Zeichen enthalten:\u000a   /, \\\ , ? , & , [ , ] , ( , ) , * , + , \\\", \' ");
	define('M4J_LANG_BACKUP_DESC','Vertrauen Sie keinen fremden Backupdateien, es sei denn, Diese stammen von Mad4Media / Mooj.org oder wurden von uns zertifiziert! <br/>Fremde Backupdateien können schädlichen Code enthalten und Ihre Datenbank / Ihr Joomla zerstören. <br><b>Wenn Sie eine Backup importieren gehen alle alten Einstellungen unwiederbringlich verloren!</b>');
	define('M4J_LANG_INFO','Information');
	define('M4J_LANG_NOAPPFORJID','Für dieses Formular steht kein App mit Frontenddarstellung zur Verfügung');
	define('M4J_LANG_ITEM_HIDDEN','Verstecktes Feld');
	$m4j_lang_elements[23]= 'Verstecktes Feld';
	define('M4J_LANG_PAYPAL_LC','Spachen-Länder-Code');
	define('M4J_LANG_PAYPAL_LC_DESC','Sie können bestimmen in welcher Sprache die Paypaleinstiegsseite angezeigt werden soll. Paypal verwendet hierzu einen Länderkennzeichen anstatt eines Sprachenkodes. Ebenso gibt es nur eine bestimmte Anzahl von zulässigen Länderkodes. Steht der hier angegebene Code nicht zur Verfügung wird stets `US`, also Englisch genommen. Wenn kein Ländercode verwendet  wird, entscheidet Paypal selbst anhand des Browser welche Sprache genommen wird.');
	define('M4J_LANG_DONT_USE','Nicht verwenden');
	define('M4J_LANG_IMPORTANT_INFO','Wichtige Information');
	define('M4J_LANG_IMPORTANT_INFO_INNER','Der Emailmanager verwendet eine ganz neue Technik zur schnellen, parallelen Versendung von Massenmails.<br/> Wenn Sie in der Joomla Konfiguration `Sendmail` oder `PHPmail` als Sendemethode ausgewählt haben und Massenmails in zu kurzen Intervallen versenden, ist es möglich, dass Ihr Hostingprovider dies als Spamversand von einer entführten Seite interpretiert.<br/> Einige Hostingprovider schließen und blockieren daraufhin Ihre Internetseite und sämtliche Ihrer anderen Seiten die sich auf dem gleichen Paket befinden für einen gewissen Zeitraum oder bis Sie den Sachverhalt aufklären. In dieser Zeit ist/sind Ihre Seite(n) nicht erreichbar!<br/> Deswegen empfehlen wir zur Versendung von Massenmails stets die `SMTP` Methode zu verwenden und Ihre Sendeintervalle so einzustellen, dass ein Abschnitt erst zu Senden anfangt wenn der vorherige Sendeabschnitt beendet wurde.<br/>Bevor Sie den Email Manager zur Versendung von Massenmails benutzen lesen Sie die entsprechende Anleitung (Nur in Englischer Sprache verfügbar) auf dem Helpdesk.<br/><b>Diese Software unterliegt der GNU/GPL Lizenz weswegen es keinerlei Gewährleistung für diese Software besteht.<br/>Mad4Media übernimmt keinerlei Haftung für Schäden die durch die Anwendung dieser Software entstehen!</b>');
	define('M4J_LANG_APPINSTALL_SUCCESS','App wurde erflogreich installiert! ');
	define('M4J_LANG_APPUNINSTALL_SUCCESS','App wurde erfolgreich deinstalliert! ');
	define('M4J_LANG_PATCHINSTALL_SUCCESS','Patch wurde erfolgreich installiert! ');
	define('M4J_LANG_BACKUP_SUCCESS','Ihre Proforms Datenbank wurde erfolgreich wiederhergestellt! ');
	define('M4J_LANG_ONLYPRO','Nur für PRO Version');
	define('M4J_LANG_ONLYPRO_DESC','<span style=\'color:red; font-weight:bold\'>Diese Funktion ist nur in der PRO Version möglich!</span>');
	define('M4J_LANG_ONLYONETEMPLATE','In der Basic Version können Sie nur EINE Formularvorlage zuweisen.<br> In der PRO Version können Sie Ihre Formular aus mehreren Vorlagen zusammenstellen!');
	define('M4J_LANG_','');
?>
