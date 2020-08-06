<?php

namespace common\modules\statistic\widgets\chart_statistics;

use common\modules\statistic\widgets\chart_statistics\assets\ChartStatisticAsset;
use yii\base\Widget;
use yii\widgets\ActiveForm;

class ChartStatisticsWidget extends Widget
{
    /**
     * @var $form ActiveForm
     */
    public $model;
    public $attributeId = 'lineChart';
    public $height = '50';
    public $labels;
    public $dataChartViews;
    public $dataChartHitViews;

    public function init()
    {
        $view = $this->getView();
        ChartStatisticAsset::register($view);

        $scriptBar = '
        var f=document.getElementById("'. $this->attributeId .'");
        new Chart(f, {
            type:"bar", data: {
                labels:'. $this->labels .', 
                datasets:[ 
                    {
                        label: "Унікальні відвідувачі", 
                        backgroundColor: "#26B99A", 
                        data: '. $this->dataChartHitViews .'
                    },
                    {
                        label: "Кількість відвідувань", 
                        backgroundColor: "#03586A", 
                        data: '. $this->dataChartViews .'
                    }
                ]
            }, 
            options: {
                scales: {
                    yAxes:[{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        });
        ';

        $scriptLine = '
        var f=document.getElementById("'. $this->attributeId .'");
        new Chart(f, {
            type:"graph", data: {
                labels:'. $this->labels .',
                datasets:[ {
                    label: "Унікальні відвідувачі",
                    backgroundColor: "rgba(38, 185, 154, 0.31)",
                    borderColor: "rgba(38, 185, 154, 0.7)",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: '. $this->dataChartHitViews .'
                }, {
                    label: "Кількість відвідувань",
                    backgroundColor: "rgba(3, 88, 106, 0.3)",
                    borderColor: "rgba(3, 88, 106, 0.70)",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: '. $this->dataChartViews .'
                    }
                ]
            }
        });
';
        $view->registerJs($scriptBar);

        parent::init();
    }

    public function run()
    {
        return '<canvas id="' . $this->attributeId . '" height="' . $this->height . '"></canvas>';
    }
}
