<?php

/* @var $this yii\web\View */
/* @var $model Note */

use app\models\Note;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin();?>
		<?=$form->field($model, 'name')->textInput();?>

		<?=$form->field($model, 'ids')->dropDownList([
				10 => 'x10',
				20 => 'x20',
				30 => 'x30',
				'foo' => 'foo',
		])->label('Какие-то идентификаторы');?>
	<?php ActiveForm::end();?>
</div>
