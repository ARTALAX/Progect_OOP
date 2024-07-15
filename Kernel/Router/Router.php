<?php
namespace App\Kernel\Router;

class Router
{
	private static $routes = [];

	// Метод для добавления маршрутов
	public static function route(string $uri, $handler): void
	{
		self::$routes[$uri] = $handler;
	}

	// Метод для обработки запроса
	public static function handleRequest(): void
	{
		$query = $_GET['q'] ?? null;

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists($query, self::$routes)) {
			// Обработка POST-запросов
			$handler = self::$routes[$query];

			if (is_callable($handler)) {
				call_user_func($handler);
				die();
			} elseif (is_string($handler) && strpos($handler, '@') !== false) {
				[$className, $methodName] = explode('@', $handler);
				$classFile = "../controllers/{$className}.php";

				if (file_exists($classFile)) {
					require_once $classFile;

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
				} else {
					self::error(404);
				}
			} elseif (is_string($handler)) {
				$file = "../views/pages/{$handler}.php";
				if (file_exists($file)) {
					require_once $file;
					die();
				} else {
					self::error(404);
				}
			}
		}

		// Обработка GET-запросов
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
				$classFile = "../../controllers/{$className}.php";

				if (file_exists($classFile)) {
					require_once $classFile;

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
				} else {
					self::error(404);
				}
			} elseif (is_string($handler)) {
				$file = "../views/pages/{$handler}.php";
				if (file_exists($file)) {
					require_once $file;
					die();
				} else {
					require_once "../views/pages/admin/movies/" . $handler . ".php";
					// self::error(404);
				}
			}
		}

		self::error(404);
	}

	// Метод для обработки ошибок
	private static function error($err): void
	{
		require_once "../errors/{$err}.php";
	}

	// Метод для получения всех маршрутов (если необходимо)
	public static function getRoutes(): array
	{
		return self::$routes;
	}
}
