<?PHP 
	/**
	* @version $Id: Mooj 10041 2008-03-18 21:48:13Z fahrettinkutyol $
	* @package joomla
	* @copyright Copyright (C) 2008 Mad4Media. Все права защищены.
	* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, см. LICENSE.php
	* Joomla! является бесплатным программным обеспечением. Эта версия может быть модифицирована согласно
	* с GNU General Public License, и, являясь распространяемой, она включает или
	* является производной работ под лицензией GNU General Public License или
	* других свободных лицензий или лицензий программного обеспечения с открытым кодом.
	* См. COPYRIGHT.php с уведомлением об авторских правах и подробностями.
	* @copyright (C) mad4media , www.mad4media.de
	*/

	/**  РУССКАЯ ВЕРСИЯ. ПЕРЕВОД www.biznetman.biz */

defined( '_JEXEC' ) or die( 'Прямой доступ к этому расположению не разрешен.' ); 
?>


<table width="<?PHP echo  M4J_WORKAREA-36 ; ?>px" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="300px" height="309" align="center" valign="top"><img src="components/com_proforms/images/proforms-image.jpg" width="253" height="309"></td>
        <td align="left" valign="top"><h3>Mooj Proforms Basic V <?PHP echo M4J_VERSION_NO; ?> | Build: <?PHP echo M4J_BUILD; ?> </h3>
          Этот компонент был раработан Dipl. Informatiker (подобный MSc) Fahrettin Kutyol для Mad4Media.<br>
          Mad4Media разрабатывает програмное обеспечение в соответствии с подходами User Centered Design. Наши продукты и проекты ориентированны на пользователя для достижения максимальной аргономичности (юзабилити). Кроме того, программируя на Java и PHP мы предлагаем индивидуальную разработку расширений для Joomla и osCommerce для наших покупателей. Если Вы заинтересовались нашими услугами, Вы можете соединитсься с нами через Нашу домашнюю страницу: <a href="http://www.mad4media.de" target="_blank">Mad4Media</a><br>
          <br>
          <strong>Лицензия и Гарантии</strong><br>
          Mooj Proforms Basic распостраняняется по лицензии GNU GPL. Нет гарантий по функциональности или завершенности.  Mad4Media не берет на себя ответственность за  возможный ущерб вызванный этим компонентом..<br>
          <br>
          <strong>Реализация Компонентов в Открытом Коде:</strong><br>
          <a href="http://www.dynarch.com/projects/calendar/" target="_blank">jsCalendar</a> - LGPL<br>
          Icons from <a href="http://www.dryicons.com" target="_blank">dryicons.com</a> - Creative Commons Attribution 3.0 License<br>
          
          <br>
          <br></td>
      </tr>
    </table>
	
	    <table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td width="50%" align="left" valign="top">
			<h3>Upgrade to PRO!</h3>
		      <a href="http://www.mad4software.com/packages/proforms.html" target="_blank">
				<img src="components/com_proforms/images/buy-proforms.png" >
			</a>
			<ul>
				<li>No Copyrightlink!</li>
				<li>Many additional functions</li>
				<li>Modules und plugins</li>
				<li>Database storage und backups</li>
				<li>Multilinguality</li>
				<li>Support</li>
				<li>Manuals via the Helpdesk</li>
				<li>Just install it over the Basic version and all forms will remain.</li>
				
			</ul>
			<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100%" height="100%" align="left" valign="top"><h3>Mooj Домашняя</h3>
                  <p>Ниже Вы получите подробную информацию на домашней странице mad4media.
                    <br />
                    Мы ценим переводы. Вы можете загрузить отдельные языковые файлы по 
                    следующему адресу. Присылайте нам Ваши переводы. Мы присоединим их к пакету компонента и сделаем общедоступными.<br />
                    Вы можете попасть на страницу проекта по ссылке: <a href="http://www.mooj.org" target="_blank">www.mooj.org
                  </a></p>
                  <p>Переводы получат обратную ссылку (как внизу) на их домашнюю страницу. <br />
                  <h3>Переводы</h3>
                    Русский от <a href="www.biznetman.biz" target="_blank">Biznetman.biz</a><br />
                    Английский, Немецкий от <a href="www.mad4media.de" target="_blank">mad4media</a><br />
                    Клиентская часть на Португальском от 
                    <a href="mailto:tecnicoisaias@yahoo.com.br">Isaias Santana
                    </a><br />  
                    <br />
                </td>
              </tr>
              </table>			<h3>&nbsp;</h3></td>
            <td width="52%" align="left" valign="top"><h3>Начало работы <br />
            </h3>
              <p><strong>Шаг 1:</strong><br />
                Вам нужна категория? <br />
                Например, если Вы хотите опубликовать несколько предложений о работе, рекомендуется создать категорию под названием &quot;вакансии&quot;. Используя категорию, Вы можете добавить контент, который будет отображен в заголовке страницы категории. Если форме не присвоен email-адрес назначения, вместо него будет использован адрес категории. Если Вы не предлагаете категории email-адрес назначения, вместо него будет использован главный email-адрес (указанный в конфигурации). 
                <br />
                <br />
                <strong>Шаг 2:</strong><br />
              Использование одного или более шаблонов.<br />
              Вы можете ввести короткое описание в область начальных данных. Это нужно для идентификации шаблона. Важно задать ширину и высоту колонок таблицы формы. В следующем шаге Вам нужно задать поля формы. Вы можете добавить полям вспомогательный текст, который будет отображаться в клиентской части при наведении мышкой. <br />
              <br />
                <strong>Шаг 3:</strong><br />
                Работа с формами.<br />
                Вставьте заглавие и задайте категорию. Если Вы не хотите задавать категорию, выберите &quot;Без категории&quot;.<br />
                Далее Вам нужно задать шаблон. Если Вы не укажете email-адрес назначения, сообщения будут отсылаться на адреса категорий. Если в категориях нет email-адреса , вместо него будет использован главный адрес.
                <br />
                Под &quot;каптча&quot; Вы можете выбрать, использовать ли проверку безопасности, чтобы обезопаситься от спам-ботов. <br />
                Вводный текст будет отображаться только в списке категорий. <br />
                Основной текст будет отображаться только на страницах форм<br />
                Вводный текст Email-письма - это подсказка для Вас самих. Он отображается только в ответных письмах.
				</p>
            </td>
          </tr>
      </table>      
      <p>&nbsp;</p></td>
  </tr>
</table>

