<?php

namespace common\modules\statistic\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%statistic}}".
 *
 * @property int $id
 * @property string $ip
 * @property string $url
 * @property int $country
 * @property int $device
 * @property int $date
 * @property int $count_views
 * @property int $black_list_ip
 */
class Statistic extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%statistic}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'url', 'country', 'device'], 'string'],
            [['date', 'black_list_ip', 'count_views'], 'integer'],
            [['url', 'country', 'device'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'IP',
            'url' => 'Url',
            'country' => 'Країна',
            'device' => 'Пристрій',
            'count_views' => 'Кількість переглядів',
            'date' => 'Дата',
            'black_list_ip' => 'Заблокований ip',
        ];
    }

    /**
     * Запис в БД
     *
     * @param string $ip
     * @param $url
     * @param int $black_list_ip
     */
    public function setCount($ip, $url, $black_list_ip = 0){
        $dayStart = mktime(0,0,0);
        $dayStop = mktime(0,0,0, date("m"), date("d")+1, date("Y"));
        $model = $this->find()->where('ip = :ip',[':ip' => $ip])->andWhere(['<=','date', $dayStop])->andWhere(['>=','date', $dayStart])->one();

        if(!$model){
            $this->ip = $ip;
            $this->url = $url;
            $this->date = time();
            $this->count_views = 1;
            $this->black_list_ip = $black_list_ip;
            $this->save();
        }
        else {
            ++$model->count_views;
            $model->save();
        }
    }
}
