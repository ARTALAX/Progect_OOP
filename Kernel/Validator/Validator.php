<?php
namespace App\Kernel\Validator;

class Validator
{
	private $errors = [];

	public function validate($data, $rules)
	{
		foreach ($rules as $field => $rule) {
			$value = isset($data[$field]) ? $data[$field] : null;
			$this->applyRule($field, $value, $rule);
		}
		return $this->errors;
	}

	private function applyRule($field, $value, $rule)
	{
		$rules = explode('|', $rule);
		foreach ($rules as $rule) {
			if (strpos($rule, ':') !== false) {
				list($ruleName, $parameter) = explode(':', $rule);
				$this->{"validate" . ucfirst($ruleName)}($field, $value, $parameter);
			} else {
				$this->{"validate" . ucfirst($rule)}($field, $value);
			}
		}
	}

	private function validateRequired($field, $value)
	{
		if (empty($value)) {
			$this->errors[$field][] = "Поле $field обязательно для заполнения.";
		}
	}

	private function validateMin($field, $value, $parameter)
	{
		if (strlen($value) < $parameter) {
			$this->errors[$field][] = "Поле $field должно быть не менее $parameter символов.";
		}
	}

	private function validateMax($field, $value, $parameter)
	{
		if (strlen($value) > $parameter) {
			$this->errors[$field][] = "Поле $field должно быть не более $parameter символов.";
		}
	}

	private function validateEmail($field, $value)
	{
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$this->errors[$field][] = "Поле $field должно быть действительным адресом электронной почты.";
		}
	}

	private function validateUrl($field, $value)
	{
		if (!filter_var($value, FILTER_VALIDATE_URL)) {
			$this->errors[$field][] = "Поле $field должно быть действительным URL.";
		}
	}

	private function validateInt($field, $value)
	{
		if (!filter_var($value, FILTER_VALIDATE_INT)) {
			$this->errors[$field][] = "Поле $field должно быть целым числом.";
		}
	}

	private function validateBoolean($field, $value)
	{
		if (!filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === null) {
			$this->errors[$field][] = "Поле $field должно быть булевым значением.";
		}
	}
}