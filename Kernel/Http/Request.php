<?php
namespace App\Kernel\Http;

class Request
{
	public function __construct(
		public readonly array $get,
		public readonly array $post,
		public readonly array $files,
		public readonly array $server,
		public readonly array $cookies,

	) {
	}
	public static function createFromGlobals(): static
	{

		return new static($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
		
	}

}