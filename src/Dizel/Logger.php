<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace Dizel;

use Cascade\Cascade;

class Logger
{
	private static $instance = null;

	private static $config = [
		"version" => 1,
		"loggers" => [
			"default" => [
				"handlers" => ["stdout"]
			]
		],
		"handlers" => [
			"stdout" => [
				"class" => "Monolog\Handler\StreamHandler",
				"level" => "DEBUG",
//				"formatter" => "spaced",
				"stream" => "php://stdout"
			]
		]
	];



	public static function init(array $config = [])
	{
		self::$config = array_replace_recursive(self::$config, $config);
	}

	private function __ctor()
	{

	}

	/**
	 * Возвращает логер по имени
	 *
	 * @param string $name
	 *
	 * @return \Monolog\Logger
	 */
	public static function getLogger($name = "default")
	{
		if (self::$instance == null)
		{
			if (self::$config == null)
				throw new \RuntimeException("Use Logger::init() before using");

			$className = get_called_class();

			self::$instance = new $className();
			Cascade::loadConfigFromArray(self::$config);
		}

		return Cascade::getLogger($name);
	}



	private function __wakeup()
	{
		throw new \RuntimeException("Can't unserialize " . __CLASS__);
	}

	private function __clone()
	{
		throw new \RuntimeException("Can't clone " . __CLASS__);
	}
}

