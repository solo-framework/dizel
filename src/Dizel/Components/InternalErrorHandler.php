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

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class InternalErrorHandler
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
		/** @var $view \Slim\Views\Twig */
		$view = $this->container->get("view");
		return $view->render($response, "internal_error.twig", ["exception" => $error, "debug" => $this->debug])->withStatus(500);
	}
}

