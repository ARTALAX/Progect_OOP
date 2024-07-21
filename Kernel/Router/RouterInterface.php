<?php
namespace App\Kernel\Router;

interface RouterInterface
{
	public static function route(string $uri, $handler): void;
	public static function handleRequest(): void;
	public static function getRoutes(): array;

}