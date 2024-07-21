<?php
namespace App\Kernel\Session;

interface SessionInterface
{
	public function set($key, $value);
	public function get($key, $default = null);
	public function getFlash($key, $default = null);
	public function remove($key);
	public function has($key);
	public function destroy();
}