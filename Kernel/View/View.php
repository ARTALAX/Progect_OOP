<?php
namespace App\Kernel\View;

use App\Kernel\Session\Session;

class View
{
	public function __construct(
		private Session $session
	) {

	}
	public function pageView(string $name)
	{
		extract(
			$this->defaultData()
		);

		require_once "../views/pages/$name.php";
	}
	public function component(string $name): void
	{

		require_once "../views/components/$name.php";
	}
	private function defaultData()
	{
		return [
			'view' => $this,
			'session' => $this->session,
		];

	}
}