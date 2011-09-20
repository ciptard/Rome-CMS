// ROME CMS JS

(function($) {

	$.fn.romeModal = function(options) {
		return this.each(function() {
			var settings = {
				overlay : "div#overlay",
				content : "div#overlayContent",
				iframe  : "iframe#overlayFrame"
			};
			
			var viewport = function() { return { width : $(window).width(), height : $(window).height() }; };
			
			var insertMarkup = function() {
				if ($('div#overlay').length) return;
				var html = '<div id="overlay" style="display:none;"></div>'
						 + '<div id="overlayContent" style="display:none;">'
						 + '<iframe id="overlayFrame" src="" frameBorder="0"></iframe>'
						 + '</div>';
				$("body").append(html);
			};
			
			var positionModal = function() {
				var dims = viewport();
				$(settings.overlay).css({ width: dims.width + 'px', height: dims.height + 'px' });
				$(settings.content).css({
					left : (dims.width / 2) - ($(settings.content).width() / 2) + 'px',
					top  : (dims.height / 2) - ($(settings.content).height() / 2) + 'px'
				});
			};
			
			var setFrameSrc = function(src) { $(settings.iframe).attr('src', src); };
			
			var open = function(href) {
				setFrameSrc(href);
				positionModal();
				$(settings.overlay).delay(200).fadeIn();
				$(settings.content).delay(200).fadeIn();
				$(settings.overlay).bind('click.romeModal', close);
				$(window).bind('resize.romeModal', positionModal);
				$(document).bind('keyup.romeModal', function(e) { if (e.keyCode == 27) close(); });
			};
			
			var close = function() {
				$(settings.content).fadeOut();
				$(settings.overlay).fadeOut(function() { setFrameSrc(''); });
				$(settings.overlay).unbind('.romeModal');
				$(window).unbind('.romeModal');
				$(document).unbind('.romeModal');
			};
			
			insertMarkup();
			
			$(settings.overlay).css({ background : '#000', left : '0px', opacity : '.4', position : 'fixed', top : '0px' });
			
			$(this).click(function(event) {
				event.preventDefault();
				open($(this).attr('href'));
			});
		});
	};
	
})(jQuery);

/*
$(document).ready(function() {
	$("a.open").romeModal();
});
*/
