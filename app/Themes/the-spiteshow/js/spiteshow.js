// spiteshow simple theme for Rome CMS

(function() {
	$(document).ready(function() {
		var re = /(ht|f)tp(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)([a-zA-Z0-9\-\.\?\,\'\/\\\+&%\$#_]*)?/g;
		$('ul.tweetsList li').each(function() {
			var urls = re.exec($(this).html());
			var link = urls ? urls[0] : $(this).attr('rel');
			$(this).click(function(event) { window.open(link); });
			$(this).hover(function() { $(this).addClass('hover'); }, function() { $(this).removeClass('hover');} );
		});
		
		// pretty headers
		Cufon.replace('h3', { fontFamily: "Diavlo"});
	});
})();
