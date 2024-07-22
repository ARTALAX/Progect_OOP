<?php
use App\Kernel\Router\Router;

Router::route('home', 'home');
Router::route('books', 'books');
Router::route('add', 'add');
Router::route('info', 'info');
Router::route('validate-form', 'FormController@validateForm');
// Router::route('validate-form', 'FormController@validateForm');
// Router::route('validate-form', 'FormController@validateForm');
Router::handleRequest();
return Router::getRoutes();