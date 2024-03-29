<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!-- FOOTER -->
<footer id="ja-footer" class="wrap ja-footer">

  <!-- FOOT NAVIGATION -->
<?php if ($this->checkSpotlight('footnav', 'footer-1, footer-2, footer-3')) : ?>
<!-- SPOTLIGHT 2 -->
<section class="container ja-fn">
  <div class="row">
    <div class="span8">
      <?php $this->spotlight ('footnav', 'footer-1, footer-2, footer-3', array('row-fluid'=>1)) ?>
    </div>
    <div class="span4<?php $this->_c('footer-4', array('tablet' => 'span4', 'xtablet' => 'span4'))?>">
      <jdoc:include type="modules" name="<?php $this->_p('footer-4') ?>" style="T3Xhtml" />
    </div>
  </div>
</section>
<!-- EQUAL FOOTNAV COLS -->
<?php  $this->addScript (T3_URL.'/js/jquery.equalheight.js'); ?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    jQuery('.ja-fn div[class*="span"]').slice(1).equalHeight();
  });
</script>
<!-- //EQUAL FOOTNAV COLS -->

<!-- //SPOTLIGHT 2 -->
<?php endif ?>
  <!-- //FOOT NAVIGATION -->
  
<section class="wrap ja-footermenu">
  <div class="container">
    <div class="row">
	<div class="span8<?php $this->_c('footermenu', array('tablet' => 'span6', 'xtablet' => 'span6'))?>">
	  <jdoc:include type="modules" name="<?php $this->_p('footermenu') ?>" style="T3Xhtml" />
	</div>  
	<div class="span4<?php $this->_c('head-search', array('tablet' => 'span6', 'xtablet' => 'span6'))?>">
	  <div class="head-search">
	    <jdoc:include type="modules" name="<?php $this->_p('head-search') ?>" style="raw" />
	  </div>
	  <div class="<?php $this->_c('social')?>">
	    <jdoc:include type="modules" name="<?php $this->_p('social') ?>" style="raw" />
	  </div>
	</div> 
    </div>
  </div>
</section>

  <section class="ja-copyright">
    <div class="container">
      <div class="row">
        <div class="span8 copyright<?php $this->_c('footer')?>">
          <jdoc:include type="modules" name="<?php $this->_p('footer') ?>" />
        </div>
        <div class="span4 poweredby">
          <small><a href="http://t3.joomlart.com" title="Powered By T3 Framework" target="_blank">Powered by <strong>T3 Framework</strong></a></small>
        </div>
      </div>
    </div>
  </section>

</footer>
<!-- //FOOTER -->