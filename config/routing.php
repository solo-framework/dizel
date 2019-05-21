<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

use App\View\IndexView;

/** @var $router \Slim\App */
$router = \Dizel\Application::getInstance()->app;

$router->get("/", IndexView::class)->setName("view.index");
$router->get("/index", IndexView::class)->setName("view.index");

$router->get("/action/test", \App\Action\TestAction::class)->setName("action.test");