<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\Url;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        //echo '<pre>';
        //print_r([
        //    'isGuest' => Yii::$app->user->isGuest, 
        //    'route' => $action->controller->id == 'site', 
        //    'action' => $action->id == 'login'
        //]);
        //echo '</pre>';

        //exit;

        if(Yii::$app->user->isGuest && !($action->controller->id == 'site' && $action->id == 'login')) {
            $this->redirect(Url::toRoute(['site/login']));
        }

        if(!parent::beforeAction($action)) return false;

        return true;
    }
}
