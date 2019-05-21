<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace Dizel\Components;

use Dizel\ApplicationComponent;
use Psr\Container\ContainerInterface;
use Slim\Http\Environment;

class ConsoleEnv extends ApplicationComponent
{
	public $debug = false;

	/**
	 * @var ContainerInterface
	 */
	protected $container;

	public function getComponent()
	{
		set_time_limit(0);
		$argv = $GLOBALS['argv'];
		array_shift($argv);

		$opts = $_SERVER;
		$opts["REQUEST_METHOD"] = "GET";

		$opts['REQUEST_URI'] = "/";
//		$opts['REQUEST_URI'] = count($argv) >= 2 ? "/{$argv[0]}/{$argv[1]}" : "/help";
//		$opts['REQUEST_URI'] = count($argv) >= 2 ? "/{$argv[0]}" : "/help";
//print_r($opts);
//		print_r($opts['REQUEST_URI']);
		return Environment::mock($opts);
	}
}

