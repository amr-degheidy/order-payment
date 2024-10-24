<?php

namespace App\Contracts;

use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Message\ResponseInterface;

readonly class PaypalPaymentMethodAdapter implements PaymentMethodInterface
{
    public function __construct(
        private GatewayInterface $gateway
    ){
    }

    public function purchase(array $parameters): ResponseInterface
    {
        return $this->gateway->purchase($parameters)->send();
    }

    public function complete(array $parameters): ResponseInterface
    {
       return $this->gateway->completePurchase([
           'transactionReference'=> $parameters['paymentId'],
           'PayerID'=> $parameters['PayerId'],
       ])->send();
    }

}
