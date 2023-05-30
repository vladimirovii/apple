<?php

/** @var \yii\web\View $this */
/** @var \common\models\Apple[] $apples */

use yii\helpers\Html;

$this->title = 'Apple tree';

foreach ($apples as $apple) {
    $form = '';
    if ($apple->isHang()) {
        $form = Html::beginForm(['apple/fall', 'id' => $apple->id]);
        $form .= Html::submitButton('Fall');
        $form .= Html::endForm();
    } elseif ($apple->isFall()) {
        $form = Html::beginForm(['apple/eat', 'id' => $apple->id]);
        $form .= Html::textInput('percent');
        $form .= Html::textInput('size', $apple->getSize(), ['disabled' => true]);
        $form .= Html::submitButton('Eat');
        $form .= Html::endForm();
    }

    echo Html::tag('div', $form, ['style' => sprintf('border:2px solid %s;border-radius: 30px;', $apple->color)]);
}

echo Html::a('Cгенерировать', ['generate/index']);
