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

		"version" => 1,
		"loggers" => [
			"default" => [
				"handlers" => ["stdout", "file"]
			]
		],
		"handlers" => [
//			"stdout" => [
//				"class" => "Monolog\Handler\StreamHandler",
//				"level" => "DEBUG",
//				"stream" => "php://stdout"
//			],
			"file" => [
				"class" => "Monolog\Handler\StreamHandler",
				"level" => "ERROR",
				"stream" => "var/log/log.log"
			]
		]
	],

	"app" => [
//		"debug"   => false,
		"routing" => "config/routing.php",
		"phpErrorHandler" => \Dizel\Components\InternalErrorHandler::class,
	],

	"components" => [
		"view" => [
			"@class"  => \Dizel\Components\Twig::class,

			// Twig_Environment options
			"options" => [
				"path"       => "src/app/templates",
				"debug"      => true,
				"cache"      => "var/cache",
				"extensions" => [
					//Twig_Extension_Debug::class
					\Twig\Extension\DebugExtension::class
				],
				"filters"    => [],
				"functions"  => [],
				"tags"       => [],

				"tests" => [],
			]

		]
	],

	"middlewares" => [

		Dizel\Middleware\Session::class => [

			"providerClass" => \Dizel\Session\File::class,
			"sessionName" => "test",
			"options"     => [
				'sessionOptions' => [
					'save_path' => 'var/sessions/',
					'cookie_domain'   => 'localhost',//'.citycard.ru',
					"cache_expire"    => 180,
					"cache_limiter"   => 'nocache',
					"gc_maxlifetime"  => 60 * 30,
					"gc_probability"  => 10,
					"cookie_httponly" => true,
					"use_strict_mode" => true,
					"cookie_secure"   => false //- TRUE только при https
				]
			]
		],

		Dizel\Middleware\Test::class => [
			"p1" => "param1",
			"p2" => "param2",
		],
	],

];