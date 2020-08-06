<?php

use common\modules\settings\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\widgets\Menu;

/* @var $this yii\web\View */
/* @var $categories */
/* @var $breadcrumbs */
/* @var $categoryModel common\models\product\ProductCategory */
/* @var $model common\models\product\Product */

$this->title = $model->name . ' - ' . Settings::getSetting( 'siteName' );
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="category">
                <p>Каталог</p>
				<?= Menu::widget( [
					'items'           => $categories,
					'options'         => [
						'class' => 'main_category',
					],
					'submenuTemplate' => "<ul class='dropdown_items'>\n{items}\n</ul>",
				] ); ?>
            </div>
        </div>

        <div class="col-md-9">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb_main">
					<?= Breadcrumbs::widget( [
						'links'              => isset( $breadcrumbs ) ? $breadcrumbs : [],
						'tag'                => 'ol',
						'options'            => [
							'class' => 'breadcrumb breadcrumb_main',
						],
						'itemTemplate'       => '<li class="breadcrumb-item">{link}</li>',
						'activeItemTemplate' => '<li class="breadcrumb-item active" aria-current="page">{link}</li>',
					] ); ?>
                </ol>
            </nav>
            <div class="item_block">
                <h1><?= $model->name ?></h1>

                <div class="row">
                    <div class="col-md-6">
                        <div class="slider">
                            <div><img src="<?= $model->getImage()->getUrl() ?>" alt="1"></div>
                            <!--                            <div><img src="images/item_slider/item1.jpg" alt="1"></div>-->
                            <!--                            <div><img src="images/item_slider/item1.jpg" alt="1"></div>-->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="description_block">
                            <h2>Артикул: <?= $model->article ?></h2>
							<?php if ( $model->in_stock ): ?>
                                <p class="item_available">Є у наявності</p>
							<?php else: ?>
                                <p class="item_notavailable">Немає в наявності</p>
							<?php endif; ?>
                            <p class="item_price"><?= $model->price ?> грн</p>

                            <div class="number">
                                <span class="minus_counter">—</span>
                                <input type="text" value="1" title="Counter" class="counter">
                                <span class="plus_counter">+</span>
                            </div>

                            <button class="btn buy_btn item_buy_btn">В корзину</button>
                        </div>
                    </div>
                </div>

            </div>

            <ul class="nav nav-pills nav_pills_item">
                <li class="active"><a data-toggle="pill" href="#desc">Опис</a></li>
                <li><a data-toggle="pill" href="#params">Характеристики</a></li>
            </ul>

            <div class="tab-content tab-content_item">
                <div id="desc" class="tab-pane fade in active">
					<?php if ( $model->content ): ?>
                        <p><?= $model->content ?></p>
					<?php else: ?>
                        <p>Опис товару відсутній</p>
					<?php endif; ?>
                </div>
                <div id="params" class="tab-pane fade">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>Ниша</td>
                            <td>Конверсия, %</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Товары для детей</td>
                            <td>3,21</td>
                        </tr>
                        <tr>
                            <td>Парфюмерия и косметика</td>
                            <td>2,94</td>
                        </tr>
                        <tr>
                            <td>Магазины продажи товаров различных групп</td>
                            <td>1,76</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <h3>Інші товари</h3>

            <div class="cards">
                <div class="col-md-3">
                    <div class="item">
                        <div class="image_block">
                            <img src="images/items/item1.jpg" class="img-responsive">
                        </div>
                        <p class="price">500 грн</p>
                        <button class="btn buy_btn">Купити</button>
                        <p class="name">Назва товару</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="item">
                        <div class="image_block">
                            <img src="images/items/item1.jpg" class="img-responsive">
                        </div>
                        <p class="price">500 грн</p>
                        <button class="btn buy_btn">Купити</button>
                        <p class="name">Назва товару</p>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="item">
                        <div class="image_block">
                            <img src="images/items/item1.jpg" class="img-responsive">
                        </div>
                        <p class="price">500 грн</p>
                        <button class="btn buy_btn">Купити</button>
                        <p class="name">Назва товару</p>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="item">
                        <div class="image_block">
                            <img src="images/items/item1.jpg" class="img-responsive">
                        </div>
                        <p class="price">500 грн</p>
                        <button class="btn buy_btn">Купити</button>
                        <p class="name">Назва товару</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="item">
                        <div class="image_block">
                            <img src="images/items/item1.jpg" class="img-responsive">
                        </div>
                        <p class="price">500 грн</p>
                        <button class="btn buy_btn">Купити</button>
                        <p class="name">Назва товару</p>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="item">
                        <div class="image_block">
                            <img src="images/items/item1.jpg" class="img-responsive">
                        </div>
                        <p class="price">500 грн</p>
                        <button class="btn buy_btn">Купити</button>
                        <p class="name">Назва товару</p>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="item">
                        <div class="image_block">
                            <img src="images/items/item1.jpg" class="img-responsive">
                        </div>
                        <p class="price">500 грн</p>
                        <button class="btn buy_btn">Купити</button>
                        <p class="name">Назва товару</p>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="item">
                        <div class="image_block">
                            <img src="images/items/item1.jpg" class="img-responsive">
                        </div>
                        <p class="price">500 грн</p>
                        <button class="btn buy_btn">Купити</button>
                        <p class="name">Назва товару</p>
                    </div>
                </div>
            </div><!--end .cards-->

        </div>
    </div>
</div>
