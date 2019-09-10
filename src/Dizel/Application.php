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

use Slim\App;

class Application
{
	/**
	 * @var Application
	 */
	protected static $instance = null;

	/**
	 * @var App
	 */
	public $app = null;

	public $debug = false;

	/**
	 * @param $configFile
	 *
	 * @param bool $isDebug
	 *
	 * @return Application
	 */
	public static function createApplication($configFile, $isDebug)
	{
		set_error_handler(function ($severity, $message, $file, $line) {
			if (error_reporting() & $severity)
			{
				throw new \ErrorException($message, 0, $severity, $file, $line);
			}
		});

//		set_exception_handler(function (\Throwable $e){
//
//			echo "SET_EXCEPTION_HANDLER ";
//			print_r($e);
//		});

//		set_exception_handler(function (\Throwable $e){
////			throw new \ErrorException($exc->getMessage(), 0);//, $severity, $file, $line);
////			echo "ECX ";
////			echo $exc;
////			$this->handleError($exc, true);
//
//			$isCli = ( empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0);
//
//			if (!$isCli)
//				http_response_code(500);
//			echo "Startup error: ". $e->getMessage();
//
////			if ($isDebug)
//			{
//				echo " in {$e->getFile()}[{$e->getLine()}]";
////				echo $e->getTraceAsString();
//			}
////		syslog(LOG_EMERG, $e->getMessage());
//			exit(1);
//		});

		if (self::$instance == null)
		{
			try
			{
				Configurator::init(new PHPConfiguratorParser($configFile));

				$settings = Configurator::getSection("framework");
				$className = get_called_class();

				self::$instance = new $className($isDebug);
				self::$instance->init($settings);

				$routing = Configurator::get("app:routing");
				if ($routing)
					$include = @include $routing;
			}

			catch (\Throwable $te)
			{
				self::handleError($te, $isDebug);
			}
		}

		return self::$instance;
	}

	/**
	 * @param \Throwable $e
	 * @param bool $isDebug
	 *
	 * @throws \Throwable
	 */
	public static function handleError(\Throwable $e, $isDebug = true)
	{
		if (!$isDebug)
			throw $e;

		$isCli = (empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0);

		if (!$isCli)
			http_response_code(500);

		$message = "Internal error: ". $e->getMessage();
		$message .= " in {$e->getFile()}[{$e->getLine()}]";
		$message .= "\n";
		$message .= $e->getTraceAsString();

		echo $message;

		exit(1);
	}


	/**
	 * Возвращает объект компонента, указанного в настройках
	 * в секции "components"
	 *
	 * @param string $id ID компонента, напр.: "view"
	 *
	 * @return mixed
	 */
	public function getComponent($id)
	{
		return $this->app->getContainer()->get($id);
	}

	/**
	 * Приватный коструктор для реализации Singleton
	 *
	 * @param boolean $isDebug Режим отладки приложения
	 */
	protected function __construct($isDebug)
	{
		$this->debug = $isDebug;
	}

	/**
	 * @param $configuration
	 *
	 * @throws \Exception
	 */
	protected function init($configuration)
	{
		$isDebug = $this->debug;
		$container = new \Slim\Container($configuration);
		Logger::init(Configurator::getSection("logger"));

		$phpErrorHandler = Configurator::get("app:phpErrorHandler");
		// Это обработчик внутренних ошибок PHP
		if ($phpErrorHandler)
		{
			$container['phpErrorHandler'] = function ($container) use ($phpErrorHandler, $isDebug) {
				return new $phpErrorHandler($container, $isDebug);
			};
		}

		$errorHandler = Configurator::get("app:errorHandler");
		if ($errorHandler)
		{
			$container['errorHandler'] = function ($container) use ($errorHandler, $isDebug) {
				return new $errorHandler($container, $isDebug);
			};
		}

		// компоненты приложения (напр. notAllowedHandler и пр)
		$components = Configurator::getSection("components");

		if (count($components) > 0)
		{
			foreach ($components as $compName => $componentOptions)
			{
				// имя класса создаваемого компонента
				$className = $componentOptions["@class"];
				unset($componentOptions["@class"]);

				$container[$compName] = function ($container) use ($className, $componentOptions) {

					/** @var $comp ApplicationComponent */
					$comp = new $className($container, $componentOptions);
					return $comp->getComponent();
				};
			}
		}

		// Создать Slim приложение
		$this->app = new App($container);

		// подключить middlewares
		$middlewares = Configurator::getSection("middlewares");
		if (count($middlewares) > 0)
		{
			ksort($middlewares);
			foreach ($middlewares as $class => $params)
			{
				/** @var $m Middleware */
				$m = new $class();
				$m->init($params);
				$this->app->add($m);
			}
		}
	}


	/**
	 * @return self
	 */
	public static function getInstance()
	{
		if (self::$instance == null)
			throw new \RuntimeException("Application is not created yet");
		return self::$instance;
	}

	/**
	 * @param bool $silent
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function run($silent = false)
	{
		$res = null;
		try
		{
			$res = $this->app->run($silent);
		}
		catch (\Throwable $t)
		{
			self::handleError($t, $this->debug);
		}
		return $res;
	}

	/**
	 * Выполняет код при уничтожении объекта приложения
	 *
	 * @return void
	 */
	public function __destruct()
	{
		restore_error_handler();
	}

	/**
	 * Клонировать тоже запретим
	 *
	 * @throws \RuntimeException
	 * @return void
	 */
	public function __clone()
	{
		throw new \RuntimeException("Can't clone singleton object");
	}

	public function __wakeup()
	{
		throw new \RuntimeException("Can't unserialize singleton object");
	}
}

