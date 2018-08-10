<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notes';
$this->params['breadcrumbs'][] = $this->title;
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<div class="note-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Note', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<?=\yii\widgets\ListView::widget([
			'dataProvider' => $dataProvider,
		'itemView' => '_item',
	]);?>
</div>

<?=\app\widgets\MyCoolWidget::widget([
	'param1' => 'hellow, world',
]);?>
