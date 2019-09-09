<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace App\CLI;

use Dizel\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Test extends Command
{
//	protected static $defaultName = 'test_command';

	protected function configure()
	{
		$this->addArgument("password", InputArgument::REQUIRED, "Это пароль");
		$this->addOption("blabla", "b", InputOption::VALUE_REQUIRED, "opt description");
		$this->setDescription("Описание метода");
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
//		echo $a;
//		throw new \Error("ddd");
//		throw new \Exception("exxxx");
//
		// Пример запуска  ./run-in-container.sh 'export APP_DEBUG_MODE=1 && cd /app && php cli.php test_command -b blabla  password'

//		print_r($input->getOptions());
//		print_r($input->getArguments());
		$output->writeln("This is TEST command with password >> {$input->getArgument("password")} and b: {$input->getOption("blabla")}" );
		return 0;
	}
}

