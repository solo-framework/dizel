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
use Twig\Error\LoaderError;

abstract class View extends Controller
{

	/**
	 * @var Twig
	 */
	protected $view = null;


	/**
	 * View constructor.
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->view = $container->get("view");
		parent::__construct($container);
	}


	/**
	 * Render the controller
	 * Отрисовывает контроллер и записывает в Response
	 *
	 * @param Response $response
	 * @param null $templateFile
	 * @param string $ext
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function display(Response $response, $templateFile = null, $ext = "twig")
	{
		return $response->write($this->render($templateFile, $ext));
	}

	/**
	 * Отрисовывает контроллер и возвращает в виде строки
	 *
	 * @param string|null $templateFile Название файла с шаблоном
	 * @param string $ext Расширение файла шаблона
	 *
	 * @return string
	 */
	public function render($templateFile = null, $ext = "twig")
	{
		$data = [];

		// помещаем в шаблон публичные переменные представления
		$rc = new ReflectionClass($this);
		$props = $rc->getProperties(\ReflectionProperty::IS_PUBLIC);

		if ($templateFile == null)
			$templateFile = $rc->getShortName() . ".{$ext}";

		foreach ($props as $item)
		{
			$name = $item->getName();
			$data[$name] = $this->$name;
		}

		try
		{
			return $this->view->fetch($templateFile, $data);
		}
		catch (LoaderError $e)
		{
			return "View render error: " . $e->getMessage();
		}
	}

	/**
	 * Возвращает компонент шаблонизатора
	 *
	 * @return mixed|Twig
	 */
	public function getViewComponent()
	{
		return $this->view;
	}
}

