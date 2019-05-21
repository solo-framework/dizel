<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace App\View;

use Dizel\View;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class IndexView extends View
{

	public $name = "!";

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return Response|void
	 */
	public function preExecute(Request $request, Response $response, array $args)
	{
		$this->logger->error("message!!!", ["e" => new \Exception(33), "arr" => [2,3,4], "key" => "VALUE"]);
//		return $response->withRedirect("/ffff");
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return ResponseInterface
	 */
	public function execute(Request $request, Response $response, array $args)
	{
		$this->name = $request->getParam("name");
		return $this->render($response, "IndexView.twig");
	}
}

