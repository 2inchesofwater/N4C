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
          This component were build by  Dipl. Informatiker (similar to MSc) Fahrettin Kutyol for Mad4Media.<br>
          Mad4Media develops software under the aspects of the User Centered Design. Our products and projects are designed user-oriented to achieve a maximum of ergonomics (usability). Besides coding in Java and PHP we offer individual extension development for Joomla or osCommerce to our custommers. If you are interested in our services, you can get through to us by our Homepage: <a href="http://www.mad4media.de" target="_blank">Mad4Media</a><br>
          <br>
          <strong>License and Guarantee</strong><br>
          Mooj Proforms Basic is published under the GNU GPL license. There is no guarantee to functionality or completeness.  Mad4Media doesn't assume liability for damages caused by this component..<br>
          <br>
          <strong>Implemented Open Source Components:</strong><br>
          <a href="http://www.dynarch.com/projects/calendar/" target="_blank">jsCalendar</a> - LGPL<br>
          Icons from <a href="http://www.dryicons.com" target="_blank">dryicons.com</a> - Creative Commons Attribution 3.0 License<br>
          
          <br>
          <br></td>
      </tr>
    </table>
	
	    <table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td width="50%" align="left" valign="top"><h3>Upgrade to PRO!</h3>
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
                  <p>Hereafter you will get explicite information at mad4media home.
                    <br />
                    We appreciate translations. You can  download the seperated languagefiles on 
                    the following address. Send us your translations. We will attach them to the component package and make them public.<br />
                    You can get to the project page through: <a href="http://www.mooj.org" target="_blank">www.mooj.org
                  </a></p>
                  <p>Translators will get a backlink (like beneath) to their homepage. <br />
                  <h3>Translations</h3>
                    English, German by <a href="www.mad4media.de" target="_blank">mad4media</a><br />
                    Frontend Portuguese by <a href="mailto:tecnicoisaias@yahoo.com.br">Isaias Santana</a><br />  
					Spanish by <a href="http://www.virtualizza.es">Virtualizza</a><br />
					Frontend Finish	by  <a href="www.aktiivi.com">Niko Kotiniemi</a><br />		
					Frontend Greek by  <a href="www.fngnet.gr">George Nikoloudis</a><br />	
					Frontend Norwegian by  <a href="http://www.mobbingiskolen.no">Mobbing I skolen</a><br />
					Frontend Croatian by  <a href="www.kk-fsv.hr">Damir</a><br />
					Frontend Catalan by  <a href="http://www.jordiborras.cat">Jordi Borràs i Vivó</a><br />
					Frontend Polish by  <a href="http://www.e-wolomin.pl">Przemyslaw Dmochowski</a><br />
					Frontend Swedish by  <a href="www.isajoh.se">Magnus Andersson</a><br />
					Frontend Danish by  <a href="www.saft-computer.dk">Kristen Thiesen</a><br />
                    <br />
                </td>
              </tr>
              </table>			<h3>&nbsp;</h3></td>
            <td width="52%" align="left" valign="top"><h3>Getting Started Guide <br />
            </h3>
              <p><strong>1.Step:</strong><br />
                Do you need a category? <br />
                E.g. if you want to publish several job offers, it is advisable to create a category named &quot;jobs&quot;. As applying a category you can add content which will be displayed at the head of a category page. If a form doesn't own a destination email address, the address of the category will be used instead. If you don't apply a destination email address to a category, the main email address (configuration) will be used instead. 
                <br />
                <br />
                <strong>2. Step:</strong><br />
              Applying one or more template(s).<br />
              You can enter a short description at the basic data area. This is for recognition of the template. It is important to apply width and height of the form table columns. In the next step you need to apply formfields. You can append helptext to fields wich will be displayed at the frontend by a mouseover. <br />
              <br />
                <strong>3.Step</strong><br />
                Applying of forms.<br />
                Insert a title and assign a category. If you don't want to assign a category choose &quot;Without category&quot;.<br />
                At next you must assign a template. If you don't append a destination email address, mails will be sent to the categories destination address. If there is no categories destination email address, the main address will be used instead.
                <br />
                Under &quot;captcha&quot; you can choose whether you wan't to use a security check to avoid bot spamming. <br />
                A introtext will only be shown at category listings. <br />
                The main text will only be shown at form pages<br />
                Email introtext is a hint for yourself. It's only visible at response emails.
                </p>
            </td>
          </tr>
      </table>      
      <p>&nbsp;</p></td>
  </tr>
</table>

