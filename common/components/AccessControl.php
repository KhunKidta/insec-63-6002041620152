<?php
namespace common\components;

use Yii;
//use yii\base\Action;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class AccessControl extends ActionFilter {

    public $params = [];
    public $denyCallback;
    private $separator = '-';

    private function getItemName($component) {
        return strtr($component->getUniqueId(), '/', $this->separator);
    }

      public function beforeAction($action) {
        $user = Yii::$app->getUser();
        $controller = $action->controller;
       // echo $user -> 'id';
       // $permission= $user ->id;
        $permission= $controller->id;
        $permission.= '-';
        $permission.= $controller->action->id;
        //echo $permission;
            if(Yii::$app->user->can($permission)){
                //ehco 'can be access'.$permission;
                return true;
            }else{
               // echo 'do not access'.$permission;
               throw new ForbiddenHttpException(
  'Contact Administrator'
               );
        } 
        
    }

    /*protected function denyAccess($user) {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }*/

}