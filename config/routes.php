<?php
use App\Kernel\Router\Router;

Router::page('/home', 'home');
Router::page('/books', 'books');
Router::page('/add', 'add');
Router::enable();