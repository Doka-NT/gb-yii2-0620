<?php

namespace app\modules\admin\controllers;

class FooController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
