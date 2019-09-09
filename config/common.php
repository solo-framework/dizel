<?php
/**
 *
 *
 * PHP version 5
 *
 * @package
 * @author  Andrey Filippov <afi@i-loto.ru>
 */

return [
	"framework" => [
		'settings' => [
//			"debug"               => false,
			'displayErrorDetails' => false,
			"outputBuffering"     => "append",
			"routerCacheFile"     => false
		],
	],

	"app" => [
//		"debug"   => false,
		"phpErrorHandler" => "",
		"errorHandler" => "",
		"routing" => ""
	],

	"logger" => [

		"version" => 1,
		"loggers" => [
			"default" => [
				"handlers" => ["stdout"]
			]
		],
		"handlers" => [
			"stdout" => [
				"class" => "Monolog\Handler\StreamHandler",
				"level" => "DEBUG",
				"stream" => "php://stdout"
			],

		]
	],
];
