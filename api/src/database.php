<?php 
class database {
	public $server;
	public $username; 
	public $password; 
	public $database;

	function __construct($server, $username, $password,
	       		$database){

		$this->server = $server; 
		$this->username = $username;
		$this->password = $password;
	       	$this->database = $database;
	}

	function get_connect(){

		$conn = new mysqli($this->server, 
			$this->username, 
			$this->password,
			$this->database);

		return $conn;
	
	}

}

?>
