<?php

declare(strict_types=1);

namespace App\Factories\Payment;

use App\Contracts\PaypalPaymentMethodAdapter;
use App\Contracts\PaymentMethodInterface;
use Omnipay\Omnipay;

final class PaymentMethodFactory
{
    public static function create(string $type = 'paypal'): PaymentMethodInterface
    {
        return match ($type) {
            'paypal' => self::createPaypal(),
        };
    }

    private static function createPaypal(): PaymentMethodInterface
    {
        $Omnipay = Omnipay::create('PayPal_Rest');
        $Omnipay->setClientId(config('payment.paypal.client_id'));
        $Omnipay->setSecret(config('payment.paypal.client_secret'));
        $Omnipay->setTestMode(config('payment.paypal.test_mode'));
        return new PaypalPaymentMethodAdapter($Omnipay);
    }
}
