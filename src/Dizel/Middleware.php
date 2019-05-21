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

abstract class Middleware
{
	/**
	 * Создает атрибуты обработчика, описанные в конфигурации
	 *
	 * @param array $params Список атрибутов
	 *
	 * @return void
	 */
	public function init($params = array())
	{
		foreach ($params as $k => $v)
		{
			$this->$k = $v;
		}
	}
}

