<?php

namespace app\models\forms;

use app\models\Access;
use app\models\Note;
use app\models\User;

class NoteForm extends Note
{
	public $users = [];

	public function rules(): array
	{
		$rules = parent::rules();
		$rules[] = ['users', 'checkUser'];

		return $rules;
	}

	/**
	 * @return void
	 */
	public function checkUser(): void
	{
		foreach ($this->users as $userId) {
			$count = (int)User::find()->andWhere(['id' => $userId])->count('id');
			if ($count === 0) {
				$this->addError('users', \sprintf('Пользователя с ID=%d не существует', $userId));
			}
		}
	}

	public function afterFind()
	{
		parent::afterFind();

		$this->users = Access::find()->select(['user_id'])->andWhere(['note_id' => $this->id])->column();
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
		Access::deleteAll(['note_id' => $this->id]);

		foreach ($this->users as $userId) {
			Access::saveAccess($this, $userId);
		}
	}
}