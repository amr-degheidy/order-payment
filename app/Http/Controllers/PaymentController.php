<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentMethodInterface;
use App\Models\Order;
use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentServiceInterface $paymentService
    ){
    }

    public function paymentSuccess(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $PayerId = $request->input('PayerID');

        try{
            $this->paymentService->completePayment(['paymentId' => $paymentId, 'PayerId' => $PayerId]);
            return print('success payment');
        } catch (\Exception $exception){
            throw new \Exception( $exception->getMessage());

        }

    }

    public function paymentCancel(Request $request)
    {
        try{
            $this->paymentService->cancelPayment(['token'=>$request->input('token')]);
            return print('cancel payment');
        }catch (\Exception $exception){
            throw new \Exception( $exception->getMessage());
        }

    }
}
