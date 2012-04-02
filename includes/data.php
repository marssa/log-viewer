<?php ?>
<style type="text/css">
h1 {
	color: #00ff00;
}

td {
	font-family: Arial, Verdana;
	font-size: 15px;
	background: #F9F8FB;
	color: #716E6E;
	font-weight: normal;
	/* text-align: center; */
	vertical-align: middle;
}

th {
	background: #CFDBF3;
	font-weight: bold;
	color: #445276;
	font-size: 17px;
}
</style>


<script language="javascript" type="text/javascript"
	src="datetimepicker.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>

<script>
	$(function() {
		var dates = $( "#txtfrom, #txtto" ).datepicker({
			defaultDate: "",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "txtfrom" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	</script>