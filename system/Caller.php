<?php
class Caller {
	/**
	 * @var $controller string
	 * @var $method string
	 */
	private $controller,
			$method;

	/**
	 * Caller constructor.
	 *
	 * @param $controller string
	 * @param $method string
	 */
	public function __construct($controller=null, $method=null) {
		$this->setController($controller);
		$this->setMethod($method);
	}

	/**
	 * @return string
	 */
	public function getController() {
		return $this->controller;
	}

	/**
	 * @param string $controller
	 *
	 * @return string
	 */
	public function setController($controller) {
		$this->controller = $controller;
		return $this->controller;
	}

	/**
	 * @return string
	 */
	public function getMethod() {
		return $this->method;
	}

	/**
	 * @param string $method
	 *
	 * @return string
	 */
	public function setMethod($method) {
		$this->method = $method;
		return $this->method;
	}

	/**
	 * @throws Exception
	 */
	public function call(){
		$file = __DIR__.'/../'.APP_DIRECTORY.'/controller/'.$this->controller.'.php';
		if(!file_exists($file)){
			throw new Exception('File not found', 404);
		}
		require_once($file);
		if(!method_exists(new $this->controller(), $this->method)){
			throw new Exception('Route not found', 404);
		}
		$this->make_call($this->controller, $this->method);

	}
	private function make_call($controller, $method){
		$reflection = new ReflectionClass($controller);
		$reflection_method = $reflection->getMethod($method);
		$doc_comment = $reflection_method->getDocComment();
		if($doc_comment && preg_match_all('/@_.+ (.+)/', $doc_comment, $matches)){
			$decorators = $matches[0];
			$this->process_decorators($decorators);
		}
		$class = new $controller();
		$class->$method();
	}
	private function process_decorators($decorators){
		require_once(__DIR__.'/../'.APP_DIRECTORY.'/decorators/decorators.php');
		foreach ($decorators as $decorator){
			$parts = explode(' ', $decorator);
			$function = substr($parts[0],2,strlen($parts[0]));
			$parameters = $parts[1];
			$function($parameters);
		}
	}

}