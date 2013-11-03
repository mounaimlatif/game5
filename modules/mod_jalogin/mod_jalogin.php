<?php
/**
 * ------------------------------------------------------------------------
 * JA Login module for J25 & J30
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
if(!defined('DS')){
	define('DS', DIRECTORY_SEPARATOR);
}
// Include the syndicate functions only once
require_once (dirname(__FILE__) . DS . 'helper.php');
$mainframe = JFactory::getApplication();
$params->def('greeting', 1);

$type = modJALoginHelper::getType();
$return = modJALoginHelper::getReturnURL($params, $type);

$user = JFactory::getUser();

$captchatext = "";
if(JRequest::getCmd('option') !== "com_users" || JRequest::getCmd('view') !== "registration"){
	JForm::addFormPath(JPATH_SITE."/components/com_users/models/forms");
	$form = JForm::getInstance('com_users.registration',"registration", array('control' => 'jform'), false, false);
	$captcha = $form->getField("captcha");
	$captchatext = $captcha->input;

}

//Add css
JHTML::stylesheet('modules/' . $module->module . '/assets/style.css');
if (is_file(JPATH_SITE . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'css' . DS . $module->module . ".css")){
    JHTML::stylesheet('templates/' . $mainframe->getTemplate() . '/css/' . $module->module . '.css');
}

//Add js
JHTML::script('modules/' . $module->module . '/assets/script.js');

require (JModuleHelper::getLayoutPath('mod_jalogin'));