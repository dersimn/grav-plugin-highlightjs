$(document).ready( function() {
	$('pre code[class^="language-"],code[class*=" language-"]').each(function(i, block) {
		hljs.highlightBlock(block);
	});
});