<?php
namespace App\Controller;

use Onlyou\Formwork\Controller;

class DefaultController extends Controller{
    public function actionIndex(){
        $k = $this->request->query['k'];
        $this->render('default.index',['test'=>$k]);
    }

    public function actionFuck(){
        echo 'sdf';
    }
}