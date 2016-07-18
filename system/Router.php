<?php

/**
 * Created by PhpStorm.
 * User: cyberkiller
 * Date: 7/18/16
 * Time: 10:18 AM
 */
class Router {
	private $request_url;
	public function __construct($request_url = null) {
		$this->setRequestUrl($request_url);
	}

	public function setRequestUrl($request_url)
	{
		$this->request_url = explode('?',$request_url)[0];
		return $this;
	}
	public function getController(){
		$request = explode('/', $this->request_url);
		if(count($request) === 1 or $this->request_url === '/'){
			return 'Welcome';
		}
		return ucfirst(explode('/', $this->request_url)[1]);
	}
	public function getMethod(){
		if($this->request_url === '/'){
			return 'index';
		}
		$request = explode('/',$this->request_url);
		return array_key_exists(2, $request)&&$request[2]!=''?$request[2]:'index';
	}
}