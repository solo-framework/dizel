<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace Dizel\Middleware;

use Dizel\Middleware;
use Slim\Http\Request;
use Slim\Http\Response;

class Test extends Middleware
{
	public $p1 = null;
	public $p2 = null;

	public function __invoke(Request $request, Response $response, $next)
	{
//		$response->write("...Test {$this->p1}[");
		$response = $next($request, $response);
//		$response->write("]...Test {$this->p2}");
		return $response;
	}
}

