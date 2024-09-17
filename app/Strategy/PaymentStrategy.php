<?php

namespace App\Strategy;


//Strategy Interface
interface PaymentStrategy
{
    public function pay(float $amount);

}