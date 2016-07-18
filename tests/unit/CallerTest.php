<?php

class CallerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
	public function testClassExists()
	{
		self::assertTrue(class_exists('Caller'));
	}
	public function getterAndSetterDataProvider(){
		return array(
			array('Method', 'any'),
			array('Controller', 'cont')
		);
	}

	/**
	 * @dataProvider getterAndSetterDataProvider
	 * @param $property
	 */
	public function testGetterAndSetter($property, $value){
		$caller = new Caller();
		self::assertTrue(method_exists($caller, 'set'.$property));
		self::assertTrue(method_exists($caller, 'get'.$property));
		$setter = 'set' .$property;
		$getter = 'get'.$property;
		self::assertSame($value,$caller->$setter($value));
		self::assertSame($value,$caller->$getter());
	}
	public function testCallExists(){
		$caller = new Caller();
		self::assertTrue(method_exists($caller, 'call'));
	}
	public function files_dataProvider(){
		return array(
			array('/23456789876578'),
			array('/Movies/192847120341lk2jh412341h1234198712903481212341')
		);
	}

	/**
	 * @param $request_uri
	 * @dataProvider files_dataProvider
	 * @expectedException Exception
	 */
	public function testFiles($request_uri){
		$router = new Router($request_uri);
		$caller = new Caller($router->getController(), $router->getMethod());
		$caller->call();
	}
	public function testMoviesController(){
		$request_uri = '/movies';
		$router = new Router($request_uri);
		$caller = new Caller($router->getController(), $router->getMethod());
		$caller->call();
	}
	public function test_testFileDoesNotExists(){
		$file = __DIR__.'../unit/../../application/controller/23456789876578.php';
		self::assertFileNotExists($file);
	}
}