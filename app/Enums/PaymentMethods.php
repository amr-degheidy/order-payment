<?php

namespace App\Enums;

enum PaymentMethods: string
{
    case Paypal = 'paypal';
    case Stripe = 'stripe';
}
