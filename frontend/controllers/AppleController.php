<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\repositories\AppleRepository;
use frontend\service\AppleService;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;

class AppleController extends Controller
{
    public function __construct(
        $id,
        $module,
        private AppleService $appleService,
        private AppleRepository $appleRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionEat(Request $request, int $id): Response
    {
        $apple = $this->appleRepository->getById($id);

        $model = new DynamicModel(['percent']);
        $model->addRule(['percent'], 'required')
            ->addRule(['percent'], 'number')
            ->addRule(['percent'], 'compare', ['operator' => '>', 'compareValue' => 0])
        ;

        if ($model->load($request->post(), '') && $model->validate()) {
            $this->appleService->eat($apple, (int) $model->percent);
        }

        return $this->redirect(['site/index']);
    }

    public function actionFall(Request $request, int $id): Response
    {
        $apple = $this->appleRepository->getById($id);

        $this->appleService->fall($apple);

        return $this->redirect(['site/index']);
    }
}
