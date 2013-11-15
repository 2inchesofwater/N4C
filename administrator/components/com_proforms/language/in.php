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
	$m4j_lang_elements[2]= 'Piihan Ya/ Tidak';
	$m4j_lang_elements[10]= 'Tanggal';
	$m4j_lang_elements[20]= 'Lajur Teks';
	$m4j_lang_elements[21]= 'Bidang Teks';
	$m4j_lang_elements[30]= 'Menu(pilihan tunggal)';
	$m4j_lang_elements[31]= 'Pilih Menu(pilihan tunggal)';
	$m4j_lang_elements[32]= 'Radiobuttons(single choice)';
	$m4j_lang_elements[33]= 'Checkbox Group(pilihan ganda)';
	$m4j_lang_elements[34]= 'Daftar(pilihan ganda)';
	
	
	define('M4J_LANG_FORMS','Form');
	define('M4J_LANG_TEMPLATES','Templat');
	define('M4J_LANG_CATEGORY','kategorI');
	define('M4J_LANG_CONFIG','konfigurasi');
	define('M4J_LANG_HELP','Info & Bantu');
	define('M4J_LANG_CANCEL','Batal');
	define('M4J_LANG_PROCEED','Lanjut');
	define('M4J_LANG_SAVE','Simpan');
	define('M4J_LANG_NEW_FORM','Form Baru');
	define('M4J_LANG_NEW_TEMPLATE','Templat Baru');
	define('M4J_LANG_ADD','Tambah');
	define('M4J_LANG_EDIT_NAME','Sunting nama dan deskripsi templat ini');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Templat Baru');
	define('M4J_LANG_TEMPLATE_NAME','Nama Templat ini');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Sunting nama templat ini');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Deskripsi singkat (untuk penggunaan internal. Dapat dikosongkan)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Sunting Deskripsi singkat');
	define('M4J_LANG_DELETE','Hapus');
	define('M4J_LANG_DELETE_CONFIRM','Anda benar2 akan menhapus item ini?');
	define('M4J_LANG_NEW_CATEGORY','Kategori Baru');
	define('M4J_LANG_NAME','Nama');
	define('M4J_LANG_SHORTDESCRIPTION','Deskripsi singkat');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Item');
	define('M4J_LANG_EDIT','Sunting');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Item -> Sunting');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Masukkan nama templat ini !');
	define('M4J_LANG_AT_LEAST_ONE','Item ini tak dapat dihapus!<br/>Minimal harus terdapat satu elemen di sini.');
	

		define('M4J_LANG_EDIT_ELEMENT','Sunting elemen Templat: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Masukkan nama kategori');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Masukkan alamat email yang valid atau biarkan kosong.<br/>');
	define('M4J_LANG_EMAIL','eMail');
	define('M4J_LANG_POSITION','Urutan');
	define('M4J_LANG_ACTIVE','Aktif');
	define('M4J_LANG_UP','Naik');
	define('M4J_LANG_DOWN','Turun');
	define('M4J_LANG_EDIT_CATEGORY','Sunting Kategori');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Elemen2 dari Templat: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Masukkan elemen baru ke templat: ');
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Masukkan sebuah pertanyaan.');
	define('M4J_LANG_REQUIRED','Wajib');
	define('M4J_LANG_QUESTION','Pertanyaan');
	define('M4J_LANG_TYPE','Tipe');
	define('M4J_LANG_YES','Ya');
	define('M4J_LANG_NO','Tidak');
	define('M4J_LANG_ALL_FORMS','Semua Form');
	define('M4J_LANG_NO_CATEGORYS','Tanpa Kategori');
	define('M4J_LANG_FORMS_OF_CATEGORY','Form Kategori: ');
	define('M4J_LANG_PREVIEW','Tampilkan');
	define('M4J_LANG_DO_COPY','Duplikasi');
	define('M4J_LANG_COPY','Duplikasi');
	define('M4J_LANG_VERTICAL','Vertikal');
	define('M4J_LANG_HORIZONTAL','Horisontal');
	define('M4J_LANG_EXAMPLE','Contoh');
	define('M4J_LANG_CHECKBOX','Tombol');
	define('M4J_LANG_DATE','Tanggal');
	define('M4J_LANG_TEXTFIELD','Lajur Teks');
	define('M4J_LANG_OPTIONS','Pilihan Tertentu');
	define('M4J_LANG_CHECKBOX_DESC','Pertanyaan sederhana Ya/ Tidak.');
	define('M4J_LANG_DATE_DESC','User harus memasukkan tanggal.');
	define('M4J_LANG_TEXTFIELD_DESC','User harus memasukkan Teks tersendiri.');
	define('M4J_LANG_OPTIONS_DESC','User memilih satu atau lebih jawaban dari antara item2 yang ditentukan. ');
	define('M4J_LANG_CLOSE_PREVIEW','Tutup Tampilan');
	define('M4J_LANG_Q_WIDTH','Lebar kolom pertanyaan. (kiri)');
	define('M4J_LANG_A_WIDTH','Lebar kolom jawaban. (kanan)');
	define('M4J_LANG_OVERVIEW','Overview');
	define('M4J_LANG_UPDATE_PROCEED','& Lanjut');
	define('M4J_LANG_NEW_ITEM','Item Baru');
	define('M4J_LANG_EDIT_ITEM','Sunting Item');
	define('M4J_LANG_CATEGORY_NAME','Nama Kategori');
	define('M4J_LANG_EMAIL_ADRESS','Alamat Email');
	define('M4J_LANG_ADD_NEW_ITEM','Tambah Item baru:');
	define('M4J_LANG_YOUR_QUESTION','Pertanyaan Anda');
	define('M4J_LANG_REQUIRED_LONG','Wajib?');
	define('M4J_LANG_HELP_TEXT','Tks Bantuan. Berikan petunjuk kepada user mengenai pertanyaan anda.(not essential)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Tipe Tombol:');
	define('M4J_LANG_ITEM_CHECKBOX','Checkbox.');
	define('M4J_LANG_YES_NO_MENU','Menu Ya/ Tidak.');
	define('M4J_LANG_YES_ON','Ya/On.');
	define('M4J_LANG_NO_OFF','Tidak/Off.');
	define('M4J_LANG_INIT_VALUE','Nilai Awal:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Tipe Lajur Teks:');
	define('M4J_LANG_ITEM_TEXTFIELD','Lajur Teks');
	define('M4J_LANG_ITEM_TEXTAREA','Bidang Teks');
	define('M4J_LANG_MAXCHARS_LONG','Maks. Karater:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Penataan Visual:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Lebar dalam Pixel</b> <br/>(Add \'%\' untuk persentase. Kosong = Automatis Menyesuaikan)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Jumlah baris yang tampak:</b><br/> (Hanya untuk Bidang Teks)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Menu</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Radiobuttons</b>');
	define('M4J_LANG_LIST_SINGLE','<b>List</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(single choice)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Checkbox Group</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Daftar</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(pilihan ganda, dengan \'CTRL\' & tombol kiri mouse)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Pilihan Tunggal (Hanya dapat memilih satu item):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Pilihan Ganda (Dapat memilih lebih dari satu Item):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Tipe Pilihan:');
	define('M4J_LANG_ROWS_LIST','<b>Jumlah baris yang tampak:</b><br/> (HAnya untuk Daftar)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Perletakan: </b> <br/>(Hanya untuk Grup Radiobutton dan Checkbox)<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Tentukan jawaban2.<br/>Lajur2 kosong akan diabaikan.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Teks Intro. Hanya akan ditampilkan di situs2 kategori.');
	define('M4J_LANG_TITLE','Title');
	define('M4J_LANG_ERROR_NO_TITLE','Masukkan judul.');
	define('M4J_LANG_USE_HELP','Teks Bantuan untuk baloontips frontend');
	define('M4J_LANG_TITLE_FORM','Judul Form');
	define('M4J_LANG_INTROTEXT','Teks Intro');
	define('M4J_LANG_MAINTEXT','Teks Utama');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Teks Intor Email. (Hanya ditampilkan di email2.)');
	define('M4J_LANG_TEMPLATE','Templat');
	define('M4J_LANG_LINK_TO_MENU','Tautan ke Menu');
	define('M4J_LANG_LINK_CAT_TO_MENU','Tautan kategori ini ke menu');
	define('M4J_LANG_LINK_TO_CAT','Tautan Kategori: ');
	define('M4J_LANG_LINK_TO_FORM','Tautan Form: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Tautan untuk menampilkan semua Form2 tanpa kategori ');
	define('M4J_LANG_LINK_TO_ALL_CAT','TAutan ke tampilan \'Semua Kategori\'');
	define('M4J_LANG_CHOOSE_MENU','Pilih menu untuk tautan ke: ');
	define('M4J_LANG_MENU','Menu: ');
	define('M4J_LANG_NO_LINK_NAME','Masukkan nama tautan.');
	define('M4J_LANG_PUBLISHED','Publik:');
	define('M4J_LANG_PARENT_LINK','Tautan Induk');
	define('M4J_LANG_LINK_NAME','Nama Tautan');
	define('M4J_LANG_ACCESS_LEVEL','Level Akses:');
	define('M4J_LANG_EDIT_MAIN_DATA','Sunting Data Dasar');
	define('M4J_LANG_LEGEND','Legenda');
	define('M4J_LANG_LINK','Tautan');
	define('M4J_LANG_IS_VISIBLE',' publik');
	define('M4J_LANG_IS_HIDDEN',' non-publik');
	define('M4J_LANG_FORM','Form');
	define('M4J_LANG_ITEM','Item');
	define('M4J_LANG_IS_REQUIRED','Wajib');
	define('M4J_LANG_IS_NOT_REQUIRED','Tidak Wajib');
	define('M4J_LANG_ASSIGN_ORDER','Urutan');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Pengurutan tidak dimungkinkan untuk  \'Semua Form\' !<br/>');
	define('M4J_LANG_EDIT_FORM','Sunting Form');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Publik! Klik= Non-publik');
	define('M4J_LANG_HOVER_ACTIVE_OFF','Nonpublik! Klik= Publik');
	define('M4J_LANG_HOVER_REQUIRED_ON','Wajib! Klik= Tidak Wajib');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Tidak Wajib! Klik= Wajib');
	define('M4J_LANG_DESCRIPTION','Deskripsi');
	define('M4J_LANG_AREA','Bidang');
	define('M4J_LANG_ADJUSTMENT','Konfigurasi');
	define('M4J_LANG_VALUE','Nilai');
	define('M4J_LANG_MAIN_CONFIG','Konfigurasi Utama:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Anda dapat mengkonfigurasikan semua seting di sini. Klik Reset bila ingin mereset semua setting2 utama (termasuk CSS) ke default.');
	define('M4J_LANG_CSS_CONFIG','Seting CSS:');
	define('M4J_LANG_CSS_CONFIG_DESC','Seting2 ini diperlukan untuk tampilan visual pada frontend. Bila anda tidak berpengalaman dengan memasukkan CSS eksternal (sendiri), jangan merubah nilai2 ini !');
	define('M4J_LANG_RESET','Reset');

	define('M4J_LANG_EMAIL_ROOT', 'Alamat Email Utama: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Maksimum Jawaban <br/> Tentukan Pilihan: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Lebar Tampilan: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Tinggi Tampilan: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Waktu Tampilan Captcha (dalam mnt): ' );
	define('M4J_LANG_HELP_ICON', 'Ikon Bantu: ' );
	define('M4J_LANG_HTML_MAIL', 'Email HTML: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Tampilkan Legenda: ' );

	define('M4J_LANG_EMAIL_ROOT_DESC', 'Amalam email utama digunakan bila kategori maupun form tidak menentukan alamat email.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Nilai ini membatasi jumlah maksimum jawaban untuk sebuah item \'Pilihan Tertentu\'. Nilai ini harus numerik.' );
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Lebar tampilan templat. Nilai ini hanya digunakan bila anda tidak menetapkan lebar tampilan pada data dasar dari sebuah templat.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Tinggi tampilan templat. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Milik frontend. Nilai ini menentukan waktu maksimum validitas captcha. Bila nilai ini terlampaui, sebuah kode captcha baru harus dimasukkan walaupun kode sebelumya valid.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Tentukan warna ikon bantu.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Bila anda menginginkan menerima email2 HTML pilih ya. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Bila anda ingin menampilkan sebuah legenda di backend pilih ya.' );

	define('M4J_LANG_CLASS_HEADING', 'Headline Utama:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Teks Header' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Daftar- Wrap ' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Daftar- Headline' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Daftar- Teks Intro ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Form- Wrap ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Form- Tabel ' );
	define('M4J_LANG_CLASS_ERROR', 'Teks Eror' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Wrap Tombol Kirim' );
	define('M4J_LANG_CLASS_SUBMIT', 'Tombol Kirim ' );
	define('M4J_LANG_CLASS_REQUIRED', 'Wajib * css ' );

	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Headline dari sebuah situs ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Konten setelah headline. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap dari daftar item.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Headline dari daftar item. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Teks Intro dari daftar item. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap dari bidang form. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Tabel dimana semua item form diotampilkan.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - CSS class dari pesan2 kesalahan. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap dari tombol kirim ' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - CSS class dari tombol kirim. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - CSS class dari \' <b>*</b> \' karakter untuk mendeklarasikan lajur2 wajib.' );

	define('M4J_LANG_INFO_HELP','Info dan Bantu');

	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Tehnik Captcha: ' );
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Biasa');

	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','Konfigurasi berhasil direset.');
		define('M4J_LANG_CONFIG_SAVED','Konfigurasi berhasil disimpan.');
		define('M4J_LANG_CAPTCHA_DESC', ' Dimungkinkan terjadi masalah pada css-captcha-standar dan beberapa server atau template. Untuk kasus ini anda memiliki alternatif untuk memilih antara css-captcha-standar dan captcha biasa. Bila captcha biasa tidak menyelesaikan masalah, maka pilih Spesial' );
		define('M4J_LANG_SPECIAL','Spesial');


	define('M4J_LANG_MAIL_ISO','Mail Charset');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Lampiran';
	define('M4J_LANG_ATTACHMENT','Lampiran File');
	define('M4J_LANG_ATTACHMENT_DESC','User dapat mengirim file memalui form.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Masukkan parameter2 untuk lajur transfer file ini:');
	define('M4J_LANG_ALLOWED_ENDINGS','Ekstensi2 file yang disetujui.');
	define('M4J_LANG_MAXSIZE','Ukuran File Maksimum.');
	define('M4J_LANG_BYTE','Byte');
	define('M4J_LANG_KILOBYTE','Kilobyte');
	define('M4J_LANG_MEGABYTE','Megabyte');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Masukkan semua ekstensi file tanpa titik (.) dan pisahkan dengan <b>kom</b>. Bila lajur anda kosongkan, maka semua ekstensi atau ukuran file akan disetujui. Untuk memudahkan, anda dapat memilih dari ekstensi2 dibawah yang secara otomatis akan dimasukkan.');
	define('M4J_LANG_IMAGES','Gambar');
	define('M4J_LANG_DOCS','Dokumen');
	define('M4J_LANG_AUDIO','Audio');
	define('M4J_LANG_VIDEO','Video');
    define('M4J_LANG_DATA','Data');
	define('M4J_LANG_COMPRESSED','Kompresi');
	define('M4J_LANG_OTHERS','Lain2');
	define('M4J_LANG_ALL','Semua');

	// New to Version 1.1.9
	define('M4J_LANG_FROM_NAME','Dari Nama');
	define('M4J_LANG_FROM_EMAIL','Dari Email');
	define('M4J_LANG_FROM_NAME_DESC','Masukkan sebua nama dari untuk email2 yang hendak anda capai<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','Masukkan sebuah nama dari alamat email untuk email2 yang hendak anda capai.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Perhatian! Semua form yang mengandung templat ini juga akan dihapus!');
	

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