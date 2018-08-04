<?php

trait Payable
{
    public function pay(int $amount): float
    {
        $result = $amount*(1 - $this->tax);
        echo "PAY WITH " . __CLASS__ . $result."<br>";
        return $result;
    }
}

abstract class PaymentParent
{
    abstract public function pay(int $amount): float;
}


class PayPal extends PaymentParent
{

    use Payable;
    public $tax = 0.15;

    public function info()
    {
        // TODO: Implement info() method.
    }
}

class LiqPay extends PaymentParent
{
    use Payable;
    public $tax = 0.12;

    public function info()
    {
        // TODO: Implement info() method.
    }
}

class Stripe extends PaymentParent
{
    use Payable;
    public $tax = 0.05;

    public function info()
    {
        // TODO: Implement info() method.
    }
}


class Payment
{
    private $service;
    public function __construct(?PaymentParent $service = null)
    {
        $this->service = $service;
    }

    public function setPaymentSystem(PaymentParent $service)
    {
        $this->service = $service;
    }

    public function pay(int $amount)
    {
        $result = $this->service->pay($amount);
        $this->log($amount, $result);
    }

    private function log($input, $output)
    {
        $send = $input;
        $tax = $this->service->tax;
        $string = (get_class($this->service))." => SEND: ".$send." TAX: ".$tax." RESULT: ".$output." DATE: ".date("Y-m-d H:i:s").PHP_EOL;
        file_put_contents('log.log', $string, FILE_APPEND);
    }
}

$service = new Payment();
$service->setPaymentSystem(new Stripe());
$service->pay(rand(100,900));
$service->setPaymentSystem(new PayPal());
$service->pay(rand(100,900));
$service->setPaymentSystem(new LiqPay());
$service->pay(rand(100,900));














/**
//OPEN CLOSED PRINCIPLE
class User
{

    private $name;
    private $age;
    private $date;

    public function __construct(string $name = null, int $age = null)
    {

    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
}

$user = new User();
$user->setName("Viktor")->setAge(25);


*/











/*


interface Payable
{
    public function pay(int $amount): float;
}


class PayPal implements Payable
{
    const TAX = 0.05;
    public function pay(int $amount): float
    {
        $result = $amount*(1 - self::TAX);
        echo "PAY WITH " . __CLASS__ . $result."<br>";
        return $result;
    }
}

class LiqPay implements Payable
{
    const TAX = 0.15;
    public function pay(int $amount): float
    {
        $result = $amount*(1 - self::TAX);
        echo "PAY WITH " . __CLASS__ . $result."<br>";
        return $result;
    }
}

class Stripe implements Payable
{
    const TAX = 0.03;
    public function pay(int $amount): float
    {
        $result = $amount*(1 - self::TAX);
        echo "PAY WITH " . __CLASS__ . $result."<br>";
        return $result;
    }
}


class Payment
{
    private $service;
    public function __construct(?Payable $service = null)
    {
        $this->service = $service;
    }

    public function setPaymentSystem(Payable $service)
    {
        $this->service = $service;
    }

    public function pay(int $amount)
    {
        $result = $this->service->pay($amount);
        $this->log($amount, $result);
    }

    private function log($input, $output)
    {
        $send = $input;
        $tax = $this->service::TAX;
        $string = (get_class($this->service))." => SEND: ".$send." TAX: ".$tax." RESULT: ".$output." DATE: ".date("Y-m-d H:i:s").PHP_EOL;
        file_put_contents('log.log', $string, FILE_APPEND);
    }
}

$service = new Payment();
$service->setPaymentSystem(new Stripe());
$service->pay(rand(100,900));
$service->setPaymentSystem(new PayPal());
$service->pay(rand(100,900));
$service->setPaymentSystem(new LiqPay());
$service->pay(rand(100,900));

*/