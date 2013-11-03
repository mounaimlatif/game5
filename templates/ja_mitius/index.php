<?php
// no direct access
defined('_JEXEC') or die;

//check if jaT3 plugin is existed
if(!defined('T3')){
	throw new Exception(JText::_('T3_MISSING_T3_PLUGIN'));
}

$T3 = T3::getApp($this);

// get configured layout
$layout = $T3->getLayout();

$T3->loadLayout ($layout);
