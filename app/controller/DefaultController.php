<?php
namespace App\Controller;

use Onlyou\Framework\Controller;
use Onlyou\Framework\Model;
use Onlyou\WebApp;

class DefaultController extends Controller{
    public function actionIndex(){
        $k = $this->request->query('k','default k');
        $this->render('default.index',['test'=>$k]);
    }

    public function actionFuck(){
        $query = Model::$db->query('select * from sns_user limit 1');
        $s = $query->fetch(\PDO::FETCH_ASSOC);
        print_r($s);
    }
}