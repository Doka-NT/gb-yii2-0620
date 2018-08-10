<?php

namespace app\modules\admin;

use app\modules\admin\assets\AdminLtePluginAsset;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'app\modules\admin\controllers';

	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
		$this->layout = '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app/layouts/main.php';
		parent::init();
		// custom initialization code goes here

		AdminLtePluginAsset::register(\Yii::$app->view);
	}
}
