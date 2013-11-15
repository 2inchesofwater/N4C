<?php

/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: router.php 3261 2012-02-11 09:54:56Z geraintedwards $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */
defined('_JEXEC') or die('No Direct Access');

JLoader::register('JEVConfig', JPATH_ADMINISTRATOR . "/components/com_jevents/libraries/config.php");
JLoader::register('JEVHelper', JPATH_SITE . "/components/com_jevents/libraries/helper.php");

function JEventsBuildRoute(&$query)
{
	$params = JComponentHelper::getParams("com_jevents");

	$cfg = & JEVConfig::getInstance();
	$segments = array();

	// sometimes the task is not set but view and layout are so tackle this!
	if (!isset($query['task']) && isset($query['view']) && isset($query['layout']))
	{
		$query['task'] = $query['view'] . "." . $query['layout'];
	}
	// We don't need the view - its only used to manipulate parameters
	if (isset($query['view']))
	{
		unset($query['view']);
	}
	if (isset($query['layout']))
	{
		unset($query['layout']);
	}

	$task = false;
	$task = false;
	if (!isset($query['task']))
	{
		if (isset($query["Itemid"]))
		{
			$menu = & JSite::getMenu();
			$menuitem = $menu->getItem($query["Itemid"]);
			if (!is_null($menuitem) && isset($menuitem->query["task"]))
			{
				$task = $menuitem->query["task"];
				return $segments;
			}
			else if (!is_null($menuitem) && isset($menuitem->query["layout"]) && isset($menuitem->query["view"]))
			{
				$task = $menuitem->query["view"] . "." . $menuitem->query["layout"];
			}
		}
		if (!$task)
		{
			$task = 'month.calendar';
		}
	}
	else
	{
		$task = $query['task'];
		unset($query['task']);
	}

	// Translatable URLs
	if ($params->get("newsef", 0))
	{
		return JEventsBuildRouteNew($query, $task);
	}

	switch ($task) {
		case "year.listevents":
		case "month.calendar":
		case "week.listevents":
		case "day.listevents":
		case "cat.listevents":
		case "jevent.detail":
		case "icalevent.detail":
		case "icalrepeat.detail":
		case "search.form":
		case "search.results":
		case "admin.listevents": {
				$segments[] = $task;
				$config = & JFactory::getConfig();
				$t_datenow = JEVHelper::getNow();

				// if no date in the query then use TODAY not the calendar date
				$nowyear = JevDate::strftime('%Y', $t_datenow->toUnix(true));
				$nowmonth = JevDate::strftime('%m', $t_datenow->toUnix(true));
				$nowday = JevDate::strftime('%d', $t_datenow->toUnix(true));
				/*
				  $year	= intval( JRequest::getVar( 'year',	 $nowyear ));
				  $month	= intval( JRequest::getVar( 'month', $nowmonth ));
				  $day	= intval( JRequest::getVar( 'day',	 $nowday ));
				 */
				if (isset($query['year']))
				{
					$segments[] = $query['year'];
					unset($query['year']);
				}
				else
				{
					// if no date in the query then use TODAY not the calendar date
					$segments[] = $nowyear;
				}
				if (isset($query['month']))
				{
					$segments[] = $query['month'];
					unset($query['month']);
				}
				else
				{
					// if no date in the query then use TODAY not the calendar date
					$segments[] = $nowmonth;
				}
				if (isset($query['day']))
				{
					$segments[] = $query['day'];
					unset($query['day']);
				}
				else
				{
					// if no date in the query then use TODAY not the calendar date
					$segments[] = $nowday;
				}
				switch ($task) {
					case "jevent.detail":
					case "icalevent.detail":
					case "icalrepeat.detail":
						if (isset($query['jevtype']))
						{
							unset($query['jevtype']);
						}
						if (isset($query['evid']))
						{
							$segments[] = $query['evid'];
							unset($query['evid']);
						}
						else
						{
							$segments[] = "0";
						}
						/*
						  // Can we drop the use of uid?
						  if(isset($query['title'])) {
						  $segments[] = JFilterOutput::stringURLSafe($query['title']);
						  unset($query['title']);
						  }
						  else {
						  $segments[] = "-";
						  }
						 */

						break;
					default:
						break;
				}
				if (isset($query['catids']) && strlen($query['catids']) > 0)
				{
					$segments[] = $query['catids'];
					unset($query['catids']);
				}
				else
				{
					$segments[] = "-";
				}

				switch ($task) {
					case "icalrepeat.detail":
						if (isset($query['uid']))
						{
							// Some remote UIDs have @ and other dodgy characters in them so encode them for safety
							//$segments[] = base64_encode($query['uid']);
							unset($query['uid']);
						}
						if (isset($query['title']))
						{
							$segments[] = substr(JFilterOutput::stringURLSafe($query['title']), 0, 150);
							unset($query['title']);
						}
						else
						{
							$segments[] = "-";
						}

						break;
					default:
						break;
				}
			}
			break;
		case "jevent.edit":
		case "icalevent.edit":
		case "icalevent.publish":
		case "icalevent.unpublish":
		case "icalevent.editcopy":
		case "icalrepeat.edit":
		case "jevent.delete":
		case "icalevent.delete":
		case "icalrepeat.delete":
		case "icalrepeat.deletefuture":
			$segments[] = $task;
			if (isset($query['jevtype']))
			{
				unset($query['jevtype']);
			}
			if (isset($query['evid']))
			{
				$segments[] = $query['evid'];
				unset($query['evid']);
			}
			else
			{
				$segments[] = "0";
			}
			break;
		case "modlatest.rss":
			$segments[] = $task;
			// assume implicit feed document
			//unset($query['format']);
			// feed type
			if (isset($query['type']))
			{
				$segments[] = $query['type'];
				unset($query['type']);
			}
			else
			{
				$segments[] = 'rss';
			}

			// modid
			if (isset($query['modid']))
			{
				$segments[] = $query['modid'];
				unset($query['modid']);
			}
			else
			{
				$segments[] = "0";
			}

			break;
		case "icalrepeat.vcal":
		case "icalevent.vcal":
			$segments[] = $task;
			if (isset($query['evid']))
			{
				$segments[] = $query['evid'];
				unset($query['evid']);
			}
			else
			{
				$segments[] = "0";
			}
			if (isset($query['catids']))
			{
				$segments[] = $query['catids'];
				unset($query['catids']);
			}
			else
			{
				$segments[] = "0";
			}
			break;

		default:
			$segments[] = $task;
			$segments[] = "-";
			break;
	}


	return $segments;

}

