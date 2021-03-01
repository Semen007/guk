<?php

include_once __DIR__.'/../Store.php';

class StoreTest extends \PHPUnit\Framework\TestCase
{
	public static $test_data = [
		['AAA', '09pr2345vc34terthbvfdjyhtjhetjhuer43ujif'],
		['AAB', 'cghfjcowlejfsk.nglksngkjngvkfjlsnjkdgm,asdg'],
		['ABA', 'dvkjhxzkjnv9p4j5jrwulgihsakljgnfvljksdgnl'],
		['ABB', 'c2u54hjgcjsdghdlgnjsdklgnsdbgdj'],
		['BAA', '3294yurfo87ehcfn8ewhbo8tmj'],
		['CAA', 'o78x34y52tocmj45t9mhj24ogthj4u53i'],
		['CAC', '28moyftrc09rjfwe'],
		['CBA', 'o8hjuvo983yj89ocg,pjoliwjerhctygljcwo4r'],
		['CBB', 'w98cp5j,okrefgsd;'],
		['CBC', 'u5yc9o83hcgj039jhg09j389c,p,8gjo356jgh'],
		['CCC', 'co542ut;we,p,8gjo356jgh'],
	];

	/**
	 * @var Store
	 */
	private $store;

	protected function setUp()
	{
		$file_path = __DIR__.'/../store.txt';

		Store::genFileStoreFromArray($file_path, self::$test_data);

		$this->store = new Store($file_path);
	}

	public function getTestData()
	{
		return self::$test_data;
	}

	/**
	 * @param $key
	 * @param $value_valid
	 * @dataProvider getTestData
	 */
	public function testGetValue($key, $value_valid)
	{
		$this->assertEquals($value_valid, $this->store->getValue($key));
	}
}
