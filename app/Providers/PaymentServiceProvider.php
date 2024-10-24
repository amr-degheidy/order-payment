<?php

namespace App\Providers;

use App\Contracts\PaymentMethodInterface;
use App\Contracts\PaymentResponseInterface;
use App\Contracts\PaypalPaymentResponseAdapterInterface;
use App\Factories\Payment\PaymentMethodFactory;
use App\Services\Payment\PaymentService;
use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);
        $this->app->bind(PaymentMethodInterface::class, function(){
            return PaymentMethodFactory::create();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
