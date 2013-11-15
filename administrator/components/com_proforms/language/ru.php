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

	/**  РУССКАЯ ВЕРСИЯ. ПЕРЕВОД www.biznetman.biz */


	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
	
	$m4j_lang_elements[1]= 'Кнопка-флажок(Check-box)';
	$m4j_lang_elements[2]= 'Выбор Да/Нет';
	$m4j_lang_elements[10]= 'Дата';
	$m4j_lang_elements[20]= 'Текстовое поле';
	$m4j_lang_elements[21]= 'Текстовая область';
	$m4j_lang_elements[30]= 'Меню(одиночный выбор)';
	$m4j_lang_elements[31]= 'Меню с выбором(одиночный выбор)';
	$m4j_lang_elements[32]= 'Кнопки с зависимой фиксацией(Radiobuttons-одиночный выбор)';
	$m4j_lang_elements[33]= 'Группа кнопок-флажков(множественный выбор)';
	$m4j_lang_elements[34]= 'Список(множественный выбор)';
	
	
	define('M4J_LANG_FORMS','Формы');
	define('M4J_LANG_TEMPLATES','Шаблоны');
	define('M4J_LANG_CATEGORY','Категории');
	define('M4J_LANG_CONFIG','Конфигурации');
	define('M4J_LANG_HELP','Инфо&Помощь');
	define('M4J_LANG_CANCEL','Отмена');
	define('M4J_LANG_PROCEED','Далее');
	define('M4J_LANG_SAVE','Сохранить');
	define('M4J_LANG_NEW_FORM','Новая форма');
	define('M4J_LANG_NEW_TEMPLATE','Новый шаблон');
	define('M4J_LANG_ADD','Добавить');
	define('M4J_LANG_EDIT_NAME','Редактировать имя и описание для этого шаблона');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Новый шаблон');
	define('M4J_LANG_TEMPLATE_NAME','Имя этого шаблона');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Редактировать имя этого шаблона');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Короткое описание (для внутреннего использования. Можно не заполнять)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Редактировать короткое описание');
	define('M4J_LANG_DELETE','Удалить');
	define('M4J_LANG_DELETE_CONFIRM','Вы действительно хотите удалить этот элемент?');
	define('M4J_LANG_NEW_CATEGORY','Новая категория');
	define('M4J_LANG_NAME','Имя');
	define('M4J_LANG_SHORTDESCRIPTION','Короткое описание');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Элементы');
	define('M4J_LANG_EDIT','Редактировать');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Элементы -> Редактировать');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Пожалуйста, введите имя для этого шаблона!');
	define('M4J_LANG_AT_LEAST_ONE','Этот элемент не может быть удален!<br/>Здесь должен быть покрайней мере один элемент.');	

	
		define('M4J_LANG_EDIT_ELEMENT','Редактировать элемнт шаблона: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Пожалуйста, вставьте название категории');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Пожалуйста вставьте верный e-mail адрес или оставьте незаполненным.<br/>');
	define('M4J_LANG_EMAIL','e-mail');
	define('M4J_LANG_POSITION','Расположение');
	define('M4J_LANG_ACTIVE','Активный');
	define('M4J_LANG_UP','Вверх');
	define('M4J_LANG_DOWN','Вниз');
	define('M4J_LANG_EDIT_CATEGORY','Редактировать категорию');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Элементы шаблона: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Вставить новый элемент в шаблон: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Пожалуйста, вставьте вопрос.');
	define('M4J_LANG_REQUIRED','Необходимый');
	define('M4J_LANG_QUESTION','Вопрос');
	define('M4J_LANG_TYPE','Тип');
	define('M4J_LANG_YES','Да');		
	define('M4J_LANG_NO','Нет');	
	define('M4J_LANG_ALL_FORMS','Все формы');
	define('M4J_LANG_NO_CATEGORYS','Без категории');
	define('M4J_LANG_FORMS_OF_CATEGORY','Формы категории: ');
	define('M4J_LANG_PREVIEW','Просмотр');
	define('M4J_LANG_DO_COPY','Копировать');		
	define('M4J_LANG_COPY','Копия');
	define('M4J_LANG_VERTICAL','Вертикально');
	define('M4J_LANG_HORIZONTAL','Горизонтально');
	define('M4J_LANG_EXAMPLE','Пример');
	define('M4J_LANG_CHECKBOX','Кнопка');	
	define('M4J_LANG_DATE','Дата');
	define('M4J_LANG_TEXTFIELD','Текстовое поле');
	define('M4J_LANG_OPTIONS','Заданный выбор');
	define('M4J_LANG_CHECKBOX_DESC','Простой Да/Нет вопрос.');
	define('M4J_LANG_DATE_DESC','Пользователь должен ввести дату.');
	define('M4J_LANG_TEXTFIELD_DESC','Пользователь должен ввести Текст.');
	define('M4J_LANG_OPTIONS_DESC','Пользователь выбирает один или несколько ответов из представленныхэлементов. ');
	define('M4J_LANG_CLOSE_PREVIEW','Закрыть Просмотр');
	define('M4J_LANG_Q_WIDTH','Ширина колонки вопроса. (левый)');
	define('M4J_LANG_A_WIDTH','Ширина колонки ответа. (правый)');
	define('M4J_LANG_OVERVIEW','Обзор');
	define('M4J_LANG_UPDATE_PROCEED','& Далее');
	define('M4J_LANG_NEW_ITEM','Новый Элемент');
	define('M4J_LANG_EDIT_ITEM','Редактировать Элемен');
	define('M4J_LANG_CATEGORY_NAME','Название Категории');
	define('M4J_LANG_EMAIL_ADRESS','Email Адрес');
	define('M4J_LANG_ADD_NEW_ITEM','Добавит новый элемент:');
	define('M4J_LANG_YOUR_QUESTION','Ваш Вопрос');
	define('M4J_LANG_REQUIRED_LONG','Обязательный?');
	define('M4J_LANG_HELP_TEXT','Вспомогательный Текст. Дайте пользователям подсказку для вопроса.(необязательно)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Тип кнопки:');
	define('M4J_LANG_ITEM_CHECKBOX','Кнопка-флажок(Checkbox).');
	define('M4J_LANG_YES_NO_MENU','Да/Нет Меню.');
	define('M4J_LANG_YES_ON','Да/Вкл.');
	define('M4J_LANG_NO_OFF','Нет/Выкл.');
	define('M4J_LANG_INIT_VALUE','Начальное Значение:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Тип Текстового поля:');
	define('M4J_LANG_ITEM_TEXTFIELD','Текстовое поле');
	define('M4J_LANG_ITEM_TEXTAREA','Текстовая область');
	define('M4J_LANG_MAXCHARS_LONG','Максимум Символов:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Визуальное выравнивание:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Ширина в Пикселях</b> <br/>(Добавить \'%\' в процентном соотношении. Пусто = Автоматическая подгонка)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Количество визуальных строк:</b><br/> (Only for Textarea)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Меню</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Кнопка с зависимой фиксацией (Radiobuttons)</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Список</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(одиночный выбор)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Группа кнопок-флажков (Checkbox)</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Список</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(множественный выбор, с \'CTRL\' & левой кнопкой мыши)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Одиночный Выбор (Only one item can be selected):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Множественный Выбор (Множество элементов может быть выбрано):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Тип Выбора:');
	define('M4J_LANG_ROWS_LIST','<b>Количество визуальных строк:</b><br/> (Только для Списков)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Выравнивание: </b> <br/>(Только для Кнопок с зависимой фиксацией (Radiobuttons) и Групп Кнопок-флажков (Checkbox))<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Специфичные ответы.<br/>Пустые поля будут проигнорированы.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Вводный текст. Будет отображаться только в категориях сайта.');
	define('M4J_LANG_TITLE','Заголовок');
	define('M4J_LANG_ERROR_NO_TITLE','Пожалуйста, введите заголовок.');
	define('M4J_LANG_USE_HELP','Вспомогательный Текст для подсказок клиентской части');
	define('M4J_LANG_TITLE_FORM','Заголовок Формы');
	define('M4J_LANG_INTROTEXT','Вступительный текст');
	define('M4J_LANG_MAINTEXT','Главный текст');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Вступительный текст для Email. (Будет отображаться только в электронных письмах.)');
	define('M4J_LANG_TEMPLATE','Шаблон');
	define('M4J_LANG_LINK_TO_MENU','Ссылка в Меню');
	define('M4J_LANG_LINK_CAT_TO_MENU','Ссылка текущей категории в меню');
	define('M4J_LANG_LINK_TO_CAT','Ссылка Категории: ');
	define('M4J_LANG_LINK_TO_FORM','Ссылка Формы: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Ссылка на отображение всех Форм без категории ');
	define('M4J_LANG_LINK_TO_ALL_CAT','Ссылка на отображение \'Все Категории\'');
	define('M4J_LANG_CHOOSE_MENU','Выберите меню ссылку на: ');
	define('M4J_LANG_MENU','Меню: ');
	define('M4J_LANG_NO_LINK_NAME','Пожалуйста, вставьте название ссылки.');
	define('M4J_LANG_PUBLISHED','Опубликовать:');
	define('M4J_LANG_PARENT_LINK','Родительская Ссылка');
	define('M4J_LANG_LINK_NAME','Название Ссылки');
	define('M4J_LANG_ACCESS_LEVEL','Уровень доступа:');
	define('M4J_LANG_EDIT_MAIN_DATA','Редактировать базовые данные');
	define('M4J_LANG_LEGEND','Надпись');
	define('M4J_LANG_LINK','Ссылка');
	define('M4J_LANG_IS_VISIBLE',' опубликовано');
	define('M4J_LANG_IS_HIDDEN',' не опубликовано');
	define('M4J_LANG_FORM','Форма');
	define('M4J_LANG_ITEM','Элемент');
	define('M4J_LANG_IS_REQUIRED','Обязательный');
	define('M4J_LANG_IS_NOT_REQUIRED','Необязательный');
	define('M4J_LANG_ASSIGN_ORDER','Порядок');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Упорядочивание не возможно для \'Все Формы\' !<br/>');
	define('M4J_LANG_EDIT_FORM','Редактировать формы');
	define('M4J_LANG_CAPTCHA','Каптча');
	define('M4J_LANG_HOVER_ACTIVE_ON','Опубликовано! Щелкните=Скрыть');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Неопубликовано! Щелкните=Опубликовать');
	define('M4J_LANG_HOVER_REQUIRED_ON','Обязательный! Щелкните= Необязательный');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Необязательный! Щелкните= Обязательный');
	define('M4J_LANG_DESCRIPTION','Описание');
	define('M4J_LANG_AREA','Area');
	define('M4J_LANG_ADJUSTMENT','Конфигурация');
	define('M4J_LANG_VALUE','Value');
	define('M4J_LANG_MAIN_CONFIG','Главная Конфигурация:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Здесь Вы можете сконфигурировать все основные настройки. Если Вы хотите переустановить все основные настройки (включая CSS) на ПО-УМОЛЧАНИЮ щелкните сброс.');
	define('M4J_LANG_CSS_CONFIG','CSS Установки:');
	define('M4J_LANG_CSS_CONFIG_DESC','Эти настройки обязательны для визуального представления клиентской части. Если Вы не опытны во включении внешнего (своего) CSS, не изменяйте эти значения!');
	define('M4J_LANG_RESET','Сброс');
			
	define('M4J_LANG_EMAIL_ROOT', 'Главный Email адрес: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Максимум ответов <br/> Специфичный выбор: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Ширина Просмотра: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Высота Просмотра: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Продолжительность Каптчи (в мин): ' );
	define('M4J_LANG_HELP_ICON', 'Иконка Помощи: ' );
	define('M4J_LANG_HTML_MAIL', 'HTML Email: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Показать Описание: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'Главный email адрес используется если ни категория ни форма не связаны email адресом.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Это значение ограничивает максимальное количество ответов для пункта \'Специфичный выбор\'. Это значение должно быть числовым.' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Ширина предварительного просмотра шаблона. Это значение используется только в случаях, когда Вы не задали ширину предварительного просмотра в базовых данных шаблона.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Высота предварительного просмотра шаблона. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Относится к клиентской части. Это значение определяет максимальный срок действия каптчи. Если этот срок действия истекает, нужно ввести новый код каптчи, даже если введенный ранее код был верным.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Определить цвет иконки помощи.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Если Вы хотите получать HTML emails, выберите да. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Если Вы хотите отобразить описание на админке, выберите да.' );
	
	define('M4J_LANG_CLASS_HEADING', 'Главный Заголовок:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Текст Заголовка' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Список- Оболочка ' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Список- Заголовок' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Список- Вступительный текст ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Форма- Оболочка ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Форма- Таблица ' );
	define('M4J_LANG_CLASS_ERROR', 'Текст Ошибки' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Оболочка Кнопки Отправить' );
	define('M4J_LANG_CLASS_SUBMIT', 'Кнопка Отправить ' );
	define('M4J_LANG_CLASS_REQUIRED', 'Обязательный * css ' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Заголовок сайта ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Контент ниже заголовка. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Переход к следующему элементу в списке.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Заголовок элемента списка. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Вступительный текст элемента списка. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Переход к области формы. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Таблица, отображающая все пункты формы.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - CSS класс сообщений об ошибке. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Переход к кнопке отправить ' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - CSS класс кнопки отправить. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - CSS класс \' <b>*</b> \' символа, обозначающего обязательные поля.' );
	
	define('M4J_LANG_INFO_HELP','Инфо и Помощь');
	
	// Новое в Версии 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Каптча Метод: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Обычный');
	
	//Новое в Версии 1.1.7
		define('M4J_LANG_CONFIG_RESET','Конфигурация была успешно сброшена.');
		define('M4J_LANG_CONFIG_SAVED','Конфигурация была успешно сохранена.');
		define('M4J_LANG_CAPTCHA_DESC', ' Возможны проблемы со стандартной css-каптчей и некоторыми серверами или шаблонами. В этом случае Вы можете выбрать между стандартной css-каптчей и обычной каптчей. Если обычная каптча не решила Вашей проблемы, выберите Специальный' );
		define('M4J_LANG_SPECIAL','Специальный');
	
	
	define('M4J_LANG_MAIL_ISO','Mail кодировка');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');		
	
	
	// Новое в Версии 1.1.8
	$m4j_lang_elements[40]= 'Прикрепить';	
	define('M4J_LANG_ATTACHMENT','Прикрепить Файл');
	define('M4J_LANG_ATTACHMENT_DESC','Пользователь может передать файл, используя форму.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Введите параметры поля передачи файла:');
	define('M4J_LANG_ALLOWED_ENDINGS','Разрешенные расширения файлов.');
	define('M4J_LANG_MAXSIZE','Максимальный размер файлов.');
	define('M4J_LANG_BYTE','Байт');
	define('M4J_LANG_KILOBYTE','Килобайт');
	define('M4J_LANG_MEGABYTE','Мегабайт');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Пожалуйста, введите все расширения файлов без точек и отделенные <b>запятыми</b>.Если Вы оставляете пустые поля, будут приняты все расширения файлов или будет разрешен любой размер. Чтобы облегчить работу, Вы можете выбрать из расширений внизу, включенных автоматически.');
	define('M4J_LANG_IMAGES','Изображения');
	define('M4J_LANG_DOCS','Документы');
	define('M4J_LANG_AUDIO','Аудио');
	define('M4J_LANG_VIDEO','Видео');										   
    define('M4J_LANG_DATA','Данные');
	define('M4J_LANG_COMPRESSED','Сжатие');
	define('M4J_LANG_OTHERS','Другие');
	define('M4J_LANG_ALL','Все');
	
	// Новое в Версии 1.1.9
	define('M4J_LANG_FROM_NAME','От кого');
	define('M4J_LANG_FROM_EMAIL','С какого email');
	define('M4J_LANG_FROM_NAME_DESC','Вставьте от кого для писем, которые Вы будете получать <br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','Вставьте с какого email адреса для писем, которые Вы будете получать.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Внимание! Все формы, содержащие этот шаблон, также будут удалены!');
	

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