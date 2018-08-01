<?php

namespace app\models\forms;

use app\models\Note;
use app\models\User;

class NoteForm extends Note
{
	public $username;
	public $password;

	public function rules(): array
	{
		$rules = parent::rules();
		$rules[] = [['username', 'password'], 'required'];

		return $rules;
	}

	public function createUserAndSave(): bool
	{
		$user = new User();
		$user->username = $this->username;
		$user->password = $this->password;

		if ($user->save()) {
			$this->save();
			$this->link('author', $user);

			return true;
		}

		return false;
	}


}