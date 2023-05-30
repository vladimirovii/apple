<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\service\GeneratorService;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;

class GenerateController extends Controller
{
    public function __construct(
        $id,
        $module,
        private GeneratorService $generatorService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(Request $request): Response
    {
        $this->generatorService->generate();

        return $this->redirect(['site/index']);
    }
}
