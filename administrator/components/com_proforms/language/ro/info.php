<?PHP 
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
	
	/**  ENGLISH VERSION. NEEDS TO BE TRANSLATED */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' ); 
?>


<table width="<?PHP echo  M4J_WORKAREA-36 ; ?>px" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="300px" height="309" align="center" valign="top"><img src="components/com_proforms/images/proforms-image.jpg" width="253" height="309"></td>
        <td align="left" valign="top"><h3>Mooj Proforms Basic V <?PHP echo M4J_VERSION_NO; ?> | Build: <?PHP echo M4J_BUILD; ?> </h3>
		Aceasta componenta a fost creata de catre Dipl Informatiker(similar Msc) Fahrettin Kutyol pentru Mad4Media<br>
		Mad4Media dezvolta software sub aspectul designului orientat catre utilizator. Produsele si proiectele noastre sunt orientate catre utilizator pentru atingerea maximului de ergonomicitate- usabilitate. In afara de codare in Java si PHP oferim dezvoltare de extensii individuale pentru Joomla sau osCommerce pentru clientii nostri. Daca sunteti interesati de oferta noastra, puteti ajunge la noi prin pagina noastra: <a href="http://www.mad4media.de" target="_blank">Mad4Media</a><br>
          <br>
          <strong>Licenta si Garantii</strong><br>
		  Mooj Proforms Basic este publicata sub licenta GNU GPL. Nu este nicio garantie a functionalitatii sau gradului de completare. Mad4Media nu isi asuma nicio responsabilitate pentru erorile cauzate de aceasta componenta.<br>
          <br>
          <strong>Compononente open source implementate:</strong><br>
          <a href="http://www.dynarch.com/projects/calendar/" target="_blank">jsCalendar</a> - LGPL<br>
          Icons from <a href="http://www.dryicons.com" target="_blank">dryicons.com</a> - Licenta Creative Commons Attribution 3.0<br>
          
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
                <td width="100%" height="100%" align="left" valign="top"><h3>Mooj Home</h3>
                  <p>In continuare veti gasi informatii explicite pe pagina Mad4Media.
                    <br />
					Apreciem traducerile. Puteti downloada fisiere de traducere separate de la adresa urmatoare. 
                    Trimiteti-ne traducerile voastre. Noi le vom atasa la pachetul de componente si le vom face publice<br />
                    Puteti sa ajungeti la pagina de proiect la adresa: <a href="http://www.mooj.org" target="_blank">www.mooj.org
                  </a></p>
                  <p>Translatorii vor primi un back link (ca si mai jos) catre pagina lor<br />
                  <h3>Translations</h3>
                    English, German by <a href="www.mad4media.de" target="_blank">mad4media</a><br />
                    Frontend Portuguese by 
                    <a href="mailto:tecnicoisaias@yahoo.com.br">Isaias Santana
                    </a><br />  
                    <br />
                </td>
              </tr>
              </table>			<h3>&nbsp;</h3></td>
            <td width="52%" align="left" valign="top"><h3>Ghidul de start <br />
            </h3>
              <p><strong>Pasul 1:</strong><br />
                Ai nevoie de o categorie? <br />
                De exemplu, daca vrei sa publici cateva oferte de munca, este recomandabil sa creezi o categorie &quot;jobs&quot;. Dupa introducerea unei categorii poti sa adaugi continut care va fi afisat in antetul paginii de categorii. Daca un formular nu detine o adresa email de destinatie, adresa categoriei va fi utilizata in schimb. Daca nu ai o adresa de email asociata acestei categorii, atunci adresa de mail principala de la configuratie va fi folosita. 
                <br />
                <br />
                <strong>Pasul 2:</strong><br />
              Utilizarea uneia sau mai multor sabloane.<br />
			  Se poate introduce o descriere scurta a zonei de data de baza. Aceasta este pentru recunoasterea in interiorul sablonului. Este importand sa se specifice inaltimea si latimea coloanelor tabelelor formularelor. In pasul urmator ai nevoie sa specifici campurile formularelor. Poti sa continui cu adaugarea de text de ajutor pentru campurile ce vor fi afisate in fronted, la navigarea in frontend cu mouse-ul deasupra elementului.<br />
              <br />
                <strong>Pasul 3</strong><br />
                Specificarea formularelor.<br />
                Introdu un titlu si acorda-i o categorie. Daca nu vrei sa ii acorzi o categorie, alege &quot;fara categorie&quot;
				<br />
                Apoi, trebuie sa acorzi o categorie. daca nu asociezi o adresa de email de destinatie, emailurile vor fi trimise la adresa destinatie a categoriei. Daca nu este definita adresa de email de destinatie a categoriilor, adresa principala de email va fi folosita in schimb.
                <br />
				Sub &quot;captcha&quot; poti alege daca vrei sa utilizezi niste setari de securitate pentru a evita spamming de bots.
                <br />
				Un text intro va fi aratat doar la listarea categoriilor
			    <br />
				Textul principal va fi vizibil doar pe paginile de formular
			   <br />
				Textul Intro este un indiciu pentru tine. Este vizibil doar la emailurile de raspuns.
			   Email introtext is a hint for yourself. It's only visible at response emails.
              </p>
            </td>
          </tr>
      </table>      
      <p>&nbsp;</p></td>
  </tr>
</table>

