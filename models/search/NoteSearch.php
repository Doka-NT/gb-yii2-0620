<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\caching\ExpressionDependency;
use yii\data\ActiveDataProvider;
use app\models\Note;

/**
 * NoteSearch represents the model behind the search form of `app\models\Note`.
 */
class NoteSearch extends Note
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Note::find();

//        $dependency = new DbDependency([
//        	'sql' => 'SELECT COUNT(id) FROM note',
//		]);

//        $query->cache(3600, $dependency);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => 2,
			]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        $query->leftJoin(['access' => 'access'], 'note.id = access.note_id');
        $query->andWhere(
        	[
        		'or',
				['author_id' => \Yii::$app->user->getId()],
				['access.user_id' => \Yii::$app->user->getId()],
			]

		);

        return $dataProvider;
    }
}
