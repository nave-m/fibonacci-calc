<?php

class FibCalc {
	static function getFib( $num ) {
		if (intval($num) < 0  || !is_int($num)) {
		    throw new Exception('Invalid argument');
		}
		if ($num < 2) {
			 return $num;
		}else {
			return self::getFib( $num - 2) + self::getFib( $num - 1 );
		}
	}	
}

class FibTest extends PHPUnit_Framework_TestCase
{

	public function testFibZero() {
		$this->assertEquals( 0, FibCalc::getFib(0) );
	}

	public function testFibOne() {
		$this->assertEquals( 1, FibCalc::getFib(1) );
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Invalid argument
	 */
	public function testMinusOne() {
		FibCalc::getFib(-1);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Invalid argument
	 */
	public function testString() {
		FibCalc::getFib("test");
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Invalid argument
	 */
	public function testNull() {
		FibCalc::getFib(NULL);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Invalid argument
	 */
	public function testFloatZero() {
		FibCalc::getFib(0.0);
	}

	/**
	 * @note http://ja.wikipedia.org/wiki/%E3%83%95%E3%82%A3%E3%83%9C%E3%83%8A%E3%83%83%E3%83%81%E6%95%B0
	 */
	public function testFromWikipedia() {
		$answers = array(0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597, 2584, 4181, 6765, 10946);
		foreach ($answers as $i => $value) {
			$this->assertEquals($value, FibCalc::getFib($i));
		}
	}
}