<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace Dizel;

use Zend\Session\SessionManager;

interface ISessionProvider
{
	/**
	 * @return void
	 */
	public function start();

	/***
	 * @return SessionManager
	 */
	public function getSessionManager();
}

