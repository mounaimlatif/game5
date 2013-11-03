<?php
/**
 * ------------------------------------------------------------------------
 * JA CountDown Module for J25
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

$mainframe = JFactory::getApplication();
$document  = JFactory::getDocument();

JHTML::_('behavior.framework', true);
JHTML::_('behavior.modal');

$custom_titles = $params->get('custom_titles','');

$custom_message = $params->get('custom_message','');

$jalayout = $params->get('jalayout','layout1');

if(!defined('JACD_ASSETS')){
	define('JACD_ASSETS', 1);
	
	JHTML::script('modules/'.$module->module.'/assets/js/jquery.jbk.js');
	
	JHTML::script('modules/'.$module->module.'/assets/js/jquery-1.8.0.min.js');
	
	JHTML::script('modules/'.$module->module.'/assets/js/jquery.noconflict.js');	
	
	JHTML::script('modules/'.$module->module.'/tmpl/'.$jalayout.'/js/jacclock.js');
	
	JHTML::stylesheet('modules/'.$module->module.'/tmpl/'.$jalayout.'/css/jacclock.css');
	
	JHTML::stylesheet('modules/'.$module->module.'/assets/css/style.css');

	if (is_file(JPATH_SITE .'/templates/' . $mainframe->getTemplate() . '/css/' . $module->module . '.css')){
		JHTML::stylesheet('templates/' . $mainframe->getTemplate() . '/css/' . $module->module . '.css');
	}
	
	$startDate  = strtotime($params->get('jastartDate'));
   
	$endDate    = strtotime($params->get('jaendDate'));
	
	$secondsColor    = "#".$params->get('secondsColor','ffdc50');
	
	$minutesColor    = "#".$params->get('minutesColor','9cdb7d');
	
	$hoursColor    = "#".$params->get('hoursColor','378cff');
	
	$daysColor    = "#".$params->get('daysColor','ff6565');
	
	$secondsGlow = "#".$params->get('secondsGlow','ffdc50');
	
	
	$document->addScriptDeclaration('
		var jacdsecondsColor = "'.$secondsColor.'";
		var jacdminutesColor = "'.$minutesColor.'";
		var jacdhoursColor = "'.$hoursColor.'";
		var jacddaysColor = "'.$daysColor.'";
		
		var jacdsecondsGlow = "'.$secondsGlow.'";
		
		var jacdstartDate = "'.$startDate.'";
		var jacdendDate = "'.$endDate.'";
		var jacdnow = "'.strtotime('now').'";
		var jacdseconds = "'.date('s').'";
	');
}

require JModuleHelper::getLayoutPath('mod_jacountdown', $params->get('layout', 'default'));

?>