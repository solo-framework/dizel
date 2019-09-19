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

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class Controller
{
	/**
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * @var Logger
	 */
	protected $logger;

	public function __construct(ContainerInterface $container)
	{

		$this->container = $container;
		$this->logger = Logger::getLogger();//$container->get("logger");
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$res = $this->preExecute($request, $response, $args);
		if ($res)
			return $res;
		return $this->execute($request, $response, $args);
	}


	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return Response|void
	 */
	public abstract function preExecute(Request $request, Response $response, array $args);

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return ResponseInterface
	 */
	public abstract function execute(Request $request, Response $response, array $args);
}

