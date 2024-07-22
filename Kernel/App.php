<?php

namespace App\Kernel;

use App\Kernel\Http\Request;
use App\Kernel\Database\Database;
use App\Kernel\Config\Config;
use App\Kernel\Config\ConfigInterface;

class App
{
	public readonly Database $database;
	public readonly ConfigInterface $config;
	public function run()
	{
		require_once dirname(__DIR__) . '/config/routes.php';
		$request = Request::createFromGlobals();
		try {
			$this->config = new Config;
			$this->database = new Database($this->config);
		} catch (\Exception $e) {
			echo "Ошибка: " . $e->getMessage();

		}

	}
}