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

	/**  T VERSION */


	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
	
	$m4j_lang_elements[1]= 'Kontrol kutusu';
	$m4j_lang_elements[2]= 'Evet/Hayir Seçimi';
	$m4j_lang_elements[10]= 'Tarih';
	$m4j_lang_elements[20]= 'Text Alani';
	$m4j_lang_elements[21]= 'Text Bölümü';
	$m4j_lang_elements[30]= 'Menü(tek seçim)';
	$m4j_lang_elements[31]= 'Seçim Menüsü(tek seçim)';
	$m4j_lang_elements[32]= 'Radiobuttons(tek seçim)';
	$m4j_lang_elements[33]= 'Kontrol kutusu Group(çoklu seçim)';
	$m4j_lang_elements[34]= 'List(çoklu seçim)';
	
	
	define('M4J_LANG_FORMS','Formlar');
	define('M4J_LANG_TEMPLATES','Templateler');
	define('M4J_LANG_CATEGORY','Kategori');
	define('M4J_LANG_CONFIG','Ayarlar');
	define('M4J_LANG_HELP','Bilgi & Yardim');
	define('M4J_LANG_CANCEL','Iptal');
	define('M4J_LANG_PROCEED','Ilerle');
	define('M4J_LANG_SAVE','Kaydet');
	define('M4J_LANG_NEW_FORM','Yeni Form');
	define('M4J_LANG_NEW_TEMPLATE','Yeni Template');
	define('M4J_LANG_ADD','Ekle');
	define('M4J_LANG_EDIT_NAME','Bu template(e) isim ve açiklama ekle');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Yeni Template');
	define('M4J_LANG_TEMPLATE_NAME','Template(in) adi');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Bu template(e) isim ekle');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Kisa açiklama (Dahili kullanim için.Bos birakilabilir)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Kisa Açiklama Ekle');
	define('M4J_LANG_DELETE','Sil');
	define('M4J_LANG_DELETE_CONFIRM','Bu maddeyi silmek istediginizden eminmisiniz?');
	define('M4J_LANG_NEW_CATEGORY','Yeni Kategori');
	define('M4J_LANG_NAME','Isim');
	define('M4J_LANG_SHORTDESCRIPTION','Kisa Açiklama');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Madde');
	define('M4J_LANG_EDIT','Ekle');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Madde -> Düzenle');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Lütfen bu template için birisim girin !');
	define('M4J_LANG_AT_LEAST_ONE','Bu madde silinemez!<br/>En az bir maddenin ekli olmasi gerekir.');	
	
	
	define('M4J_LANG_EDIT_ELEMENT','Template(e) eklenecek olan madde: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Lütfen bir katagori isimi giriniz');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Lütfen geçerli bir e-mail giriniz yada bos birakiniz.<br/>');
	define('M4J_LANG_EMAIL','eMail');
	define('M4J_LANG_POSITION','Gönder');
	define('M4J_LANG_ACTIVE','Aktive');
	define('M4J_LANG_UP','Yukari');
	define('M4J_LANG_DOWN','Asagi');
	define('M4J_LANG_EDIT_CATEGORY','Katagori Ekle');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Template Unsurlari: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Template(e) yeni element ekle: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Lütfen bir soru girin.');
	define('M4J_LANG_REQUIRED','Gerekli');
	define('M4J_LANG_QUESTION','Soru');
	define('M4J_LANG_TYPE','Tip');
	define('M4J_LANG_YES','Evet');		
	define('M4J_LANG_NO','Hayir');	
	define('M4J_LANG_ALL_FORMS','Tüm Forumlar');
	define('M4J_LANG_NO_CATEGORYS','Kategori Disi');
	define('M4J_LANG_FORMS_OF_CATEGORY','Kategori Formu: ');
	define('M4J_LANG_PREVIEW','Ön Izleme');
	define('M4J_LANG_DO_COPY','Kopyala');		
	define('M4J_LANG_COPY','Kopyala');
	define('M4J_LANG_VERTICAL','Yatay Uzunluk');
	define('M4J_LANG_HORIZONTAL','Dikey Uzunluk');
	define('M4J_LANG_EXAMPLE','Örnek');
	define('M4J_LANG_CHECKBOX','Button');	
	define('M4J_LANG_DATE','Tarih');
	define('M4J_LANG_TEXTFIELD','Text Alani');
	define('M4J_LANG_OPTIONS','Belirlenmis Seçimler');
	define('M4J_LANG_CHECKBOX_DESC','Basit Evet/Hayir Sorusu.');
	define('M4J_LANG_DATE_DESC','Ziyaretci bir tarih girmeli.');
	define('M4J_LANG_TEXTFIELD_DESC','Kullanici bireysel bir yazi yazmali.');
	define('M4J_LANG_OPTIONS_DESC','Kullanici belirlenenlerin disinda bir yada birden fazla cevap verebilir. ');
	define('M4J_LANG_CLOSE_PREVIEW','Ön Izlemeyi Kapat');
	define('M4J_LANG_Q_WIDTH','Soru sütun genisligi ( en ). (Sol)');
	define('M4J_LANG_A_WIDTH','Cevap sütun genisligi ( en )(Sag)');
	define('M4J_LANG_OVERVIEW','Gözden Geçir');
	define('M4J_LANG_UPDATE_PROCEED','& Ilerle');
	define('M4J_LANG_NEW_ITEM','Yeni Madde');
	define('M4J_LANG_EDIT_ITEM','Madde Düzenle');
	define('M4J_LANG_CATEGORY_NAME','Kategori Düzenle');
	define('M4J_LANG_EMAIL_ADRESS','Email Adresi');
	define('M4J_LANG_ADD_NEW_ITEM','Yeni Madde Ekle:');
	define('M4J_LANG_YOUR_QUESTION','Sizin Sorunuz');
	define('M4J_LANG_REQUIRED_LONG','Olmasi Sartmi?');
	define('M4J_LANG_HELP_TEXT','Yardim Textti. Ziyaretcinize sorunuzla iligili ipucu verin.(Gerekli degil)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Button Tipi:');
	define('M4J_LANG_ITEM_CHECKBOX','Konrtol Kutusu.');
	define('M4J_LANG_YES_NO_MENU','Evet/Hayir Menüsü.');
	define('M4J_LANG_YES_ON','Evet/On.');
	define('M4J_LANG_NO_OFF','Hayir/Off.');
	define('M4J_LANG_INIT_VALUE','Birincil Veri:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Text Alan Tipi:');
	define('M4J_LANG_ITEM_TEXTFIELD','Text Alani');
	define('M4J_LANG_ITEM_TEXTAREA','Text Bölümü');
	define('M4J_LANG_MAXCHARS_LONG','Maksimum Karakter:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Görsel Uymluluk:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Piksel Genisligi</b> <br/>(Ekle \'%\' yüzde. Bos = Automatik Ayalar)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Görünen sira miktari:</b><br/> (Sadece text bölümü için)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Menü</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Radiobuttons</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Liste</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(tek seçim)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Kontrol kutusu Gruplari</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Liste</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Çoklu seciç için, with \'CTRL\' & sol tus)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Tek Seçim (Sadece bir madde seçilebilir):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Çoklu Seçim (Birden Fazla Madde seçilebilir):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Secim Tipi:');
	define('M4J_LANG_ROWS_LIST','<b>Görünen sira miktari:</b><br/> (Sadece Listeler Için)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Hizalama: </b> <br/>(Sadece Radiobuttonlari and Kontrol Gruplari Için)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Cevaplanmislari Belirt.<br/>Bos alanlar gözöünüde tutulmayacaktir.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Tanitici text. Sadece kategori kisimlarinda gözükecek.');
	define('M4J_LANG_TITLE','Baslik');
	define('M4J_LANG_ERROR_NO_TITLE','Lütfen bir baslik girin.');
	define('M4J_LANG_USE_HELP','Frontend için yardimci baloontipleri');
	define('M4J_LANG_TITLE_FORM','Form Basligi');
	define('M4J_LANG_INTROTEXT','Tanitici Text');
	define('M4J_LANG_MAINTEXT','Anatext');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Email Taticitexti. (Sadece emaillerde gösterilecek.)');
	define('M4J_LANG_TEMPLATE','Template');
	define('M4J_LANG_LINK_TO_MENU','Menüye Link Ver');
	define('M4J_LANG_LINK_CAT_TO_MENU','Geçerli Kategoriyi bir menüye link olarak ekle');
	define('M4J_LANG_LINK_TO_CAT','Link Kategorisi: ');
	define('M4J_LANG_LINK_TO_FORM','Link Formu: ');
	define('M4J_LANG_LINK_TO_NO_CAT','"Katagori Disi" olanlari görüntüle ');
	define('M4J_LANG_LINK_TO_ALL_CAT','\'Tüm Kategoriler\ Görüntüle');
	define('M4J_LANG_CHOOSE_MENU','Link eklenicek menüyü seç: ');
	define('M4J_LANG_MENU','Menu: ');
	define('M4J_LANG_NO_LINK_NAME','Lütfen bir link adi girin.');
	define('M4J_LANG_PUBLISHED','Yayinlanmis:');
	define('M4J_LANG_PARENT_LINK','Ilgili Link');
	define('M4J_LANG_LINK_NAME','Link Ismi');
	define('M4J_LANG_ACCESS_LEVEL','Ulasim Seviyesi:');
	define('M4J_LANG_EDIT_MAIN_DATA','Temel Bilgileri düzenle');
	define('M4J_LANG_LEGEND','Legend');
	define('M4J_LANG_LINK','Link');
	define('M4J_LANG_IS_VISIBLE',' yayinlandi');
	define('M4J_LANG_IS_HIDDEN',' yayinlanmadi');
	define('M4J_LANG_FORM','Form');
	define('M4J_LANG_ITEM','Maddeler');
	define('M4J_LANG_IS_REQUIRED','Gerekli');
	define('M4J_LANG_IS_NOT_REQUIRED','Gerekli Degil');
	define('M4J_LANG_ASSIGN_ORDER','Gönder/Emir');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Gönder/Emir \'Tüm Forumlar\' için uygulanamaz!<br/>');
	define('M4J_LANG_EDIT_FORM','Fromlari Düzenle');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Yayinlandi! Click=Yayinlanmadi');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Yayinlanmamis! Click=Yayinlandi');
	define('M4J_LANG_HOVER_REQUIRED_ON','Gerekli! Click= Gerekli Degil');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Gerekli Degil! Click= Gerekli');
	define('M4J_LANG_DESCRIPTION','Açiklama');
	define('M4J_LANG_AREA','Alan');
	define('M4J_LANG_ADJUSTMENT','Ayarlar');
	define('M4J_LANG_VALUE','Deger');
	define('M4J_LANG_MAIN_CONFIG','Ana Ayarlar:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Bütün ana ayarlari buradan yapabilirsiniz. Eger bütün ayarlari degistirmek istiyorsaniz (CSS dahil ) reset(e) basin.');
	define('M4J_LANG_CSS_CONFIG','CSS Ayarlari:');
	define('M4J_LANG_CSS_CONFIG_DESC','Bu ayarlar formun görselligi için gereklidir. Eger css (own) üzerine tecrübeniz yok lütfen degistirmeyin!');
	define('M4J_LANG_RESET','Reset');
			
	define('M4J_LANG_EMAIL_ROOT', 'Ana Email Adresi: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Maksimum Cevaplar <br/> Özellikli Seçim: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Ön izleme Gennisligi: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Ön izkleme Yüksekligi: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Captcha Süresi (dk): ' );
	define('M4J_LANG_HELP_ICON', 'Yardim Ikonu: ' );
	define('M4J_LANG_HTML_MAIL', 'HTML Email: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Show Legend: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'Ana mail adresi katagoriler de mail bulunamamsi durumunda geçerli mail adresidir' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Özel Seçimler deki maksimum verilebiecek seçim sayisidir. Burada ki deger sayisal olmalidir.' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Template Ön Izleme Genisligi.Eger template(e) bir genislik degeri vermediyseniz kullanilabilir.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Template Ön Izleme Yüksekligi. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Captcha(nin) bekleme süresidir.Eger bekleme süresi asilmis ise girilen kod dogru olsabile yeni bir captcha sorusu gösterilecektir.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Yardim ikonunun rengini belirle.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Eger geri dönüs e-mail(ini) HTML olarak istiyosaniz isaretleyin.' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'If you want to display a legend at the backend choose yes.' );
	
	define('M4J_LANG_CLASS_HEADING', 'Ana baslik:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Text basligi' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Listele- Wrap ' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Listele- Basliklari' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Listele- Tanitim textlerini ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Form- Wrap ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Form- Tablolari ' );
	define('M4J_LANG_CLASS_ERROR', 'Hata Text' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Yolla Button Wrap' );
	define('M4J_LANG_CLASS_SUBMIT', 'Yolla Button ' );
	define('M4J_LANG_CLASS_REQUIRED', 'Gerekli * css ' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Sitenin basligi ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Basliktan sonra ki içerik. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap of a listing item.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Listelenmis maddelerin basliklari. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Tanitim textlerinin basliklari. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap of a form area. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Tablodaki tüm from maddelerini görüntüler.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - CSS sinifi hata mesaji. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap of the submit button ' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - CSS class of the submit button. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - CSS class of the \' <b>*</b> \' bir karakter girilmeli.' );
	
	define('M4J_LANG_INFO_HELP','Info and Help');
	
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Captcha Teknigi: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Ordinary');
	
	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','Ayarlar basarili bir sekilde resetlendi.');
		define('M4J_LANG_CONFIG_SAVED','Ayarlar basarili bir sekilde kayit edili.');
		define('M4J_LANG_CAPTCHA_DESC', ' standard-css-captcha kullanimi bazi serverlarda veya templatelerde hatalara yol açabilir. Bu durumda normal bir veya standart bir captcha kullanmanizi tavsiye edilir. Eger normal captcha probleminizi çözmezse özel capctha kullanabilirsiniz.' );
		define('M4J_LANG_SPECIAL','Özel');
	
	
	define('M4J_LANG_MAIL_ISO','Mail Charset');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish-Türkce), iso-8859-10 (Nordic),iso-8859-11 (Thai)');		
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Eklenti';	
	define('M4J_LANG_ATTACHMENT','Dosya Eklentisi');
	define('M4J_LANG_ATTACHMENT_DESC','Ziyaretci form üzerinden dosya gönderebilir.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Dosya transfer alani için gerekli parametreleri girin:');
	define('M4J_LANG_ALLOWED_ENDINGS','Onaylanan dosya uzantilari. Orn:jpg,gif,swf,exe,doc ext');
	define('M4J_LANG_MAXSIZE','Maksimum dosya boyutu.');
	define('M4J_LANG_BYTE','Byte');
	define('M4J_LANG_KILOBYTE','Kilobyte(kb)');
	define('M4J_LANG_MEGABYTE','Megabyte(mb)');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Dosya uzantilarini girerken lütfen (.) nokta yada (,) virgül kullanmayin.Eger bu kisimi bos birakirsaniz tüm dosyalar tipine yada büyüklügüne bakilmaksizin kabul edilcektir. Daha rahat çalisabilmek için uzanti disi ( out of extentions ) kisimini seçerseniz otomatik olarak çalisacaktir.');
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
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Dikkat! Tüm form içerigi ve template silinecektir!');
	

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