<?php


class RouterTest extends \Codeception\Test\Unit
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
		self::assertTrue(class_exists('Router'));
    }
	public function testSetUrl(){
		/**
		 * @var $tester Router
		 */
		$tester = new Router();
		self::assertInstanceOf('Router', $tester->setRequestUrl('/'));
	}
	public function testController(){
		$tester = new Router('/');
		self::assertEquals('Welcome', $tester->getController());
		$tester = new Router('?params');
		self::assertEquals('Welcome', $tester->getController());
		$tester = new Router('/?params');
		self::assertEquals('Welcome', $tester->getController());
		$tester->setRequestUrl('/login');
		self::assertEquals('Login', $tester->getController());
		$tester->setRequestUrl('/login?params');
		self::assertEquals('Login', $tester->getController());
		$tester->setRequestUrl('/login/?params');
		self::assertEquals('Login', $tester->getController());
		$tester->setRequestUrl('/login/forgot');
		self::assertEquals('Login', $tester->getController());
		$tester->setRequestUrl('/login/forgot?params');
		self::assertEquals('Login', $tester->getController());
		$tester->setRequestUrl('/login/forgot/?params');
		self::assertEquals('Login', $tester->getController());
	}
	public function testMethod(){
		$tester = new Router('/');
		self::assertEquals('index', $tester->getMethod());
		$tester = new Router('?params');
		self::assertEquals('index', $tester->getMethod());
		$tester = new Router('/?params');
		self::assertEquals('index', $tester->getMethod());
		$tester->setRequestUrl('/login');
		self::assertEquals('index', $tester->getMethod());
		$tester->setRequestUrl('/login/');
		self::assertEquals('index', $tester->getMethod());
		$tester->setRequestUrl('/login?params');
		self::assertEquals('index', $tester->getMethod());
		$tester->setRequestUrl('/login/params');
		self::assertEquals('params', $tester->getMethod());
		$tester->setRequestUrl('/login/forgot');
		self::assertEquals('forgot', $tester->getMethod());
		$tester->setRequestUrl('/login/forgot?params');
		self::assertEquals('forgot', $tester->getMethod());
		$tester->setRequestUrl('/login/forgot/?params');
		self::assertEquals('forgot', $tester->getMethod());
	}


}