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

abstract class ApplicationComponent
{
	protected $container = null;

	protected $options = null;

	public function __construct(ContainerInterface $container, array $options = null)
	{
		$this->container = $container;
		$this->options = $options["options"];
	}

	public function getOption($key)
	{
		if (!array_key_exists($key, $this->options))
			throw new \InvalidArgumentException("Option '{$key}' is not defined");

		return $this->options[$key];
	}

	public abstract function getComponent();
}

