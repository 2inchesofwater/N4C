CREATE TABLE IF NOT EXISTS `#__m4j_captcha` (
  `date` timestamp NOT NULL,
  `user` varchar(64) NOT NULL,
  `captcha` varchar(64) NOT NULL,
  `dead` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`user`)
)DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__m4j_category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `alias` varchar(80) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `email` varchar(100) DEFAULT NULL,
  `introtext` text,
  `sort_order` int(11) DEFAULT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
)DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__m4j_config` (
  `key` varchar(64) NOT NULL,
  `value` text,
  `type` varchar(64) NOT NULL,
  `namespace` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`key`)
)DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__m4j_formelements` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `required` tinyint(4) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `usermail` tinyint(4) DEFAULT '0',
  `align` tinyint(4) DEFAULT '0',
  `question` text NOT NULL,
  `form` int(11) NOT NULL,
  `parameters` text,
  `options` text,
  `help` text,
  `html` text,
  `slot` tinyint(4) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `alias` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`eid`)
)DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__m4j_forms` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` text,
  `question_width` tinytext,
  `answer_width` tinytext,
  `use_help` tinyint(4) DEFAULT '1',
  `layout` varchar(64) NOT NULL DEFAULT 'layout01',
  `layout_data` text,
  `public` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`fid`)
)DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__m4j_jobs` (
  `jid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `alias` varchar(80) DEFAULT NULL,
  `hidden` text,
  `introtext` text,
  `maintext` text,
  `active` tinyint(4) DEFAULT NULL,
  `fid` text,
  `cid` int(11) DEFAULT '-1',
  `email` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `text_confirm_only` tinyint(4) NOT NULL DEFAULT '1',
  `captcha` tinyint(4) DEFAULT '1',
  `sort_order` int(11) DEFAULT NULL,
  `public` tinyint(4) DEFAULT '1',
  `process` tinyint(4) DEFAULT '0',
  `confirmation` tinyint(4) NOT NULL DEFAULT '0',
  `aftersending` tinyint(4) NOT NULL DEFAULT '0',
  `redirect` varchar(200) DEFAULT NULL,
  `custom_text` text,
  `code1` text,
  `code2` text,
  `is_paypal` tinyint(4) NOT NULL DEFAULT '0',
  `is_sandbox` tinyint(4) NOT NULL DEFAULT '0',
  `paypal` text,
  `db` text,
  `access` int(11) NOT NULL DEFAULT '0',
  `data_listing_confirmation` tinyint(4) NOT NULL DEFAULT '1',
  `data_listing` tinyint(4) NOT NULL DEFAULT '1',
  `is_optin` tinyint(4) DEFAULT '0',
  `optin_params` text,
  PRIMARY KEY (`jid`)
)DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__m4j_sef` (
  `jid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `url` varchar(192) DEFAULT NULL,
  PRIMARY KEY (`jid`,`cid`)
)DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__m4j_apps` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `app` varchar(120) NOT NULL,
  `has_admin_view` tinyint(4) NOT NULL DEFAULT '0',
  `has_view` tinyint(4) NOT NULL DEFAULT '0',
  `has_plugin` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created` date DEFAULT NULL,
  `info` text NOT NULL,
  `admin_params` text,
  PRIMARY KEY (`aid`),
  KEY `app` (`app`)
)DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__m4j_apps2jobs` (
  `jid` int(11) NOT NULL,
  `app` varchar(120) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`jid`,`app`),
  KEY `aid` (`app`),
  KEY `jid` (`jid`)
)DEFAULT CHARSET=utf8;

