<?php
/**
 * @version		1.4.4
 * @package		Joomla
 * @subpackage	Event Booking
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;

/**
 * Change the db structure of the previous version
 *
 */
function com_install( ) {
    jimport('joomla.filesystem.file') ;
    jimport('joomla.filesystem.folder') ;
	$db = & JFactory::getDBO(); 			
	$sql = 'SELECT COUNT(*) FROM #__eb_configs';
	$db->setQuery($sql) ;	
	$total = $db->loadResult();
	if (!$total) {		
		$configSql = JPATH_ADMINISTRATOR.'/components/com_eventbooking/sql/config.eventbooking.sql' ;
		$sql = JFile::read($configSql) ;
		$queries = $db->splitSql($sql);
		if (count($queries)) {
			foreach ($queries as $query) {
			$query = trim($query);
			if ($query != '' && $query{0} != '#') {
					$db->setQuery($query);
					$db->query();						
				}	
			}
		}

		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    //Update data
		    $sql = 'UPDATE #__eb_configs SET config_value="m-d-Y" WHERE config_key="date_format"';
		    $db->setQuery($sql) ;
		    $db->query();
		    $sql = 'UPDATE #__eb_configs SET config_value="m-d-Y g:i a" WHERE config_key="event_date_format"';
		    $db->setQuery($sql) ;
		    $db->query();		    
		    $sql = 'UPDATE #__eb_configs SET config_value="g:i a" WHERE config_key="event_time_format"';
		    $db->setQuery($sql) ;
		    $db->query();
		}
	}
	$sql = 'SELECT COUNT(*) FROM #__eb_payment_plugins';
	$db->setQuery($sql) ;
	$total = $db->loadResult();
	if (!$total) {
		$configSql = JPATH_ADMINISTRATOR.'/components/com_eventbooking/sql/plugins.eventbooking.sql' ;
		$sql = JFile::read($configSql) ;
		$queries = $db->splitSql($sql);
		if (count($queries)) {
			foreach ($queries as $query) {
			$query = trim($query);
			if ($query != '' && $query{0} != '#') {
					$db->setQuery($query);
					$db->query();						
				}	
			}
		}					
	}
	//Change field type of some fields
	$sql = 'ALTER TABLE  `#__eb_events` CHANGE  `short_description`  `short_description` MEDIUMTEXT  NULL DEFAULT NULL' ;
	$db->setQuery($sql) ;
	$db->query();
		
	$sql = "ALTER TABLE  `#__eb_events` CHANGE  `discount`  `discount` DECIMAL( 10, 2 ) NULL DEFAULT  '0'" ;
	$db->setQuery($sql) ;
	$db->query();
	
	$sql = "ALTER TABLE  `#__eb_locations` CHANGE  `lat`  `lat` DECIMAL( 10, 6 ) NULL DEFAULT '0'" ;
	$db->setQuery($sql) ;
	$db->query();
	
	$sql = "ALTER TABLE  `#__eb_locations` CHANGE  `long`  `long` DECIMAL( 10, 6 ) NULL DEFAULT '0'" ;
	$db->setQuery($sql) ;
	$db->query();
			
	//Change db structure
	$sql = ' SHOW FIELDS FROM #__eb_events ';
	$db->setQuery($sql) ;
	$rows = $db->loadObjectList();
	$fields = array();
	for ($i = 0 , $n = count($rows); $i < $n; $i++) {
		$row = $rows[$i];
		$fields[] = $row->Field; 				
	}
	if (!in_array('event_end_date', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `event_end_date` DATETIME NULL AFTER  `event_date` ;";
		$db->setQuery($sql);
		$db->query();
	}				
		
	if (!in_array('access', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `access` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('registration_access', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `registration_access` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('max_group_number', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `max_group_number` INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
			
	
	if (!in_array('paypal_email', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `paypal_email` VARCHAR( 255 ) NULL;";
		$db->setQuery($sql);
		$db->query();
	}
	
    if (!in_array('attachment', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `attachment` VARCHAR( 255 ) NULL;";
		$db->setQuery($sql);
		$db->query();		
		//Need to create com_eventbooking folder under media folder
		
		if (!JFolder::exists(JPATH_ROOT.DS.'media'.DS.'com_eventbooking')) {
		    JFolder::create(JPATH_ROOT.DS.'media'.DS.'com_eventbooking');
		}						
	}
	
	if (!in_array('notification_emails', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `notification_emails` VARCHAR( 255 ) NULL;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('user_email_body', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `user_email_body` TEXT NULL;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('user_email_body_offline', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `user_email_body_offline` TEXT NULL;";
		$db->setQuery($sql);
		$db->query();
	}

	if (!in_array('thanks_message', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `thanks_message` TEXT NULL;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('thanks_message_offline', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `thanks_message_offline` TEXT NULL;";
		$db->setQuery($sql);
		$db->query();
	}

	//Adding some new fields for supporting recurring events
	if (!in_array('enable_cancel_registration', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `enable_cancel_registration` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('cancel_before_date', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `cancel_before_date` DATETIME NULL ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('enable_auto_reminder', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `enable_auto_reminder` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('remind_before_x_days', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `remind_before_x_days` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('early_bird_discount_type', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `early_bird_discount_type` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('early_bird_discount_date', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `early_bird_discount_date` DATETIME NULL ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('early_bird_discount_amount', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `early_bird_discount_amount` DECIMAL( 10, 2 ) NULL DEFAULT '0';";
		$db->setQuery($sql);
		$db->query();
	}
	
	
	if (!in_array('parent_id', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `parent_id` INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('created_by', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `created_by` INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('event_type', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `event_type` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('recurring_type', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `recurring_type` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('recurring_frequency', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `recurring_frequency` INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('article_id', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `article_id` INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	
	if (!in_array('weekdays', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `weekdays` VARCHAR( 50 ) NULL;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('monthdays', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `monthdays` VARCHAR( 50 ) NULL;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('recurring_end_date', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `recurring_end_date` DATETIME NULL ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('recurring_occurrencies', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `recurring_occurrencies` INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}	
	
	if (!in_array('recurring_occurrencies', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `recurring_occurrencies` INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}

	if (!in_array('custom_fields', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `custom_fields` TEXT NULL;";
		$db->setQuery($sql);
		$db->query();
	}
	
	#Support deposit payment
    if (!in_array('deposit_type', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `deposit_type` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}

    if (!in_array('deposit_amount', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `deposit_amount` DECIMAL( 10, 2 ) NULL DEFAULT '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	
	if (!in_array('registration_type', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `registration_type` TINYINT NOT NULL DEFAULT  '0' AFTER  `enable_group_registration` ;";
		$db->setQuery($sql);
		$db->query();
		$updateDb = true ;
	} else {
		$updateDb = false ;
	}
	if ($updateDb) {
		$sql = 'UPDATE #__eb_events SET registration_type = 1 WHERE enable_group_registration = 0';
		$db->setQuery($sql) ;
		$db->query();
	}		
			
	if (!in_array('custom_field_ids', $fields)) {
		$sql = "ALTER TABLE  `#__eb_events` ADD  `custom_field_ids` VARCHAR( 255 ) NULL;";
		$db->setQuery($sql);
		$db->query();
	}	
	//	Change db structure of #__eb_categories
	$sql = ' SHOW FIELDS FROM #__eb_categories ';
	$db->setQuery($sql) ;
	$rows = $db->loadObjectList();
	$fields = array();
	for ($i = 0 , $n = count($rows); $i < $n; $i++) {
		$row = $rows[$i];
		$fields[] = $row->Field; 				
	}
	if (!in_array('access', $fields)) {
		$sql = "ALTER TABLE  `#__eb_categories` ADD  `access` TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	//Registrants table
	$sql = ' SHOW FIELDS FROM #__eb_registrants ';
	$db->setQuery($sql) ;
	$rows = $db->loadObjectList();
	$fields = array();
	for ($i = 0 , $n = count($rows); $i < $n; $i++) {
		$row = $rows[$i];
		$fields[] = $row->Field; 				
	}
	if (!in_array('total_amount', $fields)) {
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `total_amount` DECIMAL( 10, 6 ) NULL DEFAULT '0';";
		$db->setQuery($sql);
		$db->query();		
		
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `discount_amount` DECIMAL( 10, 6 ) NULL DEFAULT '0';";
		$db->setQuery($sql);
		$db->query();
		
		$sql = 'UPDATE #__eb_registrants  SET total_amount=`amount`';
		$db->setQuery($sql) ;
		$db->query() ;
	}
	
	if (!in_array('cart_id', $fields)) {
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `cart_id`  INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();						
	}	
	
	
	if (!in_array('deposit_amount', $fields)) {
	    $sql = "ALTER TABLE  `#__eb_registrants` ADD `deposit_amount` DECIMAL( 10, 2 ) NULL DEFAULT '0' ;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('payment_status', $fields)) {
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `payment_status`  TINYINT NOT NULL DEFAULT  '1' ;";
		$db->setQuery($sql);
		$db->query();						
	}		
	
	
    if (!in_array('coupon_id', $fields)) {
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `coupon_id`  INT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();						
	}		
	
    if (!in_array('check_coupon', $fields)) {
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `check_coupon`  TINYINT NOT NULL DEFAULT  '0' ;";
		$db->setQuery($sql);
		$db->query();						
	}
	
	if (!in_array('tax_amount', $fields)) {
	    $sql = "ALTER TABLE  `#__eb_registrants` ADD  `tax_amount` DECIMAL( 10, 6 ) NULL DEFAULT '0';";
		$db->setQuery($sql);
		$db->query();	
	}
	
	if (!in_array('registration_code', $fields)) {
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `registration_code` VARCHAR( 15 ) NULL;";
		$db->setQuery($sql);
		$db->query();
	}
	
	if (!in_array('is_reminder_sent', $fields)) {
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `is_reminder_sent` TINYINT NOT NULL DEFAULT  '0';";
		$db->setQuery($sql);
		$db->query();
	}

	if (!in_array('is_group_billing', $fields)) {
		$sql = "ALTER TABLE  `#__eb_registrants` ADD  `is_group_billing` TINYINT NOT NULL DEFAULT  '0';";
		$db->setQuery($sql);
		$db->query();
						
		//Update all other records
		$sql = 'SELECT DISTINCT group_id FROM #__eb_registrants WHERE group_id > 0';
		$db->setQuery($sql);
		$groupIds = $db->loadResultArray() ;
		if (count($groupIds)) {
			$sql = 'UPDATE #__eb_registrants SET is_group_billing=1 WHERE id IN ('.implode(',', $groupIds).') OR number_registrants > 1';
			$db->setQuery($sql) ;
			$db->query();

			//Need to update the published field
			$sql = 'SELECT id, payment_method, transaction_id, published FROM #__eb_registrants WHERE id IN ('.implode(',', $groupIds).') OR number_registrants > 1';
			$db->setQuery($sql) ;
			$rowGroups = $db->loadObjectList() ;

			foreach ($rowGroups as $rowGroup) {
				$id = $rowGroup->id ;
				$paymentMethod = $rowGroup->payment_method ;
				$transactionId = $rowGroup->transaction_id ;
				$published = $rowGroup->published ;
				$sql = "UPDATE  #__eb_registrants SET payment_method='$paymentMethod', transaction_id='$transactionId', published='$published', number_registrants=1 WHERE group_id=$id";
				$db->setQuery($sql) ;
				$db->query() ;
			}			
		}						
	}	

	$sql = "ALTER TABLE  `#__eb_registrants` CHANGE  `group_id`  `group_id` INT( 11 ) NULL DEFAULT  '0';";
	$db->setQuery($sql);
	$db->query();
	
	$sql = 'UPDATE #__eb_registrants SET group_id = 0 WHERE group_id IS NULL';
	$db->setQuery($sql);
	$db->query();
	
	//Update to use event can be assigned to multiple categories feature
	$sql = 'SELECT COUNT(id) FROM #__eb_event_categories';
	$db->setQuery($sql) ;
	$total = $db->loadResult();
	if ($total == 0) {
		$sql = 'INSERT INTO #__eb_event_categories(event_id, category_id)
				SELECT id, category_id FROM #__eb_events		
		';	
		$db->setQuery($sql) ;
		$db->query();
	}
	//Field Events table
	$sql = 'SELECT COUNT(*) FROM #__eb_field_events';
	$db->setQuery($sql) ;
	$total = $db->loadResult();
	if (!$total) {
		$sql = 'UPDATE #__eb_fields SET event_id = -1 WHERE event_id = 0';
		$db->setQuery($sql) ;
		$db->query();
		$sql = 'INSERT INTO #__eb_field_events(field_id, event_id) SELECT id, event_id FROM #__eb_fields WHERE event_id != -1 ' ;
		$db->setQuery($sql) ;
		$db->query();
	} 
	//Add show price for free event config option
	$sql = 'SELECT COUNT(id) FROM #__eb_configs WHERE config_key="show_price_for_free_event"';
	$db->setQuery($sql) ;
	$total = $db->loadResult();
	if (!$total) {
		$sql = 'INSERT INTO #__eb_configs(config_key, config_value) VALUES("show_price_for_free_event", 1)';
		$db->setQuery($sql) ;
		$db->query() ;
	}		
	
	//Delete the css files which are now moved to themes folder	
	$files = array(
	    'default.css',
	    'fire.css',
	    'leaf.css',
	    'ocean.css',
	    'sky.css',
	    'tree.css'		
	) ;
	$path = JPATH_ROOT.'/components/com_eventbooking/assets/css/' ;
	foreach ($files as $file) {
	     $filePath = $path.$file ;
	     if (JFile::exists($filePath)) {
	         JFile::delete($filePath);
	     }   
	}
    
	//Update ACL field, from 1.4.1 and before to 1.4.2
	
	if (version_compare(JVERSION, '1.6.0', 'ge')) {
	    $sql = 'UPDATE #__eb_categories SET `access` = 1 WHERE `access` = 0';
	    $db->setQuery($sql) ;
	    $db->query();
	    
	    $sql = 'UPDATE #__eb_events SET `access` = 1 WHERE `access` = 0';
	    $db->setQuery($sql) ;
	    $db->query();
	    
	    $sql = 'UPDATE #__eb_events SET `registration_access` = 1 WHERE `registration_access` = 0';
	    $db->setQuery($sql) ;
	    $db->query();
	}
	
	//Update SEF setting
	$sql = 'SELECT COUNT(*) FROM #__eb_configs WHERE config_key="insert_menu_title"';
	$db->setQuery($sql) ;
	$total  = $db->loadResult() ;
	if (!$total) {
	    $sql = "INSERT INTO #__eb_configs(config_key, config_value) VALUES('insert_menu_title', '1') ";
	    $db->setQuery($sql) ;
	    $db->query() ;
	    
	    $sql = "INSERT INTO #__eb_configs(config_key, config_value) VALUES('insert_event_id', '0') ";
	    $db->setQuery($sql) ;
	    $db->query() ;
	    
	    $sql = "INSERT INTO #__eb_configs(config_key, config_value) VALUES('insert_event_title', '1') ";
	    $db->setQuery($sql) ;
	    $db->query() ;
	    
	    $sql = "INSERT INTO #__eb_configs(config_key, config_value) VALUES('insert_category_id', '0') ";
	    $db->setQuery($sql) ;
	    $db->query() ;
	    
	    $sql = "INSERT INTO #__eb_configs(config_key, config_value) VALUES('insert_category', '0') ";
	    $db->setQuery($sql) ;
	    $db->query() ;
	}
}
