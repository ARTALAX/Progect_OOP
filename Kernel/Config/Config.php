<?php
namespace App\Kernel\Config;

class Config
{
	public function get(string $key, $default = null)
	{
		[$file, $key] = explode('.', $key);
		$configPath = "../../config/$file.php";
		if (!file_exists($configPath)) {
			return $default . "asdsdd";
		}
		$config = require $configPath;
		return $config[$key] ?? $default;
	}
}