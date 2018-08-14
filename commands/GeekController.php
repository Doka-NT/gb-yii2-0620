<?php

namespace app\commands;

use app\models\Note;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\ActiveRecord;
use yii\helpers\BaseArrayHelper;
use yii\helpers\Console;

class GeekController extends Controller
{
	public $foo = [];
	public $bar;

	public function options($actionID): array
	{
		$options = parent::options($actionID);

		if ($actionID === 'option') {
			$options = BaseArrayHelper::merge($options, [
				'foo',
				'bar',
			]);
		}

		return $options;
	}

	/**
	 * Действие по-умолчанию
	 */
	public function actionIndex(): int
	{
		echo "Hello, Friend!\n";

		return ExitCode::OK;
	}

	/**
	 * Количество моделей
	 */
	public function actionCount(string $className): int
	{
		if (!\is_subclass_of($className, ActiveRecord::class)) {
			$msg = sprintf("Class %s is not subclass of ActiveRecord\n", $className);

			echo $this->ansiFormat($msg, Console::FG_RED);

			return ExitCode::USAGE;
		}

		$count = Note::find()->count('id');

		$msg = sprintf("Total of %s is: %d\n", Note::class, $count);

		echo $this->ansiFormat($msg, Console::BG_GREEN, Console::FG_BLACK);
		$this->ansiFormat('', Console::FG_BLACK);

		return ExitCode::OK;
	}

	/**
	 * Команда проверки опций
	 */
	public function actionOption(): int
	{
		var_dump($this->foo, $this->bar);
		return ExitCode::OK;
	}
}