/**
 * login form js:
 * focus on username and hash password before submitting
 * TJ Eastmond <tj.eastmond@gmail.com>
 */

$(document).ready(function() {
	if ($('form#loginForm')) { $('input#username').focus(); }
	$('form#loginForm').submit(function(event) {
		$('input#password').val(md5($('input#password').val()));
	});	
});