<?php 
/**
 * ------------------------------------------------------------------------
 * JA Newsticker Module for J25 & J30
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */

/**
 * JA News Sticker module allows display of article's title from sections or categories. \
 * You can configure the setttings in the right pane. Mutiple options for animations are also added, choose any one.
 * If you are using this module on Teline III template, * then the default module position is "headlines".
 **/
  // no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * JAStArticles class
 */
class JAStArticles {

	/**
	 * @var string $condition;
	 *
	 * @access private
	 */
	var $conditons = '';
	
	/**
	 * @var string $order 
	 *
	 * @access private
	 */
	var $order = 'a.ordering';
	
	/**
	 * @var string $limit
	 *
	 * @access private
	 */
	var $limit  = '';
	
	/**
	 * get instanace of JAStArticles
	 */
	public static function getInstance(){
		static $__instance;
		if( !$__instance ){
			$__instance = new JAStArticles();
		}
		return $__instance;
	}
	
	/**
	 * get list articles follow setting configuration.
	 *
	 * @param JParameter $param
	 * @return array 
	 */ 
	function getListArticles( $params ){
		
	 	$db	    = JFactory::getDBO();
		
		$my = JFactory::getUser();

		$aid	= $my->get( 'aid', 0 );
		$date = JFactory::getDate();
		$now  = $date->toSql();
		
		$query 	= 	'SELECT a.*,cc.description as catdesc, cc.title as cattitle,' .
					' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
					' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":",cc.id,cc.alias) ELSE cc.id END as catslug'.
					 "\n FROM #__content AS a".
					' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
					 "\n WHERE a.state = 1".
					 "\n AND ( a.publish_up = " . $db->Quote( $db->getNullDate() ) . " OR a.publish_up <= " . $db->Quote( $now  ) . " )".
					 "\n AND ( a.publish_down = " . $db->Quote( $db->getNullDate() ) . " OR a.publish_down >= " . $db->Quote( $now  ) . " )".
					 ( ( !JFactory::getApplication()->getCfg( 'shownoauth' ) ) ? "\n AND a.access >= " . (int) $aid : '' );
					
		
		$query .=  $this->getCondition( $params );
		$query .= ' ORDER BY ' . $this->order;
		
		if( $this->limit ) {
			$query .=  ' LIMIT ' . $this->limit;
		}

		$db->setQuery($query);
		return $db->loadObjectlist();
	}
	
	/**
	 * get condition from setting configuration.
	 *
	 * @param JParameter $params
	 * @return string.
	 */
	function getCondition( $params ){
		$condition = '';
		if(  strtolower($params->get('using_mode')) == 'categories_selected' ){
			$categories = $params->get( 'category' , 0 );	
			
			$ids = $this->getIds( $categories );
			$ids_arr = explode(",",$ids);
			if($ids_arr[0]=="''"){
				$condition = "";
			}else{
				$condition = " AND cc.id IN($ids)";
			}			
		}  
		return $condition;		
	}
	
	/**
	 * parser options, helper for clause where sql.
	 *
	 * @string array $options
	 * @return string.
	 */
	function getIds( $options ){
		if( !is_array($options) ){
			return (int)$options;
		} else {
			return "'".implode( "','", $options  )."'";
		}		
	}
	
	/**
	 * add sort order sql
	 *
	 * @param string $order is article's field.
	 * @param string $mode is DESC or ASC
	 * @return JAStArticles.
	 */
	function setOrder( $order, $mode ){
		$this->order = ' a.'.$order . ' '. $mode;
		return $this;
	}
	
	/**
	 * add set limit sql
	 * 
	 * @param integer $limit.
	 * @return JAStArticles.
	 */
	function setLimit( $limit ){
		$this->limit = $limit; 
		return $this;
	}
}

?>