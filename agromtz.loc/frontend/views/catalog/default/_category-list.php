<?php

use common\modules\settings\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\product\Product */

$this->title = 'Каталог товарів - ' . Settings::getSetting( 'siteName' );
?>
<div class="col-md-3 col-sm-6">
    <a href="<?= $model::createLink( $model->id ) ?>">
        <div class="cat_item">
            <img src="<?= $model->getImage()->getUrl( '200x' ) ?>" alt="фото <?= $model->name ?>" >
            <p><?= $model->name ?></p>
        </div>
    </a>
</div>
