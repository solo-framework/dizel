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
//		print_r($input->getOptions());
//		print_r($input->getArguments());
		$output->write("This is TEST command");
		return 0;
	}
}

