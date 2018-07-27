<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "note".
 *
 * @property int $id
 * @property string $name Название заметки
 * @property string $created_at Создано
 * @property string $updated_at Обновлено
 * @property int $author_id
 * @property User $author
 */
class Note extends \yii\db\ActiveRecord
{
	public $ids = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        	['id', 'integer'],
			['ids', 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название заметки',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

	/**
	 * @return ActiveQuery
	 */
	public function getAuthor(): ActiveQuery
	{
		return $this->hasOne(User::class, ['id' => 'author_id']);
    }
}
