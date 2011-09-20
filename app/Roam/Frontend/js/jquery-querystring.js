/**
 * Simple jQuery extension to pull either the
 * entire querystring or just a single variable
 *
 * TJ Eastmond <tj.eastmond@gmail.com>
 */

(function($) {
	$.fn.querystring = function() {
		var i, queryString = '', parts, pieces, qs = {}, variable = arguments[0] || false;
		queryString = window.location.search.substring(1);
		
		// no querystring present, so return false
		if (!queryString) { return false; }
		
		parts = queryString.split('&');

		len = parts.length;
		for (i = 0; i < len; i++) {
			pieces = parts[i].split('=');
			
			// looking for a specific variable, send it back if it exists
			if (variable && variable === pieces[0]) {
				return pieces[1];
			}
			
			qs[pieces[0]] = pieces[1];
		}
		
		// if they were looking for a variable, it doesn't exists
		// return fales or an object containing all the querystring parameters
		return variable ? false : qs;
	};
})(jQuery);
