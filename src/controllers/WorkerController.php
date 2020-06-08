<?php


namespace app\controllers;


use app\components\RabbitService;
use yii\web\Controller;

class WorkerController extends Controller
{
    public function actionIndex() {
        $service = new RabbitService();

        $chanel = $service->getOrdersQue();
        $chanel->basic_consume('orders', '',
            false,
            true,
            false,
            false,
        [$this, 'processOrders']);

        $chanel = $service->getPaymentsQue();
        $chanel->basic_consume('payments', '',
            false,
            true,
            false,
            false,
            [$this, 'processPayments']);
    }

    public function processOrders($msg)
    {
        var_dump($msg);
    }

    public function processPayments($msg)
    {
        var_dump($msg);
    }
}