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
	//Japanese Translation by Masato Sato<webmaster@joomlaway.net> URL:http://www.joomlaway.net/
	/**  ENGLISH VERSION. NEEDS TO BE TRANSLATED */


	defined( '_JEXEC' ) or die( 'この場所への直接アクセスは許可されていません。' );
	
	$m4j_lang_elements[1]= 'チェックボックス';
	$m4j_lang_elements[2]= 'はい/いいえ選択';
	$m4j_lang_elements[10]= '日付';
	$m4j_lang_elements[20]= 'テキストフィールド';
	$m4j_lang_elements[21]= 'テキストエリア';
	$m4j_lang_elements[30]= 'メニュー(1つ選択)';
	$m4j_lang_elements[31]= 'セレクトメニュー(1つ選択)';
	$m4j_lang_elements[32]= 'ラジオボタン(1つ選択)';
	$m4j_lang_elements[33]= 'チェックボックスグループ(複数選択)';
	$m4j_lang_elements[34]= 'リスト(複数選択)';
	
	
	define('M4J_LANG_FORMS','フォーム');
	define('M4J_LANG_TEMPLATES','テンプレート');
	define('M4J_LANG_CATEGORY','カテゴリ');
	define('M4J_LANG_CONFIG','設定');
	define('M4J_LANG_HELP','情報 & ヘルプ');
	define('M4J_LANG_CANCEL','キャンセル');
	define('M4J_LANG_PROCEED','進む');
	define('M4J_LANG_SAVE','保存');
	define('M4J_LANG_NEW_FORM','新規フォーム');
	define('M4J_LANG_NEW_TEMPLATE','新規テンプレート');
	define('M4J_LANG_ADD','追加');
	define('M4J_LANG_EDIT_NAME','このテンプレートの名前と説明を編集');
	define('M4J_LANG_NEW_TEMPLATE_LONG','新規テンプレート');
	define('M4J_LANG_TEMPLATE_NAME','このテンプレートの名前');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','このテンプレートの名前を編集');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','短い説明 (内部で使用。空欄にもできます。)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','短い説明を編集');
	define('M4J_LANG_DELETE','削除');
	define('M4J_LANG_DELETE_CONFIRM','このアイテムを本当に削除してよろしいですか？');
	define('M4J_LANG_NEW_CATEGORY','新規カテゴリ');
	define('M4J_LANG_NAME','名前');
	define('M4J_LANG_SHORTDESCRIPTION','短い説明');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','アイテム');
	define('M4J_LANG_EDIT','編集');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','アイテム -> 編集');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','このテンプレートの名前を入力して下さい！');
	define('M4J_LANG_AT_LEAST_ONE','このアイテムは削除できませんでした！<br/>少なくとも1つの要素が必要です。');	

	
		define('M4J_LANG_EDIT_ELEMENT','テンプレートの要素を編集:: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','カテゴリ名を入力して下さい');
	define('M4J_LANG_NONE_LEGAL_EMAIL','正しいメールアドレスを入力するか、空欄にしてください。<br/>');
	define('M4J_LANG_EMAIL','メールアドレス');
	define('M4J_LANG_POSITION','並び順');
	define('M4J_LANG_ACTIVE','有効');
	define('M4J_LANG_UP','上へ');
	define('M4J_LANG_DOWN','下へ');
	define('M4J_LANG_EDIT_CATEGORY','カテゴリ編集');
	define('M4J_LANG_TEMPLATE_ELEMENTS','テンプレートの要素');
	define('M4J_LANG_NEW_ELEMENT_LONG','テンプレートに新しい要素を挿入: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','質問を入力して下さい。');
	define('M4J_LANG_REQUIRED','必須');
	define('M4J_LANG_QUESTION','質問');
	define('M4J_LANG_TYPE','種類');
	define('M4J_LANG_YES','はい');		
	define('M4J_LANG_NO','いいえ');	
	define('M4J_LANG_ALL_FORMS','全てのフォーム');
	define('M4J_LANG_NO_CATEGORYS','カテゴリなし');
	define('M4J_LANG_FORMS_OF_CATEGORY','カテゴリのフォーム: ');
	define('M4J_LANG_PREVIEW','プレビュー');
	define('M4J_LANG_DO_COPY','コピー');		
	define('M4J_LANG_COPY','コピー');
	define('M4J_LANG_VERTICAL','垂直');
	define('M4J_LANG_HORIZONTAL','水平');
	define('M4J_LANG_EXAMPLE','例');
	define('M4J_LANG_CHECKBOX','ボタン');	
	define('M4J_LANG_DATE','日付');
	define('M4J_LANG_TEXTFIELD','テキストフィールド');
	define('M4J_LANG_OPTIONS','指定選択');
	define('M4J_LANG_CHECKBOX_DESC','シンプルな「はい」「いいえ」の質問です。');
	define('M4J_LANG_DATE_DESC','ユーザは日付を入力する必要があります。');
	define('M4J_LANG_TEXTFIELD_DESC','ユーザは各テキストを入力する必要があります。');
	define('M4J_LANG_OPTIONS_DESC','ユーザは指定された項目から1つ以上の回答を選択します。');
	define('M4J_LANG_CLOSE_PREVIEW','プレビューを閉じる');
	define('M4J_LANG_Q_WIDTH','質問カラムの幅(左側)');
	define('M4J_LANG_A_WIDTH','回答カラムの幅(右側)');
	define('M4J_LANG_OVERVIEW','概観');
	define('M4J_LANG_UPDATE_PROCEED','& 進む');
	define('M4J_LANG_NEW_ITEM','新規アイテム');
	define('M4J_LANG_EDIT_ITEM','アイテム編集');
	define('M4J_LANG_CATEGORY_NAME','カテゴリ名');
	define('M4J_LANG_EMAIL_ADRESS','メールアドレス');
	define('M4J_LANG_ADD_NEW_ITEM','新規アイテムを追加');
	define('M4J_LANG_YOUR_QUESTION','あなたの質問');
	define('M4J_LANG_REQUIRED_LONG','必須にしますか？');
	define('M4J_LANG_HELP_TEXT','ヘルプテキストです。質問のヒントをユーザに表示します。(必須ではありません)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','ボタンのタイプ');
	define('M4J_LANG_ITEM_CHECKBOX','チェックボックス');
	define('M4J_LANG_YES_NO_MENU','はい/いいえメニュー');
	define('M4J_LANG_YES_ON','はい/オン');
	define('M4J_LANG_NO_OFF','いいえ/オフ');
	define('M4J_LANG_INIT_VALUE','初期値:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','テキストフィールドのタイプ:');
	define('M4J_LANG_ITEM_TEXTFIELD','テキストフィールド');
	define('M4J_LANG_ITEM_TEXTAREA','テキストエリア');
	define('M4J_LANG_MAXCHARS_LONG','最大文字数:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','表示設定:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>ピクセルでの幅</b> <br/>(パーセンテージ指定時は\'%\'を追加して下さい。空欄 = 自動調整)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>表示する行数:</b><br/> (テキストエリアのみ)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>メニュー</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>ラジオボタン</b>');
	define('M4J_LANG_LIST_SINGLE','<b>リスト</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1つ選択)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>チェックボックスグループ</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>リスト</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(CTRLを押しながら左クリックで複数選択)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','1つ選択 (項目を1つだけ選択できます):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','複数選択 (複数のアイテムを選択できます):');
	define('M4J_LANG_TYPE_OF_OPTIONS','選択の種類:');
	define('M4J_LANG_ROWS_LIST','<b>表示する行数:</b><br/> (リストのみ)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>配置: </b> <br/>(ラジオボタンおよびチェックボックスグループのみ)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>回答を指定して下さい。<br/>空欄のフィールドは無視されます。</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','イントロテキストです。カテゴリ表示にのみ表示されます。');
	define('M4J_LANG_TITLE','タイトル');
	define('M4J_LANG_ERROR_NO_TITLE','タイトルを入力して下さい。');
	define('M4J_LANG_USE_HELP','フロントエンドのバルーンチップのヘルプテキスト');
	define('M4J_LANG_TITLE_FORM','フォームタイトル');
	define('M4J_LANG_INTROTEXT','イントロテキスト');
	define('M4J_LANG_MAINTEXT','本文');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','メールのイントロテキストです。(メールに表示されます。)');
	define('M4J_LANG_TEMPLATE','テンプレート');
	define('M4J_LANG_LINK_TO_MENU','メニューへリンク');
	define('M4J_LANG_LINK_CAT_TO_MENU','現在のカテゴリをメニューへリンク');
	define('M4J_LANG_LINK_TO_CAT','リンクするカテゴリ: ');
	define('M4J_LANG_LINK_TO_FORM','フォームへリンク: ');
	define('M4J_LANG_LINK_TO_NO_CAT','カテゴリなしで全てのフォームを表示するリンク');
	define('M4J_LANG_LINK_TO_ALL_CAT','「全てのカテゴリ」を表示するリンク');
	define('M4J_LANG_CHOOSE_MENU','リンクするメニューを選択してください: ');
	define('M4J_LANG_MENU','メニュー: ');
	define('M4J_LANG_NO_LINK_NAME','リンク名を入力して下さい。');
	define('M4J_LANG_PUBLISHED','公開:');
	define('M4J_LANG_PARENT_LINK','親リンク');
	define('M4J_LANG_LINK_NAME','リンク名');
	define('M4J_LANG_ACCESS_LEVEL','アクセスレベル:');
	define('M4J_LANG_EDIT_MAIN_DATA','基本データを編集');
	define('M4J_LANG_LEGEND','凡例');
	define('M4J_LANG_LINK','リンク');
	define('M4J_LANG_IS_VISIBLE',' は公開済み');
	define('M4J_LANG_IS_HIDDEN',' は非公開');
	define('M4J_LANG_FORM','フォーム');
	define('M4J_LANG_ITEM','アイテム');
	define('M4J_LANG_IS_REQUIRED','必須');
	define('M4J_LANG_IS_NOT_REQUIRED','任意');
	define('M4J_LANG_ASSIGN_ORDER','並び順');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* 「全てのフォーム」で並び順は変更できません!<br/>');
	define('M4J_LANG_EDIT_FORM','フォーム編集');
	define('M4J_LANG_CAPTCHA','キャプチャ');
	define('M4J_LANG_HOVER_ACTIVE_ON','公開時にクリック=非公開へ');
	define('M4J_LANG_HOVER_ACTIVE_OFF','非公開時にクリック=公開へ');
	define('M4J_LANG_HOVER_REQUIRED_ON','必須時にクリック=任意へ');
	define('M4J_LANG_HOVER_REQUIRED_OFF','任意時にクリック= 必須へ');
	define('M4J_LANG_DESCRIPTION','説明');
	define('M4J_LANG_AREA','エリア');
	define('M4J_LANG_ADJUSTMENT','設定');
	define('M4J_LANG_VALUE','設定');
	define('M4J_LANG_MAIN_CONFIG','メイン設定:');
	define('M4J_LANG_MAIN_CONFIG_DESC','ここで全てのメイン設定が行えます。全てのメイン設定(CSS含む)を初期値にリセットしたい場合、「リセット」をクリックして下さい。');
	define('M4J_LANG_CSS_CONFIG','CSS設定:');
	define('M4J_LANG_CSS_CONFIG_DESC','これらの設定はフロントエンドの視覚的な表現に必要です。外部CSS(自身のCSS）を含んだ事がない場合、これらの値を変更しないで下さい！');
	define('M4J_LANG_RESET','リセット');
			
	define('M4J_LANG_EMAIL_ROOT', 'メインメールアドレス: ' );
	define('M4J_LANG_MAX_OPTIONS', '指定選択の<br/> 最大回答数: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'プレビュー幅: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'プレビュー高さ: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'キャプチャ間隔 (分): ' );
	define('M4J_LANG_HELP_ICON', 'ヘルプアイコン: ' );
	define('M4J_LANG_HTML_MAIL', 'HTMLメール: ' );
	define('M4J_LANG_SHOW_LEGEND', '凡例を表示: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'カテゴリ、フォームのどちらにもメールアドレスが割り当てられていない場合に、メインメールアドレスが使用されます。' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'この値は「指定選択」項目の最大回答数を制限します。この値は数値で入力してください。' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'テンプレートプレビューの幅です。テンプレートの基本データにプレビュー幅を割り当てていない場合にのみ、この値が使用されます。' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'テンプレートプレビューの高さです。 ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'フロントエンドに属します。この値はキャプチャによる正当性検査の最大持続時間を割り当てます。持続時間が経過すると、古いコードが正しくても新しいキャプチャコードを入力する必要があります。' );
	define('M4J_LANG_HELP_ICON_DESC', 'ヘルプアイコンの色を設定して下さい。' );
	define('M4J_LANG_HTML_MAIL_DESC', 'HTMLメールを受信する場合は「はい」を選択して下さい。' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'バックエンドで凡例を表示する場合は「はい」を選択して下さい。' );
	
	define('M4J_LANG_CLASS_HEADING', 'メインの見出し:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', '見出しテキスト' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'リスト- 囲み ' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'リスト- 見出し' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'リスト- イントロテキスト ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'フォーム- 囲み ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'フォーム- テーブル ' );
	define('M4J_LANG_CLASS_ERROR', 'エラーテキスト' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', '送信ボタン囲み' );
	define('M4J_LANG_CLASS_SUBMIT', '送信ボタン ' );
	define('M4J_LANG_CLASS_REQUIRED', '必須項目 * css ' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIVタグ</strong> - サイトの見出し' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIVタグ</strong> - 見出し後のコンテンツ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIVタグ</strong> - リストアイテムの囲み' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIVタグ</strong> - リストアイテムの見出し' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIVタグ</strong> - リストアイテムのイントロテキスト' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIVタグ</strong> - フォーム領域の囲み' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLEタグ</strong> - 全てのフォームアイテムが表示されるテーブル' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPANタグ</strong> - エラーメッセージのCSSクラス' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIVタグ</strong> - 送信ボタンの囲み' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUTタグ</strong> - 送信ボタンのCSSクラス' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPANタグ</strong> - 必須項目である事を示す「<b>*</b>」のCSSクラス' );
	
	define('M4J_LANG_INFO_HELP','情報とヘルプ');
	
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'キャプチャ手法: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','通常');
	
	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','設定は正常にリセットされました。');
		define('M4J_LANG_CONFIG_SAVED','設定は正常に保存されました。');
		define('M4J_LANG_CAPTCHA_DESC', ' 標準のCSSキャプチャは、いくつかのサーバ、テンプレートで問題があるかもしれません。このような場合、標準CSSキャプチャと通常のキャプチャの中から選択する代案があります。通常のキャプチャを選択しても問題が解決しない場合は「スペシャル」を選択してください' );
		define('M4J_LANG_SPECIAL','スペシャル');
	
	
	define('M4J_LANG_MAIL_ISO','メール文字コード');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (西ヨーロッパ), iso-8859-4 (バルト), iso-8859-5 (キリル文字), iso-8859-6 (アラビア語), iso-8859-7 (ギリシャ語), iso-8859-8 (ヘブライ語),iso-8859-9 (トルコ語), iso-8859-10 (北欧),iso-8859-11 (タイ)');		
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= '添付';	
	define('M4J_LANG_ATTACHMENT','ファイル添付');
	define('M4J_LANG_ATTACHMENT_DESC','ユーザはフォームからファイルを送信できます。');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','ファイル転送フィールドのパラメータを入力してください:');
	define('M4J_LANG_ALLOWED_ENDINGS','許可するファイル拡張子');
	define('M4J_LANG_MAXSIZE','最大ファイルサイズ');
	define('M4J_LANG_BYTE','バイト');
	define('M4J_LANG_KILOBYTE','キロバイト');
	define('M4J_LANG_MEGABYTE','メガバイト');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','全てのファイル拡張子をドットなしの<b>カンマ</b>区切りで入力して下さい。フィールドを空欄にした場合、全てのファイル拡張子が許可され、どんなサイズでも認められます。この作業を簡単にするために、自動で表示された以下の拡張子の中から選択する事ができます。');
	define('M4J_LANG_IMAGES','画像');
	define('M4J_LANG_DOCS','ドキュメント');
	define('M4J_LANG_AUDIO','オーディオ');
	define('M4J_LANG_VIDEO','ビデオ');										   
    define('M4J_LANG_DATA','データ');
	define('M4J_LANG_COMPRESSED','圧縮');
	define('M4J_LANG_OTHERS','その他');
	define('M4J_LANG_ALL','全て');
	
	// New to Version 1.1.9
	define('M4J_LANG_FROM_NAME','差出人名');
	define('M4J_LANG_FROM_EMAIL','フォームメールアドレス');
	define('M4J_LANG_FROM_NAME_DESC','送信するメールの差出人名を入力してください<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','送信するメールの差出人メールアドレスを入力して下さい。<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' 警告! このテンプレートに含まれる全てのフォームも削除されます!');
	

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
