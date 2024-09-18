<?php

namespace App\Strategy;


//Strategy Interface
interface PaymentStrategy
{
    public function pay(array $paymentData);
}


//For Payment
//amount
//paymentMethod
//custInfo = custName, custEmail

//For Seat
//seats = H01|H02|H03..... => may need to store multiple times
//hallId = for Seat

//Ticket
//scheduleId
//userId
