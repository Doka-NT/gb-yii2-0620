<?php

use app\objects\ViewModels\NoteCreateView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Note */
/* @var $viewModel NoteCreateView */

$this->title = 'Create Note';
$this->params['breadcrumbs'][] = ['label' => 'Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'viewModel' => $viewModel,
    ]) ?>

</div>
