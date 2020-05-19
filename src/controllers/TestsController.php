<?php


namespace app\controllers;


use yii\web\Controller;

class TestsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}