<?php

namespace App\Services\Payment;

use App\Models\Order;

interface PaymentServiceInterface
{
    public function payOrder(Order $order);

    public function completePayment(array $paymentInfo = []);

    public function cancelPayment(array $paymentInfo = []);

}
