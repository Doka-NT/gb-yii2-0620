<?php

use app\models\forms\NoteForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model NoteForm */

?>

<?php $form = ActiveForm::begin();?>
	<?=$form->field($model, 'name')->textInput();?>

	<?=$form->field($model, 'username')->textInput();?>
	<?=$form->field($model, 'password')->passwordInput();?>

	<?=Html::submitButton('Сохранить');?>
<?php ActiveForm::end();?>
