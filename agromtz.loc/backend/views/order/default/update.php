<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

/* @var $model common\models\Post */
/* @var $pageTitle */

$this->title = $pageTitle;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редагувати: ' . $model->name;
?>
<div class="update">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-pencil-square"></i> <?= Html::encode('Редагувати: ' . $model->name) ?></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
