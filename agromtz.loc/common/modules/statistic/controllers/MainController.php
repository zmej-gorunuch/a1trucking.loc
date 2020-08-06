<?php

namespace common\modules\statistic\controllers;

use common\modules\statistic\models\Statistic;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Головний контроллер
 */
abstract class MainController extends Controller
{
    protected $model;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => function() {
                    if (Yii::$app->user->isGuest) {
                        return Yii::$app->response->redirect(Url::toRoute(['/user/security/login']));
                    }
                    return Yii::$app->response->redirect(Url::toRoute(['/admin/main/forbidden']));
                },
            ],
        ];
    }

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->model = new Statistic();
    }
}