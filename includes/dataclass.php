<?php
include_once ("includes/Connection.php");

if(!@file_exists('config/config.php') ) {
	die ("Configuration settings not set. Please check Config.example.php to see how it is set");	
} else {
	include('config/config.php');
}

function GetValuesLoggingEvent()
{
	$query =  "SELECT lee.i, lee.trace_line,
			   le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line,le.marker_type, le.event_id,
			   lep.event_id, lep.mapped_key, lep.mapped_value 
			   from  logging_event le 
			   JOIN logging_event_exception lee on le.event_id = lee.event_id
 			   JOIN logging_event_property lep on le.event_id = lep.event_id 
 			   ORDER BY " .$_SESSION['sortvalue'] ." ASC" ;

	$conn = Connection::getInstance($GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['hostname']);
	return $conn->execute($query);
}

function populatecc()
{
	$query = "SELECT DISTINCT le.caller_class
				FROM  logging_event le";

	$conn = Connection::getInstance($GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['hostname']);
	return $conn->execute($query);
}

function populatemt()
{

	$query = "SELECT DISTINCT marker_type
					FROM  logging_event le";

	$conn = Connection::getInstance($GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['hostname']);
	return $conn->execute($query);

}

function populatelevel()
{
	$query = "SELECT DISTINCT le.level_string
					FROM  logging_event le";

	$conn = Connection::getInstance($GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['hostname']);
	return $conn->execute($query);

}

function populateloggername()
{
	$query = "SELECT DISTINCT le.logger_name
					FROM  logging_event le";
	
	$conn = Connection::getInstance($GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['hostname']);
	return $conn->execute($query);

}



function getall($searchCriterias = array(), $optionr = "t3") {

date_default_timezone_set('Europe/Malta');
	$query3 =  "SELECT lee.i, lee.trace_line,
			   le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line,le.marker_type, le.event_id,
			   lep.event_id, lep.mapped_key, lep.mapped_value 
			   from  logging_event le 
			   JOIN logging_event_exception lee on le.event_id = lee.event_id
 			   JOIN logging_event_property lep on le.event_id = lep.event_id ";

	$query2 = "SELECT le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line, le.marker_type,le.event_id,
			   lep.event_id, lep.mapped_key, lep.mapped_value 
			   from  logging_event le 
			   JOIN logging_event_property lep on le.event_id = lep.event_id";

	$query = "SELECT lee.i, lee.trace_line,
			   le.timestmp,le.formatted_message, le.logger_name, le.level_string, le.thread_name, le.reference_flag, le.arg0, le.arg1, le.arg2, le.arg3, le.caller_filename, le.caller_class, le.caller_method, le.caller_line, le.marker_type,le.event_id
			   from  logging_event le 
			   JOIN logging_event_exception lee on le.event_id = lee.event_id";

	$validCriterias = array();

	if(count($searchCriterias) > 0) {
		$to;
		$from;
		$te = true;
		$fe = true;

		$sqlDate = new DateTime();
		
		foreach ($searchCriterias as $key => $value) {
			if($key == "txtto") {
				$to = $value;
				$te = false;

			} else if($key == "txtfrom") {
				$from = $value;
				$fe = false;			
				
 			} else if(($key != "txtto") && ($key != "txtfrom")) {
				
				if(isset($value) && ($value != "") && ($value != "Select")) {
					$validCriterias[$key] = $value;
				}
			}
		}		
		
		$arraySize = count($validCriterias);
		if(($arraySize > 0) || (($te == false) && ($fe == false))) {
			$counter = 1;
			$thisQuery;
			if($optionr == "t3") {
				$thisQuery = $query3;
			} else if ($optionr == "t2") {
				$thisQuery = $query2;
			} else if ($optionr == "t1") {
				$thisQuery = $query;
			}
			$thisQuery .=  " WHERE ";

			foreach ($validCriterias as $key =>$value) {
				$thisQuery .= $key." = '". $value. "'";
					
				if ($counter < $arraySize) {
					$thisQuery .= ' AND ';
				}
				$counter++;
			}
			
			if(($te == false) && ($fe == false)) {
				if($arraySize > 0 )
					$thisQuery .=  "AND timestmp BETWEEN '".strtotime($to) . "' AND '" .strtotime($from). "'";
				else if(!$arraySize > 0)
					$thisQuery .=  " timestmp BETWEEN '".strtotime($to) . "' AND '" .strtotime($from). "'";
			}
		}

		
		$conn = Connection::getInstance($GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['hostname']);
		return $conn->execute($thisQuery);

	}
}
?>