<?php
namespace App\Kernel\Http;

class Redirect implements RedirectInterface
{
	public function to($url)
	{
		header("Location: $url");
		exit();
	}
}