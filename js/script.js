$(document).ready(function() {
//	$('#txtcallerclass option').click(function() {
//		$.toggle()
//	});
});


//script.js 
//**from clayton email**

$("#free-text").autocomplete({
    source : "controllers/products.php",
    minLength : 2
});