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

class Twig extends ApplicationComponent
{
	protected $service = null;

	public function getComponent()
	{
		$path = $this->getOption("path");
		$debug = $this->getOption("debug");

		$extLoader = $this->getOption("extension_loader_class");

		unset($this->options["path"]);
		unset($this->options["extensions"]);
		unset($this->options["extension_loader_class"]);

		$this->service = new \Slim\Views\Twig($path, $this->options);

		$router = $this->container->get('router');
		$uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
		$this->service->addExtension(new \Slim\Views\TwigExtension($router, $uri));

		new $extLoader($this->service, $this->container, $this->options, $debug);

		return $this->service;
	}
}

