<?php
define('APP_DIRECTORY', 'application');
define('SYSTEM_DIRECTORY', 'system');
define('DECORATORS_DIRECTORY', 'application/decorators');
define('DEBUG_MODE', true);
header('Content-Type: application/json');
try{
	require_once __DIR__.'/'.SYSTEM_DIRECTORY.'/bootstrap.php';
}catch(Exception $e){
	$code = $e->getCode();
	$message = $e->getMessage();
	$trace = $e->getTraceAsString();
	set_status_header($code);
	$data = array();
	$data['message'] = $message;
	if(DEBUG_MODE){
		$data['trace'] = $trace;
	}
	echo json_encode($data,DEBUG_MODE?JSON_PRETTY_PRINT:null);
}
