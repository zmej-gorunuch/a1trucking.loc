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
/* @var $dataProvider yii\debug\models\timeline\DataProvider */

$this->title = $categoryModel->name . ' - ' . Settings::getSetting( 'siteName' );
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

            <div class="catalog_block">
                <h1><?= $categoryModel->name ?></h1>
                <div class="row">

                    <div class="col-md-12">
                        <p><?= $categoryModel->content ?></p>
                    </div>

					<?= ListView::widget( [
						'dataProvider'     => $dataProvider,
						'itemView'         => '_category-list',
						'layout'           => '{items}{pager}',
						'emptyTextOptions' => [
							'tag'   => 'div',
							'class' => 'col-md-12',
						],
					] ); ?>

                </div><!--End catalog block-->
            </div>

        </div>

    </div>
</div>
