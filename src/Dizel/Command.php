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

class Command extends \Symfony\Component\Console\Command\Command
{
	/**
	 * @var \Monolog\Logger
	 */
	public $logger;
	/**
	 * @var ContainerInterface
	 */
	protected $container;

	public function __construct($name, ContainerInterface $container)
	{
		parent::__construct($name);
		$this->container = $container;
		$this->logger = Logger::getLogger("cli");
	}
}

