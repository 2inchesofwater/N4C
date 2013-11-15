<?php
/**
* @ΟΝΟΜΑ MOOJ Proforms
* @ΕΚΔΟΣΗ 1.0
* @ΠΑΚΕΤΟ proforms
* @ΔΙΚΑΙΩΜΑ ΔΗΜΙΟΥΡΓΟΥ (C) 2008-2010 Mad4Media. All rights reserved.
* @ΣΥΝΤΑΚΤΗΣ Dipl. Inf.(FH) Fahrettin Kutyol
* @ΜΕΤΑΦΡΑΣΗ ΣΤΑ ΕΛΛΗΝΙΚΑ Yannis Sfetkos
* @ΑΔΕΙΑ ΧΡΗΣΗΣ http://www.gnu.org/copyleft/gpl.html GNU/GPL
* ΚΑΠΟΙΑ ΑΡΧΕΙΑ Javascript ΔΕΝ ΕΧΟΥΝ ΑΔΕΙΑ ΤΗΣ GNU/GPL.
* ΤΑ ΑΡΧΕΙΑ ΑΥΤΑ ΕΙΝΑΙ ΥΠΟ ΤΗΝ ΑΔΕΙΑ ΤΗΣ MAD4MEDIA.
* ΕΠΙΤΡΕΠΕΤΑΙ Η ΕΠΕΞΕΡΓΑΣΙΑ ΤΟΥΣ ΑΛΛΑ ΟΧΙ Η ΔΙΑΘΕΣΗ 'Η ΕΠΑΝΑΔΗΜΟΣΙΕΥΣΗ ΤΟΥΣ.
* ΓΙΑ ΠΕΡΙΣΣΟΤΕΡΕΣ ΠΛΗΡΟΦΟΡΙΕΣ ΔΙΑΒΑΣΤΕ ΤΗΝ ΣΗΜΑΝΣΗ ΣΤΑ ΑΡΧΕΙΑ js.
**/

        /**  ΕΛΛΗΝΙΚΗ ΕΚΔΟΣΗ ΜΕΤΑΦΡΑΣΗ ΓΙΑΝΝΗΣ ΣΦΕΤΚΟΣ */


        defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
        
        $m4j_lang_elements[1]= 'Κουτί Επιλογής';
        $m4j_lang_elements[2]= 'Ναι ή Όχι επιλογή';
        $m4j_lang_elements[10]= 'Ημερομηνία';
        $m4j_lang_elements[20]= 'Textfield';
        $m4j_lang_elements[21]= 'Textarea';
        $m4j_lang_elements[30]= 'Μενού (μονή επιλογή)';
        $m4j_lang_elements[31]= 'Επιλογή Μενού (μονή επιλογή)';
        $m4j_lang_elements[32]= 'Κουμπία radiobutton(μονή επιλογή)';
        $m4j_lang_elements[33]= 'Group κουτιών επιλογής (πολλαπλή επιλογή)';
        $m4j_lang_elements[34]= 'Λίστα(Πολλαπλή Επιλογή)';
        
        
        define('M4J_LANG_FORMS','Φόρμες');
        define('M4J_LANG_TEMPLATES','Πρότυπα');
        define('M4J_LANG_CATEGORY','Κατηγορίες');
        define('M4J_LANG_CONFIG','Ρυθμίσεις');
        define('M4J_LANG_HELP','Πληροφορίες / Βοήθεια');
        define('M4J_LANG_CANCEL','Ακύρωση');
        define('M4J_LANG_PROCEED','Συνέχισε');
        define('M4J_LANG_SAVE','Αποθήκευση');
        define('M4J_LANG_NEW_FORM','Νέα Φόρμα');
        define('M4J_LANG_NEW_TEMPLATE','Νέο Πρότυπο');
        define('M4J_LANG_ADD','Προσθήκη');
        define('M4J_LANG_EDIT_NAME','Επεξεργασία ονόματος και περιγραφής του πρότυπου');
        define('M4J_LANG_NEW_TEMPLATE_LONG','Νέο πρότυπο');
        define('M4J_LANG_TEMPLATE_NAME','Όνομα πρότυπου');
        define('M4J_LANG_TEMPLATE_NAME_EDIT','Αλλαγή ονόματος προτύπου');
        define('M4J_LANG_TEMPLATE_DESCRIPTION','Σύντομη περιγραφή (δεν είναι απαραίτητο - μπορεί να μείνει κενό)');
        define('M4J_LANG_TEMPLATE_DESCRIPTION_EDIT','Επεξεργασία σύντομης περιγραφής');
        define('M4J_LANG_DELETE','Διαγραφή');
        define('M4J_LANG_DELETE_CONFIRM','Είστε σίγουροι πως θέλετε να διαγράψετε το αντικείμενο;');
        define('M4J_LANG_NEW_CATEGORY','Νέα κατηγορία');
        define('M4J_LANG_NAME','Όνομα');
        define('M4J_LANG_SHORTDESCRIPTION','Σύντομη Περιγραφή');
        define('M4J_LANG_ID','ID');
        define('M4J_LANG_ITEMS','Αντικείμενα');
        define('M4J_LANG_EDIT','Επεξεργασία');
        define('M4J_LANG_EDIT_TEMPLATE_ITEMS','Αντικείμενα -> Επεξεργασία');
        define('M4J_LANG_TEMPLATE_NAME_REQUIRED','Δώστε όνομα προτύπου !');
        
        define('M4J_LANG_EDIT_ELEMENT','Επεξεργασία στοιχείων προτύπου: ');
        define('M4J_LANG_CATEGORY_NAME_ERROR','Εισάγετε όνομα κατηγορίας');
        define('M4J_LANG_NONE_LEGAL_EMAIL','Εισάγετε έγκυρο email ή αφήστε το κενό .<br/>');
        define('M4J_LANG_EMAIL','Email');
        define('M4J_LANG_POSITION','Θέση');
        define('M4J_LANG_ACTIVE','Ενεργό');
        define('M4J_LANG_UP','Πάνω');
        define('M4J_LANG_DOWN','Κάτω');
        define('M4J_LANG_EDIT_CATEGORY','Επεξεργασία κατηγορίας');
        define('M4J_LANG_TEMPLATE_ELEMENTS','Στοιχεία προτύπου: ');
        define('M4J_LANG_NEW_ELEMENT_LONG','Εισαγωγή νέου στοιχείου στο πρότυπο: ');
        define('M4J_LANG_ELEMENT_NO_QUESTION_ERROR','Εισάγετε ερώτηση.');
        define('M4J_LANG_REQUIRED','Υποχρεωτικό');
        define('M4J_LANG_QUESTION','Ερώτηση');
        define('M4J_LANG_TYPE','Τύπος');
        define('M4J_LANG_YES','Ναί');
        define('M4J_LANG_NO','Όχι');
        define('M4J_LANG_ALL_FORMS','Όλες οι φόρμες');
        define('M4J_LANG_NO_CATEGORYS','Χωρίς κατηγορία');
        define('M4J_LANG_FORMS_OF_CATEGORY','Φόρμες κατηγορίας: ');
        define('M4J_LANG_PREVIEW','Προεπισκόπηση');
        define('M4J_LANG_DO_COPY','Αντιγραφή');
        define('M4J_LANG_COPY','Αντιγραφή');
        define('M4J_LANG_VERTICAL','Κάθετα');
        define('M4J_LANG_HORIZONTAL','Οριζόντια');
        define('M4J_LANG_EXAMPLE','Παράδειγμα');
        define('M4J_LANG_CHECKBOX','Κουμπί');
        define('M4J_LANG_DATE','Ημερομηνία');
        define('M4J_LANG_TEXTFIELD','Πεδίο κειμένου');
        define('M4J_LANG_OPTIONS','Καθορισμός επιλογών');
        define('M4J_LANG_CHECKBOX_DESC','Μία απλή Ναι/Όχι ερώτηση.');
        define('M4J_LANG_DATE_DESC','Ο χρήστης πρέπει να βάλει ημερομηνία.');
        define('M4J_LANG_TEXTFIELD_DESC','Ο χρήστης πρέπει να εισάγει κείμενο.');
        define('M4J_LANG_OPTIONS_DESC','Ο χρήστης έχει επιλέξει μία η περισσότερες απαντήσεις εκτός των καθορισμένων αντικειμένων. ');
        define('M4J_LANG_CLOSE_PREVIEW','Κλείσε την προεπισκόπηση');
        define('M4J_LANG_Q_WIDTH','Πλάτος της στήλης της ερώτησης. (αριστερά)');
        define('M4J_LANG_A_WIDTH','Πλάτος της στήλης της ερώτησης. (δεξία)');
        define('M4J_LANG_OVERVIEW','Σύνοψη');
        define('M4J_LANG_UPDATE_PROCEED','& συνέχεια');
        define('M4J_LANG_NEW_ITEM','Νέο Αντικείμενο');
        define('M4J_LANG_EDIT_ITEM','Επεξεργασία Αντικειμένου');
        define('M4J_LANG_CATEGORY_NAME','Όνομα κατηγορίας');
        define('M4J_LANG_EMAIL_ADRESS','Διεύθυνση Email');
        define('M4J_LANG_ADD_NEW_ITEM','Προσθήκη νέου αντικείμενου φόρμας:');
        define('M4J_LANG_YOUR_QUESTION','Η ερώτηση σας');
        define('M4J_LANG_REQUIRED_LONG','Απαραίτητο?');
        define('M4J_LANG_HELP_TEXT','Κείμενο Βοήθειας για τους χρήστες (μη απαραίτητο)');
        define('M4J_LANG_TYPE_OF_CHECKBOX','Τύπος κουμπιού:');
        define('M4J_LANG_ITEM_CHECKBOX','Κουτί επιλογής.');
        define('M4J_LANG_YES_NO_MENU','Ναι/Όχι Μενού.');
        define('M4J_LANG_YES_ON','Ναι/Όχι.');
        define('M4J_LANG_NO_OFF','Όχι/Απενεργοποιημένο.');
        define('M4J_LANG_INIT_VALUE','Αρχική Επιλογή:');
        define('M4J_LANG_TYPE_OF_TEXTFIELD','Τύπος του πεδίου κειμένου:');
        define('M4J_LANG_ITEM_TEXTFIELD','Πεδίο κειμένου');
        define('M4J_LANG_ITEM_TEXTAREA','Χώρος κειμένου');
        define('M4J_LANG_MAXCHARS_LONG','Μέγιστοι χαρακτήρες:');
        define('M4J_LANG_OPTICAL_ALIGNMENT','Οπτική ευθυγράμμιση:');
        define('M4J_LANG_ITEM_WIDTH_LONG','<b>Πλάτος σε Pixel</b> <br/>(Προσθέστε \'%\' για ποσοστό. Κενό = Αυτόματη προσαρμογή)<br/><br/>');
        define('M4J_LANG_ROWS_TEXTAREA','<b>Αριμός εμφανών σειρών:</b><br/> (Μόνο στον χώρο του κειμένου)<br/><br/>');
        define('M4J_LANG_DROP_DOWN','<b>Μενού</b>');
        define('M4J_LANG_RADIOBUTTONS','<b>Κουμπιά επιλογής (Radiobuttons)</b>');
        define('M4J_LANG_LIST_SINGLE','<b>Λίστα</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(μονή επιλογή)');
        define('M4J_LANG_CHECKBOX_GROUP','<b>Group κουτιών επιλογής</b>');
        define('M4J_LANG_LIST_MULTIPLE','<b>Λίστα</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(πολλαπλή επιλογή, με \'CTRL\' & αριστερό κλικ)');
        define('M4J_LANG_SINGLE_CHOICE_LONG','Μονή επιλογή (Μόνο ένα αντικείμενο μπορεί να επιλεχθεί):');
        define('M4J_LANG_MULTIPLE_CHOICE_LONG','Πολλαπλή επιλογή (Μπορούν να επιλεχθούν πολλαπλά αντικείμενα):');
        define('M4J_LANG_TYPE_OF_OPTIONS','Τύπος επιλογής:');
        define('M4J_LANG_ROWS_LIST','<b>Αριθμός εμφανών σειρών:</b><br/> (Μόνο για τις λίστες)<br/><br/>');
        define('M4J_LANG_ALIGNMENT_GROUPS','<b>Ευθυγράμμιση: </b> <br/>(Μόνο για κουμπιά radiobuttons και group κουτιών επιλογής)<br/><br/>');
        define('M4J_LANG_OPTIONS_VALUES_INTRO','<b>Καθορίστε τις απαντήσεις.<br/>Τα κενά πεδία θα αγνοούνται.</b>');
        define('M4J_LANG_CATEGORY_INTRO_LONG','Κείμενο εισαγωγής (intro). Θα εμφανίζεται μόνο στις κατηγορίες.');
        define('M4J_LANG_TITLE','Τίτλος');
        define('M4J_LANG_ERROR_NO_TITLE','Επιλέξτε τίτλο.');
        define('M4J_LANG_USE_HELP','Κείμενο Βοήθειας (baloontips)');
        define('M4J_LANG_TITLE_FORM','Τίτλος φόρμας');
        define('M4J_LANG_INTROTEXT','Κείμενο εισαγωγής (intro)');
        define('M4J_LANG_MAINTEXT','Κυρίως κείμενο');
        define('M4J_LANG_EMAIL_HIDDEN_TEXT','Email κειμένου εισαγωγής. (Θα εμφανίζεται μόνο στα emails.)');
        define('M4J_LANG_TEMPLATE','Πρότυπο');
        define('M4J_LANG_LINK_TO_MENU','Σύνδεση με μενού');
        define('M4J_LANG_LINK_CAT_TO_MENU','Σύνδεση της κατηγορίας με το μενού');
        define('M4J_LANG_LINK_TO_CAT','Σύνδεση κατηγορίας: ');
        define('M4J_LANG_LINK_TO_FORM','Σύνδεση Φόρμας: ');
        define('M4J_LANG_LINK_TO_NO_CAT','Σύνδεση να εμφανίζει όλες τις φόρμες χωρίς κατηγορία ');
        define('M4J_LANG_LINK_TO_ALL_CAT','Σύνδεση να εμφανίζει \'Όλες τις κατηγορίες\'');
        define('M4J_LANG_CHOOSE_MENU','Επιλέξτε ένα μενού για σύνδεση: ');
        define('M4J_LANG_MENU','Menu: ');
        define('M4J_LANG_NO_LINK_NAME','Εισάγετε όνομα σύνδεσης.');
        define('M4J_LANG_PUBLISHED','Έγινε δημοσίευση:');
        define('M4J_LANG_PARENT_LINK','Τρέχουσα σύνδεση');
        define('M4J_LANG_LINK_NAME','Όνομα σύνδεσης');
        define('M4J_LANG_ACCESS_LEVEL','Επίπεδο πρόσβασης:');
        define('M4J_LANG_EDIT_MAIN_DATA','Επεξεργασία Βασικών Δεδομένων');
        define('M4J_LANG_LEGEND','Λεζάντα');
        define('M4J_LANG_LINK','Σύνδεση');
        define('M4J_LANG_IS_VISIBLE',' Έχει γίνει δημοσίευση');
        define('M4J_LANG_IS_HIDDEN',' Δεν έχει γίνει δημοσίευση');
        define('M4J_LANG_FORM','Φόρμα');
        define('M4J_LANG_ITEM','Αντικείμενο');
        define('M4J_LANG_IS_REQUIRED','Υποχρεωτικό');
        define('M4J_LANG_IS_NOT_REQUIRED','Δεν είναι υποχρεωτικό');
        define('M4J_LANG_ASSIGN_ORDER','Σειρά στοιχείων');
        define('M4J_LANG_ASSIGN_ORDER_HINT','* Η αλλαγή σειράς δεν είναι δυνατή για \'όλες τις φόρμες\' !<br/>');
        define('M4J_LANG_EDIT_FORM','Επεξεργασία φόρμας');
        define('M4J_LANG_CAPTCHA','Captcha');
        define('M4J_LANG_HOVER_ACTIVE_ON','Δημοσιεύθηκε! Click=Ακύρωση δημοσίευσης');
        define('M4J_LANG_HOVER_ACTIVE_OFF','Ακύρωση δημοσίευσης! Click=Δημοσίευση');
        define('M4J_LANG_HOVER_REQUIRED_ON','Υποχρεωτικό! Click= Δεν είναι υποχρεωτικό');
        define('M4J_LANG_HOVER_REQUIRED_OFF','Δεν είναι υποχρεωτικό! Click= Υποχρεωτικό');
        define('M4J_LANG_DESCRIPTION','Περιγραφή');
        define('M4J_LANG_AREA','Περιχοή');
        define('M4J_LANG_ADJUSTMENT','Ρυθμίσεις');
        define('M4J_LANG_VALUE','Αξία');
        define('M4J_LANG_MAIN_CONFIG','Βασικές ρυθμίσεις:');
        define('M4J_LANG_MAIN_CONFIG_DESC','Μπορείτε να αλλάξετε τις βασικές ρυθμίσεις εδώ. Εάν θέλετε να επαναφέρετε τις ρυθμίσεις (και τις CSS) στις προεπιλεγμένες τότε πατήστε reset.');
        define('M4J_LANG_CSS_CONFIG','Επιλογές CSS:');
        define('M4J_LANG_CSS_CONFIG_DESC','Αυτές οι ρυθμίσεις είναι απαραίτητες για την οπτική παρουσίαση του frontend. Έαν δεν είστε έμπειρος με την CSS, τότε μην αλλάξετε αυτές τις ρυθμίσεις!');
        define('M4J_LANG_RESET','Reset');
                        
        define('M4J_LANG_EMAIL_ROOT', 'Βασική διεύθυνση Email : ' );
        define('M4J_LANG_MAX_OPTIONS', 'Μέγιστες απαντήσεις <br/> ορίστε επιλογή: ' );
        define('M4J_LANG_PREVIEW_WIDTH', 'Προεπισκόπηση πλάτους: ' );
        define('M4J_LANG_PREVIEW_HEIGHT', 'Προεπισκόπηση ύψους: ' );
        define('M4J_LANG_CAPTCHA_DURATION', 'Διάρκεια Captcha (σε λεπτά): ' );
        define('M4J_LANG_HELP_ICON', 'Εικονίδιο βοήθειας: ' );
        define('M4J_LANG_HTML_MAIL', 'HTML Email: ' );
        define('M4J_LANG_SHOW_LEGEND', 'Δείξε την λεζάντα: ' );
        
        define('M4J_LANG_EMAIL_ROOT_DESC', 'Η βασική διεύθυνση email χρησιμοποιείται εάν δεν έχετε ορίσει προηγουμένως άλλη στις κατηγορίες ή στις φόρμες.' );
        define('M4J_LANG_MAX_OPTIONS_DESC', 'Η αξία ρυθμίζει το μέγιστο αριθμό απαντήσεων για ένα αντικείμενο \'συγκεκριμένης επιλογής\'. Η αξία πρέπει να είναι αριθμιτική.' );
        define('M4J_LANG_PREVIEW_WIDTH_DESC', 'Η προεπισκόπηση πλάτους χρησιμοποιείται μόνο εάν δεν την έχετε ήδη συμπληρώσει στα δεδομένα του πρότυπου.' );
        define('M4J_LANG_PREVIEW_HEIGHT_DESC', 'Ύψος της προεπισκόπησης του πρότυπου. ' );
        define('M4J_LANG_CAPTCHA_DURATION_DESC', 'Ανήκει στο frontend. Όρίζει την μέγιστη διάρκεια του Captcha. Σε περίπτωση που λήξει ο χρόνος ο πρέπει να ανανεωθεί ο κωδικός του Captcha' );
        define('M4J_LANG_HELP_ICON_DESC', 'Ορίστε χρώμα του εικονιδίου βοήθειας.' );
        define('M4J_LANG_HTML_MAIL_DESC', 'Εάν θέλετε να λαμβάνετε HTML emails πατήστε Ναί. ' );
        define('M4J_LANG_SHOW_LEGEND_DESC', 'Εάν θέλετε να εμφανίζετε λεζάντα στο πίσω μέρος πατήστε Ναί.' );
        
        define('M4J_LANG_CLASS_HEADING', 'Βασικός τίτλος:' );
        define('M4J_LANG_CLASS_HEADER_TEXT', 'Κείμενο τίτλου' );
        define('M4J_LANG_CLASS_LIST_WRAP', 'Περιτύλιγμα λίστας ' );
        define('M4J_LANG_CLASS_LIST_HEADING', 'Τίτλος λίστας' );
        define('M4J_LANG_CLASS_LIST_INTRO', 'Εισαγωγικό κείμενο λίστας ' );
        define('M4J_LANG_CLASS_FORM_WRAP', 'Περιτύλιγμα φόρμας' );
        define('M4J_LANG_CLASS_FORM_TABLE', 'Φόρμα- Πίνακας ' );
        define('M4J_LANG_CLASS_ERROR', 'Μήνυμα λάθους');
        define('M4J_LANG_CLASS_SUBMIT_WRAP', 'Submit Button Wrap' );
        define('M4J_LANG_CLASS_SUBMIT', 'Κουμπί υποβολής ' );
        define('M4J_LANG_CLASS_REQUIRED', 'Υποχρεωτικό * css ' );
        
        define('M4J_LANG_CLASS_HEADING_DESC', '<strong>DIV-Tag</strong> - Τίτλος site ' );
        define('M4J_LANG_CLASS_HEADER_TEXT_DESC', '<strong>DIV-Tag</strong> - Περιεχόμενο μετά την επικεφαλίδα.' );
        define('M4J_LANG_CLASS_LIST_WRAP_DESC', '<strong>DIV-Tag</strong> - Περιτύλιγμα του αντικειμένου λίστας.' );
        define('M4J_LANG_CLASS_LIST_HEADING_DESC', '<strong>DIV-Tag</strong> - Τίτλος περιτυλίγματος αντικειμένου λίστας. ' );
        define('M4J_LANG_CLASS_LIST_INTRO_DESC', '<strong>DIV-Tag</strong> - Εισαγωγικό κείμενο αντικειμένου λίστας. ' );
        define('M4J_LANG_CLASS_FORM_WRAP_DESC', '<strong>DIV-Tag</strong> - Περιτύλιγμα φόρμας. ' );
        define('M4J_LANG_CLASS_FORM_TABLE_DESC', '<strong>TABLE-Tag</strong> - Πίνακας όπου όλα τα αντικείμενα της φόρμας εμφανίζονται.' );
        define('M4J_LANG_CLASS_ERROR_DESC', '<strong>SPAN-Tag</strong> - CSS κατηγορία των μηνυμάτων λάθους. ' );
        define('M4J_LANG_CLASS_SUBMIT_WRAP_DESC', '<strong>DIV-Tag</strong> - Περιτύλιγμα του πλήκτρου υποβολής ' );
        define('M4J_LANG_CLASS_SUBMIT_DESC', '<strong>INPUT-Tag</strong> - CSS κατηγορία του πλήκτρου υποβολής. ' );
        define('M4J_LANG_CLASS_REQUIRED_DESC', '<strong>SPAN-Tag</strong> - CSS κατηγορία του \' <b>*</b> \' χαρακτήρα για να δηλώσει τα απαιτούμενα πεδία.' );
        
        define('M4J_LANG_INFO_HELP','Πληροφορίες και βοήθεια');
        
        // New to Version 1.1.5
        define('M4J_LANG_CHOOSE_CAPTCHA', 'Τεχνική Captcha: ' );
        define('M4J_LANG_CSS','CSS');
        define('M4J_LANG_SIMPLE','Κλασσικό');
        
        //New To Version 1.1.7
                define('M4J_LANG_CONFIG_RESET','Επανήλθαν οι αρχικές ρυθμίσεις επιτυχώς.');
                define('M4J_LANG_CONFIG_SAVED','Οι ρυθμίσεις αποθηκεύτηκαν επιτυχώς.');
                define('M4J_LANG_CAPTCHA_DESC', ' Εμφανίστηκαν προβλήματα με το βασικό-css-captcha και σε κάποιους servers ή πρότυπα. Σε αυτήν την περίπτωση έχετε την επιλογή ανάμεσα στο βασικό-css-captcha ή ένα κλασσικό captcha. Εάν ακόμα και το κλασσικο captcha δεν σας λύσει το πρόβλημα τότε επιλέξτε Ειδικό (Special)' );
                define('M4J_LANG_SPECIAL','Ειδικό');
        
        
        define('M4J_LANG_MAIL_ISO','Κωδικοποίηση γραμματοσειράς Mail');
        define('M4J_LANG_MAIL_ISO_DESC','utf-8 , iso-8859-1 (Western Europe), iso-8859-4 (Balto), iso-8859-5 (Cyrillic), iso-8859-6 (Arabic), iso-8859-7 (Greek), iso-8859-8 (Hebrew),iso-8859-9 (Turkish), iso-8859-10 (Nordic),iso-8859-11 (Thai)');                
        
        
        // New to Version 1.1.8
        $m4j_lang_elements[40]= 'Επισύναψη';
        define('M4J_LANG_ATTACHMENT','Επισύναψη αρχείου');
        define('M4J_LANG_ATTACHMENT_DESC','Ο χρήστης μπορεί να επισυνάψει αρχέια με τις φόρμες.');
        define('M4J_LANG_TYPE_OF_ATTACHMENT','Παράμετροι των αρχείων επισύναψης:');
        define('M4J_LANG_ALLOWED_ENDINGS','Επιτρεπόμενη κατάληξη αρχείων.');
        define('M4J_LANG_MAXSIZE','Μέγιστο μέγεθος.');
        define('M4J_LANG_BYTE','Byte');
        define('M4J_LANG_KILOBYTE','Kilobyte');
        define('M4J_LANG_MEGABYTE','Megabyte');
        define('M4J_LANG_ELEMENT_ATTACHMENT_DESC','Παρακαλούμε εισάγετε όλες τις επιτρεπτές καταλήξεις χωρίς την τελεία και να διαχωρίζονται μεταξύ τους με <b>κόμμα</b>.Έαν μείνει κενό το πεδίο όλα τα μεγέθη και τύποι αρχείων θα επιτρέπονται. Για να διευκολυνθείτε επιλέξτε από κάτω τις καταλήξεις οι οποίες θα συμπεριληφθούν αυτόματα.');
        define('M4J_LANG_IMAGES','Εικόνες');
        define('M4J_LANG_DOCS','Έγγραφα');
        define('M4J_LANG_AUDIO','Ήχοι');
        define('M4J_LANG_VIDEO','Video');                                                                                   
    define('M4J_LANG_DATA','Δεδομένα');
        define('M4J_LANG_COMPRESSED','Συμπίεση');
        define('M4J_LANG_OTHERS','Άλλα');
        define('M4J_LANG_ALL','Όλα');
        
        // New to Version 1.1.9
        define('M4J_LANG_FROM_NAME','Από το όνομα');
        define('M4J_LANG_FROM_EMAIL','Από το email');
        define('M4J_LANG_FROM_NAME_DESC','Εισάγωγή από τα emails που θα αρχειοθετήσετε<br/>');
        define('M4J_LANG_FROM_EMAIL_DESC','Εισάγωγή από τα emails που θα αρχειοθετήσετε.<br/>');
        define('M4J_LANG_TEMPLATE_DELETE_CAUTION',' Προσοχή! Όλες οι φόρμες που περιέχουν αυτό το πρότυπο θα σβηστούν!');
        
        // New to Proforms 1.0
        
        define('M4J_LANG_STORAGES','Μητρώο βάσης δεδομένων της φόρμας: ');
        define('M4J_LANG_READ_STORAGES','Μητρώο βάσης δεδομένων');
        define('M4J_LANG_EXPORT','Εξαγωγή');
        define('M4J_LANG_CSV_EXPORT','CSV Εξαγωγή');
        define('M4J_LANG_WORKAREA','Περιοχή εργασίας');
        define('M4J_LANG_WORKAREA_DESC','Πλάτος σε pixel του admin παράθυρου');
        define('M4J_LANG_STORAGE_WIDTH','Πλάτος αντικειμένου βάσης δεδομένων');
        define('M4J_LANG_STORAGE_WIDTH_DESC','Πλάτος σε σε pixel του αντικείμενου της βάσης δεδομένων (θα εμφανίζεται στο μητρώο).<br> Μην προσθέτεις px ή % !');
        define('M4J_LANG_RECEIVED','Λήφθηκε');
        define('M4J_LANG_PROCESS','Διαδικασία');
        define('M4J_LANG_DATABASE','Βάση δεδομένων');
        define('M4J_LANG_USERMAIL','Μοναδική email address');
        define('M4J_LANG_USERMAIL_DESC','Εδώ μπαίνει η μοναδική διεύθυνση του χρήση. Δεν μπορείτε να χρησιμοποιήσετε την επιλογή επιβεβαίωσης έαν δεν το έχετε κάνει αυτό. Πρέπει να υπάρχει μόνο ΜΙΑ μοναδική διεύθυνση στο πρότυπο. Εάν το ενεργοποιήσετε αυτό θα διαγράψει την μοναδική email διεύθυνση.');
        define('M4J_LANG_USERMAIL_TOOLTIP','Αυτό το πεδίο είναι για την μοναδική διεύθυνση email. Η μοναδική διεύθυνση είναι πάντα στην επιλογή`υποχρεωτικό`!');
        define('M4J_LANG_MATH','Μαθηματικώς');
        define('M4J_LANG_RE_CAPTCHA','reCAPTCHA');
        define('M4J_LANG_ITEM_PASSWORD','Κωδικός');
        $m4j_lang_elements[22]= 'Κωδικός';
        define('M4J_LANG_MAX_UPLOAD_ALLOWED','Ο server επιτρέπει μέγιστο upload μέγεθος ');
        define('M4J_LANG_CSS_EDIT', 'Επεξεργασία CSS');
        define('M4J_LANG_NO_FRONT_STYLESHEET','Το frontend στυλ αρχείου δεν υπάρχει! ');
        define('M4J_LANG_HTML','HTML');
        define('M4J_LANG_HTML_DESC','Επιτρέπει την εμφάνιση δικού σας HTML κώδικα μεταξύ των στοιχείων της φόρμας.');
        $m4j_lang_elements[50]= 'HTML';
        define('M4J_LANG_EXTRA_HTML',' - EXTRA HTML - ');
        define('M4J_LANG_RESET_DESC','Επαναφορά αρχικών ρυθμίσεων.');
        define('M4J_LANG_SECURITY','Captcha &amp; Ασφάλεια');
        define('M4J_LANG_RECAPTCHA_THEME','reCaptcha θέμα');
        define('M4J_LANG_RECAPTCHA_THEME_DESC','Εάν χρησιμοποιείτε reCaptcha, μπορείτε να αλλάξετε το θέμα.');
        define('M4J_LANG_SUBMISSION_TIME','Ταχύτητα αποστολής (in ms)');
        define('M4J_LANG_SUBMISSION_TIME_DESC','Αυτή η αξία είναι σε milliseconds, καθορίζει τον μέγιστο χρόνο μεταξύ της εμφάνισης της φόρμας και της αποστολής της. Εάν η αποστολή είναι ταχύτερη θα θεωρηθεί ως spam.');
        define('M4J_LANG_FORM_TITLE','Δίξε τίτλο');
        define('M4J_LANG_FORM_TITLE_DESC','Καθορίζει εάν εμφανίζεται ο τίτλος στην φόρμα.');
        define('M4J_LANG_SHOW_NO_CATEGORY','Εμφάνισε "Χωρίς κατηγορία"');
        define('M4J_LANG_SHOW_NO_CATEGORY_DESC','Εδώ μπορείτε να καθορίσετε την εμφάνιση της ψευδο-κατηγορίας "Χωρίς κατηγορία". Ανάλογα με την ρύθμιση θα εμφανίζεται στην κύρια κατηγορία ή όχι.');
        define('M4J_LANG_FORCE_CALENDAR','Εξαναγκασμός χρησιμοποίησης Αγγλικού ημερολογίου');
        define('M4J_LANG_FORCE_CALENDAR_DESC','Σε κάποιες front-end γλώσσες το ημερολόγιο μπορεί να μην λειτουργεί σωστά, εάν γίνει αυτό επιλέξτε Εξαναγκασμό χρησιμοποίησης του Αγγλικού ημερολογίου.');
        define('M4J_LANG_LINK_THIS_CAT_ALL','Σύνδεση την λίστα των κατηγοριών στα μενού.');
        define('M4J_LANG_LINK_THIS_NO_CAT','Σύνδεση όλων των φορμών να ανήκουν στο μενού λίστας κατηγορίας.');
        define('M4J_LANG_LINK_THIS_CAT','Σύνδεση όλων των φορμών στην κατηγορία \'%s\'σαν λίστα στο μενού.');
        define('M4J_LANG_LINK_THIS_FORM','Σύνδεση της φόρμας στο μενού.');
        define('M4J_LANG_LINK_ADVICE','Μπορείτε να συνδέσετε κατηγορίες και φόρμες μόνο με τα κουμπιά που έχουν δωθεί [%s] στο μενού!');
        define('M4J_LANG_HELP_TEXT_SHORT','Κείμενο βοήθειας');
        define('M4J_LANG_ROWS','Γραμμές');
        define('M4J_LANG_WIDTH','Πλάτος');
        define('M4J_LANG_ALIGNMENT','Ευθυγράμμιση');
        define('M4J_LANG_SHOW_USER_INFO','Δείξε τις πληροφοριές χρήστη');
        define('M4J_LANG_SHOW_USER_INFO_DESC','Εμφανίζει την λίστα των δεδομένων των χρηστών σε emails. ΠΑΡΑΔΕΙΓΜΑ: Joomla Όνομα, Joomla email χρήστη, browser, OS, κλπ.');
        define('M4J_LANG_FRONTEND','Frontend');
        define('M4J_LANG_ADMIN','Admin');
        define('M4J_LANG_DISPLAY','Εμφάνιση');
        define('M4J_LANG_FORCE_ADMIN_LANG','Εξαναγκασμός γλώσσας admin');
        define('M4J_LANG_FORCE_ADMIN_LANG_DESC','Στην κανονική προφόρμα αναγνωρίζει την γλώσσα του admin αυτόματα. Εδώ μπορείτε να την εξαναγκάσετε να εμφανίζεται αλλιώς.');
        define('M4J_LANG_USE_JS_VALIDATION','Επικύρωση Javascript');
        define('M4J_LANG_USE_JS_VALIDATION_DESC','Εδώ μπορείτε να αλλάξετε την φόρμα της επικύρωσης javascript. Εάν είναι απενεργοποιημένο τα πεδία θα εξεταστούν μετά την εισαγωγή.');
        define('M4J_LANG_PLEASE_SELECT','Επιλέξτε');
        define('M4J_LANG_LAYOUT','Διάταξη');
        define('M4J_LANG_DESC_LAYOUT01','Μία στήλη');
        define('M4J_LANG_DESC_LAYOUT02','Δύο στήλες');
        define('M4J_LANG_DESC_LAYOUT03','Τρεις στήλες');
        define('M4J_LANG_DESC_LAYOUT04','Επικεφαλίδα με δύο στήλες και υποσελίδα με μία στήλη');
        define('M4J_LANG_DESC_LAYOUT05','Επικεφαλίδα με μία στήλη και υποσελίδα με δύο στήλες');
        define('M4J_LANG_USE_FIELDSET','Χρησιμοποίησε το πεδίο:');
        define('M4J_LANG_LEGEND_NAME','Λεζάντα:');
        define('M4J_LANG_LEFT_COL','Αριστερή στήλη:');
        define('M4J_LANG_RIGHT_COL','Δεξιά στήλη:');
        define('M4J_LANG_FOR_POSITION',' για την θέση %s');
        define('M4J_LANG_LAYOUT_POSITION','Θέση διάτηξης');
        define('M4J_LANG_PAYPAL','PayPal');
        define('M4J_LANG_EMAIL_TEXT','Email κείμενο');
        define('M4J_LANG_CODE','Κώδικας');
        define('M4J_LANG_NEVER','Ποτέ');
        define('M4J_LANG_EVER','Πάντα');
        define('M4J_LANG_ASK','Ερώτηση');
        define('M4J_LANG_AFTER_SENDING','Μετά την αποστολή');
        define('M4J_LANG_CONFIRMATION_MAIL','Mail επιβεβαίωσης');
        define('M4J_LANG_TEXT_FOR_CONFIRMATION','Κείμενο Email μόνο για το mail επιβεβαίωσης;');
        define('M4J_LANG_SUBJECT','Αντικείμενο');
        define('M4J_LANG_ADD_TEMPLATE','Προσθήκη φόρμας πρότυπου');
        define('M4J_LANG_INCLUDED_TEMPLATES','Εισαγωγή φόρμας προτύπου');
        define('M4J_LANG_ADVICE_USERMAIL_ERROR',"Η φόρμα πρέπει να έχει μία μοναδική διεύθυνση email. Έχετε ήδη ορίσει πρότυπο φόρμας με μία μοναδική διεύθυνση email σε αυτη την φόρμα.");
        define('M4J_LANG_STANDARD_TEXT','Κλασσικό κείμενο');
        define('M4J_LANG_REDIRECT','Επανακατεύθυνση');
        define('M4J_LANG_CUSTOM_TEXT','Τροποποιημένο κείμενο');
        define('M4J_LANG_ERROR_NO_FORMS','Μπορείτε να δημιουργήσετε μία φόρμα μόνο εάν έχετε δημιουργήσει πρότυπο φόρμας. Δεν έχετε δημιουργήσει ακόμα, θέλετε τώρα?');
        define('M4J_LANG_USE_PAYPAL','Χρησιμοποιήστε PayPal');
        define('M4J_LANG_USE_PAYPAL_SANDBOX','Χρησιμοποιήστε PayPal Sandbox');
        define('M4J_LANG_HEIGHT','Ύψος');
        define('M4J_LANG_CLASS_RESET','Πλήκτρο Reset');
        define('M4J_LANG_CLASS_RESET_DESC','<b>INPUT-Tag</b> - CSS κλάσση για το κουμπί reset.');
        define('M4J_LANG_PAYPAL_PARAMETERS','Ρυθμίσεις Paypal');
        define('M4J_LANG_PAYPAL_ID','PayPal ID (email)');
        define('M4J_LANG_PAYPAL_PRODUCT_NAME','Όνομα προϊόντος');
        define('M4J_LANG_PAYPAL_QTY','Ποσότητα');
        define('M4J_LANG_PAYPAL_NET_AMOUNT','Καθαρό ποσό ποσότητας (τιμή προϊόντος)');
        define('M4J_LANG_PAYPAL_CURRENCY_CODE','Νόμισμα');
        define('M4J_LANG_PAYPAL_ADD_TAX','Συν ΦΠΑ (Συνολικά όχι ποσοστό!) ');
        define('M4J_LANG_PAYPAL_RETURN_URL','Διεύθυνση επιστροφής μετά την επιτυχημένη συναλλαγή (URL with http)');
        define('M4J_LANG_PAYPAL_CANCEL_RETURN_URL','Διεύθυνση επιστροφής σε περίπτωση αποτυχίας ή ακύρωσης (URL with http) ');
        define('M4J_LANG_SERVICE','Service');
        define('M4J_LANG_SERVICE_KEY','Service Κλειδί');
        define('M4J_LANG_EDIT_KEY','Επεξεργασία / Ανανέωση κλειδιού');
        define('M4J_LANG_CONNECT','Σύνδεση');
        define('M4J_LANG_NONE','Κανένα');
        define('M4J_LANG_ALPHABETICAL','Αλβαβητικά');
        define('M4J_LANG_ALPHANUMERIC','Αλφαριθμητικά');
        define('M4J_LANG_NUMERIC','Αριθμητικά');
        define('M4J_LANG_INTEGER','Ακέραιος αριθμός');
        define('M4J_LANG_FIELD_VALIDATION','Επιβεβαίωση');
        define('M4J_LANG_SEARCH','Αναζήτηση');
        define('M4J_LANG_ANY','-ANY-');
        define('M4J_LANG_JOBS_EMAIL_INFO','Εάν δεν βάλετε διεύθυνση e-mail θα χρησιμοποιηθεί αυτή της κατηγορίας. <br /> Εάν μείνει κενό θα χρησιμοποιηθεί η γενική διεύθυνση (ρυθμίσεις).');
        define('M4J_LANG_JOBS_INTROTEXT_INFO','Το εισαγωγικό κείμενο είναι ένα κείμενο το οποίο θα εμφανίζεται στις λίστης των φόρμων κατηγορίας. Δεν εμφανίζεται στην ίδια την φόρμα.');
        define('M4J_LANG_JOBS_MAINTEXT_INFO','The main text appears at the top of the form.');
        define('M4J_LANG_JOBS_AFTERSENDING_INFO','Εδώ καθορίζετε τι θα εμφανίζεται μετά την εισαγωγή δεδομένων στην φόρμα.');
        define('M4J_LANG_JOBS_PAYPAL_INFO','Μετά την αποστολή μπορείτε να παραπέμψετε τον χρήστη κατευθείαν στο Paypal. Εισάγετε ποσό (χρησιμοποιείστε τελείες όχι κόμμα) 24.50 αντί 24,50! <br /> Εάν χρησιμοποιείτε PayPal, η επιλογή "Μετά την αποστολή" θα αγνοηθεί !');
        define('M4J_LANG_JOBS_CODE_INFO','Μπορείτε να βάλετε δικό σας κώδικα (HTML, JS <b> όχι όμως PHP </b>) στο τέλος της φόρμας:<br /> π.χ. Google Analytics. Ο κώδικας της επιλογής "Μετά την αποστολή" δεν θα εμφανίζεται στην περίπτωση επιλογής Paypal.');
        define('M4J_LANG_ERROR_COLOR','Error color');
        define('M4J_LANG_ERROR_COLOR_DESC','If the javascript form validation detects an error ther border of a cell will displayed in a special color. Here you can determine the color (Hexadecimal without #).');
        define('M4J_LANG_CONFIG_DISPLAY_INFO','Εδώ αλλάζετε τις αξίες που επιρεάζουν την παρουσίαση του μπροστά και πίσω μέρους.');
        define('M4J_LANG_CONFIG_CAPTCHA_INFO','Εδώ μπορείτε να καθορίσετε γενικώς τις ρυθμίσεις της τεχνολογίας ασφάλειας (captcha).');
        define('M4J_LANG_CONFIG_RESET_INFO','Το στυλ της καρτέλας αρχείων δεν θα μηδενίζεται, μόνο η κλάσση του ονόματος του CSS και των ρυθμίσεων του!');
        define('M4J_LANG_SERVICE_DESC1',
        '
        Έαν έχετε κλειδί εξυπηρέτησης άδειας εισόδου θα μπορέσετε επικοινωνήσετε με το Proforms Service Helpdesk εδώ.<br/>
        Για να το κάνετε αυτό εισάγετε το κλειδί και σώστε το. Μετά πρέπει να πατήσετε το πλήκτρο "Connect" για να συνδεθείτε με το Service Help Desk Server.<br/>
        <br/> 
        Μπορείτε να συνδεθείτε με το service desk μόνο μέσω της περιοχής του admin των Proforms.<br/>
        Απευθείας σύνδεση δεν επιτρέπεται.<br/>
        <br/> 
        Το κάθε κλειδί είναι προσωρινό και δεν μπορεί να χρησιμοποιηθεί μετα τό πέρας της περιόδου. το κλειδί είναι έγκυρο μόνο για ένα domain / Joomla εγκατάσταση. Στην πρώτη επίσκεψη του helpdesk, θα ερωτηθείτε για το κλειδί περισσότερες πληροφορίες.<br/>
        <br/><span style="color:red"> 
        Εάν η εγκατάσταση (domain) είναι πίσω από firewall ή σε μη κοινή πρόσβαση (e.g. σε τοπικό server), δεν μπορούμε να προσφέρουμε τεχνική βοήθεια.<br/>
        </span><br/> 
        Το κέντρο βοήθειας Proforms προσφέρει πληροφορίες για το προϊόν και την δυνατότητα επικοινωνίας μαζί μας (απευθείας αιτήματα μέσω email θα αγνοούνται) αλλά και downloads στα πακέτα αναβάθμισης, άλλα πρότυπα ή plug-ins για Mooj Proforms.<br/>
        <br/> 
        Το κέντρο βοήθειας είναι υπο κατασκευή και αναπτύσσεται καθημερινώς. Όταν ολοκληρωθεί η ανάπτυξη του θα λάβετε ένα αυτόματο πακέτο αναβάθμισης.<br/>
        <br/> 
        Οι περιορισμοί που αφορούν τα domain επικεντρόνωνται μόνο στο κέντρο βοήθειας. Οι λοιπές λειτουργίες δεν επιρεάζονται.<br/>
        <br/> 
        ');
        define('M4J_LANG_SEARCH_IN',' Ψάξε στό ');
  	
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
