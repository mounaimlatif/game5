/** 
 *------------------------------------------------------------------------------
 * @package       T3 Framework for Joomla!
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2004-2013 JoomlArt.com. All Rights Reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       JoomlArt, JoomlaBamboo, (contribute to this project at github 
 *                & Google group to become co-author)
 * @Google group: https://groups.google.com/forum/#!forum/t3fw
 * @Link:         https://github.com/t3framework/ 
 *------------------------------------------------------------------------------
 */

!function($){
	var isTouch = 'ontouchstart' in window && !(/hp-tablet/gi).test(navigator.appVersion);
	
	if(isTouch){
		$.fn.touchmenu = function(){
			return this.each(function(){	
				var	itemsel = $(this).has('.mega').length ? 'li.mega' : 'li.parent',
					jitems = $(this).find(itemsel),
					reset = function(){
						$(this).data('noclick', 0);
					},
					onTouch = function(e){
						$(document.body).addClass('hoverable');

						e.stopPropagation();
						
						var val = !$(this).data('noclick');
						// reset all
						jitems.data('noclick', 0);
						$(this).data('noclick', val);

						var that =  this;
						
						if(val){
							$(this)
								.data('rsid', setTimeout($.proxy(reset, this), 500))
								.parent().parentsUntil('.nav').filter(itemsel).addClass('open');
						}

						this.focus();
					},
					onClick = function(e){
						e.stopPropagation();

						clearTimeout($(this).data('rsid'));

						if($(this).data('noclick')){
							e.preventDefault();
							jitems.removeClass('open');
							$(this).addClass('open').parentsUntil('.nav').filter(itemsel).addClass('open');
						} else {
							var href = $(this).children('a').attr('href');
							if(href){
								window.location.href = href;
							}
						}
					};
				
				jitems.on('touchstart', onTouch).data('noclick', 0);
				
				$(this).on('touchstart', 'li', function(e){
					e.stopPropagation();
				}).on('click', 'li', onClick);

				$(document).on('touchstart', function(){
					jitems.data('noclick', 0);
					$(document.body).removeClass('hoverable');
				});
			});
		};
		
		$(document).ready(function(){
			$('ul.nav').has('.dropdown-menu').touchmenu();
		});

	}

	$('html').addClass(isTouch ? 'touch' : 'no-touch');
	
}(jQuery);