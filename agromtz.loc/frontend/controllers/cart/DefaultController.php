<?php

namespace frontend\controllers\cart;

use common\models\order\Order;
use common\models\product\Product;
use frontend\controllers\SiteController;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Class DefaultController
 */
class DefaultController extends SiteController {

	/**
	 * Сторінка корзини
	 *
	 * @return mixed|string
	 */
	public function actionIndex() {

		return $this->render( 'index' );
	}

	/**
	 * Сторінка оформлення замовлення
	 *
	 * @return mixed|string
	 */
	public function actionCheckout() {

		return $this->render( 'checkout' );
	}

	/**
	 * Finds the model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Order|null
	 * @throws NotFoundHttpException
	 */
	protected function findModel( $id ) {
		if ( ( $model = Order::findOne( $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}
}
