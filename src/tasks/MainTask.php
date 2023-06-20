<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{
    public function mainAction()
    {
        echo 'This is the default task and the default action' . PHP_EOL;
    }
    public function insertAction($name="", $price=0, $zipcode=""){
        $flag=0;
        $arr=[
            'name'=>$name,
            'price'=>$price,
            'zipcode'=>$zipcode,
            'status'=>"In-Process",
        ];
        if (!($arr['name'] && $arr['price'] && $arr['zipcode'])){
            $arr['status']='Rejected';
            $flag=1;
        }
        $success = $this->mongo->order->insertOne($arr);
        if ($success->getInsertedCount() and !($flag)){
            echo "Order Placed SuccessFully" . PHP_EOL;
        }
        else{
            echo "Order Rejected" . PHP_EOL;
        }
    }
}