function JEventsParseRoute($segments)
{
	$vars = array();

	static $translatedTasks = false;
	if (!$translatedTasks)
	{

		// Must also load backend language files
		$lang = & JFactory::getLanguage();
		$lang->load("com_jevents", JPATH_SITE);

		$translatedTasks = array();
		$tasks = array(
			"year.listevents",
			"month.calendar",
			"week.listevents",
			"day.listevents",
			"cat.listevents",
			"jevent.detail",
			"icalevent.detail",
			"icalrepeat.detail",
			"search.form",
			"search.results",
			"admin.listevents",
			"jevent.edit",
			"icalevent.edit",
			"icalevent.publish",
			"icalevent.unpublish",
			"icalevent.editcopy",
			"icalrepeat.edit",
			"jevent.delete",
			"icalevent.delete",
			"icalrepeat.delete",
			"icalrepeat.deletefuture",
			"modlatest.rss",
			"icalrepeat.vcal",
			"icalevent.vcal");

		foreach ($tasks as $tt)
		{
			$translatedTasks[translatetask($tt)] = $tt;
			// backup for sites that hadn't translated but now have
			$translatedTasks[str_replace(".", "_", $tt)] = $tt;
		}
	}

	//Get the active menu item
	$menu = & JSite::getMenu();
	$item = & $menu->getActive();

	// Count route segments
	$count = count($segments);

	if ($count > 0)
	{
		// task
		$task = $segments[0];

		$newsef = false;
		if (array_key_exists($task, $translatedTasks))
		{
			$task = $translatedTasks[$task];
			return JEventsParseRouteNew($segments, $task);
		}
		$vars["task"] = $task;

		switch ($task) {
			case "year.listevents":
			case "month.calendar":
			case "week.listevents":
			case "day.listevents":
			case "cat.listevents":
			case "jevent.detail":
			case "icalevent.detail":
			case "icalrepeat.detail":
			case "view_cat":
				if (strpos($task, "jevent") === 0)
				{
					$vars['jevtype'] = "jevent";
				}
				else if (strpos($task, "icalevent") === 0)
				{
					$vars['jevtype'] = "icaldb";
				}
				if ($count > 1)
				{
					$vars['year'] = $segments[1];
				}
				if ($count > 2)
				{
					$vars['month'] = $segments[2];
				}
				if ($count > 3)
				{
					$vars['day'] = $segments[3];
				}
				if ($count > 4)
				{
					switch ($task) {
						case "jevent.detail":
						case "icalevent.detail":
						case "icalrepeat.detail":
							$vars['evid'] = $segments[4];
							// note that URI decoding swaps /-/ for :
							if (count($segments) > 5 && $segments[5] != ":")
							{
								$vars['catids'] = $segments[5];
							}
							break;
						default:
							// note that URI decoding swaps /-/ for :
							if ($segments[4] != ":")
							{
								$vars['catids'] = $segments[4];
							}
							break;
					}
				}
				if ($count > 6)
				{
					switch ($task) {
						case "icalrepeat.detail":
							//$vars['uid'] = base64_decode($segments[6]);
							break;
						default:
							break;
					}
				}
				break;
			case "jevent.edit":
			case "icalevent.editcopy":
			case "icalevent.edit":
			case "icalevent.publish":
			case "icalevent.unpublish":
			case "icalrepeat.edit":
			case "icalevent.delete":
			case "icalrepeat.delete":
			case "icalrepeat.deletefuture":
				if ($count > 1)
				{
					$vars['evid'] = $segments[1];
				}
				break;
			case "modlatest.rss":
				// URI = /task/feedtype/modid
				// force JDocumentFeed
				$vars['format'] = 'feed';
				//feed type
				if ($count > 1)
				{
					$vars['type'] = $segments[1];
				}
				else
				{
					$vars['type'] = "rss";
				}
				// modid
				if ($count > 2)
				{
					$vars['modid'] = $segments[2];
				}
				else
				{
					$vars['modid'] = "0";
				}
				break;

			case "icalrepeat.vcal":
			case "icalevent.vcal":
				if ($count > 1)
				{
					$vars['evid'] = $segments[1];
				}
				else
				{
					$vars['evid'] = "0";
				}
				// modid
				if ($count > 2)
				{
					$vars['catids'] = $segments[2];
				}
				else
				{
					$vars['catids'] = "0";
				}
				break;

			default:
				break;
		}
	}
	return $vars;

}

