<?php
/**
 * Обработка исключений уровня Error. Должен использоваться для указания проблем в коде,
 * требующих внимания программиста (неправильный тип входящих данных и синтаксические ошибки)
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace Dizel\Components;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class InternalCliErrorHandler
{

	/**
	 * @var ContainerInterface
	 */
	protected $container;
	/**
	 * @var bool
	 */
	private $debug;


	public function __construct(ContainerInterface $container, $debug = false)
	{
		$this->container = $container;
		$this->debug = $debug;
	}

	public function __invoke(Request $request, Response $response, \Throwable $error)
	{
		echo "Internal PHP error: " . $error->getMessage() . PHP_EOL;
		echo "in {$error->getFile()}, {$error->getLine()}" . PHP_EOL;
		if ($this->debug)
			echo "\nTrace: {$error->getTraceAsString()}" . PHP_EOL;

		exit(1);
	}
}

