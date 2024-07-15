<?php
namespace App\Controllers;

use App\Kernel\Validator\Validator;

class FormController
{
	public function validateForm()
	{
		// Данные формы, которые нужно валидировать (например, из $_POST)
		$formData = [
			'name' => $_POST['name'] ?? '',
			'email' => $_POST['email'] ?? '',
		];

		// Правила валидации
		$rules = [
			'name' => 'required|min:3|max:50',
			'email' => 'required|email',
		];

		// Создаем экземпляр валидатора и валидируем данные
		$validator = new Validator();
		$errors = $validator->validate($formData, $rules);

		if (!empty($errors)) {
			// Обработка ошибок валидации
			foreach ($errors as $field => $messages) {
				foreach ($messages as $message) {
					echo "<p>$message</p>";
				}
			}
		} else {
			// Успешная обработка формы
			echo "<p>Форма успешно валидирована!</p>";
		}
	}
}

