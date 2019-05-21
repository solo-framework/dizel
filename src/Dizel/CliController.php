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

class CliController// extends Command
{
	/**
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * @var Logger
	 */
	protected $logger;

	/**
	 * @var \Symfony\Component\Console\Application
	 */
	protected $app = null;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->logger = Logger::getLogger("cli");

		$this->app = $this->container->get("cli");
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$code = $this->app->run();
		exit($code);
	}
}

