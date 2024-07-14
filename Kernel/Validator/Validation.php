<?php
use App\Kernel\Validator\Validator;

$data = [
	'name' => 'Игорь',
	'email' => 'igor@example.com',
	'age' => '25',
	'website' => 'http://example.com',
	'is_active' => '1'
];

$rules = [
	'name' => 'required|min:3|max:50',
	'email' => 'required|email',
	'age' => 'required|int|min:18',
	'website' => 'required|url',
	'is_active' => 'required|boolean'
];

$validator = new Validator();
$errors = $validator->validate($data, $rules);
if (empty($errors)) {
	echo "Все данные валидны!";
} else {
	echo "Есть ошибки в данных:";
	print_r($errors);
}