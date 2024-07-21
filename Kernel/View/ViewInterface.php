<?php
namespace App\Kernel\View;

interface ViewInterface
{
	public function pageView(string $name);
	public function component(string $name): void;

}