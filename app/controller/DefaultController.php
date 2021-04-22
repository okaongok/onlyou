<?php
namespace App\Controller;

use Onlyou\Framework\Controller;

class DefaultController extends Controller{
    public function actionIndex(){
        $k = $this->request->query('k','default k');
        $this->render('default.index',['test'=>$k]);
    }

    public function actionFuck(){
        echo 'sdf';
    }
}