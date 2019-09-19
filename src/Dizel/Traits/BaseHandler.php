<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace Dizel\Traits;

use Psr\Container\ContainerInterface;
use Slim\Container;

trait BaseHandler
{
	/**
	 * @var Container
	 */
	protected $container;

	public function __construct(ContainerInterface $container, $displayErrorDetails = false)
	{
		$this->displayErrorDetails = $displayErrorDetails;
		$this->container = $container;
	}
}

