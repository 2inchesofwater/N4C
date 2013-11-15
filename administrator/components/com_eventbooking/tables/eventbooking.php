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
 * Event Table Class
 *
 */
class EventEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;		
	/**
	 * 
	 * The parent event ID
	 * @var Int
	 */
	var $parent_id = null ;
	/**
	 * Event Category
	 *
	 * @var int
	 */
	var $category_id = null ;
	/**
	 * Location ID
	 *
	 * @var int
	 */
	var $location_id = null ;	
	/**
	 * Event Title
	 *
	 * @var String
	 */
	var $title = null ;
	/**
	 * Event date
	 *
	 * @var DateTime
	 */
	var $event_date = null ;
	/**
	 * Event End date
	 *
	 * @var DateTime
	 */
	var $event_end_date = null ;
	/**
	 * Short description of event
	 *
	 * @var string
	 */
	var $short_description = null ;	
	/**
	 * Description of event
	 *
	 * @var string
	 */
	var $description = null ;
	/**
	 * Individual registration price
	 *
	 * @var Decimal
	 */
	var $individual_price = null ;
	/**
	 * Access permission
	 *
	 * @var TinyInt
	 */
	var $access = null ;
	/**
	 * Registration access level
	 *
	 * @var Tinyint
	 */
	var $registration_access = null ;
	/**
	 * Event capacity
	 *
	 * @var int
	 */
	var $event_capacity = null ;
	/**
	 * Cut of date . After this date, we will not receive registration for this event
	 *
	 * @var DateTime
	 */
	var $cut_off_date = null ;	
	/**
	 * Registration Type
	 *
	 * @var 0 : Both individual and Group registration, 1 : Only individual registration, 2 : Only group registration , 3 : Disable registration
	 * 
	 */
	var $registration_type = null ;
	/**
	 * Max number of group members
	 *
	 * @var Tinyint
	 */
	var $max_group_number = null ;		
	/**
	 * Discount Type
	 *
	 * @var Tinyint
	 */
	var $discount_type = null ;
	/**
	 * Discount
	 *
	 * @var Decimal
	 */
	var $discount = null ;
	/**
	 * Enable cancel registration or not	 
	 * @var Tinyint
	 */
	var $enable_cancel_registration = null ;
	/**
	 * Cancel before event date	
	 * @var DateTime
	 */
	var $cancel_before_date = null ;
	/**
	 * Enable auto reminder	 
	 * @var string
	 */
	var $enable_auto_reminder = null ;
	/**
	 * 
	 * @var Tinyint
	 */
	var $remind_before_x_days = null ; 
	/**
	 * Early bird discount type, percent or amount
	 * @var Tinyint
	 */
	var $early_bird_discount_type = null ;
	/**
	 * 
	 * Early bird discount amount
	 * @var Decimal
	 */
	var $early_bird_discount_amount = null ;
	/**
	 * Deposit type
	 * @var Tinyint
	 */
	var $deposit_type = null ;
	/**
	 * 
	 * Deposit amount
	 * @var Decimal
	 */
	var $deposit_amount = null ;
	/**
	 * 
	 * Early bird discount date
	 * @var DateTime
	 */
	var $early_bird_discount_date = null ;
	/**
	 * Term and contion article ID	 
	 * @var int
	 */
	var $article_id = 0 ;
	/**
	 * Recurring type, daily or weekly
	 * @var Tinyint
	 */
	var $recurring_type = null ;
	/**
	 * Recurring frequency, for example every 3 days or 3 every 3 weeks
	 *
	 * @var Int
	 */
	var $recurring_frequency = null ;
	/**
	 * Days in the week where the event occures.
	 * @var string
	 */
	var $weekdays = null ;
	/**
	 * Days in the month which the event happens	 
	 * @var string
	 */
	var $monthdays = null ;
	/**
	 * The date which recurring event stopped
	 * 
	 * @var Datetime
	 */
	var $recurring_end_date = null ;
	/**
	 * 
	 * Number of occurrencies for recurring events
	 * @var Int
	 */	
	var $recurring_occurrencies = null ;
	/**
	 * Notification emails. Emails receive when someone post notification
	 *
	 * @var varchar
	 */		
	var $paypal_email = null ;
	/***
	 *Notification emails
	 */
	var $notification_emails = null ;
	/***
	 *User email body
	 */
	var $user_email_body = null ;
	/***
	 * User email body for offline payment
	 */
	var $user_email_body_offline = null ;
	/***
	 * Thanks message
	 */
	var $thanks_message = null ;
	/***
	 * Thanks message offline payment
	 */
	var $thanks_message_offline = null ;
	/***
	 * Params
	 */	
	var $params = null ;
	/**
	 * ID of user who created the event
	 * 
	 * @var int
	 */
	var $created_by = null ;	
	var $custom_field_ids = null ;
	/**
	 * Custom fields data for event	 
	 * @var text
	 */
	var $custom_fields = null ;
	/**
	 * File attachment will be sent to registrant when they register for the event
	 * 
	 * @var string
	 */
	var $attachment = null ;
	/**
	 * Ordering of the event
	 *
	 * @var Int
	 */
	var $ordering = null ;	
	/**
	 * Published
	 *
	 * @var int
	 */
	var $published = null ;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_events', 'id', $db);
	}
}
/**
 * Field Table Class
 *
 */
class FieldEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;	
	/**
	 * Event ID
	 *
	 * @var int
	 */
	var $event_id = null ;
	/**
	 * Name of the field
	 *
	 * @var string
	 */
	var $name = null ;	
	/**
	 * Field title
	 *
	 * @var varchar
	 */
	var $title = null ;
	/**
	 * Description of field
	 *
	 * @var string
	 */
	var $description = null ;
	/**
	 * Field type
	 *
	 * @var tinyint
	 */
	var $field_type = null ;	
	/**
	 * Field is required or not
	 *
	 * @var tinyint
	 */
	var $required = null ;
	/**
	 * Values of fields, used for dropdown and radio list
	 *
	 * @var text
	 */
	var $values = null ;
	/**
	 * Selected values, used for dropdown and radio list
	 *
	 * @var text
	 */
	var $default_values = null ;
	/**
	 * Notification email body
	 *
	 * @var string
	 */
	var  $fee_field =  null ;
	/**
	 * Fee values
	 *
	 * @var string
	 */
	var $fee_values =  null ;
	/**
	 * Fee formular
	 *
	 * @var string
	 */
	var $fee_formula = null ;
	/**
	 * Display in
	 *
	 * @var int
	 */
	var $display_in = null ;
	/**
	 * Rows for textarea
	 *
	 * @var int
	 */
	var $rows = null ;	
	/**
	 * Cols for textarea
	 *
	 * @var int
	 */
	var $cols = null ;
	/**
	 * Size for textbox
	 *
	 * @var int
	 */
	var $size = null ;
	/**
	 * Css class 
	 *
	 * @var string
	 */
	var $css_class = null ;
	/**
	 * Field mapping
	 *
	 * @var string
	 */
	var $field_mapping = null ;
	/**
	 * Ordering of the field
	 *
	 * @var int
	 */
	var $ordering = null ;
	
	/**
	 * Published
	 *
	 * @var int
	 */
	var $published = null ;		
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_fields', 'id', $db);
	}
}
/**
 * Registrant Event Booking
 *
 */
class RegistrantEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = 0;
	/**
	 * Event ID
	 *
	 * @var int
	 */
	var $event_id = 0 ;
	/**
	 * Registrant Group ID
	 *
	 * @var Int
	 */
	var $group_id = 0 ;
	/**
	 * Card ID in case users register for multiple events
	 *
	 * @var int
	 */
	var $cart_id = 0 ;

	var $first_name = null ;
	
	var $last_name = null ;
	
	var $organization = null ;
	
	var $address = null ;
	
	var $address2 = null ;
	
	var $city = null ;
	
	var $state = null ;

	var $zip = null ;
	
	var $country = null ;
	
	var $phone = null ;
	
	var $fax = null ;
	
	var $email = null ;
			
	var $number_registrants = null ;
	
	var $total_amount = null ;
	
	var $discount_amount =  null ;
	
	var $deposit_amount = null ;
	
	var $amount = null ;
	
	var $coupon_id = null ;
	
	var $register_date = null ;
	
	var $payment_date = null ;
	
	var $payment_method = null ;
	
	var $registration_code = null ;
	
	var $transaction_id = null ;
		
	var $comment =  null ;
    /**
     * Payment Status
     * 
     * @var Tinyint
     */
	var $payment_status = null ;	
	/**
	 * Published
	 *
	 * @var int
	 */
	var $published = null ;
	/**
	 * 
	 * Tax amount
	 * @var Decimal 
	 */
	var $tax_amount = null ;
	/**
	 * Is Group Billing ?
	 * @var Tinyint
	 */
	var $is_group_billing =  0 ;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_registrants', 'id', $db);
	}
}
/**
 * Category Table Class
 *
 */
class CategoryEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/**
	 * Parent Category
	 *
	 * @var int
	 */
	var $parent = null ;
	/**
	 * Category Name
	 *
	 * @var String
	 */
	var $name = null ;	
	/**
	 * Category Description
	 *
	 * @var String
	 */
	var $description = null ;
	/**
	 * Choose layout for this category
	 *
	 * @var string
	 */
	var $layout = null ;
	/**
	 * Access permission
	 *
	 * @var Tinyint
	 */
	var $access = null ;
	/**
	 * Category Ordering
	 *
	 * @var Int
	 */
	var $ordering =  null ;	
	/**
	 * Published
	 *
	 * @var int
	 */
	var $published = null ;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_categories', 'id', $db);
	}
}
/**
 * Location Table Class
 *
 */
class LocationEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/**
	 * Location name
	 *
	 * @var string
	 */
	var $name = null ;
	/**
	 * Address
	 *
	 * @var String
	 */
	var $address = null ;	
	/**
	 * City
	 *
	 * @var String
	 */
	var $city = null ;
	/**
	 * State
	 *
	 * @var string
	 */
	var $state =  null ;
	/**
	 * Zip
	 *
	 * @var string
	 */
	var $zip = null ;
	/**
	 * Var country
	 *
	 * @var string
	 */
	var $country = null ;
	/**
	 * Latitude
	 *
	 * @var unknown_type
	 */	
	var $lat = null ;
	/**
	 * Longitude
	 *
	 * @var decimal
	 */
	var $long = null ;
	/**
	 * Published
	 *
	 * @var int
	 */
	var $published = null ;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_locations', 'id', $db);
	}
}
/**
 * Plugin table class
 *
 */
class PluginEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null ;
	/**
	 * name
	 *
	 * @var string
	 */
	var $name = null;		
	/**
	 * Title of the image
	 *
	 * @var string
	 */
	var $title = null;
	/**
	 * Author of the plugin
	 *
	 * @var string
	 */
	var $author = null ;	
	/**
	 * Creation Date
	 *
	 * @var string
	 */
	var $creation_date = null ;
	/**
	 * Copyright
	 *
	 * @var string
	 */
	var $copyright = null ;
	/**
	 * License
	 *
	 * @var string
	 */
	var $license = null;
	/**
	 * Author email
	 *
	 * @var string
	 */
	var $author_email =  null;
	/**
	 * Authro url
	 *
	 * @var string
	 */
	var $author_url = null;
	/**
	 * Plugin version
	 *
	 * @var string
	 */
	var $version =  null;
	/**
	 * Description
	 *
	 * @var string
	 */
	var $description = null;
	/**
	 * Plugin parameters
	 *
	 * @var string
	 */
	var $params = null;	
	/**
	 * Plugin ordering
	 *
	 * @var int
	 */
	var $ordering = null ;
	/**
	 * Published
	 *
	 * @var tinyint
	 */	
	var $published = 0;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_payment_plugins', 'id', $db);
	}
}
/**
 * Coupon Table
 *
 */	
class CouponEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/**
	 * coupon code
	 *
	 * @var string
	 */
	var $code = null ;
	/**
	 * type coupon
	 *
	 * @var int
	 */
	var $coupon_type = null ;	
	/**
	 *  Discount coupon
	 *
	 * @var int
	 */	
	var $discount = null ;
	/**
	 * Event ID
	 *
	 * @var string
	 */
	var $event_id = null ;
	/**
	 * times max use
	 *
	 * @var string
	 */
	var $times = null ;
	/**
	 * times used 
	 *
	 * @var string
	 */
	var $used = null;
	/**
	 * Valid from date
	 *
	 * @var DateTime
	 */
	var $valid_from = null ;
	/**
	 * Valid to date
	 * @var DateTime
	 */
	var $valid_to = null ;
	/**
	 * Published status
	 *
	 * @var tinyint
	 */
	var $published = 0 ;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_coupons', 'id', $db);
	}
}
/**
 * Event Table Class
 *
 */
class ConfigEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;		
	/**
	 * 
	 * Config key
	 * @var string
	 */
	var $config_key = null ;
	/**
	 * Config value	 
	 * @var string
	 */
	var $config_value = null ;	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_configs', 'id', $db);
	}
}
/**
 * Waiting list table class
 *
 */
class WaitingListEventBooking extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/**
	 * User ID
	 * 
	 * @var int
	 */
	var $user_id = null ;
	/**
	 * Event ID
	 * 
	 * @var int
	 */
	var $event_id = null ;
    /**
     * First Name
     * 
     * @var string
     */    
	var $first_name = null ;
	/**
	 * Last Name
	 * 
	 * @var string
	 */
	var $last_name = null ;
	/**
	 * Organization
	 * 
	 * @var string
	 */
	var $organization = null ;
    /**
     * Address
     * 
     * @var string
     */
	var $address = null ;
	/**
	 * Address 2
	 * 
	 * @var string
	 */
	var $address2 = null ;
	/**
	 * City
	 * 
	 * @var string
	 */
	var $city = null ;
	/**
	 * 
	 * State
	 * @var string
	 */
	var $state = null ;
	/**
	 * Country
	 * 
	 * @var string
	 */
	var $country = null ;
	/**
	 * Zip
	 * 
	 * @var string
	 */
	var $zip = null ;
	/**
	 * Phone
	 * 
	 * @var string
	 */
	var $phone = null ;
	/**
	 * Fax
	 * 
	 * @var string
	 */
	var $fax = null ;
    /**
     * Email
     * 
     * @var string 
     */
	var $email = null ;
	/**
	 * Number registrants
	 * @var int
	 */
	var $number_registrants = null ;
	/**
	 * Register Date
	 * 
	 * @var DateTime
	 */
	var $register_date = null ;
	/**
	 * Notified this user or not
	 * 
	 * @var string
	 */
	var $notified = 0 ;			
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.5
	 */
	function __construct(& $db) {
		parent::__construct('#__eb_waiting_lists', 'id', $db);
	}
}
