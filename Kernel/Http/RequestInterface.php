<?php
namespace App\Kernel\Http;

interface RequestInterface
{
	public static function createFromGlobals(): static;
}