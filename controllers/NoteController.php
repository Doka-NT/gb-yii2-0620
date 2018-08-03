<?php

namespace app\controllers;

use app\models\forms\NoteForm;
use app\models\Note;
use app\models\search\NoteSearch;
use app\objects\ViewModels\NoteCreateView;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * NoteController implements the CRUD actions for Note model.
 */
class NoteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Note models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoteSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Note model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$note = $this->findModel($id);

		$author = $note->author;
		$notes = $author->notes;

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Note model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Note();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $viewModel = new NoteCreateView();

        return $this->render('create', [
            'model' => $model,
			'viewModel' => $viewModel,
        ]);
    }

    /**
     * Updates an existing Note model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Note model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

	/**
	 * @return mixed
	 * @throws \yii\base\InvalidConfigException
	 */
	public function actionBigForm()
	{
		$bodyParams = \Yii::$app->getRequest()->getBodyParams();

		$model = new NoteForm();

		if ($model->load($bodyParams) && $model->createUserAndSave())  {
			return $this->redirect(['note/view', 'id' => $model->id]);
		}

		return $this->render('big-form', [
			'model' => $model,
		]);
    }

    /**
     * Finds the Note model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Note::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	/**
	 * @return string
	 */
	public function actionIndexCalendar(): string
	{
		$dates = [
			'2018-08-01',
			'2018-08-02',
			// ...
			'2018-08-30',
		];

		$notes = Note::find()
			->byDates($dates)
			->all();

		$days = [];
		foreach ($notes as $note) {
			if (isset($days[$note->created_at])) {
				$days[$note->created_at] = [];
			}

			$days[$note->created_at][] = $note;
		}

		return $this->render('calendar', [
			'days' => $days,
		]);

		// in calendar.php
//		foreach ($days as $day => $notes) {
//			$count = count($notes);
//		}
    }
}
