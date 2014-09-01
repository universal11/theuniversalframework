<?php
define("FRAMEWORK_DIR", dirname(__FILE__));
include(FRAMEWORK_DIR . "/include/UniversalDB.php");
include(FRAMEWORK_DIR . "/include/UniversalModel.php");
include(FRAMEWORK_DIR . "/include/UniversalController.php");

$request = (object)$_REQUEST;

//Set &debug=1 on URL for debug mode

$debugMode = ( (empty($request->debug)) ? false : $request->debug );
if($debugMode){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	echo "/// REQUEST ///<br>\r\n<br>\r\n";
	print_r($request);
	echo "<br>\r\n<br>\r\n<br>\r\n";
}


//
// Set DB Connection
//

$dbConnection = new UniversalDB();
$dbConnection->init("theuniversalframework.com", "universal_app", "h8rsg0nnah811");
//$universalDB->connect();

//
// Route Handler
//

if(!empty($request->controller)){
	$controller = $request->controller;
	$boot = "controllers/{$controller}.php";
	if(file_exists($boot)){
		if($debugMode){ echo "Booting Controller: {$boot}<br>\r\n"; }
		include($boot);
		if(class_exists($controller)){
			if($debugMode){ echo "{$controller} loaded...<br>\r\n"; }
			$controller = new $controller();
			if(!empty($request->action)){
				$action = $request->action;
				if(method_exists($controller, $action)){
					if($debugMode){ echo "{$action} executed...<br>\r\n"; }
					$controller->{$action}($request, $dbConnection);
				}
			}
			else{
				$controller->init($request);
			}
		}
	}
	
}


?>