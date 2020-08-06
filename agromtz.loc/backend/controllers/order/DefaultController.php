<?php

namespace backend\controllers\order;

use backend\controllers\SiteController;
use common\models\order\Order;
use Exception;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class DefaultController
 * @package common\modules\post\controllers\backend
 */
class DefaultController extends SiteController {
	private $title = 'Замовлення';

	public function actions() {
		return [

		];
	}

	/**
	 * Список записів моделі.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$pageTitle    = $this->title;
		$dataProvider = new ActiveDataProvider( [
			'query' => Order::find()->orderBy( [ 'order' => SORT_ASC ] ),
		] );

		if ( Yii::$app->request->isPjax ) {

			return $this->renderAjax( 'index', compact( 'pageTitle', 'dataProvider' ) );
		}

		return $this->render( 'index', compact( 'pageTitle', 'dataProvider' ) );
	}

	/**
	 * Додати новий запис в БД.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$pageTitle    = $this->title;
		$model        = new Order();
		$attributes = [];

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			Yii::$app->getSession()->setFlash( 'success', 'Новий запис додано' );

			return $this->redirect( [ 'update', 'id' => $model->id ] );
		}

		return $this->render( 'create', compact( 'pageTitle', 'model' ) );
	}

	/**
	 * Редагувати запис в БД.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate( $id ) {
		$pageTitle = $this->title;

		$model = $this->findModel( $id );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			Yii::$app->getSession()->setFlash( 'success', 'Зміни збережено' );

			return $this->redirect( Yii::$app->request->referrer ?: $this->redirect( [ 'index' ] ) );
		}

		return $this->render( 'update', compact( 'pageTitle', 'model', 'attributes' ) );
	}

	/**
	 * Видалити запис з БД.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException
	 * @throws Exception
	 * @throws Throwable
	 * @throws yii\db\StaleObjectException
	 */
	public function actionDelete( $id ) {
		$model = $this->findModel( $id );
		$model->delete();
		Yii::$app->getSession()->setFlash( 'success', 'Запис видалено' );

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Видалення записів SelectCheckbox
	 *
	 * @return yii\web\Response
	 * @throws Exception
	 * @throws Throwable
	 * @throws yii\db\StaleObjectException
	 */
	public function actionDeleteSelect() {
		if ( isset( $_REQUEST['selection'] ) ) {
			$selection = Yii::$app->request->post( 'selection' );
			foreach ( $selection as $id ) {
				$model = $this->findModel( $id );
				$model->delete();
			}
			Yii::$app->getSession()->setFlash( 'success', 'Вибрані записи видалено!' );

			return $this->redirect( [ 'index' ] );
		} else {
			Yii::$app->getSession()->setFlash( 'warning', 'Нічого не вибрано!' );

			return $this->redirect( [ 'index' ] );
		}
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
