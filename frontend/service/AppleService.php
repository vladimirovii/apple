<?php

declare(strict_types=1);

namespace frontend\service;

use common\exceptions\CantSave;
use common\models\Apple;
use yii\base\Exception;

class AppleService
{
    public function eat(Apple $apple, float $percent): void
    {
        if ($apple->isHang()) {
            throw new Exception('Apple is hang, fall to ground before.');
        }

        if ($apple->isSpoiled()) {
            throw new Exception('Apple is spoiled.');
        }

        $apple->eat($percent);
        if ($apple->eat_percent >= 100) {
            $apple->remove();
        } else {
            if (! $apple->save()) {
                throw new CantSave($apple);
            }
        }
    }

    public function fall(Apple $apple)
    {
        if (! $apple->isHang()) {
            throw new Exception('Apple is not hang.');
        }

        $apple->fall();
        if (! $apple->save()) {
            throw new CantSave($apple);
        }
    }
}
