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
// translated by baijianpeng ( http://www.joomlagate.com )
	/**  ENGLISH VERSION. NEEDS TO BE TRANSLATED */

	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

	define('M4J_LANG_FORM_CATEGORIES','表单类别');
	define('M4J_LANG_ERROR_NO_CATEGORY','请求的表单类别不存在或者已被取消发布。');
	define('M4J_LANG_ERROR_NO_FORM','请求的表单不存在或者已被取消发布');
	define('M4J_LANG_YES','是');
	define('M4J_LANG_NO','否');

	define('M4J_LANG_NO_CATEGORY','未分类');
	define('M4J_LANG_NO_CATEGORY_LONG','在此你可以找到所有不属于任何类别的表单。');
	define('M4J_LANG_SUBMIT','发送');
	define('M4J_LANG_MISSING','以下栏目未填写: ');
	define('M4J_LANG_ERROR_IN_FORM','必须提供的信息没有填写:');
	define('M4J_LANG_ERROR_NO_MAIL_ADRESS','此表单没有目标邮件地址，表单内容无法提交.');
	define('M4J_LANG_ERROR_CAPTCHA','验证码错误，或者已经超时失效!');
	define('M4J_LANG_MAIL_SUBJECT','表单内容: ');
	define('M4J_LANG_CAPTCHA_ADVICE','将鼠标指向左侧的图片就能看到验证码，请将验证码填写到右侧的输入框中.');
	define('M4J_LANG_REQUIRED_DESC','必填项目.');
	define('M4J_LANG_SENT_SUCCESS','您的提交已成功.');

	//New To Version 1.1.8
	 define('M4J_LANG_TO_LARGE','<br/> &nbsp;- 文件太大了 ! 最大允许: ');
	 define('M4J_LANG_WRONG_ENDING','<br/> &nbsp;- 文件类型不正确 !<br/> &nbsp;&nbsp; 允许的扩展名: ');
	
	//New To Version 1.1.9
	 define('M4J_LANG_SENT_ERROR','在发送时发生了错误 <br/> 邮件未送出!');
	 
	//New To Proforms
	define('M4J_LANG_ERROR_USERMAIL','你需要输入一个有效的电子邮件地址：');
	define('M4J_LANG_RESET','复位');
	define('M4J_LANG_REQUIRED','是必要的，不能为空白。');
	define('M4J_LANG_ERROR_PROMPT','我们的歉意。对输入的数据有些是无效的，无法处理。相应的字段标。');
	define('M4J_LANG_ALPHABETICAL','必须是字母。');
	define('M4J_LANG_NUMERIC','必须是数字。');
	define('M4J_LANG_INTEGER','必须是整数。');
	define('M4J_LANG_URL','必须是一个URL。');
	define('M4J_LANG_EMAIL','必须是一个有效的电子邮件地址。');
	define('M4J_LANG_ALPHANUMERIC','必须是字母数字。');
	define('M4J_LANG_PLEASE_SELECT','请选择');
	define('M4J_LANG_ASK2CONFIRM','请给我确认。');
	define('M4J_LANG_ASK2CONFIRM_DESC','如果您激活此复选框，您将获得对所提交的数据的确认电子邮件。');
	// New to Proforms 1.0.5
	define('M4J_LANG_ERROR_NO_TEMPLATE','This form hasn\'t been assigned to a form template!');
	 
	// New to Proforms 1.1
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','您确认您的提交。');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','你有你的，吊销提交确认。'); 
	 
?>