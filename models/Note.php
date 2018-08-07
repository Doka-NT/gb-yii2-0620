<?php

namespace app\models;

use app\models\queries\NoteQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
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

	public static function find(): NoteQuery
	{
		return new NoteQuery(get_called_class());
	}

	public function beforeSave($insert): bool
	{
		if (!$this->author_id) {
			$this->author_id = \Yii::$app->getUser()->getId();
		}

		return parent::beforeSave($insert);
	}

//	public function behaviors()
//	{
//		return [
//			'timestamp' => [
//				'class' => TimestampBehavior::class,
//				'createdAtAttribute' => 'created_at',
//				'updatedAtAttribute' => 'updated_at',
//			],
//		];
//	}

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
			['author_id', 'integer'],
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

	/**
	 * @return ActiveQuery
	 */
	public function getAccess(): ActiveQuery
	{
		return $this->hasOne(Access::class, ['note_id' => 'id']);
    }
}
