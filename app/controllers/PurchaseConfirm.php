<?php

namespace App\controllers;

use App\core\Encryption;
use App\models\Admin;
use App\core\Controller;
use App\core\Database;


class PurchaseConfirm
{
    use Controller;
    public function index()
    {
        $decryption = new Encryption();
        $ticketId = (int)$decryption->decrypt($_GET['ticketId'], $decryption->getKey());

        $ticketIdFormat = $this->formatToFiveDigits($ticketId);

        $data = [
           'ticketId' => $ticketIdFormat,
        ];

        $this->view("Customer/Payment/PurchaseConfirm", $data);
    }

    function formatToFiveDigits($value) {
        return str_pad($value, 6, '0', STR_PAD_LEFT);
    }
}