function JEventsBuildRouteNew(&$query, $task)
{
	$transtask = translatetask($task);

	$params = JComponentHelper::getParams("com_jevents");

	$cfg = & JEVConfig::getInstance();
	$segments = array();

	switch ($task) {
		case "year.listevents":
		case "month.calendar":
		case "week.listevents":
		case "day.listevents":
		case "cat.listevents":
		case "jevent.detail":
		case "icalevent.detail":
		case "icalrepeat.detail":
		case "search.form":
		case "search.results":
		case "admin.listevents": {
				$segments[] = $transtask;
				$config = & JFactory::getConfig();
				$t_datenow = JEVHelper::getNow();

				// if no date in the query then use TODAY not the calendar date
				$nowyear = JevDate::strftime('%Y', $t_datenow->toUnix(true));
				$nowmonth = JevDate::strftime('%m', $t_datenow->toUnix(true));
				$nowday = JevDate::strftime('%d', $t_datenow->toUnix(true));

				if (isset($query['year']))
				{
					$year = $query['year'];					
					unset($query['year']);
				}
				else
				{
					$year = $nowyear;
				}

				if (isset($query['month']))
				{
					$month = $query['month'];
					if (is_numeric($month)){
						$month=intval($month);
					}
					unset($query['month']);
				}
				else
				{
					$month = $nowmonth;
				}

				if (isset($query['day']))
				{
					$day = $query['day'];
					if (is_numeric($day)){
						$day=intval($day);
					}
					unset($query['day']);
				}
				else
				{
					// if no date in the query then use TODAY not the calendar date
					$day = $nowday;
				}

				// for week data always go to the start of the week
				if ($task == "week.listevents")
				{
					$startday = $cfg->get('com_starday');
					if ((!$startday ) || ( $startday > 1 ))
					{
						$startday = 0;
					}
					$date = mktime(5, 5, 5, $month, $day, $year);
					$currentday = strftime("%w", $date);
					if ($currentday > $startday)
					{
						$date -= ($currentday - $startday) * 86400;
						list($year, $month, $day) = explode("-", strftime("%Y-%m-%d", $date));
					}
					else if ($currentday < $startday)
					{
						$date -= (7 + $currentday - $startday) * 86400;
						list($year, $month, $day) = explode("-", strftime("%Y-%m-%d", $date));
					}
				}

				// only include the year in the date and list views
				if (in_array($task, array("year.listevents", "month.calendar", "week.listevents", "day.listevents")))
				{
					$segments[] = $year;
				}

				// only include the month in the date and list views (excluding year)
				if (in_array($task, array("month.calendar", "week.listevents", "day.listevents")))
				{
					$segments[] = $month;
				}

				// only include the day in the week and day views (excluding year and month)
				if (in_array($task, array("week.listevents", "day.listevents")))
				{
					$segments[] = $day;
				}

				switch ($task) {
					case "jevent.detail":
					case "icalevent.detail":
					case "icalrepeat.detail":
						if (isset($query['jevtype']))
						{
							unset($query['jevtype']);
						}
						if (isset($query['evid']))
						{
							$segments[] = $query['evid'];
							unset($query['evid']);
						}
						else
						{
							$segments[] = "0";
						}

						break;
					default:
						break;
				}
				if (isset($query['catids']) && strlen($query['catids']) > 0)
				{
					$segments[] = $query['catids'];
					unset($query['catids']);
				}
				else
				{
					$segments[] = "-";
				}

				switch ($task) {
					case "icalrepeat.detail":
						if (isset($query['uid']))
						{
							// Some remote UIDs have @ and other dodgy characters in them so encode them for safety
							//$segments[] = base64_encode($query['uid']);
							unset($query['uid']);
						}
						if (isset($query['title']))
						{
							$segments[] = substr(JFilterOutput::stringURLSafe($query['title']), 0, 150);
							unset($query['title']);
						}
						else
						{
							$segments[] = "-";
						}

						break;
					default:
						break;
				}
			}
			break;
		case "jevent.edit":
		case "icalevent.edit":
		case "icalevent.publish":
		case "icalevent.unpublish":
		case "icalevent.editcopy":
		case "icalrepeat.edit":
		case "jevent.delete":
		case "icalevent.delete":
		case "icalrepeat.delete":
		case "icalrepeat.deletefuture":
			$segments[] = $transtask;
			if (isset($query['jevtype']))
			{
				unset($query['jevtype']);
			}
			if (isset($query['evid']))
			{
				$segments[] = $query['evid'];
				unset($query['evid']);
			}
			else
			{
				$segments[] = "0";
			}
			break;
		case "modlatest.rss":
			$segments[] = $transtask;
			// assume implicit feed document
			//unset($query['format']);
			// feed type
			if (isset($query['type']))
			{
				$segments[] = $query['type'];
				unset($query['type']);
			}
			else
			{
				$segments[] = 'rss';
			}

			// modid
			if (isset($query['modid']))
			{
				$segments[] = $query['modid'];
				unset($query['modid']);
			}
			else
			{
				$segments[] = "0";
			}

			break;
		case "icalrepeat.vcal":
		case "icalevent.vcal":
			$segments[] = $transtask;
			if (isset($query['evid']))
			{
				$segments[] = $query['evid'];
				unset($query['evid']);
			}
			else
			{
				$segments[] = "0";
			}
			if (isset($query['catids']))
			{
				$segments[] = $query['catids'];
				unset($query['catids']);
			}
			else
			{
				$segments[] = "0";
			}
			break;

		default:
			$segments[] = $transtask;
			$segments[] = "-";
			break;
	}


	return $segments;

}

