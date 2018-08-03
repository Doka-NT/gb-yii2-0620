<?php

use app\objects\ViewModels\NoteCreateView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Note */
/* @var $form yii\widgets\ActiveForm */
/* @var $viewModel NoteCreateView */

?>


<div class="note-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'users')
		->checkboxList($viewModel->getUserOptions(), ['separator' => '<br/>'])
		->label('Пользователи')
		->hint('Пользователи, которые будут иметь доступ к заметке')
	; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
