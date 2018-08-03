<?php

namespace app\objects\ViewModels;

use app\models\Note;

class NoteView
{
	/**
	 * @param Note $note
	 *
	 * @return bool
	 */
	public function canWrite(Note $note): bool
	{
		return $note->author_id === \Yii::$app->getUser()->getId();
	}
}