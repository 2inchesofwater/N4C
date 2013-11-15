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
	/**  FRENCH VERSION BY KEO - 2009-07-31 - keo.one@gmail.com */
defined( '_JEXEC' ) or die( 'L&apos;acc&egrave;s direct &agrave; cette partie du site est interdit.' );

	$m4j_lang_elements[1]= 'Case &agrave; cocher';
	$m4j_lang_elements[2]= 'S&eacute;lection Oui/Non';
	$m4j_lang_elements[10]= 'Date';
	$m4j_lang_elements[20]= 'Champ de texte simple';
	$m4j_lang_elements[21]= 'Zone de texte (multi-lignes)';
	$m4j_lang_elements[30]= 'Boutons radio (choix unique)';
	$m4j_lang_elements[31]= 'Liste d&eacute;roulante (choix unique)';
	$m4j_lang_elements[32]= 'Boutons Radio (choix unique)';
	$m4j_lang_elements[33]= 'Ensemble de cases a cocher (choix multiple)';
	$m4j_lang_elements[34]= 'Liste de choix (choix multiple)';

	define('M4J_LANG_FORMS','Formulaires');
	define('M4J_LANG_TEMPLATES','Mod&egrave;les');
	define('M4J_LANG_CATEGORY','Cat&eacute;gories');
	define('M4J_LANG_CONFIG','Configuration');
	define('M4J_LANG_HELP','Info & Aide');
	define('M4J_LANG_CANCEL','Annuler');
	define('M4J_LANG_PROCEED','Continuer');
	define('M4J_LANG_SAVE','Enregistrer');
	define('M4J_LANG_NEW_FORM','Nouveau formulaire');
	define('M4J_LANG_NEW_TEMPLATE','Nouveau mod&egrave;le');
	define('M4J_LANG_ADD','Ajouter');
	define('M4J_LANG_EDIT_NAME','&Eacute;diter le nom et la description de ce mod&egrave;le');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Nouveau mod&egrave;le');
	define('M4J_LANG_TEMPLATE_NAME','Nom du mod&egrave;le');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','&Eacute;diter le nom de ce mod&egrave;le');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Courte description (usage interne, facultatif)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','&Eacute;diter la courte description');
	define('M4J_LANG_DELETE','Supprimer');
	define('M4J_LANG_DELETE_CONFIRM','Voulez-vous vraiment supprimer cet &eacute;l&eacute;ment ?');
	define('M4J_LANG_NEW_CATEGORY','Nouvelle cat&eacute;gorie');
	define('M4J_LANG_NAME','Nom');
	define('M4J_LANG_SHORTDESCRIPTION','Courte description');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','&Eacute;l&eacute;ment');
	define('M4J_LANG_EDIT','&Eacute;diter');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','&Eacute;diter les &eacute;l&eacute;ments');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Veuillez indiquer un nom pour ce mod&egrave;le.');
	define('M4J_LANG_AT_LEAST_ONE','Cet &eacute;l&eacute;ment ne peut &ecirc;tre supprim&eacute; !<br />Au moins un &eacute;l&eacute;ment doit &ecirc;tre pr&eacute;sent.');
	
	
	define('M4J_LANG_EDIT_ELEMENT','&Eacute;diter un &eacute;l&eacute;ment du mod&egrave;le: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Veuillez ajouter un nom pour cette cat&eacute;gorie.');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Veuillez saisir une adresse email valide ou laisser vide.<br />');
	define('M4J_LANG_EMAIL','email');
	define('M4J_LANG_POSITION','Ordre');
	define('M4J_LANG_ACTIVE','Activ&eacute;');
	define('M4J_LANG_UP','Vers le haut');
	define('M4J_LANG_DOWN','Vers le bas');
	define('M4J_LANG_EDIT_CATEGORY','&Eacute;diter la cat&eacute;gorie');
	define('M4J_LANG_TEMPLATE_ELEMENTS','El&eacute;ments du mod&egrave;le: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Ins&eacute;rer un nouvel &eacute;l&eacute;ment au mod&egrave;le: ');
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Veuillez indiquer une question.');
	define('M4J_LANG_REQUIRED','Obligatoire');
	define('M4J_LANG_QUESTION','Question');
	define('M4J_LANG_TYPE','Type');
	define('M4J_LANG_YES','Oui');		
	define('M4J_LANG_NO','Non');	
	define('M4J_LANG_ALL_FORMS','Tous les formulaires');
	define('M4J_LANG_NO_CATEGORYS','Sans cat&eacute;gorie');
	define('M4J_LANG_FORMS_OF_CATEGORY','Formulaires de la cat&eacute;gorie: ');
	define('M4J_LANG_PREVIEW','Pr&eacute;visualisation');
	define('M4J_LANG_DO_COPY','Copier');		
	define('M4J_LANG_COPY','Copie');
	define('M4J_LANG_VERTICAL','Vertical');
	define('M4J_LANG_HORIZONTAL','Horizontal');
	define('M4J_LANG_EXAMPLE','Exemple');
	define('M4J_LANG_CHECKBOX','Bouton');	
	define('M4J_LANG_DATE','Date');
	define('M4J_LANG_TEXTFIELD','Champ de texte');
	define('M4J_LANG_OPTIONS','Choix pr&eacute;cis');
	define('M4J_LANG_CHECKBOX_DESC','L&apos;utilisateur doit r&eacute;pondre par &quot;Oui&quot; ou &quot;Non&quot;.');
	define('M4J_LANG_DATE_DESC','L&apos;utilisateur doit indiquer une date.');
	define('M4J_LANG_TEXTFIELD_DESC','L&apos;utilisateur doit indiquer un texte, simple ou multi-lignes.');
	define('M4J_LANG_OPTIONS_DESC','L&apos;utilisateur doit choisir une ou plusieurs r&eacute;ponses parmi celles fournies.');
	define('M4J_LANG_CLOSE_PREVIEW','Fermer la pr&eacute;visualisation');
	define('M4J_LANG_Q_WIDTH','Largeur de la colonne de la &quot;question&quot;. (gauche)');
	define('M4J_LANG_A_WIDTH','Largeur de la colonne de la &quot;r&eacute;ponse&quot;. (droite)');
	define('M4J_LANG_OVERVIEW','Vue d&apos;ensemble.');
	define('M4J_LANG_UPDATE_PROCEED','& continuer');
	define('M4J_LANG_NEW_ITEM','Nouvel &eacute;l&eacute;ment');
	define('M4J_LANG_EDIT_ITEM','&egrave;diter l&apos;&eacute;l&eacute;ment');
	define('M4J_LANG_CATEGORY_NAME','Nom de la cat&eacute;gorie');
	define('M4J_LANG_EMAIL_ADRESS','Adresse email');
	define('M4J_LANG_ADD_NEW_ITEM','Ajouter un nouvel &eacute;l&eacute;ment:');
	define('M4J_LANG_YOUR_QUESTION','Votre question');
	define('M4J_LANG_REQUIRED_LONG','L&apos;&eacute;l&eacute;ment est-il obligatoire ?');
	define('M4J_LANG_HELP_TEXT','Texte d&apos;aide, pour guider vos utilisateurs (facultatif)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Indiquer le type de bouton &agrave; utiliser:');
	define('M4J_LANG_ITEM_CHECKBOX','Case &agrave; cocher.');
	define('M4J_LANG_YES_NO_MENU','S&eacute;lection Oui/Non');
	define('M4J_LANG_YES_ON','Oui/Activ&eacute;.');
	define('M4J_LANG_NO_OFF','Non/D&eacute;sactiv&eacute;.');
	define('M4J_LANG_INIT_VALUE','Valeur initiale:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Type de champ de texte:');
	define('M4J_LANG_ITEM_TEXTFIELD','Champ de texte simple');
	define('M4J_LANG_ITEM_TEXTAREA','Zone de texte (multi-lignes)');
	define('M4J_LANG_MAXCHARS_LONG','nombre maximum de caract&egrave;res:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Alignement visuel:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Largeur en pixels</b> <br />(Ajouter \'%\' pour le pourcentage. Vide = ajustement automatique)<br /><br />');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Nombre des lignes visibles:</b><br /> (Seulement pour une zone de texte)<br /><br />');
	define('M4J_LANG_DROP_DOWN','<b>Liste d&eacute;roulante</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Bouton radio</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Menu</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(choix unique)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Groupe de cases &agrave; cocher</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Liste de choix</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(choix multiple, avec \'Ctrl\' + clic gauche)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Choix simple (un seul &eacute;l&eacute;ment peut &ecirc;tre s&eacute;lectionn&eacute;):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Choix multiple (plusieurs &eacute;l&eacute;ments peuvent &ecirc;tre s&eacute;lectionn&eacute;s):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Indiquez  ici le type de s&eacute;lection:');
	define('M4J_LANG_ROWS_LIST','<b>Nombre de lignes visibles :</b><br />(seulement pour les listes de choix)<br /><br />');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Alignement :</b> <br />(seulement pour boutons radio et groupe de cases &agrave; cocher)<br /><br />');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Indiquez ici les r&eacute;ponses possibles &agrave; votre question.<br />Les champs vides ne seront pas pris en compte.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Texte d&apos;introduction, qui sera affich&eacute; sur les listes pour d&eacute;crire la cat&eacute;gorie.');
	define('M4J_LANG_TITLE','Titre');
	define('M4J_LANG_ERROR_NO_TITLE','Veuillez indiquer un titre.');
	define('M4J_LANG_USE_HELP','Afficher le(s) texte(s) d&apos;aide sur le site');
	define('M4J_LANG_TITLE_FORM','Titre du formulaire');
	define('M4J_LANG_INTROTEXT','Texte d\'introduction');
	define('M4J_LANG_MAINTEXT','Texte principal');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Texte d&apos;introduction pour l&apos;email (uniquement affich&eacute; dans l&apos;email qui vous est envoy&eacute;.)');
	define('M4J_LANG_TEMPLATE','Mod&egrave;le');
	define('M4J_LANG_LINK_TO_MENU','Lien vers le menu');
	define('M4J_LANG_LINK_CAT_TO_MENU','Lier la cat&eacute;gorie actuelle au menu');
	define('M4J_LANG_LINK_TO_CAT','Lien vers la cat&eacute;gorie: ');
	define('M4J_LANG_LINK_TO_FORM','Lien vers le formulaire: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Lien pour afficher tous les formulaires sans cat&eacute;gorie');
	define('M4J_LANG_LINK_TO_ALL_CAT','Lien pour afficher toutes les cat&eacute;gories');
	define('M4J_LANG_CHOOSE_MENU','Choisir &agrave; quel menu attribuer le lien: ');
	define('M4J_LANG_MENU','Menu: ');
	define('M4J_LANG_NO_LINK_NAME','Veuillez donnez un nom au lien.');
	define('M4J_LANG_PUBLISHED','Publi&eacute;:');
	define('M4J_LANG_PARENT_LINK','Lien parent');
	define('M4J_LANG_LINK_NAME','Nom du lien');
	define('M4J_LANG_ACCESS_LEVEL','Niveau d&apos;acc&egrave;s:');
	define('M4J_LANG_EDIT_MAIN_DATA','&Eacute;diter les donn&eacute;es de base');
	define('M4J_LANG_LEGEND','L&eacute;gende');
	define('M4J_LANG_LINK','Lien');
	define('M4J_LANG_IS_VISIBLE',' publi&eacute;(e)(s)');
	define('M4J_LANG_IS_HIDDEN',' non publi&eacute;(e)(s)');
	define('M4J_LANG_FORM','Formulaire');
	define('M4J_LANG_ITEM','&Eacute;l&eacute;ment');
	define('M4J_LANG_IS_REQUIRED','Obligatoire');
	define('M4J_LANG_IS_NOT_REQUIRED','Facultatif');
	define('M4J_LANG_ASSIGN_ORDER','D&eacute;finition d&apos;un ordre');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* La d&eacute;finition d&apos;un ordre n&apos;est pas possible pour &laquo;Tous les formulaires&raquo; !<br />');
	define('M4J_LANG_EDIT_FORM','&Eacute;diter le formulaire');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','Publi&eacute;! Clic=d&eacute;publier');
	define('M4J_LANG_HOVER_ACTIVE_OFF','D&eacute;publi&eacute;! Clic=publier');
	define('M4J_LANG_HOVER_REQUIRED_ON','Requis! Click= pas Requis');
	define('M4J_LANG_HOVER_REQUIRED_OFF','Pas Requis! Click= Requis');
	define('M4J_LANG_DESCRIPTION','Description');
	define('M4J_LANG_AREA','R&eacute;gion');
	define('M4J_LANG_ADJUSTMENT','Configuration');
	define('M4J_LANG_VALUE','Valeur');
	define('M4J_LANG_MAIN_CONFIG','Configuration principale:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Vous pouvez configurer tous les param&egrave;tres principaux ici. Cliquez sur &laquo;R&eacute;initialiser&raquo; pour retourner aux valeurs par d&eacute;faut (CSS inclus).');
	define('M4J_LANG_CSS_CONFIG','Param&egrave;tres CSS:');
	define('M4J_LANG_CSS_CONFIG_DESC','Ces param&egrave;tres sont n&eacute;cessaires &agrave; la pr&eacute;sentation visuelle du site. Si vous n&apos;avez aucune exp&eacute;rience en mati&egrave;re de CSS externe, ne modifiez pas ces valeurs !!!');
	define('M4J_LANG_RESET','R&eacute;initialiser');
			
	define('M4J_LANG_EMAIL_ROOT', 'Adresse email principale: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Nombre maximum de r&eacute;ponses' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Largeur de la pr&eacute;visualisation: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Hauteur de la pr&eacute;visualisation: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'Dur&eacute;e du Captcha (en min): ' );
	define('M4J_LANG_HELP_ICON', 'Ic&ocirc;ne de l&apos;aide: ' );
	define('M4J_LANG_HTML_MAIL', 'Email en HTML: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Afficher la l&eacute;gende: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'L&apos;adresse email principale sera utilis&eacute;e si ni la cat&eacute;gorie ni le formulaire n&apos;en ont d&apos;attribu&eacute;e.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Cette valeur limite le nombre maximum de r&eacute;ponses pour un &eacute;l&eacute;ment &laquo;Choix pr&eacute;cis&raquo;. Cette valeur doit &ecirc;tre num&eacute;rique.' );
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Largeur du mod&egrave;le de pr&eacute;visualisation. Cette valeur n&apos;est utilis&eacute;e que si vous n&apos;attribuez pas de largeur &agrave; la pr&eacute;visualisation dans les donn&eacute;es de base du mod&egrave;le.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Hauteur du mod&egrave;le de pr&eacute;visualisation. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Concerne l&apos;interface du site. Cette valeur affecte la dur&eacute;e maximale de validit&eacute; du captcha. Si cette dur&eacute;e expire, un nouveau code de captcha devra &ecirc;tre indiqu&eacute;, m&ecirc;me si l&apos;ancien code &eacute;tait correct.' );
	define('M4J_LANG_HELP_ICON_DESC', 'D&eacute;finit la couleur de l&apos;ic&ocirc;ne de l&apos;aide.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Pour recevoir des email au format HTML. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Pour afficher la l&eacute;gende dans l&apos;administration.' );
	
	define('M4J_LANG_CLASS_HEADING', 'En-t&ecirc;te principale:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Texte de l&apos;en-t&ecirc;te' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Liste - conteneur' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Liste - en-t&ecirc;te' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Liste - texte d&apos;introduction ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Formulaire - conteneur ' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Formulaire - tableau ' );
	define('M4J_LANG_CLASS_ERROR', 'Texte d&apos;erreur ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Bouton d&apos;envoi - conteneur ' );
	define('M4J_LANG_CLASS_SUBMIT', 'Bouton d&apos;envoi ' );
	define('M4J_LANG_CLASS_REQUIRED', 'Champ obligatoire (*)' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> -	En-t&ecirc;te d&apos;un site ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Descriptpion apr&egrave;s l&apos;en-t&ecirc;te. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Conteneur d&apos;un &eacute;leacute;ment de liste.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - En-t&ecirc;te d&apos;un &eacute;leacute;ment de liste. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Texte d&apos;introduction d&apos;un &eacute;leacute;ment de liste. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Conteneur d&apos;un formulaire. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Tableau ou les &eacute:leacute;ments du formulaire seront affich&eacute;s.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - Classe CSS des messages d&apos;erreurs. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Conteneur du bouton d&apos;envoi ' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - Classe CSS du bouton d&apos;envoi. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - Classe CSS du caract&egrave;re &laquo;<b>*</b>&raquo; qui d&eacute;signe les champs obligatoires.' );
	
	define('M4J_LANG_INFO_HELP','Info et Aide');

// New to Version 1.1.5
 define('M4J_LANG_CHOOSE_CAPTCHA', 'Technique Captcha: ' ); 

 define('M4J_LANG_CSS','CSS');
 define('M4J_LANG_SIMPLE','Ordinaire');

	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','La configuration a &eacute;t&eacute; r&eacute;initialis&eacute;e.');
		define('M4J_LANG_CONFIG_SAVED','La configuration a &eacute;t&eacute; enregistr&eacute;e.');
 		define('M4J_LANG_CAPTCHA_DESC', ' Il peut y avoir quelques probl&egrave;mes avec le captcha CSS standard et avec certains serveurs ou mod&egrave;les. Dans ce cas vous avez le choix entre le captcha CSS standard et un captcha ordinaire. Si vous avez encore des probl&egrave;mes, utilisez &laquo;Sp&eacute;cial&raquo;' );
		define('M4J_LANG_SPECIAL','Sp&eacute;cial');

	define('M4J_LANG_MAIL_ISO','Jeu de caract&egrave;res de l&apos;email');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');

// New to Version 1.1.8
	 $m4j_lang_elements[40]= 'Pi&egrave;ce jointe'; 
	 define('M4J_LANG_ATTACHMENT','Pi&egrave;ce jointe');
	 define('M4J_LANG_ATTACHMENT_DESC','L&apos;utilisateur peut envoyer un fichier via le formulaire.');
	 define('M4J_LANG_TYPE_OF_ATTACHMENT','Entrez les param&egrave;tres pour le champ de transfert de fichiers:');
	 define('M4J_LANG_ALLOWED_ENDINGS','Extensions de fichiers autoris&eacute;es.');
	 define('M4J_LANG_MAXSIZE','Taille de fichier maximum.');
	 define('M4J_LANG_BYTE','Octet (byte)');
	 define('M4J_LANG_KILOBYTE','Kilo-octets (kilobyte)');
	 define('M4J_LANG_MEGABYTE','Mega-octets (megabyte)');
	 define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Si vous laissez ces champs vides, toutes les extensions de fichiers seront accept&eacute;es ou toute taille sera approuv&eacute;e,
                                                ce qui pose un important probl&egrave;me de s&eacute;curit&eacuute;.
                                                Veuillez saisir les extensions de fichiers authoris&eacute;es, sans le point et s&eacute;par&eacute;es par des <b>virgules</b>;
                                                vous pouvez aussi les choisir ci-dessous, elles seront automatiquement ajout&eacute;es.');
	 define('M4J_LANG_IMAGES','Images');
	 define('M4J_LANG_DOCS','Documents');
	 define('M4J_LANG_AUDIO','Audio');
	 define('M4J_LANG_VIDEO','Video');            
	 define('M4J_LANG_DATA','Donn&eacute;es');
	 define('M4J_LANG_COMPRESSED','Archive compr&eacute;ss&eacute;e');
	 define('M4J_LANG_OTHERS','Autres');
	 define('M4J_LANG_ALL','Tout');
	
	// New to Version 1.1.9
	 define('M4J_LANG_FROM_NAME','Nom de l&apos;exp&eacute;diteur');
	 define('M4J_LANG_FROM_EMAIL','Email de l&apos;exp&eacute;diteur');
	 define('M4J_LANG_FROM_NAME_DESC','Ins&eacute;rez un nom d&apos;exp&eacute;diteur pour les emails cr&eacute;&eacute;s<br />');
	 define('M4J_LANG_FROM_EMAIL_DESC','Ins&eacute;rez une adresse d&apos;exp&eacute;diteur pour les emails cr&eacute;&eacute;s<br />');
	 define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Attention! Tous les formulaires qui contiennent ce mod&egrave;le seront &eacute;galement supprim&eacute;s!');
	

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
