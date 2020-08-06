<?php

use common\modules\settings\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Корзина - ' . Settings::getSetting( 'siteName' );
?>

<div class="container">
    <div class="row">

        <h1 class="cart_text">Корзина</h1>
        <table id="cart" class="table table-hover table-condensed ">
            <thead>
            <tr>
                <th style="width:50%">Товар</th>
                <th style="width:10%">Ціна/шт.(грн)</th>
                <th style="width:8%">Кількість</th>
                <th style="width:22%" class="text-center">Сума (грн)</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-th="Товар:">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..."
                                                             class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin">Деталь 1</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Ціна:">300</td>
                <td data-th="Кількість:">
                    <input type="number" class="form-control text-center" value="1">
                </td>
                <td data-th="Сума (грн):">300</td>
                <td class="actions">
                    <button class="btn btn-danger btn-sm">Видалити</button>
                </td>
            </tr>

            <tr>
                <td data-th="Товар:">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..."
                                                             class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin">Деталь 1</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Ціна:">300</td>
                <td data-th="Кількість:">
                    <input type="number" class="form-control text-center" value="1">
                </td>
                <td data-th="Сума (грн):">300</td>
                <td class="actions">
                    <button class="btn btn-danger btn-sm">Видалити</button>
                </td>
            </tr>


            <tr>
                <td data-th="Товар:">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..."
                                                             class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin">Деталь 1</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Ціна:">300</td>
                <td data-th="Кількість:">
                    <input type="number" class="form-control text-center" value="1">
                </td>
                <td data-th="Сума (грн):">300</td>
                <td class="actions">
                    <button class="btn btn-danger btn-sm">Видалити</button>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Загальна сума: <span>300</span></strong></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Загальна сума: <span>300</span></strong></td>
                <td><a href="<?= Url::toRoute( [ '/cart/default/checkout' ] ) ?>" class="btn btn-success btn-block">
                        Оформити замовлення</a></td>
            </tr>
            </tfoot>
        </table>

    </div>
</div>