<?php 
class Store
{
	const MAX_LENGTH = 50;

	public static function genFileStoreFromArray($file_path, $array)
	{
		if (file_exists($file_path)) {
			unlink($file_path);
		}
		
		foreach ($array as $data)
		{
			$line = self::encodeLine($data[0], $data[1]);

			file_put_contents($file_path, $line, \FILE_APPEND);
		}
	}

	private $file_path;


	public function __construct($file_path)
	{
		$this->file_path = $file_path;
	}


	public function getValue($key)
	{
		$offset = 0;
		$length = filesize($this->file_path);

		do {
			$center = $offset + round($length / 2);

			$_center = $center - self::MAX_LENGTH;

			$_center = ( $_center < 0  ? 0 : $_center );

			$file_content = file_get_contents(
				$this->file_path,
				false,
				null,
				$_center,
				self::MAX_LENGTH * 2
			);

			if ($_center === 0) {
				$file_content = chr(10).$file_content;
			}

			$array = self::decode($file_content);

			if (array_key_exists($key, $array)) {
				return $array[$key];
			}

			$key_center = array_keys($array)[0];

			if ($key_center < $key) {
				$offset = $center;
			}

			$length = $length / 2;

		} while ($length > self::MAX_LENGTH);
	}


	public static function encodeLine($key, $value)
	{
		return $key.chr(9).$value.chr(10);
	}

	public static function decode($content)
	{
		$array_lines = explode(chr(10), $content);

		array_shift($array_lines);

		array_pop($array_lines);

		$array = [];
		foreach ($array_lines as $line)
		{
			list($key, $value) = explode(chr(9), $line);

			$array[$key] = $value;
		}

		return $array;
	}
}