<?php

use common\modules\settings\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\product\Product */

$this->title = 'Каталог товарів - ' . Settings::getSetting( 'siteName' );
?>
<div class="col-md-3">
    <div class="item">
        <div class="image_block">
            <a href="<?= $model::createLink( $model->id ) ?>">
                <img src="<?= $model->getImage()->getUrl( 'x100' ) ?>"
                     class="img-responsive" alt="фото <?= $model->name ?>">
            </a>
        </div>
        <p class="price"><?= $model->price ?> грн</p>
        <button class="btn buy_btn">Купити</button>
        <a href="<?= $model::createLink( $model->id ) ?>">
            <p class="name"><?= $model->name ?></p>
        </a>

    </div>
</div>
