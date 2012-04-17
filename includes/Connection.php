<?php

class Connection
{
	var $username;
	var $password;
	var $database;
	var $hostname;
	var $connection;

	static $instance = null;

	private function __construct($username, $password, $database, $hostname) {
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		$this->hostname = $hostname;
		$this->connect();
	}

	private function __destruct() {
		$this->close();
		Connection::$instance = null;
	}

	static function getInstance($username, $password, $database, $hostname) {
		if(Connection::$instance == null) {
			Connection::$instance = new Connection($username, $password, $database, $hostname);
		}
		return Connection::$instance;
	}

	/**
	 * @return returns true if connection was successful or false otherwise
	 */
	function connect()
	{
		echo "back to connect";
			
		echo "  username = ".$this->username." ";
		echo "  password = ".$this->password." ";
		echo "  database = ".$this->database." ";
		echo "  hostname = ".$this->hostname." ";

		$this->connection = mysql_connect($this->hostname, $this->username, $this->password) or die("Unable to connect to SQLSERVER");
		return mysql_select_db ($this->database) or die("Error: " .mysql_error());
	}

	function close() {
		mysql_close();
		$this->connection = null;
	}

	function execute($query) {
		$result = mysql_query($query)  or die("SQL error: ".mysql_error());
		return $result;
		//
	}

	function getConnectionString() {
		return $connection->conection_string;
	}
}

?>




