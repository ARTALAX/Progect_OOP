<?php

namespace App\Kernel\Router;

class Router implements RouterInterface
{
	private static $routes = [];

	public static function route(string $uri, $handler): void
	{
		self::$routes[$uri] = $handler;
	}

	public static function handleRequest(): void
	{
		$query = $_GET['q'] ?? null;

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists($query, self::$routes)) {
			$handler = self::$routes[$query];

			if (is_callable($handler)) {
				call_user_func($handler);
				die();
			} elseif (is_string($handler) && strpos($handler, '@') !== false) {
				[$className, $methodName] = explode('@', $handler);
				$className = "App\\Controllers\\{$className}";

				try {
					if (class_exists($className)) {
						$classInstance = new $className();
						if (method_exists($classInstance, $methodName)) {
							$classInstance->$methodName();
							die();
						} else {
							throw new \Exception("Метод {$methodName} не существует в классе {$className}");
						}
					} else {
						throw new \Exception("Класс {$className} не существует");
					}
				} catch (\Exception $e) {
					echo "Ошибка: " . $e->getMessage();
					die();
				}
			}
		}

		if (!isset($query)) {
			require_once "../views/pages/home.php";
			die();
		}

		if (array_key_exists($query, self::$routes)) {
			$handler = self::$routes[$query];

			if (is_callable($handler)) {
				call_user_func($handler);
				die();
			} elseif (is_string($handler) && strpos($handler, '@') !== false) {
				[$className, $methodName] = explode('@', $handler);
				$className = "App\\Controllers\\{$className}";

				try {
					if (class_exists($className)) {
						$classInstance = new $className();
						if (method_exists($classInstance, $methodName)) {
							$classInstance->$methodName();
							die();
						} else {
							self::error(404);
						}
					} else {
						self::error(404);
					}
				} catch (\Exception $e) {
					echo "Ошибка: " . $e->getMessage();
					die();
				}
			} elseif (is_string($handler)) {
				$file = "../views/pages/{$handler}.php";
				if (file_exists($file)) {
					require_once $file;
					die();
				} else {
					require_once "../views/pages/admin/movies/" . $handler . ".php";
					die();
				}
			}
		}

		self::error(404);
	}

	private static function error($err): void
	{
		require_once "../errors/{$err}.php";
	}

	public static function getRoutes(): array
	{
		return self::$routes;
	}
}
