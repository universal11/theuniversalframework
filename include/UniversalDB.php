<?php

class UniversalDB{
	private $host;
	private $user;
	private $password;
	private $connection;

	public function __construct(){

	}

	public function init($host, $user, $password){
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
	}

	public function initWithConnect($host, $user, $password){
		$this->init($host, $user, $password);
		return $this->connect();
	}


	public function close(){
		mysql_close($this->connection);
	}

	public function query($sql){
		$data = array();
		$result = mysql_query($sql, $this->connection) or die(mysql_error());
		while($row = mysql_fetch_object($result)){
			$data[] = $row;
		}
		return $data;
	}

	public function queryUniqueResult($sql){
		$result = mysql_query($sql, $this->connection) or die(mysql_error());
		return mysql_fetch_object($result);
	}

	public function execute($sql){
		$result = mysql_query($sql, $this->connection) or die(mysql_error());
		return $result;
	}

	public function connect(){
		$this->connection = mysql_connect($this->host, $this->user, $this->password) or die(mysql_error());
		return $this->connection;
	}

}


?>