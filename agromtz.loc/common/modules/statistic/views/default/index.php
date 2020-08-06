<?php

use common\modules\statistic\controllers\StatisticController;
use common\modules\statistic\models\Statistic;
use common\modules\statistic\widgets\chart_statistics\ChartStatisticsWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $countViews StatisticController */
/* @var $countHitViews StatisticController */
/* @var $dataChartViews StatisticController */
/* @var $dataChartHitViews StatisticController */

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="x_panel">

    <!-- table header -->
    <div class="x_title">
        <div class="row">
            <div class="col-sm-10 col-xs-12">
                <h2><i class="fa fa-angle-double-right"></i> <?= Html::encode($this->title) ?></h2>
                <ul class="hiden nav navbar-right panel_toolbox">
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-expanded="false"><i class="fa fa-check-square-o"></i> Керування вибраними <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <?= Html::a('Змінити статус', ['status-select'], [
                                    'data-method' => 'post',
                                    'data-confirm' => 'Ви впевнені?'
                                ]) ?>
                            </li>
                            <li>
                                <?= Html::a('Видалити', ['delete-select'], [
                                    'data-method' => 'post',
                                    'data-confirm' => 'Ви впевнені?'
                                ]) ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /table header -->

    <div class="x_content">
        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row">
                <div class="col-xs-12">

                    <? try {
                        echo ChartStatisticsWidget::widget([
                            'model' => new Statistic(),
                            'labels' => $labels,
                            'dataChartViews' => $dataChartViews,
                            'dataChartHitViews' => $dataChartHitViews,
                        ]);
                    } catch (Exception $e) {
                        Yii::error($e);
                    } ?>

<!--                    <div style="text-align: center; margin-bottom: 15px;">-->
<!--                        <p>Статистика перегляду сайту за день</p>-->
<!--                        <div class="btn-group" role="group" aria-label="First group">-->
<!--                            <button type="button" class="btn btn-default btn-sm">За день</button>-->
<!--                            <button type="button" class="btn btn-default btn-sm">За місяць</button>-->
<!--                            <button type="button" class="btn btn-default btn-sm">За рік</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <ul class="list-inline widget_tally">-->
<!--                            <li>-->
<!--                                <p>-->
<!--                                    <span class="month">Всього переглядів: </span>-->
<!--                                    <span class="count">--><?//= $countViews ?><!--</span>-->
<!--                                </p>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <p>-->
<!--                                    <span class="month">Унікальних відвідувачів: </span>-->
<!--                                    <span class="count">--><?//= $countHitViews ?><!--</span>-->
<!--                                </p>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->

                </div>
            </div><!-- /row -->
        </div>
    </div><!-- /x_content  -->

</div><!-- /x_panel  -->