<?php

/*
 * The Client Handling Payment Request
 * */

namespace App\Strategy;

//Strategy Interface
use App\Strategy\PaymentStrategy;

//Concrete Strategy
use App\Strategy\CardStrategy;

//Concrete Strategy
use App\Strategy\EWalletStrategy;

//Concrete Strategy
use App\Strategy\CashStrategy;

class PaymentStrategyContext
{
    private PaymentStrategy $paymentStrategy;

    public function __construct(string $paymentMethod)
    {
        $this->paymentStrategy = match ($paymentMethod) {
            'wallet' => new EWalletStrategy(),
            'card' => new CardStrategy(),
            'cash' => new CashStrategy(),
            default => throw new \InvalidArgumentException("Payment method {$paymentMethod} is not supported"),
        };
    }

    public function pay(array $paymentData)
    {
        return $this->paymentStrategy->pay($paymentData);
    }

}