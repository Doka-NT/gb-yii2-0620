<?php

namespace app\widgets;

use yii\base\Widget;

class MyCoolWidget extends Widget
{
	public $param1 = '';

	public function run(): string
	{
		return $this->render('@app/views/widgets/my-cool', [
			'param1' => $this->param1,
		]);
	}
}
