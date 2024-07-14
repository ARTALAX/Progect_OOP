<?php

namespace App\Kernel;

use App\Kernel\Http\Request;


class App
{
	public function run()
	{
		require_once dirname(__DIR__) . '/config/routes.php';
		$request = Request::createFromGlobals();

		dd($request);
	}
}