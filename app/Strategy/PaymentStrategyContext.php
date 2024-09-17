<?php
/*
 * Handling Payment Request
 * */

namespace App\Strategy;

//Strategy Interface
use App\Strategy\PaymentStrategy;

//Concrete Strategy
use App\Strategy\GrabPayStrategy;

//Concrete Strategy
use App\Strategy\TouchNGoStrategy;

//Concrete Strategy
use App\Strategy\CashStrategy;

class PaymentStrategyContext
{
    private PaymentStrategy $paymentStrategy;

    public function __construct(string $paymentMethod)
    {
        $this->paymentStrategy = match ($paymentMethod) {
            'cash' => new CashStrategy(),
            'tng' => new TouchNGoStrategy(),
            'grab' => new GrabPayStrategy(),
            default => throw new \InvalidArgumentException("Payment method {$paymentMethod} is not supported"),
        };
    }

    public function pay($amount)
    {
        return $this->paymentStrategy->pay($amount);
    }

}