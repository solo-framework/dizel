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
//		if (!$actor)
	//		return $response->withRedirect("/index");
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return ResponseInterface
	 * @throws \ReflectionException
	 */
	public function execute(Request $request, Response $response, array $args)
	{
//		$this->logger->error("FETCH", [$this->fetch()]);

		$this->name = $request->getParam("name");
		return $this->display($response);//, "IndexView.twig");
	}
}

