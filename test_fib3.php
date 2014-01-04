<?php

class FibCalc implements Iterator{
	private $index;
	private $pastValues;

	function __construct() {
		$this->rewind();
	}

	function rewind() {
		$this->index = 1;
		$this->pastValues = array(0,1);
	}

	function current() {
		return array_sum($this->pastValues);
	}

	function key() {
		return $this->index;
	}

	function next() {
		$ret = $this->current();
		array_shift($this->pastValues);
		$this->pastValues[] = $ret;
		$this->index++;
		return $ret;
	}

	function valid() {
		if ($this->index < 0) {
			return false;
		}

		return true;
	}




	static function getFib( $num ) {
		if (intval($num) < 0  || !is_int($num)) {
		    throw new Exception('Invalid argument');
		}
		if ($num < 2) {
			return $num;
		}

		$calculator = new FibCalc();
		do {
			$result = $calculator->current();
			$calculator->next();
		} while ( $num > $calculator->key() );
		return $result;
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
	 * @dataProvider providerFromWikipedia
	 */
	public function testFromWikipedia($input, $output) {
		$this->assertEquals($output, FibCalc::getFib($input));
	}

	/**
	 * @note http://ja.wikipedia.org/wiki/%E3%83%95%E3%82%A3%E3%83%9C%E3%83%8A%E3%83%83%E3%83%81%E6%95%B0
	 */
	public function providerFromWikipedia()
	{
		return  array( 
					array( 0,    0),
					array( 1,    1),
					array( 2,    1),
					array( 3,    2), 
					array( 4,    3), 
					array( 5,    5), 
					array( 6,    8), 
					array( 7,   13), 
					array( 8,   21), 
					array( 9,   34), 
					array(10,   55), 
					array(11,   89), 
					array(12,  144), 
					array(13,  233), 
					array(14,  377), 
					array(15,  610), 
					array(16,  987), 
					array(17, 1597), 
					array(18, 2584), 
					array(19, 4181), 
					array(20, 6765), 
					array(21, 10946)
				);
	}
}