
//jquery .delegate()
//http://api.jquery.com/delegate/
$( "table" ).delegate( "td", "click", function() {
	$( this ).toggleClass( "chosen" );
});

// do something after min 
//http://www.sitepoint.com/settimeout-example/
setTimeout(function() {
	// put your code her
}, "3000");