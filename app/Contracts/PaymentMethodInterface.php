<?php

namespace App\Contracts;

interface PaymentMethodInterface
{
    public function purchase(array $parameters);

    public function complete(array $parameters);

}
