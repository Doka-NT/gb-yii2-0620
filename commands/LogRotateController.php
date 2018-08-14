<?php

namespace app\commands;

use app\models\AccessLog;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class LogRotateController extends Controller
{
	/**
	 * @return int
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionAccess(): int
	{
//		AccessLog::deleteAll([
//			'<', 'access_date', date('Y-m-d H:i:s')
//		]);

		$total = AccessLog::find()->count('id');

		Console::startProgress(0, $total);
		foreach (AccessLog::find()->each() as $index => $model) {
			/* @var $model AccessLog */
			$model->delete();
			Console::updateProgress($index+1, $total);
		}

		Console::endProgress();

		return ExitCode::OK;
	}
}