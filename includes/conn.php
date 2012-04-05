<?php

class conn
{
	function connect($mysql)
	{
		$username="marssauser";
		$password="marssa";
		$database="marssa";
		$hostname="misenas";

		//  		$username="root";
		//  		$password="";
		//  		$database="realpromise";
		//  		$hostname="localhost";

		mysql_connect($hostname,$username,$password) or die("Unable to connect to SQLSERVER");
		mysql_select_db ($database)or die( "error: " .mysql_error());

		$result = mysql_query($mysql)  or die("SQL error: ".mysql_error());

		return $result;

		//close connection
		//mysql_close();

	}
}


?>




