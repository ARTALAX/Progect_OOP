<?php
namespace App\Kernel\View;

class View
{
	public function pageView(string $name)
	{
		extract([
			'view' => $this
		]);

		require_once "../views/pages/$name.php";
	}
	public function component(string $name): void
	{

		require_once "../views/components/$name.php";
	}
}