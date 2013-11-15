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

	/**  MACEDONIAN VERSION. */


	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
	
	$m4j_lang_elements[1]= 'Штиклирање';
	$m4j_lang_elements[2]= 'Да/Не селекција';
	$m4j_lang_elements[10]= 'Датум';
	$m4j_lang_elements[20]= 'Текст поле';
	$m4j_lang_elements[21]= 'Текст површина';
	$m4j_lang_elements[30]= 'Мени(единечен избор)';
	$m4j_lang_elements[31]= 'Одбери мени(единечен избор)';
	$m4j_lang_elements[32]= 'Радио копчиња(единечен избор)';
	$m4j_lang_elements[33]= 'Група штиклирања(множински избор)';
	$m4j_lang_elements[34]= 'Листа(множински избор)';
	
	
	define('M4J_LANG_FORMS','Форми');
	define('M4J_LANG_TEMPLATES','Шаблони');
	define('M4J_LANG_CATEGORY','Категорија');
	define('M4J_LANG_CONFIG','Конфигурација');
	define('M4J_LANG_HELP','Инфо и Помош');
	define('M4J_LANG_CANCEL','Откажи');
	define('M4J_LANG_PROCEED','Изврши');
	define('M4J_LANG_SAVE','Зачувај');
	define('M4J_LANG_NEW_FORM','Нова форма');
	define('M4J_LANG_NEW_TEMPLATE','Нов шаблон');
	define('M4J_LANG_ADD','Додади');
	define('M4J_LANG_EDIT_NAME','Уредете име и опис на овој шаблон');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Нов шаблон');
	define('M4J_LANG_TEMPLATE_NAME','Име на овој шаблон');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Уредете го името наовој шаблон');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Краток опис (за интерна употреба. Може да остане празно)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Уредете краток опис');
	define('M4J_LANG_DELETE','Избриши');
	define('M4J_LANG_DELETE_CONFIRM','Дали навистина сакате да го избришете овој дел?');
	define('M4J_LANG_NEW_CATEGORY','Нова категорија');
	define('M4J_LANG_NAME','Име');
	define('M4J_LANG_SHORTDESCRIPTION','Краток опис');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Делови');
	define('M4J_LANG_EDIT','Уреди');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Делови -> Уреди');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Молам внесете име за овој шаблон!');
	define('M4J_LANG_AT_LEAST_ONE','Овој дел не може да биде избришан!<br/>Мора да има барем еден елемент тука.');	

	
	define('M4J_LANG_EDIT_ELEMENT','Уредете дел од шаблонот: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Молам внесете име на категорија');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Молам внесете валидна e-mail адреса или оставете празно.<br/>');
	define('M4J_LANG_EMAIL','e-Mail');
	define('M4J_LANG_POSITION','Редослед');
	define('M4J_LANG_ACTIVE','Активно');
	define('M4J_LANG_UP','Горе');
	define('M4J_LANG_DOWN','Долу');
	define('M4J_LANG_EDIT_CATEGORY','Уредете категорија');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Елементи од шаблон: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Вметнете нов елемент во шаблонот: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Молам вметнете прашање.');
	define('M4J_LANG_REQUIRED','Барано');
	define('M4J_LANG_QUESTION','Прашање');
	define('M4J_LANG_TYPE','Тип');
	define('M4J_LANG_YES','Да');		
	define('M4J_LANG_NO','Не');	
	define('M4J_LANG_ALL_FORMS','Сите форми');
	define('M4J_LANG_NO_CATEGORYS','Без категорија');
	define('M4J_LANG_FORMS_OF_CATEGORY','Форми од категорија: ');
	define('M4J_LANG_PREVIEW','Првоглед');
	define('M4J_LANG_DO_COPY','Копирај');		
	define('M4J_LANG_COPY','Копирај');
	define('M4J_LANG_VERTICAL','Вертикално');
	define('M4J_LANG_HORIZONTAL','Хоризонтално');
	define('M4J_LANG_EXAMPLE','Пример');
	define('M4J_LANG_CHECKBOX','Копче');	
	define('M4J_LANG_DATE','Датум');
	define('M4J_LANG_TEXTFIELD','Текст поле');
	define('M4J_LANG_OPTIONS','Посочете избор');
	define('M4J_LANG_CHECKBOX_DESC','Едноставно Да/Не прашање.');
	define('M4J_LANG_DATE_DESC','Корисникот треба да внесе датум.');
	define('M4J_LANG_TEXTFIELD_DESC','Корисникот треба да внесе текст.');
	define('M4J_LANG_OPTIONS_DESC','Корисникот одбира едно или повеќе од посочените. ');
	define('M4J_LANG_CLOSE_PREVIEW','Затвори првоглед');
	define('M4J_LANG_Q_WIDTH','Широчина на колоната за прашање. (лево)');
	define('M4J_LANG_A_WIDTH','Широчина на колоната за одговор. (десно)');
	define('M4J_LANG_OVERVIEW','Преглед');
	define('M4J_LANG_UPDATE_PROCEED','и изврши');
	define('M4J_LANG_NEW_ITEM','Нов дел');
	define('M4J_LANG_EDIT_ITEM','Уреди дел');
	define('M4J_LANG_CATEGORY_NAME','Имена категорија');
	define('M4J_LANG_EMAIL_ADRESS','E-mail адреса');
	define('M4J_LANG_ADD_NEW_ITEM','Додадете нов дел:');
	define('M4J_LANG_YOUR_QUESTION','Вашето прашање');
	define('M4J_LANG_REQUIRED_LONG','Барани?');
	define('M4J_LANG_HELP_TEXT','Помошен текст. Му дава на корисникот помош околу вашето прашање.(незадолжително)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Тип на копче:');
	define('M4J_LANG_ITEM_CHECKBOX','Штиклирање.');
	define('M4J_LANG_YES_NO_MENU','Да/Не мени.');
	define('M4J_LANG_YES_ON','Да/Вкл.');
	define('M4J_LANG_NO_OFF','Не/Иск.');
	define('M4J_LANG_INIT_VALUE','Почетна вредност:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Тип на текст поле:');
	define('M4J_LANG_ITEM_TEXTFIELD','Текст поле');
	define('M4J_LANG_ITEM_TEXTAREA','Текст површина');
	define('M4J_LANG_MAXCHARS_LONG','Макс. карактери:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Визуелно порамнување:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Широчина во пиксели</b> <br/>(Додадете \'%\' за проценти. Празно = автособирање)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Број на видливи редови:</b><br/> (Само за текст површина)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Мени</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Радио копчиња</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Листа</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(единечен избор)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Група за штиклирање</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Листа</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(множински избор, со \'CTRL\' и левото копче од глувчето)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Единечен избор (Само еден дел може да биде одбран):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Множински избор (Повеќе делови можат да бидат избрани):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Тип на избор:');
	define('M4J_LANG_ROWS_LIST','<b>Број на видливи редови:</b><br/> (Само за листи)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Порамнување: </b> <br/>(Само за Радио копчиња и Групи за штиклирање)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Посочете одговори.<br/>Празните полиња ќе бидат игнорирани.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Воведен текст. Ќе биде прикажан единствено на страниците на категориите.');
	define('M4J_LANG_TITLE','Наслов');
	define('M4J_LANG_ERROR_NO_TITLE','Молам внесете наслов.');
	define('M4J_LANG_USE_HELP','Помошен текст за во балонче');
	define('M4J_LANG_TITLE_FORM','Наслов на форма');
	define('M4J_LANG_INTROTEXT','Воведен текст');
	define('M4J_LANG_MAINTEXT','Главен текст');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Воведен текст за E-mail. (Ќе биде прикажан само за поштата.)');
	define('M4J_LANG_TEMPLATE','Шаблон');
	define('M4J_LANG_LINK_TO_MENU','Поврзи до мени');
	define('M4J_LANG_LINK_CAT_TO_MENU','Поврзете ја категоријата со мени');
	define('M4J_LANG_LINK_TO_CAT','Поврзи категорија: ');
	define('M4J_LANG_LINK_TO_FORM','Поврзи форма: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Врска за приказ на сите форми без категории ');
	define('M4J_LANG_LINK_TO_ALL_CAT','Врска за приказ на \'Сите категории\'');
	define('M4J_LANG_CHOOSE_MENU','Одберете мени за врска до: ');
	define('M4J_LANG_MENU','Мени: ');
	define('M4J_LANG_NO_LINK_NAME','Молам внесете име за врската.');
	define('M4J_LANG_PUBLISHED','Објавено:');
	define('M4J_LANG_PARENT_LINK','Родителска врска');
	define('M4J_LANG_LINK_NAME','Име на врска');
	define('M4J_LANG_ACCESS_LEVEL','Ниво на пристап:');
	define('M4J_LANG_EDIT_MAIN_DATA','Уредете основни податоци');
	define('M4J_LANG_LEGEND','Легенда');
	define('M4J_LANG_LINK','Врска');
	define('M4J_LANG_IS_VISIBLE',' е објавена');
	define('M4J_LANG_IS_HIDDEN',' не е објавена');
	define('M4J_LANG_FORM','Форма');
	define('M4J_LANG_ITEM','Дел');
	define('M4J_LANG_IS_REQUIRED','Барано');
	define('M4J_LANG_IS_NOT_REQUIRED','Небарано');
	define('M4J_LANG_ASSIGN_ORDER','Редослед');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Редоследот не е можен за \'Сите форми\' !<br/>');
	define('M4J_LANG_EDIT_FORM','Уредете форми');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Објавено! Клик=Необјавено');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Необјавено! Клик=Објавено');
	define('M4J_LANG_HOVER_REQUIRED_ON','Барано! Клик= Небарано');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Неабарано! Клик= Барано');
	define('M4J_LANG_DESCRIPTION','Опис');
	define('M4J_LANG_AREA','Површина');
	define('M4J_LANG_ADJUSTMENT','Конфигурација');
	define('M4J_LANG_VALUE','Вредност');
	define('M4J_LANG_MAIN_CONFIG','Главна конфигурација:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Сите главни поставки можете да ги конфигурирате тука. Ако сакате да се вратите на сите зададени поставки (вклучително и CSS) тогаш кликнете ресет.');
	define('M4J_LANG_CSS_CONFIG','CSS поставки:');
	define('M4J_LANG_CSS_CONFIG_DESC','Овие поставки се потребни за визуелно претставување на предницата. Ако немате искуство со вметнување надворешно (ваше) CSS, не гименувајте овие поставки!');
	define('M4J_LANG_RESET','Ресет');
			
	define('M4J_LANG_EMAIL_ROOT', 'Главна E-mail адреса: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Максимум одговори <br/> Посочете избор: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Првоглед на широчина: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Првоглед на висина: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Captcha траење (во минути): ' );
	define('M4J_LANG_HELP_ICON', 'Иконка за помош: ' );
	define('M4J_LANG_HTML_MAIL', 'HTML E-mail: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Прикажи легенда: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'Главната e-mail адреса ќе се користи ако ниту категоријата ниту формата немаат посочено e-mail адреса.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Оваа вредност го ограничува максималниот број одговори за \'Посочи избор\' делот. Вредноста мора дад е бројна.' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Широчина за првоглед на шаблонот. Вредноста се користи само ако немате посочено широчина за првоглед за основните податоци за шаблонот.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Височина за првоглед на шаблонот. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Се однесува на предницата. Вредноста одредува максимално траење на captcha-та. Ако времето истече, нов captcha код ќе треба да биде внесен иако стариот е правилно впишан.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Одредете боја на иконката за помош.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Ако сакате да добивате HTML пошта одберете да. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Ако сакате да ја прикажете легендата на позадината одберете да.' );
	
	define('M4J_LANG_CLASS_HEADING', 'Главно заглавие:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Насловен текст' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Листинг- Збиено ' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Листинг- Заглавие' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Листинг- Воведен текст ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Форма- Збиено ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Форма- Табела ' );
	define('M4J_LANG_CLASS_ERROR', 'Текст за грешка' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Збиено копче за прифаќање' );
	define('M4J_LANG_CLASS_SUBMIT', 'Копче за прифаќање ' );
	define('M4J_LANG_CLASS_REQUIRED', 'Барано * css ' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Заглавие на страницата ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Содржина по заглавието. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Збиена листа од деловите.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Заглавија на листаните делови. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Воведен текст од листаните делови. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Збиена површина на форма. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Табела каде сите делови на формата ссе прикажани.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - CSS класа за пораки за грешка. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Збиено копче за прифаќање ' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - CSS класа за копче за прифаќање. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - CSS класа за \' <b>*</b> \' знакот кој ги посочува браните полиња.' );
	
	define('M4J_LANG_INFO_HELP','Инфо и Помош');
	
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Captcha техника: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Едноставно');
	
	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','Конфигурацијата е успешно ресетирана.');
		define('M4J_LANG_CONFIG_SAVED','Конфигурацијата е успешно сочувана.');
		define('M4J_LANG_CAPTCHA_DESC', 'Може да имате мали проблеми со standard-css-captcha и некои сервери и шаблони. За таков случај имате можност за одбир меѓу standard-css-captcha и едноставна captcha. Ако едноставната captcha не ви го реши проблемот одберете Специјално' );
		define('M4J_LANG_SPECIAL','Специјално');
	
	
	define('M4J_LANG_MAIL_ISO','Главен сет на знаци');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');		
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Прикачи';	
	define('M4J_LANG_ATTACHMENT','Прикачете документ');
	define('M4J_LANG_ATTACHMENT_DESC','Корисникот може да испрати документ преку формата.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Внесете параметри во поелто за пренос:');
	define('M4J_LANG_ALLOWED_ENDINGS','Одобрени наставки за документ.');
	define('M4J_LANG_MAXSIZE','Максимална големина.');
	define('M4J_LANG_BYTE','Бајти');
	define('M4J_LANG_KILOBYTE','Килобајти');
	define('M4J_LANG_MEGABYTE','Мегабајти');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Ве молиме внесете ги сите наставки за документи без точка (.) и одделете ги со <b>запирка</b>. Ако оставите празно, сите наставки ќе бидат прифатени и сите големини одобрени. За да си ја олесните работата, можете да одберете поставки кои ќе се прикажат автоматски.');
	define('M4J_LANG_IMAGES','Слики');
	define('M4J_LANG_DOCS','Документи');
	define('M4J_LANG_AUDIO','Аудио');
	define('M4J_LANG_VIDEO','Видео');										   
    define('M4J_LANG_DATA','Податоци');
	define('M4J_LANG_COMPRESSED','Пакети');
	define('M4J_LANG_OTHERS','Останато');
	define('M4J_LANG_ALL','Сите');
	
	// New to Version 1.1.9
	define('M4J_LANG_FROM_NAME','Име на форма');
	define('M4J_LANG_FROM_EMAIL','Е-mail  на форма');
	define('M4J_LANG_FROM_NAME_DESC','Внесете име на формата од која ќе добивате пошта<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','Внесете e-mail адреса за формата од која ќе очекувате пошта.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Внимание! Сите форми што го содржат овој шаблон истотака ќе бидат избришани!');
	

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