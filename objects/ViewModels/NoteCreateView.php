<?php

namespace app\objects\ViewModels;

use app\models\User;

class NoteCreateView
{
	/**
	 * @return array
	 */
	public function getUserOptions(): array
	{
		//		$users = User::find()->all();
		//		return \yii\helpers\BaseArrayHelper::map($users, 'id', 'username');

		return User::find()
			->indexBy('id')
			->select(['username', 'id'])
			->column();
	}
}