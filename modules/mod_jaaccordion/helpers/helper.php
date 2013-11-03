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

require_once JPATH_SITE . '/modules/mod_jaaccordion/helpers/adapter/content.php';
require_once JPATH_SITE . '/modules/mod_jaaccordion/helpers/adapter/modules.php';
/**
 *
 * Mod JA Accordion helper class
 * @author JA
 *
 */
class modJAAccordionHelper
{
    /**
     * The data for display
     *
     **/
    var $_data = null;


    /**
     *
     * Get data for accordion module and process them before display
     * @return array
     */
    function getString(&$params)
    {
        $this->_data = array();
        switch ($params->get('type', '')) {
            case "modules":
                $this->getModulesPosition($params);
                break;
            case "module":
                $this->getModulesIds($params);
                break;
            case "articlesIDs":
                $this->getArticlesIds($params);
                break;
            case "categoryIDs":
                $this->getArticlesCatids($params);
                break;
        }

        return $this->_data;
    }


    /**
     *
     * Get module list from position module
     * @param object $params
     * @return array
     */
    private function getModulesPosition(&$params)
    {
        $modules = new modulesAdapter();
        $this->_data = $modules->getModulesPosition($params->get('modules-position', ''), $params);
    }


    /**
     *
     * Get module list from list module ids
     * @param object $params
     * @return array
     */
    private function getModulesIds(&$params)
    {
        $modules = new modulesAdapter();
        $this->_data = $modules->getModulesIds($params->get('module-ids', array()), $params);
    }


    /**
     *
     * Get articles list from list articles id
     * @param object $params
     * @return array
     */
    private function getArticlesIds(&$params)
    {
        $articles = new articlesAdapter();
        $this->_data = $articles->getArticles(explode(',', $params->get('artIDs', '')), null, $params);
    }


    /**
     *
     * Get articles list from list categories id
     * @param object $params
     * @return array
     */
    private function getArticlesCatids(&$params)
    {
        $articles = new articlesAdapter();
        $this->_data = $articles->getArticles(null, $params->get('catids'), $params);
    }


    /**
     * load css files: processing override css
     */
    public function css($params)
    {

        $mainframe = JFactory::getApplication();

        $document =  JFactory::getDocument();

        $cssFile = 'mod_jaaccordion.css';
        if (file_exists(JPATH_SITE . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'css' . DS . $cssFile)) {
            $document->addStyleSheet(JURI::base() . 'templates/' . $mainframe->getTemplate() . '/css/' . $cssFile);
        } else {
            $document->addStyleSheet(JURI::base() . 'modules/mod_jaaccordion/assets/css/style.css');
        }
    }


    /**
     * check overrider layout.
     */
    public function getLayoutPath($module, $layout = 'default')
    {

        $mainframe = JFactory::getApplication();

        // Build the template and base path for the layout
        $tPath = JPATH_BASE . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'html' . DS . $module . DS . $layout . '.php';
        $bPath = JPATH_BASE . DS . 'modules' . DS . $module . DS . 'tmpl' . DS . $layout . '.php';

        // If the template has a layout override use it
        if (file_exists($tPath)) {
            return $tPath;
        } else {
            return $bPath;
        }
    }

}
?>
