<?php


namespace app\controllers;


use app\components\RabbitService;
use PhpAmqpLib\Message\AMQPMessage;
use yii\web\Controller;

class TestsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOrder()
    {
        $order = [
            'Товар 1' => 5,
            'Товар 2' => 3
        ];

        $msg = new AMQPMessage(json_encode($order));

        $service = new RabbitService();
        $chanel = $service->getOrdersQue();
        $chanel->basic_publish($msg, '', 'orders');
        $chanel->close();
        $service->close();

        echo 'Сообщение отправлено';
    }

    public function actionPayment()
    {
        $msg = new AMQPMessage("Поступила оплата");

        $service = new RabbitService();
        $chanel = $service->getPaymentsQue();
        $chanel->basic_publish($msg, '', 'payments');
        $chanel->close();
        $service->close();

        echo 'Сообщение отправлено';
    }
}