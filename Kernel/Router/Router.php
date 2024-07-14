<?php
namespace App\Kernel\Router;

class Router
{
	// private static $require;
	private static $list = [];
	public static function page(string $uri, string $page_name): void
	{
		self::$list[] = [
			"uri" => $uri,
			"page" => $page_name
		];

	}
	public static function enable(): void
	{
		$query = $_GET['q'] ?? null;
		if (!isset($query)) {
			require_once "../views/pages/home.php";
			die();
		}
		foreach (self::$list as $route) {
			if ($route["uri"] === '/' . $query) {
				$require = "../views/pages/" . $route['page'] . ".php";
				if (file_exists($require)) {
					require_once "../views/pages/" . $route['page'] . ".php";
					die();

				} else {
					require_once "../views/pages/admin/movies/" . $route['page'] . ".php";
					die();
				}



			}
		}
		self::error(404);
	}

	private static function error($err): void
	{
		require_once "../errors/" . $err . ".php";
	}
	public static function getRoutes()
	{
		return require_once '../config/routes.php';
	}

}