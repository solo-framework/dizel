<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace App\Action;

use Dizel\Action;
use Slim\Http\Request;
use Slim\Http\Response;

class TestAction extends Action
{

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return void
	 */
	public function preExecute(Request $request, Response $response, array $args)
	{
		// TODO: Implement preExecute() method.
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 *
	 * @return Response
	 */
	public function execute(Request $request, Response $response, array $args)
	{
//		$this->logger->debug(print_r($request->getParams(), 1));
//		return $response->withRedirect("/lololo");

//		$this->logger->debug("!!", $request->getParams());

		return $response->withJson($request->getParams());
	}
}

