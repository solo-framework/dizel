<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace Dizel\Traits;

use Psr\Container\ContainerInterface;
use Slim\Http\Response;

/**
 * Trait AJAXResponse
 * @package Dizel\Traits
 *
 * @property ContainerInterface container
 */
trait AJAXResponse
{
	/**
	 * @param $data
	 * @param int $httpCode
	 *
	 * @return Response
	 */
	public function sendSuccessJSON($data, $httpCode = 200)
	{
		/** @var $response Response */
		$response = $this->container["response"];

		$res["error"] = false;
		$res["data"] = $data;
		return $response->withJson($res)->withStatus($httpCode);
	}

	/**
	 * @param $data
	 * @param int $httpCode
	 *
	 * @return Response
	 */
	public function sendErrorJSON($data, $httpCode = 500)
	{
		/** @var $response Response */
		$response = $this->container["response"];

		$res["error"] = true;
		$res["data"] = $data;
		return $response->withJson($res)->withStatus($httpCode);
	}
}

