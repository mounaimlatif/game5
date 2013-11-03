<?php
/**
 * ------------------------------------------------------------------------
 * JA Accordion Module for J25 & J30
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
require_once (dirname(__FILE__) . DS . 'helpers' . DS . 'helper.php');
JHtml::_('behavior.framework', true);
$jaAccordionObj = new modJAAccordionHelper($params);
$jaAccordionObj->css($params);
$accordionData = $jaAccordionObj->getString($params);
$_plgCode = '#{jathumbnail(.*?)}#i';
for($i=0;$i<count($accordionData);$i++) {			
	$accordionData[$i]->introtext = (isset($accordionData[$i]->introtext))?JHtml::_('content.prepare', $accordionData[$i]->introtext, '', 'mod_jaaccordion.content'):'';
	$accordionData[$i]->content = (isset($accordionData[$i]->content))?JHtml::_('content.prepare', $accordionData[$i]->content, '', 'mod_jaaccordion.content'):'';
	$accordionData[$i]->introtext = preg_replace($_plgCode, '', $accordionData[$i]->introtext);
	$accordionData[$i]->content = preg_replace($_plgCode, '', $accordionData[$i]->content);
}
require ($jaAccordionObj->getLayoutPath('mod_jaaccordion'));