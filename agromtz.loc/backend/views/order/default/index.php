<?php

use backend\widgets\GridView;
use kotchuprik\sortable\grid\Column;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $pageTitle */

$this->title = $pageTitle;
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- search -->
<? // $this->render('_search') ?>
<!-- /search -->

<div class="x_panel">

    <?php $form = ActiveForm::begin(); ?>

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
            <div class="col-sm-2 col-xs-12 text-center pool-right">
                <a class="btn btn-success"
                   href="<?= Url::to(['create']) ?>"
                   role="button"><i class="fa fa-pencil-square"></i> Додати новий запис
                </a>
            </div>
        </div>
    </div>
    <!-- /table header -->

    <div class="x_content">
        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row">
                <div class="col-xs-12">
                    <?php Pjax::begin() ?>
                    <? try {
                        echo GridView::widget(
                            [
                                'dataProvider' => $dataProvider,
                                'rowOptions' => function ($model, $key, $index, $grid) {
                                    return ['data-sortable-id' => $model->id];
                                },
                                'hover' => true,
                                'bordered' => false,
                                'striped' => false,
//                                'layout' => "{items}\n{pager}",
                                'columns' => [
                                    [
                                        'class' => 'yii\grid\CheckboxColumn',
                                        'headerOptions' => ['style' => 'text-align:center'],
                                        'contentOptions' => ['style' => 'text-align:center'],
                                        'checkboxOptions' => function ($model) {
                                            return ['value' => $model->id];
                                        },
                                        'cssClass' => 'ads_table',
                                    ],
                                    [
                                        'header' => '<i class="fa fa-sort"></i>',
                                        'headerOptions' => ['style' => 'width:20px; text-align:center;'],
                                        'contentOptions' => ['style' => 'text-align:center;'],
                                        'class' => Column::class,
                                        'useCdn' => false
                                    ],
                                    'name',
                                    'id',
//                                    'content',
                                    [
                                        'attribute' => 'category_id',
                                        'value' => function($model) {
                                            return !empty($model->category->name) ? $model->category->name : '';
                                        }
                                    ],
                                    [
                                        'attribute' => 'created_at',
                                        'value' => function ($model) {
                                            return date('d-m-Y р.', $model->created_at);
                                        },
                                    ],
                                    [
                                        'attribute' => 'updated_at',
                                        'value' => function ($model) {
                                            return date('d-m-Y р.', $model->updated_at);
                                        },
                                    ],
                                    [
                                        'attribute' => 'status',
                                        'headerOptions' => ['style' => 'text-align:center'],
                                        'contentOptions' => ['style' => 'text-align:center'],
                                        'format' => 'raw',
                                        'value' => function($model) {
                                            return Html::activeCheckbox($model, 'status', [
                                                'class' => 'js-switch',
                                                'label' => false,
                                                'onchange'=>'changeStatus("'. Url::toRoute(['status', 'id' => $model->id]) .'")'
                                            ]);
                                        },
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => '<i class="fa fa-gears"></i>',
                                        'headerOptions' => ['style' => 'width:100px; text-align:center;'],
                                        'contentOptions' => ['style' => 'text-align:center;'],
                                        'template' => '{update} {delete}',
                                        'buttons' => [
                                            'update' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-pencil"></i>',
                                                    $url, [
                                                        'class' => 'btn btn-primary btn-xs',
                                                        'title' => 'Редагувати',
                                                    ]);
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-trash-o">',
                                                    $url, [
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'data-method' => 'post',
                                                        'title' => 'Видалити',
                                                        'data-confirm' => 'Справді видалити?'
                                                    ]);
                                            }
                                        ],
//                                        'visibleButtons' => [
//                                            'delete' => function ($model) {
//                                                return $model->needs != 1;
//                                            },
//                                        ]
                                    ],
                                ],
                                'options' => [
                                    'data' => [
                                        'sortable-widget' => 1,
                                        'sortable-url' => Url::toRoute(['sorting']),
                                    ]
                                ],
                            ]
                        );
                    } catch (Exception $e) {
                        Yii::error($e);
                    } ?>

                    <?php Pjax::end() ?>

                </div><!-- /col-sm-12 -->
            </div><!-- /row -->
        </div>
    </div><!-- /x_content  -->

    <?php ActiveForm::end(); ?>

</div><!-- /x_panel  -->
