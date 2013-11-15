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

	/**  SPANISH VERSION.*/
	
	/**  TRANSLATED BY Jorge Mayor Lázaro http://www.virtualizza.es  */


	defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
	
	$m4j_lang_elements[1]= 'Checkbox';
	$m4j_lang_elements[2]= 'Selección Sí/No ';
	$m4j_lang_elements[10]= 'Fecha';
	$m4j_lang_elements[20]= 'Campo de texto';
	$m4j_lang_elements[21]= 'Area de texto';
	$m4j_lang_elements[30]= 'Menu(elección simple)';
	$m4j_lang_elements[31]= 'Menú selectivo(elección simple)';
	$m4j_lang_elements[32]= 'Botón de radio(elección simple)';
	$m4j_lang_elements[33]= 'Grupo Checkbox(elección múltiple)';
	$m4j_lang_elements[34]= 'Lista(elección múltiple)';
	
	
	define('M4J_LANG_FORMS','Formularios');
	define('M4J_LANG_TEMPLATES','Plantillas');
	define('M4J_LANG_CATEGORY','Categorías');
	define('M4J_LANG_CONFIG','Configuración');
	define('M4J_LANG_HELP','Info & Ayuda');
	define('M4J_LANG_CANCEL','Cancelar');
	define('M4J_LANG_PROCEED','Proceder');
	define('M4J_LANG_SAVE','Guardar');
	define('M4J_LANG_NEW_FORM',' Nuevo Formulario');
	define('M4J_LANG_NEW_TEMPLATE','Nueva Plantilla');
	define('M4J_LANG_ADD','Añadir');
	define('M4J_LANG_EDIT_NAME','Editar nombre y descripción de esta plantilla');
	define('M4J_LANG_NEW_TEMPLATE_LONG','Nueva plantilla');
	define('M4J_LANG_TEMPLATE_NAME','Nombre de esta plantilla');
	define('M4J_LANG_TEMPLATE_NAME_EDIT','Editar el nombre de esta plantilla');
	define('M4J_LANG_TEMPLATE_DESCRIPTION','Descripción corta(para uso interno. Se puede dejar vacía)');
	define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Editar descripción corta');
	define('M4J_LANG_DELETE','Borrar');
	define('M4J_LANG_DELETE_CONFIRM','¿Desea borrar este artículo?');
	define('M4J_LANG_NEW_CATEGORY','Nueva categoría');
	define('M4J_LANG_NAME','Nombre');
	define('M4J_LANG_SHORTDESCRIPTION','Descripción corta');
	define('M4J_LANG_ID','ID');
	define('M4J_LANG_ITEMS','Artículos');
	define('M4J_LANG_EDIT','Editar');
	define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Artículos -> Editar');
	define('M4J_LANG_TEMPLATE_NAME_REQUIRED','¡Por favor, introduzcsa un nombre para esta plantilla!');
	define('M4J_LANG_AT_LEAST_ONE','¡Este artículo no se puede borrar!<br/>Tiene que haber por lo menos un elemento.');	

	
		define('M4J_LANG_EDIT_ELEMENT','Editar elemento de plantilla: ');
	define('M4J_LANG_CATEGORY_NAME_ERROR','Por favor, inserte un nombre de categoría');
	define('M4J_LANG_NONE_LEGAL_EMAIL','Por favor, inserte un email válido o déjelo vacío.<br/>');
	define('M4J_LANG_EMAIL','Email');
	define('M4J_LANG_POSITION','Ordenación');
	define('M4J_LANG_ACTIVE','Activo');
	define('M4J_LANG_UP','Arriba');
	define('M4J_LANG_DOWN','Abajo');
	define('M4J_LANG_EDIT_CATEGORY','Editar categoría');
	define('M4J_LANG_TEMPLATE_ELEMENTS','Elementos de plantilla: ');
	define('M4J_LANG_NEW_ELEMENT_LONG','Insertar nuevo elemento de plantilla: ');	
	define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Por favor, inserte una pregunta.');
	define('M4J_LANG_REQUIRED','Obligatorio');
	define('M4J_LANG_QUESTION','Pregunta');
	define('M4J_LANG_TYPE','Tipo');
	define('M4J_LANG_YES','Sí');		
	define('M4J_LANG_NO','No');	
	define('M4J_LANG_ALL_FORMS','Todos los formularios');
	define('M4J_LANG_NO_CATEGORYS','Sin categoría');
	define('M4J_LANG_FORMS_OF_CATEGORY','Formularios de la categoría: ');
	define('M4J_LANG_PREVIEW','Previsualizar');
	define('M4J_LANG_DO_COPY','Copiar');		
	define('M4J_LANG_COPY','Copiar');
	define('M4J_LANG_VERTICAL','Vertical');
	define('M4J_LANG_HORIZONTAL','Horizontal');
	define('M4J_LANG_EXAMPLE','Ejemplo');
	define('M4J_LANG_CHECKBOX','Botón');	
	define('M4J_LANG_DATE','Fecha');
	define('M4J_LANG_TEXTFIELD','Campo de texto');
	define('M4J_LANG_OPTIONS','Elección especificada');
	define('M4J_LANG_CHECKBOX_DESC','Una pregunta Sí/No.');
	define('M4J_LANG_DATE_DESC','El usuario tiene que introducir una fecha.');
	define('M4J_LANG_TEXTFIELD_DESC','El usuario tiene que introducir un texto.');
	define('M4J_LANG_OPTIONS_DESC','El usuario selecciona una o más respuestas a parte de las referencias especificadas. ');
	define('M4J_LANG_CLOSE_PREVIEW','Cerrar previsualización');
	define('M4J_LANG_Q_WIDTH','Ancho de la columna pregunta. (izquierda)');
	define('M4J_LANG_A_WIDTH','Ancho de la columna respuesta. (derecha)');
	define('M4J_LANG_OVERVIEW','Visión general');
	define('M4J_LANG_UPDATE_PROCEED','& Proceder');
	define('M4J_LANG_NEW_ITEM','Nuevo elemento');
	define('M4J_LANG_EDIT_ITEM','Editar elemento');
	define('M4J_LANG_CATEGORY_NAME','Nombre de categoría');
	define('M4J_LANG_EMAIL_ADRESS','Email');
	define('M4J_LANG_ADD_NEW_ITEM','Añadr un nuevo elemento:');
	define('M4J_LANG_YOUR_QUESTION','Su pregunta');
	define('M4J_LANG_REQUIRED_LONG','¿Obligatorio?');
	define('M4J_LANG_HELP_TEXT','Texto de ayuda. Les da a los usuarios una pista sobre las preguntas.(no es esencial)');
	define('M4J_LANG_TYPE_OF_CHECKBOX','Tipo de botón:');
	define('M4J_LANG_ITEM_CHECKBOX','Checkbox.');
	define('M4J_LANG_YES_NO_MENU','Menú tipo Sí/NO.');
	define('M4J_LANG_YES_ON','Sí/Activo.');
	define('M4J_LANG_NO_OFF','No/Inactivo.');
	define('M4J_LANG_INIT_VALUE','Valor incial:');
	define('M4J_LANG_TYPE_OF_TEXTFIELD','Tipo de cuadro de texto:');
	define('M4J_LANG_ITEM_TEXTFIELD','Campo de texto');
	define('M4J_LANG_ITEM_TEXTAREA','Area de texto');
	define('M4J_LANG_MAXCHARS_LONG','Caracteres máximo:');
	define('M4J_LANG_OPTICAL_ALIGNMENT','Alineación:');
	define('M4J_LANG_ITEM_WIDTH_LONG','<b>Ancho en pixel</b> <br/>(Add \'%\' para porcentaje. Vacío = Ajuste automático)<br/><br/>');
	define('M4J_LANG_ROWS_TEXTAREA','<b>Cantidad de filas visibles:</b><br/> (Sólo para area de texto)<br/><br/>');
	define('M4J_LANG_DROP_DOWN','<b>Menú</b>');
	define('M4J_LANG_RADIOBUTTONS','<b>Botones de radio</b>');
	define('M4J_LANG_LIST_SINGLE','<b>Lista</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(elección simple)');
	define('M4J_LANG_CHECKBOX_GROUP','<b>Grupo de Checkbox</b>');
	define('M4J_LANG_LIST_MULTIPLE','<b>Lista</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(elección múltiple, con \'CTRL\' & botón izquierdo de ratón)');
	define('M4J_LANG_SINGLE_CHOICE_LONG','Elección simple (Sólo se puede seleccionar una opción):');
	define('M4J_LANG_MULTIPLE_CHOICE_LONG','Elección múltiple (Se pueden selecciónar varias opciones):');
	define('M4J_LANG_TYPE_OF_OPTIONS','Tipo de selección:');
	define('M4J_LANG_ROWS_LIST','<b>Cantidad de filas visibles:</b><br/> (Sólo para listas)<br/><br/>');
	define('M4J_LANG_ALIGNMENT_GROUPS','<b>Alineación: </b> <br/>(Sólo para botones de radioy grupos de Checkbox )<br/><br/>');
	define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Especificar las respuestas.<br/>Campos vacíos serán ignorados.</b>');
	define('M4J_LANG_CATEGORY_INTRO_LONG','Texto introductorio. Sólo se visualizará en páginas de categoría.');
	define('M4J_LANG_TITLE','Título');
	define('M4J_LANG_ERROR_NO_TITLE','Por favor, introduzca un título.');
	define('M4J_LANG_USE_HELP','Texto ayuda para los rótulos con consejos en la web');
	define('M4J_LANG_TITLE_FORM','Título del formulario');
	define('M4J_LANG_INTROTEXT','Texto introductorio');
	define('M4J_LANG_MAINTEXT','Texto principal');
	define('M4J_LANG_EMAIL_HIDDEN_TEXT','Texto introductorio del Email. (Sólo se visualizará en los emails.)');
	define('M4J_LANG_TEMPLATE','Plantilla');
	define('M4J_LANG_LINK_TO_MENU','Enlzar con el menú');
	define('M4J_LANG_LINK_CAT_TO_MENU','Enlazar la categoría actual con un menú');
	define('M4J_LANG_LINK_TO_CAT','Enlazar categoría: ');
	define('M4J_LANG_LINK_TO_FORM','Enlazar formulario: ');
	define('M4J_LANG_LINK_TO_NO_CAT','Enlace para visualizar todos los formularios sin una categoría ');
	define('M4J_LANG_LINK_TO_ALL_CAT','Enlace para visualizar \'Todas las categorías\'');
	define('M4J_LANG_CHOOSE_MENU','Elija un menú para enlazar con: ');
	define('M4J_LANG_MENU','Menú: ');
	define('M4J_LANG_NO_LINK_NAME','Por favor, inserte un nombre de enlace.');
	define('M4J_LANG_PUBLISHED','Publicado:');
	define('M4J_LANG_PARENT_LINK','Enlace padre');
	define('M4J_LANG_LINK_NAME','Nombre de enlace');
	define('M4J_LANG_ACCESS_LEVEL','Nivel de acceso:');
	define('M4J_LANG_EDIT_MAIN_DATA','Editar datos básicos');
	define('M4J_LANG_LEGEND','Leyenda');
	define('M4J_LANG_LINK','Enlazar');
	define('M4J_LANG_IS_VISIBLE',' es publicado');
	define('M4J_LANG_IS_HIDDEN',' no es publicado');
	define('M4J_LANG_FORM','Formulario');
	define('M4J_LANG_ITEM','Elemento');
	define('M4J_LANG_IS_REQUIRED','Obligatorio');
	define('M4J_LANG_IS_NOT_REQUIRED','No obligatorio');
	define('M4J_LANG_ASSIGN_ORDER','Ordenación');
	define('M4J_LANG_ASSIGN_ORDER_HINT','* Ordenación no es posible para  \'Todos los formularios\' !<br/>');
	define('M4J_LANG_EDIT_FORM','Editar formularios');
	define('M4J_LANG_CAPTCHA','Captcha');
	define('M4J_LANG_HOVER_ACTIVE_ON','¡Publicado! Clic=Despublicar');
	define('M4J_LANG_HOVER_ACTIVE_OFF','¡Despublicar! Clic=Publicar');
	define('M4J_LANG_HOVER_REQUIRED_ON','¡Obligatorio! Clic= No obligatorio');
	define('M4J_LANG_HOVER_REQUIRED_OFF','¡No obligatorio! Clic= Obligatorio');
	define('M4J_LANG_DESCRIPTION','Descripción');
	define('M4J_LANG_AREA','Area');
	define('M4J_LANG_ADJUSTMENT','Configuración');
	define('M4J_LANG_VALUE','Valor');
	define('M4J_LANG_MAIN_CONFIG','Configuración principal:');
	define('M4J_LANG_MAIN_CONFIG_DESC','Puede configurar todos los parámetros principales aqui. Si quiere reiniciar todos los parámetros, incluidos los CSS, y volver a los predeterminados haga clic en reiniciar.');
	define('M4J_LANG_CSS_CONFIG','Configuraciones CSS :');
	define('M4J_LANG_CSS_CONFIG_DESC','Estas configuraciones son obligatorias para una visualización de la web. ¡Si no tiene experiencia con CSS externos o propios, no modifique estos valores!');
	define('M4J_LANG_RESET','Reiniciar');
			
	define('M4J_LANG_EMAIL_ROOT', 'Email principal: ' );
	define('M4J_LANG_MAX_OPTIONS', 'Respuestas máximas <br/> Elección especificada: ' );
	define('M4J_LANG_PREVIEW_WIDTH', 'Ancho de la vista preliminar: ' );
	define('M4J_LANG_PREVIEW_HEIGHT', 'Alto de la vista preliminar: ' );
	define('M4J_LANG_CAPTCHA_DURATION', 'duarción del Captcha  (en min): ' );
	define('M4J_LANG_HELP_ICON', 'Icono de ayuda: ' );
	define('M4J_LANG_HTML_MAIL', 'HTML Email: ' );
	define('M4J_LANG_SHOW_LEGEND', 'Ver leyenda: ' );
	
	define('M4J_LANG_EMAIL_ROOT_DESC', 'El emael principal es utilizado cuando ni la categoría ni el formulario ha asignado un email.' );
	define('M4J_LANG_MAX_OPTIONS_DESC', 'Esto valor limita el número de respuestas para un campo de selección. Este valor ha de ser númerico.' );	
	define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Ancho de la vista preliminar de la plantilla. Este valor es utilizado únicamente si no asigna un ancho en los datos básicos de la plantilla.' );
	define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Alto de la visión preliminar de la plantilla. ' );
	define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Pertenece a la web. Este valor asigna la duración máxima de la validación del captcha (campo antispam). Si la duración expira ha de introducirse un nuevo valor aunque se visualice el antiguo.' );
	define('M4J_LANG_HELP_ICON_DESC', 'Definir el color del icono de ayuda.' );
	define('M4J_LANG_HTML_MAIL_DESC', 'Si desea recibir emails HTML elija Sí. ' );
	define('M4J_LANG_SHOW_LEGEND_DESC', 'Si desea visualizar una leyenda en el panel de control elija Sí.' );
	
	define('M4J_LANG_CLASS_HEADING', 'Título principal:' );
	define('M4J_LANG_CLASS_HEADER_TEXT', 'Texto de cabecera' );
	define('M4J_LANG_CLASS_LIST_WRAP', 'Listado resumen ' );
	define('M4J_LANG_CLASS_LIST_HEADING', 'Listado de título' );
	define('M4J_LANG_CLASS_LIST_INTRO', 'Listado texto intro ' );
	define('M4J_LANG_CLASS_FORM_WRAP', 'Formulario Wrap' );
	define('M4J_LANG_CLASS_FORM_TABLE', 'Formulario tabla ' );
	define('M4J_LANG_CLASS_ERROR', 'Texto de error' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Wrap de botón Enviar' );
	define('M4J_LANG_CLASS_SUBMIT', 'Botón de envío ' );
	define('M4J_LANG_CLASS_REQUIRED', 'css * obligatorio ' );
	
	define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Título de una web ' );
	define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Contenido tras el título. ' );
	define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Recapitulación de un campo tipo lista.' );
	define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Título de un campo tipo lista. ' );
	define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Texto intro de un campo tipo lista. ' );
	define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap de un area de formulario. ' );
	define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Tabla donde se visualizan todos los campos del formulario.' );
	define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - Clase CSS de mensajes de error. ' );
	define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Wrap del botón de envío ' );
	define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - Clase CSS del botón de envío. ' );
	define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - Clase CSS del  carácter \' <b>*</b> \' para definir los campos obligatorios.' );
	
	define('M4J_LANG_INFO_HELP','Info y ayuda');
	
	// New to Version 1.1.5
	define('M4J_LANG_CHOOSE_CAPTCHA', 'Técnica Captcha: ' ); 
	define('M4J_LANG_CSS','CSS');
	define('M4J_LANG_SIMPLE','Ordinario');
	
	//New To Version 1.1.7
		define('M4J_LANG_CONFIG_RESET','La configuración se reinició correctamente.');
		define('M4J_LANG_CONFIG_SAVED','La configuración se guardó correctamente.');
		define('M4J_LANG_CAPTCHA_DESC', 'Puede haber problemas con los css-captcha estándar y algunos servidores o plantillas. Para este caso tiene la opción de elegir entre los css-captcha estándar y un captcha ordinario o nomal. Si el captcha ordinario no solucionara el problema elija especial' );
		define('M4J_LANG_SPECIAL','especial');
	
	
	define('M4J_LANG_MAIL_ISO','Tipo de caracteres de envío');
	define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');		
	
	
	// New to Version 1.1.8
	$m4j_lang_elements[40]= 'Adjunto';	
	define('M4J_LANG_ATTACHMENT','Archivo adjunto');
	define('M4J_LANG_ATTACHMENT_DESC','El usuario puede transmitir un archivo a través de formulario.');
	define('M4J_LANG_TYPE_OF_ATTACHMENT','Introduzca los parámetros para este campo de transferencia de archivo:');
	define('M4J_LANG_ALLOWED_ENDINGS','Extensiones de archivo aprovadas.');
	define('M4J_LANG_MAXSIZE','Tamaño máximo de archivo.');
	define('M4J_LANG_BYTE','Byte');
	define('M4J_LANG_KILOBYTE','Kilobyte');
	define('M4J_LANG_MEGABYTE','Megabyte');
	define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Por favor, introduzca todas las extensiones de archivo sin punto y separadas por <b>comas</b>.Si deja campos en blanco todas las extensiones de archivo serán aceptadas o cualquier tamañao será aprovado. Para facilitar el trabajo puede elegir entre las extensiones de abajo que serán incluidas automáticamente.');
	define('M4J_LANG_IMAGES','Imágenes');
	define('M4J_LANG_DOCS','Documentos');
	define('M4J_LANG_AUDIO','Audio');
	define('M4J_LANG_VIDEO','Video');										   
    define('M4J_LANG_DATA','Datos');
	define('M4J_LANG_COMPRESSED','Compresión');
	define('M4J_LANG_OTHERS','Otros');
	define('M4J_LANG_ALL','Todo');
	
	// New to Version 1.1.9
	define('M4J_LANG_FROM_NAME','Desde nombre');
	define('M4J_LANG_FROM_EMAIL','Desde email');
	define('M4J_LANG_FROM_NAME_DESC','Insertar un nombre origen para los emails que va a recibir<br/>');
	define('M4J_LANG_FROM_EMAIL_DESC','Insertar un email origen para los emails que va a recibir.<br/>');
	define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' ¡Atención! Todos los formularios que contengan esta plantilla serán borrados!');
	

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