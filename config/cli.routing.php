<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

/** @var $router \Slim\App */
$router = \Dizel\Application::getInstance()->app;
$router->get("/", \Dizel\CliController::class);