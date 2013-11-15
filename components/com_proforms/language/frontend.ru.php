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

	/**  РУССКАЯ ВЕРСИЯ. ПЕРЕВОД www.biznetman.biz */

	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

	define('M4J_LANG_FORM_CATEGORIES','Категории');
	define('M4J_LANG_ERROR_NO_CATEGORY','Запрошенная категория не существует, либо не опубликована');
	define('M4J_LANG_ERROR_NO_FORM','Запрошенная форма не существует, либо не опубликована');
	define('M4J_LANG_YES','Да');		
	define('M4J_LANG_NO','Нет');	
	
	define('M4J_LANG_NO_CATEGORY','Без категории');
	define('M4J_LANG_NO_CATEGORY_LONG','Здесь находятся все анкеты, которые находятся вне категорий.');
	define('M4J_LANG_SUBMIT','Отправить');
	define('M4J_LANG_MISSING','Не заполнено: ');
	define('M4J_LANG_ERROR_IN_FORM','Пропущена обязательная к заполнению информация:');
	define('M4J_LANG_ERROR_NO_MAIL_ADRESS','Не указан эл.адрес для этой анкеты. Некуда отправить сообщение.');
	define('M4J_LANG_ERROR_CAPTCHA','Неверный защитный код, либо истёк срок действия защитного кода!');
	define('M4J_LANG_MAIL_SUBJECT','Сообщение: ');
	define('M4J_LANG_CAPTCHA_ADVICE','Наведите указатель мышки на изображение и введите появившийся код в поле справа.');
	define('M4J_LANG_REQUIRED_DESC','Поля, обязательные к заполнению.');
	define('M4J_LANG_SENT_SUCCESS','Ваша заявка успешно отправлена.');
	
	//New To Version 1.1.8
	define('M4J_LANG_TO_LARGE','<br/> &nbsp;- Файл слишком большой! Максимум: ');
	define('M4J_LANG_WRONG_ENDING','<br/> &nbsp;- Неверное расширение файла!<br/> &nbsp;&nbsp; Допустимо: ');
	
	//New To Version 1.1.9
	define('M4J_LANG_SENT_ERROR','Внутренная ошибка. <br/> Почта не отправлена!');

	//New To Proforms
	define ( 'M4J_LANG_ERROR_USERMAIL', 'Вы должны ввести действительный адрес электронной почты:');
	define ( 'M4J_LANG_RESET', 'сбросить');
	define ( 'M4J_LANG_REQUIRED', 'не требуется, и не может быть пустым.');
	define ( 'M4J_LANG_ERROR_PROMPT', 'наши извинения. Некоторые из введенных данных являются недействительными и не могут быть обработаны. поля помечены.');
	define ( 'M4J_LANG_ALPHABETICAL', 'должен быть алфавитным.');
	define ( 'M4J_LANG_NUMERIC', 'должны быть числовыми.');
	define ( 'M4J_LANG_INTEGER', 'должен быть целым числом.');
	define ( 'M4J_LANG_URL', 'должен быть URL.');
	define ( 'M4J_LANG_EMAIL', 'должен быть действительный адрес электронной почты.');
	define ( 'M4J_LANG_ALPHANUMERIC', 'должен быть буквенно-цифровой.');
	define ( 'M4J_LANG_PLEASE_SELECT', 'Пожалуйста, выберите');
	define ( 'M4J_LANG_ASK2CONFIRM', 'Пожалуйста, вышлите мне подтверждение.');
	define ( 'M4J_LANG_ASK2CONFIRM_DESC', 'Если вы активируете этот флажок, вы получите письмо с подтверждением представленных данных.');
	
	// New to Proforms 1.0.5
	define('M4J_LANG_ERROR_NO_TEMPLATE','This form hasn\'t been assigned to a form template!');
	
	// New to Proforms 1.1
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','Вы подтвердили ваше сообщение.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','Вы отменили подтверждение вашего представления.');
	
	
?>
