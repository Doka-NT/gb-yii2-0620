<?php

namespace app\models\queries;

use yii\db\ActiveQuery;

class NoteQuery extends ActiveQuery
{
	/**
	 * Отфильтровать заметки по дате создания
	 *
	 * @param array $dates
	 *
	 * @return self
	 */
	public function byDates(array $dates): self
	{
		return $this->andWhere(['in', 'created_at', $dates]);
	}
}