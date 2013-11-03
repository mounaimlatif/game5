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

echo '<iframe src="http://www.facebook.com/plugins/activity.php?'.$sFacebookQuery.'" scrolling="no" frameborder="0" class="'.$aParams['colorscheme'].'" style="allowTransparency:true; border:none; overflow:hidden; width:'.$aParams['width'].'px; height:'.$aParams['height'].'px;"></iframe>';
?>