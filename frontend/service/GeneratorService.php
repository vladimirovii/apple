<?php

declare(strict_types=1);

namespace frontend\service;

use common\exceptions\CantSave;
use common\models\Apple;

class GeneratorService
{
    public function generate(): void
    {
        \Yii::$app->db->createCommand('truncate apple')->execute();

        for ($j = 0; $j < rand(10, 60); $j++) {
            $apple = new Apple();
            if (! $apple->save()) {
                throw new CantSave($apple);
            }
        }
    }
}
