

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


$(function() {	
	
	$('#txtfrom').datetimepicker({
	    onClose: function(dateText, inst) {
	        var endDateTextBox = $('#txtto');
	        if (endDateTextBox.val() != '') {
	            var testStartDate = new Date(dateText);
	            var testEndDate = new Date(endDateTextBox.val());
	            if (testStartDate > testEndDate)
	                endDateTextBox.val(dateText);
	        }
	        else {
	            endDateTextBox.val(dateText);
	        }
	    },
	    onSelect: function (selectedDateTime){
	        var start = $(this).datetimepicker('getDate');
	        $('#txtto').datetimepicker('option', 'minDate', new Date(start.getTime()));
	    }
	});
	$('#txtto').datetimepicker({
	    onClose: function(dateText, inst) {
	        var startDateTextBox = $('#txtfrom');
	        if (startDateTextBox.val() != '') {
	            var testStartDate = new Date(startDateTextBox.val());
	            var testEndDate = new Date(dateText);
	            if (testStartDate > testEndDate)
	                startDateTextBox.val(dateText);
	        }
	        else {
	            startDateTextBox.val(dateText);
	        }
	    },
	    onSelect: function (selectedDateTime){
	        var end = $(this).datetimepicker('getDate');
	        $('#txtfrom').datetimepicker('option', 'maxDate', new Date(end.getTime()) );
	    }
	});
	

		});

