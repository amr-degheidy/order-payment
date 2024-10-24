<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Http\Requests\UserOrderRequest;
use App\Services\Order\OrderServiceInterface;
use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderServiceInterface $orderService,
        private readonly PaymentServiceInterface $paymentService,
    ) {
    }

    public function userOrders(UserOrderRequest $request) {
        return response()->json([
            'orders'=> $this->orderService->getUserOrders($request->validated())
        ]);

    }
    public function placeOrder(PlaceOrderRequest $request): JsonResponse
    {
        $order = $this->orderService->placeOrder($request->validated());
        try{
            $approvalUrl = $this->paymentService->payOrder($order);
            return response()->json(['approvalUrl' => $approvalUrl]);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'something went wrong'], 500);
        }

    }

}
