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
use Symfony\Component\Console\Application as ConsoleApplication;

class ConsoleApp extends ApplicationComponent
{
	public function getComponent()
	{
		$app = new ConsoleApplication();
		$commands = $this->getOption("commands");

		if (count($commands))
		{
			foreach ($commands as $name => $commandClass)
			{
				$app->add(new $commandClass($name, $this->container));
			}
		}
		return $app;
	}
}

