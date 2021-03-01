<?php
// @codeCoverageIgnoreStart
include_once __DIR__.'/../../libs/phpunit.phar';

include_once 'Store.php';
include_once 'tests/StoreTest.php';

$nums = range(1, 5.1 * 1000);

$keys = array_map(
	function ($num) {
		return sprintf("%'.09d", $num);
	},
	$nums
);

$array = [];
foreach ($keys as $key)
{
	$value = str_repeat(rand(0,9), rand(1, 4000 - 10));

	$array[] = [$key, $value];
}

$file_path = __DIR__.'/store.txt';

Store::genFileStoreFromArray(
	$file_path,
	$array
);

$store = new Store(__DIR__.'/store.txt');

shuffle($keys);

$key = $keys[0];

$s = microtime(true);

echo $key.'<br>';
echo $store->getValue($key).'<br>';

echo number_format(microtime(true) - $s, 3);

