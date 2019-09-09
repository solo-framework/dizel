<?php

// run app: ./run-in-container.sh 'export APP_CONFIG=config/web.dev.php && php -S 0.0.0.0:9191 -t /app'
// get conteiner ip: docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' <container_name|ID>
// open in browser: http://ip:9191

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
$start = microtime(true);

error_reporting(E_ALL);
ini_set("display_errors", 0);

require 'vendor/autoload.php';

use Dizel\Application;

$configFile = getenv("APP_CONFIG");//"config/web.dev.php";
$isDebug = filter_var((getenv("APP_DEBUG_MODE")), FILTER_VALIDATE_BOOLEAN);

//try
//{
	Application::createApplication($configFile, $isDebug);
	Application::getInstance()->run();
//}
//catch (Throwable $e)
//{
//	print_r($e);
//}