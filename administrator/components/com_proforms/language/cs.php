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

	/** Czech translation by Milan Šedý - wortyr@woraif.cz, http://www.woraif.cz */


	defined( '_JEXEC' ) or die( 'Přímý přístup na toto místo není povolen.' );
	
	$m4j_lang_elements[1]= 'Zaškrtávací políčko';
	$m4j_lang_elements[2]= 'Přepínač ano/ne';
	$m4j_lang_elements[10]= 'Datum';
	$m4j_lang_elements[20]= 'Jednoduchý text';
	$m4j_lang_elements[21]= 'Víceřádkový text';
	$m4j_lang_elements[30]= 'Menu(výber jedné možnosti)';
	$m4j_lang_elements[31]= 'Výběrové menu(výber jedné možnosti)';
	$m4j_lang_elements[32]= 'Přepínač(výběr jedné možnosti)';
	$m4j_lang_elements[33]= 'Zašktávání(výběr více možností)';
	$m4j_lang_elements[34]= 'List(multiple choice)';
	
	
	define('M4J_LANG_FORMS','Formuláře');
	define('M4J_LANG_TEMPLATES','Šablony');
	define('M4J_LANG_CATEGORY','Kategorie');
	define('M4J_LANG_CONFIG','Konfigurace');
	define('M4J_LANG_HELP','Info & nápověda');
	define('M4J_LANG_CANCEL','Zrušit');
	define('M4J_LANG_PROCEED','Pokračovat');
	define('M4J_LANG_SAVE','Uložit');
	define('M4J_LANG_NEW_FORM','Nový formulář');
	define('M4J_LANG_NEW_TEMPLATE','Nová šablona');
	define('M4J_LANG_ADD','Přidat');
	define('M4J_LANG_EDIT_NAME','Upravit název a popis této šablony');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Nová šablona');
	define('M4J_LANG_TEMPLATE_NAME','Název této šablony');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Upravit název této šablony');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Krátký popis (pro vnitřní potřeby; může zůstat prázdné)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Upravit krátký popis');
	define('M4J_LANG_DELETE','Smazat');
	define('M4J_LANG_DELETE_CONFIRM','Opravdu chcete tuto položku vymazat?');
	define('M4J_LANG_NEW_CATEGORY','Nová kategorie');
	define('M4J_LANG_NAME','Název');
	define('M4J_LANG_SHORTDESCRIPTION','Krátký popis');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Položky');
	define('M4J_LANG_EDIT','Upravit');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Položky -> Upravit');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Vložte prosím název této šablony!');
	define('M4J_LANG_AT_LEAST_ONE','Není možné vymazat položku!<br/>Musí zde být alespoň jedna položka.');	

	
		define('M4J_LANG_EDIT_ELEMENT','Upravit položku šablony: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Vložte prosím název kategorie');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Vložte prosím platnou e-mailovou adresu, nebo nechte pole prázdné.<br/>');
	define('M4J_LANG_EMAIL','E-mail');
	define('M4J_LANG_POSITION','Objednávky');
	define('M4J_LANG_ACTIVE','Aktivní');
	define('M4J_LANG_UP','Nahoru');
	define('M4J_LANG_DOWN','Dolů');
	define('M4J_LANG_EDIT_CATEGORY','Upravit kategorii');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Položky na šabloně: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Přidat novou položku na šablonu: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Prosím vložte otázku.');
	define('M4J_LANG_REQUIRED','Povinné');
	define('M4J_LANG_QUESTION','Otázka');
	define('M4J_LANG_TYPE','Typ');
	define('M4J_LANG_YES','Ano');		
	define('M4J_LANG_NO','Ne');	
	define('M4J_LANG_ALL_FORMS','Všechny formuláře');
	define('M4J_LANG_NO_CATEGORYS','Bez kategorie');
	define('M4J_LANG_FORMS_OF_CATEGORY','Formuláře v kategorii: ');
	define('M4J_LANG_PREVIEW','Náhled');
	define('M4J_LANG_DO_COPY','Kopírovat');		
	define('M4J_LANG_COPY','Kopírovat');
	define('M4J_LANG_VERTICAL','Vertikální');
	define('M4J_LANG_HORIZONTAL','Horizontální');
	define('M4J_LANG_EXAMPLE','Příklad');
	define('M4J_LANG_CHECKBOX','Tlačítko');	
	define('M4J_LANG_DATE','Datum');
	define('M4J_LANG_TEXTFIELD','Textové pole');
	define('M4J_LANG_OPTIONS','Vybraná volba');
	define('M4J_LANG_CHECKBOX_DESC','Jednoduchá otázka ano/ne.');
	define('M4J_LANG_DATE_DESC','Uživatel musí vložit datum.');
	define('M4J_LANG_TEXTFIELD_DESC','Užvatel musí vložit vlastní text.');
	define('M4J_LANG_OPTIONS_DESC','Uživatel vybere jednu nebo více odpovědí z dostupné nabídky. ');
	define('M4J_LANG_CLOSE_PREVIEW','Zavřít náhled');
	define('M4J_LANG_Q_WIDTH','Šířka sloupce s otázkami. (vlevo)');
	define('M4J_LANG_A_WIDTH','Šířka sloupce s odpověďmi. (vpravo)');
	define('M4J_LANG_OVERVIEW','Přehled');
	define('M4J_LANG_UPDATE_PROCEED','& Pokračovat');
	define('M4J_LANG_NEW_ITEM','Nová položka');
	define('M4J_LANG_EDIT_ITEM','Upravit položku');
	define('M4J_LANG_CATEGORY_NAME','Jméno kategorie');
	define('M4J_LANG_EMAIL_ADRESS','E-mailová adresa');
	define('M4J_LANG_ADD_NEW_ITEM','Přidat novou položku:');
	define('M4J_LANG_YOUR_QUESTION','Vaše otázka');
	define('M4J_LANG_REQUIRED_LONG','Povinná?');
	define('M4J_LANG_HELP_TEXT','Text nápovědy. Podejté uživatelům nápovědu k vaší otázce (nepovinné)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Typ tlačítka:');
	define('M4J_LANG_ITEM_CHECKBOX','Zaškrávací pole.');
	define('M4J_LANG_YES_NO_MENU','Menu Ano/ne.');
	define('M4J_LANG_YES_ON','ano/ne.');
	define('M4J_LANG_NO_OFF','ne/vypnuto.');
	define('M4J_LANG_INIT_VALUE','Předvyplněná hodnota:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Typ textového pole:');
	define('M4J_LANG_ITEM_TEXTFIELD','Textové pole');
	define('M4J_LANG_ITEM_TEXTAREA','Textová oblast');
	define('M4J_LANG_MAXCHARS_LONG','Maximální počet znaků:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Vizuální zarovnání:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Šířka v pixelech</b> <br/>(Přidáním \'%\' nastavíte šířku procentuálně. Prázdné = automaticky)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Počet viditelných řádků:</b><br/> (pouze pro textové oblasti)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Menu</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Přepínače</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Seznam</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(výběr jedné položky)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Skupina zaškrtávacích polí</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Seznam</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(výběr více možností užitím \'CTRL\' + levé tlačítko myši)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Jedna možnost (může být vybrána pouze 1 položka):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Více možností (může být vybráno více položek):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Typ výběru:');
	define('M4J_LANG_ROWS_LIST','<b>Počet viditelných řádků:</b><br/> (pouze pro seznamy)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Zarovnání: </b> <br/>(pouze pro přepínače a skupiny zaškrtávacích polí)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Popište odpovědi.<br/>Prázdná pole budou ignorována.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Úvodní text. Bude zobrazen pouze na stránce s kategoriemi.');
	define('M4J_LANG_TITLE','Nadpis');
	define('M4J_LANG_ERROR_NO_TITLE','Prosím vložte nadpis.');
	define('M4J_LANG_USE_HELP','Text nápovědy do bubliny');
	define('M4J_LANG_TITLE_FORM','Nadpis formuláře');
	define('M4J_LANG_INTROTEXT','Úvodní text');
	define('M4J_LANG_MAINTEXT','Hlavní text');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Úvodní text odeslaného e-mailu. (Použije se pouze v e-mailech.)');
	define('M4J_LANG_TEMPLATE','Šablona');
	define('M4J_LANG_LINK_TO_MENU','Odkaz do menu');
	define('M4J_LANG_LINK_CAT_TO_MENU','Odkázat vybranou kategorii do menu.');
	define('M4J_LANG_LINK_TO_CAT','Odkázat kategorii: ');
	define('M4J_LANG_LINK_TO_FORM','Odkázat formulář: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Odkaz k zobrazení všech formulářů bez kategorií ');
	define('M4J_LANG_LINK_TO_ALL_CAT','Odkaz k zobrazení přehledu \'Všechny kategorie\'');
	define('M4J_LANG_CHOOSE_MENU','Vyberte menu, na které se odkázat: ');
	define('M4J_LANG_MENU','Menu: ');
	define('M4J_LANG_NO_LINK_NAME','Vložte prosím název odkazu.');
	define('M4J_LANG_PUBLISHED','Zveřejněno:');
	define('M4J_LANG_PARENT_LINK','Nadřazený odkaz');
	define('M4J_LANG_LINK_NAME','Název odkazu');
	define('M4J_LANG_ACCESS_LEVEL','Přístupová úroveň:');
	define('M4J_LANG_EDIT_MAIN_DATA','Upravit základní data');
	define('M4J_LANG_LEGEND','Legenda');
	define('M4J_LANG_LINK','Odkaz');
	define('M4J_LANG_IS_VISIBLE',' je zveřejněn');
	define('M4J_LANG_IS_HIDDEN',' není zveřejněn');
	define('M4J_LANG_FORM','Formulář');
	define('M4J_LANG_ITEM','Položka');
	define('M4J_LANG_IS_REQUIRED','Povinné');
	define('M4J_LANG_IS_NOT_REQUIRED','Nepovinné');
	define('M4J_LANG_ASSIGN_ORDER','Řazení');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Řazení není dostupné pro kategorii \'Všechny formuláře\'!<br/>');
	define('M4J_LANG_EDIT_FORM','Upravit formuláře');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Zveřejněno! Kliknutím zneveřejnit.');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Neveřejné! Kliknutím zveřejnit.');
	define('M4J_LANG_HOVER_REQUIRED_ON','Povinné! Kliknutím nastavit na nepovinné.');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Nepovinné! Kliknutím nastavit na povinné.');
	define('M4J_LANG_DESCRIPTION','Popis');
	define('M4J_LANG_AREA','Oblast');
	define('M4J_LANG_ADJUSTMENT','Konfigurace');
	define('M4J_LANG_VALUE','Hodnota');
	define('M4J_LANG_MAIN_CONFIG','Zázkadní konfigurace:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Zde můžete nastavit všechna základní nastavení. Pokud chcete všechna základní nastavení resetovat (včetně CSS) na výchozí, klikněte na reset.');
	define('M4J_LANG_CSS_CONFIG','CSS nastavení:');
	define('M4J_LANG_CSS_CONFIG_DESC','Tyto nastavení jsou potřebná pro vizuální prezentaci na webu. Pokud nemáte zkušenosti s vkládáním vlastních CSS stylů, neměňte tyto hodnoty!');
	define('M4J_LANG_RESET','Reset');
			
	define('M4J_LANG_EMAIL_ROOT', 'Výchozí e-mailová adresa: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Maximální počet odpovědí <br/> výběrových polí: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Šířka náhledu: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Výška náhledu: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Platnost Captcha obrázku (v min): ' );
	define('M4J_LANG_HELP_ICON', 'Ikona nápovědy: ' );
	define('M4J_LANG_HTML_MAIL', 'HTML E-mail: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Zobrazit legendu: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'Výchozí e-mailová adresa se použije, pokud nebyl zadán e-mail ani u formuláře, ani u kategorie.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Tato hodnota určuje maximální počet odpovědí ve výběrovém poli. Hodnota musí být číselná.' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Šířka okna s náhledem šablony. Tato hodnota se použije pouze v případě, že nezvolíte šířku náhledu v základním nastavení.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Šířka náhledu šablony. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Určuje dobu, po kterou je platný kód z obrázku captcha, který musí uživatel opsat před odesláním.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Určuje barvu ikony nápovědy.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Pokud chcete dostávat e-maily v HTML formátu, zvolte ano. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Pokud chcete v administraci zobrazovat legendu, zvolte ano.' );
	
	define('M4J_LANG_CLASS_HEADING', 'Blok hlavičky:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Text hlavičky' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Oblast výpisu' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Výpis - hlavička' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Výpis - úvodní text ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Oblast formuláře ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Formulář - tabulka ' );
	define('M4J_LANG_CLASS_ERROR', 'Chybová hlášení' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Oblast tlačítka "Odeslat"' );
	define('M4J_LANG_CLASS_SUBMIT', 'Tlačitko  "Odeslat"' );
	define('M4J_LANG_CLASS_REQUIRED', 'CSS * - označení povinné' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Nadpis stránky ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Obsah po nadpisu stránky. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Oblast výpisu položek.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Nadpis výpisu položek. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Úvodní text výpisu položek. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Oblast formuláře. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> -Tabulka, ve které jsou obsaženy položky formuláře.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - CSS třída výpisu chybových zpráv. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Oblast s tlačítkem na odeslání dat.' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - CSS třída tlačítka na odeslání dat. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - CSS třída znaku \' <b>*</b> \', který označuje povinné položky.' );
	
	define('M4J_LANG_INFO_HELP','Info a nápověda');
	
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Captcha metoda: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Běžná');
	
	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','Nastavení úspěšně nastaveno na výchozí.');
		define('M4J_LANG_CONFIG_SAVED','Nastavení úspěšně uloženo.');
		define('M4J_LANG_CAPTCHA_DESC', ' Je možné, že se na některých serverech nebo u některých šablon objeví potíže výchozí CSS captcha. V tomto případě máte možnost volby "Běžná captcha". Pokud ani ta nevyřeší vaše problémy, použijte možnost "Speciální"' );
		define('M4J_LANG_SPECIAL','Speciální');
	
	
	define('M4J_LANG_MAIL_ISO','Kódování e-mailu');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (západní Evropa), iso-8859-4 (Balt), iso-8859-5 (cyrilice), iso-8859-6 (arabské), iso-8859-7 (řecké), iso-8859-8 (hebrejské),iso-8859-9 (turecké), iso-8859-10 (norské),iso-8859-11 (thajské)');		
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Příloha';	
	define('M4J_LANG_ATTACHMENT','Soubor přílohy');
	define('M4J_LANG_ATTACHMENT_DESC','Uživatel může pomocí formuláře vložit soubor.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Vložte parametry pro pole odeslání souboru:');
	define('M4J_LANG_ALLOWED_ENDINGS','Povolené přípony souborů.');
	define('M4J_LANG_MAXSIZE','Maximální velikost.');
	define('M4J_LANG_BYTE','Bajt');
	define('M4J_LANG_KILOBYTE','Kilobajt');
	define('M4J_LANG_MEGABYTE','Megabajt');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Všechny přípony prosím vložte bez tečky a oddělte je <b>čárkami</b>. Pokud necháte pole prázdná, bude odeslán soubor s libovolnou příponou neomezené velikosti. K usnadnění práce si můžete vybrat s přípon níže, které budou zahrnuty automaticky.');
	define('M4J_LANG_IMAGES','Obrázky');
	define('M4J_LANG_DOCS','Dokumenty');
	define('M4J_LANG_AUDIO','Audio');
	define('M4J_LANG_VIDEO','Video');										   
    define('M4J_LANG_DATA','Data');
	define('M4J_LANG_COMPRESSED','Archivy');
	define('M4J_LANG_OTHERS','Ostatní');
	define('M4J_LANG_ALL','Všechny');
	
	// New to Version 1.1.9
	define('M4J_LANG_FROM_NAME','Odesláno od');
	define('M4J_LANG_FROM_EMAIL','Odesláno z e-mailu');
	define('M4J_LANG_FROM_NAME_DESC','Jméno (název), které bude uvedeno v emailech jako odesilatel<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','E-mail, který bude v odchozích e-mailech uveden jako odesílatel.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Vyrování! Všechny formuláře, které obsahují tuto šablonu budou také vymazány!');
	

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