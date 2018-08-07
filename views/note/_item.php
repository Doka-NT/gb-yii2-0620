<?php

use app\models\Note;

/* @var $model Note */

$name = \yii\helpers\Html::encode($model->name);

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<b><?=\yii\helpers\Html::a($name, ['note/view', 'id' => $model->id]);?></b>
	</div>
	<div class="panel-body">
		<p>Автор: <?=$model->author->username;?></p>
		<p>Создано: <?=\Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y H:i');?></p>
		<p>Обновлено: <?=\Yii::$app->formatter->asDate($model->updated_at, 'php:d.m.Y H:i');?></p>
	</div>
</div>
