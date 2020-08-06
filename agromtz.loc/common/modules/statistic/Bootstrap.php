<?php

namespace common\modules\statistic;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            //Backend
            'admin/<module:statistic>/<date:now|month|year>' => '<module>/default/index',
            'admin/<module:statistic>' => '<module>/default/index',
            'admin/<module:statistic>/<action:create|sorting|delete-select|status-select>' => '<module>/default/<action>',
            'admin/<module:statistic>/<action:update|delete|page|status>/<id:\d+>' => '<module>/default/<action>',
            //Frontend
                // Image
            '<module:statistic>/<action:del-image|gallery-sorting|sorting-images|del-images|del-all-images>' => '<module>/default/<action>',
        ], false);
    }
}