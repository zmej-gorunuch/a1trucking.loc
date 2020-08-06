<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $pageTitle */

$this->title = $pageTitle;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Додати новий запис';
?>
<div class="create">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-pencil-square"></i> <?= Html::encode('Додати новий запис') ?></h2>
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