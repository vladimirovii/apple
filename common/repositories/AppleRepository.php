<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\Apple;
use yii\web\NotFoundHttpException;

class AppleRepository
{
    /**
     * @throws NotFoundHttpException
     */
    public function getById(int $id): Apple
    {
        if (null !== ($apple = Apple::findOne($id))) {
            return $apple;
        }

        throw new NotFoundHttpException();
    }

    /**
     * @return Apple[]
     */
    public function findAll(): array
    {
        return Apple::find()->all();
    }
}
