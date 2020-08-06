<?php

namespace common\modules\statistic;

use Yii;

/**
 * module definition class
 */
class Module extends yii\base\Module
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::configure($this, require __DIR__ . '/config.php');
    }
}
