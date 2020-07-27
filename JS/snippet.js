
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


// Egyptian mobile number validation
var mobile = '+201000001006';
var regex = /^(00|\+)(20)(10|11|12)[0-9]{8}$/;
if (regex.test(mobile)) {
	alert("valid number");
} else {
	alert("Invalid number");
}
