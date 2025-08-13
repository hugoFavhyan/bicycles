<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PaymentController extends Controller
{
    public function response()
    {
        $transactionId = $this->request->getGet('id');

        // Here you would typically verify the transaction status with Wompi's API
        // For now, we'll just show a simple confirmation page.

        return view('payment/response', ['transactionId' => $transactionId]);
    }
}
