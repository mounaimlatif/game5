<?php
/**
 * ------------------------------------------------------------------------
 * JA Content Popup Module for J25 & J30
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

$jacppath = dirname(__FILE__);
$jacpurl = JURI::base(true) . '/modules/mod_jacontentpopup';

require_once ($jacppath . '/helpers/helper.php');
require_once JPATH_SITE . '/components/com_content/helpers/route.php';

if (version_compare(JVERSION, '3.0', 'ge')) {
	JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models');
} else {
	JModel::addIncludePath(JPATH_SITE . '/components/com_content/models');
}

$adapters = JFolder::files($jacppath . '/helpers/adapter', '.php');
if (count($adapters)) {
    foreach ($adapters as $adapter) {
		require_once ($jacppath . '/helpers/adapter/' . $adapter);
    }
}

$mainframe = JFactory::getApplication();
$document  = JFactory::getDocument();

JHTML::_('behavior.framework', true);
JHTML::_('behavior.modal');

if(!defined('JACP_ASSETS')){
	define('JACP_ASSETS', 1);

	JHTML::stylesheet('modules/'.$module->module.'/assets/css/style.css');

	if (is_file(JPATH_SITE .'/templates/' . $mainframe->getTemplate() . '/css/' . $module->module . '.css')){
		JHTML::stylesheet('templates/' . $mainframe->getTemplate() . '/css/' . $module->module . '.css');
	}
	JHTML::stylesheet('modules/'.$module->module.'/assets/css/yoxview.css'); 

	JHTML::script('modules/'.$module->module.'/assets/js/jquery.jbk.js');
	JHTML::script('modules/'.$module->module.'/assets/js/jquery-1.8.3.min.js');
	JHTML::script('modules/'.$module->module.'/assets/js/jquery.noconflict.js');
	JHTML::script('modules/'.$module->module.'/assets/js/yoxview-init.js');
	JHTML::script('modules/'.$module->module.'/assets/js/script.js'); 
}

$helper = new modJaNewsHelper($module,$params);

$source = $params->get('source', 'JANewsHelper');
/*Get layout*/
$layout = $params->get('layout', 'default');
/*Group by categories*/
$group  = $params->get('group_categories', 0);

$show_titles	= $params->get('show_titles', 1);
$show_introtext = $params->get('show_introtext', 1);
$anim_type		= $params->get('anim_type', 'jafade');
$show_nav_control = $params->get('show_nav_control', 0);
$show_paging 	= $params->get('show_paging', 1);
$show_popup		= $params->get('show_popup',1);
$jacphelper =  new $source();

$using_ajax = null;
$lists = null;

if ($group == 1){
	$lists = $jacphelper->getCategories($params,$helper);
}else {
	$lists = $jacphelper->getList($params,$helper);
}

if($lists){
	if($show_popup){
		$document->addScriptDeclaration('
			var jabaseurl = "'.JURI::base().'";
			$jacp(document).ready(function($){
				
				jarefs = function(modulesid){
					var refs = [];
					$(\'#ja-cp-\'+modulesid+\' .ja-cp-group.active\').find("a").each(function(){
						ref = $(this).attr("rel");
						if(ref && $(\'.\'+ref)){
						    refs.push(ref);
						}
						     
					});
					refs = $.unique(refs);
					return refs;
				};
				
				jayoxview'.$module->id.' = function(refs,modulesid){	    	
						$(\'#ja-cp-\'+modulesid+\' .\'+refs).yoxview({
							textLinksSelector:\'[rel="\'+refs+\'"]\',
							defaultDimensions: { iframe: { width: '.$params->get('iframewidth','500').',height:'.$params->get('iframeheight','500').' }},
							skin:\'ja_slideshow\'
						});
				};
				    
				jaloadyoxview = function(modulesid){
					refs = jarefs(modulesid);
					for(i=0;i<refs.length;i++){
						eval(eval("jayoxview"+modulesid)(refs[i],modulesid));	
					}
				};
				$jacp(document).ready(function($){
					jaloadyoxview("'.$module->id.'");	
				});	
			});
		');
	}
	$document->addScriptDeclaration('
			$jacp(document).ready(function($){
			    $(\'#ja-cp-' . $module->id . '\').jacp({
			    	baseurl: \'' . JURI::base() . '\',
			    	animation: \'' . $anim_type . '\',
			    	navButtons: \'' . $show_nav_control . '\'
			    });	
			});	
		');
	$pagination = $helper->getPagination($params, $module);
	
	require JModuleHelper::getLayoutPath('mod_jacontentpopup', $layout);
} else {
	return '';
}
?>