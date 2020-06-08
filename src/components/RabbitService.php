<?php

namespace app\components;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitService
{
    protected $connection = null;
    private function getConnection()
    {
        if ($this->connection === null) {
            $this->connection = new AMQPStreamConnection('host.docker.internal', 5672, 'user', 'user');
        }
        return $this->connection;
    }

    private function declareQue(string $name)
    {
        $channel = $this->getConnection()->channel();
        $channel->queue_declare($name, false, true,false, false);
        return $channel;
    }

    public function getOrdersQue()
    {
        return $this->declareQue('orders');
    }

    public function getPaymentsQue()
    {
        return $this->declareQue('payments');
    }

    public function getDeliveryQue()
    {
        return $this->declareQue('delivery');
    }

    public function getCommentsQue()
    {
        return $this->declareQue('comments');
    }

    public function close()
    {
        $this->getConnection()->close();
    }
}