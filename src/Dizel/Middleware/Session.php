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

use Dizel\Context;
use Dizel\ISessionProvider;
use Dizel\Middleware;
use Slim\Http\Request;
use Slim\Http\Response;

class Session extends Middleware
{
	/**
	 * Имя класса обработчика сессий
	 *
	 * @var string
	 */
	public $providerClass = "";

	/**
	 * Имя сессии
	 *
	 * @var string
	 */
	public $sessionName = "";

	/**
	 * Настройки провайдера сессий, передаются в конструктор нужного класса
	 *
	 * @var null
	 */
	public $options = null;

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param callable $next
	 *
	 * @return Response
	 */
	public function __invoke(Request $request, Response $response, callable $next)
	{
		/** @var $provider ISessionProvider */
		$provider = new $this->providerClass($this->options);

		// стартуем контекст
		Context::start($this->sessionName, $provider);

		$response = $next($request, $response);
		return $response;
	}
}

