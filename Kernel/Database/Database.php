<?php
namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{
	public function __construct(
		private ConfigInterface $config
	) {

		$this->connect();
	}

	private \PDO $pdo;
	private function connect()
	{
		$driver = $this->config->get('database.driver');
		$host = $this->config->get('database.host');
		$dbname = $this->config->get('database.dbname');
		$user = $this->config->get('database.username');
		$password = $this->config->get('database.password');
		$charset = $this->config->get('database.charset');
		$port = $this->config->get('database.port');


		try {
			$this->pdo = new \PDO("$driver:host=$host;port=$port;dbname=$dbname;charset=$charset", $user, $password);
		} catch (\PDOException $e) {
			throw new \Exception('Database connection failed: ' . $e->getMessage());
		}
	}
}