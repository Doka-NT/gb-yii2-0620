<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Access */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accesses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Access', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?=\yii\widgets\ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_item',
		'viewParams' => $viewModel,
 	]);?>

	<?= GridView::widget(
		[
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				[
					'class' => 'yii\grid\SerialColumn',

				],
				'id',
				'note.name:raw',
				[
					'value' => function (\app\models\Access $model) {
						return Html::a($model->user->username, ['user/view', 'id' => $model->id]);
					},
					'format' => 'raw',
				],

				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{view}  {delete}',
					'visibleButtons' => [
						'delete' => false,
					],
				],
			],
		]
	); ?>
</div>
