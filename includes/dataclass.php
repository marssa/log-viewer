<?php include_once ("includes/conn.php");?>
<?php 
function GetValuesAll()
{
	$result = new conn();
	$query =  "SELECT lee.i, lee.trace_line,
			   le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line,le.marker_type, le.event_id,
			   lep.event_id, lep.mapped_key, lep.mapped_value 
			   from  logging_event le 
			   JOIN logging_event_exception lee on le.event_id = lee.event_id
 			   JOIN logging_event_property lep on le.event_id = lep.event_id
 			   ORDER BY " .$_SESSION['sortvalue'] ." ASC" ;
	$dataset = $result ->connect($query);
	return $dataset;
}

function GetValuesAllfrom2tables()
{
	$result = new conn();
	$query =  "SELECT 
			   le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line, le.marker_type,le.event_id,
			   lep.event_id, lep.mapped_key, lep.mapped_value 
			   from  logging_event le 
			   JOIN logging_event_property lep on le.event_id = lep.event_id
 			   ORDER BY " .$_SESSION['sortvalue'] ." ASC" ;
	$dataset = $result ->connect($query);
	return $dataset;
}

function GetValuesAllfrom1table()
{
	$result = new conn();
		$query =  "SELECT lee.i, lee.trace_line,
			   le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line, le.marker_type,le.event_id
			   from  logging_event le 
			   JOIN logging_event_exception lee on le.event_id = lee.event_id
 			   ORDER BY " .$_SESSION['sortvalue'] ." ASC" ;
	$dataset = $result ->connect($query);
	return $dataset;
}

function GetValuesLoggingEvent()
{

	$result = new conn();
	$query =  "SELECT timestmp,formatted_message,logger_name,level_string,thread_name, reference_flag, arg0, arg1, arg2, arg3, caller_filename, caller_class, caller_method, caller_line, marker_type,event_id      
			   FROM logging_event";

	$dataset = $result ->connect($query);
	return $dataset;
}


function GetValuesTimestmpRange($from, $to)
{
	$timestampfrom = strtotime($from);
	$timestampto = strtotime($to);
	
	$result = new conn($_SESSION['sortvalue'] );
	$query = "SELECT lee.i, lee.trace_line,
			   le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line, le.event_id,le.marker_type,
			   lep.event_id, lep.mapped_key, lep.mapped_value 
			   from  logging_event le 
			   JOIN logging_event_exception lee on le.event_id = lee.event_id
 			   JOIN logging_event_property lep on le.event_id = lep.event_id
 			   
 			   WHERE le.timestmp BETWEEN '".$timestampfrom."' AND '".$timestampto."'";
// 				ORDER BY " .$_SESSION['sortvalue'] ." ASC ";

	$dataset = $result ->connect($query);
	return $dataset;
}

function GetValuesCallerClass($callerclass)
{
	$result = new conn();
	$query = "SELECT lee.i, lee.trace_line,
				   le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line,le.marker_type, le.event_id,
				   lep.event_id, lep.mapped_key, lep.mapped_value 
				   from  logging_event le 
				   JOIN logging_event_exception lee on le.event_id = lee.event_id
	 			   JOIN logging_event_property lep on le.event_id = lep.event_id
	 			  
	 			   WHERE le.caller_class = '".$callerclass."'
					 ORDER BY " .$_SESSION['sortvalue'] ." ASC ";
	
	$dataset = $result ->connect($query);
	
	return $dataset;
}

function populatecc()
{
	$result = new conn();
	$query = "SELECT DISTINCT le.caller_class
				FROM  logging_event le";
	
	$dataset = $result -> connect($query);
	return $dataset;
}

function populatemt()
{
	$result = new conn();
	$query = "SELECT DISTINCT marker_type
					FROM  logging_event le";
	
	$dataset = $result -> connect($query);
	return $dataset;
}

function populatelevel()
{
	$result = new conn();
	$query = "SELECT DISTINCT le.level_string
					FROM  logging_event le";

	$dataset = $result -> connect($query);
	return $dataset;
}

function populateloggername()
{
	$result = new conn();
	$query = "SELECT DISTINCT le.logger_name
					FROM  logging_event le";

	$dataset = $result -> connect($query);
	return $dataset;
}


?>