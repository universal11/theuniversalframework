<?php

class UniversalController{
	public function __construct(){
	}

	public function main($request){
		print_r($request);
		echo "<br><br>Built by the UniversalFramework.<br>\r\n";

		/*	
		*	To Create DB Connection
		*
		$universalDB = new UniversalDB();
		$universalDB->init("localhost", "root", "root");
		$universalDB->connect();
		*/
	}



}

?>