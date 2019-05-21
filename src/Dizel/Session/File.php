<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

namespace Dizel\Session;

use Dizel\ISessionProvider;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;

class File implements ISessionProvider
{
	/**
	 * @var SessionManager
	 */
	protected $sessionManager = null;

	protected $defaultOptions = ["save_handler" => "files"];
	private $options;


	public function __construct($options)
	{
		$this->options = $options;
	}

	public function start()
	{
		$sessionOptions = array_merge($this->defaultOptions, $this->options["sessionOptions"]);

		$sessionConfig = new SessionConfig();
		$sessionConfig->setOptions($sessionOptions);

		$this->sessionManager = new SessionManager();
		$this->sessionManager->setConfig($sessionConfig);
	}

	/***
	 * @return SessionManager
	 */
	public function getSessionManager()
	{
		return $this->sessionManager;
	}
}

