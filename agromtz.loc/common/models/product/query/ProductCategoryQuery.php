<?php

namespace common\models\product\query;

use common\models\product\ProductCategory;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

/**
 * Class PostCategoryQuery
 */
class ProductCategoryQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::class,
        ];
    }

	public function active() {
		return $this->andWhere([ProductCategory::tableName().'.status' => 1]);
	}
}
