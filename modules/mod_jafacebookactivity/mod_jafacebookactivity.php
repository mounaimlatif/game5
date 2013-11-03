<?php
/**
 * ------------------------------------------------------------------------
 * JA Facebook Activity Module for J25 & J30
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */

// no direct access
defined('_JEXEC') or die('Restricted accessd');

global $mainframe;

// using setting params
$aParams['site'] = $params->get('site', 'joomlart.com');
$aParams['width'] = $params->get('width', 300);
$aParams['height'] = $params->get('height', 400);
$aParams['header'] = ($params->get('header', 1)) ? 'true' : 'false';
$aParams['colorscheme'] = $params->get('colorscheme', 'light');
$aParams['font'] = $params->get('font', '');
$aParams['border_color'] = $params->get('border_color', '');
$aParams['recommendations'] = ($params->get('recommendations', 0)) ? 'true' : 'false';

$sFacebookQuery = '';
foreach ($aParams as $key => $value) {
    $sFacebookQuery .= "{$key}={$value}&amp;";
}

require (JModuleHelper::getLayoutPath('mod_jafacebookactivity'));
?>