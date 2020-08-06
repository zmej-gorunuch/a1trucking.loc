<?php

namespace common\modules\statistic\widgets\chart_statistics\assets;

use yii\web\AssetBundle;

/**
 * DropZone image asset bundle.
 */
class ChartStatisticAsset extends AssetBundle
{
    public $css = [

    ];
    public $js = [
        'js/Chart.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ ;
        $this->baseUrl = '@web';
        parent::init();
    }
}
