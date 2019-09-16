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
		$extensions = $this->getOption("extensions");
		$filters = $this->getOption("filters");
		$functions = $this->getOption("functions");
		$tags = $this->getOption("tags");
		$tests = $this->getOption("tests");

		unset($this->options["path"]);
		unset($this->options["extensions"]);
		unset($this->options["filters"]);
		unset($this->options["functions"]);
		unset($this->options["tags"]);
		unset($this->options["tests"]);

		$this->service = new \Slim\Views\Twig($path, $this->options);

		$router = $this->container->get('router');
		$uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
		$this->service->addExtension(new \Slim\Views\TwigExtension($router, $uri));

		if (count($extensions) > 0)
		{
			foreach ($extensions as $ext)
			{
				$this->service->getEnvironment()->addExtension(new $ext);
			}
		}

		if (count($filters) > 0)
		{
			foreach ($filters as $ext)
			{
				$this->service->getEnvironment()->addFilter(new $ext);
			}
		}

		if (count($functions) > 0)
		{
			foreach ($functions as $ext)
			{
				$this->service->getEnvironment()->addFunction(new $ext);
			}
		}

		if (count($tags) > 0)
		{
			foreach ($tags as $ext)
			{
				$this->service->getEnvironment()->addTokenParser(new $ext);
			}
		}

		if (count($tests) > 0)
		{
			foreach ($tests as $ext)
			{
				$this->service->getEnvironment()->addTest(new $ext);
			}
		}

		return $this->service;
	}
}

