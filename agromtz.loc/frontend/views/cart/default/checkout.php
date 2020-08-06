<?php

use common\modules\settings\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Оформлення замовлення - ' . Settings::getSetting( 'siteName' );

?>
<div class="container">
    <div class="row">
        <div class="catalog_block contact_block">
            <div class="col-md-12">
                <h1>Вкажіть ваші дані</h1>

                <div class="row">
                    <div class="col-md-12">
                        <form class="contact_form">
                            <div class="form-group">
                                <input type="text"  class="form-control" placeholder="Ваше Ім'я *"  required />
                            </div>
                            <div class="form-group">
                                <input type="text"  class="form-control" placeholder="Ваш Email *"  required/>
                            </div>
                            <div class="form-group">
                                <input type="text"  class="form-control" placeholder="Ваш номер телефону *" required />
                            </div>

                            <div class="form-group">
                                <button class="btn btn_contact">Замовити</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
