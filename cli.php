<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'vendor/autoload.php';

use Dizel\Application;

//print_r($_SERVER);

$configFile = "config/cli.dev.php";
Application::createApplication($configFile);
Application::getInstance()->run();

//print_r(Application::getInstance()->app->getContainer()->get("environment"));
