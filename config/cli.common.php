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
	"@extends" => "./config/common.php",

	"logger" => [

		"version"    => 1,
		"loggers"    => [
			"cli" => [
				"handlers" => ["stdout", "file_cli"]
			]
		],
		"handlers"   => [
			"file_cli" => [
				"class"      => "Monolog\Handler\StreamHandler",
				"level"      => "DEBUG",
				"stream"     => "var/log/cli.log",
				"processors" => ["intro"],
				"formatter"  => "php"
			]
		],
		"processors" => [
			'intro' => [
				"class" => 'Monolog\Processor\IntrospectionProcessor'
			]
		],
		"formatters" => [
			"php" => [
				"class"  => "Monolog\Formatter\LineFormatter",
				"format" => "[%datetime%] %channel%.%level_name%: %message% \nContext: %context% \nExtra: %extra%\n"
			]
		]
	],

	"app" => [
		"debug"   => false,
		"routing" => "config/cli.routing.php",
		"phpErrorHandler" => \Dizel\Components\InternalCliErrorHandler::class,
		"errorHandler" => \Dizel\Components\InternalCliErrorHandler::class,
	],

	"components" => [
		"environment" => [
			"@class"  => \Dizel\Components\ConsoleEnv::class,
			"options" => []
		],
		"cli"         => [
			"@class"  => \Dizel\Components\ConsoleApp::class,//'Core\Components\ConsoleApp',
			"options" => [
				"commands" => [
					"test_command" => App\CLI\Test::class
				]
			]
		]

	],

	"middlewares" => [

//		Core\Middleware\Test::class    => [
//			"p1" => "param1",
//			"p2" => "param2",
//		],
	],
];