<?php

namespace common\modules\statistic\behaviors;

use common\modules\statistic\models\Statistic;
use Yii;
use yii\base\Behavior;
use yii\web\Controller;

class StatisticBehavior extends Behavior
{

    public $actions;

    /**
     * Привязка метода addStatistic до події
     *
     * @return array
     */
    public function events()
    {
        return [
            Controller::EVENT_AFTER_ACTION  => 'addStatistic',
        ];
    }

    public function addStatistic()
    {
        $controller = $this->owner;

        $action = $controller->action->id;
        if(array_search($action, $this->actions) === false)
            return false;

        $model = new Statistic();

        $ip = Yii::$app->request->userIP; // IP користувача
//        if($ip == '127.0.0.1')
//            return false;

        $bot_name = self::isBot(); // Перевірка на бота

        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $url =  $protocol . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"]; //URL відвіданої сторінки



        if(!$bot_name){
            //Проверка в черном списке
//            $black = $model->inspection_black_list($ip);
//            if(!$black){
                $model->setCount($ip, $url, 0);
//            }
        }
        return true;
    }

    /**
     * Перевірка на бота
     *
     * @return false|int
     */
    public static function isBot()
    {
        $is_bot = preg_match(
            "~(Google|Yahoo|Rambler|Bot|Yandex|Spider|Snoopy|Crawler|Finder|Mail|curl)~i",
            $_SERVER['HTTP_USER_AGENT']
        );
        return $is_bot;
    }

}