function JEventsParseRouteNew(&$segments, $task)
{
	$vars = array();

	$vars["task"] = $task;

	// Count route segments
	$count = count($segments);
	$slugcount = 1;

	switch ($task) {
		case "year.listevents":
		case "month.calendar":
		case "week.listevents":
		case "day.listevents":
		case "cat.listevents":
		case "jevent.detail":
		case "icalevent.detail":
		case "icalrepeat.detail":
		case "view_cat":
			if (strpos($task, "jevent") === 0)
			{
				$vars['jevtype'] = "jevent";
			}
			else if (strpos($task, "icalevent") === 0)
			{
				$vars['jevtype'] = "icaldb";
			}
			// only include the year in the date and list views
			if (in_array($task, array("year.listevents", "month.calendar", "week.listevents", "day.listevents")))
			{
				if ($count > $slugcount)
				{
					$vars['year'] = $segments[1];
				}
				$slugcount++;
			}

			// only include the month in the date and list views (excluding year)
			if (in_array($task, array("month.calendar", "week.listevents", "day.listevents")))
			{
				if ($count > $slugcount)
				{
					$vars['month'] = $segments[2];
				}
				$slugcount++;
			}

			// only include the day in the week and day views (excluding year and month)
			if (in_array($task, array("week.listevents", "day.listevents")))
			{
				if ($count > $slugcount)
				{
					$vars['day'] = $segments[3];
				}
				$slugcount++;
			}

			if ($count > $slugcount)
			{
				switch ($task) {
					case "jevent.detail":
					case "icalevent.detail":
					case "icalrepeat.detail":
						$vars['evid'] = $segments[$slugcount];
						// note that URI decoding swaps /-/ for :
						if (count($segments) > $slugcount + 1 && $segments[$slugcount + 1] != ":")
						{
							$vars['catids'] = $segments[$slugcount + 1];
						}
						break;
					default:
						// note that URI decoding swaps /-/ for :
						if ($segments[$slugcount] != ":")
						{
							$vars['catids'] = $segments[$slugcount];
						}
						break;
				}
			}
			break;
		case "jevent.edit":
		case "icalevent.editcopy":
		case "icalevent.edit":
		case "icalevent.publish":
		case "icalevent.unpublish":
		case "icalrepeat.edit":
		case "icalevent.delete":
		case "icalrepeat.delete":
		case "icalrepeat.deletefuture":
			if ($count > 1)
			{
				$vars['evid'] = $segments[1];
			}
			break;
		case "modlatest.rss":
			// URI = /task/feedtype/modid
			// force JDocumentFeed
			$vars['format'] = 'feed';
			//feed type
			if ($count > 1)
			{
				$vars['type'] = $segments[1];
			}
			else
			{
				$vars['type'] = "rss";
			}
			// modid
			if ($count > 2)
			{
				$vars['modid'] = $segments[2];
			}
			else
			{
				$vars['modid'] = "0";
			}
			break;

		case "icalrepeat.vcal":
		case "icalevent.vcal":
			if ($count > 1)
			{
				$vars['evid'] = $segments[1];
			}
			else
			{
				$vars['evid'] = "0";
			}
			// modid
			if ($count > 2)
			{
				$vars['catids'] = $segments[2];
			}
			else
			{
				$vars['catids'] = "0";
			}
			break;

		default:
			break;
	}

	return $vars;

}

function translatetask($task)
{
	$tasks = array(
		"year.listevents",
		"month.calendar",
		"week.listevents",
		"day.listevents",
		"cat.listevents",
		"jevent.detail",
		"icalevent.detail",
		"icalrepeat.detail",
		"search.form",
		"search.results",
		"admin.listevents",
		"jevent.edit",
		"icalevent.edit",
		"icalevent.publish",
		"icalevent.unpublish",
		"icalevent.editcopy",
		"icalrepeat.edit",
		"jevent.delete",
		"icalevent.delete",
		"icalrepeat.delete",
		"icalrepeat.deletefuture",
		"modlatest.rss",
		"icalrepeat.vcal",
		"icalevent.vcal");

	if (!in_array($task, $tasks))
		return $task;
	// if not translated then just drop the . and use _ instead
	$task = str_replace(".", "_", $task);
	$transtask = JText::_("JEV_SEF_" . $task);
	$transtask = strpos($transtask, "JEV_SEF_") === 0 ? $task : $transtask;
	return $transtask;

}