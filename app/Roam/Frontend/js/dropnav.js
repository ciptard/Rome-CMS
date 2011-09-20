/**
 * Dropnav.js
 * Simple and clean JS dropdown nav extension to jQuery
 * TJ Eastmond <tj.eastmond@gmail.com>
 */
 
// True check of mouse coming and going; fixes IE flicker bug
var mouseLeaveEnter = function(e, handler) {
	var t = e.relatedTarget ? e.relatedTarget : e.type == 'mouseout' ? e.toElement : e.fromElement;
	while (t && t != handler) { t = t.parentNode; }
	return (t != handler);
};

(function($) {
	var dropEvents = function() {
		var ul = this.getElementsByTagName('ul')[0];
		$(this).mouseover(function() { $(ul).show(); $(this).addClass('open'); })
			   .mouseout(function() { $(ul).hide(); $(this).removeClass('open'); });
	};

	$.fn.dropnav = function() {
		return this.each(function() {
			$(this).find('li').each(function() {
				dropEvents.apply(this);
			});
		});
	};
})(jQuery);

