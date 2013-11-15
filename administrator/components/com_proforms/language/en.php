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
	$m4j_lang_elements[2]= 'Yes/No Selection';
	$m4j_lang_elements[10]= 'Date';
	$m4j_lang_elements[20]= 'Textfield';
	$m4j_lang_elements[21]= 'Textarea';
	$m4j_lang_elements[30]= 'Menu(single choice)';
	$m4j_lang_elements[31]= 'Select Menu(sincgle choice)';
	$m4j_lang_elements[32]= 'Radiobuttons(single choice)';
	$m4j_lang_elements[33]= 'Checkbox Group(multiple choice)';
	$m4j_lang_elements[34]= 'List(multiple choice)';
	
	
	define('M4J_LANG_FORMS','Forms');
	define('M4J_LANG_TEMPLATES','Templates');
	define('M4J_LANG_CATEGORY','Category');
	define('M4J_LANG_CONFIG','Configuration');
	define('M4J_LANG_HELP','Info & Help');
	define('M4J_LANG_CANCEL','Cancel');
	define('M4J_LANG_PROCEED','Proceed');
	define('M4J_LANG_SAVE','Save');
	define('M4J_LANG_NEW_FORM','New Form');
	define('M4J_LANG_NEW_TEMPLATE','New Template');
	define('M4J_LANG_ADD','Add');
	define('M4J_LANG_EDIT_NAME','Edit name and description of this template');
	define('M4J_LANG_NEW_TEMPLATE_LONG','New Template');
	define('M4J_LANG_TEMPLATE_NAME','Name of this Template');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Edit the name of this template');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Shortdescription (for internal use. can be left empty)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Edit Shortdescription');
	define('M4J_LANG_DELETE','Delete');
	define('M4J_LANG_DELETE_CONFIRM','Do you want realy delete this item?');
	define('M4J_LANG_NEW_CATEGORY','New Category');
	define('M4J_LANG_NAME','Name');
	define('M4J_LANG_SHORTDESCRIPTION','Shortdescription');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Items');
	define('M4J_LANG_EDIT','Edit');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Items -> Edit');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Please enter a name for this template !');
	
	define('M4J_LANG_EDIT_ELEMENT','Edit element of Template: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Please insert a categoryname');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Please insert a valid emailadress or leave this empty.<br/>');
	define('M4J_LANG_EMAIL','Email');
	define('M4J_LANG_POSITION','Ordering');
	define('M4J_LANG_ACTIVE','Active');
	define('M4J_LANG_UP','Up');
	define('M4J_LANG_DOWN','Down');
	define('M4J_LANG_EDIT_CATEGORY','Edit Category');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Elements of the template: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Insert new element to template: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Please insert a question.');
	define('M4J_LANG_REQUIRED','Required');
	define('M4J_LANG_QUESTION','Question');
	define('M4J_LANG_TYPE','Type');
	define('M4J_LANG_YES','Yes');		
	define('M4J_LANG_NO','No');	
	define('M4J_LANG_ALL_FORMS','All Forms');
	define('M4J_LANG_NO_CATEGORYS','Without Category');
	define('M4J_LANG_FORMS_OF_CATEGORY','Forms of Category: ');
	define('M4J_LANG_PREVIEW','Preview');
	define('M4J_LANG_DO_COPY','Copy');		
	define('M4J_LANG_COPY','Copy');
	define('M4J_LANG_VERTICAL','Vertical');
	define('M4J_LANG_HORIZONTAL','Horizontal');
	define('M4J_LANG_EXAMPLE','Example');
	define('M4J_LANG_CHECKBOX','Button');	
	define('M4J_LANG_DATE','Date');
	define('M4J_LANG_TEXTFIELD','Textfield');
	define('M4J_LANG_OPTIONS','Specified Choice');
	define('M4J_LANG_CHECKBOX_DESC','A simple Yes/No question.');
	define('M4J_LANG_DATE_DESC','User has to enter a date.');
	define('M4J_LANG_TEXTFIELD_DESC','User has to enter a individual text.');
	define('M4J_LANG_OPTIONS_DESC','User selects one or more answers out of specified items. ');
	define('M4J_LANG_CLOSE_PREVIEW','Close preview');
	define('M4J_LANG_Q_WIDTH','Width of the question column. (left)');
	define('M4J_LANG_A_WIDTH','Width of the anwer column. (right)');
	define('M4J_LANG_OVERVIEW','Overview');
	define('M4J_LANG_UPDATE_PROCEED','& Proceed');
	define('M4J_LANG_NEW_ITEM','New Item');
	define('M4J_LANG_EDIT_ITEM','Edit Item');
	define('M4J_LANG_CATEGORY_NAME','Category Name');
	define('M4J_LANG_EMAIL_ADRESS','Email Adress');
	define('M4J_LANG_ADD_NEW_ITEM','Add a new form item:');
	define('M4J_LANG_YOUR_QUESTION','Your Question');
	define('M4J_LANG_REQUIRED_LONG','Required?');
	define('M4J_LANG_HELP_TEXT','Help Text. Give users a hint to your question.(not essential)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Type of the Button:');
	define('M4J_LANG_ITEM_CHECKBOX','Checkbox.');
	define('M4J_LANG_YES_NO_MENU','Yes/No Menu.');
	define('M4J_LANG_YES_ON','Yes/On.');
	define('M4J_LANG_NO_OFF','No/Off.');
	define('M4J_LANG_INIT_VALUE','Initial Value:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Type of Textfield:');
	define('M4J_LANG_ITEM_TEXTFIELD','Textfield');
	define('M4J_LANG_ITEM_TEXTAREA','Textarea');
	define('M4J_LANG_MAXCHARS_LONG','Maximum Chars:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Visual Alignment:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Width in Pixel</b> <br/>(Add \'%\' for percentage. Empty = Automatic Fit)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Amount of visible rows:</b><br/> (Only for Textarea)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Menu</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Radiobuttons</b>');
	define('M4J_LANG_LIST_SINGLE','<b>List</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(single choice)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Checkbox Group</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>List</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(multiple choice, with \'CTRL\' & left mousebutton)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Single Choice (Only one item can be selected):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Multiple Choice (Multiple Items can be selected):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Type of Selection:');
	define('M4J_LANG_ROWS_LIST','<b>Amount of visible rows:</b><br/> (Only for Lists)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Allignment: </b> <br/>(Only for Radiobuttons and Checkbox Groups)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Specify the answers.<br/>Empty fields will be ignored.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Introtext. Will only be displayed on category sites.');
	define('M4J_LANG_TITLE','Title');
	define('M4J_LANG_ERROR_NO_TITLE','Please enter a title.');
	define('M4J_LANG_USE_HELP','Help Text for frontend baloontips');
	define('M4J_LANG_TITLE_FORM','Form Title');
	define('M4J_LANG_INTROTEXT','Introtext');
	define('M4J_LANG_MAINTEXT','Maintext');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Email Introtext. (Will only be displayed in emails.)');
	define('M4J_LANG_TEMPLATE','Template');
	define('M4J_LANG_LINK_TO_MENU','Link to Menu');
	define('M4J_LANG_LINK_CAT_TO_MENU','Link current category to a menu');
	define('M4J_LANG_LINK_TO_CAT','Link Category: ');
	define('M4J_LANG_LINK_TO_FORM','Link Form: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Link to display all Forms without a category ');
	define('M4J_LANG_LINK_TO_ALL_CAT','Link to display \'All Categories\'');
	define('M4J_LANG_CHOOSE_MENU','Choose a menue to link to: ');
	define('M4J_LANG_MENU','Menu: ');
	define('M4J_LANG_NO_LINK_NAME','Please insert a link name.');
	define('M4J_LANG_PUBLISHED','Published:');
	define('M4J_LANG_PARENT_LINK','Parent Link');
	define('M4J_LANG_LINK_NAME','Link Name');
	define('M4J_LANG_ACCESS_LEVEL','Access Level:');
	define('M4J_LANG_EDIT_MAIN_DATA','Edit Basic Data');
	define('M4J_LANG_LEGEND','Legend');
	define('M4J_LANG_LINK','Link');
	define('M4J_LANG_IS_VISIBLE',' is published');
	define('M4J_LANG_IS_HIDDEN',' is not published');
	define('M4J_LANG_FORM','Form');
	define('M4J_LANG_ITEM','Item');
	define('M4J_LANG_IS_REQUIRED','Required');
	define('M4J_LANG_IS_NOT_REQUIRED','Not Required');
	define('M4J_LANG_ASSIGN_ORDER','Ordering');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Ordering is not possible for \'All Forms\' !<br/>');
	define('M4J_LANG_EDIT_FORM','Edit Forms');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Published! Click=Unpublish');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Unpublished! Click=Publish');
	define('M4J_LANG_HOVER_REQUIRED_ON','Required! Click= Not Required');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Not Required! Click= Required');
	define('M4J_LANG_DESCRIPTION','Description');
	define('M4J_LANG_AREA','Area');
	define('M4J_LANG_ADJUSTMENT','Configuration');
	define('M4J_LANG_VALUE','Value');
	define('M4J_LANG_MAIN_CONFIG','Main Configuration');
	define('M4J_LANG_MAIN_CONFIG_DESC','You can configure all main settings here. If you want to reset all main settings (incl. CSS) to default click reset.');
	define('M4J_LANG_CSS_CONFIG','CSS Settings:');
	define('M4J_LANG_CSS_CONFIG_DESC','These settings are required for visual presentation of the frontend. If you are not experienced by including external (own) CSS, don\'t change these values !');
	define('M4J_LANG_RESET','Reset');
			
	define('M4J_LANG_EMAIL_ROOT', 'Main Email Adress: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Maximum Answers <br/> Specified Choice: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Preview Width: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Preview Height: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Captcha Duration (in min): ' );
	define('M4J_LANG_HELP_ICON', 'Help Icon: ' );
	define('M4J_LANG_HTML_MAIL', 'HTML Email: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Show Legend: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'The main email adress is used if neither a category nor a form has assigned an email adress.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'This value limits the maximum count of answers for a \'Specified Choice\' item. This value must be numeric.' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Width of the template preview. This value is only used if you don\'t assign a preview width in the basic data of a template.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Height of the template preview. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Belongs to the frontend. This value assigns the maximum duration of a captcha\'s validity. If this duration expires, a new captcha code has to be entered even if the old code was valid.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Define the color of a help icon.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'If you want to receive HTML emails choose yes. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'If you want to display a legend at the backend choose yes.' );
	
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
	
	define('M4J_LANG_INFO_HELP','Info and Help');
	
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Captcha Technique: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Ordinary');
	
	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','Configuration has been successfully reset.');
		define('M4J_LANG_CONFIG_SAVED','Configuration has been successfully saved.');
		define('M4J_LANG_CAPTCHA_DESC', ' There might be some problems with the standard-css-captcha and some servers or templates. For this case you have the alternative to choose between the standard-css-captcha and an ordinary captcha. If the ordinary captcha doesn\'t solve your problem then choose Special' );
		define('M4J_LANG_SPECIAL','Special');
	
	
	define('M4J_LANG_MAIL_ISO','Mail Charset');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');		
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Attachment';	
	define('M4J_LANG_ATTACHMENT','File Attachment');
	define('M4J_LANG_ATTACHMENT_DESC','User can transmit a file by a form.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Enter parameters for this file transfer field:');
	define('M4J_LANG_ALLOWED_ENDINGS','Approved file extensions.');
	define('M4J_LANG_MAXSIZE','Maximum filesize.');
	define('M4J_LANG_BYTE','Byte');
	define('M4J_LANG_KILOBYTE','Kilobyte');
	define('M4J_LANG_MEGABYTE','Megabyte');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Please enter all file extensions without a point(dot) and separated by <b>commas</b>.If you leave blank fields, all file extension will be accepted or any size will be approved. To ease the work, you can choose out of the extensions below which will be included automatically.');
	define('M4J_LANG_IMAGES','Images');
	define('M4J_LANG_DOCS','Documents');
	define('M4J_LANG_AUDIO','Audio');
	define('M4J_LANG_VIDEO','Video');										   
    define('M4J_LANG_DATA','Data');
	define('M4J_LANG_COMPRESSED','Compression');
	define('M4J_LANG_OTHERS','Others');
	define('M4J_LANG_ALL','All');
	
	// New to Version 1.1.9
	define('M4J_LANG_FROM_NAME','From name');
	define('M4J_LANG_FROM_EMAIL','From email');
	define('M4J_LANG_FROM_NAME_DESC','Insert a from name for the emails you will achieve<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','Insert a from email addresss for the emails you will achieve.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Caution! All forms that contain this template will also be deleted!');
	
	// New to Proforms 1.0
	
	define('M4J_LANG_STORAGES','Database records of the form: ');
	define('M4J_LANG_READ_STORAGES','Database records');
	define('M4J_LANG_EXPORT','Export');
	define('M4J_LANG_CSV_EXPORT','CSV Export');
	define('M4J_LANG_WORKAREA','Workarea');
	define('M4J_LANG_WORKAREA_DESC','Width in pixel of the admin working window');
	define('M4J_LANG_STORAGE_WIDTH','Width of a database item');
	define('M4J_LANG_STORAGE_WIDTH_DESC','Width in pixel of a database item which will be listed in a database record.<br> Don\'t add px or % !');
	define('M4J_LANG_RECEIVED','Received');
	define('M4J_LANG_PROCESS','Process');
	define('M4J_LANG_DATABASE','Database');
	define('M4J_LANG_USERMAIL','Unique email address');
	define('M4J_LANG_USERMAIL_DESC','Hereby you can assign the specific field which represents the unique email address of the user.You can not use the confirmation (copy mail) function without assigning an unique email address. There can always be only one unique email address for each form template. Activating this will delete the current unique email address.');
	define('M4J_LANG_USERMAIL_TOOLTIP','This field is the unique email address. The unique email address is always set to `required`!');
	define('M4J_LANG_MATH','Mathematical');
	define('M4J_LANG_RE_CAPTCHA','reCAPTCHA');
	define('M4J_LANG_ITEM_PASSWORD','Password');
	$m4j_lang_elements[22]= 'Password';
	define('M4J_LANG_MAX_UPLOAD_ALLOWED','Your server allows a maximal upload size of ');
	define('M4J_LANG_CSS_EDIT', 'Edit CSS');
	define('M4J_LANG_NO_FRONT_STYLESHEET','The frontend stylesheet file doesn\'t exist! ');
	define('M4J_LANG_HTML','HTML');
	define('M4J_LANG_HTML_DESC','Allows you to display custom HTML code between the form elements.');
	$m4j_lang_elements[50]= 'HTML';
	define('M4J_LANG_EXTRA_HTML',' - EXTRA HTML - ');
	define('M4J_LANG_RESET_DESC','Resetting the configuration to the default setting.');
	define('M4J_LANG_SECURITY','Captcha &amp; Security');
	define('M4J_LANG_RECAPTCHA_THEME','reCaptcha Theme');
	define('M4J_LANG_RECAPTCHA_THEME_DESC','If you are using reCaptcha, you can change the theme.');
	define('M4J_LANG_SUBMISSION_TIME','Sending speed (in ms)');
	define('M4J_LANG_SUBMISSION_TIME_DESC','This value is in milliseconds, determines the acceptable time between the appearance of a form and its dispatch. If a dispatch is quicker than the specified context, it will be declared and rejected as spam.');
	define('M4J_LANG_FORM_TITLE','Show title');
	define('M4J_LANG_FORM_TITLE_DESC','Determines whether the title of a form is displayed. Applies only to the form display and not for the listing in one category.');
	define('M4J_LANG_SHOW_NO_CATEGORY','Show "Without Category"');
	define('M4J_LANG_SHOW_NO_CATEGORY_DESC','Here you can determine the appearance of the pseudo-category "without category". Depending on the setting it will be displayed in the main category listing or not.');
	define('M4J_LANG_FORCE_CALENDAR','Force English calendar');
	define('M4J_LANG_FORCE_CALENDAR_DESC','Under some front-end languages the calendar may not function properly. You can force the use of an English-calendar.');
	define('M4J_LANG_LINK_THIS_CAT_ALL','Link the listing of all categories to a menu.');
	define('M4J_LANG_LINK_THIS_NO_CAT','Link all forms as belonging to a category list to a menu.');
	define('M4J_LANG_LINK_THIS_CAT','Link all forms in the category \'%s\'as a list to a menu.');
	define('M4J_LANG_LINK_THIS_FORM','Link this form to a menu.');
	define('M4J_LANG_LINK_ADVICE','You can link categories and forms only with the given buttons [%s] to a menu!');
	define('M4J_LANG_HELP_TEXT_SHORT','Helptext');
	define('M4J_LANG_ROWS','Rows');
	define('M4J_LANG_WIDTH','Width');
	define('M4J_LANG_ALIGNMENT','Alignment');
	define('M4J_LANG_SHOW_USER_INFO','Show user info');
	define('M4J_LANG_SHOW_USER_INFO_DESC','Displays a list of the collected user data in emails. For example: Joomla Username, Joomla User Email, browser, OS, etc. This data will not be displayed in confirmation emails for the sender of the form.');
	define('M4J_LANG_FRONTEND','Frontend');
	define('M4J_LANG_ADMIN','Admin');
	define('M4J_LANG_DISPLAY','Display');
	define('M4J_LANG_FORCE_ADMIN_LANG','Force admin language');
	define('M4J_LANG_FORCE_ADMIN_LANG_DESC','In normal Proform recognizes the Admin language automatically. Here you can force a language.');
	define('M4J_LANG_USE_JS_VALIDATION','Javascript validation');
	define('M4J_LANG_USE_JS_VALIDATION_DESC','Here you can switch the javascript form validation. If this is off, the fields will be evaluated after submitting.');
	define('M4J_LANG_PLEASE_SELECT','Please select');
	define('M4J_LANG_LAYOUT','Layout');
	define('M4J_LANG_DESC_LAYOUT01','One column');
	define('M4J_LANG_DESC_LAYOUT02','Two columns');
	define('M4J_LANG_DESC_LAYOUT03','Three columns');
	define('M4J_LANG_DESC_LAYOUT04','Head with two columns and footer with one column');
	define('M4J_LANG_DESC_LAYOUT05','Head with one column and footer with two columns');
	define('M4J_LANG_USE_FIELDSET','Use fieldset:');
	define('M4J_LANG_LEGEND_NAME','Legend:');
	define('M4J_LANG_LEFT_COL','Left column:');
	define('M4J_LANG_RIGHT_COL','Right column:');
	define('M4J_LANG_FOR_POSITION',' for position %s');
	define('M4J_LANG_LAYOUT_POSITION','Layout position');
	define('M4J_LANG_PAYPAL','PayPal');
	define('M4J_LANG_EMAIL_TEXT','Email text');
	define('M4J_LANG_CODE','Code');
	define('M4J_LANG_NEVER','Never');
	define('M4J_LANG_EVER','Ever');
	define('M4J_LANG_ASK','Ask');
	define('M4J_LANG_AFTER_SENDING','After sending');
	define('M4J_LANG_CONFIRMATION_MAIL','Confirmation Mail');
	define('M4J_LANG_TEXT_FOR_CONFIRMATION','Email text only for confirmation mail?');
	define('M4J_LANG_SUBJECT','Subject');
	define('M4J_LANG_ADD_TEMPLATE','Add form template');
	define('M4J_LANG_INCLUDED_TEMPLATES','Included form template(s)');
	define('M4J_LANG_ADVICE_USERMAIL_ERROR',"A form can only ever have one unique email address. You already have assigned a form template with unique email address to this form.");
	define('M4J_LANG_STANDARD_TEXT','Standard text');
	define('M4J_LANG_REDIRECT','Redirection');
	define('M4J_LANG_CUSTOM_TEXT','Custom text');
	define('M4J_LANG_ERROR_NO_FORMS','You can only create a form if you have at least created one form template. You have not created yet a form template. Do you wish to create a new form template?');
	define('M4J_LANG_USE_PAYPAL','Use PayPal');
	define('M4J_LANG_USE_PAYPAL_SANDBOX','Use PayPal Sandbox');
	define('M4J_LANG_HEIGHT','Height');
	define('M4J_LANG_CLASS_RESET','Reset Button');
	define('M4J_LANG_CLASS_RESET_DESC','<b>INPUT-Tag</b> - CSS class for the reset button.');
	define('M4J_LANG_PAYPAL_PARAMETERS','Paypal configuration');
	define('M4J_LANG_PAYPAL_ID','Your PayPal ID (email)');
	define('M4J_LANG_PAYPAL_PRODUCT_NAME','Product name');
	define('M4J_LANG_PAYPAL_QTY','Quantity');
	define('M4J_LANG_PAYPAL_NET_AMOUNT','Net amount (unit price)');
	define('M4J_LANG_PAYPAL_CURRENCY_CODE','Currency Code');
	define('M4J_LANG_PAYPAL_ADD_TAX','Plus TAX (Overall, not a percentage!) ');
	define('M4J_LANG_PAYPAL_RETURN_URL','Return address after a successful transaction (URL with http)');
	define('M4J_LANG_PAYPAL_CANCEL_RETURN_URL','Return address when the transaction is aborted (URL with http) ');
	define('M4J_LANG_SERVICE','Service');
	define('M4J_LANG_SERVICE_KEY','Service Key');
	define('M4J_LANG_EDIT_KEY','Edit / Renew Key');
	define('M4J_LANG_CONNECT','Connect');
	define('M4J_LANG_NONE','None');
	define('M4J_LANG_ALPHABETICAL','Alphabetical');
	define('M4J_LANG_ALPHANUMERIC','Alphanumeric');
	define('M4J_LANG_NUMERIC','Numeric');
	define('M4J_LANG_INTEGER','Integer');
	define('M4J_LANG_FIELD_VALIDATION','Validation');
	define('M4J_LANG_SEARCH','Search');
	define('M4J_LANG_ANY','-ANY-');
	define('M4J_LANG_JOBS_EMAIL_INFO','If you don\'t enter an e-mail address here the address of the corresponding category will be used. <br /> If there is no address appended the global address will be used (see configuration).');
	define('M4J_LANG_JOBS_INTROTEXT_INFO','The intro text is the text which will be displayed by a (category) forms list. This does not appear on the form itself.');
	define('M4J_LANG_JOBS_MAINTEXT_INFO','The main text appears at the top of the form.');
	define('M4J_LANG_JOBS_AFTERSENDING_INFO','Here you can determine what will be displayed after submitting the form data.');
	define('M4J_LANG_JOBS_PAYPAL_INFO','After sending you can redirect the user directly to Paypal. Please enter the amounts with a point instead of a comma: 24.50 instead of 24,50! <br /> If you use PayPal, the action you\'ve choosen in "After sending" will passed over !');
	define('M4J_LANG_JOBS_CODE_INFO','You also can enter custom code (HTML, JS <b> but no PHP </b>) at the end of the form or at the after sending page:<br /> e.g. Google Analytics or Conversion. The "after-sending-code" will not be  included if you use an after-sending redirection or the PayPal function.');
	define('M4J_LANG_ERROR_COLOR','Error color');
	define('M4J_LANG_ERROR_COLOR_DESC','If the javascript form validation detects an error ther border of a cell will displayed in a special color. Here you can determine the color (Hexadecimal without #).');
	define('M4J_LANG_CONFIG_DISPLAY_INFO','Here you can change values which are influencing the representation of the front or the back end.');
	define('M4J_LANG_CONFIG_CAPTCHA_INFO','Here you can determine the technology of the security check (captcha) and other security settings.');
	define('M4J_LANG_CONFIG_RESET_INFO','The style sheet file will not be reset, only the CSS class name of the CSS settings!');
	define('M4J_LANG_SERVICE_DESC1',
	'
	If you have a service key you will get access to the Proforms Service Helpdesk here.<br/> 
	To do so, enter the key and save it. Afterwards you need to connect through the "Connect" button with the Service Help Desk Server.<br/>  
	<br/> 
	You can reach the service desk only from the admin area of Proforms.<br/>  
	Direct access is not allowed.<br/>  
	<br/> 
	Each service key is temporary and can’t be used by the end of the service period. The service key is only valid for one domain / Joomla installation. At the first visit of the helpdesk, you will be asked if you want to register the key on the current Domain / Joomla installation. When you click OK, you get access to the helpdesk. Then you can reach the help desk with this key only from the admin area of the registered domain / Joomla installation.<br/>  
	<br/><span style="color:red"> 
	If this installation (domain) is behind a firewall or is generally not publicly accessible (e.g. running on a local server), we can’t offer the service for technical reasons (see Technical Requirements and Conditions of use).<br/>  
	</span><br/> 
	The Proforms Helpdesk offers information about the product, the opportunity to contact us (Direct Requests via our website or by email will be ignored) and downloads to upgrade packages, and other modules or plug-ins for Mooj Proforms.<br/>  
	<br/> 
	The help desk is under construction and is growing every day. When the construction is completed you will receive an update package that provides an automatic upgrade function.<br/>  
	<br/> 
	The domain restriction applies only to the help desk service. Proform’s  functionality and portability are not affected.<br/> 
	<br/> 
	');
	define('M4J_LANG_SEARCH_IN',' Search in ');
	
	// New To Proforms 1.0.5
	define('M4J_LANG_ORDERING','Ordering');
	define('M4J_LANG_DESC','Newest first');
	define('M4J_LANG_ASC','Newest last');
	define('M4J_LANG_ERROR_NO_TEMPLATE','You must assign at least one form template to the form!');
	define('M4J_LANG_TRUNCATE','Empty');
	define('M4J_LANG_REALLY_TRUNCATE','Do you really want to delete all records?');
	define('M4J_LANG_NO_DB_RECORDS','No records!');
	define('M4J_LANG_SEARCH_FAIL','There are no records matching your search query:  %s');
	define('M4J_LANG_COMMA','Comma');
	define('M4J_LANG_SEMICOLON','Semicolon');
	define('M4J_LANG_ANSWER','Answer');
	define('M4J_LANG_SERVER_INFO','Server Info');
	define('M4J_LANG_PRINT','Print');
	define('M4J_LANG_STORAGE_CONFIG','Configuration of database records');
	define('M4J_LANG_TABLE_VIEW','Table Display');
	define('M4J_LANG_USE_QUESTIONS','Show Questions');
	define('M4J_LANG_USE_ALIAS','Show Alias');
	define('M4J_LANG_USE_QUESTIONS_DESC','Shows mainly questions at the table head and at the head of exports. If a question is blank the alias will be shown.');
	define('M4J_LANG_USE_ALIAS_DESC','Shows mainly aliases at the table head and at the head of exports. If an alias is blank the question will be shown.');
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR_ADDITION',' Or insert an alias.');
	define('M4J_LANG_USE_QUESTIONS_DESC_FE','Shows mainly the questions. If a question is blank the alias will be used.');
	define('M4J_LANG_USE_ALIAS_DESC_FE','Shows mainly the aliases. If an alias is blank the question will be used.');
	define('M4J_LANG_DATA_LISTING_CONFIRMATION','Submission list for confirmation');
	define('M4J_LANG_DATA_LISTING','Submission list for standard mail');
	define('M4J_LANG_ALIAS_ADVICE','You can add field values to the editor by entering the alias in between curly brackets [ <b>{ALIAS}</b> ]. Fields without alias won\'t be considered. <br/> ATTENTION: [The automatic insert function might be not 100% compatible to IE] ');
	define('M4J_LANG_INSERT_FIELD_VALUE','Insert field values');
	
	// New To Proforms 1.1
	define('M4J_LANG_ARTICLES','Articles');
	define('M4J_LANG_OPTIN_REDIRECT','Opt-In redirection');
	define('M4J_LANG_OPTIN_MAIL','Opt-In confirmation email');
	define('M4J_LANG_DOUBLE_OPTIN_DESC','The double-opt-in prodcedure allows you to let users confirm submissions comply with the law in most countries.<br/> Please note that you need to active database storage for this function!');
	define('M4J_LANG_ARTICLE_LINK_INFO','Link to a content article');
	define('M4J_LANG_OPT_REDIRECT_DESC','You can redirect users to any URL after they haved successfully confirmed their submission. On the redirected site you can inform users as you like about their successful confirmation. If you leave this field blank a standard text will be used instead.');
	define('M4J_LANG_OPTOUT_REDIRECT_DESC','You can redirect users to any URL after they haved successfully revoked their confirmation. On the redirected site you can inform users as you like about their successful revocation. If you leave this field blank a standard text will be used instead.');
	define('M4J_LANG_OPTOUT_REDIRECT','Opt-Out redirection');
	define('M4J_LANG_OPTOUT_MAIL','Opt-Out confirmation email');
	define('M4J_LANG_OPTIIN_ACTIVATE','Enable double opt-in');
	define('M4J_LANG_OPTIN_EMAIL_OPTION','Send admin email only after user confirmation');
	define('M4J_LANG_OPTIN_EMAIL_OPTION_DESC','If you activate this option YOU will only receive an email (means the standard mail) if the user successfully confirms the submission.');
	define('M4J_LANG_CONFIRMATION','Confirmation');
	define('M4J_LANG_CONFIRMED','Confirmed');
	define('M4J_LANG_NOT_CONFIRMED','Not confirmed');
	define('M4J_LANG_OPTIN','Opt-In');
	define('M4J_LANG_OPTOUT','Opt-Out');
	define('M4J_LANG_OPTIN_NO_CONFIRMATION_EMAIL','No confirmation email');
	define('M4J_LANG_OPTIN_NO_CONFIRMATION_EMAIL_DESC','If you activate this option, no confirmation email will be sent for opt-in or opt-out. If activated; users will only be redirected or will see the standard confirmation / revoking text.');
	define('M4J_LANG_OPTIN_DESC','Here you can set up the email which will be sent to a user if he successfully confirmes a submission. By activating the option `No confirmation email` you can disable sending of this email. You can use  alias placeholders as usal for placing submission values inside the email. For this purpose you need to set an alias between curly brackets. By using {J_OPT_OUT} you can apply a link for revoking the confirmation.');
	define('M4J_LANG_OPTOUT_DESC','Here you can set up the email which will be sent to a user if he successfully revokes a confirmation. By activating the option `No confirmation email` you can disable sending of this email. You can use alias placeholders as usal for placing submission values inside the email. For this purpose you need to set an alias between curly brackets. By using {J_OPT_IN} you can apply a link for futher confirmation.');
	define('M4J_LANG_OPTIN_CONFIRMATION_SUBJECT','You have confirmed your submission at %s.');
	define('M4J_LANG_OPTOUT_CONFIRMATION_SUBJECT','You have revoked your confirmation at %s.');
	define('M4J_LANG_OPTIN_FILTER','Confirmation filter');
	define('M4J_LANG_NO_OPTIN_ADVICE','You need to activate database storage for using the double-opt-in function. You can activate database storgage at the tab: %s  by the option %s.');
	define('M4J_LANG_OPTIN_SUBJECT','Opt-In email subject');
	define('M4J_LANG_OPTOUT_SUBJECT','Opt-Out email subject');
	define('M4J_LANG_TEXT_FOR_CONFIRMATION_DESC','If you activate this option, the email text will only be added at confirmation emails. This means the admin email will only include  the native submission listing if submission listing is enabled.');
	define('M4J_LANG_DATA_LISTING_CONFIRMATION_DESC','If this option is activated, the CONFIRMATION EMAIL (if confirmation email sending has been set up) will include the standard listing of all submissions.');
	define('M4J_LANG_DATA_LISTING_DESC','If this option is activated, the MAIN-ADMIN_EMAIL (to the predefined email addresse(s) ) will include the standard listing of all submissions.');
	define('M4J_LANG_EMAIL_FORMAT_DESC','Please enter the email addresse(s) for the main (admin) email(s) here. Multiple email addresses (if supported by your mail server) need to be separated by a semicolon [;] or by comma [,]. Please test your mail server if semicolon- or comma separated notations are supported. You can never use both notations at once.');
	define('M4J_LANG_EMAIL_SUBJECT_DESC','Please enter an email subject here. This subject is also used for the confirmation email. You can place submission values inside the subject by adding an alias placeholder. This needs to be set in curly brackets and the appropriate field must have applied an alias.');
	define('M4J_LANG_STORAGE_MAIL_HEADING','Email Manager! - Form');
	define('M4J_LANG_STORAGE_MAIL_DESTINATION','Destination');
	define('M4J_LANG_MAIL_DESTINATION','Detination');
	define('M4J_LANG_ALL_RECORDS','All records');
	define('M4J_LANG_FILTERED_RECORDS','Search queries');
	define('M4J_LANG_MAIL_ONLY_CONFIRMED','Send email only to confirmed records.');
	define('M4J_LANG_TO','To');
	define('M4J_LANG_MAIL_ADDRESS_IS','Email address is');
	define('M4J_LANG_UNIQUE_OF_FORM','unique email address of the form');
	define('M4J_LANG_USER_MAIL_ADDRESS','email address of the Joomla user (System address)');
	define('M4J_LANG_SENDING_CONDITIONS','Sending options');
	define('M4J_LANG_FIELD_ITEM','Field item');
	define('M4J_LANG_PROGRESS','Progress');
	define('M4J_LANG_SECONDS','Seconds');
	define('M4J_LANG_NORMAL','Normal');
	define('M4J_LANG_HIGH','High');
	define('M4J_LANG_PRIO','Priority');
	define('M4J_LANG_SENDING_INTERVAL','Sending interval');
	define('M4J_LANG_MAILS_AT_ONCE','Mails at once');
	define('M4J_LANG_SEND','Send');
	define('M4J_LANG_SAVE_AS_TEMPLATE','Save as template');
	define('M4J_LANG_GET_FROM_TEMPLATE','Create from template');
	define('M4J_LANG_SENDING_BEGUN','Sending of the emails has started!');
	define('M4J_LANG_SENDING_ADVICE_1','Don\'t close the browser window!');
	define('M4J_LANG_SENDING_ADVICE_2','Don\'t close this pop up!');
	define('M4J_LANG_SENDING_ADVICE_3','Don\'t refresh the site!');
	define('M4J_LANG_SENDING_ADVICE_4','Make sure that your session is not expired.<br/>If expired; cancel the sending process and log in again!');
	define('M4J_LANG_SENDING_ADVICE_5','If you want to cancel sending, click the Cancel button on the upper right side!');
	define('M4J_LANG_FOUND_STORAGE_ITEMS','Found records');
	define('M4J_LANG_PROTOCOL','Protocol');
	define('M4J_LANG_NOFROMNAME','Please enter a from name.');
	define('M4J_LANG_NOFROMMAIL','Please enter a from email address.');
	define('M4J_LANG_NOVALIDFROMADDRESS','The from email address is not a valid email address.');
	define('M4J_LANG_NO_SUBJECT','Please enter a subject!');
	define('M4J_LANG_OVERWRITE_DELETE','Overwrite / Delete');
	define('M4J_LANG_BODY_TOGGLE_DESC','Please select FIRST if you like to use HTML emails or not. When switching between HTML mail and non HTML mail; already created mail content will not be taken over to the appropriate editor. This is because otherwise it would cause formatting errors!');
	define('M4J_LANG_FROMNAME','From name');
	define('M4J_LANG_FROMMAIL','From email');
	define('M4J_LANG_CLOSE','Close');
	define('M4J_LANG_SENDING_CANCELED','Sending has been canceled!');
	define('M4J_LANG_MAIL_SENDING_END','Sending finished!');
	define('M4J_LANG_SENDING_CHUNK','Sending chunk');
	define('M4J_LANG_SENT','Sent');
	define('M4J_LANG_FAILED','Not sent');
	define('M4J_LANG_NOVALIDADDRESS','without valid email address.');
	define('M4J_LANG_APPS_HEADING','Apps for form');
	define('M4J_LANG_INSTALL_UNINSTALL','Install/Uninstall');
	define('M4J_LANG_BACKUP','Import/Export');
	define('M4J_LANG_START_EXPORT','Start export');
	define('M4J_LANG_START_IMPORT','Start import');
	define('M4J_LANG_DB_EXPORT','Database export');
	define('M4J_LANG_DB_IMPORT','Database import');
	define('M4J_LANG_IGNORE_CONFIG','Ignore configuration data');
	define('M4J_LANG_IGNORE_APPS','Ignore App data');
	define('M4J_LANG_IGNORE_RECORDS','Ignore submission records');
	define('M4J_LANG_BACKUPERROR_1','The backup file is not compatible to the PRO version but with the BASIC version.');
	define('M4J_LANG_BACKUPERROR_2','The backup file is not compatible to this build (%s)');
	define('M4J_LANG_BACKUPERROR_3','The file is not a Proforms backup file');
	define('M4J_LANG_BACKUPERROR_4','Failed to upload the backup file. Please check the Joomla folder "tmp" if you have the writing permissions.');
	define('M4J_LANG_BACKUPERROR_5','You either have not uploaded a file or the file is not a SQL file.');
	define('M4J_LANG_BACKUPERROR_6','An error occurred when running the backup, the file appears to be damaged or your MySQL is not compatible with the backup.');
	define('M4J_LANG_EXTENSIONS','Extensions');
	define('M4J_LANG_APPS','Apps');
	
	define('M4J_LANG_ACTIVEAPP_DESC','Inactive Apps can not be used on forms and/or doesn\'t show at the frontend if they have a frontend view.');
	define('M4J_LANG_ADMINISTRATION','Admin');
	define('M4J_LANG_ADMINISTRATION_DESC','If an App has a general application / admin area you can get there with the appropriate \'Start\' button below.');
	define('M4J_LANG_START','Start');
	define('M4J_LANG_FRONTEND_VIEW_DESC','If an App has a frontend view you can link the frotend view by Joomla\'s native menu system. Configuration of the App for each form goes by the appropriate \'App\' button at the form listing area.');
	define('M4J_LANG_PLUGIN','Plugin');
	define('M4J_LANG_PLUGIN_DESC','Shows if the App has a Plugin. Plugins affecting forms in their presentation and implementation. Configuration of the App for each form goes by the appropriate \'App\' button at the form listing area.');
	define('M4J_LANG_AUTHOR','Author / Info');
	define('M4J_LANG_CREATED','Installed');
	define('M4J_LANG_VERSION','Version');
	define('M4J_LANG_NOT_ACTIVE','Not active');
	define('M4J_LANG_REALLYUNINSTALL_APP','Do you really want to uninstall the choosen App?');
	define('M4J_LANG_NOAPPSELECTED','No app has been choosen!');
	define('M4J_LANG_KLICKFORACTIVATE','Click for activation');
	define('M4J_LANG_KLICKFORDEACTIVATE','Click for deactivation');
	define('M4J_LANG_HELPDESK','Helpdesk');
	define('M4J_LANG_TEXT','Text');
	define('M4J_LANG_ADDOPTION','Add option');
	define('M4J_LANG_USEVALUES','Use different values');
	define('M4J_LANG_USEVALUES_DESC','If activated you can use different values. If disabled a submission value is equal to the text.  Please note that if you use `different values` with a blank value and have set up this form element as `required`, that this will be declared as not choosen. If you use the number 0 (zero) it will not displayed at the database or in emails. Please use `0.0` instead!');
	define('M4J_LANG_ERROR_ALIAS', "An alias must consist at least out of 2 characters. And may not contain following characters:\u000a   /, \\\ , ? , & , [ , ] , ( , ) , * , + , \\\", \' ");
	define('M4J_LANG_BACKUP_DESC','Do not trust external backup files, unless these are from Mad4Media / Mooj.org or have been certified by us!<br/>External backup files may contain malicious code, and can destroy your database or your Joomla.<br><b>If you are going to import a backup all the old (current) settings will get lost unrecoverable!</b>');
	define('M4J_LANG_INFO','Information');
	define('M4J_LANG_NOAPPFORJID','There is no app with frontend view (activated) for this form');
	define('M4J_LANG_ITEM_HIDDEN','Hidden Field');
	$m4j_lang_elements[23]= 'Hidden Field';
	define('M4J_LANG_PAYPAL_LC','Language-Country-Code');
	define('M4J_LANG_PAYPAL_LC_DESC','You can set up which language the PayPal entry page shall use. Paypal uses country codes for this instead of language codes. PayPal also supports only a small number of country codes. If you set up a country code which is not supported, PayPal uses `US` (American English) instead. If you don\'t use a country code Paypal displays a language detected by the browser of the user (if supported otherwise English).');
	define('M4J_LANG_DONT_USE','Don\'t use');
	define('M4J_LANG_IMPORTANT_INFO','Important Information');
	define('M4J_LANG_IMPORTANT_INFO_INNER','The email manager uses a new technique to send fast mass mail.<br/> If you have set up `Sendmail` or `PHPmail` at Joomla\'s configuration and send mass mail in too short intervals it is possible that your hosting provider interprets this as spam from a hijacked site. <br/> There are hosting providers closing and blocking your site including all other sites at this IP immediatly for a while or until you get in contact with the provider. In this time nobody can reach your site(s).<br/> Therefore we recommend allways to use the `SMTP` method for mass mails and use sending intervals where one chunk starts sending after the last chunk has finished.<br/>Before using the email manager for sending mass mail, please read the appropriate manual at the helpdesk(Available only in English).<br/><b>Because of the GPL license there is no warranty for this software.<br/>Mad4Media shall not be liable for any damages resulting from the use of this software</b>');
	define('M4J_LANG_APPINSTALL_SUCCESS','App has been successfully installed! ');
	define('M4J_LANG_APPUNINSTALL_SUCCESS','App has been successfully uninstalled! ');
	define('M4J_LANG_PATCHINSTALL_SUCCESS','Patch has been successfully installed! ');
	define('M4J_LANG_BACKUP_SUCCESS','Your Proforms database has been successfully restored! ');
	define('M4J_LANG_ONLYPRO','Only for PRO version!');
	define('M4J_LANG_ONLYPRO_DESC','<span style=\'color:red; font-weight:bold\'>This function is only available for the PRO version!</span>');
	define('M4J_LANG_ONLYONETEMPLATE','The Basic version allows you to assign only ONE form template. <br> In the PRO version you can compile your form from several templates!');
	
	
	
?>