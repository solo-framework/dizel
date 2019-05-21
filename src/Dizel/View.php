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

use Psr\Container\ContainerInterface;
use ReflectionClass;
use Slim\Http\Response;
use Slim\Views\Twig;

abstract class View extends Controller
{

	/**
	 * @var Twig
	 */
	protected $view = null;


	public function __construct(ContainerInterface $container)
	{
		$this->view = $container->get("view");
		parent::__construct($container);
	}


	public function render(Response $response, $templateFile)
	{
		$data = [];

		// помещаем в шаблон публичные переменные представления
		$rc = new ReflectionClass($this);
		$props = $rc->getProperties(\ReflectionProperty::IS_PUBLIC);

		foreach ($props as $item)
		{
			$name = $item->getName();
			$data[$name] = $this->$name;
		}
		return $this->view->render($response, $templateFile, $data);
	}
}

